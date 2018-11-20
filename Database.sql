-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2018 at 04:22 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sjjpadel`
--
CREATE DATABASE IF NOT EXISTS `sjjpadel` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sjjpadel`;

-- --------------------------------------------------------

--
-- Table structure for table `campeonato`
--

CREATE TABLE `campeonato` (
  `idCampeonato` int(11) NOT NULL,
  `fechaInicioInscripcion` date NOT NULL,
  `fechaFinInscripcion` date DEFAULT NULL,
  `fechaInicioCampeonato` date DEFAULT NULL,
  `fechaFinCampeonato` date DEFAULT NULL,
  `nombreCampeonato` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campeonato`
--

INSERT INTO `campeonato` (`idCampeonato`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `fechaInicioCampeonato`, `fechaFinCampeonato`, `nombreCampeonato`) VALUES
(2, '2018-11-01', '2018-11-10', '2018-11-11', '2018-12-02', 'Campeonato Noviembre'),
(3, '2018-12-01', '2018-11-01', '2018-12-02', '2018-12-12', 'Campeonato puente constitucion');

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nivel` varchar(20) NOT NULL,
  `sexo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nivel`, `sexo`) VALUES
(1, 'principiante', 'masculino'),
(2, 'principiante', 'femenino'),
(3, 'principiante', 'mixto'),
(4, 'amateur', 'masculino'),
(5, 'amateur', 'femenino'),
(6, 'amateur', 'mixto'),
(7, 'profesional', 'masculino'),
(8, 'profesional', 'femenino'),
(9, 'profesional', 'mixto');

-- --------------------------------------------------------

--
-- Table structure for table `categoriascampeonato`
--

