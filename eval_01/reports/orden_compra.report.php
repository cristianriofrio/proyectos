<?php
require('fpdf/fpdf.php'); 
require_once('../models/ordenes_compra.model.php'); 

$ordenesModel = new Ordenes_Compra();
$datosOrdenes = $ordenesModel->todos();

if ($datosOrdenes) {
    
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();
    
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, mb_convert_encoding('Reporte de Órdenes de Compra', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, mb_convert_encoding('Generado por: Empresa XYZ', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
    $pdf->Ln(10);

    $ancho_id = 30;
    $ancho_proveedor = 50;
    $ancho_fecha = 50;
    $ancho_total = 40;
    $ancho_total_ancho = $ancho_id + $ancho_proveedor + $ancho_fecha + $ancho_total;
    $margen_izquierdo = (297 - $ancho_total_ancho) / 2;

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetX($margen_izquierdo);
    $pdf->Cell($ancho_id, 10, 'ID Orden', 1, 0, 'C');
    $pdf->Cell($ancho_proveedor, 10, 'Proveedor', 1, 0, 'C');
    $pdf->Cell($ancho_fecha, 10, 'Fecha', 1, 0, 'C');
    $pdf->Cell($ancho_total, 10, 'Total', 1, 1, 'C');

    while ($orden = mysqli_fetch_assoc($datosOrdenes)) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetX($margen_izquierdo);

        // Depurar si el nombre del proveedor está vacío
        if (empty($orden['proveedor'])) {
            $orden['proveedor'] = 'Proveedor Desconocido'; // Mostrar mensaje si el nombre del proveedor no está disponible
        }

        $pdf->Cell($ancho_id, 10, $orden['idOrden'], 1, 0, 'C');
        $pdf->Cell($ancho_proveedor, 10, mb_convert_encoding($orden['proveedor'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $pdf->Cell($ancho_fecha, 10, $orden['fecha_orden'], 1, 0, 'C');
        $pdf->Cell($ancho_total, 10, number_format($orden['total'], 2), 1, 1, 'C');
    }

    $pdf->Output();
    
} else {
    echo "Error: No se encontraron órdenes de compra.";
}
?>
