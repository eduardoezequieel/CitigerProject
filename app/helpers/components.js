/*
*   Este archivo es de uso general en todas las páginas web. Se importa en las plantillas del pie del documento.
*/

/*
*   Función para obtener todos los registros disponibles en los mantenimientos de tablas (operación read).
*
*   Parámetros: api (ruta del servidor para obtener los datos).
*
*   Retorno: ninguno.
*/
//Constante para la ruta API
const API_USUARIO2 = '../../app/api/dashboard/usuarios.php?action=';

document.addEventListener('DOMContentLoaded',function(){
    loadPage();
})

function loadPage(){
    var modo = document.getElementById('txtModo').value;
    if (modo == 'light') {
        //Modo claro
        //Se cambian los colores de las variables declaradas en el archivo estilos.css
        document.documentElement.style.setProperty('--color-fondo', '#ffffff');
        document.documentElement.style.setProperty('--color-fondo-opaco', '#F1F4F9');
        document.documentElement.style.setProperty('--color-tipografia-titulos', '#1C1C1C');
        document.documentElement.style.setProperty('--color-tipografia', '#1C1C1C');
        document.documentElement.style.setProperty('--bordes-inputs', '#999999');
        document.documentElement.style.setProperty('--color-citiger', '#5496F5');
        document.documentElement.style.setProperty('--color-citiger-hover', '#4174c2');
        document.documentElement.style.setProperty('--color-rojo', 'rgb(255, 183, 183)');
        document.documentElement.style.setProperty('--color-rojo-hover', 'rgb(255, 72, 72)');
        document.documentElement.style.setProperty('--color-verde', 'rgb(175, 255, 175)');
        document.documentElement.style.setProperty('--color-verde-hover', 'rgb(63, 209, 63);');
        document.documentElement.style.setProperty('--color-citiger-claro', '#c5dcff');

        //Se cambia la imagen del boton de inicio para que coincida con el modo
        document.getElementById('imgDashboard').src = '../../resources/img/citigerWhiteLogo2.png';

        //Se ocultan/muestran los botones indicados para cambiar de modo posteriormente
        document.getElementById('lightMode').className = 'd-none';
        document.getElementById('darkMode').className = 'btn fas fa-moon botonesPerfil';
    } else if (modo == 'dark') {
        //Modo oscuro
        //Se cambian los colores de las variables declaradas en el archivo estilos.css
        document.documentElement.style.setProperty('--color-fondo', '#090909');
        document.documentElement.style.setProperty('--color-fondo-opaco', '#101010');
        document.documentElement.style.setProperty('--color-tipografia-titulos', '#e6e6e6');
        document.documentElement.style.setProperty('--color-tipografia', '#ffffff');
        document.documentElement.style.setProperty('--bordes-inputs', '#3f3f3f');
        document.documentElement.style.setProperty('--color-citiger', '#5496F5');
        document.documentElement.style.setProperty('--color-citiger-hover', '#4174c2');
        document.documentElement.style.setProperty('--color-rojo', 'rgb(46, 10, 10)');
        document.documentElement.style.setProperty('--color-rojo-hover', 'rgb(255, 72, 72)');
        document.documentElement.style.setProperty('--color-verde', 'rgb(14, 61, 14)');
        document.documentElement.style.setProperty('--color-verde-hover', 'rgb(63, 209, 63)');
        document.documentElement.style.setProperty('--color-citiger-claro', '#0b1d35');

        //Se cambia la imagen del boton de inicio para que coincida con el modo
        document.getElementById('imgDashboard').src = '../../resources/img/citigerDarkLogo2.png';

        document.getElementById('lightMode').className = 'btn fas fa-sun botonesPerfil';
        document.getElementById('darkMode').className = 'd-none';
    } else {
        console.log('error');
    }
};

