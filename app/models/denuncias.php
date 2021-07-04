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
        private $respuesta = null;

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
            if ($this->validateAlphanumeric($value,1,200)) {
                $this->descripcion = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setRespuesta($value)
        {
            if ($this->validateAlphanumeric($value,1,200)) {
                $this->respuesta = $value;
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

        public function getRespuesta()
        {
            return $this -> respuesta;
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

        public function readOne()
        {
            $sql = 'SELECT CONCAT(residente.nombre,\' \',residente.apellido) AS residente, tipodenuncia.tipodenuncia, estadodenuncia.estadodenuncia, fecha, descripcion
            FROM denuncia
            INNER JOIN residente ON denuncia.idresidente = residente.idresidente
            INNER JOIN tipodenuncia ON denuncia.idtipodenuncia = tipodenuncia.idtipodenuncia
            INNER JOIN estadodenuncia ON denuncia.idestadodenuncia = estadodenuncia.idestadodenuncia
            WHERE idDenuncia = ?';
            $params = array($this->idDenuncia);
            return Database::getRow($sql, $params);
        }

        public function acceptComplaint()
        {
            $sql = 'UPDATE denuncia SET idestadodenuncia = 3 
                    WHERE iddenuncia = ?';
            $params = array($this->idDenuncia);
            return Database::executeRow($sql, $params);
        }

        public function rejectComplaint()
        {
            $sql = 'UPDATE denuncia SET idestadodenuncia = 2
                    WHERE iddenuncia = ?';
            $params = array($this->idDenuncia);
            return Database::executeRow($sql, $params);
        }

        public function revertChanges()
        {
            $sql = 'UPDATE denuncia SET idestadodenuncia = 1, respuesta = null, idempleado = null
                    WHERE iddenuncia = ?';
            $params = array($this->idDenuncia);
           
            return Database::executeRow($sql, $params);
        }

        public function finishComplaint()
        {
            $sql = 'UPDATE denuncia SET idestadodenuncia = 5 WHERE iddenuncia = ?';
            $params = array($this->idDenuncia);
           
            return Database::executeRow($sql, $params);
        }


        public function readStates()
        {
            $sql = 'SELECT*FROM estadodenuncia';
            $params = null;
            return Database::getRows($sql, $params);
        }

        public function readEmployeeTypes()
        {
            $sql = 'SELECT*FROM tipoempleado';
            $params = null;
            return Database::getRows($sql, $params);
        }

        public function readEmployeeByTypes($id)
        {
            $sql = 'SELECT idempleado, CONCAT(nombre,\' \', apellido) AS empleado 
                    FROM empleado 
                    WHERE idtipoempleado = ? AND idestadoempleado = 1';
            $params = array($id);
            return Database::getRows($sql, $params);
        }

        public function setEmployee()
        {
            $sql = 'UPDATE denuncia SET idempleado = ?, idestadodenuncia = 4 WHERE iddenuncia = ?';
            $params = array($this->idEmpleado, $this->idDenuncia);
          
            return Database::executeRow($sql, $params);
        }

        public function getInfo()
        {
            $sql = 'SELECT iddenuncia, CONCAT(residente.nombre,\' \',residente.apellido) AS residente, tipodenuncia.tipodenuncia, fecha, estadodenuncia.estadodenuncia, CONCAT(empleado.nombre,\' \', empleado.apellido) AS empleado, descripcion
                    FROM denuncia
                    INNER JOIN residente ON denuncia.idresidente = residente.idresidente
                    INNER JOIN estadodenuncia ON denuncia.idestadodenuncia = estadodenuncia.idestadodenuncia
                    INNER JOIN tipodenuncia ON denuncia.idtipodenuncia = tipodenuncia.idtipodenuncia
                    INNER JOIN empleado ON denuncia.idempleado = empleado.idempleado
                    WHERE idDenuncia = ?';
            $params = array($this->idDenuncia);
            return Database::getRow($sql, $params);
        }

        public function getAnswer()
        {
            $sql = 'SELECT respuesta FROM denuncia WHERE iddenuncia = ?';
            $params = array($this->idDenuncia);
            return Database::getRow($sql, $params);
        }

        public function insertAnswer()
        {
            $sql = 'UPDATE denuncia SET respuesta = ? WHERE iddenuncia = ?';
            $params = array($this->respuesta, $this->idDenuncia);
            return Database::executeRow($sql, $params);
        }

        
    }

?>