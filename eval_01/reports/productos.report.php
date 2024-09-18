<?php
require('fpdf/fpdf.php'); 
require_once('../models/productos.model.php'); 

$productosModel = new Productos();
$datosProductos = $productosModel->todos();

if ($datosProductos) {
    
    $pdf = new FPDF('L', 'mm', 'A4'); // 'L' indica landscape (horizontal)
    $pdf->AddPage();
    
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, mb_convert_encoding('REPORTE DE PRODUCTOS', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, mb_convert_encoding('KONECTADOS GROUP', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
    $pdf->Ln(10);

    $ancho_nombre = 60;
    $ancho_descripcion = 90;
    $ancho_precio = 40;
    $ancho_stock = 30;
    $ancho_proveedor = 50;
    $ancho_total = $ancho_nombre + $ancho_descripcion + $ancho_precio + $ancho_stock + $ancho_proveedor;
    $margen_izquierdo = (297 - $ancho_total) / 2; // Cambiamos el ancho de la página a 297 mm para A4 horizontal

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetX($margen_izquierdo);
    $pdf->Cell($ancho_nombre, 10, mb_convert_encoding('Nombre', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
    $pdf->Cell($ancho_descripcion, 10, mb_convert_encoding('Descripcion', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
    $pdf->Cell($ancho_precio, 10, 'Precio', 1, 0, 'C');
    $pdf->Cell($ancho_stock, 10, 'Stock', 1, 0, 'C');
    $pdf->Cell($ancho_proveedor, 10, mb_convert_encoding('Proveedor', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C');

    while ($producto = mysqli_fetch_assoc($datosProductos)) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetX($margen_izquierdo);
        $pdf->Cell($ancho_nombre, 10, mb_convert_encoding($producto['nombre'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $pdf->Cell($ancho_descripcion, 10, mb_convert_encoding($producto['descripcion'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $pdf->Cell($ancho_precio, 10, number_format($producto['precio'], 2), 1, 0, 'C');
        $pdf->Cell($ancho_stock, 10, $producto['stock'], 1, 0, 'C');
        $pdf->Cell($ancho_proveedor, 10, $producto['idProveedores'], 1, 1, 'C');
    }

    $pdf->Output();
    
} else {
    echo "Error: No se encontraron productos.";
}
?>