function lightMode(){
    //Modo claro
    setLightValue();
    
    swal({
        title: 'Aviso',
        text: 'Para ver los cambios, es necesario que reinicie la sesión. ¿Quieres cerrar la sesión?',
        icon: 'info',
        buttons: ['Lo hare después', 'Sí, por favor'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de cerrar sesión, de lo contrario se muestra un mensaje.
        if (value) {
            fetch('../../app/api/dashboard/usuarios.php?action=logOut', {
                method: 'get'
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            sweetAlert(1, response.message, 'index.php');
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
    });
}

function darkMode(){
    //Modo oscuro
    setDarkValue();

    swal({
        title: 'Reiniciar la sesión',
        text: 'Para ver los cambios, es necesario que reinicie la sesión. ¿Quieres cerrar la sesión?',
        icon: 'info',
        buttons: ['Lo hare después', 'Sí, por favor'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de cerrar sesión, de lo contrario se muestra un mensaje.
        if (value) {
            fetch('../../app/api/dashboard/usuarios.php?action=logOut', {
                method: 'get'
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            sweetAlert(1, response.message, 'index.php');
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
    });
}

function setDarkValue(){ 
    fetch(API_USUARIO2 + 'setDarkMode')
    .then(request => {
        //Se verifica si la petición fue correcta
        if (request.ok) {
            request.json().then(response => {
                //Se verifica si la respuesta no es correcta para redireccionar al primer uso
                if (response.status) {
                    console.log('modo oscuro');
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error))
}

function setLightValue(){ 
    fetch(API_USUARIO2 + 'setLightMode')
    .then(request => {
        //Se verifica si la petición fue correcta
        if (request.ok) {
            request.json().then(response => {
                //Se verifica si la respuesta no es correcta para redireccionar al primer uso
                if (response.status) {
                    console.log('modo claro');
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error))
}


function botonExaminar(idBoton, idInputExaminar) {
    document.getElementById(idBoton).addEventListener('click', function (event) {
        //Se evita recargar la pagina
        event.preventDefault();

        //Se hace click al input invisible
        document.getElementById(idInputExaminar).click();
    });
}

function previewPicture(idInputExaminar, idDivFoto) {
    document.getElementById(idInputExaminar).onchange = function (e) {

        //variable creada para obtener la URL del archivo a cargar
        let reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);

        //Se ejecuta al obtener una URL
        reader.onload = function () {
            //Parte de la pagina web en donde se incrustara la imagen
            let preview = document.getElementById(idDivFoto);

            //Se crea el elemento IMG que contendra la preview
            image = document.createElement('img');
            //Se le asigna la ruta al elemento creado
            image.src = reader.result;
            //Se aplican las respectivas clases para que la preview aparezca estilizada
            image.className = 'rounded-circle fotografiaPerfil';
            //Se quita lo que este dentro del div (en caso de que exista otra imagen)
            preview.innerHTML = ' ';
            //Se agrega el elemento recien creado
            preview.append(image);
        }
    }
}

function previewSavePicture(idDivFoto, name, foto) {
    let ruta;
    switch (foto) {
        case 1:
            ruta = '../../resources/img/dashboard_img/usuarios_fotos/';
            break;
        case 2:
            ruta = '../../resources/img/dashboard_img/empleados_fotos/'
            break;
        case 3:
            ruta = '../../resources/img/dashboard_img/residentes_fotos/';
            break;
        case 4:
            ruta = '../../resources/img/dashboard_img/materiales_fotos/';
            break;
        default:
            break;
    }
    if (foto == 0) {
        //Parte de la pagina web en donde se incrustara la imagen
        let preview = document.getElementById(idDivFoto);

        image = document.createElement('img');

        image.style.width = '130px';

        image.style.height = '130px';

        //Se aplican las respectivas clases para que la preview aparezca estilizada
        image.className = 'fit-images rounded-circle';

        //Se quita lo que este dentro del div (en caso de que exista otra imagen)
        preview.innerHTML = ' ';

        //Se agrega el elemento recien creado
        preview.append(image);
    } else {
        //Parte de la pagina web en donde se incrustara la imagen
        let preview = document.getElementById(idDivFoto);

        image = document.createElement('img');

        //Se le asigna la ruta al elemento creado
        image.src = ruta + name;

        //Se aplican las respectivas clases para que la preview aparezca estilizada
        image.className = 'fit-images rounded-circle fotoPrimerUso';

        //Se quita lo que este dentro del div (en caso de que exista otra imagen)
        preview.innerHTML = ' ';

        //Se agrega el elemento recien creado
        preview.append(image);
    } if (foto == 4) {

        let preview = document.getElementById(idDivFoto);

        image = document.createElement('img');

        //Se le asigna la ruta al elemento creado
        image.src = ruta + name;

        //Se aplican las respectivas clases para que la preview aparezca estilizada
        image.className = 'img-fluid fit-images fotoMaterial2';

        //Se quita lo que este dentro del div (en caso de que exista otra imagen)
        preview.innerHTML = ' ';

        //Se agrega el elemento recien creado
        preview.append(image);
    }
}

function restartSearch(btn, api) {
    document.getElementById(btn).addEventListener('click', function (event) {
        event.preventDefault();
        document.getElementById('search').value = '';
        readRows(api);
    })
}

function readRows2(api) {
    fetch(api + 'readProfile', {
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
                    sweetAlert(4, response.exception, null);
                }
                // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                fillTable(data);
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}


function readRows(api) {
    fetch(api + 'readAll', {
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
                    sweetAlert(4, response.exception, null);
                }
                // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                fillTable(data);
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

/*Sidebar responsive*/
$(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar, #content').toggleClass('active');
    });
});

/*
*   Función para obtener los resultados de una búsqueda en los mantenimientos de tablas (operación search).
*
*   Parámetros: api (ruta del servidor para obtener los datos) y form (identificador del formulario de búsqueda).
*
*   Retorno: ninguno.
*/
function searchRows(api, form) {
    fetch(api + 'search', {
        method: 'post',
        body: new FormData(document.getElementById(form))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                    fillTable(response.dataset);
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
}

/*
*   Función para crear o actualizar un registro en los mantenimientos de tablas (operación create y update).
*
*   Parámetros: api (ruta del servidor para enviar los datos), form (identificador del formulario) y modal (identificador de la caja de dialogo).
*
*   Retorno: ninguno.
*/
function saveRow(api, action, form, modal) {
    fetch(api + action, {
        method: 'post',
        body: new FormData(document.getElementById(form))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se cargan nuevamente las filas en la tabla de la vista después de agregar o modificar un registro.
                    readRows(api);
                    sweetAlert(1, response.message, closeModal(modal));
                    clearForm(form);
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

/*
*   Función para eliminar un registro seleccionado en los mantenimientos de tablas (operación delete). Requiere el archivo sweetalert.min.js para funcionar.
*
*   Parámetros: api (ruta del servidor para enviar los datos) y data (objeto con los datos del registro a eliminar).
*
*   Retorno: ninguno.
*/
function confirmDelete(api, data) {
    swal({
        title: 'Advertencia',
        text: '¿Desea eliminar el registro?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
        if (value) {
            fetch(api + 'delete', {
                method: 'post',
                body: data
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            // Se cargan nuevamente las filas en la tabla de la vista después de borrar un registro.
                            readRows(api);
                            sweetAlert(1, response.message, null);
                        } else {
                            sweetAlert(2, response.exception, null);
                            console.log(response.status + ' ' + response.statusText);
                        }
                    });
                } else {
                    console.log(request.status + ' ' + request.statusText);
                }
            }).catch(function (error) {
                console.log(error);
            });
        }
    });
}

/*
*   Función para manejar los mensajes de notificación al usuario. Requiere el archivo sweetalert.min.js para funcionar.
*
*   Parámetros: type (tipo de mensaje), text (texto a mostrar) y url (ubicación a direccionar al cerrar el mensaje).
*
*   Retorno: ninguno.
*/

function sweetAlert(type, text, url) {
    // Se compara el tipo de mensaje a mostrar.
    switch (type) {
        case 1:
            title = 'Éxito';
            icon = 'success';
            break;
        case 2:
            title = 'Error';
            icon = 'error';
            break;
        case 3:
            title = 'Advertencia';
            icon = 'warning';
            break;
        case 4:
            title = 'Aviso';
            icon = 'info';
    }
    // Si existe una ruta definida, se muestra el mensaje y se direcciona a dicha ubicación, de lo contrario solo se muestra el mensaje.
    if (url) {
        swal({
            title: title,
            text: text,
            icon: icon,
            button: 'Aceptar',
            closeOnClickOutside: false,
            closeOnEsc: false
        }).then(function () {
            location.href = url
        });
    } else {
        swal({
            title: title,
            text: text,
            icon: icon,
            button: 'Aceptar',
            closeOnClickOutside: false,
            closeOnEsc: false
        });
    }
}

/*
*   Función para cargar las opciones en un select de formulario.
*
*   Parámetros: endpoint (ruta del servidor para obtener los datos), select (identificador del select en el formulario) y selected (valor seleccionado).
*
*   Retorno: ninguno.
*/
function fillSelect(endpoint, select, selected) {
    fetch(endpoint, {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let content = '';
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Si no existe un valor para seleccionar, se muestra una opción para indicarlo.
                    if (!selected) {
                        content += '<option disabled selected>Seleccionar...</option>';
                    }
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se obtiene el dato del primer campo de la sentencia SQL (valor para cada opción).
                        value = Object.values(row)[0];
                        // Se obtiene el dato del segundo campo de la sentencia SQL (texto para cada opción).
                        text = Object.values(row)[1];
                        // Se verifica si el valor de la API es diferente al valor seleccionado para enlistar una opción, de lo contrario se establece la opción como seleccionada.
                        if (value != selected) {
                            content += `<option value="${value}">${text}</option>`;
                        } else {
                            content += `<option value="${value}" selected>${text}</option>`;
                        }
                    });
                } else {
                    content += '<option>Sin opciones.</option>';
                }
                // Se agregan las opciones a la etiqueta select mediante su id.
                document.getElementById(select).innerHTML = content;
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

/*
*   Función para generar una gráfica de barras verticales. Requiere el archivo chart.js para funcionar.
*
*   Parámetros: canvas (identificador de la etiqueta canvas), xAxis (datos para el eje X), yAxis (datos para el eje Y), legend (etiqueta para los datos) y title (título de la gráfica).
*
*   Retorno: ninguno.
*/
function barGraph(canvas, xAxis, yAxis, legend, title) {
    // Se establece el contexto donde se mostrará el gráfico, es decir, se define la etiqueta canvas a utilizar.
    const context = document.getElementById(canvas).getContext('2d');
    // Se crea una instancia para generar la gráfica con los datos recibidos.
    const chart = new Chart(context, {
        type: 'bar',
        data: {
            labels: xAxis,
            datasets: [{
                label: legend,
                data: yAxis,
                borderColor: '#000000',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: false
            },
            title: {
                display: true,
                text: title
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        precision: 0
                    }
                }]
            }
        }
    });
}

/*
*   Función para generar una gráfica de pastel con porcentajes. Requiere el archivo chart.js para funcionar.
*
*   Parámetros: canvas (identificador de la etiqueta canvas), legends (valores para las etiquetas), values (valores de los datos) y title (título de la gráfica).
*
*   Retorno: ninguno.
*/
function pieGraph(canvas, legends, values, title) {
    // Se declara un arreglo para guardar códigos de colores en formato hexadecimal.
    let colors = [];
    // Se declara e inicializa una variable para sumar los valores a graficar.
    let total = 0;
    // Se generan códigos hexadecimales de 6 cifras de acuerdo con el número de datos a mostrar y se van acumulando los valores.
    for (i = 0; i < values.length; i++) {
        colors.push('#' + (Math.random().toString(16)).substring(2, 8));
        total += values[i];
    }
    // Se declara un arreglo para guardar los porcentajes de cada cantidad.
    let percentages = [];
    // Se calcula el porcetaje que corresponde a cada valor.
    for (i = 0; i < values.length; i++) {
        percentages.push((values[i] * 100 / total).toFixed(2));
    }
    // Se establece el contexto donde se mostrará el gráfico, es decir, se define la etiqueta canvas a utilizar.
    const context = document.getElementById(canvas).getContext('2d');
    // Se crea una instancia para generar la gráfica con los datos recibidos.
    const chart = new Chart(context, {
        type: 'pie',
        data: {
            labels: legends,
            datasets: [{
                data: percentages,
                backgroundColor: colors
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: title
            }
        }
    });
}

//Función para abrir cualquier modal
function openModal(form) {
    $(document.getElementById(form)).modal('show');
}

//Función para cerrar cualquier modal
function closeModal(form) {
    $(document.getElementById(form)).modal('hide');
}

//Función para limpiar los campos del formulario
function clearForm(form) {
    document.getElementById(form).reset();
    var formulario = document.getElementById(form);
    for (let field of formulario) {
        field.classList.remove("error");
        field.classList.remove("success");
    }
}

//Función para resetear botones
function resetButtons(buttons, inicio){
    for (let i = inicio; i < buttons.length; i++) {
        if (i != inicio) {
            buttons[i].className = 'd-none';
        } else {
            buttons[i].className = 'btn btnAgregarFormulario mr-2';
        }
    }
}

/*
*   Función para suspender un registro en los mantenimientos de tablas (operación update).
*
*   Parámetros: api (ruta del servidor para enviar los datos), form (identificador del formulario) y modal (identificador de la caja de dialogo).
*
*   Retorno: ninguno.
*/
function suspendRow(api, form, modal) {
    swal({
        title: 'Advertencia',
        text: '¿Desea suspender el registro?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(value => {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
        if (value) {
            fetch(api + 'suspendRow', {
                method: 'post',
                body: new FormData(document.getElementById(form))
            }).then(request => {
                //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
                if (request.ok) {
                    request.json().then(response => {
                        //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                        if (response.status) {
                            readRows(api);
                            sweetAlert(1, response.message, closeModal(modal));
                            clearForm(form);
                        } else {
                            sweetAlert(2, response.exception, null);
                        }
                    })
                } else {
                    console.log(response.status + ' ' + response.exception);
                }
            }).catch(error => console.log(error));
        }
    });
}

/*
*   Función para activar un registro en los mantenimientos de tablas (operación update).
*
*   Parámetros: api (ruta del servidor para enviar los datos), form (identificador del formulario) y modal (identificador de la caja de dialogo).
*
*   Retorno: ninguno.
*/
function activateRow(api, form, modal) {
    swal({
        title: 'Advertencia',
        text: '¿Desea activar el registro?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(value => {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
        if (value) {
            fetch(api + 'activateRow', {
                method: 'post',
                body: new FormData(document.getElementById(form))
            }).then(request => {
                //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
                if (request.ok) {
                    request.json().then(response => {
                        //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                        if (response.status) {
                            readRows(api);
                            sweetAlert(1, response.message, closeModal(modal));
                            clearForm(form);
                        } else {
                            sweetAlert(2, response.exception, null);
                        }
                    })
                } else {
                    console.log(response.status + ' ' + response.exception);
                }
            }).catch(error => console.log(error));
        }
    });
}

/*
*   Función para filtrar los registros por su estado (select).
*
*   Parámetros: api (ruta del servidor para enviar los datos), form (identificador del formulario) y action (acción que se va a ejecutar).
*
*   Retorno: ninguno.
*/
function filter(api, action, form) {
    fetch(api + action, {
        method: 'post',
        body: new FormData(document.getElementById(form))
    }).then(request => {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(response => {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;
                } else {
                    sweetAlert(4, response.exception, null);
                }
                // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                fillTable(data);
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

// Función para mostrar un mensaje de confirmación al momento de cerrar sesión.
function logOut() {
    swal({
        title: 'Advertencia',
        text: '¿Quiere cerrar la sesión?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de cerrar sesión, de lo contrario se muestra un mensaje.
        if (value) {
            fetch('../../app/api/dashboard/usuarios.php?action=logOut', {
                method: 'get'
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            sweetAlert(1, response.message, 'index.php');
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
    });
}

function checkInputLetras(input) {
    var field = document.getElementById(input);
    if (field.value.trim() === "") {
        field.classList.remove("success");
        field.classList.add("error");
    } else {
        field.classList.remove("error");
        field.classList.add("success");

        if (/^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/.test(field.value)) {
            field.classList.remove("error");
            field.classList.add("success");

        } else {
            field.classList.remove("success");
            field.classList.add("error");
        }
    }

}

function checkCorreo(input) {
    var field = document.getElementById(input);
    if (field.value.trim() === "") {
        field.classList.remove("success");
        field.classList.add("error");
    } else {
        field.classList.remove("error");
        field.classList.add("success");

        if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(field.value)) {
            field.classList.remove("error");
            field.classList.add("success");
        } else {
            field.classList.remove("success");
            field.classList.add("error");
        }
    }
}

//Función para mostrar contraseña
function showHidePassword(checkbox, pass) {
    var check = document.getElementById(checkbox);
    var password = document.getElementById(pass);
    //Verificando el estado del check
    if (check.checked == true) {
        password.type = 'text';
    } else {
        password.type = 'password';
    }
}


function checkInput(input) {
    var field = document.getElementById(input);
    if (field.value.trim() === "") {
        field.classList.remove("success");
        field.classList.add("error");
    } else {
        field.classList.remove("error");
        field.classList.add("success");
    }

}

//Método para verificar telefono
function checkTelefono(input) {
    var field = document.getElementById(input);
    if (field.value.trim() === "") {
        field.classList.remove("success");
        field.classList.add("error");
    } else {
        field.classList.remove("error");
        field.classList.add("success");

        if (/[0-9-]+$/i.test(field.value)) {
            field.classList.remove("error");
            field.classList.add("success");
        } else {
            field.classList.remove("success");
            field.classList.add("error");
        }
    }

}

//Método para verificar el dui
function checkDui(input) {
    var field = document.getElementById(input);
    if (field.value.trim() === "") {
        field.classList.remove("success");
        field.classList.add("error");
    } else {
        field.classList.remove("error");
        field.classList.add("success");

        if (/(^\d{8})-(\d$)/.test(field.value)) {
            field.classList.remove("error");
            field.classList.add("success");
        } else {
            field.classList.remove("success");
            field.classList.add("error");
        }
    }
}

//Función para limpiar contraseña
function clearPassword(clave) {
    var contra = document.getElementById(clave);
    contra.value = '';
    contra.classList.remove("error");
    contra.classList.remove("success");
}