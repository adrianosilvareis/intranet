angular.module("filterDefault").filter("name", function () {
    return function (input) {
        if(input === undefined || input === null) return input;
        var listaDeNomes = input.split(" ");
        var listaDeNomesFormatada = listaDeNomes.map(function (nome) {
            if (/^do$|^da$|^de&/.test(nome))
                return nome;
            return nome.charAt(0).toUpperCase() + nome.substring(1).toLowerCase();
        });
        return listaDeNomesFormatada.join(" ");
    };
});