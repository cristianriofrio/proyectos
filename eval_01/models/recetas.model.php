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
        $cadena = "SELECT * FROM `recetas` WHERE `Receta_id`=$Receta_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }
    public function insertar($Nombre, $Descripcion, $Tiempo_preparacion, $Dificultad) 
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `recetas` ( `Nombre`, `Descripcion`, `Tiempo_preparacion`, `Dificultad`) VALUES ('$Nombre','$Descripcion','$Tiempo_preparacion','$Dificultad')";
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

    public function actualizar($Nombre, $Descripcion, $Tiempo_preparacion, $Dificultad)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `recetas` SET `Nombre`='$Nombre',`Descripcion='$Descripcion',`Tiempo_preparacion,`='$Tiempo_preparacion,',`Dificultad`='$Dificultad' WHERE `Receta_id` = $Receta_id";
            if (mysqli_query($con, $cadena)) {
                return $Receta_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    
    public function eliminar($Receta_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `recetas` WHERE `Receta_id`= $Receta_id";
            
            if (mysqli_query($con, $cadena)) {
                return 1;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
}