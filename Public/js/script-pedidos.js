"use strict"

$(document).ready(function () {
    readAll();
});

function createTable(data) {
    if (data.length < 1)
        return;

    var tabela = document.querySelector(".table tbody");
    tabela.innerHTML = "";

    var tmplSource = document.getElementById("tmplLinha").innerHTML;
    var tmplHandle = Handlebars.compile(tmplSource);

    for (var i = 0; i < data.length; i++) {
        var pedido = {};
        pedido.id_pedido = data[i].id;
        pedido.Valor = data[i].valor;

        var linha = {};
        linha.template = document.createElement("template");;
        linha.template.innerHTML = tmplHandle(pedido)
        linha.content = document.importNode(linha.template.content, true);

        tabela.appendChild(linha.content);
    }
}

function readAll() {
    $.ajax({
        url: "api/pedido",
        type: "GET",
        data: {},
        dataType: "json",
        success: function (data) {
            createTable(data);
        },
        error: function () {
            alert("Houve um erro na busca");
        }
    });
}
