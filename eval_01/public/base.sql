SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `recetario` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `recetario`;

CREATE TABLE `consolidado` (
  `consolidado_id` int(11) NOT NULL,
  `receta_id` int(11) DEFAULT NULL,
  `ingrediente_id` int(11) DEFAULT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `unidad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ingredientes` (
  `ingrediente_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `unidad` varchar(20) NOT NULL,
  `calorias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `recetas` (
  `receta_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `tiempo_preparacion` int(11) NOT NULL,
  `dificultad` enum('Fácil','Media','Difícil') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `consolidado`
  ADD PRIMARY KEY (`consolidado_id`),
  ADD KEY `receta_id` (`receta_id`),
  ADD KEY `ingrediente_id` (`ingrediente_id`);

ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`ingrediente_id`);

ALTER TABLE `recetas`
  ADD PRIMARY KEY (`receta_id`);


ALTER TABLE `consolidado`
  MODIFY `consolidado_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ingredientes`
  MODIFY `ingrediente_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `recetas`
  MODIFY `receta_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `consolidado`
  ADD CONSTRAINT `consolidado_ibfk_1` FOREIGN KEY (`receta_id`) REFERENCES `recetas` (`receta_id`),
  ADD CONSTRAINT `consolidado_ibfk_2` FOREIGN KEY (`ingrediente_id`) REFERENCES `ingredientes` (`ingrediente_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;