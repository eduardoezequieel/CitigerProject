CREATE TABLE marca(
	idMarca SERIAL NOT NULL PRIMARY KEY,
	marca CHARACTER VARYING(15) NOT NULL
);

CREATE TABLE tipoUnidad(
	idTipoUnidad SERIAL NOT NULL PRIMARY KEY,
	tipoUnidad CHARACTER VARYING(20) NOT NULL
);

CREATE TABLE unidadMedida(
	idUnidadMedida SERIAL NOT NULL PRIMARY KEY,
	idTipoUnidad INTEGER REFERENCES tipoUnidad(idTipoUnidad),
	unidadMedida CHARACTER VARYING(15) NOT NULL
);

CREATE TABLE categoria(
	idCategoria SERIAL NOT NULL PRIMARY KEY,
	categoria CHARACTER VARYING(40) NOT NULL
);

CREATE TABLE material(
	idMaterial SERIAL NOT NULL PRIMARY KEY,
	nombreProducto CHARACTER VARYING(40) NOT NULL,
	costo NUMERIC NOT NULL,
	imagen BYTEA,
	idCategoria INTEGER REFERENCES categoria(idCategoria),
	tamaño CHARACTER VARYING(10) NOT NULL,
	descripcion CHARACTER VARYING(200) NOT NULL,
	cantidad NUMERIC NOT NULL,
	idMarca INTEGER REFERENCES marca(idMarca),
	idUnidadMedida INTEGER REFERENCES unidadMedida(idUnidadMedida)
);

CREATE TABLE estadoPedido(
	idEstadoPedido SERIAL NOT NULL PRIMARY KEY,
	estadoPedido CHARACTER VARYING(15) NOT NULL
);

CREATE TABLE estadoEmpleado(
	idEstadoEmpleado SERIAL NOT NULL PRIMARY KEY,
	estadoEmpleado CHARACTER VARYING(20) NOT NULL
);

CREATE TABLE empleado(
	idEmpleado SERIAL NOT NULL PRIMARY KEY,
	idEstadoEmpleado INTEGER REFERENCES estadoEmpleado(idEstadoEmpleado),
	nombre CHARACTER VARYING(15) NOT NULL,
	apellido CHARACTER VARYING(15) NOT NULL,
	telefono CHAR(9) NOT NULL,
	dui CHAR(10) NOT NULL,
	genero CHAR(1) NOT NULL,
	foto BYTEA,
	direccion CHARACTER VARYING(200) NOT NULL,
	correo CHARACTER VARYING(50) NOT NULL,
	fechaNacimiento DATE NOT NULL
);

CREATE TABLE estadoUsuario(
	idEstadoUsuario SERIAL NOT NULL PRIMARY KEY,
	estadoUsuario CHARACTER VARYING(20) NOT NULL
);

CREATE TABLE tipoUsuario(
	idTipoUsuario SERIAL NOT NULL PRIMARY KEY,
	tipoUsuario CHARACTER VARYING(15) NOT NULL
);

CREATE TABLE usuario(
	idUsuario SERIAL NOT NULL PRIMARY KEY,
	idEstadoUsuario INTEGER REFERENCES estadoUsuario(idEstadoUsuario),
	idTipoUsuario INTEGER REFERENCES tipoUsuario(idTipoUsuario),
	nombre CHARACTER VARYING(15) NOT NULL,
	apellido CHARACTER VARYING(15) NOT NULL,
	telefonoFijo CHAR(9) NOT NULL,
	telefonoCelular CHAR(9) NOT NULL,
	foto BYTEA,
	correo CHARACTER VARYING(50) NOT NULL,
	fechaNacimiento DATE NOT NULL,
	genero CHAR(1) NOT NULL,
	dui CHAR(10) NOT NULL,
	username CHARACTER VARYING(25) NOT NULL,
	contrasena CHAR(40) NOT NULL
);

