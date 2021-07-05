const API_PEDIDOS = '../../app/api/dashboard/pedidos.php?action=';

document.addEventListener('DOMContentLoaded',function(){
    readRows(API_PEDIDOS);
});

function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <tr class="animate__animated animate__fadeIn">
            <!-- Datos-->
            <td>${row.empleado}</td>
            <td>${row.estadopedido}</td>
            <td>${row.idpedido}</td>
            <!-- Boton-->
            <th scope="row">
                <div class="row paddingBotones">
                    <div class="col-12">
                        <a href="#" data-toggle="modal" data-target="#administrarPedido" class="btn btnTabla"><i class="fas fa-cog"></i></a>
                    </div>
                </div>
            </th>
        </tr>
        `; 
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}
