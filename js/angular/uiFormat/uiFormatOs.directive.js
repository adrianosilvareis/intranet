angular.module("uiFormat").directive("uiFormatOs", function () {
    return {
        require: "ngModel",
        link: function (scope, element, attrs, ctrl) {
            var _formatOs = function (os) {
                if (os === undefined)
                    os = "";
                var mil = os.indexOf("*");
                os = os.replace(/[^0-9]+/g, "");
                if (os.length > 3) {
                    os = os.substring(0, 3) + "-" + os.substring(3);
                }
                if (os.length > 9) {
                    os = os.substring(0, 9) + "-" + os.substring(9);
                }
                if (os.length > 10 && mil > -1) {
                    os = os.replace("-", "");
                    os = os.replace("-", "");
                    os = os.substring(0, 4) + "-" + os.substring(4);
                    os = os.substring(0, 10) + "-" + os.substring(10, 14);
                }
                return os;
            };

            element.bind("keyup", function () {
                os = ctrl.$viewValue;
                os = _formatOs(os);
                ctrl.$setViewValue(os);
                ctrl.$render();
            });

        }
    };
});