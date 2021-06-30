const API_CASAS = '../../app/api/dashboard/aportaciones.php?action=';
const ENDPOINT_TIPOS = '../../app/api/dashboard/aportaciones.php?action=readEmployeeTypes';


document.addEventListener('DOMContentLoaded', function () {


    fillSelect(ENDPOINT_TIPOS, 'cbTipoEmpleado', null);
    readRows(API_CASAS);
    let today = new Date();
    // Se declara e inicializa una variable para guardar el día en formato de 2 dígitos.
    let day = ('0' + today.getDate()).slice(-2);
    // Se declara e inicializa una variable para guardar el mes en formato de 2 dígitos.
    var month = ('0' + (today.getMonth() + 1)).slice(-2);
    // Se declara e inicializa una variable para guardar el año con la mayoría de edad.
    let year = today.getFullYear() ;
    // Se declara e inicializa una variable para establecer el formato de la fecha.
    let date = `${year}-${month}-${day}`;
    document.getElementById('lblFecha').textContent = date;


})


//ocultar los demas botones de acción en el formulario al presionar Agregar.
document.getElementById('btnInsertDialog').addEventListener('click', function () {
    document.getElementById('btnAgregar').className = "btn btnAgregarFormulario mr-2";
    document.getElementById('btnActualizar').className = "d-none";
    document.getElementById('btnSuspender').className = "d-none";
    document.getElementById('btnActivar').className = "d-none";

    // Se reinician los campos del formulario
    document.getElementById('txtId').value = '';
    document.getElementById('txtNum').value = '';
    document.getElementById('txtUbicacion').value = '';

});

document.getElementById('adminCasa-form').addEventListener('submit', function (event) {
    //Se evita que se recargue la pagina
    event.preventDefault();
    //Se evalua si el usuario esta haciendo una inserción o una actualización
    if (document.getElementById('btnAgregar').className != 'd-none') {
        saveRow(API_CASAS, 'createRow', 'adminCasa-form', 'administrarCasa');
    } else {
        saveRow(API_CASAS, 'updateRow', 'adminCasa-form', 'administrarCasa');
    }
});


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
                    <img src="../../resources/img/bluehouse.png" alt="" class="img-fluid" width="30px">
                </div>
            </div>
        </th>
        <!-- Datos-->
        <td>${row.casa}</td>
        <td>${row.estadocasa}</td>
        <!-- Boton-->
        <th scope="row">
            <div class="row paddingBotones">
                <div class="col-12">
                    <a href="#" onclick="readDataOnModal(${row.idcasa})" data-toggle="modal" data-target="#administrarCasa" class="btn btnTabla"><i class="fas fa-edit"></i></a>
                    <a href="#"  onclick="readAportacion(${row.idcasa})" data-toggle="modal" data-target="#administrarPago" class="btn btnTabla3"><i class="fas fa-comment-dollar"></i></a>
                    <a href="#" onclick="deleteRow(${row.idcasa})" class="btn btnTabla2"><i class="fas fa-trash"></i></a>
                </div>
            </div>
        </th>
    </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}


//Carga de datos del registro seleccionado
function readDataOnModal(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('txtId', id);
    console.log(id);

    //Se ocultan los botones del formulario.
    document.getElementById('btnAgregar').className = "d-none";
    document.getElementById('btnActualizar').className = "btn btnAgregarFormulario mr-2";

    fetch(API_CASAS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('txtId').value = response.dataset.idcasa;
                    document.getElementById('txtNum').value = response.dataset.numerocasa;
                    document.getElementById('txtUbicacion').value = response.dataset.direccion;
                    if (response.dataset.idestadocasa == 1) {
                        document.getElementById('btnSuspender').className = "btn btnAgregarFormulario mr-2";
                        document.getElementById('btnActivar').className = "d-none";
                    } else if (response.dataset.idestadocasa == 2) {
                        document.getElementById('btnActivar').className = "btn btnAgregarFormulario mr-2";
                        document.getElementById('btnSuspender').className = "d-none";
                    }

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


//eliminar registros de la tabla empleado.
function deleteRow(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('txtId', id);
    // Se llama a la función que elimina un registro.
    confirmDelete(API_CASAS, data);
}

//---------------------------BUSQUEDAS EN LA TABLA---------------------------

//Busqueda común

/*En el evento submit del formulario llamamos una funcion que ya tiene especificado un fetch para
las busquedas.*/
document.getElementById('search-form').addEventListener('submit', function (event) {
    //Evitamos recargar la pagina
    event.preventDefault();

    //Llamamos la funcion
    searchRows(API_CASAS, 'search-form');
})

//Suspender registros
document.getElementById('btnSuspender').addEventListener('click', function (event) {
    event.preventDefault();
    suspendRow(API_CASAS, 'adminCasa-form', 'administrarCasa');
})

//Activar registros
document.getElementById('btnActivar').addEventListener('click', function (event) {
    event.preventDefault();
    activateRow(API_CASAS, 'adminCasa-form', 'administrarCasa');


})


/*Cada vez que cambie el valor del select, se enviara a un input invisible y de igual forma se 
presionara un boton invisible para poder activar el evento submit del form filtrarTipoEmpleado-form*/
document.getElementById('cbTipoEmpleado').addEventListener('change', function () {
    //Guardando el valor del select en un input
    document.getElementById('idTipoEmpleado').value = document.getElementById('cbTipoEmpleado').value;
    //Presionando el boton invisible
    document.getElementById('btnFiltrarEmpleado').click();
})

//Una vez presionado el boton invisible, se hace un fetch con la información del form.
document.getElementById('filtrarTipoEmpleado-form').addEventListener('submit', function (event) {
    //Se evita recargar la pagina
    event.preventDefault();

    fetch(API_CASAS + 'filterByEmployeeType', {
        method: 'post',
        body: new FormData(document.getElementById('filtrarTipoEmpleado-form'))
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

document.getElementById('btnReiniciar').addEventListener('click', function () {
    readRows(API_CASAS);
    fillSelect(ENDPOINT_TIPOS, 'cbTipoEmpleado', null);

});


function readAportacion(id) {


    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('txtIdx', id);
    console.log(id);
  

    fetch(API_CASAS + 'readAportacion', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('txtIdx').value = response.dataset.idcasa;
                    document.getElementById('casa').textContent = (response.dataset.casa);

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

