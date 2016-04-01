angular.module('downtime', ["objetoAPI", "filterDefault"]);

angular.module('downtime').value("config", {
    apiURL: "/intranet/api/downtime"
});

angular.module('downtime').run(function ($rootScope) {
    /*
     Receive emitted message and broadcast it.
     Event names must be distinct or browser will blow up!
     */
    $rootScope.$on('handleEmit', function (event, args) {
        $rootScope.$broadcast('handleBroadcast', args);
    });
});