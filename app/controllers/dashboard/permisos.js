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
                            <a href="#" onclick="editPermissions(${row.idtipousuario}, '${row.tipousuario}')" class="btn btnTabla mx-2"><i class="fas fa-edit"></i></a>

                            <a href="#" onclick="deleteType(${row.idtipousuario})" class="btn btnTabla2 mx-2"><i class="fas fa-trash"></i></a>
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
    //Arreglo que contiene los span de los botones
    let spans = [
        document.getElementById('lblAlquileresValue'),
        document.getElementById('lblAportacionesValue'),
        document.getElementById('lblDenunciaValue'),
        document.getElementById('lblMaterialesValue'),
        document.getElementById('lblUsuariosValue'),
        document.getElementById('lblVisitasValue'),    
    ]
    //Arreglo que contiene los inputs de los botones
    let inputs = [
        document.getElementById('alquileresValue'),
        document.getElementById('aportacionesValue'),
        document.getElementById('denunciaValue'),
        document.getElementById('materialesValue'),
        document.getElementById('usuariosValue'),
        document.getElementById('visitasValue'),
    ]
    //Arreglo que contiene los label de los botones
    let labels = [
        document.getElementById('btnAlquileres'),
        document.getElementById('btnAportaciones'),
        document.getElementById('btnDenuncia'),
        document.getElementById('btnMateriales'),
        document.getElementById('btnUsuarios'),
        document.getElementById('btnVisitas'),
    ]

    //Se recorre cada una de las posiciones de los arreglos
    for (let i = 0; i < labels.length; i++) {
        //Se guarda cada posicion del arreglo en una variable a parte
        var label = labels[i];
        var input = inputs[i];
        var span = spans[i];
        //Se asigna la clase por defecto
        label.className = 'btn shadow-none botonesCheckbox';
        //Se asigna el valor a los inputs por defecto
        input.value = 0;
        //Se asigna a los span la etiqueta por defecto.
        span.textContent = 'Desactivado';
    }

    //Se limpia el input de tipo de usuario
    document.getElementById('txtTipoUsuario').value = '';
    document.getElementById('txtTipoUsuario').classList.remove('error');
    document.getElementById('txtTipoUsuario').classList.remove('success');

    //Se limpia el input de contraseña
    document.getElementById('password-div').className = 'form-group';
    document.getElementById('txtContrasenaActual').value = '';
    document.getElementById('txtContrasenaActual').classList.remove('error');
    document.getElementById('txtContrasenaActual').classList.remove('success');

    //Se oculta el boton de actualizar y se muestra el de insertar
    document.getElementById('btnAgregar').className = 'btn botonesListado';
    document.getElementById('btnActualizar').className = 'd-none';

    //Se elimina margen
    document.getElementById('rowBtn').classList.remove('mt-5');
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

//Al accionar el formulario de crear tipo de usuario y sus permisos
document.getElementById('create-form').addEventListener('submit',function(event){
    event.preventDefault();
    if (document.getElementById('btnAgregar').classList.contains('botonesListado')) {
        addRow();
    } else if (document.getElementById('btnActualizar').classList.contains('botonesListado')) {
        updateRow();
    }
});

function addRow(){
    //fetch
    fetch(API_USUARIO + 'createType', {
        method: 'post',
        body: new FormData(document.getElementById('create-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se cargan nuevamente las filas en la tabla de la vista después de agregar o modificar un registro.
                    readTypes();
                    closeModal('administrarTipoUsuario');
                    sweetAlert(1, response.message, null);
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

function updateRow(){
    //fetch
    fetch(API_USUARIO + 'updateType', {
        method: 'post',
        body: new FormData(document.getElementById('create-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se cargan nuevamente las filas en la tabla de la vista después de agregar o modificar un registro.
                    readTypes();
                    closeModal('administrarTipoUsuario');
                    console.log(response.dataset);
                    console.log(response.dataset2);
                    sweetAlert(1, response.message, null);
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

//Función para eliminar registros
function deleteType(id){
    // Se guarda en un form el id
    data = new FormData();
    data.append('idTipoUsuario', id);

    //Sweet Alert
    swal({
        title: 'Advertencia',
        text: '¿Desea eliminar el tipo de usuario?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
        if (value) {
            fetch(API_USUARIO + 'deleteType', {
                method: 'post',
                body: data
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            // Se cargan nuevamente las filas en la tabla de la vista después de borrar un registro.
                            readTypes();
                            sweetAlert(1, response.message, null);
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
}

//Funcion que carga los permisos de un tipo de usario
function editPermissions(id, type){
    // Se guarda en un form el id
    data = new FormData();
    data.append('idTipoUsuario', id);
    document.getElementById('idTipoUsuario').value = id;
    //Abrimos el modal
    openModal('administrarTipoUsuario');
    document.getElementById('txtTipoUsuario').value = type;
    //Cambiamos el titulo del modal
    document.getElementById('tituloModal').textContent = 'Editar Tipo de Usuario';
    //Se limpia el input de contraseña
    document.getElementById('txtContrasenaActual').value = '';
    //Se oculta el boton de actualizar y se muestra el de insertar
    document.getElementById('btnAgregar').className = 'd-none';
    document.getElementById('btnActualizar').className = 'btn botonesListado';
    //Arreglo que contiene los span de los botones
    let spans = [
        document.getElementById('lblAlquileresValue'),
        document.getElementById('lblAportacionesValue'),
        document.getElementById('lblDenunciaValue'),
        document.getElementById('lblMaterialesValue'),
        document.getElementById('lblUsuariosValue'),
        document.getElementById('lblVisitasValue'),    
    ]
    //Arreglo que contiene los inputs de los botones
    let inputs = [
        document.getElementById('alquileresValue'),
        document.getElementById('aportacionesValue'),
        document.getElementById('denunciaValue'),
        document.getElementById('materialesValue'),
        document.getElementById('usuariosValue'),
        document.getElementById('visitasValue'),
    ]
    //Arreglo que contiene los label de los botones
    let labels = [
        document.getElementById('btnAlquileres'),
        document.getElementById('btnAportaciones'),
        document.getElementById('btnDenuncia'),
        document.getElementById('btnMateriales'),
        document.getElementById('btnUsuarios'),
        document.getElementById('btnVisitas'),
    ]
    //fetch
    fetch(API_USUARIO + 'getPermissionsOfAType', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    i = 0;
                    response.dataset.map(function(row){
                        if (row.permitido == '1') {
                            labels[i].classList.remove('botonesCheckbox');
                            labels[i].classList.add('botonesCheckboxChecked');
                            inputs[i].value = 1;
                            spans[i].textContent = 'Activado';
                        } else {
                            labels[i].classList.add('botonesCheckbox');
                            labels[i].classList.remove('botonesCheckboxChecked');
                            inputs[i].value = 0;
                            spans[i].textContent = 'Desactivado';
                        }
                        i = i+1; 

                    });
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
