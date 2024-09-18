<?php
require('fpdf/fpdf.php'); 
require_once('../models/proveedores.model.php'); 

$proveedoresModel = new Proveedores();
$datosProveedores = $proveedoresModel->todos();

if ($datosProveedores) {
    
    $pdf = new FPDF();
    $pdf->AddPage();
    
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, mb_convert_encoding('REPORTE DE PROVEEDORES', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, mb_convert_encoding('KONECTADOS GROUP', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
    $pdf->Ln(10);

    $ancho_nombre = 40;
    $ancho_direccion = 50;
    $ancho_telefono = 30;
    $ancho_email = 60;
    $ancho_total = $ancho_nombre + $ancho_direccion + $ancho_telefono + $ancho_email;
    $margen_izquierdo = (210 - $ancho_total) / 2;

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetX($margen_izquierdo);
    $pdf->Cell($ancho_nombre, 10, mb_convert_encoding('Nombre', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
    $pdf->Cell($ancho_direccion, 10, mb_convert_encoding('Direccion', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
    $pdf->Cell($ancho_telefono, 10, 'Telefono', 1, 0, 'C');
    $pdf->Cell($ancho_email, 10, 'Correo Electronico', 1, 1, 'C');

    while ($proveedor = mysqli_fetch_assoc($datosProveedores)) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetX($margen_izquierdo);
        $pdf->Cell($ancho_nombre, 10, mb_convert_encoding($proveedor['nombre'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $pdf->Cell($ancho_direccion, 10, mb_convert_encoding($proveedor['direccion'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $pdf->Cell($ancho_telefono, 10, $proveedor['telefono'], 1, 0, 'C');
        $pdf->Cell($ancho_email, 10, $proveedor['email'], 1, 1, 'C');
    }

    $pdf->Output();
    
} else {
    echo "Error: No se encontraron proveedores.";
}
?>
