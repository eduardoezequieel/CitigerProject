<?php

class Aportaciones extends Validator
{

    private $idCasa = null;
    private $idestadocasa = null;
    private $numeroCasa = null;
    private $direccion = null;

    //Métodos set
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
        $sql = 'SELECT idcasa, numerocasa,idestadocasa, direccion from casa where idcasa=?';
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
}
