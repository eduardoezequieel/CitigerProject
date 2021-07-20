const API_PEDIDOS = '../../app/api/dashboard/pedidos.php?action=';
const ENDPOINT_ESTADOS = '../../app/api/dashboard/pedidos.php?action=readStates';

document.addEventListener('DOMContentLoaded',function(){
    readRows(API_PEDIDOS);
    fillSelect(ENDPOINT_ESTADOS, 'cbEstadoPedido', null);
});

document.getElementById('btnReiniciar').addEventListener('click',function(event){
    event.preventDefault();
    readRows(API_PEDIDOS);
})

function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <tr class="animate__animated animate__fadeIn">
            <!-- Datos-->
            <td>${row.empleado}</td>
            <td>${row.estadopedido}</td>
            <td>${row.idpedido}</td>
            <td>${row.fechapedido}</td>
            <!-- Boton-->
            <th scope="row">
                <div class="row paddingBotones">
                    <div class="col-12">
                        <a href="#" onclick="readInfo(${row.idpedido})" data-toggle="modal" data-target="#administrarPedido" class="btn btnTabla"><i class="fas fa-cog"></i></a>
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

document.getElementById('cbEstadoPedido').addEventListener('change',function(){
    document.getElementById('txtEstadoPedido').value = document.getElementById('cbEstadoPedido').value;
    document.getElementById('btnBuscarEstado').click();
})

document.getElementById('search-form-estado').addEventListener('submit',function(event){
    event.preventDefault();

    fetch(API_PEDIDOS + 'readByState', {
        method: 'post',
        body: new FormData(document.getElementById('search-form-estado'))
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

})

function readInfo(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idPedido', id);
    getTotal(id);
    readOrder(id);
    document.getElementById('txtIdPedido').value = id;

    fetch(API_PEDIDOS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById('lblEmpleado').textContent = response.dataset.empleado;
                    document.getElementById('lblEstado').textContent = response.dataset.estadopedido;
                    if (response.dataset.estadopedido == 'Recibido') {
                        document.getElementById('administrarPedido-form').className = 'd-none';
                    } else if(response.dataset.estadopedido == 'Cancelado') {
                        document.getElementById('administrarPedido-form').className = 'd-none';
                    } else if (response.dataset.estadopedido == 'Realizado') {
                        document.getElementById('administrarPedido-form').className = 'd-block';
                    }
                } else {
                    sweetAlert(4, response.exception, null);
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

function getTotal(id){
    const data2 = new FormData();
    data2.append('idPedido2', id);

    fetch(API_PEDIDOS + 'getTotal2', {
        method: 'post',
        body: data2
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

function readOrder(id) {
    const data3 = new FormData();
    data3.append('idPedido3', id);

    fetch(API_PEDIDOS + 'readOrder2', {
        method: 'post',
        body: data3
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;
                    fillTable2(data);
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
                    </div>
                </div>
            </th>
            <td>${row.preciomaterial}</td>
            <td>${row.totalunidad}</td>
        </tr>
        `; 
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows2').innerHTML = content;
}

document.getElementById('btnRecibido').addEventListener('click',function(event){

    document.getElementById('administrarPedido-form').addEventListener('submit',function(event){
        event.preventDefault();

        swal({
            title: 'Advertencia',
            text: '¿Desea confirmar como recibido el pedido?',
            icon: 'warning',
            buttons: ['No', 'Sí'],
            closeOnClickOutside: false,
            closeOnEsc: false
        }).then(value => {
            // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
            if (value) {
                fetch(API_PEDIDOS + 'confirmOrder', {
                    method: 'post',
                    body: new FormData(document.getElementById('administrarPedido-form'))
                }).then(request => {
                    //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
                    if (request.ok) {
                        request.json().then(response => {
                            //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                            if (response.status) {
                                readRows(API_PEDIDOS);
                                sweetAlert(1, response.message, closeModal('administrarPedido'));
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
});

document.getElementById('btnCancelado').addEventListener('click',function(event){

    document.getElementById('administrarPedido-form').addEventListener('submit',function(event){
        event.preventDefault();

        swal({
            title: 'Advertencia',
            text: '¿Desea confirmar como cancelado el pedido?',
            icon: 'warning',
            buttons: ['No', 'Sí'],
            closeOnClickOutside: false,
            closeOnEsc: false
        }).then(value => {
            // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
            if (value) {
                fetch(API_PEDIDOS + 'cancelOrder', {
                    method: 'post',
                    body: new FormData(document.getElementById('administrarPedido-form'))
                }).then(request => {
                    //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
                    if (request.ok) {
                        request.json().then(response => {
                            //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                            if (response.status) {
                                readRows(API_PEDIDOS);
                                sweetAlert(1, response.message, closeModal('administrarPedido'));
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
});
