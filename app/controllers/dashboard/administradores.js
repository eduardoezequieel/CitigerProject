//Constante para la direccion de la API
const API_EMPLEADO = '../../app/api/dashboard/administradores.php?action=';
const ENDPOINT_TIPOS = '../../app/api/dashboard/administradores.php?action=readEmployeeTypes';

document.addEventListener('DOMContentLoaded', function () {
    fillSelect(ENDPOINT_TIPOS, 'cbTipoEmpleado', null);
    fillSelect(ENDPOINT_TIPOS, 'cbTipoEmpleado2', null);
})

document.getElementById('btnInsertDialog').addEventListener('click', function () {
    document.getElementById('btnAgregar').className = "btn btnAgregarFormulario mr-2";

});

document.getElementById('administrarEmpleado-form').addEventListener('submit', function (event) {
    event.preventDefault();

    fetch(API_EMPLEADO + 'register', {
        method: 'post',
        body: new FormData(document.getElementById('administrarEmpleado-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se cargan nuevamente las filas en la tabla de la vista después de agregar o modificar un registro.
                    sweetAlert(1, response.message, closeModal('administrarAdmin'));
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


//Metodo para usar un boton diferente de examinar
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
            image.className = 'fit-images rounded-circle fotoPrimerUso';

            //Se quita lo que este dentro del div (en caso de que exista otra imagen)
            preview.innerHTML = ' ';

            //Se agrega el elemento recien creado
            preview.append(image);
        }
    }
}


// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_EMPLEADO);
});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
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
                        <img src="../../resources/img/dashboard_img/usuarios_fotos/${row.foto}"
                            alt="" class="rounded-circle fit-images" width="30px" height="30px">
                    </div>
                </div>
            </th>
            <!-- Datos-->
            <td>${row.nombre}</td>
            <td>${row.dui}</td>
            <td>${row.telefonofijo}</td>
            <td>${row.estadousuario}</td>
            <!-- Boton-->
            <th scope="row">
                <div class="row paddingBotones">
                    <div class="col-12">
                        <a href="#" data-toggle="modal" data-target="#administrarAdmin"
                            class="btn btnTabla mx-2"><i class="fas fa-edit"></i></a>

                        <a href="#" class="btn btnTabla2 mx-2"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            </th>
    </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de buscar.
document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_EMPLEADO, 'search-form');
});