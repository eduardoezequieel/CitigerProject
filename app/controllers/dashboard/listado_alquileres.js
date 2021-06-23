//constante para la ruta de la api
const API_ALQUILER = '../../app/api/dashboard/alquileres.php?action=';

//Evento al terminar de cargar la pagina
document.addEventListener('DOMContentLoaded', function () {
    //Verificando si existen registros
    fetch (API_ALQUILER + 'readAll').then(request => {
        //verificando si la petición fue correcta
        if (request.ok) {
            request.json().then(response => {
                //Se verifica si la respuesta fue no fue satisfactoria de lo contrario no muestra nada
                if (!response.status) {
                    sweetAlert(4,response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error=>console.log(error));
})