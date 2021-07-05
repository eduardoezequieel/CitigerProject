<?php

class Denuncias extends Validator
{
    private $idDenuncia = null;
    private $idEmpleado = null;
    private $idResidente = null;
    private $idTipoDenuncia = null;
    private $idEstadoDenuncia = null;
    private $fecha = null;
    private $descripcion = null;
    private $respuesta = null;

    //Funciones set    

    public function setIdDenuncia($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idDenuncia= $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdEmpleado($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idEmpleado= $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdResidente($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idResidente= $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdTipoDenuncia($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idTipoDenuncia= $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdEstadoDenuncia($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idEstadoDenuncia= $value;
            return true;
        } else {
            return false;
        }
    }

    public function setFecha($value)
    {
        if ($this->validateDate($value)) {
            $this->fecha = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDescripcion($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->descripcion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setRespuesta($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->respuesta = $value;
            return true;
        } else {
            return false;
        }
    }

    //Funciones get

    public function getIdDenuncia()
    {
        return $this->idDenuncia;
    }

    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }

    public function getIdResidente()
    {
        return $this->idResidente;
    }

    public function getIdTipoDenuncia()
    {
        return $this->idTipoDenuncia;
    }

    public function getIdEstadoDenuncia()
    {
        return $this->idEstadoDenuncia;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getRespuesta()
    {
        return $this->respuesta;
    }

    //Sentencias SQL

    public function readAll()
    {
        $sql = 'SELECT idDenuncia, empleado.nombre, tipodenuncia.tipodenuncia, estadodenuncia.estadodenuncia, fecha, descripcion
            FROM denuncia 
            INNER JOIN estadodenuncia ON denuncia.idestadodenuncia = estadodenuncia.idestadodenuncia
            INNER JOIN residente ON denuncia.idresidente = residente.idresidente
            INNER JOIN tipodenuncia ON denuncia.idtipodenuncia = tipodenuncia.idtipodenuncia
            INNER JOIN empleado ON denuncia.idempleado = empleado.idempleado
            Where idresidente = ?
            ORDER BY fecha ASC';
            
        $params = ARRAY($_SESSION['idresidente']);
        return Database::getRows($sql, $params);
    }

    //Lee un registro de la tabla
    public function readOne()
    {
        $sql = 'SELECT idDenuncia, tipodenuncia.tipodenuncia, estadodenuncia.estadodenuncia, fecha
        FROM denuncia
        WHERE idDenuncia = ?
        ORDER BY fecha ASC';
        $params = array($this->idDenuncia);
        return Database::getRow($sql, $params);
    }

    //Función para buscar
    public function searchRows($value)
    {
        $sql = 'SELECT idDenuncia, tipodenuncia.tipodenuncia , estadodenuncia.estadodenuncia, fecha
        FROM visita 
        WHERE fecha ILIKE ?
        ORDER BY fecha ASC';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    //Crear registro de denuncia
    public function createRow()
    {
        $sql = 'INSERT INTO denuncia(idresidente, idtipodenuncia, idestadodenuncia, fecha, descripcion) 
        VALUES
        (?,?,?,?,?)';
        $params = array($this->idResidente, 
                        $this->idTipoDenuncia,
                        $this->idEstadoDenuncia, 
                        $this->fecha, 
                        $this->descripcion);
        return Database::executeRow($sql, $params);
    }

    //Carga datos para el select cbResidente
    public function readResident()
    {
        $sql='SELECT idresidente, CONCAT(nombre,\' \', apellido) AS nombre FROM residente';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Carga datos para el select cbEstadoDenuncia
    public function readComplaintStatus()
    {
        $sql='SELECT * FROM estadodenuncia';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Carga datos para el select cbTipoDenuncia
    public function readComplaintType()
    {
        $sql='SELECT * FROM tipodenuncia';
        $params = null;
        return Database::getRows($sql, $params);
    }
}

?>