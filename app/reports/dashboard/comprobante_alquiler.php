<?php
require('../../helpers/report.php');
require('../../models/alquileres.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Comprobante de alquiler');
// Se instancia el módelo Categorías para obtener los datos.
$categoria = new Alquileres;

if ($dataProductos2 = $categoria->readAlquilerDatos()) {
    foreach ($dataProductos2 as $rowProducto2) {
        // Se establece un color de relleno para los encabezados.
        $pdf->SetFillColor(225);
        // Se establece la fuente para los encabezados.
        $pdf->SetFont('Roboto-Bold', 'B', 10);
        // Se establece el color del texto 
        $pdf->SetTextColor(9,9,9);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(70, 6, utf8_decode('Creador del alquiler'), 1, 0, 'C', 1);
        // Se imprimen las celdas con los datos de los productos.
        $pdf->Cell(115, 6, utf8_decode($rowProducto2['usuario']), 1, 1);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(70, 6, utf8_decode('Residente solicitante'), 1, 0, 'C', 1);
        // Se imprimen las celdas con los datos de los productos.
        $pdf->Cell(115, 6, utf8_decode($rowProducto2['residente']), 1, 1);
        // Se establece el espacio entre elementos 
        $pdf->Ln(0);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(70, 6, utf8_decode('Espacio selecccionado'), 1, 0, 'C', 1);
        // Se imprimen las celdas con los datos de los productos.
        $pdf->Cell(115, 6, utf8_decode($rowProducto2['nombre']), 1, 1);
        // Se establece el espacio entre elementos 
        $pdf->Ln(0);        
      
    }
} else {
    $pdf->SetTextColor(9,9,9);
    $pdf->Cell(0, 10, utf8_decode('No hay datos para mostrar'), 1, 1);
}
    // Se establece el espacio entre elementos 
    $pdf->Ln(10);    
    $pdf->SetFillColor(102, 153, 255);
    // Se establece la fuente para el nombre de la categoría.
    $pdf->SetFont('Roboto-Bold', 'B', 12);
    $pdf->SetTextColor(255);
    // Se imprime una celda con el nombre de la categoría.
    $pdf->Cell(0, 10, utf8_decode('Detalles del alquiler'), 1, 1, 'C', 1);
    // Se establece la categoría para obtener sus productos, de lo contrario se imprime un mensaje de error.
    if ($dataProductos = $categoria->readReportAlquiler()) {
        // Se establece un color de relleno para los encabezados.
        $pdf->SetFillColor(225);
        // Se establece la fuente para los encabezados.
        $pdf->SetFont('Roboto-Bold', 'B', 11);
        $pdf->SetTextColor(9,9,9);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(35, 10, utf8_decode('Hora de inicio'), 1, 0, 'C', 1);
        $pdf->Cell(35, 10, utf8_decode('Hora de fin'), 1, 0, 'C', 1);
        $pdf->Cell(30, 10, utf8_decode('Fecha'), 1, 0, 'C', 1);
        $pdf->Cell(50, 10, utf8_decode('Estado del alquiler'), 1, 0, 'C', 1);
        $pdf->Cell(35.9, 10, utf8_decode('Precio'), 1, 1, 'C', 1);
        // Se establece la fuente para los datos de los productos.
        $pdf->SetFont('Roboto-Regular', '', 11);
        // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
        foreach ($dataProductos as $rowProducto) {
            // Se imprimen las celdas con los datos de los productos.
            $pdf->SetTextColor(9,9,9);
            $pdf->Cell(35, 10, utf8_decode($rowProducto['horainicio']), 1, 0,'C');
            $pdf->Cell(35, 10, utf8_decode($rowProducto['horafin']), 1, 0,'C');
            $pdf->Cell(30, 10, utf8_decode($rowProducto['fecha']), 1, 0,'C');
            $pdf->Cell(50, 10, utf8_decode($rowProducto['estadoalquiler']), 1, 0,'C');
            $pdf->Cell(35.9, 10, utf8_decode($rowProducto['precio']), 1, 1,'C');
        }
    } else {
        $pdf->SetFont('Roboto-Bold', 'B', 11);
        $pdf->SetTextColor(9,9,9);
        $pdf->Cell(0, 10, utf8_decode('No hay productos para mostrar'), 1, 1);
    }
// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>