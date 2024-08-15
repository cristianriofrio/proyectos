<?php

    require_once('../config/config.php');

    class Consolidado {

        public function todos() 
        {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            // Consulta para obtener todos los registros de la tabla consolidado
            $cadena = "SELECT * FROM `consolidado`";
            $datos = mysqli_query($con, $cadena);
            $con->close();
            return $datos;
        }
        
        public function uno($consolidado_id)
        {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "SELECT * FROM `consolidado` WHERE `consolidado_id` = $consolidado_id";
            $datos = mysqli_query($con, $cadena);
            $con->close();
            return $datos;
        }

        public function insertar($receta_id, $ingrediente_id, $cantidad, $unidad) 
        {
            try {
                $con = new ClaseConectar();
                $con = $con->ProcedimientoParaConectar();
                $cadena = "INSERT INTO `consolidado` (`receta_id`, `ingrediente_id`, `cantidad`, `unidad`) VALUES ('$receta_id', '$ingrediente_id', '$cantidad', '$unidad')";
                if (mysqli_query($con, $cadena)) {
                    return mysqli_insert_id($con); // Devuelve el ID del nuevo registro insertado
                } else {
                    return "Error: " . mysqli_error($con);
                }
            } catch (Exception $th) {
                return $th->getMessage();
            } finally {
                $con->close();
            }
        }

        public function actualizar($consolidado_id, $receta_id, $ingrediente_id, $cantidad, $unidad)
        {
            try {
                $con = new ClaseConectar();
                $con = $con->ProcedimientoParaConectar();
                $cadena = "UPDATE `consolidado` SET `receta_id` = '$receta_id', `ingrediente_id` = '$ingrediente_id', `cantidad` = '$cantidad', `unidad` = '$unidad' WHERE `consolidado_id` = $consolidado_id";
                if (mysqli_query($con, $cadena)) {
                    return $consolidado_id;
                } else {
                    return "Error: " . mysqli_error($con);
                }
            } catch (Exception $th) {
                return $th->getMessage();
            } finally {
                $con->close();
            }
        }

        public function eliminar($consolidado_id)
        {
            try {
                $con = new ClaseConectar();
                $con = $con->ProcedimientoParaConectar();
                $cadena = "DELETE FROM `consolidado` WHERE `consolidado_id` = $consolidado_id";
                if (mysqli_query($con, $cadena)) {
                    return 1; // Retorna 1 si la eliminación fue exitosa
                } else {
                    return "Error: " . mysqli_error($con); // Retorna el mensaje de error si falla
                }
            } catch (Exception $th) {
                return $th->getMessage(); // Retorna el mensaje de excepción si ocurre
            } finally {
                $con->close(); // Cierra la conexión en el bloque finally
            }
        }

    }
?>