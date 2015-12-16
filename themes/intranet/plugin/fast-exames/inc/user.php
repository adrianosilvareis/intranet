<?php
if (file_exists(FAST_PATH . '_models/AdminExames.class.php')):
    include_once FAST_PATH . '_models/AdminExames.class.php';
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$AdminExames = new AdminExames();
$FeAcoes = new FeAcoes();
$FeSetor = new FeSetor();
$FeMaterial = new FeMaterial();
$FeExames = new FeExames();

$getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
$Pager = new Pager(FAST_INCLUDE . "&page=");
$Pager->ExePager($getPage, 15);

$FeExames->Execute()->FullRead("SELECT * FROM fe_exames WHERE ex_cancelado = 0 ORDER BY ex_status, ex_data_abertura LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);

//separa os dados que podem ser nulos
$nulos = ["ex_info_encaminhamento" => $Dados['ex_info_encaminhamento'], "ex_info_interferentes" => $Dados['ex_info_interferentes'], "ex_info_coleta" => $Dados['ex_info_coleta'], "ex_info_paciente" => $Dados['ex_info_paciente'], "ex_observacao" => $Dados['ex_observacao'], "ex_unidade" => $Dados['ex_unidade'], "ex_sinonimia" => $Dados['ex_sinonimia']];
//exclui os mesmos do array Dados
unset($Dados['ex_sinonimia'], $Dados['ex_unidade'], $Dados['ex_observacao'], $Dados['ex_info_paciente'], $Dados['ex_info_coleta'], $Dados['ex_info_interferentes'], $Dados['ex_info_encaminhamento']);

if (!empty($Dados) && !in_array("", $Dados)):
    $Dados['ws_users_soli'] = Check::UserLogin()['user_id'];
    $Dados['ex_data_abertura'] = date('Y-m-d H:i:s');
    $Dados['ex_sinonimia'] = $nulos['ex_sinonimia'];
    $Dados['ex_unidade'] = $nulos['ex_unidade'];
    $Dados['ex_observacao'] = $nulos['ex_observacao'];
    $Dados['ex_info_paciente'] = $nulos['ex_info_paciente'];
    $Dados['ex_info_coleta'] = $nulos['ex_info_coleta'];
    $Dados['ex_info_interferentes'] = $nulos['ex_info_interferentes'];
    $Dados['ex_info_encaminhamento'] = $nulos['ex_info_encaminhamento'];
    unset($nulos);

    if (!is_numeric($Dados['ex_valor']) || !is_numeric($Dados['ex_prazo'])):
        WSErro("O <b>valor e o prazo</b> informado tem que ser numerico!", WS_ALERT);
        WSErro("A solicitação não foi salva!", WS_ERROR);
    elseif ($AdminExames->ExeCreate($Dados)):
        WSErro("Solicitação cadastrada com sucesso!", WS_ACCEPT);
        header("Location: " . FAST_INCLUDE);
    else:
        WSErro("Erro ao cadastrar solicitação!", WS_ERROR);
    endif;
endif;
?>

<div class="panel panel-default">

    <div class="btn-group">
        <a href="javascript:down()" title="Novo" class="btn btn-danger glyphicon glyphicon-plus"></a>
        <a href="javascript:up()" title="Pagina usuario" class="btn btn-danger glyphicon glyphicon-list"></a>
        <?php if (Check::UserLogin(3)): ?>
            <a href="<?= FAST_INCLUDE ?>admin/" title="Gerenciamento" class="btn btn-danger glyphicon glyphicon-cog"></a>
        <?php endif; ?>
    </div>

    <!--tem que melhorar parei aqui-->
    <script type="text/javascript">
        $(document).ready(function () {
            up();
        });
    </script>

    <hr>
    <!--formulario de criação-->
    <div class = "panel panel-default" id = "form">

        <h1 class="text-center">Formulario de requisição de exame</h1>
        <form method="post" class="form">

            <div class="row bg-info">

                <div class="form-group col-md-8">
                    <label>Descrição:</label>
                    <input required="true" class="form-control" title="Descrição" type="text" name="ex_descricao" placeholder="Descrição" value="<?= $Dados['ex_descricao']; ?>">
                </div>

                <div class="form-group col-md-4">
                    <label>Minemônico:</label>
                    <input required="true" class="form-control" title="Minemônico" type="text" name="ex_minemonico" placeholder="Minemônico" value="<?= $Dados['ex_minemonico']; ?>">
                </div>

                <div class="form-group col-md-12">
                    <label>Sinonimia:</label>
                    <textarea class="form-control" title="Sinonimia" name="ex_sinonimia" placeholder="Sinonimia"><?= $Dados['ex_sinonimia']; ?></textarea>
                </div>

                <div class="form-group col-md-12">
                    <label>Ação a executar:</label>
                    <select  required="true" title="Ação a executar" name="fe_acoes" class="form-control">
                        <option value="">Selecione uma ação</option>
                        <?php
                        $FeAcoes->setAcao_status(true);
                        $FeAcoes->Execute()->Query("#acao_status#");
                        foreach ($FeAcoes->Execute()->getResult() as $acao):
                            extract((array) $acao);
                            $select = ($Dados['fe_acoes'] == $acao_id ? 'selected=true' : '');
                            echo "<option value=\"{$acao_id}\" {$select}>{$acao_descricao}</option>";
                        endforeach;
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>Solicitante:</label>
                    <select  required="true" title="Setor Solicitante" name="fe_setor_soli" class="form-control">
                        <option value="">Selecione um solicitante</option>
                        <?php
                        $FeSetor->setSet_status(true);
                        $FeSetor->setSet_solicita(true);
                        $FeSetor->Execute()->Query("#set_status# AND #set_solicita#");
                        foreach ($FeSetor->Execute()->getResult() as $setor):
                            extract((array) $setor);
                            $select = ($Dados['fe_setor_soli'] == $set_id ? 'selected=true' : '');
                            echo "<option value=\"{$set_id}\" {$select}>{$set_descricao}</option>";
                        endforeach;
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>Setor execução:</label>
                    <select required="true" title="Setor Solicitante" name="fe_setor_exec" class="form-control">
                        <option value="">Selecione um setor</option>
                        <?php
                        $FeSetor->setSet_status(true);
                        $FeSetor->setSet_solicita(null);
                        $FeSetor->setSet_execucao(true);
                        $FeSetor->Execute()->Query("#set_status# AND #set_execucao#");
                        foreach ($FeSetor->Execute()->getResult() as $setor):
                            extract((array) $setor);
                            $select = ($Dados['fe_setor_exec'] == $set_id ? 'selected=true' : '');
                            echo "<option value=\"{$set_id}\" {$select}>{$set_descricao}</option>";
                        endforeach;
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label>Unidade:</label>
                    <input class="form-control" title="Unidade" type="text" name="ex_unidade" placeholder="Unidade" value="<?= $Dados['ex_unidade']; ?>">
                </div>

                <div class="form-group col-md-4">
                    <label>Prazo:</label>
                    <input required="true" class="form-control" title="Prazo" type="text" name="ex_prazo" placeholder="Prazo" value="<?= $Dados['ex_prazo']; ?>">
                </div>

                <div class="form-group col-md-4">
                    <label>Valor:</label>
                    <input required="true" class="form-control" title="Valor" type="text" name="ex_valor" placeholder="Valor" value="<?= $Dados['ex_valor']; ?>">
                </div>

                <div class="form-group col-md-6">
                    <label>Método:</label>
                    <input required="true" class="form-control" title="Valor" type="text" name="ex_metodo" placeholder="Metodo" value="<?= $Dados['ex_metodo']; ?>">
                </div>

                <div class="form-group col-md-6">
                    <label>Material:</label>
                    <select  required="true" title="Material" name="fe_material" class="form-control">
                        <option value="">Selecione um material</option>
                        <?php
                        $FeMaterial->setMat_status(true);
                        $FeMaterial->Execute()->Query("#mat_status#");
                        foreach ($FeMaterial->Execute()->getResult() as $material):
                            extract((array) $material);
                            $select = ($Dados['fe_material'] == $mat_id ? 'selected=true' : '');
                            echo "<option value=\"{$mat_id}\" {$select}>{$mat_descricao}</option>";
                        endforeach;
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label>Vr:</label>
                    <textarea required="true" class="form-control" title="Valor de Referencia" name="ex_valor_referencia" placeholder="Valor de Referencia"><?= $Dados['ex_valor_referencia']; ?></textarea>
                </div>

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

                <div class="form-group col-md-12">
                    <label>Observações:</label>
                    <textarea class="form-control" title="Observações internas" name="ex_observacao" placeholder="Observações internas"><?= $Dados['ex_observacao']; ?></textarea>
                </div>
            </div>

            <hr>
            <input type="submit" class="btn btn-success btn-block btn-lg" value="Solicitar"/>

        </form>
    </div>

    <!--LISTAGEM--> 
    <div class = "panel panel-default" id = "list">
        <?php
        if (!$FeExames->Execute()->getResult()):
            WSErro("Nenhum Solicitação foi encontrada no momento!", WS_INFOR);
            $Pager->ReturnPage();
        else:
            ?>
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th class="text-center">Exame</th>
                        <th class="text-center">Solicitante</th>
                        <th class="text-center">Setor</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aberto em</th>
                        <th class="text-center">Fechado em</th>
                        <th class="text-center">O.S Paciente Teste</th>
                        <th class="text-center">Assinado por</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($FeExames->Execute()->getResult() as $exames):
                        extract((array) $exames);
                        ?>
                        <tr>
                            <td><?= $ex_descricao; ?></td>
                            <td><?= $AdminExames->Setor($fe_setor_soli); ?></td>
                            <td><?= $AdminExames->Setor($fe_setor_exec); ?></td>
                            <td><?= ($ex_status ? "concluido" : "em processamento") ?></td>
                            <td><?= date("d/m/Y H:i:s", strtotime($ex_data_abertura)); ?></td>
                            <td><?= ($ex_status ? date("d/m/Y H:i:s", strtotime($ex_data_fechamento)) : ""); ?></td>
                            <td><?= $ex_paciente_os; ?></td>
                            <td><?= (!empty($ws_users) ? $AdminExames->Usuario($ws_users) : ""); ?></td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="row col-md-offset-4">
            <?php
            $Pager->ExePaginator("fe_exames");
            echo $Pager->getPaginator();
            ?>
        </div>
    </div>

</div>