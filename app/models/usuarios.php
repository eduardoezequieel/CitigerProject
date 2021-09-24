<?php

//Clase para manejar la tabla de usuarios
class Usuarios extends Validator
{
    //Declarando atributos
    private $idUsuario = null;
    private $idEstadoUsuario = null;
    private $idPermiso = null;
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
    private $bitacora = null;
    private $tipousuario = null;

    /*
        Creando métodos set
    */
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idUsuario = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdPermiso($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idPermiso = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdBitacora($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->bitacora = $value;
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

    public function setTipoUsuario($value)
    {
        if ($this->validateAlphabetic($value, 1, 15)) {
            $this->tipousuario = $value;
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
        if ($this->validateImageFile($file, 5000, 5000)) {
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

    /*
        Creando métodos get
    */    

    public function getId()
    {
        return $this->idUsuario;
    }

    public function getBitacora()
    {
        return $this->bitacora;
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

    //Obtener tipos de usuario
    public function readTypesOfUser()
    {
            $sql = 'SELECT idtipousuario, tipousuario, COUNT(permitido) FILTER (WHERE permitido = \'1\') AS permisos 
                    FROM permisousuario 
                    INNER JOIN tipousuario USING (idtipousuario)
                    WHERE idtipousuario <> 1
                    GROUP BY tipousuario, idtipousuario';
        $params = null;
        return Database::getRows($sql, $params);    
    }

    //Obtener los permisos de un tipo de usuario
    public function getPermissionsOfAType()
    {
        $sql = 'SELECT*FROM permisousuario WHERE idtipousuario = ?';
        $params = array($this->idTipoUsuario);
        return Database::getRows($sql, $params);
    }

    //Función para buscar tipos de usuario
    public function searchTypesOfUser($value)
    {
        $sql = 'SELECT idtipousuario, tipousuario, COUNT(permitido) FILTER (WHERE permitido = \'1\') AS permisos 
            FROM permisousuario 
            INNER JOIN tipousuario USING (idtipousuario)
            WHERE tipousuario ILIKE ? AND idtipousuario <> 1
            GROUP BY tipousuario, idtipousuario';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    //Funcion para obtener la preferencia del usuario con la autenticacion
    public function getAuthMode()
    {
        $sql = 'SELECT autenticacion FROM usuario WHERE idusuario = ?';
        $params = array($this->idUsuario);
        return Database::getRow($sql, $params);
    }

    //Funcion para actualizar la preferencia del usuario con la autenticacion.
    public function updateAuthMode($auth)
    {
        $sql = 'UPDATE usuario SET autenticacion = ? WHERE idusuario = ?';
        $params = array($auth, $this->idUsuario);
        return Database::executeRow($sql, $params);
    }

    //Función para verificar el tipo de usuario que quiere ingresar
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

    //Función para verificar si la contraseña es correcta
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

    //Función para cambiar la contraseña
    public function changePassword()
    {
        $hash = password_hash($this->contrasenia, PASSWORD_DEFAULT);
        $sql = 'UPDATE usuario SET contrasena = ? WHERE idusuario = ?';
        $params = array($hash, $this->idUsuario);
        return Database::executeRow($sql, $params);
    }

    //Función para setear el dark mode
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

    //Función para leer la información de usuario logueado
    public function readProfile()
    {
        $sql = "SELECT idUsuario, nombre, apellido, CONCAT(nombre,' ',apellido) as nombres,dui, genero, correo, foto, fechaNacimiento, telefonofijo, telefonocelular, direccion, username, contrasena, idEstadoUsuario, idTipoUsuario
        FROM usuario
        WHERE idusuario = ?";
        $params = array($_SESSION['idusuario_dashboard']);
        return Database::getRows($sql, $params);
    }

    //Función para leer la información de usuario logueado
    public function readProfile2()
    {
        $sql = "SELECT idUsuario, nombre, apellido, CONCAT(nombre,' ',apellido) as nombres,dui, genero, correo, foto, fechaNacimiento, telefonofijo, telefonocelular, direccion, username, contrasena, idEstadoUsuario, idTipoUsuario
        FROM usuario
        WHERE idusuario = ?";
        $params = array($this->idUsuario);
        return Database::getRow($sql, $params);
    }

    //Función para cambiar la foto
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

    //Función para cambiar la foto cuando el usuario es tipo caseta
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

    //Funcion para insertar tipos de usuario
    public function addType()
    {
        $sql = 'INSERT INTO tipousuario(tipousuario) VALUES(?)';
        $params = array($this->tipousuario);
        return Database::executeRow($sql, $params);
    }

    //Funcion para actualizar un tipo de usuario
    public function updateType()
    {
        $sql = 'UPDATE tipousuario SET tipousuario = ? WHERE idtipousuario = ?';
        $params = array($this->tipousuario, $this->idTipoUsuario);
        return Database::executeRow($sql, $params);
    }

    //Función para obtener la información de un tipo de usuario previamente ingresado
    public function getType($value)
    {
        $sql = 'SELECT*FROM tipousuario WHERE tipousuario = ?';
        $params = array($value);
        return Database::getRow($sql, $params);
    }

    //Funcion para insertar los permisos al momento de crear un tipo de usuario
    public function createPermissions()
    {   $retorno = null;
        for ($i=1; $i <= 6; $i++) { 
            $sql = 'INSERT INTO permisousuario(idtipousuario, idpermiso, permitido)
                    VALUES (?,?,?)';
            $params = array($this->idTipoUsuario, $i, 0);

            if (Database::executeRow($sql, $params)) {
                $retorno = true;
            } else {
                $retorno = Database::getException();
            }
        }
        return $retorno;
    }

    //Función para obtener los id de los permisos
    public function getPermissions()
    {
        $sql = 'SELECT idpermiso FROM permiso';
        $params = null;
        return Database::getRows($sql, $params);    
    }

    //Funcion para actualizar los permisos de un tipo de usuario
    public function updatePermission($array, $permisos)
    {
        $retorno = null;
        for ($i=0; $i <= 5 ; $i++) { 
            $idpermiso = (int)$permisos[$i];
            $permitido = (int)$array[$i];
            $sql = 'UPDATE permisousuario SET permitido = ? WHERE idtipousuario = ? AND idpermiso = ?';
            $params = array($permitido, $this->idTipoUsuario, $idpermiso);
            if (Database::executeRow($sql, $params)) {
                $retorno = true;
            } else {
                $retorno = Database::getException();
            }
        }

        return $retorno;
    }

    //Metodo para eliminar los permisos de un tipo de usuario
    public function deletePermissions()
    {
        $sql = 'DELETE FROM permisousuario WHERE idtipousuario = ?';
        $params = array($this->idTipoUsuario);
        return Database::executeRow($sql, $params);
    }

    //Metodo para eliminar un tipo de usuario
    public function deleteType()
    {
        $sql = 'DELETE FROM tipousuario WHERE idtipousuario = ?';
        $params = array($this->idTipoUsuario);
        return Database::executeRow($sql, $params);
    }

    //Función para actualizar la información del usuario logueado
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
                telefonoCelular, foto,correo, fechaNacimiento, genero, dui,username, contrasena,direccion,modo,intentos)
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,\'light\',?)';
        $params = array(
            $this->idEstadoUsuario, $this->idTipoUsuario, $this->nombre, $this->apellido, $this->telefonoFijo,
            $this->telefonoCelular, $this->foto, $this->correo, $this->fechaNacimiento, $this->genero,
            $this->dui, $this->username, $hash, $this->direccion,0
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

    //Función para leer todos los registros de la tabla usuario
    public function readAll()
    {
        $sql = 'SELECT*FROM usuario';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Función para leer los datos del usuario logueado cuando es diferente a caseta
    public function readAllSCRUD()
    {
        $sql = "SELECT u.idusuario, u.foto, Concat(u.nombre,' ',u.apellido) as nombre, u.dui, u.telefonofijo,e.estadousuario
                from usuario u
                inner join estadousuario e on u.idestadousuario=e.idestadousuario where u.idusuario<> ? 
                order by u.apellido";
        $params = array($_SESSION['idusuario_dashboard']);
        return Database::getRows($sql, $params);
    }

    //Función para buscar tabla
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

    //Función para leer los datos de un usuario
    public function readOne()
    {
        $sql = "SELECT idusuario, idestadousuario, idtipousuario, nombre, apellido, telefonofijo, telefonocelular, foto, correo, fechanacimiento, genero, dui, username, contrasena, direccion
                FROM usuario where idusuario=?";
        $params = array($this->idUsuario);
        return Database::getRow($sql, $params);
    }

    //Función para actualizar un registro
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

    //Función para buscar usuario por tipo
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

    //Función para registrar la acción de un usuario
    public function registerAction($action, $desc)
    {
        $sql = 'INSERT INTO bitacora VALUES (DEFAULT, ?, current_time, current_date, ?, ?)';
        $params = array($_SESSION['idusuario_dashboard'], $action, $desc);
        return Database::executeRow($sql, $params);
    }

    //Función para verificar los intentos fallidos
    public function checkIntentos() 
    {
        $sql = 'SELECT intentos FROM usuario WHERE idusuario = ?';
        $params = array($this->idUsuario);
        return Database::getRow($sql,$params);
    }

    //Función para registrar la acción de un usuario no logueado
    public function registerActionOut($action,$desc) 
    {
        $sql = 'INSERT INTO bitacora VALUES (DEFAULT, ?, current_time, current_date, ?, ?)';
        $params = array($this->idUsuario,$action,$desc);
        return Database::executeRow($sql,$params);
    }

    //Función para aumentar el valor de los intentos fallidos
    public function increaseIntentos($intentos)
    {
        $sql = 'UPDATE usuario SET intentos = ? WHERE idusuario = ?';
        $params = array($intentos, $this->idUsuario);
        return Database::executeRow($sql,$params);
    }

    //Función para verificar usuarios bloqueados
    public function checkBlockUsers()
    {
        $sql = 'SELECT idbitacora, idusuario FROM bitacora 
                WHERE accion = \'Bloqueo\' AND
                fecha = current_date - 1 AND current_time >= hora
                OR accion = \'Bloqueo\' AND fecha <= current_date - 2';
        $params = null;
        return Database::getRows($sql,$params);
    }

    //Función para actualizar la bitacora con el id
    public function updateBitacoraOut($act)
    {
        $sql = 'UPDATE bitacora SET accion = ?, fecha = current_date, hora = current_time 
                WHERE idbitacora = ?';
        $params = array($act,$this->bitacora);
        return Database::executeRow($sql,$params);
    }

    //Función para generara contraseña
    public function generatePassword() 
    {
        $contraseña = random_bytes(4);
        $contraseña = bin2hex($contraseña);
        $contraseñaFinal ='CS'.$contraseña.'*';
        return $contraseñaFinal;
    }

    //Función para verificar 90 días desde la ultima actualización
    public function checkLastPasswordUpdate()
    {
        $sql = 'SELECT idbitacora FROM bitacora
                WHERE accion = ?
                AND fecha < current_date - 90
                AND idusuario = ?';
        $params = array('Cambio de clave',$this->idUsuario);
        return Database::getRow($sql,$params);
    }

    //Función para leer los datos de un usuario
    public function readOneId()
    {
        $sql = "SELECT idusuario
                FROM usuario where correo=?";
        $params = array($this->correo);
        return Database::getRow($sql, $params);
    }

    //Función para obtener el id de la bitacora
    public function getIdBitacora($act) {
        $sql = "SELECT idbitacora
                FROM bitacora where idusuario=? AND accion = ?";
        $params = array($this->idUsuario,$act);
        return Database::getRow($sql, $params);
    }
}
