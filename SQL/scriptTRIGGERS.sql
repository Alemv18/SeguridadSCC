
--TRIGGER que bloquea usuario si intentos=6

delimiter //
CREATE TRIGGER bloquearUsuario
	BEFORE UPDATE ON usuario
    FOR EACH ROW
BEGIN
	IF NEW.intentos = 6 THEN 
	SET NEW.bloqueado = 1;
	END IF;
END;//
 