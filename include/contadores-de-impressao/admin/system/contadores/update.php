<?php
if (file_exists(IMP_PATH . "_models\AdminContadores.class.php")):
    include IMP_PATH . "_models\AdminContadores.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$contadorId = filter_input(INPUT_GET, "contadorId", FILTER_DEFAULT);
$AdminContadores = new AdminContadores();

if (isset($Dados) && $Dados['SendPostForm']):

    $Dados['contadores_data'] = date("Y-m-d");
    $Dados['contadores_id'] = $contadorId;
    unset($Dados["SendPostForm"]);

    if (in_array("", $Dados)):
        WSErro("Preencha todos os campos!", WS_ALERT);
    else:
        if ($AdminContadores->ExeUpdate($Dados)):
            WSErro("Atualizado com sucesso!", WS_ACCEPT);
        else:
            WSErro("Erro ao atualizar!", WS_ERROR);
        endif;
    endif;
endif;

$AdminContadores->FindId($contadorId);
if (!$AdminContadores->getResult()):
    WSErro("Contador não encontrado!", WS_ALERT);
else:
    $Dados = (array) $AdminContadores->getResult()[0];
endif;
?>

<article>
    <h1>Atualizar Contadores:</h1>

    <div class="row">
        <form class="form col-md-offset-2 col-md-8" name="impressora" method="post">

            <div class = "form-group col-md-6">
                <label>Serial:</label>
                <input type="text" class="form-control" value="<?= $Dados['impressora_serial']; ?>" disabled>
            </div>

            <div class = "form-group col-md-6">
                <label>Data:</label>
                <input type="Date" class="form-control" value="<?= $Dados['contadores_data']; ?>" disabled>
            </div>

            <div class = "form-group col-md-12">
                <label>Contador:</label>
                <input name="contadores_contador" type="text" placeholder="Serial" class="form-control" value="<?= $Dados['contadores_contador']; ?>">
            </div>

            <input type = "submit" class="btn btn-primary btn-lg" name="SendPostForm" value="Atualizar"/>
        </form>
    </div>
</article>