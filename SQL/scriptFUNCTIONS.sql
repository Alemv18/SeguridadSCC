
--FUNCIONES

delimiter //
CREATE FUNCTION getEdadNino (idNino int,fechaDeNacimiento date)  
	RETURNS INT 
    BEGIN  
		DECLARE edad INT;  
        SELECT TIMESTAMPDIFF(YEAR,fechaDeNacimiento,CURDATE()) INTO edad  
        FROM nino  
        WHERE id = idNino;  
	RETURN edad; 
    END;

delimiter //
CREATE FUNCTION getEdadVoluntario (matriculaVol varchar(20),fechaDeNacimiento date)
 RETURNS INT
BEGIN
	DECLARE edad INT;
 SELECT TIMESTAMPDIFF(YEAR,fechaDeNacimiento,CURDATE()) INTO edad
 FROM voluntario
 WHERE matricula = matriculaVol;
 RETURN edad;
END;