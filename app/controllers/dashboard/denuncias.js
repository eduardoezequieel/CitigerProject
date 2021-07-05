//Constante para la direccion de la API
const API_DENUNCIAS = '../../app/api/dashboard/denuncias.php?action=';
const ENDPOINT_STATES = '../../app/api/dashboard/denuncias.php?action=readStates';
const ENDPOINT_EMPLOYEETYPES = '../../app/api/dashboard/denuncias.php?action=readEmployeeTypes';
const ENDPOINT_EMPLOYEEBYTYPES = '../../app/api/dashboard/denuncias.php?action=readEmployeeByTypes';

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
                            <a href="#" onclick="administrarDenunciaRechazada(${row.iddenuncia})" data-toggle="modal" data-target="#administrarDenunciaRechazada" class="btn btnTabla2"><i class="fas fa-ban"></i></a>
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
                            <a href="#" data-toggle="modal" onclick="administrarDenunciaEnSolucion(${row.iddenuncia})" data-target="#administrarDenunciaEnSolucion" class="btn btnTabla3"><i class="fas fa-briefcase"></i></a>
                        </div>
                    </div>
                </th>
            </tr> `
        } else if (row.estadodenuncia == "Solucionada") {
            content += `
                    <th scope="row">
                    <div class="row paddingBotones">
                        <div class="col-12">
                            <a href="#" data-toggle="modal" onclick="denunciaFinalizada(${row.iddenuncia})" data-target="#administrarDenunciaEnSolucion" class="btn btnTabla3"><i class="fas fa-info-circle"></i></a>
                        </div>
                    </div>
                </th>
            </tr> `
        }
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}

document.getElementById('btnReiniciar').addEventListener('click', function(event){
    event.preventDefault();
    readRows(API_DENUNCIAS);
    clearForm();
});

/*En el evento submit del formulario llamamos una funcion que ya tiene especificado un fetch para
las busquedas.*/
document.getElementById('search-form').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();

    //Llamamos la funcion
    searchRows(API_DENUNCIAS, 'search-form');
})

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
    fillSelectSpace(ENDPOINT_EMPLOYEEBYTYPES, 'cbEmpleado', null, 'administrarDenunciaAsignar-form');
}

document.getElementById('cbTipoEmpleado').addEventListener('click',function(){
    document.getElementById('idTipoEmpleado').value = document.getElementById('cbTipoEmpleado').value;
    fillSelectSpace(ENDPOINT_EMPLOYEEBYTYPES, 'cbEmpleado', null, 'administrarDenunciaAsignar-form');
})

function administrarDenunciaRechazada(id){
    document.getElementById('idDenuncia3').value = id;

    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idDenuncia3', id);

    fetch(API_DENUNCIAS + 'getAnswer', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('txtRespuesta').value = response.dataset.respuesta;

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

function administrarDenunciaEnSolucion(id){
    document.getElementById('idDenuncia').value = id; 

    document.getElementById('botonesUltimoModal').className = 'row justify-content-center mt-4';

    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idDenuncia', id);

    fetch(API_DENUNCIAS + 'getInfo', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('lblResidente').textContent = response.dataset.residente;
                    document.getElementById('lblTipoDenuncia').textContent = response.dataset.tipodenuncia;
                    document.getElementById('lblFecha').textContent = response.dataset.fecha;
                    document.getElementById('lblEstado').textContent = response.dataset.estadodenuncia;
                    document.getElementById('lblEmpleado').textContent = response.dataset.empleado;
                    document.getElementById('txtDescripcion2').value = response.dataset.descripcion;
                    document.getElementById('idEmpleado').value = response.dataset.idempleado;
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

function denunciaFinalizada(id){
    document.getElementById('idDenuncia').value = id; 

    document.getElementById('botonesUltimoModal').className = 'd-none';

    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idDenuncia', id);
    console.log(id);

    fetch(API_DENUNCIAS + 'getInfo', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('lblResidente').textContent = response.dataset.residente;
                    document.getElementById('lblTipoDenuncia').textContent = response.dataset.tipodenuncia;
                    document.getElementById('lblFecha').textContent = response.dataset.fecha;
                    document.getElementById('lblEstado').textContent = response.dataset.estadodenuncia;
                    document.getElementById('lblEmpleado').textContent = response.dataset.empleado;
                    document.getElementById('txtDescripcion2').value = response.dataset.descripcion
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

document.getElementById('btnEnviarRespuestaRechazo').addEventListener('click',function(event){
    event.preventDefault();
    insertAnswerAfterRejected();
})

document.getElementById('btnRevertirCambiosRechazo').addEventListener('click',function(event){
    event.preventDefault();
    revertChangesAfterRejected();
})

document.getElementById('btnRevertirCambiosAceptado').addEventListener('click',function(event){
    event.preventDefault();
    revertChangesAfterAccepted();
})

document.getElementById('btnAsignarEmpleado').addEventListener('click',function(event){
    event.preventDefault();
    setEmployee();
})

document.getElementById('btnFinalizarDenuncia').addEventListener('click',function(event){
    event.preventDefault();
    finishComplaint();
})

document.getElementById('cbEstadoDenuncia').addEventListener('change',function(){
    document.getElementById('txtEstadoDenuncia').value = document.getElementById('cbEstadoDenuncia').value;
    document.getElementById('btnCambiarEstado').click();
});

document.getElementById('estadobusqueda-form').addEventListener('submit',function(event){
    event.preventDefault();
    filterByState();
})

//Contestar denuncias luego de haber sido rechazadas.
function insertAnswerAfterRejected(){
    fetch(API_DENUNCIAS + 'insertAnswerAfterRejected', {
        method: 'post',
        body: new FormData(document.getElementById('administrarDenunciaRechazada-form'))
    }).then(request => {
        //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
        if (request.ok) {
            request.json().then(response => {
                //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                if (response.status) {
                    readRows(API_DENUNCIAS);
                    sweetAlert(1, response.message, closeModal('administrarDenunciaRechazada'));
                } else {
                    sweetAlert(2, response.exception, null);
                }
            })
        } else {
            console.log(response.status + ' ' + response.exception);
        }
    }).catch(error => console.log(error));
}

function filterByState(){
    fetch(API_DENUNCIAS + 'readAllByState', {
        method: 'post',
        body: new FormData(document.getElementById('estadobusqueda-form'))
    }).then(request => {
        //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
        if (request.ok) {
            request.json().then(response => {
                let data = [];
                //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                if (response.status) {
                    data = response.dataset;
                } else {
                    sweetAlert(4, response.exception, null);
                }
                fillTable(data);
            })
        } else {
            console.log(response.status + ' ' + response.exception);
        }
    }).catch(error => console.log(error));
}

//Asignar un empleado para dar solucion a un problema
function setEmployee(){
    swal({
        title: 'Advertencia',
        text: '¿Deseas asignar este empleado para solucionar esta denuncia?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(value => {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición, de lo contrario no se hace nada.
        if (value) {
            fetch(API_DENUNCIAS + 'setEmployee', {
                method: 'post',
                body: new FormData(document.getElementById('administrarDenunciaAsignar-form'))
            }).then(request => {
                //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
                if (request.ok) {
                    request.json().then(response => {
                        //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                        if (response.status) {
                            readRows(API_DENUNCIAS);
                            sweetAlert(1, response.message, closeModal('administrarDenunciaAsignar'));
                        } else {
                            sweetAlert(2, response.exception, null);
                        }
                    })
                } else {
                    console.log(response.status + ' ' + response.exception);
                }
            }).catch(error => console.log(error));
        }
    });
}

//Revertir cambios despues de haber rechazado denuncia
function revertChangesAfterRejected(){
    swal({
        title: 'Advertencia',
        text: '¿Deseas revertir los cambios hechos en esta denuncia?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(value => {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición, de lo contrario no se hace nada.
        if (value) {
            fetch(API_DENUNCIAS + 'revertChangesAfterRejected', {
                method: 'post',
                body: new FormData(document.getElementById('administrarDenunciaRechazada-form'))
            }).then(request => {
                //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
                if (request.ok) {
                    request.json().then(response => {
                        //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                        if (response.status) {
                            readRows(API_DENUNCIAS);
                            sweetAlert(1, response.message, closeModal('administrarDenunciaRechazada'));
                        } else {
                            sweetAlert(2, response.exception, null);
                        }
                    })
                } else {
                    console.log(response.status + ' ' + response.exception);
                }
            }).catch(error => console.log(error));
        }
    });
}

//Finalizar denuncia
function finishComplaint(){
    swal({
        title: 'Advertencia',
        text: '¿Deseas reportar esta denuncia como finalizada?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(value => {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición, de lo contrario no se hace nada.
        if (value) {
            fetch(API_DENUNCIAS + 'finishComplaint', {
                method: 'post',
                body: new FormData(document.getElementById('administrarDenunciaEnSolucion-form'))
            }).then(request => {
                //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
                if (request.ok) {
                    request.json().then(response => {
                        //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                        if (response.status) {
                            readRows(API_DENUNCIAS);
                            sweetAlert(1, response.message, closeModal('administrarDenunciaEnSolucion'));
                        } else {
                            sweetAlert(2, response.exception, null);
                        }
                    })
                } else {
                    console.log(response.status + ' ' + response.exception);
                }
            }).catch(error => console.log(error));
        }
    });
}

//Revertir cambios despues de haber aceptado la denuncia
function revertChangesAfterAccepted(){
    swal({
        title: 'Advertencia',
        text: '¿Deseas revertir los cambios hechos en esta denuncia?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(value => {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición, de lo contrario no se hace nada.
        if (value) {
            fetch(API_DENUNCIAS + 'revertChangesAfterAccepted', {
                method: 'post',
                body: new FormData(document.getElementById('administrarDenunciaAsignar-form'))
            }).then(request => {
                //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
                if (request.ok) {
                    request.json().then(response => {
                        //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                        if (response.status) {
                            readRows(API_DENUNCIAS);
                            sweetAlert(1, response.message, closeModal('administrarDenunciaAsignar'));
                        } else {
                            sweetAlert(2, response.exception, null);
                        }
                    })
                } else {
                    console.log(response.status + ' ' + response.exception);
                }
            }).catch(error => console.log(error));
        }
    });
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
                        openModal('administrarDenunciaAsignar');
                        administrarDenunciaAsignar(document.getElementById('idDenuncia1').value);
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
                        administrarDenunciaRechazada(document.getElementById('idDenuncia1').value);
                    })
                } else {
                    console.log(response.status + ' ' + response.exception);
                }
            }).catch(error => console.log(error));
        }
    });
})

//Para cargar selects dependientes
function fillSelectSpace(endpoint, select, selected, form) {
    fetch(endpoint, {
        method: 'post',
        body: new FormData(document.getElementById(form))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let content = '';
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Si no existe un valor para seleccionar, se muestra una opción para indicarlo.
                    if (!selected) {
                        content += '<option disabled selected>Seleccione una opción</option>';
                    }
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se obtiene el dato del primer campo de la sentencia SQL (valor para cada opción).
                        value = Object.values(row)[0];
                        // Se obtiene el dato del segundo campo de la sentencia SQL (texto para cada opción).
                        text = Object.values(row)[1];
                        // Se verifica si el valor de la API es diferente al valor seleccionado para enlistar una opción, de lo contrario se establece la opción como seleccionada.
                        if (value != selected) {
                            content += `<option value="${value}">${text}</option>`;
                        } else {
                            content += `<option value="${value}" selected>${text}</option>`;
                        }
                    });
                } else {
                    content += '<option>No hay opciones disponibles</option>';
                }
                // Se agregan las opciones a la etiqueta select mediante su id.
                document.getElementById(select).innerHTML = content;
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}
