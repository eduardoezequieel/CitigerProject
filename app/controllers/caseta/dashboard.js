//Constante para la ruta API
const API_VISITA = '../../app/api/caseta/visitas.php?action=';

document.addEventListener('DOMContentLoaded', function () {
    contadorVisitas();
})

function contadorVisitas(){
    fetch(API_VISITA + 'contadorVisitas', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById('txtVisitas').textContent = response.dataset.visitas;
                } else {
                    sweetAlert(4, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

//Función para verificar la visita por medio del dui
document.getElementById('verificarDui-form').addEventListener('submit', function (event) {
    //Evento para evitar que recargue la pagina
    event.preventDefault();
    //Fetch para verificar por el dui
    fetch(API_VISITA + 'checkVisitDui', {
        method:'post',
        body: new FormData(document.getElementById('verificarDui-form'))
    }).then(request => {
        //Se verifica si la petición fue correcta
        if (request.ok) {
            request.json().then(response => {
                //Se verifica la respuesta de la api
                if (response.status) {
                    document.getElementById('txtDui').value= "";
                    document.getElementById('txtDui').className= "form-control cajaTextoFormulario";
                    closeModal('verificarDui');
                    openModal('infoVisita');
                    fillInformation(response.dataset);
                } else {
                    sweetAlert(4, response.exception, null);
                    document.getElementById('txtDui').value= "";
                    document.getElementById('txtDui').className= "form-control cajaTextoFormulario";
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText)
        }
    })
    .catch(error => console.log(error))
})

//Función para verificar la visita por medio de la placa del visitante
document.getElementById('verificarPlaca-form').addEventListener('submit', function (event) {
    //Evento para evitar que recargue la pagina
    event.preventDefault();
    //Fetch para verificar por el dui
    fetch(API_VISITA + 'checkVisitPlaca', {
        method:'post',
        body: new FormData(document.getElementById('verificarPlaca-form'))
    }).then(request => {
        //Se verifica si la petición fue correcta
        if (request.ok) {
            request.json().then(response => {
                //Se verifica la respuesta de la api
                if (response.status) {
                    document.getElementById('txtPlaca').value = "";
                    document.getElementById('txtPlaca').className= "form-control cajaTextoFormulario";
                    closeModal('verificarPlaca');
                    openModal('infoVisita');
                   fillInformation(response.dataset);
                } else {
                    sweetAlert(4, response.exception, null);
                    document.getElementById('txtPlaca').value = "";
                    document.getElementById('txtPlaca').className= "form-control cajaTextoFormulario";
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText)
        }
    })
    .catch(error => console.log(error))
})

//Función para llenar los datos en el modal 
function fillInformation(dataset){
    document.getElementById('txtVisita').value = dataset.idvisita;
    document.getElementById('lblResidente').textContent = dataset.residente;
    document.getElementById('lblFecha').textContent =dataset.fecha;
    document.getElementById('lblVisitante').textContent = dataset.visitante;
    document.getElementById('lblCasa').textContent =dataset.numerocasa;
    document.getElementById('lblObservacion').textContent =dataset.observacion;
}

//Función para finalizar la visita
function confirmVisit(){
    
}

//Función para que se confirme la visita
document.getElementById('info-form').addEventListener('submit', function (event) {
    //Evento para evitar que recargue la pagina
    event.preventDefault();
    //Fetch para finalizar la visita
    fetch(API_VISITA + 'finishVisit', {
        method:'post',
        body: new FormData(document.getElementById('info-form'))
    }).then(request => {
        //Se verifica si la petición fue correcta
        if (request.ok) {
            request.json().then(response => {
                //Se verifica la respuesta de la api
                if (response.status) {
                    sweetAlert(1, response.message, closeModal('infoVisita'));
                    document.getElementById('txtVisita').value = "";
                    document.getElementById('lblResidente').textContent = "";
                    document.getElementById('lblFecha').textContent ="";
                    document.getElementById('lblVisitante').textContent = "";
                    document.getElementById('lblCasa').textContent ="";
                    document.getElementById('lblObservacion').textContent ="";
                } else {
                    sweetAlert(4, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText)
        }
    })
    .catch(error => console.log(error))
})