CREATE TABLE pedido(
	idPedido SERIAL NOT NULL PRIMARY KEY,
	idEstadoPedido INTEGER REFERENCES estadoPedido(idEstadoPedido),
	idUsuario INTEGER REFERENCES usuario(idUsuario),
	idEmpleado INTEGER REFERENCES empleado(idEmpleado),
	fechaPedido DATE NOT NULL
);

CREATE TABLE detalleMaterial(
	idDetalleMaterial SERIAL NOT NULL PRIMARY KEY,
	idPedido INTEGER REFERENCES pedido(idPedido),
	idMaterial INTEGER REFERENCES material(idMaterial),
	precioMaterial NUMERIC NOT NULL,
	cantidad NUMERIC NOT NULL
);

CREATE TABLE estadoEspacio(
	idEstadoEspacio SERIAL NOT NULL PRIMARY KEY,
	estadoEspacio CHARACTER VARYING(15) NOT NULL
);

CREATE TABLE estadoResidente(
	idEstadoResidente SERIAL NOT NULL PRIMARY KEY,
	estadoResidente CHARACTER VARYING(15) NOT NULL
);

CREATE TABLE residente(
	idResidente SERIAL NOT NULL PRIMARY KEY,
	idEstadoResidente INTEGER REFERENCES estadoResidente(idEstadoResidente),
	nombre CHARACTER VARYING(15) NOT NULL,
	apellido CHARACTER VARYING(15) NOT NULL,
	telefonoFijo CHAR(9) NOT NULL,
	telefonoCelular CHAR(9) NOT NULL,
	foto BYTEA,
	correo CHARACTER VARYING(50) NOT NULL,
	fechaNacimiento DATE NOT NULL,
	genero CHAR(1) NOT NULL,
	dui CHAR(10) NOT NULL,
	username CHARACTER VARYING(25) NOT NULL,
	contrasena CHAR(40) NOT NULL
);

CREATE TABLE estadoAlquiler(
	idEstadoAlquiler SERIAL NOT NULL PRIMARY KEY,
	estadoAlquiler CHARACTER VARYING(15) NOT NULL
);

CREATE TABLE espacio(
	idEspacio SERIAL NOT NULL PRIMARY KEY,
	idEstadoEspacio INTEGER REFERENCES estadoEspacio(idEstadoEspacio),
	nombre CHARACTER VARYING(30) NOT NULL,
	descripcion CHARACTER VARYING(200) NOT NULL,
	capacidad NUMERIC NOT NULL
);

CREATE TABLE imagenesEspacio(
	idImagenesEspacio SERIAL NOT NULL PRIMARY KEY,
	imagen BYTEA NOT NULL,
	idEspacio INTEGER REFERENCES espacio(idEspacio)
);

CREATE TABLE alquiler(
	idAlquiler SERIAL NOT NULL PRIMARY KEY,
	idEstadoAlquiler INTEGER REFERENCES estadoAlquiler(idEstadoAlquiler),
	idEspacio INTEGER REFERENCES espacio(idEspacio),
	precio NUMERIC NOT NULL,
	idUsuario INTEGER REFERENCES usuario(idUsuario),
	idResidente INTEGER REFERENCES residente(idResidente),
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
	tipoDenuncia CHARACTER VARYING(15) NOT NULL
);

CREATE TABLE denuncia(
	idDenuncia SERIAL NOT NULL PRIMARY KEY,
	idEmpleado INTEGER REFERENCES empleado(idEmpleado),
	idResidente INTEGER REFERENCES residente(idResidente),
	idTipoDenuncia INTEGER REFERENCES tipoDenuncia(idTipoDenuncia),
	idEstadoDenuncia INTEGER REFERENCES estadoDenuncia(idEstadoDenuncia),
	fecha DATE NOT NULL,
	descripcion CHARACTER VARYING(200) NOT NULL
);

CREATE TABLE visita(
	idVisita SERIAL NOT NULL PRIMARY KEY,
	idResidente INTEGER REFERENCES residente(idResidente),
	fecha DATE NOT NULL,
	visitaRecurrente BOOL NOT NULL,
	observacion CHARACTER VARYING(200) NOT NULL
);

