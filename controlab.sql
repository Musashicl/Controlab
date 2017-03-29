-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-08-2012 a las 22:11:05
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `controlab`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `estado`) VALUES
(1, 'En Diagnostico'),
(2, 'Espera de Repuestos'),
(3, 'Reparado/Disponible'),
(4, 'asd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ez_access_keys`
--

CREATE TABLE IF NOT EXISTS `ez_access_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `program` varchar(255) DEFAULT NULL,
  `access` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ez_auth`
--

CREATE TABLE IF NOT EXISTS `ez_auth` (
  `user_id` int(11) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `reset_code` varchar(255) DEFAULT NULL,
  `cookie_hash` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ez_users`
--

CREATE TABLE IF NOT EXISTS `ez_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE IF NOT EXISTS `ingresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `fingreso` datetime NOT NULL,
  `motivo` varchar(200) NOT NULL,
  `descripcion` text,
  `fsalida` datetime DEFAULT NULL,
  `diagnostico` text,
  `ubicacion_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_idIngreso_Tipos` (`tipo_id`),
  KEY `fk_idIngreso_Estados` (`estado_id`),
  KEY `fk_idIngreso_Ubicaciones` (`ubicacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id`, `ticket`, `estado_id`, `tipo_id`, `fingreso`, `motivo`, `descripcion`, `fsalida`, `diagnostico`, `ubicacion_id`) VALUES
(1, 151515, 3, 1, '2012-08-01 06:53:00', 'motivo 1', 'desc 1', '2012-08-02 14:46:00', 'reparado', 2),
(2, 234234, 2, 2, '2012-08-02 11:14:00', 'motivo 2', 'desc 2', '2012-08-24 12:15:00', 'diag 2 edited 2', 2),
(4, 345345, 1, 1, '2012-06-21 00:00:00', 'motivo3', 'desc 3', '2012-06-21 00:09:00', 'diag 3', 3),
(8, 432, 2, 2, '2012-09-07 07:10:00', 'edited fecha 1', 'desc6', NULL, '', 3),
(18, 789456, 2, 2, '2012-07-12 00:00:00', 'asd', 'asd', NULL, 'asdsda', 3),
(29, 1232323, 1, 3, '2012-08-02 00:54:00', 'asd', 'asd', NULL, 'asd', 1),
(30, 321147, 1, 1, '0000-00-00 00:00:00', '', '', NULL, '', 1),
(31, 321147, 1, 2, '2012-08-03 05:08:00', 'asd', 'asd', NULL, 'asd', 1),
(32, 321147, 1, 2, '0000-00-00 00:00:00', 'motivo form test', '', NULL, '', 1),
(33, 321147, 1, 2, '2012-07-19 00:00:00', 'motivo form test', 'desc form test', NULL, 'diag form  test', 3),
(34, 432242, 1, 1, '0000-00-00 00:00:00', '', '', NULL, '', 1),
(35, 0, 1, 1, '0000-00-00 00:00:00', '', '', NULL, '', 1),
(36, 32145, 2, 3, '0000-00-00 00:00:00', 'sdfdf', 'dfdf', NULL, 'sdfsdf', 2),
(37, 85684, 2, 2, '0000-00-00 00:00:00', 'test form 3', 'desc 3', NULL, 'diag 3', 1),
(38, 459721, 1, 1, '0000-00-00 00:00:00', 'test ajax form', 'desc ajax form', NULL, 'diag ajax form', 1),
(39, 52525, 1, 1, '0000-00-00 00:00:00', 'fdsrte', 'rew', NULL, 'rew', 1),
(40, 3215, 4, 2, '0000-00-00 00:00:00', 'asd', 'dsa', NULL, 'dsa', 1),
(41, 46464, 1, 1, '0000-00-00 00:00:00', 'jghjgh', 'ghjhg', NULL, 'ghjghj', 1),
(42, 321324, 1, 1, '0000-00-00 00:00:00', 'qwe', 'qwe', NULL, 'qwe', 1),
(43, 64646, 1, 1, '0000-00-00 00:00:00', 'sdf', 'sdf', NULL, 'sdf', 1),
(44, 76767, 1, 1, '0000-00-00 00:00:00', 'rty', 'rty', NULL, 'rty', 3),
(45, 7477, 1, 1, '0000-00-00 00:00:00', 'asd', 'asd', NULL, 'asd', 1),
(46, 646464, 1, 1, '0000-00-00 00:00:00', 'dsds', 'dsd', NULL, 'sdsd', 1),
(47, 646464, 1, 1, '0000-00-00 00:00:00', 'dsds', 'dsd', NULL, 'sdsd', 1),
(48, 7676, 1, 1, '0000-00-00 00:00:00', 'fgh', 'fgh', NULL, 'fgh', 1),
(49, 26262, 1, 1, '0000-00-00 00:00:00', 'werwe', 'werwe', NULL, 'werwe', 1),
(50, 454, 1, 1, '0000-00-00 00:00:00', 'wer', 'wer', NULL, 'wer', 1),
(51, 5353, 1, 1, '0000-00-00 00:00:00', 'qwd', 'asd', NULL, 'asd', 1),
(52, 3434, 1, 1, '0000-00-00 00:00:00', '5535', '53', NULL, 's', 1),
(53, 3535, 1, 1, '0000-00-00 00:00:00', 'grdf', 'gdg', NULL, 'g', 1),
(54, 336363, 1, 1, '0000-00-00 00:00:00', 'qw', 'wr', NULL, 'wr', 1),
(55, 35353, 1, 1, '0000-00-00 00:00:00', '3535', '3535', NULL, '3535', 1),
(56, 535553, 1, 1, '2012-07-20 12:30:00', 'test fecha', 'test decha 07/20/2012', NULL, 'test', 1),
(57, 656566, 1, 1, '2012-07-23 13:00:00', 'test fecha 2', 'dwxh', NULL, 'RWAR', 1),
(58, 123654, 1, 1, '2012-07-20 16:19:00', 'test new way of the form', 'new way', NULL, 'in waves', 1),
(59, 7686, 1, 2, '2012-07-19 06:13:00', 'tuuj', 'jgj', NULL, 'j', 3),
(60, 12325, 1, 1, '2012-11-07 06:12:00', 'mortivo editado', 'ñ', NULL, '', 1),
(61, 2344, 2, 3, '2012-04-25 12:45:00', '4234', 'serer', '2012-08-22 05:54:00', 'erer', 1),
(62, 12341, 1, 1, '2012-08-22 05:24:00', 'adada', 'dad', NULL, 'ada', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE IF NOT EXISTS `tipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `tipo`) VALUES
(1, 'Notebook'),
(2, 'Desktop'),
(3, 'Generico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE IF NOT EXISTS `ubicaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ubicacion` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`id`, `ubicacion`) VALUES
(1, 'Piso 1'),
(2, 'Piso 2'),
(3, 'Piso 3');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `fk_idIngreso_Estados` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idIngreso_Tipos` FOREIGN KEY (`tipo_id`) REFERENCES `tipos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idIngreso_Ubicaciones` FOREIGN KEY (`ubicacion_id`) REFERENCES `ubicaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
