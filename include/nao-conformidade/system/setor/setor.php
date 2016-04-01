<div class="well">

    <article>

        <header>
            <h1>Setor:</h1>
        </header>
        
        <p ng-if="message" class="trigger accept">{{message}}<span class="ajax_close"></span></p> 
        <?php require HOME . "/include/nao-conformidade/system/message/message-setor.html"; ?>

        <form name="setorForm">

            <div class="form-group">
                <label>Titulo:</label>
                <input class="form-control" type="text" name="setor_content" placeholder="nome do setor" ng-model="setor.setor_content" ng-required="true" ng-minlength="3"/>
            </div>

            <div class="form-group">
                <label>E-mail:</label>
                <input class="form-control" type="email" name="setor_email" placeholder="email@servidor.com.br" ng-model="setor.setor_email" />
            </div>

            <div class="row">

                <div class="col-md-4">
                    <label>Tipo:</label>
                    <select class="form-control" name="setor_type" ng-model="setor.setor_type" ng-options="type.type_id as type.type_content for type in types" ng-required="true">
                        <option value=""> Selecione um tipo: </option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Categoria:</label>
                    <select class="form-control" name="setor_category" ng-model="setor.setor_category" ng-required="true">
                        <option value=""> Selecione uma categoria: </option>
                        <option value="nao-conformidade"> Não Conformidade: </option>
                        <option value="geral"> Geral </option>
                    </select>
                </div>
            </div>

            <hr>
            <div class="btn-group">
                <input class="btn btn-primary" style="width: 200px;" type="submit" value="Novo" name="SendPostForm" ng-disabled="!setor" ng-click="novoSetor()"/>
                <input class="btn btn-success" style="width: 200px;" type="submit" value="Salvar" name="SendPostForm" ng-disabled="setorForm.$invalid" ng-click="saveSetor(setor)"/>
            </div>
        </form>
    </article>

    <div class="clear"></div>
</div> <!-- content home -->