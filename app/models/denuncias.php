<?php
    //Clase para tabla de denuncias
    class Denuncias extends Validator{
        private $idDenuncia = null;
        private $idEmpleado = null;
        private $idResidente = null;
        private $idTipoDenuncia = null;
        private $idEstadoDenuncia = null;
        private $fecha = null;
        private $descripcion = null;

        //Metodos set para las variables del modelo

        public function setIdDenuncia($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idDenuncia = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setIdEmpleado($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idEmpleado = $value;
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

        public function setIdTipoDenuncia($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idTipoDenuncia = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setIdEstadoDenuncia($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idEstadoDenuncia = $value;
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

        public function setDescripcion($value)
        {
            if ($this->validateAlphabetic($value,1,200)) {
                $this->descripcion = $value;
                return true;
            } else {
                return false;
            }
        }

        //Metodos get para todas las variables del modelo
        public function getIdDenuncia()
        {
            return $this -> idDenuncia;
        }

        public function getIdEmpleado()
        {
            return $this -> idEmpleado;
        }

        public function getIdResidente()
        {
            return $this -> idResidente;
        }   

        public function getIdTipoDenuncia()
        {
            return $this -> idTipoDenuncia;
        }

        public function getIdEstadoDenuncia()
        {
            return $this -> idEstadoDenuncia;
        }

        public function getFecha()
        {
            return $this -> fecha;
        }

        public function getDescripcion()
        {
            return $this -> descripcion;
        }

        //Sentencias SQL

        public function readAll()
        {
            $sql = 'SELECT idDenuncia, CONCAT(residente.nombre,\' \',residente.apellido) AS residente, tipodenuncia.tipodenuncia, estadodenuncia.estadodenuncia, fecha
            FROM denuncia
            INNER JOIN residente ON denuncia.idresidente = residente.idresidente
            INNER JOIN tipodenuncia ON denuncia.idtipodenuncia = tipodenuncia.idtipodenuncia
            INNER JOIN estadodenuncia ON denuncia.idestadodenuncia = estadodenuncia.idestadodenuncia';
            $params = null;
            return Database::getRows($sql, $params);
        }

        public function readOne(){
            $sql = 'SELECT CONCAT(residente.nombre,\' \',residente.apellido) AS residente, tipodenuncia.tipodenuncia, estadodenuncia.estadodenuncia, fecha, descripcion
            FROM denuncia
            INNER JOIN residente ON denuncia.idresidente = residente.idresidente
            INNER JOIN tipodenuncia ON denuncia.idtipodenuncia = tipodenuncia.idtipodenuncia
            INNER JOIN estadodenuncia ON denuncia.idestadodenuncia = estadodenuncia.idestadodenuncia
            WHERE idDenuncia = ?';
            $params = array($this->idDenuncia);
            return Database::getRow($sql, $params);
        }

        public function acceptComplaint(){
            $sql = 'UPDATE denuncia SET idestadodenuncia = 3 
                    WHERE iddenuncia = ?';
            $params = array($this->idDenuncia);
            return Database::executeRow($sql, $params);
        }

        public function rejectComplaint(){
            $sql = 'UPDATE denuncia SET idestadodenuncia = 2 
                    WHERE iddenuncia = ?';
            $params = array($this->idDenuncia);
            return Database::executeRow($sql, $params);
        }
    }

?>