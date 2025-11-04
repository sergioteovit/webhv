-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-11-2025 a las 10:39:51
-- Versión del servidor: 8.0.34
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `myhvirtual`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE `profiles` (
  `ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `FNAME` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `LNAME` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `EMAIL` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `USERNAME` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PASSWORD` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ROLE` int NOT NULL DEFAULT '0',
  `PICTURE` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'html/images/profilepicture.png',
  `CONNECTED` int NOT NULL DEFAULT '0',
  `SIGNIN` date DEFAULT NULL,
  `SIGNOUT` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`ID`, `FNAME`, `LNAME`, `EMAIL`, `USERNAME`, `PASSWORD`, `ROLE`, `PICTURE`, `CONNECTED`, `SIGNIN`, `SIGNOUT`) VALUES
('67c247c450d23', 'Sergio', 'Teodoro Vite', 'sergio.teodoro@facmed.unam.mx', 'sergioteovit', '123', 0, 'html/images/profilepicture.png', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `systems`
--

CREATE TABLE `systems` (
  `ID` int NOT NULL,
  `System` text,
  `Icon` text,
  `Description` text,
  `Url` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `systems`
--

INSERT INTO `systems` (`ID`, `System`, `Icon`, `Description`, `Url`) VALUES
(1, 'Tegumentario', 'tegumentario.png', '', 'tegumentario'),
(2, 'Muscular', 'muscular.png', '', 'muscular'),
(3, 'Óseo', 'oseo.png', '', 'oseo'),
(4, 'Nervioso', 'nervioso.png', '', 'nervioso'),
(5, 'Endócrino', 'endocrino.png', '', 'endocrino'),
(6, 'Linfático o inmunológico', 'linfatico.png', '', 'linfatico'),
(7, 'Circulatorio', 'circulatorio.png', '', 'circulatorio'),
(8, 'Urinario', 'urinario.png', '', 'urinario'),
(9, 'Respiratorio', 'respiratorio.png', '', 'respiratorio'),
(10, 'Digestivo', 'digestivo.png', '', 'digestivo'),
(11, 'Reproductor Masculino', 'reproductormasculino.png', '', 'reproductormasculino'),
(12, 'Reproductor Femenino', 'reproductorfemenino.png', '', 'reproductorfemenino');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
