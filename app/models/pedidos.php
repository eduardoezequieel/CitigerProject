<?php
 class Pedidos extends Validator{

    //variables para la tabla de pedido
    private $idPedido = null;
    private $idEstadoPedido = null;
    private $idUsuario = null;
    private $idEmpleado = null;
    private $fechaPedido = null;

    //variables para la tabla de materiales
    private $idMaterial = null;

    //Metodos get

    public function setIdPedido($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idPedido = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdMaterial($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idMaterial = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdEstadoPedido($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idEstadoPedido = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdUsuario($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idUsuario = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdEmpleado($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idEmpleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setFechaPedido($value)
    {
        if ($this->validateDate($value)) {
            $this->fechaPedido = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getIdPedido()
    {
        return $this -> idPedido;
    }

    public function getIdMaterial()
    {
        return $this -> idMaterial;
    }

    public function getIdEstadoPedido()
    {
        return $this -> idEstadoPedido;
    }

    public function getIdUsuario()
    {
        return $this -> idUsuario;
    }

    public function getIdEmpleado()
    {
        return $this -> idEmpleado;
    }

    public function getFechaPedido()
    {
        return $this -> fechaPedido;
    }

    public function readAll()
    {
        $sql = 'SELECT CONCAT(empleado.nombre,\' \',empleado.apellido) AS empleado, estadopedido.estadopedido, idpedido FROM pedido
        INNER JOIN empleado ON pedido.idempleado = empleado.idempleado
        INNER JOIN estadopedido ON pedido.idestadopedido = estadopedido.idestadopedido';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readMaterials()
    {
        $sql = 'SELECT idmaterial, imagen, nombreproducto, cantidad FROM material';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOneMaterial()
    {
        $sql = 'SELECT idmaterial, imagen, nombreproducto, marca.marca, cantidad, unidadmedida.unidadmedida, tamaño, costo FROM material
                INNER JOIN marca ON material.idmarca = marca.idmarca
                INNER JOIN unidadmedida ON material.idunidadmedida = unidadmedida.idunidadmedida
                WHERE idmaterial = ?';
        $params = array($this->idMaterial);
        return Database::getRow($sql, $params);
    }
 }
?>