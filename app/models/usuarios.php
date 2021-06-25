<?php
    
    //Clase para manejar la tabla de usuarios
    Class Usuarios extends Validator
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
        private $modo = null;
        
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

    public function setModo($value)
    {
        if ($this->validateAlphabetic($value,1,25)) {
            $this->modo = $value;
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

    public function getModo(){
        return $this -> modo;
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

    //***Métodos para administrar cuenta del usuario***

    //Método para verificar si el usuario existe
    public function checkUser($email)
    {
        $sql = 'SELECT idUsuario,foto,idEstadoUsuario, username,tipoUsuario, modo FROM usuario 
                INNER JOIN tipoUsuario ON tipoUsuario.idTipoUsuario = usuario.idTipoUsuario
                WHERE correo = ?';
        $params = array($email);
        if ($data = Database::getRow($sql, $params)) {
            $this->idUsuario = $data['idusuario'];
            $this->correo = $email;
            $this->foto= $data['foto'];
            $this->idEstadoUsuario= $data['idestadousuario'];
            $this->username = $data['username'];
            $this->idTipoUsuario = $data['tipousuario'];
            $this->modo = $data['modo'];
            return true;
        } else {
            return false;
        }
    }

    //Método para verificar el estado del usuario
    public function checkEstado()
    {
        if ($this->idEstadoUsuario == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($password)
    {
        $sql = 'SELECT contrasena FROM usuario WHERE idUsuario = ?';
        $params = array($this->idUsuario);
        $data = Database::getRow($sql, $params);
        if (password_verify($password, $data['contrasena'])) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword()
    {
        $hash = password_hash($this->contrasenia, PASSWORD_DEFAULT);
        $sql = 'UPDATE admon SET contraseña = ? WHERE idAdmon = ?';
        $params = array($hash, $_SESSION['idAdmon']);
        return Database::executeRow($sql, $params);
    }

    public function setDarkMode()
    {
        $sql = 'UPDATE usuario SET modo = \'dark\' WHERE idUsuario = ?';
        $params = array($_SESSION['idusuario']);
        return Database::executeRow($sql, $params);
    }

    public function setLightMode()
    {
        $sql = 'UPDATE usuario SET modo = \'light\' WHERE idUsuario = ?';
        $params = array($_SESSION['idusuario']); 
        return Database::executeRow($sql, $params);
    }

    public function readProfile()
    {
        $sql = 'SELECT idAdmon, nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, direccion, usuario, contraseña, idEstadoUsuario, idTipoUsuario
        FROM admon
        WHERE idAdmon = ?';
        $params = array($_SESSION['idAdmon']);
        return Database::getRow($sql, $params);
    }

    public function updateProfileInfo($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->foto) ? $this->deleteFile($this->getRuta(), $current_image) : $this->foto = $current_image;

        $sql = 'UPDATE admon
                SET foto = ?, nombre = ?, apellido = ?, genero = ?, fechaNacimiento = ?, telefono = ?, direccion = ?
                WHERE idAdmon = ?';
        $params = array($this->foto, $this->nombre, $this->apellido, $this->genero, $this->fechaNacimiento, $this->telefono,$this->direccion, $_SESSION['idAdmon']);
        return Database::executeRow($sql, $params);
    }

    public function updateProfileAccount()
    {
        $sql = 'UPDATE admon
                SET usuario = ?, correo = ?
                WHERE idAdmon = ?';
        $params = array($this->usuario, $this->correo, $_SESSION['idAdmon']);
        return Database::executeRow($sql, $params);
    }

    //Función para buscar
    public function searchRows($value)
    {
        $sql = 'SELECT idAdmon, nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, direccion, usuario, contraseña, estadoUsuario, tipoUsuario
        FROM admon
        INNER JOIN estadoUsuario ON estadoUsuario.idEstadoUsuario = admon.idEstadoUsuario
        INNER JOIN tipoUsuario ON tipoUsuario.idTipoUsuario = admon.idTipoUsuario
        WHERE apellido ILIKE ? OR nombre ILIKE ? OR usuario ILIKE ?
        ORDER BY apellido';
        $params = array("%$value%", "%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    //Método para crear un nuevo registro
    public function createRow()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->contrasenia, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO usuario(idEstadoUsuario, idTipoUsuario, nombre, apellido, telefonoFijo, 
                telefonoCelular, foto,correo, fechaNacimiento, genero, dui,username, contrasena,direccion)
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $params = array($this->idEstadoUsuario, $this->idTipoUsuario, $this->nombre, $this->apellido, $this->telefonoFijo, 
                        $this->telefonoCelular, $this->foto, $this->correo, $this->fechaNacimiento, $this->genero,
                        $this->dui, $this->username, $hash, $this->direccion);
        return Database::executeRow($sql, $params);
    }

    //Métodos para obtener valores
    public function readAll(){
        $sql = 'SELECT idUsuario, estadoUsuario, tipoUsuario, nombre, apellido, telefonoFijo, telefonoCelular, foto, correo,  fechaNacimiento, genero, dui, username, contrasena, direccion
        FROM usuario
        INNER JOIN estadoUsuario ON estadoUsuario.idEstadoUsuario = usuario.idEstadoUsuario
        INNER JOIN tipoUsuario ON tipoUsuario.idTipoUsuario = usuario.idTipoUsuario
        ORDER BY apellido';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT idAdmon, nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, direccion, usuario, contraseña, idEstadoUsuario, idTipoUsuario
        FROM admon
        WHERE idAdmon = ?';
        $params = array($this->idAdmon);
        return Database::getRow($sql, $params);
    }

    //Métodos para obtener tipos de usuario
    public function readAllTipos(){
        $sql = 'SELECT * FROM tipoUsuario';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function updateRow($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->foto) ? $this->deleteFile($this->getRuta(), $current_image) : $this->foto = $current_image;

        $sql = 'UPDATE admon
                SET foto = ?, nombre = ?, apellido = ?, genero = ?, correo = ?, fechaNacimiento = ?, telefono = ?, direccion = ?, usuario = ?, idTipoUsuario = ?
                WHERE idAdmon = ?';
        $params = array($this->foto, $this->nombre, $this->apellido, $this->genero, $this->correo, $this->fechaNacimiento, $this->telefono,$this->direccion, $this->usuario, $this->idTipoUsuario, $this->idAdmon);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow(){
        $sql = 'DELETE FROM admon WHERE idAdmon = ?';
        $params = array($this->idAdmon);
        return Database::executeRow($sql, $params);
    }

    public function suspenderRow(){
        $sql = 'UPDATE admon SET idEstadoUsuario = 2 WHERE idAdmon = ?';
        $params = array($this->idAdmon);
        return Database::executeRow($sql, $params);
    }

    public function activarRow(){
        $sql = 'UPDATE admon SET idEstadoUsuario = 1 WHERE idAdmon = ?';
        $params = array($this->idAdmon);
        return Database::executeRow($sql, $params);
    }
    }
?>