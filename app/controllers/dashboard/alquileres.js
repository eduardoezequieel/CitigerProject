//constante para la ruta de la api
const API_ALQUILER = '../../app/api/dashboard/alquileres.php?action=';
const ENDPOINT_ESTADO_ALQUILER = '../../app/api/dashboard/alquileres.php?action=readRentalStatus';
const ENDPOINT_ESPACIO_ALQUILER = '../../app/api/dashboard/alquileres.php?action=readSpace';
const ENDPOINT_ESPACIO_ALQUILER_UPDATE = '../../app/api/dashboard/alquileres.php?action=readSpaceUpdate';
const ENDPOINT_RES_ALQUILER = '../../app/api/dashboard/alquileres.php?action=readResident';

//Evento al terminar de cargar la pagina
document.addEventListener('DOMContentLoaded', function () {
    //Función para verificar permiso 
    checkPermissions('Alquileres');
    //Inicializando tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    // Se declara e inicializa un objeto para obtener la fecha y hora actual.
    let today = new Date();
    // Se declara e inicializa una variable para guardar el día en formato de 2 dígitos.
    let day = ('0' + today.getDate()).slice(-2);
    // Se declara e inicializa una variable para guardar el mes en formato de 2 dígitos.
    var month = ('0' + (today.getMonth() + 1)).slice(-2);
    // Se declara e inicializa una variable para guardar el año con la mayoría de edad.
    let year = today.getFullYear();
    // Se declara e inicializa una variable para establecer el formato de la fecha.
    let date = `${year}-${month}-${day}`;
    // Se asigna la fecha como valor máximo en el campo del formulario.
    document.getElementById('txtFecha').setAttribute('min', date);
    fillSelect(ENDPOINT_ESTADO_ALQUILER, 'cbEstadoAlquiler', null);
    readRows(API_ALQUILER);
    readEspacios(API_ALQUILER);
    finalizarAlquiler();

})

