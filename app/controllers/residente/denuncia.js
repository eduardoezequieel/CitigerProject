const API_DENUNCIA = '../../app/api/residente/denuncia.php?action=';
const ENDPOINT_ESTADO = '../../app/api/residente/denuncia.php?action=readComplaintStatus';
const ENDPOINT_TIPO = '../../app/api/residente/denuncia.php?action=readComplaintType';

document.addEventListener('DOMContentLoaded', function(){

    fillSelect(ENDPOINT_ESTADO, 'cbEstadoDenuncia', null);
    fillSelect(ENDPOINT_TIPO, 'cbTipo', null);
    readRows(API_DENUNCIA);
})

function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr class="animate__animated animate__fadeIn">
                <th scope="row">
                    <div class="row paddingTh">
                        <div class="col-12">
                            <img src="../../resources/img/usericon.png" alt="#"
                                class="rounded-circle fit-images" width="30px" height="30px">
                        </div>
                    </div>
                </th>
                <td>${row.tipodenuncia}</td>
                <td>${row.estadodenuncia}</td>
                <td>${row.fecha}</td>
                <!-- Boton-->
                <th scope="row">
                    <div class="row paddingBotones">
                        <div class="col-12">
                            <a href="#" onclick="readDataOnModal(${row.iddenuncia}) "data-toggle="modal" data-target="#administrarVisita" class="btn btnTabla mx-2"><i class="fas fa-edit"></i></a>
                        </div>
                    </div>
                </th>
            </tr>
        `; 
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}

document.getElementById('btnReiniciar').addEventListener('click',function(){
    readRows(API_DENUNCIA);
});

//ocultar los demas botones de acción en el formulario al presionar Agregar.
document.getElementById('btnInsertDialog').addEventListener('click',function(){
    document.getElementById('btnAgregar').className="btn btnAgregarFormulario mr-2";

    // Se reinician los campos del formulario
    document.getElementById('idDenuncia').value = '';
    document.getElementById('txtObservacion').value = '';
    fillSelect(ENDPOINT_RESIDENTE, 'cbTipo', null);

});

//Agregar y actualizar información
document.getElementById('administrarDenuncia-form').addEventListener('submit',function(event){
    //Se evita que se recargue la pagina
    event.preventDefault();

    //Se evalua si el usuario esta haciendo una inserción o una actualización
    if (document.getElementById('btnAgregar').className != 'd-none') {
        saveRow(API_DENUNCIA, 'createRow','administrarDenuncia-form', 'administrarDenuncia');
    } else {
        
    }
});

//Busqueda por estado visita
document.getElementById('cbEstadoDenuncia').addEventListener('change',function(){
    //Guardando el valor del select en un input
    document.getElementById('idEstadoDenuncia').value = document.getElementById('cbEstadoDenuncia').value;
    //Presionando el boton invisible
    document.getElementById('btnFiltrarDenuncia').click();   
})

//Una vez presionado el boton invisible, se hace un fetch con la información del form.
document.getElementById('filtrarEstadoDenuncia-form').addEventListener('submit',function(event){
    //Se evita recargar la pagina
    event.preventDefault();

    fetch(API_VISITA + 'filterByVisitStatus', {
        method: 'post',
        body: new FormData(document.getElementById('filtrarEstadoDenuncia-form'))
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