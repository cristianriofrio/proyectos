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

require_once '../models/ordenes_compra.model.php';
error_reporting(0);
$ordenes_compra = new Ordenes_Compra;

switch ($_GET["op"]) 
{
    case 'todos':
        $datos = $ordenes_compra->todos();
        $todos = array();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $idOrden = $_POST["idOrden"];
        $datos = $ordenes_compra->uno($idOrden);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':
        $idProveedores = $_POST["idProveedores"];
        $fecha_orden = $_POST["fecha_orden"];
        $total = $_POST["total"];
        $datos = $ordenes_compra->insertar($idProveedores, $fecha_orden, $total);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $idOrden = $_POST["idOrden"];
        $idProveedores = $_POST["idProveedores"];
        $fecha_orden = $_POST["fecha_orden"];
        $total = $_POST["total"];
        $datos = $ordenes_compra->actualizar($idOrden, $idProveedores, $fecha_orden, $total);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $idOrden = $_POST["idOrden"];
        $datos = $ordenes_compra->eliminar($idOrden);
        echo json_encode($datos);
        break;
}
?>
