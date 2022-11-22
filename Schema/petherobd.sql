-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2022 a las 03:02:03
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
-- Base de datos: `petherobd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `keeper` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `chats`
--

INSERT INTO `chats` (`id`, `owner`, `keeper`) VALUES
(9, 10, 266);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keepers`
--

CREATE TABLE `keepers` (
  `id` int(11) NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `userName` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `userType` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `compensation` int(50) DEFAULT NULL,
  `petType` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `keepers`
--

INSERT INTO `keepers` (`id`, `mail`, `password`, `userName`, `name`, `surname`, `userType`, `compensation`, `petType`) VALUES
(265, 'melisa.labra@outlook.com', 'Melisa123', 'Melisa', 'Melisa', 'Labra', 'keeper', 3000, 'Small'),
(266, 'jose@hotmail.com', 'Jose1234', 'Jose', 'Jose', 'Sanjurjo', 'keeper', 3500, 'Medium'),
(267, 'sofia@hotmail.com', 'Sofia123', 'Sofia', 'Sofia', 'Guitierrez', 'keeper', 4000, 'Small');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `mail` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `userName` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `userType` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `owners`
--

INSERT INTO `owners` (`id`, `mail`, `password`, `userName`, `name`, `surname`, `userType`) VALUES
(9, 'juanmanuelsanjurjo@hotmail.com', 'Juanma123', 'Juanma', 'Juan Manuel', 'Sanjurujo', 'owner'),
(10, 'mariano@hotmail.com', 'Mariano123', 'Mariano', 'Mariano', 'Fernandez', 'owner');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pet`
--

CREATE TABLE `pet` (
  `id` int(11) NOT NULL,
  `idOwner` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `photo` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `breed` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `size` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `vaxPlanImg` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `video` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `observations` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `petType` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `pet`
--

INSERT INTO `pet` (`id`, `idOwner`, `name`, `photo`, `breed`, `size`, `vaxPlanImg`, `video`, `observations`, `petType`) VALUES
(38, 9, 'Cheems', '9_38.jpg', 'Profe gimnasia', 'Medium', '9_38_vaxplan.jpg', NULL, 'No muerde pero te manda a hacer burpé', 'dog'),
(39, 9, 'Cheems Eastwood', '9_39.jpg', 'cheems', 'Small', '9_39_vaxplan.jpg', NULL, '', 'dog'),
(40, 9, 'Ein', '9_40.jpg', 'Corgi', 'Small', '9_40_vaxplan.jpg', '9_40_video.mkv', '', 'dog'),
(41, 9, 'Grumpy', '9_41.jpg', 'ni idea', 'Small', '9_41_vaxplan.jpg', NULL, '', 'cat'),
(42, 10, '  Tincho', '10_42.jpg', '  Cheems Vigorexico', 'Big', '10_42_vaxplan.jpg', NULL, '', 'dog'),
(43, 10, 'Carlitos', '10_43.jpg', 'Minecraft cheems', 'Small', '10_43_vaxplan.jpg', NULL, '', 'dog'),
(44, 10, 'Ernestito', '10_44.gif', 'Shiba Inu', 'Medium', '10_44_vaxplan.jpg', NULL, 'Para probar img GIF', 'dog');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation`
--

CREATE TABLE `reservation` (
  `reservationNumber` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `keeper` int(11) NOT NULL,
  `compensation` int(50) NOT NULL,
  `dateStart` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `dateEnd` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `pet` int(11) NOT NULL,
  `confirmation` tinyint(1) DEFAULT NULL,
  `payment` varchar(150) COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `reservation`
--

INSERT INTO `reservation` (`reservationNumber`, `owner`, `keeper`, `compensation`, `dateStart`, `dateEnd`, `pet`, `confirmation`, `payment`) VALUES
(251, 10, 265, 0, '2022-12-01', '2022-12-01', 44, NULL, NULL),
(252, 10, 266, 0, '2022-12-10', '2022-12-10', 44, NULL, '10_252_payment.png'),
(260, 10, 265, 0, '2022-12-01', '2022-12-01', 44, NULL, NULL),
(261, 10, 266, 0, '2022-12-20', '2022-12-24', 44, NULL, NULL),
(262, 10, 266, 0, '2022-12-20', '2022-12-24', 44, NULL, NULL),
(263, 9, 267, 0, '2022-12-20', '2022-12-27', 41, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `smpt_credentials`
--

CREATE TABLE `smpt_credentials` (
  `smpt_pass` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `smpt_credentials`
--

INSERT INTO `smpt_credentials` (`smpt_pass`) VALUES
('ghcapcpdlldzwgcx'),
('ghcapcpdlldzwgcx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `texts`
--

CREATE TABLE `texts` (
  `id` int(50) NOT NULL,
  `idChat` int(50) NOT NULL,
  `message` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `sender` int(50) NOT NULL,
  `receiver` int(50) NOT NULL,
  `textDate` datetime(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `texts`
--

INSERT INTO `texts` (`id`, `idChat`, `message`, `sender`, `receiver`, `textDate`) VALUES
(21, 9, 'asdasd', 266, 10, '2022-11-21 22:17:46.0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `timeinterval`
--

CREATE TABLE `timeinterval` (
  `id` int(11) NOT NULL,
  `start` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `end` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `idKeeper` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `timeinterval`
--

INSERT INTO `timeinterval` (`id`, `start`, `end`, `idKeeper`) VALUES
(101, '2022-11-25', '2022-11-30', 265),
(102, '2022-12-01', '2022-12-10', 265),
(103, '2022-12-12', '2022-12-22', 265),
(104, '2022-12-05', '2022-12-10', 265),
(105, '2022-12-20', '2022-12-24', 265),
(106, '2022-12-15', '2022-12-25', 265),
(107, '2022-11-25', '2022-11-30', 266),
(108, '2022-12-01', '2022-12-05', 266),
(109, '2022-12-01', '2022-12-10', 266),
(110, '2022-12-10', '2022-12-15', 266),
(111, '2022-12-15', '2022-12-25', 266),
(112, '2022-11-25', '2022-11-30', 267),
(113, '2022-11-25', '2022-12-05', 267),
(114, '2022-12-01', '2022-12-05', 267),
(115, '2022-12-01', '2022-12-10', 267),
(116, '2022-12-10', '2022-12-15', 267),
(117, '2022-12-15', '2022-12-20', 267),
(118, '2022-12-15', '2022-12-25', 267),
(119, '2022-12-20', '2022-12-30', 267);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_owner` (`owner`),
  ADD KEY `fk_id_keeper` (`keeper`);

--
-- Indices de la tabla `keepers`
--
ALTER TABLE `keepers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idOwner` (`idOwner`);

--
-- Indices de la tabla `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservationNumber`),
  ADD KEY `fk_idKeeper` (`keeper`),
  ADD KEY `fk_idPet` (`pet`),
  ADD KEY `fk:idOwner` (`owner`);

--
-- Indices de la tabla `texts`
--
ALTER TABLE `texts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_chat` (`idChat`);

--
-- Indices de la tabla `timeinterval`
--
ALTER TABLE `timeinterval`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idKeeperDate` (`idKeeper`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `keepers`
--
ALTER TABLE `keepers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT de la tabla `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pet`
--
ALTER TABLE `pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservationNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT de la tabla `texts`
--
ALTER TABLE `texts`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `timeinterval`
--
ALTER TABLE `timeinterval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `fk_id_keeper` FOREIGN KEY (`keeper`) REFERENCES `keepers` (`id`),
  ADD CONSTRAINT `fk_id_owner` FOREIGN KEY (`owner`) REFERENCES `owners` (`id`);

--
-- Filtros para la tabla `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `fk_idOwner` FOREIGN KEY (`idOwner`) REFERENCES `owners` (`id`);

--
-- Filtros para la tabla `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk:idOwner` FOREIGN KEY (`owner`) REFERENCES `owners` (`id`),
  ADD CONSTRAINT `fk_idKeeper` FOREIGN KEY (`keeper`) REFERENCES `keepers` (`id`),
  ADD CONSTRAINT `fk_idPet` FOREIGN KEY (`pet`) REFERENCES `pet` (`id`);

--
-- Filtros para la tabla `texts`
--
ALTER TABLE `texts`
  ADD CONSTRAINT `fk_id_chat` FOREIGN KEY (`idChat`) REFERENCES `chats` (`id`);

--
-- Filtros para la tabla `timeinterval`
--
ALTER TABLE `timeinterval`
  ADD CONSTRAINT `fk_idKeeperDate` FOREIGN KEY (`idKeeper`) REFERENCES `keepers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
