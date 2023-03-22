"use strict"

$(document).ready(function () {
    readAll();
});

$('#bt-new').click(function () {
    $('#formCreate').removeClass('d-none');
    var tabela = document.querySelector(".table-modal tbody");
    tabela.innerHTML = "";
    resetForm();
    createPedido();
});

$('.btClose').click(function () {
    readAll();
});

$('#btAdd').click(function () {
    if ($('#seProd').val() == 0)
        return alert("Favor informar o produto que deseja adicionar");
    addProduto();
});

function createPedido() {
    var obj = {
        id_pedido: '',
        valor: 0
    };

    create(obj);
}

function addProduto() {
    var obj = {
        pedido_id: $('#idPedido').val(),
        produto_id: $('#seProd').val(),
        quantidade: $('#txtQuantidade').val()
    };

    createItem(obj);
}

function openModalView(reset = true) {
    if (reset)
        resetForm();
    $('#modalVerPedido').modal('show');
}

function closeModalView() {
    resetForm();
    $('#modalVerPedido').modal('hide');
}

function resetForm() {
    $('#idPedido').val("");
    $('#seProd').val("0");
    $('#txtQuantidade').val("");
}

function createTable(data) {
    if (data.length < 1)
        return;

    var tabela = document.querySelector(".table-principal tbody");
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

function createTableModal(data, reset) {
    if (data.length < 1)
        return;

    var tabela = document.querySelector(".table-modal tbody");
    tabela.innerHTML = "";

    var tmplSource = document.getElementById("tmplLinhaModal").innerHTML;
    var tmplHandle = Handlebars.compile(tmplSource);

    for (var i = 0; i < data.length; i++) {
        var pedido = {};
        pedido.Descricao = data[i].descricao;
        pedido.Quantidade = data[i].quantidade;
        pedido.Unitario = data[i].valorVenda;
        pedido.Total = data[i].totalProduto;

        var linha = {};
        linha.template = document.createElement("template");;
        linha.template.innerHTML = tmplHandle(pedido)
        linha.content = document.importNode(linha.template.content, true);

        tabela.appendChild(linha.content);
    }
    $('#seProd').val("0");
    $('#txtQuantidade').val("");

    openModalView(reset);
}

function createSelect(data) {
    for (var i = 0; i < data.length; i++) {
        var produto = {};
        produto.id_produto = data[i].id;
        produto.Descricao = data[i].descricao;

        $('#seProd').append('<option value"' + data[i].id + '">' + data[i].descricao + '</option>');
    }
}

function open_pedido(id_pedido) {
    readById(id_pedido);
    $('#formCreate').addClass('d-none');
}

function deletePedido(id) {
    if (confirm("Deseja realmente remover?")) {
        deleteId(id);
    } else {
        return;
    }
}

function create(obj) {
    $.ajax({
        url: "api/pedido/",
        type: "POST",
        data: obj,
        dataType: "json",
        beforeSend: function () {
            $('#bt-new').attr("disabled", true);
        },
        success: function (data) {
            readAllProduto();
            openModalView();
            $('#idPedido').val(data);
        },
        error: function () {
            alert("Houve um erro no cadastro");
        },
        complete: function () {
            $('#bt-new').attr("disabled", false);
        }
    });
}

function createItem(obj) {
    $.ajax({
        url: "api/pedidoItem/",
        type: "POST",
        data: obj,
        dataType: "json",
        beforeSend: function () {
            $('#btAdd').attr("disabled", true);
        },
        success: function () {
            readById(obj.pedido_id, false);
        },
        error: function () {
            alert("Houve um erro no cadastro");
        },
        complete: function () {
            $('#btAdd').attr("disabled", false);
        }
    });
}

function readAllProduto() {
    $.ajax({
        url: "api/produto",
        type: "GET",
        data: {},
        dataType: "json",
        success: function (data) {
            createSelect(data);
        },
        error: function () {
            alert("Houve um erro na busca");
        }
    });
}

function readAll() {
    $.ajax({
        url: "api/pedido",
        type: "GET",
        data: {},
        dataType: "json",
        success: function (data) {
            createTable(data);
        }
    });
}

function readById(id, reset) {
    $.ajax({
        url: "api/pedido/" + id,
        type: "GET",
        dataType: "json",
        success: function (data) {
            createTableModal(data, reset);
        },
        error: function () {
            alert("Houve um erro na busca");
        }
    });
}

function deleteId(id) {
    $.ajax({
        url: "api/pedido/" + id,
        type: "DELETE",
        dataType: "json",
        success: function () {
            readAll();
        },
        error: function () {
            alert("Houve um erro na deleção.");
        }
    });
}
