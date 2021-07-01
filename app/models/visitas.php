<?php
    //Clase para la tabla de visitas
    class Visitas extends Validator 
    {
        private $idVisita = null;
        private $idEstadoVisita = null;
        private $idResidente = null;
        private $fecha = null;
        private $visitarecurrente = null;
        private $observacion = null;

        //Metodos set para todas las variables del modelo.
        public function setIdVisita($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idVisita = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setIdEstadoVisita($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idEstadoVisita = $value;
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

        public function setVisitaR($value)
        {
            if ($this->validateAlphabetic($value,1,10)) {
                $this->visitarecurrente = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setObservacion($value)
        {
            if ($this->validateAlphabetic($value,1,200)) {
                $this->observacion = $value;
                return true;
            } else {
                return false;
            }
        }


        //Metodos get para las variables del modelo

        public function getIdVisita()
        {
            return $this -> idVisita;
        }

        public function getidEstadoVisita()
        {
            return $this -> idEstadoVisita;
        }   

        public function getIdResidente()
        {
            return $this -> idResidente;
        }

        public function getFecha()
        {
            return $this -> fecha;
        }

        public function getVisitaR()
        {
            return $this -> visitarecurrente;
        }

        public function getObservacion()
        {
            return $this -> observacion;
        }


        //Sentencias SQL a la tabla visita.

        //Carga datos para el select cbEstadoVisita
        public function readVisitStatus()
        {
            $sql='SELECT*FROM estadoVisita';
            $params = null;
            return Database::getRows($sql, $params);
        }

        //Carga datos para el select cbEstadoVisita
        public function readResident()
        {
            $sql='SELECT*FROM residente';
            $params = null;
            return Database::getRows($sql, $params);
        }

        //Lee todos los registros de la tabla
        public function readAll()
        {
            $sql = 'SELECT idVisita, residente.nombre, fecha, visitarecurrente, observacion estadovisita.estadovisita
            FROM visita 
            INNER JOIN estadovisita ON visita.idestadovisita = estadovisita.idestadovisita
            INNER JOIN residente ON visita.idresidente = residente.idresidente
            ORDER BY fecha ASC';
            $params = null;
            return Database::getRows($sql, $params);
        }

        //Lee todos los registros de la tabla
        public function filterByVisitStatus()
        {
            $sql = 'SELECT idVisita, residente.nombre, fecha, visitarecurrente, observacion estadovisita.estadovisita
            FROM visita 
            INNER JOIN estadovisita ON visita.idestadovisita = estadovisita.idestadovisita
            INNER JOIN residente ON visita.idresidente = residente.idresidente
            WHERE estadovisita.idestadovisita = ?
            ORDER BY fecha ASC';
            $params = array($this->idEstadoVisita);
            return Database::getRows($sql, $params);
        }

        //Lee un registro de la tabla
        public function readOne()
        {
            $sql = 'SELECT idVisita, idresidente, fecha, visitarecurrente, observacion, idestadovisita
            FROM visita
			WHERE idVisita = ?
			ORDER BY fecha ASC';
            $params = array($this->idVisita);
            return Database::getRow($sql, $params);
        }

        //Crear registro de visita
        public function createRow()
        {
            $sql = 'INSERT INTO visita(idresidente, fecha, visitarecurrente, observacion, idestadovisita) 
            VALUES
            (?,?,?,?,?)';
            $params = array($this->idResidente, 
                            $this->fecha, 
                            $this->visitarecurrente,
                            $this->observacion, 
                            $this->idEstadoVisita);
            return Database::executeRow($sql, $params);
        }

        //Actualizacion de datos
        public function updateRow($current_image)
        {

            $sql = 'UPDATE visita 
            SET idresidente = ?, fecha = ?, visitarecurrente = ?, observacion = ?, idestadovisita = ? 
            WHERE idvisita = ?';
            $params = array($this->idResidente, 
                            $this->fecha, 
                            $this->visitarecurrente,
                            $this->observacion, 
                            $this->idEstadoVisita, 
                            $this->idVisita);
            return Database::executeRow($sql, $params);
        }

        //Suspender visita
        public function suspend(){
            $sql = 'UPDATE visita SET idestadovisita = 3
                    WHERE idvisita = ?';
            $params = array($this->idVisita);
            return Database::executeRow($sql, $params);
        }

        //Activar visita
        public function activate(){
            $sql = 'UPDATE visita SET idestadovisita = 1
                    WHERE idvisita = ?';
            $params = array($this->idVisita);
            return Database::executeRow($sql, $params);
        }

        //Visita en camino
        public function ontheway(){
            $sql = 'UPDATE visita SET idestadovisita = 2
                    WHERE idvisita = ?';
            $params = array($this->idVisita);
            return Database::executeRow($sql, $params);
        }


        //Eliminar registro de visita
        public function deleteRow()
        {
            $sql = 'DELETE FROM visita WHERE idvisita = ?';
            $params = array($this->idVisita);
            return Database::executeRow($sql, $params);
        }

        public function registerAction($action, $desc)
        {
            $sql = 'INSERT INTO bitacora VALUES (DEFAULT, ?, current_time, current_date, ?, ?)';
            $params = array($_SESSION['idusuario'],$action, $desc);
            return Database::executeRow($sql, $params);
        }
    }
    
?>