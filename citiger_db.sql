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