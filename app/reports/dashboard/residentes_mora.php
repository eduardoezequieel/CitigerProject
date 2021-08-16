<?php
require('../../helpers/report.php');
require('../../models/residentes.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Casas con Mora');

// Se instancia el módelo Categorías para obtener los datos.
$categoria = new Residentes;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.

$pdf->SetFillColor(102, 153, 255);
// Se establece la fuente para el nombre de la categoría.
$pdf->SetFont('Roboto-Bold', 'B', 12);
$pdf->SetTextColor(255);
// Se imprime una celda con el nombre de la categoría.
$pdf->Cell(0, 10, ('Listado'), 1, 1, 'C', 1);
// Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
if ($dataProductos = $categoria->residentesMora()) {
    // Se establece un color de relleno para los encabezados.
    $pdf->SetFillColor(225);
    // Se establece la fuente para los encabezados.
    $pdf->SetFont('Roboto-Bold', 'B', 11);
    $pdf->SetTextColor(9, 9, 9);
    // Se imprimen las celdas con los encabezados.
    $pdf->Cell(80, 10, utf8_decode('Residente'), 1, 0, 'C', 1);
    $pdf->Cell(60, 10, utf8_decode('Casa'), 1, 0, 'C', 1);
    $pdf->Cell(46, 10, utf8_decode('Fecha'), 1, 1, 'C', 1);
    // Se establece la fuente para los datos de los productos.
    $pdf->SetFont('Roboto-Regular', '', 11);
    // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
    foreach ($dataProductos as $rowProducto) {
        // Se imprimen las celdas con los datos de los productos.
        $pdf->Cell(80, 10, utf8_decode($rowProducto['residente']), 1, 0, 'C');
        $pdf->Cell(60, 10, utf8_decode($rowProducto['casa']), 1, 0, 'C');
        $pdf->Cell(46, 10, utf8_decode($rowProducto['fechapago']), 1, 1, 'C');
    }

    $pdf->Ln(10);
} else {
    $pdf->SetFont('Roboto-Bold', 'B', 11);
    $pdf->SetTextColor(9, 9, 9);
    $pdf->Cell(0, 10, utf8_decode('No hay datos'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
