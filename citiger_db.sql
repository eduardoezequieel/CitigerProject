CREATE TABLE marca(
	idMarca SERIAL NOT NULL PRIMARY KEY,
	marca VARCHAR(15) NOT NULL
);

CREATE TABLE tipoUnidad(
	idTipoUnidad SERIAL NOT NULL PRIMARY KEY,
	tipoUnidad VARCHAR(20) NOT NULL
);

CREATE TABLE tipoEmpleado(
	idTipoEmpleado SERIAL NOT NULL PRIMARY KEY, 
	tipoEmpleado VARCHAR(15) NOT NULL
);

CREATE TABLE unidadMedida(
	idUnidadMedida SERIAL NOT NULL PRIMARY KEY,
	idTipoUnidad INTEGER NOT NULL REFERENCES tipoUnidad(idTipoUnidad),
	unidadMedida VARCHAR(15) NOT NULL
);

CREATE TABLE categoria(
	idCategoria SERIAL NOT NULL PRIMARY KEY,
	categoria VARCHAR(40) NOT NULL
);

CREATE TABLE material(
	idMaterial SERIAL NOT NULL PRIMARY KEY,
	nombreProducto VARCHAR(40) NOT NULL,
	costo NUMERIC NOT NULL,
	imagen VARCHAR(50),
	idCategoria INTEGER NOT NULL REFERENCES categoria(idCategoria),
	tamaño VARCHAR(10) NOT NULL,
	descripcion VARCHAR(200) NOT NULL,
	cantidad NUMERIC NOT NULL,
	idMarca INTEGER NOT NULL REFERENCES marca(idMarca),
	idUnidadMedida INTEGER NOT NULL REFERENCES unidadMedida(idUnidadMedida)
);

CREATE TABLE estadoPedido(
	idEstadoPedido SERIAL NOT NULL PRIMARY KEY,
	estadoPedido VARCHAR(15) NOT NULL
);

CREATE TABLE estadoEmpleado(
	idEstadoEmpleado SERIAL NOT NULL PRIMARY KEY,
	estadoEmpleado VARCHAR(20) NOT NULL
);

CREATE TABLE empleado(
	idEmpleado SERIAL NOT NULL PRIMARY KEY,
	idEstadoEmpleado INTEGER NOT NULL REFERENCES estadoEmpleado(idEstadoEmpleado),
	idTipoEmpleado INTEGER NOT NULL REFERENCES tipoEmpleado(idTipoEmpleado),
	nombre VARCHAR(30) NOT NULL,
	apellido VARCHAR(30) NOT NULL,
	telefono CHAR(9) NOT NULL ,
	dui CHAR(10) NOT NULL ,
	genero CHAR(1) NOT NULL,
	foto VARCHAR(50),
	direccion VARCHAR(200) NOT NULL,
	correo VARCHAR(50) NOT NULL ,
	fechaNacimiento DATE NOT NULL
);

CREATE TABLE estadoUsuario(
	idEstadoUsuario SERIAL NOT NULL PRIMARY KEY,
	estadoUsuario VARCHAR(20) NOT NULL
);

CREATE TABLE tipoUsuario(
	idTipoUsuario SERIAL NOT NULL PRIMARY KEY,
	tipoUsuario VARCHAR(15) NOT NULL
);

CREATE TABLE usuario(
	idUsuario SERIAL NOT NULL PRIMARY KEY,
	idEstadoUsuario INTEGER NOT NULL REFERENCES estadoUsuario(idEstadoUsuario),
	idTipoUsuario INTEGER NOT NULL REFERENCES tipoUsuario(idTipoUsuario),
	nombre VARCHAR(30) NOT NULL,
	apellido VARCHAR(30) NOT NULL,
	telefonoFijo CHAR(9) NOT NULL,
	telefonoCelular CHAR(9) NOT NULL ,
	foto VARCHAR(50),
	correo VARCHAR(50) NOT NULL ,
	fechaNacimiento DATE NOT NULL,
	genero CHAR(1) NOT NULL,
	dui CHAR(10) NOT NULL ,
	username VARCHAR(25) NOT NULL ,
	contrasena VARCHAR(60) NOT NULL,
	direccion VARCHAR(200) NOT NULL
);

CREATE TABLE pedido(
	idPedido SERIAL NOT NULL PRIMARY KEY,
	idEstadoPedido INTEGER NOT NULL REFERENCES estadoPedido(idEstadoPedido),
	idUsuario INTEGER NOT NULL REFERENCES usuario(idUsuario),
	idEmpleado INTEGER NOT NULL REFERENCES empleado(idEmpleado),
	fechaPedido DATE NOT NULL
);

