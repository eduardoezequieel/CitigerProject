const API_VISITA = '../../app/api/dashboard/visitas.php?action=';
const ENDPOINT_ESTADO = '../../app/api/dashboard/visitas.php?action=readVisitStatus';
const ENDPOINT_RESIDENTE = '../../app/api/dashboard/visitas.php?action=readResident';

document.addEventListener('DOMContentLoaded', function(){

    fillSelect(ENDPOINT_ESTADO, 'cbEstadoVisita', null);
    fillSelect(ENDPOINT_RESIDENTE, 'cbResidente', null);
    readRows(API_VISITA);
})

function fillTable(dataset){
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
}

document.getElementById('btnReiniciar').addEventListener('click',function(){
    readRows(API_VISITA);
});

//---------------------------Operaciones CRUD---------------------------


//ocultar los demas botones de acción en el formulario al presionar Agregar.
document.getElementById('btnInsertDialog').addEventListener('click',function(){
    document.getElementById('btnAgregar').className="btn btnAgregarFormulario mr-2";
    document.getElementById('btnActualizar').className="d-none";
    document.getElementById('btnSuspender').className="d-none";
    document.getElementById('btnActivar').className="d-none";

    // Se reinician los campos del formulario
    document.getElementById('idVisita').value = '';
    document.getElementById('txtFecha').value = '';
    fillSelect('cbVisitaR', null);
    document.getElementById('txtObservacion').value = '';
    fillSelect(ENDPOINT_RESIDENTE, 'cbResidente', null);

});

//Agregar y actualizar información
document.getElementById('administrarVisita-form').addEventListener('submit',function(event){
    //Se evita que se recargue la pagina
    event.preventDefault();

    //Se evalua si el usuario esta haciendo una inserción o una actualización
    if (document.getElementById('btnAgregar').className != 'd-none') {
        saveRow(API_VISITA, 'createRow','administrarVisita-form', 'administrarVisita');
        document.getElementById('btnCamino').className="d-none";
    } else {
        saveRow(API_VISITA, 'updateRow','administrarVisita-form', 'administrarVisita');
    }
});

//Carga de datos del registro seleccionado
function readDataOnModal(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idVisita', id);
    console.log(id);

    //Se ocultan los botones del formulario.
    document.getElementById('btnAgregar').className="d-none";
    document.getElementById('btnActualizar').className="btn btnAgregarFormulario mr-2";

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
                        document.getElementById('btnSuspender').className="btn btnAgregarFormulario mr-2";
                        document.getElementById('btnCamino').className="btn btnAgregarFormulario mr-2";
                        document.getElementById('btnActivar').className="d-none";
                    }else if(response.dataset.idestadovisita == 5){
                        document.getElementById('btnActivar').className="btn btnAgregarFormulario mr-2";
                        document.getElementById('btnSuspender').className="d-none";
                        document.getElementById('btnCamino').className="d-none";

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
document.getElementById('btnSuspender').addEventListener('click',function(event){
    event.preventDefault();
    suspendRow(API_VISITA, 'administrarVisita-form','administrarVisita');
})

//Activar registros
document.getElementById('btnActivar').addEventListener('click',function(event){
    event.preventDefault();
    activateRow(API_VISITA, 'administrarVisita-form','administrarVisita');
})


//eliminar registros de la tabla visita.
function deleteRow(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idVisita', id);
    // Se llama a la función que elimina un registro.
    confirmDelete(API_VISITA, data);
}

//Busqueda por estado visita
document.getElementById('cbEstadoVisita').addEventListener('change',function(){
    //Guardando el valor del select en un input
    document.getElementById('idEstadoVisita').value = document.getElementById('cbEstadoVisita').value;
    //Presionando el boton invisible
    document.getElementById('btnFiltrarEstado').click();   
})

//Una vez presionado el boton invisible, se hace un fetch con la información del form.
document.getElementById('filtrarEstadoVisita-form').addEventListener('submit',function(event){
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
