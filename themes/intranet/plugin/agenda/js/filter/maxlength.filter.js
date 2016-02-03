appAgenda.filter("maxlength", function () {
    return function (input, limit) {
        if (input && input.length > limit) {
            var _maxLength = input.substr(0, limit);
            return _maxLength;
        }
        return input;
    };
});