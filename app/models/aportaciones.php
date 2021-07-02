<?php
require_once('../../helpers/database.php');

class Aportaciones extends Validator
{

    private $idCasa = null;
    private $idestadocasa = null;
    private $numeroCasa = null;
    private $direccion = null;
    private $mes = null;
    private $idMesPago = null;
    private $idAportacion=null;


    //Métodos set

    public function setIdMespago($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idMesPago = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdAportacion($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idAportacion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setMes($value)
    {
        if ($this->validateString($value, 1, 200)) {
            $this->mes = $value;
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

    public function setIdEstadoCasa($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idestadocasa = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNumeroCasa($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->numeroCasa = $value;
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

    public function getMes()
    {
        return $this->mes;
    }

    public function getMespago()
    {
        return $this->idMesPago;
    }

    public function getIdAportacion()
    {
        return $this->idAportacion;
    }

    public function getId()
    {
        return $this->idCasa;
    }

    public function getIdEstadoCasa()
    {
        return $this->idestadocasa;
    }

    public function getNumeroCasa()
    {
        return $this->numeroCasa;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function createRow()
    {
        $sql = 'INSERT INTO casa(idestadocasa, numerocasa, direccion)
                VALUES(1,?,?)';
        $params = array(
            $this->numeroCasa, $this->direccion
        );
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = "SELECT c.idcasa, CONCAT('#',c.numerocasa,' ',c.direccion) AS casa ,e.estadocasa from casa c, estadocasa e where c.idestadocasa=e.idestadocasa  ORDER BY numerocasa ASC";
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = "SELECT CONCAT('#',numerocasa,' ',direccion) AS casa, idcasa, numerocasa,idestadocasa, direccion from casa where idcasa=?";
        $params = array(
            $this->idCasa
        );
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE casa
        SET numerocasa=?, direccion=?
        WHERE idcasa=? ';
        $params = array(
            $this->numeroCasa, $this->direccion, $this->idCasa
        );
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM casa WHERE idcasa = ?';
        $params = array($this->idCasa);
        return Database::executeRow($sql, $params);
    }

    public function suspend()
    {
        $sql = 'UPDATE casa SET idestadocasa = 2
                WHERE idcasa = ?';
        $params = array($this->idCasa);
        return Database::executeRow($sql, $params);
    }

    public function activar()
    {
        $sql = 'UPDATE casa SET idestadocasa = 1
                WHERE idcasa = ?';
        $params = array($this->idCasa);
        return Database::executeRow($sql, $params);
    }

    //Función para buscar
    public function searchRows($value)
    {
        $sql = "SELECT c.idcasa, CONCAT('#',c.numerocasa,' ',c.direccion) AS casa ,e.estadocasa from casa c, estadocasa e where c.idestadocasa=e.idestadocasa
        and CONCAT(c.numerocasa,' ',c.direccion) ILIKE ?
        ORDER BY numerocasa ASC";
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    public function filterByEmployeeType()
    {
        $sql = "SELECT c.idcasa, CONCAT('#',c.numerocasa,' ',c.direccion) AS casa ,e.estadocasa from casa c, estadocasa e where c.idestadocasa=e.idestadocasa
        and e.idestadocasa=?
        ORDER BY numerocasa ASC";
        $params = array($this->idestadocasa);
        return Database::getRows($sql, $params);
    }


    //Métodos para obtener valores
    public function readEstados()
    {
        $sql = 'SELECT*FROM estadocasa';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function registerAction($action, $desc)
    {
        $sql = 'INSERT INTO bitacora VALUES (DEFAULT, ?, current_time, current_date, ?, ?)';
        $params = array($_SESSION['idusuario'], $action, $desc);
        return Database::executeRow($sql, $params);
    }


    public function crearAportacion()
    {

        $sql = "INSERT into aportacion(idcasa,idestadoaportacion,monto,idmespago,fechapago,descripcion)VALUES
        (?,1,20,1,'2021-06-12','Pago usado para mantenimiento de la residencial'),
        (?,1,20,2,'2021-06-12','Pago usado para mantenimiento de la residencial'),
        (?,1,20,3,'2021-06-12','Pago usado para mantenimiento de la residencial'),
        (?,1,20,4,'2021-06-12','Pago usado para mantenimiento de la residencial'),
        (?,1,20,5,'2021-06-12','Pago usado para mantenimiento de la residencial'),
        (?,1,20,6,'2021-06-12','Pago usado para mantenimiento de la residencial'),
        (?,1,20,7,'2021-06-12','Pago usado para mantenimiento de la residencial'),
        (?,1,20,8,'2021-06-12','Pago usado para mantenimiento de la residencial'),
        (?,1,20,9,'2021-06-12','Pago usado para mantenimiento de la residencial'),
        (?,1,20,10,'2021-06-12','Pago usado para mantenimiento de la residencial'),
        (?,1,20,11,'2021-06-12','Pago usado para mantenimiento de la residencial'),
        (?,1,20,12,'2021-06-12','Pago usado para mantenimiento de la residencial')";
        $params = array($this->idCasa,$this->idCasa,$this->idCasa,$this->idCasa,$this->idCasa,$this->idCasa,$this->idCasa,$this->idCasa,$this->idCasa,$this->idCasa,$this->idCasa,$this->idCasa);
        return Database::executeRow($sql, $params);
    }

    public function readAllParam($value)
    {

        $sql = "SELECT a.idaportacion, CONCAT(m.mes,' ',m.ano) as mespago,a.monto,fechapago,e.estadoaportacion from aportacion a
        INNER JOIN mespago m on a.idmespago=m.idmespago
        INNER JOIN estadoaportacion e on a.idestadoaportacion=e.idestadoaportacion where a.idcasa=? ORDER By a.idaportacion ASC";
        $params = array($value);
        return Database::getRows($sql, $params);
    }

    public function cancelarAportacion(){

        $sql='UPDATE aportacion set idestadoaportacion=2 where idaportacion=?';
        $params = array($this->idAportacion);
        return Database::executeRow($sql, $params);


    }

    public function aportacionPendiente(){

        $sql='UPDATE aportacion set idestadoaportacion=1 where idaportacion=?';
        $params = array($this->idAportacion);
        return Database::executeRow($sql, $params);

    }

    public function filtrarAportacion($value,$value2){
        $sql = "SELECT a.idaportacion, CONCAT(m.mes,' ',m.ano) as mespago,a.monto,fechapago,e.estadoaportacion from aportacion a
        INNER JOIN mespago m on a.idmespago=m.idmespago
        INNER JOIN estadoaportacion e on a.idestadoaportacion=e.idestadoaportacion where a.idcasa=? and m.ano=? ORDER By a.idaportacion ASC";
        $params = array($value,$value2);
        return Database::getRows($sql, $params);

    }


}
