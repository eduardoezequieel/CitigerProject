<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/aportaciones.php');

if (isset($_GET['action'])) {
    //Reanudando la sesion
    session_start();

    //Objeto para instanciar la clase
    $aportaciones = new Aportaciones();

    //Arreglo para guardar respuestas de la API
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);

    //Acciones a ejecutar permitidas con la sesion iniciada
    if (isset($_SESSION['idusuario_dashboard'])) {
        switch ($_GET['action']) {
            //Caso para verificar si una casa posee un residente asignado
            case 'readResidentHouse':
                if ($aportaciones->setIdCasa($_POST['txtIdx'])) {
                    if ($result['dataset'] = $aportaciones->readResidentHouse()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Esta casa no tiene ningún residente asignado.';
                        }
                    }
                } else {
                    $result['exception'] = 'id incorrecto.';
                }
                
                
                break;
            case 'readAll':
                if ($result['dataset'] = $aportaciones->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['error'] = 1;
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No se han encontrado registros de casas.';
                    }
                }
                break;
            case 'readAnio':
                if ($result['dataset'] = $aportaciones->readAnio()) {
                    $result['status'] = 1;
                    $result['message'] = 'Se ha encontrado al menos un año.';
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen años.';
                    }
                }
                break;

            case 'readOne':
                $_POST = $aportaciones->validateForm($_POST);
                if ($aportaciones->setIdCasa($_POST['txtId'])) {
                    if ($result['dataset'] = $aportaciones->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Marca inexistente';
                        }
                    }
                } else {
                    $result['exception'] = 'Marca seleccionada incorrecta';
                }
                break;
            case 'readAportacion':
                $_POST = $aportaciones->validateForm($_POST);
                if ($aportaciones->setIdCasa($_POST['txtIdx'])) {
                    if ($result['dataset'] = $aportaciones->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Aportacion inexistente';
                        }
                    }
                } else {
                    $result['exception'] = 'Casa incorrecta';
                }
                break;
            case 'readAportacion2':
                $_POST = $aportaciones->validateForm($_POST);
                if ($aportaciones->setIdCasa($_POST['Casa'])) {
                    if ($result['dataset'] = $aportaciones->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Aportacion inexistente';
                        }
                    }
                } else {
                    $result['exception'] = 'Casa incorrecta';
                }
                break;

            case 'createRow':
                $_POST = $aportaciones->validateForm($_POST);
                if ($aportaciones->setNumeroCasa($_POST['txtNum'])) {
                    if ($aportaciones->setDireccion($_POST['txtUbicacion'])) {
                        if ($aportaciones->createRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Casa registrada correctamente.';
                            $aportaciones->registerAction('Registrar', 'El usuario agregó  un registro en la tabla de casas.');
                        } else {
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Direccion inválida.';
                    }
                } else {
                    $result['exception'] = 'Número inválido.';
                }
                break;

            case 'updateRow':
                $_POST = $aportaciones->validateForm($_POST);
                if ($aportaciones->setIdCasa($_POST['txtId'])) {
                    if ($aportaciones->readOne()) {
                        if ($aportaciones->setNumeroCasa($_POST['txtNum'])) {
                            if ($aportaciones->setDireccion($_POST['txtUbicacion'])) {
                                if ($aportaciones->updateRow()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Se ha actualizado la casa correctamente.';
                                    $aportaciones->registerAction('Actualizar', 'El usuario actualizó un registro en la tabla de casas.');
                                } else {
                                    if (Database::getException()) {
                                        $result['exception'] = Database::getException();
                                    } else {
                                        $result['exception'] = 'No se ha actualizado la casa';
                                    }
                                }
                            } else {
                                $result['exception'] = 'Dirección incorrecta.';
                            }
                        } else {
                            $result['exception'] = 'Número incorrecto.';
                        }
                    } else {
                        $result['exception'] = 'Marca seleccionado incorrecto';
                    }
                } else {
                    $result['exception'] = 'Casa seleccionada incorrecta';
                }
                break;

            case 'delete':
                $_POST = $aportaciones->validateForm($_POST);
                if ($aportaciones->setIdCasa($_POST['txtId'])) {
                    if ($aportaciones->deleteRow()) {
                        $result['status'] = 1;
                        $result['message'] = 'Registro eliminado correctamente';
                        $aportaciones->registerAction('Eliminar', 'El usuario eliminó un registro en la tabla de casas.');
                    } else {
                        $result['exception'] = Database::getException();
                    }
                } else {
                    $result['exception'] = 'Id invalido';
                }
                break;
            case 'search':
                $_POST = $aportaciones->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $aportaciones->searchRows($_POST['search'])) {
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
            case 'activateRow':
                $_POST = $aportaciones->validateForm($_POST);
                if ($aportaciones->setIdCasa($_POST['txtId'])) {
                    if ($aportaciones->activar()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha activado el registro correctamente.';
                        $aportaciones->registerAction('Activar', 'El usuario activó un registro en la tabla de casas.');
                    } else {
                        $result['exception'] = Database::getException();
                    }
                } else {
                    $result['exception'] = 'ID incorrecto';
                }
                break;

            case 'suspendRow':
                $_POST = $aportaciones->validateForm($_POST);
                if ($aportaciones->setIdCasa($_POST['txtId'])) {
                    if ($aportaciones->suspend()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha suspendido el registro correctamente.';
                        $aportaciones->registerAction('Suspender', 'El usuario suspendió un registro en la tabla de casas.');
                    } else {
                        $result['exception'] = Database::getException();
                    }
                } else {
                    $result['exception'] = 'ID incorrecto';
                }
                break;

            case 'readEmployeeTypes':
                if ($result['dataset'] = $aportaciones->readEstados()) {
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

            case 'filterByEmployeeType':
                $_POST = $aportaciones->validateForm($_POST);
                if ($aportaciones->setIdEstadoCasa($_POST['idTipoEmpleado'])) {
                    if ($result['dataset'] = $aportaciones->filterByEmployeeType()) {
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

            case 'readAllParam': // METODO BUSQUEDA FILTRADA
                $_POST = $aportaciones->validateForm($_POST);
                if ($result['dataset'] = $aportaciones->readAllParam($_POST['txtIdx'])) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $_POST = $aportaciones->validateForm($_POST);
                        if ($aportaciones->setIdCasa($_POST['txtIdx'])) {
                            if ($aportaciones->crearAportacion()) {
                                $result['status'] = 1;
                                $result['message'] = 'Se han agregado las aportaciones';
                            } else {
                                $result['error'] = 1;
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Id inválido.';
                        }
                    }
                }
                break;

            case 'cancelarAportacion':
                $_POST = $aportaciones->validateForm($_POST);
                if ($aportaciones->setIdAportacion($_POST['txtIdAportacion'])) {
                    if ($aportaciones->cancelarAportacion()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha cancelado la aportación.';
                    } else {
                        $result['exception'] = Database::getException();
                    }
                } else {
                    $result['exception'] = 'ID incorrecto';
                }
                break;

            case 'AportacionPendiente':
                $_POST = $aportaciones->validateForm($_POST);
                if ($aportaciones->setIdAportacion($_POST['txtIdAportacion'])) {
                    if ($aportaciones->aportacionPendiente()) {
                        $result['status'] = 1;
                        $result['message'] = 'La aportación se ha establecido como pendiente';
                    } else {
                        $result['exception'] = Database::getException();
                    }
                } else {
                    $result['exception'] = 'ID incorrecto';
                }
                break;

            case 'filtrarAportacion': // METODO BUSQUEDA FILTRADA
                $_POST = $aportaciones->validateForm($_POST);
                if ($result['dataset'] = $aportaciones->filtrarAportacion($_POST['txtId2'], $_POST['anio'])) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                    }
                }
                break;

            case 'agregarAportacion2022':

                $_POST = $aportaciones->validateForm($_POST);
                if ($_POST['anio2'] == '') {
                    $result['exception'] = 'Seleccione un año';
                } else {

                    if ($aportaciones->verificarAportacion($_POST['Casa'], $_POST['anio2'])) {
                        $result['exception'] = 'Ya se han agregado aportaciones con este año o no han sido canceladas';
                    } else {

                        $_POST = $aportaciones->validateForm($_POST);
                        if ($aportaciones->setIdCasa($_POST['Casa'])) {
                            if ($aportaciones->crearAportacion2022()) {
                                $result['status'] = 1;
                                $result['message'] = 'Se han agregado las aportaciones';
                            } else {
                                $result['error'] = 1;
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Id inválido.';
                        }
                    }
                }


                break;
            case 'agregarAportacion2023':
                $_POST = $aportaciones->validateForm($_POST);
                if ($_POST['anio2'] == '') {
                    $result['exception'] = 'Seleccione un año';
                } else {

                    if ($aportaciones->verificarAportacion($_POST['Casa'], $_POST['anio2'])) {
                        $result['exception'] = 'Ya se han agregado aportaciones con este año o no han sido canceladas';
                    } else {

                        $_POST = $aportaciones->validateForm($_POST);
                        if ($aportaciones->setIdCasa($_POST['Casa'])) {
                            if ($aportaciones->crearAportacion2023()) {
                                $result['status'] = 1;
                                $result['message'] = 'Se han agregado las aportaciones';
                            } else {
                                $result['error'] = 1;
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Id inválido.';
                        }
                    }
                }

                break;
            case 'agregarAportacion2024':
                $_POST = $aportaciones->validateForm($_POST);
                if ($_POST['anio2'] == '') {
                    $result['exception'] = 'Seleccione un año';
                } else {

                    if ($aportaciones->verificarAportacion($_POST['Casa'], $_POST['anio2'])) {
                        $result['exception'] = 'Ya se han agregado aportaciones con este año o no han sido canceladas';
                    } else {


                        $_POST = $aportaciones->validateForm($_POST);
                        if ($aportaciones->setIdCasa($_POST['Casa'])) {
                            if ($aportaciones->crearAportacion2024()) {
                                $result['status'] = 1;
                                $result['message'] = 'Ya se han agregado aportaciones con este año o no han sido canceladas';
                            } else {
                                $result['error'] = 1;
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Id inválido.';
                        }
                    }
                }
                break;
            case 'agregarAportacion2025':
                $_POST = $aportaciones->validateForm($_POST);
                if ($_POST['anio2'] == '') {
                    $result['exception'] = 'Seleccione un año';
                } else {

                    if ($aportaciones->verificarAportacion($_POST['Casa'], $_POST['anio2'])) {
                        $result['exception'] = 'Ya se han agregado aportaciones con este año o no han sido canceladas';
                    } else {

                        $_POST = $aportaciones->validateForm($_POST);
                        if ($aportaciones->setIdCasa($_POST['Casa'])) {
                            if ($aportaciones->crearAportacion2025()) {
                                $result['status'] = 1;
                                $result['message'] = 'Se han agregado las aportaciones correctamente';
                            } else {
                                $result['error'] = 1;
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Id inválido.';
                        }
                    }
                }

                break;
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    }
    //Si la sesion no esta iniciada, entonces:
    else {
        print(json_encode('Acceso denegado. Por favor iniciar sesión'));
    }
} else {
    print(json_encode('El recurso no esta disponible'));
}