//Llenado de tabla
function fillTable(dataset) {
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
                                <img src="../../resources/img/dashboard_img/residentes_fotos/${row.foto}" alt="" class="fit-images rounded-circle" width="30px" height="30px">
                            </div>
                        </div>
                    </th>
                    <!-- Datos-->
                    <td>${row.residente}</td>
                    <td>${row.nombre}</td>
                    <td>${row.fecha}</td>
                    <td>${row.estadoalquiler}</td>
                    <!-- Boton-->
        `;
        if (row.estadoalquiler == "Activo") {
            content += `
            <th scope="row">
            <div class="row paddingBotones">
                <div class="col-12">
                    <a href="#" onclick="readDataOnModal(${row.idalquiler}) " data-target="#agregarAlquiler" data-toggle="modal" class="btn btnTabla"><i class="fas fa-edit"></i></a>

                    <a href="#" onclick="deleteRow(${row.idalquiler},${row.idespacio})" class="btn btnTabla2 mx-2"><i
                    class="fas fa-trash"></i></a>

                    <a href="#" onclick="openReport(${row.idalquiler})" type="button" data-toggle="tooltip" data-target="#" data-placement="bottom" title="Comprobante de alquiler" class="btn btnTabla"><i class="fas fa-file-alt"></i></a>

                </div>
            </div>
        </th>
            </tr> `
        } else if (row.estadoalquiler == "Revisión") {
            content += `
            <th scope="row">
            <div class="row paddingBotones">
                <div class="col-12">
                    <a href="#" onclick="readDataOnModal(${row.idalquiler}) " data-target="#agregarAlquiler" data-toggle="modal" class="btn btnTabla"><i class="fas fa-edit"></i></a>

                    <a href="#" onclick="deleteRow(${row.idalquiler},${row.idespacio})" class="btn btnTabla2 mx-2"><i
                    class="fas fa-trash"></i></a>


                </div>
            </div>
        </th>
            </tr> `
        } else if (row.estadoalquiler == "Denegado") {
            content += `
            <th scope="row">
            <div class="row paddingBotones">
                <div class="col-12">
                    <a href="#" onclick="readDataOnModal(${row.idalquiler}) " data-target="#agregarAlquiler" data-toggle="modal" class="btn btnTabla"><i class="fas fa-edit"></i></a>

                    <a href="#" onclick="deleteRow(${row.idalquiler},${row.idespacio})" class="btn btnTabla2 mx-2"><i
                    class="fas fa-trash"></i></a>


                </div>
            </div>
        </th>
            </tr> `
        }
        else if (row.estadoalquiler == "Finalizado") {
            content += `
            <th scope="row">
            <div class="row paddingBotones">
                <div class="col-12">
                    <a href="#" onclick="readDataOnModal(${row.idalquiler}) " data-target="#verAlquiler" data-toggle="modal" class="btn btnTabla"><i class="fas fa-eye"></i></a>

                    <a href="#" onclick="deleteRow(${row.idalquiler},${row.idespacio})" class="btn btnTabla2 mx-2"><i
                    class="fas fa-trash"></i></a>

                    <a href="#" onclick="openReport(${row.idalquiler})" type="button" data-toggle="tooltip" data-target="#" data-placement="bottom" title="Comprobante de alquiler" class="btn btnTabla"><i class="fas fa-file-alt"></i></a>



                </div>
            </div>
        </th>
            </tr> `
        }
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;

    $('#data-table').DataTable({
        retrieve: true,
        searching: false,
        language:
        {
            "decimal": "",
            "emptyTable": "No hay información disponible en la tabla.",
            "info": "Mostrando _START_ de _END_ de _TOTAL_ registros.",
            "infoEmpty": "Mostrando 0 de 0 de 0 registros",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ registros",
            "loadingRecords": "Loading...",
            "processing": "Processing...",
            "search": "Search:",
            "zeroRecords": "No matching records found",
            "paginate": {
                "first": "AAA",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }
    });
}

//Carga de datos del registro seleccionado
function readDataOnModal(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idAlquiler', id);
    document.getElementById('salir2').className = "d-none";
    document.getElementById('btnAgregar').className = "d-none";
    document.getElementById('salir').className = "close closeModalButton lead";
    document.getElementById('btnActualizar').className = "btn btnAgregarFormulario mr-2";
    document.getElementById('btnAutorizar').className = "btn btnAgregarFormulario mr-2";
    document.getElementById('btnDenegar').className = "btn btnAgregarFormulario mr-2";




    //Se ocultan los botones del formulario.


    fetch(API_ALQUILER + 'readOne', {
        method: 'post',
        body: data
    }).then(request => {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(response => {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idAlquiler').value = response.dataset.idalquiler;
                    document.getElementById('idAlquiler2').value = response.dataset.idalquiler;
                    document.getElementById('idEspacio').value = response.dataset.idespacio;
                    document.getElementById('txtFecha').value = response.dataset.fecha;
                    document.getElementById('txtHoraInicio').value = response.dataset.horainicio;
                    document.getElementById('txtHoraFin').value = response.dataset.horafin;
                    document.getElementById('txtPrecio').value = response.dataset.precio;

                    document.getElementById('lblResidente2').textContent = (response.dataset.residente);
                    document.getElementById('lblEspacio2').textContent = (response.dataset.nombre);

                    if (response.dataset.idestadoalquiler == 4) {
                        document.getElementById('btnDenegar').className = "d-none";
                        document.getElementById('btnAutorizar').className = " btn btnAgregarFormulario mr-2";


                    } else if (response.dataset.idestadoalquiler == 2) {

                        document.getElementById('btnAutorizar').className = "d-none";
                        document.getElementById('btnDenegar').className = " btn btnAgregarFormulario mr-2";



                    }


                    document.getElementById('lblFecha').textContent = (response.dataset.fecha);
                    document.getElementById('lblResidente').textContent = (response.dataset.residente);
                    document.getElementById('lblEspacio').textContent = (response.dataset.nombre);
                    document.getElementById('lblInicio').textContent = (response.dataset.horainicio);
                    document.getElementById('lblFin').textContent = (response.dataset.horafin);
                    document.getElementById('lblPrecio').textContent = (response.dataset.precio);



                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error));
}

/*Agregando o actualizando un nuevo registro a la tabla
  Se verifica si se muestra el botón agregar se hace un createRow, de lo contrario un updateRow*/
document.getElementById('alquiler-form').addEventListener('submit', function (event) {
    //Evento para evitar que recargué la pagina
    event.preventDefault();
    //Verificando la acción que se va a realizar
    if (document.getElementById('btnAgregar').className != 'd-none') {
        //Agregando el registro
        saveRow(API_ALQUILER, 'createRow', 'alquiler-form', 'agregarAlquiler');
        readEspacios(API_ALQUILER);

    } else {
        saveRow(API_ALQUILER, 'updateRow', 'alquiler-form', 'agregarAlquiler');
        readEspacios(API_ALQUILER);

    }
})

//Eliminar registros de la tabla empleado.
function deleteRow(id, idespacio) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idAlquiler', id);
    data.append('idEspacio', idespacio);

    // Se llama a la función que elimina un registro.
    confirmDelete(API_ALQUILER, data);
    readEspacios(API_ALQUILER);

}

//Suspendiendo el registro de la tabla
document.getElementById('btnDenegar').addEventListener('click', function (event) {
    //Evento para evitar que recargué la pagina
    event.preventDefault();
    //Se suspende el registro seleccionado
    suspendRow(API_ALQUILER, 'alquiler-form', 'agregarAlquiler');
    readEspacios(API_ALQUILER);

})

//Activando el registro de la tabla
document.getElementById('btnAutorizar').addEventListener('click', function (event) {
    //Evento para evitar que recargué la pagina
    event.preventDefault();
    //Se suspende el registro seleccionado
    activateRow(API_ALQUILER, 'alquiler-form', 'agregarAlquiler');
    readEspacios(API_ALQUILER);

})


//Buscando registros
document.getElementById('search-form').addEventListener('submit', function (event) {
    //Evitamos recargar la pagina
    event.preventDefault();
    //Llamamos la funcion
    searchRows(API_ALQUILER, 'search-form');
})

//Busqueda por estado de alquiler

/*Cada vez que cambie el valor del select, se enviara a un input invisible y de igual forma se 
presionara un boton invisible para poder activar el evento submit del form*/
document.getElementById('cbEstadoAlquiler').addEventListener('change', function (event) {
    //Se evita recargar la pagina
    event.preventDefault();
    //Guardando el valor del select en un input
    document.getElementById('idEstadoAlquiler').value = document.getElementById('cbEstadoAlquiler').value;
    //Presionando el boton invisible
    document.getElementById('btnFiltrarAlquiler').click();
})

//Una vez presionado el boton invisible, se hace un fetch con la información del form.
document.getElementById('filtrarEstadoAlquiler-form').addEventListener('submit', function (event) {
    //Se evita recargar la pagina
    event.preventDefault();
    //Se realiza el filtro
    filter(API_ALQUILER, 'filterRentalStatus', 'filtrarEstadoAlquiler-form');
})

//Método para resetear botones
document.getElementById('btnInsertDialog').addEventListener('click', function () {
    clearForm('alquiler-form');
    document.getElementById('idEspacio').value = 0;
    document.getElementById('txtDuiVerificar').value = '';
    readEspacios(API_ALQUILER);


})

//Método para resetear busqueda
document.getElementById('btnReiniciar').addEventListener('click', function () {
    readRows(API_ALQUILER);
    document.getElementById('search').value = '';
    fillSelect(ENDPOINT_ESTADO_ALQUILER, 'cbEstadoAlquiler', null);


});


/*
*   Función para cargar las opciones en un select de formulario.
*
*   Parámetros: endpoint (ruta del servidor para obtener los datos), select (identificador del select en el formulario) y selected (valor seleccionado).
*
*   Retorno: ninguno.
*/
function fillSelectSpace(endpoint, select, selected) {
    fetch(endpoint, {
        method: 'post',
        body: new FormData(document.getElementById('alquiler-form'))
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


document.getElementById('fecha-form').addEventListener('submit', function (event) {
    //Evento para evitar que recargué la pagina
    event.preventDefault();
    // Realizamos una peticion a la API indicando el caso a utilizar y enviando la direccion de la API como parametro
    fetch(API_ALQUILER + 'readOne2', {
        method: 'post',
        body: new FormData(document.getElementById('fecha-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Abrimos el reporte mediante su URL 
                    window.open("../../app/reports/dashboard/alquileres.php", "");
                } else {
                    sweetAlert(3, response.exception, null);
                    console.log(response.status + ' ' + response.statusText);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
})


function openReport(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('txtId', id);
    // Realizamos una peticion a la API indicando el caso a utilizar y enviando la direccion de la API como parametro
    fetch(API_ALQUILER + 'readOne3', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            // Abrimos el reporte mediante su URL 
            window.open("../../app/reports/dashboard/comprobante_alquiler.php", "");
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });

}

//Aplicacion de las mascaras
$(document).ready(function () {
    $("#txtDuiVerificar").mask("00000000-0");
    $("#txtTelefonoFijo").mask("0000-0000");
    $("#txtTelefonomovil").mask("0000-0000");
});


//Llenado de cartas
function fillTable2(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <div class="animate__animated animate__bounceIn col-xl-4 col-md-4 col-sm-12 col-xs-12 mt-4 d-flex margenTarjetas justify-content-center align-items-center text-center">
                            <!-- Inicio de Tarjeta -->
                            <div class="tarjeta">
                                <!-- Fila para Imagen -->
                                <div class="row">
                                    <div class="col-12">
                                        <img src="../../resources/img/dashboard_img/espacios_fotos/${row.imagenprincipal}" alt="#" class="img-fluid fit-images fotoEspacio imagenTarjeta">
                                    </div>
                                </div>
                                <!-- Fila para Información -->
                                <div class="row mt-2">
                                    <div class="col-12 text-left">
                                        <h1 class="letraTarjetaTitulo">${row.nombre}</h1>
                                        <h1 class="letraTarjeta">Capacidad: <span class="letraDestacadaTarjeta">${row.capacidad}</span></h1>
                                    </div>
                                </div>
                                <!-- Fila para Boton -->
                                <div class="row">
                                    <div class="col-12">
                                        <button data-toggle="modal" onclick="readOneEspacio(${row.idespacio}) " data-target="#agregarAlquiler" data-dismiss="modal" class="btn botonesTarjeta"><span class="fas fa-plus mr-2"></span>Agregar</button>
                                    </div>
                                </div>
                                <!-- Fin de Tarjeta -->
                            </div>


                        </div>

                    
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('espacios').innerHTML = content;
}


//Funcion para obtener la informacion del residente
function getResidenteData(dui) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('txtDuiVerificar', dui);
    console.log(dui);
    fetch(API_ALQUILER + 'checkResidente', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idResidente').value = response.dataset.idresidente;
                    document.getElementById('lblResidente2').textContent = response.dataset.nombre + ' ' + response.dataset.apellido;

                } else {
                    console.log(response.exception);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

document.getElementById('verificarDui-form').addEventListener('submit', function (event) {
    //Evitamos recargar la pagina
    event.preventDefault();
    //fetch para verificar la informacion
    fetch(API_ALQUILER + 'checkResidente', {
        method: 'post',
        body: new FormData(document.getElementById('verificarDui-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Sucede si se encuentra el visitante
                    console.log('El residente existe.');
                    //Cerramos el modal actual
                    closeModal('verificarDui');
                    //Mandamos la informacion al nuevo modal
                    var num = document.getElementById('txtDuiVerificar').value;
                    console.log(num);
                    getResidenteData(num);
                    //Abrimos el nuevo modal
                    openModal('seleccionarEspacio');
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
});


//Carga de datos del registro seleccionado
function readOneEspacio(id) {
    // Se configuran los botones dependiendo de la accion seleccionada
    document.getElementById('btnAgregar').className = "btn btnAgregarFormulario mr-2";
    document.getElementById('btnActualizar').className = "d-none";
    document.getElementById('btnAutorizar').className = "d-none";
    document.getElementById('btnDenegar').className = "d-none";
    document.getElementById('salir').className = "d-none";
    document.getElementById('salir2').className = "close closeModalButton lead";


    const data = new FormData();
    data.append('idEspacio', id);
    //Se ocultan los botones del formulario.


    fetch(API_ALQUILER + 'readOneEspacio', {
        method: 'post',
        body: data
    }).then(request => {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(response => {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idEspacio').value = response.dataset.idespacio;
                    document.getElementById('lblEspacio2').textContent = (response.dataset.nombre);




                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error));
}


function finalizarAlquiler() {

    fetch(API_ALQUILER + 'finishRow', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    console.log(response.message);
                    readEspacios(API_ALQUILER);
                    readRows(API_ALQUILER);


                } else {
                    sweetAlert(4, response.exception, null);
                    readEspacios(API_ALQUILER);
                    readRows(API_ALQUILER);


                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });


}