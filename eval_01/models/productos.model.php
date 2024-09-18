<?php
require_once '../config/config.php';

class Productos
{
    public function todos() 
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM productos";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idProductos)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM productos WHERE idProductos = $idProductos";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($nombre, $descripcion, $precio, $stock, $idProveedores) 
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO productos (nombre, descripcion, precio, stock, idProveedores) VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$idProveedores')";
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

    public function actualizar($idProductos, $nombre, $descripcion, $precio, $stock, $idProveedores)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', stock = '$stock', idProveedores = '$idProveedores' WHERE idProductos = $idProductos";
            if (mysqli_query($con, $cadena)) {
                return $idProductos; 
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($idProductos)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM productos WHERE idProductos = $idProductos";
            if (mysqli_query($con, $cadena)) {
                return 1; 
            } else {
                return "Error al eliminar producto: " . mysqli_error($con);
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
