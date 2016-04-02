angular.module("agenda", ["ngMessages", "objetoAPI", 'uiFormat', 'filterDefault']);

angular.module("agenda").run(function ($rootScope) {
    /*
     Receive emitted message and broadcast it.
     Event names must be distinct or browser will blow up!
     */
    $rootScope.$on('handleEmit', function (event, args) {
        $rootScope.$broadcast('handleBroadcast', args);
    });
});

//Controller que envia a mensagem BrodCast
//myModule.controller("ControllerZero", function ($scope) {
//    $scope.handleClick = function (msg) {
//        $scope.$emit('handleEmit', {message: msg});
//    };
//});
//
//Controller que recebe a mensagem BroadCast
//myModule.controller("controller", function ($scope) {
//    $scope.$on('handleBroadcast', function (event, args) {
//        $scope.message = 'ONE: ' + args.message;
//    });
//});