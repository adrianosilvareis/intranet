appNCon.controller("setor", function ($scope, objetoAPI, config) {
    $scope.setores = [];
    $scope.types = [];
    $scope.setor;

    var carregarObjetos = function () {
        objetoAPI.getObjeto(config.apiURL + "/setor.api.php").success(function (data) {
            $scope.setores = data;
        });
        objetoAPI.getObjeto(config.apiURL + "/setor_type.api.php").success(function (data) {
            $scope.types = data;
        });
    };

    $scope.saveSetor = function (setor) {
        objetoAPI.saveObjeto(config.apiURL + "/setor.api.php", setor).success(function (date, status) {
            delete $scope.setor;
            $scope.setorForm.$setPristine();
            carregarObjetos();
            $scope.message = date;
            if (status === 200) {
                console.log(date);
            }
        });
    };

    $scope.setorId = function (setor) {
        setor.edited = true;
        $scope.setor = setor;
    };

    $scope.apagarSetor = function (setor) {
        apagar = [setor];
        $scope.saveSetor(apagar);
    };

    $scope.novoSetor = function () {
        delete $scope.setor;
        $scope.setorForm.$setPristine();
    };

    $scope.alterStatus = function (setor) {
        setor.setor_status = (setor.setor_status === "0" ? false : true);
        setor.setor_status = !setor.setor_status;
        setor.edited = true;
        $scope.saveSetor(setor);
    };

    carregarObjetos();
});