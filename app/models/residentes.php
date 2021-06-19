<?php
    class Residentes extends Validator 
    {
        private $idResidente = null;
        private $idEstadoResidente = null;
        private $nombre = null;
        private $apellido = null;
        private $telefonof = null;
        private $telefonom = null;
        private $dui = null;
        private $genero = null;
        private $foto = null;
        private $correo = null;
        private $fechaNacimiento = null;
        private $ruta = '../../../resources/img/dashboard_img/residentes_fotos/';
        private $username = null;
        private $contrasenia = null;

        //Metodos set para todas las variables del modelo.
        public function setIdResidente($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idResidente = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setIdEstadoResidente($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idEstadoResidente = $value;
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

        public function setTelefonof($value)
        {
            if ($this->validatePhone($value)) {
                $this->telefonof = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setTelefonom($value)
        {
            if ($this->validatePhone($value)) {
                $this->telefonom = $value;
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

        public function setCorreo($value)
        {
            if ($this->validateEmail($value)) {
                $this->correo = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setNacimiento($value)
        {
            if ($this->validateDate($value)) {
                $this->fechaNacimiento = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setUsername($value)
        {
            if ($this->validateAlphanumeric($value, 1, 25)) {
                $this->username = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setContrasenia($value)
        {
            if ($this->validatePassword($value)) {
                $this->contrasenia = $value;
                return true;
            } else {
                return false;
            }
        }

        //Metodos get para las variables del modelo

        public function getIdResidente()
        {
            return $this -> idResidente;
        }

        public function getIdEstadoResidente()
        {
            return $this -> idEstadoResidente;
        }   

        public function getNombre()
        {
            return $this -> nombre;
        }

        public function getApellido()
        {
            return $this -> apellido;
        }

        public function getTelefonof()
        {
            return $this -> telefonof;
        }

        public function getTelefonom()
        {
            return $this -> telefonom;
        }

        public function getDui()
        {
            return $this -> dui;
        }

        public function getGenero()
        {
            return $this -> genero;
        }

        public function getFoto()
        {
            return $this -> foto;
        }

        public function getCorreo()
        {
            return $this -> correo;
        }

        public function getNacimiento()
        {
            return $this -> fechaNacimiento;
        }


        public function getRuta()
        {
            return $this->ruta;
        }

        public function getUsername()
        {
            return $this->username;
        }

        public function getContrasenia()
        {
            return $this->contrasenia;
        }

        //Sentencias SQL a la tabla residente.

        //Lee todos los registros de la tabla
        public function readAll()
        {
            $sql = 'SELECT idResidente, foto, CONCAT(nombre,\' \', apellido) AS nombre, dui, telefonocelular, estadoresidente.estadoresidente
            FROM residente 
            INNER JOIN estadoresidente ON residente.idestadoresidente = estadoresidente.idestadoresidente
            ORDER BY nombre ASC';
            $params = null;
            return Database::getRows($sql, $params);
        }


        //Lee un registro de la tabla
        public function readOne()
        {
            $sql = 'SELECT idResidente, correo, fechanacimiento, foto, nombre, apellido, dui, telefonofijo, telefonocelular, idestadoresidente, genero, username
            FROM residente
			WHERE idResidente = ?
			ORDER BY nombre ASC';
            $params = array($this->idResidente);
            return Database::getRow($sql, $params);
        }

        //Función para buscar
        public function searchRows($value)
        {
            $sql = 'SELECT idResidente, foto, CONCAT(nombre,\' \', apellido) AS nombre, apellido, dui, telefonocelular, estadoresidente.estadoresidente
            FROM residente 
            INNER JOIN estadoresidente ON residente.idestadoresidente = estadoresidente.idestadoresidente
            WHERE nombre ILIKE ? OR apellido ILIKE ? OR dui ILIKE ? OR telefonocelular ILIKE ?
            ORDER BY nombre ASC';
            $params = array("%$value%", "%$value%", "%$value%", "%$value%");
            return Database::getRows($sql, $params);
        }

        //Crear registro de residente
        public function createRow()
        {
            $sql = 'INSERT INTO residente(idestadoresidente, nombre, apellido, telefonofijo, telefonocelular, foto, 
            correo, fechanacimiento, genero, dui, username, contrasena) 
            VALUES
            (?,?,?,?,?,?,?,?,?,?,?,?)';
            $params = array($this->idEstadoResidente, 
                            $this->nombre, 
                            $this->apellido,
                            $this->telefonof, 
                            $this->telefonom, 
                            $this->foto, 
                            $this->correo, 
                            $this->fechaNacimiento,
                            $this->genero, 
                            $this->dui, 
                            $this->username,
                            $this->contrasenia);
            return Database::executeRow($sql, $params);
        }

        //Actualizacion de datos
        public function updateRow($current_image)
        {
            // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
            ($this->foto) ? $this->deleteFile($this->getRuta(), $current_image) : $this->foto = $current_image;

            $sql = 'UPDATE residente 
            SET nombre = ?, apellido = ?, telefonofijo = ?, telefonocelular = ?, dui = ?, 
                genero = ?, foto = ?, direccion = ?, correo = ?, fechanacimiento = ?, username = ? 
            WHERE idresidente = ?';
            $params = array($this->nombre, 
                            $this->apellido,
                            $this->telefonof, 
                            $this->telefonom, 
                            $this->foto, 
                            $this->correo, 
                            $this->fechaNacimiento,
                            $this->genero, 
                            $this->dui, 
                            $this->username);
            return Database::executeRow($sql, $params);
        }

        //Suspender empleado
        public function suspend(){
            $sql = 'UPDATE residente SET idestadoresidente = 2
                    WHERE idresidente = ?';
            $params = array($this->idResidente);
            return Database::executeRow($sql, $params);
        }

        //Activar empleado
        public function activate(){
            $sql = 'UPDATE residente SET idestadoresidente = 1
                    WHERE idresidente = ?';
            $params = array($this->idResidente);
            return Database::executeRow($sql, $params);
        }


        //Eliminar registro de empleado
        public function deleteRow()
        {
            $sql = 'DELETE FROM residente WHERE idresidente = ?';
            $params = array($this->idResidente);
            return Database::executeRow($sql, $params);
        }
    }


?>