<div class="container">
    <h4>Internos</h4>
        <div class="card-panel col s12 row">
            <div class="col s12 m3">
                <a class="margin-alter green btn" href="<?= base_url('internal/create'); ?>">Adicionar novo</a>
            </div>
            <div class="input-field col s12 m6 l7" >
                <input type="text" name="search" class="margin-alter" placeholder=" Buscar pessoa..." required>
            </div>
            <div class="col s12 m2">
                <button href="#" id="search_button" class="margin-alter btn green">Buscar</button>
            </div>
        </div>

        <div class="row">
            <div class="col s12 collection">
                <table id="" class="bordered highlight">
                    <thead>
                        <td><strong>Nome</strong></td>
                        <td><strong>CPF</strong></td>
                        <td><strong>Data de Entrada</strong></td>
                    </thead>
                    <tbody>
                        <?php  foreach ($teste as $teste) :?>
                        	<tr>
                        	    <td></td>
                        	    <td></td>
                        	    <td></td>
                        	    <td>
									<a href="<?= base_url('')?>">Alterar</a>
											|
									<a class="delete_people" id="" href="#">Apagar</a>
									</a>

								</td>
                        	</tr>
                         <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
</div>