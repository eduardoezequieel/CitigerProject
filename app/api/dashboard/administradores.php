<?php

require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/usuarios.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../../../libraries/phpmailer65/src/Exception.php';
require '../../../libraries/phpmailer65/src/PHPMailer.php';
require '../../../libraries/phpmailer65/src/SMTP.php';

//Creando instancia para mandar correo
$mail = new PHPMailer(true);

//Verificando si existe alguna acción
if (isset($_GET['action'])) {
    //Se crea una sesion o se reanuda la actual
    session_start();
    //Instanciando clases
    $usuarios = new Usuarios;
    //Array para respuesta de la API
    $result = array('status' => 0, 'recaptcha' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    //Verificando si hay una sesion iniciada
    if (isset($_SESSION['idusuario_dashboard'])) {
        //Se compara la acción a realizar cuando la sesion está iniciada
        switch ($_GET['action']) {
            //Caso registrar a un nuevo usuario
            case 'register':
                $_POST = $usuarios->validateForm($_POST);
                if (isset($_POST['cbTipoEmpleado2'])) {
                    if ($usuarios->setIdTipoUsuario($_POST['cbTipoEmpleado2'])) {
                        if ($usuarios->setNombres($_POST['txtNombre'])) {
                            if ($usuarios->setApellidos($_POST['txtApellido'])) {
                                if ($usuarios->setTelefonoFijo($_POST['txtTelefonofijo'])) {
                                    if ($usuarios->setTelefonoCelular($_POST['txtTelefonomovil'])) {
                                        if (is_uploaded_file($_FILES['archivo_usuario']['tmp_name'])) {
                                            if ($usuarios->setFoto($_FILES['archivo_usuario'])) {
                                                if ($usuarios->setCorreo($_POST['txtCorreo'])) {
                                                    if ($usuarios->setNacimiento($_POST['txtFechaNacimiento'])) {
                                                        if (isset($_POST['cbGenero'])) {
                                                            if ($usuarios->setGenero($_POST['cbGenero'])) {
                                                                if ($usuarios->setDui($_POST['txtDUI'])) {
                                                                    if ($usuarios->setUsername($_POST['txtUsuario'])) {
                                                                        if ($usuarios->setContrasenia($usuarios->generatePassword())) {
                                                                            if ($usuarios->setDireccion($_POST['txtDireccion'])) {
                                                                                $usuarios->setIdEstadoUsuario(1);
                                                                                if ($usuarios->createRow()) {
                                                                                    $result['correo'] = $usuarios->getCorreo();
                                                                                    $result['username'] = $usuarios->getUsername();
                                                                                    $result['contrasenia'] = $usuarios->getContrasenia();
                                                                                    $result['status'] = 1;
                                                                                    if ($usuarios->saveFile($_FILES['archivo_usuario'], $usuarios->getRuta(), $usuarios->getFoto())) {
                                                                                        $result['message'] = 'Usuario registrado correctamente';
                                                                                        $usuarios->registerAction('Registrar', 'El usuario registró un registro en la tabla de usuarios.');
                                                                                    } else {
                                                                                        $result['message'] = 'Usuario registrado pero no se guardó la imagen';
                                                                                        $usuarios->registerAction('Registrar', 'El usuario registró un registro en la tabla de usuarios.');
                                                                                        
                                                                                    }
                                                                                    $data = $usuarios->readOneId();
                                                                                    $usuarios->setId($data['idusuario']);
                                                                                    $usuarios->registerActionOut('Cambio de clave','Se ha creado la clave');
                                                                                } else {
                                                                                    $result['exception'] = Database::getException();
                                                                                }
                                                                            } else {
                                                                                $result['exception'] = 'La dirección ingresada no es válida';
                                                                            }
                                                                        } else {
                                                                            $result['exception'] = 'Hubo un error al asignar la contraseña.';
                                                                        }
                                                                    } else {
                                                                        $result['exception'] = 'El username ingresado no es válido.';
                                                                    }
                                                                } else {
                                                                    $result['exception'] = 'El DUI ingresado no es válido.';
                                                                }
                                                            } else {
                                                                $result['exception'] = 'El género ingresado no es válido.';
                                                            }
                                                        } else {
                                                            $result['exception'] = 'Seleccione un género.';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'La fecha de nacimiento ingresada no es válida.';
                                                    }
                                                } else {
                                                    $result['exception'] = 'El correo ingresado no es válido.';
                                                }
                                            } else {
                                                $result['exception'] = 'La foto ingresada no es válida.';
                                            }
                                        } else {
                                            $result['exception'] =  'Selecciona una foto de perfil.';
                                        }
                                    } else {
                                        $result['exception'] = 'El teléfono celular ingresado no es válido.';
                                    }
                                } else {
                                    $result['exception'] = 'El teléfono fijo ingresado no es válido.';
                                }
                            } else {
                                $result['exception'] = 'El apellido ingresado no es válido.';
                            }
                        } else {
                            $result['exception'] = 'El nombre ingresado no es válido.';
                        }
                    } else {
                        $result['exception'] = 'Seleccione una opcion.';
                    }
                } else {
                    $result['exception'] = 'Seleccione una opcion.';
                }
                break;
            //Caso para enviar un correo
            case 'sendEmail':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setCorreo($_POST['txtCorreo'])){
                    if ($usuarios->setUsername($_POST['txtUsuario'])){
                        if ($usuarios->setContrasenia($_POST['txtContrasenia'])) {
                            try {
                            
                                //Ajustes del servidor
                                $mail->SMTPDebug = 0;                   
                                $mail->isSMTP();                                            
                                $mail->Host       = 'smtp.gmail.com';                     
                                $mail->SMTPAuth   = true;                                   
                                $mail->Username   = 'citigersystem@gmail.com';                     
                                $mail->Password   = 'citiger123';                               
                                $mail->SMTPSecure = 'tls';            
                                $mail->Port       = 587;     
                                $mail->CharSet = 'UTF-8';
                               
                            
                                //Receptores
                                $mail->setFrom('citigersystem@gmail.com', 'Citiger Support');
                                $mail->addAddress($usuarios->getCorreo());    
                            
                                //Contenido
                                $mail->isHTML(true);                                  
                                $mail->Subject = 'Bienvenido a Citiger '.$usuarios->getUsername();
                                $mail->Body    = 'Se ha creado un registro con tu cuenta de correo
                                                en Citiger. Para que puedas iniciar sesión tu contraseña es: <b>' . $usuarios->getContrasenia(). '</b>.';
                                $mail->AltBody = 'Tu contraseña es: ' . $usuarios->getContrasenia();
                            
                                if ($mail->send()) {
                                    $result['status'] = 1;
                                }
                            } catch (Exception $e) {
                                $result['exception'] = $mail->ErrorInfo;
                            }
                        } else {    
                            $result['exception'] = 'Hubo un error al setear la contraseña.';
                        }
                    } else {    
                        $result['exception'] = 'Hubo un error al setear nombre de usuario.';
                    }
                } else {    
                    $result['exception'] = 'Hubo un error al setear el correo.';
                }
                break;
            //Caso para leer todos los empleados
            case 'readEmployeeTypes':
                if ($result['dataset'] = $usuarios->readEmployeeTypes()) {
                    $result['status'] = 1;
                    $result['message'] = 'Se ha encontrado al menos un tipo.';
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen tipos registrados.';
                    }
                }
                break;
            case 'readAll': // METODO READ CARGAR TODOS LOS DATOS 
                if ($result['dataset'] = $usuarios->readAllSCRUD()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay usuarios registrados';
                    }
                }
                break;
            case 'search':
                $_POST = $usuarios->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $usuarios->searchRows($_POST['search'])) {
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
            case 'readOne':
                if ($usuarios->setId($_POST['txtId'])) {
                    if ($result['dataset'] = $usuarios->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Usuario inexistente';
                        }
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            case 'updateRow':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setId($_POST['txtId'])) {
                    if ($data = $usuarios->readOne()) {
                        if ($usuarios->setUsername($_POST['txtUsuario'])) {
                            if ($usuarios->setTelefonoFijo($_POST['txtTelefonofijo'])) {
                                if ($usuarios->setNombres($_POST['txtNombre'])) {
                                    if ($usuarios->setApellidos($_POST['txtApellido'])) {
                                        if ($usuarios->setTelefonoCelular($_POST['txtTelefonomovil'])) {
                                            if ($usuarios->setDui($_POST['txtDUI'])) {
                                                if (isset($_POST['cbGenero'])) {
                                                    if ($usuarios->setGenero($_POST['cbGenero'])) {
                                                        if ($usuarios->setDireccion($_POST['txtDireccion'])) {
                                                            if ($usuarios->setCorreo($_POST['txtCorreo'])) {
                                                                if ($usuarios->setNacimiento($_POST['txtFechaNacimiento'])) {
                                                                    if (isset($_POST['cbTipoEmpleado2'])) {
                                                                        if ($usuarios->setIdTipoUsuario($_POST['cbTipoEmpleado2'])) {
                                                                            if (is_uploaded_file($_FILES['archivo_usuario']['tmp_name'])) {
                                                                                if ($usuarios->setFoto($_FILES['archivo_usuario'])) {
                                                                                    if ($usuarios->updateRow($data['foto'])) {
                                                                                        $result['status'] = 1;
                                                                                        if ($usuarios->saveFile($_FILES['archivo_usuario'], $usuarios->getRuta(), $usuarios->getFoto())) {
                                                                                            $result['message'] = 'Usuario modificado correctamente';
                                                                                            $usuarios->registerAction('Actualizar', 'El usuario actualizó un registro con cambio de foto en la tabla de usuarios.');
                                                                                        } else {
                                                                                            $result['message'] = 'Usuario modificado pero no se guardó la imagen';
                                                                                        }
                                                                                    } else {
                                                                                        $result['exception'] = Database::getException();
                                                                                    }
                                                                                } else {
                                                                                    $result['exception'] = $usuarios->getImageError();
                                                                                }
                                                                            } else {
                                                                                if ($usuarios->updateRow($data['foto'])) {
                                                                                    $result['status'] = 1;
                                                                                    $result['message'] = 'Usuario modificado correctamente';
                                                                                    $usuarios->registerAction('Actualizar', 'El usuario actualizó un registro en la tabla de usuarios sin cambiar su fotografía.');
                                                                                } else {
                                                                                    $result['exception'] = Database::getException();
                                                                                }
                                                                            }
                                                                        } else {
                                                                            $result['exception'] = 'Tipo2 invalida';
                                                                        }
                                                                    } else {
                                                                        $result['exception'] = 'Tipo1 invalida';
                                                                    }
                                                                } else {
                                                                    $result['exception'] = 'Fecha invalida';
                                                                }
                                                            } else {
                                                                $result['exception'] = 'Correo invalido';
                                                            }
                                                        } else {
                                                            $result['exception'] = 'Direccion invalida';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Genero invalido2';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Genero invalido1';
                                                }
                                            } else {
                                                $result['exception'] = 'Nombre invalido';
                                            }
                                        } else {
                                            $result['exception'] = 'Telefono invalido';
                                        }
                                    } else {
                                        $result['exception'] = 'Apellido invalido';
                                    }
                                } else {
                                    $result['exception'] = 'Nombre invalido';
                                }
                            } else {
                            }
                        } else {
                        }
                    } else {
                        $result['exception'] = 'Usuario invalido';
                    }
                } else {
                    $result['exception'] = 'Telefono invalido';
                }
                break;
            case 'delete':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setId($_POST['txtId'])) {
                    if ($data = $usuarios->readOne()) {
                        if ($usuarios->deleteRow()) {
                            if ($usuarios->deleteFile($usuarios->getRuta(), $data['foto'])) {
                                $result['status'] = 1;
                                $result['message'] = 'Usuario eliminado correctamente';
                                $usuarios->registerAction('Eliminar','El usuario eliminó un registro en la tabla de usuarios.');

                            } else {
                                $result['exception'] = 'Se borró el registro pero no la imagen';
                            }
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Cliente no existente';
                    }
                } else {
                    $result['exception'] = 'Cliente seleccionado incorrecto';
                }
                break;
            case 'suspendRow':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setId($_POST['txtId'])) {
                    if ($usuarios->suspend()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha suspendido al usuario correctamente.';
                        $usuarios->registerAction('Suspender', 'El usuario suspendió un registro en la tabla de usuarios.');
                    } else {
                        $result['exception'] = Database::getException();
                    }
                } else {
                    $result['exception'] = 'ID incorrecto';
                }
                break;
            case 'filterByEmployeeType':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setIdTipoUsuario($_POST['idTipoEmpleado'])) {
                    if ($result['dataset'] = $usuarios->filterByEmployeeType()) {
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
                    $result['exception'] = 'Error id select';
                }
                break;
            //Caso para activar un registro
            case 'activateRow':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setId($_POST['txtId'])) {
                    if ($usuarios->activar()) {
                        $usuarios->registerAction('Activar', 'El usuario activó un registro en la tabla de usuarios.');
                        $result['status'] = 1;
                        $result['message'] = 'Se ha activado al usuario correctamente.';
                        //Se verifica si fue bloqueado por intentos fallidos
                        //de ser asi actualiza la información y reinicia los campos
                        if ($data = $usuarios->getIdBitacora('Bloqueo')) {
                            $usuarios->setIdBitacora($data['idbitacora']);
                            $usuarios->updateBitacoraOut('Bloqueo (Activado)'); 
                            $usuarios->increaseIntentos(0);   
                        }
                        
                    } else {
                        $result['exception'] = Database::getException();
                    }
                } else {
                    $result['exception'] = 'ID incorrecto';
                }
                break;
                //Caso de default del switch
            default:
                $result['exception'] = 'La acción no está disponible dentro de la sesión';
        }
    } else {
        print(json_encode('Recurso no disponible'));
    }
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}
