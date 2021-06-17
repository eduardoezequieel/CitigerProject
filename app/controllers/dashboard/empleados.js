//Constante para la direccion de la API
const API_EMPLEADO = '../../app/api/dashboard/empleados.php?action=';
const ENDPOINT_TIPOS = '../../app/api/dashboard/empleados.php?action=readEmployeeTypes';

document.addEventListener('DOMContentLoaded', function(){
    // Se declara e inicializa un objeto para obtener la fecha y hora actual.
    let today = new Date();
    // Se declara e inicializa una variable para guardar el día en formato de 2 dígitos.
    let day = ('0' + today.getDate()).slice(-2);
    // Se declara e inicializa una variable para guardar el mes en formato de 2 dígitos.
    var month = ('0' + (today.getMonth() + 1)).slice(-2);
    // Se declara e inicializa una variable para guardar el año con la mayoría de edad.
    let year = today.getFullYear() - 18;
    // Se declara e inicializa una variable para establecer el formato de la fecha.
    let date = `${year}-${month}-${day}`;
    // Se asigna la fecha como valor máximo en el campo del formulario.
    document.getElementById('txtFechaNacimiento').setAttribute('max', date);
    document.getElementById('txtFechaNacimiento').setAttribute('value', date);

    fillSelect(ENDPOINT_TIPOS, 'cbTipoEmpleado', null);
    fillSelect(ENDPOINT_TIPOS, 'cbTipoEmpleado2', null);
    readRows(API_EMPLEADO);
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
                            <img src="../../resources/img/dashboard_img/empleados_fotos/${row.foto}" alt="#"
                                class="rounded-circle fit-images" width="30px" height="30px">
                        </div>
                    </div>
                </th>
                <!-- Datos-->
                <td>${row.nombre}</td>
                <td>${row.dui}</td>
                <td>${row.telefono}</td>
                <td>${row.estadoempleado}</td>
                <td>${row.tipoempleado}</td>
                <!-- Boton-->
                <th scope="row">
                    <div class="row paddingBotones">
                        <div class="col-12">
                            <a href="#" onclick="readDataOnModal(${row.idempleado}) "data-toggle="modal" data-target="#administrarEmpleado" class="btn btnTabla mx-2"><i class="fas fa-edit"></i></a>

                            <a href="#" onclick="deleteRow(${row.idempleado})" class="btn btnTabla2 mx-2"><i class="fas fa-trash"></i></a>
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
    readRows(API_EMPLEADO);
});

//---------------------------Operaciones CRUD---------------------------


//ocultar los demas botones de acción en el formulario al presionar Agregar.
document.getElementById('btnInsertDialog').addEventListener('click',function(){
    document.getElementById('btnAgregar').className="btn btnAgregarFormulario mr-2";
    document.getElementById('btnActualizar').className="d-none";
    document.getElementById('btnSuspender').className="d-none";
    document.getElementById('btnActivar').className="d-none";

    // Se reinician los campos del formulario
    document.getElementById('idEmpleado').value = '';
    document.getElementById('txtNombre').value = '';
    document.getElementById('txtApellido').value = '';
    document.getElementById('txtDUI').value = '';
    document.getElementById('txtNombre').value = '';
    document.getElementById('txtTelefono').value = '';
    document.getElementById('txtCorreo').value = '';

    fillSelect(ENDPOINT_TIPOS, 'cbTipoEmpleado2', null);
    
    document.getElementById('txtDireccion').value = '';
    previewSavePicture('divFoto', null, 2);
});

