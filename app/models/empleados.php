<?php
    //Clase para la tabla de empleados
    class Empleados extends Validator 
    {
        private $idEmpleado = null;
        private $idEstadoEmpleado = null;
        private $nombre = null;
        private $apellido = null;
        private $telefono = null;
        private $dui = null;
        private $genero = null;
        private $foto = null;
        private $direccion = null;
        private $correo = null;
        private $fechaNacimiento = null;
        private $ruta = '../../../resources/img/dashboard_img/empleados_fotos/';
        private $idTipoEmpleado = null;

        //Metodos set para todas las variables del modelo.
        public function setIdEmpleado($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idEmpleado = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setIdTipoEmpleado($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idTipoEmpleado = $value;
                return true;
            } else {
                return false;
            }
        }
        
        public function setIdEstadoEmpleado($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idEstadoEmpleado = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setNombre($value)
        {
            if ($this->validateAlphabetic($value,1,30)) {
                $this->nombre = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setApellido($value)
        {
            if ($this->validateAlphabetic($value,1,30)) {
                $this->apellido = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setTelefono($value)
        {
            if ($this->validatePhone($value)) {
                $this->telefono = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setDui($value)
        {
            if ($this->validateDUI($value)) {
                $this->dui = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setGenero($value)
        {
            if ($this->validateAlphabetic($value,1,10)) {
                $this->genero = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setFoto($file)
        {
            if ($this->validateImageFile($file, 4000, 4000)) {
                $this->foto = $this->getImageName();
                return true;
            } else {
                return false;
            }
        }

        public function setDireccion($value)
        {
            if ($this->validateAlphabetic($value,1,200)) {
                $this->direccion = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setCorreo($value)
        {
            if ($this->validateEmail($value)) {
                $this->correo = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setNacimiento($value)
        {
            if ($this->validateDate($value)) {
                $this->fechaNacimiento = $value;
                return true;
            } else {
                return false;
            }
        }

        //Metodos get para las variables del modelo

        public function getIdEmpleado()
        {
            return $this -> idEmpleado;
        }

        public function getIdEstadoEmpleado()
        {
            return $this -> idEstadoEmpleado;
        }   

        public function getNombre()
        {
            return $this -> nombre;
        }

        public function getIdTipoEmpleado()
        {
            return $this -> idTipoEmpleado;
        }

        public function getApellido()
        {
            return $this -> apellido;
        }

        public function getTelefono()
        {
            return $this -> telefono;
        }

        public function getDui()
        {
            return $this -> dui;
        }

        public function getGenero()
        {
            return $this -> genero;
        }

        public function getFoto()
        {
            return $this -> foto;
        }

        public function getCorreo()
        {
            return $this -> correo;
        }

        public function getNacimiento()
        {
            return $this -> fechaNacimiento;
        }

        public function getDireccion()
        {
            return $this -> direccion;
        }

        public function getRuta()
        {
            return $this->ruta;
        }

        //Sentencias SQL a la tabla empleados.

        //Carga datos para el select cbTipoEmpleado
        public function readEmployeeTypes()
        {
            $sql='SELECT*FROM tipoEmpleado';
            $params = null;
            return Database::getRows($sql, $params);
        }

        //Lee todos los registros de la tabla
        public function readAll()
        {
            $sql = 'SELECT idEmpleado, foto, CONCAT(nombre,\' \', apellido) AS nombre, dui, telefono, estadoempleado.estadoempleado, tipoempleado.tipoempleado
            FROM empleado 
            INNER JOIN estadoempleado ON empleado.idestadoempleado = estadoempleado.idestadoempleado
            INNER JOIN tipoempleado ON empleado.idtipoempleado = tipoempleado.idtipoempleado
            ORDER BY nombre ASC';
            $params = null;
            return Database::getRows($sql, $params);
        }

        //Lee todos los registros de la tabla
        public function filterByEmployeeType()
        {
            $sql = 'SELECT idEmpleado, foto, CONCAT(nombre,\' \', apellido) AS nombre, dui, telefono, estadoempleado.estadoempleado, tipoempleado.tipoempleado
            FROM empleado 
            INNER JOIN estadoempleado ON empleado.idestadoempleado = estadoempleado.idestadoempleado
            INNER JOIN tipoempleado ON empleado.idtipoempleado = tipoempleado.idtipoempleado
            WHERE tipoempleado.idtipoempleado = ?
            ORDER BY nombre ASC';
            $params = array($this->idTipoEmpleado);
            return Database::getRows($sql, $params);
        }

        //Lee un registro de la tabla
        public function readOne()
        {
            $sql = 'SELECT idEmpleado, correo, fechanacimiento, foto, nombre, apellido, dui, telefono, idestadoempleado, direccion, genero, idtipoempleado
            FROM empleado
			WHERE idEmpleado = ?
			ORDER BY nombre ASC';
            $params = array($this->idEmpleado);
            return Database::getRow($sql, $params);
        }

        //Función para buscar
        public function searchRows($value)
        {
            $sql = 'SELECT idEmpleado, foto, CONCAT(nombre,\' \', apellido) AS nombre, dui, telefono, estadoempleado.estadoempleado, tipoempleado.tipoempleado
            FROM empleado 
            INNER JOIN estadoempleado ON empleado.idestadoempleado = estadoempleado.idestadoempleado
            INNER JOIN tipoempleado ON empleado.idtipoempleado = tipoempleado.idtipoempleado
            WHERE nombre ILIKE ? OR apellido ILIKE ? OR DUI ILIKE ? OR telefono ILIKE ?
            ORDER BY nombre ASC';
            $params = array("%$value%", "%$value%", "%$value%", "%$value%");
            return Database::getRows($sql, $params);
        }

        //Crear registro de empleado
        public function createRow()
        {
            $sql = 'INSERT INTO empleado(idestadoempleado, nombre, apellido, telefono, dui, 
            genero, foto, direccion, correo, fechanacimiento, idtipoempleado) 
            VALUES
            (?,?,?,?,?,?,?,?,?,?,?)';
            $params = array($this->idEstadoEmpleado, $this->nombre, $this->apellido,
                            $this->telefono, $this->dui, $this->genero, $this->foto,
                            $this->direccion, $this->correo, $this->fechaNacimiento,
                            $this->idTipoEmpleado);
            return Database::executeRow($sql, $params);
        }

        //Actualizacion de datos
        public function updateRow($current_image)
        {
            // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
            ($this->foto) ? $this->deleteFile($this->getRuta(), $current_image) : $this->foto = $current_image;

            $sql = 'UPDATE empleado 
            SET idtipoempleado = ?, nombre = ?, apellido = ?, telefono = ?, dui = ?, 
                genero = ?, foto = ?, direccion = ?, correo = ?, fechanacimiento = ? 
            WHERE idempleado = ?';
            $params = array($this->idTipoEmpleado, $this->nombre, $this->apellido,
                            $this->telefono, $this->dui, $this->genero, $this->foto,
                            $this->direccion, $this->correo, $this->fechaNacimiento,
                            $this->idEmpleado);
            return Database::executeRow($sql, $params);
        }

        //Suspender empleado
        public function suspend(){
            $sql = 'UPDATE empleado SET idestadoempleado = 3
                    WHERE idempleado = ?';
            $params = array($this->idEmpleado);
            return Database::executeRow($sql, $params);
        }

        //Activar empleado
        public function activate(){
            $sql = 'UPDATE empleado SET idestadoempleado = 1
                    WHERE idempleado = ?';
            $params = array($this->idEmpleado);
            return Database::executeRow($sql, $params);
        }


        //Eliminar registro de empleado
        public function deleteRow()
        {
            $sql = 'DELETE FROM empleado WHERE idempleado = ?';
            $params = array($this->idEmpleado);
            return Database::executeRow($sql, $params);
        }

        public function registerAction($action, $desc)
        {
            $sql = 'INSERT INTO bitacora VALUES (DEFAULT, ?, current_time, current_date, ?, ?)';
            $params = array($_SESSION['idusuario_dashboard'],$action, $desc);
            return Database::executeRow($sql, $params);
        }

        public function readTipoEmpleado2()
        {
            $sql = 'SELECT idtipoempleado, tipoempleado FROM tipoempleado';
            $params = null;
            return Database::getRows($sql, $params);
        }

        public function empleadoTipo()
        {
            $sql="SELECT CONCAT(apellido,', ', nombre) AS nombre, dui, telefono, estadoempleado.estadoempleado
            FROM empleado 
            INNER JOIN estadoempleado USING(idestadoempleado)
            WHERE idtipoempleado = ?
            ORDER BY nombre";
            $params = array($this->idTipoEmpleado);
            return Database::getRows($sql, $params);
        }
    }
    
?>