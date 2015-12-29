<?php
if (file_exists(IMP_PATH . "_models\AdminTaxas.class.php")):
    include IMP_PATH . "_models\AdminTaxas.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$taxaId = filter_input(INPUT_GET, "taxaId", FILTER_DEFAULT);

if (isset($Dados) && $Dados['SendPostForm']):
    $Dados['taxa_status'] = ( $Dados['SendPostForm'] == 'Cadastrar' ? '0' : '1');
    $Dados['taxa_id'] = $taxaId;
    unset($Dados["SendPostForm"]);

    $AdminTaxas = new AdminTaxas();

    if (in_array("", $Dados)):
        WSErro("Preencha todos os campos!", WS_ALERT);
    elseif (!is_numeric($Dados['taxa_valor'])):
        WSErro("O campo valor, precisa de um valor numerico.", WS_ALERT);
    else:
        if ($AdminTaxas->ExeUpdate($Dados)):
            WSErro("Atualizado com sucesso!", WS_ACCEPT);
        else:
            WSErro("Erro ao atualizar!", WS_ERROR);
        endif;
    endif;
else:
    $ImpTaxa = new ImpTaxaImpress();
    $ImpTaxa->Execute()->find("taxa_id=$taxaId");
    $Dados = (array) $ImpTaxa->Execute()->getResult();
endif;

$checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
if ($checkCreate && empty($AdminTaxas)):
    WSErro("A taxa <b>{$Dados['taxa_descricao']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT);
endif;
?>

<article>
    <h1>Atualizar Taxas:</h1>

    <div class="row">
        <form class="form col-md-offset-2 col-md-8" name="modelo" method="post">
            <div class="form-group">
                <label>Nome:</label>
                <input name="taxa_descricao" type="text" placeholder="Nome" class="form-control" value="<?= $Dados['taxa_descricao']; ?>">
            </div>
            <div class="form-group">
                <label>Valor:</label>
                <input name="taxa_valor" type="text" placeholder="valor" class="form-control" value="<?= $Dados['taxa_valor']; ?>">
            </div>
            <input type="submit" class="btn btn-primary" name="SendPostForm" value="Atualizar"/>
            <input type="submit" class="btn btn-success" name="SendPostForm" value="Atualizar Ativo"/>
        </form>
    </div>
</article>