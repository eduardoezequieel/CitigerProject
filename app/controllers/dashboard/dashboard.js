//Constante para la direccion de la API
const API_DASHBOARD = '../../app/api/dashboard/dashboard.php?action=';
const ENDPOINT_ANIO2 = '../../app/api/dashboard/dashboard.php?action=readAnios';
const API_USUARIOS = '../../app/api/dashboard/usuarios.php?action=';


document.addEventListener('DOMContentLoaded',function(){
    //Función para mostrar graficos
    showCharts();
    createSesionHistory();
    checkIfEmailIsValidated();
});

//Se verifica si el usuario ha validado su correo.
function checkIfEmailIsValidated() {
    fetch(API_USUARIOS + 'checkIfEmailIsValidated', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    if (response.dataset.verificado == '0') {
                        
                        document.getElementById('alerta-verificacion').classList.remove('d-none');
                    } else if (response.dataset.verificado == '1') {
                        
                        document.getElementById('alerta-verificacion').remove();
                    }
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

//Funcion para enviar un correo electronico con el codigo de verificacion
function sendEmailCode(){
    fetch(API_USUARIOS + 'sendEmailCode', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    
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

//Función para completar el autotab 
function autotab(current, to, prev) {
    if (current.getAttribute &&
        current.value.length == current.getAttribute("maxlength")) {
        to.focus();
    } else {
        prev.focus();
    }
}

//Función para verificar el codigo
document.getElementById('verificarCodigo-form').addEventListener('submit', function (event) {
    //Se evita que se recargue la pagina
    var uno = document.getElementById('1a').value;
    var dos = document.getElementById('2a').value;
    var tres = document.getElementById('3a').value;
    var cuatro = document.getElementById('4a').value;
    var cinco = document.getElementById('5a').value;
    var seis = document.getElementById('6a').value;
    document.getElementById('codigoAuth').value = uno + dos + tres + cuatro + cinco + seis;

    event.preventDefault();
    fetch(API_USUARIOS + 'verifyCodeEmail', {
        method: 'post',
        body: new FormData(document.getElementById('verificarCodigo-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Mostramos mensaje de exito
                    closeModal('verificarCorreo');
                    sweetAlert(1, response.message, 'dashboard.php');
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
});

//Se ejecuta al desplegar el collapse
document.getElementById('btnCollapseGraficas').addEventListener('click',function(){
    //Función para mostrar graficos
    showCharts();
});

//Se ejecuta al presionar el boton para seleccionar un producto con historial de movimientos de stock
document.getElementById('btnModalInventario').addEventListener('click',function(){
    //Se cargan los datos a la tabla
    readMovements();
});

//Se ejecuta al presionar el boton para seleccionar un residente con visitas
document.getElementById('btnModalResidente').addEventListener('click',function(){
    //Se cargan los datos a la tabla
    readResidents();
})

//Se ejecuta al presionar el boton para seleccionar un espacio con usos
document.getElementById('btnModalEspacio').addEventListener('click',function(){
    //Se cargan los datos a la tabla
    readSpaces();
})

//Se ejecuta al presionar el boton para seleccionar un mes y un año de aportaciones
document.getElementById('btnModalAportaciones').addEventListener('click',function(){
    //Se asigna el año actual a la funcion
    var date = new Date();
    var año = date.getFullYear();
    //Se cargan los datos a la tabla
    fillSelect2(ENDPOINT_ANIO2, 'cbAnio', null);
    readYears(año);
});

//Para reiniciar busquedas
document.getElementById('btnReiniciarMovimientos').addEventListener('click',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //Ejecutamos el metodo default
    readMovements();
})

document.getElementById('btnReiniciarResidentes').addEventListener('click',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //Ejecutamos el metodo default
    readResidents();
})

document.getElementById('btnReiniciarEspacios').addEventListener('click',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //Ejecutamos el metodo default
    readSpaces();
})

//Busca los movimientos de un producto
document.getElementById('search-form-historialInventario').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //Realizamos el fetch
    fetch(API_DASHBOARD + 'searchMovements', {
        method: 'post',
        body: new FormData(document.getElementById('search-form-historialInventario'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                    fillMovements(response.dataset);
                    sweetAlert(1, response.message, null);
                } else {
                    sweetAlert(2, response.exception, null);
                    console.log("error");
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
})

//Busca los residentes y sus visitas
document.getElementById('search-form-residenteVisita').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //Realizamos el fetch
    fetch(API_DASHBOARD + 'searchVisitsByResident', {
        method: 'post',
        body: new FormData(document.getElementById('search-form-residenteVisita'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                    fillResidents(response.dataset);
                    sweetAlert(1, response.message, null);
                } else {
                    sweetAlert(2, response.exception, null);
                    console.log("error");
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});

//Busca los espacios y sus usos
document.getElementById('search-form-espacioVeces').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //Realizamos el fetch
    fetch(API_DASHBOARD + 'searchSpacesUses', {
        method: 'post',
        body: new FormData(document.getElementById('search-form-espacioVeces'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                    fillSpaces(response.dataset);
                    sweetAlert(1, response.message, null);
                } else {
                    sweetAlert(2, response.exception, null);
                    console.log("error");
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});

//Carga la tabla de movimientos de un producto
function readMovements() {
    fetch(API_DASHBOARD + 'readMovements', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;
                } else {
                    closeModal('historialInventario');
                    sweetAlert(4, response.exception, null);
                }
                // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                fillMovements(data);
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

//Carga la tabla de residentes con visitas
function readResidents() {
    fetch(API_DASHBOARD + 'visitsByResident', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;
                } else {
                    closeModal('residenteVisita');
                    sweetAlert(4, response.exception, null);
                }
                // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                fillResidents(data);
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

//Carga la tabla de espacios con usos
function readSpaces() {
    fetch(API_DASHBOARD + 'spacesUses', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;
                } else {
                    closeModal('espacioVeces');
                    sweetAlert(4, response.exception, null);
                }
                // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                fillSpaces(data);
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

//Carga la tabla de años y meses para aportaciones
function readYears(año) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('ano', año);
    
    fetch(API_DASHBOARD + 'contributionsByYear', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;
                } else {
                    //closeModal('mesAño');
                    sweetAlert(4, response.exception, null);
                }
                // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                fillYears(data);
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function fillYears(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <tr>
            <!-- Datos-->
            <td>${row.mespago}</td>
            <td>${row.aportaciones}</td>
            <!-- Boton-->
            <th scope="row">
                <div class="row paddingBotones">
                    <div class="col-12">
                        <a href="#" data-toggle="modal" onclick="setIdMespago(${row.idmespago})" class="btn btnTabla"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
            </th>
        </tr>
        `; 
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows5').innerHTML = content;
}

function fillMovements(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <tr>
            <!-- Datos-->
            <td>${row.nombreproducto}</td>
            <td>${row.movimientos}</td>
            <!-- Boton-->
            <th scope="row">
                <div class="row paddingBotones">
                    <div class="col-12">
                        <a href="#" data-toggle="modal" onclick="setIdMaterial(${row.idmaterial})" class="btn btnTabla"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
            </th>
        </tr>
        `; 
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows2').innerHTML = content;
}

function fillResidents(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <tr>
            <!-- Datos-->
            <td>${row.residente}</td>
            <td>${row.visitas}</td>
            <!-- Boton-->
            <th scope="row">
                <div class="row paddingBotones">
                    <div class="col-12">
                        <a href="#" data-toggle="modal" onclick="setIdResidente(${row.idresidente})" class="btn btnTabla"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
            </th>
        </tr>
        `; 
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows3').innerHTML = content;
}

function fillSpaces(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <tr>
            <!-- Datos-->
            <td>${row.nombre}</td>
            <td>${row.usos}</td>
            <!-- Boton-->
            <th scope="row">
                <div class="row paddingBotones">
                    <div class="col-12">
                        <a href="#" data-toggle="modal" onclick="setIdEspacio(${row.idespacio})" class="btn btnTabla"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
            </th>
        </tr>
        `; 
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows4').innerHTML = content;
}

//Setea el id de un registro al input y posteriormente se ejecuta el evento submit del formulario
function setIdMaterial(id){
    //Se asigna el id al input
    document.getElementById('txtIdMaterial').value = id;
    //Se cierra el modal
    closeModal('historialInventario');
    //Se ejecuta la función de la grafica
    graficaLineaHistorialInventario();
}

//Setea el id del residente al input y posteriormente se ejecuta el evento submit del formulario
function setIdResidente(id){
    //Se asigna el id al input
    document.getElementById('idresidente').value = id;
    //Se cierra el modal
    closeModal('residenteVisita');
    //Se ejecuta la funcion de la grafica
    graficaBarrasResidente();
}

//Setea el id del espacip al input y posteriormente se ejecuta el evento submit del formulario
function setIdEspacio(id){
    //Se asigna el id al input
    document.getElementById('idespacio').value = id;
    //Se cierra el modal
    closeModal('espacioVeces');
    //Se ejecuta la funcion de la grafica
    graficaLineasEspacioUsos();
}

//Setea el id del espacip al input y posteriormente se ejecuta el evento submit del formulario
function setIdMespago(id){
    //Se asigna el id al input
    document.getElementById('idmespago').value = id;
    //Se cierra el modal
    closeModal('mesAño');
    //Se ejecuta la funcion de la grafica
    graficaPastelAportaciones();
}

//Genera una grafica de lineas acerca de las visitas de los ultimos 6 meses
function graficaLineaVisitas(permiso) {
    if (permiso == 1) {
        fetch(API_DASHBOARD + 'last6MonthsOfVisits', {
            method: 'get'
        }).then(function (request) {
            // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
            if (request.ok) {
                request.json().then(function (response) {
                    let cantidad = [];
                    let mes = [];
                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                    if (response.status) {
                        //Se recorre el arreglo de datos
                        response.dataset.map(function(row){
                            //Se asignan a los arreglos creados previamente
                            cantidad.push(row.visitas);
                            mes.push(row.mes);
                        });
    
                        //Se establece el color para las fuentes de chartJS en base al modo del sistema
                        var modo = document.getElementById('txtModo').value;
                        var colorFuente;
    
                        if (modo == 'light') {
                            colorFuente = 'rgb(0,0,0)';
                        } else if (modo == 'dark') {
                            colorFuente = 'rgb(255,255,255)';
                        }
    
                        //Creamos un arreglo para guardar los meses de forma textual
                        let meses = [];
                        //Recorremos el arreglo de meses uno por uno y evaluamos su valor 
                        for (let index = 0; index < mes.length; index++) {
                            if (mes[index] == 1) {
                                meses[index] = 'Enero';
                            } else if(mes[index] == 2) {
                                meses[index] = 'Febrero';
                            } else if(mes[index] == 3) {
                                meses[index] = 'Marzo';
                            } else if(mes[index] == 4) {
                                meses[index] = 'Abril';
                            } else if(mes[index] == 5) {
                                meses[index] = 'Mayo';
                            } else if(mes[index] == 6) {
                                meses[index] = 'Junio';
                            } else if(mes[index] == 7) {
                                meses[index] = 'Julio';
                            } else if(mes[index] == 8) {
                                meses[index] = 'Agosto';
                            } else if(mes[index] == 9) {
                                meses[index] = 'Septiembre';
                            } else if(mes[index] == 10) {
                                meses[index] = 'Octubre';
                            } else if(mes[index] == 11) {
                                meses[index] = 'Noviembre';
                            } else if(mes[index] == 2) {
                                meses[index] = 'Diciembre';
                            }
                        }
    
                        lineGraph('cnVisitas6Meses', meses, cantidad, 'Visitas', 'Cantidad de visitas: ', 'Visitas Mensuales del Último Semestre', colorFuente);
                    } else {
                        //Si no hay visitas, se oculta el canvas y se muestra un div con un mensaje.
                        document.getElementById('cnVisitas6Meses').className = 'd-none';
                        document.getElementById('noVisitas').className = 'd-flex flex-column justify-content-center align-items-center';
    
                    }
                });
            } else {
                console.log(request.status + ' ' + request.statusText);
            }
        }).catch(function (error) {
            console.log(error);
        });
    } else {
        //Si no hay visitas, se oculta el canvas y se muestra un div con un mensaje.
        document.getElementById('cnVisitas6Meses').className = 'd-none';
        document.getElementById('noVisitas').className = 'd-flex flex-column justify-content-center align-items-center';
        document.getElementById('mensaje5').textContent = 'Información no disponible.';
    }
}

//Se acciona al cambiar de valor el select
document.getElementById('cbAnio').addEventListener('change',function(){
    //Asignamos el valor del select a un input invisible
    var num = document.getElementById('cbAnio').value;
    readYears(num);
})

//Genera una grafica de pastel con el porcentaje de aportaciones por estado por mes
function graficaPastelAportaciones(){
    //Se presiona el boton del formulario invisible para activar el evento submit
    document.getElementById('btnMesPago').click();
}

//Al accionar el evento submit de aportacionesEstado-form
document.getElementById('aportacionesEstado-form').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //fetch
    fetch(API_DASHBOARD + 'stateContributions', {
        method: 'post',
        body: new FormData(document.getElementById('aportacionesEstado-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    //Creamos arreglos para guardar la informacion
                    let estadoaportacion = [];
                    let porcentajestados = [];
                    let mespago = [];

                    //recorremos los registros obtenidos y lo sagregamos a los arreglos
                    response.dataset.map(function(row){
                        ///Asignamos
                        estadoaportacion.push(row.estadoaportacion);
                        porcentajestados.push(row.porcentajestados);
                        mespago.push(row.mespago);
                    });

                    //Se destruye el elemento actual para poder crear otro
                    document.getElementById('contenedorGraficaAportaciones').removeChild(document.getElementById('cnAportaciones'));
                    //Creamos un nuevo canvas
                    var graph = document.createElement('canvas');
                    //Asignamos el mismo id
                    graph.id = 'cnAportaciones';   
                    //Agregamos el elemento al div
                    document.getElementById('contenedorGraficaAportaciones').appendChild(graph);
                    //Se establece el color para las fuentes de chartJS en base al modo del sistema
                    var modo = document.getElementById('txtModo').value;
                    var colorFuente;
                    var colorFondo;

                    if (modo == 'light') {
                        colorFuente = 'rgb(0,0,0)';
                    } else if (modo == 'dark') {
                        colorFuente = 'rgb(255,255,255)';
                    }

                    if (modo == 'light') {
                        colorFondo = '#F1F4F9';
                    } else if (modo == 'dark') {
                        colorFondo = '#121212';
                    }

                    //Recorremos el arreglo para limitar los decimales
                    for (let index = 0; index < porcentajestados.length; index++) {
                        var num = parseInt(porcentajestados[index]);
                        porcentajestados[index] = num.toFixed(2);   
                    }

                    //pieGraph
                    pieGraph('cnAportaciones', estadoaportacion, porcentajestados, mespago[0], colorFondo, colorFuente);
                } else {
                    /*se oculta el canvas
                    document.getElementById('graficaEspacioVeces').className = 'd-none';
                    document.getElementById('noEspacioVeces').className = 'd-flex flex-column justify-content-center align-items-center'; */
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
})

//Genera una grafica de lineas del historial de usos de un espacio
function graficaLineasEspacioUsos(){
    //Se presiona el boton del formulario invisible para activar el evento submit
    document.getElementById('btnEspacio').click();
}

//Al accionar el evento submit de historialInventario-form
document.getElementById('espacioVeces-form').addEventListener('submit',function(event){
    //evitamos recargar la pagina
    event.preventDefault();
    //fetch
    fetch(API_DASHBOARD + 'spaces6Months', {
        method: 'post',
        body: new FormData(document.getElementById('espacioVeces-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    //Creamos arreglos para guardar la informacion
                    let mes = [];
                    let totalusos = [];
                    let nombre = [];

                    //recorremos los registros obtenidos y lo sagregamos a los arreglos
                    response.dataset.map(function(row){
                        ///Asignamos
                        mes.push(row.mes);
                        totalusos.push(row.totaluso);
                        nombre.push(row.nombre);
                    });

                    //Se destruye el elemento actual para poder crear otro
                    document.getElementById('contenedorGraficaEspacio').removeChild(document.getElementById('cnEspacioVeces'));
                    //Creamos un nuevo canvas
                    var graph = document.createElement('canvas');
                    //Asignamos el mismo id
                    graph.id = 'cnEspacioVeces';   
                    //Agregamos el elemento al div
                    document.getElementById('contenedorGraficaEspacio').appendChild(graph);
                    //Se establece el color para las fuentes de chartJS en base al modo del sistema
                    var modo = document.getElementById('txtModo').value;
                    var colorFuente;

                    if (modo == 'light') {
                        colorFuente = 'rgb(0,0,0)';
                    } else if (modo == 'dark') {
                        colorFuente = 'rgb(255,255,255)';
                    }

                    //Creamos un arreglo para guardar los meses de forma textual
                    let meses = [];
                    //Recorremos el arreglo de meses uno por uno y evaluamos su valor 
                    for (let index = 0; index < mes.length; index++) {
                        if (mes[index] == 1) {
                            meses[index] = 'Enero';
                        } else if(mes[index] == 2) {
                            meses[index] = 'Febrero';
                        } else if(mes[index] == 3) {
                            meses[index] = 'Marzo';
                        } else if(mes[index] == 4) {
                            meses[index] = 'Abril';
                        } else if(mes[index] == 5) {
                            meses[index] = 'Mayo';
                        } else if(mes[index] == 6) {
                            meses[index] = 'Junio';
                        } else if(mes[index] == 7) {
                            meses[index] = 'Julio';
                        } else if(mes[index] == 8) {
                            meses[index] = 'Agosto';
                        } else if(mes[index] == 9) {
                            meses[index] = 'Septiembre';
                        } else if(mes[index] == 10) {
                            meses[index] = 'Octubre';
                        } else if(mes[index] == 11) {
                            meses[index] = 'Noviembre';
                        } else if(mes[index] == 2) {
                            meses[index] = 'Diciembre';
                        }
                    }
                    //lineGraph
                    lineGraph('cnEspacioVeces', meses, totalusos, 'asd', 'Usos: ', nombre[0], colorFuente);
                } else {
                    //se oculta el canvas
                    document.getElementById('graficaEspacioVeces').className = 'd-none';
                    document.getElementById('noEspacioVeces').className = 'd-flex flex-column justify-content-center align-items-center'; 
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});


//Genera una grafica de lineas del historial de movimientos de un productó
function graficaLineaHistorialInventario(){
    //Se presiona el boton del formulario invisible para activar el evento submit
    document.getElementById('btnFormHistorial').click();
}

//Al accionar el evento submit de historialInventario-form
document.getElementById('historialInventario-form').addEventListener('submit',function(event){
    //evitamos recargar la pagina
    event.preventDefault();
    //fetch
    fetch(API_DASHBOARD + 'getMovement', {
        method: 'post',
        body: new FormData(document.getElementById('historialInventario-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    //Creamos arreglos para guardar la informacion
                    let nombreproducto = [];
                    let cantidad = [];
                    let fecha = [];

                    //recorremos los registros obtenidos y lo sagregamos a los arreglos
                    response.dataset.map(function(row){
                        ///Asignamos
                        nombreproducto.push(row.nombreproducto);
                        cantidad.push(row.cantidad);
                        fecha.push(row.fecha);
                    });

                    //Se destruye el elemento actual para poder crear otro
                    document.getElementById('graficaHistorialInventario').removeChild(document.getElementById('cnHistorialInventario'));
                    //Creamos un nuevo canvas
                    var graph = document.createElement('canvas');
                    //Asignamos el mismo id
                    graph.id = 'cnHistorialInventario';   
                    //Asignamos tamaños
                    graph.width = '400';
                    //Agregamos el elemento al div
                    document.getElementById('graficaHistorialInventario').appendChild(graph);
                    //Se establece el color para las fuentes de chartJS en base al modo del sistema
                    var modo = document.getElementById('txtModo').value;
                    var colorFuente;

                    if (modo == 'light') {
                        colorFuente = 'rgb(0,0,0)';
                    } else if (modo == 'dark') {
                        colorFuente = 'rgb(255,255,255)';
                    }
                    //lineGraph
                    lineGraph('cnHistorialInventario', fecha, cantidad, 'asd', 'Cantidad en el inventario: ', nombreproducto[0], colorFuente);
                } else {
                    //se oculta el canvas
                    document.getElementById('graficaInventario').className = 'd-none';
                    document.getElementById('noInventario').className = 'd-flex flex-column justify-content-center align-items-center'; 
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });

});

//Genera una grafica de barras de las visitas de un residente
function graficaBarrasResidente(){
    //Se presiona el boton del formulario invisible para activar el evento submit
    document.getElementById('btnResidenteVisita').click();
}

//Al activar el evento submit del formulario residenteVisita-form
document.getElementById('residenteVisita-form').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //fetch
    fetch(API_DASHBOARD + 'visitsOfAResident', {
        method: 'post',
        body: new FormData(document.getElementById('residenteVisita-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    //Creamos arreglos para guardar la informacion
                    let residente = [];
                    let visitas = [];
                    let mes = [];

                    //recorremos los registros obtenidos y lo sagregamos a los arreglos
                    response.dataset.map(function(row){
                        ///Asignamos
                        residente.push(row.residente);
                        visitas.push(row.visitas);
                        mes.push(row.mes);
                    });

                    //Se destruye el elemento actual para poder crear otro
                    document.getElementById('contenedorGraficaVisitasResidente').removeChild(document.getElementById('cnVisitasResidente'));
                    //Creamos un nuevo canvas
                    var graph = document.createElement('canvas');
                    //Asignamos el mismo id
                    graph.id = 'cnVisitasResidente';   
                    //Agregamos el elemento al div
                    document.getElementById('contenedorGraficaVisitasResidente').appendChild(graph);
                    //Se establece el color para las fuentes de chartJS en base al modo del sistema
                    var modo = document.getElementById('txtModo').value;
                    var colorFuente;
                    var colorFondo;

                    if (modo == 'light') {
                        colorFuente = 'rgb(0,0,0)';
                    } else if (modo == 'dark') {
                        colorFuente = 'rgb(255,255,255)';
                    }

                    if (modo == 'light') {
                        colorFondo = '#F1F4F9';
                    } else if (modo == 'dark') {
                        colorFondo = '#121212';
                    }

                    //Creamos un arreglo para guardar los meses de forma textual
                    let meses = [];
                    //Recorremos el arreglo de meses uno por uno y evaluamos su valor 
                    for (let index = 0; index < mes.length; index++) {
                        if (mes[index] == 1) {
                            meses[index] = 'Enero';
                        } else if(mes[index] == 2) {
                            meses[index] = 'Febrero';
                        } else if(mes[index] == 3) {
                            meses[index] = 'Marzo';
                        } else if(mes[index] == 4) {
                            meses[index] = 'Abril';
                        } else if(mes[index] == 5) {
                            meses[index] = 'Mayo';
                        } else if(mes[index] == 6) {
                            meses[index] = 'Junio';
                        } else if(mes[index] == 7) {
                            meses[index] = 'Julio';
                        } else if(mes[index] == 8) {
                            meses[index] = 'Agosto';
                        } else if(mes[index] == 9) {
                            meses[index] = 'Septiembre';
                        } else if(mes[index] == 10) {
                            meses[index] = 'Octubre';
                        } else if(mes[index] == 11) {
                            meses[index] = 'Noviembre';
                        } else if(mes[index] == 2) {
                            meses[index] = 'Diciembre';
                        }
                    }
                    //barGraph
                    barGraph('cnVisitasResidente', meses, visitas, residente[0], colorFondo, colorFuente, 'Visitas: ');
                } else {
                    document.getElementById('graficaResidente').className = 'd-none';
                    document.getElementById('noVisitasResidente').className = 'd-flex flex-column justify-content-center align-items-center';
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
})

//Funcion para crear una grafica de pastel acerca de las denuncias por estado
function graficaPastelDenuncia(permiso){
    if (permiso == 1) {
        fetch(API_DASHBOARD + 'complaintPercentage', {
            method: 'get'
        }).then(function (request) {
            // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
            if (request.ok) {
                request.json().then(function (response) {
                    let estadodenuncia = [];
                    let porcentajedenuncia = [];
                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                    if (response.status) {
                        //Se recorre el arreglo de datos
                        response.dataset.map(function(row){
                            //Se asignan a los arreglos creados previamente
                            estadodenuncia.push(row.estadodenuncia);
                            porcentajedenuncia.push(row.porcentajedenuncia);
                        });
    
                        //Se establece el color para las fuentes de chartJS en base al modo del sistema
                        var modo = document.getElementById('txtModo').value;
                        var colorFuente;
                        var colorFondo;
    
                        if (modo == 'light') {
                            colorFuente = 'rgb(0,0,0)';
                        } else if (modo == 'dark') {
                            colorFuente = 'rgb(255,255,255)';
                        }
    
                        if (modo == 'light') {
                            colorFondo = '#F1F4F9';
                        } else if (modo == 'dark') {
                            colorFondo = '#121212';
                        }
    
                        //Recorremos el arreglo para limitar los decimales
                        for (let index = 0; index < porcentajedenuncia.length; index++) {
                            var num = parseInt(porcentajedenuncia[index]);
                            porcentajedenuncia[index] = num.toFixed(2);   
                        }
    
                        pieGraph('cnEstadoDenuncia', estadodenuncia, porcentajedenuncia, 'Porcentaje de Denuncias por Estado', colorFondo, colorFuente)
    
                    } else {
                        //Si no hay visitas, se oculta el canvas y se muestra un div con un mensaje.
                        document.getElementById('cnEstadoDenuncia').className = 'd-none';
                        document.getElementById('noDenuncias').className = 'd-flex flex-column justify-content-center align-items-center';
    
                    }
                });
            } else {
                console.log(request.status + ' ' + request.statusText);
            }
        }).catch(function (error) {
            console.log(error);
        });
    } else {
         //Si no hay visitas, se oculta el canvas y se muestra un div con un mensaje.
         document.getElementById('cnEstadoDenuncia').className = 'd-none';
         document.getElementById('noDenuncias').className = 'd-flex flex-column justify-content-center align-items-center';
         document.getElementById('mensaje6').textContent = 'Información no disponible.';
    }
}

//Funcion para crear una grafica de dona de los productos mas demandados
function graficaDonaProductos(permiso){
    if (permiso == 1) {
        fetch(API_DASHBOARD + 'topProducts', {
            method: 'get'
        }).then(function (request) {
            // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
            if (request.ok) {
                request.json().then(function (response) {
                    let nombreproducto = [];
                    let totalproducto = [];
                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                    if (response.status) {
                        //Se recorre el arreglo de datos
                        response.dataset.map(function(row){
                            //Se asignan a los arreglos creados previamente
                            nombreproducto.push(row.nombreproducto);
                            totalproducto.push(row.total);
                        });
    
                        //Se destruye el grafico actual para poder hacer otro
                        document.getElementById('graficaProducto').removeChild(document.getElementById('cnProductoDemandado'));
                        //Creamos un nuevo canvas
                        var graph = document.createElement('canvas');
                        //Asignamos el mismo id
                        graph.id = 'cnProductoDemandado';
                        //Aplicamos el mismo tamaño
                        graph.width = '235';
                        //Añadimos el elemento al div 
                        document.getElementById('graficaProducto').appendChild(graph);
                        //Se establece el color para las fuentes de chartJS en base al modo del sistema
                        var modo = document.getElementById('txtModo').value;
                        var colorFuente;
                        var colorFondo;
    
                        if (modo == 'light') {
                            colorFuente = 'rgb(0,0,0)';
                        } else if (modo == 'dark') {
                            colorFuente = 'rgb(255,255,255)';
                        }
    
                        if (modo == 'light') {
                            colorFondo = '#F1F4F9';
                        } else if (modo == 'dark') {
                            colorFondo = '#121212';
                        }
    
                        doughnutGraph('cnProductoDemandado', nombreproducto, totalproducto, 'Top 5 Materiales más Demandados', colorFondo, colorFuente)
    
                    } else {
                        //Si no hay visitas, se oculta el canvas y se muestra un div con un mensaje.
                        document.getElementById('cnProductoDemandado').className = 'd-none';
                        document.getElementById('noProductos').className = 'd-flex flex-column justify-content-center align-items-center';
    
                    }
                });
            } else {
                console.log(request.status + ' ' + request.statusText);
            }
        }).catch(function (error) {
            console.log(error);
        });
    } else {
        //Si no hay visitas, se oculta el canvas y se muestra un div con un mensaje.
        document.getElementById('cnProductoDemandado').className = 'd-none';
        document.getElementById('noProductos').className = 'd-flex flex-column justify-content-center align-items-center';
        document.getElementById('mensaje7').textContent = 'Información no disponible.';
    }
}

//Funcion para crear una grafica de area acerca de los espacios mas demandados
function graficaAreaEspacios(permiso){
    if (permiso == 1) {
        fetch(API_DASHBOARD + 'topSpaces', {
            method: 'get'
        }).then(function (request) {
            // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
            if (request.ok) {
                request.json().then(function (response) {
                    let nombre = [];
                    let total = [];
                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                    if (response.status) {
                        //Se recorre el arreglo de datos
                        response.dataset.map(function(row){
                            //Se asignan a los arreglos creados previamente
                            nombre.push(row.nombre);
                            total.push(row.total);
                        });
    
                        //Se destruye el grafico actual para poder hacer otro
                        document.getElementById('graficaEspacios').removeChild(document.getElementById('cnEspacioDemandado'));
                        //Creamos un nuevo canvas
                        var graph = document.createElement('canvas');
                        //Asignamos el mismo id
                        graph.id = 'cnEspacioDemandado';
                        //Aplicamos el mismo tamaño
                        graph.width = '230';
                        //Añadimos el elemento al div 
                        document.getElementById('graficaEspacios').appendChild(graph);
                        //Se establece el color para las fuentes de chartJS en base al modo del sistema
                        var modo = document.getElementById('txtModo').value;
                        var colorFuente;
                        var colorFondo;
    
                        if (modo == 'light') {
                            colorFuente = 'rgb(0,0,0)';
                        } else if (modo == 'dark') {
                            colorFuente = 'rgb(255,255,255)';
                        }
    
                        if (modo == 'light') {
                            colorFondo = '#F1F4F9';
                        } else if (modo == 'dark') {
                            colorFondo = '#121212';
                        }
    
                        polarAreaGraph('cnEspacioDemandado', nombre, total, 'Top 5 Espacios más Alquilados', colorFondo, colorFuente)
    
                    } else {
                        //Si no hay visitas, se oculta el canvas y se muestra un div con un mensaje.
                        document.getElementById('cnEspacioDemandado').className = 'd-none';
                        document.getElementById('noEspacio').className = 'd-flex flex-column justify-content-center align-items-center';
    
                    }
                });
            } else {
                console.log(request.status + ' ' + request.statusText);
            }
        }).catch(function (error) {
            console.log(error);
        });
    } else {
        //Si no hay visitas, se oculta el canvas y se muestra un div con un mensaje.
        document.getElementById('cnEspacioDemandado').className = 'd-none';
        document.getElementById('noEspacio').className = 'd-flex flex-column justify-content-center align-items-center';
            document.getElementById('mensaje8').textContent = 'Información no disponible.';
    }
}

function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <tr>
            <!-- Fotografia-->
            <th scope="row">
                <div class="row paddingTh">
                    <div class="col-12">
                        <img src="../../resources/img/dashboard_img/usuarios_fotos/${row.foto}" alt="" class="fit-images rounded-circle" width="30px" height="30px">
                    </div>
                </div>
            </th>
            <!-- Datos-->
            <td>${row.usuario}</td>
            <td>${row.hora.substring(0,8)}</td>
            <td>${row.fecha}</td>
            <td>${row.accion}</td>
            <!-- Boton-->
            <th scope="row">
                <div class="row paddingBotones">
                    <div class="col-12">
                        <a href="#" data-toggle="modal" onclick="readBitacora(${row.idbitacora})" data-target="#bitacoraModal" class="btn btnTabla"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
            </th>
        </tr>
        `; 
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;

    $('#data-table2').DataTable({
        retrieve: true,
        searching: false,
        language:
            {
                "decimal":        "",
                "emptyTable":     "No hay información disponible en la tabla.",
                "info":           "Mostrando _START_ de _END_ de _TOTAL_ registros.",
                "infoEmpty":      "Mostrando 0 de 0 de 0 registros",
                "infoFiltered":   "(filtered from _MAX_ total entries)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Mostrar _MENU_ registros",
                "loadingRecords": "Loading...",
                "processing":     "Processing...",
                "search":         "Search:",
                "zeroRecords":    "No matching records found",
                "paginate": {
                    "first":      "AAA",
                    "last":       "Ultimo",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "aria": {
                    "sortAscending":  ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            }
    });
}

function contadorDenuncias(){
    fetch(API_DASHBOARD + 'contadorDenuncias', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById('txtDenuncia').textContent = response.dataset.denunciaspendientes;
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



function contadorVisitas() {
    fetch(API_DASHBOARD + 'contadorVisitas', {
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


function contadorAportacion() {
    fetch(API_DASHBOARD + 'contadorAportacion', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById('txtAportaciones').textContent = response.dataset.aportaciones;
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

function readBitacora(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idBitacora', id);

    fetch(API_DASHBOARD + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('txtUsuario').textContent = response.dataset.username;
                    document.getElementById('txtHora').textContent = response.dataset.hora.substring(0,8);
                    document.getElementById('txtFecha').textContent = response.dataset.fecha;
                    document.getElementById('txtAccion').textContent = response.dataset.accion;
                    document.getElementById('txtDescripcion').textContent = response.dataset.descripcion;
                    previewSavePicture('divFoto', response.dataset.foto,1);

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


function createSesionHistory(){
    fetch(API_USUARIOS + 'createSesionHistory', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    //console.log(response.message);
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