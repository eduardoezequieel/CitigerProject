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
        private $idimagenesespacio = null;

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

        public function setIdImagenEspacio($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idimagenesespacio = $value;
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

        public function getIdImagenEspacio() 
        {
            return $this->idimagenesespacio;
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

        //Funcion para ver los espacios y su cantidad de usos
        public function spacesUses()
        {
            $sql = 'SELECT idespacio, nombre, COUNT(idalquiler) as usos 
                    FROM alquiler 
                    INNER JOIN espacio USING (idespacio) 
                    GROUP BY idespacio, nombre';
            $params = null;
            return Database::getRows($sql, $params);
        }

        //Funcion para ver los espacios y su cantidad de usos (busqueda)
        public function searchSpacesUses($value)
        {
            $sql = 'SELECT idespacio, nombre, COUNT(idalquiler) as usos 
                    FROM alquiler 
                    INNER JOIN espacio USING (idespacio) 
                    WHERE nombre ILIKE ?
                    GROUP BY idespacio, nombre';
            $params = array("%$value%");
            return Database::getRows($sql, $params);
        }

        //Funcion para obtener la cantidad de veces mensuales que un espacio ha sido utilizado en los ultimos 6 meses
        public function spaces6Months()
        {
            $sql = 'SELECT nombre, EXTRACT(MONTH FROM fecha) AS mes, COUNT(idespacio) AS totaluso
                    FROM alquiler
                    INNER JOIN espacio USING (idespacio)
                    WHERE idespacio = ?
                    GROUP BY nombre, mes
                    ORDER BY mes ASC 
                    LIMIT 6';
            $params = array($this->idEspacio);
            return Database::getRows($sql, $params);
        }

        //Top 5 espacios mas alquilados
        public function topSpaces()
        {
            $sql = 'SELECT nombre, COUNT(idalquiler) AS total
                    FROM alquiler
                    INNER JOIN espacio USING(idespacio)
                    WHERE idestadoespacio != 3
                    GROUP BY nombre
                    ORDER BY total DESC
                    LIMIT 5';
            $params = null;
            return Database::getRows($sql, $params);
        }

        //Método para leer todos los datos de la tabla
        public function readAll()
        {
            $sql = 'SELECT idEspacio, estadoEspacio, nombre, descripcion, capacidad, imagenprincipal
                    FROM espacio 
                    INNER JOIN estadoEspacio ON estadoEspacio.idEstadoEspacio = espacio.idEstadoEspacio
                    ORDER BY nombre';
            $params = null;
            return Database::getRows($sql,$params);
        }

        //Método para leer un dato de la tabla
        public function readOne()
        {
            $sql = 'SELECT idEspacio, espacio.idestadoespacio, estadoEspacio, nombre, descripcion, capacidad, imagenprincipal
                    FROM espacio 
                    INNER JOIN estadoEspacio ON estadoEspacio.idEstadoEspacio = espacio.idEstadoEspacio 
                    WHERE idEspacio = ?
                    ORDER BY nombre';
            $params =  array($this->idEspacio);
            return Database::getRow($sql,$params);
        }

        //Método para leer un dato de la tabla
        public function readOneImage()
        {
            $sql = 'SELECT idimagenesespacio,imagen, nombre, imagenesespacio.idespacio 
                    FROM imagenesespacio
                    INNER JOIN espacio ON espacio.idespacio = imagenesespacio.idespacio
                    WHERE idimagenesespacio = ?';
            $params =  array($this->idimagenesespacio);
            return Database::getRow($sql,$params);
        }

        //Método para leer un dato de la tabla
        public function readAllImageSpace()
        {
            $sql = 'SELECT idimagenesespacio,imagen, nombre, imagenesespacio.idespacio 
                    FROM imagenesespacio
                    INNER JOIN espacio ON espacio.idespacio = imagenesespacio.idespacio
                    WHERE imagenesespacio.idespacio  = ?';
            $params =  array($this->idEspacio);
            return Database::getRows($sql,$params);
        }


        public function readImageSpace()
        {
            $sql = 'SELECT idimagenesespacio,imagen, nombre 
                    FROM imagenesespacio
                    INNER JOIN espacio ON espacio.idespacio = imagenesespacio.idespacio
                    WHERE imagenesespacio.idespacio = ?';
            $params =  array($this->idEspacio);
            return Database::getRows($sql,$params);
        }

        public function updateFoto($current_image)
        {
            // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
            ($this->imagen) ? $this->deleteFile($this->getRuta(), $current_image) : $this->imagen = $current_image;

            $sql = 'UPDATE imagenesespacio
                    SET imagen = ?
                    WHERE idimagenesespacio = ?';
            $params = array($this->imagen, $this->idimagenesespacio);
            return Database::executeRow($sql, $params);
        }

        //Método para crear un nuevo registro
        public function createRow()
        {
            $sql = 'INSERT INTO espacio(idestadoespacio, nombre, descripcion, capacidad,imagenprincipal) 
                    VALUES(?,?,?,?,?)';
            $params = array($this->idEstadoEspacio,$this->nombre,$this->descripcion,$this->capacidad,$this->imagen);
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
        public function updateRow($current_image)
        {
            ($this->imagen) ? $this->deleteFile($this->getRuta(), $current_image) : $this->imagen = $current_image;
            $sql = 'UPDATE espacio 
                    SET idestadoespacio = ?, nombre = ?, descripcion = ?, capacidad = ?, imagenprincipal = ?
                    WHERE idespacio = ?';
            $params = array($this->idEstadoEspacio,$this->nombre,$this->descripcion,$this->capacidad,$this->imagen, $this->idEspacio);
            return Database::executeRow($sql,$params);
        }

        //Método para eliminar un registro
        public function deleteRow()
        {
            $sql = 'DELETE FROM espacio WHERE idespacio = ?';
            $params = array($this->idEspacio);
            return Database::executeRow($sql,$params);
        }

        public function deleteImage()
        {
            $sql = 'DELETE FROM imagenesespacio WHERE idimagenesespacio = ?';
            $params = array($this->idimagenesespacio);
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
            $sql = 'SELECT idEspacio, estadoEspacio, nombre, descripcion, capacidad, imagenprincipal
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
            $sql = 'SELECT idEspacio, estadoEspacio, nombre, descripcion, capacidad, imagenprincipal
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
        $params = array($_SESSION['idusuario_dashboard'], $action, $desc);
        return Database::executeRow($sql, $params);
        }

        
        public function readReportCabecera()
        {
            $sql = "SELECT nombre, capacidad, estadoespacio from espacio
            INNER JOIN estadoespacio using(idestadoespacio) where idespacio=?";
            $params = array($_SESSION['idespacio']);
            return Database::getRows($sql, $params);  
        }

        public function readReport()
        {
            $sql = "SELECT CONCAT(residente.apellido, ', ', residente.nombre) AS residente, fecha, horainicio, horafin, estadoalquiler
            FROM alquiler
            INNER JOIN residente USING(idresidente)
            INNER JOIN estadoalquiler USING(idestadoalquiler)
            WHERE fecha BETWEEN ? AND ? AND idespacio = ?
            ORDER BY fecha desc";
            $params = array($_SESSION['fecha1'],$_SESSION['fecha2'],$_SESSION['idespacio']);
            return Database::getRows($sql, $params);
       }


        public function readReport2()
        {
            $sql = "SELECT CONCAT(residente.apellido, ', ', residente.nombre) AS residente, fecha, horainicio, horafin, estadoalquiler
            FROM alquiler
            INNER JOIN residente USING(idresidente)
            INNER JOIN estadoalquiler USING(idestadoalquiler)
            WHERE idespacio = ?
            ORDER BY fecha desc";
            $params = array($_SESSION['idespacio']);
            return Database::getRows($sql, $params);
       }

        

    }
?>