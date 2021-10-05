<?php
require('../../helpers/report.php');
require('../../helpers/wordwrap.php');
require('../../models/visitas.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Visitas de la semana');

// Se instancia el módelo Categorías para obtener los datos.
$tipo = new Visitas;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataTipo = $tipo->readEstadoVisita()) {
    // Se recorren los registros ($dataCategorias) fila por fila ($rowCategoria).
    foreach ($dataTipo as $rowTipo) {
        // Se establece un color de relleno para mostrar el nombre de la categoría.
        $pdf->SetFillColor(102, 153, 255);
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Roboto-Bold', 'B', 12);
        $pdf->SetTextColor(255);
        // Se imprime una celda con el nombre de la categoría.
        $pdf->Cell(0, 10, utf8_decode('Estado de la visita: '.$rowTipo['estadovisita']), 1, 1, 'C', 1);
        // Se establece la categoría para obtener sus productos, de lo contrario se imprime un mensaje de error.
        if ($tipo->setIdEstadoVisita($rowTipo['idestadovisita'])) {
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataEmpleados = $tipo->visitasSemanales()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                // Se establece la fuente para los encabezados.
                $pdf->SetFont('Roboto-Bold', 'B', 11);
                $pdf->SetTextColor(9,9,9);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(65, 10, utf8_decode('Residente'), 1, 0, 'C', 1);
                $pdf->Cell(35, 10, utf8_decode('Visita recurrente'), 1, 0, 'C', 1);
                $pdf->Cell(22, 10, utf8_decode('Fecha'), 1, 0, 'C', 1);
                $pdf->Cell(63.9, 10, utf8_decode('Visitante'), 1, 1, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Roboto-Regular', '', 11);
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataEmpleados as $rowEmpleados) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->Cell(65, 10, utf8_decode($rowEmpleados['residente']), 1, 0,'C');
                    $pdf->Cell(35, 10, utf8_decode($rowEmpleados['visitarecurrente']), 1, 0,'C');
                    $pdf->Cell(22, 10, utf8_decode($rowEmpleados['fecha']), 1, 0,'C');
                    $pdf->Cell(63.9, 10, $rowEmpleados['visitante'], 1, 1,'C');
                }

                $pdf->Ln(10);    

            } else {
                $pdf->SetFont('Roboto-Bold', 'B', 11);
                $pdf->SetTextColor(9,9,9);
                $pdf->Cell(0, 10, utf8_decode('No hay visitas para este Estado'), 1, 1);
            }
        } else {
        
            $pdf->SetFont('Roboto-Bold', 'B', 11);
            $pdf->SetTextColor(9,9,9);
            $pdf->Cell(0, 10, utf8_decode('Estado incorrecto o inexistente'), 1, 1);
        }
    }
} else {
    $pdf->SetFont('Roboto-Bold', 'B', 11);
    $pdf->SetTextColor(9,9,9);
    $pdf->Cell(0, 10, utf8_decode('No hay Estado para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>