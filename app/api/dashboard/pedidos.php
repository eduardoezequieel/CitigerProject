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