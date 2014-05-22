-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-01-2014 a las 22:32:37
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `crm`
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
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `process_id`, `leader_id`, `name`, `areastype_id`, `state`, `created`, `modified`, `user_id`) VALUES
(7, 7, 0, 'Secretaria General', '', 'Activo', '2013-09-03', '2013-09-03', 0),
(8, 10, 0, 'Operaciones', '7', 'Activo', '2013-09-04', '2013-10-16', 0),
(9, 7, 0, 'Control Interno', '11', 'Activo', '2013-10-08', '2013-10-15', 0),
(10, 10, 0, 'Comercial', '', 'Activo', '2013-10-15', '2013-10-15', 0),
(11, 7, 0, 'comunicaciones', '9', 'Activo', '2013-10-16', '2013-10-21', 0),
(12, 11, 0, 'compras y demas', '', 'Activo', '2013-12-23', '2013-12-23', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Group', 1, '', 1, 4),
(2, NULL, 'Group', 2, '', 5, 8),
(3, NULL, 'Group', 3, '', 9, 12),
(4, NULL, 'User', 1, '', 2, 3),
(5, NULL, 'User', 2, '', 6, 7),
(6, 3, 'User', 3, '', 10, 11);

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
-- Estructura de tabla para la tabla `cidades`
--

CREATE TABLE IF NOT EXISTS `cidades` (
  `id` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `estado_id` int(2) unsigned zerofill NOT NULL DEFAULT '00',
  `nome` varchar(50) NOT NULL DEFAULT '',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9720 ;

--
-- Volcado de datos para la tabla `cidades`
--

INSERT INTO `cidades` (`id`, `estado_id`, `nome`) VALUES
(9715, 01, 'itagui'),
(9716, 01, 'medellin'),
(9717, 02, 'bogota'),
(9718, 02, 'chia'),
(9719, 02, 'ciudad bolivar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `state` varchar(20) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Volcado de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `customer_id`, `name`, `phone`, `email`, `state`, `created`, `modified`) VALUES
(4, 1, 'nombre contacto 1', 'tel 1', '0', 'Activo', '2014-01-09', '2014-01-09'),
(5, 2, 'nombre contacto 2', 'tel 1', '0', 'Activo', '2014-01-09', '2014-01-09'),
(9, 3, 'NILTON ALVAREZ', 'TEL NIL', '0', 'Activo', '2014-01-09', '2014-01-09'),
(13, 3, 'Marcela', 'tel marce', '0', 'Activo', '2014-01-09', '2014-01-09'),
(14, 3, 'juan pedro', '', '0', 'Activo', '2014-01-09', '2014-01-09'),
(15, 4, 'CATALINA ', '43915885', '0', 'Activo', '2014-01-09', '2014-01-09'),
(16, 4, 'Tomas Alvarez Jaramillo', '3007926171', '0', 'Activo', '2014-01-09', '2014-01-09'),
(17, 4, 'Jhon villa', '4443448 ext 142 ', '0', 'Activo', '2014-01-09', '2014-01-09'),
(18, 36, 'carlos beta', '2310000', 'carbeta@esu.com.co', 'Inactivo', '2014-01-10', '2014-01-13'),
(21, 4, 'FREDY', '3005768749', 'PETERLOB', '', '2014-01-10', '2014-01-10'),
(22, 0, 'ANDRES CUARTAS', '20000', 'ACUARTAS@', '', '2014-01-10', '2014-01-10'),
(23, 4, 'cristina jaramillo', '2582455', 'crisjar@esu.com', 'Inactivo', '2014-01-10', '2014-01-13'),
(26, 4, 'juan esteban', '1234546', 'emai', 'Inactivo', '2014-01-10', '2014-01-13'),
(27, 4, 'angela', '21a', 'ema', '', '2014-01-10', '2014-01-10'),
(28, 4, 'aver', '2121', 'ema', '', '2014-01-10', '2014-01-10'),
(29, 4, 'tata', '23232', 'cac', 'Inactivo', '2014-01-10', '2014-01-13'),
(30, 4, 'monica', '2121', '111', 'Inactivo', '2014-01-10', '2014-01-13'),
(31, 4, 'julio', '5454', '4545', 'Inactivo', '2014-01-10', '2014-01-13'),
(32, 4, 'catalina lopez', 'asas', '12121', '', '2014-01-10', '2014-01-10'),
(33, 4, 'julio verne', '1212', '878as78a7s87', 'Inactivo', '2014-01-10', '2014-01-13'),
(34, 37, 'Jhon jairo', '236444', 'jvilla@esu.com.co', 'Inactivo', '2014-01-10', '2014-01-13'),
(35, 37, 'NILTON ALVAREZ', '2311111', 'nalvarez@esu.com', 'Inactivo', '2014-01-10', '2014-01-13'),
(36, 37, 'Tato', '12121', 'nalvarez@esu.com', 'Inactivo', '2014-01-10', '2014-01-13'),
(37, 37, 'cata', '23232', 'asa@esu.com', 'Inactivo', '2014-01-13', '2014-01-13'),
(38, 37, 'juan pablo', '2361121', 'nalvarez@esu.com', '', '2014-01-13', '2014-01-13'),
(39, 36, 'luz', '2311', 'car@esu.com', '', '2014-01-13', '2014-01-13'),
(40, 3, 'carlos ben', '1316', 'nalvarez@esu.com', '', '2014-01-13', '2014-01-13'),
(41, 3, 'juanes', '1234', 'nalvarez@esu.com', '', '2014-01-13', '2014-01-13'),
(42, 38, 'jhon jairo', '4443448 ext 143 ', 'jvilla@esu.com.co', 'Activo', '2014-01-13', '2014-01-13'),
(43, 38, 'daniel ', '232323', 'juanes@esu.com.co', '', '2014-01-13', '2014-01-13'),
(44, 3, 'yenifer marin', '2323', 'nalvarez@esu.com', 'Inactivo', '2014-01-14', '2014-01-14'),
(45, 39, 'alejandra', '2321', 'nalvarez@esu.com.co', 'Activo', '2014-01-14', '2014-01-14'),
(46, 39, 'alejo hector', '232', 'nalvarez@esu.com', '', '2014-01-14', '2014-01-14'),
(47, 39, 'marimar', '12121', 'nalvarez@esu.com', 'Activo', '2014-01-14', '2014-01-14'),
(48, 40, 'RAMON  PELAEZ', '2365', 'nalvarez@esu.com.co', 'Activo', '2014-01-15', '2014-01-15'),
(49, 0, '', '', '', '', '2014-01-24', '2014-01-24'),
(50, 0, '', '', '', '', '2014-01-24', '2014-01-24'),
(51, 0, '', '', '', '', '2014-01-24', '2014-01-24'),
(52, 0, '', '', '', '', '2014-01-24', '2014-01-24'),
(53, 0, '', '', '', '', '2014-01-24', '2014-01-24');

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
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `dress` varchar(200) NOT NULL,
  `note` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `Department_id` int(11) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `state` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `dress`, `note`, `email`, `Department_id`, `user_id`, `created`, `modified`, `state`) VALUES
(1, 'cleinte 2012121', '2122421', 'cra s2asa', '<p><strong>titulo</strong></p><p>ALIAMOS Ltda. Alianzas para el Mejoramiento Organizacional se dedica a brindar servicios de asesor&iacute;a y consultor&iacute;a a empresas del sector p&uacute;blico y privado por medio de la transferencia de conocimientos, herramientas y metodolog&iacute;as, que aporten a su desarrollo y mejoramiento organizacional; somos un equipo de profesionales competentes en diferentes disciplinas y nuestro trabajo se basa en una relaci&oacute;n de confianza, confidencialidad y respeto con las entidades clientes.</p><ul><li>uno&nbsp;</li><li>dos&nbsp;</li><li>tres</li></ul>', 'nalvarez@esu.com.co', 6, '4', '2014-01-08', '2014-01-13', 'Activo'),
(2, 'ESU editname', '332', 'cll 16 edit ', '<p><strong>AVER SI DAAAAAAAAAAAAsasas</strong></p>', 'nalvarez@esu.com.co', 1, '1', '2014-01-09', '2014-01-13', 'Activo'),
(36, 'carbeta', '2310000', 'call', '<p><strong>carlos betaaaaa</strong></p>\r\n', 'carbeta@esu.com.co', 1, '2', '2014-01-10', '2014-01-10', 'Activo'),
(37, 'consultoria jvilla', '236444', 'clll', '<p><em>asjshajsjasjaj</em></p>\r\n', 'jvilla@esu.com.co', 4, '1', '2014-01-10', '2014-01-10', 'Activo'),
(38, 'VILLA CONSULTORES', '4443448 ext 143 ', 'cll 16 ....', '<p><em>texttt</em></p>', 'jvilla@esu.com.co', 2, '2', '2014-01-13', '2014-01-13', 'Activo'),
(39, 'aleja asesorias', '2321', 'cll 10', '<p>Descripcion</p>', 'nalvarez@esu.com.co', 1, '1', '2014-01-14', '2014-01-14', 'Activo'),
(40, 'RAMON', '2365', 'SASA', '<p>S&Ntilde;DLS&Ntilde;DS&Ntilde;DSSSSSSSS</p>', 'nalvarez@esu.com.co', 3, '8', '2014-01-15', '2014-01-15', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `uf` varchar(10) NOT NULL DEFAULT '',
  `nome` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `uf`, `nome`) VALUES
(01, 'ANTIOQUIA', 'Antioquia'),
(02, 'CUNDINAMAR', 'Cundinamarca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Administrador', NULL, NULL),
(2, 'Registro y Actualizacion', NULL, NULL),
(3, 'Invitado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Departments`
--

CREATE TABLE IF NOT EXISTS `Departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `Departments`
--

INSERT INTO `Departments` (`id`, `name`, `created`, `modified`) VALUES
(1, 'AMAZONAS', '0000-00-00', '0000-00-00'),
(2, 'ANTIOQUIA', '0000-00-00', '0000-00-00'),
(3, 'ARAUCA', '0000-00-00', '0000-00-00'),
(4, 'ATLANTICO', '0000-00-00', '0000-00-00'),
(5, 'BOLIVAR', '0000-00-00', '0000-00-00'),
(6, 'BOYACA', '0000-00-00', '0000-00-00'),
(7, 'CALDAS', '0000-00-00', '0000-00-00'),
(8, 'CAQUETA', '0000-00-00', '0000-00-00'),
(9, 'CASANARE', '0000-00-00', '0000-00-00'),
(10, 'CAUCA', '0000-00-00', '0000-00-00'),
(11, 'CESAR', '0000-00-00', '0000-00-00'),
(12, 'CHOCO', '0000-00-00', '0000-00-00'),
(13, 'CORDOBA', '0000-00-00', '0000-00-00'),
(14, 'CUNDINAMARCA', '0000-00-00', '0000-00-00'),
(15, 'GUAINIA', '0000-00-00', '0000-00-00'),
(16, 'GUAVIARE', '0000-00-00', '0000-00-00'),
(17, 'HUILA', '0000-00-00', '0000-00-00'),
(18, 'LA GUAJIRA', '0000-00-00', '0000-00-00'),
(19, 'MAGDALENA', '0000-00-00', '0000-00-00'),
(20, 'META', '0000-00-00', '0000-00-00'),
(21, 'NARI', '0000-00-00', '0000-00-00'),
(22, 'NORTE DE SANTANDER', '0000-00-00', '0000-00-00'),
(23, 'PUTUMAYO', '0000-00-00', '0000-00-00'),
(24, 'QUINDIO', '0000-00-00', '0000-00-00'),
(25, 'RISARALDA', '0000-00-00', '0000-00-00'),
(26, 'SAN ANDRES', '0000-00-00', '0000-00-00'),
(27, 'SANTANDER', '0000-00-00', '0000-00-00'),
(28, 'SUCRE', '0000-00-00', '0000-00-00'),
(29, 'TOLIMA', '0000-00-00', '0000-00-00'),
(30, 'VALLE DEL CAUCA', '0000-00-00', '0000-00-00'),
(31, 'VAUPES', '0000-00-00', '0000-00-00'),
(32, 'VICHADA', '0000-00-00', '0000-00-00');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `processes`
--

INSERT INTO `processes` (`id`, `name`, `type`, `target`, `input`, `activities`, `output`, `requeriments`, `id_position_responsable`, `state`, `user`, `created`, `modified`) VALUES
(11, 'Control interno', 'Evaluacion', 'asasas', '', '', '', '', 0, 0, 0, '2013-12-18', '2013-12-18'),
(7, 'calidad', 'Apoyo', 'proceso de calidad actualizado', '', '', '', '', 0, 0, 0, '2013-08-27', '2013-08-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proffers`
--

CREATE TABLE IF NOT EXISTS `proffers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `contact_id` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `state` varchar(100) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `expired` varchar(200) NOT NULL,
  `log` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `proffers`
--

INSERT INTO `proffers` (`id`, `customer_id`, `contact_id`, `user_id`, `description`, `state`, `created`, `modified`, `expired`, `log`) VALUES
(4, 1, '5', 0, '', 'Vigente', '2014-01-24', '2014-01-24', '01/16/14', ''),
(5, 40, '9', 0, '<p>asasasasa</p>', 'Vigente', '2014-01-24', '2014-01-24', '01/22/14', ''),
(6, 38, '16', 0, 'seguridad fisica', 'Vigente', '2014-01-24', '2014-01-24', '01/15/14', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `name` varchar(300) NOT NULL,
  `lastname` varchar(300) NOT NULL,
  `email` varchar(200) NOT NULL,
  `area_id` int(4) NOT NULL,
  `state` varchar(10) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user_id`, `username`, `name`, `lastname`, `email`, `area_id`, `state`, `password`, `role`, `group_id`, `created`, `modified`) VALUES
(1, 0, 'admin', 'administrador', '', '', 7, 'Activo', '1f697a6c777c97f19364fac0c3ab1bc0ec102389', 'admin', 0, '2013-07-07 15:31:28', '2014-01-02 15:50:05'),
(2, 0, 'juan', 'esteban', 'alvareza', 'nalvarez@esu.com.co', 12, 'Activo', '8606cb9d08fd4ac93f9c1af5ec3a4257415addcc', 'guest', 3, '2013-07-07 15:38:39', '2014-01-14 19:04:09'),
(3, 0, 'tomas', 'alvarez', 'herrera', '', 9, 'Inactivo', '1f697a6c777c97f19364fac0c3ab1bc0ec102389', 'author', 0, '2013-07-18 14:41:49', '2014-01-02 15:52:26'),
(4, 0, 'nilton', 'nilton', '', '', 9, 'Activo', '1f697a6c777c97f19364fac0c3ab1bc0ec102389', 'admin', 0, '2013-08-23 11:59:39', '2014-01-02 15:13:54'),
(8, 0, 'nalvarez', 'niltiÃ±o', 'alvar', 'asa', 8, 'Activo', 'aaa0666a159ccfdab94a71df24df0daa453d4fbc', 'author', 1, '2013-12-23 20:31:59', '2014-01-02 22:26:11');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
