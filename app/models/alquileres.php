<?php
    
    //Clase para manejar la tabla de alquileres
    Class Alquileres extends Validator
    {
        //Declarando atributos
        private $idAlquiler = null;
        private $idEstadoAlquiler = null;
        private $idEspacio = null;
        private $precio = null;
        private $idUsuario = null;
        private $idResidente = null;
        private $fecha = null;
        private $horaInicio = null;
        private $horaFin = null;

        //Métodos set
        public function setIdAlquiler($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idAlquiler = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setIdEstadoAlquiler($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idEstadoAlquiler = $value;
                return true;
            } else {
                return false;
            }
        }
        
        public function setIdEspacio($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idEspacio = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setPrecio($value)
        {
            if ($this->validateMoney($value)) {
                $this->precio = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setIdUsuario($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idUsuario = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setIdResidente($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idResidente = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setFecha($value)
        {
            if ($this->validateDate($value)) {
                $this->fecha = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setHoraInicio($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->horaInicio = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setHoraFin($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->horaFin = $value;
                return true;
            } else {
                return false;
            }
        }

        //Métodos get
        
        public function getIdAlquiler(){
            return $this -> idAlquiler;
        }

        public function getIdEstadoAlquiler(){
            return $this -> idEstadoAlquiler;
        }

        public function getIdEspacio(){
            return $this -> idEspacio;
        }

        public function getPrecio(){
            return $this -> precio;
        }

        public function getIdUsuario(){
            return $this -> idUsuario;
        }

        public function getIdResidente(){
            return $this -> idResidente;
        }

        public function getFecha(){
            return $this -> fecha;
        }

        public function getHoraInicio(){
            return $this -> horaInicio;
        }

        public function getHoraFin(){
            return $this -> horaFin;
        }

        //Método para leer todos los datos de la tabla
        public function readAll()
        {
            $sql = 'SELECT idalquiler,estadoalquiler, espacio.nombre, precio, usuario.username, residente.username, 
                    fecha, horainicio, horafin
                    FROM alquiler
                    INNER JOIN estadoalquiler ON estadoalquiler.idestadoalquiler = alquiler.idestadoalquiler
                    INNER JOIN espacio ON espacio.idespacio = espacio.idespacio
                    INNER JOIN usuario ON usuario.idusuario = alquiler.idusuario
                    INNER JOIN residente ON residente.idresidente = alquiler.idresidente';
            $params = null;
            return Database::getRows($sql,$params);
        }
    }
?>