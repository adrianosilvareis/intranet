<?php
if (file_exists(IMP_PATH . "_models\AdminModelo.class.php")):
    include IMP_PATH . "_models\AdminModelo.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($Dados) && $Dados['SendPostForm']):
    $Dados['modelo_status'] = ( $Dados['SendPostForm'] == 'Cadastrar' ? '0' : '1');
    unset($Dados["SendPostForm"]);


    $AdminModelo = new AdminModelo();

    if (in_array("", $Dados)):
        WSErro("Preencha todos os campos!", WS_ALERT);
    elseif ($AdminModelo->FindNome($Dados['modelo_descricao'])):
        $modelo = $AdminModelo->FindNome($Dados['modelo_descricao']);
        WSErro("O modelo <b>{$modelo->modelo_descricao}</b> já existe no sistema!", WS_INFOR);
    else:
        if ($AdminModelo->ExeCreate($Dados)):
            WSErro("Cadastrado com sucesso!", WS_ACCEPT);
            header("Location: " . IMP_INCLUDE . "admin/&exe=modelo/update&create=true&modeloId=" . $AdminModelo->getResult());
        else:
            WSErro("Erro no cadastro!", WS_ERROR);
        endif;
    endif;
endif;
?>
<article>
    <h1>Criar Modelo:</h1>

    <div class="row">
        <form class="form col-md-offset-2 col-md-8" name="modelo" method="post">
            <div class="form-group">
                <label>Nome:</label>
                <input name="modelo_descricao" type="text" placeholder="Nome" class="form-control" value="<?= $Dados['modelo_descricao']; ?>">
            </div>
            <input type="submit" class="btn btn-primary" name="SendPostForm" value="Cadastrar"/>
            <input type="submit" class="btn btn-success" name="SendPostForm" value="Cadastrar Ativo"/>
        </form>
    </div>
</article>