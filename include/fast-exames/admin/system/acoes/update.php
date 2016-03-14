<h1>Atualiza Ações:</h1>
<?php
if (file_exists('include/fast-exames/_models/AdminAcoes.class.php')):
    include_once 'include/fast-exames/_models/AdminAcoes.class.php';
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$acaoId = filter_input(INPUT_GET, "acaoId", FILTER_DEFAULT);
$create = filter_input(INPUT_GET, "create", FILTER_DEFAULT);

$AdminAcoes = new AdminAcoes();

if (!empty($Dados) && !in_array("", $Dados)):
    $Dados['acao_status'] = ($Dados['sendPostForm'] == 'Atualiza' ? '0' : '1');
    $Dados['acao_id'] = $acaoId;
    unset($Dados['sendPostForm']);

    if ($AdminAcoes->ExeUpdate($Dados)):
        WSErro("Ação atualizada com sucesso!", WS_ACCEPT);
    else:
        WSErro("Erro ao atualizar!", WS_ERROR);
    endif;
elseif (!$AdminAcoes->FindId($acaoId)):
    WSErro("Ação não encontrada!", WS_INFOR);
else:
    $Dados = (array) $AdminAcoes->FindId($acaoId);
endif;

if (!empty($create)):
    WSErro("Ação <b>{$Dados['acao_descricao']}</b> cadastrada com sucesso!", WS_ACCEPT);
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
        <input type="submit" class="btn btn-primary btn-block" name="sendPostForm" value="Atualiza"/>
        <input type="submit" class="btn btn-success btn-block" name="sendPostForm" value="Atualiza Ativo"/>
    </div>
</form>
