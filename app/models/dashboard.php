<?php
class Dashboard extends Validator
{

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

    public function contadorDenuncias2()
    {
        $sql = 'SELECT COUNT(iddenuncia) as denunciasPendientes 
                    FROM denuncia 
                    where idresidente=?';
        $params = array($_SESSION['idresidente']);
        return Database::getRow($sql, $params);
    }


    public function contadorVisitas()
    {
        $sql = 'SELECT COUNT(idvisita) as visitas 
                    FROM visita
                    where idestadovisita=1 and idresidente=?';
        $params = array($_SESSION['idresidente']);
        return Database::getRow($sql, $params);
    }


    public function contadorAportaciones()
    {
        $sql = 'SELECT COUNT(idaportacion) as aportaciones from aportacion a, casa c, residente r,residentecasa rc where rc.idcasa=c.idcasa and rc.idresidente=r.idresidente
            and a.idestadoaportacion=1 and a.idcasa=c.idcasa and fechapago < current_date and EXTRACT(YEAR FROM fechapago) = (SELECT EXTRACT(YEAR FROM current_date)) and r.idresidente=? ';
        $params = array($_SESSION['idresidente']);
        return Database::getRow($sql, $params);
    }

    public function readAll()
    {

        $sql = "SELECT a.idaportacion, CONCAT(m.mes,' ',m.ano) as mespago,a.monto,fechapago,e.estadoaportacion from aportacion a, casa c, residente r,residentecasa rc, mespago m,
        estadoaportacion e where a.idmespago=m.idmespago and rc.idcasa=c.idcasa and rc.idresidente=r.idresidente and a.idestadoaportacion=e.idestadoaportacion and
         a.idcasa=c.idcasa and EXTRACT(YEAR FROM fechapago) = (SELECT EXTRACT(YEAR FROM current_date)) and  fechapago < current_date and rc.idresidente=?
             ";
        $params = array($_SESSION['idresidente']);
        return Database::getRows($sql, $params);
    }


    public function contadorVisitas2()
    {
        $sql = 'SELECT COUNT(idvisita) as visitas 
                    FROM visita
                    where idestadovisita=1';
        $params = null;
        return Database::getRow($sql, $params);
    }


    public function contadorAportaciones2()
    {
        $sql = 'SELECT COUNT(idaportacion) as aportaciones from aportacion where idestadoaportacion=1 and EXTRACT(YEAR FROM fechapago) = (SELECT EXTRACT(YEAR FROM current_date)) and  fechapago < current_date';
        $params = null;
        return Database::getRow($sql, $params);
    }
}
