<script type="text/javascript">
	$(document).ready(function(){
		$("#new-user").submit(function(e){
			e.preventDefault();
			if($("input[name=user_confirm_password]").val() != $("input[name=user_password]").val()){
				$("input[name=user_password]").css("border-bottom", "1px solid red");
				$("input[name=user_confirm_password]").css("border-bottom", "1px solid red").focus();
				return false;
			}else{
				$.ajax({
					url: "<?php echo site_url('/UserController/createUser')?>",
					type: "POST",
					data: $("#new-user").serialize(),
					success: function(data){
						if(data == 1){
							Materialize.toast("Usuário cadastrado com sucesso", 4000);
							$("#new-user").each (function(){
								this.reset();
							});
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
		<h4>Novo Usuário</h4>
			<form id="new-user">
				<div>
					<label for="user-name">Nome *</label>
					<input name="user_name" required="required" type="text">
				</div>
				<div>
					<label for="user-name">Login de acesso *</label>
					<input name="user_login" required="required" type="text">
				</div>
				<div>
					<label for="user-name">Senha *</label>
					<input name="user_password" required="required" type="password">
				</div>
				<div>
					<label for="user-name">Confirmar senha *</label>
					<input name="user_confirm_password" required="required" type="password">
				</div>
				<div class="" align="right">
					<button type="submit" id="" class="btn green">Salvar<i class="material-icons right">send</i> </button>
				</div>
			</form>
		</div>
	</div>
</div>