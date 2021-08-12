<?php
require('../../helpers/report.php');
require('../../models/pedidos.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Factura');
// Se instancia el módelo Categorías para obtener los datos.
$categoria = new Pedidos;

if ($dataProductos2 = $categoria->readReportCabecera()) {
    foreach ($dataProductos2 as $rowProducto2) {
        // Se establece un color de relleno para los encabezados.
        $pdf->SetFillColor(225);
        // Se establece la fuente para los encabezados.
        $pdf->SetFont('Roboto-Bold', 'B', 10);
        // Se establece el color del texto 
        $pdf->SetTextColor(9,9,9);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(70, 6, utf8_decode('Fecha del pedido'), 1, 0, 'C', 1);
        // Se imprimen las celdas con los datos de los productos.
        $pdf->Cell(115, 6, utf8_decode($rowProducto2['fechapedido']), 1, 1);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(70, 6, utf8_decode('Empleado solicitante'), 1, 0, 'C', 1);
        // Se imprimen las celdas con los datos de los productos.
        $pdf->Cell(115, 6, utf8_decode($rowProducto2['empleado']), 1, 1);
        // Se establece el espacio entre elementos 
        $pdf->Ln(0);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(70, 6, utf8_decode('Creador del pedido'), 1, 0, 'C', 1);
        // Se imprimen las celdas con los datos de los productos.
        $pdf->Cell(115, 6, utf8_decode($rowProducto2['usuario']), 1, 1);
        // Se establece el espacio entre elementos 
        $pdf->Ln(0);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(70, 6, utf8_decode('Número de pedido'), 1, 0, 'C', 1);
        // Se imprimen las celdas con los datos de los productos.
        $pdf->Cell(115, 6, utf8_decode($rowProducto2['idpedido']), 1, 1);
        // Se establece el espacio entre elementos 
        $pdf->Ln(0);        
      
    }
} else {
    $pdf->SetTextColor(9,9,9);
    $pdf->Cell(0, 10, utf8_decode('No hay usuarios para mostrar'), 1, 1);
}
    // Se establece el espacio entre elementos 
    $pdf->Ln(10);    
    $pdf->SetFillColor(102, 153, 255);
    // Se establece la fuente para el nombre de la categoría.
    $pdf->SetFont('Roboto-Bold', 'B', 12);
    $pdf->SetTextColor(255);
    // Se imprime una celda con el nombre de la categoría.
    $pdf->Cell(0, 10, utf8_decode('Materiales Solicitados'), 1, 1, 'C', 1);
    // Se establece la categoría para obtener sus productos, de lo contrario se imprime un mensaje de error.
    if ($dataProductos = $categoria->readReport()) {
        // Se establece un color de relleno para los encabezados.
        $pdf->SetFillColor(225);
        // Se establece la fuente para los encabezados.
        $pdf->SetFont('Roboto-Bold', 'B', 11);
        $pdf->SetTextColor(9,9,9);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(76, 10, utf8_decode('Nombre del material'), 1, 0, 'C', 1);
        $pdf->Cell(35, 10, utf8_decode('Precio'), 1, 0, 'C', 1);
        $pdf->Cell(30, 10, utf8_decode('Cantidad'), 1, 0, 'C', 1);
        $pdf->Cell(45, 10, utf8_decode('Subtotal'), 1, 1, 'C', 1);
        // Se establece la fuente para los datos de los productos.
        $pdf->SetFont('Roboto-Regular', '', 11);
        // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
        foreach ($dataProductos as $rowProducto) {
            // Se imprimen las celdas con los datos de los productos.
            $pdf->SetTextColor(9,9,9);
            $pdf->Cell(76, 10, utf8_decode($rowProducto['nombreproducto']), 1, 0,'C');
            $pdf->Cell(35, 10, utf8_decode('$'.$rowProducto['costo']), 1, 0,'C');
            $pdf->Cell(30, 10, utf8_decode($rowProducto['cantidadmaterial']), 1, 0,'C');
            $pdf->Cell(45, 10, utf8_decode('$'.$rowProducto['total']), 1, 1,'C');
        }
        $pdf->Ln(5);
        $pdf->Cell(20);
        $pdf->SetFont('Roboto-Bold', 'B', 11);
        $pdf->Cell(290, 10, ('Costo total (USD): $'. $_SESSION['preciototal']), 0, 1, 'C');
    } else {
        $pdf->SetFont('Roboto-Bold', 'B', 11);
        $pdf->SetTextColor(9,9,9);
        $pdf->Cell(0, 10, utf8_decode('No hay clientes para mostrar'), 1, 1);
    }
// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>