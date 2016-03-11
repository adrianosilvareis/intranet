<div class="well">

    <article>

        <header>
            <h1>Registros:</h1>
        </header>

        <p ng-if="message" class="trigger accept">{{message}}<span class="ajax_close"></span></p>
        <?php require HOME . "/" . REQUIRE_PATH . "/plugin/nao-conformidade/system/message/message-registro.html"; ?>


        <form name="registroForm">

            <script type="text/javascript">
                $(document).ready(function () {
                    $('#example-multiple-optgroups').multiselect();
                    $('#example-multiple-selected').multiselect();
                });
            </script>

            <!-- Note the missing multiple attribute! -->
            <select id="example-multiple-selected" class="form-control" multiple="multiple">
                <option value="1">Option 1</option>
                <option value="2" selected="selected">Option 2</option>
                <option value="3" selected="selected">Option 3</option>
                <option value="4">Option 4</option>
                <option value="5">Option 5</option>
                <option value="6">Option 6</option>
            </select>

            <div class="form-group">
                <label>Descrição:</label>
                <textarea class="form-control" rows="3" name="reg_descricao" placeholder="Descrição do ocorrido" ng-model="registro.reg_descricao" ng-required="true" ng-minlength="3"></textarea>
            </div>

            <hr>
            <div class="btn-group">
                <input class="btn btn-primary" style="width: 200px;" type="submit" value="Novo" name="SendPostForm" ng-disabled="!registro" ng-click="novaRegistro()"/>
                <input class="btn btn-success" style="width: 200px;" type="submit" value="Salvar" name="SendPostForm" ng-disabled="registroForm.$invalid" ng-click="saveRegistro(registro)"/>
            </div>
        </form>
    </article>
    {{registro}}
    <div class="clear"></div>
</div> <!-- content home -->