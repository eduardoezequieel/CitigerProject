<?php
    
    //Clase para manejar la tabla de alquileres
    Class Alquileres extends Validator
    {
        //Declarando atributos
        private $idAlquiler = null;
        private $idEstadoAlquiler = null;
        private $idEspacio = null;
        private $idEstadoEspacio = null;
        private $precio = null;
        private $idUsuario = null;
        private $idResidente = null;
        private $fecha = null;
        private $horaInicio = null;
        private $horaFin = null;
        private $idBitacora = null;

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

        public function setIdEstadoEspacio($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idEstadoEspacio = $value;
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
            $this->horaInicio = $value;
            return true;
        }

        public function setHoraFin($value)
        {
            $this->horaFin = $value;
            return true;
        }

        public function setIdBitacora($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idBitacora = $value;
                return true;
            } else {
                return false;
            }
        }

        //Métodos get
        
        public function getIdAlquiler()
        {
            return $this -> idAlquiler;
        }

        public function getIdEstadoAlquiler()
        {
            return $this -> idEstadoAlquiler;
        }

        public function getIdEspacio()
        {
            return $this -> idEspacio;
        }

        public function getIdEstadoEspacio()
        {
            return $this -> idEstadoEspacio;
        }

        public function getPrecio(){
            return $this -> precio;
        }

        public function getIdUsuario(){
            return $this -> idUsuario;
        }

        public function getIdResidente()
        {
            return $this -> idResidente;
        }

        public function getFecha()
        {
            return $this -> fecha;
        }

        public function getHoraInicio()
        {
            return $this -> horaInicio;
        }

        public function getHoraFin()
        {
            return $this -> horaFin;
        }

        public function getIdBitacora()
        {
            return $this->idBitacora;
        }

        //Función para leer todos los datos de la tabla
        public function readAll()
        {
            $sql = 'SELECT idalquiler, estadoalquiler, espacio.nombre, 
                    alquiler.idespacio, precio, idusuario,  CONCAT(residente.apellido, \', \', residente.nombre) 
                    as residente,alquiler.idresidente, fecha, horainicio,horafin, foto
                    FROM alquiler
                    INNER JOIN estadoalquiler ON estadoalquiler.idestadoalquiler = alquiler.idestadoalquiler
                    INNER JOIN espacio ON espacio.idespacio = alquiler.idespacio
                    INNER JOIN residente ON residente.idresidente = alquiler.idresidente
                    ORDER BY fecha';
            $params = null;
            return Database::getRows($sql,$params);
        }

        //Función para leer solo un dato de tabla
        public function readOne()
        {
            $sql = 'SELECT idalquiler, estadoalquiler, espacio.nombre, 
                    alquiler.idespacio, precio, idusuario,  CONCAT(residente.apellido, \', \', residente.nombre) 
                    as residente,alquiler.idresidente, fecha, horainicio,horafin, foto
                    FROM alquiler
                    INNER JOIN estadoalquiler ON estadoalquiler.idestadoalquiler = alquiler.idestadoalquiler
                    INNER JOIN espacio ON espacio.idespacio = alquiler.idespacio
                    INNER JOIN residente ON residente.idresidente = residente.idresidente
                    WHERE idalquiler = ?
                    ORDER BY fecha';
            $params = array($this->idAlquiler);
            return Database::getRow($sql,$params);
        }

        //Función para llenar cbEstados
        public function readRentalStatus()
        {
            $sql = 'SELECT*FROM estadoalquiler ORDER BY estadoalquiler';
            $params = null;
            return Database::getRows($sql,$params);
        }

        //Función para llenar cbEspacios
        public function readSpaceUpdate()
        {
            $sql = 'SELECT idespacio, nombre FROM espacio WHERE idestadoespacio != 3 OR idespacio= ? 
                    ORDER BY nombre';
            $params = array($this->idEspacio);
            return Database::getRows($sql,$params);
        }

        public function readSpace()
        {
            $sql = 'SELECT idespacio, nombre FROM espacio WHERE idestadoespacio != 3 ORDER BY nombre';
            $params = null;
            return Database::getRows($sql,$params);
        }

        //Función para llenar cbEspacios
        public function readResident()
        {
            $sql = 'SELECT idresidente, CONCAT(apellido, \', \', nombre) as residente FROM residente 
                    WHERE idestadoresidente= 1 ORDER BY apellido';
            $params = null;
            return Database::getRows($sql,$params);
        }

        //Función para agregar un nuevo registro a la base
        public function createRow()
        {
            $sql = 'INSERT INTO alquiler(idestadoalquiler, idespacio, precio, idusuario, idresidente, fecha,
                    horaInicio, horaFin)
                    VALUES(?,?,?,?,?,?,?,?)';
            $params = array($this->idEstadoAlquiler, $this->idEspacio, $this->precio,$_SESSION['idusuario'], $this->idResidente,
                            $this->fecha, $this->horaInicio, $this->horaFin);
            return Database::executeRow($sql,$params);
        }

        //Función para cambiar el estado del espacio
        public function changeSpaceStatus()
        {
            $sql = 'UPDATE espacio SET idestadoespacio = ? WHERE idespacio = ?';
            $params = array($this->idEstadoEspacio,$this->idEspacio);
            return Database::executeRow($sql,$params);
        }

        //Función para evaluar si se hace un update del estado del espacio 
        public function checkSpaceStatus() 
        {
            $sql = 'SELECT * FROM alquiler WHERE idespacio = ? AND idalquiler != ?
                    AND idestadoalquiler = 2';
            $params = array($this->idEspacio, $this->idAlquiler);
            return Database::getRows($sql,$params);
        }

        //Función para actualizar el registro
        public function updateRow()
        {
            $sql = 'UPDATE alquiler 
                    SET idestadoalquiler = ?, idespacio = ?, precio = ?, idusuario = ?, idresidente = ?,
                    fecha = ?, horainicio = ?, horafin = ?
                    WHERE idalquiler = ?';
            $params = array($this->idEstadoAlquiler,$this->idEspacio,$this->precio,$_SESSION['idusuario'], $this->idResidente,
                            $this->fecha, $this->horaInicio, $this->horaFin, $this->idAlquiler);
            return Database::executeRow($sql,$params);
        }

        //Función para eliminar el registro
        public function deleteRow()
        {
            $sql = 'DELETE FROM alquiler WHERE idalquiler = ?';
            $params = array($this->idAlquiler);
            return Database::executeRow($sql,$params);
        }

        //Método para suspender/activar un registro 
        public function changeStatus()
        {
            $sql = 'UPDATE alquiler 
                    SET idestadoalquiler = ?
                    WHERE idalquiler = ?';
            $params = array($this->idEstadoAlquiler, $this->idAlquiler);
            return Database::executeRow($sql,$params);
        }

        //Función para activar el estado del espacio
        public function activateSpaceStatus()
        {
            $sql = 'UPDATE espacio SET idestadoespacio = 1 WHERE idespacio = ?';
            $params = array($this->idEspacio);
            return Database::executeRow($sql,$params);
        }

         //Función para buscar
         public function searchRows($value)
         {
             $sql = 'SELECT idalquiler, estadoalquiler, espacio.nombre, 
                    alquiler.idespacio, precio, idusuario,  CONCAT(residente.apellido, \', \', residente.nombre) 
                    as residente,alquiler.idresidente, fecha, horainicio,horafin, foto
                    FROM alquiler
                    INNER JOIN estadoalquiler ON estadoalquiler.idestadoalquiler = alquiler.idestadoalquiler
                    INNER JOIN espacio ON espacio.idespacio = alquiler.idespacio
                    INNER JOIN residente ON residente.idresidente = residente.idresidente
                    WHERE residente.nombre ILIKE ? OR residente.apellido ILIKE ? OR espacio.nombre ILIKE ? 
                    ORDER BY fecha';
             $params = array("%$value%", "%$value%","%$value%");
             return Database::getRows($sql, $params);
         }

          //Lee todos los registros de la tabla
        public function filterRentalStatus()
        {
            $sql = 'SELECT idalquiler, estadoalquiler, alquiler.idestadoalquiler, espacio.nombre, 
                    alquiler.idespacio, precio, idusuario,  CONCAT(residente.apellido, \', \', residente.nombre) 
                    as residente,alquiler.idresidente, fecha, horainicio,horafin, foto
                    FROM alquiler
                    INNER JOIN estadoalquiler ON estadoalquiler.idestadoalquiler = alquiler.idestadoalquiler
                    INNER JOIN espacio ON espacio.idespacio = alquiler.idespacio
                    INNER JOIN residente ON residente.idresidente = residente.idresidente
                    WHERE alquiler.idestadoalquiler = ?
                    ORDER BY fecha';
            $params = array($this->idEstadoAlquiler);
            return Database::getRows($sql, $params);
        }

        //Función para llenar bitacora
        public function registerAction($action, $desc)
        {
        $sql = 'INSERT INTO bitacora VALUES (DEFAULT, ?, current_time, current_date, ?, ?)';
        $params = array($_SESSION['idusuario'], $action, $desc);
        return Database::executeRow($sql, $params);
        }

        //***************** SITIO DEL RESIDENTE ************* */

        //Función para leer todos los datos de la tabla
        public function readAllResident()
        {
            $sql = 'SELECT idalquiler, estadoalquiler, espacio.nombre, 
                    alquiler.idespacio, precio, idusuario,  CONCAT(residente.apellido, \', \', residente.nombre) 
                    as residente,alquiler.idresidente, fecha, horainicio,horafin, foto, imagenprincipal, espacio.nombre
                    FROM alquiler
                    INNER JOIN estadoalquiler ON estadoalquiler.idestadoalquiler = alquiler.idestadoalquiler
                    INNER JOIN espacio ON espacio.idespacio = alquiler.idespacio
                    INNER JOIN residente ON residente.idresidente = alquiler.idresidente
                    WHERE alquiler.idresidente = ?
                    ORDER BY fecha';
            $params = array($_SESSION['idresidente']);
            return Database::getRows($sql,$params);
        }

        public function searchRowsResident($value)
         {
             $sql = 'SELECT idalquiler, estadoalquiler, espacio.nombre, 
                    alquiler.idespacio, precio, idusuario,  CONCAT(residente.apellido, \', \', residente.nombre) 
                    as residente,alquiler.idresidente, fecha, horainicio,horafin, foto, imagenprincipal, espacio.nombre
                    FROM alquiler
                    INNER JOIN estadoalquiler ON estadoalquiler.idestadoalquiler = alquiler.idestadoalquiler
                    INNER JOIN espacio ON espacio.idespacio = alquiler.idespacio
                    INNER JOIN residente ON residente.idresidente = alquiler.idresidente
                    WHERE alquiler.idresidente = ? AND espacio.nombre ILIKE ? 
                    ORDER BY fecha';
             $params = array($_SESSION['idresidente'],"%$value%");
             return Database::getRows($sql, $params);
         }

         public function filterRentalStatusResident()
         {
             $sql = 'SELECT idalquiler, estadoalquiler, espacio.nombre, 
                    alquiler.idespacio, precio, idusuario,  CONCAT(residente.apellido, \', \', residente.nombre) 
                    as residente,alquiler.idresidente, fecha, horainicio,horafin, foto, imagenprincipal, espacio.nombre
                    FROM alquiler
                    INNER JOIN estadoalquiler ON estadoalquiler.idestadoalquiler = alquiler.idestadoalquiler
                    INNER JOIN espacio ON espacio.idespacio = alquiler.idespacio
                    INNER JOIN residente ON residente.idresidente = alquiler.idresidente
                     WHERE alquiler.idestadoalquiler = ? AND alquiler.idresidente = ?
                     ORDER BY fecha';
             $params = array($this->idEstadoAlquiler,$_SESSION['idresidente']);
             return Database::getRows($sql, $params);
         }
    }
?>