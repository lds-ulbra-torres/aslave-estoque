<div id="divTable" class="container">
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
			</thead>
			<tbody>
					<?php
						foreach($stocks as $dados){ 
							echo "<tr>";
							echo "<td>";
							echo $dados['name_product'];
							echo "</td>";
							echo "<td>";
							echo $dados['name_group'];
							echo "</td>";
							echo "<td>";
							echo $dados['price'];
							echo "</td>";
							echo "<td>";
							echo $dados['amount'];
							echo "</td>";
							echo "<td>";
							echo $dados['total'];
							echo "</td>";
							echo "<td>";
							echo $dados['input'];
							echo "</td>";
							echo "<td>";
							echo $dados['output'];
							echo "</td>";
							echo"</tr>";
						}
					?>
			</tbody>
		</table>	
	</div>