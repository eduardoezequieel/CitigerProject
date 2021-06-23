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
            case 'cargarUnidadMedida':
                $_POST = $material->validateForm($_POST);
                if ($material->setIdTipo($_POST['idTipoEmpleado'])) {
                    if ($result['dataset'] = $material->readUnidadmedida()) {
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
