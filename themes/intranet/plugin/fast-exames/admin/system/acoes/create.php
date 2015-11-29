<h1>Cria Ações:</h1>
<?php
if (file_exists(FAST_PATH . "_models/AdminAcoes.class.php")):
    require_once FAST_PATH . "_models/AdminAcoes.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$AdminAcoes = new AdminAcoes();

if (!empty($Dados) && !in_array("", $Dados)):
    $Dados['acao_status'] = ($Dados['sendPostForm'] == 'Cadastrar' ? '0' : '1');
    unset($Dados['sendPostForm']);

    if ($AdminAcoes->FindName($Dados['acao_descricao'])):
        WSErro("Ação já cadastrada!", WS_ALERT);
    elseif ($AdminAcoes->ExeCreate($Dados)):
        header("Location: " . FAST_INCLUDE . "admin/&exe=acoes/update&acaoId=" . $AdminAcoes->getResult() . "&create=true");
        WSErro("Ação cadastrada com sucesso!", WS_ACCEPT);
    else:
        WSErro("Erro ao cadastrar!", WS_ERROR);
    endif;
endif;
?>
<form method="post" class="form" id="form">

    <div class="row bg-primary">

        <div class="form-group col-md-12">
            <label>Descrição:</label>
            <input required="true" class="form-control" title="Descrição" type="text" name="acao_descricao" placeholder="Descrição" value="<?= $Dados['acao_descricao']; ?>">
        </div>        

    </div>
    <hr>
    <div class="btn-group">
        <input type="submit" class="btn btn-primary btn-block" name="sendPostForm" value="Cadastrar"/>
        <input type="submit" class="btn btn-success btn-block" name="sendPostForm" value="Cadastrar Ativo"/>
    </div>
</form>