//Variable para la API
const API_PEDIDOS = '../../app/api/dashboard/pedidos.php?action=';

//Variable que se utiliza para capturar la cantidad maxima permitida en un producto (stock)
let cantidad = '';

document.addEventListener('DOMContentLoaded',function(){
    //Cargando productos del inventario listos para añadir a un pedido
    readMaterials(API_PEDIDOS);
});

//Cargando productos del inventario listos para añadir a un pedido
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

//Funcion filltable para cargar los productos con su respectiva informacion
function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <div class="col-xl-4 col-md-4 col-sm-12 mt-3 col-xs-12 d-flex margenTarjetas justify-content-center align-items-center text-center">
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

//Funcion para cargar los detalles de un producto al momento de seleccionarlo.
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

//Se ejecuta al disminuir la cantidad deseada de stock para el pedido
document.getElementById('btnMinus').addEventListener('click',function(event){
    //Se evita que se recargue la pagina
    event.preventDefault();
    //Se captura el valor del label en una variable
    var valor = document.getElementById('cantidadMaterial').textContent;
    //Se resta
    valor--;
    //Se evalua el valor seleccionado por el usuario, no esta permitido bajar de 1.
    if (valor == 0) {
        //Si el valor es igual a 0, se setea 1 en el label para evitar la cantidad nula.
        document.getElementById('cantidadMaterial').textContent = '1';
        sweetAlert(2, 'No puede colocar una cantidad nula.', null);
    } else {
        //Si el valor es mayor que 0, entonces se coloca en un input listo para su agregacion al carrito.
        document.getElementById('cantidadMaterial').textContent = valor;
        document.getElementById('txtCantidadMaterial').value = valor;
    }
    
});

//Se ejecuta al sumar la cantidad deseada de stock para el pedido
document.getElementById('btnPlus').addEventListener('click',function(event){
    //Se evita que se recargue la pagina
    event.preventDefault();
    //Se evalua el valor seleccionado por el usuario, no esta permitido superar el stock registrado.
    var valor = document.getElementById('cantidadMaterial').textContent;
    if (valor == cantidad) {
        /*Si el valor ingresado es mayor al stock, se regresa al maximo valor permitido y se le notifica
        al usuario.*/
        document.getElementById('cantidadMaterial').textContent = cantidad;
        sweetAlert(2, 'Ha llegado al limite en existencias.', null);
    } else {
        /*Si el valor es menor o igual al stock permitido, entonces se coloca en un input listo 
        para su agregacion al carrito luego de aumentar su valor en uno.*/
        valor++;
        document.getElementById('cantidadMaterial').textContent = valor;
        document.getElementById('txtCantidadMaterial').value = valor;
    }
})

/*Se ejecuta cuando el usuario presiona el boton agregar en el modal del producto.*/
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

//Se ejecuta para capturar los materiales seleccionados para el pedido.
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

    
    //Se ejecuta obtener el precio total de los productos seleccionados para el pedido.
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

//Funcion filltable para cargar la información de los productos en el "carrito" del pedido.
function fillTable2(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <tr class="animate__animated animate__fadeIn">
            <!-- Datos-->
            <td>${row.nombreproducto}</td>
            <td>${row.cantidadmaterial}</td>
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

// Se ejecuta al intentar eliminar un producto del "carrito" de compras.
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
