<div id="content_table" class="container">
		<table class="striped centered">
			<legend><h4>Movimentações de estoque</h4></legend>
			<thead>
				<td>Produto</td>
				<td>Categoria</td>
				<td>Preço</td>
				<td>Quantidade</td>
				<td>Total</td>
				<td>Data de entrada</td>
				<td>Data de saida</td>
				<td>Ações</td>
			</thead>
			<tbody>
					<?php foreach($stocks as $dados) :?>
				<tr>
				  <td><?= $dados['name_product'] ?></td>
				  <td><?= $dados['name_group'] ?></td>
				  <td><?= $dados['price'] ?></td>
				  <td><?= $dados['amount'] ?></td>
				  <td><?= $dados['total'] ?></td>
				  <td><?= $dados['input'] ?></td>
				  <td><?= $dados['output'] ?></td>
				  <td>
				  <a class="deleteProduct" id="<?php echo $dados['id_product']; ?>" href="#">Apagar</a></td>
           		</tr>
                  <?php endforeach; ?>
					
			</tbody>
		</table>

		<div id="stockModal" class="modal">
		<div class="modal-content">
			<h4>Aviso</h4>
			<div class="row">
				<p>Realmente quer deletar este Produto do estoque?</p>
			</div>
		</div>
		<div class="modal-footer">
			<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
			<a href="#!" id="deleteStock" class=" modal-action modal-close waves-effect waves-green btn-flat">Apagar</a>
		</div>
	</div>

</div>



