//Constante para la direccion de la API
const API_DASHBOARD = '../../app/api/dashboard/dashboard.php?action=';

document.addEventListener('DOMContentLoaded',function(){
    //Carga la bitacora
    readRows(API_DASHBOARD);

    //Graficas
    graficaLineaVisitas();
    graficaPastelDenuncia();

    //Carga los contadores
    contadorDenuncias();
    contadorVisitas();
    contadorAportacion(); 

});

//Se ejecuta al desplegar el collapse
document.getElementById('btnCollapseGraficas').addEventListener('click',function(){
    graficaDonaProductos();
    graficaAreaEspacios();
});



//Se ejecuta al presionar el boton para seleccionar un producto con historial de movimientos de stock
document.getElementById('btnModalInventario').addEventListener('click',function(){
    //Se cargan los datos a la tabla
    readMovements();
});

//Para reiniciar busquedas
document.getElementById('btnReiniciarMovimientos').addEventListener('click',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //Ejecutamos el metodo default
    readMovements();
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

//Carga la tabla de movimientos de un producto
function readMovements(api) {
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
                        <a href="#" data-toggle="modal" onclick="#" class="btn btnTabla"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
            </th>
        </tr>
        `; 
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows2').innerHTML = content;
}

//Genera una grafica de lineas acerca de las visitas de los ultimos 6 meses
function graficaLineaVisitas() {
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

                    lineGraph('cnVisitas6Meses', meses, cantidad, 'Visitas', 'Cantidad de visitas: ', 'Visitas', colorFuente);
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
}

//Funcion para crear una grafica de pastel acerca de las denuncias por estado
function graficaPastelDenuncia(){
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

                    pieGraph('cnEstadoDenuncia', estadodenuncia, porcentajedenuncia, 'Denuncias', colorFondo, colorFuente)

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
}

//Funcion para crear una grafica de dona de los productos mas demandados
function graficaDonaProductos(){
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
                    graph.width = '230';
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

                    doughnutGraph('cnProductoDemandado', nombreproducto, totalproducto, 'Productos', colorFondo, colorFuente)

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
}

//Funcion para crear una grafica de area acerca de los espacios mas demandados
function graficaAreaEspacios(){
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

                    polarAreaGraph('cnEspacioDemandado', nombre, total, 'Espacios', colorFondo, colorFuente)

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