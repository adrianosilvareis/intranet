<h1>Atualiza Setores</h1>

<?php
if (file_exists(FAST_PATH . "_models/AdminSetor.class.php")):
    require_once FAST_PATH . "_models/AdminSetor.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setorId = filter_input(INPUT_GET, "setorId", FILTER_DEFAULT);
$create = filter_input(INPUT_GET, "create", FILTER_DEFAULT);

$AdminSetor = new AdminSetor();

if (!empty($Dados) && !in_array("", $Dados)):
    $Dados['set_status'] = ($Dados['sendPostForm'] == 'Atualizar' ? '0' : '1');
    $Dados['set_id'] = $setorId;
    unset($Dados['sendPostForm']);
    
    if (empty($Dados['set_solicita']) && empty($Dados['set_execucao'])):
        WSErro("<b>Ops!</b> Você esqueceu de marcar o tipo de setor.", WS_INFOR);
    elseif ($AdminSetor->ExeUpdate($Dados)):
        WSErro("Metodo atualizada com sucesso!", WS_ACCEPT);
    else:
        WSErro("Erro ao atualizar!", WS_ERROR);
    endif;
elseif (!$AdminSetor->FindId($setorId)):
    WSErro("Setor não encontrado!", WS_INFOR);
else:
    $Dados = (array) $AdminSetor->FindId($setorId);
endif;
?>
<form method="post" class="form" id="form">

    <div class="row bg-primary">

        <div class="form-group col-md-12">
            <label>Descrição:</label>
            <input required="true" class="form-control" title="Descrição" type="text" name="set_descricao" placeholder="Descrição" value="<?= $Dados['set_descricao']; ?>">
        </div>        

        <div class="form-group col-md-12">
            <label class="col-md-2">Solicitante:
                <input class="form-control" title="Descrição" type="checkbox" name="set_solicita" <?= (!empty($Dados['set_solicita']) ? 'checked' : '') ?> ></label>
            <label class="col-md-2">Execução:
                <input class="form-control" title="Descrição" type="checkbox" name="set_execucao" <?= (!empty($Dados['set_execucao']) ? 'checked' : '') ?>></label>
        </div>

    </div>
    <hr>
    <div class="btn-group">
        <input type="submit" class="btn btn-primary btn-block" name="sendPostForm" value="Atualizar"/>
        <input type="submit" class="btn btn-success btn-block" name="sendPostForm" value="Atualizar Ativo"/>
    </div>
</form>
