<?php

class Inventario extends Validator
{
    //declarando atributos

    private $idmaterial = null;
    private $nombreMaterial = null;
    private $costo = null;
    private $imagen = null;
    private $idcategoria = null;
    private $tamanio = null;
    private $descripcion = null;
    private $cantidad = null;
    private $idmarca = null;
    private $idunidadmedida = null;
    private $idTipoUnidad = null;
    private $ruta = '../../../resources/img/dashboard_img/materiales_fotos/';

    public function setIdMaterial($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idmaterial = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombres($value)
    {
        if ($this->validateAlphanumeric($value, 1, 25)) {
            $this->nombreMaterial = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCosto($value)
    {
        if ($this->validateMoney($value)) {
            $this->costo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setImagen($file)
    {
        if ($this->validateImageFile($file, 4000, 4000)) {
            $this->imagen = $this->getImageName();
            return true;
        } else {
            return false;
        }
    }

    public function setIdCategoria($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idcategoria = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTamanio($value)
    {
        if ($this->validateAlphanumeric($value, 1, 25)) {
            $this->tamanio = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDescripcion($value)
    {
        if ($this->validateString($value, 1, 200)) {
            $this->descripcion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCantidad($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cantidad = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdMarca($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idmarca = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdUnidadmedida($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idunidadmedida = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdTipo($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idTipoUnidad = $value;
            return true;
        } else {
            return false;
        }
    }

    //metodos get

    public function getIdmaterial()
    {

        return $this->idmaterial;
    }

    public function getNombre()
    {

        return $this->nombreMaterial;
    }

    public function getCosto()
    {

        return $this->costo;
    }

    public function getImagen()
    {

        return $this->imagen;
    }

    public function getIdCategoria()
    {

        return $this->idcategoria;
    }

    public function getTamanio()
    {

        return $this->tamanio;
    }

    public function getDescripcion()
    {

        return $this->descripcion;
    }

    public function getCantidad()
    {

        return $this->cantidad;
    }

    public function getIdmarca()
    {

        return $this->idmarca;
    }

    public function getIdUnidadmedida()
    {

        return $this->idunidadmedida;
    }

    public function getIdTipoUnidad()
    {

        return $this->idTipoUnidad;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    //Consulta para ver los productos mas demandados
    public function topProducts(){
        $sql = 'SELECT nombreproducto, sum(cantidadmaterial) as totalProducto FROM detallematerial
                INNER JOIN material USING (idmaterial)
                GROUP BY nombreproducto
                ORDER BY totalProducto DESC
                LIMIT 5';
        $params = null;
        return Database::getRows($sql, $params);
    }


    public function readTipoUnidad()
    {
        $sql = 'SELECT*FROM tipounidad';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readCategoria()
    {
        $sql = 'SELECT*FROM categoria';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readMarca()
    {
        $sql = 'SELECT*FROM marca';
        $params = null;
        return Database::getRows($sql, $params);
    }


    public function readUnidadmedida()
    {

        $sql = 'SELECT idunidadmedida, unidadmedida from unidadmedida where idtipounidad=?';
        $params = array($this->idTipoUnidad);
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO material(
                nombreproducto, costo, imagen, idcategoria, tamaño, descripcion, cantidad, idmarca, idunidadmedida)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';

        $params = array(
            $this->nombreMaterial, $this->costo, $this->imagen, $this->idcategoria,
            $this->tamanio, $this->descripcion, $this->cantidad, $this->idmarca, $this->idunidadmedida
        );
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = "SELECT m.idmaterial, m.imagen,concat(b.marca,' ', m.nombreproducto) as producto, m.cantidad  from material m, marca b
        where m.idmarca=b.idmarca";
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function searchRows($value)
    {
        $sql = "SELECT m.idmaterial, m.imagen,concat(b.marca,' ', m.nombreproducto) as producto, m.cantidad  from material m, marca b
        where m.idmarca=b.idmarca and m.nombreproducto ILIKE ?";
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    public function filterCategoria()
    {
        $sql = "SELECT m.idmaterial, m.imagen,concat(b.marca,' ', m.nombreproducto) as producto, m.cantidad  from material m, marca b
        where m.idmarca=b.idmarca and m.idcategoria = ?";
        $params = array($this->idcategoria);
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {

        $sql = 'SELECT idmaterial, nombreproducto, costo, imagen, idcategoria, "tamaño", descripcion, cantidad, idmarca, idunidadmedida
        FROM material where idmaterial=?';
        $params = array($this->idmaterial);
        return Database::getRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM material WHERE idmaterial = ?';
        $params = array($this->idmaterial);
        return Database::executeRow($sql, $params);
    }

    public function updateRow($current_image)
    {

        ($this->imagen) ? $this->deleteFile($this->getRuta(), $current_image) : $this->imagen = $current_image;

        $sql = 'UPDATE material
        SET nombreproducto=?, costo=?, imagen=?, idcategoria=?, "tamaño"=?, descripcion=?, cantidad=?, idmarca=?, idunidadmedida=?
        WHERE idmaterial=?';
        $params = array(
            $this->nombreMaterial, $this->costo, $this->imagen, $this->idcategoria,
            $this->tamanio, $this->descripcion, $this->cantidad, $this->idmarca, $this->idunidadmedida, $this->idmaterial
        );
        return Database::executeRow($sql, $params);
    }

    public function registerAction($action, $desc)
    {
        $sql = 'INSERT INTO bitacora VALUES (DEFAULT, ?, current_time, current_date, ?, ?)';
        $params = array($_SESSION['idusuario'], $action, $desc);
        return Database::executeRow($sql, $params);
    }

    public function readCategoria2()
    {
        $sql = 'SELECT idcategoria, categoria FROM categoria';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readMaterialesCategoria()
    {
        $sql = "SELECT categoria, idmaterial, concat(nombreproducto,' ', marca) as producto, descripcion, costo, cantidad, unidadmedida
        FROM material INNER JOIN categoria USING(idcategoria)
        INNER JOIN marca using(idmarca)
        INNER JOIN unidadmedida using(idunidadmedida)
        WHERE idcategoria = ?
        ORDER BY producto";
        $params = array($this->idcategoria);
        return Database::getRows($sql, $params);
    }
}
