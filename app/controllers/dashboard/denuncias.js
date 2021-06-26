//Constante para la direccion de la API
const API_DENUNCIAS = '../../app/api/dashboard/denuncias.php?action=';

document.addEventListener('DOMContentLoaded', function(){
    readRows(API_DENUNCIAS);
})

//Llenado de tabla
function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr class="animate__animated animate__fadeIn">
                <!-- Fotografia-->
                <th scope="row">
                    <div class="row paddingTh">
                        <div class="col-12">
                            <img src="../../resources/img/iconw.png" alt="" class="img-fluid" width="30px">
                        </div>
                    </div>
                </th>
                <!-- Datos-->
                <td>${row.residente}</td>
                <td>${row.tipodenuncia}</td>
                <td>${row.estadodenuncia}</td>
                <td>${row.fecha}</td>
                <!-- Boton-->
                <th scope="row">
                    <div class="row paddingBotones">
                        <div class="col-12">
                            <a href="#" data-toggle="modal" data-target="#administrarDenunciaPendiente" class="btn btnTabla"><i class="fas fa-cog"></i></a>
                            <a href="#" data-toggle="modal" data-target="#administrarDenunciaRechazada" class="btn btnTabla2"><i class="fas fa-ban"></i></a>
                            <a href="#" data-toggle="modal" data-target="#administrarDenunciaAsignar" class="btn btnTabla"><i class="fas fa-question"></i></a>
                            <a href="#" data-toggle="modal" data-target="#administrarDenunciaEnSolucion" class="btn btnTabla3"><i class="fas fa-briefcase"></i></a>
                            <a href="#" data-toggle="modal" data-target="#administrarDenunciaEnSolucion" class="btn btnTabla3"><i class="fas fa-info"></i></a>

                        </div>
                    </div>
                </th>
            </tr>
        `; 
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}
