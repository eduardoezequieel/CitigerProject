const API_VISITA = '../../app/api/residente/visitas.php?action=';



document.getElementById('btnInsertDialog').addEventListener('click', function () {

    // Se reinician los campos del formulario
    document.getElementById('idVisita').value = '';
    document.getElementById('txtFecha').value = '';
    document.getElementById('txtObservacion').value = '';

});

//Agregar y actualizar información
document.getElementById('administrarVisita-form').addEventListener('submit', function (event) {
    //Se evita que se recargue la pagina
    event.preventDefault();

    saveRow(API_VISITA, 'createRow', 'administrarVisita-form', 'crearVisita');

});


document.getElementById('btnNo').addEventListener('click', function () {

    // Se reinician los campos del formulario
    document.getElementById('txtApellido').value = '';
    document.getElementById('txtPlaca').value = '';
    document.getElementById('txtNombre').value = '';
    document.getElementById('txtDUI').value = '';

});

//Agregar y actualizar información
document.getElementById('Visitante-form').addEventListener('submit', function (event) {
    //Se evita que se recargue la pagina
    event.preventDefault();

    saveRow(API_VISITA, 'createVisitante', 'Visitante-form',null );

});



