<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/inventario.php');

//Verificando si existe alguna acción
if (isset($_GET['action'])) {
    //Se crea una sesion o se reanuda la actual
    session_start();
    //Instanciando clases
    $material = new Inventario;
    //Array para respuesta de la API
    $result = array('status' => 0, 'recaptcha' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    //Verificando si hay una sesion iniciada
    if (isset($_SESSION['idusuario'])) {
        //Se compara la acción a realizar cuando la sesion está iniciada
        switch ($_GET['action']) {
                //Caso para leer todos los datos de la tabla
            case 'readTipoUnidad':
                if ($result['dataset'] = $material->readTipoUnidad()) {
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
            case 'readCategoria':
                if ($result['dataset'] = $material->readCategoria()) {
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
            case 'readMarca':
                if ($result['dataset'] = $material->readMarca()) {
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
            case 'cargarUnidadMedida':
                $_POST = $material->validateForm($_POST);
                if (isset($_POST['cbTipo'])) {
                    if ($material->setIdTipo($_POST['cbTipo'])) {
                        if ($result['dataset'] = $material->readUnidadmedida()) {
                            $result['status'] = 1;
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No existen tipos registrados.';
                            }
                        }
                    } else {
                        $result['exception'] = 'id malo';
                    }
                } else {
                    $result['exception'] = 'Error isset';
                }
                
                break;
            case 'createRow':
                $_POST = $material->validateForm($_POST);
                if (isset($_POST['cbMarca'])) {
                    if ($material->setIdMarca($_POST['cbMarca'])) {
                        if (isset($_POST['cbCategoria'])) {
                            if ($material->setIdCategoria($_POST['cbCategoria'])) {
                                if (isset($_POST['cbUnidad'])) {
                                    if ($material->setIdUnidadmedida($_POST['cbUnidad'])) {
                                        if ($material->setNombres($_POST['txtNombres'])) {
                                            if ($material->setTamanio($_POST['txtTamanio'])) {
                                                if ($material->setCosto($_POST['txtCosto'])) {
                                                    if ($material->setCantidad($_POST['txtCantidad'])) {
                                                        if ($material->setDescripcion($_POST['txtDesc'])) {
                                                            if (is_uploaded_file($_FILES['archivo_usuario']['tmp_name'])) {
                                                                if ($material->setImagen($_FILES['archivo_usuario'])) {
                                                                    if ($material->createRow()) {
                                                                        $result['status'] = 1;
                                                                        if ($material->saveFile($_FILES['archivo_usuario'], $material->getRuta(), $material->getImagen())) {
                                                                            $result['message'] = 'Material registrado correctamente';
                                                                            $material->registerAction('Registrar', 'El usuario registró un material en la tabla de materiales.');
                                                                        } else {
                                                                            $result['message'] = 'Material registrado pero no se guardó la imagen';
                                                                        }
                                                                    } else {
                                                                        $result['exception'] = Database::getException();;
                                                                    }
                                                                } else {
                                                                    $result['exception'] = 'Imagen incorrecta.';
                                                                }
                                                            } else {
                                                                $result['exception'] = 'Seleccione una imagen.';
                                                            }
                                                        } else {
                                                            $result['exception'] = 'Descripción incorrecta.';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Cantidad incorrecta.';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Costo incorrecto.';
                                                }
                                            } else {
                                                $result['exception'] = 'Dimensiones incorrectas.';
                                            }
                                        } else {
                                            $result['exception'] = 'Nombres incorrectos.';
                                        }
                                    } else {
                                        $result['exception'] = 'Unidad de medida incorrecta.';
                                    }
                                } else {
                                    $result['exception'] = 'Seleccione una opcion.';
                                }
                            } else {
                                $result['exception'] = 'Categoría incorrecta.';
                            }
                        } else {
                            $result['exception'] = 'Seleccione una opcion.';
                        }
                    } else {
                        $result['exception'] = 'Marca incorrecta.';
                    }
                } else {
                    $result['exception'] = 'Seleccione una opcion.';
                }
                break;

            case 'readAll':
                if ($result['dataset'] = $material->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No se ha encontrado ningún material registrado.';
                    }
                }
                break;
            case 'search':
                $_POST = $material->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $material->searchRows($_POST['search'])) {
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
            case 'filterCategorias':
                $_POST = $material->validateForm($_POST);
                if ($material->setIdCategoria($_POST['idCategoria'])) {
                    if ($result['dataset'] = $material->filterCategoria()) {
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
            case 'readOne':
                $_POST = $material->validateForm($_POST);
                if ($material->setIdMaterial($_POST['txtId'])) {
                    if ($result['dataset'] = $material->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No se ha encontrado ningún material registrado.';
                        }
                    }
                } else {
                    $result['exception'] = 'Hubo problemas al seleccionar el registro.';
                }
                break;
            case 'delete':
                $_POST = $material->validateForm($_POST);
                if ($material->setIdMaterial($_POST['txtId'])) {
                    if ($data = $material->readOne()) {
                        if ($material->deleteRow()) {
                            if ($material->deleteFile($material->getRuta(), $data['imagen'])) {
                                $result['status'] = 1;
                                $result['message'] = 'Material eliminado correctamente';
                                $material->registerAction('Eliminar','El usuario eliminó un registro en la tabla de materiales.');
                            } else {
                                $result['exception'] = 'Se borró el registro pero no la imagen';
                            }
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Material no existente';
                    }
                } else {
                    $result['exception'] = 'Material seleccionado incorrecto';
                }
                break;
            case 'updateRow':
                $_POST = $material->validateForm($_POST);
                if ($material->setIdMaterial($_POST['txtId'])) {
                    if ($data = $material->readOne()) {
                        if (isset($_POST['cbMarca'])) {
                            if ($material->setIdMarca($_POST['cbMarca'])) {
                                if (isset($_POST['cbCategoria'])) {
                                    if ($material->setIdCategoria($_POST['cbCategoria'])) {
                                        if (isset($_POST['cbUnidad'])) {
                                            if ($material->setIdUnidadmedida($_POST['cbUnidad'])) {
                                                if ($material->setNombres($_POST['txtNombres'])) {
                                                    if ($material->setTamanio($_POST['txtTamanio'])) {
                                                        if ($material->setCosto($_POST['txtCosto'])) {
                                                            if ($material->setCantidad($_POST['txtCantidad'])) {
                                                                if ($material->setDescripcion($_POST['txtDesc'])) {
                                                                    if (is_uploaded_file($_FILES['archivo_usuario']['tmp_name'])) {
                                                                        if ($material->setImagen($_FILES['archivo_usuario'])) {
                                                                            if ($material->updateRow($data['imagen'])) {
                                                                                $result['status'] = 1;
                                                                                if ($material->saveFile($_FILES['archivo_usuario'], $material->getRuta(), $material->getImagen())) {
                                                                                    $result['message'] = 'Material modificado correctamente';
                                                                                    $material->registerAction('Actualizar', 'El usuario actualizó un registro con cambio de foto en la tabla de materiales.');
                                                                                } else {
                                                                                    $result['message'] = 'Material modificado pero no se guardó la imagen';
                                                                                }
                                                                            } else {
                                                                                $result['exception'] = Database::getException();;
                                                                            }
                                                                        } else {
                                                                            $result['exception'] = $material->getImageError();
                                                                        }
                                                                    } else {
                                                                        if ($material->updateRow($data['imagen'])) {
                                                                            $result['status'] = 1;
                                                                            $result['message'] = 'Material modificado correctamente';
                                                                            $material->registerAction('Actualizar', 'El usuario actualizó un registro en la tabla de materiales sin cambiar su imagen.');

                                                                        } else {
                                                                            $result['exception'] = Database::getException();;
                                                                        }
                                                                    }
                                                                } else {
                                                                    $result['exception'] = 'Descripción incorrecta.';
                                                                }
                                                            } else {
                                                                $result['exception'] = 'Cantidad incorrecta.';
                                                            }
                                                        } else {
                                                            $result['exception'] = 'Costo incorrecto.';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Dimensiones incorrectas.';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Nombres incorrectos.';
                                                }
                                            } else {
                                                $result['exception'] = 'Unidad de medida incorrecta.';
                                            }
                                        } else {
                                            $result['exception'] = 'Seleccione una opcion.';
                                        }
                                    } else {
                                        $result['exception'] = 'Categoría incorrecta.';
                                    }
                                } else {
                                    $result['exception'] = 'Seleccione una opcion.';
                                }
                            } else {
                                $result['exception'] = 'Marca incorrecta.';
                            }
                        } else {
                            $result['exception'] = 'Seleccione una opcion.';
                        }
                    } else {
                        $result['exception'] = 'Material invalido';
                    }
                } else {
                    $result['exception'] = 'Material incorrecto.';
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
