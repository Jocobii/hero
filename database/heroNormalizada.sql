-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2021 at 11:43 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pruebahero`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `idArea` int(11) NOT NULL,
  `nombreArea` varchar(45) NOT NULL,
  `idDepartamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`idArea`, `nombreArea`, `idDepartamento`) VALUES
(1, 'TI', 1);

-- --------------------------------------------------------

--
-- Table structure for table `colaborador`
--

CREATE TABLE `colaborador` (
  `idColaborador` int(11) NOT NULL,
  `nombreCol` varchar(45) NOT NULL,
  `ApPaternoCol` varchar(45) NOT NULL,
  `ApMaterno` varchar(45) DEFAULT NULL,
  `numServidor` varchar(45) NOT NULL,
  `fechaNacCol` date NOT NULL,
  `emailCol` varchar(45) DEFAULT NULL,
  `linkComodato` varchar(100) DEFAULT NULL,
  `estadoCol` char(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `idSede` int(11) NOT NULL,
  `idEquipo` int(11) DEFAULT NULL,
  `idPuesto` int(11) NOT NULL,
  `celular` varchar(10) NOT NULL,
  `shortel` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `colaborador`
--

INSERT INTO `colaborador` (`idColaborador`, `nombreCol`, `ApPaternoCol`, `ApMaterno`, `numServidor`, `fechaNacCol`, `emailCol`, `linkComodato`, `estadoCol`, `created_at`, `updated_at`, `idSede`, `idEquipo`, `idPuesto`, `celular`, `shortel`) VALUES
(1, 'Alexander', 'Vazquez', 'Jocobi', '100779', '2001-02-05', 'alexander.vazquez@g-global.com', 'https://drive.google.com/file/d/1-SJcsN0vqcB4Xovo3RPoBoIrnlsn7UzG/view?usp=sharing', '1', '2021-06-19 04:28:27', '2021-07-09 14:28:43', 1, 1, 2, '6647738664', '666'),
(2, 'Ileana', 'Verduzco', 'Escalera', '100315', '2001-02-05', 'ileana.verduzco@g-global.com', 'https://drive.google.com/file/d/1dN2McKy7nCtbAIP9MA9EtwX2LFlhZwM6/view?usp=sharing', '1', '2021-06-19 04:28:27', '2021-06-15 19:53:08', 1, 2, 2, '', ''),
(3, 'Yobani', 'Vital', NULL, '100719', '1990-06-15', 'yobani.vital@g-global.com', 'https://drive.google.com/drive/u/0/folders/1BPx1HNyBVzJ7Ke9CMuS7mKEvX4VL3Bpe', '1', '2021-06-19 04:28:27', NULL, 1, 2, 1, '', ''),
(4, 'yhovan', 'bojorquez', NULL, '100999', '1990-06-15', 'yhovan.borjorquez@g-global.com', 'https://drive.google.com/drive/u/0/folders/1BPx1HNyBVzJ7Ke9CMuS7mKEvX4VL3Bpe', '1', '2021-06-19 04:28:27', '2021-07-09 14:29:22', 1, 1, 1, '', ''),
(5, 'uziel', 'Estrada', NULL, '100876', '1990-02-15', 'uziel.estrada@g-global.com', 'https://drive.google.com/drive/u/0/folders/1BPx1HNyBVzJ7Ke9CMuS7mKEvX4VL3Bpe', '1', '2021-06-19 04:28:27', NULL, 1, 1, 1, '', ''),
(6, 'roman', 'tercero', NULL, '100546', '1999-06-15', 'roman.tercero@g-global.com', 'https://drive.google.com/drive/u/0/folders/1BPx1HNyBVzJ7Ke9CMuS7mKEvX4VL3Bpe', '1', '2021-06-19 04:28:27', NULL, 1, 1, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE `compra` (
  `idCompra` int(11) NOT NULL,
  `cantidadCompra` int(11) NOT NULL,
  `totalCompra` float NOT NULL,
  `descripcionCompra` varchar(255) NOT NULL,
  `facturaCompra` varchar(45) DEFAULT NULL,
  `fechaCompra` date DEFAULT NULL,
  `fechaRegistroCompra` date NOT NULL,
  `fechaActualizacionCompra` date DEFAULT NULL,
  `idCompradorCompra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `departamento`
--

CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL,
  `nombreDpto` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `nombreDpto`) VALUES
(1, 'Tecnologias de la informacion');

-- --------------------------------------------------------

--
-- Table structure for table `dispositivo`
--

CREATE TABLE `dispositivo` (
  `idDispositivo` int(11) NOT NULL,
  `descripcionDispositivo` varchar(45) DEFAULT NULL,
  `serieDispositivo` varchar(45) NOT NULL,
  `procesadorDisposito` varchar(45) DEFAULT NULL,
  `memoriaDispositivo` varchar(45) DEFAULT NULL,
  `almacenamientoDispositivo` varchar(45) DEFAULT NULL,
  `resolucionDispositivo` varchar(45) DEFAULT NULL,
  `puertosVideo` varchar(45) DEFAULT NULL,
  `tipoDispositivo` int(11) NOT NULL,
  `modeloDispositivo` int(11) NOT NULL,
  `estadoFisico` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dispositivo`
--

INSERT INTO `dispositivo` (`idDispositivo`, `descripcionDispositivo`, `serieDispositivo`, `procesadorDisposito`, `memoriaDispositivo`, `almacenamientoDispositivo`, `resolucionDispositivo`, `puertosVideo`, `tipoDispositivo`, `modeloDispositivo`, `estadoFisico`) VALUES
(2, 'monitor nuevo', 'FK42KJ2QV', NULL, NULL, NULL, NULL, 'HDMI, VGA', 3, 1, 'nuevo'),
(3, 'monitor nuevo', 'LK42J6HZ', NULL, NULL, NULL, NULL, 'HDMI, DISPLAY', 3, 4, 'nuevo');

-- --------------------------------------------------------

--
-- Table structure for table `dpto_sede`
--

CREATE TABLE `dpto_sede` (
  `idDpto_Sede` int(11) NOT NULL,
  `idDpto` int(11) NOT NULL,
  `idSede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dpto_sede`
--

INSERT INTO `dpto_sede` (`idDpto_Sede`, `idDpto`, `idSede`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `equipo`
--

CREATE TABLE `equipo` (
  `idEquipo` int(11) NOT NULL,
  `nombreEquipo` varchar(45) NOT NULL,
  `codEquipo` varchar(45) NOT NULL,
  `emailEquipo` varchar(45) DEFAULT NULL,
  `idArea` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equipo`
--

INSERT INTO `equipo` (`idEquipo`, `nombreEquipo`, `codEquipo`, `emailEquipo`, `idArea`) VALUES
(1, 'DevTI', 'DT', 'DevTI@g-global.com', 1),
(2, 'TI', 'TI', 'ti@g-global.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `marca`
--

CREATE TABLE `marca` (
  `idMarca` int(11) NOT NULL,
  `nombreMarca` varchar(45) NOT NULL,
  `statusMarca` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marca`
--

INSERT INTO `marca` (`idMarca`, `nombreMarca`, `statusMarca`) VALUES
(1, 'dell', 1),
(2, 'asus', 1),
(3, 'vorago', 1),
(4, 'benq', 1),
(5, 'acer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modelo`
--

CREATE TABLE `modelo` (
  `idModelo` int(11) NOT NULL,
  `nombreModelo` varchar(45) NOT NULL,
  `idMarca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modelo`
--

INSERT INTO `modelo` (`idModelo`, `nombreModelo`, `idMarca`) VALUES
(1, 'GW2780', 2),
(2, 'GW2780', 2),
(3, 'LED-W19-204', 1),
(4, 'VA27EHE', 3),
(5, 'G27C5', 2);

-- --------------------------------------------------------

--
-- Table structure for table `puesto`
--

CREATE TABLE `puesto` (
  `idPuesto` int(11) NOT NULL,
  `nombrePuesto` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `puesto`
--

INSERT INTO `puesto` (`idPuesto`, `nombrePuesto`) VALUES
(1, 'especialista'),
(2, 'coach');

-- --------------------------------------------------------

--
-- Table structure for table `recurso`
--

CREATE TABLE `recurso` (
  `idRecurso` int(11) NOT NULL,
  `codigoServicioRecurso` varchar(45) DEFAULT NULL,
  `precioRecurso` varchar(45) DEFAULT NULL,
  `fechaRegistroRecurso` date NOT NULL,
  `stockRecurso` int(11) DEFAULT NULL,
  `estadoRecurso` int(11) NOT NULL,
  `idColaboradorActual` int(11) NOT NULL,
  `idUsuarioGestion` int(11) NOT NULL,
  `idSede` int(11) NOT NULL,
  `idDispositivoR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recurso`
--

INSERT INTO `recurso` (`idRecurso`, `codigoServicioRecurso`, `precioRecurso`, `fechaRegistroRecurso`, `stockRecurso`, `estadoRecurso`, `idColaboradorActual`, `idUsuarioGestion`, `idSede`, `idDispositivoR`) VALUES
(2, NULL, NULL, '2021-06-18', NULL, 1, 1, 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `recursomovimiento`
--

CREATE TABLE `recursomovimiento` (
  `idRecursoMovimiento` int(11) NOT NULL,
  `idRecurso` int(11) NOT NULL,
  `idColaboradorAnterior` int(11) NOT NULL,
  `idColaboradorCambio` int(11) NOT NULL,
  `recursoMovimientoFecha` datetime DEFAULT current_timestamp(),
  `idUsuarioGestion` int(11) NOT NULL,
  `idTipoMovimiento` int(11) NOT NULL,
  `motivoRecusoMovimiento` text NOT NULL,
  `notaRecusoMovimiento` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recursomovimiento`
--

INSERT INTO `recursomovimiento` (`idRecursoMovimiento`, `idRecurso`, `idColaboradorAnterior`, `idColaboradorCambio`, `recursoMovimientoFecha`, `idUsuarioGestion`, `idTipoMovimiento`, `motivoRecusoMovimiento`, `notaRecusoMovimiento`) VALUES
(1, 2, 2, 1, '2021-07-09 00:00:00', 5, 4, 'fasdkmdnfkjasdfkjlasdhfkjladshfljkadsfhlkjasdhflkjasdhflkjsadf', 'asdfhasdljkfhasdlfhkljasdfhlasdhflkjasdhf'),
(2, 2, 3, 1, '0000-00-00 00:00:00', 4, 2, 'dasasdfsadfasdfasdf', 'asdfasdfasdfsdf'),
(3, 2, 3, 1, '2021-07-09 14:41:45', 4, 2, 'dasasdfsadfasdfasdf', 'asdfasdfasdfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `recurso_compra`
--

CREATE TABLE `recurso_compra` (
  `idrecurso_compra` int(11) NOT NULL,
  `idRecursoRC` int(11) NOT NULL,
  `idCompraRC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sede`
--

CREATE TABLE `sede` (
  `idSede` int(11) NOT NULL,
  `codSede` char(3) NOT NULL,
  `nombreSede` varchar(45) NOT NULL,
  `calleSede` varchar(45) NOT NULL,
  `numeroExtSede` varchar(45) NOT NULL,
  `numeroIntSede` varchar(45) DEFAULT NULL,
  `coloniaSede` varchar(45) NOT NULL,
  `codPostalSede` varchar(45) NOT NULL,
  `ciudadSede` varchar(30) NOT NULL,
  `estadoSede` varchar(30) NOT NULL,
  `paisSede` varchar(45) NOT NULL,
  `telefonoSede` char(10) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sede`
--

INSERT INTO `sede` (`idSede`, `codSede`, `nombreSede`, `calleSede`, `numeroExtSede`, `numeroIntSede`, `coloniaSede`, `codPostalSede`, `ciudadSede`, `estadoSede`, `paisSede`, `telefonoSede`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'TJ', 'Tijuana Office', 'Bellas artes', '412321', NULL, 'Otay', '23145', 'Tijuana', 'Baja california', 'Mexico', '6643124561', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tipodispositivo`
--

CREATE TABLE `tipodispositivo` (
  `idTipoDispositivo` int(11) NOT NULL,
  `nombreTipoRecurso` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipodispositivo`
--

INSERT INTO `tipodispositivo` (`idTipoDispositivo`, `nombreTipoRecurso`) VALUES
(1, 'laptop'),
(2, 'desktop'),
(3, 'monitor'),
(4, 'teclado'),
(5, 'mouse');

-- --------------------------------------------------------

--
-- Table structure for table `tipomovimiento`
--

CREATE TABLE `tipomovimiento` (
  `idtipoMovimiento` int(11) NOT NULL,
  `tipoMovimiento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipomovimiento`
--

INSERT INTO `tipomovimiento` (`idtipoMovimiento`, `tipoMovimiento`) VALUES
(1, 'asignacion'),
(2, 'cambio'),
(3, 'revocado'),
(4, 'prestamo');

-- --------------------------------------------------------

--
-- Table structure for table `tipousuario`
--

CREATE TABLE `tipousuario` (
  `idTipoUsuario` int(11) NOT NULL,
  `plataforma` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipousuario`
--

INSERT INTO `tipousuario` (`idTipoUsuario`, `plataforma`) VALUES
(1, 'Equipo'),
(2, 'globalization'),
(3, 'darwin'),
(4, 'rackspace'),
(5, 'google'),
(6, 'sap');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(45) NOT NULL,
  `passwordUsuario` text NOT NULL,
  `idColaborador` int(11) NOT NULL,
  `idTipoUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombreUsuario`, `passwordUsuario`, `idColaborador`, `idTipoUsuario`) VALUES
(1, 'avazquez', 'Central.TI', 1, 1),
(2, 'iverduzco', 'ileana123', 2, 6),
(3, 'avazquez', 'Central.TI', 1, 6),
(4, 'avazquez', 'Central.TI', 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`idArea`),
  ADD KEY `idDepartamento` (`idDepartamento`);

--
-- Indexes for table `colaborador`
--
ALTER TABLE `colaborador`
  ADD PRIMARY KEY (`idColaborador`),
  ADD KEY `idSede` (`idSede`),
  ADD KEY `idEquipo` (`idEquipo`),
  ADD KEY `idPuestoC` (`idPuesto`);

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idCompra`),
  ADD KEY `idCompradorCompra` (`idCompradorCompra`);

--
-- Indexes for table `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`idDepartamento`);

--
-- Indexes for table `dispositivo`
--
ALTER TABLE `dispositivo`
  ADD PRIMARY KEY (`idDispositivo`),
  ADD KEY `tipoDispositivo` (`tipoDispositivo`),
  ADD KEY `modeloDispositivo` (`modeloDispositivo`);

--
-- Indexes for table `dpto_sede`
--
ALTER TABLE `dpto_sede`
  ADD PRIMARY KEY (`idDpto_Sede`),
  ADD KEY `idDpto` (`idDpto`),
  ADD KEY `idSede3` (`idSede`);

--
-- Indexes for table `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`idEquipo`),
  ADD KEY `idArea` (`idArea`);

--
-- Indexes for table `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idMarca`);

--
-- Indexes for table `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`idModelo`),
  ADD KEY `idMarca` (`idMarca`);

--
-- Indexes for table `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`idPuesto`);

--
-- Indexes for table `recurso`
--
ALTER TABLE `recurso`
  ADD PRIMARY KEY (`idRecurso`),
  ADD KEY `idColaboradorActual` (`idColaboradorActual`),
  ADD KEY `idUsuarioGestion` (`idUsuarioGestion`),
  ADD KEY `idSede2` (`idSede`),
  ADD KEY `idDispositivoR` (`idDispositivoR`);

--
-- Indexes for table `recursomovimiento`
--
ALTER TABLE `recursomovimiento`
  ADD PRIMARY KEY (`idRecursoMovimiento`),
  ADD KEY `idRecurso` (`idRecurso`),
  ADD KEY `idColaboradorAnterior` (`idColaboradorAnterior`),
  ADD KEY `idColaboradorCambio` (`idColaboradorCambio`),
  ADD KEY `idUsuarioGestion2` (`idUsuarioGestion`),
  ADD KEY `idTipoMovimiento` (`idTipoMovimiento`);

--
-- Indexes for table `recurso_compra`
--
ALTER TABLE `recurso_compra`
  ADD PRIMARY KEY (`idrecurso_compra`),
  ADD KEY `idRecursoRC` (`idRecursoRC`),
  ADD KEY `idCompraRC` (`idCompraRC`);

--
-- Indexes for table `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`idSede`);

--
-- Indexes for table `tipodispositivo`
--
ALTER TABLE `tipodispositivo`
  ADD PRIMARY KEY (`idTipoDispositivo`);

--
-- Indexes for table `tipomovimiento`
--
ALTER TABLE `tipomovimiento`
  ADD PRIMARY KEY (`idtipoMovimiento`);

--
-- Indexes for table `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`idTipoUsuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`,`nombreUsuario`),
  ADD KEY `idColaboradorU` (`idColaborador`),
  ADD KEY `idTipoUsuarioU` (`idTipoUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `idArea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `colaborador`
--
ALTER TABLE `colaborador`
  MODIFY `idColaborador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `idCompra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dispositivo`
--
ALTER TABLE `dispositivo`
  MODIFY `idDispositivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dpto_sede`
--
ALTER TABLE `dpto_sede`
  MODIFY `idDpto_Sede` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idEquipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `modelo`
--
ALTER TABLE `modelo`
  MODIFY `idModelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `puesto`
--
ALTER TABLE `puesto`
  MODIFY `idPuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recurso`
--
ALTER TABLE `recurso`
  MODIFY `idRecurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recursomovimiento`
--
ALTER TABLE `recursomovimiento`
  MODIFY `idRecursoMovimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recurso_compra`
--
ALTER TABLE `recurso_compra`
  MODIFY `idrecurso_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sede`
--
ALTER TABLE `sede`
  MODIFY `idSede` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tipodispositivo`
--
ALTER TABLE `tipodispositivo`
  MODIFY `idTipoDispositivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tipomovimiento`
--
ALTER TABLE `tipomovimiento`
  MODIFY `idtipoMovimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `idTipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `idDepartamento` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`);

--
-- Constraints for table `colaborador`
--
ALTER TABLE `colaborador`
  ADD CONSTRAINT `idEquipo` FOREIGN KEY (`idEquipo`) REFERENCES `equipo` (`idEquipo`),
  ADD CONSTRAINT `idPuestoC` FOREIGN KEY (`idPuesto`) REFERENCES `puesto` (`idPuesto`),
  ADD CONSTRAINT `idSede` FOREIGN KEY (`idSede`) REFERENCES `sede` (`idSede`);

--
-- Constraints for table `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `idCompradorCompra` FOREIGN KEY (`idCompradorCompra`) REFERENCES `colaborador` (`idColaborador`);

--
-- Constraints for table `dispositivo`
--
ALTER TABLE `dispositivo`
  ADD CONSTRAINT `Dispositivo_ibfk_1` FOREIGN KEY (`modeloDispositivo`) REFERENCES `modelo` (`idModelo`),
  ADD CONSTRAINT `tipoDispositivo` FOREIGN KEY (`tipoDispositivo`) REFERENCES `tipodispositivo` (`idTipoDispositivo`);

--
-- Constraints for table `dpto_sede`
--
ALTER TABLE `dpto_sede`
  ADD CONSTRAINT `idDpto` FOREIGN KEY (`idDpto`) REFERENCES `departamento` (`idDepartamento`),
  ADD CONSTRAINT `idSede3` FOREIGN KEY (`idSede`) REFERENCES `sede` (`idSede`);

--
-- Constraints for table `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `idArea` FOREIGN KEY (`idArea`) REFERENCES `area` (`idArea`);

--
-- Constraints for table `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `idMarca` FOREIGN KEY (`idMarca`) REFERENCES `marca` (`idMarca`);

--
-- Constraints for table `recurso`
--
ALTER TABLE `recurso`
  ADD CONSTRAINT `idColaboradorActual` FOREIGN KEY (`idColaboradorActual`) REFERENCES `colaborador` (`idColaborador`),
  ADD CONSTRAINT `idDispositivoR` FOREIGN KEY (`idDispositivoR`) REFERENCES `dispositivo` (`idDispositivo`),
  ADD CONSTRAINT `idSede2` FOREIGN KEY (`idSede`) REFERENCES `sede` (`idSede`),
  ADD CONSTRAINT `idUsuarioGestion` FOREIGN KEY (`idUsuarioGestion`) REFERENCES `colaborador` (`idColaborador`);

--
-- Constraints for table `recursomovimiento`
--
ALTER TABLE `recursomovimiento`
  ADD CONSTRAINT `idColaboradorAnterior` FOREIGN KEY (`idColaboradorAnterior`) REFERENCES `colaborador` (`idColaborador`),
  ADD CONSTRAINT `idColaboradorCambio` FOREIGN KEY (`idColaboradorCambio`) REFERENCES `colaborador` (`idColaborador`),
  ADD CONSTRAINT `idRecurso` FOREIGN KEY (`idRecurso`) REFERENCES `recurso` (`idRecurso`),
  ADD CONSTRAINT `idTipoMovimiento` FOREIGN KEY (`idTipoMovimiento`) REFERENCES `tipomovimiento` (`idtipoMovimiento`),
  ADD CONSTRAINT `idUsuarioGestion2` FOREIGN KEY (`idUsuarioGestion`) REFERENCES `colaborador` (`idColaborador`);

--
-- Constraints for table `recurso_compra`
--
ALTER TABLE `recurso_compra`
  ADD CONSTRAINT `idCompraRC` FOREIGN KEY (`idCompraRC`) REFERENCES `compra` (`idCompra`),
  ADD CONSTRAINT `idRecursoRC` FOREIGN KEY (`idRecursoRC`) REFERENCES `recurso` (`idRecurso`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `idColaboradorU` FOREIGN KEY (`idColaborador`) REFERENCES `colaborador` (`idColaborador`),
  ADD CONSTRAINT `idTipoUsuarioU` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tipousuario` (`idTipoUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
