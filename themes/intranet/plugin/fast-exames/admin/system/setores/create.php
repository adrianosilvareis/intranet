<h1>Cria Setores</h1>

<?php
if (file_exists(FAST_PATH . "_models/AdminSetor.class.php")):
    require_once FAST_PATH . "_models/AdminSetor.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$AdminSetor = new AdminSetor();

if (!empty($Dados) && !in_array("", $Dados)):
    $Dados['set_status'] = ($Dados['sendPostForm'] == 'Cadastrar' ? '0' : '1');
    unset($Dados['sendPostForm']);

    if (empty($Dados['set_solicita']) && empty($Dados['set_execucao'])):
        WSErro("<b>Ops!</b> Você esqueceu de marcar o tipo de setor.", WS_INFOR);
    elseif ($AdminSetor->FindName($Dados['set_descricao'])):
        WSErro("Setor já cadastrado!", WS_ALERT);
    elseif ($AdminSetor->ExeCreate($Dados)):
        header("Location: " . FAST_INCLUDE . "admin/&exe=setores/update&setorId=" . $AdminSetor->getResult() . "&create=true");
        WSErro("Setor Cadastrado com sucesso!", WS_ACCEPT);
    else:
        WSErro("Erro ao cadastrar!", WS_ERROR);
    endif;
endif;
?>
<form method="post" class="form" id="form">

    <div class="row bg-primary">

        <div class="form-group col-md-12">
            <label>Descrição:</label>
            <input required="true" class="form-control" title="Descrição" type="text" name="set_descricao" placeholder="Descrição" value="<?= $Dados['set_descricao']; ?>">
        </div>        

        <div class="form-group col-md-12">
            <label class="col-md-2">Solicitante:
                <input class="form-control" title="Descrição" type="checkbox" name="set_solicita" <?= (!empty($Dados['set_solicita']) ? 'checked' : '') ?> ></label>
            <label class="col-md-2">Execução:
                <input class="form-control" title="Descrição" type="checkbox" name="set_execucao" <?= (!empty($Dados['set_execucao']) ? 'checked' : '') ?>></label>
        </div>

    </div>
    <hr>
    <div class="btn-group">
        <input type="submit" class="btn btn-primary btn-block" name="sendPostForm" value="Cadastrar"/>
        <input type="submit" class="btn btn-success btn-block" name="sendPostForm" value="Cadastrar Ativo"/>
    </div>
</form>
