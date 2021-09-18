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

    fetch(API_USUARIOS + 'readProfile2', {
        method: 'get',
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.

                    previewSavePicture('divFoto', response.dataset.foto, 1);
                    document.getElementById('nombres').textContent = (response.dataset.nombres);
                    document.getElementById('lblNombres').textContent = (response.dataset.nombre);
                    document.getElementById('lblApellidos').textContent = (response.dataset.apellido);
                    document.getElementById('lblDUI').textContent = (response.dataset.dui);
                    document.getElementById('lblGenero').textContent = (response.dataset.genero);
                    document.getElementById('lblTelFijo').textContent = (response.dataset.telefonofijo);
                    document.getElementById('lblTelCelular').textContent = (response.dataset.telefonocelular);
                    document.getElementById('lblFechaNac').textContent = (response.dataset.fechanacimiento);
                    document.getElementById('lblUser').textContent = (response.dataset.username);
                    document.getElementById('lblCorreo').textContent = (response.dataset.correo);



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
                    document.getElementById('txtDUI').value = response.dataset.dui;
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


document.getElementById('archivo_usuario').addEventListener('change', function () {
    //Presionando el boton invisible
    document.getElementById('btnUpload').click();
})


document.getElementById('img-form').addEventListener('submit', function (event) {
    event.preventDefault();
    fetch(API_USUARIOS + 'updateFoto', {
        method: 'post',
        body: new FormData(document.getElementById('img-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    window.location.href = 'ajustes_cuenta.php';
                    console.log('Foto actualizada');
                    // Se muestra un mensaje y se direcciona a la página web de bienvenida para actualizar los datos en el menú.
                    //sweetAlert(1, response.message, 'ajustes_cuenta.php');
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