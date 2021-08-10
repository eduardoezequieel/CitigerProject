//Constante para la direccion de la API
const API_DASHBOARD = '../../app/api/dashboard/dashboard.php?action=';

document.addEventListener('DOMContentLoaded',function(){
    //Carga la bitacora
    readRows(API_DASHBOARD);

    //Graficas
    graficaLineaVisitas();

    //Carga los contadores
    contadorDenuncias();
    contadorVisitas();
    contadorAportacion(); 
});

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

                    lineGraph('cnVisitas6Meses', meses, cantidad, 'Visitas', 'Cantidad de visitas: ', 'Visitas los Ultimos 6 Meses', colorFuente);
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