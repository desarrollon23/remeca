-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2021 a las 19:36:37
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `remeca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcionmaterial`
--

CREATE TABLE `recepcionmaterial` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cedula` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idlugar` int(11) DEFAULT NULL,
  `pesofull` double(12,2) DEFAULT NULL,
  `pesovacio` double(12,2) DEFAULT NULL,
  `pesoneto` double(12,2) DEFAULT NULL,
  `pesocalculado` double(12,2) DEFAULT NULL,
  `observaciones` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recibido` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facturado` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `recepcionmaterial`
--
ALTER TABLE `recepcionmaterial`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `recepcionmaterial`
--
ALTER TABLE `recepcionmaterial`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
