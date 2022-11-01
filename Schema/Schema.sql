SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `keepers` (
  `Id` int(50) NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `userName` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `userType` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `compensation` double NOT NULL,
  `petType` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--

ALTER TABLE `keepers`
  ADD PRIMARY KEY (`Id`);


ALTER TABLE `keepers`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;
