angular.module('faturamento').controller('uploadParticular', function ($scope, config, fileUpload) {

    $scope.info = {};
    
    
    $scope.submit = function () {
        if ($scope.arquivo) {
            var file = $scope.arquivo;
            fileUpload.uploadFileToUrl(config.urlAPI + '/particular', file)
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
        console.log('sucesso: ');
        console.log(data);
    };

    var error = function (error) {
        $scope.info = error;
        console.log('error: ');
        console.log(error);
    };
});