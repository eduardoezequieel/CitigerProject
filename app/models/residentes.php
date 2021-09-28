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
    private $idCasa = null;
    private $modo = null;
    private $idtipoDenuncia = null;
    private $bitacora = null;



    /*
        Metodos set para todas las variables del modelo.
    */

    public function setIdResidente($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idResidente = $value;
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

    public function setModo($value)
    {
        if ($this->validateAlphabetic($value, 1, 25)) {
            $this->modo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdCasa($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idCasa = $value;
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
        if ($this->validateAlphabetic($value, 1, 30)) {
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellido($value)
    {
        if ($this->validateAlphabetic($value, 1, 30)) {
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
        if ($this->validateAlphabetic($value, 1, 10)) {
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

    public function setIdtipoDenuncia($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idtipoDenuncia = $value;
            return true;
        } else {
            return false;
        }
    }

    //Metodos get para las variables del modelo

    public function getIdResidente()
    {
        return $this->idResidente;
    }

    public function getBitacora()
    {
        return $this->bitacora;
    }


    public function getModo()
    {
        return $this->modo;
    }

    public function getIdCasa()
    {
        return $this->idCasa;
    }

    public function getIdEstadoResidente()
    {
        return $this->idEstadoResidente;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getTelefonof()
    {
        return $this->telefonof;
    }

    public function getTelefonom()
    {
        return $this->telefonom;
    }

    public function getDui()
    {
        return $this->dui;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getNacimiento()
    {
        return $this->fechaNacimiento;
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

    public function getIdTipoDenuncia()
    {
        return $this->idtipoDenuncia;
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
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->contrasenia, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO residente(idestadoresidente, nombre, apellido, telefonofijo, telefonocelular, foto, 
            correo, fechanacimiento, genero, dui, username, contrasena, modo,intentos,autenticacion) 
            VALUES
            (?,?,?,?,?,?,?,?,?,?,?,?,\'light\',?,\'No\')';
        $params = array(
            $this->idEstadoResidente,
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
            $hash,0
        );
        return Database::executeRow($sql, $params);
    }

    //Actualizacion de datos
    public function updateRow($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->foto) ? $this->deleteFile($this->getRuta(), $current_image) : $this->foto = $current_image;

        $sql = 'UPDATE residente 
            SET nombre = ?, apellido = ?, telefonofijo = ?, telefonocelular = ?, dui = ?, 
                genero = ?, foto = ?, correo = ?, fechanacimiento = ?, username = ? 
            WHERE idresidente = ?';
        $params = array(
            $this->nombre,
            $this->apellido,
            $this->telefonof,
            $this->telefonom,
            $this->dui,
            $this->genero,
            $this->foto,
            $this->correo,
            $this->fechaNacimiento,
            $this->username,
            $this->idResidente
        );
        return Database::executeRow($sql, $params);
    }

    //Suspender empleado
    public function suspend()
    {
        $sql = 'UPDATE residente SET idestadoresidente = 2
                    WHERE idresidente = ?';
        $params = array($this->idResidente);
        return Database::executeRow($sql, $params);
    }

    //Funcion para saber si un residente posee su correo electronico verificado
    public function checkIfEmailIsValidated()
    {
        $sql = 'SELECT verificado FROM residente WHERE idresidente = ?';
        $params = array($this->idResidente);
        return Database::getRow($sql, $params);
    }

    //Activar empleado
    public function activate()
    {
        $sql = 'UPDATE residente SET idestadoresidente = 1
                    WHERE idresidente = ?';
        $params = array($this->idResidente);
        return Database::executeRow($sql, $params);
    }

    //Funcion para obtener la preferencia del usuario con la autenticacion
    public function getAuthMode()
    {
        $sql = 'SELECT autenticacion FROM residente WHERE idresidente = ?';
        $params = array($this->idResidente);
        return Database::getRow($sql, $params);
    }

    //Funcion para actualizar la preferencia del usuario con la autenticacion.
    public function updateAuthMode($auth)
    {
        $sql = 'UPDATE residente SET autenticacion = ? WHERE idresidente = ?';
        $params = array($auth, $this->idResidente);
        return Database::executeRow($sql, $params);
    }


    //Eliminar registro de empleado
    public function deleteRow()
    {
        $sql = 'DELETE FROM residente WHERE idresidente = ?';
        $params = array($this->idResidente);

        return Database::executeRow($sql, $params);
    }

    //Función para obtener la casa del residente
    public function getCasaResidente()
    {

        $sql = "SELECT rc.idresidentecasa, rc.idresidente, rc.idcasa, CONCAT('#',c.numerocasa,'  ',c.direccion)as casa from residentecasa rc
            INNER JOIN casa c on rc.idcasa=c.idcasa
            where rc.idresidente=?";
        $params = array($this->idResidente);
        return Database::getRow($sql, $params);
    }

    //Función para leer la información de todas las casas
    public function cargarCasas()
    {

        $sql = "SELECT idcasa, numerocasa, direccion from casa";
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Función para buscar casas por su #
    public function searchCasa($value)
    {
        $sql = "SELECT idcasa, numerocasa, direccion from casa where
            CONCAT(numerocasa,' ',direccion) ILIKE ?
            ORDER BY numerocasa ASC";
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    //Función para asignar una casa a un residente
    public function ingresarResidenteCasa()
    {

        $sql = 'INSERT into residentecasa(idresidente,idcasa) values (?,?)';
        $params = array($this->idResidente, $this->idCasa);
        return Database::executeRow($sql, $params);
    }

    //Función para actualizar la casa del residente
    public function updateResidenteCasa()
    {
        $sql = 'UPDATE residentecasa
        SET idcasa=?
        WHERE idresidente=?';
        $params = array($this->idCasa, $this->idResidente);
        return Database::executeRow($sql, $params);
    }

    //Función para llenar bitacora
    public function registerAction($action, $desc)
    {
        $sql = 'INSERT INTO bitacora VALUES (DEFAULT, ?, current_time, current_date, ?, ?)';
        $params = array($_SESSION['idusuario_dashboard'], $action, $desc);
        return Database::executeRow($sql, $params);
    }

    //Función para verificar el residente por su email
    public function checkUser($email)
    {
        $sql = 'SELECT idresidente,foto,idestadoresidente,modo, username FROM residente 
                WHERE correo = ?';
        $params = array($email);
        if ($data = Database::getRow($sql, $params)) {
            $this->idResidente = $data['idresidente'];
            $this->correo = $email;
            $this->foto = $data['foto'];
            $this->idEstadoResidente = $data['idestadoresidente'];
            $this->username = $data['username'];
            $this->modo = $data['modo'];

            return true;
        } else {
            return false;
        }
    }

    //Método para verificar el estado del usuario
    public function checkEstado()
    {
        if ($this->idEstadoResidente == 1) {
            return true;
        } else {
            return false;
        }
    }

    //Función para verificar la contraseña
    public function checkPassword($password)
    {
        $sql = 'SELECT contrasena FROM residente WHERE idresidente = ?';
        $params = array($this->idResidente);
        $data = Database::getRow($sql, $params);
        if (password_verify($password, $data['contrasena'])) {
            return true;
        } else {
            return false;
        }
    }

    //Función para setear el dark mode
    public function setDarkMode()
    {
        $sql = 'UPDATE residente SET modo = \'dark\' WHERE idresidente = ?';
        $params = array($_SESSION['idresidente']);
        return Database::executeRow($sql, $params);
    }

    //Función para setear el light mode
    public function setLightMode()
    {
        $sql = 'UPDATE residente SET modo = \'light\' WHERE idresidente = ?';
        $params = array($_SESSION['idresidente']);
        return Database::executeRow($sql, $params);
    }

    //Función para cambiar contraseña por defecto
    public function changePassword()
    {
        $hash = password_hash($this->contrasenia, PASSWORD_DEFAULT);
        $sql = 'UPDATE residente SET contrasena = ? WHERE idresidente = ?';
        $params = array($hash, $_SESSION['idresidente']);
        return Database::executeRow($sql, $params);
    }

    //Función para cambiar contraseña por defecto
    public function changePasswordOut()
    {
        $hash = password_hash($this->contrasenia, PASSWORD_DEFAULT);
        $sql = 'UPDATE residente SET contrasena = ? WHERE idresidente = ?';
        $params = array($hash, $this->idResidente);
        return Database::executeRow($sql, $params);
    }

    //Función para leer la info del usuario logueado
    public function readProfile()
    {
        $sql = "SELECT idresidente, nombre, apellido, CONCAT(nombre,' ',apellido) as nombres,dui, genero, correo, foto, fechaNacimiento, telefonofijo, telefonocelular, username, contrasena
        FROM residente
        WHERE idresidente = ?";
        $params = array($_SESSION['idresidente']);
        return Database::getRows($sql, $params);
    }

    //Función para leer la info del usuario logueado
    public function readProfile2()
    {
        $sql = "SELECT idresidente, nombre, apellido, CONCAT(nombre,' ',apellido) as nombres,dui, genero, correo, foto, fechaNacimiento, telefonofijo, telefonocelular, username, contrasena
        FROM residente
        WHERE idresidente = ?";
        $params = array($_SESSION['idresidente']);
        return Database::getRow($sql, $params);
    }

    //Función para actualizar la foto
    public function updateFoto($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->foto) ? $this->deleteFile($this->getRuta(), $current_image) : $this->foto = $current_image;

        $sql = 'UPDATE residente
                SET foto = ?
                WHERE idresidente = ?';
        $params = array($this->foto, $_SESSION['idresidente']);
        if (Database::executeRow($sql, $params)) {
            $_SESSION['foto_residente'] = $this->foto;
            return true;
        } else {
            return false;
        }
        
    }

    //Función para actualizar la información del usuario logueado
    public function updateInfo()
    {
        $sql = 'UPDATE residente
        SET nombre=?, apellido=?, telefonofijo=?, telefonocelular=?, fechanacimiento=?, genero=?, dui=?
        WHERE idresidente=?';
        $params = array($this->nombre, $this->apellido, $this->telefonof, $this->telefonof, $this->fechaNacimiento, $this->genero, $this->dui, $_SESSION['idresidente']);
        return Database::executeRow($sql, $params);
    }

    //Función para setear la cabecera del reporte
    public function readReportCabecera()
    {
        $sql = "SELECT Concat(nombre,' ',apellido) as residente, telefonofijo, telefonocelular, idresidente from residente where idresidente=? ";
        $params = array($_SESSION['idresidente']);
        return Database::getRows($sql, $params);  
    }

    //Función para leer los datos del reporte
    public function readReport()
    {
        $sql = 'SELECT d.iddenuncia, t.tipodenuncia, e.estadodenuncia, d.fecha, d.descripcion  from denuncia d
        INNER JOIN tipodenuncia t USING(idtipodenuncia)
        INNER JOIN estadodenuncia e USING(idestadodenuncia)
        WHERE idresidente=? AND idtipodenuncia = ?';
        $params = array($_SESSION['idresidente'],$this->idtipoDenuncia);
        return Database::getRows($sql, $params);
    }

    //Función para leer todos los tipo de denuncia
    public function readTipodenuncia(){

        $sql="SELECT idtipodenuncia, tipodenuncia
        FROM tipodenuncia";
        $params=null;
        return Database::getRows($sql,$params);
    }

    //Función para leer el mes del pago
    public function readMes(){

        $sql="SELECT EXTRACT (month from fechapago) as mes from aportacion where idestadoaportacion=1 group by mes order by mes asc LIMIT 12";
        $params=null;
        return Database::getRows($sql,$params);
    }

    //Función para obtener la información de los residentes que tienen mora
    public function residentesMora(){
        $sql ="SELECT CONCAT(residente.apellido, ', ', residente.nombre) AS residente, 
        CONCAT('#',casa.numerocasa) AS casa, fechapago
        FROM aportacion
        INNER JOIN casa USING(idcasa)
        INNER JOIN residenteCasa USING(idcasa)
        INNER JOIN residente USING(idresidente)
        WHERE fechapago < current_date AND idestadoaportacion = 1 and EXTRACT(YEAR FROM fechapago) = (SELECT EXTRACT(YEAR FROM current_date))  and EXTRACT(month from fechapago)=?";
        $params = array($this->idResidente);
        return Database::getRows($sql, $params);
    }

    //Función para verificar los intentos fallidos
    public function checkIntentos() 
    {
        $sql = 'SELECT intentos FROM residente WHERE idresidente = ?';
        $params = array($this->idResidente);
        return Database::getRow($sql,$params);
    }

    //Función para registrar la acción de un usuario no logueado
    public function registerActionOut($action,$desc) 
    {
        $sql = 'INSERT INTO bitacoraResidente VALUES (DEFAULT, ?, current_time, current_date, ?, ?)';
        $params = array($this->idResidente,$action,$desc);
        return Database::executeRow($sql,$params);
    }

    //Función para aumentar el valor de los intentos fallidos
    public function increaseIntentos($intentos)
    {
        $sql = 'UPDATE residente SET intentos = ? WHERE idresidente = ?';
        $params = array($intentos, $this->idResidente);
        return Database::executeRow($sql,$params);
    }

    //Función para verificar usuarios bloqueados
    public function checkBlockUsers()
    {
        $sql = 'SELECT idbitacora, idresidente FROM bitacoraResidente 
                WHERE accion = \'Bloqueo\' AND
                fecha = current_date - 1 AND current_time >= hora
                OR accion = \'Bloqueo\' AND fecha <= current_date - 2';
        $params = null;
        return Database::getRows($sql,$params);
    }

    public function updateBitacoraOut($act)
    {
        $sql = 'UPDATE bitacoraResidente SET accion = ?, fecha = current_date, hora = current_time
                WHERE idbitacora = ?';
        $params = array($act,$this->bitacora);
        return Database::executeRow($sql,$params);
    }

     //Función para cargar los historiales de sesión fallidos de un usuario
     public function readFailedSessions()
     {
         $sql = 'SELECT hora, fecha, accion 
                 FROM bitacoraResidente 
                 WHERE accion = \'Intento Fallido\' OR accion = \'Bloqueo\' AND idresidente = ?
                 ORDER BY fecha DESC, hora DESC   
                 LIMIT 5';
         $params = array($this->idResidente);
         return Database::getRows($sql, $params);
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
        $sql = 'SELECT idbitacora FROM bitacoraResidente
                WHERE accion = ?
                AND fecha < current_date - 90
                AND idresidente = ?';
        $params = array('Cambio de clave',$this->idResidente);
        return Database::getRow($sql,$params);
    }

    //Función para leer los datos de un usuario
    public function readOneId()
    {
        $sql = "SELECT idresidente
                FROM residente where correo=?";
        $params = array($this->correo);
        return Database::getRow($sql, $params);
    }
    
    //Función para obtener el id de la bitacora
    public function getIdBitacora($act) {
        $sql = "SELECT idbitacora
                FROM bitacoraresidente where idresidente=? AND accion = ?";
        $params = array($this->idResidente,$act);
        return Database::getRow($sql, $params);
    }

    
    public function historialUsuario()
    {
        $sql = 'INSERT INTO historialresidente(
            idhistorial, idresidente, ip, region, sistema, fecha)
            VALUES (default, ?, ?, ?, ?, default)';
        // Creamos la sentencia SQL que contiene la consulta que mandaremos a la base        
        $params = array($_SESSION['idresidente'], $_SESSION['ip_residente'], $_SESSION['region_residente'], $_SESSION['sistema_residente']);
        return Database::executeRow($sql, $params);
    }

    public function checkDevices()
    {
        $sql = 'SELECT * from historialresidente where ip=? and idresidente=?';
        // Creamos la sentencia SQL que contiene la consulta que mandaremos a la base        
        $params = array($_SESSION['ip_residente'], $_SESSION['idresidente']);
        if (Database::getRow($sql, $params)) {
            return true;
        } else {
            return false;
        }
    }

    public function getSesionHistory()
    {
        $sql = 'SELECT*FROM historialresidente WHERE idresidente = ?';
        $params = array($_SESSION['idresidente']);
        return Database::getRows($sql, $params);
    }
}
