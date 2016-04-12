<header>
    <h1>Avaliação:</h1>
</header>

<p ng-if="message" class="trigger accept">{{message}}<span class="ajax_close"></span></p>
<?php require HOME . "/include/nao-conformidade/system/message/message-avaliacao.html"; ?>


<form name="avaliacaoForm">

    <div class="well">

        <label>Avaliação das causas da NC:</label>  
        <div class="clearfix"></div>

        <div class="form-group col-md-4">
            <label>Processos:</label>
            <textarea class="form-control" name="" title="" rows="3"></textarea>
        </div>

        <div class="form-group col-md-4">
            <label>Matéria-Prima:</label>
            <textarea class="form-control" name="" title="" rows="3"></textarea>
        </div>

        <div class="form-group col-md-4">
            <label>Mão de Obra:</label>
            <textarea class="form-control" name="" title="" rows="3"></textarea>
        </div>

        <div class="col-md-12">
            <img style="width: 100%; height: 100px;"  src="<?= HOME ?>/include/nao-conformidade/img/fish.png" class="img-responsive" title="fish">
        </div>

        <div class="form-group col-md-4">
            <label>Equipamentos:</label>
            <textarea class="form-control" name="" title="" rows="3"></textarea>
        </div>

        <div class="form-group col-md-4">
            <label>Meio Ambiente:</label>
            <textarea class="form-control" name="" title="" rows="3"></textarea>
        </div>

        <div class="form-group col-md-4">
            <label>Outros:</label>
            <textarea class="form-control" name="" title="" rows="3"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label>Causa Principal:</label>
        <textarea class="form-control" rows="3" name="" placeholder="Causa Principal"  ng-required="true" ng-minlength="5"></textarea>
    </div>

    <div class="btn-group">
        <input class="btn btn-primary" style="width: 200px;" type="submit" value="Novo" name="SendPostForm" ng-disabled="!registro" ng-click="novoRegistro()"/>
        <input class="btn btn-success" style="width: 200px;" type="submit" value="Salvar" name="SendPostForm" ng-disabled="registroForm.$invalid" ng-click="saveRegistro(registro)"/>
    </div>
</form>