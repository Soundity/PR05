-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-03-2016 a las 13:02:07
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_soundity`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_genere`
--

CREATE TABLE `tbl_genere` (
  `gen_id` int(11) NOT NULL,
  `gen_nom` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_genere`
--

INSERT INTO `tbl_genere` (`gen_id`, `gen_nom`) VALUES
(1, 'Electronica'),
(2, 'Funk'),
(3, 'Hip Hop'),
(4, 'House'),
(5, 'Indie'),
(6, 'Jazz'),
(7, 'Pop'),
(8, 'Rap'),
(9, 'Reggae'),
(10, 'RnB'),
(11, 'Rock'),
(12, 'Soul'),
(13, 'EDM'),
(14, 'Ambient'),
(15, 'Classic');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_genere_usuari`
--

CREATE TABLE `tbl_genere_usuari` (
  `gus_id` int(11) NOT NULL,
  `usu_id` int(11) DEFAULT NULL,
  `gen_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_genere_usuari`
--

INSERT INTO `tbl_genere_usuari` (`gus_id`, `usu_id`, `gen_id`) VALUES
(2, 2, 1),
(4, 4, 2),
(5, 5, 3),
(6, 6, 3),
(7, 7, 3),
(8, 8, 4),
(9, 8, 4),
(10, 9, 4),
(11, 9, 4),
(12, 10, 5),
(13, 11, 5),
(14, 12, 6),
(15, 13, 6),
(16, 14, 7),
(17, 14, 7),
(18, 15, 7),
(19, 15, 7),
(20, 16, 8),
(21, 17, 8),
(22, 18, 9),
(23, 19, 9),
(24, 20, 10),
(25, 21, 10),
(26, 22, 11),
(27, 23, 11),
(28, 24, 11),
(29, 25, 12),
(30, 26, 12),
(31, 27, 13),
(32, 28, 13),
(33, 29, 14),
(34, 30, 14),
(35, 31, 15),
(36, 32, 15),
(37, 39, 1),
(48, 37, 1),
(49, 37, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_llistes`
--

CREATE TABLE `tbl_llistes` (
  `lli_id` int(11) NOT NULL,
  `lli_nom` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `usu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_llistes`
--

INSERT INTO `tbl_llistes` (`lli_id`, `lli_nom`, `usu_id`) VALUES
(1, 'Llista 1', 37),
(2, 'Llista 2', 37);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_llistes_musica`
--

CREATE TABLE `tbl_llistes_musica` (
  `lmu_id` int(11) NOT NULL,
  `lli_id` int(11) DEFAULT NULL,
  `mus_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_llistes_musica`
--

INSERT INTO `tbl_llistes_musica` (`lmu_id`, `lli_id`, `mus_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 2, 10),
(7, 2, 11),
(8, 2, 12),
(9, 2, 13),
(10, 2, 14),
(11, 2, 1),
(12, 1, 1),
(13, 2, 1),
(14, 1, 1),
(15, 1, 32),
(16, 1, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_musica`
--

CREATE TABLE `tbl_musica` (
  `mus_id` int(11) NOT NULL,
  `mus_nom` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `mus_titol` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `usu_comptador` int(11) DEFAULT NULL,
  `usu_id` int(11) DEFAULT NULL,
  `gen_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_musica`
--

INSERT INTO `tbl_musica` (`mus_id`, `mus_nom`, `mus_titol`, `usu_comptador`, `usu_id`, `gen_id`) VALUES
(1, 'feelinggood', 'Feeling Good', NULL, 1, 1),
(2, 'heybaby', 'Hey Baby', NULL, 2, 1),
(3, 'lifehappens', 'Life Happens', NULL, 3, 2),
(4, 'urlove', 'Ur Love', NULL, 4, 2),
(5, 'californialove', 'California Love', NULL, 5, 3),
(6, 'viviendo', 'Viviendo', NULL, 6, 3),
(7, 'dragonballrap', 'Dragon Ball Rap', NULL, 7, 3),
(8, 'iwantyoutoknow', 'I Want You to Know', NULL, 8, 4),
(9, 'findyou', 'Find You', NULL, 8, 4),
(10, 'dontyouworrychild', 'Don''t You Worry Child', NULL, 9, 4),
(11, 'savetheworld', 'Save The World', NULL, 9, 4),
(12, 'youvegotthelove', 'You''ve Got the Love', NULL, 10, 5),
(13, 'adios', 'Adiós', NULL, 11, 5),
(14, 'dontgonofurther', 'Don''t Go No Further', NULL, 12, 6),
(15, 'dancemetotheendoflove', 'Dance Me to The End Of Love', NULL, 13, 6),
(16, 'perfume', 'Perfume', NULL, 14, 1),
(17, 'womanizer', 'Womanizer', NULL, 14, 7),
(18, 'discosally', 'Disco Sally', NULL, 15, 7),
(19, 'absolutamente', 'Absolutamente', NULL, 15, 7),
(20, 'todoloqueimporta', 'Todo Lo Que Importa', NULL, 16, 8),
(21, 'afuego', 'A Fuego', NULL, 17, 8),
(22, 'herbalist', 'Herbalist', NULL, 18, 9),
(23, 'vibrapositiva', 'Vibra Positiva', NULL, 19, 9),
(24, 'tooclose', 'Too Close', NULL, 20, 1),
(25, 'goodforyou', 'Good For You', NULL, 21, 10),
(26, 'sitevas', 'Si Te Vas', NULL, 22, 11),
(27, 'irresistible', 'Irresistible', NULL, 23, 11),
(28, 'molinosdeviento', 'Molinos De Viento', NULL, 24, 11),
(29, 'backtoblack', 'Back To Black', NULL, 25, 12),
(30, 'rollinginthedeep', 'Rolling In The Deep', NULL, 26, 12),
(31, 'howdeepisyoulove', 'How Deep Is Your Love', NULL, 27, 13),
(32, 'getlucky', 'Get Lucky', NULL, 28, 13),
(33, 'creep', 'Creep', NULL, 29, 14),
(34, 'behindthewallofsleep', 'Behind The Wall Of Sleep', NULL, 30, 14),
(35, 'chopin', 'Chopin', NULL, 31, 15),
(36, 'moonlightsonata', 'Moonlight Sonata', NULL, 32, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_subscripcions`
--

CREATE TABLE `tbl_subscripcions` (
  `sub_id` int(11) NOT NULL,
  `usu_idorigen` int(11) DEFAULT NULL,
  `usu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_subscripcions`
--

INSERT INTO `tbl_subscripcions` (`sub_id`, `usu_idorigen`, `usu_id`) VALUES
(10, 1, 37),
(12, 2, 37);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuari`
--

CREATE TABLE `tbl_usuari` (
  `usu_id` int(11) NOT NULL,
  `usu_mail` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `usu_contra` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `usu_nom` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `usu_avatar` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `usu_descripcio` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `usu_rang` tinyint(1) DEFAULT NULL,
  `usu_idioma` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_usuari`
--

INSERT INTO `tbl_usuari` (`usu_id`, `usu_mail`, `usu_contra`, `usu_nom`, `usu_avatar`, `usu_descripcio`, `usu_rang`, `usu_idioma`) VALUES
(1, 'avicii_89@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Avicii', 'avicii.jpg', 'DJ y productor musical sueco.', 0, 'Inglés'),
(2, 'deadmau5@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Deadmau5', 'deadmau5.jpg', 'Productor musical canadiense de música electrónica', 0, 'Inglés'),
(3, 'ester_rada@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Ester Rada', 'ester.jpg', 'Cantante y productora de Funk, Soul y Jazz', 0, 'Inglés'),
(4, 'karl_denson_tu@yahoo.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Karl Denson’s Tiny Universe', 'karl.jpg', 'Grupo de Funk-Frenético y Jazz', 0, 'Inglés'),
(5, 'tupac_shakur@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Tupac Shakur', 'tupac.jpg', 'Rapero de Estados Unidos.', 0, 'Inglés'),
(6, 'nach.rap@yahoo.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Nach', 'nach.jpg', 'Productor, rapero y MC español (Valencia).', 0, 'Español'),
(7, 'porta88@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Porta', 'porta.jpg', 'Rapero interprete de música en español.', 0, 'Español'),
(8, 'zedd_ddez@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Zedd', 'zedd.jpg', 'Músico, disc jockey y productor ruso-alemán, orientado al electro house', 0, 'Inglés'),
(9, 'shw05@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Swedish House Mafia', 'shw.jpg', 'Grupo de músicos, DJ''s y productores musicales suecos.', 0, 'Inglés'),
(10, 'florence_welch@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Florence Welch', 'florence.jpg', 'Cantante y compositora de Indie Británico.', 0, 'Inglés'),
(11, 'full_sevilla@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Full', '', 'Grupo Indie-Pop provinitentes de Sevilla', 0, 'Español'),
(12, 'ster_wax@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Ster Wax', 'ster.jpg', 'Banda de Jazz&Bles de Barcelona.', 0, 'Inglés'),
(13, 'madeleine_Pe@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Madeleine Peyroux', 'madeleine.jpg', 'Cantante, guitarrista y compositora estadounidense de Jazz.', 0, 'Inglés'),
(14, 'bs_81@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Britney Spears', 'brit.jpg', 'Cantante, bailarina y compositora Estadounidense', 0, 'Inglés'),
(15, 'fagoria_91@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Fangoria', 'fangoria.jpg', 'Grupo de pop electrónico Español.', 0, 'Español'),
(16, 'zatu_esp@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Zatu', 'zatu.jpg', 'Rapero español', 0, 'Español'),
(17, 'rapsusklei@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Rapsusklei', 'rapsuklei.jpg', 'Rapero español', 0, 'Español'),
(18, 'alborosie_77@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Alborosie', 'alborosie.jpg', 'Cantante Italiano de Reggae', 0, 'Inglés'),
(19, 'zona_ganjah@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Zona Ganjah', 'ganjah.jpg', 'Agrupación musical chilena de reggea', 0, 'Español'),
(20, 'next@yahoo.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Next', 'next.jpg', 'Banda de R&B proviniente de Minnesota, USA', 0, 'Inglés'),
(21, 'selena_gomez@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Selena Gomez', 'selena.jpg', 'Cantante de R&B y pop', 0, 'Inglés'),
(22, 'extremoduro@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Extremoduro', 'extremoduro.jpg', 'Grupo de música rock fundado en Plasencia, Extremadura (España)', 0, 'Español'),
(23, 'fall_out_boy@gmai.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Fall Out Boy ', 'fall.jpg', 'Formación de rock alternativo formado en Chicago (USA)', 0, 'Inglés'),
(24, 'mago_deoz@yahoo.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Mago de Oz', 'mago.jpg', 'Grupo de Heavy Metal/Rock español.', 0, 'Español'),
(25, 'amy_winehouse@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Amy Winehouse', 'amy.jpg', 'Cantante y compositora de R&B y Soul', 0, 'Inglés'),
(26, 'adele@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Adele', 'adele.jpg', 'Cantante y compositora Pop y Soul', 0, 'Inglés'),
(27, 'calvin_harris@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Calvin Harris', 'calvin.jpg', 'Músico y productor escocés de Electronic Dance Music.', 0, 'Inglés'),
(28, 'daft.punk@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Daft Punk', 'daft.jpg', 'Grupo de músicos franceses de Musica Dance electronica', 0, 'Inglés'),
(29, 'radiohead@yahoo.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Radiohead', 'radio.jpg', 'Grupo británico de música ambient, rock y rock alternativo', 0, 'Inglés'),
(30, 'oophoi@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Oöphoi', 'oophoi.jpg', 'Músico y compositor italiano de música Ambient.', 0, 'Inglés'),
(31, 'martha_argerich@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Martha Argerich', 'martha.jpg', 'Compositora y pianista Argentina', 0, 'Español'),
(32, 'daniel_barenboim@yahoo.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Daniel Barenboim', 'barenboim.jpg', 'Músico y compositor argentino', 0, 'Español'),
(33, 'carlos_sachez@fje.edu', '81dc9bdb52d04dc20036dbd8313ed055', 'Carlos Sanchez', 'carlos.jpg', 'Administrador', 1, 'Español'),
(34, 'sergio_ayala@fje.edu', '81dc9bdb52d04dc20036dbd8313ed055', 'Sergio Ayala', 'sergio.jpg', 'Administrador', 1, 'Español'),
(35, 'aitor_blesa@fje.edu', '81dc9bdb52d04dc20036dbd8313ed055', 'Aitor Blesa', 'aitor.jpg', 'Administrador', 1, 'Español'),
(36, 'victor_cruz@fje.edu', '81dc9bdb52d04dc20036dbd8313ed055', 'Víctor Cruz', 'victor.jpg', 'Administrador', 1, 'Español'),
(37, 'enric_gorriz@fje.edu', '81dc9bdb52d04dc20036dbd8313ed055', 'Enric Górriz', '37_logo.jpg', 'Administrador', 1, 'Català'),
(38, 'xavier_granell@fje.edu', '81dc9bdb52d04dc20036dbd8313ed055', 'Xavier Granell', 'xavi.jpg', 'Administrador', 1, 'Español'),
(39, 'pepin@java.com', '81dc9bdb52d04dc20036dbd8313ed055', 'pepin', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_valoracio`
--

CREATE TABLE `tbl_valoracio` (
  `val_id` int(11) NOT NULL,
  `val_puntuacio` int(3) DEFAULT NULL,
  `mus_id` int(11) DEFAULT NULL,
  `usu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_valoracio`
--

INSERT INTO `tbl_valoracio` (`val_id`, `val_puntuacio`, `mus_id`, `usu_id`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2),
(3, 1, 1, 3),
(4, -1, 2, 4),
(5, -1, 2, 5),
(6, 1, 3, 6),
(7, 1, 3, 7),
(8, 1, 4, 8),
(9, 1, 5, 9),
(10, 1, 4, 10),
(11, 1, 6, 1),
(12, 1, 7, 1),
(13, -1, 1, 18),
(14, 1, 18, 1),
(15, 1, 19, 1),
(20, 1, 1, 37),
(22, 1, 16, 37),
(23, 1, 24, 37),
(24, 1, 4, 37),
(25, 1, 32, 37);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_genere`
--
ALTER TABLE `tbl_genere`
  ADD PRIMARY KEY (`gen_id`);

--
-- Indices de la tabla `tbl_genere_usuari`
--
ALTER TABLE `tbl_genere_usuari`
  ADD PRIMARY KEY (`gus_id`),
  ADD KEY `usu_id` (`usu_id`),
  ADD KEY `gen_id` (`gen_id`);

--
-- Indices de la tabla `tbl_llistes`
--
ALTER TABLE `tbl_llistes`
  ADD PRIMARY KEY (`lli_id`),
  ADD KEY `usu_id` (`usu_id`);

--
-- Indices de la tabla `tbl_llistes_musica`
--
ALTER TABLE `tbl_llistes_musica`
  ADD PRIMARY KEY (`lmu_id`),
  ADD KEY `mus_id` (`mus_id`),
  ADD KEY `lli_id` (`lli_id`);

--
-- Indices de la tabla `tbl_musica`
--
ALTER TABLE `tbl_musica`
  ADD PRIMARY KEY (`mus_id`),
  ADD KEY `usu_id` (`usu_id`),
  ADD KEY `gen_id` (`gen_id`);

--
-- Indices de la tabla `tbl_subscripcions`
--
ALTER TABLE `tbl_subscripcions`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `usu_id` (`usu_id`),
  ADD KEY `usu_idorigen` (`usu_idorigen`);

--
-- Indices de la tabla `tbl_usuari`
--
ALTER TABLE `tbl_usuari`
  ADD PRIMARY KEY (`usu_id`);

--
-- Indices de la tabla `tbl_valoracio`
--
ALTER TABLE `tbl_valoracio`
  ADD PRIMARY KEY (`val_id`),
  ADD KEY `usu_id` (`usu_id`),
  ADD KEY `mus_id` (`mus_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_genere`
--
ALTER TABLE `tbl_genere`
  MODIFY `gen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `tbl_genere_usuari`
--
ALTER TABLE `tbl_genere_usuari`
  MODIFY `gus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de la tabla `tbl_llistes`
--
ALTER TABLE `tbl_llistes`
  MODIFY `lli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbl_llistes_musica`
--
ALTER TABLE `tbl_llistes_musica`
  MODIFY `lmu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `tbl_musica`
--
ALTER TABLE `tbl_musica`
  MODIFY `mus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `tbl_subscripcions`
--
ALTER TABLE `tbl_subscripcions`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `tbl_usuari`
--
ALTER TABLE `tbl_usuari`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT de la tabla `tbl_valoracio`
--
ALTER TABLE `tbl_valoracio`
  MODIFY `val_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_genere_usuari`
--
ALTER TABLE `tbl_genere_usuari`
  ADD CONSTRAINT `tbl_genere_usuari_ibfk_1` FOREIGN KEY (`usu_id`) REFERENCES `tbl_usuari` (`usu_id`),
  ADD CONSTRAINT `tbl_genere_usuari_ibfk_2` FOREIGN KEY (`gen_id`) REFERENCES `tbl_genere` (`gen_id`);

--
-- Filtros para la tabla `tbl_llistes`
--
ALTER TABLE `tbl_llistes`
  ADD CONSTRAINT `tbl_llistes_ibfk_1` FOREIGN KEY (`usu_id`) REFERENCES `tbl_usuari` (`usu_id`);

--
-- Filtros para la tabla `tbl_llistes_musica`
--
ALTER TABLE `tbl_llistes_musica`
  ADD CONSTRAINT `tbl_llistes_musica_ibfk_1` FOREIGN KEY (`mus_id`) REFERENCES `tbl_musica` (`mus_id`),
  ADD CONSTRAINT `tbl_llistes_musica_ibfk_2` FOREIGN KEY (`lli_id`) REFERENCES `tbl_llistes` (`lli_id`);

--
-- Filtros para la tabla `tbl_musica`
--
ALTER TABLE `tbl_musica`
  ADD CONSTRAINT `tbl_musica_ibfk_1` FOREIGN KEY (`usu_id`) REFERENCES `tbl_usuari` (`usu_id`),
  ADD CONSTRAINT `tbl_musica_ibfk_2` FOREIGN KEY (`gen_id`) REFERENCES `tbl_genere` (`gen_id`);

--
-- Filtros para la tabla `tbl_subscripcions`
--
ALTER TABLE `tbl_subscripcions`
  ADD CONSTRAINT `tbl_subscripcions_ibfk_1` FOREIGN KEY (`usu_id`) REFERENCES `tbl_usuari` (`usu_id`),
  ADD CONSTRAINT `tbl_subscripcions_ibfk_2` FOREIGN KEY (`usu_idorigen`) REFERENCES `tbl_usuari` (`usu_id`);

--
-- Filtros para la tabla `tbl_valoracio`
--
ALTER TABLE `tbl_valoracio`
  ADD CONSTRAINT `tbl_valoracio_ibfk_1` FOREIGN KEY (`usu_id`) REFERENCES `tbl_usuari` (`usu_id`),
  ADD CONSTRAINT `tbl_valoracio_ibfk_2` FOREIGN KEY (`mus_id`) REFERENCES `tbl_musica` (`mus_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
