<article ng-controller="registroUser">
    <header>
        <h1>Registros:<small>Evento</small></h1>
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
                <ul class="list-group" ng-model="origem" ng-require="true" >
                    <a id="origem_{{origem.origem_id}}}" href="" class="list-group-item col-md-3" style="float: left; text-align: center;"  
                       title="{{origem.origem_title}}" ng-repeat="origem in origens" ng-click="addOrigem(origem)" ng-class="activeItem(origem)" 
                       >{{origem.origem_title}}</a>
                </ul>
            </div>
            
            <div class="clearfix"></div>
            <div class="form-group">
                <label>Outros:</label>
                <input type="text" class="form-control" name="reg_origem_outros" ng-model="registro.reg_origem_outros" ng-disabled="registro.disabled"/>
            </div>
        </div>

        <div class="well">

            <div class="form-group" ng-if="!registro.disabled">
                <label>Anexo:</label>
                <input class="form-control" type="file" ngf-select="onFileSelect(uploads)" multiple="true" ng-model="uploads" ng-disabled="registro.disabled"/>
            </div>

            <div class="form-group row" ng-if="registro.images.length > 0">
                <label>Imagens:</label>
                <div class="row">
                    <div class="col-md-2" ng-repeat="img in registro.images">
                        <img src="{{img.TYNY}}"  alt="{{img.FILE.name}}" class="img-responsive img-thumbnail" style="height: 105px">
                        <a href="" class="del" title="remover" ng-click="removeFile(img)">remover</a>
                    </div>
                </div>
            </div>

            <div class="form-group row" ng-if="registro.files.length > 0">
                <label>Arquivos:</label>
                <ul class="list-group">
                    <li ng-repeat="file in registro.files" class="list-group-item col-md-3" style="float: left; text-align: center; height: 60px; overflow: hidden;">
                        {{file.FILE.name}}<a href="" class="del" title="remover" ng-click="removeFile(file)">remover</a>
                    </li>
                </ul>
            </div>

            <div class="progress" ng-if="!registro.disabled">
                <div class="progress-bar progress-bar-success progress-bar-striped" style="width: 1%;"></div>
            </div>

        </div>

        <div class="form-group">
            <label>Descrição:</label>
            <textarea class="form-control" rows="3" name="reg_descricao" placeholder="Descrição do ocorrido" ng-model="registro.reg_descricao" ng-required="true" ng-minlength="10" ng-disabled="registro.disabled"></textarea>
        </div>

        <div class="form-group">
            <label class="btn btn-primary">
                Hove impacto para o paciente ? 
                <input type="checkbox" autocomplete="off" name="reg_impacto_paciente" ng-model="registro.reg_impacto_paciente" ng-disabled="registro.disabled"> 
            </label>
        </div>

        <div class="form-group">
            <label>Setor detectado:</label>
            <input ng-if="registro.disabled" class="form-control" name="setor_recebimento" ng-model="registro.setor_recebimento.setor_content" disabled="true"/>
            <select class="form-control" name="setor_recebimento" ng-model="registro.setor_recebimento" ng-options="setor.setor_id as setor.setor_content for setor in setores" ng-required="true" ng-if="!registro.disabled">
                <option value="">Selecione um setor</option>
            </select>
        </div>

        <div class="form-group">
            <label>Usuário responsável:</label>
            <input ng-if="registro.disabled" class="form-control" name="user_recebimento" ng-model="registro.user_recebimento.user_nickname" disabled="true"/>
            <select class="form-control" name="user_recebimento" ng-model="registro.user_recebimento" ng-options="user.user_id as user.user_nickname +  ' - ' +  user.user_name +  ' ' +  user.user_lastname for user in usuarios" ng-required="true" ng-if="!registro.disabled">
                <option value="">Selecione um responsável</option>
            </select>
        </div>

        <div class="form-group">
            <label>Correção Imediata:</label>
            <textarea class="form-control" rows="3" name="reg_correcao_imediata" placeholder="Correção imediata" ng-model="registro.reg_correcao_imediata" ng-required="true" ng-minlength="10" ng-disabled="registro.disabled"></textarea>
        </div>

        <div class="form-group col-md-6">
            <label>Responsável pela execução da açao:</label>
            <input type="text" class="form-control" name="reg_user_correcao" ng-model="registro.reg_user_correcao" ng-required="true" ng-minlength="5" ng-disabled="registro.disabled"/>
        </div>

        <div class="form-group  col-md-6">
            <label>Data da ação corretiva:</label>
            <input type="text" class="form-control formDate" name="reg_date_correcao" ng-model="registro.reg_date_correcao" ng-required="true" ng-minlength='19' ng-if="!registro.disabled"/>
            <input type="text" class="form-control" name="reg_date_correcao" ng-model="registro.reg_date_correcao" disabled="true" ng-if="registro.disabled"/>
        </div>

        <hr>
        <div class="btn-group" ng-if="!registro.disabled">
            <input class="btn btn-primary" style="width: 200px;" type="submit" value="Novo" name="SendPostForm" ng-disabled="!registro" ng-click="novoRegistro()"/>
            <input class="btn btn-success" style="width: 200px;" type="submit" value="Salvar" name="SendPostForm" ng-disabled="registroForm.$invalid || origemValid()" ng-click="saveRegistro(registro)"/>
        </div>
    </form>
</article>