CREATE TABLE detalleMaterial(
	idDetalleMaterial SERIAL NOT NULL PRIMARY KEY,
	idPedido INTEGER NOT NULL REFERENCES pedido(idPedido),
	idMaterial INTEGER NOT NULL REFERENCES material(idMaterial),
	precioMaterial NUMERIC NOT NULL,
	cantidad NUMERIC NOT NULL
);

CREATE TABLE estadoEspacio(
	idEstadoEspacio SERIAL NOT NULL PRIMARY KEY,
	estadoEspacio VARCHAR(15) NOT NULL
);

CREATE TABLE estadoResidente(
	idEstadoResidente SERIAL NOT NULL PRIMARY KEY,
	estadoResidente VARCHAR(15) NOT NULL
);

CREATE TABLE residente(
	idResidente SERIAL NOT NULL PRIMARY KEY,
	idEstadoResidente INTEGER REFERENCES estadoResidente(idEstadoResidente),
	nombre VARCHAR(30) NOT NULL,
	apellido VARCHAR(30) NOT NULL,
	telefonoFijo CHAR(9) NOT NULL,
	telefonoCelular CHAR(9) NOT NULL ,
	foto VARCHAR(50),
	correo VARCHAR(50) NOT NULL ,
	fechaNacimiento DATE NOT NULL,
	genero CHAR(1) NOT NULL,
	dui CHAR(10) NOT NULL ,
	username VARCHAR(25) NOT NULL ,
	contrasena VARCHAR(60) NOT NULL
);	

CREATE TABLE estadoAlquiler(
	idEstadoAlquiler SERIAL NOT NULL PRIMARY KEY,
	estadoAlquiler VARCHAR(15) NOT NULL
);

CREATE TABLE espacio(
	idEspacio SERIAL NOT NULL PRIMARY KEY,
	idEstadoEspacio INTEGER NOT NULL REFERENCES estadoEspacio(idEstadoEspacio),
	nombre VARCHAR(30) NOT NULL,
	descripcion VARCHAR(200) NOT NULL,
	capacidad NUMERIC NOT NULL
);

CREATE TABLE imagenesEspacio(
	idImagenesEspacio SERIAL NOT NULL PRIMARY KEY,
	imagen VARCHAR(50),
	idEspacio INTEGER REFERENCES espacio(idEspacio)
);

CREATE TABLE alquiler(
	idAlquiler SERIAL NOT NULL PRIMARY KEY,
	idEstadoAlquiler INTEGER NOT NULL REFERENCES estadoAlquiler(idEstadoAlquiler),
	idEspacio INTEGER NOT NULL REFERENCES espacio(idEspacio),
	precio NUMERIC NOT NULL,
	idUsuario INTEGER NOT NULL REFERENCES usuario(idUsuario),
	idResidente INTEGER NOT NULL REFERENCES residente(idResidente),
	fecha DATE NOT NULL,
	horaInicio TIME NOT NULL,
	horaFin TIME NOT NULL
);


CREATE TABLE estadoDenuncia(
	idEstadoDenuncia SERIAL NOT NULL PRIMARY KEY,
	estadoDenuncia CHARACTER VARYING(15) NOT NULL
);

CREATE TABLE tipoDenuncia(
	idTipoDenuncia SERIAL NOT NULL PRIMARY KEY,
	tipoDenuncia VARCHAR(15) NOT NULL
);

CREATE TABLE denuncia(
	idDenuncia SERIAL NOT NULL PRIMARY KEY,
	idEmpleado INTEGER NOT NULL REFERENCES empleado(idEmpleado),
	idResidente INTEGER NOT NULL REFERENCES residente(idResidente),
	idTipoDenuncia INTEGER NOT NULL REFERENCES tipoDenuncia(idTipoDenuncia),
	idEstadoDenuncia INTEGER NOT NULL REFERENCES estadoDenuncia(idEstadoDenuncia),
	fecha DATE NOT NULL,
	descripcion VARCHAR(200) NOT NULL
);

CREATE TABLE visita(
	idVisita SERIAL NOT NULL PRIMARY KEY,
	idResidente INTEGER NOT NULL REFERENCES residente(idResidente),
	fecha DATE NOT NULL,
	visitaRecurrente CHAR(2) NOT NULL,
	observacion VARCHAR(200) NOT NULL
);

CREATE TABLE visitante(
	idVisitante SERIAL NOT NULL PRIMARY KEY,
	nombre VARCHAR(30) NOT NULL,
	apellido VARCHAR(30) NOT NULL,
	dui CHAR(10) NOT NULL ,
	genero CHAR(1) NOT NULL,
	placa VARCHAR(10) NOT NULL 
);

CREATE TABLE detalleVisita(
	idDetalleVisita SERIAL NOT NULL PRIMARY KEY,
	idVisita INTEGER NOT NULL REFERENCES visita(idVisita),
	idVisitante INTEGER NOT NULL REFERENCES visitante(idVisitante)
);

