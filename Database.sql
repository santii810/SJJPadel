-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2019 at 11:07 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

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
  `nombreCampeonato` varchar(45) DEFAULT NULL,
  `fase` enum('Inscripcion','Grupos','Cuartos','Semifinal','Final') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campeonato`
--

INSERT INTO `campeonato` (`idCampeonato`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `fechaInicioCampeonato`, `fechaFinCampeonato`, `nombreCampeonato`, `fase`) VALUES
(5, '2019-01-15', '2019-01-31', '2019-02-01', '2019-02-28', 'CampeonatoFaseInscripcion', 'Inscripcion'),
(6, '2019-01-14', '2019-01-31', '2019-01-01', '2019-01-31', 'Grupo sin generar', 'Inscripcion'),
(7, '2019-01-01', '2019-01-23', '2019-01-01', '2019-01-31', 'Ver clasificacion completa', 'Final'),
(8, '2019-01-01', '2019-01-31', '2019-01-01', '2019-01-31', 'Pasar a fase de eliminatoria', 'Grupos'),
(9, '2019-01-02', '2019-01-31', '2019-01-01', '2019-01-31', 'Concretar Partido', 'Grupos');

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
(8, 1, 5),
(9, 1, 6),
(12, 1, 7),
(13, 1, 8),
(14, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `enfrentamiento`
--

CREATE TABLE `enfrentamiento` (
  `idEnfrentamiento` int(11) NOT NULL,
  `idPareja1` int(11) NOT NULL,
  `idPareja2` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `fase` enum('Grupos','Cuartos','Semifinal','Final') NOT NULL,
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

INSERT INTO `enfrentamiento` (`idEnfrentamiento`, `idPareja1`, `idPareja2`, `idGrupo`, `fase`, `fecha`, `hora`, `puntosPareja1`, `puntosPareja2`, `setsPareja1`, `setsPareja2`) VALUES
(392, 195, 198, 26, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 1),
(393, 195, 201, 26, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 0, 3),
(394, 195, 204, 26, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 1),
(395, 195, 207, 26, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 2),
(396, 195, 210, 26, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 1, 3),
(397, 195, 213, 26, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 0),
(398, 195, 216, 26, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 2),
(399, 198, 201, 26, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 2),
(400, 198, 204, 26, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 2),
(401, 198, 207, 26, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 1, 3),
(402, 198, 210, 26, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 1, 3),
(403, 198, 213, 26, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 0, 3),
(404, 198, 216, 26, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 0),
(405, 201, 204, 26, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 0, 3),
(406, 201, 207, 26, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 0),
(407, 201, 210, 26, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 1, 3),
(408, 201, 213, 26, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 2, 3),
(409, 201, 216, 26, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 1),
(410, 204, 207, 26, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 2, 3),
(411, 204, 210, 26, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 0),
(412, 204, 213, 26, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 2),
(413, 204, 216, 26, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 1, 3),
(414, 207, 210, 26, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 2, 3),
(415, 207, 213, 26, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 1, 3),
(416, 207, 216, 26, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 1),
(417, 210, 213, 26, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 2),
(418, 210, 216, 26, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 2),
(419, 213, 216, 26, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 0),
(420, 196, 199, 27, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 1),
(421, 196, 202, 27, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 1),
(422, 196, 205, 27, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 2, 3),
(423, 196, 208, 27, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 1, 3),
(424, 196, 211, 27, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 1, 3),
(425, 196, 214, 27, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 1, 3),
(426, 196, 217, 27, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 1, 3),
(427, 199, 202, 27, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 0, 3),
(428, 199, 205, 27, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 1),
(429, 199, 208, 27, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 1),
(430, 199, 211, 27, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 0),
(431, 199, 214, 27, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 2, 3),
(432, 199, 217, 27, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 2, 3),
(433, 202, 205, 27, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 1),
(434, 202, 208, 27, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 1),
(435, 202, 211, 27, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 1, 3),
(436, 202, 214, 27, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 2, 3),
(437, 202, 217, 27, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 2),
(438, 205, 208, 27, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 0),
(439, 205, 211, 27, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 2, 3),
(440, 205, 214, 27, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 2, 3),
(441, 205, 217, 27, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 0),
(442, 208, 211, 27, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 0, 3),
(443, 208, 214, 27, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 1),
(444, 208, 217, 27, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 2),
(445, 211, 214, 27, 'Grupos', '2019-01-06', '10:00:00', 3, 1, 3, 1),
(446, 211, 217, 27, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 2, 3),
(447, 214, 217, 27, 'Grupos', '2019-01-06', '10:00:00', 1, 3, 2, 3),
(448, 218, 219, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(449, 218, 220, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(450, 218, 221, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(451, 218, 222, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(452, 218, 223, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(453, 218, 224, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(454, 218, 225, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(455, 219, 220, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(456, 219, 221, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(457, 219, 222, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(458, 219, 223, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(459, 219, 224, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(460, 219, 225, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(461, 220, 221, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(462, 220, 222, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(463, 220, 223, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(464, 220, 224, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(465, 220, 225, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(466, 221, 222, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(467, 221, 223, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(468, 221, 224, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(469, 221, 225, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(470, 222, 223, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(471, 222, 224, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(472, 222, 225, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(473, 223, 224, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(474, 223, 225, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(475, 224, 225, 28, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(476, 210, 216, 26, 'Cuartos', '2019-01-06', '10:00:00', 3, 1, 3, 0),
(477, 195, 198, 26, 'Cuartos', '2019-01-06', '10:00:00', 1, 3, 0, 3),
(478, 213, 201, 26, 'Cuartos', '2019-01-06', '10:00:00', 3, 1, 3, 1),
(479, 204, 207, 26, 'Cuartos', '2019-01-06', '10:00:00', 1, 3, 2, 3),
(480, 198, 207, 26, 'Semifinal', '2019-01-06', '10:00:00', 1, 3, 0, 3),
(481, 210, 213, 26, 'Semifinal', '2019-01-06', '10:00:00', 3, 1, 3, 1),
(482, 207, 210, 26, 'Final', '2019-01-06', '10:00:00', 3, 1, 3, 1);

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
(26, 1, 7, 'Grupo A'),
(27, 1, 8, 'Grupo A'),
(28, 3, 9, 'Grupo A');

-- --------------------------------------------------------

--
-- Table structure for table `ofertaenfrentamiento`
--

CREATE TABLE `ofertaenfrentamiento` (
  `idOfertaEnfrentamiento` int(11) NOT NULL,
  `idPareja` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL
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
(15, '2019-01-18', '10:00:00'),
(16, '2019-01-23', '10:00:00'),
(17, '2019-01-24', '10:00:00'),
(18, '2019-01-24', '16:00:00'),
(19, '2019-01-24', '20:30:00'),
(20, '2019-01-21', '20:30:00'),
(21, '2019-01-21', '16:00:00');

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
(194, 'santi', 'julio', 9),
(195, 'santi', 'julio', 12),
(196, 'santi', 'julio', 13),
(197, 'cesar', 'celso', 9),
(198, 'cesar', 'celso', 12),
(199, 'cesar', 'celso', 13),
(200, 'angel', 'floro', 9),
(201, 'angel', 'floro', 12),
(202, 'angel', 'floro', 13),
(203, 'cristian', 'david', 9),
(204, 'cristian', 'david', 12),
(205, 'cristian', 'david', 13),
(206, 'estevan', 'anton', 9),
(207, 'estevan', 'anton', 12),
(208, 'estevan', 'anton', 13),
(209, 'fabio', 'eugenio', 9),
(210, 'fabio', 'eugenio', 12),
(211, 'fabio', 'eugenio', 13),
(212, 'francisco', 'jorge', 9),
(213, 'francisco', 'jorge', 12),
(214, 'francisco', 'jorge', 13),
(215, 'jose', 'juan', 9),
(216, 'jose', 'juan', 12),
(217, 'jose', 'juan', 13),
(218, 'santi', 'julio', 14),
(219, 'cesar', 'celso', 14),
(220, 'angel', 'floro', 14),
(221, 'cristian', 'david', 14),
(222, 'estevan', 'anton', 14),
(223, 'fabio', 'eugenio', 14),
(224, 'francisco', 'jorge', 14),
(225, 'jose', 'juan', 14);

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
(195, 26),
(196, 27),
(198, 26),
(199, 27),
(201, 26),
(202, 27),
(204, 26),
(205, 27),
(207, 26),
(208, 27),
(210, 26),
(211, 27),
(213, 26),
(214, 27),
(216, 26),
(217, 27),
(218, 28),
(219, 28),
(220, 28),
(221, 28),
(222, 28),
(223, 28),
(224, 28),
(225, 28);

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
(18, 15, 'jose'),
(19, 16, 'jose'),
(20, 21, 'jose'),
(21, 18, 'jose'),
(22, 15, 'santi'),
(23, 21, 'santi'),
(24, 20, 'santi'),
(25, 17, 'santi'),
(26, 15, 'julio');

-- --------------------------------------------------------

--
-- Table structure for table `partidoorganizado`
--

CREATE TABLE `partidoorganizado` (
  `idPartidoOrganizado` int(11) NOT NULL,
  `idReserva` int(11) NOT NULL,
  `login1` varchar(20) NOT NULL,
  `login2` varchar(20) NOT NULL,
  `login3` varchar(20) NOT NULL,
  `login4` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(110, 'admin', '2019-01-15', '10:00'),
(111, 'admin', '2019-01-15', '11:30'),
(112, 'admin', '2019-01-16', '10:00'),
(113, 'admin', '2019-01-16', '19:00'),
(114, 'admin', '2019-01-16', '20:30'),
(115, 'admin', '2019-01-16', '20:30'),
(116, 'admin', '2019-01-16', '13:00'),
(117, 'admin', '2019-01-17', '16:00'),
(118, 'admin', '2019-01-18', '17:30'),
(119, 'jose', '2019-01-15', '11:30'),
(120, 'jose', '2019-01-15', '11:30'),
(121, 'jose', '2019-01-15', '11:30'),
(122, 'jose', '2019-01-15', '19:00'),
(123, 'jose', '2019-01-16', '17:30'),
(124, 'jose', '2019-01-17', '17:30'),
(125, 'jose', '2019-01-19', '19:00'),
(126, 'jose', '2019-01-20', '13:00'),
(127, 'jose', '2019-01-20', '13:00'),
(128, 'jose', '2019-01-20', '19:00'),
(129, 'jose', '2019-01-20', '19:00'),
(130, 'jose', '2019-01-20', '20:30'),
(131, 'jose', '2019-01-20', '14:30'),
(132, 'jose', '2019-01-20', '14:30'),
(133, 'jose', '2019-01-20', '14:30'),
(134, 'jose', '2019-01-20', '14:30'),
(135, 'jose', '2019-01-19', '19:00'),
(136, 'jose', '2019-01-19', '19:00'),
(137, 'jose', '2019-01-19', '19:00'),
(138, 'jose', '2019-01-20', '11:30'),
(139, 'jose', '2019-01-19', '17:30'),
(140, 'jose', '2019-01-19', '11:30'),
(141, 'jose', '2019-01-19', '16:00'),
(142, 'jose', '2019-01-20', '10:00'),
(143, 'jose', '2019-01-20', '16:00'),
(144, 'jose', '2019-01-21', '13:00'),
(145, 'jose', '2019-01-21', '11:30'),
(146, 'jose', '2019-01-21', '20:30'),
(147, 'jose', '2019-01-20', '20:30'),
(148, 'jose', '2019-01-20', '19:00'),
(149, 'jose', '2019-01-19', '20:30'),
(150, 'jose', '2019-01-19', '14:30'),
(151, 'jose', '2019-01-19', '17:30'),
(152, 'jose', '2019-01-19', '17:30'),
(153, 'jose', '2019-01-19', '17:30'),
(154, 'jose', '2019-01-19', '16:00'),
(155, 'jose', '2019-01-19', '16:00'),
(156, 'jose', '2019-01-19', '11:30'),
(157, 'jose', '2019-01-19', '11:30'),
(158, 'jose', '2019-01-19', '11:30'),
(159, 'jose', '2019-01-19', '11:30'),
(160, 'jose', '2019-01-19', '14:30'),
(161, 'jose', '2019-01-19', '14:30'),
(162, 'jose', '2019-01-19', '14:30'),
(163, 'jose', '2019-01-20', '19:00'),
(164, 'jose', '2019-01-20', '19:00'),
(165, 'jose', '2019-01-19', '16:00'),
(166, 'jose', '2019-01-19', '16:00'),
(167, 'jose', '2019-01-19', '13:00'),
(168, 'jose', '2019-01-19', '13:00'),
(169, 'jose', '2019-01-18', '16:00'),
(170, 'jose', '2019-01-18', '16:00'),
(171, 'jose', '2019-01-18', '16:00'),
(172, 'jose', '2019-01-18', '16:00'),
(173, 'jose', '2019-01-18', '17:30'),
(174, 'jose', '2019-01-18', '19:00'),
(175, 'jose', '2019-01-18', '14:30'),
(176, 'jose', '2019-01-18', '20:30'),
(177, 'jose', '2019-01-21', '17:30'),
(178, 'jose', '2019-01-21', '17:30'),
(179, 'jose', '2019-01-21', '17:30'),
(180, 'jose', '2019-01-21', '17:30'),
(181, 'jose', '2019-01-21', '13:00');

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
('admin', 'admin', 'admin', 'admin', 'a', 'masculino'),
('ainoa', 'Jerry', 'Shimuk', 'pass', 'd', 'femenino'),
('aldara', 'Stacie', 'Helliar', 'pass', 'd', 'femenino'),
('ana', 'Bernie', 'Keitley', 'pass', 'd', 'femenino'),
('andrea', 'Jeannette', 'Grossier', 'pass', 'd', 'femenino'),
('angel', 'Sampson', 'Bellfield', 'pass', 'd', 'masculino'),
('angela', 'Eachelle', 'Srutton', 'pass', 'e', 'femenino'),
('anton', 'Bernarr', 'Jankovic', 'pass', 'd', 'masculino'),
('aroa', 'Bridie', 'Riehm', 'pass', 'd', 'femenino'),
('candela', 'Ginnifer', 'Gainfort', 'pass', 'd', 'femenino'),
('carla', 'Ulrike', 'Adshed', 'pass', 'd', 'femenino'),
('celso', 'Jost', 'Carmine', 'pass', 'd', 'masculino'),
('cesar', 'cesar', 'barco', 'pass', 'd', 'masculino'),
('claudio', 'Kelley', 'Loftie', 'pass', 'd', 'masculino'),
('cristian', 'Normy', 'Jiroutek', 'pass', 'd', 'masculino'),
('david', 'david', 'Gomez', 'pass', 'd', 'masculino'),
('dmeeusk', 'Dylan', 'Meeus', 'pass', 'd', 'masculino'),
('emilio', 'Connie', 'Burkwood', 'pass', 'e', 'masculino'),
('enrique', 'Marlin', 'Henrique', 'pass', 'd', 'masculino'),
('ernesto', 'Etan', 'O Fielly', 'pass', 'd', 'masculino'),
('estefania', 'Yelena', 'Walshe', 'pass', 'd', 'femenino'),
('estevan', 'Nico', 'Gavagan', 'pass', 'd', 'masculino'),
('eugenio', 'Gun', 'Ditty', 'pass', 'd', 'masculino'),
('fabio', 'Ruttger', 'Swatridge', 'pass', 'd', 'masculino'),
('floro', 'floro', 'ramirez', 'pass', 'd', 'masculino'),
('francisco', 'Hanan', 'Polglase', 'pass', 'd', 'masculino'),
('helena', 'Helena', 'Casse', 'pass', 'd', 'femenino'),
('inma', 'Hope', 'Bremeyer', 'pass', 'd', 'femenino'),
('jorge', 'jorge', 'vigo', 'pass', 'd', 'masculino'),
('jose', 'jose', 'perez', 'pass', 'd', 'masculino'),
('juan', 'juan', 'Gonzalez', 'pass', 'd', 'masculino'),
('julio', 'julio', 'Quintas', 'pass', 'd', 'masculino'),
('laura', 'Kelsy', 'Firth', 'pass', 'd', 'femenino'),
('lois', 'lois', 'paderme', 'pass', 'd', 'masculino'),
('luis', 'Emile', 'Spyvye', 'pass', 'd', 'masculino'),
('manuel', 'Ring', 'Ghiroldi', 'pass', 'd', 'masculino'),
('marcos', 'marcos', 'santas', 'pass', 'd', 'masculino'),
('marisa', 'Marissa', 'Jaram', 'pass', 'd', 'femenino'),
('matias', 'matias', 'souto', 'pass', 'd', 'masculino'),
('oscar', 'Dermot', 'Iannini', 'pass', 'd', 'masculino'),
('pedro', 'pedro', 'Gonzalez', 'pass', 'd', 'masculino'),
('pepe', 'Hy', 'Catterson', 'pass', 'd', 'masculino'),
('raquel', 'Silvia', 'Wrates', 'pass', 'd', 'femenino'),
('rodrigo', 'Mar', 'Pitcock', 'pass', 'd', 'masculino'),
('santi', 'Audre', 'Vanelli', 'pass', 'd', 'masculino'),
('santiago', 'santiago', 'gomas', 'pass', 'd', 'masculino'),
('santiD', 'Santi', 'Rodríguez González', 'pass', 'a', 'masculino'),
('sara', 'Cherilyn', 'Deyenhardt', 'pass', 'd', 'femenino'),
('sergio', 'Harald', 'Stother', 'pass', 'd', 'masculino'),
('sofia', 'Salaidh', 'Bau', 'pass', 'd', 'femenino');

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
  ADD KEY `FK_Pareja_idx` (`idPareja`),
  ADD KEY `FK_Oferta_Grupo` (`idGrupo`);

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
-- Indexes for table `partidoorganizado`
--
ALTER TABLE `partidoorganizado`
  ADD PRIMARY KEY (`idPartidoOrganizado`),
  ADD KEY `idReserva` (`idReserva`),
  ADD KEY `login1` (`login1`),
  ADD KEY `login2` (`login2`),
  ADD KEY `login3` (`login3`),
  ADD KEY `login4` (`login4`);

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
  MODIFY `idCampeonato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categoriascampeonato`
--
ALTER TABLE `categoriascampeonato`
  MODIFY `idCategoriasCampeonato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `enfrentamiento`
