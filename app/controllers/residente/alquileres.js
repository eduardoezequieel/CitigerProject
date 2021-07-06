//constante para la ruta de la api
const API_ALQUILER = '../../app/api/residente/alquileres.php?action=';
const ENDPOINT_ESTADO_ALQUILER = '../../app/api/residente/alquileres.php?action=readRentalStatus';
const ENDPOINT_ESPACIO_ALQUILER = '../../app/api/residente/alquileres.php?action=readSpace';

//Evento al terminar de cargar la pagina
document.addEventListener('DOMContentLoaded', function () {
    //Llenando los combobox necesarios
    fillSelect(ENDPOINT_ESTADO_ALQUILER,'cbEstadoAlquiler',null);
   
    // Se declara e inicializa un objeto para obtener la fecha y hora actual.
    let today = new Date();
    // Se declara e inicializa una variable para guardar el día en formato de 2 dígitos.
    let day = ('0' + today.getDate()).slice(-2);
    // Se declara e inicializa una variable para guardar el mes en formato de 2 dígitos.
    var month = ('0' + (today.getMonth() + 1)).slice(-2);
    // Se declara e inicializa una variable para guardar el año con la mayoría de edad.
    let year = today.getFullYear();
    // Se declara e inicializa una variable para establecer el formato de la fecha.
    let date = `${year}-${month}-${day}`;
    // Se asigna la fecha como valor máximo en el campo del formulario.
    document.getElementById('txtFecha').setAttribute('min', date);

    //Verificando si existen registros
    fetch (API_ALQUILER + 'readAll').then(request => {
        //verificando si la petición fue correcta
        if (request.ok) {
            request.json().then(response => {
                //Se verifica si la respuesta fue no fue satisfactoria de lo contrario no muestra nada
                if (response.status) {
                    readRows(API_ALQUILER);
                } else {
                    sweetAlert(4,response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error=>console.log(error));

})

//Llenado de tabla de alquiler
function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        if (row.imagenprincipal) {
            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            content += `
                    <div class="animate__animated animate__bounceIn col-xl-4 col-md-4 col-sm-12 col-xs-12 mt-2 d-flex margenTarjetas justify-content-center align-items-center text-center">
                        <!-- Inicio de Tarjeta -->
                        <div class="tarjeta">
                        <!-- Fila para Imagen -->
                            <div class="row">
                                <div class="col-12">
                                    <img src="../../resources/img/dashboard_img/espacios_fotos/${row.imagenprincipal}" alt="#" class="img-fluid fit-images imagenTarjeta">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12 text-left">
                                    <h1 class="letraTarjetaTitulo">${row.nombre}</h1>
                                    <h1 class="letraTarjeta">Hora de inicio: <span class="letraDestacadaTarjeta">${row.horainicio}</span></h1>
                                </div>
                            </div>
                            <!-- Fila para Boton -->
                            <div class="row">
                                <div class="col-12">
                                <a href="#" onclick="readDataOnModal(${row.idalquiler}) " data-target="#administrarAlquiler" data-toggle="modal" class="btn btnTabla"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>

                        <!-- Fin de Tarjeta -->
                        </div>
                    </div>
            `; 
        } else {
            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            content += `
                    <div class="animate__animated animate__bounceIn col-xl-4 col-md-4 col-sm-12 col-xs-12 mt-2 d-flex margenTarjetas justify-content-center align-items-center text-center">
                        <!-- Inicio de Tarjeta -->
                        <div class="tarjeta">
                        <!-- Fila para Imagen -->
                            <div class="row">
                                <div class="col-12">
                                    <img src="../../resources/img/no-image.png" alt="#" class="img-fluid fit-images imagenTarjeta">
                                </div>
                            </div>
                            <!-- Fila para Información -->
                            <div class="row mt-2">
                                <div class="col-12 text-left">
                                    <h1 class="letraTarjetaTitulo">${row.nombre}</h1>
                                    <h1 class="letraTarjeta">Hora de inicio: <span class="letraDestacadaTarjeta">${row.horainicio}</span></h1>
                                </div>
                            </div>
                            <!-- Fila para Boton -->
                            <div class="row">
                                <div class="col-12">
                                <a href="#" onclick="readDataOnModal(${row.idalquiler}) " data-target="#administrarAlquiler" data-toggle="modal" class="btn btnTabla"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>

                        <!-- Fin de Tarjeta -->
                        </div>
                    </div>
            `; 
        }
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('show-tarjeta').innerHTML = content;

}

//Carga de datos del registro seleccionado
function readDataOnModal(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idAlquiler', id);

    fetch(API_ALQUILER + 'readOne', {
        method: 'post',
        body: data
    }).then(request => {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(response => {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idAlquiler').value = response.dataset.idalquiler;
                    document.getElementById('idEspacio').value = response.dataset.idespacio;
                    document.getElementById('txtFecha').value = response.dataset.fecha;
                    document.getElementById('txtHoraInicio').value = response.dataset.horainicio;
                    document.getElementById('txtHoraFin').value = response.dataset.horafin;
                    document.getElementById('txtPrecio').value = response.dataset.precio;
                    document.getElementById('txtEstado6').value = response.dataset.estadoalquiler;
                    fillSelect(ENDPOINT_ESPACIO_ALQUILER,'cbEspacio',response.dataset.idespacio);
                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error));
}

//Buscando registros
document.getElementById('search-form').addEventListener('submit',function (event) {
    //Evitamos recargar la pagina
    event.preventDefault();
    //Llamamos la funcion
    searchRows(API_ALQUILER, 'search-form');
})

/*Cada vez que cambie el valor del select, se enviara a un input invisible y de igual forma se 
presionara un boton invisible para poder activar el evento submit del form*/
document.getElementById('cbEstadoAlquiler').addEventListener('change', function (event) {
    //Se evita recargar la pagina
    event.preventDefault();
   //Guardando el valor del select en un input
   document.getElementById('idEstadoAlquiler').value = document.getElementById('cbEstadoAlquiler').value;
   //Presionando el boton invisible
   document.getElementById('btnFiltrarAlquiler').click();   
})

//Una vez presionado el boton invisible, se hace un fetch con la información del form.
document.getElementById('filtrarEstadoAlquiler-form').addEventListener('submit', function (event) {
    //Se evita recargar la pagina
    event.preventDefault();
    //Se realiza el filtro
    filter(API_ALQUILER,'filterRentalStatus','filtrarEstadoAlquiler-form');
 })

//Método para resetear busqueda
document.getElementById('btnReiniciar').addEventListener('click', function () {
    readRows(API_ALQUILER);
    document.getElementById('search').value='';
    fillSelect(ENDPOINT_ESTADO_ALQUILER,'cbEstadoAlquiler',null);
});
