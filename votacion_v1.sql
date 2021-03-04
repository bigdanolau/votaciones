-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla votacion.alumnos
CREATE TABLE IF NOT EXISTS `alumnos` (
  `id_alumnos` int(11) NOT NULL AUTO_INCREMENT,
  `cedula_alumno` int(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `carrera` varchar(50) NOT NULL,
  `cod_candidato` int(50) NOT NULL,
  `voto` int(50) NOT NULL,
  UNIQUE KEY `id_alumnos` (`id_alumnos`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla votacion.candidatos
CREATE TABLE IF NOT EXISTS `candidatos` (
  `id_candidato` int(11) NOT NULL AUTO_INCREMENT,
  `cedula_candidato` int(50) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `cod_candidato` int(50) NOT NULL,
  `imagen` text,
  PRIMARY KEY (`id_candidato`),
  UNIQUE KEY `cedula_candidato` (`cedula_candidato`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla votacion.carreras
CREATE TABLE IF NOT EXISTS `carreras` (
  `id_carreras` int(50) NOT NULL AUTO_INCREMENT,
  `carreras` varchar(50) NOT NULL,
  PRIMARY KEY (`id_carreras`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla votacion.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  UNIQUE KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para vista votacion.votos
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `votos` (
	`carrera` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`cod_candidato` INT(50) NOT NULL,
	`nombre` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`votos` BIGINT(21) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista votacion.votos
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `votos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `votos` AS select `alumnos`.`carrera` AS `carrera`,`alumnos`.`cod_candidato` AS `cod_candidato`,`candidatos`.`nombre` AS `nombre`,count(`alumnos`.`carrera`) AS `votos` from (`alumnos` join `candidatos` on((`candidatos`.`cod_candidato` = `alumnos`.`cod_candidato`))) group by `alumnos`.`carrera`,`alumnos`.`cod_candidato`,`candidatos`.`nombre` ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
