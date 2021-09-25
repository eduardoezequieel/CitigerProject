<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/usuarios.php');
require_once('../../helpers/mail.php');



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
    $correo = new Correo;
    //Array para respuesta de la API
    $result = array('status' => 0, 
                    'recaptcha' => 0, 
                    'error' => 0,
                    'auth' => 0, 
                    'message' => null, 
                    'exception' => null);
    //Verificando si hay una sesion iniciada
    if (isset($_SESSION['idusuario_dashboard'])) {
        //Se compara la acción a realizar cuando la sesion está iniciada
        switch ($_GET['action']) {
            //Obtener el modo de autenticación de un usuario
            case 'getAuthMode':
                if ($usuarios->setId($_SESSION['idusuario_dashboard'])) {
                    if ($result['dataset'] = $usuarios->getAuthMode()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Este usuario no tiene ninguna preferencia.';
                        }
                    }
                } else {
                    $result['exception'] = 'Id incorrecto.';
                }
                
                break;
            //Caso para actualizar la preferencia del modo de autenticacion del usuario
            case 'updateAuthMode':
                if ($usuarios->setId($_SESSION['idusuario_dashboard'])) {
                    if ($usuarios->checkPassword($_POST['txtContrasenaActualAuth'])) {
                        if ($_POST['switchValue'] == 'Si' || $_POST['switchValue'] == 'No') {
                            if ($usuarios->updateAuthMode($_POST['switchValue'])) {
                                $result['status'] = 1;
                                $result['message'] = 'Exito.';
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Valor incorrecto.';
                        }
                    } else {
                        $result['exception'] = 'Contraseña incorrecta.';
                    }
                } else {
                    $result['exception'] = 'Sesión invalida.';
                }
                
                break;
            //Crear nuevo tipo de usuario y asignar permisos
            case 'createType':
                $_POST = $usuarios->validateForm($_POST);
                //Validamos que la contraseña sea correcta
                if ($usuarios->setId($_SESSION['idusuario_dashboard'])) {
                    if ($usuarios->checkPassword($_POST['txtContrasenaActual'])) {
                        //Validamos que el tipo de usuario ingresado cumpla con que sea alfabetico.
                        if ($usuarios->setTipoUsuario($_POST['txtTipoUsuario'])) {
                            //Creamos el tipo de usuario
                            if ($usuarios->addType()) {
                                //Guardamos la información del tipo de usuario
                                if ($data = $usuarios->getType($_POST['txtTipoUsuario'])) {
                                    //Seteamos a la variable idTipoUsuario el id obtenido anteriormente.
                                    if ($usuarios->setIdTipoUsuario($data['idtipousuario'])) {
                                        //Creamos los permisos del usuario por defecto (Todos en 'No')
                                        if ($usuarios->createPermissions()) {
                                            //Guardamos en un arreglo los seleccionados por el usuario
                                            $array = array($_POST['alquileresValue'],
                                                    $_POST['aportacionesValue'],
                                                    $_POST['denunciaValue'],
                                                    $_POST['materialesValue'],
                                                    $_POST['usuariosValue'],
                                                    $_POST['visitasValue']);
                                            $permissions = array(1,2,3,4,5,6);
                                            //Mandamos el arreglo a la funcion que se encarga de ingresar los datos
                                            if ($usuarios->updatePermission($array, $permissions)) {
                                                $result['status'] = 1;
                                                $result['dataset'] = $array;
                                                $result['dataset2'] = $permissions;
                                                $result['message'] = 'Tipo de usuario creado correctamente.';
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                        } else {
                                            $result['exception'] = Database::getException();
                                        }
                                    } else {
                                        $result['exception'] = 'Tipo de usuario invalido.';
                                    }
                                } else {
                                    if (Database::getException()) {
                                        $result['exception'] = Database::getException();
                                    } else {
                                        $result['exception'] = 'No hay ninguna coincidencia con el ingresado.';
                                    }
                                }
                            } else {
                                $result['exception'] = Database::getException();
                            } 
                        } else {
                            $result['exception'] = 'Nombre para el tipo de usuario invalido.';
                        }
                    } else {
                        $result['exception'] = 'Contraseña incorrecta.';
                    }
                } else {
                    $result['exception'] = 'Id incorrecto.';
                }
                
                break;
            //Caso para actualizar tipo de usuario y sus permisos
            case 'updateType':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setId($_SESSION['idusuario_dashboard'])) {
                    if ($usuarios->checkPassword($_POST['txtContrasenaActual'])) {
                        if ($usuarios->setIdTipoUsuario($_POST['idTipoUsuario'])) {
                            if ($usuarios->setTipoUsuario($_POST['txtTipoUsuario'])) {
                                if ($usuarios->updateType()) {
                                    //Guardamos en un arreglo los seleccionados por el usuario
                                    $array = array($_POST['alquileresValue'],
                                    $_POST['aportacionesValue'],
                                    $_POST['denunciaValue'],
                                    $_POST['materialesValue'],
                                    $_POST['usuariosValue'],
                                    $_POST['visitasValue']);
                                    $permissions = array(1,2,3,4,5,6);
                                    //Mandamos el arreglo a la funcion que se encarga de ingresar los datos
                                    if ($usuarios->updatePermission($array, $permissions)) {
                                        $result['status'] = 1;
                                        $result['dataset'] = $array;
                                        $result['dataset2'] = $permissions;
                                        $result['message'] = 'Permisos actualizados correctamente.';
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            } else {
                                $result['exception'] = 'Nombre para el tipo de usuario invalido..';
                            }
                        } else {
                            $result['exception'] = 'Id incorrecto.';
                        }
                    } else {
                        $result['exception'] = 'Contraseña incorrecta.';
                    }
                } else {
                    $result['exception'] = 'Id incorrecto.';
                }
                
                break;
            //Caso para eliminar un tipo de usuario y sus permisos
            case 'deleteType':
                if ($usuarios->setIdTipoUsuario($_POST['idTipoUsuario'])) {
                    if ($usuarios->deletePermissions()) {
                        if ($usuarios->deleteType()) {
                            $result['status'] = 1;
                            $result['message'] = 'Tipo de usuario eliminado correctamente.';
                        } else {
                            $result['exception'] = Database::getException();
                            $usuarios->createPermissions();
                        }
                    } else {
                        $result['exception'] = Database::getException();
                    }
                } else {
                    $result['exception'] = 'Dato incorrecto.';
                }
                break;
            //Caso para obtener todos los tipos de usuario
            case 'readTypesOfUser':
                if ($result['dataset'] = $usuarios->readTypesOfUser()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay tipos de usuario.';
                    }
                }
                break;
            //Caso para obtener los permisos de un usuario
            case 'getPermissionsOfAType':
                if ($usuarios->setIdTipoUsuario($_POST['idTipoUsuario'])) {
                    if ($result['dataset'] = $usuarios->getPermissionsOfAType()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Este tipo de usuario no posee permisos.';
                        }
                    }
                } else {
                    $result['exception'] = 'Id invalido.';
                }
             
                break;
            //Realizar busquedas de tipos de usuario
            case 'searchTypesOfUser':
                $_POST = $usuarios->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $usuarios->searchTypesOfUser($_POST['search'])) {
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
                unset($_SESSION['idusuario_dashboard']);
                $result['status'] = 1;
                $result['message'] = 'Sesión eliminada correctamente';
                break;
            //Redirige al dashboard
            case 'validateSession':
                $result['status'] = 1;
                $result['message'] = 'Posee una sesión activa.';
                break;
            //Caso para setear light mode
            case 'setLightMode':
                if ($usuarios->setId($_SESSION['idusuario_dashboard'])) {
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
            //Caso para setear dark mode
            case 'setDarkMode':
                if ($usuarios->setId($_SESSION['idusuario_dashboard'])) {
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
            //Caso para leer la información de un usuario
            case 'readProfile2':
                if ($usuarios->setId($_SESSION['idusuario_dashboard'])) {
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
            //Caso para editar el perfil de un usuario
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
                                                if ($usuarios->setId($_SESSION['idusuario_dashboard'])) {
                                                    if ($usuarios->updateInfo()) {
                                                        $result['status'] = 1;
                                                        $result['message'] = 'Perfil modificado correctamente';
                                                    } else {
                                                        $result['exception'] = Database::getException();
                                                    }
                                                } else {
                                                    $result['exception'] = 'Id incorrecto';
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
            //Caso para actualizar la foto
            case 'updateFoto':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setId($_SESSION['idusuario_dashboard'])) {
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
                        $result['exception'] = $usuarios->getImageError();
                    }
                } else {
                    $result['exception'] = 'Id incorrecto';
                }
                
                break;
            //Caso para actualizar la contraseña (Dentro del sistema)
            case 'updatePassword':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setId($_SESSION['idusuario_dashboard'])) {
                    if ($usuarios->checkPassword($_POST['txtContrasenaActual'])) {
                        if ($_POST['txtNuevaContrasena'] == $_POST['txtConfirmarContrasena']) {
                            if ($_POST['txtNuevaContrasena'] != $_POST['txtContrasenaActual'] ||
                                $_POST['txtConfirmarContrasena'] != $_POST['txtContrasenaActual']) {
                                if ($usuarios->setContrasenia($_POST['txtNuevaContrasena'])) {
                                    if ($usuarios->changePassword()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Contraseña actualizada correctamente.';
                                        $data = $usuarios->getIdBitacora('Cambio de clave');
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
            //Caso para verificar los permisos permitidos del usuario logueado
            case 'checkUserLoggedPermissions':
                if ($result['dataset'] = $usuarios->checkUserLoggedPermissions()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = $_SESSION['idusuario_dashboard'];
                }
                break;
            //Caso para verificar los permisos permitidos del usuario logueado
            case 'checkPermissionsPerPage':
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setPermiso($_POST['txtPagina'])) {
                    if ($usuarios->checkPermissionsPerPage()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'El usuario no tiene los permisos necesarios para acceder.';
                    }
                    break;
                } else {
                    $result['exception'] = 'Hubo un error al describir el permiso';
                }
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
                    if ($usuarios->checkUserType(2)) {
                        if ($usuarios->checkEstado()) {
                            if ($usuarios->checkPassword($_POST['txtContrasenia'])) {  
                                $_SESSION['idusuario_dashboard'] = $usuarios->getId();
                                $_SESSION['usuario_dashboard'] = $usuarios->getUsername();
                                $_SESSION['foto_dashboard'] = $usuarios->getFoto();
                                $_SESSION['tipousuario_dashboard'] = $usuarios->getIdTipoUsuario();
                                $_SESSION['modo_dashboard'] = $usuarios->getModo();
                                $_SESSION['correo_dashboard'] = $usuarios->getCorreo();
                                //Se reinicia el conteo de intentos fallidos
                                if ($usuarios->increaseIntentos(0)){
                                    if ($result['dataset'] = $usuarios->checkLastPasswordUpdate()) {
                                        $result['error'] = 1;
                                        $result['message'] = 'Se ha detectado que debes actualizar
                                                                tu contraseña por seguridad.';
                                        $_SESSION['idusuario_dashboard_tmp'] = $_SESSION['idusuario_dashboard'];
                                        unset($_SESSION['idusuario_dashboard']);
                                    } else {
                                        if ($autenticacion = $usuarios->getAuthMode()) {
                                            if ($autenticacion['autenticacion'] == 'Si') {
                                                $result['auth'] = 1;
                                                $result['status'] = 1;
                                                $_SESSION['idusuario_temp'] = $usuarios->getId();
                                                unset($_SESSION['idusuario_dashboard']);
                                            } else {
                                                $result['status'] = 1;
                                                $result['message'] = 'Sesión iniciada correctamente.';
                                            }
                                            
                                        } else {
                                            if (Database::getException()) {
                                                $result['exception'] = Database::getException();
                                            } else {
                                                $result['exception'] = 'El usuario no posee ninguna preferencia.';
                                            }
                                            
                                        }
                                        
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
                        $result['exception'] = 'El usuario no tiene los permisos necesarios para acceder.';
                    }
                } else {
                    $result['exception'] = 'El correo ingresado es incorrecto.';
                }
                
                break;
            case 'sendVerificationCode':
                // Generamos el codigo de seguridad 
                $code = rand(999999, 111111);
                if ($correo->setCorreo($_SESSION['correo_dashboard'])) {
                    // Ejecutamos funcion para obtener el usuario del correo ingresado\
                    $correo->obtenerUsuario($_SESSION['correo_dashboard']);

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
                        $mail->CharSet    = 'UTF-8';


                        //Receptores
                        $mail->setFrom('citigersystem@gmail.com', 'Citiger Support');
                        $mail->addAddress($correo->getCorreo());

                        //Contenido
                        $mail->isHTML(true);
                        $mail->Subject = 'Código de Verificación';
                        $mail->Body    = 'Hola ' . $_SESSION['usuario'] . ', tu código de seguridad para el factor de doble autenticación es: <b>' . $code . '</b>';

                        if ($mail->send()) {
                            $result['status'] = 1;
                            $result['message'] = 'Código enviado correctamente, ' . $_SESSION['usuario'] . ' ';
                            $correo->actualizarCodigo('usuario', $code);
                        }
                    } catch (Exception $e) {
                        $result['exception'] = $mail->ErrorInfo;
                    }
                } else {
                    $result['exception'] = 'Correo incorrecto';
                }

                break;
            //Caso para verificar el código con el factor de autenticación en dos pasos.
            case 'verifyCodeAuth':
                $_POST = $usuarios->validateForm($_POST);
                // Validmos el formato del mensaje que se enviara en el correo
                if ($correo->setCodigo($_POST['codigoAuth'])) {
                    // Ejecutamos la funcion para validar el codigo de seguridad
                    if ($correo->validarCodigo('usuario',$_SESSION['idusuario_temp'])) {
                        $_SESSION['idusuario_dashboard'] = $_SESSION['idusuario_temp'];
                        unset($_SESSION['idusuario_temp']);
                        $result['status'] = 1;
                        $correo->cleanCode($_SESSION['idusuario_dashboard']);
                        // Colocamos el mensaje de exito 
                        $result['message'] = 'Sesión iniciada correctamente.';
                    } else {
                        // En caso que el correo no se envie mostramos el error
                        $result['exception'] = 'El código ingresado no es correcto.';
                    }
                } else {
                    $result['exception'] = 'Mensaje incorrecto';
                }
                break;
            //Caso para registrar el primer usuario del sistema
            case 'register':
                $_POST = $usuarios->validateForm($_POST);
                if (isset($_SESSION['idusuario_dashboard'])) {
                    $result['exception'] = 'Ya existen usuarios agregados en la base.';
                } else {
                    if ($usuarios->setNombres($_POST['txtNombre'])) {
                        if ($usuarios->setApellidos($_POST['txtApellido'])) {
                            if ($usuarios->setTelefonoFijo($_POST['txtFijo'])) {
                                if ($usuarios->setTelefonoCelular($_POST['txtCelular'])) {
                                    if (is_uploaded_file($_FILES['archivo_usuario']['tmp_name'])) {
                                        if ($usuarios->setFoto($_FILES['archivo_usuario'])) {
                                            if ($_POST['txtCorreo'] == $_POST['txtCorreoConfirmar']) {
                                                if ($usuarios->setCorreo($_POST['txtCorreo'])) {
                                                    if ($usuarios->setNacimiento($_POST['txtNacimiento'])) {
                                                        if (isset($_POST['txtGenero'])) {
                                                            if ($usuarios->setGenero($_POST['txtGenero'])) {
                                                                if ($usuarios->setDui($_POST['txtDui'])) {
                                                                    if ($usuarios->setUsername($_POST['txtUsuario'])) {
                                                                        if ($_POST['txtContrasenia'] == $_POST['txtContraseniaConfirmar']) {
                                                                            if ($usuarios->setContrasenia($_POST['txtContrasenia'])) {
                                                                                if ($usuarios->setDireccion($_POST['txtDireccion'])) {
                                                                                    $usuarios->setIdEstadoUsuario(1);
                                                                                    $usuarios->setIdTipoUsuario(1);
                                                                                    if ($usuarios->createRow()) {
                                                                                        $result['status'] = 1;
                                                                                        if ($usuarios->saveFile($_FILES['archivo_usuario'], $usuarios->getRuta(), $usuarios->getFoto())) {
                                                                                            $result['message'] = 'Primer usuario registrado correctamente';
                                                                                        } else {
                                                                                            $result['message'] = 'Primer usuario registrado pero no se guardó la imagen';
                                                                                        }
                                                                                        $data = $usuarios->readOneId();
                                                                                        $usuarios->setId($data['idusuario']);
                                                                                        $usuarios->registerActionOut('Cambio de clave','Se ha creado la clave');
                                                                                    } else {
                                                                                        $result['exception'] = Database::getException();;
                                                                                    }
                                                                                } else {
                                                                                    $result['exception'] = 'La dirección ingresada no es válida';
                                                                                }
                                                                            } else {
                                                                                $result['exception'] = 'La contraseña ingresado no es válida';
                                                                            }
                                                                        } else {
                                                                            $result['exception'] = 'Las contraseñas no coinciden.';
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
                                                $result['exception'] = 'Los correos no coinciden.';
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
                if ($usuarios->setId($_POST['txtId'])) {
                    if ($usuarios->setIdBitacora($_POST['txtBitacora'])){
                        if ($usuarios->activar()) {
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
                if ($usuarios->setId($_SESSION['idusuario_dashboard_tmp'])) {
                    if ($usuarios->checkPassword($_POST['txtContrasenaActual1'])) {
                        if ($_POST['txtNuevaContrasena1'] == $_POST['txtConfirmarContrasena1']) {
                            if ($_POST['txtNuevaContrasena1'] != $_POST['txtContrasenaActual1'] ||
                                $_POST['txtConfirmarContrasena1'] != $_POST['txtContrasenaActual1']) {
                                if ($usuarios->setContrasenia($_POST['txtNuevaContrasena1'])) {
                                    if ($usuarios->changePassword()) {
                                        $usuarios->setIdBitacora($_POST['txtBitacoraPassword']);
                                        if ($usuarios->updateBitacoraOut('Cambio de clave')) {
                                            $result['status'] = 1;
                                            $result['message'] = 'Contraseña actualizada correctamente.';
                                            $_SESSION['idusuario_dashboard'] =$_SESSION['idusuario_dashboard_tmp'];
                                            unset($_SESSION['idusuario_dashboard_tmp']);
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
            //Caso para enviar un email
            case 'sendMail':
                $_POST = $usuarios->validateForm($_POST);
                // Generamos el codigo de seguridad 
                $code = rand(999999, 111111);
                if ($correo->setCorreo($_POST['txtCorreoRecu'])) {
                    if ($correo->validarCorreo('usuario')) {

                        // Ejecutamos funcion para obtener el usuario del correo ingresado\
                        $_SESSION['mail'] = $correo->getCorreo();

                        $correo->obtenerUsuario($_SESSION['mail']);


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
                            $mail->addAddress($correo->getCorreo());

                            //Contenido
                            $mail->isHTML(true);
                            $mail->Subject = 'Recuperación de contraseña';
                            $mail->Body    = 'Hola ' . $_SESSION['usuario'] . ', hemos enviado este correo para que recuperes tu contraseña, tu código de seguridad es: <b>' . $code . '</b>';

                            if ($mail->send()) {
                                $result['status'] = 1;
                                $result['message'] = 'Código enviado correctamente, ' . $_SESSION['usuario'] . ' ';
                                $correo->actualizarCodigo('usuario', $code);
                            }
                        } catch (Exception $e) {
                            $result['exception'] = $mail->ErrorInfo;
                        }
                    } else {

                        $result['exception'] = 'El correo ingresado no está registrado';
                    }
                } else {

                    $result['exception'] = 'Correo incorrecto';
                }



                break;
            //Caso para verificar el codigo enviado al correo
            case 'verifyCode':
                $_POST = $usuarios->validateForm($_POST);
                // Validmos el formato del mensaje que se enviara en el correo
                if ($correo->setCodigo($_POST['codigo'])) {
                    // Ejecutamos la funcion para validar el codigo de seguridad
                    if ($correo->validarCodigo('usuario',$_SESSION['idusuario'])) {
                        $result['status'] = 1;
                        // Colocamos el mensaje de exito 
                        $result['message'] = 'El código ingresado es correcto';
                    } else {
                        // En caso que el correo no se envie mostramos el error
                        $result['exception'] = 'El código ingresado no es correcto';
                    }
                } else {
                    $result['exception'] = 'Mensaje incorrecto';
                }
                break;
            //Caso para cambiar la contraseña
            case 'changePass':
                // Obtenemos el form con los inputs para obtener los datos
                $_POST = $usuarios->validateForm($_POST);
                if ($usuarios->setId($_SESSION['idusuario'])) {
                    if ($usuarios->setContrasenia($_POST['txtContrasenia2'])) {
                        // Ejecutamos la funcion para actualizar al usuario
                        if ($usuarios->changePassword()) {
                            $result['status'] = 1;
                            $result['message'] = 'Clave actualizada correctamente';
                            $correo->cleanCode($_SESSION['idusuario']);
                            unset($_SESSION['idusuario']);
                            unset($_SESSION['mail']);
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = $usuarios->getPasswordError();
                    }
                } else {
                    $result['exception'] = 'Correo incorrecto';
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
