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
    private $cantidadStock = null;

    //Variables para la tabla de detallematerial
    private $idDetalleMaterial = null;
    private $precioMaterial = null;
    private $cantidadMaterial = null;


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

    public function setCantidadStock($value)
    {
        $this->cantidadStock = $value;
        return true;
    }

    public function setIdDetalleMaterial($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idDetalleMaterial = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setPrecioMaterial($value)
    {
        if ($this->validateMoney($value)) {
            $this->precioMaterial = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCantidadMaterial($value)
    {
        $this->cantidadMaterial = $value;
        return true;
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

    public function getCantidadStock()
    {
        return $this -> cantidadStock;
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

    public function getIdDetalleMaterial()
    {
        return $this -> idDetalleMaterial;
    }

    public function getPrecioMaterial()
    {
        return $this -> precioMaterial;
    }

    public function getCantidadMaterial()
    {
        return $this -> cantidadMaterial;
    }

    public function readAll()
    {
        $sql = 'SELECT CONCAT(empleado.nombre,\' \',empleado.apellido) AS empleado, estadopedido.estadopedido, idpedido, fechapedido FROM pedido
        INNER JOIN empleado ON pedido.idempleado = empleado.idempleado
        INNER JOIN estadopedido ON pedido.idestadopedido = estadopedido.idestadopedido';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readByState()
    {
        $sql = 'SELECT CONCAT(empleado.nombre,\'  \',empleado.apellido) AS empleado, estadopedido.estadopedido, idpedido, fechapedido FROM pedido
                INNER JOIN empleado ON pedido.idempleado = empleado.idempleado
                INNER JOIN estadopedido ON pedido.idestadopedido = estadopedido.idestadopedido
                WHERE estadopedido.idestadopedido = ?;';
        $params = array($this->idEstadoPedido);
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT estadopedido.estadopedido, CONCAT(empleado.nombre,\' \',empleado.apellido) as empleado FROM pedido
        INNER JOIN estadopedido ON pedido.idestadopedido = estadopedido.idestadopedido
        INNER JOIN empleado ON pedido.idempleado = empleado.idempleado
        WHERE idpedido = ?';
        $params = array($this->idPedido);
        return Database::getRow($sql, $params);
    }

    public function cancelOrder()
    {
        $sql = 'UPDATE pedido SET idestadopedido = 4 WHERE idPedido = ?';
        $params = array($this->idPedido);
        return Database::executeRow($sql, $params);
    }

    public function confirmOrder()
    {
        $sql = 'UPDATE pedido SET idestadopedido = 3 WHERE idPedido = ?';
        $params = array($this->idPedido);
        return Database::executeRow($sql, $params);
    }

    public function readStates()
    {
        $sql = 'SELECT*FROM estadopedido WHERE idestadopedido<>1';
        $params = null;
        return Database::getRows($sql,$params);
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

    public function checkIfThereIsAnActiveOrder(){
        $sql = 'SELECT*FROM pedido WHERE idestadopedido = 1 AND idusuario = ?';
        $params = array($_SESSION['idusuario']);
        return Database::getRow($sql, $params);
    }

    public function getOrder()
    {
        $sql = 'SELECT iddetallematerial, material.idmaterial, material.nombreproducto, (preciomaterial*cantidadmaterial) as totalUnidad, preciomaterial, cantidadmaterial FROM detallematerial
                INNER JOIN material ON detallematerial.idmaterial = material.idmaterial
                WHERE idpedido = ?';
        $params = array($this->idPedido);
        return Database::getRows($sql, $params);
    }

    public function getTotalPrice()
    {
        $sql = 'SELECT sum (preciomaterial*cantidadmaterial) as total FROM detallematerial WHERE idpedido = ?';
        $params = array($this->idPedido);
        return Database::getRow($sql, $params);
    }

    public function createOrder()
    {
        $sql = 'INSERT INTO pedido (idestadopedido, idusuario, fechapedido) 
                VALUES (1, ?, current_date)';
        $params = array($_SESSION['idusuario']);
        return Database::executeRow($sql, $params);
    }

    public function addMaterial()
    {
        $sql = 'INSERT INTO detallematerial(idpedido, idmaterial, preciomaterial, cantidadmaterial) 
                VALUES (?,?,?,?)';
        $params = array($this->idPedido, $this->idMaterial, $this->precioMaterial, $this->cantidadMaterial);
        return Database::executeRow($sql, $params);
    }

    public function noDuplicatedData()
    {
        $sql = 'SELECT*FROM detallematerial WHERE idpedido = ? AND idmaterial = ?';
        $params = array($this->idPedido, $this->idMaterial);
        return Database::getRow($sql, $params);
    }

    public function readEmployees()
    {
        $sql = 'SELECT idempleado, CONCAT(nombre,\' \',apellido) as empleado FROM empleado';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function sendOrder()
    {
        $sql = 'UPDATE pedido SET idempleado = ?, idestadopedido = 2 WHERE idpedido = ?';
        $params = array($this->idEmpleado,$this->idPedido);
        return Database::executeRow($sql, $params);
    }

    public function updateMaterialStock()
    {
        $newstock = $this->cantidadStock - $this->cantidadMaterial;
        $sql = 'UPDATE material SET cantidad = ? WHERE idMaterial = ?';
        $params = array($newstock, $this->idMaterial);
        return Database::executeRow($sql, $params);
    }

    public function restoreMaterialStock()
    {
        $newstock = $this->cantidadStock + $this->cantidadMaterial;
        $sql = 'UPDATE material SET cantidad = ? WHERE idMaterial = ?';
        $params = array($newstock, $this->idMaterial);
        return Database::executeRow($sql, $params);
    }

    public function deleteMaterial()
    {
        $sql = 'DELETE FROM detallematerial WHERE iddetallematerial = ?';
        $params = array($this->idDetalleMaterial);
        return Database::executeRow($sql, $params);
    }

    public function updateStock($cantidad)
    {
        $sql = 'UPDATE material SET cantidad = ? WHERE idMaterial = ?';
        $params = array($cantidad, $this->idMaterial);
        return Database::executeRow($sql,$params);
    }

    public function updateOrderStock($cantidad)
    {
        $sql = 'UPDATE detallematerial SET cantidadmaterial = ? WHERE iddetallematerial = ?';
        $params = array($cantidad, $this->idDetalleMaterial);
        return Database::executeRow($sql,$params);
    }

    public function registerAction($action, $desc)
    {
        $sql = 'INSERT INTO bitacora VALUES (DEFAULT, ?, current_time, current_date, ?, ?)';
        $params = array($_SESSION['idusuario'],$action, $desc);
        return Database::executeRow($sql, $params);
    }

    
 }
?>