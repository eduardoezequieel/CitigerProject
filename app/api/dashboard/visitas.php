<?php
    require_once('../../helpers/database.php');
    require_once('../../helpers/validator.php');
    require_once('../../models/visitas.php');

    //Verificando si existe alguna acción
    if (isset($_GET['action'])) {
        //Se crea una sesion o se reanuda la actual
        session_start();
        //Instanciando clases
        $visita = new Visitas;
        //Array para respuesta de la API
        $result = array('status'=>0, 'error'=>0, 'message'=>null, 'exception'=>null);        
        //Verificando si hay una sesion iniciada
        if (isset($_SESSION['idusuario'])) {
            //Se compara la acción a realizar cuando la sesion está iniciada
            switch ($_GET['action']) {
                //Caso para leer todos los registros de la tabla
                case 'readAll':
                    if ($result['dataset'] = $visita->readAll()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha encontrado al menos una visita.';
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No existen visitas registradas.';
                        }
                    }
                    break;
                //Caso para cargar un registro en especifico
                case 'readOne':
                    $_POST = $visita -> validateForm($_POST);
                    if($visita->setIdVisita($_POST['idVisita'])){
                        if($result['dataset'] = $visita->readOne()){
                            $result['status'] = 1;
                        } else{
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'Visita inexistente';
                            }
                        }
                    } else{
                        $result['exception'] = 'Visita seleccionada incorrecta';
                    }
                    break;
                //Caso para cargar un registro en especifico
                case 'filterByVisitStatus':
                    $_POST = $visita -> validateForm($_POST);
                    if ($visita->setIdEstadoVisita($_POST['idEstadoVisita'])) {
                        if($result['dataset'] = $visita->filterByVisitStatus()){
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
                    }else{
                        $result['exception'] = 'Error id select';
                    }
                    break;
                
                //Caso para cargar información en los select
                case 'readVisitStatus':
                    if ($result['dataset'] = $visita->readVisitStatus()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha encontrado al menos un estado.';
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No existen estados registrados.';
                        }
                    }
                    break;

                //Caso para cargar información en los select
                case 'readResident':
                    if ($result['dataset'] = $visita->readResident()) {
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
                //Caso para suspender visita
                case 'suspendRow':
                    $_POST = $visita->validateForm($_POST);
                    if ($visita->setIdVisita($_POST['idVisita'])) {
                        if ($visita->suspend()) {
                            $result['status'] = 1;
                            $result['message'] = 'Se ha suspendido la visita correctamente.';
                            $visita->registerAction('Suspender','El usuario suspendio una visita.');
                        }else{
                            $result['exception'] = Database::getException();
                        }
                    }else{
                        $result['exception'] = 'ID incorrecto';
                    }
                    break;
                //Caso para activar visita
                case 'activateRow':
                    $_POST = $visita->validateForm($_POST);
                    if ($visita->setIdVisita($_POST['idVisita'])) {
                        if ($visita->activate()) {
                            $result['status'] = 1;
                            $result['message'] = 'Se ha activado la visita correctamente.';
                            $visita->registerAction('Activar','El usuario activo una visita.');

                        }else{
                            $result['exception'] = Database::getException();
                        }
                    }else{
                        $result['exception'] = 'ID incorrecto';
                    }
                    break;

                //Caso para crear registros en la tabla visitas
                case 'createRow':
                    $_POST = $visita->validateForm($_POST);
                    $visita->setIdEstadoVisita(4);
                     if(isset($_POST['cbResidente'])){
                        if($visita->setIdResidente($_POST['cbResidente'])){
                            if($visita->setFecha($_POST['txtFecha'])){
                                if(isset($_POST['cbVisitaR'])){
                                    if($visita->setVisitaR($_POST['cbVisitaR'])){
                                        if($visita->setObservacion($_POST['txtObservacion'])){
                                            if ($visita->createRow()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Visita registrada correctamente.';
                                                $visita->registerAction('Registrar','El usuario registro una visita.');
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                        } else{
                                            $result['exception'] = 'Onservacion invalido.';
                                        }
                                    } else{
                                        $result['exception'] = 'Visita Recurrente invalida.';
                                    }
                                } else{
                                    $result['exception'] = 'Visita Recurrente invalido.';
                                }
                            } else{
                                $result['exception'] = 'Fecha invalida.';
                            }
                        } else{
                            $result['exception'] = 'Residente invalido.';
                        }
                     } else{
                        $result['exception'] = 'Residente invalido.';
                     }
                    
                    break;
                //Actualizar datos
                case 'updateRow':
                    $_POST = $visita->validateForm($_POST);
                    if ($visita->setIdVisita($_POST['idVisita'])) {
                        if ($data = $visita->readOne()) {
                            if(isset($_POST['cbResidente'])){
                                if($visita->setIdResidente($_POST['cbResidente'])){
                                    if($visita->setFecha($_POST['txtFecha'])){
                                        if(isset($_POST['cbVisitaR'])){
                                            if($visita->setVisitaR($_POST['cbVisitaR'])){
                                                if($visita->setObservacion($_POST['txtObservacion'])){
                                                    if ($visita->updateRow()) {
                                                        $result['status'] = 1;
                                                        $result['message'] = 'Visita actualizada correctamente';
                                                    } else {
                                                        $result['exception'] = Database::getException();
                                                    } 
                                                } else{
                                                    $result['exception'] = 'Onservacion invalido.';
                                                }
                                            } else{
                                                $result['exception'] = 'Visita Recurrente invalida.';
                                            }
                                        } else{
                                            $result['exception'] = 'Visita Recurrente invalida.';
                                        }
                                    } else{
                                        $result['exception'] = 'Fecha invalida.';
                                    }
                                } else{
                                    $result['exception'] = 'Residente invalido.';
                                }
                             } else{
                                $result['exception'] = 'Residente invalido.';
                             }
                        }else{

                        }
                    }else{

                    }
                    break;
                //Caso para eliminar el registro
                case 'delete':
                    $_POST = $visita -> validateForm($_POST);
                    if ($visita -> setIdVisita($_POST['idVisita'])) {
                        if ($visita -> deleteRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Registro eliminado correctamente';
                        }else{
                            $result['exception'] = Database::getException();
                        }
                    }else{
                        $result['exception'] = 'Id invalido';
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