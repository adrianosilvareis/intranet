<?php
$filter = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($filter);

if (!empty($filter)):
    unset($filter['sendPostForm']);

    var_dump($filter);

endif;
?>

<div class="col-md-offset-3 col-md-6">
    <form method="post">
        <div class="form-group">
            <label>Descrição:</label>
            <input type="text" name="set_descricao" class="form-control" placeholder="Descrição">
        </div>
        <div class="form-group">
            <label>Execução:</label>
            <input type="checkbox" name="set_execucao">
        </div>
        <div class="form-group">
            <label>Status:</label>
            <input type="checkbox" name="set_status">
        </div>
        <input type="submit" class="btn btn-danger" value="Cadastrar" name="sendPostForm">
    </form>
</div>