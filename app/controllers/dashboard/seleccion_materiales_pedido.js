const API_PEDIDOS = '../../app/api/dashboard/pedidos.php?action=';

let cantidad = '';

document.addEventListener('DOMContentLoaded',function(){
    readMaterials(API_PEDIDOS);
});

function readMaterials(api) {
    fetch(api + 'readMaterials', {
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
                fillTable(data);
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 d-flex margenTarjetas justify-content-center align-items-center text-center">
            <!-- Inicio de Tarjeta -->
            <div class="tarjeta">
                <!-- Fila para Imagen -->
                <div class="row">
                    <div class="col-12">
                        <img src="../../resources/img/dashboard_img/materiales_fotos/${row.imagen}" alt=""
                            class="fit-images imagenTarjeta fotoMaterial">
                    </div>
                </div>
                <!-- Fila para Información -->
                <div class="row mt-2">
                    <div class="col-12 text-left">
                        <h1 class="letraTarjeta">${row.nombreproducto}</h1>
                        <h1 class="letraTarjeta">En Stock: <span class="letraDestacadaTarjeta">${row.cantidad}</span></h1>
                    </div>
                </div>
                <!-- Fila para Boton -->
                <div class="row">
                    <div class="col-12">
                        <a href="#" onclick="checkMaterial(${row.idmaterial})"  data-toggle="modal" data-target="#verMateriales" class="btn botonesTarjeta"><span class="fas fa-plus mr-2"></span>Agregar</a>
                    </div>
                </div>
                <!-- Fin de Tarjeta -->
            </div>
        </div>
        `; 
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}

function checkMaterial(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idMaterial', id);  

    fetch(API_PEDIDOS + 'readOneMaterial', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idMaterial').value = response.dataset.idmaterial;
                    document.getElementById('txtTitulo').textContent = response.dataset.nombreproducto;
                    document.getElementById('txtMarca').textContent = response.dataset.marca;
                    document.getElementById('txtCantidad').textContent = response.dataset.cantidad;
                    document.getElementById('txtUnidadMedida').textContent = response.dataset.unidadmedida;
                    document.getElementById('txtTamaño').textContent = response.dataset.tamaño;
                    document.getElementById('txtCosto').textContent = response.dataset.costo;
                    cantidad = response.dataset.cantidad;
                    if (cantidad == 0) {
                        document.getElementById('btnAgregarCarrito').className = 'd-none';
                        document.getElementById('controlesCantidad').className = 'd-none';
                    } else {
                        document.getElementById('btnAgregarCarrito').className = 'btn botonesListado';
                        document.getElementById('controlesCantidad').className = 'form-group d-flex justify-content-center align-items-center text-center';
                    }
                    document.getElementById('cantidadMaterial').textContent = '1';
                    document.getElementById('txtCantidadMaterial').value = '1';
                    previewSavePicture('divFoto', response.dataset.imagen, 4);

                    document.getElementById('txtPrecioMaterial').value = response.dataset.costo;
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

document.getElementById('btnMinus').addEventListener('click',function(event){
    event.preventDefault();
    var valor = document.getElementById('cantidadMaterial').textContent;
    valor--;
    if (valor == 0) {
        document.getElementById('cantidadMaterial').textContent = '1';
        sweetAlert(2, 'No puede colocar una cantidad nula.', null);
    } else {
        document.getElementById('cantidadMaterial').textContent = valor;
        document.getElementById('txtCantidadMaterial').value = valor;
    }
    
});

document.getElementById('btnPlus').addEventListener('click',function(event){
    event.preventDefault();
    var valor = document.getElementById('cantidadMaterial').textContent;
    if (valor == cantidad) {
        document.getElementById('cantidadMaterial').textContent = cantidad;
        sweetAlert(2, 'Ha llegado al limite en existencias.', null);
    } else {
        valor++;
        document.getElementById('cantidadMaterial').textContent = valor;
        document.getElementById('txtCantidadMaterial').value = valor;
    }
})

document.getElementById('btnMinus2').addEventListener('click',function(event){
    event.preventDefault();
    var valor = document.getElementById('cantidadMaterial2').textContent;
    valor--;
    if (valor == 0) {
        document.getElementById('cantidadMaterial2').textContent = '1';
        sweetAlert(2, 'No puede colocar una cantidad nula.', null);
    } else {
        document.getElementById('cantidadMaterial2').textContent = valor;
        document.getElementById('txtCantidadMaterial2').value = valor;
    }
    
});

document.getElementById('btnPlus2').addEventListener('click',function(event){
    event.preventDefault();
    var valor = document.getElementById('cantidadMaterial2').textContent;
    if (valor == cantidad) {
        document.getElementById('cantidadMaterial2').textContent = cantidad;
        sweetAlert(2, 'Ha llegado al limite en existencias.', null);
    } else {
        valor++;
        document.getElementById('cantidadMaterial2').textContent = valor;
        document.getElementById('txtCantidadMaterial2').value = valor;
    }
})

function readOrder() {
    fetch(API_PEDIDOS + 'readOrder', {
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
                    //sweetAlert(4, response.exception, null);
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

    fetch(API_PEDIDOS + 'getTotal', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById('lblTotal').textContent = response.dataset.total;
                } else {
                    //sweetAlert(4, response.exception, null);
                }
                // Se envían los datos a la función del controlador para que llene la tabla en la vista.
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function fillTable2(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <tr class="animate__animated animate__fadeIn">
            <!-- Datos-->
            <td>${row.nombreproducto}</td>
            <th scope="row">
                <div class="row paddingBotones">
                    <div class="col-12 d-flex justify-content-center">

                        <h1 class="cantidadNumeroLabel mt-2 mx-2" id="cantidadMaterialCart">${row.cantidadmaterial}</h1>

                        <a href="#" onclick="setCurrentCantidad(${row.iddetallematerial}, ${row.cantidadmaterial}, ${row.idmaterial})" data-toggle="modal" data-dismiss="modal" data-target="#actualizarCantidades" class="btn btnTabla"><i class="fas fa-edit"></i></a>
                    </div>
                </div>
            </th>
            <td>${row.preciomaterial}</td>
            <td>${row.totalunidad}</td>
            <!-- Boton-->
            <th scope="row">
                <div class="row paddingBotones">
                    <div class="col-12">
                        <a href="#" onclick="deleteFromCart(${row.iddetallematerial}, ${row.cantidadmaterial}, ${row.idmaterial})" class="btn btnTabla"><i class="fas fa-times"></i></a>
                    </div>
                </div>
            </th>
        </tr>
        `; 
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows2').innerHTML = content;
}

function deleteFromCart(id, cantidad, idmaterial){
    const data = new FormData();
    data.append('idDetalleMaterial', id);
    data.append('cantidadMaterial', cantidad);
    data.append('idMaterial', idmaterial);

    swal({
        title: 'Advertencia',
        text: '¿Desea eliminar el material del carrito?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
        if (value) {
            fetch(API_PEDIDOS + 'deleteFromCart', {
                method: 'post',
                body: data
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            // Se cargan nuevamente las filas en la tabla de la vista después de borrar un registro.
                            readOrder();
                            readMaterials(API_PEDIDOS);
                            sweetAlert(1, 'Material eliminado del carrito con exito.', null);
                        } else {
                            //sweetAlert(2, response.exception, null);
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

document.getElementById('btnActualizarCantidad').addEventListener('click',function(event){
    event.preventDefault();
    var cantidadNueva = document.getElementById('txtCantidadMaterial2').value;
    var cantidadAnterior = document.getElementById('txtGuardarCantidad').value;

    var total = cantidadNueva - cantidadAnterior;

    document.getElementById('txtRestante').value = total;
})

function setCurrentCantidad(iddetallematerial, cantidadactual, idmaterial){
    document.getElementById('txtIdDetalleMaterial').value = iddetallematerial;
    document.getElementById('cantidadMaterial2').textContent = cantidadactual; 
    document.getElementById('txtCantidadMaterial2').value = cantidadactual; 
    document.getElementById('txtIdMaterial').value = idmaterial; 
    document.getElementById('txtGuardarCantidad').value = cantidadactual;

    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idMaterial', idmaterial);  

    fetch(API_PEDIDOS + 'readOneMaterial', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    cantidad = response.dataset.cantidad;
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

document.getElementById('verMateriales-form').addEventListener('submit',function(event){
    event.preventDefault();

    fetch(API_PEDIDOS + 'addMaterialToOrder', {
        method: 'post',
        body: new FormData(document.getElementById('verMateriales-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    readMaterials(API_PEDIDOS);
                    sweetAlert(1, response.message, closeModal('verMateriales'));
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
})
