    <script type="text/javascript">
    $(document).ready(function () {
        function reloadTableUsers() {
            $.ajax({
                url: "<?= base_url('users/');?>",
                type: "POST",
                data: $("table"),
                success: function (data) {
                    $("#users").html($(data).find("table"));
                },
                error: function () {
                    console.log(data);
                    Materialize.toast('Erro ao recarregar a tabela, atualize a pagina!', 4000);
                }
            });
        }

        var idUser;
        $("body").on("click", ".delete_user", function () {
            idUser = $(this).attr("id");
            $("#delete_user_modal").openModal();
        });
        $("#delete_user").click(function () {
            $.ajax({
                url: "<?= base_url('UserController/deleteUser');?>",
                type: "POST",
                data: {user: idUser},
                success: function (data) {
                    reloadTableUsers();
                    Materialize.toast(data, 4000);
                },
                error: function (data) {
                    console.log(data);
                    Materialize.toast("Ocorreu algum erro", 4000);
                }
            });
        });
        $("input[name=search]").keyup(function (e) {
            e.preventDefault();
            if ($(this).val() != '') {
                $.ajax({
                    url: "<?= base_url('UserController/searchUser');?>",
                    type: "POST",
                    data: {search: $("input[name=search]").val()},
                    success: function (data) {
                        $('#loadUser').html("");
                        var obj = JSON.parse(data);
                        if (obj.length > 0) {
                            try {
                                var items = [];
                                $.each(obj, function (i, val) {
                                    items.push($("<a href='#' class='user'  id=" + val.id_user + ">" + val.full_name + "</a><br>"));
                                });
                                $('#loadUser').append.apply($('#loadUser'), items);
                            } catch (e) {
                                alert('Ocorreu algum erro ao carregar os Usuários!');
                            }
                        } else {
                            $('#loadUser').html($('<span/>').text("Nenhum Usuário encontrado!"));
                        }
                    },
                    error: function (data) {
                        console.log(data);
                        Materialize.toast("Ocorreu algum erro", 4000);
                    }
                });
            } else {
                $('#loadUser').html("");
            }
        });
        $("body").on("click", ".user", function () {
            $("input[name=search]").val($(this).text());
            $("input[name=search]").attr("id", $(this).attr("id"));
            $('#loadUser').html("");
        });
        $("#search_button").click(function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('UserController/searchUser');?>",
                type: "POST",
                data: {
                    search: $("input[name=search]").val()
                },
                success: function (data) {

                    var obj = JSON.parse(data);
                    if (!obj.length > 0) {
                        Materialize.toast("Nenhum usuário encontrado", 4000);
                    } else {
                        $('#users > tbody').html("");
                        try {
                            var items = [];
                            $.each(obj, function (i, val) {
                                items.push($("<tr><td>" + val.full_name + "</td><td>" + val.login + "</td><td><a href='<?= base_url('user/update/'); ?>/" + val.id_user + "'>Alterar</a> | <a href='#' class='delete_user' id=" + val.id_user + ">Apagar</a></td></tr>"));
                            });
                            $('#users > tbody').append.apply($('#users > tbody'), items);
                        } catch (e) {
                            alert('Ocorreu algum erro ao carregar os Usuários!');
                        }
                    }
                },
                error: function (data) {
                    console.log(data);
                    Materialize.toast("Ocorreu algum erro", 4000);
                }
            });
        });
    });
</script>
<div class="container">
    <div class="row">
        <h4>Usuários</h4>
        <div class="card-panel col s12 m12">
            <div class="input-field col s12 m6 l3">
                <a class="green btn" href="<?= base_url('user/create') ?>">Adicionar novo</a>
            </div>
            <div class="input-field col s12 m7 l6">
                <input type="text" name="search" placeholder="Nome do usuário" autocomplete="off" required>
                <div style="min-height: 30px;" id="loadUser" class="col s12" style="position: relative; bottom: 0;">
                </div>
            </div>
            <div class="input-field col s12 m1 l1">
                <button href="#" id="search_button" class="btn green">Buscar</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12 m12 collection responsive-table">
            <table id="users" class="bordered highlight">
                <thead>
                <td><strong>Nome</strong></td>
                <td><strong>Login</strong></td>
                <td><strong>Ações</strong></td>
                </thead>
                <tbody>
                <?php foreach ($users as $row) : ?>
                    <tr>
                        <td><?= $row['full_name'] ?></td>
                        <td><?= $row['login'] ?></td>
                        <td>
                            <a href="<?= base_url('user/update/' . $row['id_user']); ?>"><i class="material-icons">edit</i></a>&nbsp;
                            <a class="delete_user" id="<?= $row['id_user']; ?>" href="#"><i class="material-icons">delete</i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="delete_user_modal" class="modal">
    <div class="modal-content">
        <h4>Aviso</h4>
        <div class="">
            <p>Realmente quer apagar este usuário?</p>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close btn-flat">Cancelar</a>
        <a href="#!" id="delete_user" class="modal-action modal-close waves-effect waves-red btn-flat">Apagar</a>
    </div>
</div>