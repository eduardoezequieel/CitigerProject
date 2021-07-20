const API_MATERIAL = '../../app/api/dashboard/inventario.php?action=';
const ENDPOINT_TIPOS = '../../app/api/dashboard/inventario.php?action=readTipoUnidad';
const ENDPOINT_UNIDAD = '../../app/api/dashboard/inventario.php?action=cargarUnidadMedida';
const ENDPOINT_MARCAS = '../../app/api/dashboard/inventario.php?action=readMarca';
const ENDPOINT_CATEGORIAS = '../../app/api/dashboard/inventario.php?action=readCategoria';



document.addEventListener('DOMContentLoaded', function () {

    fillSelect(ENDPOINT_TIPOS, 'cbTipo', 1);
    fillSelect(ENDPOINT_MARCAS, 'cbMarca', null);
    fillSelect(ENDPOINT_CATEGORIAS, 'cbCategoria', null);
    fillSelect(ENDPOINT_CATEGORIAS, 'cbCategoria2', null);
    fillSelectSpace(ENDPOINT_UNIDAD, 'cbUnidad', null);

    readRows(API_MATERIAL);


})

document.getElementById('cbTipo').addEventListener('change',function(){
    document.getElementById('idTipoUnidad').value = document.getElementById('cbTipo').value;
    fillSelectSpace(ENDPOINT_UNIDAD, 'cbUnidad', null);
})

//ocultar los demas botones de acción en el formulario al presionar Agregar.
document.getElementById('btnInsertDialog').addEventListener('click', function () {
    document.getElementById('btnAgregar').className = "btn btnAgregarFormulario mr-2";
    document.getElementById('btnActualizar').className = "d-none";

    // Se reinician los campos del formulario
    document.getElementById('txtId').value = '';
    document.getElementById('txtNombres').value = '';
    document.getElementById('txtTamanio').value = '';
    document.getElementById('txtCosto').value = '';
    document.getElementById('txtCantidad').value = '';
    document.getElementById('txtDesc').value = '';

    fillSelect(ENDPOINT_TIPOS, 'cbTipo', 1);
    fillSelect(ENDPOINT_MARCAS, 'cbMarca', null);
    fillSelect(ENDPOINT_CATEGORIAS, 'cbCategoria', null);
    fillSelectSpace(ENDPOINT_UNIDAD, 'cbUnidad', null);

    previewSavePicture('divFoto', 'default.png', 4);

});

//Agregando un nuevo registro a la tabla
document.getElementById('btnAgregar').addEventListener('click', function (event) {
    //Evento para evitar que recargue la pagina
    event.preventDefault();
    //Se agrega el nuevo registro
    saveRow(API_MATERIAL, 'createRow', 'administrarMateriales-form', 'administrarInventario');
})

//Método para resetear busqueda
document.getElementById('btnReiniciar').addEventListener('click', function (event) {
    //Se evita recargar la pagina
    event.preventDefault();
    readRows(API_MATERIAL);
    fillSelect(ENDPOINT_CATEGORIAS, 'cbCategoria2', null);


});

//Buscando registros
document.getElementById('search-form').addEventListener('submit', function (event) {
    //Evitamos recargar la pagina
    event.preventDefault();
    //Llamamos la funcion
    searchRows(API_MATERIAL, 'search-form');

})

//Actualizando un registro de la tabla
document.getElementById('btnActualizar').addEventListener('click', function (event) {
    //Evento para evitar que recargue la pagina
    event.preventDefault();
    //Se agrega el nuevo registro
    saveRow(API_MATERIAL, 'updateRow', 'administrarMateriales-form', 'administrarInventario');
})

function fillSelectSpace(endpoint, select, selected) {
    fetch(endpoint, {
        method: 'post',
        body: new FormData(document.getElementById('administrarMateriales-form'))
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


document.getElementById('cbCategoria2').addEventListener('change', function () {
    //Guardando el valor del select en un input
    document.getElementById('idCategoria').value = document.getElementById('cbCategoria2').value;
    //Presionando el boton invisible
    document.getElementById('btnCategoria').click();
})

//Una vez presionado el boton invisible, se hace un fetch con la información del form.
document.getElementById('filtrarCategoria-form').addEventListener('submit', function (event) {
    //Se evita recargar la pagina
    event.preventDefault();

    fetch(API_MATERIAL + 'filterCategorias', {
        method: 'post',
        body: new FormData(document.getElementById('filtrarCategoria-form'))
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


//Carga de datos del registro seleccionado
function readDataOnModal(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('txtId', id);
    console.log(id);

    //Se ocultan los botones del formulario.
    document.getElementById('btnAgregar').className = "d-none";
    document.getElementById('btnActualizar').className = "btn btnAgregarFormulario mr-2";

    fetch(API_MATERIAL + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('txtId').value = response.dataset.idmaterial;
                    document.getElementById('txtNombres').value = response.dataset.nombreproducto;
                    document.getElementById('txtCosto').value = response.dataset.costo;
                    document.getElementById('txtTamanio').value = response.dataset.tamaño;
                    document.getElementById('txtDesc').value = response.dataset.descripcion;
                    document.getElementById('txtCantidad').value = response.dataset.cantidad;
                    fillSelect(ENDPOINT_MARCAS, 'cbMarca', response.dataset.idmarca);
                    fillSelect(ENDPOINT_CATEGORIAS, 'cbCategoria', response.dataset.idcategoria);
                    fillSelectSpace(ENDPOINT_UNIDAD, 'cbUnidad', null);
                    previewSavePicture('divFoto', response.dataset.imagen, 4);

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


//Llenado de cartas
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
                    <div class="animate__animated animate__bounceIn col-xl-4 col-md-4 col-sm-12 col-xs-12 mt-2 d-flex margenTarjetas justify-content-center align-items-center text-center">
                        <!-- Inicio de Tarjeta -->
                        <div class="tarjeta">
                        <!-- Fila para Imagen -->
                            <div class="row">
                                <div class="col-12">
                                    <img src="../../resources/img/dashboard_img/materiales_fotos/${row.imagen}" alt="#" class="img-fluid fit-images fotoMaterial imagenTarjeta">
                                </div>
                            </div>
                            <!-- Fila para Información -->
                            <div class="row mt-2">
                                <div class="col-12 text-left">
                                    <h1 class="letraTarjetaTitulo">${row.producto}</h1>
                                    <h1 class="letraTarjeta">En stock: <span class="letraDestacadaTarjeta">${row.cantidad}</span></h1>
                                </div>
                            </div>
                            <!-- Fila para Boton -->
                            <div class="row">
                                <div class="col-12">
                                    <a href="#" onclick="readDataOnModal(${row.idmaterial}) " data-toggle="modal" data-target="#administrarInventario" class="btn btnTabla"><span class="fas fa-edit"></span></a>
                                    <a href="#" onclick="deleteRow(${row.idmaterial})" class="btn btnTabla2"><span class="fas fa-trash" ></span></a>
                                </div>
                            </div>

                        <!-- Fin de Tarjeta -->
                        </div>
                    </div>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('materiales').innerHTML = content;
}



botonExaminar('btnAgregarFoto', 'archivo_usuario');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPicture('archivo_usuario', 'divFoto');

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
            image.className = 'img-fluid fit-images fotoMaterial';

            //Se quita lo que este dentro del div (en caso de que exista otra imagen)
            preview.innerHTML = ' ';

            //Se agrega el elemento recien creado
            preview.append(image);
        }
    }
}

//eliminar registros de la tabla materiales.
function deleteRow(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('txtId', id);
    // Se llama a la función que elimina un registro.
    confirmDelete(API_MATERIAL, data);
}

