ALTER TABLE cliente2 ADD COLUMN profesion_plantilla VARCHAR(200);



CREATE TRIGGER fnprofesion_plantilla BEFORE INSERT ON cliente2
  FOR EACH ROW 
BEGIN
		SET NEW.profesion_plantilla=NEW.detaprofesion;
		SET NEW.detaprofesion = (SELECT desprofesion FROM profesiones as  p where p.idprofesion=NEW.idprofesion);
END


UPDATE cliente2 SET profesion_plantilla = detaprofesion ;


alter table usuarios add column dni varchar (8);

quitar not null a la tabla de cliente2


-- ACTUALZIAICON 28/12/200
CREATE
    /*!50017 DEFINER = 'root'@'localhost' */
    TRIGGER `fnprofesion_plantilla_update` BEFORE UPDATE ON `cliente2` 
    FOR EACH ROW BEGIN

		SET NEW.profesion_plantilla=NEW.detaprofesion;

		SET NEW.detaprofesion = (SELECT desprofesion FROM profesiones AS  p WHERE p.idprofesion=NEW.idprofesion);

END;

--07/02/2025

CREATE INDEX idx_kardex_codactos ON kardex (codactos);
CREATE INDEX idx_responsable_new ON kardex (responsable_new);
CREATE INDEX idx_idcontratante ON contratantes (idcontratante);
CREATE INDEX idx_parte ON contratantesxacto (parte);
CREATE INDEX idx_renta_idcontratante ON renta (idcontratante);
CREATE INDEX idx_codactos_fecha ON kardex (codactos, fechaescritura);
CREATE INDEX idx_loginusuario ON usuarios (loginusuario);
CREATE INDEX idx_ofondo_parte ON contratantesxacto (ofondo, parte);
CREATE INDEX idx_kardex_detallebienes ON detallebienes (kardex);
CREATE INDEX idx_detbien_idtipbien ON detallebienes (detbien, idtipbien, tipob);
CREATE INDEX idx_preguntas ON renta (pregu1, pregu2, pregu3);


CREATE INDEX idx_kardex_consulta ON kardex (responsable_new(50), codactos, idkardex);
CREATE INDEX idx_kardex_codactos_responsable ON kardex (codactos(20), responsable_new(50));
CREATE INDEX idx_contratantes_kardex ON contratantes (kardex, idcontratante);
CREATE INDEX idx_cliente2_idcontratante ON cliente2 (idcontratante, tipper);
CREATE INDEX idx_cxa_parte_idcontratante ON contratantesxacto (parte, idcontratante);
CREATE INDEX idx_renta_idcontratante_2 ON renta (idcontratante, pregu1, pregu2, pregu3);
CREATE INDEX idx_kardex_responsable_codactos_fecha ON kardex (responsable_new(50), codactos(10), fechaescritura, idkardex);
CREATE INDEX idx_detallebienes_bienes ON detallebienes (kardex, detbien, idtipbien, tipob);
CREATE INDEX idx_contratantesxacto ON contratantesxacto (kardex, ofondo, parte, idcontratante);