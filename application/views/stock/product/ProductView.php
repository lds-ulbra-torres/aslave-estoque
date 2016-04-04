<div id="content_table" class="container">
	<table class="striped">
		<legend><h4>Produtos</h4></legend>
		<thead>
			<td>Nome</td>
			<td>Categoria</td>
			<td>Ações</td>
		</thead>
		<tbody>
			<?php foreach($products as $row) :?>
				<tr>
				  <td><?= $row['name_product'] ?></td>
				  <td><?= $row['name_group'] ?></td>
				  <td><a href="<?= base_url('stock/products/update/'.$row['id_group']); ?>">Alterar</a></td>
				  <td><a href="<?= base_url('stock/products/delete/'.$row['id_group']); ?>">Apagar</a></td>
           		</tr>
                  <?php endforeach; ?>
        </tbody>
	</table>	
</div>