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
    }
    
?>