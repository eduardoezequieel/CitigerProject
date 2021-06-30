<?php
    class Dashboard extends Validator{

        private $idBitacora = null;
        //Métodos set
        public function setIdBitacora($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->idBitacora = $value;
                return true;
            } else {
                return false;
            }
        }

        public function getIdBitacora()
    {
        return $this->idBitacora;
    }
        
        //Metodos para la tabla de bitacoras

        //Leer todas las bitacoras
        public function readAllBitacora()
        {
            $sql = 'SELECT idbitacora, usuario.foto, CONCAT(usuario.nombre,\' \', usuario.apellido) as usuario, hora, fecha, accion FROM bitacora
                    INNER JOIN usuario ON bitacora.idusuario = usuario.idusuario
                    ORDER BY hora, fecha ASC';
            $params = null;
            return Database::getRows($sql, $params);
        }

        //Capturar información de una bitacora
        public function readOneBitacora()
        {
            $sql = 'SELECT usuario.foto, usuario.username, CONCAT(usuario.nombre,\' \', usuario.apellido) as nombre, hora, fecha, accion, descripcion FROM bitacora
                    INNER JOIN usuario ON bitacora.idusuario = usuario.idusuario
                    WHERE idbitacora = ?
                    ORDER BY hora, fecha ASC';
            $params = array($this->idBitacora);
            return Database::getRow($sql, $params);
        }

        public function contadorDenuncias()
        {
            $sql = 'SELECT COUNT(iddenuncia) as denunciasPendientes 
                    FROM denuncia 
                    WHERE idestadodenuncia = 1';
            $params = null;
            return Database::getRow($sql, $params);
        }
    }
?>