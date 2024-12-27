<?php
require_once 'Database.php';
require_once 'Product.php';

$database = new Database();
$db = $database->connect();

$product = new Product($db);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        $product->name = $data->name;
        $product->price = $data->price;
        $product->stock = $data->stock;
        if ($product->create()) {
            echo json_encode(["message" => "Product created successfully."]);
        }
        break;

    case 'GET':
        $stmt = $product->read();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($products);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));
        $product->id = $data->id;
        $product->name = $data->name;
        $product->price = $data->price;
        $product->stock = $data->stock;
        if ($product->update()) {
            echo json_encode(["message" => "Product updated successfully."]);
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"));
        $product->id = $data->id;
        if ($product->delete()) {
            echo json_encode(["message" => "Product deleted successfully."]);
        }
        break;
}
?>
