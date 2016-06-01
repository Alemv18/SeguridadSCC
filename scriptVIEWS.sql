
-- VIEWS

CREATE VIEW ninos as
	SELECT i.nombre ,n.nombres, apellidoPat, apellidoMat, getEdadNino(n.id, n.fechaDeNac) as edad
    FROM nino n JOIN institucion i ON i.id= n.institucion ORDER BY institucion;
    
   
CREATE VIEW voluntarios AS
	SELECT matricula, nombres, apellidoPat, apellidoMat, email, escolaridad, semestre
    FROM voluntario ORDER BY escolaridad, matricula;

CREATE VIEW usuariosAdmin AS
	SELECT v.nombres, v.apellidoPat, v.apellidoMat, u.username
    FROM usuario u JOIN voluntario v USING(matricula)
    WHERE tipo= 'admin';

CREATE VIEW usuariosMesa AS
	SELECT v.nombres, v.apellidoPat, v.apellidoMat, u.username
    FROM usuario u JOIN voluntario v USING(matricula)
    WHERE tipo= 'mesa';
    

CREATE VIEW usuariosInst AS
	SELECT i.nombre, u.username
    FROM usuario u JOIN institucion i ON u.institucion = i.id;