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
        $result= array('status'=>0, 'recaptcha' => 0,'error'=>0, 'message'=>null,'exception'=> null);
        //Verificando si hay una sesion iniciada
        if (isset($_SESSION['idusuario'])) {
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
                        if ($usuarios->checkEstado()) {
                            if ($usuarios->checkPassword($_POST['txtContrasenia'])) {
                                $result['status'] = 1;
                                $result['message'] = 'Sesión iniciada correctamente.';
                            } else {
                                $result['exception'] = 'La contraseña ingresada es incorrecta.';
                            }
                        } else {
                            $result['exception'] = 'El usuario está inactivo. Contacte con el administrador.';
                        }
                    } else {
                        $result['exception'] = 'El correo ingresado es incorrecto.';
                    }
                    break;
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