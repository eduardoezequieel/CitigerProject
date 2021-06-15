//Constante para la ruta API
const API_USUARIO = '../../app/api/dashboard/usuarios.php?action=';

//Método para manejador de eventos cuando la pagina haya cargado
document.addEventListener('DOMContentLoaded', function () {
    //Verificando si hay usuarios registrados 
    fetch(API_USUARIO + 'readAll')
    .then(request => {
        //Se verifica si la petición fue correcta
        if (request.ok) {
            request.json().then(response => {
                //Se verifica si la respuesta no es correcta para redireccionar al primer uso
                if (!response.status) {
                    sweetAlert(3, response.exception, 'primer_uso.php');
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error))
})

//Método para iniciar sesion
document.getElementById('login-form').addEventListener('submit', function (event) {
    //Evento para que no recargue la pagina
    event.preventDefault();

    //Verificando las credenciales del usuario
    fetch(API_USUARIO + 'logIn', {
        method: 'post',
        body: new FormData(document.getElementById('login-form'))
    }).then(request => {
        //Verificando si la petición fue correcta
        if (request.ok) {
            request.json().then(response => {
                //Verificando si la respuesta es satisfactoria de lo contrario se muestra la excepción
                if (response.status) {
                    sweetAlert(1, response.message, 'dashboard.php');
                } else {
                    sweetAlert(2, response.exception, clearPassword('txtContrasenia'));
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error));
})
