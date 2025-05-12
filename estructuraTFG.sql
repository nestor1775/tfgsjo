-- --------------------------------------------------------
-- Host:                         tfgnestor-tfgnestor.b.aivencloud.com
-- Versión del servidor:         8.0.35 - Source distribution
-- SO del servidor:              Linux
-- HeidiSQL Versión:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para AppPartesTrabajo
CREATE DATABASE IF NOT EXISTS `AppPartesTrabajo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `AppPartesTrabajo`;

-- Volcando estructura para tabla AppPartesTrabajo.Administradores
CREATE TABLE IF NOT EXISTS `Administradores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_usuario` (`nombre_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla AppPartesTrabajo.Partes
CREATE TABLE IF NOT EXISTS `Partes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_proyecto` int DEFAULT NULL,
  `id_trabajador` int DEFAULT NULL,
  `fecha` date NOT NULL,
  `horas_trabajadas` decimal(5,2) NOT NULL,
  `horas_extra` tinyint(1) DEFAULT NULL,
  `dia_festivo` tinyint(1) DEFAULT '0',
  `observaciones` text,
  `firma_responsable_empresaorigen` text,
  `firma_responsable_airtek` text,
  PRIMARY KEY (`id`),
  KEY `id_proyecto` (`id_proyecto`),
  KEY `id_trabajador` (`id_trabajador`),
  CONSTRAINT `Partes_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `Proyectos` (`id`),
  CONSTRAINT `Partes_ibfk_2` FOREIGN KEY (`id_trabajador`) REFERENCES `Trabajadores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla AppPartesTrabajo.Proyectos
CREATE TABLE IF NOT EXISTS `Proyectos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `link_parte` text,
  `id_administrador` int DEFAULT NULL,
  `is_activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_administrador` (`id_administrador`),
  CONSTRAINT `Proyectos_ibfk_1` FOREIGN KEY (`id_administrador`) REFERENCES `Administradores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla AppPartesTrabajo.Trabajadores
CREATE TABLE IF NOT EXISTS `Trabajadores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
