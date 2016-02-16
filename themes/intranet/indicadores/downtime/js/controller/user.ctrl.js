angular.module("downtime").controller("user", function ($scope, objetoAPI, config) {
    var times = [];
    $scope.equipamentos = [];

    $scope.update = function (equip) {

        $scope.carregando = false;

        equip.equip_lastupdate = getTimestampNow();
        equip.equip_author = equip.author;
        if (!equip.downtime[0]) {
            //criar downtime
            equip.time_stop = getTimestampNow();
            saveTime(equip);
        } else {
            //atualizar downtime
            var time = equip.downtime[0];
            time.equip_author = equip.author;
            time.time_lastupdate = getTimestampNow();
            time.time_start = getTimestampNow();
            saveTime(time);
        }
        saveEquip(equip);
    };
    
    var getTimestampNow = function () {
        //2016-02-16 16:31:45
        var date = new Date();
        var year = date.getFullYear();
        var month = date.getMonth() + 1;
        var day = date.getDate();
        var hour = date.getHours();
        var minute = date.getMinutes();
        var seconds = date.getSeconds();

        return year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + seconds;
    };

    var saveEquip = function (equip) {
        objetoAPI.saveObjeto(config.apiURL + "/equipe.api.php", equip).success(function (data) {
            console.log(data);
            console.log(equip);
            carregarListas();
        });
    };

    var saveTime = function (down) {
        objetoAPI.saveObjeto(config.apiURL + "/time.api.php", down).success(function (data) {
            console.log(data);
            console.log(down);
            carregarListas();
        });
    };

    var num = 0;
    var load = function (cont) {
        num += cont;
        if (num === 2) {
            num = 0;
            vincularTimes();
        }
    };

    var vincularTimes = function () {
        $scope.equipamentos.forEach(function (equip) {
            var _times = times.filter(function (element) {
                if (element.equip_id === equip.equip_id)
                    return element;
            });

            equip.downtime = _times.filter(function (element) {
                if (element.time_start == "0000-00-00 00:00:00")
                    return element;
            });
            equip.stoped = (equip.downtime[0] ? true : false);
        });
        $scope.carregando = true;
    };

    var carregarListas = function () {
        objetoAPI.getObjeto(config.apiURL + "/equipe.api.php").success(function (data) {
            $scope.equipamentos = data;
            load(1);
        });

        objetoAPI.getObjeto(config.apiURL + "/time.api.php").success(function (data) {
            times = data;
            load(1);
        });

    };

    carregarListas();
});