<?php

 //Clase para manejar la tabla de usuarios
 Class Administradores extends Validator
 {
                //Declarando atributos
                private $idUsuario = null;
                private $idEstadoUsuario = null;
                private $idTipoUsuario = null;
                private $nombre = null;
                private $apellido = null;
                private $telefonoFijo = null;
                private $telefonoCelular = null;
                private $foto = null;
                private $correo = null;
                private $fechaNacimiento = null;
                private $genero = null;
                private $dui = null;
                private $username = null;
                private $contrasenia = null;
                private $direccion = null;
                private $ruta = '../../../resources/img/dashboard_img/usuarios_fotos/';
                
                public function setId($value)
            {
                if ($this->validateNaturalNumber($value)) {
                    $this->idUsuario = $value;
                    return true;
                } else {
                    return false;
                }
            }

            public function setNombres($value)
            {
                if ($this->validateAlphabetic($value,1,25)) {
                    $this->nombre = $value;
                    return true;
                } else {
                    return false;
                }
            }

            public function setApellidos($value)
            {
                if ($this->validateAlphabetic($value,1,25)) {
                    $this->apellido = $value;
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

            public function setCorreo($value)
            {
                if ($this->validateEmail($value)) {
                    $this->correo = $value;
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

                public function setNacimiento($value)
                {
                    if ($this->validateDate($value)) {
                        $this->fechaNacimiento = $value;
                        return true;
                    } else {
                        return false;
                    }
                }

            public function setTelefonoFijo($value)
            {
                if ($this->validatePhone($value)) {
                    $this->telefonoFijo = $value;
                    return true;
                } else {
                    return false;
                }
            }

            public function setTelefonoCelular($value)
            {
                if ($this->validatePhone($value)) {
                    $this->telefonoCelular = $value;
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

            public function setDireccion($value)
            {
                if ($this->validateString($value,1,200)) {
                    $this->direccion = $value;
                    return true;
                } else {
                    return false;
                }
            }

            public function setUsername($value)
            {
                if ($this->validateAlphanumeric($value,1,25)) {
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

            public function setIdEstadoUsuario($value)
            {
                if ($this->validateNaturalNumber($value)) {
                    $this->idEstadoUsuario = $value;
                    return true;
                } else {
                    return false;
                }
            }

            public function setIdTipoUsuario($value)
            {
                if ($this->validateNaturalNumber($value)) {
                    $this->idTipoUsuario = $value;
                    return true;
                } else {
                    return false;
                }
            }

            //Metodos get

            public function getId(){
                return $this -> idUsuario;
            }

            public function getNombres(){
                return $this -> nombre;
            }

            public function getApellidos(){
                return $this -> apellido;
            }

            public function getGenero(){
                return $this -> genero;
            }

            public function getCorreo(){
                return $this -> correo;
            }

            public function getFoto(){
                return $this -> foto;
            }

            public function getRuta()
            {
                return $this->ruta;
            }

            public function getNacimiento(){
                return $this -> fechaNacimiento;
            }

            public function getTelefonoFijo(){
                return $this -> telefonoFijo;
            }

            public function getTelefonoCelular(){
                return $this -> telefonoCelular;
            }

            public function getDui(){
                return $this -> dui;
            }
            public function getUsername(){
                return $this -> username;
            }

            public function getContrasenia(){
                return $this -> contrasenia;
            }

            public function getIdEstadoUsuario(){
                return $this -> idEstadoUsuario;
            }

            public function getIdTipoUsuario(){
                return $this -> idTipoUsuario;
            }

            public function readEmployeeTypes()
            {
                $sql='SELECT*FROM tipoUsuario';
                $params = null;
                return Database::getRows($sql, $params);
            }

            public function createRow()
            {
                // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
                $sql = 'INSERT INTO usuario(idEstadoUsuario, idTipoUsuario, nombre, apellido, telefonoFijo, 
                        telefonoCelular, foto,correo, fechaNacimiento, genero, dui,username, contrasena,direccion)
                        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
                $params = array($this->idEstadoUsuario, $this->idTipoUsuario, $this->nombre, $this->apellido, $this->telefonoFijo, 
                                $this->telefonoCelular, $this->foto, $this->correo, $this->fechaNacimiento, $this->genero,
                                $this->dui, $this->username, $this->contrasenia, $this->direccion);
                return Database::executeRow($sql, $params);
            }

            public function readAll()
            {
                $sql="SELECT u.idusuario, u.foto, Concat(u.nombre,' ',u.apellido) as nombre, u.dui, u.telefonofijo,e.estadousuario
                from usuario u
                inner join estadousuario e on u.idestadousuario=e.idestadousuario and idusuario<> ? 
                order by u.apellido";
                $params = array($_SESSION['idusuario']);
                return Database::getRows($sql, $params);
            }

            public function searchRows($value)
            {
                $sql="SELECT u.idusuario, u.foto, Concat(u.nombre,' ',u.apellido) as nombre, u.dui, u.telefonofijo,e.estadousuario
                from usuario u
                inner join estadousuario e on u.idestadousuario=e.idestadousuario where u.idusuario<> ? and Concat(u.nombre,' ',u.apellido) ILIKE ?
                order by u.apellido";
                $params = array($_SESSION['idusuario'], "%$value%");
                return Database::getRows($sql, $params);
            }



 }
