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