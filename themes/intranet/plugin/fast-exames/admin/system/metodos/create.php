<h1>Cria Metodos:</h1>
<?php
if (file_exists(FAST_PATH . "_models/AdminMetodo.class.php")):
    require_once FAST_PATH . "_models/AdminMetodo.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$AdminMetodo = new AdminMetodo();

if (!empty($Dados) && !in_array("", $Dados)):
    $Dados['met_status'] = ($Dados['sendPostForm'] == "Cadastrar" ? "0" : "1");

    if ($AdminMetodo->FindName($Dados['met_descricao'])):
        WSErro("Metodo já cadastrado no sistema!", WS_ALERT);
    elseif ($AdminMetodo->ExeCreate($Dados)):
        header("Location: " . FAST_INCLUDE . "admin/&exe=metodos/update&metodoId=" . $AdminMetodo->getResult() . "&create=true");
        WSErro("Metodo cadastrado com sucesso!", WS_ACCEPT);
    else:
        WSErro("Erro ao cadastrar!", WS_ERROR);
    endif;
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
        <input type="submit" class="btn btn-primary btn-block" name="sendPostForm"value="Cadastrar"/>
        <input type="submit" class="btn btn-success btn-block" name="sendPostForm"value="Cadastrar Ativo"/>
    </div>
</form>