CREATE TABLE `categoriascampeonato` (
  `idCategoriasCampeonato` int(11) NOT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  `idCampeonato` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoriascampeonato`
--

INSERT INTO `categoriascampeonato` (`idCategoriasCampeonato`, `idCategoria`, `idCampeonato`) VALUES
(1, 3, 2),
(2, 6, 2),
(3, 9, 2),
(4, 3, 3),
(5, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `enfrentamiento`
--

CREATE TABLE `enfrentamiento` (
  `idEnfrentamiento` int(11) NOT NULL,
  `idPareja1` int(11) NOT NULL,
  `idPareja2` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `puntosPareja1` int(11) DEFAULT NULL,
  `puntosPareja2` int(11) DEFAULT NULL,
  `setsPareja1` int(11) DEFAULT NULL,
  `setsPareja2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enfrentamiento`
--

INSERT INTO `enfrentamiento` (`idEnfrentamiento`, `idPareja1`, `idPareja2`, `idGrupo`, `fecha`, `hora`, `puntosPareja1`, `puntosPareja2`, `setsPareja1`, `setsPareja2`) VALUES
(1, 173, 174, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 173, 175, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 173, 176, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 173, 177, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 173, 178, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 173, 179, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 173, 180, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 174, 175, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 174, 176, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 174, 177, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 174, 178, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 174, 179, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 174, 180, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 175, 176, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 175, 177, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 175, 178, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 175, 179, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 175, 180, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 176, 177, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 176, 178, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 176, 179, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 176, 180, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 177, 178, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 177, 179, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 177, 180, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 178, 179, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 178, 180, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 179, 180, 6, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grupo`
--

CREATE TABLE `grupo` (
  `idGrupo` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idCampeonato` int(11) NOT NULL,
  `nombreGrupo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grupo`
--

INSERT INTO `grupo` (`idGrupo`, `idCategoria`, `idCampeonato`, `nombreGrupo`) VALUES
(6, 3, 3, 'Grupo A'),
(8, 3, 3, 'Grupo A'),
(10, 3, 3, 'Grupo A'),
(12, 3, 3, 'Grupo A'),
(13, 6, 3, 'Grupo A'),
(14, 3, 3, 'Grupo A'),
(15, 6, 3, 'Grupo A');

-- --------------------------------------------------------

--
-- Table structure for table `ofertaenfrentamiento`
--

CREATE TABLE `ofertaenfrentamiento` (
  `idOfertaEnfrentamiento` int(11) NOT NULL,
  `idPareja` int(11) NOT NULL,
  `hora` varchar(15) NOT NULL,
  `fecha` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organizarpartido`
--

CREATE TABLE `organizarpartido` (
  `idOrganizarPartido` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organizarpartido`
--

INSERT INTO `organizarpartido` (`idOrganizarPartido`, `fecha`, `hora`) VALUES
(1, '2018-11-21', '11:30:00'),
(2, '2018-11-23', '11:30:00'),
(3, '2018-11-25', '19:00:00'),
(5, '1970-01-01', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pareja`
--

CREATE TABLE `pareja` (
  `idPareja` int(11) NOT NULL,
  `idCapitan` varchar(20) NOT NULL,
  `idCompañero` varchar(20) NOT NULL,
  `idCategoriaCampeonato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pareja`
--

INSERT INTO `pareja` (`idPareja`, `idCapitan`, `idCompañero`, `idCategoriaCampeonato`) VALUES
(133, 'avanelli2p', 'bjankovic1p', 1),
(134, 'bkeitley1', 'briehmi', 1),
(135, 'cburkwoodc', 'cdeyenhardtj', 1),
(136, 'cjost0', 'diannini1r', 1),
(137, 'dmeeusk', 'eofielly6', 1),
(138, 'espyvyef', 'bjankovic1p', 1),
(139, 'gdittyp', 'ggainfortl', 1),
(140, 'hbremeyer2b', 'hcassea', 1),
(141, 'hcattersonz', 'hpolglase1q', 1),
(142, 'hstothere', 'jgrossier2a', 1),
(143, 'jhanwright0', 'kfirth2q', 1),
(144, 'kloftie5', 'pedro', 1),
(145, 'kloftie5', 'pedro', 1),
(146, 'juan', 'david', 1),
(147, 'santiago', 'julio', 1),
(148, 'lois', 'floro', 1),
(149, 'matias', 'cesar', 1),
(150, 'avanelli2p', 'bjankovic1p', 2),
(151, 'bkeitley1', 'briehmi', 2),
(152, 'cburkwoodc', 'cdeyenhardtj', 2),
(153, 'cjost0', 'diannini1r', 2),
(154, 'dmeeusk', 'eofielly6', 2),
(155, 'espyvyef', 'bjankovic1p', 2),
(156, 'gdittyp', 'ggainfortl', 2),
(157, 'hbremeyer2b', 'hcassea', 2),
(158, 'hcattersonz', 'hpolglase1q', 2),
(159, 'hstothere', 'jgrossier2a', 2),
(160, 'avanelli2p', 'bjankovic1p', 3),
(161, 'bkeitley1', 'briehmi', 3),
(162, 'cburkwoodc', 'cdeyenhardtj', 3),
(163, 'cjost0', 'diannini1r', 3),
(164, 'dmeeusk', 'eofielly6', 3),
(165, 'espyvyef', 'bjankovic1p', 3),
(166, 'gdittyp', 'ggainfortl', 3),
(167, 'hbremeyer2b', 'hcassea', 3),
(168, 'hcattersonz', 'hpolglase1q', 3),
(169, 'hstothere', 'jgrossier2a', 3),
(170, 'jhanwright0', 'kfirth2q', 3),
(171, 'kloftie5', 'pedro', 3),
(172, 'kloftie5', 'pedro', 3),
(173, 'avanelli2p', 'bjankovic1p', 4),
(174, 'bkeitley1', 'briehmi', 4),
(175, 'cburkwoodc', 'cdeyenhardtj', 4),
(176, 'cjost0', 'diannini1r', 4),
(177, 'dmeeusk', 'eofielly6', 4),
(178, 'espyvyef', 'bjankovic1p', 4),
(179, 'gdittyp', 'ggainfortl', 4),
(180, 'hbremeyer2b', 'hcassea', 4),
(181, 'avanelli2p', 'bjankovic1p', 5),
(182, 'bkeitley1', 'briehmi', 5),
(183, 'cburkwoodc', 'cdeyenhardtj', 5),
(184, 'cjost0', 'diannini1r', 5),
(185, 'dmeeusk', 'eofielly6', 5),
(186, 'espyvyef', 'bjankovic1p', 5),
(187, 'gdittyp', 'ggainfortl', 5),
(188, 'hbremeyer2b', 'hcassea', 5),
(189, 'hcattersonz', 'hpolglase1q', 5),
(190, 'hstothere', 'jgrossier2a', 5),
(191, 'jhanwright0', 'kfirth2q', 5),
(192, 'kloftie5', 'pedro', 5);

-- --------------------------------------------------------

--
-- Table structure for table `parejagrupo`
--

CREATE TABLE `parejagrupo` (
  `idPareja` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parejagrupo`
--

INSERT INTO `parejagrupo` (`idPareja`, `idGrupo`) VALUES
(173, 6),
(174, 6),
(175, 6),
(176, 6),
(177, 6),
(178, 6),
(179, 6),
(180, 6);

-- --------------------------------------------------------

--
-- Table structure for table `participantespartido`
--

CREATE TABLE `participantespartido` (
  `idParticipantesPartido` int(11) NOT NULL,
  `idOrganizarPartido` int(11) DEFAULT NULL,
  `loginUsuario` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participantespartido`
--

INSERT INTO `participantespartido` (`idParticipantesPartido`, `idOrganizarPartido`, `loginUsuario`) VALUES
(1, 1, 'jgrossier2a'),
(2, 1, 'bkeitley1'),
(3, 2, 'dmeeusk'),
(4, 3, 'bjankovic1p'),
(5, 3, 'cjost0');

-- --------------------------------------------------------

--
-- Table structure for table `reserva`
--

CREATE TABLE `reserva` (
  `idReserva` int(11) NOT NULL,
  `idUsuarioReserva` varchar(20) NOT NULL,
  `fechaReserva` varchar(15) NOT NULL,
  `horaReserva` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reserva`
--

INSERT INTO `reserva` (`idReserva`, `idUsuarioReserva`, `fechaReserva`, `horaReserva`) VALUES
(1, 'jgrossier2a', '2018-11-01', '10:00'),
(2, 'hcassea', '2018-11-01', '11:30'),
(3, 'mpitcockb', '2018-11-01', '11:30'),
(4, 'ywalshe29', '2018-11-01', '11:30'),
(5, 'sbellfieldy', '2018-11-01', '13:00'),
(6, 'bjankovic1p', '2018-11-01', '13:00'),
(7, 'ngavagan8', '2018-11-01', '16:00'),
(8, 'uadshed7', '2018-11-01', '16:00'),
(9, 'cjost0', '2018-11-01', '17:30'),
(10, 'dmeeusk', '2018-11-01', '19:00'),
(11, 'kloftie5', '2018-11-01', '19:00'),
(12, 'bkeitley1', '2018-11-30', '10:00'),
(13, 'bkeitley1', '2018-11-25', '19:00'),
(14, 'admin', '2018-11-15', '10:00'),
(15, 'admin', '2018-11-15', '10:00'),
(16, 'admin', '2018-11-15', '10:00'),
(17, 'admin', '2018-11-15', '10:00'),
(18, 'admin', '2018-11-15', '10:00'),
(19, 'admin', '2018-11-15', '11:30'),
(20, 'admin', '2018-11-16', '11:30'),
(21, 'admin', '2018-11-16', '11:30'),
(22, 'admin', '2018-11-16', '11:30'),
(23, 'admin', '2018-11-16', '11:30'),
(24, 'admin', '2018-11-15', '13:00'),
(25, 'admin', '2018-11-15', '13:00'),
(26, 'admin', '2018-11-15', '13:00'),
(27, 'admin', '2018-11-15', '11:30'),
(28, 'admin', '2018-11-15', '11:30'),
(29, 'admin', '2018-11-20', '10:00');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `login` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `pass` varchar(20) DEFAULT NULL,
  `rol` char(1) DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES
('aa', 'aa', 'aa', 'aa', 'd', 'masculino'),
('admin', 'admin', 'admin', 'admin', 'a', 'masculino'),
('avanelli2p', 'Audre', 'Vanelli', 'Ajqb8pziF', 'd', 'femenino'),
('bjankovic1p', 'Bernarr', 'Jankovic', 'qspW50hGXD', 'd', 'masculino'),
('bkeitley1', 'Bernie', 'Keitley', 'jRzXG', 'd', 'femenino'),
('briehmi', 'Bridie', 'Riehm', '5i6PhIVGn', 'd', 'femenino'),
('cburkwoodc', 'Connie', 'Burkwood', 'mNtJnJ9MxGQJ', 'e', 'masculino'),
('cdeyenhardtj', 'Cherilyn', 'Deyenhardt', 'Zj4y14k5Q', 'd', 'femenino'),
('cesar', 'cesar', 'barco', 'pass', 'd', 'masculino'),
('cjost0', 'Jost', 'Carmine', 'pass', 'd', 'masculino'),
('david', 'david', 'Gomez', 'pass', 'd', 'masculino'),
('diannini1r', 'Dermot', 'Iannini', 'QJ34Mbf9sEE', 'd', 'masculino'),
('dmeeusk', 'Dylan', 'Meeus', 'dykiwj23', 'd', 'masculino'),
('eofielly6', 'Etan', 'O Fielly', 'ahrVtFg', 'd', 'masculino'),
('espyvyef', 'Emile', 'Spyvye', 'gnuGNQpzU', 'd', 'masculino'),
('esruttond', 'Eachelle', 'Srutton', 'oyl7vLqER8He', 'e', 'femenino'),
('floro', 'floro', 'ramirez', 'pass', 'd', 'masculino'),
('gdittyp', 'Gun', 'Ditty', 'dykiwj23', 'd', 'masculino'),
('ggainfortl', 'Ginnifer', 'Gainfort', 'yOkuanm', 'd', 'femenino'),
('hbremeyer2b', 'Hope', 'Bremeyer', 'QGO03wlSMqP', 'd', 'femenino'),
('hcassea', 'Helena', 'Casse', '1SGe6T', 'd', 'femenino'),
('hcattersonz', 'Hy', 'Catterson', 'aEWNRX', 'd', 'masculino'),
('hpolglase1q', 'Hanan', 'Polglase', '9cljNljk45z', 'd', 'masculino'),
('hstothere', 'Harald', 'Stother', 'hdwu19XJ4', 'd', 'masculino'),
('jgrossier2a', 'Jeannette', 'Grossier', 'GEbRo5hK5qT', 'd', 'femenino'),
('jhanwright0', 'Jerry', 'Shimuk', 'ES5vx7XR', 'd', 'femenino'),
('jorge', 'jorge', 'vigo', 'pass', 'd', 'masculino'),
('jose', 'jose', 'perez', 'pass', 'd', 'masculino'),
('juan', 'juan', 'Gonzalez', 'pass', 'd', 'masculino'),
('julio', 'julio', 'Quintas', 'pass', 'd', 'masculino'),
('kfirth2q', 'Kelsy', 'Firth', '0Ecp4Q', 'd', 'femenino'),
('kloftie5', 'Kelley', 'Loftie', 'sjHZ8iW', 'd', 'masculino'),
('lois', 'lois', 'paderme', 'pass', 'd', 'masculino'),
('marcos', 'marcos', 'santas', 'pass', 'd', 'masculino'),
('matias', 'matias', 'souto', 'pass', 'd', 'masculino'),
('mhenrique10', 'Marlin', 'Henrique', 'AQZqEyJ', 'd', 'masculino'),
('mjaramg', 'Marissa', 'Jaram', 'Uh57EeVSPA', 'd', 'femenino'),
('mpitcockb', 'Mar', 'Pitcock', 'EllDkud7', 'd', 'masculino'),
('ngavagan8', 'Nico', 'Gavagan', 't1cH2', 'd', 'masculino'),
('njiroutekb', 'Normy', 'Jiroutek', 'LKdzUrL7LLO', 'd', 'masculino'),
('pedro', 'pedro', 'Gonzalez', 'pass', 'd', 'masculino'),
('rghiroldi1s', 'Ring', 'Ghiroldi', 'icpcI6p', 'd', 'masculino'),
('rswatridgec', 'Ruttger', 'Swatridge', 'S1tPv8', 'd', 'masculino'),
('santiago', 'santiago', 'gomas', 'pass', 'd', 'masculino'),
('santiD', 'Santi', 'Rodríguez González', 'rgroot', 'a', 'masculino'),
('sbau2m', 'Salaidh', 'Bau', '8SrhxWw3NR', 'd', 'femenino'),
('sbellfieldy', 'Sampson', 'Bellfield', 'W6zTcZC', 'd', 'masculino'),
('shelliar2o', 'Stacie', 'Helliar', 'VbjQlZq', 'd', 'femenino'),
('swrates', 'Silvia', 'Wrates', 'yOkuanm', 'd', 'femenino'),
('uadshed7', 'Ulrike', 'Adshed', 'YPXFWOK', 'd', 'femenino'),
('ywalshe29', 'Yelena', 'Walshe', 'aWTf71UxKil', 'd', 'femenino');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campeonato`
--
ALTER TABLE `campeonato`
  ADD PRIMARY KEY (`idCampeonato`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indexes for table `categoriascampeonato`
--
ALTER TABLE `categoriascampeonato`
  ADD PRIMARY KEY (`idCategoriasCampeonato`),
  ADD KEY `FK_Categoria_idx` (`idCategoria`),
  ADD KEY `FK_Campeonato_idx` (`idCampeonato`);

--
-- Indexes for table `enfrentamiento`
--
ALTER TABLE `enfrentamiento`
  ADD PRIMARY KEY (`idEnfrentamiento`),
  ADD KEY `FK_idPareja1_idx` (`idPareja1`),
  ADD KEY `FK_Grupo_idx` (`idGrupo`),
  ADD KEY `FK_Enfrentamientos_Pareja2_idx` (`idPareja2`);

--
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idGrupo`),
  ADD KEY `FK_Categoria_idx` (`idCategoria`),
  ADD KEY `FK_Campeonato_idx` (`idCampeonato`);

--
-- Indexes for table `ofertaenfrentamiento`
--
ALTER TABLE `ofertaenfrentamiento`
  ADD PRIMARY KEY (`idOfertaEnfrentamiento`),
  ADD KEY `FK_Pareja_idx` (`idPareja`);

--
-- Indexes for table `organizarpartido`
--
ALTER TABLE `organizarpartido`
  ADD PRIMARY KEY (`idOrganizarPartido`);

--
-- Indexes for table `pareja`
--
ALTER TABLE `pareja`
  ADD PRIMARY KEY (`idPareja`),
  ADD KEY `FK_idLider_idx` (`idCompañero`),
  ADD KEY `FK_Pareja_Capitan_idx` (`idCapitan`),
  ADD KEY `FK_CategoriaCampeonato_idx` (`idCategoriaCampeonato`);

--
-- Indexes for table `parejagrupo`
--
ALTER TABLE `parejagrupo`
  ADD PRIMARY KEY (`idPareja`,`idGrupo`),
  ADD KEY `FK_Grupo_idx` (`idGrupo`);

--
-- Indexes for table `participantespartido`
--
ALTER TABLE `participantespartido`
  ADD PRIMARY KEY (`idParticipantesPartido`),
  ADD KEY `FK_OrganizarPartido_idx` (`idOrganizarPartido`),
  ADD KEY `FK_Usuario_idx` (`loginUsuario`);

--
-- Indexes for table `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `FK_Usuario_idx` (`idUsuarioReserva`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campeonato`
--
ALTER TABLE `campeonato`
  MODIFY `idCampeonato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categoriascampeonato`
--
ALTER TABLE `categoriascampeonato`
  MODIFY `idCategoriasCampeonato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `enfrentamiento`
--
ALTER TABLE `enfrentamiento`
  MODIFY `idEnfrentamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `grupo`
--
ALTER TABLE `grupo`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ofertaenfrentamiento`
--
ALTER TABLE `ofertaenfrentamiento`
  MODIFY `idOfertaEnfrentamiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizarpartido`
--
ALTER TABLE `organizarpartido`
  MODIFY `idOrganizarPartido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pareja`
--
ALTER TABLE `pareja`
  MODIFY `idPareja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `participantespartido`
--
ALTER TABLE `participantespartido`
  MODIFY `idParticipantesPartido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categoriascampeonato`
--
ALTER TABLE `categoriascampeonato`
  ADD CONSTRAINT `FK_CC_Campeonato` FOREIGN KEY (`idCampeonato`) REFERENCES `campeonato` (`idCampeonato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CC_Categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `enfrentamiento`
--
ALTER TABLE `enfrentamiento`
  ADD CONSTRAINT `FK_Enfrentamientos_Grupo` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Enfrentamientos_Pareja1` FOREIGN KEY (`idPareja1`) REFERENCES `pareja` (`idPareja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Enfrentamientos_Pareja2` FOREIGN KEY (`idPareja2`) REFERENCES `pareja` (`idPareja`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `FK_Grupo_Campeonato` FOREIGN KEY (`idCampeonato`) REFERENCES `campeonato` (`idCampeonato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Grupo_Categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ofertaenfrentamiento`
--
ALTER TABLE `ofertaenfrentamiento`
  ADD CONSTRAINT `FK_Oferta_Pareja` FOREIGN KEY (`idPareja`) REFERENCES `pareja` (`idPareja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pareja`
--
ALTER TABLE `pareja`
  ADD CONSTRAINT `FK_ParejaCompañero` FOREIGN KEY (`idCompañero`) REFERENCES `usuario` (`login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Pareja_Capitan` FOREIGN KEY (`idCapitan`) REFERENCES `usuario` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parejagrupo`
--
ALTER TABLE `parejagrupo`
  ADD CONSTRAINT `FK_PG_Grupo` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PG_Pareja` FOREIGN KEY (`idPareja`) REFERENCES `pareja` (`idPareja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participantespartido`
--
ALTER TABLE `participantespartido`
  ADD CONSTRAINT `FK_Participantes_OrganizarPartido` FOREIGN KEY (`idOrganizarPartido`) REFERENCES `organizarpartido` (`idOrganizarPartido`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Participantes_Usuario` FOREIGN KEY (`loginUsuario`) REFERENCES `usuario` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `FK_Reserva_Usuario` FOREIGN KEY (`idUsuarioReserva`) REFERENCES `usuario` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
