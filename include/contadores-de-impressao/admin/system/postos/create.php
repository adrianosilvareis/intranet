<?php
if (file_exists(IMP_PATH . "_models\AdminPostos.class.php")):
    include IMP_PATH . "_models\AdminPostos.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($Dados) && $Dados['SendPostForm']):

    $Dados['postos_ativo'] = ($Dados['SendPostForm'] == "Cadastrar" ? '0' : '1');
    unset($Dados["SendPostForm"]);

    $AdminPostos = new AdminPostos();

    if (in_array("", $Dados)):
        WSErro("Preencha todos os campos!", WS_ALERT);
    elseif (!is_numeric($Dados['postos_numero'])):
        WSErro("O Campo <b>Numero</b>, deve ser um valor numerico.", WS_ERROR);
    elseif ($AdminPostos->getPostoNumero($Dados['postos_numero'])):
        $posto = $AdminPostos->getPostoNumero($Dados['postos_numero']);
        WSErro("Posto <b>{$posto->postos_nome}</b> já existe, crie um novo posto!", WS_INFOR);
    else:
        if ($AdminPostos->ExeCreate($Dados)):
            WSErro("Cadastrado com sucesso!", WS_ACCEPT);
            header("Location: " . IMP_INCLUDE . "admin/&exe=postos/update&create=true&postoId=" . $AdminPostos->getResult());
        else:
            WSErro("Erro no cadastro!", WS_ERROR);
        endif;
    endif;
endif;
?>
<article>
    <h1>Criar Postos:</h1>

    <div class="row">
        <form class="form col-md-offset-2 col-md-8" name="postos" method="post">
            <div class="form-group">
                <label>Nome:</label>
                <input name="postos_nome" type="text" placeholder="Nome" class="form-control" value="<?= $Dados['postos_nome']; ?>">
            </div>
            <div class="form-group">
                <label>Numero:</label>
                <input name="postos_numero" type="text" placeholder="Numero" class="form-control" value="<?= $Dados['postos_numero']; ?>"> 
            </div>
            <input type="submit" class="btn btn-primary" name="SendPostForm" value="Cadastrar"/>
            <input type="submit" class="btn btn-success" name="SendPostForm" value="Cadastrar Ativo"/>
        </form>
    </div>
</article>