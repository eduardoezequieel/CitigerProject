<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/alquileres.php');

//Se verifica si existe la acción
if (isset($_GET['action'])) {
    //Se reanuda la sesión 
    session_start();
    //Se instancia la clase
    $alquiler = new Alquileres;
    //Se crea el array para la respuesta
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    //Se verifica si hay una sesión iniciada
    if (isset($_SESSION['idusuario_dashboard'])) {
        //Se evalua que acción se va a ejecutar
        switch ($_GET['action']) {
                //Caso para leer todos los datos de la tabla
            case 'readAll':
                if ($result['dataset'] = $alquiler->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Se encontró al menos un registro';
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No se ha encontrado ningún alquiler registrado.';
                    }
                }
                break;
            case 'readEspacios':
                if ($result['dataset'] = $alquiler->readEspacios()) {
                    $result['status'] = 1;
                    $result['message'] = 'Se encontró al menos un registro';
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No se ha encontrado ningún espacio registrado.';
                    }
                }
                break;

            case 'checkResidente':
                $_POST = $alquiler->validateForm($_POST);
                if ($alquiler->setDui($_POST['txtDuiVerificar'])) {
                    if ($result['dataset'] = $alquiler->checkResidente()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha encontrado al residente.';
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No existe ningún residente con este DUI.';
                        }
                    }
                } else {
                    $result['exception'] = 'Dui incorrecto.';
                }

                break;
                //Caso para llenar combobox de estado del alquiler
            case 'readRentalStatus':
                if ($result['dataset'] = $alquiler->readRentalStatus()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    }
                }
                break;
                //Caso para llenar combobox de espacios
            case 'readSpaceUpdate':
                $_POST = $alquiler->validateForm($_POST);
                if ($alquiler->setIdEspacio($_POST['idEspacio'])) {
                    if ($result['dataset'] = $alquiler->readSpaceUpdate()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        }
                    }
                } else {
                    $result['exception'] = 'Error al seleccionar el espacio.';
                }
                break;
                //Caso para llenar combobx de espacios
            case 'readSpace':
                if ($result['dataset'] = $alquiler->readSpace()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    }
                }
                break;
                //Caso para llenar combobox de residente
            case 'readResident':
                if ($result['dataset'] = $alquiler->readResident()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    }
                }
                break;
                //Caso para leer un dato en especifico
            case 'readOne':
                $_POST = $alquiler->validateForm($_POST);
                if ($alquiler->setIdAlquiler($_POST['idAlquiler'])) {
                    if ($result['dataset'] = $alquiler->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No se ha encontrado ningún alquiler registrado.';
                        }
                    }
                } else {
                    $result['exception'] = 'Hubo problemas al seleccionar el registro.';
                }
                break;
            case 'readOneEspacio':
                $_POST = $alquiler->validateForm($_POST);
                if ($alquiler->setIdEspacio($_POST['idEspacio'])) {
                    if ($result['dataset'] = $alquiler->readOneEspacio()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No se ha encontrado ningún espacio registrado.';
                        }
                    }
                } else {
                    $result['exception'] = 'Hubo problemas al seleccionar el espacio.';
                }
                break;
                //Caso para agregar un registro
            case 'createRow':
                $_POST = $alquiler->validateForm($_POST);
                if ($alquiler->setIdEspacio($_POST['idEspacio'])) {
                    if ($alquiler->setIdResidente($_POST['idResidente'])) {
                        if ($alquiler->setFecha($_POST['txtFecha'])) {
                            if (
                                $_POST['txtHoraInicio'] != $_POST['txtHoraFin'] &&
                                $_POST['txtHoraInicio'] < $_POST['txtHoraFin']
                            ) {
                                if ($alquiler->setHoraInicio($_POST['txtHoraInicio'])) {
                                    if ($alquiler->setHoraFin($_POST['txtHoraFin'])) {
                                        if ($alquiler->setPrecio($_POST['txtPrecio'])) {
                                            $alquiler->setIdEstadoAlquiler(1);
                                            if ($alquiler->createRow()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Se ha agregado el alquiler correctamente.';
                                                $alquiler->registerAction('Registrar', 'El usuario registró un dato en la tabla de alquileres');
                                            } else {
                                                if (Database::getException()) {
                                                    $result['exception'] = Database::getException();
                                                } else {
                                                    $result['exception'] = 'No se ha agregado el alquiler correctamente.';
                                                }
                                            }
                                        } else {
                                            $result['exception'] = 'El precio ingresado no es válido.';
                                        }
                                    } else {
                                        $result['exception'] = 'La hora de fin ingresada no es válida.';
                                    }
                                } else {
                                    $result['exception'] = 'La hora de inicio ingresada no es válida.';
                                }
                            } else {
                                $result['exception'] = 'La hora de inicio no puede ser igual o menor a la hora de fin.';
                            }
                        } else {
                            $result['exception'] = 'La fecha ingresada no es válida.';
                        }
                    } else {
                        $result['exception'] = 'El residente seleccionado no es válido.';
                    }
                } else {
                    $result['exception'] = 'El espacio seleccionado no es válido.';
                }

                break;
                //Caso para actualizar un registro
            case 'updateRow':
                $_POST = $alquiler->validateForm($_POST);
                if ($alquiler->setIdAlquiler($_POST['idAlquiler'])) {
                    if ($alquiler->readOne()) {
                        if ($alquiler->setFecha($_POST['txtFecha'])) {
                            if (
                                $_POST['txtHoraInicio'] != $_POST['txtHoraFin'] &&
                                $_POST['txtHoraInicio'] < $_POST['txtHoraFin']
                            ) {
                                if ($alquiler->setHoraInicio($_POST['txtHoraInicio'])) {
                                    if ($alquiler->setHoraFin($_POST['txtHoraFin'])) {
                                        if ($alquiler->setPrecio($_POST['txtPrecio'])) {
                                            $alquiler->setIdEstadoAlquiler(1);
                                            if ($alquiler->updateRow()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Se ha actualizado el alquiler correctamente.';
                                                $alquiler->registerAction('Actualizar', 'El usuario actualizó un registro en la tabla de alquileres');
                                            } else {
                                                if (Database::getException()) {
                                                    $result['exception'] = Database::getException();
                                                } else {
                                                    $result['exception'] = 'No se ha actualizado el alquiler correctamente.';
                                                }
                                            }
                                        } else {
                                            $result['exception'] = 'El precio ingresado no es válido.';
                                        }
                                    } else {
                                        $result['exception'] = 'La hora de fin ingresada no es válida.';
                                    }
                                } else {
                                    $result['exception'] = 'La hora de inicio ingresada no es válida.';
                                }
                            } else {
                                $result['exception'] = 'La hora de inicio no puede ser igual o mayor a la hora de fin.';
                            }
                        } else {
                            $result['exception'] = 'La fecha ingresada no es válida.';
                        }
                    } else {
                        $result['exception'] = 'El residente seleccionado no es válido.';
                    }
                } else {
                    $result['exception'] = 'Hubo un problema al seleccionar el alquiler.';
                }
                break;
                //Caso para eliminar el registro de la base
            case 'delete':
                $_POST = $alquiler->validateForm($_POST);
                if ($alquiler->setIdAlquiler($_POST['idAlquiler'])) {
                    if ($alquiler->setIdEspacio($_POST['idEspacio'])) {
                        if ($alquiler->deleteRow()) {
                            $result['status'] = 1;
                            if ($alquiler->checkSpaceStatus()) {
                                $result['message'] = 'Se ha eliminado el alquiler correctamente';
                            } else {
                                $alquiler->setIdEstadoEspacio(1);
                                $alquiler->changeSpaceStatus();
                                $result['message'] = 'Se ha eliminado el alquiler correctamente.';
                                $alquiler->registerAction('Eliminar', 'El usuario eliminó un registro en la tabla de alquileres');
                            }
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No se ha eliminado el alquiler correctamente.';
                            }
                        }
                    } else {
                        $result['exception'] = 'Hubo problemas al seleccionar el espacio.';
                    }
                } else {
                    $result['exception'] = 'Problemas al seleccionar el alquiler.';
                }
                break;
                //Caso para suspender un registro
            case 'suspendRow':
                $_POST = $alquiler->validateForm($_POST);
                if ($alquiler->setIdAlquiler($_POST['idAlquiler'])) {
                    $alquiler->setIdEstadoAlquiler(4);
                    if ($alquiler->setIdEspacio($_POST['idEspacio'])) {
                        if ($alquiler->changeStatus()) {
                            $result['status'] = 1;
                            if ($alquiler->checkSpaceStatus()) {
                                $result['message'] = 'Se ha denegado el alquiler correctamente';
                            } else {
                                $alquiler->setIdEstadoEspacio(1);
                                $alquiler->changeSpaceStatus();
                                $result['message'] = 'Se ha denegado el alquiler correctamente.';
                                $alquiler->registerAction('Denegar', 'El usuario denegó un registro en la tabla de alquileres');
                            }
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No se ha denegado el alquiler correctamente';
                            }
                        }
                    } else {
                        $result['exception'] = 'Hubo problemas al seleccionar el espacio.';
                    }
                } else {
                    $result['exception'] = 'Problemas al seleccionar el alquiler';
                }
                break;
                //Caso para activar un registro
            case 'activateRow':
                $_POST = $alquiler->validateForm($_POST);
                if ($alquiler->setIdAlquiler($_POST['idAlquiler'])) {
                    $alquiler->setIdEstadoAlquiler(2);
                    if ($alquiler->setIdEspacio($_POST['idEspacio'])) {
                        if ($alquiler->changeStatus()) {
                            $result['status'] = 1;
                            $alquiler->setIdEstadoEspacio(4);
                            $alquiler->changeSpaceStatus();
                            $result['message'] = 'Se ha activado el alquiler correctamente.';
                            $alquiler->registerAction('Autorizar', 'El usuario autorizó un registro en la tabla de alquileres');
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No se ha activado el alquiler correctamente.';
                            }
                        }
                    } else {
                        $result['exception'] = 'No se ha activado el alquiler correctamente.';
                    }
                } else {
                    $result['exception'] = 'Problemas al seleccionar el alquiler';
                }
                break;
                //Caso para finalizar un registro
            case 'finishRow':
                if ($alquiler->finalizarAlquiler()) {
                    $result['status'] = 1;
                    $alquiler->activateSpaceStatus();
                    $result['message'] = 'Se han finalizado alquileres';

                   
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No se han finalizado alquileres.';
                    }
                }
                break;
                //Caso para realizar busquedas
            case 'search':
                $_POST = $alquiler->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $alquiler->searchRows($_POST['search'])) {
                        $result['status'] = 1;
                        $row = count($result['dataset']);
                        if ($row > 0) {
                            $result['message'] = 'Se han encontrado ' . $row . ' coincidencias';
                        } else {
                            $result['message'] = 'Se ha encontrado una coincidencia.';
                        }
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay coincidencias.';
                        }
                    }
                } else {
                    $result['exception'] = 'Campo vacio';
                }
                break;
                //Caso para cargar un registro en especifico
            case 'filterRentalStatus':
                $_POST = $alquiler->validateForm($_POST);
                if ($alquiler->setIdEstadoAlquiler($_POST['idEstadoAlquiler'])) {
                    if ($result['dataset'] = $alquiler->filterRentalStatus()) {
                        $result['status'] = 1;
                        $row = count($result['dataset']);
                        if ($row > 0) {
                            $result['message'] = 'Se han encontrado ' . $row . ' coincidencias.';
                        } else {
                            $result['message'] = 'Se ha encontrado una coincidencia.';
                        }
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay coincidencias.';
                        }
                    }
                } else {
                    $result['exception'] = 'Hubo un problema al seleccionar el estado del alquiler.';
                }
                break;

            case 'readOne2':
                $_POST = $alquiler->validateForm($_POST);
                $_SESSION['fecha1'] = $_POST['txtFecha1'];
                $_SESSION['fecha2'] = $_POST['txtFecha2'];
                if (
                    $_POST['txtFecha1'] != $_POST['txtFecha2'] &&
                    $_POST['txtFecha1'] < $_POST['txtFecha2']
                ) {
                    if ($_POST['txtFecha1'] != null && $_POST['txtFecha1'] != null) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'No ha ingresado fechas';
                    }
                } else {
                    $result['exception'] = 'La fecha de inicio no puede ser  menor a la fecha de fin.';
                }
                break;

            case 'readOne3':
                $_SESSION['idalquiler'] = $_POST['txtId'];
                if ($_SESSION['idalquiler'] != null) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Factura inexistente';
                }
                break;
            default:
                $result['exception'] = 'La acción solicitada no está disponible dentro de la sesión';
        }
    } else {
        $result['exception'] = 'La acción solicitada no está disponible fuera de la sesión';
    }
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}
