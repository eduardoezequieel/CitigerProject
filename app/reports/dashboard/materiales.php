<?php
require('../../helpers/report.php');
require('../../models/inventario.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Materiales por categoría');

// Se instancia el módelo Categorías para obtener los datos.
$categoria = new Inventario;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataCategorias = $categoria->readCategoria2()) {
    // Se recorren los registros ($dataCategorias) fila por fila ($rowCategoria).
    foreach ($dataCategorias as $rowCategoria) {
        // Se establece un color de relleno para mostrar el nombre de la categoría.
        $pdf->SetFillColor(102, 153, 255);
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Roboto-Bold', 'B', 12);
        $pdf->SetTextColor(255);
        // Se imprime una celda con el nombre de la categoría.
        $pdf->Cell(0, 10, utf8_decode(''.$rowCategoria['categoria']), 1, 1, 'C', 1);
        // Se establece la categoría para obtener sus productos, de lo contrario se imprime un mensaje de error.
        if ($categoria->setIdCategoria($rowCategoria['idcategoria'])) {
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataProductos = $categoria->readMaterialesCategoria()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                // Se establece la fuente para los encabezados.
                $pdf->SetFont('Roboto-Bold', 'B', 11);
                $pdf->SetTextColor(9,9,9);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(80, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
                $pdf->Cell(20, 10, utf8_decode('Cantidad'), 1, 0, 'C', 1);
                $pdf->Cell(40, 10, utf8_decode('Unidad de medida'), 1, 0, 'C', 1);
                $pdf->Cell(46, 10, utf8_decode('Precio (US$)'), 1, 1, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Roboto-Regular', '', 11);
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataProductos as $rowProducto) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->Cell(80, 10, utf8_decode($rowProducto['producto']), 1, 0,'C');
                    $pdf->Cell(20, 10, utf8_decode($rowProducto['cantidad']), 1, 0,'C');
                    $pdf->Cell(40, 10, utf8_decode($rowProducto['unidadmedida']), 1, 0,'C');
                    $pdf->Cell(46, 10, '$'.$rowProducto['costo'], 1, 1,'C');
                }

                $pdf->Ln(10);    

            } else {
                $pdf->SetFont('Roboto-Bold', 'B', 11);
                $pdf->SetTextColor(9,9,9);
                $pdf->Cell(0, 10, utf8_decode('No hay productos para esta categoría'), 1, 1);
            }
        } else {
        
            $pdf->SetFont('Roboto-Bold', 'B', 11);
            $pdf->SetTextColor(9,9,9);
            $pdf->Cell(0, 10, utf8_decode('Categoría incorrecta o inexistente'), 1, 1);
        }
    }
} else {
    $pdf->SetFont('Roboto-Bold', 'B', 11);
    $pdf->SetTextColor(9,9,9);
    $pdf->Cell(0, 10, utf8_decode('No hay categorías para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>