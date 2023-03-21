<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once("../../vendor/autoload.php");
use App\Controller\ImagensController;
use App\Controller\PedidoController;
use App\Controller\PedidoItemController;
use App\Controller\ProdutoController;

$controller = null;
$id_produto = null;
$id_pedido = null;
$id_imagem = null;
$method = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];
$data = null;
parse_str(file_get_contents('php://input'), $data);
$unsetCount = 3;

$ex = explode("/", $uri);

for ($i = 0; $i < $unsetCount; $i++) {
    unset($ex[$i]);
}

$ex = array_filter(array_values($ex));

if (isset($ex[0]))
    $controller = $ex[0];

if (isset($ex[1])) {
    if ($controller == 'produto') {
        $id_produto = $ex[1];
    } else if ($controller == 'pedido') {
        $id_pedido = $ex[1];
    } else if ($controller == 'imagens') {
        $id_produto = $ex[1];
        $id_imagem = $ex[1];
    } else if ($controller == 'pedidoItem') {
        $id_produto = $ex[1];
    }
}

$imagensController = new ImagensController();
$pedidoController = new PedidoController();
$pedidoItemController = new PedidoItemController();
$produtoController = new ProdutoController();

switch ($method) {
    case 'GET':
        if ($controller == 'produto' && $id_produto == null) {
            echo $produtoController->readAll();
        } else if ($controller == 'produto' && $id_produto != null) {
            echo $produtoController->readById($id_produto);
        } else if ($controller == 'pedido' && $id_pedido == null) {
            echo $pedidoController->readAll();
        } else if ($controller == 'pedido' && $id_pedido != null) {
            echo $pedidoController->readById($id_pedido);
        } else if ($controller == 'imagens' && $id_produto != null) {
            echo $imagensController->readById($id_produto);
        } else {
            echo json_encode(["result" => "invalid"]);
        }
        break;
    case 'POST':
        if ($controller == 'produto' && $id_produto == null) {
            echo $produtoController->create($data);
        } else if ($controller == 'pedido' && $id_pedido == null) {
            echo $pedidoController->create($data);
        } else if ($controller == 'pedidoItem' && $id_produto == null) {
            echo $pedidoItemController->create($data);
        } else if ($controller == 'imagens' && $id_produto == null) {
            echo $imagensController->create($data);
        } else {
            echo json_encode(["result" => "invalid"]);
        }
        break;
    case 'PUT':
        if ($controller == 'produto' && $id_produto != null) {
            echo $produtoController->update($id_produto, $data);
        } else {
            echo json_encode(["result" => "invalid"]);
        }
        break;
    case 'DELETE':
        if ($controller == 'produto' && $id_produto != null) {
            echo $produtoController->delete($id_produto);
        } else if ($controller == 'pedido' && $id_pedido != null) {
            echo $pedidoController->delete($id_pedido);
        } else if ($controller == 'imagens' && $id_imagem != null) {
            echo $imagensController->delete($id_imagem);
        } else {
            echo json_encode(["result" => "invalid"]);
        }
        break;
    default:
        echo json_encode(["result" => "invalid request"]);
        break;
}

?>