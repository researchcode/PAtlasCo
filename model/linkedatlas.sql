-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2022 a las 02:31:04
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `linkedatlas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `basic_data`
--

CREATE TABLE `basic_data` (
  `id` int(11) NOT NULL,
  `code` text NOT NULL,
  `entity` text NOT NULL,
  `country_name` text NOT NULL,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL,
  `zoom` int(11) NOT NULL,
  `sparql_endpoint` text NOT NULL,
  `lang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `basic_data`
--

INSERT INTO `basic_data` (`id`, `code`, `entity`, `country_name`, `latitude`, `longitude`, `zoom`, `sparql_endpoint`, `lang`) VALUES
(1, 'data1', 'parque', 'Colombia', '4.40', '-72.9301367', 6, 'http://es.dbpedia.org/sparql', 'es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entity_markers`
--

CREATE TABLE `entity_markers` (
  `id` bigint(20) NOT NULL,
  `item_name` text NOT NULL,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entity_markers`
--

INSERT INTO `entity_markers` (`id`, `item_name`, `latitude`, `longitude`) VALUES
(1, 'Macuira', '12.1667', '-71.3333'),
(3, 'El Cocuy', '6.5154361', '-72.1235795576598');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `website_data`
--

CREATE TABLE `website_data` (
  `id` int(11) NOT NULL,
  `code` text NOT NULL,
  `name` text NOT NULL,
  `main_title` text NOT NULL,
  `subtitle` text NOT NULL,
  `use_policy` text NOT NULL,
  `copyright` text NOT NULL,
  `youtube_link` text NOT NULL,
  `facebook_link` text NOT NULL,
  `twitter_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `website_data`
--

INSERT INTO `website_data` (`id`, `code`, `name`, `main_title`, `subtitle`, `use_policy`, `copyright`, `youtube_link`, `facebook_link`, `twitter_link`) VALUES
(1, 'web1', 'LinkedAtlas', 'Linked Data Interactive Atlas using DBpedia', 'Navitage on the map and get information from a location-based entity', 'This data can be used only for academic purposes.', 'LinkedAtlas &copy; Developed by Cecilia Avila, researcher at Fundaci&oacute;n Universitaria Konrad Lorenz. Bogot&aacute;, Colombia, 2022.', 'http://youtube.com', 'http://facebook.com', 'https://twitter.com/ceciavilag');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `basic_data`
--
ALTER TABLE `basic_data`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entity_markers`
--
ALTER TABLE `entity_markers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `website_data`
--
ALTER TABLE `website_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `basic_data`
--
ALTER TABLE `basic_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `entity_markers`
--
ALTER TABLE `entity_markers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `website_data`
--
ALTER TABLE `website_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
