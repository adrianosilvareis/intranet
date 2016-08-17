angular.module("uiFormat").directive("uiFormatTel", function () {
    return {
        require: "ngModel",
        link: function (scope, element, attrs, ctrl) {
            var _formatTel = function (tel) {
                if (tel === undefined)
                    tel = "";
                tel = tel.replace(/[^0-9]+/g, "");
                if (tel.length > 1) {
                    tel = "(" + tel;
                }
                if (tel.length > 3) {
                    tel = tel.substring(0, 3) + ")" + tel.substring(3);
                }
                if (tel.length > 8) {
                    tel = tel.substring(0, 8) + "-" + tel.substring(8);
                }
                if (tel.length > 13) {
                    tel = tel.replace("-", "");
                    tel = tel.substring(0, 9) + "-" + tel.substring(9, 13);
                }
                return tel;
            };

//            //executa o efeito de trasnformação da string
//            element.bind("keyup", function () {                
//                ctrl.$setViewValue(_formatTel(ctrl.$viewValue));
//                ctrl.$render();
//            });
//            
//            //No caso de Datas, converte as string em Date e insere no banco o tempo em milisegundos
//            ctrl.$parsers.push(function (value) {
//                if (value.length >= 13) {
//                    return value;
//                }
//            });
//              
//            //Converte o tempo em milisegundos vindo do banco em uma string no formato brasileiro
//            ctrl.$formatters.push(function (value) {
//                return _formatTel(value);
//            });

            element.bind("keyup", function () {
                telefones = ctrl.$viewValue.split("/");
                telefones = telefones.map(function (tel) {
                    return _formatTel(tel);
                });
                ctrl.$setViewValue(telefones.join(" / "));
                ctrl.$render();
            });

        }
    };
});