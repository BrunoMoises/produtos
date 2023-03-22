"use strict"

$(document).ready(function () {
    readAll();
});

$('#addImg').click(function () {
    
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

function deleteImagem(id, id_produto) {
    if (confirm("Deseja realmente remover?")) {
        deleteImagemId(id, id_produto);
    } else {
        return;
    }
}

function editaProdutoView() {
    $('#txtDescricao').attr('readonly', false);
    $('#txtValor').attr('readonly', false);
    $('#txtEstoque').attr('readonly', false);
    $('#btnSubmit').removeClass('d-none');
}

function addImage() {
    $('#divImg').removeClass('d-none');
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

function saveImage() {
    var obj = {
        produto_id: $('#idProduto').val(),
        imagem: $('#fileImg').val()
    };

    createImg(obj);
}

function createImg(obj) {
    $.ajax({
        url: "api/imagens/",
        type: "POST",
        data: obj,
        dataType: "json",
        beforeSend: function () {
            $('#addImg').attr("disabled", true);
        },
        success: function (data) {
            if (data.result) {
                open_produto(obj.produto_id);
            } else {
                alert("Houve um erro no cadastro");
            }
        },
        error: function () {
            alert("Houve um erro no cadastro");
        },
        complete: function () {
            $('#addImg').attr("disabled", false);
        }
    });
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
        },
        error: function () {
            alert("Houve um erro na busca");
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

function deleteImagemId(id, id_produto) {
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