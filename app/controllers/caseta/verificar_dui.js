//Constante para la ruta API
const API_VISITA = '../../app/api/caseta/visitas.php?action=';

document.getElementById('dui-form').addEventListener('submit', function (event) {
    //Evento para evitar que recargue la pagina
    event.preventDefault();
    //Fetch para verificar por el dui
    fetch(API_VISITA + 'checkVisitDui', {
        method:'post',
        body: new FormData(document.getElementById('dui-form'))
    }).then(request => {
        //Se verifica si la petición fue correcta
        if (request.ok) {
            request.json().then(response => {
                //Se verifica la respuesta de la api
                if (response.status) {
                    document.getElementById('txtVisita').value = response.dataset.idvisita;
                    document.getElementById('residente').textContent = 'Residente: ' + response.dataset.residente;
                    document.getElementById('fecha').textContent = 'Fecha: ' + response.dataset.fecha;
                    document.getElementById('visitante').textContent = 'Visitante: ' + response.dataset.visitante;
                    document.getElementById('observacion').textContent = 'Observación: ' + response.dataset.observacion;
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

//Función para finalizar la visita
function confirmVisit(){
    //Fetch para verificar por el dui
    fetch(API_VISITA + 'finishVisit', {
       method:'post',
       body: new FormData(document.getElementById('dui-form'))
   }).then(request => {
       //Se verifica si la petición fue correcta
       if (request.ok) {
           request.json().then(response => {
               //Se verifica la respuesta de la api
               if (response.status) {
                   sweetAlert(1, response.message, clearForm('dui-form'));
                   document.getElementById('txtDui').value='';
                   document.getElementById('residente').textContent = 'Residente: ' ;
                   document.getElementById('fecha').textContent = 'Fecha: ' ;
                   document.getElementById('visitante').textContent = 'Visitante: ';
                   document.getElementById('observacion').textContent = 'Observación: ' ;
               } else {
                   sweetAlert(4, response.exception, null);
               }
           })
       } else {
           console.log(request.status + ' ' + request.statusText)
       }
   })
   .catch(error => console.log(error))
}

document.getElementById('btnReiniciar').addEventListener('click', function (event) {
    //Se evita recargar la pagina
    event.preventDefault();
    document.getElementById('txtDui').value='';
    clearForm('dui-form');
    document.getElementById('residente').textContent = 'Residente: ' ;
    document.getElementById('fecha').textContent = 'Fecha: ' ;
    document.getElementById('visitante').textContent = 'Visitante: ';
    document.getElementById('observacion').textContent = 'Observación: ' ;
});

