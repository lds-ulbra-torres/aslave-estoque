<script type="text/javascript">
	$(document).ready(function(){
		var change = 0;
		$("#show_password").click(function(){
			$("#change_password").show("slow");
			$(this).hide();
			change = 1;
			$("input").prop('required',true);
		});
		$("#update-user").submit(function(e){
			e.preventDefault();
			if($("input[name=user_confirm_password]").val() != $("input[name=user_password]").val()){
				Materialize.toast("O campo senha e confirmar senha estão com valores diferentes", 4000);
				return false;
			}else{
				$.ajax({
					url: "<?php echo site_url('/UserController/updateUser')?>",
					type: "POST",
					data: {
						id_user: "<?= $this->uri->segment(3) ?>",
						full_name: $("input[name=user_name]").val(),
						login: $("input[name=user_login]").val(),
						password: $("input[name=user_password]").val(),
						confirm_password: change
					},
					success: function(data){
						if(data == 1){
							document.location.href = "<?= base_url('users'); ?>";
						}else{
							Materialize.toast(data, 4000);	
						}
					},
					error: function(data){
						console.log(data);
						Materialize.toast("Ocorreu algum erro", 4000);
					}
				});
			}
		});
	});
</script>
<div class="container">
	<div class="row">
		<a href="<?=base_url('users') ?>">< Voltar para usuários</a>
		<div div class="row card-panel">
			<h4>Alterar Usuário</h4>
			<form id="update-user">
				<div>
					<label for="user-name">Nome *</label>
					<input name="user_name" required="required" value="<?php foreach($user_data as $row){ echo $row['full_name'];}?>" type="text">
				</div>
				<div>
					<label for="user-name">Login de acesso *</label>
					<input name="user_login" required="required" value="<?php foreach($user_data as $row){ echo $row['login'];}?>" type="text">
				</div>
				<button type="button" id="show_password" class="btn">Alterar senha<i class="material-icons right">lock</i> </button>
				<div id="change_password" style="display:none;">
					<div>
						<label for="user-name">Nova senha *</label>
						<input name="user_password"  type="password">
					</div>
					<div>
						<label for="user-name">Confirmar senha *</label>
						<input name="user_confirm_password"  type="password">
					</div>
				</div>
				<div align="right">
					<button type="submit" id="" class="btn green">Salvar<i class="material-icons right">send</i> </button>	
				</div>
			</form>
		</div>
	</div>
</div>
