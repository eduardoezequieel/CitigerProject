<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/dashboard.php');
require_once('../../models/visitas.php');
require_once('../../models/denuncias.php');
require_once('../../models/inventario.php');
require_once('../../models/espacios.php');



if (isset($_GET['action'])) {
    //Reanudando la sesion
    session_start();

    //Objeto para instanciar la clase
    $dashboard = new Dashboard();
    //Objeto para instanciar la clase
    $visita = new Visitas();
    //Objeto para instanciar la clase
    $denuncia = new Denuncias();
    //Objeto para instanciar la clase
    $inventario = new Inventario();
    //Objeto para instanciar la clase
    $espacio = new Espacios();

    //Arreglo para guardar respuestas de la API
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);

    //Acciones a ejecutar permitidas con la sesion iniciada
    if (isset($_SESSION['idusuario'])) {
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $dashboard->readAllBitacora()) {
                    $result['status'] = 1;
                    $result['message'] = 'Se han encontrado registros en la bitacora.';
                } else {
                    if (Database::getException()) {
                        $result['error'] = 1;
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen registros en la bitacora.';
                    }
                }
                break;
            case 'readOne':
                $_POST = $dashboard->validateForm($_POST);
                if ($dashboard->setIdBitacora($_POST['idBitacora'])) {
                    if ($result['dataset'] = $dashboard->readOneBitacora()) {
                        $result['status'] = 1;
                        $result['message'] = 'Registro encontrado';
                    } else {
                        $result['exception'] = Database::getException();
                    }
                } else {
                    $result['exception'] = 'Id incorrecto';
                }
                break;
            case 'contadorDenuncias':
                if ($result['dataset'] = $dashboard->contadorDenuncias()) {
                    $result['status'] = 1;
                    $result['message'] = 'Denuncias encontradas';
                } else {
                    $result['exception'] = Database::getException();
                }
                break;

            case 'contadorVisitas':
                if ($result['dataset'] = $dashboard->contadorVisitas2()) {
                    $result['status'] = 1;
                    $result['message'] = 'Visitas encontradas';
                } else {
                    $result['exception'] = Database::getException();
                }
                break;
            case 'contadorAportacion':
                if ($result['dataset'] = $dashboard->contadorAportaciones2()) {
                    $result['status'] = 1;
                    $result['message'] = 'Visitas encontradas';
                } else {
                    $result['exception'] = Database::getException();
                }
                break;
            //Caso para obtener la cantidad de visitas de los ultimos 6 meses
            case 'last6MonthsOfVisits':
                if ($result['dataset'] = $visita->last6MonthsOfVisits()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay visitas.';
                    }
                }
                break;
            //Caso para obtener el porcentaje de denuncias por estado
            case 'complaintPercentage':
                if ($result['dataset'] = $denuncia->complaintPercentage()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay denuncias.';
                    }
                }
                break;
            //Caso para obtener los productos mas demandados.
            case 'topProducts':
                if ($result['dataset'] = $inventario->topProducts()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay productos.';
                    }
                }
                break;
            //Caso para obtener los espacios mas demandados.
            case 'topSpaces':
                if ($result['dataset'] = $espacio->topSpaces()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay espacios.';
                    }
                }
                break;
            //Caso para obtener los productos con movimientos.
            case 'readMovements':
                if ($result['dataset'] = $inventario->readMovements()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay productos con movimientos.';
                    }
                }
                break;
            //Caso para realizar busquedas
            case 'searchMovements':
                $_POST = $inventario->validateForm($_POST);
                if($_POST['search-historialInventario'] != ''){
                    if($result['dataset'] = $inventario->searchMovements($_POST['search-historialInventario'])){
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
