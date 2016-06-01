INSERT INTO Voluntario VALUES ('A01233188','Liliana', 'Barraza','Pineda', '1995-06-14', 'lilyybp@hotmail.com',
	'8711438708', '7122134', 'ITIC', '6', 'XS','1');
INSERT INTO Voluntario VALUES ('A01233107', 'Benjamin', 'Arredondo', 'Sagui', '1995-05-18', 'benjis_95@hotmail.com',
	'8713343392', '7220211', 'ITIC', '6','M','1');
INSERT INTO Voluntario VALUES ('A01231278','Alejandra', 'Muñoz','Villalobos', '1995-02-23', 'alemv18@gmail.com',
	'8711453061', '7131954','ITIC','6','S','1');
INSERT INTO Voluntario VALUES ('A01233189','Dulce Andrea', 'Salas','Bonilla', '1995-09-26', 'dulceasb@hmail.com',
	'8711889900', '7134433','IMT','6','XS','1');
INSERT INTO Voluntario VALUES ('A01233236','Maria Fernanda', 'Avalos','Silos', '1995-05-20', 'fernanda_-340@hmail.com',
	'8711009988', '7198877','IMT','6','XS','1');

-- insert institucion
INSERT INTO institucion (nombre, direccion, contacto, telefono, email, visible) VALUES ('Fundacion Down','Col. Estrella Calle Mexico','Paty Lopez','7223311','fundacionDowns@hotmail.com','1');
INSERT INTO institucion (nombre, direccion, contacto, telefono, email, visible) VALUES ('Ver Contigo','Col. Villa Jardin','Juan Gonzalez','7998877','verContigo@hotmail.com','1');


-- insert patrocinador
INSERT INTO patrocinador VALUES (1,'Lala','Juan Perez', 'Gomez Palacio, Zona Industrial', 'lala@hotmail.com', '1','7660908');
INSERT INTO patrocinador VALUES (2,'Cimaco','Andrea Jimenez', 'Cuatro caminos, independencia', 'cimaco@hotmail.com','1','7557788');


-- insert discapacidad
INSERT INTO discapacidad VALUES (1, 'Sindrome de Down');
INSERT INTO discapacidad VALUES (2, 'Ceguera');
INSERT INTO discapacidad VALUES (3, 'Autismo');


-- insert niño
INSERT INTO nino VALUES (1, 'Johnny','Lopez','Gonzalez','2003-11-01',1, 1,'M','1','1');
INSERT INTO nino VALUES (2, 'Lupita','Perez','Sanchez','2000-09-11', 2, 2,'F','9','1');
INSERT INTO nino VALUES (3, 'Andres','Marquez','Davila','2004-01-30',2, 2,'M','9','1');

-- inserts PERMISOS

INSERT INTO permiso (descripcion) VALUES ('Ver usuarios');
INSERT INTO permiso (descripcion) VALUES ('Crear usuario');
INSERT INTO permiso (descripcion) VALUES ('Editar usuario');
INSERT INTO permiso (descripcion) VALUES ('Eliminar usuario');
INSERT INTO permiso (descripcion) VALUES ('Ver voluntarios');
INSERT INTO permiso (descripcion) VALUES ('Crear voluntario');
INSERT INTO permiso (descripcion) VALUES ('Editar voluntario');
INSERT INTO permiso (descripcion) VALUES ('Eliminar voluntario');
INSERT INTO permiso (descripcion) VALUES ('Ver patrocinadores');
INSERT INTO permiso (descripcion) VALUES ('Agregar patrocinador');
INSERT INTO permiso (descripcion) VALUES ('Editar patrocinador');
INSERT INTO permiso (descripcion) VALUES ('Eliminar patrocinador');
INSERT INTO permiso (descripcion) VALUES ('Ver instituciones');
INSERT INTO permiso (descripcion) VALUES ('Agregar institución');
INSERT INTO permiso (descripcion) VALUES ('Editar institución');
INSERT INTO permiso (descripcion) VALUES ('Eliminar institución');
INSERT INTO permiso (descripcion) VALUES ('Ver niños');
INSERT INTO permiso (descripcion) VALUES ('Agregar niño');
INSERT INTO permiso (descripcion) VALUES ('Editar niño');
INSERT INTO permiso (descripcion) VALUES ('Eliminar niño');

-- PROCEDURES

delimiter //
CREATE PROCEDURE insertPermisosAdmin (username varchar(20))
	BEGIN
		DECLARE x INT;
        SET x = 0;
        REPEAT
			SET x = x+1;
            INSERT INTO usuarioPermiso VALUES (username, x);
        UNTIL x = 20
        END REPEAT;
	END;

delimiter //
CREATE PROCEDURE insertPermisosMesa (username varchar(20))
	BEGIN
		DECLARE x INT;
        SET x = 0;
        REPEAT
			SET x = x+1;
			INSERT INTO usuarioPermiso VALUES (username, x);
			SET x = x+1;
			INSERT INTO usuarioPermiso VALUES (username, x);
			SET x = x + 2;
        UNTIL x = 20
        END REPEAT;
	END;

