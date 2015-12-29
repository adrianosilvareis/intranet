<?php
if (file_exists(IMP_PATH . "_models\AdminPostos.class.php")):
    include IMP_PATH . "_models\AdminPostos.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$postoId = filter_input(INPUT_GET, "postoId", FILTER_DEFAULT);

if (isset($Dados) && $Dados['SendPostForm']):
    $Dados['postos_ativo'] = ($Dados['SendPostForm'] == "Atualizar" ? '0' : '1');
    $Dados['postos_id'] = $postoId;
    unset($Dados["SendPostForm"]);
    
    $AdminPostos = new AdminPostos();
    
    if (in_array("", $Dados)):
        WSErro("Preencha todos os campos!", WS_ALERT);
    elseif (!is_numeric($Dados['postos_numero'])):
        WSErro("O Campo <b>Numero</b>, deve ser um valor numerico.", WS_ERROR);
    else:
        if ($AdminPostos->ExeUpdate($Dados)):
            WSErro("Atualizado com sucesso!", WS_ACCEPT);
        else:
            WSErro("Erro ao atualizar!", WS_ERROR);
        endif;
    endif;
else:
    $ImpPostos = new ImpPostos();
    $ImpPostos->Execute()->find("postos_id=$postoId");
    $Dados = (array) $ImpPostos->Execute()->getResult();
endif;

$checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
if ($checkCreate && empty($AdminPostos)):
    WSErro("O posto <b>{$Dados['postos_nome']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT);
endif;
?>

<article>
    <h1>Atualizar Postos:</h1>

    <div class="row">
        <form class="form col-md-offset-2 col-md-4" name="postos" method="post">

            <div class="form-group">
                <label>Nome:</label>
                <input name="postos_nome" type="text" placeholder="Nome" class="form-control" value="<?= $Dados['postos_nome']; ?>">
            </div>
            <div class="form-group">
                <label>Numero:</label>
                <input name="postos_numero" type="text" placeholder="Numero" class="form-control" value="<?= $Dados['postos_numero']; ?>"> 
            </div>
            <input type="submit" class="btn btn-primary" name="SendPostForm" value="Atualizar"/>
            <input type="submit" class="btn btn-success" name="SendPostForm" value="Atualizar Ativo"/>
        </form>
    </div>
</article>