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
                            <li class="home"><a href="index.php">Produtos</a></li>
                            <li><a href="pedidos.php">Pedidos</a></li>
                        </ul>
                    </nav>
                </div>
        </header>
        <hr class="border-success">
        <div>
            <button type="button" class="btn btn-outline-success" id="bt-new">Novo produto</button>
        </div>
        <div class="row mt-3">
            <table class="table table-striped-columns table-bordered">
                <thead>
                    <tr>
                        <th colspan="3">Codigo</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Estoque</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <script id="tmplLinha" type="text/template">
                <tr>
                    <td width="10"><i class="bi-x-circle-fill icon icon-x pointer" title="Excluir produto"
                            aria-multiline="Excluir produto" onclick="deleteProduto('{{id_produto}}')"></i></td>
                    <td width="10"><i class="bi-pencil-fill icon icon-edit pointer" title="Editar produto"
                            aria-multiline="Editar produto" onclick="editaProduto('{{id_produto}}')"></i></td>
                    <td align="center" width="40">{{id_produto}}</td>
                    <td><a href="javascript:open_produto('{{id_produto}}')">{{Descricao}}</a></td>
                    <td>{{Valor}}</td>
                    <td>{{Estoque}}</td>
                </tr>
            </script>
        </div>
    </div>

    <div class="modal fade" id="modalVerProduto" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <form id="frmCreate" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalLabel">Produto&nbsp;&nbsp;<i class="bi-pencil-fill icon icon-edit pointer" title="Editar produto" aria-multiline="Editar produto" id="btEdit" onclick="editaProdutoView()"></i></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="txtDescricao">Descrição: </label>
                                <input type="hidden" id="idProduto" value="">
                                <input type="text" id="txtDescricao" readonly class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="txtValor">Valor: </label>
                                <input type="number" id="txtValor" readonly class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="txtEstoque">Estoque: </label>
                                <input type="number" id="txtEstoque" readonly class="form-control">
                            </div>
                        </div>
                        <div class="row d-none" id="divImg">
                            <label for="txtEstoque">Imagem: </label>
                            <input type="file" id="fileImg" class="form-control">
                            <button type="button" id="addImg" class="btn btn-outline-success w-25" data-bs-dismiss="modal" onclick="saveImage()">Adicionar</button>
                        </div>
                        <div class="row images">
                            <label>Imagens: </label>
                            <i class="bi-file-plus-fill icon icon-edit pointer" title="Adicionar imagem" aria-multiline="Adicionar imagem" id="addImage" onclick="addImage()"></i>
                            <div id="divImagens" class="justify-content-center d-flex">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success d-none" id="btnSubmit">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="js/handlebars.js"></script>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script-produtos.js"></script>
</body>

</html>