//Declarando constantes para almacenar la ruta de las apis
const API_VISITA = '../../app/api/dashboard/visitas.php?action=';
const ENDPOINT_ESTADO = '../../app/api/dashboard/visitas.php?action=readVisitStatus';
const ENDPOINT_RESIDENTE = '../../app/api/dashboard/visitas.php?action=readResident';
const ENDPOINT_VISITANTE = '../../app/api/dashboard/visitas.php?action=readVisitante';

//Método que se ejecuta cuando se carga la pagina
document.addEventListener('DOMContentLoaded', function () {
    //Función para verificar permiso 
    checkPermissions('Visitas');
    //Llenando todos los select necesarios
    fillSelect(ENDPOINT_ESTADO, 'cbEstadoVisita', null);
    fillSelect(ENDPOINT_RESIDENTE, 'cbResidente', null);
    fillSelect(ENDPOINT_VISITANTE, 'cbVisitante', null);
    //Llenando la tabla con los datos registrados
    readRows(API_VISITA);
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

})

//Función para llenar la tabla
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr class="animate__animated animate__fadeIn">
                <td>${row.nombre}</td>
                <td>${row.fecha}</td>
                <td>${row.visitarecurrente}</td>
                <td>${row.observacion}</td>
                <td>${row.estadovisita}</td>
                <!-- Boton-->
                <th scope="row">
                    <div class="row paddingBotones">
                        <div class="col-12">
                            <a href="#" onclick="readDataOnModal(${row.idvisita}) "data-toggle="modal" data-target="#administrarVisita" class="btn btnTabla mx-2"><i class="fas fa-edit"></i></a>

                            <a href="#" onclick="deleteRow(${row.idvisita})" class="btn btnTabla2 mx-2"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                </th>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;

    $('#data-table').DataTable({
        retrieve: true,
        searching: false,
        language:
            {
                "decimal":        "",
                "emptyTable":     "No hay información disponible en la tabla.",
                "info":           "Mostrando _START_ de _END_ de _TOTAL_ registros.",
                "infoEmpty":      "Mostrando 0 de 0 de 0 registros",
                "infoFiltered":   "(filtered from _MAX_ total entries)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Mostrar _MENU_ registros",
                "loadingRecords": "Loading...",
                "processing":     "Processing...",
                "search":         "Search:",
                "zeroRecords":    "No matching records found",
                "paginate": {
                    "first":      "AAA",
                    "last":       "Ultimo",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "aria": {
                    "sortAscending":  ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            }
    });
}

document.getElementById('btnReiniciar').addEventListener('click', function () {
    readRows(API_VISITA);
});

//---------------------------Operaciones CRUD---------------------------


//ocultar los demas botones de acción en el formulario al presionar Agregar.
document.getElementById('btnInsertDialog').addEventListener('click', function () {
    document.getElementById('btnAgregar').className = "btn btnAgregarFormulario mr-2";
    document.getElementById('btnActualizar').className = "d-none";
    document.getElementById('btnSuspender').className = "d-none";
    document.getElementById('btnActivar').className = "d-none";

    // Se reinician los campos del formulario
    document.getElementById('idVisita').value = '';
    document.getElementById('txtFecha').value = '';
    fillSelect('cbVisitaR', null);
    document.getElementById('txtObservacion').value = '';
    fillSelect(ENDPOINT_RESIDENTE, 'cbResidente', null);
    fillSelect(ENDPOINT_VISITANTE, 'cbVisitante', null);
    clearForm('administrarVisita-form');
    document.getElementById('cbc1').classList.remove("success");
    document.getElementById('cbc2').classList.remove("success");
    document.getElementById('cbc3').classList.remove("success");
    document.getElementById('cbc4').classList.remove("success");
});

//Agregar y actualizar información
document.getElementById('administrarVisita-form').addEventListener('submit', function (event) {
    //Se evita que se recargue la pagina
    event.preventDefault();

    //Se evalua si el usuario esta haciendo una inserción o una actualización
    if (document.getElementById('btnAgregar').className != 'd-none') {
        saveRow(API_VISITA, 'createRow', 'administrarVisita-form', 'administrarVisita');
    } else {
        saveRow(API_VISITA, 'updateRow', 'administrarVisita-form', 'administrarVisita');
    }
});

//Carga de datos del registro seleccionado
function readDataOnModal(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idVisita', id);
    console.log(id);

    //Se ocultan los botones del formulario.
    document.getElementById('btnAgregar').className = "d-none";
    document.getElementById('btnActualizar').className = "btn btnAgregarFormulario mr-2";

    fetch(API_VISITA + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idVisita').value = response.dataset.idvisita;
                    document.getElementById('cbVisitaR').value = response.dataset.visitarecurrente;
                    fillSelect(ENDPOINT_RESIDENTE, 'cbResidente', response.dataset.idresidente);
                    document.getElementById('txtFecha').value = response.dataset.fecha;
                    document.getElementById('txtObservacion').value = response.dataset.observacion;
                    if (response.dataset.idestadovisita == 4) {
                        document.getElementById('btnSuspender').className = "btn btnAgregarFormulario mr-2";
                        document.getElementById('btnActivar').className = "d-none";
                    } else if (response.dataset.idestadovisita == 5) {
                        document.getElementById('btnActivar').className = "btn btnAgregarFormulario mr-2";
                        document.getElementById('btnSuspender').className = "d-none";
                    }
                    fillSelect(ENDPOINT_VISITANTE, 'cbVisitante', response.dataset.idvisitante);

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

//Suspender registros
document.getElementById('btnSuspender').addEventListener('click', function (event) {
    event.preventDefault();
    suspendRow(API_VISITA, 'administrarVisita-form', 'administrarVisita');
})

//Activar registros
document.getElementById('btnActivar').addEventListener('click', function (event) {
    event.preventDefault();
    activateRow(API_VISITA, 'administrarVisita-form', 'administrarVisita');
})


//eliminar registros de la tabla visita.
function deleteRow(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idVisita', id);
    // Se llama a la función que elimina un registro.
    confirmDelete(API_VISITA, data);
}

//Busqueda por estado visita
document.getElementById('cbEstadoVisita').addEventListener('change', function () {
    //Guardando el valor del select en un input
    document.getElementById('idEstadoVisita').value = document.getElementById('cbEstadoVisita').value;
    //Presionando el boton invisible
    document.getElementById('btnFiltrarEstado').click();
})

//Una vez presionado el boton invisible, se hace un fetch con la información del form.
document.getElementById('filtrarEstadoVisita-form').addEventListener('submit', function (event) {
    //Se evita recargar la pagina
    event.preventDefault();

    fetch(API_VISITA + 'filterByVisitStatus', {
        method: 'post',
        body: new FormData(document.getElementById('filtrarEstadoVisita-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;
                    //sweetAlert(1, response.message, null);
                } else {
                    sweetAlert(4, response.exception, null);
                }
                // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                fillTable(data);
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});

