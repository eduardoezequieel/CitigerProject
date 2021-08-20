<?php
require('../../helpers/report.php');
require('../../models/empleados.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Empleados por Tipo');

// Se instancia el módelo Categorías para obtener los datos.
$tipo = new Empleados;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataTipo = $tipo->readTipoEmpleado2()) {
    // Se recorren los registros ($dataCategorias) fila por fila ($rowCategoria).
    foreach ($dataTipo as $rowTipo) {
        // Se establece un color de relleno para mostrar el nombre de la categoría.
        $pdf->SetFillColor(102, 153, 255);
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Roboto-Bold', 'B', 12);
        $pdf->SetTextColor(255);
        // Se imprime una celda con el nombre de la categoría.
        $pdf->Cell(0, 10, utf8_decode(''.$rowTipo['tipoempleado']), 1, 1, 'C', 1);
        // Se establece la categoría para obtener sus productos, de lo contrario se imprime un mensaje de error.
        if ($tipo->setIdTipoEmpleado($rowTipo['idtipoempleado'])) {
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataEmpleados = $tipo->empleadoTipo()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                // Se establece la fuente para los encabezados.
                $pdf->SetFont('Roboto-Bold', 'B', 11);
                $pdf->SetTextColor(9,9,9);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(80, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
                $pdf->Cell(25, 10, utf8_decode('DUI'), 1, 0, 'C', 1);
                $pdf->Cell(35, 10, utf8_decode('Telefono'), 1, 0, 'C', 1);
                $pdf->Cell(46, 10, utf8_decode('Estado'), 1, 1, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Roboto-Regular', '', 11);
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataEmpleados as $rowEmpleados) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->Cell(80, 10, utf8_decode($rowEmpleados['nombre']), 1, 0,'C');
                    $pdf->Cell(25, 10, utf8_decode($rowEmpleados['dui']), 1, 0,'C');
                    $pdf->Cell(35, 10, utf8_decode($rowEmpleados['telefono']), 1, 0,'C');
                    $pdf->Cell(46, 10, $rowEmpleados['estadoempleado'], 1, 1,'C');
                }

                $pdf->Ln(10);    

            } else {
                $pdf->SetFont('Roboto-Bold', 'B', 11);
                $pdf->SetTextColor(9,9,9);
                $pdf->Cell(0, 10, utf8_decode('No hay empleados para este tipo'), 1, 1);
            }
        } else {
        
            $pdf->SetFont('Roboto-Bold', 'B', 11);
            $pdf->SetTextColor(9,9,9);
            $pdf->Cell(0, 10, utf8_decode('Tipo incorrecto o inexistente'), 1, 1);
        }
    }
} else {
    $pdf->SetFont('Roboto-Bold', 'B', 11);
    $pdf->SetTextColor(9,9,9);
    $pdf->Cell(0, 10, utf8_decode('No hay tipos para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>