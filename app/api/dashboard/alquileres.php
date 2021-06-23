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
        if (isset($_SESSION['idusuario'])) {
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