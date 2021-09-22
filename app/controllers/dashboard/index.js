//Constante para la ruta API
const API_USUARIO = '../../app/api/dashboard/usuarios.php?action=';

//Método para manejador de eventos cuando la pagina haya cargado
document.addEventListener('DOMContentLoaded', function () {
    //Metodo para activar todos los usuarios que ya cumplieron las 24 horas
    checkBlockUsers();
    //Verificando si hay usuarios registrados 
    fetch(API_USUARIO + 'readAll')
        .then(request => {
            //Se verifica si la petición fue correcta
            if (request.ok) {
                request.json().then(response => {
                    //Se verifica si la respuesta no es correcta para redireccionar al primer uso
                    if (!response.status) {
                        sweetAlert(3, response.exception, 'primer_uso.php');
                    } else {
                        //Verificando si hay una sesión iniciada
                        fetch(API_USUARIO + 'validateSession')
                            .then(request => {
                                //Se verifica si la petición fue correcta
                                if (request.ok) {
                                    request.json().then(response => {
                                        //Se verifica si la respuesta no es correcta para redireccionar al primer uso
                                        if (response.status) {
                                            window.location.href = 'dashboard.php';
                                        }
                                    })
                                } else {
                                    console.log(request.status + ' ' + request.statusText);
                                }
                            }).catch(error => console.log(error))
                    }
                })
            } else {
                console.log(request.status + ' ' + request.statusText);
            }
        }).catch(error => console.log(error));


})

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
                        sweetAlert(2, response.exception, clearPassword('txtContrasenia'));
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
                        document.getElementById('txtId').value = row.idusuario;
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



document.getElementById('checkMail-form').addEventListener('submit',function(event){
    //Se evita que se recargue la pagina
    event.preventDefault();
    fetch(API_USUARIO+ 'sendMail', {
        method: 'post',
        body: new FormData(document.getElementById('checkMail-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Mostramos mensaje de exito
                    sweetAlert(1, response.message, null);

                    closeModal('recuperarContraseña');
                    openModal('verificarCodigoRecuperacion');



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

function showHidePassword2(checkbox, pass1, pass2) {
    var check = document.getElementById(checkbox);
    var password1 = document.getElementById(pass1);
    var password2 = document.getElementById(pass2);
    //Verificando el estado del check
    if (check.checked == true) {
        password1.type = 'text';
        password2.type = 'text';
    } else {
        password1.type = 'password';
        password2.type = 'password';
    }
}