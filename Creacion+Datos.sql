CREATE DATABASE IF NOT EXISTS `sjjpadel` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
grant all privileges on sjjpadel.* to abp@localhost identified by 'abp';

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
  `nombreCampeonato` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categoriascampeonato`
--

CREATE TABLE `categoriascampeonato` (
  `idCategoriasCampeonato` int(11) NOT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  `idCampeonato` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nivel` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `sexo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grupo`
--

CREATE TABLE `grupo` (
  `idGrupo` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idCampeonato` int(11) NOT NULL,
  `nombreGrupo` varchar(45) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ofertaenfrentamiento`
--

CREATE TABLE `ofertaenfrentamiento` (
  `idOfertaEnfrentamiento` int(11) NOT NULL,
  `idPareja` int(11) NOT NULL,
  `hora` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` varchar(15) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizarpartido`
--

CREATE TABLE `organizarpartido` (
  `idOrganizarPartido` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pareja`
--

CREATE TABLE `pareja` (
  `idPareja` int(11) NOT NULL,
  `idCapitan` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `idCompañero` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parejagrupo`
--

CREATE TABLE `parejagrupo` (
  `idPareja` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participantespartido`
--

CREATE TABLE `participantespartido` (
  `idParticipantesPartido` int(11) NOT NULL,
  `idOrganizarPartido` int(11) DEFAULT NULL,
  `loginUsuario` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pista`
--

CREATE TABLE `pista` (
  `idPista` int(11) NOT NULL,
  `nombrePista` varchar(45) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reserva`
--

CREATE TABLE `reserva` (
  `idReserva` int(11) NOT NULL,
  `idUsuarioReserva` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `fechaReserva` date COLLATE utf8_spanish2_ci NOT NULL,
  `horaReserva` time COLLATE utf8_spanish2_ci NOT NULL,
  `idPista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservaenfrentamiento`
--

CREATE TABLE `reservaenfrentamiento` (
  `idReserva` int(11) NOT NULL,
  `idEnfrentamiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservaorganizarpartido`
--

CREATE TABLE `reservaorganizarpartido` (
  `idReserva` int(11) NOT NULL,
  `idOrganizarPartido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `login` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `pass` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `rol` char(1) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `genero` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campeonato`
--
ALTER TABLE `campeonato`
  ADD PRIMARY KEY (`idCampeonato`);

--
-- Indexes for table `categoriascampeonato`
--
ALTER TABLE `categoriascampeonato`
  ADD PRIMARY KEY (`idCategoriasCampeonato`),
  ADD KEY `FK_Categoria_idx` (`idCategoria`),
  ADD KEY `FK_Campeonato_idx` (`idCampeonato`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

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
  ADD KEY `FK_Categoria_idx` (`idCategoria`),
  ADD KEY `FK_Pareja_Capitan_idx` (`idCapitan`);

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
-- Indexes for table `pista`
--
ALTER TABLE `pista`
  ADD PRIMARY KEY (`idPista`);

--
-- Indexes for table `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `FK_Usuario_idx` (`idUsuarioReserva`),
  ADD KEY `FK_Pista_idx` (`idPista`);

--
-- Indexes for table `reservaenfrentamiento`
--
ALTER TABLE `reservaenfrentamiento`
  ADD PRIMARY KEY (`idReserva`,`idEnfrentamiento`),
  ADD KEY `FK_Enfrentamiento_idx` (`idEnfrentamiento`);

--
-- Indexes for table `reservaorganizarpartido`
--
ALTER TABLE `reservaorganizarpartido`
  ADD PRIMARY KEY (`idReserva`,`idOrganizarPartido`),
  ADD KEY `FK_OrganizarPartido_idx` (`idOrganizarPartido`);

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
  MODIFY `idCampeonato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enfrentamiento`
--
ALTER TABLE `enfrentamiento`
  MODIFY `idEnfrentamiento` int(11) NOT NULL AUTO_INCREMENT;
  
--
-- AUTO_INCREMENT for table `participantespartido`
--
ALTER TABLE `participantespartido`
  MODIFY `idParticipantesPartido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ofertaenfrentamiento`
--
ALTER TABLE `ofertaenfrentamiento`
  MODIFY `idOfertaEnfrentamiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizarpartido`
--
ALTER TABLE `organizarpartido`
  MODIFY `idOrganizarPartido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pareja`
--
ALTER TABLE `pareja`
  MODIFY `idPareja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pista`
--
ALTER TABLE `pista`
  MODIFY `idPista` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `FK_Oferta_Pareja` FOREIGN KEY (`idPareja`) REFERENCES `pareja` (`idPareja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pareja`
--
ALTER TABLE `pareja`
  ADD CONSTRAINT `FK_Categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
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
-- Constraints for table `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `FK_Reserva_Pista` FOREIGN KEY (`idPista`) REFERENCES `pista` (`idPista`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Reserva_Usuario` FOREIGN KEY (`idUsuarioReserva`) REFERENCES `usuario` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservaenfrentamiento`
--
ALTER TABLE `reservaenfrentamiento`
  ADD CONSTRAINT `FK_RE_Enfrentamiento` FOREIGN KEY (`idEnfrentamiento`) REFERENCES `enfrentamiento` (`idEnfrentamiento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RE_Reserva` FOREIGN KEY (`idReserva`) REFERENCES `reserva` (`idReserva`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservaorganizarpartido`
--
ALTER TABLE `reservaorganizarpartido`
  ADD CONSTRAINT `FK_ROP_OrganizarPartido` FOREIGN KEY (`idOrganizarPartido`) REFERENCES `organizarpartido` (`idOrganizarPartido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ROP_Reserva` FOREIGN KEY (`idReserva`) REFERENCES `reserva` (`idReserva`) ON DELETE CASCADE ON UPDATE CASCADE;


  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
--  
--  
-- Insert de datos
--
--


USE `sjjpadel`;

--
-- Table `campeonato` data input
--

INSERT INTO campeonato (`idCampeonato`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `fechaInicioCampeonato`, `fechaFinCampeonato`, `nombreCampeonato`)
							VALUES (1, '2018-10-01', '2018-10-05', '2018-10-10', '2018-10-31', 'Campeonato Septiembre');
INSERT INTO campeonato (`idCampeonato`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `fechaInicioCampeonato`, `fechaFinCampeonato`, `nombreCampeonato`)
							VALUES (2, '2018-11-01', '2018-11-05', '2018-11-10', '2018-12-02', 'Campeonato Octubre');
INSERT INTO campeonato (`idCampeonato`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `fechaInicioCampeonato`, `fechaFinCampeonato`, `nombreCampeonato`)
							VALUES (3, '2018-12-01', '2018-12-05', '2018-12-10', '2018-01-05', 'Campeonato Diciembre');
INSERT INTO campeonato (`idCampeonato`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `fechaInicioCampeonato`, `fechaFinCampeonato`, `nombreCampeonato`)
							VALUES (4, '2018-12-01', '2018-12-05', '2018-12-10', '2018-01-05', 'Campeonato Especial Navidad');
INSERT INTO campeonato (`idCampeonato`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `fechaInicioCampeonato`, `fechaFinCampeonato`, `nombreCampeonato`)
							VALUES (5, '2019-01-01', '2019-01-05', '2019-01-10', '2019-01-31', 'Campeonato Enero');

-- --------------------------------------------------------

--
-- Table `categoria` data input
--

INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (1, 'principiante', 'masculino');
INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (2, 'principiante', 'femenino');
INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (3, 'principiante', 'mixto');

INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (4, 'amateur', 'masculino');
INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (5, 'amateur', 'femenino');
INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (6, 'amateur', 'mixto');

INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (7, 'profesional', 'masculino');
INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (8, 'profesional', 'femenino');
INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (9, 'profesional', 'mixto');


-- --------------------------------------------------------

--
-- Table `categoriascampeonato` data input
--
INSERT INTO categoriascampeonato(`idCategoriasCampeonato`, `idCategoria`, `idCampeonato`)
								VALUES(1, 3, 1);

INSERT INTO categoriascampeonato(`idCategoriasCampeonato`, `idCategoria`, `idCampeonato`)
								VALUES(2, 1, 2);
INSERT INTO categoriascampeonato(`idCategoriasCampeonato`, `idCategoria`, `idCampeonato`)
								VALUES(3, 5, 2);
INSERT INTO categoriascampeonato(`idCategoriasCampeonato`, `idCategoria`, `idCampeonato`)
								VALUES(4, 7, 2);

-- --------------------------------------------------------


--
-- Table `usuario` data input
--

INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('admin', 'admin', 'admin', 'admin', 'a', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('santiD', 'Santi', 'Rodríguez González', 'rgroot', 'a', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('cjost0', 'Jost', 'Carmine', 'pass', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('bkeitley1', 'Bernie', 'Keitley', 'jRzXG', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('jhanwright0', 'Jerry', 'Shimuk', 'ES5vx7XR', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('kloftie5', 'Kelley', 'Loftie', 'sjHZ8iW', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('eofielly6', 'Etan', 'O Fielly', 'ahrVtFg', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('mpitcockb', 'Mar', 'Pitcock', 'EllDkud7', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('rswatridgec', 'Ruttger', 'Swatridge', 'S1tPv8', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('hstothere', 'Harald', 'Stother', 'hdwu19XJ4', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('espyvyef', 'Emile', 'Spyvye', 'gnuGNQpzU', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('mjaramg', 'Marissa', 'Jaram', 'Uh57EeVSPA', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('uadshed7', 'Ulrike', 'Adshed', 'YPXFWOK', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('ngavagan8', 'Nico', 'Gavagan', 't1cH2', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('hcassea', 'Helena', 'Casse', '1SGe6T', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('njiroutekb', 'Normy', 'Jiroutek', 'LKdzUrL7LLO', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('briehmi', 'Bridie', 'Riehm', '5i6PhIVGn', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('cdeyenhardtj', 'Cherilyn', 'Deyenhardt', 'Zj4y14k5Q', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('dmeeusk', 'Dylan', 'Meeus', 'dykiwj23', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('ggainfortl', 'Ginnifer', 'Gainfort', 'yOkuanm', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('gdittyp', 'Gun', 'Ditty', 'dykiwj23', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('swrates', 'Silvia', 'Wrates', 'yOkuanm', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('sbellfieldy', 'Sampson', 'Bellfield', 'W6zTcZC', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('hcattersonz', 'Hy', 'Catterson', 'aEWNRX', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('mhenrique10', 'Marlin', 'Henrique', 'AQZqEyJ', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('bjankovic1p', 'Bernarr', 'Jankovic', 'qspW50hGXD', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('hpolglase1q', 'Hanan', 'Polglase', '9cljNljk45z', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('diannini1r', 'Dermot', 'Iannini', 'QJ34Mbf9sEE', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('rghiroldi1s', 'Ring', 'Ghiroldi', 'icpcI6p', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('ywalshe29', 'Yelena', 'Walshe', 'aWTf71UxKil', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('jgrossier2a', 'Jeannette', 'Grossier', 'GEbRo5hK5qT', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('hbremeyer2b', 'Hope', 'Bremeyer', 'QGO03wlSMqP', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('shelliar2o', 'Stacie', 'Helliar', 'VbjQlZq', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('avanelli2p', 'Audre', 'Vanelli', 'Ajqb8pziF', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('kfirth2q', 'Kelsy', 'Firth', '0Ecp4Q', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('sbau2m', 'Salaidh', 'Bau', '8SrhxWw3NR', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('cburkwoodc', 'Connie', 'Burkwood', 'mNtJnJ9MxGQJ', 'e', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('esruttond', 'Eachelle', 'Srutton', 'oyl7vLqER8He', 'e', 'femenino');

-- --------------------------------------------------------


--
-- Table `pareja` data input
--

INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (1, 'bkeitley1', 'espyvyef', 3);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (2, 'cburkwoodc', 'ggainfortl', 3);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (3, 'ngavagan8', 'mjaramg', 3);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (4, 'jhanwright0', 'kloftie5', 3);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (5, 'dmeeusk', 'sbellfieldy', 3);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (6, 'diannini1r', 'briehmi', 3);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (7, 'eofielly6', 'uadshed7', 3);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (8, 'rghiroldi1s', 'mhenrique10', 3);

INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (9, 'cjost0', 'gdittyp', 1);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (10, 'kloftie5', 'eofielly6', 1);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (11, 'mpitcockb', 'rswatridgec', 1);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (12, 'hstothere', 'espyvyef', 1);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (13, 'dmeeusk', 'sbellfieldy', 1);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (14, 'hcattersonz', 'mhenrique10', 1);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (15, 'bjankovic1p', 'hpolglase1q', 1);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (16, 'rghiroldi1s', 'diannini1r', 1);

INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (17, 'jhanwright0', 'bkeitley1', 5);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (18, 'mjaramg', 'uadshed7', 5);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (19, 'hcassea', 'briehmi', 5);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (20, 'cdeyenhardtj', 'ggainfortl', 5);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (21, 'kloftie5', 'ywalshe29', 5);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (22, 'jgrossier2a', 'hbremeyer2b', 5);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (23, 'shelliar2o', 'avanelli2p', 5);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (24, 'kfirth2q', 'sbau2m', 5);

-- --------------------------------------------------------

--
-- Table `grupo` data input
--

INSERT INTO grupo (`idGrupo`, `idCategoria`, `idCampeonato`, `nombreGrupo`) VALUES (1, 3, 1, 'Grupo 1');

INSERT INTO grupo (`idGrupo`, `idCategoria`, `idCampeonato`, `nombreGrupo`) VALUES (2, 1, 2, 'Grupo 1');
INSERT INTO grupo (`idGrupo`, `idCategoria`, `idCampeonato`, `nombreGrupo`) VALUES (3, 5, 2, 'Grupo 2');

-- --------------------------------------------------------

--
-- Table `enfrentamiento` data input
--

INSERT INTO enfrentamiento (`idEnfrentamiento`, `idPareja1`, `idPareja2`, `idGrupo`, `fecha`, `hora`, `puntosPareja1`, `puntosPareja2`, `setsPareja1`, `setsPareja2`)
					VALUES (1, 1, 4, 1, '2018-11-30', '10:00', 4, 9, 2, 1);

-- --------------------------------------------------------

--
-- Table `enfrentamiento` data input
--

INSERT INTO ofertaenfrentamiento (`idOfertaEnfrentamiento`, `idPareja`, `hora`, `fecha`) VALUES (1, 2, '16:00', '2018-11-11');
INSERT INTO ofertaenfrentamiento (`idOfertaEnfrentamiento`, `idPareja`, `hora`, `fecha`) VALUES (2, 3, '10:00', '2018-11-11');
INSERT INTO ofertaenfrentamiento (`idOfertaEnfrentamiento`, `idPareja`, `hora`, `fecha`) VALUES (3, 5, '11:30', '2018-11-12');
INSERT INTO ofertaenfrentamiento (`idOfertaEnfrentamiento`, `idPareja`, `hora`, `fecha`) VALUES (4, 10, '11:30', '2018-11-13');
INSERT INTO ofertaenfrentamiento (`idOfertaEnfrentamiento`, `idPareja`, `hora`, `fecha`) VALUES (5, 12, '10:00', '2018-11-14');
INSERT INTO ofertaenfrentamiento (`idOfertaEnfrentamiento`, `idPareja`, `hora`, `fecha`) VALUES (6, 15, '19:00', '2018-11-14');
INSERT INTO ofertaenfrentamiento (`idOfertaEnfrentamiento`, `idPareja`, `hora`, `fecha`) VALUES (7, 15, '13:00', '2018-11-14');
INSERT INTO ofertaenfrentamiento (`idOfertaEnfrentamiento`, `idPareja`, `hora`, `fecha`) VALUES (8, 7, '19:00', '2018-11-15');

-- --------------------------------------------------------

--
-- Table `organizarpartido` data input
--
INSERT INTO organizarpartido (`idOrganizarPartido`, `fecha`, `hora`)
								VALUES (1, '2018-11-21', '11:30');
INSERT INTO organizarpartido (`idOrganizarPartido`, `fecha`, `hora`)
								VALUES (2, '2018-11-23', '11:30');
INSERT INTO organizarpartido (`idOrganizarPartido`, `fecha`, `hora`)
								VALUES (3, '2018-11-25', '19:00');


-- --------------------------------------------------------

--
-- Table `parejagrupo` data input
--

INSERT INTO parejagrupo (`idPareja`, `idGrupo`)
								VALUES (9, 2);
INSERT INTO parejagrupo (`idPareja`, `idGrupo`)
								VALUES (10, 2);
INSERT INTO parejagrupo (`idPareja`, `idGrupo`)
								VALUES (11, 2);
INSERT INTO parejagrupo (`idPareja`, `idGrupo`)
								VALUES (12, 2);
INSERT INTO parejagrupo (`idPareja`, `idGrupo`)
								VALUES (13, 2);
INSERT INTO parejagrupo (`idPareja`, `idGrupo`)
								VALUES (14, 2);
INSERT INTO parejagrupo (`idPareja`, `idGrupo`)
								VALUES (15, 2);
INSERT INTO parejagrupo (`idPareja`, `idGrupo`)
								VALUES (16, 2);
-- --------------------------------------------------------

--
-- Table `participantespartido` data input
--
INSERT INTO participantespartido (`idParticipantesPartido`, `idOrganizarPartido`, `loginUsuario`)
								VALUES (1, 1, 'jgrossier2a');
INSERT INTO participantespartido (`idParticipantesPartido`, `idOrganizarPartido`, `loginUsuario`)
								VALUES (2, 1, 'bkeitley1');
INSERT INTO participantespartido (`idParticipantesPartido`, `idOrganizarPartido`, `loginUsuario`)
								VALUES (3, 2, 'dmeeusk');
INSERT INTO participantespartido (`idParticipantesPartido`, `idOrganizarPartido`, `loginUsuario`)
								VALUES (4, 3, 'bjankovic1p');
INSERT INTO participantespartido (`idParticipantesPartido`, `idOrganizarPartido`, `loginUsuario`)
								VALUES (5, 3, 'cjost0');
-- --------------------------------------------------------


--
-- Table `pista` data input
--

INSERT INTO pista (`idPista`, `nombrePista`) VALUES (1, 'Pista 1');
INSERT INTO pista (`idPista`, `nombrePista`) VALUES (2, 'Pista 2');
INSERT INTO pista (`idPista`, `nombrePista`) VALUES (3, 'Pista 3');
INSERT INTO pista (`idPista`, `nombrePista`) VALUES (4, 'Pìsta 4');
INSERT INTO pista (`idPista`, `nombrePista`) VALUES (5, 'Pista 5');

-- --------------------------------------------------------

--
-- Table `reserva` data input
--

INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (1, 'jgrossier2a', '2018-11-01', '10:00', 1);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (2, 'hcassea', '2018-11-01', '11:30', 1);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (3, 'mpitcockb', '2018-11-01', '11:30', 2);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (4, 'ywalshe29', '2018-11-01', '11:30', 3);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (5, 'sbellfieldy', '2018-11-01', '13:00', 1);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (6, 'bjankovic1p', '2018-11-01', '13:00', 1);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (7, 'ngavagan8', '2018-11-01', '16:00', 1);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (8, 'uadshed7', '2018-11-01', '16:00', 2);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (9, 'cjost0', '2018-11-01', '17:30', 1);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (10, 'dmeeusk', '2018-11-01', '19:00', 1);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (11, 'kloftie5', '2018-11-01', '19:00', 2);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (12, 'bkeitley1', '2018-11-30', '10:00', 2);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (13, 'bkeitley1', '2018-11-25', '19:00', 2);

-- --------------------------------------------------------

--
-- Table `reservaenfrentamiento` data input
--

INSERT INTO reservaenfrentamiento(`idReserva`, `idEnfrentamiento`)
								VALUES(12, 1);

-- --------------------------------------------------------

--
-- Table `reservaorganizarpartido` data input
--
INSERT INTO reservaorganizarpartido(`idReserva`, `idOrganizarPartido`)
								VALUES(13, 3);

-- --------------------------------------------------------
  
  

  
  
  
  
-- 
--
-- Inserts
--
--

use sjjpadel;

--
-- Table `campeonato` data input
--

INSERT INTO campeonato (`idCampeonato`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `fechaInicioCampeonato`, `fechaFinCampeonato`, `nombreCampeonato`)
							VALUES (1, '2018-10-01', '2018-10-05', '2018-10-10', '2018-10-31', 'Campeonato Septiembre');
INSERT INTO campeonato (`idCampeonato`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `fechaInicioCampeonato`, `fechaFinCampeonato`, `nombreCampeonato`)
							VALUES (2, '2018-11-01', '2018-11-05', '2018-11-10', '2018-12-02', 'Campeonato Octubre');
INSERT INTO campeonato (`idCampeonato`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `fechaInicioCampeonato`, `fechaFinCampeonato`, `nombreCampeonato`)
							VALUES (3, '2018-12-01', '2018-12-05', '2018-12-10', '2018-01-05', 'Campeonato Diciembre');
INSERT INTO campeonato (`idCampeonato`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `fechaInicioCampeonato`, `fechaFinCampeonato`, `nombreCampeonato`)
							VALUES (4, '2018-12-01', '2018-12-05', '2018-12-10', '2018-01-05', 'Campeonato Especial Navidad');
INSERT INTO campeonato (`idCampeonato`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `fechaInicioCampeonato`, `fechaFinCampeonato`, `nombreCampeonato`)
							VALUES (5, '2019-01-01', '2019-01-05', '2019-01-10', '2019-01-31', 'Campeonato Enero');

-- --------------------------------------------------------

--
-- Table `categoria` data input
--

INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (1, 'principiante', 'masculino');
INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (2, 'principiante', 'femenino');
INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (3, 'principiante', 'mixto');

INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (4, 'amateur', 'masculino');
INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (5, 'amateur', 'femenino');
INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (6, 'amateur', 'mixto');

INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (7, 'profesional', 'masculino');
INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (8, 'profesional', 'femenino');
INSERT INTO categoria (`idCategoria`, `nivel`, `sexo`) VALUES (9, 'profesional', 'mixto');


-- --------------------------------------------------------

--
-- Table `categoriascampeonato` data input
--
INSERT INTO categoriascampeonato(`idCategoriasCampeonato`, `idCategoria`, `idCampeonato`)
								VALUES(1, 3, 1);

INSERT INTO categoriascampeonato(`idCategoriasCampeonato`, `idCategoria`, `idCampeonato`)
								VALUES(2, 1, 2);
INSERT INTO categoriascampeonato(`idCategoriasCampeonato`, `idCategoria`, `idCampeonato`)
								VALUES(3, 5, 2);
INSERT INTO categoriascampeonato(`idCategoriasCampeonato`, `idCategoria`, `idCampeonato`)
								VALUES(4, 7, 2);

-- --------------------------------------------------------


--
-- Table `usuario` data input
--

INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('admin', 'admin', 'admin', 'admin', 'a', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('santiD', 'Santi', 'Rodríguez González', 'rgroot', 'a', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('cjost0', 'Jost', 'Carmine', 'pass', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('bkeitley1', 'Bernie', 'Keitley', 'jRzXG', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('jhanwright0', 'Jerry', 'Shimuk', 'ES5vx7XR', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('kloftie5', 'Kelley', 'Loftie', 'sjHZ8iW', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('eofielly6', 'Etan', 'O Fielly', 'ahrVtFg', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('mpitcockb', 'Mar', 'Pitcock', 'EllDkud7', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('rswatridgec', 'Ruttger', 'Swatridge', 'S1tPv8', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('hstothere', 'Harald', 'Stother', 'hdwu19XJ4', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('espyvyef', 'Emile', 'Spyvye', 'gnuGNQpzU', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('mjaramg', 'Marissa', 'Jaram', 'Uh57EeVSPA', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('uadshed7', 'Ulrike', 'Adshed', 'YPXFWOK', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('ngavagan8', 'Nico', 'Gavagan', 't1cH2', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('hcassea', 'Helena', 'Casse', '1SGe6T', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('njiroutekb', 'Normy', 'Jiroutek', 'LKdzUrL7LLO', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('briehmi', 'Bridie', 'Riehm', '5i6PhIVGn', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('cdeyenhardtj', 'Cherilyn', 'Deyenhardt', 'Zj4y14k5Q', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('dmeeusk', 'Dylan', 'Meeus', 'dykiwj23', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('ggainfortl', 'Ginnifer', 'Gainfort', 'yOkuanm', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('gdittyp', 'Gun', 'Ditty', 'dykiwj23', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('swrates', 'Silvia', 'Wrates', 'yOkuanm', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('sbellfieldy', 'Sampson', 'Bellfield', 'W6zTcZC', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('hcattersonz', 'Hy', 'Catterson', 'aEWNRX', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('mhenrique10', 'Marlin', 'Henrique', 'AQZqEyJ', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('bjankovic1p', 'Bernarr', 'Jankovic', 'qspW50hGXD', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('hpolglase1q', 'Hanan', 'Polglase', '9cljNljk45z', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('diannini1r', 'Dermot', 'Iannini', 'QJ34Mbf9sEE', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('rghiroldi1s', 'Ring', 'Ghiroldi', 'icpcI6p', 'd', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('ywalshe29', 'Yelena', 'Walshe', 'aWTf71UxKil', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('jgrossier2a', 'Jeannette', 'Grossier', 'GEbRo5hK5qT', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('hbremeyer2b', 'Hope', 'Bremeyer', 'QGO03wlSMqP', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('shelliar2o', 'Stacie', 'Helliar', 'VbjQlZq', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('avanelli2p', 'Audre', 'Vanelli', 'Ajqb8pziF', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('kfirth2q', 'Kelsy', 'Firth', '0Ecp4Q', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('sbau2m', 'Salaidh', 'Bau', '8SrhxWw3NR', 'd', 'femenino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('cburkwoodc', 'Connie', 'Burkwood', 'mNtJnJ9MxGQJ', 'e', 'masculino');
INSERT INTO usuario (`login`, `nombre`, `apellidos`, `pass`, `rol`, `genero`) VALUES ('esruttond', 'Eachelle', 'Srutton', 'oyl7vLqER8He', 'e', 'femenino');

-- --------------------------------------------------------


--
-- Table `pareja` data input
--

INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (1, 'bkeitley1', 'espyvyef', 3);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (2, 'cburkwoodc', 'ggainfortl', 3);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (3, 'ngavagan8', 'mjaramg', 3);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (4, 'jhanwright0', 'kloftie5', 3);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (5, 'dmeeusk', 'sbellfieldy', 3);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (6, 'diannini1r', 'briehmi', 3);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (7, 'eofielly6', 'uadshed7', 3);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (8, 'rghiroldi1s', 'mhenrique10', 3);

INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (9, 'cjost0', 'gdittyp', 1);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (10, 'kloftie5', 'eofielly6', 1);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (11, 'mpitcockb', 'rswatridgec', 1);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (12, 'hstothere', 'espyvyef', 1);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (13, 'dmeeusk', 'sbellfieldy', 1);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (14, 'hcattersonz', 'mhenrique10', 1);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (15, 'bjankovic1p', 'hpolglase1q', 1);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (16, 'rghiroldi1s', 'diannini1r', 1);

INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (17, 'jhanwright0', 'bkeitley1', 5);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (18, 'mjaramg', 'uadshed7', 5);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (19, 'hcassea', 'briehmi', 5);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (20, 'cdeyenhardtj', 'ggainfortl', 5);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (21, 'kloftie5', 'ywalshe29', 5);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (22, 'jgrossier2a', 'hbremeyer2b', 5);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (23, 'shelliar2o', 'avanelli2p', 5);
INSERT INTO pareja (`idPareja`, `idCapitan`, `idCompañero`, `idCategoria`) VALUES (24, 'kfirth2q', 'sbau2m', 5);

-- --------------------------------------------------------

--
-- Table `grupo` data input
--

INSERT INTO grupo (`idGrupo`, `idCategoria`, `idCampeonato`, `nombreGrupo`) VALUES (1, 3, 1, 'Grupo 1');

INSERT INTO grupo (`idGrupo`, `idCategoria`, `idCampeonato`, `nombreGrupo`) VALUES (2, 1, 2, 'Grupo 1');
INSERT INTO grupo (`idGrupo`, `idCategoria`, `idCampeonato`, `nombreGrupo`) VALUES (3, 5, 2, 'Grupo 2');

-- --------------------------------------------------------

--
-- Table `enfrentamiento` data input
--

INSERT INTO enfrentamiento (`idEnfrentamiento`, `idPareja1`, `idPareja2`, `idGrupo`, `fecha`, `hora`, `puntosPareja1`, `puntosPareja2`, `setsPareja1`, `setsPareja2`)
					VALUES (1, 1, 4, 1, '2018-11-30', '10:00', 4, 9, 2, 1);

-- --------------------------------------------------------

--
-- Table `enfrentamiento` data input
--

INSERT INTO ofertaenfrentamiento (`idOfertaEnfrentamiento`, `idPareja`, `hora`, `fecha`) VALUES (1, 2, '16:00', '2018-11-11');
INSERT INTO ofertaenfrentamiento (`idOfertaEnfrentamiento`, `idPareja`, `hora`, `fecha`) VALUES (2, 3, '10:00', '2018-11-11');
INSERT INTO ofertaenfrentamiento (`idOfertaEnfrentamiento`, `idPareja`, `hora`, `fecha`) VALUES (3, 5, '11:30', '2018-11-12');
INSERT INTO ofertaenfrentamiento (`idOfertaEnfrentamiento`, `idPareja`, `hora`, `fecha`) VALUES (4, 10, '11:30', '2018-11-13');
INSERT INTO ofertaenfrentamiento (`idOfertaEnfrentamiento`, `idPareja`, `hora`, `fecha`) VALUES (5, 12, '10:00', '2018-11-14');
INSERT INTO ofertaenfrentamiento (`idOfertaEnfrentamiento`, `idPareja`, `hora`, `fecha`) VALUES (6, 15, '19:00', '2018-11-14');
INSERT INTO ofertaenfrentamiento (`idOfertaEnfrentamiento`, `idPareja`, `hora`, `fecha`) VALUES (7, 15, '13:00', '2018-11-14');
INSERT INTO ofertaenfrentamiento (`idOfertaEnfrentamiento`, `idPareja`, `hora`, `fecha`) VALUES (8, 7, '19:00', '2018-11-15');

-- --------------------------------------------------------

--
-- Table `organizarpartido` data input
--
INSERT INTO organizarpartido (`idOrganizarPartido`, `fecha`, `hora`)
								VALUES (1, '2018-11-21', '11:30');
INSERT INTO organizarpartido (`idOrganizarPartido`, `fecha`, `hora`)
								VALUES (2, '2018-11-23', '11:30');
INSERT INTO organizarpartido (`idOrganizarPartido`, `fecha`, `hora`)
								VALUES (3, '2018-11-25', '19:00');


-- --------------------------------------------------------

--
-- Table `parejagrupo` data input
--

INSERT INTO parejagrupo (`idPareja`, `idGrupo`)
								VALUES (9, 2);
INSERT INTO parejagrupo (`idPareja`, `idGrupo`)
								VALUES (10, 2);
INSERT INTO parejagrupo (`idPareja`, `idGrupo`)
								VALUES (11, 2);
INSERT INTO parejagrupo (`idPareja`, `idGrupo`)
								VALUES (12, 2);
INSERT INTO parejagrupo (`idPareja`, `idGrupo`)
								VALUES (13, 2);
INSERT INTO parejagrupo (`idPareja`, `idGrupo`)
								VALUES (14, 2);
INSERT INTO parejagrupo (`idPareja`, `idGrupo`)
								VALUES (15, 2);
INSERT INTO parejagrupo (`idPareja`, `idGrupo`)
								VALUES (16, 2);
-- --------------------------------------------------------

--
-- Table `participantespartido` data input
--
INSERT INTO participantespartido (`idParticipantesPartido`, `idOrganizarPartido`, `loginUsuario`)
								VALUES (1, 1, 'jgrossier2a');
INSERT INTO participantespartido (`idParticipantesPartido`, `idOrganizarPartido`, `loginUsuario`)
								VALUES (2, 1, 'bkeitley1');
INSERT INTO participantespartido (`idParticipantesPartido`, `idOrganizarPartido`, `loginUsuario`)
								VALUES (3, 2, 'dmeeusk');
INSERT INTO participantespartido (`idParticipantesPartido`, `idOrganizarPartido`, `loginUsuario`)
								VALUES (4, 3, 'bjankovic1p');
INSERT INTO participantespartido (`idParticipantesPartido`, `idOrganizarPartido`, `loginUsuario`)
								VALUES (5, 3, 'cjost0');
-- --------------------------------------------------------


--
-- Table `pista` data input
--

INSERT INTO pista (`idPista`, `nombrePista`) VALUES (1, 'Pista 1');
INSERT INTO pista (`idPista`, `nombrePista`) VALUES (2, 'Pista 2');
INSERT INTO pista (`idPista`, `nombrePista`) VALUES (3, 'Pista 3');
INSERT INTO pista (`idPista`, `nombrePista`) VALUES (4, 'Pìsta 4');
INSERT INTO pista (`idPista`, `nombrePista`) VALUES (5, 'Pista 5');

-- --------------------------------------------------------

--
-- Table `reserva` data input
--

INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (1, 'jgrossier2a', '2018-11-01', '10:00', 1);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (2, 'hcassea', '2018-11-01', '11:30', 1);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (3, 'mpitcockb', '2018-11-01', '11:30', 2);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (4, 'ywalshe29', '2018-11-01', '11:30', 3);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (5, 'sbellfieldy', '2018-11-01', '13:00', 1);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (6, 'bjankovic1p', '2018-11-01', '13:00', 1);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (7, 'ngavagan8', '2018-11-01', '16:00', 1);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (8, 'uadshed7', '2018-11-01', '16:00', 2);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (9, 'cjost0', '2018-11-01', '17:30', 1);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (10, 'dmeeusk', '2018-11-01', '19:00', 1);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (11, 'kloftie5', '2018-11-01', '19:00', 2);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (12, 'bkeitley1', '2018-11-30', '10:00', 2);
INSERT INTO reserva (`idReserva`, `idusuarioReserva`, `fechaReserva`, `horaReserva`, `idPista`) VALUES (13, 'bkeitley1', '2018-11-25', '19:00', 2);

-- --------------------------------------------------------

--
-- Table `reservaenfrentamiento` data input
--

INSERT INTO reservaenfrentamiento(`idReserva`, `idEnfrentamiento`)
								VALUES(12, 1);

-- --------------------------------------------------------

--
-- Table `reservaorganizarpartido` data input
--
INSERT INTO reservaorganizarpartido(`idReserva`, `idOrganizarPartido`)
								VALUES(13, 3);

-- --------------------------------------------------------
