const API_USUARIOS = '../../app/api/dashboard/usuarios.php?action=';

document.addEventListener('DOMContentLoaded', function () {
    // Se declara e inicializa un objeto para obtener la fecha y hora actual.
    let today = new Date();
    // Se declara e inicializa una variable para guardar el día en formato de 2 dígitos.
    let day = ('0' + today.getDate()).slice(-2);
    // Se declara e inicializa una variable para guardar el mes en formato de 2 dígitos.
    var month = ('0' + (today.getMonth() + 1)).slice(-2);
    // Se declara e inicializa una variable para guardar el año con la mayoría de edad.
    let year = today.getFullYear() - 18;
    // Se declara e inicializa una variable para establecer el formato de la fecha.
    let date = `${year}-${month}-${day}`;
    // Se asigna la fecha como valor máximo en el campo del formulario.
    document.getElementById('txtFechaNacimiento').setAttribute('max', date);
    document.getElementById('txtFechaNacimiento').setAttribute('value', date);
    readRows2(API_USUARIOS);





})

//Llenado de cartas
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
<div class="row mb-3">
    <div class="col-12">
        <h1 class="tituloPagina text-center">Mi Cuenta</h1>
    </div>
</div>

<div class="row justify-content-center animate__animated animate__zoomIn" id="fotoDiv">
    <div class="col-12 d-flex justify-content-center">
        <form method="post" id="img-form>
            <div class=" col">
                <div class="divFotografiaAjustes">
                    <div class="cargarFoto d-flex justify-content-center align-items-center" id="divFoto">
                        <img src="../../resources/img/dashboard_img/usuarios_fotos/${row.foto}" alt=""
                            class="fit-images rounded-circle" width="140px" height="140px">
                    </div>

                    <div id="btnAgregarFoto">
                        <button type="submit" class="btn btnCargarFoto2 mx-2" id="botonFoto"><span
                                class="fas fa-plus"></span></button>
                                <input id="archivo_usuario" type="file" class="d-none" name="archivo_usuario" accept=".gif, .jpg, .png">

                    </div>
                    <h1 class="tituloUsuario mt-3">${row.nombres}</h1>
                </div>
            </div>
    </form>
</div>
<!-- Final Cargar Fotografia -->

<!-- Sección para cambiar información personal -->
<div class="row mt-3">
    <div class="col-12">
        <h1 class="tituloTarjetaAjustes">Información Personal</h1>

    </div>
</div>

<div class="row justify-content-center animate__animated animate__zoomIn" id="Usuario">
    <div class="col-12 d-flex justify-content-center align-items-center">
        <!-- Div especializado para cada sección -->
        <div class="informacionPersonal">
            <div class="row justify-content-center ml-4">
                <div class="col-6 divColumnasAjustes">
                    <form>
                        <!-- Titulo -->
                        <h1 class="tituloInformacion">Nombres</h1>
                        <!-- Información -->
                        <h2 class="informacion">${row.nombre}</h2>
                    </form>
                </div>
                <div class="col-6 divColumnasAjustes">
                    <form>
                        <h1 class="tituloInformacion">Apellidos</h1>
                        <h2 class="informacion">${row.apellido}</h2>
                    </form>
                </div>
            </div>
            <div class="row mt-2 justify-content-center ml-4">
                <div class="col-6 divColumnasAjustes">
                    <form>
                        <h1 class="tituloInformacion">DUI</h1>
                        <h2 class="informacion">${row.dui}</h2>
                    </form>
                </div>
                <div class="col-6 divColumnasAjustes">
                    <form>
                        <h1 class="tituloInformacion">Genéro</h1>
                        <h2 class="informacion">${row.genero}</h2>
                    </form>
                </div>
            </div>
            <div class="row mt-2 justify-content-center ml-4">
                <div class="col-6 divColumnasAjustes">
                    <form>
                        <h1 class="tituloInformacion">Teléfono Fijo</h1>
                        <h2 class="informacion">${row.telefonofijo}</h2>
                    </form>
                </div>
                <div class="col-6 divColumnasAjustes">
                    <form>
                        <h1 class="tituloInformacion">Teléfono Celular</h1>
                        <h2 class="informacion">${row.telefonocelular}</h2>
                    </form>
                </div>
            </div>
            <div class="row mt-2 justify-content-center ml-4">
                <div class="col-6 divColumnasAjustes">
                    <form>
                        <h1 class="tituloInformacion">Fecha de Nacimiento</h1>
                        <h2 id="lblNacimiento" name="lblNacimiento" class="informacion">${row.fechanacimiento}</h2>
                    </form>
                </div>
                <div class="col-6 divColumnasAjustes">
                    <form>
                        <a href="#" id="btnEditarAjustes" onclick="readDataOnModal(${row.idusuario})"
                            data-toggle="modal" data-target="#administrarCuenta" class="btn botonesAjustes">Editar</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Sección para administrar ajustes de la cuenta (mismo formato de arriba) -->
<div class="row mt-4">
    <div class="col">
        <h1 class="tituloTarjetaAjustes">Ajustes de la Cuenta</h1>
    </div>
</div>

<div class="row justify-content-center animate__animated animate__zoomIn">
    <div class="col-12 d-flex justify-content-center align-items-center">
        <div class="informacionPersonal">
            <div class="row">
                <div class="col-6">
                    <h1 class="tituloInformacion">Usuario</h1>
                    <h2 class="informacion">${row.username}</h2>
                </div>
                <div class="col-6">
                    <button class="btn botonesAjustes">Editar</button>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-6">
                    <h1 class="tituloInformacion">Correo Electrónico</h1>
                    <h2 class="informacion">${row.correo}</h2>
                </div>
                <div class="col-6">
                    <a href="#" class="btn botonesAjustes">Editar</a>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-6">
                    <h1 class="tituloInformacion">Contraseña</h1>
                    <h2 class="informacion">*********</h2>
                </div>
                <div class="col-6">
                    <button class="btn botonesAjustes">Cambiar</button>
                </div>
            </div>

        </div>
    </div>
</div>

`;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('miCuenta').innerHTML = content;
}

function readDataOnModal() {
    // Se abre la caja de dialogo (modal) que contiene el formulario para editar perfil, ubicado en el archivo de las

    fetch(API_USUARIOS + 'readProfile2', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del usuario que ha iniciado sesión.
                    document.getElementById('txtApellidos').value = response.dataset.apellido;
                    document.getElementById('txtNombres').value = response.dataset.nombre;
                    document.getElementById('txtTelefonoFijo').value = response.dataset.telefonofijo;
                    document.getElementById('txtTelefonomovil').value = response.dataset.telefonocelular;
                    document.getElementById('cbGenero').value = response.dataset.genero;
                    document.getElementById('txtFechaNacimiento').value = response.dataset.fechanacimiento;
                    // Se actualizan los campos para que las etiquetas (labels) no queden sobre los datos.
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


// Método manejador de eventos que se ejecuta cuando se envía el formulario de editar perfil.
document.getElementById('admin-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    fetch(API_USUARIOS + 'editProfile', {
        method: 'post',
        body: new FormData(document.getElementById('admin-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {

                    // Se muestra un mensaje y se direcciona a la página web de bienvenida para actualizar el nombre del usuario en el menú.
                    sweetAlert(1, response.message, 'ajustes_cuenta.php');
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
});

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
            image.className = 'fit-images rounded-circle" width="140px" height="140px';

            //Se quita lo que este dentro del div (en caso de que exista otra imagen)
            preview.innerHTML = ' ';

            //Se agrega el elemento recien creado
            preview.append(image);
        }
    }
}