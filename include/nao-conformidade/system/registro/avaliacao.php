<article ng-controller="avaliacao">
    <header>
        <h1>Registros:<small>Avaliação</small></h1>
    </header>
    
    <p ng-if="message" class="trigger accept">{{message}}<span class="ajax_close"></span></p>
    <?php include HOME . "/include/nao-conformidade/system/message/message-avaliacao.html"; ?>
    
    <form name="avaliacaoForm">

        <div class="well">

            <label>Avaliação das causas da NC:</label>
            <div class="clearfix"></div>

            <div class="form-group col-md-4">
                <label>Processos:</label>
                <textarea class="form-control" name="reg_aval_processo" rows="3" placeholder="Erro nos processos." ng-model="registro.reg_aval_processo"></textarea>
            </div>

            <div class="form-group col-md-4">
                <label>Matéria-Prima:</label>
                <textarea class="form-control" name="reg_aval_materia_prima" rows="3" placeholder="Problema com matéria-prima" ng-model="registro.reg_aval_materia_prima"></textarea>
            </div>

            <div class="form-group col-md-4">
                <label>Mão de Obra:</label>
                <textarea class="form-control" name="reg_aval_mao_obra" rows="3" placeholder="Erro operacional" ng-model="registro.reg_aval_mao_obra"></textarea>
            </div>

            <div class="col-md-12">
                <img style="width: 100%; height: 100px;"  src="<?= HOME ?>/include/nao-conformidade/img/fish.png" class="img-responsive" title="fish">
            </div>

            <div class="form-group col-md-4">
                <label>Equipamentos:</label>
                <textarea class="form-control" name="reg_aval_equipamento" rows="3" placeholder="Problema com equipamentos" ng-model="registro.reg_aval_equipamento"></textarea>
            </div>

            <div class="form-group col-md-4">
                <label>Meio Ambiente:</label>
                <textarea class="form-control" name="reg_aval_meio_ambiente" rows="3" placeholder="Problemas no meio ambiente" ng-model="registro.reg_aval_meio_ambiente"></textarea>
            </div>

            <div class="form-group col-md-4">
                <label>Outros:</label>
                <textarea class="form-control" name="reg_aval_outros" rows="3" placeholder="Outras causas" ng-model="registro.reg_aval_outros"></textarea>
            </div>

        </div>

        <div class="form-group">
            <label>Causa Principal:</label>
            <textarea class="form-control" rows="3" name="reg_causa_principal" placeholder="Causa Principal"  ng-required="true" ng-minlength="10" ng-model="registro.reg_causa_principal"></textarea>
        </div>

        <div class="form-group">
            <label>Proposta de ação corretiva:</label>
            <textarea class="form-control" rows="3" name="reg_acao_corretiva" placeholder="Proposta de Ação corretiva"  ng-required="true" ng-minlength="10" ng-model="registro.reg_acao_corretiva"></textarea>
        </div>

        <div class="btn-group">
            <input class="btn btn-primary" style="width: 200px;" type="submit" value="Novo" name="SendPostForm" ng-disabled="!registro" ng-click="novoRegistro()"/>
            <input class="btn btn-success" style="width: 200px;" type="submit" value="Salvar" name="SendPostForm" ng-disabled="avaliacaoForm.$invalid || causaValid()" ng-click="saveRegistro(registro)"/>
        </div>
    </form>
</article>