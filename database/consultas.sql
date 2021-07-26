--Trigger para cuando inserten un dispositivo rapido se un recurso para asignar.
CREATE TRIGGER recursoDispositivo AFTER INSERT ON dispositivo
FOR EACH ROW INSERT INTO recurso (idDispositivoR) VALUES (NEW.idDispositivo)

--tipoUsuario
INSERT INTO `tipoUsuario` (`idTipoUsuario`, `plataforma`) VALUES (NULL, 'windows'),(NULL, 'globalization'),
(NULL, 'darwin'),(NULL, 'rackspace'),(NULL, 'google'),(NULL, 'sap');

--tipoMovimiento
INSERT INTO `tipoMovimiento` (`idtipoMovimiento`, `tipoMovimiento`) VALUES (NULL, 'asignacion'),
(NULL,'cambio'),(NULL,'revocado'),(NULL,'prestamo');

--tipoMovimiento
INSERT INTO `tipoDispositivo` (`idTipoDispositivo`, `nombreTipoRecurso`) VALUES (NULL, 'laptop'),
(NULL, 'desktop'),(NULL, 'monitor'),(NULL, 'teclado'),(NULL, 'mouse');

--puestos
INSERT INTO `Puesto` (`idPuesto`, `nombrePuesto`) VALUES (NULL, 'especialista'),
(NULL, 'coach');

--marca
INSERT INTO `Modelo` (`idModelo`, `nombreModelo`, `idMarca`) VALUES (NULL, 'GW2780', '2'),
(NULL, 'LED-W19-204', '1'),(NULL, 'VA27EHE', '3'),(NULL, 'G27C5', '2');
