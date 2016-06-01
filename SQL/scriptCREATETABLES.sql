

CREATE TABLE voluntario(
    matricula char(9) NOT NULL,
    nombres varchar (30) NOT NULL,
    apellidoPat varchar (20) NOT NULL,
    apellidoMat varchar (20),
    fechaDeNac date NOT NULL,
    email varchar (100) NOT NULL,
    celular char (10),
    telefono char(7),
    escolaridad varchar (5) NOT NULL,
    semestre int,
    talla varchar(3),
    visible char DEFAULT '1', 
    CONSTRAINT voluntario_pk PRIMARY KEY (matricula)
);

CREATE TABLE institucion(
    id int AUTO_INCREMENT NOT NULL,
    nombre varchar(40) NOT NULL,
    direccion varchar (50),
    contacto varchar (40),
    telefono varchar (10),
    visible char DEFAULT '1', 
    email varchar(100) NOT NULL,
    CONSTRAINT institucion_pk PRIMARY KEY (id)
);

CREATE TABLE usuario(
    username varchar(20) NOT NULL,
    matricula char(9),
    password varchar(128) NOT NULL,
    tipo varchar(15) NOT NULL,
    bloqueado int DEFAULT 0, -- 0 = No Bloqueado
    intentos int DEFAULT 0,
    institucion int,
    visible char DEFAULT '1', 
    CONSTRAINT usuario_pk PRIMARY KEY (username),
    CONSTRAINT matriculaUsuario_fk FOREIGN KEY (matricula) REFERENCES voluntario(matricula),
    CONSTRAINT instUsuario_fk FOREIGN KEY (institucion) REFERENCES institucion(id)
);

CREATE TABLE patrocinador (
    id int AUTO_INCREMENT NOT NULL,
    nombrePatrocinador varchar(50) NOT NULL,
    nombreContacto varchar(100),
    direccion varchar(150),
    email varchar(40),
    visible char DEFAULT '1', 
    telefono varchar(10),
    CONSTRAINT patrocinador_pk PRIMARY KEY (id)
);

CREATE TABLE discapacidad(
    id int AUTO_INCREMENT NOT NULL,
    descripcion varchar (100) NOT NULL,
    CONSTRAINT discapacidad_pk PRIMARY KEY (id)
);

CREATE TABLE nino(
    id int AUTO_INCREMENT NOT NULL,
    nombres varchar (30) NOT NULL,
    apellidoPat varchar (30) NOT NULL,
    apellidoMat varchar (30),
    fechaDeNac date NOT NULL,
    institucion int NOT NULL,
    discapacidad int NOT NULL,
    genero char, 
    grupo varchar(2),
    visible char DEFAULT '1', 
    CONSTRAINT nino_pk PRIMARY KEY (id),
    CONSTRAINT idInstitucion_fk FOREIGN KEY (institucion) REFERENCES institucion(id),
    CONSTRAINT idDiscapacidad_fk FOREIGN KEY (discapacidad) REFERENCES discapacidad(id)
);

CREATE TABLE permiso(
    id int NOT NULL AUTO_INCREMENT,
    descripcion varchar(50) NOT NULL,
    CONSTRAINT permisos_pk PRIMARY KEY (id)
);

CREATE TABLE usuarioPermiso(
    username varchar(20) NOT NULL,
    id int NOT NULL,
    CONSTRAINT up_pk PRIMARY KEY (id,username),
    CONSTRAINT upId_fk FOREIGN KEY (id) REFERENCES permiso(id),
    CONSTRAINT upUsername_fk FOREIGN KEY (username) REFERENCES usuario(username)
);

CREATE TABLE opcionesNavegacion (
    id int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(40) NOT NULL,
    href varchar(100) NOT NULL,
    display char(1) NOT NULL,
    CONSTRAINT opcionesNavegacion_pk PRIMARY KEY (id)
);

CREATE TABLE opcionesAdministracion (
    id int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(40) NOT NULL,
    href varchar(100) NOT NULL,
    permiso int NOT NULL,
    CONSTRAINT opcionesAdministracion_pk PRIMARY KEY (id)
);

CREATE TABLE evento(
    id int AUTO_INCREMENT NOT NULL,
    descripcion char(11) NOT NULL, -- Ej. "Verano 2015"
    fechaInicio date NOT NULL,
    fechaFin date,
    encargado char(9) NOT NULL,
    visible char DEFAULT '1', 
    CONSTRAINT evento_pk PRIMARY KEY (id),
    CONSTRAINT encargado_fk FOREIGN KEY (encargado) REFERENCES voluntario(matricula)
);

CREATE TABLE voluntarioEvento(
    evento int NOT NULL,
    voluntario char(9) NOT NULL,
    CONSTRAINT voluntarioEvento_pk PRIMARY KEY (evento, voluntario),
    CONSTRAINT eventoVolEv_fk FOREIGN KEY (evento) REFERENCES evento(id),
    CONSTRAINT voluntarioVolEv_fk FOREIGN KEY (voluntario) REFERENCES voluntario(matricula)
);


CREATE TABLE institucionEvento(
    evento int NOT NULL,
    institucion int NOT NULL,
    CONSTRAINT institucionEvento_pk PRIMARY KEY (evento, institucion),
    CONSTRAINT eventoInstEv_fk FOREIGN KEY (evento) REFERENCES evento(id),
    CONSTRAINT institucionInstEv_fk FOREIGN KEY (institucion) REFERENCES institucion(id)
);

CREATE TABLE patrocinadorEvento(
    evento int NOT NULL,
    patrocinador int NOT NULL,
    CONSTRAINT patrocinadorEvento_pk PRIMARY KEY (evento, patrocinador),
    CONSTRAINT eventoPatrEv_fk FOREIGN KEY (evento) REFERENCES evento(id),
    CONSTRAINT patrocinadorPatrEv FOREIGN KEY (patrocinador) REFERENCES patrocinador(id)
);

CREATE TABLE ninoEvento (
    evento int NOT NULL,
    nino int NOT NULL,
    CONSTRAINT ninoEvento_pk PRIMARY KEY (evento, nino),
    CONSTRAINT eventoNinoEv_fk FOREIGN KEY (evento) REFERENCES evento(id),
    CONSTRAINT ninoNinoEv_fk FOREIGN KEY (nino) REFERENCES nino(id)
);

CREATE TABLE tblreseteopass(
    username varchar(10) PRIMARY KEY,
    token varchar(64) NOT NULL,
    creado timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE tablaLog(
    id int NOT NULL AUTO_INCREMENT,
    tipoDeEvento varchar(15) NOT NULL,
    usuario varchar(20),
    fecha timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    descripcion varchar(200) NOT NULL,
    CONSTRAINT tablaLog_pk PRIMARY KEY (id)
);

CREATE TABLE donacion(
    id int NULL PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(20),
    fecha  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    numeroDeTarjeta varchar(127),
    codigoDeSeguridad varchar(4),
    fechaDeVencimiento char(5),
    monto int,
    patrocinador int,
    CONSTRAINT donacionPatrocinador_fk FOREIGN KEY (patrocinador) REFERENCES patrocinador(id)
);




