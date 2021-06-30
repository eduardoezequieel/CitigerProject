<?php

    class Visitantes extends Validator 
    {
        private $idVisitante = null;
        private $nombre = null;
        private $apellido = null;
        private $dui = null;
        private $genero = null;
        private $placa = null;

        //Metodos set para todas las variables del modelo.
        public function setIdVisitante($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idVisitante = $value;
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

        public function setPlaca($value)
        {
            if ($this->validateAlphanumeric($value,1,30)) {
                $this->placa = $value;
                return true;
            } else {
                return false;
            }
        }

        //Metodos get para las variables del modelo

        public function getIdVisitante()
        {
            return $this -> idVisitante;
        }

        public function getNombre()
        {
            return $this -> nombre;
        }

        public function getApellido()
        {
            return $this -> apellido;
        }

        public function getDui()
        {
            return $this -> dui;
        }

        public function getGenero()
        {
            return $this -> genero;
        }

        public function getPlaca()
        {
            return $this -> placa;
        }

        //Sentencias SQL a la tabla visitante.

        //Lee todos los registros de la tabla
        public function readAll()
        {
            $sql = 'SELECT idVisitante, CONCAT(nombre,\' \', apellido) AS nombre, dui, placa
            FROM visitante 
            ORDER BY nombre ASC';
            $params = null;
            return Database::getRows($sql, $params);
        }

        //Lee un registro de la tabla
        public function readOne()
        {
            $sql = 'SELECT idVisitante, nombre, apellido, dui, genero, placa
            FROM visitante
			WHERE idVisitante = ?
			ORDER BY nombre ASC';
            $params = array($this->idVisitante);
            return Database::getRow($sql, $params);
        }

        //Función para buscar
        public function searchRows($value)
        {
            $sql = 'SELECT idVisitante, CONCAT(nombre,\' \', apellido) AS nombre, apellido, dui, placa
            FROM visitante 
            WHERE nombre ILIKE ? OR apellido ILIKE ? OR dui ILIKE ? OR placa ILIKE ?
            ORDER BY nombre ASC';
            $params = array("%$value%", "%$value%", "%$value%", "%$value%");
            return Database::getRows($sql, $params);
        }

        //Crear registro de visitate
        public function createRow()
        {
            $sql = 'INSERT INTO visitante(nombre, apellido, dui, genero, placa) 
            VALUES
            (?,?,?,?,?)';
            $params = array($this->nombre, 
                            $this->apellido,
                            $this->dui, 
                            $this->genero, 
                            $this->placa);
            return Database::executeRow($sql, $params);
        }

        //Actualizacion de datos
        public function updateRow()
        {
            $sql = 'UPDATE visitante 
            SET nombre = ?, apellido = ?, dui = ?, genero = ?, placa = ?
            WHERE idvisitante = ?';
            $params = array($this->nombre, 
                            $this->apellido,
                            $this->dui,
                            $this->genero, 
                            $this->placa, 
                            $this->idVisitante);
            return Database::executeRow($sql, $params);
        }

        //Eliminar registro de empleado
        public function deleteRow()
        {
            $sql = 'DELETE FROM visitante WHERE idvisitante = ?';
            $params = array($this->idVisitante);
            return Database::executeRow($sql, $params);
        }

    }

?>