//agregar registros a la tabla de empleados
document.getElementById('btnAgregar').addEventListener('click',function(){
    document.getElementById('administrarEmpleado-form').addEventListener('submit',function(event){
        event.preventDefault();
        //Fetch para registrar empleado
        fetch(API_EMPLEADO + 'createRow', {
            method: 'post',
            body: new FormData(document.getElementById('administrarEmpleado-form'))
        }).then(request => {
            //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
            if (request.ok) {
                request.json().then(response => {
                    //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                    if (response.status) {
                        readRows(API_EMPLEADO);
                        sweetAlert(1, response.message, closeModal('administrarEmpleado'));
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
    data.append('idEmpleado', id);
    console.log(id);

    //Se ocultan los botones del formulario.
    document.getElementById('btnAgregar').className="d-none";
    document.getElementById('btnActualizar').className="btn btnAgregarFormulario mr-2";

    fetch(API_EMPLEADO + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idEmpleado').value = response.dataset.idempleado;
                    document.getElementById('txtNombre').value = response.dataset.nombre;
                    document.getElementById('txtApellido').value = response.dataset.apellido;
                    document.getElementById('txtDUI').value = response.dataset.dui;
                    document.getElementById('txtNombre').value = response.dataset.nombre;
                    document.getElementById('txtTelefono').value = response.dataset.telefono;
                    document.getElementById('txtCorreo').value = response.dataset.correo;
                    document.getElementById('cbGenero').value = response.dataset.genero;
                    fillSelect(ENDPOINT_TIPOS, 'cbTipoEmpleado2', response.dataset.idtipoempleado);
                    document.getElementById('txtFechaNacimiento').value = response.dataset.fechanacimiento;
                    document.getElementById('txtDireccion').value = response.dataset.direccion;
                    previewSavePicture('divFoto', response.dataset.foto,2);
                    if (response.dataset.idestadoempleado == 1) {
                        document.getElementById('btnSuspender').className="btn btnAgregarFormulario mr-2";
                        document.getElementById('btnActivar').className="d-none";
                    }else if(response.dataset.idestadoempleado == 3){
                        document.getElementById('btnActivar').className="btn btnAgregarFormulario mr-2";
                        document.getElementById('btnSuspender').className="d-none";
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


//actualizar registros
document.getElementById('btnActualizar').addEventListener('click',function(event){

    document.getElementById('administrarEmpleado-form').addEventListener('submit',function(event){
        event.preventDefault();
        //Fetch para actualizar empleado
        fetch(API_EMPLEADO + 'updateRow', {
            method: 'post',
            body: new FormData(document.getElementById('administrarEmpleado-form'))
        }).then(request => {
            //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
            if (request.ok) {
                request.json().then(response => {
                    //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                    if (response.status) {
                        readRows(API_EMPLEADO);
                        sweetAlert(1, response.message, closeModal('administrarEmpleado'));
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

//Suspender registros
document.getElementById('btnSuspender').addEventListener('click',function(){

    document.getElementById('administrarEmpleado-form').addEventListener('submit',function(event){
        event.preventDefault();
        //Fetch para suspender empleado
        swal({
            title: 'Advertencia',
            text: '¿Desea suspender el registro?',
            icon: 'warning',
            buttons: ['No', 'Sí'],
            closeOnClickOutside: false,
            closeOnEsc: false
        }).then(function (value) {
            // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
            if (value) {
                fetch(API_EMPLEADO + 'suspendEmployee', {
                    method: 'post',
                    body: new FormData(document.getElementById('administrarEmpleado-form'))
                }).then(request => {
                    //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
                    if (request.ok) {
                        request.json().then(response => {
                            //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                            if (response.status) {
                                readRows(API_EMPLEADO);
                                sweetAlert(1, response.message, closeModal('administrarEmpleado'));
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
    
    });
})

//Activar registros
document.getElementById('btnActivar').addEventListener('click',function(){

    document.getElementById('administrarEmpleado-form').addEventListener('submit',function(event){
        event.preventDefault();
        //Fetch para suspender empleado
        swal({
            title: 'Advertencia',
            text: '¿Desea activar el registro?',
            icon: 'warning',
            buttons: ['No', 'Sí'],
            closeOnClickOutside: false,
            closeOnEsc: false
        }).then(function (value) {
            // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
            if (value) {
                fetch(API_EMPLEADO + 'activateEmployee', {
                    method: 'post',
                    body: new FormData(document.getElementById('administrarEmpleado-form'))
                }).then(request => {
                    //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
                    if (request.ok) {
                        request.json().then(response => {
                            //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                            if (response.status) {
                                readRows(API_EMPLEADO);
                                sweetAlert(1, response.message, closeModal('administrarEmpleado'));
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
    
    });
})

//eliminar registros de la tabla empleado.
function deleteRow(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idEmpleado', id);
    // Se llama a la función que elimina un registro.
    confirmDelete(API_EMPLEADO, data);
}

//---------------------------BUSQUEDAS EN LA TABLA---------------------------

//Busqueda común

/*En el evento submit del formulario llamamos una funcion que ya tiene especificado un fetch para
las busquedas.*/
document.getElementById('search-form').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();

    //Llamamos la funcion
    searchRows(API_EMPLEADO, 'search-form');
})



//Busqueda por tipo de empleado

/*Cada vez que cambie el valor del select, se enviara a un input invisible y de igual forma se 
presionara un boton invisible para poder activar el evento submit del form filtrarTipoEmpleado-form*/
document.getElementById('cbTipoEmpleado').addEventListener('change',function(){
    //Guardando el valor del select en un input
    document.getElementById('idTipoEmpleado').value = document.getElementById('cbTipoEmpleado').value;
    //Presionando el boton invisible
    document.getElementById('btnFiltrarEmpleado').click();   
})

//Una vez presionado el boton invisible, se hace un fetch con la información del form.
document.getElementById('filtrarTipoEmpleado-form').addEventListener('submit',function(event){
    //Se evita recargar la pagina
    event.preventDefault();

    fetch(API_EMPLEADO + 'filterByEmployeeType', {
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

//---------------------------METODOS NECESARIOS PARA LA CARGA DE FOTOS---------------------------


//Metodo para usar un boton diferente de examinar
botonExaminar('btnAgregarFoto', 'archivo_usuario');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPicture('archivo_usuario','divFoto');

function botonExaminar(idBoton, idInputExaminar){
    document.getElementById(idBoton).addEventListener('click', function(event){
        //Se evita recargar la pagina
        event.preventDefault();
    
        //Se hace click al input invisible
        document.getElementById(idInputExaminar).click();
    });
}

function previewPicture(idInputExaminar, idDivFoto){
    document.getElementById(idInputExaminar).onchange=function(e){

        //variable creada para obtener la URL del archivo a cargar
        let reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);
    
        //Se ejecuta al obtener una URL
        reader.onload=function(){
            //Parte de la pagina web en donde se incrustara la imagen
            let preview=document.getElementById(idDivFoto);
    
            //Se crea el elemento IMG que contendra la preview
            image = document.createElement('img');
    
            //Se le asigna la ruta al elemento creado
            image.src = reader.result;
    
            //Se aplican las respectivas clases para que la preview aparezca estilizada
            image.className = 'fit-images rounded-circle fotoPrimerUso';
    
            //Se quita lo que este dentro del div (en caso de que exista otra imagen)
            preview.innerHTML = ' ';
    
            //Se agrega el elemento recien creado
            preview.append(image);
        }
    }
}