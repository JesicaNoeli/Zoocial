-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-08-2019 a las 23:17:44
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `zoocial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `mail_us` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

CREATE TABLE IF NOT EXISTS `amigos` (
`id_amistad` int(50) NOT NULL,
  `mail_us` varchar(50) NOT NULL,
  `mail_amigo` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `amigos`
--

INSERT INTO `amigos` (`id_amistad`, `mail_us`, `mail_amigo`) VALUES
(7, 'gmail@gmail.com', 'jesicanoeli87@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
`id_comentario` int(50) NOT NULL,
  `id_post` int(50) NOT NULL,
  `mail_comenta` varchar(50) NOT NULL,
  `comentario` varchar(200) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moderador`
--

CREATE TABLE IF NOT EXISTS `moderador` (
  `mail_us` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE IF NOT EXISTS `notificaciones` (
`id_noti` int(50) NOT NULL,
  `mail_us` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_post` int(50) NOT NULL,
  `mail_amigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `leido` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE IF NOT EXISTS `post` (
`id_post` int(10) NOT NULL,
  `mail_postea` varchar(50) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fecha` date NOT NULL,
  `tag1` varchar(50) NOT NULL,
  `tag2` varchar(50) NOT NULL,
  `tag3` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id_post`, `mail_postea`, `titulo`, `foto`, `descripcion`, `fecha`, `tag1`, `tag2`, `tag3`) VALUES
(32, 'gmail@gmail.com', 'Frio', 'Frio.jpeg', 'hoy es jueves', '2006-11-01', 'piedra', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reacciones`
--

CREATE TABLE IF NOT EXISTS `reacciones` (
`id_reaccion` int(50) NOT NULL,
  `mail_reacciona` varchar(50) NOT NULL,
  `id_post` int(50) NOT NULL,
  `reaccion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_ami`
--

CREATE TABLE IF NOT EXISTS `solicitud_ami` (
  `mail_us` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `mail_envia` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id` int(50) NOT NULL,
  `mail_us` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fec_nac` date NOT NULL,
  `sexo` varchar(50) NOT NULL,
  `fecha_alta` date NOT NULL,
  `img_perfil` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `mail_us`, `username`, `password`, `nombre`, `apellido`, `fec_nac`, `sexo`, `fecha_alta`, `img_perfil`) VALUES
(20, 'gmail@gmail.com', 'gfarias', '25d55ad283aa400af464c76d713c07ad', 'Gabriel', 'Farias', '1973-09-24', 'Hombre', '2006-11-01', 'gfarias.jpeg'),
(21, 'pp@gmail.com', 'pepe', '25d55ad283aa400af464c76d713c07ad', 'pepito', 'argento', '1987-09-07', 'Hombre', '2006-11-01', 'default_img.jpg'),
(22, 'jesicanoeli87@gmail.com', 'jesiA', '25d55ad283aa400af464c76d713c07ad', 'Jesica', 'Alegre', '1987-02-28', 'Mujer', '2006-11-01', 'default_img.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`mail_us`);

--
-- Indices de la tabla `amigos`
--
ALTER TABLE `amigos`
 ADD PRIMARY KEY (`id_amistad`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
 ADD PRIMARY KEY (`id_comentario`,`id_post`) USING BTREE;

--
-- Indices de la tabla `moderador`
--
ALTER TABLE `moderador`
 ADD PRIMARY KEY (`mail_us`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
 ADD PRIMARY KEY (`id_noti`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
 ADD PRIMARY KEY (`id_post`);

--
-- Indices de la tabla `reacciones`
--
ALTER TABLE `reacciones`
 ADD PRIMARY KEY (`id_reaccion`);

--
-- Indices de la tabla `solicitud_ami`
--
ALTER TABLE `solicitud_ami`
 ADD PRIMARY KEY (`mail_us`,`mail_envia`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amigos`
--
ALTER TABLE `amigos`
MODIFY `id_amistad` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
MODIFY `id_comentario` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
MODIFY `id_noti` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
MODIFY `id_post` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `reacciones`
--
ALTER TABLE `reacciones`
MODIFY `id_reaccion` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
