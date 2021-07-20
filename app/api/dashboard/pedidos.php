<?php
    require_once('../../helpers/database.php');
    require_once('../../helpers/validator.php');
    require_once('../../models/pedidos.php');

    if (isset($_GET['action'])) {
        //Reanudando la sesion
        session_start();

        //Objeto para instanciar la clase
        $pedidos = new Pedidos();

        //Arreglo para guardar respuestas de la API
        $result = array('status'=>0, 'error'=>0, 'message'=>null, 'exception'=>null);

        //Acciones a ejecutar permitidas con la sesion iniciada
        if (isset($_SESSION['idusuario'])) {
            switch($_GET['action']){
                //Caso para leer todos los registros
                case 'readAll':
                    if ($result['dataset'] = $pedidos -> readAll()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha encontrado registros de pedidos.';
                    }
                    else{
                        if (Database::getException()) {
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        }
                        else{
                            $result['exception'] = 'No se han encontrado registros de pedidos.';
                        }
                    }
                    break;
                //Caso para leer un pedido
                case 'readOne':
                    if ($pedidos->setIdPedido($_POST['idPedido'])) {
                        if ($result['dataset'] = $pedidos -> readOne()) {
                            $result['status'] = 1;
                            $result['message'] = 'Se ha encontrado registros de pedidos.';
                        }
                        else{
                            if (Database::getException()) {
                                $result['error'] = 1;
                                $result['exception'] = Database::getException();
                            }
                            else{
                                $result['exception'] = 'No se han encontrado registros de pedidos.';
                            }
                        }
                    } else {
                        $result['exception'] = 'Id incorrecto.';
                    }
                    break;
                //Caso para filtrar los registros mediante estado
                case 'readByState':
                    if ($pedidos->setIdEstadoPedido($_POST['txtEstadoPedido'])) {
                        if ($result['dataset'] = $pedidos -> readByState()) {
                            $result['status'] = 1;
                            $result['message'] = 'Se ha encontrado registros de pedidos.';
                        }
                        else{
                            if (Database::getException()) {
                                $result['error'] = 1;
                                $result['exception'] = Database::getException();
                            }
                            else{
                                $result['exception'] = 'No se han encontrado registros de pedidos.';
                            }
                        }
                    } else {
                        $result['exception'] = 'Id incorrecto.';
                    }
                    
                    break;
                //Caso para actualizar el stock de un producto cuando este ya ha sido ingresado al carrito;
                case 'updateStock':
                    if ($pedidos->setIdMaterial($_POST['idmaterial'])) {
                        if ($pedidos->setIdDetalleMaterial($_POST['iddetalle'])) {
                            if ($pedidos->updateStock($_POST['stockBodega'])) {
                                if ($pedidos->updateOrderStock($_POST['stockPedido'])) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Cantidad de material actualizada correctamente.';
                                    $pedidos->registerAction('Actualizar','El usuario cambio el stock de un producto mediante un pedido.');

                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Id material incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Id material incorrecto';
                    }
                    break;
                //Caso para cambiar el estado de una orden/pedido a cancelado
                case 'cancelOrder':
                    if ($pedidos->setIdPedido($_POST['txtIdPedido'])) {
                        if ($pedidos->cancelOrder()) {
                            $result['status'] = 1;
                            $result['message'] = 'Pedido reportado como cancelado exitosamente.';
                            $pedidos->registerAction('Cancelar','El usuario canceló un pedido.');

                        } else {
                            $result['exception'] = Database::getException();
                        }
                        
                    } else {
                        $result['exception'] = 'Id incorrecto.';
                    }
                    
                    break;
                //Caso para cambiar el estado de una orden/pedido a recibido
                case 'confirmOrder':
                    if ($pedidos->setIdPedido($_POST['txtIdPedido'])) {
                        if ($pedidos->confirmOrder()) {
                            $result['status'] = 1;
                            $result['message'] = 'Pedido reportado como recibido exitosamente.';
                            $pedidos->registerAction('Confirmar','El usuario reporto como recibido un pedido.');
                        } else {
                            $result['exception'] = Database::getException();
                        }
                        
                    } else {
                        $result['exception'] = 'Id incorrecto.';
                    }
                    
                    break;
                //Caso para obtener el total.
                case 'getTotal2':
                    if ($pedidos->setIdPedido($_POST['idPedido2'])) {
                        if ($result['dataset'] = $pedidos->getTotalPrice()) {
                            $result['status'] = 1;
                        } else {
                            $result['exception'] = Database::getException();
                        }
                        
                    } else {
                        $result['exception'] = 'id incorrecto';
                    }
                    break;
                //Caso para obtener los productos de un pedido.
                case 'readOrder2':
                    if ($pedidos->setIdPedido($_POST['idPedido3'])) {
                        if ($result['dataset'] = $pedidos->getOrder()) {
                            $result['status'] = 1;
                        } else {
                            $result['exception'] = Database::getException();
                        }
                        
                    } else {
                        $result['exception'] = 'id incorrecto';
                    }
                    break;
                case 'readMaterials':
                    if ($result['dataset'] = $pedidos -> readMaterials()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha encontrado registros de materiales.';
                    }
                    else{
                        if (Database::getException()) {
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        }
                        else{
                            $result['exception'] = 'No se han encontrado registros de materiales.';
                        }
                    }
                    break;
                case 'readOneMaterial':
                    $_POST = $pedidos->validateForm($_POST);
                    if ($pedidos->setIdMaterial($_POST['idMaterial'])) {
                        if ($result['dataset'] = $pedidos->readOneMaterial()) {
                            $result['status'] = 1;
                        } else {
                            $result['exception'] = Database::getException();
                        }
                        
                    } else {
                        $result['exception'] = 'id incorrecto';
                    }
                    break;
                case 'readOrder':
                    if ($data = $pedidos->checkIfThereIsAnActiveOrder()) {
                        if ($pedidos->setIdPedido($data['idpedido'])) {
                            if ($result['dataset'] = $pedidos->getOrder()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = Database::getException();
                            }
                            
                        } else {
                            $result['exception'] = 'id incorrecto';
                        }
                        
                    } else {
                        $result['exception'] = 'Este usuario no tiene ordenes en proceso.';
                    }
                    break;
                case 'getTotal':
                    if ($data = $pedidos->checkIfThereIsAnActiveOrder()) {
                        if ($pedidos->setIdPedido($data['idpedido'])) {
                            if ($result['dataset'] = $pedidos->getTotalPrice()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = Database::getException();
                            }
                            
                        } else {
                            $result['exception'] = 'id incorrecto';
                        }
                        
                    } else {
                        $result['exception'] = 'Este usuario no tiene ordenes en proceso.';
                    }
                    break;
                case 'readEmployees':
                    if ($result['dataset'] = $pedidos->readEmployees()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se han encontrado empleados.';
                    } else {
                        $result['exception'] = 'No se han encontrado empleados.';
                    }
                    break;
                case 'readStates':
                    if ($result['dataset'] = $pedidos->readStates()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se han encontrado estados.';
                    } else {
                        $result['exception'] = 'No se han encontrado estados.';
                    }
                    
                    break;
                case 'sendPedido':
                    if ($data = $pedidos->checkIfThereIsAnActiveOrder()) {
                        if ($pedidos->setIdPedido($data['idpedido'])) {
                            if (isset($_POST['txtEmpleadoPedido'])) {
                                if ($pedidos->setIdEmpleado($_POST['txtEmpleadoPedido'])) {
                                    if ($pedidos->sendOrder()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Pedido realizado exitosamente.';
                                        $pedidos->registerAction('Crear','El usuario creó un pedido.');
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                    
                                } else {
                                    $result['exception'] = 'Id empleado incorrecto';
                                }
                                
                            } else {
                                $result['exception'] = 'Por favor seleccione al empleado solicitante del pedido.';
                            }
                            
                        } else {
                            $result['exception'] = 'Id pedido incorrecto';
                        }
                        
                    } else {
                        $result['exception'] = 'Este usuario no posee ordenes pendientes.';
                    }
                    
                    break;
                case 'addMaterialToOrder':
                    if ($data = $pedidos->checkIfThereIsAnActiveOrder()) {
                        if ($pedidos->setIdPedido($data['idpedido'])) {
                            if ($pedidos->setIdMaterial($_POST['idMaterial'])) {
                                if ($pedidos->setPrecioMaterial($_POST['txtPrecioMaterial'])) {
                                    if ($pedidos->setCantidadMaterial($_POST['txtCantidadMaterial'])) {
                                        if ($pedidos->noDuplicatedData()) {
                                            $result['exception'] = 'El producto ya ha sido ingresado en el carrito de compras.';
                                        } else {
                                            if ($pedidos->addMaterial()) {
                                                if ($dataMaterial = $pedidos->readOneMaterial()) {
                                                    if ($pedidos->setCantidadStock($dataMaterial['cantidad'])) {
                                                        if ($pedidos->updateMaterialStock()) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Agregado al carrito correctamente.';
                                                            $pedidos->registerAction('Agregar','El usuario agregó material a un pedido.');
                                                        } else {
                                                            $result['exception'] = Database::getException();
                                                        }
                                                        
                                                    } else {
                                                        $result['exception'] = 'Cantidad stock incorrecta.';
                                                    }
                                                    
                                                } else {
                                                    $result['exception'] = Database::getException();
                                                }
                                                
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                        }
                                        
                                    } else {
                                        $result['exception'] = 'Cantidad incorrecta.';
                                    }
                                    
                                } else {
                                    $result['exception'] = 'Precio incorrecto.';
                                }
                                
                            } else {
                                $result['exception'] = 'id material incorrecto';
                            }
                        } else {
                            $result['exception'] = 'id incorrecto';
                        }
                        
                    } else {
                        if ($pedidos->createOrder()) {
                            if ($data2 = $pedidos->checkIfThereIsAnActiveOrder()) {
                                if ($pedidos->setIdPedido($data2['idpedido'])) {
                                    if ($pedidos->setIdMaterial($_POST['idMaterial'])) {
                                        if ($pedidos->setPrecioMaterial($_POST['txtPrecioMaterial'])) {
                                            if ($pedidos->setCantidadMaterial($_POST['txtCantidadMaterial'])) {
                                                if ($pedidos->addMaterial()) {
                                                    if ($dataMaterial = $pedidos->readOneMaterial()) {
                                                        if ($pedidos->setCantidadStock($dataMaterial['cantidad'])) {
                                                            if ($pedidos->updateMaterialStock()) {
                                                                $result['status'] = 1;
                                                                $result['message'] = 'Agregado al carrito correctamente.';
                                                                $pedidos->registerAction('Agregar','El usuario agregó material a un pedido.');
                                                            } else {
                                                                $result['exception'] = Database::getException();
                                                            }
                                                            
                                                        } else {
                                                            $result['exception'] = 'Cantidad stock incorrecta.';
                                                        }
                                                        
                                                    } else {
                                                        $result['exception'] = Database::getException();
                                                    }
                                                } else {
                                                    $result['exception'] = Database::getException();
                                                }
                                                
                                            } else {
                                                $result['exception'] = 'Cantidad incorrecta.';
                                            }
                                            
                                        } else {
                                            $result['exception'] = 'Precio incorrecto.';
                                        }
                                        
                                    } else {
                                        $result['exception'] = 'id material incorrecto';
                                    }
                                    
                                } else {
                                    $result['exception'] = 'id incorrecto';
                                }
                                
                            } else {
                                $result['exception'] = 'ta rebug pa';
                            }
                            
                        } else {
                            $result['exception'] = Database::getException();
                        }
                        
                    }
                    break;
                case 'deleteFromCart':
                    $_POST = $pedidos -> validateForm($_POST);
                    if ($pedidos->setIdDetalleMaterial($_POST['idDetalleMaterial'])) {
                        if ($pedidos->setCantidadMaterial($_POST['cantidadMaterial'])) {
                            if ($pedidos->setIdMaterial($_POST['idMaterial'])) {
                                if ($data = $pedidos->readOneMaterial()) {
                                    if ($pedidos->setCantidadStock($data['cantidad'])) {
                                        if ($pedidos->restoreMaterialStock()) {
                                            if ($pedidos->deleteMaterial()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Material eliminado del carrito con exito.';
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                        } else {
                                            $result['exception'] = 'No se han podido restaurar las cantidades antes de eliminar el registro.';
                                        }
                                        
                                    } else {
                                        $result['exception'] = 'Cantidad incorrecta';
                                    }
                                    
                                } else {
                                    $result['exception'] = 'No se ha podido recuperar la informacion del material.';
                                }
                                
                            } else {
                                $result['exception'] = 'Id material incorrecto';
                            }
                            
                        } else {
                            $result['exception'] = 'cantidad material invalida';
                        }
                        
                    } else {
                        $result['exception'] = 'id incorrecto';
                    }
                    break;
                case 'updateCantidad':
                    if ($pedidos->setIdMaterial($_POST['txtIdMaterial'])) {
                        if ($data = $pedidos->readOneMaterial()) {
                            if ($pedidos->setCantidadStock($data['cantidad'])) {
                                
                            } else {
                                $result['exception'] = 'Cantidad stock incorrecta.';
                            }
                            
                        } else {
                            $result['exception'] = 'No hay informacion acerca de este id';
                        }
                    } else {
                        $result['exception'] = 'Id incorrecto';
                    }
                    
                    
                    break;
            }
            // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
            header('content-type: application/json; charset=utf-8');
            // Se imprime el resultado en formato JSON y se retorna al controlador.
            print(json_encode($result));
        }
        //Si la sesion no esta iniciada, entonces:
        else{
            print(json_encode('Acceso denegado. Por favor iniciar sesión'));
        }
    }
    else{
        print(json_encode('El recurso no esta disponible'));
    }
?>