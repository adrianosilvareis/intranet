<h1 id="form">Criar Solicitação de exames</h1>
<?php
if (file_exists(FAST_PATH . "_models/AdminExames.class.php")):
    require_once FAST_PATH . "_models/AdminExames.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$AdminExames = new AdminExames();


$FeAcoes = new FeAcoes();
$WsSetor = new WsSetor();
$FeMaterial = new FeMaterial();

if (!empty($Dados)):
    $Dados['ws_users_soli'] = Check::UserLogin()['user_id'];
    $Dados['ex_data_abertura'] = date('Y-m-d H:i:s');

    if ($AdminExames->ExeCreate($Dados)):
        WSErro("Solicitação cadastrada com sucesso!", WS_ACCEPT);
        header("Location: " . FAST_INCLUDE . "admin/&exe=exames/update&examesId=" . $AdminExames->getResult() . "&create=true");
    else:
        WSErro("Erro ao cadastrar solicitação!", WS_ERROR);
    endif;
endif;
?>
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

        <div class="form-group col-md-6">
            <label>Ação a executar:</label>
            <select  required="true" title="Ação a executar" name="fe_acoes" class="form-control">
                <option value="">Selecione uma ação</option>
                <?php
                $FeAcoes->setAcao_status(true);
                $FeAcoes->Execute()->FullRead("SELECT * FROM fe_acoes WHERE acao_status = :acao_status ORDER by acao_descricao");
                foreach ($FeAcoes->Execute()->getResult() as $acao):
                    extract((array) $acao);
                    $select = ($Dados['fe_acoes'] == $acao_id ? 'selected=true' : '');
                    echo "<option value=\"{$acao_id}\" {$select}>{$acao_descricao}</option>";
                endforeach;
                ?>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label>Material:</label>
            <select  required="true" title="Material" name="fe_material" class="form-control">
                <option value="">Selecione um material</option>
                <?php
                $FeMaterial->setMat_status(true);
                $FeMaterial->Execute()->Query("#mat_status#");
                $FeMaterial->Execute()->FullRead("SELECT * FROM fe_material WHERE mat_status=:mat_status ORDER BY mat_descricao");
                foreach ($FeMaterial->Execute()->getResult() as $material):
                    extract((array) $material);
                    $select = ($Dados['fe_material'] == $mat_id ? 'selected=true' : '');
                    echo "<option value=\"{$mat_id}\" {$select}>{$mat_descricao}</option>";
                endforeach;
                ?>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label>Setor Solicitante:</label>
            <select  required="true" title="Setor Solicitante" name="ws_setor_soli" class="form-control">
                <option value="">Selecione um setor</option>
                <?php
                $WsSetor->setSetor_status(true);
                $WsSetor->Execute()->Query("setor_status=1 AND setor_type!=2 AND setor_type!=1 AND (setor_category='geral' OR setor_category='fast-exames')");
                foreach ($WsSetor->Execute()->getResult() as $setor):
                    extract((array) $setor);
                    $select = ($Dados['ws_setor_soli'] == $setor_id ? 'selected=true' : '');
                    echo "<option value=\"{$setor_id}\" {$select}>{$setor_content}</option>";
                endforeach;
                ?>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label>Setor execução:</label>
            <select required="true" title="Setor Solicitante" name="ws_setor_exec" class="form-control">
                <option value="">Selecione um setor</option>
                <?php
                $WsSetor->Execute()->Query("setor_status=1 AND (setor_type=2 OR setor_type=1) AND (setor_category='geral' OR setor_category='fast-exames')");
                foreach ($WsSetor->Execute()->getResult() as $setor):
                    extract((array) $setor);
                    $select = ($Dados['fe_setor_exec'] == $setor_id ? 'selected=true' : '');
                    echo "<option value=\"{$setor_id}\" {$select}>{$setor_content}</option>";
                endforeach;
                ?>
            </select>
        </div>

        <div class="form-group col-md-4">
            <label>Unidade:</label>
            <input required="true" required="true" class="form-control" title="Unidade" type="text" name="ex_unidade" placeholder="Unidade" value="<?= $Dados['ex_unidade']; ?>">
        </div>

        <div class="form-group col-md-4">
            <label>Prazo:</label>
            <input required="true" class="form-control" title="Prazo" type="text" name="ex_prazo" placeholder="Prazo" value="<?= $Dados['ex_prazo']; ?>">
        </div>

        <div class="form-group col-md-4">
            <label>Valor:</label>
            <input required="true" class="form-control" title="Valor" type="text" name="ex_valor" placeholder="Valor" value="<?= $Dados['ex_valor']; ?>">
        </div>        

        <div class="form-group col-md-12">
            <label>Observações:</label>
            <textarea class="form-control" title="Observações internas" name="ex_observacao" placeholder="Observações internas"><?= (!empty($Dados['ex_observacao']) ? $Dados['ex_observacao'] : ""); ?></textarea>
        </div>
    </div>

    <hr>
    <input type="submit" class="btn btn-success btn-block btn-lg" value="Solicitar"/>

</form>
