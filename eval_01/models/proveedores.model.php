<?php
require_once '../config/config.php';

class Proveedores
{

    public function todos() 
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM proveedores";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idProveedores)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM proveedores WHERE idProveedores = $idProveedores";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($nombre, $direccion, $telefono, $email) 
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO proveedores (nombre, direccion, telefono, email) VALUES ('$nombre', '$direccion', '$telefono', '$email')";
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

    public function actualizar($idProveedores, $nombre, $direccion, $telefono, $email)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE proveedores SET nombre = '$nombre', direccion = '$direccion', telefono = '$telefono', email = '$email' WHERE idProveedores = $idProveedores";
            if (mysqli_query($con, $cadena)) {
                return $idProveedores; 
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($idProveedores)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM proveedores WHERE idProveedores = $idProveedores";
            if (mysqli_query($con, $cadena)) {
                return 1; 
            } else {
                return "Error al eliminar proveedor: " . mysqli_error($con);
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
