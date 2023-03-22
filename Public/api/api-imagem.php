<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once("../../vendor/autoload.php");
use App\Controller\ImagensController;

$method = $_SERVER["REQUEST_METHOD"];

$data = array();
$data['produto_id'] = $_POST['produto_id'];
$data['imagem'] = $_FILES["file"];



$imagensController = new ImagensController();

switch ($method) {
    case 'POST':
        echo $imagensController->create($data);
        break;
    default:
        echo json_encode(["result" => "invalid request"]);
        break;
}