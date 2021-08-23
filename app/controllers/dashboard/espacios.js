//constante para guardar la ruta de la api
const API_ESPACIO = '../../app/api/dashboard/espacios.php?action=';
const ENDPOINT_ESTADO = '../../app/api/dashboard/espacios.php?action=readSpaceStatus';


//Evento que se ejecuta al cargar la pag
document.addEventListener('DOMContentLoaded', function () {
    //Llenando combobox de estado espacio
    fillSelect(ENDPOINT_ESTADO, 'cbEstadoEspacio', null);
    //Verificar si hay espacios registrados en la base
    fetch(API_ESPACIO + 'readAll').then(request => {
        //Se verifica si la petición fue correcta
        if (request.ok) {
            request.json().then(response => {
                //Se verifica si la respuesta fue no fue satisfactoria de lo contrario no muestra nada
                if (response.status) {
                    readRows(API_ESPACIO);
                } else {
                    sweetAlert(4, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error));
})


//Llenado de tabla de espacios
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        if (row.imagenprincipal) {
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
                                    <a href="#" onclick="readDataOnModal(${row.idespacio}) " data-toggle="modal" data-target="#administrarEspacio" class="btn btnTabla"><span class="fas fa-edit"></span></a>
                                    <a href="#" onclick="deleteRow(${row.idespacio})" class="btn btnTabla2"><span class="fas fa-trash" ></span></a>
                                    <a href="#" onclick="readDataOnModal(${row.idespacio})"  data-toggle="modal" data-target="#modalReporte" class="btn btnTabla2"><span class="fas fa-file-alt" ></span></a>

                                </div>
                            </div>

                        <!-- Fin de Tarjeta -->
                        </div>
                    </div>
            `;
        } else {
            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            content += `
                    <div class="animate__animated animate__bounceIn col-xl-4 col-md-4 col-sm-12 col-xs-12 mt-2 d-flex margenTarjetas justify-content-center align-items-center text-center">
                        <!-- Inicio de Tarjeta -->
                        <div class="tarjeta">
                        <!-- Fila para Imagen -->
                            <div class="row">
                                <div class="col-12">
                                    <img src="../../resources/img/no-image.png" alt="#" class="img-fluid fit-images fotoEspacio imagenTarjeta">
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
                                    <a href="#" onclick="readDataOnModal(${row.idespacio}) " data-toggle="modal" data-target="#administrarEspacio" class="btn btnTabla"><span class="fas fa-edit"></span></a>
                                    <a href="#" onclick="deleteRow(${row.idespacio})" class="btn btnTabla2"><span class="fas fa-trash" ></span></a>
                                    <a href="#" onclick="readDataOnModal(${row.idespacio})"  data-toggle="modal" data-target="#modalReporte" class="btn btnTabla2"><span class="fas fa-file-alt" ></span></a>

                                </div>
                            </div>

                        <!-- Fin de Tarjeta -->
                        </div>
                    </div>
            `;
        }
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('show-tarjeta').innerHTML = content;
}

//Llenado de tabla de imagenes
function fillTableImage(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
                    <div class="animate__animated animate__bounceIn col-xl-4 col-md-4 col-sm-12 col-xs-12 mt-2 d-flex margenTarjetas justify-content-center align-items-center text-center">
                        <!-- Inicio de Tarjeta -->
                        <div class="tarjetaImage">
                        <!-- Fila para Imagen -->
                            <div class="row">
                                <div class="col-12">
                                <img src="../../resources/img/dashboard_img/espacios_fotos/${row.imagen}" alt="#" class="img-fluid fit-images fotoEspacioMultiple imagenTarjeta">
                                </div>
                            </div>
                            <!-- Fila para Boton -->
                            <div class="row">
                                <div class="col-12">
                                    <a href="#"  onclick="readDataOnModalImage(${row.idimagenesespacio})" data-toggle="modal" data-target="#administrarEspacio" class="btn btnTabla"><span class="fas fa-edit"></span></a>
                                    <a href="#" onclick="deleteRowImage(${row.idimagenesespacio})"  class="btn btnTabla2"><span class="fas fa-trash" ></span></a>
                                </div>
                            </div>

                        <!-- Fin de Tarjeta -->
                        </div>
                    </div>
            `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('show-tarjetaImage').innerHTML = content;
}

//Carga de datos del registro seleccionado del espacio
function readDataOnModal(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idEspacio', id);
    //Se ocultan los botones del formulario.
    document.getElementById('btnAgregar').className = 'd-none';
    document.getElementById('btnInsertDialogImagen').className = 'btn btnAgregarFormulario mr-2';
    document.getElementById('btnActualizar').className = 'btn btnAgregarFormulario mr-2';
    document.getElementById('btnActivar').className = 'd-none';
    document.getElementById('btnSuspender').className = 'd-none';

    fetch(API_ESPACIO + 'readOne', {
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
                    document.getElementById('idEspacio1').value = response.dataset.idespacio;
                    document.getElementById('idEspacio3').value = response.dataset.idespacio;
                    document.getElementById('txtNombre').value = response.dataset.nombre;
                    document.getElementById('txtEspacio').value = response.dataset.idespacio;
                    document.getElementById('txtEspacio2').value = response.dataset.idespacio;
                    document.getElementById('txtDescripcion').value = response.dataset.descripcion;
                    document.getElementById('txtCapacidad').value = response.dataset.capacidad;
                    document.getElementById('idEstadoEspacio1').value = response.dataset.idestadoespacio;
                    if (response.dataset.idestadoespacio == 1) {
                        document.getElementById('btnActivar').className = 'd-none';
                        document.getElementById('btnSuspender').className = 'btn btnAgregarFormulario mr-2';
                    } else if (response.dataset.idestadoespacio == 3) {
                        document.getElementById('btnActivar').className = 'btn btnAgregarFormulario mr-2';
                        document.getElementById('btnSuspender').className = 'd-none';
                    }
                    if (response.dataset.imagenprincipal) {
                        previewSavePicture('divFotografia1', response.dataset.imagenprincipal, 5);
                    } else {
                        previewSavePicture('divFotografia1', 'default.png', 5);
                    }
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
document.getElementById('espacio-form').addEventListener('submit', function (event) {
    //Evento para evitar que recargué la pagina
    event.preventDefault();
    //Verificando la acción que se va a realizar
    if (document.getElementById('btnAgregar').className != 'd-none') {
        //Agregando el registro
        saveRowBoolean(API_ESPACIO, 'createRow', 'espacio-form', 'administrarEspacio');
        //console.log('agregar')
    } else {
        //console.log('actualizar')
        saveRow(API_ESPACIO, 'updateRow', 'espacio-form', 'administrarEspacio');
    }
})

//Eliminar registros de la tabla empleado.
function deleteRow(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idEspacio', id);
    // Se llama a la función que elimina un registro.
    confirmDelete(API_ESPACIO, data);
}

//Suspendiendo el registro de la tabla
document.getElementById('btnSuspender').addEventListener('click', function (event) {
    //Evento para evitar que recargue la pagina
    event.preventDefault();
    //Se suspende el registro seleccionado
    suspendRow(API_ESPACIO, 'espacio-form', 'administrarEspacio');
})

//Activando el registro de la tabla
document.getElementById('btnActivar').addEventListener('click', function (event) {
    //Evento para evitar que recargue la pagina
    event.preventDefault();
    //Se suspende el registro seleccionado
    activateRow(API_ESPACIO, 'espacio-form', 'administrarEspacio');
})

//Buscando registros
document.getElementById('search-form').addEventListener('submit', function (event) {
    //Evitamos recargar la pagina
    event.preventDefault();
    //Llamamos la funcion
    searchRows(API_ESPACIO, 'search-form');
})


//Busqueda por estado de espacio

/*Cada vez que cambie el valor del select, se enviara a un input invisible y de igual forma se 
presionara un boton invisible para poder activar el evento submit del form*/
document.getElementById('cbEstadoEspacio').addEventListener('change', function (event) {
    //Se evita recargar la pagina
    event.preventDefault();
    //Guardando el valor del select en un input
    document.getElementById('idEstadoEspacio').value = document.getElementById('cbEstadoEspacio').value;
    //Presionando el boton invisible
    document.getElementById('btnFiltrarEspacio').click();
})

//Una vez presionado el boton invisible, se hace un fetch con la información del form.
document.getElementById('filtrarEstadoEspacio-form').addEventListener('submit', function (event) {
    //Se evita recargar la pagina
    event.preventDefault();
    //Se realiza el filtro
    filter(API_ESPACIO, 'filterSpaceStatus', 'filtrarEstadoEspacio-form');
})

//Método para resetear busqueda
document.getElementById('btnReiniciar').addEventListener('click', function (event) {
    //Se evita recargar la pagina
    event.preventDefault();
    readRows(API_ESPACIO);
    document.getElementById('search').value = '';
    fillSelect(ENDPOINT_ESTADO, 'cbEstadoEspacio', null);
});

//Método para resetear botones
document.getElementById('btnInsertDialog').addEventListener('click', function () {
    clearForm('espacio-form');
    document.getElementById('btnAgregar').className = 'btn btnAgregarFormulario mr-2';
    document.getElementById('btnActualizar').className = 'd-none';
    document.getElementById('btnActivar').className = 'd-none';
    document.getElementById('btnSuspender').className = 'd-none';
    document.getElementById('btnInsertDialogImagen').className = 'd-none';

    previewSavePicture('divFotografia1', 'default.png', 5);
})

//Método para resetear botones
document.getElementById('adminImagen').addEventListener('click', function () {
    previewSavePicture('divFotografia', 'default.png', 5);
    document.getElementById('btnAgregarImagen').className = 'btn btnAgregarFormulario mr-2';
    document.getElementById('btnActualizarImagen').className = 'd-none';
})

document.getElementById('agregar').addEventListener('click', function () {
    document.getElementById('btnAgregarImagen').className = 'btn btnAgregarFormulario mr-2';
    document.getElementById('btnActualizarImagen').className = 'd-none';
    previewSavePicture('divFotografia', 'default.png', 5);
    closeModal('administrarImagenes')
})

document.getElementById('btnInsertDialogImagen').addEventListener('click', function () {
    closeModal('administrarEspacio')
    readRowsImage(API_ESPACIO, 'ImagenEspacio-form');
})

//Carga de datos del registro seleccionado
function readDataOnModalImage(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idImagenEspacio', id);
    closeModal('administrarImagenes');
    document.getElementById('btnAgregarImagen').className = 'd-none';
    document.getElementById('btnActualizarImagen').className = 'btn btnAgregarFormulario mr-2';

    fetch(API_ESPACIO + 'readOneImage', {
        method: 'post',
        body: data
    }).then(request => {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(response => {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idEspacio1').value = response.dataset.idespacio;
                    document.getElementById('idEspacio3').value = response.dataset.idespacio;
                    document.getElementById('idImagenEspacio').value = response.dataset.idimagenesespacio;
                    document.getElementById('idImagenEspacio1').value = response.dataset.idimagenesespacio;
                    previewSavePicture('divFotografia', response.dataset.imagen, 5);
                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error));
}

//Eliminar registros de la tabla empleado.
function deleteRowImage(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idImagenEspacio', id);

    swal({
        title: 'Advertencia',
        text: '¿Desea eliminar el registro?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
        if (value) {
            fetch(API_ESPACIO + 'deleteImage', {
                method: 'post',
                body: data
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            // Se cargan nuevamente las filas en la tabla de la vista después de borrar un registro.
                            readRows(API_ESPACIO);
                            readRowsImage(API_ESPACIO, 'ImagenEspacio-form');
                            sweetAlert(1, response.message, null);
                        } else {
                            sweetAlert(2, response.exception, null);
                            console.log(response.status + ' ' + response.statusText);
                        }
                    });
                } else {
                    console.log(request.status + ' ' + request.statusText);
                }
            }).catch(function (error) {
                console.log(error);
            });
        }
    });
}



/*Agregando o actualizando un nuevo registro a la tabla
  Se verifica si se muestra el botón agregar se hace un createRow, de lo contrario un updateRow*/
document.getElementById('espacioImagen-form').addEventListener('submit', function (event) {
    //Evento para evitar que recargué la pagina
    event.preventDefault();
    //Verificando la acción que se va a realizar
    if (document.getElementById('btnAgregarImagen').className != 'd-none') {
        //Verificando la acción que se va a realizar
        savePhoto(API_ESPACIO, 'savePhoto', 'espacioImagen-form');

    } else {
        fetch(API_ESPACIO + 'updatePhoto', {
            method: 'post',
            body: new FormData(document.getElementById('espacioImagen-form'))
        }).then(function (request) {
            // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
            if (request.ok) {
                request.json().then(function (response) {
                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                    if (response.status) {
                        // Se cargan nuevamente las filas en la tabla de la vista después de borrar un registro.
                        readRows(API_ESPACIO);
                        sweetAlert(1, response.message, closeModal('administrarImagenes'));

                    } else {
                        sweetAlert(2, response.exception, null);
                        console.log(response.status + ' ' + response.statusText);
                    }
                });
            } else {
                console.log(request.status + ' ' + request.statusText);
            }
        }).catch(function (error) {
            console.log(error);
        });
    }
})

//Metodo para usar un boton diferente de examinar
botonExaminar('btnAgregarFoto', 'archivo_espacio');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPicture5('archivo_espacio', 'divFotografia');

//Metodo para usar un boton diferente de examinar
botonExaminar('btnAgregarFoto1', 'archivo_espacio1');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPicture5('archivo_espacio1', 'divFotografia1');

function botonExaminar(idBoton, idInputExaminar) {
    document.getElementById(idBoton).addEventListener('click', function (event) {
        //Se evita recargar la pagina
        event.preventDefault();

        //Se hace click al input invisible
        document.getElementById(idInputExaminar).click();
    });
}

function previewPicture5(idInputExaminar, idDivFoto) {
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
            image.className = 'fit-images fotoEspacioModal';

            //Se quita lo que este dentro del div (en caso de que exista otra imagen)
            preview.innerHTML = ' ';

            //Se agrega el elemento recien creado
            preview.append(image);
        }
    }
}

document.getElementById('fecha-form').addEventListener('submit', function (event) {
    //Evento para evitar que recargué la pagina
    event.preventDefault();
    // Realizamos una peticion a la API indicando el caso a utilizar y enviando la direccion de la API como parametro
    fetch(API_ESPACIO + 'readOne2', {
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

document.getElementById('btnReporte2').addEventListener('click', function (event) {
    //Evento para evitar que recargué la pagina
    event.preventDefault();
    // Realizamos una peticion a la API indicando el caso a utilizar y enviando la direccion de la API como parametro
    fetch(API_ESPACIO + 'readOne3', {
        method: 'post',
        body: new FormData(document.getElementById('report-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Abrimos el reporte mediante su URL 
                    window.open("../../app/reports/dashboard/alquileres_espacio.php", "");
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