CREATE TABLE visitante(
	idVisitante SERIAL NOT NULL PRIMARY KEY,
	nombre CHARACTER VARYING(15) NOT NULL,
	apellido CHARACTER VARYING(15) NOT NULL,
	dui CHAR(10) NOT NULL,
	genero CHAR(1) NOT NULL,
	placa CHARACTER VARYING(10) NOT NULL
);

CREATE TABLE detalleVisita(
	idDetalleVisita SERIAL NOT NULL PRIMARY KEY,
	idVisita INTEGER REFERENCES visita(idVisita),
	idVisitante INTEGER REFERENCES visitante(idVisitante)
);

CREATE TABLE estadoCasa(
	idEstadoCasa SERIAL NOT NULL PRIMARY KEY,
	estadoCasa CHARACTER VARYING(15) NOT NULL
);

CREATE TABLE casa(
	idCasa SERIAL NOT NULL PRIMARY KEY,
	idEstadoCasa INTEGER REFERENCES estadoCasa(idEstadoCasa),
	numeroCasa NUMERIC NOT NULL,
	direccion CHARACTER VARYING(200) NOT NULL
);

CREATE TABLE residenteCasa(
	idResidenteCasa SERIAL NOT NULL PRIMARY KEY,
	idResidente INTEGER REFERENCES residente(idResidente),
	idCasa INTEGER REFERENCES casa(idCasa)
);

CREATE TABLE estadoAportacion(
	idEstadoAportacion SERIAL NOT NULL PRIMARY KEY,
	estadoAportacion CHARACTER VARYING(15) NOT NULL
);

CREATE TABLE mesPago(
	idMesPago SERIAL NOT NULL PRIMARY KEY,
	mes CHARACTER VARYING(10) NOT NULL,
	ano NUMERIC NOT NULL
);

CREATE TABLE aportacion(
	idAportacion SERIAL NOT NULL PRIMARY KEY,
	idCasa INTEGER REFERENCES casa(idCasa),
	idEstadoAportacion INTEGER REFERENCES estadoAportacion(idEstadoAportacion),
	monto NUMERIC NOT NULL,
	idMesPago INTEGER REFERENCES mesPago(idMesPago),
	fechaPago DATE NOT NULL,
	descripcion CHARACTER VARYING (200) NOT NULL
);

--cambios 13/06/2021 (las que estan en comentarios quizas no sean necesarias, PostgreSQL indica que
--ya existen)
alter table usuario add constraint UQ_usuario_username unique (username);
alter table usuario add constraint UQ_usuario_correo unique (correo);
ALTER TABLE usuario ALTER COLUMN foto TYPE character varying(50) USING CAST(foto AS bytea);
ALTER TABLE usuario ALTER COLUMN contrasena TYPE character varying(60) USING CAST(contrasena AS character varying);
alter table residente add constraint UQ_residente_usuario unique (username);
alter table residente add constraint UQ_residente_correo unique (correo);
ALTER TABLE residente ALTER COLUMN foto TYPE character varying(50) USING CAST(foto AS bytea);
ALTER TABLE residente ALTER COLUMN contrasena TYPE character varying(60) USING CAST(contrasena AS character varying);
-- ALTER TABLE usuario ADD COLUMN direccion character varying(200);
--alter table usuario add constraint UQ_usuario_dui unique (dui);
-- alter table residente add constraint UQ_residente_dui unique (dui);
ALTER TABLE usuario ADD COLUMN direccion character varying(200);
ALTER TABLE usuario ALTER COLUMN nombre TYPE character varying(25) USING CAST(nombre AS character varying); 
ALTER TABLE usuario ALTER COLUMN apellido TYPE character varying(25) USING CAST(apellido AS character varying); 
ALTER TABLE residente ALTER COLUMN nombre TYPE character varying(25) USING CAST(nombre AS character varying); 
ALTER TABLE residente ALTER COLUMN apellido TYPE character varying(25) USING CAST(apellido AS character varying); 