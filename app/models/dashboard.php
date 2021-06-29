<?php
    class Dashboard extends Validator{
        
        //Metodos para la tabla de bitacoras
        public function readAllBitacora()
        {
            $sql = 'SELECT usuario.foto, CONCAT(usuario.nombre,\' \', usuario.apellido) as usuario, hora, fecha, accion FROM bitacora
            INNER JOIN usuario ON bitacora.idusuario = usuario.idusuario
            ORDER BY hora, fecha ASC';
            $params = null;
            return Database::getRows($sql, $params);
        }
    }
?>