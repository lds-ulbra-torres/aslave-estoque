<script type="text/javascript">
$(document).ready(function(){ 
	
});
</script>
<div class="row">
	<h4>Saídas de Estoque</h4>
	<div class="card-panel col s11">
		<div class="input-field col s3">
			<a class="green btn" href="<?=base_url('stock/outputs/create') ?>">Adicionar nova</a>
		</div>
		<div class="input-field col s3">
        	<input type="text" placeholder=" Fornecedor..." required>
        </div>
        <div class="input-field col s1">
        	<button href="#" id="search_button" class="btn grey">
        		<i class="material-icons">search</i>
        	</button>
        </div>
        <div class="input-field col s3">
			<select id="group_id">
				<option disabled selected> Filtrar fornecedor...</option>
				<?php foreach($output_stocks as $row) :
					echo "<option value=".$row['id_people'].">";
					echo $row['name'];
					echo "</option>";
				endforeach; ?>
			</select>
		</div>
		<div class="input-field col s2">
			<select id="group_id">
				<option disabled selected> Ambiente</option>
				<option value="1"> Uso interno</option>
				<option value="2"> Uso externo</option>
			</select>
		</div>
	</div>
</div>

<div class="row">
	<div class="col s11 collection">
		<table class="bordered highlight">
			<thead>
				<td><strong>Fornecedor</strong></td>
				<td><strong>Data</strong></td>
				<td><strong>Valor total</strong></td>
				<td><strong>Ações</strong></td>
			</thead>
			<tbody>
				<?php foreach($output_stocks as $row) :?>
					<tr>
						<td><a href="<?= base_url('stock/outputs/'.$row['id_stock']); ?>"><?= $row['name'] ?></a></td>
						<td><?= date('d/m/Y', strtotime($row['output_date'])); ?></td>
						<td><?='R$ ' . number_format($row['sum_value'], 2, ',', '.');?></td>
						<td>
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
				<p>Realmente quer apagar esta saída de estoque?</p>
			</div>
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
			<a href="#!" id="delete_stock" class="modal-action modal-close waves-effect waves-red btn-flat">Apagar</a>
		</div>
	</div>
</div>