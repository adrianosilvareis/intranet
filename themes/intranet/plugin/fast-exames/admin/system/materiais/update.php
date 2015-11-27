<h1>Atualiza Materiais:</h1>
<?php
if (file_exists(FAST_PATH . "_models/AdminMaterial.class.php")):
    require_once FAST_PATH . "_models/AdminMaterial.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$materialId = filter_input(INPUT_GET, "materialId", FILTER_DEFAULT);
$create = filter_input(INPUT_GET, "create", FILTER_DEFAULT);

$AdminMaterial = new AdminMaterial();

if (!empty($Dados) && !in_array("", $Dados)):
    $Dados['mat_status'] = ($Dados['sendPostForm'] == 'Atualiza' ? '0' : '1');
    $Dados['mat_id'] = $materialId;
    unset($Dados['sendPostForm']);

    if ($AdminMaterial->ExeUpdate($Dados)):
        WSErro("Ação atualizada com sucesso!", WS_ACCEPT);
    else:
        WSErro("Erro ao atualizar!", WS_ERROR);
    endif;
elseif (!$AdminMaterial->FindId($materialId)):
    WSErro("Ação não encontrada!", WS_INFOR);
else:
    $Dados = (array) $AdminMaterial->FindId($materialId);
endif;

if (!empty($create)):
    WSErro("Material <b>{$Dados['mat_descricao']}</b> cadastrada com sucesso!", WS_ACCEPT);
endif;

?>
<form method="post" class="form">

    <div class="row bg-primary">

        <div class="form-group col-md-12">
            <label>Descrição:</label>
            <input required="true" class="form-control" title="Descrição" type="text" name="mat_descricao" placeholder="Descrição" value="<?= $Dados['mat_descricao']; ?>">
        </div>        

    </div>
    <hr>
    <div class="btn-group">
        <input type="submit" class="btn btn-primary btn-block" name="sendPostForm" value="Atualiza"/>
        <input type="submit" class="btn btn-success btn-block" name="sendPostForm" value="Atualiza Ativo"/>
    </div>
</form>
