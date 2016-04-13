var width = 0;
var tempo = 50;
var carga = null;

this.init = function () {
    if (carga === null)
        carga = document.querySelector('.progress-bar');
    clearInterval(carga.intervalCounterId);
};

setWidth = function (width) {
    this.width = width;
    carga.style.width = width + '%';
    carga.innerHTML = width + "%";
};

this.start = function () {
    this.init();
    carga.intervalCounterId = setInterval(function () {
        this.width = this.width + 1;
        setWidth(this.width);
        if (this.width >= 100) {
            clearInterval(carga.intervalCounterId);
            this.width = 0;
        }
    }, this.tempo);
};

this.stop = function () {
    this.init();
};

this.complete = function () {
    this.init();
    setWidth(100);
};

this.reset = function () {
    this.init();
    setWidth(1);
};