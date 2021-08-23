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
if ($dataCategorias = $categoria->readMes()) {
    // Se recorren los registros ($dataCategorias) fila por fila ($rowCategoria).
    foreach ($dataCategorias as $rowCategoria) {
        // Se establece un color de relleno para mostrar el nombre de la categoría.
        $pdf->SetFillColor(102, 153, 255);
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Roboto-Bold', 'B', 12);
        $pdf->SetTextColor(255);

        if (($rowCategoria['mes'])==1) {
            $pdf->Cell(0, 10, utf8_decode('Enero'), 1, 1, 'C', 1);
        }
       
        else if(($rowCategoria['mes'])==2){
            $pdf->Cell(0, 10, utf8_decode('Febrero'), 1, 1, 'C', 1);

        }
        else if(($rowCategoria['mes'])==3){
            $pdf->Cell(0, 10, utf8_decode('Marzo'), 1, 1, 'C', 1);

        }
        else if(($rowCategoria['mes'])==4){
            $pdf->Cell(0, 10, utf8_decode('Abril'), 1, 1, 'C', 1);

        }
        else if(($rowCategoria['mes'])==5){
            $pdf->Cell(0, 10, utf8_decode('Mayo'), 1, 1, 'C', 1);

        }
        else if(($rowCategoria['mes'])==6){
            $pdf->Cell(0, 10, utf8_decode('Junio'), 1, 1, 'C', 1);

        }
        else if(($rowCategoria['mes'])==7){
            $pdf->Cell(0, 10, utf8_decode('Julio'), 1, 1, 'C', 1);

        }
        else if(($rowCategoria['mes'])==8){
            $pdf->Cell(0, 10, utf8_decode('Agosto'), 1, 1, 'C', 1);

        }
        else if(($rowCategoria['mes'])==9){
            $pdf->Cell(0, 10, utf8_decode('Septiembre'), 1, 1, 'C', 1);

        }
        else if(($rowCategoria['mes'])==10){
            $pdf->Cell(0, 10, utf8_decode('Octubre'), 1, 1, 'C', 1);

        }
        else if(($rowCategoria['mes'])==11){
            $pdf->Cell(0, 10, utf8_decode('Noviembre'), 1, 1, 'C', 1);

        }
        else if(($rowCategoria['mes'])==12){
            $pdf->Cell(0, 10, utf8_decode('Diciembre'), 1, 1, 'C', 1);

        }
        // Se imprime una celda con el nombre de la categoría.
        // Se establece la categoría para obtener sus productos, de lo contrario se imprime un mensaje de error.
        if ($categoria->setIdResidente($rowCategoria['mes'])) {
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
                $pdf->Cell(0, 10, utf8_decode('No hay datos para mostrar'), 1, 1);
            }
        } else {

            $pdf->SetFont('Roboto-Bold', 'B', 11);
            $pdf->SetTextColor(9, 9, 9);
            $pdf->Cell(0, 10, utf8_decode('Mes incorrecto o inexistente'), 1, 1);
        }
    }
} else {
    $pdf->SetFont('Roboto-Bold', 'B', 11);
    $pdf->SetTextColor(9, 9, 9);
    $pdf->Cell(0, 10, utf8_decode('No hay Meses para mostrar'), 1, 1);
}


// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
