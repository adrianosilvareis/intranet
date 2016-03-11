<div class="well">

    <article>
        
        <header>
            <h1>Equipamento:</h1>
        </header>

        <p ng-if="message" class="trigger accept">{{message}}<span class="ajax_close"></span></p>
        <?php require HOME . "/" . REQUIRE_PATH . "/indicadores/downtime/system/message/message-equip.html"; ?>

        <form name="equipForm">

            <div class="form-group">
                <label>Titulo:</label>
                <input class="form-control" type="text" name="equip_title" placeholder="nome do equipamento" ng-model="equipamento.equip_title" ng-required="true" ng-minlength="3"/>
            </div>

            <div class="form-group">
                <label>Descrição:</label>
                <input class="form-control" type="text" name="equip_content" placeholder="Descrição" ng-model="equipamento.equip_content" />
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label>Setor:</label>
                    <select class="form-control" name="setor_id" ng-model="equipamento.setor_id" ng-options="setor.setor_id as setor.setor_content for setor in setores" ng-required="true">
                        <option value=""> Selecione um setor: </option>
                    </select>
                </div>
            </div>

            <hr>
            <div class="btn-group">
                <input class="btn btn-primary" style="width: 200px;" type="submit" value="Novo" name="SendPostForm" ng-disabled="!equipamento" ng-click="novoEquipamento()"/>
                <input class="btn btn-success" style="width: 200px;" type="submit" value="Salvar" name="SendPostForm" ng-disabled="equipForm.$invalid" ng-click="saveEquipamento(equipamento)"/>
            </div>

        </form>
    </article>
    <div class="clear"></div>
</div>