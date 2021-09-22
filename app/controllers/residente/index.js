//Constante para la ruta API
const API_USUARIO = '../../app/api/residente/index.php?action=';

//Al cargar la pagina
document.addEventListener('DOMContentLoaded',function(){
    //Método para activar usuario después de 24 horas
    checkBlockUsers();
    //Verificando si hay una sesión iniciada
    fetch(API_USUARIO + 'validateSession')
    .then(request => {
        //Se verifica si la petición fue correcta
        if (request.ok) {
            request.json().then(response => {
                //Se verifica si la respuesta no es correcta para redireccionar al primer uso
                if (response.status) {
                    window.location.href = 'dashboard.php';
                } else {
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error))
});

//Método para iniciar sesion
document.getElementById('login-form').addEventListener('submit', function (event) {
    //Evento para que no recargue la pagina
    event.preventDefault();

    //Verificando las credenciales del usuario
    fetch(API_USUARIO + 'logIn', {
        method: 'post',
        body: new FormData(document.getElementById('login-form'))
    }).then(request => {
        //Verificando si la petición fue correcta
        if (request.ok) {
            request.json().then(response => {
                //Verificando si la respuesta es satisfactoria de lo contrario se muestra la excepción
                if (response.status) {
                    sweetAlert(1, response.message, 'dashboard.php');
                } else {
                    if (response.error) {
                        document.getElementById('txtBitacoraPassword').value = response.dataset.idbitacora;
                        openModal('obligatorioContrasena');
                    } else {
                        sweetAlert(2, response.exception, null);
                    }
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error));
})

function checkBlockUsers(){
    //Verificando si hay usuarios bloqueados que ya cumplieron su penalización
    fetch(API_USUARIO + 'checkBlockUsers').then(request => {
        //Verificando si la petición fue correcta
        if (request.ok) {
            request.json().then(response => {
                //Verificando si la respuesta es satisfactoria de lo contrario se muestra la excepción
                if (response.status) {
                    response.dataset.map(function (row){
                        document.getElementById('txtId').value = row.idresidente;
                        document.getElementById('txtBitacora').value = row.idbitacora;
                        //Activando los usuarios que ya cumplieron con su penalización
                        fetch(API_USUARIO + 'activateBlockUsers', {
                            method: 'post',
                            body: new FormData(document.getElementById('login-form'))
                        }).then(request => {
                            //Verificando si la petición fue correcta
                            if (request.ok) {
                                request.json().then(response => {
                                    //Verificando si la respuesta es satisfactoria de lo contrario se muestra la excepción
                                    if (response.status) {
                                    }
                                })
                            } else {
                                console.log(request.status + ' ' + request.statusText);
                            }
                        }).catch(error => console.log(error));
                    })
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error));
}

//Actualizando contraseña por obligación después de 90 días
document.getElementById('90password-form').addEventListener('submit',function(event){
    event.preventDefault();
    //Verificando las credenciales del usuario
    fetch(API_USUARIO + 'changePassword', {
        method: 'post',
        body: new FormData(document.getElementById('90password-form'))
    }).then(request => {
        //Verificando si la petición fue correcta
        if (request.ok) {
            request.json().then(response => {
                //Verificando si la respuesta es satisfactoria de lo contrario se muestra la excepción
                if (response.status) {
                    sweetAlert(1, response.message, 'dashboard.php');
                } else {
                    sweetAlert(2, response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error));
})

//Función para mostrar o ocultar contraseñas
function showHidePassword3(checkbox, pass1, pass2, pass3) {
    var check = document.getElementById(checkbox);
    var password1 = document.getElementById(pass1);
    var password2 = document.getElementById(pass2);
    var password3 = document.getElementById(pass3);
    //Verificando el estado del check
    if (check.checked == true) {
        password1.type = 'text';
        password2.type = 'text';
        password3.type = 'text';
    } else {
        password1.type = 'password';
        password2.type = 'password';
        password3.type = 'password';
    }
}
