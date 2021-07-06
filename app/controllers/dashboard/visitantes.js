//Constante para la direccion de la API
const API_VISITANTE = '../../app/api/dashboard/visitantes.php?action=';

document.addEventListener('DOMContentLoaded', function(){
    readRows(API_VISITANTE);
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
                            <img src="../../resources/img/usericon.png" alt="#"
                                class="rounded-circle fit-images" width="30px" height="30px">
                        </div>
                    </div>
                </th>
                <!-- Datos-->
                <td>${row.nombre}</td>
                <td>${row.dui}</td>
                <td>${row.placa}</td>
                <!-- Boton-->
                <th scope="row">
                    <div class="row paddingBotones">
                        <div class="col-12">
                            <a href="#" onclick="readDataOnModal(${row.idvisitante}) "data-toggle="modal" data-target="#administrarVisitante" class="btn btnTabla mx-2"><i class="fas fa-edit"></i></a>

                            <a href="#" onclick="deleteRow(${row.idvisitante})" class="btn btnTabla2 mx-2"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                </th>
            </tr>
        `; 
    });

    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;

    let dataTable = new DataTable('#data-table', { 
        labels: { 
            placeholder: 'Buscar visitantes...', 
            perPage: '{select} Visitantes por página', 
            noRows: 'No se encontraron visitantes', 
            info:'Mostrando {start} a {end} de {rows} visitantes' 
        } 
    });
}


document.getElementById('btnReiniciar').addEventListener('click',function(){
    readRows(API_VISITANTE);
});

//---------------------------Operaciones CRUD---------------------------


//ocultar los demas botones de acción en el formulario al presionar Agregar.
document.getElementById('btnInsertDialog').addEventListener('click',function(){
    document.getElementById('btnAgregar').className="btn btnAgregarFormulario mr-2";
    document.getElementById('btnActualizar').className="d-none";

    // Se reinician los campos del formulario
    document.getElementById('idVisitante').value = '';
    document.getElementById('txtNombre').value = '';
    document.getElementById('txtApellido').value = '';
    document.getElementById('txtDUI').value = '';
    document.getElementById('txtPlaca').value = '';
});

//Agregar y actualizar información
document.getElementById('administrarVisitante-form').addEventListener('submit',function(event){
    //Se evita que se recargue la pagina
    event.preventDefault();

    //Se evalua si el usuario esta haciendo una inserción o una actualización
    if (document.getElementById('btnAgregar').className != 'd-none') {
        saveRow(API_VISITANTE, 'createRow','administrarVisitante-form', 'administrarVisitante');
    } else {
        saveRow(API_VISITANTE, 'updateRow','administrarVisitante-form', 'administrarVisitante');
    }
});

//Carga de datos del registro seleccionado
function readDataOnModal(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idVisitante', id);
    console.log(id);

    //Se ocultan los botones del formulario.
    document.getElementById('btnAgregar').className="d-none";
    document.getElementById('btnActualizar').className="btn btnAgregarFormulario mr-2";

    fetch(API_VISITANTE + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idVisitante').value = response.dataset.idvisitante;
                    document.getElementById('txtNombre').value = response.dataset.nombre;
                    document.getElementById('txtApellido').value = response.dataset.apellido;
                    document.getElementById('txtDUI').value = response.dataset.dui;
                    document.getElementById('cbGenero').value = response.dataset.genero;
                    document.getElementById('txtPlaca').value = response.dataset.placa;

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

//Actualizar registros 
document.getElementById('btnActualizar').addEventListener('click',function(event){

    document.getElementById('administrarVisitante-form').addEventListener('submit',function(event){
        event.preventDefault();
        //Fetch para actualizar visitante
        fetch(API_VISITANTE + 'updateRow', {
            method: 'post',
            body: new FormData(document.getElementById('administrarVisitante-form'))
        }).then(request => {
            //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
            if (request.ok) {
                request.json().then(response => {
                    //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                    if (response.status) {
                        readRows(API_VISITANTE);
                        sweetAlert(1, response.message, closeModal('administrarVisitante'));
                    } else {
                        sweetAlert(2, response.exception, null);
                    }
                })
            } else {
                console.log(response.status + ' ' + response.exception);
            }
        }).catch(error => console.log(error));
    
    });
});

//eliminar registros de la tabla visitante.
function deleteRow(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idVisitante', id);
    // Se llama a la función que elimina un registro.
    confirmDelete(API_VISITANTE, data);
}

//---------------------------BUSQUEDAS EN LA TABLA---------------------------

//Busqueda común

/*En el evento submit del formulario llamamos una funcion que ya tiene especificado un fetch para
las busquedas.*/
document.getElementById('search-form').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();

    //Llamamos la funcion
    searchRows(API_VISITANTE, 'search-form');
})
