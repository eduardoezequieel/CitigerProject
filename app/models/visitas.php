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
            $sql='SELECT * FROM estadovisita';
            $params = null;
            return Database::getRows($sql, $params);
        }

        //Carga datos para el select cbEstadoVisita
        public function readResident()
        {
            $sql='SELECT idresidente, CONCAT(nombre,\' \', apellido) AS nombre FROM residente';
            $params = null;
            return Database::getRows($sql, $params);
        }

        //Lee todos los registros de la tabla
        public function readAll()
        {
            $sql = 'SELECT idVisita, residente.nombre, fecha, visitarecurrente, observacion, estadovisita.estadovisita
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
            $sql = 'SELECT idVisita, residente.nombre, fecha, visitarecurrente, observacion, estadovisita.estadovisita
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
        public function updateRow()
        {

            $sql = 'UPDATE visita 
            SET idresidente = ?, fecha = ?, visitarecurrente = ?, observacion = ?
            WHERE idvisita = ?';
            $params = array($this->idResidente, 
                            $this->fecha, 
                            $this->visitarecurrente,
                            $this->observacion,  
                            $this->idVisita);
            return Database::executeRow($sql, $params);
        }

        //Suspender visita
        public function suspend(){
            $sql = 'UPDATE visita SET idestadovisita = 5
                    WHERE idvisita = ?';
            $params = array($this->idVisita);
            return Database::executeRow($sql, $params);
        }

        //Activar visita
        public function activate(){
            $sql = 'UPDATE visita SET idestadovisita = 4
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
            $params = array($_SESSION['idresidente'],$action, $desc);
            return Database::executeRow($sql, $params);
        }
    
        public function createVisita()
        {
            $sql = 'INSERT INTO visita(idresidente, fecha, visitarecurrente, observacion, idestadovisita) 
            VALUES
            (?,?,?,?,?)';
            $params = array($_SESSION['idresidente'], 
                            $this->fecha, 
                            $this->visitarecurrente,
                            $this->observacion, 
                            $this->idEstadoVisita);
            return Database::executeRow($sql, $params);
        }

        public function createVistante()
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
    
    }
