const API_VISITA = '../../app/api/residente/visitas.php?action=';
const ENDPOINT_VISITANTE = '../../app/api/residente/visitas.php?action=readVisitante';


document.addEventListener('DOMContentLoaded', function () {

    fillSelect(ENDPOINT_VISITANTE, 'cbVisitante', null);
    readRows(API_VISITA);



})


document.getElementById('btnInsertDialog').addEventListener('click', function () {

    // Se reinician los campos del formulario
    document.getElementById('idVisita').value = '';
    document.getElementById('txtFecha').value = '';
    document.getElementById('txtObservacion').value = '';
    fillSelect(ENDPOINT_VISITANTE, 'cbVisitante', null);


});

//Agregar y actualizar información
document.getElementById('administrarVisita-form').addEventListener('submit', function (event) {
    //Se evita que se recargue la pagina
    event.preventDefault();

    fillSelect(ENDPOINT_VISITANTE, 'cbVisitante', null);
    saveRow(API_VISITA, 'createRow', 'administrarVisita-form', 'crearVisita');
    readRows(API_VISITA);


});


document.getElementById('btnNo').addEventListener('click', function () {

    // Se reinician los campos del formulario
    document.getElementById('txtApellido').value = '';
    document.getElementById('txtPlaca').value = '';
    document.getElementById('txtNombre').value = '';
    document.getElementById('txtDUI').value = '';

});

//Agregar y actualizar información
document.getElementById('Visitante-form').addEventListener('submit', function (event) {
    //Se evita que se recargue la pagina
    event.preventDefault();

    saveRow(API_VISITA, 'createVisitante', 'Visitante-form', 'administrarVisitante');


});



//Llenado de tabla
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <tr class="animate__animated animate__fadeIn">
        <!-- Datos-->
        <td>${row.visitante}</td>
        <td>${row.estadovisita}</td>
        <td>${row.fecha}</td>
        <!-- Boton-->
        <th scope="row">
            <div class="row paddingBotones">
                <div class="col-12">
                    <a href="#" data-toggle="modal" onclick="readOne(${row.iddetallevisita})" data-target="#informacionVisita" class="btn btnTabla"><i class="fas fa-info-circle"></i></a>

                </div>
            </div>
        </th>
    </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;

    let dataTable = new DataTable('#data-table', { 
        labels: { 
            placeholder: 'Buscar visitas...', 
            perPage: '{select} Visitas por página', 
            noRows: 'No se encontraron visitas', 
            info:'Mostrando {start} a {end} de {rows} visitas' 
        } 
    });
}


function readOne(id) {

    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idDetalle', id);
    console.log(id);


    fetch(API_VISITA + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idDetalle').value = response.dataset.iddetallevisita;
                    document.getElementById('lblVisitante').textContent = (response.dataset.visitante);
                    document.getElementById('lblPlaca').textContent = (response.dataset.placa);
                    document.getElementById('lblFecha').textContent = (response.dataset.fecha);
                    document.getElementById('lblVisita').textContent = (response.dataset.visitarecurrente);
                    document.getElementById('lblEstado').textContent = (response.dataset.estadovisita);
                    document.getElementById('lblOb').textContent = (response.dataset.observacion);



                } else {
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });

}


function searchRows2(API_VISITA, form) {
    fetch(API_VISITA + 'search', {
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

document.getElementById('search-form').addEventListener('submit', function (event) {
    //Evitamos recargar la pagina
    event.preventDefault();

    //Llamamos la funcion
    searchRows2(API_VISITA, 'search-form');
})