<div class="container">
	<div class="container row">
		<div class="col s12">
			<table class="striped">
				<legend><h4>Entradas de estoque</h4></legend>
				<thead>
					<td>Produto</td>
					<td>Categoria</td>
					<td>Preço</td>
					<td>Quantidade</td>
					<td>Data de entrada</td>
				</thead>
				<tbody>
						<?php
							foreach($stock_in as $dados){ 
								echo "<tr>";
								echo "<td>";
								echo $dados['name_product'];
								echo "</td>";
								echo "<td>";
								echo $dados['name_group'];
								echo "</td>";
								echo "<td>";
								echo $dados['unit_price'];
								echo "</td>";
								echo "<td>";
								echo $dados['input_amount'];
								echo "</td>";
								echo "<td>";
								echo $dados['input_date'];
								echo "</td>";
								echo"</tr>";
							}
						?>
				</tbody>
			</table>	
		</div>
	</div>

	<div class="container row">
		<div class="col s12">
			<table class="striped">
				<legend><h4>Saídas de estoque</h4></legend>
				<thead>
					<td>Produto</td>
					<td>Categoria</td>
					<td>Preço</td>
					<td>Quantidade</td>
					<td>Data de saída</td>
				</thead>
				<tbody>
						<?php
							foreach($stock_out as $dados){ 
								echo "<tr>";
								echo "<td>";
								echo $dados['name_product'];
								echo "</td>";
								echo "<td>";
								echo $dados['name_group'];
								echo "</td>";
								echo "<td>";
								echo $dados['unit_price'];
								echo "</td>";
								echo "<td>";
								echo $dados['output_amount'];
								echo "</td>";
								echo "<td>";
								echo $dados['output_date'];
								echo "</td>";
								echo"</tr>";
							}
						?>
				</tbody>
			</table>
		</div>
	</div>
</div>