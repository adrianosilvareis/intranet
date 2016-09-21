angular.module('parada-equipamento').factory("loadingInterceptor", function ($q, $rootScope, $timeout) {
    var loading = 0;
    var endLoading = function () {
        --loading;
        if (loading === 0) {
            $timeout(function () {
                $rootScope.loading = false;
            }, 500);
        }
    };

    return {
        request: function (config) {
            loading++;
            $rootScope.loading = true;
            return config;
        },
        requestError: function (rejection) {
            endLoading();
            return $q.reject(rejection);
        },
        response: function (response) {
            endLoading();
            return response;
        },
        responseError: function (rejection) {
            endLoading();
            return $q.reject(rejection);
        }
    };
});