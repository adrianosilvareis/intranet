<div class="well">

    <article>

        <header>
            <h1>Registros:</h1>
        </header>

        <p ng-if="message" class="trigger accept">{{message}}<span class="ajax_close"></span></p>
        <?php require HOME . "/include/nao-conformidade/system/message/message-registro.html"; ?>


        <form name="registroForm">

            <script type="text/javascript">
                $(document).ready(function () {
                    $('#example-multiple-optgroups').multiselect();
                    $('#multiple-selected').multiselect();
                });
            </script>

            <div class="well">
                <label>Origem da não conformidade:</label>  
                <div class="form-group">
                    <ul ng-model="origem" >
                        <li ng-repeat="origem in origens"><a href="" title="">{{origem.origem_title}}</a></li>
                    </ul>
                </div>

                <div class="form-group">
                    <label>Outros:</label>
                    <input type="text" class="form-control" name="reg_origem_outros" ng-model="registro.reg_origem_outros" />
                </div>
            </div>

            <div class="form-group">
                <label>Descrição:</label>
                <textarea class="form-control" rows="3" name="reg_descricao" placeholder="Descrição do ocorrido" ng-model="registro.reg_descricao" ng-required="true" ng-minlength="3"></textarea>
            </div>

            <div class="form-group">
                <label class="btn btn-primary">
                    Hove impacto para o paciente ? 
                    <input type="checkbox" autocomplete="off" name="reg_impacto_paciente" ng-model="registro.reg_impacto_paciente"> 
                </label>
            </div>

            <div class="form-group">
                <label>Setor detectado:</label>
                <select class="form-control" name="setor_responsavel" ng-model="registro.setor_responsavel" ng-options="setor.setor_id as setor.setor_content for setor in setores">
                    <option value="">Selecione um setor</option>
                </select>
            </div>

            <div class="form-group">
                <label>Usuário responsável:</label>
                <select class="form-control" name="user_recebimento" ng-model="registro.user_recebimento" ng-options="user.user_id as user.user_nickname +     ' - ' +     user.user_name +     ' ' +     user.user_lastname for user in usuarios">
                    <option value="">Selecione um responsável</option>
                </select>
            </div>

            <div class="form-group">
                <label>Correção Imediata:</label>
                <textarea class="form-control" rows="3" name="reg_correcao_imediata" placeholder="Correção imediata" ng-model="registro.reg_correcao_imediata" ng-required="true" ng-minlength="3"></textarea>
            </div>

            <div class="form-group col-md-6">
                <label>Responsável pela execução da açao:</label>
                <input type="text" class="form-control" name="reg_user_correcao" ng-model="registro.reg_user_correcao" />
            </div>

            <div class="form-group  col-md-6">
                <label>Data da ação corretiva:</label>
                <input type="text" class="form-control formDate" name="reg_date_correcao" ng-model="registro.reg_date_correcao" />
            </div>

            <hr>
            <div class="btn-group">
                <input class="btn btn-primary" style="width: 200px;" type="submit" value="Novo" name="SendPostForm" ng-disabled="!registro" ng-click="novoRegistro()"/>
                <input class="btn btn-success" style="width: 200px;" type="submit" value="Salvar" name="SendPostForm" ng-disabled="registroForm.$invalid" ng-click="saveRegistro(registro)"/>
            </div>
        </form>
    </article>
    {{registro}}
    <div class="clear"></div>
</div> <!-- content home -->