const API_PEDIDOS = '../../app/api/dashboard/pedidos.php?action=';
const ENDPOINT_EMPLEADOS = '../../app/api/dashboard/pedidos.php?action=readEmployees';

document.addEventListener('DOMContentLoaded',function(){
    readOrder();
    fillSelect(ENDPOINT_EMPLEADOS,'txtEmpleadoPedido', null);
});

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
                    </div>
                </div>
            </th>
            <td>${row.preciomaterial}</td>
            <td>${row.totalunidad}</td>
        </tr>
        `; 
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}

document.getElementById('txtEmpleadoPedido').addEventListener('change',function(){
    console.log(document.getElementById('txtEmpleadoPedido').value);
})

document.getElementById('finalizarPedido-form').addEventListener('submit',function(event){
    event.preventDefault();

    swal({
        title: 'Advertencia',
        text: '¿Desea realizar el pedido?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
        if (value) {
            fetch(API_PEDIDOS + 'sendPedido', {
                method: 'post',
                body: new FormData(document.getElementById('finalizarPedido-form'))
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            // Se cargan nuevamente las filas en la tabla de la vista después de borrar un registro.
                            sweetAlert(1,response.message,'pedidos.php');
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
})