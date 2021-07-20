//Constante para la ruta API
const API_VISITA = '../../app/api/caseta/visitas.php?action=';

document.addEventListener('DOMContentLoaded', function () {
    readRows(API_VISITA);
})

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
                                class="rounded-circle fit-images" width="50px" height="50px">
                        </div>
                    </div>
                </th>
                <td>${row.residente}</td>
                <td>${row.fecha}</td>
                <td>${row.visitante}</td>
                <!-- Boton-->
                <th scope="row">
                    <div class="row paddingBotones">
                        <div class="col-12">
                            <a href="#" onclick="readDataOnModal(${row.idvisita}) "data-toggle="modal" data-target="#modalVisitas" class="btn btnTabla mx-2"><i class="fas fa-eye"></i></a>
                        </div>
                    </div>
                </th>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;

    // Se inicializa la tabla con DataTable.
    let dataTable = new DataTable('#data-table', {
        labels: {
            placeholder: 'Buscar visitas...',
            perPage: '{select} Visitas por página',
            noRows: 'No se encontraron visitas',
            info:'Mostrando {start} a {end} de {rows} visitas'
        }
    });
}

document.getElementById('btnReiniciar').addEventListener('click', function () {
    readRows(API_VISITA);
    document.getElementById('search').value='';
});

//Buscando registros
document.getElementById('search-form').addEventListener('submit',function (event) {
    //Evitamos recargar la pagina
    event.preventDefault();
    //Llamamos la funcion
    searchRows(API_VISITA, 'search-form');
})

function readDataOnModal(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('txtVisita', id);

    fetch(API_VISITA + 'readOne', {
        method: 'post',
        body: data
    }).then(request => {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(response => {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById('txtVisita').value = response.dataset.idvisita;
                    document.getElementById('residente').textContent = 'Residente: ' + response.dataset.residente;
                    document.getElementById('fecha').textContent = 'Fecha: ' + response.dataset.fecha;
                    document.getElementById('visitante').textContent = 'Visitante: ' + response.dataset.visitante;
                    document.getElementById('observacion').textContent = 'Observación: ' + response.dataset.observacion;
                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error));
}








