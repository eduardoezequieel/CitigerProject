//Constante para la direccion de la API
const API_DENUNCIAS = '../../app/api/dashboard/denuncias.php?action=';
const ENDPOINT_STATES = '../../app/api/dashboard/denuncias.php?action=readStates';
const ENDPOINT_EMPLOYEETYPES = '../../app/api/dashboard/denuncias.php?action=readEmployeeTypes';

document.addEventListener('DOMContentLoaded', function(){
    readRows(API_DENUNCIAS);
    fillSelect(ENDPOINT_STATES, 'cbEstadoDenuncia', null);
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
                
        `; 

        if (row.estadodenuncia == "Pendiente") {
            content += `
                    <th scope="row">
                    <div class="row paddingBotones">
                        <div class="col-12">
                            <a href="#" onclick="administrarDenunciaPendiente(${row.iddenuncia})" data-toggle="modal" data-target="#administrarDenunciaPendiente" class="btn btnTabla"><i class="fas fa-cog"></i></a>

                        </div>
                    </div>
                </th>
            </tr> `
        } else if(row.estadodenuncia == "Rechazada") {
            content += `
                    <th scope="row">
                    <div class="row paddingBotones">
                        <div class="col-12">
                            <a href="#" data-toggle="modal" data-target="#administrarDenunciaRechazada" class="btn btnTabla2"><i class="fas fa-ban"></i></a>
                        </div>
                    </div>
                </th>
            </tr> `
        } else if (row.estadodenuncia == "Revisión") {
            content += `
                    <th scope="row">
                    <div class="row paddingBotones">
                        <div class="col-12">
                            <a href="#" data-toggle="modal" onclick="administrarDenunciaAsignar(${row.iddenuncia})" data-target="#administrarDenunciaAsignar" class="btn btnTabla"><i class="fas fa-question"></i></a>
                        </div>
                    </div>
                </th>
            </tr> `
        } else if (row.estadodenuncia == "En proceso") {
            content += `
                    <th scope="row">
                    <div class="row paddingBotones">
                        <div class="col-12">
                            <a href="#" data-toggle="modal" data-target="#administrarDenunciaEnSolucion" class="btn btnTabla3"><i class="fas fa-briefcase"></i></a>
                        </div>
                    </div>
                </th>
            </tr> `
        } else if (row.estadodenuncia == "Solucionada") {
            content += `
                    <th scope="row">
                    <div class="row paddingBotones">
                        <div class="col-12">
                            <a href="#" data-toggle="modal" data-target="#administrarDenunciaEnSolucion" class="btn btnTabla3"><i class="fas fa-info"></i></a>
                        </div>
                    </div>
                </th>
            </tr> `
        }
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}

function administrarDenunciaPendiente(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idDenuncia', id);
    console.log(id);

    fetch(API_DENUNCIAS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idDenuncia1').value = id;
                    document.getElementById('txtResidente').textContent = response.dataset.residente;
                    document.getElementById('txtTipoDenuncia').textContent = response.dataset.tipodenuncia;
                    document.getElementById('txtFecha').textContent = response.dataset.fecha;
                    document.getElementById('txtEstadoDenuncia').textContent = response.dataset.estadodenuncia;
                    document.getElementById('txtDescripcion').textContent = response.dataset.descripcion;

                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function administrarDenunciaAsignar(id){
    document.getElementById('idDenuncia2').value = id;
    fillSelect(ENDPOINT_EMPLOYEETYPES, 'cbTipoEmpleado', null);
}

//Aceptar denuncias
document.getElementById('btnAceptar').addEventListener('click',function(event){
    event.preventDefault();

    swal({
        title: 'Advertencia',
        text: '¿Desea aceptar está denuncia?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(value => {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición, de lo contrario no se hace nada.
        if (value) {
            fetch(API_DENUNCIAS + 'acceptComplaint', {
                method: 'post',
                body: new FormData(document.getElementById('administrarDenunciaPendiente-form'))
            }).then(request => {
                //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
                if (request.ok) {
                    request.json().then(response => {
                        //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                        if (response.status) {
                            readRows(API_DENUNCIAS);
                            sweetAlert(1, response.message, closeModal('administrarDenunciaPendiente'));
                            
                        } else {
                            sweetAlert(2, response.exception, null);
                        }
                        console.log('modal por error')
                        openModal('administrarDenunciaAsignar');
                    })
                } else {
                    console.log(response.status + ' ' + response.exception);
                }
            }).catch(error => console.log(error));
        }
    });
})

//Rechazar denuncias
document.getElementById('btnRechazar').addEventListener('click',function(event){
    event.preventDefault();

    swal({
        title: 'Advertencia',
        text: '¿Desea rechazar está denuncia?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(value => {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición, de lo contrario no se hace nada.
        if (value) {
            fetch(API_DENUNCIAS + 'rejectComplaint', {
                method: 'post',
                body: new FormData(document.getElementById('administrarDenunciaPendiente-form'))
            }).then(request => {
                //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
                if (request.ok) {
                    request.json().then(response => {
                        //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                        if (response.status) {
                            readRows(API_DENUNCIAS);
                            sweetAlert(1, response.message, closeModal('administrarDenunciaPendiente'));
                        } else {
                            sweetAlert(2, response.exception, null);
                        }

                        openModal('administrarDenunciaRechazada');
                    })
                } else {
                    console.log(response.status + ' ' + response.exception);
                }
            }).catch(error => console.log(error));
        }
    });
})


