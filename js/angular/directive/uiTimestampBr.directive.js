angular.module("uiFormat").directive("uiTimestampbr", function ($filter) {
    return {
        require: 'ngModel',
        link: function (scope, element, attrs, ctrl) {
            var _formatTimestamp = function (date) {
                
                if (!date) {
                    return date;
                }
                date = date.replace(/[^0-9]+/g, '');
                if (date.length > 2) {
                    date = date.substring(0, 2) + "/" + date.substring(2);
                }
                if (date.length > 5) {
                    date = date.substring(0, 5) + "/" + date.substring(5);
                }
                if (date.length > 10) {
                    date = date.substring(0, 10) + " " + date.substring(10);
                }
                if (date.length > 13) {
                    date = date.substring(0, 13) + ":" + date.substring(13);
                }
                if (date.length > 16) {
                    date = date.substring(0, 16) + ":" + date.substring(16, 18);
                }

                return date;
            };

            element.bind('keyup', function () {
                ctrl.$setViewValue(_formatTimestamp(ctrl.$viewValue));
                ctrl.$render();
            });

            ctrl.$parsers.push(function (value) {
                if (value.length === 19) {

                    var dataHora = value.split(" ");
                    var data = dataHora[0];
                    var hora = dataHora[1];

                    var arrayData = data.split("/");
                    var dia = arrayData[0];
                    var mes = arrayData[1];
                    var ano = arrayData[2];

                    var dataFormatada = ano + "-" + mes + "-" + dia + " " + hora;
                    return dataFormatada;
                }
            });

            ctrl.$formatters.push(function (value) {
                return $filter("timestampBr")(value);
            });
        }
    };
});