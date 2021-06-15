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
            if ($this->validateAlphabetic($value,1,15)) {
                $this->nombre = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setApellido($value)
        {
            if ($this->validateAlphabetic($value,1,15)) {
                $this->nombre = $value;
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

        //Crear registro de empleado
        public function createRow()
        {
            $sql = 'INSERT INTO empleado(idestadoempleado, nombre, apellido, telefono, dui, 
            genero, foto, direccion, correo, fechanacimiento) 
            VALUES
            (?,?,?,?,?,?,?,?,?,?)';
            $params = array($this->idEstadoEmpleado, $this->nombre, $this->apellido,
                            $this->telefono, $this->dui, $this->genero, $this->foto,
                            $this->direccion, $this->correo, $this->fechaNacimiento);
            return Database::executeRow($sql, $params);
        }

        public function readEmployeeTypes(
        {
            $sql='SELECT*FROM tipoEmpleado';
            $params = null;
            return Database::getRows($sql, $params);
        }
    }
    
?>