-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-12-2018 a las 19:57:12
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sjjpadel`
--
CREATE DATABASE IF NOT EXISTS `sjjpadel` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sjjpadel`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campeonato`
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
-- Volcado de datos para la tabla `campeonato`
--

INSERT INTO `campeonato` (`idCampeonato`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `fechaInicioCampeonato`, `fechaFinCampeonato`, `nombreCampeonato`, `fase`) VALUES
(2, '2018-11-01', '2018-11-10', '2018-11-11', '2018-12-02', 'Campeonato Noviembre', 'Inscripcion'),
(3, '2018-11-01', '2018-11-10', '2018-11-15', '2018-12-12', 'Campeonato puente constitucion', 'Inscripcion'),
(4, '2018-11-20', '2018-12-15', '2018-12-15', '2018-12-31', 'Campeonato Diciembre', 'Inscripcion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nivel` varchar(20) NOT NULL,
  `sexo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
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
-- Estructura de tabla para la tabla `categoriascampeonato`
--

CREATE TABLE `categoriascampeonato` (
  `idCategoriasCampeonato` int(11) NOT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  `idCampeonato` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoriascampeonato`
--

INSERT INTO `categoriascampeonato` (`idCategoriasCampeonato`, `idCategoria`, `idCampeonato`) VALUES
(1, 3, 2),
(2, 6, 2),
(3, 9, 2),
(4, 3, 3),
(5, 6, 3),
(6, 1, 4),
(7, 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfrentamiento`
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
-- Volcado de datos para la tabla `enfrentamiento`
--

INSERT INTO `enfrentamiento` (`idEnfrentamiento`, `idPareja1`, `idPareja2`, `idGrupo`, `fase`, `fecha`, `hora`, `puntosPareja1`, `puntosPareja2`, `setsPareja1`, `setsPareja2`) VALUES
(29, 173, 174, 18, 'Grupos', '2018-11-20', '10:00:00', 3, 1, 3, 1),
(30, 173, 175, 18, 'Grupos', '2018-11-20', '10:00:00', 3, 1, 3, 1),
(31, 173, 176, 18, 'Grupos', '2018-11-08', '14:00:00', 1, 3, 1, 3),
(32, 173, 177, 18, 'Grupos', '2018-11-10', '10:00:00', 1, 3, 2, 3),
(33, 173, 178, 18, 'Grupos', '2018-11-10', '10:00:00', 1, 3, 0, 3),
(34, 173, 179, 18, 'Grupos', '2018-11-10', '10:00:00', NULL, NULL, NULL, NULL),
(35, 173, 180, 18, 'Grupos', '2018-11-10', '10:00:00', NULL, NULL, NULL, NULL),
(36, 174, 175, 18, 'Grupos', '2018-11-10', '10:00:00', NULL, NULL, NULL, NULL),
(37, 174, 176, 18, 'Grupos', '2018-11-10', '10:00:00', 3, 1, 3, 1),
(38, 174, 177, 18, 'Grupos', '2018-11-10', '10:00:00', 1, 3, 0, 3),
(39, 174, 178, 18, 'Grupos', '2018-11-10', '10:00:00', 1, 3, 2, 3),
(40, 174, 179, 18, 'Grupos', '2018-11-10', '10:00:00', NULL, NULL, NULL, NULL),
(41, 174, 180, 18, 'Grupos', '2018-11-24', '10:00:00', NULL, NULL, NULL, NULL),
(42, 175, 176, 18, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(43, 175, 177, 18, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(44, 175, 178, 18, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(45, 175, 179, 18, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(46, 175, 180, 18, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(47, 176, 177, 18, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(48, 176, 178, 18, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(49, 176, 179, 18, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(50, 176, 180, 18, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(51, 177, 178, 18, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(52, 177, 179, 18, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(53, 177, 180, 18, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(54, 178, 179, 18, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(55, 178, 180, 18, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(56, 179, 180, 18, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(57, 181, 182, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(58, 181, 183, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(59, 181, 184, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(60, 181, 185, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(61, 181, 186, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(62, 181, 187, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(63, 181, 188, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(64, 181, 189, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(65, 181, 190, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(66, 181, 191, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(67, 181, 192, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(68, 182, 183, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(69, 182, 184, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(70, 182, 185, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(71, 182, 186, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(72, 182, 187, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(73, 182, 188, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(74, 182, 189, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(75, 182, 190, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(76, 182, 191, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(77, 182, 192, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(78, 183, 184, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(79, 183, 185, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(80, 183, 186, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(81, 183, 187, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(82, 183, 188, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(83, 183, 189, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(84, 183, 190, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(85, 183, 191, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(86, 183, 192, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(87, 184, 185, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(88, 184, 186, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(89, 184, 187, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(90, 184, 188, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(91, 184, 189, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(92, 184, 190, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(93, 184, 191, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(94, 184, 192, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(95, 185, 186, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(96, 185, 187, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(97, 185, 188, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(98, 185, 189, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(99, 185, 190, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(100, 185, 191, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(101, 185, 192, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(102, 186, 187, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(103, 186, 188, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(104, 186, 189, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(105, 186, 190, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(106, 186, 191, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(107, 186, 192, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(108, 187, 188, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(109, 187, 189, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(110, 187, 190, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(111, 187, 191, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(112, 187, 192, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(113, 188, 189, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(114, 188, 190, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(115, 188, 191, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(116, 188, 192, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(117, 189, 190, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(118, 189, 191, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(119, 189, 192, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(120, 190, 191, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(121, 190, 192, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL),
(122, 191, 192, 19, 'Grupos', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `idGrupo` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idCampeonato` int(11) NOT NULL,
  `nombreGrupo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`idGrupo`, `idCategoria`, `idCampeonato`, `nombreGrupo`) VALUES
(18, 3, 3, 'Grupo A'),
(19, 6, 3, 'Grupo A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertaenfrentamiento`
--

CREATE TABLE `ofertaenfrentamiento` (
  `idOfertaEnfrentamiento` int(11) NOT NULL,
  `idPareja` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ofertaenfrentamiento`
--

INSERT INTO `ofertaenfrentamiento` (`idOfertaEnfrentamiento`, `idPareja`, `idGrupo`, `hora`, `fecha`) VALUES
(2, 174, 18, '10:00:00', '2018-11-26'),
(3, 174, 18, '11:30:00', '2018-11-28'),
(4, 174, 18, '16:00:00', '2018-11-27'),
(5, 180, 18, '10:00:00', '2018-11-30'),
(6, 180, 18, '10:00:00', '2018-11-28'),
(7, 180, 18, '19:00:00', '2018-11-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organizarpartido`
--

CREATE TABLE `organizarpartido` (
  `idOrganizarPartido` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `organizarpartido`
--

INSERT INTO `organizarpartido` (`idOrganizarPartido`, `fecha`, `hora`) VALUES
(10, '2018-11-29', '10:00:00'),
(12, '2018-11-30', '10:00:00'),
(13, '2018-11-26', '11:30:00'),
(14, '2018-11-29', '19:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pareja`
--

CREATE TABLE `pareja` (
  `idPareja` int(11) NOT NULL,
  `idCapitan` varchar(20) NOT NULL,
  `idCompañero` varchar(20) NOT NULL,
  `idCategoriaCampeonato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pareja`
--

INSERT INTO `pareja` (`idPareja`, `idCapitan`, `idCompañero`, `idCategoriaCampeonato`) VALUES
(133, 'santi', 'julio', 1),
(134, 'ana', 'aroa', 1),
(135, 'emilio', 'sara', 1),
(136, 'celso', 'oscar', 1),
(137, 'dmeeusk', 'ernesto', 1),
(138, 'luis', 'anton', 1),
(139, 'eugenio', 'candela', 1),
(140, 'inma', 'helena', 1),
(141, 'pepe', 'francisco', 1),
(142, 'sergio', 'andrea', 1),
(143, 'ainoa', 'laura', 1),
(144, 'claudio', 'pedro', 1),
(145, 'claudio', 'pedro', 1),
(146, 'juan', 'david', 1),
(147, 'santiago', 'julio', 1),
(148, 'lois', 'floro', 1),
(149, 'matias', 'cesar', 1),
(150, 'santi', 'anton', 2),
(151, 'ana', 'aroa', 2),
(152, 'emilio', 'sara', 2),
(153, 'celso', 'oscar', 2),
(154, 'dmeeusk', 'ernesto', 2),
(155, 'luis', 'anton', 2),
(156, 'eugenio', 'candela', 2),
(157, 'inma', 'helena', 2),
(158, 'pepe', 'francisco', 2),
(159, 'sergio', 'andrea', 2),
(160, 'santi', 'anton', 3),
(161, 'ana', 'aroa', 3),
(162, 'emilio', 'sara', 3),
(163, 'celso', 'oscar', 3),
(164, 'dmeeusk', 'ernesto', 3),
(165, 'luis', 'anton', 3),
(166, 'eugenio', 'candela', 3),
(167, 'inma', 'helena', 3),
(168, 'pepe', 'francisco', 3),
(169, 'sergio', 'andrea', 3),
(170, 'ainoa', 'laura', 3),
(171, 'claudio', 'pedro', 3),
(172, 'claudio', 'pedro', 3),
(173, 'santi', 'anton', 4),
(174, 'ana', 'aroa', 4),
(175, 'emilio', 'sara', 4),
(176, 'celso', 'oscar', 4),
(177, 'dmeeusk', 'ernesto', 4),
(178, 'luis', 'anton', 4),
(179, 'eugenio', 'candela', 4),
(180, 'inma', 'helena', 4),
(181, 'santi', 'anton', 5),
(182, 'ana', 'aroa', 5),
(183, 'emilio', 'sara', 5),
(184, 'celso', 'oscar', 5),
(185, 'dmeeusk', 'ernesto', 5),
(186, 'luis', 'anton', 5),
(187, 'eugenio', 'candela', 5),
(188, 'inma', 'helena', 5),
(189, 'pepe', 'francisco', 5),
(190, 'sergio', 'andrea', 5),
(191, 'ainoa', 'laura', 5),
(192, 'claudio', 'pedro', 5),
(193, 'aa', 'juan', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parejagrupo`
--

CREATE TABLE `parejagrupo` (
  `idPareja` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parejagrupo`
--

INSERT INTO `parejagrupo` (`idPareja`, `idGrupo`) VALUES
(173, 18),
(174, 18),
(175, 18),
(176, 18),
(177, 18),
(178, 18),
(179, 18),
(180, 18),
(181, 19),
(182, 19),
(183, 19),
(184, 19),
(185, 19),
(186, 19),
(187, 19),
(188, 19),
(189, 19),
(190, 19),
(191, 19),
(192, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participantespartido`
--

CREATE TABLE `participantespartido` (
  `idParticipantesPartido` int(11) NOT NULL,
  `idOrganizarPartido` int(11) DEFAULT NULL,
  `loginUsuario` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `participantespartido`
--

INSERT INTO `participantespartido` (`idParticipantesPartido`, `idOrganizarPartido`, `loginUsuario`) VALUES
(12, 10, 'floro'),
(13, 14, 'floro'),
(14, 13, 'floro'),
(15, 10, 'juan'),
(16, 10, 'julio'),
(17, 12, 'julio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `idReserva` int(11) NOT NULL,
  `idUsuarioReserva` varchar(20) NOT NULL,
  `fechaReserva` varchar(15) NOT NULL,
  `horaReserva` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`idReserva`, `idUsuarioReserva`, `fechaReserva`, `horaReserva`) VALUES
(55, 'admin', '2018-11-25', '13:00'),
(56, 'admin', '2018-11-25', '13:00'),
(57, 'admin', '2018-11-25', '13:00'),
(58, 'admin', '2018-11-25', '13:00'),
(59, 'admin', '2018-11-25', '17:30'),
(60, 'admin', '2018-11-25', '17:30'),
(61, 'admin', '2018-11-25', '17:30'),
(62, 'admin', '2018-11-25', '17:30'),
(63, 'admin', '2018-11-25', '17:30'),
(64, 'admin', '2018-11-25', '20:30'),
(65, 'admin', '2018-11-25', '20:30'),
(66, 'admin', '2018-11-25', '20:30'),
(67, 'admin', '2018-11-25', '20:30'),
(68, 'admin', '2018-11-25', '10:00'),
(69, 'admin', '2018-11-25', '10:00'),
(70, 'admin', '2018-11-25', '10:00'),
(71, 'admin', '2018-11-25', '10:00'),
(72, 'admin', '2018-11-26', '10:00'),
(73, 'admin', '2018-11-26', '10:00'),
(74, 'admin', '2018-11-26', '10:00'),
(75, 'admin', '2018-11-26', '10:00'),
(76, 'admin', '2018-11-26', '10:00'),
(77, 'admin', '2018-11-26', '20:30'),
(78, 'admin', '2018-11-26', '20:30'),
(79, 'admin', '2018-11-26', '20:30'),
(80, 'admin', '2018-11-26', '20:30'),
(81, 'admin', '2018-11-26', '17:30'),
(82, 'admin', '2018-11-26', '17:30'),
(83, 'admin', '2018-11-26', '17:30'),
(84, 'admin', '2018-11-26', '17:30'),
(85, 'admin', '2018-11-26', '13:00'),
(86, 'admin', '2018-11-26', '11:30'),
(87, 'admin', '2018-11-26', '19:00'),
(88, 'admin', '2018-11-26', '16:00'),
(89, 'admin', '2018-11-26', '14:30'),
(90, 'admin', '2018-11-26', '14:30'),
(91, 'admin', '2018-11-26', '19:00'),
(92, 'admin', '2018-11-26', '11:30'),
(93, 'inma', '2018-11-24', '10:00:00'),
(94, 'santi', '2018-11-26', '11:30'),
(95, 'santi', '2018-11-26', '11:30'),
(96, 'santi', '2018-11-26', '17:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
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
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES
('aa', 'aa', 'aa', 'aa', 'd', 'masculino'),
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
('santi', 'Audre', 'Vanelli', 'pass', 'd', 'femenino'),
('santiago', 'santiago', 'gomas', 'pass', 'd', 'masculino'),
('santiD', 'Santi', 'Rodríguez González', 'pass', 'a', 'masculino'),
('sara', 'Cherilyn', 'Deyenhardt', 'pass', 'd', 'femenino'),
('sergio', 'Harald', 'Stother', 'pass', 'd', 'masculino'),
('sofia', 'Salaidh', 'Bau', 'pass', 'd', 'femenino');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `campeonato`
--
ALTER TABLE `campeonato`
  ADD PRIMARY KEY (`idCampeonato`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `categoriascampeonato`
--
ALTER TABLE `categoriascampeonato`
  ADD PRIMARY KEY (`idCategoriasCampeonato`),
  ADD KEY `FK_Categoria_idx` (`idCategoria`),
  ADD KEY `FK_Campeonato_idx` (`idCampeonato`);

--
-- Indices de la tabla `enfrentamiento`
--
ALTER TABLE `enfrentamiento`
  ADD PRIMARY KEY (`idEnfrentamiento`),
  ADD KEY `FK_idPareja1_idx` (`idPareja1`),
  ADD KEY `FK_Grupo_idx` (`idGrupo`),
  ADD KEY `FK_Enfrentamientos_Pareja2_idx` (`idPareja2`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idGrupo`),
  ADD KEY `FK_Categoria_idx` (`idCategoria`),
  ADD KEY `FK_Campeonato_idx` (`idCampeonato`);

--
-- Indices de la tabla `ofertaenfrentamiento`
--
ALTER TABLE `ofertaenfrentamiento`
  ADD PRIMARY KEY (`idOfertaEnfrentamiento`),
  ADD KEY `FK_Pareja_idx` (`idPareja`),
  ADD KEY `FK_Oferta_Grupo` (`idGrupo`);

--
-- Indices de la tabla `organizarpartido`
--
ALTER TABLE `organizarpartido`
  ADD PRIMARY KEY (`idOrganizarPartido`);

--
-- Indices de la tabla `pareja`
--
ALTER TABLE `pareja`
  ADD PRIMARY KEY (`idPareja`),
  ADD KEY `FK_idLider_idx` (`idCompañero`),
  ADD KEY `FK_Pareja_Capitan_idx` (`idCapitan`),
  ADD KEY `FK_CategoriaCampeonato_idx` (`idCategoriaCampeonato`);

--
-- Indices de la tabla `parejagrupo`
--
ALTER TABLE `parejagrupo`
  ADD PRIMARY KEY (`idPareja`,`idGrupo`),
  ADD KEY `FK_Grupo_idx` (`idGrupo`);

--
-- Indices de la tabla `participantespartido`
--
ALTER TABLE `participantespartido`
  ADD PRIMARY KEY (`idParticipantesPartido`),
  ADD KEY `FK_OrganizarPartido_idx` (`idOrganizarPartido`),
  ADD KEY `FK_Usuario_idx` (`loginUsuario`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `FK_Usuario_idx` (`idUsuarioReserva`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `campeonato`
--
ALTER TABLE `campeonato`
  MODIFY `idCampeonato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `categoriascampeonato`
--
ALTER TABLE `categoriascampeonato`
  MODIFY `idCategoriasCampeonato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `enfrentamiento`
--
ALTER TABLE `enfrentamiento`
  MODIFY `idEnfrentamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `ofertaenfrentamiento`
--
ALTER TABLE `ofertaenfrentamiento`
  MODIFY `idOfertaEnfrentamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `organizarpartido`
--
ALTER TABLE `organizarpartido`
  MODIFY `idOrganizarPartido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `pareja`
--
ALTER TABLE `pareja`
  MODIFY `idPareja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;
--
-- AUTO_INCREMENT de la tabla `participantespartido`
--
ALTER TABLE `participantespartido`
  MODIFY `idParticipantesPartido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoriascampeonato`
--
ALTER TABLE `categoriascampeonato`
  ADD CONSTRAINT `FK_CC_Campeonato` FOREIGN KEY (`idCampeonato`) REFERENCES `campeonato` (`idCampeonato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CC_Categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `enfrentamiento`
--
ALTER TABLE `enfrentamiento`
  ADD CONSTRAINT `FK_Enfrentamientos_Grupo` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Enfrentamientos_Pareja1` FOREIGN KEY (`idPareja1`) REFERENCES `pareja` (`idPareja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Enfrentamientos_Pareja2` FOREIGN KEY (`idPareja2`) REFERENCES `pareja` (`idPareja`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `FK_Grupo_Campeonato` FOREIGN KEY (`idCampeonato`) REFERENCES `campeonato` (`idCampeonato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Grupo_Categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ofertaenfrentamiento`
--
ALTER TABLE `ofertaenfrentamiento`
  ADD CONSTRAINT `FK_Oferta_Grupo` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Oferta_Pareja` FOREIGN KEY (`idPareja`) REFERENCES `pareja` (`idPareja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pareja`
--
ALTER TABLE `pareja`
  ADD CONSTRAINT `FK_ParejaCompañero` FOREIGN KEY (`idCompañero`) REFERENCES `usuario` (`login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Pareja_Capitan` FOREIGN KEY (`idCapitan`) REFERENCES `usuario` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `parejagrupo`
--
ALTER TABLE `parejagrupo`
  ADD CONSTRAINT `FK_PG_Grupo` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PG_Pareja` FOREIGN KEY (`idPareja`) REFERENCES `pareja` (`idPareja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `participantespartido`
--
ALTER TABLE `participantespartido`
  ADD CONSTRAINT `FK_Participantes_OrganizarPartido` FOREIGN KEY (`idOrganizarPartido`) REFERENCES `organizarpartido` (`idOrganizarPartido`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Participantes_Usuario` FOREIGN KEY (`loginUsuario`) REFERENCES `usuario` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `FK_Reserva_Usuario` FOREIGN KEY (`idUsuarioReserva`) REFERENCES `usuario` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
