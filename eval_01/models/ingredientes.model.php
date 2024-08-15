<?php
require_once '../config/config.php';

class Ingredientes
{
    public function todos() 
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM ingredientes";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($Ingrediente_id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM ingredientes WHERE ingrediente_id = $Ingrediente_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Nombre, $Cantidad, $Unidad, $Calorias) 
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO ingredientes (Nombre, Cantidad, Unidad, Calorias) VALUES ('$Nombre', '$Cantidad', '$Unidad', '$Calorias')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }


    public function actualizar($Ingrediente_id, $Nombre, $Cantidad, $Unidad, $Calorias)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE ingredientes SET Nombre = '$Nombre', Cantidad = '$Cantidad', Unidad = '$Unidad', Calorias = '$Calorias' WHERE Ingrediente_id = $Ingrediente_id";
            if (mysqli_query($con, $cadena)) {
                return $Ingrediente_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($Ingrediente_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();

            // Eliminar registros en la tabla consolidado que dependan del ingrediente
            $cadenaDependencias = "DELETE FROM `consolidado` WHERE `ingrediente_id` = $Ingrediente_id";
            if (!mysqli_query($con, $cadenaDependencias)) {
                return "Error al eliminar dependencias: " . mysqli_error($con);
            }

            // Eliminar el ingrediente
            $cadena = "DELETE FROM `ingredientes` WHERE `Ingrediente_id` = $Ingrediente_id";
            if (mysqli_query($con, $cadena)) {
                return 1;
            } else {
                return "Error al eliminar ingrediente: " . mysqli_error($con);
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            if ($con) {
                $con->close();
            }
        }
    }

}
?>