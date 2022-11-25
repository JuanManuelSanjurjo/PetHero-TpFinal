-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2022 a las 02:51:26
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
(9, 10, 266),
(12, 10, 268),
(13, 9, 266),
(14, 9, 265);

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
(267, 'sofia@hotmail.com', 'Sofia123', 'Sofia', 'Sofia', 'Guitierrez', 'keeper', 4000, 'Small'),
(268, 'juanmanuelsanjurjo@gmail.com', 'Juanma123', 'JuanmaKeeper', 'Juan Manuel', 'Keeper', 'keeper', 2600, 'Big');

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
(10, 'fernandezmariano12@gmail.com', 'Mariano123', 'Mariano', 'Mariano', 'Fernandez', 'owner');

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
(44, 10, ' Ernestito', '10_44.gif', ' Shiba Inu', 'Big', '10_44_vaxplan.jpg', NULL, '', 'dog'),
(45, 9, 'Cheems', '9_45.jpg', 'Cheems profe', 'Medium', '9_45_vaxplan.jpg', '9_45_video.mkv', 'No te muerde pero te manda a hacer burpes', 'dog'),
(46, 9, 'Cheems Eastwood', '9_46.jpg', 'Shiba Inu', 'Big', '9_46_vaxplan.jpg', NULL, '', 'dog'),
(47, 9, 'Chad', '9_47.jpg', 'ChadCheems', 'Big', '9_47_vaxplan.jpg', NULL, '', 'dog'),
(48, 9, ' Sad Cheems', '9_48.jpg', ' Shiba Inu', 'Small', '9_48_vaxplan.jpg', NULL, '', 'dog'),
(49, 9, 'grumpy', '9_49.jpg', 'Siemese', 'Small', '9_49_vaxplan.jpg', NULL, '', 'cat'),
(50, 9, 'Ein', '9_50.jpg', 'Corgi', 'Small', '9_50_vaxplan.jpg', '9_50_video.mkv', '', 'dog'),
(51, 10, ' Toromaru', '10_51.jpeg', ' Shiba Inu ', 'Small', '10_51_vaxplan.jpg', NULL, 'maneja una tienda ', 'dog'),
(53, 10, 'Neko', '10_53.jpeg', 'negro', 'Small', '10_53_vaxplan.jpg', NULL, '', 'cat'),
(55, 10, '  Bunshin', '10_55.jpeg', '  Shiba Inu', 'Medium', '10_55_vaxplan.jpg', NULL, 'es un samurai papa', 'dog');

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
(266, 10, 268, 0, '2022-12-01', '2022-12-07', 44, 1, NULL),
(267, 10, 266, 0, '2022-12-16', '2022-12-18', 55, NULL, NULL),
(268, 9, 266, 0, '2022-12-28', '2022-12-30', 45, NULL, NULL),
(269, 9, 265, 0, '2022-12-21', '2022-12-23', 49, NULL, NULL);

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
(22, 12, 'Hola como estas, queria saber un poco del lugar donde los cuidas, muchas gracias!', 10, 268, '2022-11-24 22:38:17.0'),
(23, 12, 'Hola, como va? es un lugar grande con patio, asi que si quiere estar al aire libre puede tranquilamente. Alguna otra duda?', 268, 10, '2022-11-24 22:42:28.0'),
(24, 12, 'Genial, muchas gracias, nos vemos el dia de la reserva!', 10, 268, '2022-11-24 22:42:56.0'),
(25, 13, 'Hola, buen dia, necesitaria saber si te gusta hacer burpes?, gracias.', 9, 266, '2022-11-24 22:47:42.0');

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
(101, '2022-12-01', '2022-12-10', 265),
(102, '2022-12-01', '2022-12-10', 266),
(103, '2022-12-01', '2022-12-10', 267),
(104, '2022-12-01', '2022-12-10', 268),
(105, '2022-12-11', '2022-12-15', 265),
(106, '2022-12-11', '2022-12-15', 266),
(107, '2022-12-11', '2022-12-15', 267),
(108, '2022-12-11', '2022-12-15', 268),
(109, '2022-12-16', '2022-12-20', 265),
(110, '2022-12-16', '2022-12-20', 266),
(111, '2022-12-16', '2022-12-20', 267),
(112, '2022-11-16', '2022-12-20', 268),
(113, '2022-12-21', '2022-12-25', 265),
(114, '2022-12-21', '2022-12-25', 266),
(115, '2022-12-21', '2022-12-25', 267),
(116, '2022-12-21', '2022-12-25', 268),
(118, '2022-12-26', '2022-12-31', 265),
(119, '2022-12-26', '2022-12-31', 266),
(120, '2022-12-26', '2022-12-31', 267),
(121, '2022-12-26', '2022-12-31', 268),
(122, '2023-01-01', '2023-01-10', 265),
(123, '2023-01-01', '2023-01-10', 266),
(124, '2023-01-01', '2023-01-10', 267),
(125, '2023-01-01', '2023-01-10', 268),
(126, '2023-01-11', '2023-01-15', 267),
(127, '2023-01-11', '2023-01-15', 267),
(128, '2023-01-11', '2023-01-15', 267),
(129, '2023-01-11', '2023-01-15', 267),
(130, '2023-01-16', '2023-01-25', 267),
(131, '2023-01-16', '2023-01-25', 267),
(132, '2023-01-16', '2023-01-25', 267),
(133, '2023-01-16', '2023-01-25', 267);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `keepers`
--
ALTER TABLE `keepers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT de la tabla `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pet`
--
ALTER TABLE `pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservationNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT de la tabla `texts`
--
ALTER TABLE `texts`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `timeinterval`
--
ALTER TABLE `timeinterval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

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
