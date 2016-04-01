angular.module("uiFormat").directive("uiFormatSite", function () {
    return {
        require: "ngModel",
        link: function (scope, element, attrs, ctrl) {

            var _formatSite = function (site) {
                site = site.replace("http://", "");
                if(site.length !== 0 && !/(https?):\/\//g.test(site))
                    site = "http://" + site;

                return site;
            };

            element.bind("keyup", function () {
                ctrl.$setViewValue(_formatSite(ctrl.$viewValue));
                ctrl.$render();
            });
        }
    };
});