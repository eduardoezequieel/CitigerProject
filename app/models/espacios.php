<?php
    //Clase para manejar tabla de espacio
    Class Espacios extends Validator 
    {
        //Declarando atributos
        private $idEspacio = null;
        private $idEstadoEspacio = null;
        private $nombre = null;
        private $descripcion = null;
        private $capacidad = null;
        private $idBitacora = null;
        private $imagen = null;
        private $ruta = '../../../resources/img/dashboard_img/espacios_fotos/';

        //Métodos set 
        public function setIdEspacio($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idEspacio = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setFoto($file)
        {
            if ($this->validateImageFile($file, 4000, 4000)) {
                $this->imagen = $this->getImageName();
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

        public function setNombre($value)
        {
            if ($this->validateAlphanumeric($value,1,30)) {
                $this->nombre = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setDescripcion($value)
        {
            if ($this->validateString($value,1,200)) {
                $this->descripcion = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setCapacidad($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->capacidad = $value;
                return true;
            } else {
                return false;
            }
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
        public function getIdEspacio() 
        {
            return $this->idEspacio;
        }

        public function getIdEstadoEspacio() 
        {
            return $this->idEstadoEspacio;
        }

        public function getNombre() 
        {
            return $this->nombre;
        }
        
        public function getDescripcion() 
        {
            return $this->descripcion;
        }

        public function getCapacidad() 
        {
            return $this->capacidad;
        }

        public function getIdBitacora()
        {
            return $this->idBitacora;
        }

        public function getFoto()
        {
            return $this->imagen;
        }

        public function getRuta()
        {
            return $this->ruta;
        }

        //Método para leer todos los datos de la tabla
        public function readAll()
        {
            $sql = 'SELECT idEspacio, estadoEspacio, nombre, descripcion, capacidad
                    FROM espacio 
                    INNER JOIN estadoEspacio ON estadoEspacio.idEstadoEspacio = espacio.idEstadoEspacio
                    ORDER BY nombre';
            $params = null;
            return Database::getRows($sql,$params);
        }

        //Método para leer un dato de la tabla
        public function readOne()
        {
            $sql = 'SELECT idEspacio, idestadoespacio, nombre, descripcion, capacidad
                    FROM espacio 
                    WHERE idEspacio = ?
                    ORDER BY nombre';
            $params =  array($this->idEspacio);
            return Database::getRow($sql,$params);
        }

        //Método para crear un nuevo registro
        public function createRow()
        {
            $sql = 'INSERT INTO espacio(idestadoespacio, nombre, descripcion, capacidad) 
                    VALUES(?,?,?,?)';
            $params = array($this->idEstadoEspacio,$this->nombre,$this->descripcion,$this->capacidad);
            return Database::executeRow($sql,$params);
        }

        //Método para crear un nuevo registro de imagen
        public function savePhoto()
        {
            $sql = 'INSERT INTO imagenesespacio(imagen,idespacio) 
                    VALUES(?,?)';
            $params = array($this->imagen, $this->idEspacio);
            return Database::executeRow($sql,$params);
        }

        public function readLast()
        {
            $sql = 'SELECT MAX(idespacio) as id FROM espacio';
            $params =  null;
            if ($data = Database::getRow($sql, $params)) {
                $this->idEspacio = $data['id'];
                return true;
            } else {
                return false;
            }
        }
    

        //Método para actualizar un registro
        public function updateRow()
        {
            $sql = 'UPDATE espacio 
                    SET idestadoespacio = ?, nombre = ?, descripcion = ?, capacidad = ?
                    WHERE idespacio = ?';
            $params = array($this->idEstadoEspacio,$this->nombre,$this->descripcion,$this->capacidad, $this->idEspacio);
            return Database::executeRow($sql,$params);
        }

        //Método para eliminar un registro
        public function deleteRow()
        {
            $sql = 'DELETE FROM espacio WHERE idespacio = ?';
            $params = array($this->idEspacio);
            return Database::executeRow($sql,$params);
        }

        //Método para suspender/activar un registro 
        public function changeStatus()
        {
            $sql = 'UPDATE espacio 
                    SET idestadoespacio = ?
                    WHERE idespacio = ?';
            $params = array($this->idEstadoEspacio, $this->idEspacio);
            return Database::executeRow($sql,$params);
        }

        //Método para buscar
        public function searchRows($value)
        {
            $sql = 'SELECT idEspacio, estadoEspacio, nombre, descripcion, capacidad
                    FROM espacio 
                    INNER JOIN estadoEspacio ON estadoEspacio.idEstadoEspacio = espacio.idEstadoEspacio
                    WHERE nombre ILIKE ? OR estadoespacio ILIKE ?
                    ORDER BY nombre';
            $params = array("%$value%", "%$value%");
            return Database::getRows($sql, $params);
        }

        //Método para llenar combobox de estado
        public function readSpaceStatus()
        {
            $sql = 'SELECT * FROM estadoEspacio ORDER BY estadoespacio';
            $params =  null;
            return Database::getRows($sql,$params);
        }

        //Lee todos los registros de la tabla
        public function filterSpaceStatus()
        {
            $sql = 'SELECT idEspacio, estadoEspacio, nombre, descripcion, capacidad
                    FROM espacio 
                    INNER JOIN estadoEspacio ON estadoEspacio.idEstadoEspacio = espacio.idEstadoEspacio
                    WHERE espacio.idestadoespacio = ?
                    ORDER BY nombre';
            $params = array($this->idEstadoEspacio);
            return Database::getRows($sql, $params);
        }

        //Función para llenar bitacora
        public function registerAction($action, $desc)
        {
        $sql = 'INSERT INTO bitacora VALUES (DEFAULT, ?, current_time, current_date, ?, ?)';
        $params = array($_SESSION['idusuario'], $action, $desc);
        return Database::executeRow($sql, $params);
        }

    }
?>