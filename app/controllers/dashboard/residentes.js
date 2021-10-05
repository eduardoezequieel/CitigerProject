//Constante para la direccion de la API
const API_RESIDENTE = '../../app/api/dashboard/residentes.php?action=';

document.addEventListener('DOMContentLoaded', function () {
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
    readRows(API_RESIDENTE);

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
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
                            <img src="../../resources/img/dashboard_img/residentes_fotos/${row.foto}" alt="#"
                                class="rounded-circle fit-images" width="30px" height="30px">
                        </div>
                    </div>
                </th>
                <!-- Datos-->
                <td>${row.nombre}</td>
                <td>${row.dui}</td>
                <td>${row.telefonocelular}</td>
                <td>${row.estadoresidente}</td>
                <!-- Boton-->
                <th scope="row">
                    <div class="row paddingBotones">
                        <div class="col-12">
                            <a href="#" onclick="AsignarCasa(${row.idresidente})" data-toggle="modal" data-target="#casaResidente" class="btn btnTabla3 mx-2"><i class="fas fa-home"></i></a>

                            <a href="#" onclick="readDataOnModal(${row.idresidente}) "data-toggle="modal" data-target="#administrarResidente" class="btn btnTabla mx-2"><i class="fas fa-edit"></i></a>

                            <a href="#" onclick="deleteRow(${row.idresidente})" class="btn btnTabla2 mx-2"><i class="fas fa-trash"></i></a>

                            <a href="#" type="button" onclick="openReport(${row.idresidente}) "data-toggle="tooltip" data-placement="bottom" title="Reporte de denuncias realizadas por un residente" class="btn btnTabla"><i class="fas fa-file-alt"></i></a>

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

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
}

document.getElementById('btnReiniciar').addEventListener('click', function () {
    readRows(API_RESIDENTE);
});

//---------------------------Operaciones CRUD---------------------------


//ocultar los demas botones de acción en el formulario al presionar Agregar.
document.getElementById('btnInsertDialog').addEventListener('click', function () {
    document.getElementById('btnAgregar').className = "btn btnAgregarFormulario mr-2";
    document.getElementById('btnActualizar').className = "d-none";
    document.getElementById('btnSuspender').className = "d-none";
    document.getElementById('btnActivar').className = "d-none";

    // Se reinician los campos del formulario
    document.getElementById('idResidente').value = '';
    document.getElementById('txtNombre').value = '';
    document.getElementById('txtApellido').value = '';
    document.getElementById('txtDUI').value = '';
    document.getElementById('txtTelefonofijo').value = '';
    document.getElementById('txtTelefonomovil').value = '';
    document.getElementById('txtCorreo').value = '';
    document.getElementById('txtUser').value = '';
    previewSavePicture('divFoto', 'default.png', 1);

    //Función para limpiar la validación del lado del cliente
    clearForm('administrarResidente-form');
    document.getElementById('cbc1').classList.remove("success");
});

//Agregar y actualizar información
document.getElementById('administrarResidente-form').addEventListener('submit', function (event) {
    //Se evita que se recargue la pagina
    event.preventDefault();

    //Se evalua si el usuario esta haciendo una inserción o una actualización
    if (document.getElementById('btnAgregar').className != 'd-none') {
        fetch(API_RESIDENTE + 'createRow', {
            method: 'post',
            body: new FormData(document.getElementById('administrarResidente-form'))
        }).then(function (request) {
            // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
            if (request.ok) {
                request.json().then(function (response) {
                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                    if (response.status) {
                        // Se cargan nuevamente las filas en la tabla de la vista después de agregar o modificar un registro.
                        readRows(API_RESIDENTE);
                        sweetAlert(1, response.message, closeModal('administrarResidente'));
                        clearForm('administrarResidente-form');
                        document.getElementById('txtCorreo').value = response.correo;
                        document.getElementById('txtUser').value = response.username;
                        document.getElementById('txtContrasenia').value = response.contrasenia;
                        fetch(API_RESIDENTE + 'sendEmail', {
                            method: 'post',
                            body: new FormData(document.getElementById('administrarResidente-form'))
                        }).then(function (request) {
                            // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                            if (request.ok) {
                                request.json().then(function (response) {
                                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                                    if (response.status) {
                                        //sweetAlert(1, response.message, null);
                                        clearForm('administrarResidente-form');
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
        saveRow(API_RESIDENTE, 'updateRow', 'administrarResidente-form', 'administrarResidente');
    }
});

/*
//agregar registros a la tabla de residentes
document.getElementById('btnAgregar').addEventListener('click',function(){
    document.getElementById('administrarResidente-form').addEventListener('submit',function(event){
        event.preventDefault();
        //Fetch para registrar residente
        fetch(API_RESIDENTE + 'createRow', {
            method: 'post',
            body: new FormData(document.getElementById('administrarResidente-form'))
        }).then(request => {
            //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
            if (request.ok) {
                request.json().then(response => {
                    //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                    if (response.status) {
                        readRows(API_RESIDENTE);
                        sweetAlert(1, response.message, closeModal('administrarResidente'));
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
*/

//Carga de datos del registro seleccionado
function readDataOnModal(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idResidente', id);
    console.log(id);

    //Se ocultan los botones del formulario.
    document.getElementById('btnAgregar').className = "d-none";
    document.getElementById('btnActualizar').className = "btn btnAgregarFormulario mr-2";

    fetch(API_RESIDENTE + 'readOne', {
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
                    document.getElementById('txtNombre').value = response.dataset.nombre;
                    document.getElementById('txtApellido').value = response.dataset.apellido;
                    document.getElementById('txtDUI').value = response.dataset.dui;
                    document.getElementById('txtTelefonofijo').value = response.dataset.telefonofijo;
                    document.getElementById('txtTelefonomovil').value = response.dataset.telefonocelular;
                    document.getElementById('txtCorreo').value = response.dataset.correo;
                    document.getElementById('cbGenero').value = response.dataset.genero;
                    document.getElementById('txtFechaNacimiento').value = response.dataset.fechanacimiento;
                    document.getElementById('txtUser').value = response.dataset.username;
                    previewSavePicture('divFoto', response.dataset.foto, 3);
                    if (response.dataset.idestadoresidente == 1) {
                        document.getElementById('btnSuspender').className = "btn btnAgregarFormulario mr-2";
                        document.getElementById('btnActivar').className = "d-none";
                    } else if (response.dataset.idestadoresidente == 2) {
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

//Actualizar registros 
document.getElementById('btnActualizar').addEventListener('click', function (event) {

    document.getElementById('administrarResidente-form').addEventListener('submit', function (event) {
        event.preventDefault();
        //Fetch para actualizar residente
        fetch(API_RESIDENTE + 'updateRow', {
            method: 'post',
            body: new FormData(document.getElementById('administrarResidente-form'))
        }).then(request => {
            //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
            if (request.ok) {
                request.json().then(response => {
                    //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                    if (response.status) {
                        readRows(API_RESIDENTE);
                        sweetAlert(1, response.message, closeModal('administrarResidente'));
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
document.getElementById('btnSuspender').addEventListener('click', function (event) {
    event.preventDefault();
    suspendRow(API_RESIDENTE, 'administrarResidente-form', 'administrarResidente');
})

//Activar registros
document.getElementById('btnActivar').addEventListener('click', function (event) {
    event.preventDefault();
    activateRow(API_RESIDENTE, 'administrarResidente-form', 'administrarResidente');


})
//eliminar registros de la tabla residente.
function deleteRow(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idResidente', id);
    // Se llama a la función que elimina un registro.
    confirmDelete(API_RESIDENTE, data);
}

//---------------------------BUSQUEDAS EN LA TABLA---------------------------

//Busqueda común

/*En el evento submit del formulario llamamos una funcion que ya tiene especificado un fetch para
las busquedas.*/
document.getElementById('search-form').addEventListener('submit', function (event) {
    //Evitamos recargar la pagina
    event.preventDefault();

    //Llamamos la funcion
    searchRows(API_RESIDENTE, 'search-form');
})

//---------------------------METODOS NECESARIOS PARA LA CARGA DE FOTOS---------------------------


//Metodo para usar un boton diferente de examinar
botonExaminar('btnAgregarFoto', 'archivo_residente');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPicture('archivo_residente', 'divFoto');

function botonExaminar(idBoton, idInputExaminar) {
    document.getElementById(idBoton).addEventListener('click', function (event) {
        //Se evita recargar la pagina
        event.preventDefault();

        //Se hace click al input invisible
        document.getElementById(idInputExaminar).click();
    });
}

function previewPicture(idInputExaminar, idDivFoto) {
    document.getElementById(idInputExaminar).onchange = function (e) {

        //variable creada para obtener la URL del archivo a cargar
        let reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);

        //Se ejecuta al obtener una URL
        reader.onload = function () {
            //Parte de la pagina web en donde se incrustara la imagen
            let preview = document.getElementById(idDivFoto);

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


function AsignarCasa(id) {


    document.getElementById('txtIdCasa').value = '';
    document.getElementById('casa').textContent = 'Sin asignar';


    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('txtIdx', id);
    console.log(id);


    fetch(API_RESIDENTE + 'readCasa', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('txtIdx').value = response.dataset.idresidente;
                    document.getElementById('txtIdCasa').value = response.dataset.idcasa;
                    document.getElementById('casa').textContent = (response.dataset.casa);

                } else {
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });

    document.getElementById('txtIdx').value = id;
    readRows3(API_RESIDENTE);


}

function readRows3(API_RESIDENTE) {
    fetch(API_RESIDENTE + 'readCasas', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;
                } else {
                    sweetAlert(4, response.exception, null);
                }
                // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                fillTable2(data);
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

//Llenado de tabla
function fillTable2(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <tr class="animate__animated animate__fadeIn">
        <td># ${row.numerocasa}</td>
        <td>${row.direccion}</td>
        <!-- Boton-->
        <th scope="row">
            <div class="row paddingBotones">
                <div class="col-12">
                    <a href="#" id="btnResidenteCasa" onclick="ResidenteCasa(${row.idcasa})" class="btn btnTabla mx-2"><i class="fas fa-plus"></i></a>
                </div>
            </div>
        </th>
    </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows2').innerHTML = content;
}

function searchRows2(API_RESIDENTE, form) {
    fetch(API_RESIDENTE + 'searchCasa', {
        method: 'post',
        body: new FormData(document.getElementById(form))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                    fillTable2(response.dataset);
                    sweetAlert(1, response.message, null);
                } else {
                    sweetAlert(2, response.exception, null);
                    console.log("error");
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}


document.getElementById('search-form2').addEventListener('submit', function (event) {
    //Evitamos recargar la pagina
    event.preventDefault();

    //Llamamos la funcion
    searchRows2(API_RESIDENTE, 'search-form2');
})


function ResidenteCasa(id) {

    document.getElementById('txtCasa').value = id;
    if (document.getElementById('txtIdCasa').value) {
        saveRow(API_RESIDENTE, 'updateResidenteCasa', 'casa-form', 'casaResidente');

    } else {
        saveRow(API_RESIDENTE, 'createResidenteCasa', 'casa-form', 'casaResidente');

    }




}


function openReport(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('txtId', id);
    // Realizamos una peticion a la API indicando el caso a utilizar y enviando la direccion de la API como parametro
    fetch(API_RESIDENTE + 'readOne2', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            // Abrimos el reporte mediante su URL 
            window.open("../../app/reports/dashboard/denuncias.php","");
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });

}

$(document).ready(function(){
    $("#txtDUI").mask("00000000-0");
    $("#txtTelefonofijo").mask("0000-0000");
    $("#txtTelefonomovil").mask("0000-0000");
});