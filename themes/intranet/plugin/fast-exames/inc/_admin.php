<?php
if (file_exists(FAST_PATH . '_models/AdminExames.class.php')):
    include_once FAST_PATH . '_models/AdminExames.class.php';
endif;

$exameId = filter_input(INPUT_GET, "exameId", FILTER_DEFAULT);
$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$AdminExames = new AdminExames();
$FeExames = new FeExames();
$FeExames->Execute()->findAll();
?>

<div class="panel panel-default">

    <div class="btn-group">
        <a href="javascript:down()" title="Novo" class="btn btn-danger glyphicon glyphicon-plus"></a>
        <a href="javascript:up()" title="Pagina usuario" class="btn btn-danger glyphicon glyphicon-list"></a>
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
    </script>

    <hr>
    <div class = "panel panel-default" id = "form">

        <?php
        $form = true;
        if (!empty($exameId) && !$Dados):
            $Dados = (array) $AdminExames->FindId($exameId);
            if (empty($Dados['ex_descricao'])):
                WSErro("Pedido não encontrado!", WS_INFOR);
                $form = false;
            endif;
        endif;

//        'ex_id' => string '1' (length = 1)
//        'ex_status' => string '1' (length = 1)
//        'ws_users' => string '1' (length = 1)
//        'ws_users_soli' => string '1' (length = 1)
//        'fe_material' => string '1' (length = 1)
//        'fe_metodo' => string '1' (length = 1)
        ?>
        
        <?php if ($form): ?>
            <h1 class="text-center">Formulario de requisição de exame</h1>
            <form method="post" class="form">

                <div class="row bg-success">

                    <div class="form-group col-md-12">
                        <label>Descrição:</label>
                        <input class="form-control" title="Descrição" type="text" name="ex_descricao" placeholder="Descrição" value="<?= $Dados['ex_descricao']; ?>">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Sinonimia:</label>
                        <textarea class="form-control" title="Sinonimia" name="ex_sinonimia" placeholder="Sinonimia"><?= $Dados['ex_sinonimia']; ?></textarea>
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
                        <input class="form-control" title="Unidade" type="text" name="ex_unidade" placeholder="Unidade" value="<?= $Dados['ex_unidade']; ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Prazo:</label>
                        <input class="form-control" title="Prazo" type="text" name="ex_prazo" placeholder="Prazo" value="<?= $Dados['ex_prazo']; ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Valor:</label>
                        <input class="form-control" title="Valor" type="text" name="ex_valor" placeholder="Valor" value="<?= $Dados['ex_valor']; ?>">
                    </div>
                </div>

                <div class="row bg-primary">
                    <div class="form-group col-md-6">
                        <label>Informação Paciente:</label>
                        <textarea class="form-control" title="Info Paciente" name="ex_info_paciente" placeholder="Info Paciente"><?= $Dados['ex_info_paciente']; ?></textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Informação Coleta:</label>
                        <textarea class="form-control" title="Info Coleta" name="ex_info_coleta" placeholder="Info Coleta"><?= $Dados['ex_info_coleta']; ?></textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Informação Encaminhamento:</label>
                        <textarea class="form-control" title="Info Encaminhamento" name="ex_info_encaminhamento" placeholder="Info Encaminhamento"><?= $Dados['ex_info_encaminhamento']; ?></textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Informação Interferentes:</label>
                        <textarea class="form-control" title="Info Interferentes" name="ex_info_interferentes" placeholder="Info Interferentes"><?= $Dados['ex_info_interferentes']; ?></textarea>
                    </div>
                </div>

                <div class="row bg-danger">

                    <div class="form-group col-md-12">
                        <label>Vr:</label>
                        <textarea class="form-control" title="Valor de Referencia" name="ex_valor_referencia" placeholder="Valor de Referencia"><?= $Dados['ex_valor_referencia']; ?></textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Paciente teste:</label>
                        <input class="form-control" title="Paciente teste" type="text" name="ex_paciente_os"  placeholder="Paciente teste" value="<?= $Dados['ex_paciente_os']; ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Data Abertura:</label>
                        <input class="formDate form-control" title="Data Abertura" type="text" name="ex_data_abertura"  value="<?= date("d/m/Y H:i:s", strtotime($Dados['ex_data_abertura'])); ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Data Fechamento:</label>
                        <input class="formDate form-control" title="Data Fechamento" type="text" name="ex_data_fechamento"  value="<?= date("d/m/Y H:i:s", strtotime($Dados['ex_data_fechamento'])); ?>">
                    </div>

                </div>
                <hr>
                <input type="submit" class="btn btn-success" value="Registrar"/>
            </form>
        <?php endif; ?>
            
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