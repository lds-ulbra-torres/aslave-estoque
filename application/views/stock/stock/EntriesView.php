<script type="text/javascript">
$(document).ready(function(){ 
	
});
</script>
<div class="row">
	<h4>Entradas de Estoque</h4>
	<div class="card-panel col s11">
		<div class="input-field col s3">
			<a class="green btn" href="<?=base_url('stock/entries/create') ?>">Adicionar nova</a>
		</div>
		<div class="input-field col s3">
        	<input type="text" placeholder=" Buscar entradas..." required>
        </div>
        <div class="input-field col s2">
        	<button href="#" id="search_button" class="btn grey">
        		<i class="material-icons">search</i>
        	</button>
        </div>
	</div>
</div>

<div class="row">
	<div class="col s11">
		<table class="bordered highlight">
			<thead>
				<td><strong>Fornecedor</strong></td>
				<td><strong>Data</strong></td>
				<td><strong>Valor total</strong></td>
				<td><strong>Tipo</strong></td>
				<td><strong>Ações</strong></td>
			</thead>
			<tbody>
				<?php foreach($input_stocks as $row) :?>
					<tr>
						<td>
							<a href="<?= base_url('stock/input/create/'.$row['id_stock']); ?>"><?= $row['name']; ?></a>
						</td>
						<td><?= $row['input_date'] ?></td>
						<td>Test</td>
						<td><?php switch ($row['input_type']) {
							case '1':
								echo 'Compra';
								break;
							
							case '2':
								echo 'Doação';
								break;
						} ?></td>
						<td>
							<a href="#">Alterar</a> |
							<a class="delete_stock_btn" id="<?= $row['id_stock']; ?>" href="#">Apagar</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div id="delete_stock_modal" class="modal">
		<div class="modal-content">
			<h4>Aviso</h4>
			<div class="row">
				<p>Realmente quer apagar esta entrada de estoque?</p>
			</div>
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
			<a href="#!" id="delete_stock" class="modal-action modal-close waves-effect waves-red btn-flat">Apagar</a>
		</div>
	</div>
</div>