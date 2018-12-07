ALTER TABLE `campeonato` ADD `fase` ENUM('Inscripcion', 'Grupos', 'Eliminatoria') NOT NULL AFTER `nombreCampeonato`;
ALTER TABLE `enfrentamiento` ADD `fase` ENUM('Grupos', 'Cuartos', 'Semifinal', 'Final') NOT NULL AFTER `idGrupo`;
