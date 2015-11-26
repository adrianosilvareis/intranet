<?php
if (file_exists(FAST_PATH . "_models/AdminSetor.class.php")):
    require_once FAST_PATH . "_models/AdminSetor.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$AdminSetor = new AdminSetor();

if (!empty($Dados) && !is_array("", $Dados)):
    $AdminSetor->ExeCreate($Dados);
endif;
?>
<h1 class="text-center">Setores</h1>
<form method="post" class="form">

    <div class="row bg-primary">

        <div class="form-group col-md-12">
            <label>Descrição:</label>
            <input required="true" class="form-control" title="Descrição" type="text" name="set_descricao" placeholder="Descrição" value="<?= $Dados['set_descricao']; ?>">
        </div>        

        <div class="form-group col-md-12">
            <label class="col-md-2">Execução:
                <input class="form-control" title="Descrição" type="checkbox" name="set_solicita" value="<?= $Dados['set_solicita']; ?>"></label>
            <label class="col-md-2">Solicitante:
                <input class="form-control" title="Descrição" type="checkbox" name="set_execucao" value="<?= $Dados['set_execucao']; ?>"></label>
        </div>

    </div>
    <hr>
    <div class="btn-group">
        <input type="submit" class="btn btn-primary btn-block" name="cadastrar "value="Cadastrar"/>
        <input type="submit" class="btn btn-success btn-block" name="cadastrar Ativo"value="Cadastrar Ativo"/>
    </div>
</form>
