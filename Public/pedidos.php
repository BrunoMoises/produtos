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
            <table class="table table-striped-columns table-bordered">
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

    <script src="js/handlebars.js"></script>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script-pedidos.js"></script>
</body>

</html>