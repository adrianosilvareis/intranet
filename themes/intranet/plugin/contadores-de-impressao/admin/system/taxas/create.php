<?php
if (file_exists(IMP_PATH . "_models\AdminTaxas.class.php")):
    include IMP_PATH . "_models\AdminTaxas.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($Dados) && $Dados['SendPostForm']):
    $Dados['taxa_status'] = ( $Dados['SendPostForm'] == 'Cadastrar' ? '0' : '1');
    unset($Dados["SendPostForm"]);


    $AdminTaxas = new AdminTaxas();

    if (in_array("", $Dados)):
        WSErro("Preencha todos os campos!", WS_ALERT);
    elseif ($AdminTaxas->FindNome($Dados['taxa_descricao'])):
        $taxa = $AdminTaxas->FindNome($Dados['taxa_descricao']);
        WSErro("A taxa <b>{$taxa->taxa_descricao}</b> já existe no sistema!", WS_INFOR);
    elseif (!is_numeric($Dados['taxa_valor'])):
        WSErro("O campo valor, precisa de um valor numerico.", WS_ALERT);
    else:
        if ($AdminTaxas->ExeCreate($Dados)):
            WSErro("Cadastrado com sucesso!", WS_ACCEPT);
            header("Location: " . IMP_INCLUDE . "admin/&exe=taxas/update&create=true&taxaId=" . $AdminTaxas->getResult());
        else:
            WSErro("Erro no cadastro!", WS_ERROR);
        endif;
    endif;
endif;
?>
<article>
    <h1>Criar Taxas:</h1>

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
            <input type="submit" class="btn btn-primary" name="SendPostForm" value="Cadastrar"/>
            <input type="submit" class="btn btn-success" name="SendPostForm" value="Cadastrar Ativo"/>
        </form>
    </div>
</article>