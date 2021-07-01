//Constante para la ruta de la API
const API_MARCAS = '../../app/api/dashboard/marcas.php?action=';


//Cuando se carga la pagina web
document.addEventListener('DOMContentLoaded', function(){
    readRows(API_MARCAS);
});

//Llenado de tabla
function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr class="animate__animated animate__fadeIn">
                <!--Icono-->
                <th scope="row">
                    <div class="row paddingTh">
                        <div class="col-12">
                            <img src="../../resources/img/brand.png" alt="#"
                                class="rounded-circle fit-images" width="25px" height="25px">
                        </div>
                    </div>
                </th>
                <!-- Datos-->
                <td>${row.marca}</td>
                <!-- Boton-->
                <th scope="row">
                    <div class="row paddingBotones">
                        <div class="col-6">
                            <a href="#" onclick="readDataOnModal(${row.idmarca}) "data-toggle="modal" data-target="#administrarMarcas" class="btn btnTabla mx-2"><i class="fas fa-edit"></i></a>

                            <a href="#" onclick="deleteRow(${row.idmarca})" class="btn btnTabla2 mx-2"><i class="fas fa-trash"></i></a>
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
    readRows(API_MARCAS);
});

//---------------------------Operaciones CRUD---------------------------


//ocultar los demas botones de acción en el formulario al presionar Agregar.
document.getElementById('btnInsertDialog').addEventListener('click',function(){
    document.getElementById('btnAgregar').className="btn btnAgregarFormulario mr-2";
    document.getElementById('btnActualizar').className="d-none";

    // Se reinician los campos del formulario
    document.getElementById('idMarca').value = '';
    document.getElementById('txtNombre').value = '';
});

//agregar marca
document.getElementById('btnAgregar').addEventListener('click',function(){
    document.getElementById('administrarMarcas-form').addEventListener('submit',function(event){
        event.preventDefault();
        //Fetch para registrar Marca
        fetch(API_MARCAS + 'createRow', {
            method: 'post',
            body: new FormData(document.getElementById('administrarMarcas-form'))
        }).then(request => {
            //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
            if (request.ok) {
                request.json().then(response => {
                    //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                    if (response.status) {
                        readRows(API_MARCAS);
                        sweetAlert(1, response.message, closeModal('administrarMarcas'));
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

//Carga de datos del registro seleccionado
function readDataOnModal(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idMarca', id);
    console.log(id);

    //Se ocultan los botones del formulario.
    document.getElementById('btnAgregar').className="d-none";
    document.getElementById('btnActualizar').className="btn btnAgregarFormulario mr-2";

    fetch(API_MARCAS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idMarca').value = response.dataset.idmarca;
                    document.getElementById('txtNombre').value = response.dataset.marca;

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

    document.getElementById('administrarMarcas-form').addEventListener('submit',function(event){
        event.preventDefault();
        //Fetch para actualizar Marca
        fetch(API_MARCAS + 'updateRow', {
            method: 'post',
            body: new FormData(document.getElementById('administrarMarcas-form'))
        }).then(request => {
            //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
            if (request.ok) {
                request.json().then(response => {
                    //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                    if (response.status) {
                        readRows(API_MARCAS);
                        sweetAlert(1, response.message, closeModal('administrarMarcas'));
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

//eliminar registros de la tabla marca.
function deleteRow(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idMarca', id);
    // Se llama a la función que elimina un registro.
    confirmDelete(API_MARCAS, data);
}

//---------------------------BUSQUEDAS EN LA TABLA---------------------------

//Busqueda común

/*En el evento submit del formulario llamamos una funcion que ya tiene especificado un fetch para
las busquedas.*/
document.getElementById('search-form').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();

    //Llamamos la funcion
    searchRows(API_MARCAS, 'search-form');
})