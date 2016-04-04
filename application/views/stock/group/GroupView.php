<div id="content_table" class="container">
	<table class="striped">
		<legend><h4>Categorias</h4></legend>
		<thead>
			<td>Nome</td>
			<td>Ações</td>
		</thead>
		<tbody>
			<?php foreach($groups as $row) :?>
				<tr>
				  <td><?= $row['name_group'] ?></td>
				  <td><a href="<?= base_url('stock/groups/update/'.$row['id_group']); ?>">Alterar</a></td>
				  <td><a href="<?= base_url('stock/groups/delete/'.$row['id_group']); ?>">Apagar</a></td>
           		</tr>
                  <?php endforeach; ?>
        </tbody>
	</table>	
</div>
