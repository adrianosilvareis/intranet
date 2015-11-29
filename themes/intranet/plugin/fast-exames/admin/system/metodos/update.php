<h1>Atualiza Metodo:</h1>
<?php
if (file_exists(FAST_PATH . "_models/AdminMetodo.class.php")):
    require_once FAST_PATH . "_models/AdminMetodo.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$metodoId = filter_input(INPUT_GET, "metodoId", FILTER_DEFAULT);
$create = filter_input(INPUT_GET, "create", FILTER_DEFAULT);

$AdminMetodo = new AdminMetodo();

if (!empty($Dados) && !in_array("", $Dados)):
    $Dados['met_status'] = ($Dados['sendPostForm'] == 'Atualiza' ? '0' : '1');
    $Dados['met_id'] = $metodoId;
    unset($Dados['sendPostForm']);

    if ($AdminMetodo->ExeUpdate($Dados)):
        WSErro("Metodo atualizada com sucesso!", WS_ACCEPT);
    else:
        WSErro("Erro ao atualizar!", WS_ERROR);
    endif;
elseif (!$AdminMetodo->FindId($metodoId)):
    WSErro("Metodo não encontrada!", WS_INFOR);
else:
    $Dados = (array) $AdminMetodo->FindId($metodoId);
endif;

if (!empty($create)):
    WSErro("Metodo <b>{$Dados['met_descricao']}</b> cadastrada com sucesso!", WS_ACCEPT);
endif;

?>
<form method="post" class="form" id="form">

    <div class="row bg-primary">

        <div class="form-group col-md-12">
            <label>Descrição:</label>
            <input required="true" class="form-control" title="Descrição" type="text" name="met_descricao" placeholder="Descrição" value="<?= $Dados['met_descricao']; ?>">
        </div>        

    </div>
    <hr>
    <div class="btn-group">
        <input type="submit" class="btn btn-primary btn-block" name="sendPostForm" value="Atualiza"/>
        <input type="submit" class="btn btn-success btn-block" name="sendPostForm" value="Atualiza Ativo"/>
    </div>
</form>
