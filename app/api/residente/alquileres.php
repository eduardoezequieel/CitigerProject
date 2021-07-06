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
        $result = array('status'=>0,'error'=>0, 'message'=>null,'exception'=> null);
        //Se verifica si hay una sesión iniciada
        if (isset($_SESSION['idresidente'])) {
            //Se evalua que acción se va a ejecutar
            switch ($_GET['action']) {
                //Caso para leer todos los datos de la tabla
                case 'readAll':
                    if ($result['dataset'] = $alquiler->readAllResident()) {
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
                //Caso para realizar busquedas
                case 'search':
                    $_POST = $alquiler->validateForm($_POST);
                    if($_POST['search'] != ''){
                        if($result['dataset'] = $alquiler->searchRowsResident($_POST['search'])){
                            $result['status'] = 1;
                            $row = count($result['dataset']);
                            if($row > 0){
                                $result['message'] = 'Se han encontrado '.$row .' coincidencias';
                            } else{
                                $result['message'] = 'Se ha encontrado una coincidencia.';
                            }
                        } else{
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
                    $_POST = $alquiler -> validateForm($_POST);
                    if ($alquiler->setIdEstadoAlquiler($_POST['idEstadoAlquiler'])) {
                        if($result['dataset'] = $alquiler->filterRentalStatusResident()){
                            $result['status'] = 1;
                            $row = count($result['dataset']);
                            if($row > 0){
                                $result['message'] = 'Se han encontrado '.$row .' coincidencias.';
                            } else{
                                $result['message'] = 'Se ha encontrado una coincidencia.';
                            }
                        } else{
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No hay coincidencias.';
                            }
                        }
                    }else{
                        $result['exception'] = 'Hubo un problema al seleccionar el estado del alquiler.';
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
?>