<script>
    angular.module("itemPerfil", ['objetoAPI']);

    angular.module('itemPerfil').value('config', {
        apiURL: "/intranet/api/perfil"
    });

    angular.module("itemPerfil").controller('acesso', function ($scope, objetoAPI, config) {
        $('#menu2').hide();

        $scope.acessos = [];
        $scope.submenu1 = [];
        $scope.submenu2 = [];

        $scope.submenu = function (select) {
            $scope.submenu1 = filterAcessos(select.acesso_id);
            $('#menu2').toggle('slow');
        };

        $scope.submenu2 = function (select) {
            $scope.submenu2 = filterAcessos(select.acesso_id);
            $('#menu3').toggle('slow');
        };

        var filterAcessos = function (acesso_id) {
            return $scope.acessos.filter(function (submenu) {
                return submenu.acesso_parent === acesso_id;
            });
        };

        var carregarItens = function () {
            objetoAPI.getObjeto(config.apiURL + '/acesso.api.php').success(function (data) {
                $scope.acessos = data;
            });
        };

        carregarItens();
    });
</script>

<div class="content list_content" ng-app="itemPerfil">

    <section ng-controller="acesso">

        <h1>Itens de Acesso</h1>

        <ul id="menu1" class="menu_list blue-default column-3">
            <li class="header">TITULO</li>
            <li class="item" ng-repeat="acesso in acessos| filter:{
                        acesso_parent:null
                    }">
                <a href="" ng-click="submenu(acesso)" title="{{acesso.acesso_content}}">{{acesso.acesso_title}}</a>
            </li>
        </ul>

        <ul id="menu2" class="menu_list blue-default column-3">
            <li class="header">SUBMENU</li>
            <li class="item" ng-repeat="acesso in submenu1">
                <a href="" ng-click="submenu2(acesso)" title="{{acesso.acesso_content}}">{{acesso.acesso_title}}</a>
            </li>
        </ul>

        <ul id="menu3" class="menu_list blue-default column-3">
            <li class="header">SUBTITULO 2</li>
            <li class="item"><a href="">first</a></li>
        </ul>

        <div class="clear"></div>
    </section>
</div> <!-- content home -->