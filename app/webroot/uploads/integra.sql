-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-11-2013 a las 12:12:21
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `integra`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `process_id` int(11) NOT NULL,
  `leader_id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `areastype_id` varchar(300) NOT NULL,
  `state` varchar(100) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `id_username` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `process_id`, `leader_id`, `name`, `areastype_id`, `state`, `created`, `modified`, `id_username`) VALUES
(7, 7, 0, 'Secretaria General', '', 'Activo', '2013-09-03', '2013-09-03', ''),
(8, 10, 0, 'Operaciones', '7', 'Activo', '2013-09-04', '2013-10-16', ''),
(9, 7, 0, 'Control Interno', '11', 'Activo', '2013-10-08', '2013-10-15', ''),
(10, 10, 0, 'Comercial', '', 'Activo', '2013-10-15', '2013-10-15', 'admin'),
(11, 7, 0, 'comunicaciones', '9', 'Activo', '2013-10-16', '2013-10-21', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas_types`
--

CREATE TABLE IF NOT EXISTS `areas_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `state` varchar(30) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `areas_types`
--

INSERT INTO `areas_types` (`id`, `name`, `state`, `created`, `modified`) VALUES
(7, 'oficina central ', 'Activo', '2013-10-08', '2013-10-09'),
(8, 'centro de distribucion', 'Activo', '2013-10-10', '2013-10-18'),
(9, 'agencia', 'Activo', '2013-10-10', '2013-10-10'),
(10, 'area', 'Inactivo', '2013-10-10', '2013-10-15'),
(11, 'DirecciÃ³n', 'Activo', '2013-10-10', '2013-10-10'),
(12, 'Departamento', 'Activo', '2013-10-15', '2013-10-15'),
(13, 'Extension', 'Activo', '2013-10-21', '2013-10-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) unsigned NOT NULL,
  `aco_id` int(10) unsigned NOT NULL,
  `_create` char(2) NOT NULL DEFAULT '0',
  `_read` char(2) NOT NULL DEFAULT '0',
  `_update` char(2) NOT NULL DEFAULT '0',
  `_delete` char(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `counts`
--

CREATE TABLE IF NOT EXISTS `counts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countname` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pasword` varchar(200) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `state` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `created`, `modified`) VALUES
(1, 'poster 1', 'descripcion 1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `processes`
--

CREATE TABLE IF NOT EXISTS `processes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `type` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `target` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `input` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `activities` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `output` text NOT NULL,
  `requeriments` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `id_position_responsable` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_4` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `processes`
--

INSERT INTO `processes` (`id`, `name`, `type`, `target`, `input`, `activities`, `output`, `requeriments`, `id_position_responsable`, `state`, `user`, `created`, `modified`) VALUES
(10, 'logistica', 'Apoyo', 'direccion de servicios logisticos ', '', '', '', '', 0, 0, 0, '2013-08-29', '2013-08-29'),
(7, 'calidad', 'Apoyo', 'proceso de calidad actualizado', '', '', '', '', 0, 0, 0, '2013-08-27', '2013-08-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`) VALUES
(1, 'admin', 'e0e094fe753c2395428a2244d946523619c0ef38', 'admin', '2013-07-07 15:31:28', '2013-07-07 15:31:28'),
(2, 'juan', 'c5f3f9184c96b9a7cb136263c4da5aebe1ff8457', 'author', '2013-07-07 15:38:39', '2013-07-07 15:38:39'),
(3, 'tomas', '8606cb9d08fd4ac93f9c1af5ec3a4257415addcc', 'admin', '2013-07-18 14:41:49', '2013-07-18 14:41:49'),
(4, 'nilton', '8606cb9d08fd4ac93f9c1af5ec3a4257415addcc', 'admin', '2013-08-23 11:59:39', '2013-08-23 11:59:39');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
