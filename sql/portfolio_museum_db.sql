-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2022 a las 11:52:47
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `portfolio_museum_db`
--
CREATE DATABASE IF NOT EXISTS `portfolio_museum_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `portfolio_museum_db`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obras_s1`
--

CREATE TABLE `obras_s1` (
  `id` int(11) NOT NULL,
  `titulo_obra` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ruta_obra` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_username` varchar(30) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `extension_obra` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_de_obra` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pm_usuarios`
--
-- Error leyendo la estructura de la tabla portfolio_museum_db.pm_usuarios: #1932 - Table &#039;portfolio_museum_db.pm_usuarios&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla portfolio_museum_db.pm_usuarios: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `portfolio_museum_db`.`pm_usuarios`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_pm`
--

CREATE TABLE `usuarios_pm` (
  `usuario_id` int(4) NOT NULL,
  `usuario_nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `usuario_apellido` varchar(30) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `usuario_username` varchar(15) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `usuario_email` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `usuario_clave` varchar(32) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `usuario_edad` int(3) NOT NULL DEFAULT 0,
  `usuario_nacionalidad` varchar(30) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `usuario_freg` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios_pm`
--

INSERT INTO `usuarios_pm` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_username`, `usuario_email`, `usuario_clave`, `usuario_edad`, `usuario_nacionalidad`, `usuario_freg`) VALUES
(1, 'Nacho', 'Occhipinti', 'nachoocchi', 'nachochi@mail.com', '5a885db69098cf494776f16035e529f0', 23, 'Argentina', '2022-10-30 23:51:31'),
(3, 'admin', 'admin', 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 100, 'Argentina', '2022-10-31 20:40:45'),
(5, 'Jose', 'Lopez', 'joselopez', 'jose@mail.com', '5a885db69098cf494776f16035e529f0', 36, 'Argentina', '2022-11-29 16:06:10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `obras_s1`
--
ALTER TABLE `obras_s1`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_pm`
--
ALTER TABLE `usuarios_pm`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `obras_s1`
--
ALTER TABLE `obras_s1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT de la tabla `usuarios_pm`
--
ALTER TABLE `usuarios_pm`
  MODIFY `usuario_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
