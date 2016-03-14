<h1>Cria Materiais:</h1>
<?php
if (file_exists('include/fast-exames/_models/AdminMaterial.class.php')):
    include_once 'include/fast-exames/_models/AdminMaterial.class.php';
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$AdminMaterial = new AdminMaterial();

if (!empty($Dados) && !in_array("", $Dados)):
    $Dados['mat_status'] = ($Dados['sendPostForm'] == "Cadastrar" ? "0" : "1");
    unset($Dados['sendPostForm']);

    if ($AdminMaterial->FindName($Dados['mat_descricao'])):
        WSErro("Material já cadastrado no sistema!", WS_ALERT);
    elseif ($AdminMaterial->ExeCreate($Dados)):
        header("Location: " . FAST_INCLUDE . "admin/&exe=materiais/update&materialId=" . $AdminMaterial->getResult() . "&create=true");
        WSErro("Material cadastrado com sucesso!", WS_ACCEPT);
    else:
        WSErro("Erro ao cadastrar material!", WS_ERROR);
    endif;
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
        <input type="submit" class="btn btn-primary btn-block" name="sendPostForm" value="Cadastrar"/>
        <input type="submit" class="btn btn-success btn-block" name="sendPostForm" value="Cadastrar Ativo"/>
    </div>
</form>
