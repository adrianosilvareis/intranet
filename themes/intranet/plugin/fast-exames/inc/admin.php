<?php
if (file_exists(FAST_PATH . '_models/AdminExames.class.php')):
    include_once FAST_PATH . '_models/AdminExames.class.php';
endif;

$exameId = filter_input(INPUT_GET, "exameId", FILTER_DEFAULT);

$AdminExames = new AdminExames();
$FeExames = new FeExames();
$FeExames->Execute()->findAll();
?>

<div class="panel panel-default">

    <div class="btn-group">
        <a href="javascript:down()" title="Novo" class="btn btn-danger glyphicon glyphicon-plus"></a>
        <a href="javascript:up()" title="Pagina usuario" class="btn btn-danger glyphicon glyphicon-user"></a>
    </div>

    <!--tem que melhorar parei aqui-->
    <script type="text/javascript">
        $(document).ready(function () {
<?php
if (!empty($exameId)):
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

    <hr>
    <div class = "panel panel-default" id = "form">

        <?php
        $exame = $AdminExames->FindId($exameId);
        if (!empty($exameId) && !$exame):
            WSErro("Nenhum resultado encontrado!", WS_INFOR);
        else:

            /**
             * ex_id
             * ex_descricao
             * ex_sinonimia
             * ex_unidade
             * ex_valor_referencia
             * ex_prazo
             * ex_info_paciente
             * ex_info_coleta
             * ex_info_interferentes
             * ex_info_encaminhamento
             * ex_valor
             * ex_status
             * ex_data_abertura
             * ex_data_fechamento
             * ex_paciente_os
             * ws_users
             * ws_users_soli
             * fe_setor_soli
             * fe_setor_exec
             * fe_material
             * fe_metodo

             */
            ?>

            <h1 class="text-center">Formulario de requisição de exame</h1>
            <form method="post" class="form">

                <div class="row bg-success">

                    <div class="form-group col-md-12">
                        <label>Descrição:</label>
                        <input class="form-control" title="Descrição" type="text" name="ex_descricao" placeholder="Descrição" value="<?= $exame->ex_descricao; ?>">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Sinonimia:</label>
                        <textarea class="form-control" title="Sinonimia" name="ex_sinonimia" placeholder="Sinonimia"> 
                            <?= $exame->ex_sinonimia; ?>
                        </textarea>
                    </div>

                </div>

                <div class="row bg-warning">

                    <div class="form-group col-md-6">
                        <label>Solicitante:</label>
                        <select title="Setor Solicitante" name="fe_setor_soli" class="form-control">
                            <option value="">Selecione um solicitante</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Setor execução:</label>
                        <select title="Setor Solicitante" name="fe_setor_exec" class="form-control">
                            <option value="">Selecione um setor</option>
                        </select>
                    </div>

                </div>

                <div class="row bg-info">
                    <div class="form-group col-md-4">
                        <label>Unidade:</label>
                        <input class="form-control" title="Unidade" type="text" name="ex_unidade" placeholder="Unidade" value="<?= $exame->ex_unidade; ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Prazo:</label>
                        <input class="form-control" title="Prazo" type="text" name="ex_prazo" placeholder="Prazo" value="<?= $exame->ex_prazo; ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Valor:</label>
                        <input class="form-control" title="Valor" type="text" name="ex_valor" placeholder="Valor" value="<?= $exame->ex_valor; ?>">
                    </div>
                </div>

                <div class="row bg-primary">
                    <div class="form-group col-md-6">
                        <label>Informação Paciente:</label>
                        <textarea class="form-control" title="Info Paciente" name="ex_info_paciente" placeholder="Info Paciente"> 
                            <?= $exame->ex_info_paciente; ?>
                        </textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Informação Coleta:</label>
                        <textarea class="form-control" title="Info Coleta" name="ex_info_coleta" placeholder="Info Coleta"> 
                            <?= $exame->ex_info_coleta; ?>
                        </textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Informação Encaminhamento:</label>
                        <textarea class="form-control" title="Info Encaminhamento" name="ex_info_encaminhamento" placeholder="Info Encaminhamento"> 
                            <?= $exame->ex_info_encaminhamento; ?>
                        </textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Informação Interferentes:</label>
                        <textarea class="form-control" title="Info Interferentes" name="ex_info_interferentes" placeholder="Info Interferentes"> 
                            <?= $exame->ex_info_interferentes; ?>
                        </textarea>
                    </div>
                </div>

                <div class="row bg-danger">
                    <div class="form-group col-md-12">
                        <label>Vr:</label>
                        <textarea class="form-control" title="Valor de Referencia" name="ex_valor_referencia" placeholder="Valor de Referencia"> 
                            <?= $exame->ex_valor_referencia; ?>
                        </textarea>
                    </div>   

                    <div class="form-group col-md-4">
                        <label>Paciente teste:</label>
                        <input class="form-control" title="Paciente teste" type="datetime" value="<?= $exame->ex_paciente_os; ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Data Abertura:</label>
                        <input class="form-control" title="Data Abertura" type="datetime" value="<?= $exame->ex_data_abertura; ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Data Fechamento:</label>
                        <input class="form-control" title="Data Fechamento" type="datetime" value="<?= $exame->ex_data_fechamento; ?>">
                    </div>
                </div>
                <hr>
                <input type="submit" class="btn btn-success" value="Registrar"/>
            </form>
        <?php
        endif;
        ?>



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
                                    <a href="<?= FAST_INCLUDE . "&exameId=$ex_id"; ?>" title="Editar" class="btn btn-danger glyphicon glyphicon-pencil"></a>
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