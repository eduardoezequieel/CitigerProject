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
                if (session_destroy()) {
                    $result['status'] = 1;
                    $result['message'] = 'Sesión eliminada correctamente';
                } else {
                    $result['exception'] = 'Ocurrió un problema al cerrar sesión';
                }
                break;

            case 'setLightMode':
                if ($usuarios->setLightMode()) {
                    $result['status'] = 1;
                    $result['message'] = 'Modo claro activado correctamente.';
                } else {
                    $result['exception'] = 'Ocurrio un problema-';
                }
                break;
            case 'setDarkMode':
                if ($usuarios->setDarkMode()) {
                    $result['status'] = 1;
                    $result['message'] = 'Modo oscuro activado correctamente.';
                } else {
                    $result['exception'] = 'Ocurrio un problema-';
                }
                break;

                /* 
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
            case 'editProfile':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setDui($_POST['txtDUI'])) {
                    if ($usuarios->setTelefonoFijo($_POST['txtTelefonoFijo'])) {
                        if ($usuarios->setTelefonoCelular($_POST['txtTelefonomovil'])) {
                            if ($usuarios->setNacimiento($_POST['txtFechaNacimiento'])) {
                                if ($usuarios->setNombres($_POST['txtNombres'])) {
                                    if ($usuarios->setApellidos($_POST['txtApellidos'])) {
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
            case 'changePassword':
                $_POST = $usuarios->validateForm($_POST);
                if ($_POST['txtContrasena'] == $_POST['txtConfirmarContra']) {
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
                    $result['exception'] = 'Las contraseñas no coinciden.';
                }
                break; */
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
                            $_SESSION['foto'] = $usuarios->getFoto();
                            $_SESSION['modo'] = $usuarios->getModo();
                            if ($_POST['txtContrasenia'] != 'newUser') {
                                $result['status'] = 1;
                                $result['message'] = 'Sesión iniciada correctamente.';
                            } else {
                                $result['error'] = 1;
                                $result['message'] = 'Contraseña por defecto, para mayor seguridad actualizar la clave.';
                            }
                        } else {
                            $result['exception'] = 'La contraseña ingresada es incorrecta.';
                        }
                    } else {
                        $result['exception'] = 'El usuario está inactivo. Contacte con el administrador.';
                    }
                } else {
                    $result['exception'] = 'El correo ingresado es incorrecto o no tiene los permisos requeridos.';
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
