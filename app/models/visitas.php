<?php
//Clase para la tabla de visitas
class Visitas extends Validator
{
    private $idVisita = null;
    private $idEstadoVisita = null;
    private $idResidente = null;
    private $fecha = null;
    private $visitarecurrente = null;
    private $observacion = null;

    private $idVisitante = null;
    private $nombre = null;
    private $apellido = null;
    private $dui = null;
    private $genero = null;
    private $placa = null;

    //Metodos set para todas las variables del modelo.
    public function setIdVisitante($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idVisitante = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombre($value)
    {
        if ($this->validateAlphabetic($value, 1, 30)) {
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellido($value)
    {
        if ($this->validateAlphabetic($value, 1, 30)) {
            $this->apellido = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDui($value)
    {
        if ($this->validateDUI($value)) {
            $this->dui = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setGenero($value)
    {
        if ($this->validateAlphabetic($value, 1, 10)) {
            $this->genero = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setPlaca($value)
    {
        if ($this->validateAlphanumeric($value, 1, 30)) {
            $this->placa = $value;
            return true;
        } else {
            return false;
        }
    }

    //Metodos get para las variables del modelo

    public function getIdVisitante()
    {
        return $this->idVisitante;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getDui()
    {
        return $this->dui;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function getPlaca()
    {
        return $this->placa;
    }

    //Metodos set para todas las variables del modelo.
    public function setIdVisita($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idVisita = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdEstadoVisita($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idEstadoVisita = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdResidente($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idResidente = $value;
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

    public function setVisitaR($value)
    {
        if ($this->validateAlphabetic($value, 1, 10)) {
            $this->visitarecurrente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setObservacion($value)
    {
        if ($this->validateAlphanumeric($value, 1, 200)) {
            $this->observacion = $value;
            return true;
        } else {
            return false;
        }
    }


    //Metodos get para las variables del modelo

    public function getIdVisita()
    {
        return $this->idVisita;
    }

    public function getidEstadoVisita()
    {
        return $this->idEstadoVisita;
    }

    public function getIdResidente()
    {
        return $this->idResidente;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getVisitaR()
    {
        return $this->visitarecurrente;
    }

    public function getObservacion()
    {
        return $this->observacion;
    }


    //Sentencias SQL a la tabla visita.

    //visitas por un residente
    public function visitsOfAResident()
    {
        $sql = 'SELECT CONCAT(nombre,\' \',apellido) as residente, COUNT(idvisita) as visitas, EXTRACT(MONTH FROM fecha) as mes 
                FROM visita 
                INNER JOIN residente USING (idresidente)
                WHERE EXTRACT(MONTH FROM fecha) <= (SELECT EXTRACT(MONTH FROM current_date)) 
                AND EXTRACT(MONTH FROM fecha) > (SELECT EXTRACT(MONTH FROM current_date)- 6) 
                AND idestadovisita = 1 AND idresidente = ?
                GROUP BY mes, residente
                LIMIT 6';
        $params = array($this->idResidente);
        return Database::getRows($sql, $params);
    }

    //Cantidad de visitas por residente
    public function visitsByResident()
    {
        $sql = 'SELECT idresidente, CONCAT(nombre,\' \',apellido) as residente, COUNT(idvisita) FILTER (WHERE idestadovisita = 1) as visitas FROM visita
                INNER JOIN residente USING (idresidente)
                GROUP BY idresidente, residente
                ORDER BY visitas DESC';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Cantidad de visitas por residente (Busqueda)
    public function searchVisitsByResident($value)
    {
        $sql = 'SELECT idresidente, CONCAT(nombre,\' \',apellido) as residente, COUNT(idvisita) FILTER (WHERE idestadovisita = 1) as visitas FROM visita
                INNER JOIN residente USING (idresidente)
                WHERE nombre ILIKE ? OR apellido ILIKE ?
                GROUP BY idresidente, residente
                ORDER BY visitas DESC';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    //Cantidad de visitas de los ultimos 6 meses (Grafica)
    public function last6MonthsOfVisits()
    {
        $sql = 'SELECT COUNT(idvisita) as visitas, EXTRACT(MONTH FROM fecha) as mes 
                FROM visita 
                WHERE EXTRACT(MONTH FROM fecha) <= (SELECT EXTRACT(MONTH FROM current_date)) 
                AND EXTRACT(MONTH FROM fecha) > (SELECT EXTRACT(MONTH FROM current_date)- 6) 
                AND idestadovisita = 1
                GROUP BY mes
                ORDER BY mes ASC';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Carga datos para el select cbEstadoVisita
    public function readVisitStatus()
    {
        $sql = 'SELECT * FROM estadovisita';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Carga datos para el select cbEstadoVisita
    public function readResident()
    {
        $sql = 'SELECT idresidente, CONCAT(nombre,\' \', apellido) AS nombre FROM residente';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Lee todos los registros de la tabla
    public function readAll()
    {
        $sql = 'SELECT idVisita, residente.nombre, fecha, visitarecurrente, observacion, estadovisita.estadovisita
            FROM visita 
            INNER JOIN estadovisita ON visita.idestadovisita = estadovisita.idestadovisita
            INNER JOIN residente ON visita.idresidente = residente.idresidente
            ORDER BY fecha ASC';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Lee todos los registros de la tabla
    public function filterByVisitStatus()
    {
        $sql = 'SELECT idVisita, residente.nombre, fecha, visitarecurrente, observacion, estadovisita.estadovisita
            FROM visita 
            INNER JOIN estadovisita ON visita.idestadovisita = estadovisita.idestadovisita
            INNER JOIN residente ON visita.idresidente = residente.idresidente
            WHERE estadovisita.idestadovisita = ?
            ORDER BY fecha ASC';
        $params = array($this->idEstadoVisita);
        return Database::getRows($sql, $params);
    }

    //Lee un registro de la tabla
    public function readOne()
    {
        $sql = 'SELECT idVisita, idresidente, fecha, visitarecurrente, observacion, idestadovisita
            FROM visita
			WHERE idVisita = ?
			ORDER BY fecha ASC';
        $params = array($this->idVisita);
        return Database::getRow($sql, $params);
    }

    //Crear registro de visita
    public function createRow()
    {
        $sql = 'INSERT INTO visita(idresidente, fecha, visitarecurrente, observacion, idestadovisita) 
            VALUES
            (?,?,?,?,?)';
        $params = array(
            $this->idResidente,
            $this->fecha,
            $this->visitarecurrente,
            $this->observacion,
            $this->idEstadoVisita
        );
        return Database::executeRow($sql, $params);
    }

    //Actualizacion de datos
    public function updateRow()
    {

        $sql = 'UPDATE visita 
            SET idresidente = ?, fecha = ?, visitarecurrente = ?, observacion = ?
            WHERE idvisita = ?';
        $params = array(
            $this->idResidente,
            $this->fecha,
            $this->visitarecurrente,
            $this->observacion,
            $this->idVisita
        );
        return Database::executeRow($sql, $params);
    }

    //Suspender visita
    public function suspend()
    {
        $sql = 'UPDATE visita SET idestadovisita = 2
                    WHERE idvisita = ?';
        $params = array($this->idVisita);
        return Database::executeRow($sql, $params);
    }

    //Activar visita
    public function activate()
    {
        $sql = 'UPDATE visita SET idestadovisita = 1
                    WHERE idvisita = ?';
        $params = array($this->idVisita);
        return Database::executeRow($sql, $params);
    }



    //Eliminar registro de visita
    public function deleteRow()
    {
        $sql = 'DELETE FROM visita WHERE idvisita = ?';
        $params = array($this->idVisita);
        return Database::executeRow($sql, $params);
    }

    public function registerAction($action, $desc)
    {
        $sql = 'INSERT INTO bitacora VALUES (DEFAULT, ?, current_time, current_date, ?, ?)';
        $params = array($_SESSION['idusuario_dashboard'], $action, $desc);
        return Database::executeRow($sql, $params);
    }

    public function createVisita()
    {
        $sql = 'INSERT INTO visita(idresidente, fecha, visitarecurrente, observacion, idestadovisita) 
            VALUES
            (?,?,?,?,?)';
        $params = array(
            $_SESSION['idresidente'],
            $this->fecha,
            $this->visitarecurrente,
            $this->observacion,
            $this->idEstadoVisita
        );
        return Database::executeRow($sql, $params);
    }

    public function createVistante()
    {
        $sql = 'INSERT INTO visitante(nombre, apellido, dui, genero, placa) 
            VALUES
            (?,?,?,?,?)';
        $params = array(
            $this->nombre,
            $this->apellido,
            $this->dui,
            $this->genero,
            $this->placa
        );
        return Database::executeRow($sql, $params);
    }


    public function readVisitante()
    {
        $sql = 'SELECT idvisitante, CONCAT(nombre,\' \', apellido) AS nombre FROM visitante';
        $params = null;
        return Database::getRows($sql, $params);
    }


    public function insertDetalleVisita()
    {
        $sql = 'INSERT INTO detallevisita(
            idvisita, idvisitante)
            VALUES (?, ?);';
        $params = array(
            $this->idVisita,
            $this->idVisitante

        );
        return Database::executeRow($sql, $params);
    }


    public function readVisitas()
    {
        $sql = "SELECT d.iddetallevisita, d.idvisita, d.idvisitante, CONCAT(vi.nombre,' ',vi.apellido) as visitante, v.fecha, e.estadovisita from detallevisita d
        INNER JOIN visitante vi on d.idvisitante=vi.idvisitante
        INNER JOIN visita v on  d.idvisita=v.idvisita
        INNER JOIN estadovisita e on v.idestadovisita=e.idestadovisita where v.idresidente=? ";
        $params = array($_SESSION['idresidente']);
        return Database::getRows($sql, $params);
    }


    public function readOne2()
    {
        $sql = "SELECT d.iddetallevisita, d.idvisita, d.idvisitante, CONCAT(vi.nombre,' ',vi.apellido) as visitante,vi.placa,v.visitarecurrente, v.observacion, v.fecha, e.estadovisita from detallevisita d
        INNER JOIN visitante vi on d.idvisitante=vi.idvisitante
        INNER JOIN visita v on  d.idvisita=v.idvisita
        INNER JOIN estadovisita e on v.idestadovisita=e.idestadovisita where v.idresidente=? and  d.iddetallevisita=?";
        $params = array($_SESSION['idresidente'],$this->idVisita);
        return Database::getRow($sql, $params);
    }

    public function searchRows($value)
    {
        $sql = "SELECT d.iddetallevisita, d.idvisita, d.idvisitante, CONCAT(vi.nombre,' ',vi.apellido) as visitante, v.fecha, e.estadovisita from detallevisita d
        INNER JOIN visitante vi on d.idvisitante=vi.idvisitante
        INNER JOIN visita v on  d.idvisita=v.idvisita
        INNER JOIN estadovisita e on v.idestadovisita=e.idestadovisita where v.idresidente=? AND  CONCAT(vi.nombre,' ',vi.apellido) ILIKE ? ";
        $params = array($_SESSION['idresidente'], "%$value%");
        return Database::getRows($sql, $params);
    }

    //Función para contar las visitas activas
    public function contadorVisitas()
    {
        $sql = 'SELECT COUNT(idvisita) as visitas 
                FROM visita 
                WHERE idestadovisita = 1';
        $params = null;
        return Database::getRow($sql, $params);
    }

    //Función para verificar visita por el dui y con estado activa
    public function checkVisitDui()
    {
        $sql = 'SELECT CONCAT(residente.apellido, \', \', residente.nombre) as residente, fecha, 
                CONCAT(visitante.apellido, \', \', visitante.nombre) as visitante, observacion,detallevisita.idvisita,
                numerocasa
                FROM detallevisita
                INNER JOIN visitante USING(idvisitante)
                INNER JOIN visita USING(idvisita)
                INNER JOIN residente USING(idresidente)
                INNER JOIN residentecasa USING(idresidente)
                INNER JOIN casa USING(idcasa)
                WHERE visitante.dui = ? AND visita.idestadovisita = 1';
        $params = array($this->dui);
        return Database::getRow($sql, $params);
    }

    //Función para verificar visita por la placa
    public function checkVisitPlaca()
    {
        $sql = 'SELECT CONCAT(residente.apellido, \', \', residente.nombre) as residente, fecha, 
                CONCAT(visitante.apellido, \', \', visitante.nombre) as visitante, observacion,detallevisita.idvisita,
                numerocasa
                FROM detallevisita
                INNER JOIN visitante USING(idvisitante)
                INNER JOIN visita USING(idvisita)
                INNER JOIN residente USING(idresidente)
                INNER JOIN residentecasa USING(idresidente)
                INNER JOIN casa USING(idcasa)
                WHERE visitante.placa = ? AND visita.idestadovisita = 1';
        $params = array($this->placa);
        return Database::getRow($sql, $params);
    }

    //Función para cambiar estado de visita a finalizada cuando la visita esté verificada
    public function updateVisita()
    {
        $sql = 'UPDATE visita 
                SET idestadovisita = 2
                WHERE idvisita = ?';
        $params = array($this->idVisita);
        return Database::executeRow($sql, $params);
    }

    public function getLastId()
    {
        $sql = 'SELECT max(idvisita) as idvisita from visita';
        $params = null;
        return Database::getRow($sql, $params);
    }

    
    //Lee todos los registros de la tabla
    public function readAllVisitas()
    {
        $sql = 'SELECT CONCAT(residente.apellido, \' \', residente.nombre) as residente, fecha, 
                CONCAT(visitante.apellido, \' \', visitante.nombre) as visitante, observacion,
                detallevisita.idvisita,residente.foto, estadovisita
                FROM detallevisita
                INNER JOIN visitante ON visitante.idvisitante = detallevisita.idvisitante
                INNER JOIN visita ON visita.idvisita = detallevisita.idvisita
                INNER JOIN estadoVisita USING(idestadovisita)
                INNER JOIN residente ON residente.idresidente = visita.idresidente
                ORDER BY fecha ASC';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Lee un registro de la tabla
    public function readOneVisitas()
    {
        $sql = 'SELECT CONCAT(residente.apellido, \' \', residente.nombre) as residente, fecha, 
                CONCAT(visitante.apellido, \' \', visitante.nombre) as visitante, observacion,
                detallevisita.idvisita,residente.foto
                FROM detallevisita
                INNER JOIN visitante ON visitante.idvisitante = detallevisita.idvisitante
                INNER JOIN visita ON visita.idvisita = detallevisita.idvisita
                INNER JOIN residente ON residente.idresidente = visita.idresidente
                WHERE detallevisita.idvisita = ?';
        $params = array($this->idVisita);
        return Database::getRow($sql, $params);
    }

    //Función para buscar
    public function searchRowsVisitas($value)
    {
        $sql = 'SELECT CONCAT(residente.apellido, \' \', residente.nombre) as residente, fecha, 
                CONCAT(visitante.apellido, \' \', visitante.nombre) as visitante, observacion,
                detallevisita.idvisita,residente.foto
                FROM detallevisita
                INNER JOIN visitante ON visitante.idvisitante = detallevisita.idvisitante
                INNER JOIN visita ON visita.idvisita = detallevisita.idvisita
                INNER JOIN residente ON residente.idresidente = visita.idresidente
                WHERE residente.nombre ILIKE ? OR residente.apellido ILIKE ? 
                OR visitante.nombre ILIKE ? OR visitante.apellido ILIKE ? 
                ORDER BY fecha';
        $params = array("%$value%", "%$value%","%$value%","%$value%");
        return Database::getRows($sql, $params);
    }
}


