<?php

//Clase para manejar la tabla de usuarios
class Usuarios extends Validator
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
        if ($this->validateAlphabetic($value, 1, 25)) {
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setModo($value)
    {
        if ($this->validateAlphabetic($value, 1, 25)) {
            $this->modo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellidos($value)
    {
        if ($this->validateAlphabetic($value, 1, 25)) {
            $this->apellido = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setGenero($value)
    {
        if ($this->validateAlphabetic($value, 1, 10)) {
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
        if ($this->validateString($value, 1, 200)) {
            $this->direccion = $value;
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

    public function getId()
    {
        return $this->idUsuario;
    }

    public function getNombres()
    {
        return $this->nombre;
    }

    public function getApellidos()
    {
        return $this->apellido;
    }

    public function getModo()
    {
        return $this->modo;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    public function getNacimiento()
    {
        return $this->fechaNacimiento;
    }

    public function getTelefonoFijo()
    {
        return $this->telefonoFijo;
    }

    public function getTelefonoCelular()
    {
        return $this->telefonoCelular;
    }

    public function getDui()
    {
        return $this->dui;
    }
    public function getUsername()
    {
        return $this->username;
    }

    public function getContrasenia()
    {
        return $this->contrasenia;
    }

    public function getIdEstadoUsuario()
    {
        return $this->idEstadoUsuario;
    }

    public function getIdTipoUsuario()
    {
        return $this->idTipoUsuario;
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
            $this->foto = $data['foto'];
            $this->idEstadoUsuario = $data['idestadousuario'];
            $this->username = $data['username'];
            $this->idTipoUsuario = $data['tipousuario'];
            $this->modo = $data['modo'];
            return true;
        } else {
            return false;
        }
    }

    public function checkUserType($num)
    {
        if ($num == 1) {
            $sql = 'SELECT idUsuario,foto,idEstadoUsuario, username,tipoUsuario, modo FROM usuario 
            INNER JOIN tipoUsuario ON tipoUsuario.idTipoUsuario = usuario.idTipoUsuario
            WHERE correo = ? AND tipoUsuario = ? OR correo=? AND tipoUsuario = \'Administrador\'';
        } else {
            $sql = 'SELECT idUsuario,foto,idEstadoUsuario, username,tipoUsuario, modo FROM usuario 
            INNER JOIN tipoUsuario ON tipoUsuario.idTipoUsuario = usuario.idTipoUsuario
            WHERE correo = ? AND tipoUsuario != ? OR correo=? AND tipoUsuario = \'Administrador\'';
        }
        $params = array($this->correo,$this->idTipoUsuario,$this->correo);
        return Database::getRow($sql, $params);
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
        $sql = 'UPDATE usuario SET contrasena = ? WHERE idusuario = ?';
        $params = array($hash, $_SESSION['idusuario_dashboard']);
        return Database::executeRow($sql, $params);
    }

    public function setDarkMode()
    {
        $sql = 'UPDATE usuario SET modo = \'dark\' WHERE idUsuario = ?';
        $params = array($this->idUsuario);
        return Database::executeRow($sql, $params);
    }

    public function setLightMode()
    {
        $sql = 'UPDATE usuario SET modo = \'light\' WHERE idUsuario = ?';
        $params = array($this->idUsuario);
        return Database::executeRow($sql, $params);
    }

    public function readProfile()
    {
        $sql = "SELECT idUsuario, nombre, apellido, CONCAT(nombre,' ',apellido) as nombres,dui, genero, correo, foto, fechaNacimiento, telefonofijo, telefonocelular, direccion, username, contrasena, idEstadoUsuario, idTipoUsuario
        FROM usuario
        WHERE idusuario = ?";
        $params = array($_SESSION['idusuario_dashboard']);
        return Database::getRows($sql, $params);
    }

    public function readProfile2()
    {
        $sql = "SELECT idUsuario, nombre, apellido, CONCAT(nombre,' ',apellido) as nombres,dui, genero, correo, foto, fechaNacimiento, telefonofijo, telefonocelular, direccion, username, contrasena, idEstadoUsuario, idTipoUsuario
        FROM usuario
        WHERE idusuario = ?";
        $params = array($this->idUsuario);
        return Database::getRow($sql, $params);
    }

    public function updateFoto($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->foto) ? $this->deleteFile($this->getRuta(), $current_image) : $this->foto = $current_image;

        $sql = 'UPDATE usuario
                SET foto = ?
                WHERE idusuario = ?';
        $params = array($this->foto, $this->idUsuario);
        if (Database::executeRow($sql, $params)) {
            $_SESSION['foto_dashboard'] = $this->foto;
            return true;
        } else {
            return false;
        }
    }

    public function updateFoto2($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->foto) ? $this->deleteFile($this->getRuta(), $current_image) : $this->foto = $current_image;

        $sql = 'UPDATE usuario
                SET foto = ?
                WHERE idusuario = ?';
        $params = array($this->foto, $this->idUsuario);
        if (Database::executeRow($sql, $params)) {
            $_SESSION['foto_caseta'] = $this->foto;
            return true;
        } else {
            return false;
        }
    }

    public function updateInfo()
    {
        $sql = 'UPDATE usuario
        SET nombre=?, apellido=?, telefonofijo=?, telefonocelular=?, fechanacimiento=?, genero=?, dui=?
        WHERE idusuario=?';
        $params = array($this->nombre, $this->apellido, $this->telefonoFijo, $this->telefonoCelular, $this->fechaNacimiento, $this->genero, $this->dui, $this->idUsuario);
        return Database::executeRow($sql, $params);
    }


    //Método para crear un nuevo registro
    public function createRow()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->contrasenia, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO usuario(idEstadoUsuario, idTipoUsuario, nombre, apellido, telefonoFijo, 
                telefonoCelular, foto,correo, fechaNacimiento, genero, dui,username, contrasena,direccion,modo)
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,\'light\')';
        $params = array(
            $this->idEstadoUsuario, $this->idTipoUsuario, $this->nombre, $this->apellido, $this->telefonoFijo,
            $this->telefonoCelular, $this->foto, $this->correo, $this->fechaNacimiento, $this->genero,
            $this->dui, $this->username, $hash, $this->direccion
        );
        return Database::executeRow($sql, $params);
    }

    //Métodos para obtener valores
    public function readEmployeeTypes()
    {
        $sql = 'SELECT*FROM tipoUsuario';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Método para verificar datos duplicados de la tabla
    public function duplicateRow()
    {
        $sql = 'SELECT * FROM usuario WHERE username = ? or telefonoCelular=? or telefonoFijo=? or correo=? or dui=?';
        $params =  array($this->username, $this->telefonoCelular, $this->telefonoFijo, $this->correo, $this->dui);
        return Database::getRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT*FROM usuario';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readAllSCRUD()
    {
        $sql = "SELECT u.idusuario, u.foto, Concat(u.nombre,' ',u.apellido) as nombre, u.dui, u.telefonofijo,e.estadousuario
                from usuario u
                inner join estadousuario e on u.idestadousuario=e.idestadousuario where u.idusuario<> ? 
                order by u.apellido";
        $params = array($_SESSION['idusuario_dashboard']);
        return Database::getRows($sql, $params);
    }

    public function searchRows($value)
    {
        $sql = "SELECT u.idusuario, u.foto, Concat(u.nombre,' ',u.apellido) as nombre, u.dui, u.telefonofijo,e.estadousuario
                from usuario u
                inner join estadousuario e on u.idestadousuario=e.idestadousuario where Concat(u.nombre,' ',u.apellido) ILIKE ?
                or Concat(u.username,' ',u.dui) ILIKE ? and u.idusuario<> ? 
                order by u.apellido";
        $params = array("%$value%", "%$value%", $_SESSION['idusuario_dashboard']);
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = "SELECT idusuario, idestadousuario, idtipousuario, nombre, apellido, telefonofijo, telefonocelular, foto, correo, fechanacimiento, genero, dui, username, contrasena, direccion
                FROM usuario where idusuario=?";
        $params = array($this->idUsuario);
        return Database::getRow($sql, $params);
    }

    public function updateRow($current_image)
    {

        ($this->foto) ? $this->deleteFile($this->getRuta(), $current_image) : $this->foto = $current_image;

        $sql = 'UPDATE usuario
                SET idtipousuario=?, nombre=?, apellido=?, telefonofijo=?, telefonocelular=?, foto=?, correo=?, fechanacimiento=?, genero=?, dui=?, username=?,direccion=?
                WHERE idusuario=?';
        $params = array(
            $this->idTipoUsuario, $this->nombre, $this->apellido, $this->telefonoFijo,
            $this->telefonoCelular, $this->foto, $this->correo, $this->fechaNacimiento, $this->genero,
            $this->dui, $this->username, $this->direccion, $this->idUsuario
        );
        return Database::executeRow($sql, $params);
    }

    //Eliminar registro de empleado
    public function deleteRow()
    {
        $sql = 'DELETE FROM usuario WHERE idusuario = ?';
        $params = array($this->idUsuario);
        return Database::executeRow($sql, $params);
    }

    //Suspender usuario
    public function suspend()
    {
        $sql = 'UPDATE usuario SET idestadousuario = 2
                WHERE idusuario = ?';
        $params = array($this->idUsuario);
        return Database::executeRow($sql, $params);
    }

    //Activar usuario
    public function activar()
    {
        $sql = 'UPDATE usuario SET idestadousuario = 1
                WHERE idusuario = ?';
        $params = array($this->idUsuario);
        return Database::executeRow($sql, $params);
    }


    public function filterByEmployeeType()
    {
        $sql = "SELECT u.idusuario, u.foto, Concat(u.nombre,' ',u.apellido) as nombre, u.dui, u.telefonofijo,e.estadousuario, t.tipousuario
        from usuario u
        inner join tipousuario t on u.idtipousuario=t.idtipousuario
        inner join estadousuario e on u.idestadousuario=e.idestadousuario where t.idtipousuario=?
        and u.idusuario<> ?
        order by u.apellido";
        $params = array($this->idTipoUsuario, $_SESSION['idusuario_dashboard']);
        return Database::getRows($sql, $params);
    }

    public function registerAction($action, $desc)
    {
        $sql = 'INSERT INTO bitacora VALUES (DEFAULT, ?, current_time, current_date, ?, ?)';
        $params = array($_SESSION['idusuario_dashboard'], $action, $desc);
        return Database::executeRow($sql, $params);
    }
}