CREATE TABLE estadoCasa(
	idEstadoCasa SERIAL NOT NULL PRIMARY KEY,
	estadoCasa VARCHAR(15) NOT NULL
);

CREATE TABLE casa(
	idCasa SERIAL NOT NULL PRIMARY KEY,
	idEstadoCasa INTEGER NOT NULL REFERENCES estadoCasa(idEstadoCasa),
	numeroCasa NUMERIC NOT NULL,
	direccion VARCHAR(200) NOT NULL
);

CREATE TABLE residenteCasa(
	idResidenteCasa SERIAL NOT NULL PRIMARY KEY,
	idResidente INTEGER NOT NULL REFERENCES residente(idResidente),
	idCasa INTEGER NOT NULL REFERENCES casa(idCasa)
);

CREATE TABLE estadoAportacion(
	idEstadoAportacion SERIAL NOT NULL PRIMARY KEY,
	estadoAportacion VARCHAR(15) NOT NULL
);

CREATE TABLE mesPago(
	idMesPago SERIAL NOT NULL PRIMARY KEY,
	mes VARCHAR(10) NOT NULL,
	ano NUMERIC NOT NULL
);

CREATE TABLE aportacion(
	idAportacion SERIAL NOT NULL PRIMARY KEY,
	idCasa INTEGER NOT NULL REFERENCES casa(idCasa),
	idEstadoAportacion INTEGER NOT NULL REFERENCES estadoAportacion(idEstadoAportacion),
	monto NUMERIC NOT NULL,
	idMesPago INTEGER NOT NULL REFERENCES mesPago(idMesPago),
	fechaPago DATE NOT NULL,
	descripcion VARCHAR(200) NOT NULL
);

INSERT INTO tipoUsuario(tipoUsuario) VALUES('Administrador');
INSERT INTO estadoUsuario(estadoUsuario) VALUES('Disponible'),('Suspendido');
INSERT INTO tipoEmpleado(tipoEmpleado) VALUES('Albañil'),('Limpieza'),('Bodega');
INSERT INTO estadoEmpleado(estadoEmpleado) VALUES ('Disponible'),('Ocupado');

--Cambios 16/6/2021
INSERT INTO estadoempleado VALUES (DEFAULT, 'Suspendido');

--Cambios 17/06/2021
INSERT INTO estadoresidente (estadoresidente) VALUES ('Activo'),('Deshabilitado');

--Cambios 22/06/2021
INSERT INTO estadoEspacio(estadoEspacio) VALUES('Disponible'),('Ocupado'),('Suspendido');

--Cambios 24/06/2021
INSERT INTO categoria(categoria) VALUES ('Artículos de limpieza'),('Artículos de construcción'),('Ornamentación');
INSERT INTO marca(marca) VALUES ('CEMEX'),('Kimberly-Clark'),('HOLCIM'),('IKEA');
INSERT INTO tipoUnidad(tipoUnidad) VALUES ('Volumen'),('Peso'),('Altura');
INSERT INTO unidadMedida(idTipoUnidad,unidadMedida) VALUES (1,'Litros'), (2,'Libras'), (3,'Metros');

--Cambios 24/6/2021
ALTER TABLE usuario ADD COLUMN modo VARCHAR(6) NULL;
UPDATE usuario SET modo = 'light';

--Cambios 25/06/2021
INSERT INTO estadoAlquiler(estadoAlquiler) VALUES('Revisión'),('Activo'),('Finalizado'),('Denegado');

--Cambios 26/6/2021	(Validación de datos duplicados)
ALTER TABLE empleado ADD CONSTRAINT UQ_empleado_dui UNIQUE (dui);
ALTER TABLE empleado ADD CONSTRAINT UQ_empleado_telefono UNIQUE (telefono);
ALTER TABLE empleado ADD CONSTRAINT UQ_empleado_correo UNIQUE (correo);

INSERT INTO tipodenuncia(tipodenuncia) VALUES ('Mantenimiento'),('Limpieza'),('Disturbio');
INSERT INTO estadodenuncia(estadodenuncia) VALUES ('Pendiente'),('Rechazada'),('Revisión'),('En proceso'),('Solucionada');
INSERT INTO denuncia(idempleado, idresidente,idtipodenuncia, idestadodenuncia, fecha, descripcion) VALUES (1, 1, 1, 1, '2021-06-26','Denuncia de prueba');

ALTER TABLE usuario ADD CONSTRAINT UQ_usuario_dui UNIQUE (dui);
ALTER TABLE usuario ADD CONSTRAINT UQ_usuario_telefono_fijo UNIQUE (telefonofijo);
ALTER TABLE usuario ADD CONSTRAINT UQ_usuario_telefono_celular UNIQUE (telefonocelular);
ALTER TABLE usuario ADD CONSTRAINT UQ_usuario_correo UNIQUE (correo);
ALTER TABLE usuario ADD CONSTRAINT UQ_usuario_username UNIQUE (username);