delimiter //
CREATE PROCEDURE insertPermisosInst (username varchar(20))
	BEGIN
		DECLARE x INT;
        SET x = 0;
        INSERT INTO usuarioPermiso VALUES (username, 17);
		INSERT INTO usuarioPermiso VALUES (username, 18);
		INSERT INTO usuarioPermiso VALUES (username, 19);

	END;

delimiter //
CREATE TRIGGER registrarPermisos
AFTER INSERT ON Usuario
FOR EACH ROW 
	BEGIN
		CASE
			WHEN new.tipo = 'Admin' THEN CALL insertPermisosAdmin(new.username);
			WHEN new.tipo = 'Mesa' THEN CALL insertPermisosMesa(new.username) ;
			WHEN new.tipo = 'Inst' THEN CALL insertPermisosInst(new.username) ;
		END CASE;
	END;


-- insert usuario
INSERT INTO usuario (username, matricula, password, tipo) VALUES ('A01233188','A01233188','bey9c6C7qGtu2','admin'); 
INSERT INTO usuario (username, matricula, password, tipo) VALUES ('A01233107','A01233107','berFqUDue9NTI','mesa');
INSERT INTO usuario (username, password, tipo,institucion) VALUES ('verContigo','beq4kDVQwNRQY', 'inst',2);




-- insert opcionesNavegacion


INSERT INTO opcionesNavegacion VALUES (1, 'Eventos', 'eventos.php', '1');
INSERT INTO opcionesNavegacion VALUES (2, '\&iquestQui\&eacutenes somos?', 'acerca.php', '1');
INSERT INTO opcionesNavegacion VALUES (3, 'Patrocinadores', 'patrocinadores.php', '1');
INSERT INTO opcionesNavegacion VALUES (4, 'Donaciones', 'donaciones.php', '1');
INSERT INTO opcionesNavegacion VALUES (5, 'Contacto', 'contacto.php', '1');
INSERT INTO opcionesNavegacion VALUES (6, 'Administraci\&oacuten', 'listarNinos.php', '0');
INSERT INTO opcionesNavegacion VALUES (7, 'Iniciar Sesi\&oacuten', 'sesion.php', '1');
INSERT INTO opcionesNavegacion VALUES (8, 'Cerrar Sesi\&oacuten', 'cerrarSesion.php', '0');

-- insert opcionesAdministracion
INSERT INTO opcionesAdministracion (nombre, href, permiso) VALUES ('Administraci\&oacuten de Voluntarios', 'listarVoluntarios.php', '1');
INSERT INTO opcionesAdministracion (nombre, href, permiso) VALUES ('Administraci\&oacuten de Instituciones', 'listarInstitucion.php', '5');
INSERT INTO opcionesAdministracion (nombre, href, permiso) VALUES ('Administraci\&oacuten de Patrocinadores', 'listarPatrocinadores.php', '9');
INSERT INTO opcionesAdministracion (nombre, href, permiso) VALUES ('Administraci\&oacuten de Usuarios', 'listarUsuarios.php', '13');
INSERT INTO opcionesAdministracion (nombre, href, permiso) VALUES ('Administraci\&oacuten de Niños', 'listarNinos.php', '17');

-- insert evento
INSERT INTO evento (id, descripcion, fechaInicio, encargado) VALUES (1, 'Posada 2015','2015-12-11','A01233107');
INSERT INTO evento (id, descripcion, fechaInicio, encargado) VALUES (2, 'Verano 2016','2016-05-23','A01233107');

-- insert voluntarioEvento

INSERT INTO voluntarioEvento VALUES (1,'A01233188');
INSERT INTO voluntarioEvento VALUES (2,'A01233188');
INSERT INTO voluntarioEvento VALUES (1,'A01233107');
INSERT INTO voluntarioEvento VALUES (2,'A01233107');
INSERT INTO voluntarioEvento VALUES (1,'A01233189');

-- insert InstitucionEvento


INSERT INTO institucionEvento VALUES (1,1);
INSERT INTO institucionEvento VALUES (1,2);
INSERT INTO institucionEvento VALUES (2,1);
INSERT INTO institucionEvento VALUES (2,2);


-- insert patrocinadorEvento

INSERT INTO patrocinadorEvento VALUES (1,1);
INSERT INTO patrocinadorEvento VALUES (1,2);
INSERT INTO patrocinadorEvento VALUES (2,2);
 
-- insert ninoEvento


INSERT INTO ninoEvento VALUES (1,1);
INSERT INTO ninoEvento VALUES (2,1);
INSERT INTO ninoEvento VALUES (1,2);
INSERT INTO ninoEvento VALUES (1,3);
INSERT INTO ninoEvento VALUES (2,3);



