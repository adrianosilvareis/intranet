<?php
if (file_exists(IMP_PATH . "_models\AdminModelo.class.php")):
    include IMP_PATH . "_models\AdminModelo.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$modeloId = filter_input(INPUT_GET, "modeloId", FILTER_DEFAULT);

if (isset($Dados) && $Dados['SendPostForm']):
    $Dados['modelo_status'] = ( $Dados['SendPostForm'] == 'Cadastrar' ? '0' : '1');
    $Dados['modelo_id'] = $modeloId;
    unset($Dados["SendPostForm"]);
    
    $AdminModelo = new AdminModelo();
    
    if (in_array("", $Dados)):
        WSErro("Preencha todos os campos!", WS_ALERT);
    else:
        if ($AdminModelo->ExeUpdate($Dados)):
            WSErro("Atualizado com sucesso!", WS_ACCEPT);
        else:
            WSErro("Erro ao atualizar!", WS_ERROR);
        endif;
    endif;
else:
    $AppModelo = new AppModelo();
    $AppModelo->Execute()->find("modelo_id=$modeloId");
    $Dados = (array) $AppModelo->Execute()->getResult();
endif;

$checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
if ($checkCreate && empty($AdminPostos)):
    WSErro("O modelo de impressora <b>{$Dados['modelo_descricao']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT);
endif;
?>

<article>
    <h1>Atualizar Modelo:</h1>

    <div class="row">
        <form class="form col-md-offset-2 col-md-4" name="postos" method="post">

            <div class="form-group">
                <label>Nome:</label>
                <input name="modelo_descricao" type="text" placeholder="Nome" class="form-control" value="<?= $Dados['modelo_descricao']; ?>">
            </div>
            <input type="submit" class="btn btn-primary" name="SendPostForm" value="Atualizar"/>
            <input type="submit" class="btn btn-success" name="SendPostForm" value="Atualizar Ativo"/>
        </form>
    </div>
</article>