angular.module('fileUploads').service('fileUpload', ['$http', function ($http) {
        this.uploadFileToUrl = function (uploadUrl, file) {
            var fd = new FormData();
            fd.append('file', file);

            return $http.post(uploadUrl, fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined}
            });
        };
    }]);