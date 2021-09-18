<?php

require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/visitantes.php');

if (isset($_GET['action'])) {
    //Se crea una sesion o se reanuda la actual
    session_start();
    //Instanciando clases
    $visitante = new Visitantes;
    //Array para respuesta de la API
    $result = array('status'=>0, 'error'=>0, 'message'=>null, 'exception'=>null);        
    //Verificando si hay una sesion iniciada
    if(isset($_SESSION['idusuario_dashboard'])){
        //Se compara la acción a realizar cuando la sesion está iniciada
        switch ($_GET['action']) {
            //Caso para leer todos los registros de la tabla
            case 'readAll':
                if ($result['dataset'] = $visitante->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Se ha encontrado al menos un visitante.';
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen visitantes registrados.';
                    }
                }
                break;

            //Caso para cargar un registro en especifico
            case 'readOne':
                $_POST = $visitante -> validateForm($_POST);
                if($visitante->setIdVisitante($_POST['idVisitante'])){
                    if($result['dataset'] = $visitante->readOne()){
                        $result['status'] = 1;
                    } else{
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Visitante inexistente';
                        }
                    }
                } else{
                    $result['exception'] = 'Visitante seleccionado incorrecto';
                }
                break;

            //Caso para realizar busquedas
            case 'search':
                $_POST = $visitante->validateForm($_POST);
                if($_POST['search'] != ''){
                    if($result['dataset'] = $visitante->searchRows($_POST['search'])){
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


            //Caso para ingresar visitante 
            case 'createRow':
                $_POST = $visitante ->validateForm($_POST);
                if($visitante->setNombre($_POST['txtNombre'])){
                    if($visitante->setApellido($_POST['txtApellido'])){
                        if($visitante->setDui($_POST['txtDUI'])){
                            if($visitante->setPlaca($_POST['txtPlaca'])){
                                if(isset($_POST['cbGenero'])){
                                    if($visitante->setGenero($_POST['cbGenero'])){
                                        if ($visitante -> createRow()) {
                                            $result['status'] = 1;
                                            $result['message'] = 'Visitante registrado correctamente.';
                                        }else{
                                            $result['error'] = 1;
                                            $result['exception'] = Database::getException();
                                        }
                                    } else{
                                        $result['exception'] = 'Genero invalido.';
                                    }
                                } else{
                                    $result['exception'] = 'Genero invalido.';
                                }
                            } else{
                                $result['exception'] = 'Placa invalida.';
                            }
                        } else{
                            $result['exception'] = 'DUI invalido.';
                        }
                    } else{
                        $result['exception'] = 'Apellido invalido.';
                    }
                } else{
                    $result['exception'] = 'Nombre invalido.';
                }
                break;

            //Caso para actualizar el registro
            case 'updateRow':
                $_POST = $visitante ->validateForm($_POST);
                if($visitante->setIdVisitante($_POST['idVisitante'])){
                    if($data = $visitante->readOne()){
                        if($visitante->setNombre($_POST['txtNombre'])){
                            if($visitante->setApellido($_POST['txtApellido'])){
                                if($visitante->setDui($_POST['txtDUI'])){
                                    if($visitante->setPlaca($_POST['txtPlaca'])){
                                        if(isset($_POST['cbGenero'])){
                                            if($visitante->setGenero($_POST['cbGenero'])){
                                                if ($visitante->updateRow()) {
                                                    $result['status'] = 1;
                                                    $result['message'] = 'Visitante actualizado correctamente';
                                                } else {
                                                    $result['exception'] = Database::getException();
                                                } 
                                            } else{
                                                $result['exception'] = 'Genero invalido.';
                                            }
                                        } else{
                                            $result['exception'] = 'Genero invalido.';
                                        }
                                    } else{
                                        $result['exception'] = 'Placa invalida.';
                                    }
                                } else{
                                    $result['exception'] = 'DUI invalido.';
                                }
                            } else{
                                $result['exception'] = 'Apellido invalido.';
                            }
                        } else{
                            $result['exception'] = 'Nombre invalido';
                        }
                    } else{

                    }
                } else{

                }
                break;

            //Caso para eliminar el registro
            case 'delete':
                $_POST = $visitante -> validateForm($_POST);
                if ($visitante -> setIdVisitante($_POST['idVisitante'])) {
                    if ($visitante -> deleteRow()) {
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