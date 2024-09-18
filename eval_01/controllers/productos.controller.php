<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}

require_once '../models/productos.model.php';
error_reporting(0);
$productos = new Productos;

switch ($_GET["op"]) 
{
    case 'todos':
        $datos = $productos->todos();
        $todos = array();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $idProductos = $_POST["idProductos"];
        $datos = $productos->uno($idProductos);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $stock = $_POST["stock"];
        $idProveedores = $_POST["idProveedores"];
        $datos = $productos->insertar($nombre, $descripcion, $precio, $stock, $idProveedores);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $idProductos = $_POST["idProductos"];
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $stock = $_POST["stock"];
        $idProveedores = $_POST["idProveedores"];
        $datos = $productos->actualizar($idProductos, $nombre, $descripcion, $precio, $stock, $idProveedores);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $idProductos = $_POST["idProductos"];
        $datos = $productos->eliminar($idProductos);
        echo json_encode($datos);
        break;
}
?>
