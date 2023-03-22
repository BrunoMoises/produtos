<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Pedidos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <div class="container">
        <header>
            <div class="row mt-3">
                <div class="col-md-3">
                    <a href="index.php">CRUD Pedidos</a>
                </div>
                <div class="col-md-9 text-start">
                    <nav class="nav__container">
                        <ul class="ul__nav">
                            <li><a href="index.php">Produtos</a></li>
                            <li class="home"><a href="pedidos.php">Pedidos</a></li>
                        </ul>
                    </nav>
                </div>
        </header>
        <hr class="border-info">
        <div>
            <button type="button" class="btn btn-outline-success" id="bt-new">Novo pedido</button>
        </div>
        <div class="row mt-3">
            <table class="table table-striped-columns table-bordered table-principal">
                <thead>
                    <tr>
                        <th colspan="2">Codigo</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <script id="tmplLinha" type="text/template">
                <tr>
                    <td width="10"><i class="bi-x-circle-fill icon icon-x pointer" title="Excluir pedido"
                            aria-multiline="Excluir pedido" onclick="deletePedido('{{id_pedido}}')"></i></td>
                    <td><a href="javascript:open_pedido('{{id_pedido}}')">Pedido {{id_pedido}}</a></td>
                    <td><a href="javascript:open_pedido('{{id_pedido}}')">{{Valor}}</a></td>
                </tr>
            </script>
        </div>
    </div>

    <div class="modal fade" id="modalVerPedido" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <form id="frmCreate" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalLabel">Criar/Ver Pedido</h1>
                        <button type="button" class="btn-close btClose" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <table class="table table-striped-columns table-bordered table-modal">
                                <thead>
                                    <tr>
                                        <th>Descrição</th>
                                        <th>Quantidade</th>
                                        <th>Valor un</th>
                                        <th>Valor total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <script id="tmplLinhaModal" type="text/template">
                                <tr>
                                    <td>{{Descricao}}</td>
                                    <td>{{Quantidade}}</td>
                                    <td>{{Unitario}}</td>
                                    <td>{{Total}}</td>
                                </tr>
                            </script>
                        </div>
                        <div id="formCreate">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="txtDescricao">Produto: </label>
                                    <input type="hidden" id="idPedido" value="">
                                    <select name="seProd" id="seProd" class="form-control">
                                        <option value="0">Selecione...</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="txtQuantidade">Quantidade: </label>
                                    <input type="number" id="txtQuantidade" class="form-control">
                                </div>
                                <div class="col-md-3 d-flex aligm-items-center">
                                    <button type="button" class="btn btn-outline-success" id="btAdd" class="form-control">Adicionar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger btClose" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="js/handlebars.js"></script>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script-pedidos.js"></script>
</body>

</html>