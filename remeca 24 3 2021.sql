-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-03-2021 a las 11:40:52
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
-- Estructura de tabla para la tabla `clientes`
--

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
(1, 'V33333333', 'JUAN CAMACHO', 'MARACAY', '3333', 'ABC@A.COM', NULL, '2021-03-22 07:25:32', '2021-03-22 07:25:32'),
(2, 'V44444444', 'JOSE JARAMILLO', 'MARACAY', '2222', 'BCD@A.COM', NULL, '2021-03-22 07:26:15', '2021-03-22 07:26:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallerecmat`
--

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
(1, 7, 1, '900.00', 'SUMA', '2021-03-22 08:41:13', '2021-03-22 08:41:13'),
(2, 8, 1, '40.00', 'SUMA', '2021-03-22 08:49:37', '2021-03-22 08:49:37'),
(3, 9, 1, '50.00', 'SUMA', '2021-03-22 08:55:25', '2021-03-22 08:55:25'),
(4, 10, 1, '30.00', 'SUMA', '2021-03-22 08:56:14', '2021-03-22 08:56:14'),
(5, 11, 1, '30.00', 'SUMA', '2021-03-22 09:00:46', '2021-03-22 09:00:46'),
(6, 12, 1, '30.00', 'SUMA', '2021-03-22 09:03:12', '2021-03-22 09:03:12'),
(7, 12, 2, '10.00', 'SUMA', '2021-03-22 09:07:23', '2021-03-22 09:07:23'),
(8, 12, 3, '10.00', 'SUMA', '2021-03-22 09:11:21', '2021-03-22 09:11:21'),
(9, 12, 1, '10.00', 'SUMA', '2021-03-22 09:15:28', '2021-03-22 09:15:28'),
(10, 12, 1, '5.00', 'SUMA', '2021-03-22 09:17:03', '2021-03-22 09:17:03'),
(11, 13, 1, '20.00', 'SUMA', '2021-03-22 09:21:26', '2021-03-22 09:21:26'),
(12, 17, 1, '10.00', 'SUMA', '2021-03-22 09:44:50', '2021-03-22 09:44:50'),
(13, 19, 1, '10.00', 'SUMA', '2021-03-22 10:06:18', '2021-03-22 10:06:18'),
(14, 19, 1, '1.00', 'SUMA', '2021-03-22 10:34:44', '2021-03-22 10:34:44'),
(15, 19, 2, '10.00', 'SUMA', '2021-03-22 10:59:09', '2021-03-22 10:59:09'),
(16, 23, 1, '5.00', 'SUMA', '2021-03-22 11:20:50', '2021-03-22 11:20:50'),
(17, 23, 4, '5.00', 'SUMA', '2021-03-22 11:24:05', '2021-03-22 11:24:05'),
(18, 23, 1, '10.00', 'SUMA', '2021-03-22 11:26:22', '2021-03-22 11:26:22'),
(19, 27, 1, '10.00', 'SUMA', '2021-03-22 11:32:01', '2021-03-22 11:32:01'),
(20, 28, 2, '5.00', 'SUMA', '2021-03-22 11:38:49', '2021-03-22 11:38:49'),
(21, 28, 1, '55.00', 'SUMA', '2021-03-22 11:39:22', '2021-03-22 11:39:22'),
(22, 30, 1, '10.00', 'SUMA', '2021-03-22 17:27:02', '2021-03-22 17:27:02'),
(23, 32, 1, '10.00', 'SUMA', '2021-03-22 17:45:06', '2021-03-22 17:45:06'),
(24, 36, 1, '10.00', 'SUMA', '2021-03-22 18:04:00', '2021-03-22 18:04:00'),
(25, 37, 1, '10.00', 'SUMA', '2021-03-22 18:13:52', '2021-03-22 18:13:52'),
(26, 41, 1, '10.00', 'SUMA', '2021-03-22 23:17:09', '2021-03-22 23:17:09'),
(27, 55, 1, '10.00', 'SUMA', '2021-03-23 00:07:25', '2021-03-23 00:07:25'),
(28, 56, 1, '1.00', 'SUMA', '2021-03-23 00:10:39', '2021-03-23 00:10:39'),
(29, 60, 1, '10.00', 'SUMA', '2021-03-23 00:17:41', '2021-03-23 00:17:41'),
(30, 61, 1, '10.00', 'SUMA', '2021-03-23 00:21:58', '2021-03-23 00:21:58'),
(31, 66, 1, '10.00', 'SUMA', '2021-03-23 01:27:54', '2021-03-23 01:27:54'),
(32, 68, 1, '10.00', 'SUMA', '2021-03-23 01:31:20', '2021-03-23 01:31:20'),
(33, 69, 1, '10.00', 'SUMA', '2021-03-23 01:44:38', '2021-03-23 01:44:38'),
(34, 70, 1, '10.00', 'SUMA', '2021-03-23 01:48:47', '2021-03-23 01:48:47'),
(35, 74, 1, '10.00', 'SUMA', '2021-03-23 02:22:05', '2021-03-23 02:22:05'),
(36, 75, 1, '10.00', 'SUMA', '2021-03-23 02:24:33', '2021-03-23 02:24:33'),
(37, 78, 1, '10.00', 'SUMA', '2021-03-23 03:06:22', '2021-03-23 03:06:22'),
(38, 81, 1, '10.00', 'SUMA', '2021-03-23 03:13:19', '2021-03-23 03:13:19'),
(39, 89, 1, '10.00', 'SUMA', '2021-03-23 03:31:10', '2021-03-23 03:31:10'),
(40, 96, 1, '10.00', 'SUMA', '2021-03-23 03:46:13', '2021-03-23 03:46:13'),
(41, 106, 1, '10.00', 'SUMA', '2021-03-23 04:06:51', '2021-03-23 04:06:51'),
(42, 107, 1, '10.00', 'SUMA', '2021-03-23 04:08:00', '2021-03-23 04:08:00'),
(43, 109, 1, '10.00', 'SUMA', '2021-03-23 04:16:11', '2021-03-23 04:16:11'),
(44, 110, 1, '10.00', 'SUMA', '2021-03-23 04:17:54', '2021-03-23 04:17:54'),
(45, 111, 1, '10.00', 'SUMA', '2021-03-23 04:31:32', '2021-03-23 04:31:32'),
(46, 112, 1, '10.00', 'SUMA', '2021-03-23 04:35:38', '2021-03-23 04:35:38'),
(47, 114, 1, '10.00', 'SUMA', '2021-03-23 04:41:39', '2021-03-23 04:41:39'),
(48, 115, 1, '10.00', 'SUMA', '2021-03-23 04:44:49', '2021-03-23 04:44:49'),
(49, 117, 1, '10.00', 'SUMA', '2021-03-23 04:50:35', '2021-03-23 04:50:35'),
(50, 118, 1, '10.00', 'SUMA', '2021-03-23 04:54:03', '2021-03-23 04:54:03'),
(51, 121, 1, '10.00', 'SUMA', '2021-03-23 05:10:28', '2021-03-23 05:10:28'),
(52, 123, 1, '10.00', 'SUMA', '2021-03-23 05:17:41', '2021-03-23 05:17:41'),
(53, 125, 1, '10.00', 'SUMA', '2021-03-23 05:26:20', '2021-03-23 05:26:20'),
(54, 127, 1, '10.00', 'SUMA', '2021-03-23 05:30:47', '2021-03-23 05:30:47'),
(55, 129, 1, '10.00', 'SUMA', '2021-03-23 12:32:50', '2021-03-23 12:32:50'),
(56, 129, 2, '50.00', 'SUMA', '2021-03-23 12:33:29', '2021-03-23 12:33:29'),
(57, 129, 3, '5.00', 'RESTA', '2021-03-23 12:34:06', '2021-03-23 12:34:06'),
(58, 129, 4, '15.00', 'RESTA', '2021-03-23 12:37:43', '2021-03-23 12:37:43'),
(59, 129, 4, '20.00', 'RESTA', '2021-03-23 12:38:38', '2021-03-23 12:38:38'),
(60, 141, 1, '10.00', 'SUMA', '2021-03-23 13:23:52', '2021-03-23 13:23:52'),
(61, 141, 2, '5.00', 'RESTA', '2021-03-23 13:24:11', '2021-03-23 13:24:11'),
(62, 142, 1, '15.00', 'SUMA', '2021-03-23 13:29:07', '2021-03-23 13:29:07'),
(63, 142, 2, '5.00', 'RESTA', '2021-03-23 13:29:19', '2021-03-23 13:29:19'),
(64, 143, 1, '16.00', 'SUMA', '2021-03-23 13:33:11', '2021-03-23 13:33:11'),
(65, 143, 3, '4.00', 'RESTA', '2021-03-23 13:33:23', '2021-03-23 13:33:23'),
(66, 144, 1, '30.00', 'SUMA', '2021-03-23 13:49:51', '2021-03-23 13:49:51'),
(67, 144, 3, '5.00', 'RESTA', '2021-03-23 13:50:00', '2021-03-23 13:50:00'),
(68, 145, 1, '15.00', 'SUMA', '2021-03-23 14:25:06', '2021-03-23 14:25:06'),
(69, 146, 2, '50.00', 'SUMA', '2021-03-23 14:32:37', '2021-03-23 14:32:37'),
(70, 147, 1, '90.00', 'SUMA', '2021-03-23 14:35:50', '2021-03-23 14:35:50'),
(71, 148, 1, '15.00', 'SUMA', '2021-03-23 15:11:10', '2021-03-23 15:11:10'),
(72, 149, 1, '30.00', 'SUMA', '2021-03-23 15:16:57', '2021-03-23 15:16:57'),
(73, 150, 1, '50.00', 'SUMA', '2021-03-23 15:39:20', '2021-03-23 15:39:20'),
(74, 150, 3, '30.00', 'RESTA', '2021-03-23 15:39:46', '2021-03-23 15:39:46'),
(75, 151, 1, '30.00', 'SUMA', '2021-03-23 15:55:19', '2021-03-23 15:55:19'),
(76, 151, 1, '30.00', 'SUMA', '2021-03-23 16:01:02', '2021-03-23 16:01:02'),
(77, 151, 2, '50.00', 'RESTA', '2021-03-23 16:01:49', '2021-03-23 16:01:49'),
(78, 151, 1, '10.00', 'RESTA', '2021-03-23 16:04:42', '2021-03-23 16:04:42'),
(79, 152, 1, '80.00', 'SUMA', '2021-03-23 16:08:46', '2021-03-23 16:11:15'),
(80, 152, 3, '10.00', 'RESTA', '2021-03-23 16:11:15', '2021-03-23 16:20:35'),
(81, 152, 3, '10.00', 'RESTA', '2021-03-23 16:20:36', '2021-03-23 16:20:36'),
(82, 154, 1, '15.00', 'RESTA', '2021-03-23 16:38:13', '2021-03-23 16:38:54'),
(83, 154, 1, '15.00', 'RESTA', '2021-03-23 16:38:54', '2021-03-23 16:38:54'),
(84, 155, 1, '20.00', 'SUMA', '2021-03-23 16:53:07', '2021-03-23 16:53:07'),
(85, 156, 2, '20.00', 'RESTA', '2021-03-23 16:54:06', '2021-03-23 16:54:36'),
(86, 156, 2, '20.00', 'RESTA', '2021-03-23 16:54:36', '2021-03-23 16:54:36'),
(87, 157, 2, '70.00', 'RESTA', '2021-03-23 17:00:52', '2021-03-23 17:07:04'),
(88, 159, 2, '100.00', 'SUMA', '2021-03-23 17:11:30', '2021-03-23 17:12:23'),
(89, 159, 3, '100.00', 'SUMA', '2021-03-23 17:11:46', '2021-03-23 17:11:46'),
(90, 159, 2, '100.00', 'SUMA', '2021-03-23 17:12:23', '2021-03-23 17:12:23'),
(91, 160, 3, '30.00', 'RESTA', '2021-03-23 17:34:13', '2021-03-23 17:34:28'),
(92, 160, 3, '30.00', 'RESTA', '2021-03-23 17:34:28', '2021-03-23 17:34:28'),
(93, 203, 1, '60.00', 'SUMA', '2021-03-23 21:01:16', '2021-03-23 21:01:16'),
(94, 205, 1, '40.00', 'SUMA', '2021-03-23 21:08:43', '2021-03-23 21:08:43'),
(95, 207, 1, '10.00', 'SUMA', '2021-03-23 21:22:57', '2021-03-23 21:22:57'),
(96, 210, 1, '10.00', 'SUMA', '2021-03-23 21:42:49', '2021-03-23 21:42:49'),
(97, 212, 1, '19.00', 'SUMA', '2021-03-23 21:46:26', '2021-03-23 21:46:26'),
(98, 214, 1, '5.00', 'SUMA', '2021-03-23 22:02:38', '2021-03-23 22:02:38'),
(99, 218, 1, '34.00', 'SUMA', '2021-03-23 22:15:29', '2021-03-23 22:15:29'),
(108, 222, 1, '10.00', 'SUMA', '2021-03-23 23:30:13', '2021-03-23 23:30:13'),
(109, 225, 1, '25.00', 'SUMA', '2021-03-23 23:39:27', '2021-03-23 23:39:27'),
(110, 225, 2, '20.00', 'RESTA', '2021-03-23 23:39:54', '2021-03-23 23:39:54'),
(112, 227, 3, '10.00', 'SUMA', '2021-03-23 23:45:22', '2021-03-23 23:45:22'),
(113, 227, 2, '15.00', 'SUMA', '2021-03-24 00:04:59', '2021-03-24 00:04:59'),
(114, 229, 1, '80.00', 'RESTA', '2021-03-24 00:06:47', '2021-03-24 00:06:47'),
(115, 231, 1, '50.00', 'RESTA', '2021-03-24 00:11:37', '2021-03-24 00:11:37'),
(116, 233, 1, '50.00', 'RESTA', '2021-03-24 00:14:44', '2021-03-24 00:14:44'),
(117, 235, 1, '30.00', 'RESTA', '2021-03-24 00:16:07', '2021-03-24 00:16:07'),
(118, 235, 3, '60.00', 'SUMA', '2021-03-24 00:16:40', '2021-03-24 00:16:40'),
(119, 237, 1, '20.00', 'RESTA', '2021-03-24 01:17:35', '2021-03-24 01:17:35'),
(120, 239, 3, '20.00', 'SUMA', '2021-03-24 01:23:51', '2021-03-24 01:24:08'),
(121, 239, 3, '20.00', 'SUMA', '2021-03-24 01:24:08', '2021-03-24 01:24:08'),
(123, 241, 3, '60.00', 'SUMA', '2021-03-24 01:25:53', '2021-03-24 01:25:53'),
(124, 241, 4, '200.00', 'SUMA', '2021-03-24 01:30:20', '2021-03-24 01:30:20'),
(126, 263, 3, '70.00', 'SUMA', '2021-03-24 02:53:25', '2021-03-24 02:53:25'),
(127, 263, 2, '10.00', 'SUMA', '2021-03-24 02:55:48', '2021-03-24 02:55:48'),
(128, 265, 1, '45.00', 'SUMA', '2021-03-24 03:00:21', '2021-03-24 03:00:21'),
(129, 265, 4, '45.00', 'SUMA', '2021-03-24 03:00:31', '2021-03-24 03:00:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_negociacion_ventas`
--

CREATE TABLE `detalle_negociacion_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idventa` int(11) NOT NULL,
  `idproductov` int(11) NOT NULL,
  `cantidadprov` decimal(8,2) NOT NULL,
  `operacionv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precioprov` decimal(8,2) NOT NULL,
  `totalprov` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

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
-- Estructura de tabla para la tabla `migrations`
--

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

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

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
-- Estructura de tabla para la tabla `negociacion_ventas`
--

CREATE TABLE `negociacion_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin.dashboard', 'Ver la Página Principal', 'web', '2021-03-22 07:21:47', '2021-03-22 07:21:47'),
(2, 'livewire.almacen.material-reception.index', 'Ver la Lista de Almacen', 'web', '2021-03-22 07:21:48', '2021-03-22 07:21:48'),
(3, 'livewire.almacen.material-reception.create', 'Crear una Recepción de Material', 'web', '2021-03-22 07:21:48', '2021-03-22 07:21:48'),
(4, 'livewire.almacen.material-reception.edit', 'Editar una Recepción de Material', 'web', '2021-03-22 07:21:48', '2021-03-22 07:21:48'),
(5, 'livewire.almacen.material-reception.destroy', 'Eliminar una Recepción de Material', 'web', '2021-03-22 07:21:48', '2021-03-22 07:21:48'),
(6, 'livewire.pproveedores.index', 'Ver la Lista de Proveedores', 'web', '2021-03-22 07:21:48', '2021-03-22 07:21:48'),
(7, 'livewire.pproveedores.create', 'Crear un Proveedor', 'web', '2021-03-22 07:21:48', '2021-03-22 07:21:48'),
(8, 'livewire.pproveedores.edit', 'Editar un Proveedor', 'web', '2021-03-22 07:21:48', '2021-03-22 07:21:48'),
(9, 'livewire.pproveedores.destroy', 'Eliminar un Proveedor', 'web', '2021-03-22 07:21:48', '2021-03-22 07:21:48'),
(10, 'livewire.productos.index', 'Ver la Lista de Materiales', 'web', '2021-03-22 07:21:48', '2021-03-22 07:21:48'),
(11, 'livewire.productos.create', 'Crear un Material', 'web', '2021-03-22 07:21:49', '2021-03-22 07:21:49'),
(12, 'livewire.productos.edit', 'Editar un Material', 'web', '2021-03-22 07:21:49', '2021-03-22 07:21:49'),
(13, 'livewire.productos.destroy', 'Eliminar un Material', 'web', '2021-03-22 07:21:49', '2021-03-22 07:21:49'),
(14, 'livewire.sucursales.index', 'Ver la Lista de Lugares', 'web', '2021-03-22 07:21:49', '2021-03-22 07:21:49'),
(15, 'livewire.sucursales.create', 'Crear un Lugar', 'web', '2021-03-22 07:21:49', '2021-03-22 07:21:49'),
(16, 'livewire.sucursales.edit', 'Editar un Lugar', 'web', '2021-03-22 07:21:49', '2021-03-22 07:21:49'),
(17, 'livewire.sucursales.destroy', 'Eliminar un Lugar', 'web', '2021-03-22 07:21:49', '2021-03-22 07:21:49'),
(18, 'admin.users.index', 'Ver la Lista de Usuarios', 'web', '2021-03-22 07:21:49', '2021-03-22 07:21:49'),
(19, 'admin.users.edit', 'Editar un Usuario', 'web', '2021-03-22 07:21:49', '2021-03-22 07:21:49'),
(20, 'admin.users.update', 'Eliminar un Usuario', 'web', '2021-03-22 07:21:49', '2021-03-22 07:21:49'),
(21, 'admin.roles.index', 'Ver la Lista de Roles', 'web', '2021-03-22 07:21:50', '2021-03-22 07:21:50'),
(22, 'admin.roles.create', 'Crear un Rol', 'web', '2021-03-22 07:21:50', '2021-03-22 07:21:50'),
(23, 'admin.roles.edit', 'Editar un Rol', 'web', '2021-03-22 07:21:50', '2021-03-22 07:21:50'),
(24, 'admin.roles.destroy', 'Eliminar un Rol', 'web', '2021-03-22 07:21:50', '2021-03-22 07:21:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

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
-- Estructura de tabla para la tabla `proveedores`
--

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
(1, 'V11111111', 'PEDRO PEREZ', 'MARACAY', '555', 'A@B.COM', NULL, '2021-03-22 07:23:43', '2021-03-22 07:23:43'),
(2, 'V22222222', 'CARLOS CAMARA', 'CARACAS', '4444', 'A@AB.COM', NULL, '2021-03-22 07:24:28', '2021-03-22 07:24:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcionmaterial`
--

CREATE TABLE `recepcionmaterial` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cedula` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idlugar` int(11) DEFAULT NULL,
  `pesofull` decimal(8,2) DEFAULT NULL,
  `pesovacio` decimal(8,2) DEFAULT NULL,
  `pesoneto` decimal(8,2) DEFAULT NULL,
  `pesocalculado` decimal(8,2) DEFAULT NULL,
  `observaciones` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `recepcionmaterial`
--

INSERT INTO `recepcionmaterial` (`id`, `fecha`, `cedula`, `idlugar`, `pesofull`, `pesovacio`, `pesoneto`, `pesocalculado`, `observaciones`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 08:24:09', '2021-03-22 08:24:09'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 08:35:46', '2021-03-22 08:35:46'),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 08:36:08', '2021-03-22 08:36:08'),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 08:36:44', '2021-03-22 08:36:44'),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 08:37:28', '2021-03-22 08:37:28'),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 08:39:00', '2021-03-22 08:39:00'),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 08:40:16', '2021-03-22 08:40:16'),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 08:46:21', '2021-03-22 08:46:21'),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 08:55:01', '2021-03-22 08:55:01'),
(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 08:56:02', '2021-03-22 08:56:02'),
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 09:00:31', '2021-03-22 09:00:31'),
(12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 09:02:58', '2021-03-22 09:02:58'),
(13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 09:18:05', '2021-03-22 09:18:05'),
(14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 09:28:16', '2021-03-22 09:28:16'),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 09:32:28', '2021-03-22 09:32:28'),
(16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 09:36:39', '2021-03-22 09:36:39'),
(17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 09:43:37', '2021-03-22 09:43:37'),
(18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 09:56:20', '2021-03-22 09:56:20'),
(19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 10:03:06', '2021-03-22 10:03:06'),
(20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 11:09:14', '2021-03-22 11:09:14'),
(21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 11:12:59', '2021-03-22 11:12:59'),
(22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 11:15:22', '2021-03-22 11:15:22'),
(23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 11:18:02', '2021-03-22 11:18:02'),
(24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 11:27:08', '2021-03-22 11:27:08'),
(25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 11:28:38', '2021-03-22 11:28:38'),
(26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 11:30:37', '2021-03-22 11:30:37'),
(27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 11:31:44', '2021-03-22 11:31:44'),
(28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 11:38:26', '2021-03-22 11:38:26'),
(29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 17:20:52', '2021-03-22 17:20:52'),
(30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 17:26:35', '2021-03-22 17:26:35'),
(31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'else ', '2021-03-22 17:41:24', '2021-03-22 17:41:24'),
(32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 17:41:40', '2021-03-22 17:41:40'),
(33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 17:51:18', '2021-03-22 17:51:18'),
(34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 17:55:46', '2021-03-22 17:55:46'),
(35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 18:01:03', '2021-03-22 18:01:03'),
(36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 18:03:25', '2021-03-22 18:03:25'),
(37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 18:11:45', '2021-03-22 18:11:45'),
(38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 19:10:56', '2021-03-22 19:10:56'),
(39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 23:11:15', '2021-03-22 23:11:15'),
(40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 23:11:26', '2021-03-22 23:11:26'),
(41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 23:16:08', '2021-03-22 23:16:08'),
(42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 23:22:06', '2021-03-22 23:22:06'),
(43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 23:26:16', '2021-03-22 23:26:16'),
(44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 23:29:00', '2021-03-22 23:29:00'),
(45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 23:31:02', '2021-03-22 23:31:02'),
(46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 23:33:36', '2021-03-22 23:33:36'),
(47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 23:34:33', '2021-03-22 23:34:33'),
(48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 23:35:45', '2021-03-22 23:35:45'),
(49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 23:38:22', '2021-03-22 23:38:22'),
(50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 23:40:14', '2021-03-22 23:40:14'),
(51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 23:49:11', '2021-03-22 23:49:11'),
(52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 23:51:38', '2021-03-22 23:51:38'),
(53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 23:54:06', '2021-03-22 23:54:06'),
(54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 23:55:19', '2021-03-22 23:55:19'),
(55, '22-03-2021', NULL, NULL, '100.00', '10.00', '90.00', '90.00', NULL, '2021-03-23 00:06:41', '2021-03-23 00:08:35'),
(56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 00:09:57', '2021-03-23 00:09:57'),
(57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 00:12:09', '2021-03-23 00:12:09'),
(58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 00:14:04', '2021-03-23 00:14:04'),
(59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 00:14:46', '2021-03-23 00:14:46'),
(60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 00:17:06', '2021-03-23 00:17:06'),
(61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 00:21:19', '2021-03-23 00:21:19'),
(62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 00:23:25', '2021-03-23 00:23:25'),
(63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 00:24:30', '2021-03-23 00:24:30'),
(64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 00:25:09', '2021-03-23 00:25:09'),
(65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 00:26:32', '2021-03-23 00:26:32'),
(66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 01:27:25', '2021-03-23 01:27:25'),
(67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 01:30:01', '2021-03-23 01:30:01'),
(68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 01:31:03', '2021-03-23 01:31:03'),
(69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 01:43:36', '2021-03-23 01:43:36'),
(70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 01:48:22', '2021-03-23 01:48:22'),
(71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 01:51:59', '2021-03-23 01:51:59'),
(72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 02:15:51', '2021-03-23 02:15:51'),
(73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 02:16:29', '2021-03-23 02:16:29'),
(74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 02:21:37', '2021-03-23 02:21:37'),
(75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 02:24:05', '2021-03-23 02:24:05'),
(76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 02:39:59', '2021-03-23 02:39:59'),
(77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:04:30', '2021-03-23 03:04:30'),
(78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:05:53', '2021-03-23 03:05:53'),
(79, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:08:20', '2021-03-23 03:08:20'),
(80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:11:18', '2021-03-23 03:11:18'),
(81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:12:55', '2021-03-23 03:12:55'),
(82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:14:09', '2021-03-23 03:14:09'),
(83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:15:58', '2021-03-23 03:15:58'),
(84, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:18:36', '2021-03-23 03:18:36'),
(85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:19:27', '2021-03-23 03:19:27'),
(86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:20:56', '2021-03-23 03:20:56'),
(87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:22:06', '2021-03-23 03:22:06'),
(88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:29:35', '2021-03-23 03:29:35'),
(89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:30:54', '2021-03-23 03:30:54'),
(90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:33:02', '2021-03-23 03:33:02'),
(91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:33:10', '2021-03-23 03:33:10'),
(92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:34:10', '2021-03-23 03:34:10'),
(93, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:34:43', '2021-03-23 03:34:43'),
(94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:36:28', '2021-03-23 03:36:28'),
(95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:38:35', '2021-03-23 03:38:35'),
(96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:45:17', '2021-03-23 03:45:17'),
(97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:48:00', '2021-03-23 03:48:00'),
(98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:48:43', '2021-03-23 03:48:43'),
(99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:49:35', '2021-03-23 03:49:35'),
(100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:50:52', '2021-03-23 03:50:52'),
(101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:52:46', '2021-03-23 03:52:46'),
(102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:54:12', '2021-03-23 03:54:12'),
(103, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 03:55:15', '2021-03-23 03:55:15'),
(104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:00:52', '2021-03-23 04:00:52'),
(105, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:02:42', '2021-03-23 04:02:42'),
(106, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:06:35', '2021-03-23 04:06:35'),
(107, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:07:43', '2021-03-23 04:07:43'),
(108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:13:05', '2021-03-23 04:13:05'),
(109, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:15:50', '2021-03-23 04:15:50'),
(110, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:17:34', '2021-03-23 04:17:34'),
(111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:30:28', '2021-03-23 04:30:28'),
(112, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:35:19', '2021-03-23 04:35:19'),
(113, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:37:22', '2021-03-23 04:37:22'),
(114, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:41:10', '2021-03-23 04:41:10'),
(115, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:44:32', '2021-03-23 04:44:32'),
(116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:47:35', '2021-03-23 04:47:35'),
(117, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:50:08', '2021-03-23 04:50:08'),
(118, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:53:41', '2021-03-23 04:53:41'),
(119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:56:37', '2021-03-23 04:56:37'),
(120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:57:45', '2021-03-23 04:57:45'),
(121, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 04:59:12', '2021-03-23 04:59:12'),
(122, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 05:13:55', '2021-03-23 05:13:55'),
(123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 05:16:57', '2021-03-23 05:16:57'),
(124, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 05:19:10', '2021-03-23 05:19:10'),
(125, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 05:22:57', '2021-03-23 05:22:57'),
(126, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 05:29:06', '2021-03-23 05:29:06'),
(127, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 05:30:05', '2021-03-23 05:30:05'),
(128, NULL, NULL, NULL, '100.00', '10.00', '90.00', '90.00', NULL, '2021-03-23 05:35:23', '2021-03-23 05:35:23'),
(129, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 12:31:38', '2021-03-23 12:31:38'),
(130, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 12:44:21', '2021-03-23 12:44:21'),
(131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 12:46:29', '2021-03-23 12:46:29'),
(132, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 12:51:19', '2021-03-23 12:51:19'),
(133, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 12:55:08', '2021-03-23 12:55:08'),
(134, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 13:03:35', '2021-03-23 13:03:35'),
(135, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 13:04:56', '2021-03-23 13:04:56'),
(136, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 13:06:43', '2021-03-23 13:06:43'),
(137, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 13:10:47', '2021-03-23 13:10:47'),
(138, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 13:15:37', '2021-03-23 13:15:37'),
(139, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 13:20:54', '2021-03-23 13:20:54'),
(140, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 13:21:09', '2021-03-23 13:21:09'),
(141, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 13:23:25', '2021-03-23 13:23:25'),
(142, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 13:28:49', '2021-03-23 13:28:49'),
(143, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 13:32:53', '2021-03-23 13:32:53'),
(144, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 13:49:38', '2021-03-23 13:49:38'),
(145, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 14:24:48', '2021-03-23 14:24:48'),
(146, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 14:32:24', '2021-03-23 14:32:24'),
(147, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 14:35:35', '2021-03-23 14:35:35'),
(148, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 15:10:52', '2021-03-23 15:10:52'),
(149, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 15:16:39', '2021-03-23 15:16:39'),
(150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 15:39:02', '2021-03-23 15:39:02'),
(151, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 15:55:04', '2021-03-23 15:55:04'),
(152, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 16:08:21', '2021-03-23 16:08:21'),
(153, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 16:35:34', '2021-03-23 16:35:34'),
(154, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 16:37:52', '2021-03-23 16:37:52'),
(155, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 16:52:44', '2021-03-23 16:52:44'),
(156, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 16:53:54', '2021-03-23 16:53:54'),
(157, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 17:00:04', '2021-03-23 17:00:04'),
(158, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 17:09:04', '2021-03-23 17:09:04'),
(159, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 17:11:06', '2021-03-23 17:11:06'),
(160, '23-03-2021', 'v11111111', 1, '400.00', '50.00', '350.00', '350.00', NULL, '2021-03-23 17:33:52', '2021-03-23 17:35:02'),
(161, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 18:32:09', '2021-03-23 18:32:09'),
(162, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 18:37:39', '2021-03-23 18:37:39'),
(163, NULL, NULL, NULL, '100.00', '1.00', '99.00', '99.00', NULL, '2021-03-23 18:38:57', '2021-03-23 18:38:57'),
(164, NULL, NULL, NULL, '100.00', '1.00', '99.00', '99.00', NULL, '2021-03-23 18:39:44', '2021-03-23 18:39:44'),
(165, NULL, NULL, NULL, '100.00', '1.00', '99.00', '99.00', NULL, '2021-03-23 18:40:13', '2021-03-23 18:40:13'),
(166, NULL, NULL, NULL, '100.00', '1.00', '99.00', '99.00', NULL, '2021-03-23 18:41:20', '2021-03-23 18:41:20'),
(167, NULL, NULL, NULL, '100.00', '1.00', '99.00', '99.00', NULL, '2021-03-23 18:42:58', '2021-03-23 18:42:58'),
(168, NULL, NULL, NULL, '100.00', '1.00', '99.00', '99.00', NULL, '2021-03-23 18:47:00', '2021-03-23 18:47:00'),
(169, NULL, NULL, NULL, '100.00', '1.00', '99.00', '99.00', NULL, '2021-03-23 18:47:50', '2021-03-23 18:47:50'),
(170, NULL, NULL, NULL, '100.00', '1.00', '99.00', '99.00', NULL, '2021-03-23 18:50:19', '2021-03-23 18:50:19'),
(171, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 18:52:35', '2021-03-23 18:52:35'),
(172, NULL, NULL, NULL, '100.00', '10.00', '90.00', '90.00', NULL, '2021-03-23 18:53:58', '2021-03-23 18:53:58'),
(173, NULL, NULL, NULL, '100.00', '10.00', '90.00', '90.00', NULL, '2021-03-23 18:54:29', '2021-03-23 18:54:29'),
(174, NULL, NULL, NULL, '100.00', '10.00', '90.00', '90.00', NULL, '2021-03-23 18:55:49', '2021-03-23 18:55:49'),
(175, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:00:20', '2021-03-23 19:00:20'),
(176, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:00:26', '2021-03-23 19:00:26'),
(177, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:02:50', '2021-03-23 19:02:50'),
(178, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:02:55', '2021-03-23 19:02:55'),
(179, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:05:51', '2021-03-23 19:05:51'),
(180, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:05:54', '2021-03-23 19:05:54'),
(181, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:06:41', '2021-03-23 19:06:41'),
(182, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:06:44', '2021-03-23 19:06:44'),
(183, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:07:22', '2021-03-23 19:07:22'),
(184, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:07:25', '2021-03-23 19:07:25'),
(185, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:09:02', '2021-03-23 19:09:02'),
(186, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:09:06', '2021-03-23 19:09:06'),
(187, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:10:17', '2021-03-23 19:10:17'),
(188, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:10:19', '2021-03-23 19:10:19'),
(189, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:10:43', '2021-03-23 19:10:43'),
(190, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:10:46', '2021-03-23 19:10:46'),
(191, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:11:49', '2021-03-23 19:11:49'),
(192, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:11:51', '2021-03-23 19:11:51'),
(193, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:11:53', '2021-03-23 19:11:53'),
(194, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:13:50', '2021-03-23 19:13:50'),
(195, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:13:52', '2021-03-23 19:13:52'),
(196, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:13:53', '2021-03-23 19:13:53'),
(197, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:14:55', '2021-03-23 19:14:55'),
(198, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:14:56', '2021-03-23 19:14:56'),
(199, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:14:58', '2021-03-23 19:14:58'),
(200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:16:00', '2021-03-23 19:16:00'),
(201, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 19:16:03', '2021-03-23 19:16:03'),
(202, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 21:00:56', '2021-03-23 21:00:56'),
(203, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 21:01:00', '2021-03-23 21:01:00'),
(204, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 21:08:18', '2021-03-23 21:08:18'),
(205, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 21:08:21', '2021-03-23 21:08:21'),
(206, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 21:22:37', '2021-03-23 21:22:37'),
(207, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 21:22:41', '2021-03-23 21:22:41'),
(208, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 21:23:33', '2021-03-23 21:23:33'),
(209, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 21:42:25', '2021-03-23 21:42:25'),
(210, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 21:42:26', '2021-03-23 21:42:26'),
(211, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 21:46:00', '2021-03-23 21:46:00'),
(212, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 21:46:02', '2021-03-23 21:46:02'),
(213, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 22:02:20', '2021-03-23 22:02:20'),
(214, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 22:02:23', '2021-03-23 22:02:23'),
(215, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 22:04:37', '2021-03-23 22:04:37'),
(216, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 22:15:01', '2021-03-23 22:15:01'),
(217, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 22:15:07', '2021-03-23 22:15:07'),
(218, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 22:15:11', '2021-03-23 22:15:11'),
(219, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 22:44:17', '2021-03-23 22:44:17'),
(220, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 22:44:20', '2021-03-23 22:44:20'),
(221, NULL, NULL, NULL, '100.00', '5.00', '95.00', '95.00', NULL, '2021-03-23 22:57:29', '2021-03-23 22:57:29'),
(222, NULL, NULL, NULL, '100.00', '5.00', '95.00', '95.00', NULL, '2021-03-23 22:57:33', '2021-03-23 22:57:33'),
(223, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 23:38:57', '2021-03-23 23:38:57'),
(224, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 23:39:04', '2021-03-23 23:39:04'),
(225, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 23:39:09', '2021-03-23 23:39:09'),
(226, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 23:43:45', '2021-03-23 23:43:45'),
(227, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 23:43:49', '2021-03-23 23:43:49'),
(228, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 00:06:14', '2021-03-24 00:06:14'),
(229, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 00:06:16', '2021-03-24 00:06:16'),
(230, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 00:10:54', '2021-03-24 00:10:54'),
(231, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 00:11:00', '2021-03-24 00:11:00'),
(232, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 00:14:24', '2021-03-24 00:14:24'),
(233, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 00:14:26', '2021-03-24 00:14:26'),
(234, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 00:15:46', '2021-03-24 00:15:46'),
(235, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 00:15:50', '2021-03-24 00:15:50'),
(236, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 01:17:17', '2021-03-24 01:17:17'),
(237, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 01:17:20', '2021-03-24 01:17:20'),
(238, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 01:23:18', '2021-03-24 01:23:18'),
(239, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 01:23:20', '2021-03-24 01:23:20'),
(240, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 01:25:24', '2021-03-24 01:25:24'),
(241, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 01:25:27', '2021-03-24 01:25:27'),
(242, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:05:49', '2021-03-24 02:05:49'),
(243, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:05:56', '2021-03-24 02:05:56'),
(244, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:06:43', '2021-03-24 02:06:43'),
(245, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:13:47', '2021-03-24 02:13:47'),
(246, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:13:57', '2021-03-24 02:13:57'),
(247, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:15:29', '2021-03-24 02:15:29'),
(248, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:17:42', '2021-03-24 02:17:42'),
(249, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:18:31', '2021-03-24 02:18:31'),
(250, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:26:21', '2021-03-24 02:26:21'),
(251, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:27:22', '2021-03-24 02:27:22'),
(252, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:28:49', '2021-03-24 02:28:49'),
(253, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:28:55', '2021-03-24 02:28:55'),
(254, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:29:11', '2021-03-24 02:29:11'),
(255, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:30:21', '2021-03-24 02:30:21'),
(256, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:31:23', '2021-03-24 02:31:23'),
(257, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:31:27', '2021-03-24 02:31:27'),
(258, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:32:34', '2021-03-24 02:32:34'),
(259, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:35:04', '2021-03-24 02:35:04'),
(260, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:35:40', '2021-03-24 02:35:40'),
(261, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:35:56', '2021-03-24 02:35:56'),
(262, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:47:21', '2021-03-24 02:47:21'),
(263, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 02:51:11', '2021-03-24 02:51:11'),
(264, NULL, 'v11111111', 1, '90.00', '10.00', '80.00', '80.00', NULL, '2021-03-24 02:58:32', '2021-03-24 02:58:32'),
(265, '23-03-2021', 'v11111111', 1, '100.00', '10.00', '90.00', '90.00', NULL, '2021-03-24 02:59:49', '2021-03-24 03:00:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

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
(1, 'Admin', 'web', '2021-03-22 07:21:47', '2021-03-22 07:21:47'),
(2, 'Auditor', 'web', '2021-03-22 07:21:47', '2021-03-22 07:21:47'),
(3, 'Mantenimiento', 'web', '2021-03-22 07:21:47', '2021-03-22 07:21:47'),
(4, 'Presidencia', 'web', '2021-03-22 07:21:47', '2021-03-22 07:21:47'),
(5, 'Finanzas', 'web', '2021-03-22 07:21:47', '2021-03-22 07:21:47'),
(6, 'Logistica', 'web', '2021-03-22 07:21:47', '2021-03-22 07:21:47'),
(7, 'Administracion', 'web', '2021-03-22 07:21:47', '2021-03-22 07:21:47'),
(8, 'Almacen', 'web', '2021-03-22 07:21:47', '2021-03-22 07:21:47'),
(9, 'PRUEBA', 'web', '2021-03-23 13:38:39', '2021-03-23 13:38:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

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
(2, 8),
(3, 1),
(3, 2),
(3, 4),
(3, 8),
(4, 1),
(4, 2),
(4, 4),
(4, 8),
(5, 1),
(5, 2),
(5, 4),
(5, 8),
(6, 1),
(6, 2),
(6, 3),
(7, 1),
(7, 2),
(7, 9),
(8, 1),
(8, 2),
(8, 9),
(9, 1),
(9, 2),
(9, 9),
(10, 1),
(10, 2),
(10, 3),
(10, 9),
(11, 1),
(11, 2),
(11, 9),
(12, 1),
(12, 2),
(12, 9),
(13, 1),
(13, 2),
(13, 9),
(14, 1),
(14, 2),
(14, 3),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(18, 3),
(19, 1),
(19, 2),
(19, 3),
(20, 1),
(20, 2),
(20, 3),
(21, 1),
(21, 2),
(21, 3),
(21, 4),
(22, 1),
(22, 2),
(22, 3),
(23, 1),
(23, 2),
(23, 3),
(24, 1),
(24, 2),
(24, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

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
('9xtS1HpLqL5fpiqe8zkzRkIHBh31gweWwFfDfM5S', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', 'YToxMjp7czo2OiJfdG9rZW4iO3M6NDA6IjEzZGptb3hFWXhLek9ra3dNVFZiVExJcHh0Q0l1QVQ3blJPdzYwSlMiO3M6MzoidXJsIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NzoiaHR0cDovL3JlbWVjYS50ZXN0L2xpdmV3aXJlL2NvbXByYWRvci1jb21wb25lbnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkODFDdk1UWE5PL3FoNjJ3RC4vTW9jT0Faa3NXbmJNN2g1Y01NdzhocUM4VUdkM2ZaSVhkWVciO3M6MjoicGYiO2k6MDtzOjI6InB0IjtpOjA7czozOiJwbW0iO2Q6NjA7czo4OiJlZGl0bV9pZCI7aToxMTc7aTowO3M6MTA6InRvcHJvZGFjdW0iO2k6MTtkOjI3MDA7fQ==', 1616561971),
('A9KgOqSzRTfEbXlJEehJsAXHm18u0EdDEN7hFYov', 1, '192.168.250.2', 'Mozilla/5.0 (Linux; Android 10; GO1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.105 Mobile Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoicWluVE5nb2JXZks4SXN1bHNXVW5sY0Fja2RjbGUxUWttTWdDT2s5SSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjYxOiJodHRwOi8vYXBwLjE5Mi4xNjguMjUwLjIzLnhpcC5pby9saXZld2lyZS9jb21wcmFkb3ItY29tcG9uZW50Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJDgxQ3ZNVFhOTy9xaDYyd0QuL01vY09BWmtzV25iTTdoNWNNTXc4aHFDOFVHZDNmWklYZFlXIjt9', 1616558717),
('xaPWbNOUEIoNVQNll4e55jHoejejQkNY4nXxlEQR', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiQ1RuTnNLNmpMTVY4dXpjdXNMZnRZUGRBdFphcVRuWEtVTzY4ZVB1dyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vcmVtZWNhLnRlc3QvdXNlcnMvMS9lZGl0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJDgxQ3ZNVFhOTy9xaDYyd0QuL01vY09BWmtzV25iTTdoNWNNTXc4aHFDOFVHZDNmWklYZFlXIjtpOjA7czoxMDoidG9wcm9kYWN1bSI7aToxO2Q6MjcwMDt9', 1616580183);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

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
(1, 'MARACAY', 'MARACAY ARAGUA', NULL, NULL, NULL, '2021-03-22 07:28:17', '2021-03-23 15:53:46'),
(2, 'PUERTO CABELLO', 'PUERTO CABELLO', NULL, NULL, NULL, '2021-03-22 07:28:40', '2021-03-22 07:28:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teams`
--

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
(1, 'Julio H Nuñez A', 'julion23@gmail.com', NULL, '$2y$10$81CvMTXNO/qh62wD./MocOAZksWnbM7h5cMMw8hqC8UGd3fZIXdYW', NULL, NULL, NULL, NULL, NULL, '2021-03-22 07:21:51', '2021-03-22 07:21:51'),
(2, 'Auditor', 'auditor@remeca.test', NULL, '$2y$10$Zq9Pw6VgUo/4VZiKHD2ZOuRN44IWibSJ5sgCxavydZ0JKJYaWewuO', NULL, NULL, NULL, NULL, NULL, '2021-03-22 07:21:51', '2021-03-22 07:21:51'),
(3, 'Mantenimiento', 'mantenimiento@remeca.test', NULL, '$2y$10$bsp.WAZPLQeVJ1hYM48O1OLvsRnjLypu1UoIaheh65TYzAJhFTD9.', NULL, NULL, NULL, NULL, NULL, '2021-03-22 07:21:51', '2021-03-22 07:21:51'),
(4, 'Sr Miguel', 'miguel@remeca.test', NULL, '$2y$10$uLKFW5BSD0tZm9sSclCoYeQq8AKB2rUp4oSHz/wRGyyQSOzxuS/OO', NULL, NULL, NULL, NULL, NULL, '2021-03-22 07:21:51', '2021-03-22 07:21:51'),
(5, 'Sra Gusmary', 'gusmary@remeca.test', NULL, '$2y$10$Z01lLUIwrYlzIFQmkKs3QOESVCq1pA8S9NHAXUp7lfT0b7.WCS2M.', NULL, NULL, NULL, NULL, NULL, '2021-03-22 07:21:52', '2021-03-22 07:21:52'),
(6, 'Sra Erika', 'erika@remeca.test', NULL, '$2y$10$1aewDgUi3f0OHKol9Hf1dOrCYKnZDdtjzJ/Lrh.2DB6hJRFvVfI6C', NULL, NULL, NULL, NULL, NULL, '2021-03-22 07:21:52', '2021-03-22 07:21:52'),
(7, 'Sra Katherine', 'katherine@remeca.test', NULL, '$2y$10$5aY/48e4H/u.L30l6uEYwOYXKEcqco7y5u2iW6UTVQF73if8KFpXy', NULL, NULL, NULL, NULL, NULL, '2021-03-22 07:21:52', '2021-03-22 07:21:52'),
(8, 'Almacen', 'almacen@remeca.test', NULL, '$2y$10$6oHALPvEFmDLM4bW6uWT0eRo2xxvO0V6YVddWDNINvY6Tz31PFt2O', NULL, NULL, NULL, NULL, NULL, '2021-03-22 07:21:53', '2021-03-22 07:21:53'),
(9, 'Sra. Irene Villareal Hijo', 'nieves.sara@example.com', '2021-03-22 07:21:53', '$2y$10$G1QSyjkZF3QU/IHBvQtTluoMP4K/oKZo5PJ/3UqWOn4wdauxqy3P.', NULL, NULL, 'a5dHqY6lI4', NULL, NULL, '2021-03-22 07:21:57', '2021-03-22 07:21:57'),
(10, 'Sra. Nayara Preciado Segundo', 'ybarra.eduardo@example.org', '2021-03-22 07:21:53', '$2y$10$WEhyGydwYr4uN6NhY1E7we3gYgMtZJqtvF7n7jNp/LVMQi5LbRzw.', NULL, NULL, 'PaLMl6wzat', NULL, NULL, '2021-03-22 07:21:57', '2021-03-22 07:21:57'),
(11, 'Saúl Oliver', 'qcastellano@example.org', '2021-03-22 07:21:53', '$2y$10$6UF/1hJ.2WgwpHf.vXfccuHs9E4Pc//DeGALfGgVrv.BSTqQzfsP.', NULL, NULL, 'UDyD6qF5PT', NULL, NULL, '2021-03-22 07:21:57', '2021-03-22 07:21:57'),
(12, 'Celia Escudero', 'cazares.diana@example.net', '2021-03-22 07:21:54', '$2y$10$j3clwtG7.DNgPPvHaXh7fezdGFp33Hxz4HA4KeWqTHoCSySPHgDiG', NULL, NULL, 'y0hhYZajqp', NULL, NULL, '2021-03-22 07:21:58', '2021-03-22 07:21:58'),
(13, 'Úrsula Ordóñez', 'xledesma@example.net', '2021-03-22 07:21:54', '$2y$10$tZKhsSyT4Y2H81EgHjUMYOWOLe79Fn0tu3vq2GyI8YQsO2RK8kmYy', NULL, NULL, 'Ttwwce6dRa', NULL, NULL, '2021-03-22 07:21:58', '2021-03-22 07:21:58'),
(14, 'Unai Orellana', 'dmonroy@example.org', '2021-03-22 07:21:54', '$2y$10$YJAehZtykZbMJ7ZaVZWIAeG5tcIcdfPvOOTmBcB9H1WHa/RApw4JG', NULL, NULL, 'gzQlG0ckvF', NULL, NULL, '2021-03-22 07:21:58', '2021-03-22 07:21:58'),
(15, 'Dr. Manuel Camarillo', 'alex.dejesus@example.net', '2021-03-22 07:21:54', '$2y$10$NqHeu1ewNyo14RIggDqzo.xBXWYJM4vbwMOPQLvA.jKTQYz4BE37u', NULL, NULL, 'OvH6fdFyFd', NULL, NULL, '2021-03-22 07:21:58', '2021-03-22 07:21:58'),
(16, 'Srta. Alicia Serna Segundo', 'aleix96@example.net', '2021-03-22 07:21:55', '$2y$10$GNBIHcF.WAALSrVPwUjN0eyuuFTY8jo5iy..vvxC3d9om4yiiRD5e', NULL, NULL, 'kNeGYij56g', NULL, NULL, '2021-03-22 07:21:58', '2021-03-22 07:21:58'),
(17, 'Úrsula Quintero', 'vparedes@example.org', '2021-03-22 07:21:55', '$2y$10$5QYNP3efGqRpqzcnojPij.6sMowzunHCYlBu2BptDU3TF3LCLzS1m', NULL, NULL, 'W2277v2I1q', NULL, NULL, '2021-03-22 07:21:58', '2021-03-22 07:21:58'),
(18, 'Adrián Coronado', 'soler.gael@example.net', '2021-03-22 07:21:55', '$2y$10$n.LNQSq/iI0yL85oy05UvOhZI0TEiBGhCwXrxWzQbS2dcwUFp8N8.', NULL, NULL, 'fUTH9BcG5q', NULL, NULL, '2021-03-22 07:21:58', '2021-03-22 07:21:58'),
(19, 'Ing. Nerea Valladares', 'juan97@example.net', '2021-03-22 07:21:55', '$2y$10$TUP8qGy1Ma7c83g5FL9DK..PYXVOk6Axpvi/Ciz8Q79OWZbeEoUyy', NULL, NULL, 'kk9GPRXgLT', NULL, NULL, '2021-03-22 07:21:58', '2021-03-22 07:21:58'),
(20, 'Izan Vicente', 'qguillen@example.net', '2021-03-22 07:21:56', '$2y$10$4aMkoZsH3QwVQZcn6AlSheiOp8xkpFaQNNVwGtZqJbecHHP22jn5a', NULL, NULL, 'Rjzkwj82zm', NULL, NULL, '2021-03-22 07:21:58', '2021-03-22 07:21:58'),
(21, 'Isabel Hinojosa', 'castro.mariapilar@example.net', '2021-03-22 07:21:56', '$2y$10$AUtFSPPGOUxc/67EOdAlQevYmLD8WYFMv6dpzYFx6mb246TK4B7Qy', NULL, NULL, 'cGhMLUvd7i', NULL, NULL, '2021-03-22 07:21:58', '2021-03-22 07:21:58'),
(22, 'Ing. Oriol Mascareñas Hijo', 'estrada.emilia@example.net', '2021-03-22 07:21:56', '$2y$10$0XEuzqCm6WOVM3RkNGFJhuyHSqgE4nwxoysjhI4eFH8yYkkATfyMC', NULL, NULL, '03ZJqmcaPY', NULL, NULL, '2021-03-22 07:21:58', '2021-03-22 07:21:58'),
(23, 'Ing. Lidia Cuevas', 'eduardo.hernando@example.com', '2021-03-22 07:21:56', '$2y$10$JYtxk9JWcAB8REezHqs/4OqYVCpP7RD4E2gMUVsZFKjmaBOo8fJ5C', NULL, NULL, '4Zp7Rl0vrr', NULL, NULL, '2021-03-22 07:21:58', '2021-03-22 07:21:58'),
(24, 'Adam Cortés', 'naia32@example.com', '2021-03-22 07:21:57', '$2y$10$oto4uHn0qr7z57oA/G331.k7CG5gVxFLDAHQW4jOmLWYe0hyEzCIa', NULL, NULL, 'V4KB4yGSXs', NULL, NULL, '2021-03-22 07:21:58', '2021-03-22 07:21:58'),
(25, 'Gerard Millán Hijo', 'fportillo@example.net', '2021-03-22 07:21:57', '$2y$10$L1TsHPzxiezZCSEXohjPreaOGfv0eJ0LdNuR2SsaOjhPSi52N26XC', NULL, NULL, 'O8KzoU390F', NULL, NULL, '2021-03-22 07:21:58', '2021-03-22 07:21:58'),
(26, 'Dña Marina Anguiano Tercero', 'roldan.marina@example.net', '2021-03-22 07:21:57', '$2y$10$oIT3ImTnU3tG7wzPPeedzOuuonCCVl38zo6GUSTNyti6Ax/e0MKYS', NULL, NULL, 'rLuk4YOVZZ', NULL, NULL, '2021-03-22 07:21:58', '2021-03-22 07:21:58'),
(27, 'Gerard Romero', 'leo51@example.net', '2021-03-22 07:21:57', '$2y$10$ds51R2.ZwSWmZdfwU4CHH.jOVQ.u6Juz6LyXTbE0DF32lTVMjxi2e', NULL, NULL, '27i1a2XNwD', NULL, NULL, '2021-03-22 07:21:58', '2021-03-22 07:21:58'),
(28, 'Alicia Malave', 'zvergara@example.net', '2021-03-22 07:21:57', '$2y$10$2Tf9BvR3CKYlSLG0JeK0OuTnCt3bBdZjac74GcX3mp7VD.kc1v6K6', NULL, NULL, 'S0brJXS1qK', NULL, NULL, '2021-03-22 07:21:58', '2021-03-22 07:21:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fechaventa` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horaventa` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cedulav` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idlugarv` int(11) DEFAULT NULL,
  `idestatuspagov` int(11) DEFAULT NULL,
  `idtipopagov` int(11) DEFAULT NULL,
  `totalcomrav` decimal(8,2) DEFAULT NULL,
  `totalpagadov` decimal(8,2) DEFAULT NULL,
  `diferenciapagov` decimal(8,2) DEFAULT NULL,
  `ajusteporpesov` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observacionesv` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_ccategoriaproducto`
--

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

CREATE TABLE `_ccompras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecharecepcion` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechacompra` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cedula` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idlugar` int(11) DEFAULT NULL,
  `idestatuspago` int(11) DEFAULT NULL,
  `idtipopago` int(11) DEFAULT NULL,
  `totalcomra` decimal(8,2) DEFAULT NULL,
  `totalpagado` decimal(8,2) DEFAULT NULL,
  `diferenciapago` decimal(8,2) DEFAULT NULL,
  `observacionesc` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `_ccompras`
--

INSERT INTO `_ccompras` (`id`, `fecharecepcion`, `fechacompra`, `hora`, `cedula`, `idlugar`, `idestatuspago`, `idtipopago`, `totalcomra`, `totalpagado`, `diferenciapago`, `observacionesc`, `created_at`, `updated_at`) VALUES
(1, '23-03-2021', NULL, NULL, 'v11111111', 1, NULL, 1, '1.00', NULL, NULL, 'Ninguna', '2021-03-23 18:22:50', '2021-03-23 18:22:50'),
(2, '23-03-2021', NULL, NULL, 'v11111111', 1, NULL, 1, '1.00', NULL, NULL, 'Ninguna', '2021-03-24 03:02:20', '2021-03-24 03:02:20'),
(3, '23-03-2021', NULL, NULL, 'v11111111', 1, NULL, 1, '1.00', NULL, NULL, 'Ninguna', '2021-03-24 04:28:05', '2021-03-24 04:28:05'),
(4, '23-03-2021', NULL, NULL, 'v11111111', 1, NULL, 1, '1.00', NULL, NULL, 'Ninguna', '2021-03-24 04:52:50', '2021-03-24 04:52:50'),
(5, '23-03-2021', '24-03-2021', NULL, 'v11111111', 1, 1, 1, '2700.00', '1700.00', '1000.00', ' ', '2021-03-24 04:59:16', '2021-03-24 04:59:31'),
(6, '23-03-2021', '24-03-2021', NULL, 'v11111111', 1, 1, 1, '2700.00', '2700.00', '0.00', ' ', '2021-03-24 09:40:17', '2021-03-24 09:40:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_ddetallecompras`
--

CREATE TABLE `_ddetallecompras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idcompra` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidadpro` decimal(8,2) NOT NULL,
  `operacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preciopro` decimal(8,2) DEFAULT NULL,
  `totalpro` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `_ddetallecompras`
--

INSERT INTO `_ddetallecompras` (`id`, `idcompra`, `idproducto`, `cantidadpro`, `operacion`, `preciopro`, `totalpro`, `created_at`, `updated_at`) VALUES
(1, 6, 1, '45.00', 'SUMA', NULL, NULL, '2021-03-24 09:40:40', '2021-03-24 09:40:40'),
(2, 6, 4, '45.00', 'SUMA', NULL, NULL, '2021-03-24 09:40:40', '2021-03-24 09:40:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_iinventario`
--

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
(1, '24-03-2021', '05:40:40', 1, 45, 0, 0, '2021-03-24 09:40:40', '2021-03-24 09:40:40'),
(2, '24-03-2021', '05:40:40', 4, 45, 0, 0, '2021-03-24 09:40:40', '2021-03-24 09:40:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_pproductos`
--

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
(1, 1, 'R', '10.00', 45, NULL, NULL, '2021-03-22 07:26:39', '2021-03-24 09:40:40'),
(2, 1, 'A', '20.00', 0, NULL, NULL, '2021-03-22 07:26:49', '2021-03-24 03:43:55'),
(3, 1, 'P', '30.00', 0, NULL, NULL, '2021-03-22 07:27:11', '2021-03-24 03:44:03'),
(4, 1, 'RL', '50.00', 45, NULL, NULL, '2021-03-22 07:27:40', '2021-03-24 09:40:40');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detallerecmat`
--
ALTER TABLE `detallerecmat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recepcionmaterial_id` (`recepcionmaterial_id`);

--
-- Indices de la tabla `detalle_negociacion_ventas`
--
ALTER TABLE `detalle_negociacion_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indices de la tabla `negociacion_ventas`
--
ALTER TABLE `negociacion_ventas`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `_iinventario`
--
ALTER TABLE `_iinventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `_pproductos`
--
ALTER TABLE `_pproductos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detallerecmat`
--
ALTER TABLE `detallerecmat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de la tabla `detalle_negociacion_ventas`
--
ALTER TABLE `detalle_negociacion_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `negociacion_ventas`
--
ALTER TABLE `negociacion_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `recepcionmaterial`
--
ALTER TABLE `recepcionmaterial`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `_ccategoriaproducto`
--
ALTER TABLE `_ccategoriaproducto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `_ccompras`
--
ALTER TABLE `_ccompras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `_ddetallecompras`
--
ALTER TABLE `_ddetallecompras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `_iinventario`
--
ALTER TABLE `_iinventario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `_pproductos`
--
ALTER TABLE `_pproductos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallerecmat`
--
ALTER TABLE `detallerecmat`
  ADD CONSTRAINT `detallerecmat_ibfk_1` FOREIGN KEY (`recepcionmaterial_id`) REFERENCES `recepcionmaterial` (`id`) ON DELETE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
