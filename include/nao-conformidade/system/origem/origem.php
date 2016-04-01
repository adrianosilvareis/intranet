<div class="well">

    <article>
        
        <header>
            <h1>Origem:</h1>
        </header>

        <p ng-if="message" class="trigger accept">{{message}}<span class="ajax_close"></span></p>
        <?php require HOME . "/include/nao-conformidade/system/message/message-origem.html"; ?>

        <form name="origemForm">
            <div class="form-group">
                <label>Titulo:</label>
                <input class="form-control" type="text" name="origem_title" placeholder="origem da não conformidade" ng-model="origem.origem_title" ng-required="true" ng-minlength="3"/>
            </div>

            <hr>
            <div class="btn-group">
                <input class="btn btn-primary" style="width: 200px;" type="submit" value="Novo" name="SendPostForm" ng-disabled="!origem" ng-click="novaOrigem()"/>
                <input class="btn btn-success" style="width: 200px;" type="submit" value="Salvar" name="SendPostForm" ng-disabled="origemForm.$invalid" ng-click="saveOrigem(origem)"/>
            </div>
        </form>
    </article>

    <div class="clear"></div>
</div> <!-- content home -->