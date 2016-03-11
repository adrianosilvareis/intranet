appDt = angular.module("downtime", ["objetoAPI", "filterDefault"]);
angular.module("downtime").value("config", {
    apiURL: "/intranet/api/downtime"
});