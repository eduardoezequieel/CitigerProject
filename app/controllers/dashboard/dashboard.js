//Constante para la direccion de la API
const API_DASHBOARD = '../../app/api/dashboard/dashboard.php?action=';

document.addEventListener('DOMContentLoaded',function(){
    fetch(API_DASHBOARD + 'readAll', {
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
});

function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <tr>
            <!-- Fotografia-->
            <th scope="row">
                <div class="row paddingTh">
                    <div class="col-12">
                        <img src="../../resources/img/dashboard_img/usuarios_fotos/${row.foto}" alt="" class="fit-images rounded-circle" width="30px" height="30px">
                    </div>
                </div>
            </th>
            <!-- Datos-->
            <td>${row.usuario}</td>
            <td>${row.hora.substring(0,8)}</td>
            <td>${row.fecha}</td>
            <td>${row.accion}</td>
            <!-- Boton-->
            <th scope="row">
                <div class="row paddingBotones">
                    <div class="col-12">
                        <a href="" class="btn btnTabla"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
            </th>
        </tr>
        `; 
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}