angular.module('faturamento').directive('uiAlert', function (config) {

    return {
        templateUrl: config.partials + '/messages/alert.html',
        restrict: 'AE',
        require: 'ngIf',
        transclude: true,
        scope: {
            status: '=',
            title: '='
        },
        controller: function ($scope, $timeout) {
            var status = function (alert) {
                switch (alert) {
                    case '200':
                        info = 'alert alert-success';
                        break;
                    case '204':
                        info = 'alert alert-info';
                        break;
                    case '404':
                        info = 'alert alert-warning';
                        break;
                    case '500':
                        info = 'alert alert-danger';
                        break;
                    default:
                        info = 'alert alert-danger';
                        break;
                }
                $scope.style = info;
            };

            $timeout(function () {
                status($scope.status);
            }, 100 * 10);
        }
    };

});