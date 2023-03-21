"use strict"

$(document).ready(function () {
    readAll();
});

//EVENTOS

function createTable(data) {
    if (data.length < 1)
        return;

    var tabela = document.querySelector(".table tbody");
    tabela.innerHTML = "";

    var tmplSource = document.getElementById("tmplLinha").innerHTML;
    var tmplHandle = Handlebars.compile(tmplSource);

    for (var i = 0; i < data.length; i++) {
        var produto = {};
        produto.id_produto = data[i].id;
        produto.Descricao = data[i].descricao;
        produto.Valor = data[i].valorVenda;
        produto.Estoque = data[i].estoque;

        var linha = {};
        linha.template = document.createElement("template");;
        linha.template.innerHTML = tmplHandle(produto)
        linha.content = document.importNode(linha.template.content, true);

        tabela.appendChild(linha.content);
    }
}

function readAll() {
    $.ajax({
        url: "api/produto",
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