--Cambios 27/6/2021	

INSERT INTO estadocasa(idestadocasa, estadocasa) VALUES (DEFAULT, 'Activa'),(DEFAULT, 'Desactivada');

--Cambios 28/6/2021
CREATE TABLE bitacora(
	idBitacora SERIAL NOT NULL PRIMARY KEY,
	idUsuario INTEGER NOT NULL REFERENCES usuario(idUsuario),
	hora TIME NOT NULL,
	fecha DATE NOT NULL,
	accion VARCHAR(20) NOT NULL,
	descripcion VARCHAR(200) NOT NULL
)

--Cambios 29/06/2021
INSERT INTO tipoUsuario(tipousuario) VALUES('Caseta');

--Cambios 30/06/2021
INSERT INTO estadoespacio(estadoespacio) VALUES('Reservado');
ALTER TABLE espacio ADD CONSTRAINT UQ_espacio_nombre UNIQUE (nombre);

CREATE TABLE estadoVisita(
	idEstadoVisita SERIAL NOT NULL PRIMARY KEY,
	estadoVisita VARCHAR(15) NOT NULL
);

ALTER TABLE visita ADD COLUMN idEstadoVisita INTEGER NOT NULL REFERENCES estadovisita(idestadovisita)

INSERT INTO estadovisita(idestadovisita, estadovisita) VALUES (DEFAULT, 'Activa'),('Finalizada');

--Cambios 02/07/2021
insert into estadoaportacion values(default, 'Pendiente'),(default, 'Cancelada')

--es importante que el id empieze desde 1, sino, reiniciar cuenta

insert into mespago values(default,'Enero',2021),(default,'Febrero',2021),(default,'Marzo',2021),(default,'Abril',2021),(default,'Mayo',2021),
(default,'Junio',2021),(default,'Julio',2021),(default,'Agosto',2021),(default,'Septiembre',2021),
(default,'Octubre',2021),(default,'Noviembre',2021),(default,'Diciembre',2021),

(default,'Enero',2022),(default,'Febrero',2022),(default,'Marzo',2022),(default,'Abril',2022),(default,'Mayo',2022),
(default,'Junio',2022),(default,'Julio',2022),(default,'Agosto',2022),(default,'Septiembre',2022),
(default,'Octubre',2022),(default,'Noviembre',2022),(default,'Diciembre',2022),

(default,'Enero',2023),(default,'Febrero',2023),(default,'Marzo',2023),(default,'Abril',2023),(default,'Mayo',2023),
(default,'Junio',2023),(default,'Julio',2023),(default,'Agosto',2023),(default,'Septiembre',2023),
(default,'Octubre',2023),(default,'Noviembre',2023),(default,'Diciembre',2023),

(default,'Enero',2024),(default,'Febrero',2024),(default,'Marzo',2024),(default,'Abril',2024),(default,'Mayo',2021),
(default,'Junio',2024),(default,'Julio',2024),(default,'Agosto',2024),(default,'Septiembre',2024),
(default,'Octubre',2024),(default,'Noviembre',2024),(default,'Diciembre',2024),

(default,'Enero',2025),(default,'Febrero',2025),(default,'Marzo',2025),(default,'Abril',2025),(default,'Mayo',2025),
(default,'Junio',2025),(default,'Julio',2025),(default,'Agosto',2025),(default,'Septiembre',2025),
(default,'Octubre',2025),(default,'Noviembre',2025),(default,'Diciembre',2025);

--Cambios 03/07/2021
ALTER TABLE espacio ADD COLUMN imagenprincipal CHARACTER VARYING(50);

--usado para que funcionen los estados de visita en el insert
update estadovisita set idestadovisita=5 where idestadovisita=2
update estadovisita set idestadovisita=4 where idestadovisita=1

--Agregar para que el cambio de modos funcione en el sitio de residentes.
ALTER TABLE residente ADD COLUMN modo VARCHAR(6) NULL;
UPDATE residente SET modo = 'light';

--Denuncias
ALTER TABLE denuncia ADD COLUMN respuesta VARCHAR(200) NULL;
ALTER TABLE denuncia ALTER COLUMN idempleado DROP NOT NULL;

--Cambios 05/07/2021
ALTER TABLE visitante ADD CONSTRAINT UQ_visitante_placa UNIQUE (placa);
ALTER TABLE visitante ADD CONSTRAINT UQ_visitante_dui UNIQUE (dui);

INSERT INTO estadopedido(estadopedido) VALUES ('En Proceso');
INSERT INTO estadopedido(estadopedido) VALUES ('Realizado');
INSERT INTO estadopedido(estadopedido) VALUES ('Recibido'),('Cancelado');

ALTER TABLE detallematerial RENAME COLUMN cantidad TO cantidadmaterial;

