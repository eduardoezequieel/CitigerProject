//Constante para la ruta de la API
const API_MARCAS = '../../app/api/dashboard/marcas.php?action=';


//Cuando se carga la pagina web
document.addEventListener('DOMContentLoaded', function(){
    readRows(API_MARCAS);
});

//Funcion para el llenado de tablas.
function fillTable(dataset){
    let content = ' ';

    dataset.map(function(row){
        content += `
        <tr>
            <td>${row.marca}</td>
            <th scope="row">
                <div class="row justify-content-end">
                    <div class="col-12 d-flex justify-content-end">
                        <!-- Button trigger modal -->
                        <a href="#" data-bs-toggle="modal" onclick="openUpdateDialog(${row.idmarca})" data-bs-target="#administrarMarcas" class="btn btn-outline-success"><i class="fas fa-edit tamanoBoton"></i></a>

                        <h5 class="mx-1"></h1>

                        <a href="#" data--bs-toggle="modal" onclick="openDeleteDialog(${row.idmarca})" data-bs-target="#administrarInventario" class="btn btn-outline-danger"><i class="fas fa-trash-alt tamanoBoton"></i></a>
                    </div>
                </div>
            </th>
        </tr>
        `
    })

    document.getElementById('tbody-rows').innerHTML = content;
}

function openUpdateDialog(id){
    const data = new FormData();
    data.append('idMarca', id);

    fetch(API_MARCAS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idMarca').value = response.dataset.idmarca;
                    document.getElementById('txtMarca').value = response.dataset.marca;
                    fillSelect(ENDPOINT_ESTADO,'cbEstadoMarca',response.dataset.idestadomarca);
                    
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

//Eliminar
function openDeleteDialog(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idMarca', id);
    // Se llama a la función que elimina un registro.
    confirmDelete(API_MARCAS, data);
}

//Buscar

document.getElementById('search-form').addEventListener('submit', function(event){

    //Evento para que no recargue la pagina
    event.preventDefault();

    searchRows(API_MARCAS, 'search-form');
})
    
restartSearch('btnReiniciar', API_MARCAS);

document.getElementById('agregarMarcas-form').addEventListener('submit', function(event){

    event.preventDefault();

    fetch(API_MARCAS + 'createRow', {
        method: 'post',
        body: new FormData(document.getElementById('agregarMarcas-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    //cargando de nuevo la tabla
                    readRows(API_MARCAS);
                    //Mandando mensaje de exito
                    sweetAlert(1, response.message, closeModal('agregarMarcas'));
                } else{
                    sweetAlert(4, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function(error){
        console.log(error);
    });
});

document.getElementById('administrarMarcas-form').addEventListener('submit', function(event){

    event.preventDefault();

    fetch(API_MARCAS + 'updateRow', {
        method: 'post',
        body: new FormData(document.getElementById('administrarMarcas-form'))
    }).then(function(request){
        //Verificando si la petición fue correcta
        if(request.ok){
            request.json().then(function(response){
                //Verificando respuesta satisfactoria
                if(response.status){
                    //cargando de nuevo la tabla
                    readRows(API_MARCAS);
                    //Mandando mensaje de exito
                    sweetAlert(1, response.message, closeModal('administrarMarcas'));
                } else{
                    sweetAlert(4, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function(error){
        console.log(error);
    });
});
