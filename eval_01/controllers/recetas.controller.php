<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

require_once('../models/recetas.model.php');
error_reporting(0);
$recetas = new Recetas;

switch ($_GET["op"]) 
{
  
case 'todos':
$datos = array();
$datos = $recetas->todos();
while ($row = mysqli_fetch_assoc($datos))
{
    $todos[] = $row;
}
echo json_encode($todos);
break;

case 'uno':
    $Recetas_id = $_POST["Recetas_id"];
    $datos = array();
    $datos = $recetas->uno($id>Recetas);
    $res = mysqli_fetch_assoc($datos);
    echo json_encode($res);
    break;

case 'insertar':
        $Nombre = $_POST["Nombre"];
        $Descripcion = $_POST["Descripcion"];
        $Tiempo_preparacion = $_POST["Tiempo_preparacion"];
        $Dificultad = $_POST["Dificultad"];
        $datos = array();
        $datos = $recetas->insertar($Nombre, $Descripcion, $Tiempo_preparacion, $Dificultad);
        echo json_encode($datos);
        break;

case 'actualizar':
        $Nombre = $_POST["Nombre"];
        $Descripcion = $_POST["Descripcion"];
        $Tiempo_preparacion = $_POST["Tiempo_preparacion"];
        $Dificultad = $_POST["Dificultad"];
        $datos = array();
        $datos = $recetas->actualizar($Nombre, $Descripcion, $Tiempo_preparacion, $Dificultad);
        echo json_encode($datos);
        break;
    
case 'eliminar':
            $Recetas_id = $_POST["Recetas_id"];
            $datos = array();
            $datos = $recetas->eliminar($Recetas_id);
            echo json_encode($datos);
            break;
}