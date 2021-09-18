//Constante para la ruta API
const API_USUARIO = '../../app/api/residente/index.php?action=';

//Al cargar la pagina
document.addEventListener('DOMContentLoaded',function(){
    //Verificando si hay una sesión iniciada
    fetch(API_USUARIO + 'validateSession')
    .then(request => {
        //Se verifica si la petición fue correcta
        if (request.ok) {
            request.json().then(response => {
                //Se verifica si la respuesta no es correcta para redireccionar al primer uso
                if (response.status) {
                    console.log('Posee una sesión activa');
                    window.location.href = 'dashboard.php';
                } else {
                    console.log('No posee una sesión activa');
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error))
});

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
                    if (response.error) {
                        sweetAlert(3, response.message, 'cambiar_contrasena.php');
                    } else {
                        sweetAlert(2, response.exception, null);
                    }
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error));
})
