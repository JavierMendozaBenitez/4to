-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2023 a las 02:03:16
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `garage_bd`
--
CREATE DATABASE IF NOT EXISTS `garage_bd` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `garage_bd`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autos`
--

CREATE TABLE `autos` (
  `patente` varchar(30) NOT NULL,
  `marca` varchar(30) NOT NULL,
  `color` varchar(15) NOT NULL,
  `precio` double NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `autos`
--

INSERT INTO `autos` (`patente`, `marca`, `color`, `precio`, `foto`) VALUES
('ABC123', 'Toyota', 'Azul', 15000, 'sin foto'),
('DEF456', 'Honda', 'rojo', 56454, 'sin foto'),
('GHI789', 'Ford', 'negro', 18000, 'sin foto'),
('JKL012', 'Chevrolet', 'Blanco', 16000, 'sin foto'),
('ÑE56ER', 'ferrari', 'purpu', 9999, 'ÑE56ER.003929.jpg'),
('NE123IN', 'hiund', 'gris', 12344, 'NE123IN.004004.jpg'),
('ZU456NA', 'ecoSport', 'negro', 64646, 'ZU456NA.004032.jpg'),
('LA6123L', 'zukas', 'blankito', 45454, 'LA6123L.004104.jpg'),
('FGNOSNO', 'subaru', 'negrito', 56565, 'FGNOSNO.004153.jpg'),
('MI13I', 'lexus', 'amarillo', 123456, 'MI13I.004232.png'),
('MA22A', 'FERRARI', 'naranja', 9999999999, 'MA22A.004311.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
