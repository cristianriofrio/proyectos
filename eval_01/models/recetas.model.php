<?php
require_once('../config/config.php');
class Recetas
{
    public function todos() 
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `recetas`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($Receta_id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $Receta_id = mysqli_real_escape_string($con, $Receta_id);
        $cadena = "SELECT * FROM `recetas` WHERE `Receta_id` = '$Receta_id'";
        $datos = mysqli_query($con, $cadena);

        if ($datos && mysqli_num_rows($datos) > 0) {
            $result = mysqli_fetch_assoc($datos);
        } else {
            $result = null; // Devolver null si no se encuentra la receta
        }

        $con->close();
        return $result;
    }


    public function insertar($Nombre, $Descripcion, $Tiempo_preparacion, $Dificultad) 
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `recetas` (`Nombre`, `Descripcion`, `Tiempo_preparacion`, `Dificultad`) VALUES ('$Nombre','$Descripcion','$Tiempo_preparacion','$Dificultad')";
            if (mysqli_query($con, $cadena)) {
                return mysqli_insert_id($con);
            } else {
                return mysqli_error($con);
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            if ($con) {
                $con->close();
            }
        }
    }

    public function actualizar($Receta_id, $Nombre, $Descripcion, $Tiempo_preparacion, $Dificultad)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `recetas` SET `Nombre`='$Nombre', `Descripcion`='$Descripcion', `Tiempo_preparacion`='$Tiempo_preparacion', `Dificultad`='$Dificultad' WHERE `Receta_id` = $Receta_id";
            if (mysqli_query($con, $cadena)) {
                return $Receta_id;
            } else {
                return mysqli_error($con);
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            if ($con) {
                $con->close();
            }
        }
    }
    
    public function eliminar($Receta_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();

            // Eliminar registros en la tabla consolidado que dependan de la receta
            $cadenaDependencias = "DELETE FROM `consolidado` WHERE `receta_id` = $Receta_id";
            if (!mysqli_query($con, $cadenaDependencias)) {
                return "Error al eliminar dependencias: " . mysqli_error($con);
            }

            // Eliminar la receta
            $cadena = "DELETE FROM `recetas` WHERE `Receta_id` = $Receta_id";
            if (mysqli_query($con, $cadena)) {
                return 1;
            } else {
                return "Error al eliminar receta: " . mysqli_error($con);
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
