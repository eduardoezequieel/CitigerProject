<?php

require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/residentes.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../../../libraries/phpmailer65/src/Exception.php';
require '../../../libraries/phpmailer65/src/PHPMailer.php';
require '../../../libraries/phpmailer65/src/SMTP.php';

//Creando instancia para mandar correo
$mail = new PHPMailer(true);

if (isset($_GET['action'])) {
    //Se crea una sesion o se reanuda la actual
    session_start();
    //Instanciando clases
    $residente = new Residentes;
    //Array para respuesta de la API
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    //Verificando si hay una sesion iniciada
    if (isset($_SESSION['idusuario_dashboard'])) {
        //Se compara la acción a realizar cuando la sesion está iniciada
        switch ($_GET['action']) {
                //Caso para leer todos los registros de la tabla
            case 'readAll':
                if ($result['dataset'] = $residente->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Se ha encontrado al menos un residente.';
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen residentes registrados.';
                    }
                }
                break;

                //Caso para cargar un registro en especifico
            case 'readOne':
                $_POST = $residente->validateForm($_POST);
                if ($residente->setIdResidente($_POST['idResidente'])) {
                    if ($result['dataset'] = $residente->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Residente inexistente';
                        }
                    }
                } else {
                    $result['exception'] = 'Residente seleccionado incorrecto';
                }
                break;

                //Caso para realizar busquedas
            case 'search':
                $_POST = $residente->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $residente->searchRows($_POST['search'])) {
                        $result['status'] = 1;
                        $row = count($result['dataset']);
                        if ($row > 0) {
                            $result['message'] = 'Se han encontrado ' . $row . ' coincidencias';
                        } else {
                            $result['message'] = 'Se ha encontrado una coincidencia';
                        }
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay coincidencias';
                        }
                    }
                } else {
                    $result['exception'] = 'Campo vacio';
                }
                break;

                //Caso para suspender residentes
            case 'suspendRow':
                $_POST = $residente->validateForm($_POST);
                if ($residente->setIdResidente($_POST['idResidente'])) {
                    if ($residente->suspend()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha deshabilitado al residente correctamente.';
                    } else {
                        $result['exception'] = Database::getException();
                    }
                } else {
                    $result['exception'] = 'ID incorrecto';
                }
                break;

                //Caso para activar residentes
            case 'activateRow':
                $_POST = $residente->validateForm($_POST);
                if ($residente->setIdResidente($_POST['idResidente'])) {
                    if ($residente->activate()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha activado al residente correctamente.';
                    } else {
                        $result['exception'] = Database::getException();
                    }
                } else {
                    $result['exception'] = 'ID incorrecto';
                }
                break;

                //Caso para ingresar residente 
            case 'createRow':
                $_POST = $residente->validateForm($_POST);
                $residente->setIdEstadoResidente(1);
                if ($residente->setNombre($_POST['txtNombre'])) {
                    if ($residente->setApellido($_POST['txtApellido'])) {
                        if ($residente->setTelefonof($_POST['txtTelefonofijo'])) {
                            if ($residente->setTelefonom($_POST['txtTelefonomovil'])) {
                                if (is_uploaded_file($_FILES['archivo_residente']['tmp_name'])) {
                                    if ($residente->setFoto($_FILES['archivo_residente'])) {
                                        if ($residente->setCorreo($_POST['txtCorreo'])) {
                                            if ($residente->setNacimiento($_POST['txtFechaNacimiento'])) {
                                                if (isset($_POST['cbGenero'])) {
                                                    if ($residente->setGenero($_POST['cbGenero'])) {
                                                        if ($residente->setDui($_POST['txtDUI'])) {
                                                            if ($residente->setUsername($_POST['txtUser'])) {
                                                                $contraseña = random_bytes(5);
                                                                $residente->setContrasenia(bin2hex($contraseña));
                                                                if ($residente->createRow()) {
                                                                    $result['status'] = 1;
                                                                    if ($residente->saveFile($_FILES['archivo_residente'], $residente->getRuta(), $residente->getFoto())) {
                                                                        $result['message'] = 'Residente registrado correctamente';
                                                                    } else {
                                                                        $result['message'] = 'Residente registrado pero no se guardó la imagen';
                                                                    }
                                                                } else {
                                                                    $result['exception'] = Database::getException();
                                                                }
                                                            } else {
                                                                $result['exception'] = 'Usuario invalido.';
                                                            }
                                                        } else {
                                                            $result['exception'] = 'DUI invalido.';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Genero invalido.';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Genero invalido.';
                                                }
                                            } else {
                                                $result['exception'] = 'Fecha de nacimiento invalido.';
                                            }
                                        } else {
                                            $result['exception'] = 'Correo invalido.';
                                        }
                                    } else {
                                        $result['exception'] = 'Foto invalida.';
                                    }
                                } else {
                                    $result['exception'] = 'Por favor cargue una fotografía.';
                                }
                            } else {
                                $result['exception'] = 'Telefono Movil invalido.';
                            }
                        } else {
                            $result['exception'] = 'Telejono Fijo invalido.';
                        }
                    } else {
                        $result['exception'] = 'Apellido invalido.';
                    }
                } else {
                    $result['exception'] = 'Nombre invalido.';
                }
                break;

                //Caso para actualizar el registro
            case 'updateRow':
                $_POST = $residente->validateForm($_POST);
                if ($residente->setIdResidente($_POST['idResidente'])) {
                    if ($data = $residente->readOne()) {
                        if ($residente->setNombre($_POST['txtNombre'])) {
                            if ($residente->setApellido($_POST['txtApellido'])) {
                                if ($residente->setTelefonof($_POST['txtTelefonofijo'])) {
                                    if ($residente->setTelefonom($_POST['txtTelefonomovil'])) {
                                        if ($residente->setCorreo($_POST['txtCorreo'])) {
                                            if ($residente->setNacimiento($_POST['txtFechaNacimiento'])) {
                                                if (isset($_POST['cbGenero'])) {
                                                    if ($residente->setGenero($_POST['cbGenero'])) {
                                                        if ($residente->setDui($_POST['txtDUI'])) {
                                                            if ($residente->setUsername($_POST['txtUser'])) {
                                                                if (is_uploaded_file($_FILES['archivo_residente']['tmp_name'])) {
                                                                    if ($residente->setFoto($_FILES['archivo_residente'])) {
                                                                        if ($residente->updateRow($data['foto'])) {
                                                                            $result['status'] = 1;
                                                                            if ($residente->saveFile($_FILES['archivo_residente'], $residente->getRuta(), $residente->getFoto())) {
                                                                                $result['message'] = 'Residente modificado correctamente';
                                                                            } else {
                                                                                $result['message'] = 'Residente modificado pero no se guardó la imagen';
                                                                            }
                                                                        } else {
                                                                            $result['exception'] = Database::getException();
                                                                        }
                                                                    } else {
                                                                        $result['exception'] = $residente->getImageError();
                                                                    }
                                                                } else {
                                                                    if ($residente->updateRow($data['foto'])) {
                                                                        $result['status'] = 1;
                                                                        $result['message'] = 'Residente modificado correctamente';
                                                                    } else {
                                                                        $result['exception'] = Database::getException();
                                                                    }
                                                                }
                                                            } else {
                                                                $result['exception'] = 'Usuario invalido.';
                                                            }
                                                        } else {
                                                            $result['exception'] = 'DUI invalido.';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Genero invalido.';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Genero invalido.';
                                                }
                                            } else {
                                                $result['exception'] = 'Fecha de nacimiento invalido.';
                                            }
                                        } else {
                                            $result['exception'] = 'Correo invalido.';
                                        }
                                    } else {
                                        $result['exception'] = 'Telefono Movil invalido.';
                                    }
                                } else {
                                    $result['exception'] = 'Telejono Fijo invalido.';
                                }
                            } else {
                                $result['exception'] = 'Apellido invalido.';
                            }
                        } else {
                            $result['exception'] = 'Nombre invalido';
                        }
                    } else {
                    }
                } else {
                }
                break;

                //Caso para eliminar el registro
            case 'delete':
                $_POST = $residente->validateForm($_POST);
                if ($residente->setIdResidente($_POST['idResidente'])) {
                    if ($data = $residente->readOne()) {
                        if ($residente->deleteRow()) {
                            if ($residente->deleteFile($residente->getRuta(), $data['foto'])) {
                                $result['status'] = 1;
                                $result['message'] = 'Residente eliminado correctamente';
                            } else {
                                $result['exception'] = 'Se borró el registro pero no la imagen';
                            }
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Residente no existente';
                    }
                } else {
                    $result['exception'] = 'Residente seleccionado incorrecto';
                }
                break;

                //Caso para buscar la casa del residente
            case 'readCasa':
                $_POST = $residente->validateForm($_POST);
                if ($residente->setIdResidente($_POST['txtIdx'])) {
                    if ($result['dataset'] = $residente->getCasaResidente()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'El residente no tiene casa asignada';
                        }
                    }
                } else {
                    $result['exception'] = 'Casa incorrecta';
                }
                break;

            case 'readCasas':

                if ($result['dataset'] = $residente->cargarCasas()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen casas registrados.';
                    }
                }
                break;

            case 'searchCasa':
                $_POST = $residente->validateForm($_POST);
                if ($_POST['search2'] != '') {
                    if ($result['dataset'] = $residente->searchCasa($_POST['search2'])) {
                        $result['status'] = 1;
                        $rows = count($result['dataset']);
                        if ($rows > 1) {
                            $result['message'] = 'Se encontraron ' . $rows . ' coincidencias';
                        } else {
                            $result['message'] = 'Solo existe una coincidencia';
                        }
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay coincidencias';
                        }
                    }
                } else {
                    $result['exception'] = 'Ingrese un valor para buscar';
                }
                break;

            case 'createResidenteCasa':
                $_POST = $residente->validateForm($_POST);
                if ($residente->setIdResidente($_POST['txtIdx'])) {
                    if ($residente->setIdCasa($_POST['txtCasa'])) {
                        if ($residente->ingresarResidenteCasa()) {
                            $result['status'] = 1;
                            $result['message'] = 'Casa registrada correctamente.';
                            $residente->registerAction('Registrar', 'El usuario registró un registro en la tabla de residentesCasa.');
                        } else {
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Casa inválida.';
                    }
                } else {
                    $result['exception'] = 'Número inválido.';
                }
                break;

            case 'updateResidenteCasa':
                $_POST = $residente->validateForm($_POST);
                if ($residente->setIdResidente($_POST['txtIdx'])) {
                    if ($residente->getCasaResidente()) {
                        if ($residente->setIdCasa($_POST['txtCasa'])) {
                            if ($residente->updateResidenteCasa()) {
                                $result['status'] = 1;
                                $result['message'] = 'Casa actualizada correctamente';
                                $residente->registerAction('Actualizar', 'El usuario actualizó un registro en la tabla de residentesCasa.');
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Casa incorrecta';
                        }
                    } else {
                        $result['exception'] = 'Residente incorrecto';
                    }
                } else {
                    $result['exception'] = 'Residente incorrecto';
                }
                break;
                //Caso para actualizar la contraseña de primer uso 
            case 'changePassword':
                $_POST = $residente->validateForm($_POST);
                if ($_POST['txtContrasena'] == $_POST['txtConfirmarContra']) {
                    if ($_POST['txtContrasena'] != 'newResident') {
                        if ($residente->setContrasenia($_POST['txtContrasena'])) {
                            if ($residente->changePassword()) {
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
            case 'readOne2':
                $_SESSION['idresidente'] = $_POST['txtId'];
                if ($_SESSION['idresidente'] != null) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Factura inexistente';
                }
                break;

                //Caso de default del switch
            default:
                $result['exception'] = 'La acción no está disponible dentro de la sesión';
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        //Si la sesion no esta iniciada, entonces:
        print(json_encode('Acceso denegado. Por favor iniciar sesión'));
    }
} else {
    print(json_encode('Recurso no disponible'));
}
