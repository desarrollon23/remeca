-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-04-2021 a las 06:20:12
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `remeca`
--
CREATE DATABASE IF NOT EXISTS `remeca` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `remeca`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono_material_negociacion_compras`
--

DROP TABLE IF EXISTS `abono_material_negociacion_compras`;
CREATE TABLE `abono_material_negociacion_compras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `negociacion_id` bigint(20) UNSIGNED NOT NULL,
  `idproducton` bigint(20) UNSIGNED NOT NULL,
  `cantidadpron` double(8,2) NOT NULL,
  `idrecepcion` bigint(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Disparadores `abono_material_negociacion_compras`
--
DROP TRIGGER IF EXISTS `Insert_en_abono_MatNegCom`;
DELIMITER $$
CREATE TRIGGER `Insert_en_abono_MatNegCom` AFTER INSERT ON `abono_material_negociacion_compras` FOR EACH ROW BEGIN
SET @ecpc = (SELECT cpc FROM cuentasmaterial WHERE idproducto = NEW.idproducton);
SET @necpc = @ecpc - NEW.cantidadpron;
UPDATE cuentasmaterial SET cpc = @necpc WHERE idproducto = NEW.idproducton;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono_material_negociacion_ventas`
--

DROP TABLE IF EXISTS `abono_material_negociacion_ventas`;
CREATE TABLE `abono_material_negociacion_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `negociacion_id` bigint(20) UNSIGNED NOT NULL,
  `idproducton` bigint(20) UNSIGNED NOT NULL,
  `cantidadpron` double(8,2) NOT NULL,
  `iddespacho` bigint(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `abono_material_negociacion_ventas`
--

INSERT INTO `abono_material_negociacion_ventas` (`id`, `negociacion_id`, `idproducton`, `cantidadpron`, `iddespacho`, `created_at`, `updated_at`) VALUES
(10, 2, 7, 100.00, 24, '2021-04-16 16:22:32', '2021-04-16 17:03:33'),
(11, 2, 7, 200.00, 24, '2021-04-16 17:00:24', '2021-04-16 17:03:33'),
(12, 1, 4, 50.00, 35, '2021-04-16 17:46:57', '2021-04-18 16:12:51'),
(13, 1, 5, 50.00, 35, '2021-04-16 17:51:47', '2021-04-18 16:12:51'),
(14, 1, 4, 50.00, 35, '2021-04-16 19:13:27', '2021-04-18 16:12:51'),
(15, 4, 2, 1000.00, 36, '2021-04-16 20:03:19', '2021-04-18 17:00:46'),
(16, 1, 5, 8.00, 35, '2021-04-18 16:09:13', '2021-04-18 16:12:51'),
(17, 4, 2, 100.00, 36, '2021-04-18 16:41:34', '2021-04-18 17:00:46');

--
-- Disparadores `abono_material_negociacion_ventas`
--
DROP TRIGGER IF EXISTS `Insert_en_abono_MatNegVen`;
DELIMITER $$
CREATE TRIGGER `Insert_en_abono_MatNegVen` AFTER INSERT ON `abono_material_negociacion_ventas` FOR EACH ROW BEGIN
SET @ecpp = (SELECT cpp FROM cuentasmaterial WHERE idproducto = NEW.idproducton);
SET @necpp = @ecpp - NEW.cantidadpron;
UPDATE cuentasmaterial SET cpp = @necpp WHERE idproducto = NEW.idproducton;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

DROP TABLE IF EXISTS `auditoria`;
CREATE TABLE `auditoria` (
  `id` bigint(20) NOT NULL,
  `fechahora` varchar(20) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `programa` varchar(200) NOT NULL,
  `operacion` varchar(50) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `dispositivo` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id`, `fechahora`, `idusuario`, `usuario`, `nombre`, `programa`, `operacion`, `ip`, `dispositivo`, `created_at`, `updated_at`) VALUES
(17, '17-04-2021 13:30:13', 8, 'almacen@remeca.test', 'Almacen', 'RECEPCION DE MATERIAL #: 16', 'AGREGAR MATERIAL', '192.168.250.3', 'Mozilla/5.0 (Linux; Android 10; GO1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.66 Mobile Safari/537.36', '2021-04-17 17:30:13', '2021-04-17 17:30:13'),
(18, '17-04-2021 13:30:30', 8, 'almacen@remeca.test', 'Almacen', 'RECEPCION DE MATERIAL #: 16', 'ELIMINAR MATERIAL', '192.168.250.3', 'Mozilla/5.0 (Linux; Android 10; GO1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.66 Mobile Safari/537.36', '2021-04-17 17:30:30', '2021-04-17 17:30:30'),
(19, '17-04-2021 13:30:50', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'RECEPCION DE MATERIAL #: 14', 'CANCELAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 17:30:50', '2021-04-17 17:30:50'),
(20, '17-04-2021 13:31:10', 8, 'almacen@remeca.test', 'Almacen', 'RECEPCION DE MATERIAL #: 16', 'AGREGAR MATERIAL', '192.168.250.3', 'Mozilla/5.0 (Linux; Android 10; GO1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.66 Mobile Safari/537.36', '2021-04-17 17:31:10', '2021-04-17 17:31:10'),
(21, '17-04-2021 13:31:14', 8, 'almacen@remeca.test', 'Almacen', 'RECEPCION DE MATERIAL #: 16', 'GUARDAR', '192.168.250.3', 'Mozilla/5.0 (Linux; Android 10; GO1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.66 Mobile Safari/537.36', '2021-04-17 17:31:14', '2021-04-17 17:31:14'),
(22, '17-04-2021 15:31:42', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1071', 'GENERAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 19:31:42', '2021-04-17 19:31:42'),
(23, '17-04-2021 15:41:15', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: ', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 19:41:15', '2021-04-17 19:41:15'),
(24, '17-04-2021 15:41:38', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: ', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 19:41:38', '2021-04-17 19:41:38'),
(25, '17-04-2021 15:42:54', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1071', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 19:42:54', '2021-04-17 19:42:54'),
(26, '17-04-2021 17:11:09', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: ', 'CANCELAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 21:11:09', '2021-04-17 21:11:09'),
(27, '17-04-2021 17:11:50', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1071', 'GENERAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 21:11:50', '2021-04-17 21:11:50'),
(28, '17-04-2021 17:25:43', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: ', 'CANCELAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 21:25:43', '2021-04-17 21:25:43'),
(29, '17-04-2021 17:26:11', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1071', 'GENERAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 21:26:11', '2021-04-17 21:26:11'),
(30, '17-04-2021 17:42:21', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1071', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 21:42:21', '2021-04-17 21:42:21'),
(31, '17-04-2021 17:46:57', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1071', 'ELIMINAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 21:46:57', '2021-04-17 21:46:57'),
(32, '17-04-2021 18:10:20', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: ', 'CANCELAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:10:20', '2021-04-17 22:10:20'),
(33, '17-04-2021 18:11:42', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1071', 'GENERAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:11:42', '2021-04-17 22:11:42'),
(34, '17-04-2021 18:11:45', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1071', 'CANCELAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:11:45', '2021-04-17 22:11:45'),
(35, '17-04-2021 18:13:28', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1071', 'GENERAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:13:28', '2021-04-17 22:13:28'),
(36, '17-04-2021 18:13:44', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1071', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:13:44', '2021-04-17 22:13:44'),
(37, '17-04-2021 18:13:54', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1071', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:13:54', '2021-04-17 22:13:54'),
(38, '17-04-2021 18:13:58', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1071', 'ELIMINAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:13:58', '2021-04-17 22:13:58'),
(39, '17-04-2021 18:22:54', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1071', 'GUARDAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:22:54', '2021-04-17 22:22:54'),
(40, '17-04-2021 18:24:10', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1071', 'GUARDAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:24:10', '2021-04-17 22:24:10'),
(41, '17-04-2021 18:26:09', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1072', 'GENERAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:26:09', '2021-04-17 22:26:09'),
(42, '17-04-2021 18:26:32', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1072', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:26:32', '2021-04-17 22:26:32'),
(43, '17-04-2021 18:44:49', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1072', 'GUARDAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:44:49', '2021-04-17 22:44:49'),
(44, '17-04-2021 18:45:26', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1073', 'GENERAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:45:26', '2021-04-17 22:45:26'),
(45, '17-04-2021 18:46:01', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1073', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:46:01', '2021-04-17 22:46:01'),
(46, '17-04-2021 18:46:30', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1073', 'GUARDAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:46:30', '2021-04-17 22:46:30'),
(47, '17-04-2021 18:53:04', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:53:04', '2021-04-17 22:53:04'),
(48, '17-04-2021 18:53:07', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:53:07', '2021-04-17 22:53:07'),
(49, '17-04-2021 18:53:10', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:53:10', '2021-04-17 22:53:10'),
(50, '17-04-2021 18:53:13', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 22:53:13', '2021-04-17 22:53:13'),
(51, '17-04-2021 19:14:29', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 23:14:29', '2021-04-17 23:14:29'),
(52, '17-04-2021 19:14:56', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 23:14:56', '2021-04-17 23:14:56'),
(53, '17-04-2021 19:17:57', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 23:17:57', '2021-04-17 23:17:57'),
(54, '17-04-2021 19:18:14', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 23:18:14', '2021-04-17 23:18:14'),
(55, '17-04-2021 19:47:33', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 23:47:33', '2021-04-17 23:47:33'),
(56, '17-04-2021 19:48:05', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 23:48:05', '2021-04-17 23:48:05'),
(57, '17-04-2021 19:53:17', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 23:53:17', '2021-04-17 23:53:17'),
(58, '17-04-2021 19:53:34', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-17 23:53:34', '2021-04-17 23:53:34'),
(59, '17-04-2021 20:54:04', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 00:54:04', '2021-04-18 00:54:04'),
(60, '17-04-2021 20:54:40', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 00:54:40', '2021-04-18 00:54:40'),
(61, '17-04-2021 21:08:38', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 01:08:38', '2021-04-18 01:08:38'),
(62, '17-04-2021 21:09:10', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 01:09:10', '2021-04-18 01:09:10'),
(63, '18-04-2021 00:43:56', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 04:43:56', '2021-04-18 04:43:56'),
(64, '18-04-2021 00:43:59', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 04:43:59', '2021-04-18 04:43:59'),
(65, '18-04-2021 00:48:30', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA - ABONO #: 9', 'ABONO DE MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 04:48:30', '2021-04-18 04:48:30'),
(66, '18-04-2021 00:49:16', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 04:49:16', '2021-04-18 04:49:16'),
(67, '18-04-2021 00:49:23', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 04:49:23', '2021-04-18 04:49:23'),
(68, '18-04-2021 00:49:30', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1077', 'GENERAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 04:49:30', '2021-04-18 04:49:30'),
(69, '18-04-2021 00:49:57', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1077', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 04:49:57', '2021-04-18 04:49:57'),
(70, '18-04-2021 00:55:36', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1077', 'ELIMINAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 04:55:36', '2021-04-18 04:55:36'),
(71, '18-04-2021 00:55:40', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1077', 'CANCELAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 04:55:40', '2021-04-18 04:55:40'),
(72, '18-04-2021 00:56:07', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 04:56:07', '2021-04-18 04:56:07'),
(73, '18-04-2021 01:01:15', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 05:01:15', '2021-04-18 05:01:15'),
(74, '18-04-2021 01:01:19', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1077', 'GENERAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 05:01:19', '2021-04-18 05:01:19'),
(75, '18-04-2021 01:03:20', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1077', 'CANCELAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 05:03:20', '2021-04-18 05:03:20'),
(76, '18-04-2021 01:03:23', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 05:03:23', '2021-04-18 05:03:23'),
(77, '18-04-2021 01:14:26', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA - ABONO #: 0', 'ABONO DE MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 05:14:26', '2021-04-18 05:14:26'),
(78, '18-04-2021 01:15:31', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA - ABONO #: 0', 'ABONO DE MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 05:15:31', '2021-04-18 05:15:31'),
(79, '18-04-2021 01:55:03', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 05:55:03', '2021-04-18 05:55:03'),
(80, '18-04-2021 02:04:13', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 06:04:13', '2021-04-18 06:04:13'),
(81, '18-04-2021 02:04:32', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 06:04:32', '2021-04-18 06:04:32'),
(82, '18-04-2021 02:07:40', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 06:07:40', '2021-04-18 06:07:40'),
(83, '18-04-2021 10:02:07', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 14:02:07', '2021-04-18 14:02:07'),
(84, '18-04-2021 10:03:32', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 14:03:32', '2021-04-18 14:03:32'),
(85, '18-04-2021 10:03:42', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 14:03:42', '2021-04-18 14:03:42'),
(86, '18-04-2021 10:07:49', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA - ABONO #: 0', 'ABONO DE MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 14:07:49', '2021-04-18 14:07:49'),
(87, '18-04-2021 10:49:29', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA - ABONO #: 3', 'ABONO DE MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 14:49:29', '2021-04-18 14:49:29'),
(88, '18-04-2021 10:51:52', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA - ABONO #: 3', 'ABONO DE MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 14:51:52', '2021-04-18 14:51:52'),
(89, '18-04-2021 10:52:33', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA - ABONO #: 0', 'ABONO DE MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 14:52:33', '2021-04-18 14:52:33'),
(90, '18-04-2021 10:56:27', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA - NEGOCIACION #: 0', 'ABONO DE MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 14:56:27', '2021-04-18 14:56:27'),
(91, '18-04-2021 11:00:45', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA - NEGOCIACION #: 0', 'ABONO DE MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:00:45', '2021-04-18 15:00:45'),
(92, '18-04-2021 11:02:28', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA - CREDITO #: 1073', 'AMORTIZACION A CREDITO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:02:28', '2021-04-18 15:02:28'),
(93, '18-04-2021 11:06:37', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA - NEGOCIACION #: 3', 'ABONO A CREDITO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:06:37', '2021-04-18 15:06:37'),
(94, '18-04-2021 11:08:23', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:08:23', '2021-04-18 15:08:23'),
(95, '18-04-2021 11:08:28', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:08:28', '2021-04-18 15:08:28'),
(96, '18-04-2021 11:17:23', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:17:23', '2021-04-18 15:17:23'),
(97, '18-04-2021 11:17:28', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:17:28', '2021-04-18 15:17:28'),
(98, '18-04-2021 11:23:40', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:23:40', '2021-04-18 15:23:40'),
(99, '18-04-2021 11:24:04', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:24:04', '2021-04-18 15:24:04'),
(100, '18-04-2021 11:25:49', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:25:49', '2021-04-18 15:25:49'),
(101, '18-04-2021 11:26:20', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:26:20', '2021-04-18 15:26:20'),
(102, '18-04-2021 11:34:28', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:34:28', '2021-04-18 15:34:28'),
(103, '18-04-2021 11:34:30', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:34:30', '2021-04-18 15:34:30'),
(104, '18-04-2021 11:35:28', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:35:28', '2021-04-18 15:35:28'),
(105, '18-04-2021 11:39:25', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:39:25', '2021-04-18 15:39:25'),
(106, '18-04-2021 11:39:34', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1077', 'GENERAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:39:34', '2021-04-18 15:39:34'),
(107, '18-04-2021 11:39:43', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1077', 'CANCELAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:39:43', '2021-04-18 15:39:43'),
(108, '18-04-2021 11:39:47', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:39:47', '2021-04-18 15:39:47'),
(109, '18-04-2021 11:39:53', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:39:53', '2021-04-18 15:39:53'),
(110, '18-04-2021 11:42:51', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1077', 'GENERAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:42:51', '2021-04-18 15:42:51'),
(111, '18-04-2021 11:43:35', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1077', 'CANCELAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:43:35', '2021-04-18 15:43:35'),
(112, '18-04-2021 11:43:41', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:43:41', '2021-04-18 15:43:41'),
(113, '18-04-2021 11:43:51', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:43:51', '2021-04-18 15:43:51'),
(114, '18-04-2021 11:46:05', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:46:05', '2021-04-18 15:46:05'),
(115, '18-04-2021 11:48:53', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:48:53', '2021-04-18 15:48:53'),
(116, '18-04-2021 11:48:58', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:48:58', '2021-04-18 15:48:58'),
(117, '18-04-2021 11:50:30', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:50:30', '2021-04-18 15:50:30'),
(118, '18-04-2021 11:52:17', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:52:17', '2021-04-18 15:52:17'),
(119, '18-04-2021 11:58:56', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:58:56', '2021-04-18 15:58:56'),
(120, '18-04-2021 11:59:00', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 15:59:00', '2021-04-18 15:59:00'),
(121, '18-04-2021 12:07:40', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 16:07:40', '2021-04-18 16:07:40'),
(122, '18-04-2021 12:07:57', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 16:07:57', '2021-04-18 16:07:57'),
(123, '18-04-2021 12:13:12', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 16:13:12', '2021-04-18 16:13:12'),
(124, '18-04-2021 12:13:24', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 16:13:24', '2021-04-18 16:13:24'),
(125, '18-04-2021 12:13:26', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 16:13:26', '2021-04-18 16:13:26'),
(126, '18-04-2021 12:13:39', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 16:13:39', '2021-04-18 16:13:39'),
(127, '18-04-2021 12:15:00', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 16:15:00', '2021-04-18 16:15:00'),
(128, '18-04-2021 12:15:08', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 16:15:08', '2021-04-18 16:15:08'),
(129, '18-04-2021 12:41:34', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTAS - NEGOCIACION #: 4', 'ABONO DE MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 16:41:34', '2021-04-18 16:41:34'),
(130, '18-04-2021 13:00:46', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTAS - NEGOCIACION #: 4', 'ABONAR MATERIAL(ES) Y CREAR ORDEN DE DESPACHO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 17:00:46', '2021-04-18 17:00:46'),
(131, '18-04-2021 13:16:31', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 17:16:31', '2021-04-18 17:16:31'),
(132, '18-04-2021 13:17:12', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-18 17:17:12', '2021-04-18 17:17:12'),
(133, '19-04-2021 15:50:44', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1077', 'GENERAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-19 19:50:44', '2021-04-19 19:50:44'),
(134, '19-04-2021 15:51:22', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1077', 'CANCELAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-19 19:51:22', '2021-04-19 19:51:22'),
(135, '19-04-2021 15:51:26', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1077', 'GENERAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-19 19:51:27', '2021-04-19 19:51:27'),
(136, '19-04-2021 15:51:30', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1077', 'CANCELAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-19 19:51:30', '2021-04-19 19:51:30'),
(137, '19-04-2021 15:51:33', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-19 19:51:33', '2021-04-19 19:51:33'),
(138, '19-04-2021 15:52:34', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-19 19:52:34', '2021-04-19 19:52:34'),
(139, '19-04-2021 15:53:13', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-19 19:53:13', '2021-04-19 19:53:13'),
(140, '19-04-2021 19:29:21', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1077', 'GENERAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-19 23:29:21', '2021-04-19 23:29:21'),
(141, '20-04-2021 18:30:08', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA NEGOCIACIO #: 24', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 22:30:08', '2021-04-20 22:30:08'),
(142, '20-04-2021 18:35:51', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA NEGOCIACIO #: 24', 'ELIMINAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 22:35:51', '2021-04-20 22:35:51'),
(143, '20-04-2021 18:35:55', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA NEGOCIACIO #: 24', 'ELIMINAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 22:35:55', '2021-04-20 22:35:55'),
(144, '20-04-2021 18:35:58', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA NEGOCIACIO #: 24', 'CANCELAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 22:35:58', '2021-04-20 22:35:58'),
(145, '20-04-2021 18:40:23', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 22:40:23', '2021-04-20 22:40:23'),
(146, '20-04-2021 18:46:04', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'ELIMINAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 22:46:04', '2021-04-20 22:46:04'),
(147, '20-04-2021 18:46:07', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'CANCELAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 22:46:07', '2021-04-20 22:46:07'),
(148, '20-04-2021 18:46:12', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 22:46:12', '2021-04-20 22:46:12'),
(149, '20-04-2021 18:46:32', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 22:46:32', '2021-04-20 22:46:32'),
(150, '20-04-2021 18:46:52', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 22:46:52', '2021-04-20 22:46:52'),
(151, '20-04-2021 18:47:04', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 22:47:04', '2021-04-20 22:47:04'),
(152, '20-04-2021 18:47:25', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 22:47:25', '2021-04-20 22:47:25'),
(153, '20-04-2021 18:47:42', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 22:47:42', '2021-04-20 22:47:42'),
(154, '20-04-2021 18:48:11', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 22:48:11', '2021-04-20 22:48:11'),
(155, '20-04-2021 19:43:18', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'ELIMINAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 23:43:18', '2021-04-20 23:43:18'),
(156, '20-04-2021 19:43:22', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'ELIMINAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 23:43:22', '2021-04-20 23:43:22'),
(157, '20-04-2021 19:43:25', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'ELIMINAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 23:43:25', '2021-04-20 23:43:25'),
(158, '20-04-2021 19:43:28', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'ELIMINAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 23:43:28', '2021-04-20 23:43:28'),
(159, '20-04-2021 19:43:31', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'ELIMINAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 23:43:31', '2021-04-20 23:43:31'),
(160, '20-04-2021 19:43:34', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'ELIMINAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 23:43:34', '2021-04-20 23:43:34'),
(161, '20-04-2021 19:43:40', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'CANCELAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 23:43:40', '2021-04-20 23:43:40'),
(162, '20-04-2021 19:46:01', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 23:46:01', '2021-04-20 23:46:01'),
(163, '20-04-2021 19:46:18', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 23:46:18', '2021-04-20 23:46:18'),
(164, '20-04-2021 19:49:36', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'ELIMINAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 23:49:36', '2021-04-20 23:49:36'),
(165, '20-04-2021 19:49:43', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'CANCELAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 23:49:43', '2021-04-20 23:49:43'),
(166, '20-04-2021 19:50:38', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 23:50:38', '2021-04-20 23:50:38'),
(167, '20-04-2021 19:50:56', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 23:50:56', '2021-04-20 23:50:56'),
(168, '20-04-2021 19:53:35', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'ELIMINAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 23:53:35', '2021-04-20 23:53:35'),
(169, '20-04-2021 19:53:39', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'CANCELAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 23:53:39', '2021-04-20 23:53:39'),
(170, '20-04-2021 19:58:51', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 23:58:51', '2021-04-20 23:58:51'),
(171, '20-04-2021 19:59:13', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-20 23:59:13', '2021-04-20 23:59:13'),
(172, '20-04-2021 20:02:07', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'ELIMINAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 00:02:07', '2021-04-21 00:02:07'),
(173, '20-04-2021 20:02:10', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'CANCELAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 00:02:10', '2021-04-21 00:02:10'),
(174, '20-04-2021 20:02:30', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 00:02:30', '2021-04-21 00:02:30'),
(175, '20-04-2021 20:02:46', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 24', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 00:02:46', '2021-04-21 00:02:46'),
(176, '21-04-2021 00:05:14', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 04:05:14', '2021-04-21 04:05:14'),
(177, '21-04-2021 00:13:20', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'CANCELAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 04:13:20', '2021-04-21 04:13:20'),
(178, '21-04-2021 00:13:25', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1079', 'GENERAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 04:13:25', '2021-04-21 04:13:25'),
(179, '21-04-2021 00:14:01', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1079', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 04:14:01', '2021-04-21 04:14:01'),
(180, '21-04-2021 00:14:13', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA #: 1079', 'GUARDAR VENTA', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 04:14:13', '2021-04-21 04:14:13'),
(181, '21-04-2021 00:14:31', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'ABONO', 'GENERAR ABONO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 04:14:31', '2021-04-21 04:14:31'),
(182, '21-04-2021 00:15:31', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'VENTA - CREDITO #: 1079', 'AMORTIZACION A CREDITO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 04:15:31', '2021-04-21 04:15:31'),
(183, '21-04-2021 10:27:23', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 25', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 14:27:23', '2021-04-21 14:27:23'),
(184, '21-04-2021 10:27:29', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 25', 'CANCELAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 14:27:29', '2021-04-21 14:27:29'),
(185, '21-04-2021 12:20:39', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 5', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 16:20:39', '2021-04-21 16:20:39'),
(186, '21-04-2021 12:24:29', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 5', 'CANCELAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 16:24:29', '2021-04-21 16:24:29'),
(187, '21-04-2021 12:27:43', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 5', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 16:27:43', '2021-04-21 16:27:43'),
(188, '21-04-2021 12:30:47', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 6', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 16:30:47', '2021-04-21 16:30:47'),
(189, '21-04-2021 12:31:16', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 7', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 16:31:16', '2021-04-21 16:31:16'),
(190, '21-04-2021 12:32:00', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 8', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 16:32:00', '2021-04-21 16:32:00'),
(191, '21-04-2021 12:36:38', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 9', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 16:36:39', '2021-04-21 16:36:39'),
(192, '21-04-2021 12:42:25', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 10', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 16:42:25', '2021-04-21 16:42:25');
INSERT INTO `auditoria` (`id`, `fechahora`, `idusuario`, `usuario`, `nombre`, `programa`, `operacion`, `ip`, `dispositivo`, `created_at`, `updated_at`) VALUES
(193, '21-04-2021 12:44:09', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 11', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 16:44:09', '2021-04-21 16:44:09'),
(194, '21-04-2021 12:47:34', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 12', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 16:47:34', '2021-04-21 16:47:34'),
(195, '21-04-2021 12:48:37', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 13', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 16:48:37', '2021-04-21 16:48:37'),
(196, '21-04-2021 12:49:28', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 14', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 16:49:28', '2021-04-21 16:49:28'),
(197, '21-04-2021 14:47:32', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'RECEPCION DE MATERIAL #: 17', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 18:47:32', '2021-04-21 18:47:32'),
(198, '21-04-2021 14:47:58', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'RECEPCION DE MATERIAL #: 18', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 18:47:58', '2021-04-21 18:47:58'),
(199, '21-04-2021 14:48:58', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'RECEPCION DE MATERIAL #: 18', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 18:48:58', '2021-04-21 18:48:58'),
(200, '21-04-2021 14:49:04', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'RECEPCION DE MATERIAL #: 18', 'GUARDAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 18:49:04', '2021-04-21 18:49:04'),
(201, '21-04-2021 14:49:21', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 14', 'CANCELAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 18:49:21', '2021-04-21 18:49:21'),
(202, '21-04-2021 14:53:00', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 14', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 18:53:00', '2021-04-21 18:53:00'),
(203, '21-04-2021 14:59:33', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 14', 'CANCELAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 18:59:33', '2021-04-21 18:59:33'),
(204, '21-04-2021 15:00:58', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 14', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 19:00:58', '2021-04-21 19:00:58'),
(205, '21-04-2021 15:02:09', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 14', 'CANCELAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 19:02:09', '2021-04-21 19:02:09'),
(206, '21-04-2021 15:02:21', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 14', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 19:02:21', '2021-04-21 19:02:21'),
(207, '21-04-2021 15:23:17', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 15', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 19:23:17', '2021-04-21 19:23:17'),
(208, '21-04-2021 15:35:17', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 15', 'GUARDAR DE CONTADO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 19:35:17', '2021-04-21 19:35:17'),
(209, '21-04-2021 15:43:17', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 16', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 19:43:17', '2021-04-21 19:43:17'),
(210, '21-04-2021 15:44:01', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 16', 'GUARDAR DE CONTADO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 19:44:01', '2021-04-21 19:44:01'),
(211, '21-04-2021 15:55:39', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 17', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 19:55:39', '2021-04-21 19:55:39'),
(212, '21-04-2021 15:56:19', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 17', 'GUARDAR DE CONTADO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 19:56:19', '2021-04-21 19:56:19'),
(213, '21-04-2021 16:12:23', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'RECEPCION DE MATERIAL #: 19', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 20:12:23', '2021-04-21 20:12:23'),
(214, '21-04-2021 16:13:36', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'RECEPCION DE MATERIAL #: 19', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 20:13:36', '2021-04-21 20:13:36'),
(215, '21-04-2021 16:13:44', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'RECEPCION DE MATERIAL #: 19', 'GUARDAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 20:13:44', '2021-04-21 20:13:44'),
(216, '21-04-2021 16:14:14', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 18', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 20:14:14', '2021-04-21 20:14:14'),
(217, '21-04-2021 16:38:17', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 18', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 20:38:17', '2021-04-21 20:38:17'),
(218, '21-04-2021 16:52:18', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - CREDITO #: 18', 'GUARDAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 20:52:18', '2021-04-21 20:52:18'),
(219, '21-04-2021 17:49:32', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'RECEPCION DE MATERIAL #: 20', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 21:49:32', '2021-04-21 21:49:32'),
(220, '21-04-2021 17:50:12', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'RECEPCION DE MATERIAL #: 20', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 21:50:12', '2021-04-21 21:50:12'),
(221, '21-04-2021 17:50:21', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'RECEPCION DE MATERIAL #: 20', 'GUARDAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 21:50:21', '2021-04-21 21:50:21'),
(222, '21-04-2021 17:50:58', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'RECEPCION DE MATERIAL #: 21', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 21:50:58', '2021-04-21 21:50:58'),
(223, '21-04-2021 17:51:26', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'RECEPCION DE MATERIAL #: 21', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 21:51:26', '2021-04-21 21:51:26'),
(224, '21-04-2021 17:51:32', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'RECEPCION DE MATERIAL #: 21', 'GUARDAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 21:51:32', '2021-04-21 21:51:32'),
(225, '21-04-2021 17:53:10', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA #: 19', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 21:53:10', '2021-04-21 21:53:10'),
(226, '21-04-2021 17:58:58', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - CREDITO #: 19', 'GUARDAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 21:58:58', '2021-04-21 21:58:58'),
(227, '21-04-2021 18:03:58', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 25', 'GENERAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 22:03:58', '2021-04-21 22:03:58'),
(228, '21-04-2021 18:04:58', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 25', 'AGREGAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 22:04:58', '2021-04-21 22:04:58'),
(229, '21-04-2021 18:05:29', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 25', 'ELIMINAR MATERIAL', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 22:05:29', '2021-04-21 22:05:29'),
(230, '21-04-2021 18:05:36', 1, 'julion23@gmail.com', 'Julio H Nuñez A', 'COMPRA - NEGOCIACION #: 25', 'CANCELAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', '2021-04-21 22:05:36', '2021-04-21 22:05:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cedulac` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombrec` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccionc` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefonoc` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correoc` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visiblec` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `cedulac`, `nombrec`, `direccionc`, `telefonoc`, `correoc`, `visiblec`, `created_at`, `updated_at`) VALUES
(1, 'V11111111', 'PEDRO PEREZ', 'MARACAY', '333', 'a@b.com', NULL, '2021-03-25 04:25:59', '2021-03-25 04:25:59'),
(2, 'V22222222', 'CARLOS', 'Animi aut odio et c', '+1 (693) 814-9635', 'wikocoj@mailinator.com', NULL, '2021-03-25 04:26:35', '2021-03-25 13:21:42'),
(3, 'V33333333', 'JUAN', 'Est commodi aut sunt', '+1 (779) 459-5104', 'tavumasujy@mailinator.com', NULL, '2021-03-25 04:27:07', '2021-03-25 13:21:51'),
(4, 'V44444444', 'MARCOS', 'Suscipit quia dignis', '+1 (465) 945-7076', 'qihelac@mailinator.com', NULL, '2021-03-25 04:27:53', '2021-03-25 13:22:02'),
(5, 'V55555555', 'LUIS', 'Corporis ullam qui e', '+1 (381) 847-8426', 'qapecon@mailinator.com', NULL, '2021-03-25 04:28:16', '2021-03-25 13:22:16'),
(6, '123', 'maria ', 'maracay ', '0412-456321', 'akire56@hotmail.com', NULL, '2021-04-16 21:10:55', '2021-04-16 21:10:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentasmaterial`
--

DROP TABLE IF EXISTS `cuentasmaterial`;
CREATE TABLE `cuentasmaterial` (
  `id` bigint(20) NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `disponible` double(102,2) NOT NULL,
  `cpc` double(102,2) NOT NULL,
  `cpp` double(102,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuentasmaterial`
--

INSERT INTO `cuentasmaterial` (`id`, `idproducto`, `disponible`, `cpc`, `cpp`, `created_at`, `updated_at`) VALUES
(1, 1, 0.00, 0.00, 0.00, NULL, NULL),
(2, 2, 0.00, 20.00, 6902.00, NULL, '2021-04-19 19:45:02'),
(3, 3, 0.00, 30.00, 5987.00, NULL, '2021-04-20 18:28:02'),
(4, 4, 0.00, 40.00, 200.00, NULL, '2021-04-15 23:59:57'),
(5, 5, 0.00, 50.00, 344.00, NULL, '2021-04-19 19:45:02'),
(6, 6, 0.00, 60.00, 8.00, NULL, '2021-04-17 23:34:49'),
(7, 7, 0.00, 70.00, 2700.00, NULL, '2021-04-16 14:44:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_por_cobrar_ventas`
--

DROP TABLE IF EXISTS `cuentas_por_cobrar_ventas`;
CREATE TABLE `cuentas_por_cobrar_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idventa` bigint(20) DEFAULT NULL,
  `idnegociacionventa` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cedula` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montototal` double(102,2) DEFAULT NULL,
  `totalefectivo` double(102,2) DEFAULT NULL,
  `totaltransferencia` double(102,2) DEFAULT NULL,
  `totalpagado` double(102,2) DEFAULT NULL,
  `totalresta` double(102,2) DEFAULT NULL,
  `finalizada` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amortizando` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cuentas_por_cobrar_ventas`
--

INSERT INTO `cuentas_por_cobrar_ventas` (`id`, `idventa`, `idnegociacionventa`, `fecha`, `hora`, `cedula`, `montototal`, `totalefectivo`, `totaltransferencia`, `totalpagado`, `totalresta`, `finalizada`, `amortizando`, `created_at`, `updated_at`) VALUES
(6, 0, 1, '15-04-2021', '19:59:57', 'v33333333', 1700.00, 1850.00, 650.00, 2500.00, 0.00, 'NO', 1, NULL, '2021-04-16 03:01:50'),
(7, 1055, 0, '16-04-2021', '09:29:49', 'V55555555', 700.00, 20.00, 40.00, 60.00, 640.00, 'NO', 1, '2021-04-16 13:29:49', '2021-04-16 17:44:17'),
(8, 1056, 0, '16-04-2021', '09:40:55', 'V22222222', 300.00, 0.00, 0.00, 0.00, 300.00, 'NO', 1, '2021-04-16 13:40:55', '2021-04-16 13:40:55'),
(9, 1057, 0, '16-04-2021', '09:44:50', 'V22222222', 250.00, 0.00, 0.00, 0.00, 250.00, 'NO', 1, '2021-04-16 13:44:50', '2021-04-16 13:44:50'),
(10, 1058, 0, '16-04-2021', '09:57:00', 'V11111111', 450.00, 0.00, 0.00, 0.00, 450.00, 'NO', 1, '2021-04-16 13:57:00', '2021-04-16 13:57:00'),
(11, 1059, 0, '16-04-2021', '10:04:05', 'V11111111', 80.00, 5.00, 5.00, 10.00, 70.00, 'NO', 1, '2021-04-16 14:04:05', '2021-04-16 14:04:05'),
(12, 1060, 0, '16-04-2021', '10:16:34', 'v11111111', 100.00, 0.00, 0.00, 0.00, 100.00, 'NO', 1, '2021-04-16 14:16:34', '2021-04-16 14:16:34'),
(13, 1061, 0, '16-04-2021', '10:19:56', 'v55555555', 200.00, 35.00, 45.00, 80.00, 120.00, 'NO', 1, '2021-04-16 14:19:56', '2021-04-16 16:51:45'),
(14, 1062, 2, '16-04-2021', '10:44:45', 'v55555555', 6000.00, 900.00, 1700.00, 2600.00, 3900.00, 'NO', 1, NULL, '2021-04-16 17:42:19'),
(15, 0, 3, '16-04-2021', '15:02:32', 'v33333333', 12000.00, 2000.00, 1500.00, 3500.00, 8500.00, 'NO', 1, NULL, '2021-04-18 15:06:37'),
(16, 1065, 0, '16-04-2021', '15:10:22', 'v33333333', 492.66, 200.00, 292.66, 492.66, 0.00, 'NO', 1, '2021-04-16 19:10:22', '2021-04-16 19:16:28'),
(17, 1067, 4, '16-04-2021', '15:52:47', 'v11111111', 24000.00, 24000.00, 0.00, 24000.00, 0.00, 'NO', 1, NULL, '2021-04-16 20:17:48'),
(18, 1073, 0, '17-04-2021', '18:46:29', 'v33333333', 42.00, 19.00, 15.00, 34.00, 12.00, 'NO', 1, '2021-04-17 22:46:29', '2021-04-18 15:02:28'),
(19, 0, 8, '17-04-2021', '19:29:14', 'V33333333', 777.00, 0.00, 0.00, 0.00, 777.00, 'NO', NULL, NULL, NULL),
(20, 0, 9, '17-04-2021', '19:34:49', 'V33333333', 8.00, 4.00, 0.00, 4.00, 4.00, 'NO', 1, NULL, '2021-04-18 04:48:30'),
(21, 0, 10, '17-04-2021', '19:45:42', 'v33333333', 100.00, 0.00, 0.00, 0.00, 100.00, 'NO', NULL, NULL, NULL),
(22, 0, 12, '20-04-2021', '14:28:02', 'v33333333', 36000.00, 36000.00, 0.00, 36000.00, 0.00, 'NO', NULL, NULL, NULL),
(23, 1079, 0, '21-04-2021', '00:14:12', 'v33333333', 474.00, 74.00, 100.00, 174.00, 300.00, 'NO', 1, '2021-04-21 04:14:12', '2021-04-21 04:15:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_por_pagar_compras`
--

DROP TABLE IF EXISTS `cuentas_por_pagar_compras`;
CREATE TABLE `cuentas_por_pagar_compras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idcompra` bigint(20) DEFAULT NULL,
  `idnegociacioncompra` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cedula` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montototal` double(102,2) DEFAULT NULL,
  `totalefectivo` double(102,2) DEFAULT NULL,
  `totaltransferencia` double(102,2) DEFAULT NULL,
  `totalpagado` double(102,2) DEFAULT NULL,
  `totalresta` double(102,2) DEFAULT NULL,
  `finalizada` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amortizando` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cuentas_por_pagar_compras`
--

INSERT INTO `cuentas_por_pagar_compras` (`id`, `idcompra`, `idnegociacioncompra`, `fecha`, `hora`, `cedula`, `montototal`, `totalefectivo`, `totaltransferencia`, `totalpagado`, `totalresta`, `finalizada`, `amortizando`, `created_at`, `updated_at`) VALUES
(2, 18, NULL, '21-04-2021', '16:52:18', 'V77777777', 34988.80, 500.00, 500.00, 1000.00, 33988.80, 'NO', 1, '2021-04-21 20:52:18', '2021-04-21 20:52:18'),
(3, 19, NULL, '21-04-2021', '17:58:57', 'V77777777', 20880.00, 16000.00, 2000.00, 18000.00, 2880.00, 'NO', 1, '2021-04-21 21:58:57', '2021-04-21 21:58:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho_material`
--

DROP TABLE IF EXISTS `despacho_material`;
CREATE TABLE `despacho_material` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fechaventad` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horaventad` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idlugard` int(11) DEFAULT NULL,
  `idestatusd` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `despacho_material`
--

INSERT INTO `despacho_material` (`id`, `fechaventad`, `horaventad`, `idlugard`, `idestatusd`, `created_at`, `updated_at`) VALUES
(16, '16-04-2021', '09:27:03', NULL, 1, '2021-04-16 13:27:03', '2021-04-16 13:27:03'),
(17, '16-04-2021', '09:29:48', NULL, 1, '2021-04-16 13:29:48', '2021-04-16 13:29:48'),
(18, '16-04-2021', '09:40:55', NULL, 1, '2021-04-16 13:40:55', '2021-04-16 13:40:55'),
(19, '16-04-2021', '09:44:50', NULL, 1, '2021-04-16 13:44:50', '2021-04-16 13:44:50'),
(20, '16-04-2021', '09:56:59', NULL, 1, '2021-04-16 13:56:59', '2021-04-16 13:56:59'),
(21, '16-04-2021', '10:04:05', NULL, 1, '2021-04-16 14:04:05', '2021-04-16 14:04:05'),
(22, '16-04-2021', '10:16:34', NULL, 1, '2021-04-16 14:16:34', '2021-04-16 14:16:34'),
(23, '16-04-2021', '10:19:56', NULL, 1, '2021-04-16 14:19:56', '2021-04-16 14:19:56'),
(24, '16-04-2021', '13:03:33', NULL, 1, '2021-04-16 17:03:33', '2021-04-16 17:03:33'),
(25, '16-04-2021', '13:51:53', NULL, 1, '2021-04-16 17:51:53', '2021-04-16 17:51:53'),
(26, '16-04-2021', '15:07:36', NULL, 1, '2021-04-16 19:07:36', '2021-04-16 19:07:36'),
(27, '16-04-2021', '15:10:21', NULL, 1, '2021-04-16 19:10:21', '2021-04-16 19:10:21'),
(28, '16-04-2021', '15:14:33', NULL, 1, '2021-04-16 19:14:33', '2021-04-16 19:14:33'),
(29, '16-04-2021', '16:03:25', NULL, 2, '2021-04-16 20:03:25', '2021-04-16 20:04:13'),
(30, '17-04-2021', '18:21:34', NULL, 1, '2021-04-17 22:21:34', '2021-04-17 22:21:34'),
(31, '17-04-2021', '18:22:54', NULL, 1, '2021-04-17 22:22:54', '2021-04-17 22:22:54'),
(32, '17-04-2021', '18:24:10', NULL, 1, '2021-04-17 22:24:10', '2021-04-17 22:24:10'),
(33, '17-04-2021', '18:44:49', NULL, 1, '2021-04-17 22:44:49', '2021-04-17 22:44:49'),
(34, '17-04-2021', '18:46:29', NULL, 1, '2021-04-17 22:46:29', '2021-04-17 22:46:29'),
(35, '18-04-2021', '12:12:51', NULL, 1, '2021-04-18 16:12:51', '2021-04-18 16:12:51'),
(36, '18-04-2021', '13:00:45', NULL, 1, '2021-04-18 17:00:45', '2021-04-18 17:00:45'),
(37, '21-04-2021', '00:14:12', NULL, 1, '2021-04-21 04:14:12', '2021-04-21 04:14:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallerecmat`
--

DROP TABLE IF EXISTS `detallerecmat`;
CREATE TABLE `detallerecmat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recepcionmaterial_id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `cantidadprorecmat` decimal(8,2) DEFAULT NULL,
  `operacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detallerecmat`
--

INSERT INTO `detallerecmat` (`id`, `recepcionmaterial_id`, `producto_id`, `cantidadprorecmat`, `operacion`, `created_at`, `updated_at`) VALUES
(89, 1, 3, '100.00', 'SUMA', '2021-04-16 19:26:03', '2021-04-16 19:26:03'),
(90, 1, 4, '50.00', 'SUMA', '2021-04-16 19:26:19', '2021-04-16 19:26:19'),
(91, 2, 7, '3000.00', 'SUMA', '2021-04-16 19:34:58', '2021-04-16 19:34:58'),
(92, 2, 6, '6980.00', 'SUMA', '2021-04-16 19:35:20', '2021-04-16 19:35:20'),
(93, 3, 2, '290.00', 'SUMA', '2021-04-16 19:36:46', '2021-04-16 19:36:46'),
(94, 3, 1, '5.00', 'RESTA', '2021-04-16 19:36:54', '2021-04-16 19:36:54'),
(95, 5, 2, '490.00', 'SUMA', '2021-04-17 01:48:27', '2021-04-17 01:48:27'),
(96, 6, 4, '550.00', 'SUMA', '2021-04-17 01:52:35', '2021-04-17 01:52:35'),
(97, 7, 5, '190.00', 'SUMA', '2021-04-17 01:59:40', '2021-04-17 01:59:40'),
(98, 8, 7, '1970.00', 'SUMA', '2021-04-17 02:04:12', '2021-04-17 02:04:12'),
(99, 9, 7, '395.00', 'SUMA', '2021-04-17 04:07:10', '2021-04-17 04:07:10'),
(100, 10, 2, '3800.00', 'SUMA', '2021-04-17 04:09:37', '2021-04-17 04:09:37'),
(101, 11, 5, '18.00', 'SUMA', '2021-04-17 04:44:14', '2021-04-17 04:44:14'),
(102, 12, 3, '100.00', 'SUMA', '2021-04-17 04:47:31', '2021-04-17 04:47:31'),
(103, 13, 4, '290.00', 'SUMA', '2021-04-17 16:12:28', '2021-04-17 16:12:28'),
(104, 13, 4, '290.00', 'SUMA', '2021-04-17 16:14:12', '2021-04-17 16:14:12'),
(105, 13, 4, '290.00', 'SUMA', '2021-04-17 16:15:31', '2021-04-17 16:15:31'),
(115, 16, 4, '150.00', 'SUMA', '2021-04-17 17:31:10', '2021-04-17 17:31:10'),
(116, 18, 5, '5000.00', 'SUMA', '2021-04-21 18:48:58', '2021-04-21 18:48:58'),
(117, 19, 2, '4928.00', 'SUMA', '2021-04-21 20:13:36', '2021-04-21 20:13:36'),
(118, 20, 3, '2900.00', 'SUMA', '2021-04-21 21:50:12', '2021-04-21 21:50:12'),
(119, 21, 3, '2900.00', 'SUMA', '2021-04-21 21:51:26', '2021-04-21 21:51:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cuentas_por_cobrar_ventas`
--

DROP TABLE IF EXISTS `detalle_cuentas_por_cobrar_ventas`;
CREATE TABLE `detalle_cuentas_por_cobrar_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idcpcv` bigint(20) DEFAULT NULL,
  `fecha` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `efectivo` double(102,2) DEFAULT NULL,
  `transferencia` double(102,2) DEFAULT NULL,
  `pagado` double(102,2) DEFAULT NULL,
  `resta` double(102,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_cuentas_por_cobrar_ventas`
--

INSERT INTO `detalle_cuentas_por_cobrar_ventas` (`id`, `idcpcv`, `fecha`, `hora`, `efectivo`, `transferencia`, `pagado`, `resta`, `created_at`, `updated_at`) VALUES
(6, 6, '15-04-2021', '19:59:57', 200.00, 500.00, 700.00, 1000.00, NULL, NULL),
(7, 6, '15-04-2021', '21:53:24', 50.00, 150.00, 200.00, 800.00, '2021-04-16 01:53:24', '2021-04-16 01:53:24'),
(8, 6, '15-04-2021', '23:01:50', 800.00, 0.00, 800.00, 0.00, '2021-04-16 03:01:50', '2021-04-16 03:01:50'),
(9, 7, '16-04-2021', '09:29:49', 0.00, 0.00, 0.00, 700.00, '2021-04-16 13:29:49', '2021-04-16 13:29:49'),
(10, 8, '16-04-2021', '09:40:55', 0.00, 0.00, 0.00, 300.00, '2021-04-16 13:40:55', '2021-04-16 13:40:55'),
(11, 9, '16-04-2021', '09:44:50', 0.00, 0.00, 0.00, 250.00, '2021-04-16 13:44:50', '2021-04-16 13:44:50'),
(12, 10, '16-04-2021', '09:57:00', 0.00, 0.00, 0.00, 450.00, '2021-04-16 13:57:00', '2021-04-16 13:57:00'),
(13, 11, '16-04-2021', '10:04:05', 5.00, 5.00, 10.00, 70.00, '2021-04-16 14:04:05', '2021-04-16 14:04:05'),
(14, 12, '16-04-2021', '10:16:34', 0.00, 0.00, 0.00, 100.00, '2021-04-16 14:16:34', '2021-04-16 14:16:34'),
(15, 13, '16-04-2021', '10:19:56', 15.00, 15.00, 30.00, 170.00, '2021-04-16 14:19:56', '2021-04-16 14:19:56'),
(16, 14, '16-04-2021', '10:44:45', 500.00, 1000.00, 1500.00, 4500.00, NULL, NULL),
(17, 13, '16-04-2021', '12:51:45', 20.00, 30.00, 50.00, 120.00, '2021-04-16 16:51:45', '2021-04-16 16:51:45'),
(18, 14, '16-04-2021', '12:55:36', 200.00, 300.00, 500.00, 4000.00, '2021-04-16 16:55:36', '2021-04-16 16:55:36'),
(19, 14, '16-04-2021', '13:42:19', 200.00, 400.00, 600.00, 3900.00, '2021-04-16 17:42:19', '2021-04-16 17:42:19'),
(20, 7, '16-04-2021', '13:44:17', 20.00, 40.00, 60.00, 640.00, '2021-04-16 17:44:17', '2021-04-16 17:44:17'),
(21, 15, '16-04-2021', '15:02:32', 70.00, 0.00, 70.00, 11930.00, NULL, NULL),
(22, 16, '16-04-2021', '15:10:22', 0.00, 92.66, 92.66, 400.00, '2021-04-16 19:10:22', '2021-04-16 19:10:22'),
(23, 16, '16-04-2021', '15:16:29', 200.00, 200.00, 400.00, 0.00, '2021-04-16 19:16:29', '2021-04-16 19:16:29'),
(24, 17, '16-04-2021', '15:52:47', 20000.00, 0.00, 20000.00, 4000.00, NULL, NULL),
(25, 17, '16-04-2021', '16:17:48', 4000.00, 0.00, 4000.00, 0.00, '2021-04-16 20:17:48', '2021-04-16 20:17:48'),
(26, 18, '17-04-2021', '18:46:29', 0.00, 0.00, 0.00, 42.00, '2021-04-17 22:46:29', '2021-04-17 22:46:29'),
(27, 19, '17-04-2021', '19:29:14', 0.00, 0.00, 0.00, 777.00, NULL, NULL),
(28, 20, '17-04-2021', '19:34:49', 0.00, 0.00, 0.00, 8.00, NULL, NULL),
(29, 21, '17-04-2021', '19:45:42', 0.00, 0.00, 0.00, 100.00, NULL, NULL),
(30, 20, '18-04-2021', '00:48:30', 4.00, 0.00, 4.00, 4.00, '2021-04-18 04:48:30', '2021-04-18 04:48:30'),
(31, 18, '18-04-2021', '01:14:26', 2.00, 2.00, 4.00, 38.00, '2021-04-18 05:14:26', '2021-04-18 05:14:26'),
(32, 18, '18-04-2021', '01:15:31', 5.00, 5.00, 10.00, 32.00, '2021-04-18 05:15:31', '2021-04-18 05:15:31'),
(33, 18, '18-04-2021', '10:07:49', 2.00, 0.00, 2.00, 30.00, '2021-04-18 14:07:49', '2021-04-18 14:07:49'),
(34, 15, '18-04-2021', '10:49:29', 930.00, 1000.00, 1930.00, 10000.00, '2021-04-18 14:49:29', '2021-04-18 14:49:29'),
(35, 15, '18-04-2021', '10:51:52', 500.00, 500.00, 1000.00, 9000.00, '2021-04-18 14:51:52', '2021-04-18 14:51:52'),
(36, 18, '18-04-2021', '10:52:33', 5.00, 0.00, 5.00, 25.00, '2021-04-18 14:52:33', '2021-04-18 14:52:33'),
(37, 18, '18-04-2021', '10:56:27', 0.00, 5.00, 5.00, 20.00, '2021-04-18 14:56:27', '2021-04-18 14:56:27'),
(38, 18, '18-04-2021', '11:00:45', 5.00, 0.00, 5.00, 15.00, '2021-04-18 15:00:45', '2021-04-18 15:00:45'),
(39, 18, '18-04-2021', '11:02:28', 0.00, 3.00, 3.00, 12.00, '2021-04-18 15:02:28', '2021-04-18 15:02:28'),
(40, 15, '18-04-2021', '11:06:37', 500.00, 0.00, 500.00, 8500.00, '2021-04-18 15:06:37', '2021-04-18 15:06:37'),
(41, 22, '20-04-2021', '14:28:02', 36000.00, 0.00, 36000.00, 0.00, NULL, NULL),
(42, 23, '21-04-2021', '00:14:12', 0.00, 0.00, 0.00, 474.00, '2021-04-21 04:14:12', '2021-04-21 04:14:12'),
(43, 23, '21-04-2021', '00:15:31', 74.00, 100.00, 174.00, 300.00, '2021-04-21 04:15:31', '2021-04-21 04:15:31');

--
-- Disparadores `detalle_cuentas_por_cobrar_ventas`
--
DROP TRIGGER IF EXISTS `Delete_en_DetalleCPC`;
DELIMITER $$
CREATE TRIGGER `Delete_en_DetalleCPC` AFTER DELETE ON `detalle_cuentas_por_cobrar_ventas` FOR EACH ROW BEGIN
SET @ed = (SELECT efectivo FROM liquidez WHERE id = 1);
SET @bd = (SELECT banco FROM liquidez WHERE id = 1);
SET @ne = @ed - OLD.efectivo;
SET @nb = @bd - OLD.transferencia;
UPDATE liquidez SET efectivo = @ne, banco = @nb WHERE id = 1;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `Insert_en_DetalleCPC`;
DELIMITER $$
CREATE TRIGGER `Insert_en_DetalleCPC` AFTER INSERT ON `detalle_cuentas_por_cobrar_ventas` FOR EACH ROW BEGIN
SET @ed = (SELECT efectivo FROM liquidez WHERE id = 1);
SET @bd = (SELECT banco FROM liquidez WHERE id = 1);
SET @ne = @ed + NEW.efectivo;
SET @nb = @bd + NEW.transferencia;
UPDATE liquidez SET efectivo = @ne, banco = @nb WHERE id = 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cuentas_por_pagar_compras`
--

DROP TABLE IF EXISTS `detalle_cuentas_por_pagar_compras`;
CREATE TABLE `detalle_cuentas_por_pagar_compras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idcppc` bigint(20) DEFAULT NULL,
  `fecha` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `efectivo` double(102,2) DEFAULT NULL,
  `transferencia` double(102,2) DEFAULT NULL,
  `pagado` double(102,2) DEFAULT NULL,
  `resta` double(102,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_cuentas_por_pagar_compras`
--

INSERT INTO `detalle_cuentas_por_pagar_compras` (`id`, `idcppc`, `fecha`, `hora`, `efectivo`, `transferencia`, `pagado`, `resta`, `created_at`, `updated_at`) VALUES
(1, 2, '21-04-2021', '16:52:18', 500.00, 500.00, 1000.00, 33988.80, '2021-04-21 20:52:18', '2021-04-21 20:52:18'),
(2, 3, '21-04-2021', '17:58:57', 16000.00, 2000.00, 18000.00, 2880.00, '2021-04-21 21:58:57', '2021-04-21 21:58:57');

--
-- Disparadores `detalle_cuentas_por_pagar_compras`
--
DROP TRIGGER IF EXISTS `Delete_en_DetalleCPP`;
DELIMITER $$
CREATE TRIGGER `Delete_en_DetalleCPP` AFTER DELETE ON `detalle_cuentas_por_pagar_compras` FOR EACH ROW BEGIN
SET @ed = (SELECT efectivo FROM liquidez WHERE id = 1);
SET @bd = (SELECT banco FROM liquidez WHERE id = 1);
SET @ne = @ed - OLD.efectivo;
SET @nb = @bd - OLD.transferencia;
UPDATE liquidez SET efectivo = @ne, banco = @nb WHERE id = 1;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `Insert_en_DetalleCPP`;
DELIMITER $$
CREATE TRIGGER `Insert_en_DetalleCPP` AFTER INSERT ON `detalle_cuentas_por_pagar_compras` FOR EACH ROW BEGIN
SET @ed = (SELECT efectivo FROM liquidez WHERE id = 1);
SET @bd = (SELECT banco FROM liquidez WHERE id = 1);
SET @ne = @ed - NEW.efectivo;
SET @nb = @bd - NEW.transferencia;
UPDATE liquidez SET efectivo = @ne, banco = @nb WHERE id = 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_negociacion_compras`
--

DROP TABLE IF EXISTS `detalle_negociacion_compras`;
CREATE TABLE `detalle_negociacion_compras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `negociacion_id` bigint(20) UNSIGNED NOT NULL,
  `producto_idn` bigint(20) UNSIGNED NOT NULL,
  `cantidadprorecmatn` double(12,2) DEFAULT NULL,
  `precionegn` double(12,2) DEFAULT NULL,
  `totalpronegn` double(102,2) DEFAULT NULL,
  `cantidadprorecmatndebe` double(12,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_negociacion_compras`
--

INSERT INTO `detalle_negociacion_compras` (`id`, `negociacion_id`, `producto_idn`, `cantidadprorecmatn`, `precionegn`, `totalpronegn`, `cantidadprorecmatndebe`, `created_at`, `updated_at`) VALUES
(5, 1, 2, 2.00, 2.10, 4.20, 2.00, '2021-04-19 19:22:14', '2021-04-19 19:22:14'),
(6, 1, 5, 2.00, 2.40, 4.80, 2.00, '2021-04-19 19:26:56', '2021-04-19 19:26:56'),
(7, 2, 7, 3000.00, 7.60, 22800.00, 3000.00, '2021-04-19 20:59:20', '2021-04-19 20:59:20'),
(12, 3, 7, 3500.00, 8.60, 30100.00, 3500.00, '2021-04-19 21:38:05', '2021-04-19 21:38:05'),
(13, 4, 3, 4000.00, 8.20, 32800.00, 4000.00, '2021-04-19 22:00:40', '2021-04-19 22:00:40'),
(14, 5, 2, 4000.00, 8.10, 32400.00, 4000.00, '2021-04-19 22:05:20', '2021-04-19 22:05:20'),
(15, 6, 4, 5000.00, 7.30, 36500.00, 5000.00, '2021-04-19 22:10:45', '2021-04-19 22:10:45'),
(16, 7, 4, 5000.00, 7.30, 36500.00, 5000.00, '2021-04-19 22:50:31', '2021-04-19 22:50:31'),
(17, 8, 4, 5000.00, 7.30, 36500.00, 5000.00, '2021-04-19 22:54:40', '2021-04-19 22:54:40'),
(18, 9, 4, 4000.00, 8.30, 33200.00, 4000.00, '2021-04-19 22:59:55', '2021-04-19 22:59:55'),
(19, 10, 4, 4000.00, 8.30, 33200.00, 4000.00, '2021-04-19 23:03:06', '2021-04-19 23:03:06'),
(20, 11, 4, 4000.00, 9.30, 37200.00, 4000.00, '2021-04-19 23:05:02', '2021-04-19 23:05:02'),
(21, 12, 4, 5000.00, 7.30, 36500.00, 5000.00, '2021-04-19 23:09:01', '2021-04-19 23:09:01'),
(22, 13, 7, 1000000000.00, 7.60, 30400.00, 4000.00, '2021-04-19 23:19:20', '2021-04-19 23:19:20'),
(23, 14, 3, 999999999.00, 9.20, 9199999990.80, 999999999.00, '2021-04-20 00:04:27', '2021-04-20 00:04:27'),
(24, 15, 5, 1.20, 7.40, 8.88, 1.20, '2021-04-20 03:53:11', '2021-04-20 03:53:11'),
(29, 16, 3, 5000.00, 7.20, 36000.00, 5000.00, '2021-04-20 04:39:29', '2021-04-20 04:39:29'),
(30, 17, 3, 5000.00, 7.20, 36000.00, 5000.00, '2021-04-20 04:50:24', '2021-04-20 04:50:24'),
(31, 20, 3, 5000.00, 7.20, 36000.00, 5000.00, '2021-04-20 15:00:50', '2021-04-20 15:00:50'),
(43, 21, 5, 4000.00, 8.40, 33600.00, 4000.00, '2021-04-20 15:51:46', '2021-04-20 15:51:46'),
(53, 23, 2, 4000.00, 9.10, 36400.00, 4000.00, '2021-04-20 19:03:16', '2021-04-20 19:03:16'),
(66, 24, 5, 4000.00, 8.40, 33600.00, 4000.00, '2021-04-21 00:02:46', '2021-04-21 00:02:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_negociacion_ventas`
--

DROP TABLE IF EXISTS `detalle_negociacion_ventas`;
CREATE TABLE `detalle_negociacion_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `negociacion_id` bigint(20) UNSIGNED NOT NULL,
  `producto_idn` bigint(20) UNSIGNED NOT NULL,
  `cantidadprorecmatn` double(12,2) DEFAULT NULL,
  `precionegn` double(12,2) DEFAULT NULL,
  `totalpronegn` double(102,2) DEFAULT NULL,
  `cantidadprorecmatndebe` double(12,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_negociacion_ventas`
--

INSERT INTO `detalle_negociacion_ventas` (`id`, `negociacion_id`, `producto_idn`, `cantidadprorecmatn`, `precionegn`, `totalpronegn`, `cantidadprorecmatndebe`, `created_at`, `updated_at`) VALUES
(120, 1, 3, 200.00, 2.00, 400.00, 200.00, '2021-04-15 23:59:16', '2021-04-15 23:59:16'),
(121, 1, 5, 400.00, 2.00, 800.00, 342.00, '2021-04-15 23:59:27', '2021-04-18 16:09:13'),
(122, 1, 4, 250.00, 2.00, 500.00, 150.00, '2021-04-15 23:59:41', '2021-04-16 19:13:27'),
(123, 2, 7, 3000.00, 2.00, 6000.00, 2700.00, '2021-04-16 14:43:37', '2021-04-16 17:00:24'),
(124, 3, 2, 3000.00, 4.00, 12000.00, 3000.00, '2021-04-16 18:59:53', '2021-04-16 18:59:53'),
(125, 4, 2, 5000.00, 4.80, 24000.00, 3900.00, '2021-04-16 19:52:05', '2021-04-18 16:41:34'),
(126, 7, 2, 2000.80, 1.20, 2400.96, 2000.80, '2021-04-16 21:19:31', '2021-04-16 21:19:31'),
(127, 8, 3, 777.00, 1.00, 777.00, 777.00, '2021-04-17 23:29:08', '2021-04-17 23:29:08'),
(128, 9, 6, 8.00, 1.00, 8.00, 8.00, '2021-04-17 23:34:43', '2021-04-17 23:34:43'),
(129, 10, 3, 10.00, 10.00, 100.00, 10.00, '2021-04-17 23:45:35', '2021-04-17 23:45:35'),
(130, 12, 3, 5000.00, 7.20, 36000.00, 5000.00, '2021-04-20 15:00:44', '2021-04-20 15:00:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

DROP TABLE IF EXISTS `detalle_ventas`;
CREATE TABLE `detalle_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idventa` bigint(20) UNSIGNED NOT NULL,
  `idproductov` bigint(20) UNSIGNED NOT NULL,
  `cantidadprov` double(12,2) NOT NULL,
  `operacionv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precioprov` double(12,2) DEFAULT NULL,
  `totalprov` double(102,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `idventa`, `idproductov`, `cantidadprov`, `operacionv`, `precioprov`, `totalprov`, `created_at`, `updated_at`) VALUES
(56, 1054, 2, 100.00, NULL, 2.00, 200.00, '2021-04-16 13:25:49', '2021-04-16 13:25:49'),
(57, 1054, 3, 500.00, NULL, 3.00, 1500.00, '2021-04-16 13:26:17', '2021-04-16 13:26:17'),
(58, 1055, 4, 200.00, NULL, 2.00, 400.00, '2021-04-16 13:29:00', '2021-04-16 13:29:00'),
(59, 1055, 5, 300.00, NULL, 1.00, 300.00, '2021-04-16 13:29:38', '2021-04-16 13:29:38'),
(60, 1056, 6, 10.00, NULL, 30.00, 300.00, '2021-04-16 13:40:46', '2021-04-16 13:40:46'),
(61, 1057, 7, 50.00, NULL, 5.00, 250.00, '2021-04-16 13:44:33', '2021-04-16 13:44:33'),
(62, 1058, 7, 150.00, NULL, 3.00, 450.00, '2021-04-16 13:56:42', '2021-04-16 13:56:42'),
(63, 1059, 6, 40.00, NULL, 2.00, 80.00, '2021-04-16 14:02:27', '2021-04-16 14:02:27'),
(64, 1060, 4, 50.00, NULL, 2.00, 100.00, '2021-04-16 14:16:27', '2021-04-16 14:16:27'),
(65, 1061, 7, 100.00, NULL, 2.00, 200.00, '2021-04-16 14:19:45', '2021-04-16 14:19:45'),
(66, 1064, 6, 50.00, NULL, 2.00, 100.00, '2021-04-16 19:06:45', '2021-04-16 19:06:45'),
(67, 1065, 6, 400.54, NULL, 1.23, 492.66, '2021-04-16 19:09:46', '2021-04-16 19:09:46'),
(73, 1071, 3, 5.00, NULL, 3.00, 15.00, '2021-04-17 22:13:44', '2021-04-17 22:13:44'),
(75, 1072, 2, 12.00, NULL, 3.00, 36.00, '2021-04-17 22:26:32', '2021-04-17 22:26:32'),
(76, 1073, 2, 6.00, NULL, 7.00, 42.00, '2021-04-17 22:46:01', '2021-04-17 22:46:01'),
(78, 1079, 3, 158.00, NULL, 3.00, 474.00, '2021-04-21 04:14:01', '2021-04-21 04:14:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liquidez`
--

DROP TABLE IF EXISTS `liquidez`;
CREATE TABLE `liquidez` (
  `id` bigint(20) NOT NULL,
  `efectivo` double(102,2) DEFAULT NULL,
  `banco` double(102,2) DEFAULT NULL,
  `descripcion` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `liquidez`
--

INSERT INTO `liquidez` (`id`, `efectivo`, `banco`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, -16000.00, -2000.00, 'DISPONIBLE', '2021-04-13 17:41:49', '2021-04-17 22:44:49'),
(2, 0.00, 0.00, 'CPC', '2021-04-15 20:16:35', '2021-04-15 20:16:35'),
(3, 0.00, 0.00, 'CPP', '2021-04-15 20:16:35', '2021-04-15 20:16:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2020_05_21_100000_create_teams_table', 1),
(7, '2020_05_21_200000_create_team_user_table', 1),
(8, '2020_05_21_300000_create_team_invitations_table', 1),
(9, '2021_02_16_075143_create_sessions_table', 1),
(10, '2021_02_16_183425_create_sucursales_table', 1),
(11, '2021_02_19_044151_create__pproveedores_table', 1),
(12, '2021_02_19_044841_create__ccompras_table', 1),
(13, '2021_02_19_044914_create__ddetallecompras_table', 1),
(14, '2021_02_19_045022_create__iinventario_table', 1),
(15, '2021_02_19_045107_create__ccategoriaproducto_table', 1),
(16, '2021_02_19_051641_create__pproductos_table', 1),
(17, '2021_02_19_062543_create__proveedores_table', 1),
(18, '2021_02_20_175544_create_recepcionmaterial_table', 1),
(19, '2021_02_20_180046_create_detallerecmat_table', 1),
(20, '2021_03_13_145352_create_permission_tables', 1),
(21, '2021_03_21_190131_create_ventas_table', 1),
(22, '2021_03_21_195640_create_detalle_ventas_table', 1),
(23, '2021_03_21_202827_create_negociacion_ventas_table', 1),
(24, '2021_03_21_202905_create_detalle_negociacion_ventas_table', 1),
(25, '2021_03_21_211519_create_clientes_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5),
(6, 'App\\Models\\User', 6),
(7, 'App\\Models\\User', 7),
(8, 'App\\Models\\User', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negociacion_compras`
--

DROP TABLE IF EXISTS `negociacion_compras`;
CREATE TABLE `negociacion_compras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fechan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cedulan` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idlugarn` int(11) DEFAULT NULL,
  `idtipopagon` int(11) DEFAULT NULL,
  `idtipoabonon` int(11) DEFAULT NULL,
  `observaciones` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montotn` double(102,2) DEFAULT NULL,
  `efectivo` double(102,2) DEFAULT NULL,
  `transferencia` double(102,2) DEFAULT NULL,
  `totalpagado` double(102,2) DEFAULT NULL,
  `pesotn` double(102,2) DEFAULT NULL,
  `restan` double(102,2) DEFAULT NULL,
  `finalizada` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amortizando` int(11) DEFAULT NULL COMMENT 'Este campo evita que se cree una factura desde el disparador cuando se modifica esta tabla desde el abono a credito',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `negociacion_compras`
--

INSERT INTO `negociacion_compras` (`id`, `fechan`, `horan`, `cedulan`, `idlugarn`, `idtipopagon`, `idtipoabonon`, `observaciones`, `montotn`, `efectivo`, `transferencia`, `totalpagado`, `pesotn`, `restan`, `finalizada`, `amortizando`, `created_at`, `updated_at`) VALUES
(1, '19-04-2021', '15:45:02', 'v12345678', 0, 2, 0, 'nada', 9.00, 0.00, 0.00, 0.00, 4.00, 9.00, 'NO', 2, '2021-04-19 19:21:52', '2021-04-19 19:45:02'),
(2, '19-04-2021', '16:58:57', 'v77777777', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-19 20:58:57', '2021-04-19 20:59:20'),
(3, '19-04-2021', '17:15:52', 'v88888888', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-19 21:15:52', '2021-04-19 21:16:12'),
(4, '19-04-2021', '17:59:32', 'v88888888', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-19 21:59:32', '2021-04-19 22:00:40'),
(5, '19-04-2021', '18:04:49', 'v88888888', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-19 22:04:49', '2021-04-19 22:05:20'),
(6, '19-04-2021', '18:10:03', 'v77777777', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-19 22:10:03', '2021-04-19 22:10:45'),
(7, '19-04-2021', '18:49:49', 'v77777777', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-19 22:49:49', '2021-04-19 22:50:31'),
(8, '19-04-2021', '18:54:15', 'v77777777', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-19 22:54:15', '2021-04-19 22:54:40'),
(9, '19-04-2021', '18:59:24', 'v88888888', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-19 22:59:24', '2021-04-19 22:59:55'),
(10, '19-04-2021', '19:02:42', 'v88888888', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-19 23:02:42', '2021-04-19 23:03:06'),
(11, '19-04-2021', '19:04:31', 'v99999999', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-19 23:04:31', '2021-04-19 23:05:02'),
(12, '19-04-2021', '19:08:43', 'v77777777', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-19 23:08:43', '2021-04-19 23:09:01'),
(13, '19-04-2021', '19:18:43', 'v77777777', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-19 23:18:43', '2021-04-19 23:19:20'),
(14, '19-04-2021', '19:45:45', 'v99999999', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-19 23:45:45', '2021-04-20 00:04:27'),
(15, '19-04-2021', '22:26:23', 'v77777777', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-20 02:26:23', '2021-04-20 03:53:11'),
(16, '20-04-2021', '00:39:09', 'V77777777', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-20 04:39:09', '2021-04-20 04:39:29'),
(17, '20-04-2021', '00:49:57', 'V77777777', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-20 04:49:57', '2021-04-20 04:50:24'),
(18, '20-04-2021', '10:42:19', '', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-20 14:42:19', '2021-04-20 14:42:19'),
(19, '20-04-2021', '10:45:28', '', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-20 14:45:28', '2021-04-20 14:45:28'),
(20, '20-04-2021', '10:58:57', 'v77777777', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-20 14:58:57', '2021-04-20 15:00:50'),
(21, '20-04-2021', '11:50:32', 'v88888888', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-20 15:50:32', '2021-04-20 15:51:26'),
(22, '20-04-2021', '14:49:25', 'v99999999', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-20 18:49:25', '2021-04-20 18:49:41'),
(23, '20-04-2021', '15:02:12', 'v99999999', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-20 19:02:12', '2021-04-20 19:03:16'),
(24, '20-04-2021', '20:02:30', '', 1, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-21 00:02:30', '2021-04-21 00:02:30');

--
-- Disparadores `negociacion_compras`
--
DROP TRIGGER IF EXISTS `Insert_en_Compras_CPP_DCPP`;
DELIMITER $$
CREATE TRIGGER `Insert_en_Compras_CPP_DCPP` AFTER UPDATE ON `negociacion_compras` FOR EACH ROW BEGIN
IF NEW.amortizando <> 1 THEN
  IF NEW.restan = 0 THEN 
  	SET @statuspago = 1; 
  ELSE 
  	SET @statuspago = 2; 
  END IF;
    INSERT INTO _ccompras (fechacompra, hora, cedula, idlugar, idestatuspago, idtipopago, efectivo, transferencia, idtipoabonov, negociacion_id, totalcomra, totalpagado, diferenciapago, observacionesc)
	VALUES (NEW.fechan, NEW.cedulan, idlugarn, @statuspago, NEW.idtipopagon, NEW.efectivo, NEW.transferencia, NEW.idtipoabonon, NEW.id, NEW.montotn, NEW.totalpagado, NEW.restan, CONCAT("FACTURADO DESDE LA NEGOCIACION. ", NEW.`observaciones`), "NO");
    
INSERT INTO cuentas_por_pagar_compras
(idcompra, idnegociacioncompra, fecha, hora, cedula, montototal, totalefectivo, totaltransferencia, totalpagado, totalresta, finalizada)
VALUES (0, NEW.id, NEW.fechan, NEW.horan, NEW.cedulan, NEW.montotn, NEW.efectivo, NEW.transferencia, NEW.totalpagado, NEW.restan, NEW.finalizada);
SET @idcppc = (SELECT id FROM cuentas_por_pagar_compras
 ORDER BY id DESC LIMIT 1);
 
INSERT INTO detalle_cuentas_por_pagar_compras
(idcppc, fecha, hora, efectivo, transferencia, pagado, resta)
VALUES (@idcpcv, NEW.fechan, NEW.horan, NEW.efectivo, NEW.transferencia, NEW.totalpagado, NEW.restan);
    
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negociacion_ventas`
--

DROP TABLE IF EXISTS `negociacion_ventas`;
CREATE TABLE `negociacion_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fechan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cedulan` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idlugarn` int(11) DEFAULT NULL,
  `idtipopagon` int(11) DEFAULT NULL,
  `idtipoabonon` int(11) DEFAULT NULL,
  `observaciones` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montotn` double(102,2) DEFAULT NULL,
  `efectivo` double(102,2) DEFAULT NULL,
  `transferencia` double(102,2) DEFAULT NULL,
  `totalpagado` double(102,2) DEFAULT NULL,
  `pesotn` double(102,2) DEFAULT NULL,
  `restan` double(102,2) DEFAULT NULL,
  `finalizada` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amortizando` int(11) DEFAULT NULL COMMENT 'Este campo evita que se cree una factura desde el disparador cuando se modifica esta tabla desde el abono a credito',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `negociacion_ventas`
--

INSERT INTO `negociacion_ventas` (`id`, `fechan`, `horan`, `cedulan`, `idlugarn`, `idtipopagon`, `idtipoabonon`, `observaciones`, `montotn`, `efectivo`, `transferencia`, `totalpagado`, `pesotn`, `restan`, `finalizada`, `amortizando`, `created_at`, `updated_at`) VALUES
(1, '15-04-2021', '19:59:57', 'v33333333', 0, 2, 3, 'a', 1700.00, 200.00, 500.00, 700.00, 850.00, 1000.00, 'NO', 2, '2021-04-15 23:56:03', '2021-04-15 23:59:57'),
(2, '16-04-2021', '10:44:45', 'v55555555', 0, 2, 3, 'ninguna', 6000.00, 500.00, 1000.00, 1500.00, 3000.00, 4500.00, 'NO', 2, '2021-04-16 14:43:11', '2021-04-16 14:44:45'),
(3, '16-04-2021', '15:02:32', 'v33333333', 0, 2, 1, 'nada', 12000.00, 70.00, 0.00, 70.00, 3000.00, 11930.00, 'NO', 2, '2021-04-16 18:58:44', '2021-04-16 19:02:32'),
(4, '16-04-2021', '15:52:47', 'v11111111', 0, 2, 1, 'abonaron 20000 menos comision por cambio', 24000.00, 20000.00, 0.00, 20000.00, 5000.00, 4000.00, 'NO', 2, '2021-04-16 19:51:17', '2021-04-16 19:52:47'),
(5, '16-04-2021', '16:13:40', '', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-16 20:13:40', '2021-04-16 20:13:40'),
(6, '16-04-2021', '16:18:21', '', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-16 20:18:21', '2021-04-16 20:18:21'),
(7, '16-04-2021', '17:17:52', '', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-16 21:17:52', '2021-04-16 21:17:52'),
(8, '17-04-2021', '19:29:14', 'V33333333', 0, 2, 0, 'K', 777.00, 0.00, 0.00, 0.00, 777.00, 777.00, 'NO', 2, '2021-04-17 23:28:31', '2021-04-17 23:29:14'),
(9, '17-04-2021', '19:34:49', 'V33333333', 0, 2, 0, 'J', 8.00, 0.00, 0.00, 0.00, 8.00, 8.00, 'NO', 2, '2021-04-17 23:34:18', '2021-04-17 23:34:49'),
(10, '17-04-2021', '19:45:42', 'v33333333', 0, 2, 0, 'jj', 100.00, 0.00, 0.00, 0.00, 10.00, 100.00, 'NO', 2, '2021-04-17 23:45:10', '2021-04-17 23:45:42'),
(11, '19-04-2021', '12:06:12', '', 0, 0, 0, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NO', 2, '2021-04-19 16:06:12', '2021-04-19 16:06:12'),
(12, '20-04-2021', '14:28:02', 'v33333333', 0, 1, 1, 'vv', 36000.00, 36000.00, 0.00, 36000.00, 5000.00, 0.00, 'NO', 2, '2021-04-20 14:59:30', '2021-04-20 18:28:02');

--
-- Disparadores `negociacion_ventas`
--
DROP TRIGGER IF EXISTS `Insert_en_Ventas_CPC_DCPC`;
DELIMITER $$
CREATE TRIGGER `Insert_en_Ventas_CPC_DCPC` AFTER UPDATE ON `negociacion_ventas` FOR EACH ROW BEGIN
IF NEW.amortizando <> 1 THEN
  IF NEW.restan = 0 THEN 
  	SET @statuspagov = 1; 
  ELSE 
  	SET @statuspagov = 2; 
  END IF;
    INSERT INTO ventas (fechaventa, cedulav, idestatuspagov, idtipopagov, efectivo, transferencia, idtipoabonov, negociacion_id, totalcomrav, totalpagadov, diferenciapagov, observacionesv, despachado)
	VALUES (NEW.fechan, NEW.cedulan, @statuspagov, NEW.idtipopagon, NEW.efectivo, NEW.transferencia, NEW.idtipoabonon, NEW.id, NEW.montotn, NEW.totalpagado, NEW.restan, CONCAT("FACTURADO DESDE LA NEGOCIACION. ", NEW.`observaciones`), "NO"
	);

INSERT INTO cuentas_por_cobrar_ventas
(idventa, idnegociacionventa, fecha, hora, cedula, montototal, totalefectivo, totaltransferencia, totalpagado, totalresta, finalizada)
VALUES (0, NEW.id, NEW.fechan, NEW.horan, NEW.cedulan, NEW.montotn, NEW.efectivo, NEW.transferencia, NEW.totalpagado, NEW.restan, NEW.finalizada);
SET @idcpcv = (SELECT id FROM cuentas_por_cobrar_ventas
 ORDER BY id DESC LIMIT 1);
INSERT INTO detalle_cuentas_por_cobrar_ventas
(idcpcv, fecha, hora, efectivo, transferencia, pagado, resta)
VALUES (@idcpcv, NEW.fechan, NEW.horan, NEW.efectivo, NEW.transferencia, NEW.totalpagado, NEW.restan);
    
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_negociacion_ventas`
--

DROP TABLE IF EXISTS `pago_negociacion_ventas`;
CREATE TABLE `pago_negociacion_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idventa` bigint(20) DEFAULT NULL,
  `negociacion_id` bigint(20) UNSIGNED NOT NULL,
  `fechapagonegven` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horapagonegven` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cedula` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monto` double(102,2) DEFAULT NULL,
  `montoefec` double(102,2) DEFAULT NULL,
  `montotran` double(102,2) DEFAULT NULL,
  `totalpago` double(102,2) DEFAULT NULL,
  `restapago` double(102,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios_productos_prov_clie`
--

DROP TABLE IF EXISTS `precios_productos_prov_clie`;
CREATE TABLE `precios_productos_prov_clie` (
  `id` bigint(20) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `precio` double(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `precios_productos_prov_clie`
--

INSERT INTO `precios_productos_prov_clie` (`id`, `cedula`, `idproducto`, `precio`) VALUES
(1, 'V12345678', 2, 2.10),
(2, 'V12345678', 3, 2.20),
(3, 'V12345678', 4, 2.30),
(4, 'V12345678', 5, 2.40),
(5, 'V12345678', 6, 2.50),
(6, 'V12345678', 7, 2.60),
(7, 'v66666666', 2, 6.10),
(8, 'v66666666', 3, 6.20),
(9, 'v66666666', 4, 6.30),
(10, 'v66666666', 5, 6.40),
(11, 'v66666666', 6, 6.50),
(12, 'v66666666', 7, 6.60),
(13, 'v77777777', 2, 7.10),
(14, 'v77777777', 3, 7.20),
(15, 'v77777777', 4, 7.30),
(16, 'v77777777', 5, 7.40),
(17, 'v77777777', 6, 7.50),
(18, 'v77777777', 7, 7.60),
(19, 'v88888888', 2, 8.10),
(20, 'v88888888', 3, 8.20),
(21, 'v88888888', 4, 8.30),
(22, 'v88888888', 5, 8.40),
(23, 'v88888888', 6, 8.50),
(24, 'v88888888', 7, 8.60),
(25, 'v99999999', 2, 9.10),
(26, 'v99999999', 3, 9.20),
(27, 'v99999999', 4, 9.30),
(28, 'v99999999', 5, 9.40),
(29, 'v99999999', 6, 9.50),
(30, 'v99999999', 7, 9.60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE `proveedores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cedula` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visible` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `cedula`, `nombre`, `direccion`, `telefono`, `correo`, `visible`, `created_at`, `updated_at`) VALUES
(1, 'V66666666', 'JUAN CARLOS', 'Et non ut in rerum n', '+1 (923) 281-7684', 'zemeruvyf@mailinator.com', NULL, '2021-03-25 04:33:23', '2021-03-25 13:22:54'),
(2, 'V77777777', 'MANUEL', 'Eum non nihil ab rem', '+1 (535) 878-5983', 'walolib@mailinator.com', NULL, '2021-03-25 04:33:39', '2021-03-25 13:23:06'),
(3, 'V88888888', 'ROBERTO', 'Ab dicta sit quaerat', '+1 (941) 142-2648', 'lorunyve@mailinator.com', NULL, '2021-03-25 04:33:56', '2021-03-25 13:23:18'),
(4, 'V99999999', 'PEDRO', 'Quaerat ullam quia i', '+1 (558) 285-4931', 'cokovuqog@mailinator.com', NULL, '2021-03-25 04:34:12', '2021-03-25 13:23:40'),
(5, 'V12345678', 'LUIS MANUEL', 'Consequatur consequa', '+1 (488) 122-9185', 'qimy@mailinator.com', NULL, '2021-03-25 04:34:37', '2021-03-25 13:24:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcionmaterial`
--

DROP TABLE IF EXISTS `recepcionmaterial`;
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
-- Volcado de datos para la tabla `recepcionmaterial`
--

INSERT INTO `recepcionmaterial` (`id`, `fecha`, `cedula`, `idlugar`, `pesofull`, `pesovacio`, `pesoneto`, `pesocalculado`, `observaciones`, `recibido`, `facturado`, `created_at`, `updated_at`) VALUES
(1, '16-04-2021', 'V99999999', 1, 200.00, 50.00, 150.00, 150.00, NULL, 'SI', 'SI', '2021-04-16 19:25:09', '2021-04-16 19:30:12'),
(2, '16-04-2021', 'V77777777', 1, 10000.00, 20.00, 9980.00, 9980.00, 'hhh', 'SI', 'NO', '2021-04-16 19:33:13', '2021-04-16 19:35:23'),
(3, '16-04-2021', 'v66666666', 1, 300.00, 5.00, 295.00, 295.00, 'u', 'SI', 'SI', '2021-04-16 19:36:02', '2021-04-16 19:43:39'),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NO', 'NO', '2021-04-16 21:14:42', '2021-04-16 21:14:42'),
(5, '16-04-2021', 'V77777777', 1, 500.00, 10.00, 490.00, 490.00, 'Ninguna', 'SI', 'NO', '2021-04-17 01:47:05', '2021-04-17 01:49:19'),
(6, '16-04-2021', 'V77777777', 1, 600.00, 50.00, 550.00, 550.00, 'Nada', 'SI', 'NO', '2021-04-17 01:51:33', '2021-04-17 01:52:40'),
(7, '16-04-2021', 'v66666666', 1, 200.00, 10.00, 190.00, 190.00, 'nada', 'SI', 'NO', '2021-04-17 01:55:22', '2021-04-17 01:59:44'),
(8, '16-04-2021', 'V99999999', 1, 2000.00, 30.00, 1970.00, 1970.00, 'nada', 'SI', 'NO', '2021-04-17 02:03:15', '2021-04-17 02:04:37'),
(9, '17-04-2021', 'V99999999', 1, 400.00, 5.00, 395.00, 395.00, 'Nada', 'SI', 'NO', '2021-04-17 04:06:29', '2021-04-17 04:07:19'),
(10, '17-04-2021', 'V77777777', 1, 4000.00, 200.00, 3800.00, 3800.00, 'nada', 'SI', 'NO', '2021-04-17 04:08:12', '2021-04-17 04:09:46'),
(11, '17-04-2021', 'V77777777', 1, 20.00, 2.00, 18.00, 18.00, 'G', 'SI', 'NO', '2021-04-17 04:43:32', '2021-04-17 04:44:22'),
(12, '17-04-2021', 'V99999999', 1, 120.00, 20.00, 100.00, 100.00, 'G', 'SI', 'NO', '2021-04-17 04:46:52', '2021-04-17 04:47:38'),
(13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NO', 'NO', '2021-04-17 16:11:35', '2021-04-17 16:11:35'),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NO', 'NO', '2021-04-17 16:55:29', '2021-04-17 16:55:29'),
(16, '17-04-2021', 'V77777777', 1, 200.00, 50.00, 150.00, 150.00, 'Kn', 'SI', 'NO', '2021-04-17 17:06:09', '2021-04-17 17:31:14'),
(17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NO', 'NO', '2021-04-21 18:47:32', '2021-04-21 18:47:32'),
(18, '21-04-2021', 'v99999999', 1, 5050.00, 50.00, 5000.00, 5000.00, 'nada', 'SI', 'SI', '2021-04-21 18:47:58', '2021-04-21 19:56:19'),
(19, '21-04-2021', 'V77777777', 1, 4930.00, 2.00, 4928.00, 4928.00, 'NADA', 'SI', 'SI', '2021-04-21 20:12:23', '2021-04-21 20:39:19'),
(20, '21-04-2021', 'V99999999', 1, 3000.00, 100.00, 2900.00, 2900.00, 'nada', 'SI', 'NO', '2021-04-21 21:49:32', '2021-04-21 21:50:21'),
(21, '21-04-2021', 'V77777777', 1, 3000.00, 100.00, 2900.00, 2900.00, 'nada', 'SI', 'SI', '2021-04-21 21:50:58', '2021-04-21 21:58:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2021-03-25 03:02:55', '2021-03-25 03:02:55'),
(2, 'Auditor', 'web', '2021-03-25 03:02:55', '2021-03-25 03:02:55'),
(3, 'Mantenimiento', 'web', '2021-03-25 03:02:55', '2021-03-25 03:02:55'),
(4, 'Presidencia', 'web', '2021-03-25 03:02:55', '2021-03-25 03:02:55'),
(5, 'Finanzas', 'web', '2021-03-25 03:02:55', '2021-03-25 03:02:55'),
(6, 'Logistica', 'web', '2021-03-25 03:02:55', '2021-03-25 03:02:55'),
(7, 'Administracion', 'web', '2021-03-25 03:02:55', '2021-03-25 03:02:55'),
(8, 'Almacen', 'web', '2021-03-25 03:02:55', '2021-03-25 03:02:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(2, 1),
(2, 2),
(2, 4),
(2, 5),
(3, 1),
(3, 2),
(3, 4),
(3, 5),
(4, 1),
(4, 2),
(4, 4),
(4, 5),
(4, 7),
(5, 1),
(5, 2),
(5, 4),
(5, 7),
(6, 1),
(6, 2),
(6, 4),
(6, 7),
(7, 1),
(7, 2),
(7, 4),
(7, 7),
(8, 1),
(8, 2),
(8, 4),
(8, 8),
(9, 1),
(9, 2),
(9, 4),
(9, 8),
(10, 1),
(10, 2),
(10, 4),
(10, 8),
(11, 1),
(11, 2),
(11, 4),
(11, 8),
(12, 1),
(12, 2),
(12, 3),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(16, 3),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(20, 3),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(24, 3),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(28, 3),
(29, 1),
(29, 2),
(29, 3),
(30, 1),
(30, 2),
(30, 3),
(31, 1),
(31, 2),
(31, 3),
(31, 4),
(32, 1),
(32, 2),
(32, 3),
(33, 1),
(33, 2),
(33, 3),
(34, 1),
(34, 2),
(34, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('hseeS5p6K0Q4ESfRGaoEA0xb2mqMjiy8Ti3diW9L', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', 'YToxNTp7czo2OiJfdG9rZW4iO3M6NDA6IjVaWVNWYzJCWWRmT2tVd0JXaWsyMDBaT2dYTmVtYmNqSzJEWWhRSkgiO3M6MzoidXJsIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo3NjoiaHR0cDovL3JlbWVjYS50ZXN0L2xpdmV3aXJlL3ZlbnRhcy9kZXRhbGxlbmVnb2NpYWNpb24vc3dlZXRhbGVydDIuYWxsLm1pbi5qcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRVaHpGbWZpc0k1VFRMWmpwUnVraDQuNkVhSjk2TkNPNmVaUFVlL0E2SVB1NmFYY1ZYb05iaSI7czoxMDoiY2FudGlkYWRwMSI7czo3OiIyOTAwLjAwIjtpOjA7czoxMDoidG9wcm9kYWN1bSI7aToxO2Q6NzUxNTA7czoxMDoiY2FudGlkYWRwMiI7czo3OiI2OTgwLjAwIjtzOjEwOiJ0b3Byb2RhY3VtIjtkOjI2Njc5Ljk5OTk5OTk5OTk5NjtzOjI6InB0IjtpOjA7czoyOiJwZiI7aTowO3M6NToidnBlc28iO2I6MDtzOjE0OiJ2YWxvcmNlZHVsYW5uYyI7czo5OiJ2ODg4ODg4ODgiO30=', 1619043100),
('iRN0ZZybwA8Bm5cQpGcfuPLewsxyKyTP9gSPyumt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVjJWSE14eGQwU092UXdMdkZEYjNGMHMxRXNDdUZNVkZERkpMN1ZEZSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NzoiaHR0cDovL3JlbWVjYS50ZXN0L2xpdmV3aXJlL2NvbXByYXMvbmVnb2NpYWNpb24iO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NzoiaHR0cDovL3JlbWVjYS50ZXN0L2xpdmV3aXJlL2NvbXByYXMvbmVnb2NpYWNpb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1619053559);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

DROP TABLE IF EXISTS `sucursales`;
CREATE TABLE `sucursales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idencargado` int(11) DEFAULT NULL,
  `visible` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `descripcion`, `direccion`, `telefono`, `idencargado`, `visible`, `created_at`, `updated_at`) VALUES
(1, 'san vicente', 'maracay edo aragua', NULL, NULL, NULL, '2021-03-25 03:39:28', '2021-03-25 03:39:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teams`
--

DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `team_invitations`
--

DROP TABLE IF EXISTS `team_invitations`;
CREATE TABLE `team_invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `team_user`
--

DROP TABLE IF EXISTS `team_user`;
CREATE TABLE `team_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Julio H Nuñez A', 'julion23@gmail.com', NULL, '$2y$10$UhzFmfisI5TTLZjpRukh4.6EaJ96NCO6eZPUe/A6IPu6aXcVXoNbi', NULL, NULL, 'aMKWdiIJI2DlcsTNaVj5j6ktMDsntzRNPfqL5gmITLJQcEA2tMxauhixA2J4', NULL, 'profile-photos/BYBkXlFVbR1CJS2pHEfsnba575kBOVSjDG9pEtVI.png', '2021-03-25 03:02:59', '2021-04-19 03:05:48'),
(2, 'Auditor', 'auditor@remeca.test', NULL, '$2y$10$Mix4D8Ahr53GYDa9.HjsqO4NSPJiBAqQfeO7QpgwRDw89o/WNlAHi', NULL, NULL, NULL, NULL, NULL, '2021-03-25 03:03:00', '2021-03-25 03:03:00'),
(3, 'Mantenimiento', 'mantenimiento@remeca.test', NULL, '$2y$10$XobXbgPqbGJvI342bTvu7.vyTl4j3dHVj1QiDy5B.2iF5iPpeDVAG', NULL, NULL, NULL, NULL, NULL, '2021-03-25 03:03:00', '2021-03-25 03:03:00'),
(4, 'Sr Miguel', 'miguel@remeca.test', NULL, '$2y$10$ojlsVPm6XaFB5PIvybGZre.6.8mMMsDBnjluifHq7zM1skOqsyufO', NULL, NULL, 'sLmJaTi01frVoxuDa2cosKotIfaXmkCoHWroFotooySv36EjmGDSrmgwv1Dm', NULL, NULL, '2021-03-25 03:03:00', '2021-03-25 03:03:00'),
(5, 'Sra Gusmary', 'gusmary@remeca.test', NULL, '$2y$10$kPkG2AL1O3EFqk9JXqpTsunzjncMNN2n6v0bE00S/ELQ1m2XKlKVy', NULL, NULL, NULL, NULL, NULL, '2021-03-25 03:03:00', '2021-03-25 03:03:00'),
(6, 'Sra Erika', 'erika@remeca.test', NULL, '$2y$10$obvg7x578b1KDDuo1KRbBueeqA/ivpMbpc3i/MHHSyqKEozG2QZ86', NULL, NULL, NULL, NULL, NULL, '2021-03-25 03:03:01', '2021-03-25 03:03:01'),
(7, 'Sra Katherine', 'katherine@remeca.test', NULL, '$2y$10$Up5QAmmMbCo6ZFXlb8FqtOb7McxeDmC8ZlJKLjRjY4SwSDcace5Em', NULL, NULL, 'Q8nf8JowovZzoZ7s8iRfN82zX4vsmvXpM1s6UDOmjNPNZuUOPb0IunHQcpOM', NULL, NULL, '2021-03-25 03:03:01', '2021-03-25 03:03:01'),
(8, 'Almacen', 'almacen@remeca.test', NULL, '$2y$10$VcmgFJA.Th1tWMmExmUj2e67Pnm4bUBmKwPTkQROZtlgz4QA1roSa', NULL, NULL, NULL, NULL, NULL, '2021-03-25 03:03:01', '2021-03-25 03:03:01'),
(9, 'Lic. Eva Andrés', 'ablasco@example.com', '2021-03-25 03:03:01', '$2y$10$gEAJ4JVd6HDw98hQ8DLv2O3SvJtCCoUGZP4pnF7i0ufnSS144ksWm', NULL, NULL, '9UNxuyY0Jn', NULL, NULL, '2021-03-25 03:03:05', '2021-03-25 03:03:05'),
(10, 'Inés Peralta', 'miriam.valadez@example.com', '2021-03-25 03:03:02', '$2y$10$9Uasl7IMDwNyNchS9LRj8.dGGc0bDJN3mzarIGEONyeJ6prw4iptG', NULL, NULL, '3zNjclEKDQ', NULL, NULL, '2021-03-25 03:03:05', '2021-03-25 03:03:05'),
(11, 'Verónica Román', 'marco51@example.net', '2021-03-25 03:03:02', '$2y$10$UTrbNE98fbKrvJzdJ5YlBO65O.MDMNbs7LGq6Yr7N735Y0teyLATu', NULL, NULL, 'K6UkyAXpOc', NULL, NULL, '2021-03-25 03:03:05', '2021-03-25 03:03:05'),
(12, 'Miguel Dávila', 'afierro@example.net', '2021-03-25 03:03:02', '$2y$10$f1dlYWaZSVbnY4u1nfg/8.GCS.Y95LomIMzHkxS8PoZkMlUSKFqgy', NULL, NULL, 'rDrzMftS8P', NULL, NULL, '2021-03-25 03:03:05', '2021-03-25 03:03:05'),
(13, 'Pau Herrero', 'wlucio@example.com', '2021-03-25 03:03:02', '$2y$10$hA1mKGl1gszuMg11IOHJsO4HGEIGjTsoIydBwP500X2BsBGlGGaD6', NULL, NULL, 'dF6ScuBxJC', NULL, NULL, '2021-03-25 03:03:05', '2021-03-25 03:03:05'),
(14, 'D. Fernando Aguirre', 'amparo32@example.org', '2021-03-25 03:03:02', '$2y$10$6Gdahtl/o4Lj/U0PIZm08eVRI0r9cgj8iyDJhMZFD1gJT/90e5QS6', NULL, NULL, 'yDiCCuEHSW', NULL, NULL, '2021-03-25 03:03:05', '2021-03-25 03:03:05'),
(15, 'Alejandra Curiel', 'javier.menchaca@example.net', '2021-03-25 03:03:03', '$2y$10$CuP26nVtZAb61wosIC5DmO4L07pLE3uPlOsFjfubsPUKmsDwXDxi6', NULL, NULL, 'F3TqqM06bs', NULL, NULL, '2021-03-25 03:03:05', '2021-03-25 03:03:05'),
(16, 'Abril De Anda', 'ines86@example.org', '2021-03-25 03:03:03', '$2y$10$pR65hTKjhmvekoYeVp9RjufC0xbKB8AGAqOtXzmpUzA/UaPRDJQZK', NULL, NULL, 'oWCquf5x2u', NULL, NULL, '2021-03-25 03:03:05', '2021-03-25 03:03:05'),
(17, 'Francisco Javier Aguado', 'vasquez.jordi@example.com', '2021-03-25 03:03:03', '$2y$10$yEyHY5Vwu5fXFLBya2Vph.icNXHUtPfKe1zOjhtzH5EhnXJwnT4Rm', NULL, NULL, 'DA9cxuksjk', NULL, NULL, '2021-03-25 03:03:05', '2021-03-25 03:03:05'),
(18, 'Dr. Jordi Patiño Hijo', 'umarcos@example.com', '2021-03-25 03:03:03', '$2y$10$RgpTjZlNrcECNw5nVihu/OK2JYFEJpcnrqE1an4m/MKqxgNwqFAb.', NULL, NULL, 'LfWUnUsGEd', NULL, NULL, '2021-03-25 03:03:05', '2021-03-25 03:03:05'),
(19, 'Nahia Martí Tercero', 'carla.guevara@example.net', '2021-03-25 03:03:03', '$2y$10$45XPON0Uj6Z8HAJNKSDN7e0jcwD7cvr61rhEm3RRiCbMp.zVQiv8q', NULL, NULL, 'xbBWVs8CbA', NULL, NULL, '2021-03-25 03:03:05', '2021-03-25 03:03:05'),
(20, 'Sr. Erik Campos Tercero', 'bruno10@example.net', '2021-03-25 03:03:04', '$2y$10$TU848Hx3Z5Yg5QBmtQjigeNkhGXS7QM.ZJlS7QhL3nnEGWrsoQL7q', NULL, NULL, 'ZEhJMXvFFi', NULL, NULL, '2021-03-25 03:03:05', '2021-03-25 03:03:05'),
(21, 'Elsa Zapata Tercero', 'luis02@example.com', '2021-03-25 03:03:04', '$2y$10$Ls.kLPQwGFnbkq6/XoxpCOlOOZWd0JApfirf9bR0sR3.1RuN/Qd.S', NULL, NULL, 'kzLwc9ums4', NULL, NULL, '2021-03-25 03:03:05', '2021-03-25 03:03:05'),
(22, 'Dr. Mara Cepeda Segundo', 'btapia@example.com', '2021-03-25 03:03:04', '$2y$10$e0hTkyGyviwNlHHuOZfxX.Vk01fruB1I1/ieHjKM01Y45a9LdcDO6', NULL, NULL, 'YnL7WvuCqn', NULL, NULL, '2021-03-25 03:03:05', '2021-03-25 03:03:05'),
(23, 'Sra. Ana Isabel Juárez Segundo', 'kroig@example.net', '2021-03-25 03:03:04', '$2y$10$NezUVmo670Jld6UH1qot8OxJvQRFyiyZvDdjWnoll7g5a.0Tw0A3K', NULL, NULL, 'nXwVJbhT6U', NULL, NULL, '2021-03-25 03:03:05', '2021-03-25 03:03:05'),
(24, 'Mario Alanis', 'ivan.garay@example.net', '2021-03-25 03:03:04', '$2y$10$f1k8EeKb/UI3eUyGg3ofAOdVvcIH64FonFlJ79wbxoMb1CHwvoTW6', NULL, NULL, 'VctiiHo6uQ', NULL, NULL, '2021-03-25 03:03:05', '2021-03-25 03:03:05'),
(25, 'María Dolores Jasso', 'sepulveda.adam@example.net', '2021-03-25 03:03:05', '$2y$10$GQxRNBU64YQgofRNL9LYseVk34xN6VPiJyLIMoovNd.Ezs.8DvnJC', NULL, NULL, 'EIdnv6SIcw', NULL, NULL, '2021-03-25 03:03:05', '2021-03-25 03:03:05'),
(26, 'Omar Bustamante', 'olopez@example.net', '2021-03-25 03:03:05', '$2y$10$pjlUG3miewS.EWR4VRlVxOob82duuk5A7SewKba.LjOjVc5OUGQne', NULL, NULL, 'DOzB6GPTkh', NULL, NULL, '2021-03-25 03:03:06', '2021-03-25 03:03:06'),
(27, 'Alex Roldán', 'biel.marrero@example.net', '2021-03-25 03:03:05', '$2y$10$tueoJ4m.1n/cfeZlJ5MIh.FtiTpPyV1.Bc3P5tkt1sknf/WG8qQ3G', NULL, NULL, 'L10ZS4B0hj', NULL, NULL, '2021-03-25 03:03:06', '2021-03-25 03:03:06'),
(28, 'Alberto Téllez', 'ona.simon@example.com', '2021-03-25 03:03:05', '$2y$10$eINJhzCx16FE.Fs4FnaeW.8FBsV6.Dtr8tTE/Hbd8wrmGntPzxGV6', NULL, NULL, '1iugi7VqpF', NULL, NULL, '2021-03-25 03:03:06', '2021-03-25 03:03:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE `ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fechaventa` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horaventa` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cedulav` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idlugarv` int(11) DEFAULT NULL,
  `idestatuspagov` int(11) DEFAULT NULL,
  `idtipopagov` int(11) DEFAULT NULL,
  `efectivo` double(102,2) DEFAULT NULL,
  `transferencia` double(102,2) DEFAULT NULL,
  `idtipoabonov` int(11) DEFAULT NULL,
  `negociacion_id` bigint(20) DEFAULT NULL,
  `placa` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalcomrav` double(102,2) DEFAULT NULL,
  `totalpagadov` double(102,2) DEFAULT NULL,
  `diferenciapagov` double(102,2) DEFAULT NULL,
  `ajusteporpesov` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observacionesv` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `despachado` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iddespacho` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fechaventa`, `horaventa`, `cedulav`, `idlugarv`, `idestatuspagov`, `idtipopagov`, `efectivo`, `transferencia`, `idtipoabonov`, `negociacion_id`, `placa`, `totalcomrav`, `totalpagadov`, `diferenciapagov`, `ajusteporpesov`, `observacionesv`, `despachado`, `iddespacho`, `created_at`, `updated_at`) VALUES
(1053, '15-04-2021', NULL, 'v33333333', NULL, 2, 2, NULL, NULL, 3, 1, NULL, 1700.00, 700.00, 1000.00, NULL, 'FACTURADO DESDE LA NEGOCIACION. a', 'NO', NULL, NULL, NULL),
(1054, '16-04-2021', '09:27:03', 'V44444444', 1, 1, 1, 200.00, 1500.00, 3, NULL, NULL, 1700.00, 1700.00, 0.00, NULL, 'NINGUNA', 'NO', NULL, '2021-04-16 13:25:19', '2021-04-16 13:27:03'),
(1055, '16-04-2021', '09:29:49', 'V55555555', 1, 2, 2, 0.00, 0.00, 0, NULL, NULL, 700.00, 0.00, 700.00, NULL, 'NINGUNA', 'NO', NULL, '2021-04-16 13:28:19', '2021-04-16 13:29:49'),
(1056, '16-04-2021', '09:40:55', 'V22222222', 1, 2, 2, 0.00, 0.00, 0, NULL, NULL, 300.00, 0.00, 300.00, NULL, 'NINGUNA', 'NO', NULL, '2021-04-16 13:39:45', '2021-04-16 13:40:55'),
(1057, '16-04-2021', '09:44:50', 'V22222222', 1, 2, 2, 0.00, 0.00, 0, NULL, NULL, 250.00, 0.00, 250.00, NULL, 'NINGUNA', 'NO', NULL, '2021-04-16 13:43:46', '2021-04-16 13:44:50'),
(1058, '16-04-2021', '09:57:00', 'V11111111', 1, 2, 2, 50.00, 100.00, 3, NULL, NULL, 450.00, 150.00, 450.00, NULL, 'NINGUNA', 'NO', NULL, '2021-04-16 13:56:11', '2021-04-16 13:57:00'),
(1059, '16-04-2021', '10:04:05', 'V11111111', 1, 2, 2, 5.00, 5.00, 3, NULL, NULL, 80.00, 10.00, 80.00, NULL, 'NINGUNA', 'NO', NULL, '2021-04-16 14:01:53', '2021-04-16 14:04:05'),
(1060, '16-04-2021', '10:16:34', 'v11111111', 1, 2, 2, 0.00, 0.00, 0, NULL, NULL, 100.00, 0.00, 100.00, NULL, 'NINGUNA', 'NO', NULL, '2021-04-16 14:15:56', '2021-04-16 14:16:34'),
(1061, '16-04-2021', '10:19:56', 'v55555555', 1, 2, 2, 15.00, 15.00, 3, NULL, NULL, 200.00, 30.00, 200.00, NULL, 'NINGUNA', 'NO', NULL, '2021-04-16 14:19:04', '2021-04-16 14:19:56'),
(1062, '16-04-2021', NULL, 'v55555555', NULL, 2, 2, NULL, NULL, 3, 2, NULL, 6000.00, 1500.00, 4500.00, NULL, 'FACTURADO DESDE LA NEGOCIACION. ninguna', 'NO', NULL, NULL, NULL),
(1063, '16-04-2021', NULL, 'v33333333', NULL, 2, 2, NULL, NULL, 1, 3, NULL, 12000.00, 70.00, 11930.00, NULL, 'FACTURADO DESDE LA NEGOCIACION. nada', 'NO', NULL, NULL, NULL),
(1064, '16-04-2021', '15:07:36', 'v33333333', 1, 1, 1, 50.00, 50.00, 3, NULL, NULL, 100.00, 100.00, 0.00, NULL, 'nnnnn', 'NO', NULL, '2021-04-16 19:05:46', '2021-04-16 19:07:36'),
(1065, '16-04-2021', '15:10:21', 'v33333333', 1, 2, 2, 0.00, 92.66, 2, NULL, NULL, 492.66, 92.66, 492.66, NULL, 'nnnnn', 'NO', NULL, '2021-04-16 19:08:50', '2021-04-16 19:10:21'),
(1066, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NO', NULL, '2021-04-16 19:21:35', '2021-04-16 19:21:35'),
(1067, '16-04-2021', NULL, 'v11111111', NULL, 2, 2, NULL, NULL, 1, 4, NULL, 24000.00, 20000.00, 4000.00, NULL, 'FACTURADO DESDE LA NEGOCIACION. abonaron 20000 menos comision por cambio', 'NO', NULL, NULL, NULL),
(1068, '17-04-2021', '14:56:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NO', NULL, '2021-04-17 18:56:20', '2021-04-17 18:56:20'),
(1069, '17-04-2021', '14:57:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NO', NULL, '2021-04-17 18:57:38', '2021-04-17 18:57:38'),
(1070, '17-04-2021', '14:59:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NO', NULL, '2021-04-17 18:59:05', '2021-04-17 18:59:05'),
(1071, '17-04-2021', '18:24:10', 'v33333333', 1, 1, 1, 10.00, 5.00, 3, NULL, NULL, 0.00, 15.00, 0.00, NULL, 'L', 'NO', NULL, '2021-04-17 22:13:28', '2021-04-17 22:24:10'),
(1072, '17-04-2021', '18:44:49', 'v33333333', 1, 1, 1, 30.00, 6.00, 3, NULL, NULL, 36.00, 36.00, 0.00, NULL, 's', 'NO', NULL, '2021-04-17 22:26:09', '2021-04-17 22:44:49'),
(1073, '17-04-2021', '18:46:29', 'v33333333', 1, 2, 2, 0.00, 0.00, 0, NULL, NULL, 42.00, 0.00, 42.00, NULL, 'l', 'NO', NULL, '2021-04-17 22:45:26', '2021-04-17 22:46:29'),
(1074, '17-04-2021', NULL, 'V33333333', NULL, 2, 2, NULL, NULL, 0, 8, NULL, 777.00, 0.00, 777.00, NULL, 'FACTURADO DESDE LA NEGOCIACION. K', 'NO', NULL, NULL, NULL),
(1075, '17-04-2021', NULL, 'V33333333', NULL, 2, 2, NULL, NULL, 0, 9, NULL, 8.00, 0.00, 8.00, NULL, 'FACTURADO DESDE LA NEGOCIACION. J', 'NO', NULL, NULL, NULL),
(1076, '17-04-2021', NULL, 'v33333333', NULL, 2, 2, NULL, NULL, 0, 10, NULL, 100.00, 0.00, 100.00, NULL, 'FACTURADO DESDE LA NEGOCIACION. jj', 'NO', NULL, NULL, NULL),
(1077, '19-04-2021', '19:29:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NO', NULL, '2021-04-19 23:29:21', '2021-04-19 23:29:21'),
(1078, '20-04-2021', NULL, 'v33333333', NULL, 1, 1, NULL, NULL, 1, 12, NULL, 36000.00, 36000.00, 0.00, NULL, 'FACTURADO DESDE LA NEGOCIACION. vv', 'NO', NULL, NULL, NULL),
(1079, '21-04-2021', '00:14:12', 'v33333333', 1, 2, 2, 0.00, 0.00, 0, NULL, NULL, 474.00, 0.00, 474.00, NULL, 'nada', 'NO', NULL, '2021-04-21 04:13:25', '2021-04-21 04:14:12');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_abono_negociacion_compra`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_abono_negociacion_compra`;
CREATE TABLE `vista_abono_negociacion_compra` (
`negociacion` bigint(20) unsigned
,`recepcion` bigint(11)
,`fecha` timestamp
,`id` bigint(20) unsigned
,`material` varchar(100)
,`abono` double(8,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_abono_negociacion_venta`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_abono_negociacion_venta`;
CREATE TABLE `vista_abono_negociacion_venta` (
`negociacion` bigint(20) unsigned
,`despacho` bigint(11)
,`fecha` timestamp
,`id` bigint(20) unsigned
,`material` varchar(100)
,`abono` double(8,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_amortizaciones`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_amortizaciones`;
CREATE TABLE `vista_amortizaciones` (
`cedula` varchar(15)
,`id` bigint(20) unsigned
,`negociacion` bigint(20) unsigned
,`factura` bigint(20)
,`fecha` varchar(10)
,`hora` varchar(10)
,`efectivo` double(102,2)
,`transferencia` double(102,2)
,`pago` double(102,2)
,`total` double(102,2)
,`monto` double(102,2)
,`totalresta` double(102,2)
,`resta` double(102,2)
,`finalizada` varchar(2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_amortizaciones_compras`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_amortizaciones_compras`;
CREATE TABLE `vista_amortizaciones_compras` (
`cedula` varchar(15)
,`id` bigint(20) unsigned
,`negociacion` bigint(20) unsigned
,`factura` bigint(20)
,`fecha` varchar(10)
,`hora` varchar(10)
,`efectivo` double(102,2)
,`transferencia` double(102,2)
,`pago` double(102,2)
,`total` double(102,2)
,`monto` double(102,2)
,`totalresta` double(102,2)
,`resta` double(102,2)
,`finalizada` varchar(2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_amortizacion_negociacion_compra`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_amortizacion_negociacion_compra`;
CREATE TABLE `vista_amortizacion_negociacion_compra` (
`negociacion` bigint(20)
,`factura` bigint(20) unsigned
,`fecha` varchar(10)
,`hora` varchar(10)
,`efectivo` double(102,2)
,`transferencia` double(102,2)
,`pago` double(102,2)
,`monto` double(102,2)
,`total` double(102,2)
,`totalresta` double(102,2)
,`resta` double(102,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_amortizacion_negociacion_venta`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_amortizacion_negociacion_venta`;
CREATE TABLE `vista_amortizacion_negociacion_venta` (
`negociacion` bigint(20)
,`factura` bigint(20) unsigned
,`fecha` varchar(10)
,`hora` varchar(10)
,`efectivo` double(102,2)
,`transferencia` double(102,2)
,`pago` double(102,2)
,`monto` double(102,2)
,`total` double(102,2)
,`totalresta` double(102,2)
,`resta` double(102,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_cantidad_productos_pagar`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_cantidad_productos_pagar`;
CREATE TABLE `vista_cantidad_productos_pagar` (
`id` bigint(20) unsigned
,`producto` varchar(100)
,`debe` double(19,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_cpc_cedula_nombre_monto`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_cpc_cedula_nombre_monto`;
CREATE TABLE `vista_cpc_cedula_nombre_monto` (
`cedula` varchar(15)
,`nombre` varchar(100)
,`monto` double(19,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_cpp_cedula_nombre_monto`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_cpp_cedula_nombre_monto`;
CREATE TABLE `vista_cpp_cedula_nombre_monto` (
`cedula` varchar(15)
,`nombre` varchar(100)
,`monto` double(19,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_despacho_abono_material_negociacion_ventas`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_despacho_abono_material_negociacion_ventas`;
CREATE TABLE `vista_despacho_abono_material_negociacion_ventas` (
`despacho` bigint(11)
,`cedula` varchar(15)
,`nombre` varchar(100)
,`observaciones` varchar(250)
,`material` varchar(100)
,`cantidad` double(8,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_despacho_ventas`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_despacho_ventas`;
CREATE TABLE `vista_despacho_ventas` (
`despacho` bigint(20)
,`cedula` varchar(15)
,`nombre` varchar(100)
,`observaciones` varchar(250)
,`material` varchar(100)
,`cantidad` double(12,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_inventario`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_inventario`;
CREATE TABLE `vista_inventario` (
`id` bigint(20) unsigned
,`fecha` varchar(10)
,`hora` varchar(10)
,`idproducto` bigint(20) unsigned
,`descripcion` varchar(100)
,`comprados` int(11)
,`vendidos` int(11)
,`existencia` int(11)
,`cantidad` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_neg_com_monto_por_pagar`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_neg_com_monto_por_pagar`;
CREATE TABLE `vista_neg_com_monto_por_pagar` (
`cedula` varchar(15)
,`nombre` varchar(100)
,`monto` double(19,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_neg_ven_monto_por_cobrar`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_neg_ven_monto_por_cobrar`;
CREATE TABLE `vista_neg_ven_monto_por_cobrar` (
`cedula` varchar(15)
,`nombre` varchar(100)
,`monto` double(19,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_precio_prod_cedu`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_precio_prod_cedu`;
CREATE TABLE `vista_precio_prod_cedu` (
`idprecio` bigint(20)
,`cedula` varchar(15)
,`idproducto` bigint(20)
,`descripcion` varchar(100)
,`precio` double(12,2)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_ccategoriaproducto`
--

DROP TABLE IF EXISTS `_ccategoriaproducto`;
CREATE TABLE `_ccategoriaproducto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_ccompras`
--

DROP TABLE IF EXISTS `_ccompras`;
CREATE TABLE `_ccompras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idrecepcion` bigint(20) NOT NULL,
  `fecharecepcion` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechacompra` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cedula` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idlugar` int(11) DEFAULT NULL,
  `idestatuspago` int(11) DEFAULT NULL,
  `idtipopago` int(11) DEFAULT NULL,
  `efectivo` double(102,2) DEFAULT NULL,
  `transferencia` double(102,2) DEFAULT NULL,
  `idtipoabonov` int(11) DEFAULT NULL,
  `negociacion_id` bigint(20) DEFAULT NULL,
  `totalcomra` double(102,2) DEFAULT NULL,
  `totalpagado` double(102,2) DEFAULT NULL,
  `diferenciapago` double(102,2) DEFAULT NULL,
  `observacionesc` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `_ccompras`
--

INSERT INTO `_ccompras` (`id`, `idrecepcion`, `fecharecepcion`, `fechacompra`, `hora`, `cedula`, `idlugar`, `idestatuspago`, `idtipopago`, `efectivo`, `transferencia`, `idtipoabonov`, `negociacion_id`, `totalcomra`, `totalpagado`, `diferenciapago`, `observacionesc`, `created_at`, `updated_at`) VALUES
(1, 1, '16-04-2021', '16-04-2021', '15:30:12', 'V99999999', 1, 1, 1, NULL, NULL, NULL, NULL, 500.00, 500.00, 0.00, 'nada', '2021-04-16 19:28:20', '2021-04-16 19:30:12'),
(2, 3, '16-04-2021', '16-04-2021', '15:43:39', 'v66666666', 1, 2, 2, NULL, NULL, NULL, NULL, 780.00, 80.00, 700.00, 'kkk', '2021-04-16 19:37:53', '2021-04-16 19:43:39'),
(3, 2, '16-04-2021', NULL, NULL, 'V77777777', 1, 1, 1, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 'NINGUNA', '2021-04-16 21:02:22', '2021-04-16 21:02:22'),
(4, 2, '16-04-2021', NULL, NULL, 'V77777777', 1, 1, 1, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 'NINGUNA', '2021-04-21 15:55:28', '2021-04-21 15:55:28'),
(5, 2, '16-04-2021', NULL, NULL, 'V77777777', 1, 1, 1, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 'NINGUNA', '2021-04-21 16:27:43', '2021-04-21 16:27:43'),
(6, 2, '16-04-2021', NULL, NULL, 'V77777777', 1, 1, 1, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 'NINGUNA', '2021-04-21 16:30:46', '2021-04-21 16:30:46'),
(7, 2, '16-04-2021', NULL, NULL, 'V77777777', 1, 1, 1, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 'NINGUNA', '2021-04-21 16:31:16', '2021-04-21 16:31:16'),
(8, 2, '16-04-2021', NULL, NULL, 'V77777777', 1, 1, 1, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 'NINGUNA', '2021-04-21 16:31:59', '2021-04-21 16:31:59'),
(9, 2, '16-04-2021', NULL, NULL, 'V77777777', 1, 1, 1, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 'NINGUNA', '2021-04-21 16:36:38', '2021-04-21 16:36:38'),
(10, 2, '16-04-2021', NULL, NULL, 'V77777777', 1, 1, 1, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 'NINGUNA', '2021-04-21 16:42:25', '2021-04-21 16:42:25'),
(11, 2, '16-04-2021', NULL, NULL, 'V77777777', 1, 1, 1, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 'NINGUNA', '2021-04-21 16:44:09', '2021-04-21 16:44:09'),
(12, 2, '16-04-2021', NULL, NULL, 'V77777777', 1, 1, 1, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 'NINGUNA', '2021-04-21 16:47:34', '2021-04-21 16:47:34'),
(13, 2, '16-04-2021', NULL, NULL, 'V77777777', 1, 1, 1, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 'NINGUNA', '2021-04-21 16:48:37', '2021-04-21 16:48:37'),
(14, 18, '21-04-2021', NULL, NULL, 'v99999999', 1, 1, 1, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 'NINGUNA', '2021-04-21 19:02:21', '2021-04-21 19:02:21'),
(15, 18, '21-04-2021', '21-04-2021', '15:35:17', 'v99999999', 1, 1, 1, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, NULL, '2021-04-21 19:23:17', '2021-04-21 19:35:17'),
(16, 18, '21-04-2021', '21-04-2021', '15:44:01', 'v99999999', 1, 0, 0, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, NULL, '2021-04-21 19:43:17', '2021-04-21 19:44:01'),
(17, 18, '21-04-2021', '21-04-2021', '15:56:19', 'v99999999', 1, 1, 1, 46081.34, 918.66, NULL, NULL, 47000.00, 47000.00, 0.00, 'DE CONTADO', '2021-04-21 19:55:39', '2021-04-21 19:56:19'),
(18, 19, '21-04-2021', '21-04-2021', '16:52:18', 'V77777777', 1, 2, 2, 500.00, 500.00, NULL, NULL, 34988.80, 1000.00, 33988.80, 'A CREDITO', '2021-04-21 20:38:17', '2021-04-21 20:52:18'),
(19, 21, '21-04-2021', '21-04-2021', '17:58:57', 'V77777777', 1, 2, 2, 16000.00, 2000.00, NULL, NULL, 20880.00, 18000.00, 2880.00, 'credito', '2021-04-21 21:53:10', '2021-04-21 21:58:57');

--
-- Disparadores `_ccompras`
--
DROP TRIGGER IF EXISTS `Update_en_Compras_Pago_Contado`;
DELIMITER $$
CREATE TRIGGER `Update_en_Compras_Pago_Contado` AFTER UPDATE ON `_ccompras` FOR EACH ROW BEGIN
-- IF NEW.idtipopago = 1 THEN
SET @ed = (SELECT efectivo FROM liquidez WHERE id = 1);
SET @bd = (SELECT banco FROM liquidez WHERE id = 1);
SET @ne = @ed - NEW.efectivo;
SET @nb = @bd - NEW.transferencia;
UPDATE liquidez SET efectivo = @ne, banco = @nb WHERE id = 1;
-- END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_ddetallecompras`
--

DROP TABLE IF EXISTS `_ddetallecompras`;
CREATE TABLE `_ddetallecompras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idcompra` bigint(20) UNSIGNED NOT NULL,
  `idproducto` bigint(20) UNSIGNED NOT NULL,
  `cantidadpro` double(12,2) NOT NULL,
  `operacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preciopro` double(12,2) DEFAULT NULL,
  `totalpro` double(102,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `_ddetallecompras`
--

INSERT INTO `_ddetallecompras` (`id`, `idcompra`, `idproducto`, `cantidadpro`, `operacion`, `preciopro`, `totalpro`, `created_at`, `updated_at`) VALUES
(29, 1, 3, 100.00, 'SUMA', 3.00, 300.00, '2021-04-16 19:30:12', '2021-04-16 19:30:12'),
(30, 1, 4, 50.00, 'SUMA', 4.00, 200.00, '2021-04-16 19:30:12', '2021-04-16 19:30:12'),
(31, 2, 2, 290.00, 'SUMA', 0.00, 0.00, '2021-04-16 19:43:39', '2021-04-16 19:43:39'),
(32, 2, 1, 5.00, 'RESTA', 0.00, 0.00, '2021-04-16 19:43:39', '2021-04-16 19:43:39'),
(33, 15, 5, 5000.00, 'SUMA', 0.00, 0.00, '2021-04-21 19:35:17', '2021-04-21 19:35:17'),
(34, 16, 5, 5000.00, 'SUMA', 0.00, 0.00, '2021-04-21 19:44:01', '2021-04-21 19:44:01'),
(35, 17, 5, 5000.00, 'SUMA', 0.00, 0.00, '2021-04-21 19:56:19', '2021-04-21 19:56:19'),
(37, 18, 2, 4928.00, 'SUMA', 0.00, 0.00, '2021-04-21 20:39:19', '2021-04-21 20:39:19'),
(38, 18, 2, 4928.00, 'SUMA', 0.00, 0.00, '2021-04-21 20:46:52', '2021-04-21 20:46:52'),
(39, 18, 2, 4928.00, 'SUMA', 0.00, 0.00, '2021-04-21 20:52:18', '2021-04-21 20:52:18'),
(40, 19, 3, 2900.00, 'SUMA', 0.00, 0.00, '2021-04-21 21:58:57', '2021-04-21 21:58:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_iinventario`
--

DROP TABLE IF EXISTS `_iinventario`;
CREATE TABLE `_iinventario` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idproducto` int(11) NOT NULL,
  `comprados` int(11) DEFAULT NULL,
  `vendidos` int(11) DEFAULT NULL,
  `existencia` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `_iinventario`
--

INSERT INTO `_iinventario` (`id`, `fecha`, `hora`, `idproducto`, `comprados`, `vendidos`, `existencia`, `created_at`, `updated_at`) VALUES
(62, '13-04-2021', '09:19:58', 1, 0, 0, 0, '2021-04-13 13:19:58', '2021-04-13 13:19:58'),
(63, '13-04-2021', '09:20:33', 2, 0, 0, 1000, '2021-04-13 13:20:33', '2021-04-13 13:20:33'),
(64, '13-04-2021', '09:20:51', 3, 0, 0, 1000, '2021-04-13 13:20:51', '2021-04-13 13:20:51'),
(65, '13-04-2021', '09:20:58', 4, 0, 0, 1000, '2021-04-13 13:20:58', '2021-04-13 13:20:58'),
(66, '13-04-2021', '09:21:04', 5, 0, 0, 1000, '2021-04-13 13:21:04', '2021-04-13 13:21:04'),
(67, '13-04-2021', '09:21:10', 6, 0, 0, 1000, '2021-04-13 13:21:10', '2021-04-13 13:21:10'),
(69, '13-04-2021', '09:37:39', 7, 0, 0, 1000, '2021-04-13 13:37:39', '2021-04-13 13:37:39'),
(82, '16-04-2021', '09:27:03', 2, 0, 100, 1000, '2021-04-16 13:27:03', '2021-04-16 13:27:03'),
(83, '16-04-2021', '09:27:03', 3, 0, 500, 1000, '2021-04-16 13:27:03', '2021-04-16 13:27:03'),
(84, '16-04-2021', '09:29:49', 4, 0, 200, 1000, '2021-04-16 13:29:49', '2021-04-16 13:29:49'),
(85, '16-04-2021', '09:29:49', 5, 0, 300, 1000, '2021-04-16 13:29:49', '2021-04-16 13:29:49'),
(86, '16-04-2021', '09:40:55', 6, 0, 10, 1000, '2021-04-16 13:40:55', '2021-04-16 13:40:55'),
(87, '16-04-2021', '09:44:50', 7, 0, 50, 1000, '2021-04-16 13:44:50', '2021-04-16 13:44:50'),
(88, '16-04-2021', '09:57:00', 7, 0, 150, 950, '2021-04-16 13:57:00', '2021-04-16 13:57:00'),
(89, '16-04-2021', '10:04:05', 6, 0, 40, 990, '2021-04-16 14:04:05', '2021-04-16 14:04:05'),
(90, '16-04-2021', '10:16:34', 4, 0, 50, 800, '2021-04-16 14:16:34', '2021-04-16 14:16:34'),
(91, '16-04-2021', '10:19:56', 7, 0, 100, 800, '2021-04-16 14:19:56', '2021-04-16 14:19:56'),
(92, '16-04-2021', '13:03:33', 7, 0, 100, 700, '2021-04-16 17:03:33', '2021-04-16 17:03:33'),
(93, '16-04-2021', '13:03:33', 7, 0, 200, 600, '2021-04-16 17:03:33', '2021-04-16 17:03:33'),
(94, '16-04-2021', '13:51:53', 4, 0, 50, 750, '2021-04-16 17:51:53', '2021-04-16 17:51:53'),
(95, '16-04-2021', '13:51:53', 5, 0, 50, 700, '2021-04-16 17:51:53', '2021-04-16 17:51:53'),
(96, '16-04-2021', '15:07:36', 6, 0, 50, 950, '2021-04-16 19:07:36', '2021-04-16 19:07:36'),
(97, '16-04-2021', '15:10:21', 6, 0, 401, 900, '2021-04-16 19:10:22', '2021-04-16 19:10:22'),
(98, '16-04-2021', '15:14:34', 4, 0, 50, 700, '2021-04-16 19:14:34', '2021-04-16 19:14:34'),
(99, '16-04-2021', '15:14:34', 5, 0, 50, 650, '2021-04-16 19:14:34', '2021-04-16 19:14:34'),
(100, '16-04-2021', '15:14:34', 4, 0, 50, 650, '2021-04-16 19:14:34', '2021-04-16 19:14:34'),
(101, '16-04-2021', '15:30:12', 3, 100, 0, 500, '2021-04-16 19:30:12', '2021-04-16 19:30:12'),
(102, '16-04-2021', '15:30:12', 4, 50, 0, 600, '2021-04-16 19:30:12', '2021-04-16 19:30:12'),
(103, '16-04-2021', '15:43:39', 2, 290, 0, 900, '2021-04-16 19:43:39', '2021-04-16 19:43:39'),
(104, '16-04-2021', '15:43:39', 1, 5, 0, 0, '2021-04-16 19:43:39', '2021-04-16 19:43:39'),
(105, '16-04-2021', '16:03:25', 2, 0, 1000, 1190, '2021-04-16 20:03:25', '2021-04-16 20:03:25'),
(106, '17-04-2021', '18:21:34', 3, 0, 5, 600, '2021-04-17 22:21:34', '2021-04-17 22:21:34'),
(107, '17-04-2021', '18:22:54', 3, 0, 5, 595, '2021-04-17 22:22:54', '2021-04-17 22:22:54'),
(108, '17-04-2021', '18:24:10', 3, 0, 5, 590, '2021-04-17 22:24:10', '2021-04-17 22:24:10'),
(109, '17-04-2021', '18:44:49', 2, 0, 12, 190, '2021-04-17 22:44:49', '2021-04-17 22:44:49'),
(110, '17-04-2021', '18:46:29', 2, 0, 6, 178, '2021-04-17 22:46:29', '2021-04-17 22:46:29'),
(111, '18-04-2021', '12:12:51', 4, 0, 50, 650, '2021-04-18 16:12:51', '2021-04-18 16:12:51'),
(112, '18-04-2021', '12:12:51', 5, 0, 50, 600, '2021-04-18 16:12:51', '2021-04-18 16:12:51'),
(113, '18-04-2021', '12:12:51', 4, 0, 50, 600, '2021-04-18 16:12:51', '2021-04-18 16:12:51'),
(114, '18-04-2021', '12:12:51', 5, 0, 8, 550, '2021-04-18 16:12:51', '2021-04-18 16:12:51'),
(115, '18-04-2021', '13:00:46', 2, 0, 1000, 172, '2021-04-18 17:00:46', '2021-04-18 17:00:46'),
(116, '18-04-2021', '13:00:46', 2, 0, 100, -828, '2021-04-18 17:00:46', '2021-04-18 17:00:46'),
(117, '21-04-2021', '00:14:12', 3, 0, 158, 585, '2021-04-21 04:14:12', '2021-04-21 04:14:12'),
(118, '21-04-2021', '15:35:17', 5, 5000, 0, 542, '2021-04-21 19:35:17', '2021-04-21 19:35:17'),
(119, '21-04-2021', '15:44:01', 5, 5000, 0, 5542, '2021-04-21 19:44:01', '2021-04-21 19:44:01'),
(120, '21-04-2021', '15:56:19', 5, 5000, 0, 10542, '2021-04-21 19:56:19', '2021-04-21 19:56:19'),
(121, '21-04-2021', '16:22:07', 2, 4928, 0, -928, '2021-04-21 20:22:07', '2021-04-21 20:22:07'),
(122, '21-04-2021', '16:39:19', 2, 4928, 0, 4000, '2021-04-21 20:39:19', '2021-04-21 20:39:19'),
(123, '21-04-2021', '16:46:52', 2, 4928, 0, 8928, '2021-04-21 20:46:52', '2021-04-21 20:46:52'),
(124, '21-04-2021', '16:52:18', 2, 4928, 0, 13856, '2021-04-21 20:52:18', '2021-04-21 20:52:18'),
(125, '21-04-2021', '17:58:57', 3, 2900, 0, 427, '2021-04-21 21:58:57', '2021-04-21 21:58:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_pproductos`
--

DROP TABLE IF EXISTS `_pproductos`;
CREATE TABLE `_pproductos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idcate` int(11) DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(8,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `visiblecom` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibleven` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `_pproductos`
--

INSERT INTO `_pproductos` (`id`, `idcate`, `descripcion`, `precio`, `cantidad`, `visiblecom`, `visibleven`, `created_at`, `updated_at`) VALUES
(1, 1, 'DESCARTE', '0.00', 5, NULL, NULL, '2021-03-25 04:02:54', '2021-04-16 19:43:39'),
(2, 1, 'R', '2.00', 18784, NULL, NULL, '2021-03-25 04:03:35', '2021-04-21 20:52:18'),
(3, 1, 'A', '3.00', 3327, NULL, NULL, '2021-03-25 04:03:50', '2021-04-21 21:58:57'),
(4, 1, 'P', '4.00', 550, NULL, NULL, '2021-03-25 04:04:07', '2021-04-18 16:12:51'),
(5, 1, 'RL', '5.00', 15542, NULL, NULL, '2021-03-25 04:04:28', '2021-04-21 19:56:19'),
(6, 1, 'RAC', '6.00', 499, NULL, NULL, '2021-03-25 04:04:43', '2021-04-16 19:10:22'),
(7, 1, 'ALUM', '7.00', 400, NULL, NULL, '2021-03-29 14:16:07', '2021-04-16 17:03:33');

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_abono_negociacion_compra`
--
DROP TABLE IF EXISTS `vista_abono_negociacion_compra`;

DROP VIEW IF EXISTS `vista_abono_negociacion_compra`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_abono_negociacion_compra`  AS SELECT `abono_material_negociacion_compras`.`negociacion_id` AS `negociacion`, `abono_material_negociacion_compras`.`idrecepcion` AS `recepcion`, `abono_material_negociacion_compras`.`created_at` AS `fecha`, `abono_material_negociacion_compras`.`id` AS `id`, `_pproductos`.`descripcion` AS `material`, `abono_material_negociacion_compras`.`cantidadpron` AS `abono` FROM (`abono_material_negociacion_compras` join `_pproductos` on(`_pproductos`.`id` = `abono_material_negociacion_compras`.`idproducton`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_abono_negociacion_venta`
--
DROP TABLE IF EXISTS `vista_abono_negociacion_venta`;

DROP VIEW IF EXISTS `vista_abono_negociacion_venta`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_abono_negociacion_venta`  AS SELECT `abono_material_negociacion_ventas`.`negociacion_id` AS `negociacion`, `abono_material_negociacion_ventas`.`iddespacho` AS `despacho`, `abono_material_negociacion_ventas`.`created_at` AS `fecha`, `abono_material_negociacion_ventas`.`id` AS `id`, `_pproductos`.`descripcion` AS `material`, `abono_material_negociacion_ventas`.`cantidadpron` AS `abono` FROM (`abono_material_negociacion_ventas` join `_pproductos` on(`_pproductos`.`id` = `abono_material_negociacion_ventas`.`idproducton`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_amortizaciones`
--
DROP TABLE IF EXISTS `vista_amortizaciones`;

DROP VIEW IF EXISTS `vista_amortizaciones`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_amortizaciones`  AS SELECT `cuentas_por_cobrar_ventas`.`cedula` AS `cedula`, `cuentas_por_cobrar_ventas`.`id` AS `id`, `cuentas_por_cobrar_ventas`.`idnegociacionventa` AS `negociacion`, `cuentas_por_cobrar_ventas`.`idventa` AS `factura`, `detalle_cuentas_por_cobrar_ventas`.`fecha` AS `fecha`, `detalle_cuentas_por_cobrar_ventas`.`hora` AS `hora`, `detalle_cuentas_por_cobrar_ventas`.`efectivo` AS `efectivo`, `detalle_cuentas_por_cobrar_ventas`.`transferencia` AS `transferencia`, `detalle_cuentas_por_cobrar_ventas`.`pagado` AS `pago`, `cuentas_por_cobrar_ventas`.`totalpagado` AS `total`, `cuentas_por_cobrar_ventas`.`montototal` AS `monto`, `cuentas_por_cobrar_ventas`.`totalresta` AS `totalresta`, `detalle_cuentas_por_cobrar_ventas`.`resta` AS `resta`, `cuentas_por_cobrar_ventas`.`finalizada` AS `finalizada` FROM (`cuentas_por_cobrar_ventas` join `detalle_cuentas_por_cobrar_ventas` on(`cuentas_por_cobrar_ventas`.`id` = `detalle_cuentas_por_cobrar_ventas`.`idcpcv`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_amortizaciones_compras`
--
DROP TABLE IF EXISTS `vista_amortizaciones_compras`;

DROP VIEW IF EXISTS `vista_amortizaciones_compras`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_amortizaciones_compras`  AS SELECT `cuentas_por_pagar_compras`.`cedula` AS `cedula`, `cuentas_por_pagar_compras`.`id` AS `id`, `cuentas_por_pagar_compras`.`idnegociacioncompra` AS `negociacion`, `cuentas_por_pagar_compras`.`idcompra` AS `factura`, `detalle_cuentas_por_pagar_compras`.`fecha` AS `fecha`, `detalle_cuentas_por_pagar_compras`.`hora` AS `hora`, `detalle_cuentas_por_pagar_compras`.`efectivo` AS `efectivo`, `detalle_cuentas_por_pagar_compras`.`transferencia` AS `transferencia`, `detalle_cuentas_por_pagar_compras`.`pagado` AS `pago`, `cuentas_por_pagar_compras`.`totalpagado` AS `total`, `cuentas_por_pagar_compras`.`montototal` AS `monto`, `cuentas_por_pagar_compras`.`totalresta` AS `totalresta`, `detalle_cuentas_por_pagar_compras`.`resta` AS `resta`, `cuentas_por_pagar_compras`.`finalizada` AS `finalizada` FROM (`cuentas_por_pagar_compras` join `detalle_cuentas_por_pagar_compras` on(`cuentas_por_pagar_compras`.`id` = `detalle_cuentas_por_pagar_compras`.`idcppc`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_amortizacion_negociacion_compra`
--
DROP TABLE IF EXISTS `vista_amortizacion_negociacion_compra`;

DROP VIEW IF EXISTS `vista_amortizacion_negociacion_compra`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_amortizacion_negociacion_compra`  AS SELECT `_ccompras`.`negociacion_id` AS `negociacion`, `_ccompras`.`id` AS `factura`, `detalle_cuentas_por_pagar_compras`.`fecha` AS `fecha`, `detalle_cuentas_por_pagar_compras`.`hora` AS `hora`, `detalle_cuentas_por_pagar_compras`.`efectivo` AS `efectivo`, `detalle_cuentas_por_pagar_compras`.`transferencia` AS `transferencia`, `detalle_cuentas_por_pagar_compras`.`pagado` AS `pago`, `cuentas_por_pagar_compras`.`montototal` AS `monto`, `cuentas_por_pagar_compras`.`totalpagado` AS `total`, `cuentas_por_pagar_compras`.`montototal` AS `totalresta`, `detalle_cuentas_por_pagar_compras`.`resta` AS `resta` FROM ((`_ccompras` join `cuentas_por_pagar_compras` on(`cuentas_por_pagar_compras`.`idnegociacioncompra` = `_ccompras`.`negociacion_id`)) join `detalle_cuentas_por_pagar_compras` on(`cuentas_por_pagar_compras`.`id` = `detalle_cuentas_por_pagar_compras`.`idcppc`)) ORDER BY `detalle_cuentas_por_pagar_compras`.`id` DESC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_amortizacion_negociacion_venta`
--
DROP TABLE IF EXISTS `vista_amortizacion_negociacion_venta`;

DROP VIEW IF EXISTS `vista_amortizacion_negociacion_venta`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_amortizacion_negociacion_venta`  AS SELECT `ventas`.`negociacion_id` AS `negociacion`, `ventas`.`id` AS `factura`, `detalle_cuentas_por_cobrar_ventas`.`fecha` AS `fecha`, `detalle_cuentas_por_cobrar_ventas`.`hora` AS `hora`, `detalle_cuentas_por_cobrar_ventas`.`efectivo` AS `efectivo`, `detalle_cuentas_por_cobrar_ventas`.`transferencia` AS `transferencia`, `detalle_cuentas_por_cobrar_ventas`.`pagado` AS `pago`, `cuentas_por_cobrar_ventas`.`montototal` AS `monto`, `cuentas_por_cobrar_ventas`.`totalpagado` AS `total`, `cuentas_por_cobrar_ventas`.`montototal` AS `totalresta`, `detalle_cuentas_por_cobrar_ventas`.`resta` AS `resta` FROM ((`ventas` join `cuentas_por_cobrar_ventas` on(`cuentas_por_cobrar_ventas`.`idnegociacionventa` = `ventas`.`negociacion_id`)) join `detalle_cuentas_por_cobrar_ventas` on(`cuentas_por_cobrar_ventas`.`id` = `detalle_cuentas_por_cobrar_ventas`.`idcpcv`)) ORDER BY `detalle_cuentas_por_cobrar_ventas`.`id` DESC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_cantidad_productos_pagar`
--
DROP TABLE IF EXISTS `vista_cantidad_productos_pagar`;

DROP VIEW IF EXISTS `vista_cantidad_productos_pagar`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_cantidad_productos_pagar`  AS SELECT `detalle_negociacion_ventas`.`producto_idn` AS `id`, `_pproductos`.`descripcion` AS `producto`, sum(`detalle_negociacion_ventas`.`cantidadprorecmatndebe`) AS `debe` FROM (`detalle_negociacion_ventas` join `_pproductos` on(`detalle_negociacion_ventas`.`producto_idn` = `_pproductos`.`id`)) GROUP BY `detalle_negociacion_ventas`.`producto_idn` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_cpc_cedula_nombre_monto`
--
DROP TABLE IF EXISTS `vista_cpc_cedula_nombre_monto`;

DROP VIEW IF EXISTS `vista_cpc_cedula_nombre_monto`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_cpc_cedula_nombre_monto`  AS SELECT `clientes`.`cedulac` AS `cedula`, `clientes`.`nombrec` AS `nombre`, sum(`cuentas_por_cobrar_ventas`.`totalresta`) AS `monto` FROM (`cuentas_por_cobrar_ventas` join `clientes` on(`cuentas_por_cobrar_ventas`.`cedula` = `clientes`.`cedulac`)) GROUP BY `clientes`.`cedulac`, `clientes`.`cedulac`, `clientes`.`nombrec` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_cpp_cedula_nombre_monto`
--
DROP TABLE IF EXISTS `vista_cpp_cedula_nombre_monto`;

DROP VIEW IF EXISTS `vista_cpp_cedula_nombre_monto`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_cpp_cedula_nombre_monto`  AS SELECT `proveedores`.`cedula` AS `cedula`, `proveedores`.`nombre` AS `nombre`, sum(`cuentas_por_pagar_compras`.`totalresta`) AS `monto` FROM (`cuentas_por_pagar_compras` join `proveedores` on(`cuentas_por_pagar_compras`.`cedula` = `proveedores`.`cedula`)) GROUP BY `proveedores`.`cedula`, `proveedores`.`cedula`, `proveedores`.`nombre` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_despacho_abono_material_negociacion_ventas`
--
DROP TABLE IF EXISTS `vista_despacho_abono_material_negociacion_ventas`;

DROP VIEW IF EXISTS `vista_despacho_abono_material_negociacion_ventas`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_despacho_abono_material_negociacion_ventas`  AS SELECT `abono_material_negociacion_ventas`.`iddespacho` AS `despacho`, `clientes`.`cedulac` AS `cedula`, `clientes`.`nombrec` AS `nombre`, `negociacion_ventas`.`observaciones` AS `observaciones`, `_pproductos`.`descripcion` AS `material`, `abono_material_negociacion_ventas`.`cantidadpron` AS `cantidad` FROM ((`negociacion_ventas` left join (`abono_material_negociacion_ventas` left join `_pproductos` on(`abono_material_negociacion_ventas`.`idproducton` = `_pproductos`.`id`)) on(`abono_material_negociacion_ventas`.`negociacion_id` = `negociacion_ventas`.`id`)) join `clientes` on(`negociacion_ventas`.`cedulan` = `clientes`.`cedulac`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_despacho_ventas`
--
DROP TABLE IF EXISTS `vista_despacho_ventas`;

DROP VIEW IF EXISTS `vista_despacho_ventas`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_despacho_ventas`  AS SELECT `ventas`.`iddespacho` AS `despacho`, `clientes`.`cedulac` AS `cedula`, `clientes`.`nombrec` AS `nombre`, `ventas`.`observacionesv` AS `observaciones`, `_pproductos`.`descripcion` AS `material`, `detalle_ventas`.`cantidadprov` AS `cantidad` FROM (((`ventas` join `clientes` on(`ventas`.`cedulav` = `clientes`.`cedulac`)) join `detalle_ventas` on(`ventas`.`id` = `detalle_ventas`.`idventa`)) join `_pproductos` on(`detalle_ventas`.`idproductov` = `_pproductos`.`id`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_inventario`
--
DROP TABLE IF EXISTS `vista_inventario`;

DROP VIEW IF EXISTS `vista_inventario`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_inventario`  AS SELECT `_iinventario`.`id` AS `id`, `_iinventario`.`fecha` AS `fecha`, `_iinventario`.`hora` AS `hora`, `_pproductos`.`id` AS `idproducto`, `_pproductos`.`descripcion` AS `descripcion`, `_iinventario`.`comprados` AS `comprados`, `_iinventario`.`vendidos` AS `vendidos`, `_iinventario`.`existencia` AS `existencia`, `_pproductos`.`cantidad` AS `cantidad` FROM (`_pproductos` join `_iinventario` on(`_iinventario`.`idproducto` = `_pproductos`.`id`)) ORDER BY `_iinventario`.`id` DESC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_neg_com_monto_por_pagar`
--
DROP TABLE IF EXISTS `vista_neg_com_monto_por_pagar`;

DROP VIEW IF EXISTS `vista_neg_com_monto_por_pagar`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_neg_com_monto_por_pagar`  AS SELECT `proveedores`.`cedula` AS `cedula`, `proveedores`.`nombre` AS `nombre`, sum(`negociacion_compras`.`restan`) AS `monto` FROM (`negociacion_compras` join `proveedores` on(`proveedores`.`cedula` = `negociacion_compras`.`cedulan`)) WHERE `negociacion_compras`.`finalizada` = 'NO' GROUP BY `proveedores`.`cedula`, `proveedores`.`cedula`, `proveedores`.`nombre` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_neg_ven_monto_por_cobrar`
--
DROP TABLE IF EXISTS `vista_neg_ven_monto_por_cobrar`;

DROP VIEW IF EXISTS `vista_neg_ven_monto_por_cobrar`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_neg_ven_monto_por_cobrar`  AS SELECT `clientes`.`cedulac` AS `cedula`, `clientes`.`nombrec` AS `nombre`, sum(`negociacion_ventas`.`restan`) AS `monto` FROM (`negociacion_ventas` join `clientes` on(`clientes`.`cedulac` = `negociacion_ventas`.`cedulan`)) WHERE `negociacion_ventas`.`finalizada` = 'NO' GROUP BY `clientes`.`cedulac`, `clientes`.`cedulac`, `clientes`.`nombrec` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_precio_prod_cedu`
--
DROP TABLE IF EXISTS `vista_precio_prod_cedu`;

DROP VIEW IF EXISTS `vista_precio_prod_cedu`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_precio_prod_cedu`  AS SELECT `precios_productos_prov_clie`.`id` AS `idprecio`, `precios_productos_prov_clie`.`cedula` AS `cedula`, `precios_productos_prov_clie`.`idproducto` AS `idproducto`, `_pproductos`.`descripcion` AS `descripcion`, `precios_productos_prov_clie`.`precio` AS `precio` FROM (`precios_productos_prov_clie` join `_pproductos` on(`_pproductos`.`id` = `precios_productos_prov_clie`.`idproducto`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abono_material_negociacion_compras`
--
ALTER TABLE `abono_material_negociacion_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `abono_material_negociacion_compras_negociacion_id_foreign` (`negociacion_id`) USING BTREE;

--
-- Indices de la tabla `abono_material_negociacion_ventas`
--
ALTER TABLE `abono_material_negociacion_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `abono_material_negociacion_ventas_idproducton_foreign` (`idproducton`) USING BTREE;

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuentasmaterial`
--
ALTER TABLE `cuentasmaterial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `cuentas_por_cobrar_ventas`
--
ALTER TABLE `cuentas_por_cobrar_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuentas_por_cobrar_ventas_idventa_foreign` (`idventa`),
  ADD KEY `cuentas_por_cobrar_ventas_idnegociacionventa_foreign` (`idnegociacionventa`);

--
-- Indices de la tabla `cuentas_por_pagar_compras`
--
ALTER TABLE `cuentas_por_pagar_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuentas_por_pagar_compras_idcompra_foreign` (`idcompra`),
  ADD KEY `cuentas_por_pagar_compras_idnegociacioncompra_foreign` (`idnegociacioncompra`);

--
-- Indices de la tabla `despacho_material`
--
ALTER TABLE `despacho_material`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detallerecmat`
--
ALTER TABLE `detallerecmat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detallerecmat_recepcionmaterial_id_foreign` (`recepcionmaterial_id`);

--
-- Indices de la tabla `detalle_cuentas_por_cobrar_ventas`
--
ALTER TABLE `detalle_cuentas_por_cobrar_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_cuentas_por_cobrar_ventas_idcpcv_foreign` (`idcpcv`) USING BTREE;

--
-- Indices de la tabla `detalle_cuentas_por_pagar_compras`
--
ALTER TABLE `detalle_cuentas_por_pagar_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_cuentas_por_cobrar_ventas_idcppc_foreign` (`idcppc`) USING BTREE;

--
-- Indices de la tabla `detalle_negociacion_compras`
--
ALTER TABLE `detalle_negociacion_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_negociacion_compras_negociacion_id_foreign` (`negociacion_id`);

--
-- Indices de la tabla `detalle_negociacion_ventas`
--
ALTER TABLE `detalle_negociacion_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_negociacion_ventas_negociacion_id_foreign` (`negociacion_id`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_ventas_idventa_foreign` (`idventa`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `liquidez`
--
ALTER TABLE `liquidez`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `negociacion_compras`
--
ALTER TABLE `negociacion_compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `negociacion_ventas`
--
ALTER TABLE `negociacion_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pago_negociacion_ventas`
--
ALTER TABLE `pago_negociacion_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pago_negociacion_ventas_negociacion_id_foreign` (`negociacion_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `precios_productos_prov_clie`
--
ALTER TABLE `precios_productos_prov_clie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `precios_proveedores_clientes_cedula_foreign` (`cedula`),
  ADD KEY `precios_productos_foreign` (`idproducto`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recepcionmaterial`
--
ALTER TABLE `recepcionmaterial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_index` (`user_id`);

--
-- Indices de la tabla `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_invitations_team_id_email_unique` (`team_id`,`email`);

--
-- Indices de la tabla `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `_ccategoriaproducto`
--
ALTER TABLE `_ccategoriaproducto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `_ccompras`
--
ALTER TABLE `_ccompras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `_ddetallecompras`
--
ALTER TABLE `_ddetallecompras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `_ddetallecompras_idcompra_foreign` (`idcompra`);

--
-- Indices de la tabla `_iinventario`
--
ALTER TABLE `_iinventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `_pproductos`
--
ALTER TABLE `_pproductos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abono_material_negociacion_ventas`
--
ALTER TABLE `abono_material_negociacion_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cuentasmaterial`
--
ALTER TABLE `cuentasmaterial`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cuentas_por_cobrar_ventas`
--
ALTER TABLE `cuentas_por_cobrar_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `cuentas_por_pagar_compras`
--
ALTER TABLE `cuentas_por_pagar_compras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `despacho_material`
--
ALTER TABLE `despacho_material`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `detallerecmat`
--
ALTER TABLE `detallerecmat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT de la tabla `detalle_cuentas_por_cobrar_ventas`
--
ALTER TABLE `detalle_cuentas_por_cobrar_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `detalle_cuentas_por_pagar_compras`
--
ALTER TABLE `detalle_cuentas_por_pagar_compras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_negociacion_compras`
--
ALTER TABLE `detalle_negociacion_compras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `detalle_negociacion_ventas`
--
ALTER TABLE `detalle_negociacion_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `liquidez`
--
ALTER TABLE `liquidez`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `negociacion_compras`
--
ALTER TABLE `negociacion_compras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `negociacion_ventas`
--
ALTER TABLE `negociacion_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `pago_negociacion_ventas`
--
ALTER TABLE `pago_negociacion_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `precios_productos_prov_clie`
--
ALTER TABLE `precios_productos_prov_clie`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `recepcionmaterial`
--
ALTER TABLE `recepcionmaterial`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `team_invitations`
--
ALTER TABLE `team_invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1080;

--
-- AUTO_INCREMENT de la tabla `_ccategoriaproducto`
--
ALTER TABLE `_ccategoriaproducto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `_ccompras`
--
ALTER TABLE `_ccompras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `_ddetallecompras`
--
ALTER TABLE `_ddetallecompras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `_iinventario`
--
ALTER TABLE `_iinventario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT de la tabla `_pproductos`
--
ALTER TABLE `_pproductos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallerecmat`
--
ALTER TABLE `detallerecmat`
  ADD CONSTRAINT `detallerecmat_recepcionmaterial_id_foreign` FOREIGN KEY (`recepcionmaterial_id`) REFERENCES `recepcionmaterial` (`id`);

--
-- Filtros para la tabla `detalle_negociacion_compras`
--
ALTER TABLE `detalle_negociacion_compras`
  ADD CONSTRAINT `detalle_negociacion_compras_negociacion_id_foreign` FOREIGN KEY (`negociacion_id`) REFERENCES `negociacion_compras` (`id`);

--
-- Filtros para la tabla `detalle_negociacion_ventas`
--
ALTER TABLE `detalle_negociacion_ventas`
  ADD CONSTRAINT `detalle_negociacion_ventas_negociacion_id_foreign` FOREIGN KEY (`negociacion_id`) REFERENCES `negociacion_ventas` (`id`);

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `detalle_ventas_idventa_foreign` FOREIGN KEY (`idventa`) REFERENCES `ventas` (`id`);

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pago_negociacion_ventas`
--
ALTER TABLE `pago_negociacion_ventas`
  ADD CONSTRAINT `pago_negociacion_ventas_negociacion_id_foreign` FOREIGN KEY (`negociacion_id`) REFERENCES `negociacion_ventas` (`id`);

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `_ddetallecompras`
--
ALTER TABLE `_ddetallecompras`
  ADD CONSTRAINT `_ddetallecompras_idcompra_foreign` FOREIGN KEY (`idcompra`) REFERENCES `_ccompras` (`id`);
COMMIT;
