<?php
require('../../helpers/report.php');
require('../../models/alquileres.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Alquileres en un lapso de fechas');
// Se instancia el módelo Categorías para obtener los datos.
$categoria = new Alquileres;

// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataCategorias = $categoria->readReportCabecera()) {
    // Se recorren los registros ($dataCategorias) fila por fila ($rowCategoria).
    foreach ($dataCategorias as $rowCategoria) {
        // Se establece un color de relleno para mostrar el nombre de la categoría.
        $pdf->SetFillColor(102, 153, 255);
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Roboto-Bold', 'B', 12);
        $pdf->SetTextColor(255);
        // Se imprime una celda con el nombre de la categoría.
        $pdf->Cell(0, 10, utf8_decode(''.$rowCategoria['nombre']), 1, 1, 'C', 1);
        // Se establece la categoría para obtener sus productos, de lo contrario se imprime un mensaje de error.
        if ($categoria->setIdEspacio($rowCategoria['idespacio'])) {
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataProductos = $categoria->readReport()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                // Se establece la fuente para los encabezados.
                $pdf->SetFont('Roboto-Bold', 'B', 11);
                $pdf->SetTextColor(9,9,9);
                $pdf->Cell(75, 10, utf8_decode('Residente'), 1, 0, 'C', 1);
                $pdf->Cell(35, 10, utf8_decode('Fecha de alquiler'), 1, 0, 'C', 1);
                $pdf->Cell(25, 10, utf8_decode('Hora inicio'), 1, 0, 'C', 1);
                $pdf->Cell(25, 10, utf8_decode('Hora fin'), 1, 0, 'C', 1);
                $pdf->Cell(25.9, 10, utf8_decode('Estado'), 1, 1, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Roboto-Regular', '', 11);
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataProductos as $rowProducto) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->Cell(75, 10, utf8_decode($rowProducto['residente']), 1, 0,'C');
                    $pdf->Cell(35, 10, utf8_decode($rowProducto['fecha']), 1, 0,'C');
                    $pdf->Cell(25, 10, utf8_decode($rowProducto['horainicio']), 1, 0,'C');
                    $pdf->Cell(25, 10, utf8_decode($rowProducto['horafin']), 1, 0,'C');
                    $pdf->Cell(25.9, 10, utf8_decode($rowProducto['estadoalquiler']), 1, 1,'C');
                }

                $pdf->Ln(10);    

            } else {
                $pdf->SetFont('Roboto-Bold', 'B', 11);
                $pdf->SetTextColor(9,9,9);
                $pdf->Cell(0, 10, utf8_decode('No hay alquileres para esta espacio'), 1, 1);
            }
        } else {
        
            $pdf->SetFont('Roboto-Bold', 'B', 11);
            $pdf->SetTextColor(9,9,9);
            $pdf->Cell(0, 10, utf8_decode('Espacio incorrecto o inexistente'), 1, 1);
        }
    }
} else {
    $pdf->SetFont('Roboto-Bold', 'B', 11);
    $pdf->SetTextColor(9,9,9);
    $pdf->Cell(0, 10, utf8_decode('No hay espacios para mostrar'), 1, 1);
}
// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
