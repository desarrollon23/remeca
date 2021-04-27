-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-04-2021 a las 14:07:50
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
-- Estructura para la vista `vista_rd_ventas`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_rd_ventas`  AS SELECT `ventas`.`fechaventa` AS `fecha`, `ventas`.`cedulav` AS `cedula`, `detalle_ventas`.`idproductov` AS `idproducto`, `detalle_ventas`.`cantidadprov` AS `cantidad`, `detalle_ventas`.`totalprov` AS `total` FROM (`ventas` join `detalle_ventas` on(`ventas`.`id` = `detalle_ventas`.`idventa`)) ;

--
-- VIEW `vista_rd_ventas`
-- Datos: Ninguna
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
