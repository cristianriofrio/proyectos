<?php
require('fpdf/fpdf.php');
require_once('../controllers/productos.controller.php');
$pdf = new FPDF();
$pdf->AddPage();

$producto = new Producto();


$pdf->SetFont('Arial','B', 12);
$pdf->Text(30,10,'Title');


$pdf->SetFont('Arial', '', 12);
$texto = "Listado de productos";
$pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $texto), 0, 'J');


$listaproductos = $producto->todos();
$x=0;
$y=35;


$pdf->Cell(10,55,'#',1);
$pdf->Cell(40,55,'Codigo de Barras',1);
$pdf->Cell(55,55,'Nombre',1);
$pdf->Cell(40,55,'IVA',1);

$index=1;
$pdf->Ln();
while ($prod = mysql_fetch_assoc($listaproductos)){
    $pdf->Cell(10, 55, $index,1);
    $pdf->Cell(40,10, $prod["Codigo de Barras"],1);
    $pdf->Cell(55,10, $prod["Nombre"],1);
    $pdf->Cell(40,10, $prod["IVA",1]);
    $pdf->Ln();
    $index++;
}

$pdf->Output();
