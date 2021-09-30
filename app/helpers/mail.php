<?php 


class Correo extends Validator
{
    // Declaración de atributos (propiedades).
    private $correo = null;
    private $codigo = null;

    /*
    *   Métodos para asignar valores a los atributos.
    */
    public function setCodigo($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->codigo = $value;
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

 
    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getCorreo()
    {
        return $this->correo;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    // Metodo para actualizar el codigo de confirmacion de un usuario
    public function validarCorreo($table)
    {
        // Declaramos la sentencia que enviaremos a la base con el parametro del nombre de la tabla (dinamico)
        $sql = "SELECT correo from $table where correo = ?";
        // Enviamos los parametros
        $params = array($this->correo);
        return Database::getRow($sql, $params);
    }

    // Metodo para actualizar el codigo de confirmacion de un usuario
    public function validarCodigo($table,$id)
    {
        // Declaramos la sentencia que enviaremos a la base con el parametro del nombre de la tabla (dinamico)
        $sql = "SELECT correo from $table where codigo = ? and idusuario = ?";
        // Enviamos los parametros
        $params = array($this->codigo,$id);
        return Database::getRow($sql, $params);
    }

     // Metodo para actualizar el codigo de confirmacion de un residente
     public function validarCodigoResidente($table,$id)
     {
         // Declaramos la sentencia que enviaremos a la base con el parametro del nombre de la tabla (dinamico)
         $sql = "SELECT correo from $table where codigo = ? and idresidente = ?";
         // Enviamos los parametros
         $params = array($this->codigo,$id);
         return Database::getRow($sql, $params);
     }

    // Metodo para actualizar el codigo de confirmacion de un usuario
    public function actualizarCodigo($table,$codigo)
    {
        // Declaramos la sentencia que enviaremos a la base con el parametro del nombre de la tabla (dinamico)
        $sql = "UPDATE $table set codigo = ? where correo = ?";
        // Enviamos los parametros
        $params = array($codigo, $this->correo);
        return Database::executeRow($sql, $params);
    }

    //Metodo para actualizar el campo de verificacion en la tabla de residentes
    public function validateUsuario ($idUsuario)
    {
        $sql = 'UPDATE usuario SET verificado = \'1\' WHERE idusuario = ?';
        $params = array($idUsuario);
        return Database::executeRow($sql, $params);
    }

    //Metodo para actualizar el campo de verificacion en la tabla de residentes
    public function validateResidente($idResidente)
    {
        $sql = 'UPDATE residente SET verificado = \'1\' WHERE idresidente = ?';
        $params = array($idResidente);
        return Database::executeRow($sql, $params);
    }

    public function obtenerUsuario($correo)
    {
        // Creamos la sentencia SQL que contiene la consulta que mandaremos a la base
        $sql = 'SELECT nombre,idusuario FROM usuario WHERE correo = ?';
        $params = array($correo);
        if ($data = Database::getRow($sql, $params)) {
            $_SESSION['usuario'] = $data['nombre']; 
            $_SESSION['idusuario'] = $data['idusuario'];                                                                                      
                                                                                     
            return true;
        } else {
            return false;
        }
    }

    public function obtenerResidente($correo)
    {
        // Creamos la sentencia SQL que contiene la consulta que mandaremos a la base
        $sql = 'SELECT nombre,idresidente FROM residente WHERE correo = ?';
        $params = array($correo);
        if ($data = Database::getRow($sql, $params)) {
            $_SESSION['residente'] = $data['nombre']; 
            $_SESSION['idresidenterecu'] = $data['idresidente'];                                                                                      
                                                                                     
            return true;
        } else {
            return false;
        }
    }


    // Metodo para actualizar el codigo de confirmacion de un usuario
    public function cleanCode($id)
    {
        // Declaramos la sentencia que enviaremos a la base con el parametro del nombre de la tabla (dinamico)
        $sql = "UPDATE usuario set codigo = null where idusuario = ?";
        // Enviamos los parametros
        $params = array($id);
        return Database::executeRow($sql, $params);
    }

    // Metodo para actualizar el codigo de confirmacion de un usuario
    public function cleanCodeResidente($id)
    {
        // Declaramos la sentencia que enviaremos a la base con el parametro del nombre de la tabla (dinamico)
        $sql = "UPDATE residente set codigo = null where idresidente = ?";
        // Enviamos los parametros
        $params = array($id);
        return Database::executeRow($sql, $params);
    }


}


?>

