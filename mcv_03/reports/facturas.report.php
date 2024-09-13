<?php
require('fpdf/fpdf.php'); 
require_once('../models/factura.model.php'); 

if (!isset($_GET['idFactura'])) {
    echo "Error: No se especificó el ID de la factura.";
    exit();
}

$idFactura = intval($_GET['idFactura']);

$facturaModel = new Factura();
$datosFactura = $facturaModel->uno($idFactura); 


if ($datosFactura && $factura = mysqli_fetch_assoc($datosFactura)) {

    
    $pdf = new FPDF();
    $pdf->AddPage();
    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Empresa XYZ', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, 'RUC: 1234567890', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Direccion: Calle Falsa 123, Quito, Ecuador', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Telefono: +593 999 999 999', 0, 1, 'C');
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 10, 'Factura', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, 'No. 001-001-' . str_pad($factura['idFactura'], 9, '0', STR_PAD_LEFT), 0, 1, 'R');
    $pdf->Cell(0, 10, 'Fecha de Emision: ' . $factura['Fecha'], 0, 1, 'R');
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 10, 'Datos del Cliente', 0, 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, 'Nombre: ' . $factura['Nombres'], 0, 1);
    $pdf->Cell(0, 10, 'Cedula/RUC: ' . $factura['Cedula'], 0, 1);
    $pdf->Cell(0, 10, 'Direccion: ' . $factura['Direccion'], 0, 1);
    $pdf->Cell(0, 10, 'Telefono: ' . $factura['Telefono'], 0, 1);
    $pdf->Ln(10);

   
    $productos = $facturaModel->productosPorFactura($idFactura);

   
    if ($productos) {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 10, 'Descripcion', 1);
        $pdf->Cell(30, 10, 'Cantidad', 1);
        $pdf->Cell(30, 10, 'Precio Unitario', 1);
        $pdf->Cell(30, 10, 'Subtotal', 1);
        $pdf->Cell(30, 10, 'IVA (12%)', 1);
        $pdf->Cell(30, 10, 'Total', 1);
        $pdf->Ln();

        while ($producto = mysqli_fetch_assoc($productos)) {
            $pdf->Cell(50, 10, $producto['DESCRIPCION'], 1);
            $pdf->Cell(30, 10, $producto['CANTIDAD'], 1);
            $pdf->Cell(30, 10, number_format($producto['PRECIOUNITARIO'], 2), 1);
            $pdf->Cell(30, 10, number_format($producto['SUBTOTAL'], 2), 1);
            $pdf->Cell(30, 10, number_format($producto['IVA'], 2), 1);
            $pdf->Cell(30, 10, number_format($producto['TOTAL'], 2), 1);
            $pdf->Ln();
        }
    } else {
        $pdf->Cell(0, 10, 'No hay productos asociados a esta factura.', 1, 1, 'C');
    }

    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(120, 10, '', 0);
    $pdf->Cell(30, 10, 'Subtotal:', 1);
    $pdf->Cell(30, 10, number_format($factura['Sub_total'], 2), 1);
    $pdf->Ln();
    $pdf->Cell(120, 10, '', 0);
    $pdf->Cell(30, 10, 'IVA (12%):', 1);
    $pdf->Cell(30, 10, number_format($factura['Sub_total_iva'], 2), 1);
    $pdf->Ln();
    $pdf->Cell(120, 10, '', 0);
    $pdf->Cell(30, 10, 'Total a Pagar:', 1);
    $pdf->Cell(30, 10, number_format($factura['Sub_total'] + $factura['Sub_total_iva'], 2), 1);
    
$pdf->Output();
    
} else {
    echo "Error: No se encontró la factura.";
}
    
?>
