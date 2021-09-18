<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/usuarios.php');

//Verificando si existe alguna acción
if (isset($_GET['action'])) {
    //Se crea una sesion o se reanuda la actual
    session_start();
    //Instanciando clases
    $usuarios = new Usuarios;
    //Array para respuesta de la API
    $result = array('status' => 0, 'recaptcha' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    //Verificando si hay una sesion iniciada
    if (isset($_SESSION['idusuario_caseta'])) {
        //Se compara la acción a realizar cuando la sesion está iniciada
        switch ($_GET['action']) {
            //Caso para leer todos los datos de la tabla
            case 'readAll':
                if ($result['dataset'] = $usuarios->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Se ha encontrado al menos un usuario';
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen usuarios registrados. Ingrese el primer usuario';
                    }
                }
                break;
            //Caso para cerrar la sesión
            case 'logOut':
                unset($_SESSION['idusuario_caseta']);
                $result['status'] = 1;
                $result['message'] = 'Sesión eliminada correctamente';
                break;
            //Redirige al dashboard
            case 'validateSession':
                $result['status'] = 1;
                $result['message'] = 'Posee una sesión activa.';
                break;
            case 'setLightMode':
                if ($usuarios->setId($_SESSION['idusuario_caseta'])) {
                    if ($usuarios->setLightMode()) {
                        $result['status'] = 1;
                        $result['message'] = 'Modo claro activado correctamente.';
                    } else {
                        $result['exception'] = 'Ocurrio un problema-';
                    }
                } else {
                    $result['exception'] = 'Id incorrecto.';
                }
                
                break;
            case 'setDarkMode':
                if ($usuarios->setId($_SESSION['idusuario_caseta'])) {
                    if ($usuarios->setDarkMode()) {
                        $result['status'] = 1;
                        $result['message'] = 'Modo oscuro activado correctamente.';
                    } else {
                        $result['exception'] = 'Ocurrio un problema-';
                    }
                } else {
                    $result['exception'] = 'Id incorrecto.';
                }
                break;
            case 'readProfile2':
                if ($usuarios->setId($_SESSION['idusuario_caseta'])) {
                    if ($result['dataset'] = $usuarios->readProfile2()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Usuario inexistente';
                        }
                    }
                } else {
                    $result['exception'] = 'Id incorrecto.';
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
                                                if ($usuarios->setId($_SESSION['idusuario_caseta'])) {
                                                    if ($usuarios->updateInfo()) {
                                                        $result['status'] = 1;
                                                        $result['message'] = 'Perfil modificado correctamente';
                                                    } else {
                                                        $result['exception'] = Database::getException();
                                                    }
                                                } else {
                                                    $result['exception'] = 'Id incorrecto.';
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
                if ($usuarios->setId($_SESSION['idusuario_caseta'])) {
                    if ($usuarios->setFoto($_FILES['archivo_usuario'])) {
                        if ($data = $usuarios->readProfile2()) {
                            if ($usuarios->updateFoto2($data['foto'])) {
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
                //Caso de default del switch
            default:
                $result['exception'] = 'La acción no está disponible dentro de la sesión';
        }
    } else {
        //Se compara la acción a realizar cuando la sesion está iniciada
        switch ($_GET['action']) {
                //Caso para leer todos los datos de la tabla
            case 'readAll':
                if ($result['dataset'] = $usuarios->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Se ha encontrado al menos un usuario.';
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen usuarios registrados. Ingrese el primer usuario.';
                    }
                }
                break;
            //Caso para iniciar sesion
            case 'logIn':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->checkUser($_POST['txtCorreo'])) {
                    if ($usuarios->checkUserType(1)) {
                        if ($usuarios->checkEstado()) {
                            if ($usuarios->checkPassword($_POST['txtContrasenia'])) {  
                                $_SESSION['idusuario_caseta'] = $usuarios->getId();
                                $_SESSION['usuario_caseta'] = $usuarios->getUsername();
                                $_SESSION['foto_caseta'] = $usuarios->getFoto();
                                $_SESSION['tipousuario_caseta'] = $usuarios->getIdTipoUsuario();
                                $_SESSION['modo_caseta'] = $usuarios->getModo();
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
                        $result['exception'] = 'El usuario no tiene los permisos necesarios para acceder.';
                    }
                } else {
                    $result['exception'] = 'El correo ingresado es incorrecto.';
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
?>