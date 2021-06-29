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
    if (isset($_SESSION['idusuario'])) {
        switch ($_GET['action']) {
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

            case 'createRow':
                $_POST = $aportaciones->validateForm($_POST);
                if ($aportaciones->setNumeroCasa($_POST['txtNum'])) {
                    if ($aportaciones->setDireccion($_POST['txtUbicacion'])) {
                        if ($aportaciones->createRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Casa registrada correctamente.';
                            $aportaciones->registerAction('Registrar', 'El usuario registró un registro en la tabla de casas.');
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
                        $aportaciones->registerAction('Eliminar','El usuario eliminó un registro en la tabla de casas.');
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
