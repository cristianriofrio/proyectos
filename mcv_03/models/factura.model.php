<?php
// TODO: Clase de Factura Tienda Cel@g
require_once('../config/config.php');

class Factura
{
    public function todos() // select * from factura
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT factura.idFactura, clientes.Nombres, (factura.Sub_total + factura.Sub_total_iva) as total FROM `factura` INNER JOIN clientes on factura.Clientes_idClientes = clientes.idClientes";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idFactura) // select * from factura where id = $idFactura
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `factura` INNER JOIN clientes on factura.Clientes_idClientes = clientes.idClientes WHERE `idFactura` = $idFactura";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Fecha, $Sub_total, $Sub_total_iva, $Valor_IVA, $Clientes_idClientes) // insert into factura (Fecha, Sub_total, Sub_total_iva, Valor_IVA, Clientes_idClientes) values (...)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `factura`(`Fecha`, `Sub_total`, `Sub_total_iva`, `Valor_IVA`, `Clientes_idClientes`) 
                       VALUES ('$Fecha', '$Sub_total', '$Sub_total_iva', '$Valor_IVA', '$Clientes_idClientes')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id; // Return the inserted ID
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function actualizar($idFactura, $Fecha, $Sub_total, $Sub_total_iva, $Valor_IVA, $Clientes_idClientes) // update factura set ... where id = $idFactura
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `factura` SET 
                       `Fecha`='$Fecha',
                       `Sub_total`='$Sub_total',
                       `Sub_total_iva`='$Sub_total_iva',
                       `Valor_IVA`='$Valor_IVA',
                       `Clientes_idClientes`='$Clientes_idClientes'
                       WHERE `idFactura` = $idFactura";
            if (mysqli_query($con, $cadena)) {
                return $idFactura; // Return the updated ID
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($idFactura) // delete from factura where id = $idFactura
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `factura` WHERE `idFactura`= $idFactura";
            if (mysqli_query($con, $cadena)) {
                return 1; // Success
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function productosPorFactura($idFactura)
    {
        try {
            // Conectar a la base de datos
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
    
            // Consulta SQL para obtener los productos relacionados con una factura específica
            $cadena = "SELECT productos.Nombre_Producto DESCRIPCION,
                              KARDEX.CANTIDAD, 
                              KARDEX.Valor_Venta PRECIOUNITARIO,    
                              (KARDEX.CANTIDAD * KARDEX.Valor_Venta) AS SUBTOTAL, 
                              KARDEX.IVA, ((KARDEX.CANTIDAD * KARDEX.Valor_Venta) +  KARDEX.IVA) AS TOTAL
                            FROM KARDEX
                            INNER JOIN productos ON productos.idProductos = kardex.Productos_idProductos
                        WHERE kardex.idKardex = $idFactura";
    
            // Ejecutar la consulta
            $datos = mysqli_query($con, $cadena);
    
            // Cerrar la conexión
            $con->close();
    
            // Retornar los productos
            return $datos;
    
        } catch (Exception $e) {
            // Manejo de errores
            return "Error: " . $e->getMessage();
        }
    }
    
}