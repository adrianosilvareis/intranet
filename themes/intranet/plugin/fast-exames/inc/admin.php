<?php
if (file_exists(FAST_PATH . '_models/AdminExames.class.php')):
    include_once FAST_PATH . '_models/AdminExames.class.php';
endif;


$AdminExames = new AdminExames();
$FeExames = new FeExames();
$FeExames->Execute()->findAll();
?>

<div class="panel panel-default">

    <div class="btn-group">
        <a href="javascript:down()" title="Novo" class="btn btn-danger glyphicon glyphicon-plus"></a>
        <a href="javascript:up()" title="Pagina usuario" class="btn btn-danger glyphicon glyphicon-user"></a>
    </div>
    <hr>


    <?php
    $teste = filter_input(INPUT_GET, "teste", FILTER_DEFAULT);
    ?>
    <!--tem que melhorar parei aqui-->
    <script type="text/javascript">
        $(document).ready(function () {
<?php
if (!empty($teste)):
    ?>
                down();
    <?php
else:
    ?>
                up();
<?php
endif;
?>
        });

        function down() {
            $("#list").slideUp("slow", function () {
                $("#form").slideDown();
            });
        }

        function up() {
            $("#form").slideUp(function () {
                $("#list").slideDown("slow");
            });
        }
    </script>

    <div class = "panel panel-default" id = "form">
        <form class = "form form-horizontal" method = "post">
            <div class = "form-group">
                <label>Nome:</label>
                <input class = "form-control" type = "text" name = "nome" placeholder = "nome"/>
            </div>
            <div class = "form-group">
                <label>Telefone:</label>
                <input class = "form-control" type = "tel" name = "telefone" placeholder = "telefone"/>
            </div>
            <div class = "form-group">
                <label>Email:</label>
                <input class = "form-control" type = "email" name = "email" placeholder = "email"/>
            </div>
            <div class = "form-group">
                <label>Idade:</label>
                <input class = "form-control" type = "text" name = "idade" placeholder = "idade"/>
            </div>
            <input type = "submit" name = "form" value = "enviar"/>
        </form>
    </div>

    <div class = "panel panel-default" id = "list">
        <?php
        if (!$FeExames->Execute()->getResult()):
            WSErro("Nenhum Solicitação foi encontrada no momento!", WS_INFOR);
        else:
            ?>
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th class="text-center">Solicitante</th>
                        <th class="text-center">Aberto em</th>
                        <th class="text-center">Setor</th>
                        <th class="text-center">Exame</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">O.S Paciente Teste</th>
                        <th class="text-center">Assinado por</th>
                        <th class="text-center">Fechado em</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($FeExames->Execute()->getResult() as $exames):
                        extract((array) $exames);
                        ?>
                        <tr>
                            <td><?= $AdminExames->Setor($fe_setor_soli); ?></td>
                            <td><?= date("d/m/Y H:i:s", strtotime($ex_data_abertura)); ?></td>
                            <td><?= $AdminExames->Setor($fe_setor_exec); ?></td>
                            <td><?= $ex_descricao; ?></td>
                            <td><?= ($ex_status ? "concluido" : "em processamento") ?></td>
                            <td><?= $ex_paciente_os; ?></td>
                            <td><?= $AdminExames->Usuario($ws_users); ?></td>
                            <td><?= date("d/m/Y H:i:s", strtotime($ex_data_fechamento)); ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="javascript:alerta('ok')" title="Editar" class="btn btn-danger glyphicon glyphicon-pencil"></a>
                                    <a title="Confirmação" class="btn btn-danger glyphicon glyphicon-ok"></a>
                                    <a title="Remover" class="btn btn-danger glyphicon glyphicon-trash"></a>
                                </div>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</div>