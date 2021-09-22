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
    public function validarCodigo($table)
    {
        // Declaramos la sentencia que enviaremos a la base con el parametro del nombre de la tabla (dinamico)
        $sql = "SELECT correo from $table where codigo = ? and idusuario = ?";
        // Enviamos los parametros
        $params = array($this->codigo,$_SESSION['idusuario']);
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


}


?>

