angular.module("naoConformidade").controller("registro", function ($scope) {

    $scope.saveRegistro = function (registro) {
        console.log(registro);
    };
    
    $scope.opcoes = [
        {id: 1, nome: 'Adriano'},
        {id: 2, nome: 'Thiago'},
        {id: 3, nome: 'Renan'},
        {id: 4, nome: 'Davi'},
        {id: 5, nome: 'Carlos'}
    ];
    
    $scope.setores = [
        {id: 1, nome: 'CPD'},
        {id: 2, nome: 'Faturamento'},
        {id: 3, nome: 'Recepção'},
        {id: 4, nome: 'Triagem'},
        {id: 5, nome: 'Area tecnica'}
    ];
    
    $scope.usuarios = [
        {id: 1, nome:'Adriano'},
        {id: 2, nome:'Kamila'},
        {id: 3, nome:'Jorge'},
        {id: 4, nome:'Leinha'},
        {id: 5, nome:'Binha'}
    ];
});