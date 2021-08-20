<?php
require('../../helpers/report.php');
require('../../models/pedidos.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Pedidos por Estado');

// Se instancia el módelo Categorías para obtener los datos.
$estado = new Pedidos;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataEstado = $estado->readEstadoPedido2()) {
    // Se recorren los registros ($dataCategorias) fila por fila ($rowCategoria).
    foreach ($dataEstado as $rowEstado) {
        // Se establece un color de relleno para mostrar el nombre de la categoría.
        $pdf->SetFillColor(102, 153, 255);
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Roboto-Bold', 'B', 12);
        $pdf->SetTextColor(255);
        // Se imprime una celda con el nombre de la categoría.
        $pdf->Cell(0, 10, utf8_decode(''.$rowEstado['estadopedido']), 1, 1, 'C', 1);
        // Se establece la categoría para obtener sus productos, de lo contrario se imprime un mensaje de error.
        if ($estado->setIdEstadoPedido($rowEstado['idestadopedido'])) {
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataPedidos = $estado->readPedidosEstado()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                // Se establece la fuente para los encabezados.
                $pdf->SetFont('Roboto-Bold', 'B', 11);
                $pdf->SetTextColor(9,9,9);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(71, 10, utf8_decode('Empleado'), 1, 0, 'C', 1);
                $pdf->Cell(80, 10, utf8_decode('Encargado'), 1, 0, 'C', 1);
                $pdf->Cell(35, 10, utf8_decode('Fecha'), 1, 1, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Roboto-Regular', '', 11);
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataPedidos as $rowEstados) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->Cell(71, 10, utf8_decode($rowEstados['empleado']), 1, 0,'C');
                    $pdf->Cell(80, 10, utf8_decode($rowEstados['usuario_encargado']), 1, 0,'C');
                    $pdf->Cell(35, 10, $rowEstados['fechapedido'], 1, 1,'C');
                }

                $pdf->Ln(10);    

            } else {
                $pdf->SetFont('Roboto-Bold', 'B', 11);
                $pdf->SetTextColor(9,9,9);
                $pdf->Cell(0, 10, utf8_decode('No hay pedidos para este estado'), 1, 1);
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
    $pdf->Cell(0, 10, utf8_decode('No hay estados para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>