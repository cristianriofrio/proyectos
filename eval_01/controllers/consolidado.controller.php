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

    require_once '../models/consolidado.model.php'; // Asegúrate de que esta ruta sea correcta
    error_reporting(0);
    $consolidado = new Consolidado(); // Instancia del modelo Consolidado

    switch ($_GET["op"]) 
    {
        case 'todos':
            $datos = $consolidado->todos();
            $todos = array();
            while ($row = mysqli_fetch_assoc($datos)) {
                $todos[] = $row;
            }
            echo json_encode($todos);
            break;

        case 'uno':
            if (isset($_POST["consolidado_id"])) {
                $consolidado_id = $_POST["consolidado_id"];
                $datos = $consolidado->uno($consolidado_id);
                $res = mysqli_fetch_assoc($datos);
                echo json_encode($res);
            } else {
                echo json_encode(["error" => "Falta el parámetro consolidado_id"]);
            }
            break;

        case 'insertar':
            if (isset($_POST["receta_id"], $_POST["ingrediente_id"], $_POST["cantidad"], $_POST["unidad"])) {
                $receta_id = $_POST["receta_id"];
                $ingrediente_id = $_POST["ingrediente_id"];
                $cantidad = $_POST["cantidad"];
                $unidad = $_POST["unidad"];
                $resultado = $consolidado->insertar($receta_id, $ingrediente_id, $cantidad, $unidad);
                echo json_encode($resultado);
            } else {
                echo json_encode(["error" => "Faltan parámetros necesarios para insertar"]);
            }
            break;
        
        case 'actualizar':
            if (isset($_POST["consolidado_id"], $_POST["receta_id"], $_POST["ingrediente_id"], $_POST["cantidad"], $_POST["unidad"])) {
                $consolidado_id = $_POST["consolidado_id"];
                $receta_id = $_POST["receta_id"];
                $ingrediente_id = $_POST["ingrediente_id"];
                $cantidad = $_POST["cantidad"];
                $unidad = $_POST["unidad"];
                $resultado = $consolidado->actualizar($consolidado_id, $receta_id, $ingrediente_id, $cantidad, $unidad);
                echo json_encode($resultado);
            } else {
                echo json_encode(["error" => "Faltan parámetros necesarios para actualizar"]);
            }
            break;
        
        case 'eliminar':
            if (isset($_POST["consolidado_id"])) {
                $consolidado_id = $_POST["consolidado_id"];
                $resultado = $consolidado->eliminar($consolidado_id);
                echo json_encode($resultado);
            } else {
                echo json_encode(["error" => "Falta el parámetro consolidado_id"]);
            }
            break;

        default:
            echo json_encode(["error" => "Operación no válida"]);
            break;
    }

?>
