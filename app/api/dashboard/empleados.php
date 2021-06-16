<?php
    require_once('../../helpers/database.php');
    require_once('../../helpers/validator.php');
    require_once('../../models/empleados.php');

    //Verificando si existe alguna acción
    if (isset($_GET['action'])) {
        //Se crea una sesion o se reanuda la actual
        session_start();
        //Instanciando clases
        $empleado = new Empleados;
        //Array para respuesta de la API
        $result= array('status'=>0, 'recaptcha' => 0,'error'=>0, 'message'=>null,'exception'=> null);
        //Verificando si hay una sesion iniciada
        if (isset($_SESSION['idusuario'])) {
            //Se compara la acción a realizar cuando la sesion está iniciada
            switch ($_GET['action']) {
                //Caso para crear registros en la tabla empleados
                case 'readEmployeeTypes':
                    if ($result['dataset'] = $empleado->readEmployeeTypes()) {
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
                
                case 'createRow':
                    $_POST = $empleado->validateForm($_POST);
                    $empleado->setIdEstadoEmpleado(1);
                    if ($empleado->setNombre($_POST['txtNombre'])) {
                        if ($empleado->setApellido($_POST['txtApellido'])) {
                            if ($empleado->setTelefono($_POST['txtTelefono'])) {
                                if ($empleado->setDui($_POST['txtDUI'])) {
                                    if (isset($_POST['cbGenero'])) {
                                        if ($empleado->setGenero($_POST['cbGenero'])) {
                                            if (is_uploaded_file($_FILES['archivo_usuario']['tmp_name'])) {
                                                if ($empleado->setFoto($_FILES['archivo_usuario'])){
                                                    if ($empleado->setDireccion($_POST['txtDireccion'])) {
                                                        if ($empleado->setCorreo($_POST['txtCorreo'])) {
                                                            if ($empleado->setNacimiento($_POST['txtFechaNacimiento'])) {
                                                                if (isset($_POST['cbTipoEmpleado2'])) {
                                                                    if ($empleado->setIdTipoEmpleado($_POST['cbTipoEmpleado2'])) {
                                                                        if ($empleado->createRow()) {
                                                                            $result['status'] = 1;
                                                                            if ($empleado->saveFile($_FILES['archivo_usuario'], $empleado->getRuta(), $empleado->getFoto())) {
                                                                                $result['message'] = 'Empleado registrado correctamente';
                                                                            } else {
                                                                                $result['message'] = 'Empleado registrado pero no se guardó la imagen';
                                                                            }
                                                                        } else {
                                                                            $result['exception'] = Database::getException();
                                                                        }  
                                                                    }else{
                                                                        $result['exception'] = 'Tipo2 invalida';
                                                                    }
                                                                }else{
                                                                    $result['exception'] = 'Tipo1 invalida';
                                                                }
                                                            }else{
                                                                $result['exception'] = 'Fecha invalida';
                                                            }
                                                        }else{
                                                            $result['exception'] = 'Correo invalido';
                                                        }
                                                    }else{
                                                        $result['exception'] = 'Direccion invalida';
                                                    }
                                                }else{
                                                    $result['exception'] = 'Error foto2';
                                                }
                                            }else{
                                                $result['exception'] = 'Error foto1';
                                            }
                                        }else{
                                            $result['exception'] = 'Genero invalido2';
                                        }
                                    }else{
                                        $result['exception'] = 'Genero invalido1';
                                    }
                                }else{
                                    $result['exception'] = 'Nombre invalido';
                                }
                            }else{
                                $result['exception'] = 'Telefono invalido';
                            }
                        }else{
                            $result['exception'] = 'Apellido invalido';
                        }
                    }else{
                        $result['exception'] = 'Nombre invalido';
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