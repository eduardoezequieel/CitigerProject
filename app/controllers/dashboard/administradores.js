//Constante para la direccion de la API
const API_EMPLEADO = '../../app/api/dashboard/administradores.php?action=';
const ENDPOINT_TIPOS = '../../app/api/dashboard/administradores.php?action=readEmployeeTypes';

document.addEventListener('DOMContentLoaded', function(){
    //Función para verificar permiso 
    checkPermissions('Usuarios');
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
                            <img src="../../resources/img/dashboard_img/usuarios_fotos/${row.foto}" alt="#"
                                class="rounded-circle fit-images" width="30px" height="30px">
                        </div>
                    </div>
                </th>
                <!-- Datos-->
                <td>${row.nombre}</td>
                <td>${row.dui}</td>
                <td>${row.telefonofijo}</td>
                <td>${row.estadousuario}</td>
                <!-- Boton-->
                <th scope="row">
                    <div class="row paddingBotones">
                        <div class="col-12">
                            <a href="#" onclick="readDataOnModal(${row.idusuario}) "data-toggle="modal" data-target="#administrarAdmin" class="btn btnTabla mx-2"><i class="fas fa-edit"></i></a>

                            <a href="#" onclick="deleteRow(${row.idusuario})" class="btn btnTabla2 mx-2"><i class="fas fa-trash"></i></a>
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

document.getElementById('btnReiniciar').addEventListener('click',function(){
    readRows(API_EMPLEADO);
    fillSelect(ENDPOINT_TIPOS, 'cbTipoEmpleado', null);

});

//---------------------------Operaciones CRUD---------------------------


//ocultar los demas botones de acción en el formulario al presionar Agregar.
document.getElementById('btnInsertDialog').addEventListener('click',function(){
    document.getElementById('btnAgregar').className="btn btnAgregarFormulario mr-2";
    document.getElementById('btnActualizar').className="d-none";
    document.getElementById('btnSuspender').className="d-none";
    document.getElementById('btnActivar').className="d-none";

    // Se reinician los campos del formulario
    document.getElementById('txtId').value = '';
    document.getElementById('txtNombre').value = '';
    document.getElementById('txtApellido').value = '';
    document.getElementById('txtDUI').value = '';
    document.getElementById('txtNombre').value = '';
    document.getElementById('txtTelefonomovil').value = '';
    document.getElementById('txtTelefonofijo').value = '';
    document.getElementById('txtCorreo').value = '';

    fillSelect(ENDPOINT_TIPOS, 'cbTipoEmpleado2', null);
    previewSavePicture('divFoto', 'default.png', 1);

    document.getElementById('txtDireccion').value = '';
});

//Carga de datos del registro seleccionado
function readDataOnModal(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('txtId', id);
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
                    document.getElementById('txtId').value = response.dataset.idusuario;
                    document.getElementById('txtUsuario').value = response.dataset.username;
                    document.getElementById('txtNombre').value = response.dataset.nombre;
                    document.getElementById('txtApellido').value = response.dataset.apellido;
                    document.getElementById('txtDUI').value = response.dataset.dui;
                    document.getElementById('txtNombre').value = response.dataset.nombre;
                    document.getElementById('txtTelefonofijo').value = response.dataset.telefonofijo;
                    document.getElementById('txtTelefonomovil').value = response.dataset.telefonocelular;
                    document.getElementById('txtCorreo').value = response.dataset.correo;
                    document.getElementById('cbGenero').value = response.dataset.genero;
                    fillSelect(ENDPOINT_TIPOS, 'cbTipoEmpleado2', response.dataset.idtipousuario);
                    document.getElementById('txtFechaNacimiento').value = response.dataset.fechanacimiento;
                    document.getElementById('txtDireccion').value = response.dataset.direccion;
                    previewSavePicture('divFoto', response.dataset.foto,1);
                    if (response.dataset.idestadousuario == 1) {
                        document.getElementById('btnSuspender').className="btn btnAgregarFormulario mr-2";
                        document.getElementById('btnActivar').className="d-none";
                    }else if(response.dataset.idestadousuario == 2){
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


document.getElementById('administrarEmpleado-form').addEventListener('submit',function(event){
    //Se evita que se recargue la pagina
    event.preventDefault();
    //Se evalua si el usuario esta haciendo una inserción o una actualización
    if (document.getElementById('btnAgregar').className != 'd-none') {
        fetch(API_EMPLEADO + 'register', {
            method: 'post',
            body: new FormData(document.getElementById('administrarEmpleado-form'))
        }).then(function (request) {
            // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
            if (request.ok) {
                request.json().then(function (response) {
                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                    if (response.status) {
                        // Se cargan nuevamente las filas en la tabla de la vista después de agregar o modificar un registro.
                        readRows(API_EMPLEADO);
                        sweetAlert(1, response.message, closeModal('administrarAdmin'));
                        clearForm('administrarEmpleado-form');
                        document.getElementById('txtCorreo').value = response.correo;
                        document.getElementById('txtUsuario').value = response.username;
                        document.getElementById('txtContrasenia').value = response.contrasenia;
                        fetch(API_EMPLEADO + 'sendEmail', {
                            method: 'post',
                            body: new FormData(document.getElementById('administrarEmpleado-form'))
                        }).then(function (request) {
                            // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                            if (request.ok) {
                                request.json().then(function (response) {
                                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                                    if (response.status) {
                                        //sweetAlert(1, response.message, null);
                                        clearForm('administrarEmpleado-form');
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
    } else {
        saveRow(API_EMPLEADO, 'updateRow','administrarEmpleado-form', 'administrarAdmin');
    }
});

//Suspender registros
document.getElementById('btnSuspender').addEventListener('click',function(event){
    event.preventDefault();
    suspendRow(API_EMPLEADO, 'administrarEmpleado-form','administrarAdmin');
})

//Activar registros
document.getElementById('btnActivar').addEventListener('click',function(event){
    event.preventDefault();
    activateRow(API_EMPLEADO, 'administrarEmpleado-form','administrarAdmin');


})


//eliminar registros de la tabla empleado.
function deleteRow(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('txtId', id);
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
