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

require_once '../models/ingredientes.model.php';
error_reporting(0);
$ingredientes = new Ingredientes;

switch ($_GET["op"]) 
{
  
case 'todos':
$datos = array();
$datos = $ingredientes->todos();
while ($row = mysqli_fetch_assoc($datos))
{
    $todos[] = $row;
}
echo json_encode($todos);
break;

case 'uno':
    $Ingrediente_id = $_POST["Ingrediente_id"];
    $datos = array();
    $datos = $ingredientes->uno($id>Ingredientes);
    $res = mysqli_fetch_assoc($datos);
    echo json_encode($res);
    break;

case 'insertar':
        $Nombre = $_POST["Nombre"];
        $Cantidad= $_POST["Cantidad"];
        $Unidad = $_POST["Unidad"];
        $Calorias = $_POST["Calorias"];
        $datos = array();
        $datos = $ingredientes->insertar($Nombre, $Cantidad, $Unidad, $Calorias);
        echo json_encode($datos);
        break;

case 'actualizar':
        $Nombre = $_POST["Nombre"];
        $Cantidad= $_POST["Cantidad"];
        $Unidad = $_POST["Unidad"];
        $Calorias = $_POST["Calorias"];
        $datos = array();
        $datos = $ingredientes->actualizar($Nombre, $Cantidad, $Unidad, $Calorias);
        echo json_encode($datos);
        break;
    
case 'eliminar':
            $Ingrediente_id = $_POST["Ingrediente_id"];
            $datos = array();
            $datos = $ingredientes->eliminar($Ingrediente_id);
            echo json_encode($datos);
            break;
}
?>