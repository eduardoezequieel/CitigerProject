<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/residentes.php');

//Verificando si existe alguna acción
if (isset($_GET['action'])) {
    //Se crea una sesion o se reanuda la actual
    session_start();
    //Instanciando clases
    $usuarios = new Residentes;
    //Array para respuesta de la API
    $result = array('status' => 0, 'recaptcha' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    //Verificando si hay una sesion iniciada
    if (isset($_SESSION['idresidente'])) {
        //Se compara la acción a realizar cuando la sesion está iniciada
        switch ($_GET['action']) {
                //Caso para cerrar la sesión
            case 'logOut':
                unset($_SESSION['idresidente']);
                $result['status'] = 1;
                $result['message'] = 'Sesión eliminada correctamente';
                break;
            //Redirige al dashboard
            case 'validateSession':
                $result['status'] = 1;
                $result['message'] = 'Posee una sesión activa.';
                break;
            //Caso para setear el light mode
            case 'setLightMode':
                if ($usuarios->setLightMode()) {
                    $result['status'] = 1;
                    $result['message'] = 'Modo claro activado correctamente.';
                } else {
                    $result['exception'] = 'Ocurrio un problema-';
                }
                break;
            //Caso para setear el dark mode
            case 'setDarkMode':
                if ($usuarios->setDarkMode()) {
                    $result['status'] = 1;
                    $result['message'] = 'Modo oscuro activado correctamente.';
                } else {
                    $result['exception'] = 'Ocurrio un problema-';
                }
                break;
            //Caso para leer la información del usuario logueado
            case 'readProfile2':
                if ($result['dataset'] = $usuarios->readProfile2()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Usuario inexistente';
                    }
                }
                break;
            //Caso para editar información del perfil
            case 'editProfile':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setDui($_POST['txtDUI'])) {
                    if ($usuarios->setTelefonof($_POST['txtTelefonoFijo'])) {
                        if ($usuarios->setTelefonom($_POST['txtTelefonomovil'])) {
                            if ($usuarios->setNacimiento($_POST['txtFechaNacimiento'])) {
                                if ($usuarios->setNombre($_POST['txtNombres'])) {
                                    if ($usuarios->setApellido($_POST['txtApellidos'])) {
                                        if (isset($_POST['cbGenero'])) {
                                            if ($usuarios->setGenero($_POST['cbGenero'])) {

                                                if ($usuarios->updateInfo()) {
                                                    $result['status'] = 1;
                                                    $result['message'] = 'Perfil modificado correctamente';
                                                } else {
                                                    $result['exception'] = Database::getException();
                                                }
                                            } else {
                                                $result['exception'] = 'Seleccione una opción';
                                            }
                                        } else {
                                            $result['exception'] = 'Correo incorrecto';
                                        }
                                    } else {
                                        $result['exception'] = 'Apellido invalido';
                                    }
                                } else {
                                    $result['exception'] = 'Nombre invalido';
                                }
                            } else {
                                $result['exception'] = 'Fecha invalida';
                            }
                        } else {
                            $result['exception'] = 'Telefono invalido';
                        }
                    } else {
                        $result['exception'] = 'Telefono invalido';
                    }
                } else {
                    $result['exception'] = 'DUI invalido';
                }
                break;
            //Caso para actualizar una foto
            case 'updateFoto':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setFoto($_FILES['archivo_usuario'])) {
                    if ($data = $usuarios->readProfile2()) {
                        if ($usuarios->updateFoto($data['foto'])) {
                            $result['status'] = 1;
                            $_SESSION['foto'] = $usuarios->getFoto();
                            if ($usuarios->saveFile($_FILES['archivo_usuario'], $usuarios->getRuta(), $usuarios->getFoto())) {
                                $result['message'] = 'Foto modificada correctamente';
                            } else {
                                $result['exception'] = 'Foto no actualiza';
                            }
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = $usuarios->getImageError();
                    }
                }else{
                    $result['exception'] = 'Usuario inválido';
                }
                break;
            //Caso para actualizar la contraseña (Dentro del sistema)
            case 'updatePassword':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setIdResidente($_SESSION['idresidente'])) {
                    if ($usuarios->checkPassword($_POST['txtContrasenaActual'])) {
                        if ($_POST['txtNuevaContrasena'] == $_POST['txtConfirmarContrasena']) {
                            if ($_POST['txtNuevaContrasena'] != $_POST['txtContrasenaActual'] ||
                                $_POST['txtConfirmarContrasena'] != $_POST['txtContrasenaActual']) {
                                if ($usuarios->setContrasenia($_POST['txtNuevaContrasena'])) {
                                    if ($usuarios->changePassword()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Contraseña actualizada correctamente.';
                                        $data = $usuarios->getIdBitacora();
                                        $usuarios->setIdBitacora($data['idbitacora']);
                                        $usuarios->updateBitacoraOut('Cambio de clave');
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                } else {
                                    $result['exception'] = 'Su contraseña no cumple con los requisitos especificados.';
                                }
                            } else {
                                $result['exception'] = 'Su nueva contraseña no puede ser igual a la actual.';
                            }
                        } else {
                            $result['exception'] = 'Las contraseñas no coinciden.';
                        }
                    } else {
                        $result['exception'] = 'La contraseña ingresada es incorrecta.';
                    }
                } else {
                    $result['exception'] = 'Id incorrecto.';
                }
                
                break;
            //Caso para actualizar la contraseña
            case 'changePassword':
                $_POST = $usuarios->validateForm($_POST);
                if ($_POST['txtContrasena'] == $_POST['txtConfirmarContra']) {
                    if ($_POST['txtContrasena'] != 'newUser') {
                        if ($usuarios->setContrasenia($_POST['txtContrasena'])) {
                            if ($usuarios->changePassword()) {
                                $result['status'] = 1;
                                $result['message'] = 'Se ha actualizado la contraseña correctamente.';
                            } else {
                                if (Database::getException()) {
                                    $result['exception'] = Database::getException();
                                } else {
                                    $result['exception'] = 'No se ha actualizado la contraseña correctamente.';
                                }
                            }
                        } else {
                            $result['exception'] = 'La contraseña no es válida.';
                        }
                    } else {
                        $result['exception'] = 'La contraseña no puede ser igual a la contraseña por defecto.';
                    }
                } else {
                    $result['exception'] = 'Las contraseñas no coinciden.';
                }
                break;
            default:
                $result['exception'] = 'La acción no está disponible dentro de la sesión';
        }
    } else {
        //Se compara la acción a realizar cuando la sesion está iniciada
        switch ($_GET['action']) {
            //Caso para iniciar sesion
            case 'logIn':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->checkUser($_POST['txtCorreo'])) {
                    if ($usuarios->checkEstado()) {
                        if ($usuarios->checkPassword($_POST['txtContrasenia'])) {
                            $_SESSION['idresidente'] = $usuarios->getIdResidente();
                            $_SESSION['username'] = $usuarios->getUsername();
                            $_SESSION['foto_residente'] = $usuarios->getFoto();
                            $_SESSION['modo_residente'] = $usuarios->getModo();
                             //Se reinicia el conteo de intentos fallidos
                             if ($usuarios->increaseIntentos(0)) {
                                if ($result['dataset'] = $usuarios->checkLastPasswordUpdate()) {
                                    $result['error'] = 1;
                                    $result['message'] = 'Se ha detectado que debes actualizar
                                                            tu contraseña por seguridad.';
                                    $_SESSION['idresidente_tmp'] = $_SESSION['idresidente'];
                                    unset($_SESSION['idresidente']);
                                } else {
                                    $result['status'] = 1;
                                    $result['message'] = 'Sesión iniciada correctamente.';
                                }
                            }
                        } else {
                            //Se verifica los intentos que tiene guardado el usuario
                            if ($data = $usuarios->checkIntentos()){
                                //Se evalúa si ya el usuario ya realizó dos intentos
                                if ($data['intentos'] < 2) {
                                    //Se aumenta la cantidad de intentos
                                    if ($usuarios->increaseIntentos($data['intentos']+1)) {
                                        $result['exception'] = 'La contraseña ingresada es incorrecta';
                                        $usuarios->registerActionOut('Intento Fallido','Intento Fallido N° '.$data['intentos']+1.);
                                    }
                                } else {
                                    //Se bloquea el usuario
                                    if ($usuarios->suspend()) {
                                        $result['exception'] = 'Has superado el máximo de intentos, el usuario se ha bloquedo
                                                                por 24 horas.';
                                        $usuarios->registerActionOut('Bloqueo','Intento N° 3. Usuario bloqueado por intentos fallidos');
                                    }
                                }
                            }
                        }
                    } else {
                        $result['exception'] = 'El usuario está inactivo. Contacte con el administrador.';
                    }
                } else {
                    $result['exception'] = 'El correo ingresado es incorrecto.';
                }
                break;
            //Caso para verificar si hay usuarios que desbloquear
            case 'checkBlockUsers':
                if ($result['dataset'] = $usuarios->checkBlockUsers()) {
                    $result['status'] = 1;
                } 
                break;
            //Caso para activar los usuarios que ya cumplieron con su tiempo de penalización
            case 'activateBlockUsers':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setIdResidente($_POST['txtId'])) {
                    if ($usuarios->setIdBitacora($_POST['txtBitacora'])){
                        if ($usuarios->activate()) {
                            if ($usuarios->updateBitacoraOut('Bloqueo (Cumplido)')) {
                                if ($usuarios->increaseIntentos(0)){
                                    $result['status'] = 1;
                                }
                            }
                        }
                    } 
                }
                break;
            //Caso para cambiar la contraseña
            case 'changePassword':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setIdResidente($_SESSION['idresidente_tmp'])) {
                    if ($usuarios->checkPassword($_POST['txtContrasenaActual1'])) {
                        if ($_POST['txtNuevaContrasena1'] == $_POST['txtConfirmarContrasena1']) {
                            if ($_POST['txtNuevaContrasena1'] != $_POST['txtContrasenaActual1'] ||
                                $_POST['txtConfirmarContrasena1'] != $_POST['txtContrasenaActual1']) {
                                if ($usuarios->setContrasenia($_POST['txtNuevaContrasena1'])) {
                                    if ($usuarios->changePasswordOut()) {
                                        $usuarios->setIdBitacora($_POST['txtBitacoraPassword']);
                                        if ($usuarios->updateBitacoraOut('Cambio de clave')) {
                                            $result['status'] = 1;
                                            $result['message'] = 'Contraseña actualizada correctamente.';
                                            $_SESSION['idresidente'] =$_SESSION['idresidente_tmp'];
                                            unset($_SESSION['idresidente_tmp']);
                                        } else {
                                            $result['exception'] = 'Hubo un error al registrar la bitacora';
                                        }
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                } else {
                                    $result['exception'] = 'Su contraseña no cumple con los requisitos especificados.';
                                }
                            } else {
                                $result['exception'] = 'Su nueva contraseña no puede ser igual a la actual.';
                            }
                        } else {
                            $result['exception'] = 'Las contraseñas no coinciden.';
                        }
                    } else {
                        $result['exception'] = 'La contraseña ingresada es incorrecta.';
                    }
                } else {
                    $result['exception'] = 'Id incorrecto.';
                }
                break;
            default:
                $result['exception'] = 'La acción no está disponible afuera de la sesión';
        }
    }
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}
