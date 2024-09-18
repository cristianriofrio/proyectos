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

require_once '../models/proveedores.model.php';
error_reporting(0);
$proveedores = new Proveedores();

switch ($_GET["op"]) 
{
    case 'todos':
        $datos = $proveedores->todos();
        $todos = array();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $idProveedores = $_POST["idProveedores"];
        $datos = $proveedores->uno($idProveedores);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':
        $nombre = $_POST["nombre"];
        $direccion = $_POST["direccion"];
        $telefono = $_POST["telefono"];
        $email = $_POST["email"];
        $datos = $proveedores->insertar($nombre, $direccion, $telefono, $email);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $idProveedores = $_POST["idProveedores"];
        $nombre = $_POST["nombre"];
        $direccion = $_POST["direccion"];
        $telefono = $_POST["telefono"];
        $email = $_POST["email"];
        $datos = $proveedores->actualizar($idProveedores, $nombre, $direccion, $telefono, $email);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $idProveedores = $_POST["idProveedores"];
        $datos = $proveedores->eliminar($idProveedores);
        echo json_encode($datos);
        break;
}

?>
