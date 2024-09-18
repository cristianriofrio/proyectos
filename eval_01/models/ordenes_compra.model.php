<?php
require_once '../config/config.php';

class Ordenes_Compra
{

    public function todos() 
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM ordenes_compra";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idOrden)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM ordenes_compra WHERE idOrden = $idOrden";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($idProveedores, $fecha_orden, $total) 
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO ordenes_compra (idProveedores, fecha_orden, total) VALUES ('$idProveedores', '$fecha_orden', '$total')";
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

    public function actualizar($idOrden, $idProveedores, $fecha_orden, $total)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE ordenes_compra SET idProveedores = '$idProveedores', fecha_orden = '$fecha_orden', total = '$total' WHERE idOrden = $idOrden";
            if (mysqli_query($con, $cadena)) {
                return $idOrden;  
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($idOrden)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM ordenes_compra WHERE idOrden = $idOrden";
            if (mysqli_query($con, $cadena)) {
                return 1; 
            } else {
                return "Error al eliminar orden de compra: " . mysqli_error($con);
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
