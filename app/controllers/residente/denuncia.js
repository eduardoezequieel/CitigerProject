const API_DENUNCIA = '../../app/api/residente/denuncia.php?action=';
const ENDPOINT_ESTADO = '../../app/api/residente/denuncia.php?action=readComplaintStatus';
const ENDPOINT_TIPO = '../../app/api/residente/denuncia.php?action=readComplaintType';

document.addEventListener('DOMContentLoaded', function(){

    fillSelect(ENDPOINT_ESTADO, 'cbEstadoDenuncia', null);
    fillSelect(ENDPOINT_TIPO, 'cbTipo', null);
    readRows(API_DENUNCIA);
})

function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr class="animate__animated animate__fadeIn">
                <th scope="row">
                    <div class="row paddingTh">
                        <div class="col-12">
                            <img src="../../resources/img/usericon.png" alt="#"
                                class="rounded-circle fit-images" width="30px" height="30px">
                        </div>
                    </div>
                </th>
                <td>${row.tipodenuncia}</td>
                <td>${row.estadodenuncia}</td>
                <td>${row.fecha}</td>
                <!-- Boton-->
                <th scope="row">
                    <div class="row paddingBotones">
                        <div class="col-12">
                            <a href="#" onclick="readDataOnModal(${row.iddenuncia}) "data-toggle="modal" data-target="#administrarVisita" class="btn btnTabla mx-2"><i class="fas fa-edit"></i></a>
                        </div>
                    </div>
                </th>
            </tr>
        `; 
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}