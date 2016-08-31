angular.module('faturamento').controller('uploadParticular', function ($scope, config, fileUpload) {

    $scope.info = {};
    
    $scope.voltar = function(){
        delete $scope.erros;
    };
    
    $scope.submit = function () {
        if ($scope.arquivo) {
            var file = $scope.arquivo;
            fileUpload.uploadFileToUrl(config.urlAPI + '/uploadparticular', file)
                    .success(success)
                    .error(error);
        } else {
            $scope.info = {
                message: 'Nenhum arquivo selecionado!',
                status: '404'
            };
        }
    };

    var success = function (data) {
        $scope.info = {
            message: "Arquivo Salvo com sucesso!",
            status: '200'
        };
        console.log(data);
        $scope.erros = data;
    };

    var error = function (error) {
        $scope.info = error;
        console.log(error);
    };
});