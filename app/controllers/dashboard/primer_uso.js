//Constante para la direccion de la API
const API_USUARIO = '../../app/api/dashboard/usuarios.php?action=';

//Evento que se ejecuta al cargar el DOM 
document.addEventListener('DOMContentLoaded', function () {
    //Se verifica si hay usuarios existentes
    fetch(API_USUARIO + 'readAll')
    .then(request => {
        //Si la verifica si la petición fue correcta
        if (request.ok) {
            //Se convierte la petición a json
            request.json().then(response => {
                //Se verifica si la respuesta fue satisfactoria
                if (response.status) {
                    sweetAlert(3, response.message, 'index.php');
                }
            })
        } else {
            console.log(response.status + ' ' + response.exception)
        }
    }).catch(error => console.log(error))
})