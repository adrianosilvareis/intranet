angular.module("agenda").controller("agenda", function ($scope, objetoAPI, config) {

    $scope.contatos = [];
    $scope.enderecos = [];
    $scope.setores = [];
    
    //BroadCast Recebendo de contatos.ctrl.js e setor.ctrl.js os dados ja carregados da API
    $scope.$on('handleBroadcast', function (event, args) {
        if (args.setores)
            $scope.setores = args.setores;
        if (args.contatos)
            $scope.contatos = args.contatos;
        if (args.enderecos)
            $scope.enderecos = args.enderecos;

        if ($scope.contatos && $scope.setores)
            vincularContatos();
    });

    var vincularContatos = function () {
        $scope.contatos.map(function (contato) {
            contato.setor = $scope.setores.filter(function (setor) {
                if (setor.setor_id === contato.setor_id) {
                    return setor;
                }
            })[0];
        });
    };

});