"use strict"

$(document).ready(function () {
    readAll();
});

function openModalView() {
    $('#modalVerProduto').modal('show');
}

function closeModalView() {
    $('#modalVerProduto').modal('hide');
}

function createModalView(data) {
    if (data == null)
        return;

    $('#idProduto').val(data.id_produto);
    $('#txtDescricao').val(data.descricao);
    $('#txtValor').val(data.valorVenda);
    $('#txtEstoque').val(data.estoque);

    readImagesById(data.id_produto);
}

function insertImagens(data) {
    if (data == null)
        return;

    $('#divImagens').html("");

    for (var i = 0; i < data.length; i++) {
        $('#divImagens').append("<img src='getImagem.php?id=" + data[i].id + "' \"><i class='bi-x-circle-fill icon icon-x pointer' title='Excluir imagem' aria-multiline='Excluir imagem' onclick='deleteImagem(" + data[i].id + "," + data[i].produto_id + ")'></i>");
    }

    openModalView();
}

function deleteImagem(id,id_produto) {
    if (confirm("Deseja realmente remover?")) {
        deleteImagemId(id,id_produto);
    } else {
        return;
    }
}

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

function open_produto(id_produto) {
    readById(id_produto);
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

function readById(id) {
    $.ajax({
        url: "api/produto/" + id,
        type: "GET",
        dataType: "json",
        success: function (data) {
            createModalView(data);
        }
    });
}

function readImagesById(id) {
    $.ajax({
        url: "api/imagens/" + id,
        type: "GET",
        dataType: "json",
        success: function (data) {
            insertImagens(data);
        }
    });
}

function deleteImagemId(id,id_produto) {
    $.ajax({
        url: "api/imagens/" + id,
        type: "DELETE",
        dataType: "json",
        success: function (data) {
            if (data.result) {
                open_produto(id_produto);
            }
        },
        error: function () {
            alert("Houve um erro na deleção");
        }
    });
}