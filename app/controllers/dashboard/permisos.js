//Constante para la direccion de la API
const API_USUARIO = '../../app/api/dashboard/usuarios.php?action=';

//Al cargar al pagina
document.addEventListener('DOMContentLoaded',function(){
    //Carga los datos
    readTypes();
});

//Función para cargar los tipos de usuario
function readTypes() {
    fetch(API_USUARIO + 'readTypesOfUser', {
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

//Llenado de tabla
function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr class="animate__animated animate__fadeIn">
                <!-- Datos-->
                <td>${row.tipousuario}</td>
                <td>${row.permisos}</td>
                <!-- Boton-->
                <th scope="row">
                    <div class="row paddingBotones">
                        <div class="col-12">
                            <a href="#" onclick="readDataOnModal(${row.idusuario}) "data-toggle="modal" data-target="#administrarAdmin" class="btn btnTabla mx-2"><i class="fas fa-edit"></i></a>

                            <a href="#" onclick="deleteRow(${row.idusuario})" class="btn btnTabla2 mx-2"><i class="fas fa-trash"></i></a>
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

//Realizar busquedas
document.getElementById('search-form').addEventListener('submit',function(event){
    //Evitamos recargar la página
    event.preventDefault();
    //fetch
    fetch(API_USUARIO + 'searchTypesOfUser', {
        method: 'post',
        body: new FormData(document.getElementById('search-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                    fillTable(response.dataset);
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
});

//Al presionar el boton de reiniciar
document.getElementById('btnReiniciar').addEventListener('click',function(event){
    //Evitamos recargar la pagina
    event.preventDefault
    //Ejecutamos el metodo por default de cargar tablas
    readTypes();
});

//Al abrir el modal de insertar
document.getElementById('btnInsertDialog').addEventListener('click',function(){
    //Cambiamos el titulo del modal y limpiamos el formulario
    document.getElementById('tituloModal').textContent = 'Crear Nuevo Tipo de Usuario';
});

//Cambiar estilo y valor a los botones al momento de hacer click
function changeStyle(label, input, span){
    //Se captura el boton para cambiar sus propiedades
    var label2 = document.getElementById(label);
    //Se captura el input que contiene su valor
    var input2 = document.getElementById(input);
    //Se captura el span que hace visible el valor del input
    var span2 = document.getElementById(span);
    //Se comprueba si posee una clase en especifico para removerla y poner otra o viceversa
    if (label2.classList.contains('botonesCheckbox')) {
        label2.classList.remove('botonesCheckbox');
        label2.classList.add('botonesCheckboxChecked');
        input2.value = 1;
        span2.textContent = 'Activado';
    } else {
        label2.classList.remove('botonesCheckboxChecked');
        label2.classList.add('botonesCheckbox');
        input2.value = 0;
        span2.textContent = 'Desactivado';
    }
}

//Función para mostrar contraseña
function showHidePassword2(checkbox, pass1) {
    var check = document.getElementById(checkbox);
    var password1 = document.getElementById(pass1);
    //Verificando el estado del check
    if (check.checked == true) {
        password1.type = 'text';
    } else {
        password1.type = 'password';
    }
}