--
ALTER TABLE `enfrentamiento`
  MODIFY `idEnfrentamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=483;

--
-- AUTO_INCREMENT for table `grupo`
--
ALTER TABLE `grupo`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `ofertaenfrentamiento`
--
ALTER TABLE `ofertaenfrentamiento`
  MODIFY `idOfertaEnfrentamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `organizarpartido`
--
ALTER TABLE `organizarpartido`
  MODIFY `idOrganizarPartido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pareja`
--
ALTER TABLE `pareja`
  MODIFY `idPareja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `participantespartido`
--
ALTER TABLE `participantespartido`
  MODIFY `idParticipantesPartido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `partidoorganizado`
--
ALTER TABLE `partidoorganizado`
  MODIFY `idPartidoOrganizado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categoriascampeonato`
--
ALTER TABLE `categoriascampeonato`
  ADD CONSTRAINT `FK_CC_Campeonato` FOREIGN KEY (`idCampeonato`) REFERENCES `campeonato` (`idCampeonato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CC_Categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enfrentamiento`
--
ALTER TABLE `enfrentamiento`
  ADD CONSTRAINT `FK_Enfrentamientos_Grupo` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Enfrentamientos_Pareja1` FOREIGN KEY (`idPareja1`) REFERENCES `pareja` (`idPareja`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Enfrentamientos_Pareja2` FOREIGN KEY (`idPareja2`) REFERENCES `pareja` (`idPareja`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FK_Oferta_Grupo` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `FK_Participantes_OrganizarPartido` FOREIGN KEY (`idOrganizarPartido`) REFERENCES `organizarpartido` (`idOrganizarPartido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Participantes_Usuario` FOREIGN KEY (`loginUsuario`) REFERENCES `usuario` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `partidoorganizado`
--
ALTER TABLE `partidoorganizado`
  ADD CONSTRAINT `partidoorganizado_ibfk_1` FOREIGN KEY (`idReserva`) REFERENCES `reserva` (`idReserva`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partidoorganizado_ibfk_2` FOREIGN KEY (`login1`) REFERENCES `usuario` (`login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partidoorganizado_ibfk_3` FOREIGN KEY (`login2`) REFERENCES `usuario` (`login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partidoorganizado_ibfk_4` FOREIGN KEY (`login3`) REFERENCES `usuario` (`login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partidoorganizado_ibfk_5` FOREIGN KEY (`login4`) REFERENCES `usuario` (`login`);

--
-- Constraints for table `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `FK_Reserva_Usuario` FOREIGN KEY (`idUsuarioReserva`) REFERENCES `usuario` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
