<?php
    require_once('../../helpers/database.php');
    require_once('../../helpers/validator.php');
    require_once('../../models/denuncias.php');

    //Verificando si existe alguna acción
    if (isset($_GET['action'])) {
        //Se crea una sesion o se reanuda la actual
        session_start();
        //Instanciando clases
        $denuncia = new Denuncias;
        //Array para respuesta de la API
        $result = array('status'=>0, 'error'=>0, 'message'=>null, 'exception'=>null);        
        //Verificando si hay una sesion iniciada
        if (isset($_SESSION['idusuario'])) {
            //Se compara la acción a realizar cuando la sesion está iniciada
            switch ($_GET['action']) {
                //Caso para leer todos los registros de la tabla
                case 'readStates':
                    if ($result['dataset'] = $denuncia->readStates()) {
                        $result['status'] = '1';
                        $result['message'] = 'Se han encontrado estados de denuncias.';
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No se han encontrado estados de denuncias.';
                        }
                    }
                    break;
                case 'readAll':
                    if ($result['dataset'] = $denuncia->readAll()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha encontrado al menos una denuncia.';
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No existen denuncias.';
                        }
                    }
                    break;
                case 'readAllByState':
                    $_POST = $denuncia -> validateForm($_POST);
                    if ($denuncia->setIdEstadoDenuncia($_POST['txtEstadoDenuncia'])) {
                        if ($result['dataset'] = $denuncia->readAllByState()) {
                            $result['status'] = 1;
                            $result['message'] = 'Se ha encontrado al menos una denuncia.';
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No existen denuncias.';
                            }
                        }
                    } else {
                        $result['exception'] = 'Id incorrecto';
                    }
                    break;
            //Caso para realizar busquedas
            case 'search':
                $_POST = $denuncia->validateForm($_POST);
                if($_POST['search'] != ''){
                    if($result['dataset'] = $denuncia->searchRows($_POST['search'])){
                        $result['status'] = 1;
                        $row = count($result['dataset']);
                        if($row > 0){
                            $result['message'] = 'Se han encontrado '.$row .' coincidencias';
                        } else{
                            $result['message'] = 'Se ha encontrado una coincidencia';
                        }
                    } else{
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
                case 'readOne':
                    $_POST = $denuncia -> validateForm($_POST);
                    if ($denuncia->setIdDenuncia($_POST['idDenuncia'])) {
                        if ($result['dataset'] = $denuncia->readOne()) {
                            $result['status'] = 1;
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'Denuncia inexistente';
                            }
                        }
                    } else {
                        $result['exception'] = 'Id incorrecto';
                    }
                    break;
                case 'getInfo':
                    $_POST = $denuncia -> validateForm($_POST);
                    if ($denuncia->setIdDenuncia($_POST['idDenuncia'])) {
                        if ($result['dataset'] = $denuncia->getInfo()) {
                            $result['status'] = 1;
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'id incorrecto';
                    }
                    break;
                case 'acceptComplaint':
                    $_POST = $denuncia -> validateForm($_POST);
                    if ($denuncia->setIdDenuncia($_POST['idDenuncia1'])) {
                        if ($denuncia->acceptComplaint()) {
                            $result['status'] = 1;
                            $result['message'] = 'Denuncia aceptada. Por favor asigne un empleado para solucionarla.';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Id incorrecto';
                    }
                    break;
                case 'rejectComplaint':
                    $_POST = $denuncia -> validateForm($_POST);
                    if ($denuncia->setIdDenuncia($_POST['idDenuncia1'])) {
                        if ($denuncia->rejectComplaint()) {
                            $result['status'] = 1;
                            $result['message'] = 'Denuncia rechazada correctamente.';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Id incorrecto';
                    }
                    break;
                case 'setEmployee':
                    $_POST = $denuncia -> validateForm($_POST);
                    if (isset($_POST['cbEmpleado'])) {
                        if ($denuncia->setIdEmpleado($_POST['cbEmpleado'])) {
                            if ($denuncia->setIdDenuncia($_POST['idDenuncia2'])) {
                                if ($denuncia->setEmployee()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Empleado asignado exitosamente. Puede monitorear la denuncia posteriormente filtrandola en la lista de registros.';
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                                
                            } else {
                                $result['exception'] = 'Id incorrecto2';
                            }
                            
                        } else {
                            $result['exception'] = 'Id incorrecto';
                        }
                        
                    } else {
                        $result['exception'] = 'Por favor seleccione un empleado.';
                    }
                    break;
                case 'revertChangesAfterAccepted':
                    $_POST = $denuncia -> validateForm($_POST);
                    if ($denuncia->setIdDenuncia($_POST['idDenuncia2'])) {
                        if ($denuncia->revertChanges()) {
                            $result['status'] = 1;
                            $result['message'] = 'Cambios revertidos con exito.';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Id incorrecto';
                    }
                    break;
                case 'finishComplaint':
                    $_POST = $denuncia -> validateForm($_POST);
                    if ($denuncia->setIdDenuncia($_POST['idDenuncia'])) {
                        if ($denuncia->setIdEmpleado($_POST['idEmpleado'])) {
                            if ($denuncia->finishComplaint()) {
                                $result['status'] = 1;
                                $result['message'] = 'Denuncia reportada como solucionada.';
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'id de empleado incorrecto';
                        }
                        
                    } else {
                        $result['exception'] = 'Id incorrecto';
                    }
                    break;
                case 'revertChangesAfterRejected':
                    $_POST = $denuncia -> validateForm($_POST);
                    if ($denuncia->setIdDenuncia($_POST['idDenuncia3'])) {
                        if ($denuncia->revertChanges()) {
                            $result['status'] = 1;
                            $result['message'] = 'Cambios revertidos con exito.';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Id incorrecto';
                    }
                    break;
                case 'readEmployeeTypes':
                    if ($result['dataset'] = $denuncia->readEmployeeTypes()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se han encontrado tipos de empleados.';
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No se han encontrado tipos de empleados';
                        }
                    }
                    break;
                case 'readEmployeeByTypes':
                    $_POST = $denuncia -> validateForm($_POST);
                    if ($result['dataset'] = $denuncia->readEmployeeByTypes($_POST['idTipoEmpleado'])) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = Database::getException();
                    }
                    break;
                case 'getAnswer':
                    $_POST = $denuncia -> validateForm($_POST);
                    if ($denuncia->setIdDenuncia($_POST['idDenuncia3'])) {
                        if ($result['dataset'] = $denuncia->getAnswer()) {
                            $result['status'] = 1;
                            $result['message'] = 'Respuesta obtenida exitosamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                        
                    } else {
                        $result['exception'] = 'id incorrecto';
                    }
                    break;
                case 'insertAnswerAfterRejected':
                    $_POST = $denuncia -> validateForm($_POST);
                    if ($denuncia->setRespuesta($_POST['txtRespuesta'])) {
                        if ($denuncia->setIdDenuncia($_POST['idDenuncia3'])) {
                            if ($denuncia->insertAnswer()) {
                                $result['status'] = 1;
                                $result['message'] = 'Respuesta enviada correctamente.';
                            } else {
                                $result['exception'] = Database::getException();
                            }
                            
                        } else {
                            $result['exception'] = 'id incorrecto.';
                        }
                        
                    } else {
                        $result['exception'] = 'Respuesta incorrecta.';
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
?>