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
    private $ano = null;
    private $idAportacion = null;


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

    public function setAno($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->ano = $value;
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

    public function getAno()
    {
        return $this->ano;
    }

    //Funcion para obtener los meses con sus aportaciones por año
    public function contributionsByYear()
    {
        $sql = 'SELECT idmespago, CONCAT(mes,\' \',ano) as mespago, count(idaportacion) as aportaciones FROM aportacion
                INNER JOIN mespago USING (idmespago)
                WHERE ano = ?
                GROUP BY idmespago, mespago
                ORDER BY idmespago ASC';
        $params = array($this->ano);
        return Database::getRows($sql, $params);
    }

    //Funcion para obtener el porcentaje de aportaciones por estado (De forma mensual);
    public function stateContributions()
    {
        $sql = 'SELECT CONCAT(mes,\' \', ano) as mespago, estadoaportacion, (COUNT(idaportacion) * 100.0) / (SELECT COUNT(idaportacion) FROM aportacion WHERE idmespago = ?) 
                AS porcentajestados
                FROM aportacion
                INNER JOIN estadoaportacion USING(idestadoaportacion)
                INNER JOIN mespago USING (idmespago)
                WHERE idmespago = ?
                GROUP BY mespago, estadoaportacion';
        $params = array($this->idMesPago, $this->idMesPago);
        return Database::getRows($sql, $params);
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


    //Métodos para obtener valores
    public function readAnio()
    {
        $sql = 'SELECT DISTINCT ano FROM mespago where ano<>2021 ORDER BY ano ASC';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function crearAportacion()
    {

        $sql = "INSERT into aportacion(idcasa,idestadoaportacion,monto,idmespago,fechapago,descripcion)VALUES
        (?,1,20,1,'2021-01-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,2,'2021-02-28','Pago usado para mantenimiento de la residencial'),
        (?,1,20,3,'2021-03-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,4,'2021-04-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,5,'2021-05-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,6,'2021-06-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,7,'2021-07-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,8,'2021-08-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,9,'2021-09-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,10,'2021-10-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,11,'2021-11-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,12,'2021-12-31','Pago usado para mantenimiento de la residencial')";
        $params = array($this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa);
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

    public function cancelarAportacion()
    {

        $sql = 'UPDATE aportacion set idestadoaportacion=2 where idaportacion=?';
        $params = array($this->idAportacion);
        return Database::executeRow($sql, $params);
    }

    public function aportacionPendiente()
    {

        $sql = 'UPDATE aportacion set idestadoaportacion=1 where idaportacion=?';
        $params = array($this->idAportacion);
        return Database::executeRow($sql, $params);
    }

    public function filtrarAportacion($value, $value2)
    {
        $sql = "SELECT a.idaportacion, CONCAT(m.mes,' ',m.ano) as mespago,a.monto,fechapago,e.estadoaportacion from aportacion a
        INNER JOIN mespago m on a.idmespago=m.idmespago
        INNER JOIN estadoaportacion e on a.idestadoaportacion=e.idestadoaportacion where a.idcasa=? and m.ano=? ORDER By a.idaportacion ASC";
        $params = array($value, $value2);
        return Database::getRows($sql, $params);
    }

    public function verificarAportacion($value, $value2)
    {
        $sql = "SELECT a.idaportacion, CONCAT(m.mes,' ',m.ano) as mespago,a.monto,fechapago,e.estadoaportacion,a.idestadoaportacion from aportacion a
        INNER JOIN mespago m on a.idmespago=m.idmespago
        INNER JOIN estadoaportacion e on a.idestadoaportacion=e.idestadoaportacion where a.idcasa=? and m.ano=? or a.idestadoaportacion=1 ORDER By a.idaportacion ASC";
        $params = array($value, $value2);
        return Database::getRows($sql, $params);
    }

    public function crearAportacion2022()
    {

        $sql = "INSERT into aportacion(idcasa,idestadoaportacion,monto,idmespago,fechapago,descripcion)VALUES
        (?,1,20,13,'2022-01-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,14,'2022-02-28','Pago usado para mantenimiento de la residencial'),
        (?,1,20,15,'2022-03-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,16,'2022-04-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,17,'2022-05-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,18,'2022-06-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,19,'2022-07-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,20,'2022-08-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,21,'2022-09-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,22,'2022-10-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,23,'2022-11-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,24,'2022-12-31','Pago usado para mantenimiento de la residencial')";
        $params = array($this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa);
        return Database::executeRow($sql, $params);
    }

    public function crearAportacion2023()
    {

        $sql = "INSERT into aportacion(idcasa,idestadoaportacion,monto,idmespago,fechapago,descripcion)VALUES
        (?,1,20,25,'2023-01-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,26,'2023-02-28','Pago usado para mantenimiento de la residencial'),
        (?,1,20,27,'2023-03-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,28,'2023-04-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,29,'2023-05-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,30,'2023-06-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,31,'2023-07-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,32,'2023-08-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,33,'2023-09-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,34,'2023-10-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,35,'2023-11-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,36,'2023-12-31','Pago usado para mantenimiento de la residencial')";
        $params = array($this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa);
        return Database::executeRow($sql, $params);
    }

    public function crearAportacion2024()
    {

        $sql = "INSERT into aportacion(idcasa,idestadoaportacion,monto,idmespago,fechapago,descripcion)VALUES
        (?,1,20,37,'2024-01-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,38,'2024-02-29','Pago usado para mantenimiento de la residencial'),
        (?,1,20,39,'2024-03-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,40,'2024-04-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,41,'2024-05-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,42,'2024-06-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,43,'2024-07-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,44,'2024-08-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,45,'2024-09-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,46,'2024-10-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,47,'2024-11-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,48,'2024-12-31','Pago usado para mantenimiento de la residencial')";
        $params = array($this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa);
        return Database::executeRow($sql, $params);
    }

    public function crearAportacion2025()
    {

        $sql = "INSERT into aportacion(idcasa,idestadoaportacion,monto,idmespago,fechapago,descripcion)VALUES
        (?,1,20,49,'2025-01-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,50,'2025-02-28','Pago usado para mantenimiento de la residencial'),
        (?,1,20,51,'2025-03-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,52,'2025-04-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,53,'2025-05-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,54,'2025-06-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,55,'2025-07-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,56,'2025-08-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,57,'2025-09-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,58,'2025-10-31','Pago usado para mantenimiento de la residencial'),
        (?,1,20,59,'2025-11-30','Pago usado para mantenimiento de la residencial'),
        (?,1,20,60,'2025-12-31','Pago usado para mantenimiento de la residencial')";
        $params = array($this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa, $this->idCasa);
        return Database::executeRow($sql, $params);
    }
}
