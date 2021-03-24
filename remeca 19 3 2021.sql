-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-03-2021 a las 18:16:24
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
(1, 14, 1, '100.00', 'RESTA', '2021-03-15 21:05:32', '2021-03-15 21:05:32'),
(2, 14, 2, '200.00', 'SUMA', '2021-03-15 21:06:04', '2021-03-15 21:06:04'),
(3, 14, 3, '200.00', 'SUMA', '2021-03-15 21:06:38', '2021-03-15 21:06:38'),
(4, 16, 1, '100.00', 'RESTA', '2021-03-15 22:04:36', '2021-03-15 22:04:36'),
(5, 17, 1, '100.00', 'SUMA', '2021-03-15 22:06:48', '2021-03-15 22:06:48'),
(6, 17, 1, '50.00', 'RESTA', '2021-03-15 22:07:08', '2021-03-15 22:07:08'),
(7, 18, 1, '25000.00', 'SUMA', '2021-03-15 22:14:45', '2021-03-15 22:16:39'),
(8, 18, 2, '20000.00', 'SUMA', '2021-03-15 22:15:09', '2021-03-15 22:16:50'),
(9, 18, 3, '4000.00', 'SUMA', '2021-03-15 22:15:49', '2021-03-15 22:17:01'),
(10, 57, 1, '2000.00', 'SUMA', '2021-03-16 03:30:22', '2021-03-16 03:30:22'),
(11, 59, 1, '2000.00', 'SUMA', '2021-03-16 03:45:11', '2021-03-16 03:45:11'),
(12, 60, 1, '1000.00', 'SUMA', '2021-03-16 03:55:50', '2021-03-16 03:55:50'),
(13, 60, 2, '5000.00', 'SUMA', '2021-03-16 03:59:18', '2021-03-16 03:59:18'),
(14, 64, 1, '7000.00', 'SUMA', '2021-03-16 04:23:29', '2021-03-16 04:23:29'),
(15, 65, 1, '2000.00', 'SUMA', '2021-03-16 04:34:17', '2021-03-16 04:34:17'),
(16, 66, 2, '3000.00', 'SUMA', '2021-03-16 05:15:09', '2021-03-16 05:15:09'),
(17, 149, 1, '900.00', 'SUMA', '2021-03-17 02:01:38', '2021-03-17 02:02:41'),
(18, 150, 1, '4000.00', 'SUMA', '2021-03-17 02:04:50', '2021-03-17 02:04:50'),
(19, 158, 1, '1000.00', 'SUMA', '2021-03-17 07:26:02', '2021-03-17 07:26:02'),
(20, 158, 2, '5000.00', 'SUMA', '2021-03-17 07:26:21', '2021-03-17 07:26:21'),
(21, 158, 3, '2000.00', 'SUMA', '2021-03-17 07:26:45', '2021-03-17 07:26:45'),
(22, 162, 1, '100.00', 'SUMA', '2021-03-17 08:47:43', '2021-03-17 08:47:43'),
(23, 162, 1, '200.00', 'SUMA', '2021-03-17 08:52:16', '2021-03-17 08:52:16'),
(24, 163, 1, '4000.00', 'SUMA', '2021-03-17 08:57:54', '2021-03-17 08:57:54'),
(25, 163, 3, '800.00', 'SUMA', '2021-03-17 08:58:21', '2021-03-17 08:58:21'),
(26, 165, 1, '100.00', 'SUMA', '2021-03-17 14:58:19', '2021-03-17 14:58:19'),
(27, 168, 1, '150.00', 'SUMA', '2021-03-17 15:31:38', '2021-03-17 15:31:38'),
(28, 169, 1, '180.00', 'SUMA', '2021-03-17 15:35:29', '2021-03-17 15:35:29'),
(29, 169, 2, '50.00', 'SUMA', '2021-03-17 15:35:47', '2021-03-17 15:36:58'),
(30, 170, 1, '90.00', 'SUMA', '2021-03-17 15:43:03', '2021-03-17 15:43:03'),
(31, 170, 2, '100.00', 'SUMA', '2021-03-17 15:43:18', '2021-03-17 15:43:18'),
(32, 170, 3, '100.00', 'SUMA', '2021-03-17 15:43:33', '2021-03-17 15:43:33'),
(33, 171, 1, '1000.00', 'SUMA', '2021-03-17 19:43:24', '2021-03-17 19:43:24'),
(34, 171, 2, '950.00', 'SUMA', '2021-03-17 19:44:23', '2021-03-17 19:44:23'),
(35, 172, 2, '400.00', 'SUMA', '2021-03-17 20:03:12', '2021-03-17 20:03:12');

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
(20, '2021_03_13_145352_create_permission_tables', 1);

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
(3, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5),
(6, 'App\\Models\\User', 6),
(7, 'App\\Models\\User', 7),
(8, 'App\\Models\\User', 8);

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
(1, 'admin.dashboard', 'Ver la Página Principal', 'web', '2021-03-15 02:38:12', '2021-03-15 02:38:12'),
(2, 'livewire.pproveedores.index', 'Ver la Lista de Proveedores', 'web', '2021-03-15 02:38:12', '2021-03-15 02:38:12'),
(3, 'livewire.pproveedores.create', 'Crear un Proveedor', 'web', '2021-03-15 02:38:13', '2021-03-15 02:38:13'),
(4, 'livewire.pproveedores.edit', 'Editar un Proveedor', 'web', '2021-03-15 02:38:13', '2021-03-15 02:38:13'),
(5, 'livewire.pproveedores.destroy', 'Eliminar un Proveedor', 'web', '2021-03-15 02:38:13', '2021-03-15 02:38:13'),
(6, 'livewire.productos.index', 'Ver la Lista de Materiales', 'web', '2021-03-15 02:38:13', '2021-03-15 02:38:13'),
(7, 'livewire.productos.create', 'Crear un Material', 'web', '2021-03-15 02:38:13', '2021-03-15 02:38:13'),
(8, 'livewire.productos.edit', 'Editar un Material', 'web', '2021-03-15 02:38:13', '2021-03-15 02:38:13'),
(9, 'livewire.productos.destroy', 'Eliminar un Material', 'web', '2021-03-15 02:38:13', '2021-03-15 02:38:13'),
(10, 'livewire.sucursales.index', 'Ver la Lista de Lugares', 'web', '2021-03-15 02:38:13', '2021-03-15 02:38:13'),
(11, 'livewire.sucursales.create', 'Crear un Lugar', 'web', '2021-03-15 02:38:13', '2021-03-15 02:38:13'),
(12, 'livewire.sucursales.edit', 'Editar un Lugar', 'web', '2021-03-15 02:38:13', '2021-03-15 02:38:13'),
(13, 'livewire.sucursales.destroy', 'Eliminar un Lugar', 'web', '2021-03-15 02:38:13', '2021-03-15 02:38:13'),
(14, 'admin.users.index', 'Ver la Lista de Usuarios', 'web', '2021-03-15 02:38:13', '2021-03-15 02:38:13'),
(15, 'admin.users.edit', 'Editar un Usuario', 'web', '2021-03-15 02:38:13', '2021-03-15 02:38:13'),
(16, 'admin.users.update', 'Eliminar un Usuario', 'web', '2021-03-15 02:38:13', '2021-03-15 02:38:13'),
(17, 'admin.roles.index', 'Ver la Lista de Roles', 'web', '2021-03-15 02:38:14', '2021-03-15 02:38:14'),
(18, 'admin.roles.create', 'Crear un Rol', 'web', '2021-03-15 02:38:14', '2021-03-15 02:38:14'),
(19, 'admin.roles.edit', 'Editar un Rol', 'web', '2021-03-15 02:38:14', '2021-03-15 02:38:14'),
(20, 'admin.roles.destroy', 'Eliminar un Rol', 'web', '2021-03-15 02:38:14', '2021-03-15 02:38:14');

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
(1, '12345678', 'Pedro Perez', NULL, NULL, NULL, NULL, '2021-03-15 14:55:39', '2021-03-15 14:55:39'),
(2, '87654321', 'Carlos Morillo', NULL, NULL, NULL, NULL, '2021-03-17 14:28:52', '2021-03-17 14:28:52'),
(3, '11111111', 'RAUL CASTILLO', NULL, NULL, NULL, NULL, '2021-03-17 14:29:49', '2021-03-17 14:29:49');

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
(1, '15-03-2021', '12345678', 1, '1000.00', '100.00', '900.00', '900.00', 'Prueba para ver si guarda las observaciones y las limpia', '2021-03-15 19:45:41', '2021-03-15 19:46:29'),
(2, '15-03-2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 19:47:03', '2021-03-15 19:47:03'),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 19:58:59', '2021-03-15 19:58:59'),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 20:02:45', '2021-03-15 20:02:45'),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 20:04:56', '2021-03-15 20:04:56'),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 20:10:07', '2021-03-15 20:10:07'),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 20:14:45', '2021-03-15 20:14:45'),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 20:16:06', '2021-03-15 20:16:06'),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 20:20:52', '2021-03-15 20:20:52'),
(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 20:23:08', '2021-03-15 20:23:08'),
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 20:24:54', '2021-03-15 20:24:54'),
(12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 21:00:01', '2021-03-15 21:00:01'),
(13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 21:02:37', '2021-03-15 21:02:37'),
(14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 21:05:20', '2021-03-15 21:05:20'),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 22:01:01', '2021-03-15 22:01:01'),
(16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 22:04:20', '2021-03-15 22:04:20'),
(17, '15-03-2021', '12345678', 1, '1000.00', '100.00', '900.00', '900.00', 'Prueba', '2021-03-15 22:06:27', '2021-03-15 22:07:38'),
(18, '15-03-2021', '12345678', 1, '50000.00', '1000.00', '49000.00', '49000.00', 'Otra Prueba', '2021-03-15 22:14:02', '2021-03-15 22:17:21'),
(19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 22:24:25', '2021-03-15 22:24:25'),
(20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 23:26:15', '2021-03-15 23:26:15'),
(21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 23:29:35', '2021-03-15 23:29:35'),
(22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 23:30:12', '2021-03-15 23:30:12'),
(23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 23:31:33', '2021-03-15 23:31:33'),
(24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 23:33:14', '2021-03-15 23:33:14'),
(25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 23:35:53', '2021-03-15 23:35:53'),
(26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 23:39:12', '2021-03-15 23:39:12'),
(27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 23:42:01', '2021-03-15 23:42:01'),
(28, '15-03-2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 23:43:07', '2021-03-15 23:43:10'),
(29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 23:46:45', '2021-03-15 23:46:45'),
(30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 23:57:47', '2021-03-15 23:57:47'),
(31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 00:00:21', '2021-03-16 00:00:21'),
(32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 00:09:39', '2021-03-16 00:09:39'),
(33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 00:11:46', '2021-03-16 00:11:46'),
(34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 00:27:28', '2021-03-16 00:27:28'),
(35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 00:54:42', '2021-03-16 00:54:42'),
(36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 00:59:11', '2021-03-16 00:59:11'),
(37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 01:01:22', '2021-03-16 01:01:22'),
(38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 01:02:10', '2021-03-16 01:02:10'),
(39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 01:04:59', '2021-03-16 01:04:59'),
(40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 01:08:37', '2021-03-16 01:08:37'),
(41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 01:13:44', '2021-03-16 01:13:44'),
(42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 01:14:29', '2021-03-16 01:14:29'),
(43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 01:19:59', '2021-03-16 01:19:59'),
(44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 01:25:53', '2021-03-16 01:25:53'),
(45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 01:33:10', '2021-03-16 01:33:10'),
(46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 01:38:03', '2021-03-16 01:38:03'),
(47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 01:49:28', '2021-03-16 01:49:28'),
(48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 02:05:46', '2021-03-16 02:05:46'),
(49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 02:14:10', '2021-03-16 02:14:10'),
(50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 02:37:47', '2021-03-16 02:37:47'),
(51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 02:40:27', '2021-03-16 02:40:27'),
(52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 02:44:33', '2021-03-16 02:44:33'),
(53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 03:02:41', '2021-03-16 03:02:41'),
(54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 03:18:41', '2021-03-16 03:18:41'),
(55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 03:21:41', '2021-03-16 03:21:41'),
(56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 03:23:56', '2021-03-16 03:23:56'),
(57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 03:29:04', '2021-03-16 03:29:04'),
(58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 03:38:25', '2021-03-16 03:38:25'),
(59, '15-03-2021', '12345678', 1, '10000.00', '2000.00', '8000.00', '8000.00', NULL, '2021-03-16 03:44:10', '2021-03-16 03:50:41'),
(60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 03:53:06', '2021-03-16 03:53:06'),
(61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 04:13:22', '2021-03-16 04:13:22'),
(62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 04:16:00', '2021-03-16 04:16:00'),
(63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 04:20:15', '2021-03-16 04:20:15'),
(64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 04:22:25', '2021-03-16 04:22:25'),
(65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 04:33:00', '2021-03-16 04:33:00'),
(66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 05:14:34', '2021-03-16 05:14:34'),
(67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 05:21:38', '2021-03-16 05:21:38'),
(68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 05:25:28', '2021-03-16 05:25:28'),
(69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 05:26:39', '2021-03-16 05:26:39'),
(70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 05:27:20', '2021-03-16 05:27:20'),
(71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 05:29:56', '2021-03-16 05:29:56'),
(72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 05:30:35', '2021-03-16 05:30:35'),
(73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 05:31:21', '2021-03-16 05:31:21'),
(74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 05:32:36', '2021-03-16 05:32:36'),
(75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 05:33:08', '2021-03-16 05:33:08'),
(76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 05:34:00', '2021-03-16 05:34:00'),
(77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 05:34:57', '2021-03-16 05:34:57'),
(78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 13:06:28', '2021-03-16 13:06:28'),
(79, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 13:07:36', '2021-03-16 13:07:36'),
(80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 13:10:18', '2021-03-16 13:10:18'),
(81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 13:14:33', '2021-03-16 13:14:33'),
(82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 13:17:06', '2021-03-16 13:17:06'),
(83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 13:18:04', '2021-03-16 13:18:04'),
(84, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 13:29:22', '2021-03-16 13:29:22'),
(85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 13:36:07', '2021-03-16 13:36:07'),
(86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 13:49:01', '2021-03-16 13:49:01'),
(87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 13:52:09', '2021-03-16 13:52:09'),
(88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 13:54:07', '2021-03-16 13:54:07'),
(89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 13:59:10', '2021-03-16 13:59:10'),
(90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 14:02:07', '2021-03-16 14:02:07'),
(91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 14:07:35', '2021-03-16 14:07:35'),
(92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 14:09:26', '2021-03-16 14:09:26'),
(93, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 14:17:59', '2021-03-16 14:17:59'),
(94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 14:19:23', '2021-03-16 14:19:23'),
(95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 14:20:35', '2021-03-16 14:20:35'),
(96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 16:03:20', '2021-03-16 16:03:20'),
(97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 16:31:04', '2021-03-16 16:31:04'),
(98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 16:33:26', '2021-03-16 16:33:26'),
(99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 16:56:14', '2021-03-16 16:56:14'),
(100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 17:01:37', '2021-03-16 17:01:37'),
(101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 17:06:42', '2021-03-16 17:06:42'),
(102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 17:11:39', '2021-03-16 17:11:39'),
(103, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 18:02:57', '2021-03-16 18:02:57'),
(104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 18:06:57', '2021-03-16 18:06:57'),
(105, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 18:12:06', '2021-03-16 18:12:06'),
(106, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 18:50:41', '2021-03-16 18:50:41'),
(107, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 18:51:36', '2021-03-16 18:51:36'),
(108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 18:59:57', '2021-03-16 18:59:57'),
(109, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 19:00:44', '2021-03-16 19:00:44'),
(110, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 19:04:55', '2021-03-16 19:04:55'),
(111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 19:12:00', '2021-03-16 19:12:00'),
(112, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 19:15:35', '2021-03-16 19:15:35'),
(113, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 19:20:00', '2021-03-16 19:20:00'),
(114, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 19:27:27', '2021-03-16 19:27:27'),
(115, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 19:30:26', '2021-03-16 19:30:26'),
(116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 19:32:31', '2021-03-16 19:32:31'),
(117, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 20:18:33', '2021-03-16 20:18:33'),
(118, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 20:20:23', '2021-03-16 20:20:23'),
(119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 20:25:05', '2021-03-16 20:25:05'),
(120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 20:29:05', '2021-03-16 20:29:05'),
(121, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 20:31:39', '2021-03-16 20:31:39'),
(122, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 20:50:27', '2021-03-16 20:50:27'),
(123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 20:53:22', '2021-03-16 20:53:22'),
(124, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 20:55:52', '2021-03-16 20:55:52'),
(125, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 20:58:07', '2021-03-16 20:58:07'),
(126, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:01:06', '2021-03-17 01:01:06'),
(127, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:06:24', '2021-03-17 01:06:24'),
(128, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:13:22', '2021-03-17 01:13:22'),
(129, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:16:26', '2021-03-17 01:16:26'),
(130, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:17:59', '2021-03-17 01:17:59'),
(131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:19:33', '2021-03-17 01:19:33'),
(132, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:20:18', '2021-03-17 01:20:18'),
(133, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:21:28', '2021-03-17 01:21:28'),
(134, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:30:37', '2021-03-17 01:30:37'),
(135, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:32:05', '2021-03-17 01:32:05'),
(136, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:33:40', '2021-03-17 01:33:40'),
(137, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:35:49', '2021-03-17 01:35:49'),
(138, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:37:13', '2021-03-17 01:37:13'),
(139, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:38:56', '2021-03-17 01:38:56'),
(140, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:41:03', '2021-03-17 01:41:03'),
(141, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:42:26', '2021-03-17 01:42:26'),
(142, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:45:19', '2021-03-17 01:45:19'),
(143, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:46:31', '2021-03-17 01:46:31'),
(144, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:47:26', '2021-03-17 01:47:26'),
(145, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:51:17', '2021-03-17 01:51:17'),
(146, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:51:54', '2021-03-17 01:51:54'),
(147, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:53:53', '2021-03-17 01:53:53'),
(148, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 01:54:36', '2021-03-17 01:54:36'),
(149, '16-03-2021', '12345678', 1, '1000.00', '100.00', '900.00', '900.00', NULL, '2021-03-17 01:59:26', '2021-03-17 02:02:50'),
(150, '16-03-2021', '12345678', 1, '5000.00', '1000.00', '4000.00', '4000.00', NULL, '2021-03-17 02:04:15', '2021-03-17 02:04:56'),
(151, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 03:12:34', '2021-03-17 03:12:34'),
(152, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 03:13:03', '2021-03-17 03:13:03'),
(153, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 03:15:48', '2021-03-17 03:15:48'),
(154, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 03:17:22', '2021-03-17 03:17:22'),
(155, '16-03-2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 03:22:40', '2021-03-17 03:22:42'),
(156, '16-03-2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 03:22:48', '2021-03-17 03:22:48'),
(157, '16-03-2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 03:23:49', '2021-03-17 03:23:51'),
(158, '17-03-2021', '12345678', 1, '10000.00', '1000.00', '9000.00', '9000.00', 'NINGUNA', '2021-03-17 07:25:08', '2021-03-17 07:27:42'),
(159, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 08:31:12', '2021-03-17 08:31:12'),
(160, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 08:41:16', '2021-03-17 08:41:16'),
(161, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 08:43:19', '2021-03-17 08:43:19'),
(162, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 08:46:54', '2021-03-17 08:46:54'),
(163, '17-03-2021', '12345678', 1, '5000.00', '200.00', '4800.00', '4800.00', NULL, '2021-03-17 08:56:50', '2021-03-17 08:58:43'),
(164, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 14:04:21', '2021-03-17 14:04:21'),
(165, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 14:57:30', '2021-03-17 14:57:30'),
(166, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 15:15:38', '2021-03-17 15:15:38'),
(167, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 15:23:34', '2021-03-17 15:23:34'),
(168, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 15:31:14', '2021-03-17 15:31:14'),
(169, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 15:35:10', '2021-03-17 15:35:10'),
(170, '17-03-2021', '87654321', 1, '300.00', '10.00', '290.00', '290.00', NULL, '2021-03-17 15:42:31', '2021-03-17 15:43:43'),
(171, '17-03-2021', '12345678', 1, '2000.00', '50.00', '1950.00', '1950.00', NULL, '2021-03-17 19:40:54', '2021-03-17 19:44:49'),
(172, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 20:02:54', '2021-03-17 20:02:54'),
(173, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-18 18:57:18', '2021-03-18 18:57:18'),
(174, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-18 19:20:18', '2021-03-18 19:20:18');

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
(1, 'Admin', 'web', '2021-03-15 02:38:12', '2021-03-15 02:38:12'),
(2, 'Auditor', 'web', '2021-03-15 02:38:12', '2021-03-15 02:38:12'),
(3, 'Mantenimiento', 'web', '2021-03-15 02:38:12', '2021-03-15 02:38:12'),
(4, 'Presidencia', 'web', '2021-03-15 02:38:12', '2021-03-15 02:38:12'),
(5, 'Finanzas', 'web', '2021-03-15 02:38:12', '2021-03-15 02:38:12'),
(6, 'Logistica', 'web', '2021-03-15 02:38:12', '2021-03-15 02:38:12'),
(7, 'Administracion', 'web', '2021-03-15 02:38:12', '2021-03-15 02:38:12'),
(8, 'Almacen', 'web', '2021-03-15 02:38:12', '2021-03-15 02:38:12');

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
(2, 3),
(2, 7),
(3, 1),
(3, 2),
(3, 7),
(4, 1),
(4, 2),
(4, 7),
(5, 1),
(5, 2),
(5, 7),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 7),
(7, 1),
(7, 2),
(7, 4),
(7, 7),
(8, 1),
(8, 2),
(8, 7),
(9, 1),
(9, 2),
(9, 7),
(10, 1),
(10, 2),
(10, 3),
(10, 7),
(11, 1),
(11, 2),
(11, 7),
(12, 1),
(12, 2),
(12, 7),
(13, 1),
(13, 2),
(13, 7),
(14, 1),
(14, 2),
(14, 3),
(15, 1),
(15, 2),
(15, 3),
(16, 1),
(16, 2),
(16, 3),
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(18, 1),
(18, 2),
(18, 3),
(19, 1),
(19, 2),
(19, 3),
(20, 1),
(20, 2),
(20, 3);

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
('vTaMfSQA1Pko1H0CA38bl786eVk517tw9YbhybkI', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiTE9RSWdEaGVPNm4xbFJZV3djY2RXNkNGQXpsOWJtdGhQdUJ6QVp3USI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ3OiJodHRwOi8vcmVtZWNhLnRlc3QvbGl2ZXdpcmUvY29tcHJhZG9yLWNvbXBvbmVudCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRCWHY1ZVhCcFV5RnVsc2ouNWJTZmsueGcuNWJBTHc3c1puZE5yeUpHZWN0UUpFV0xkVEtmaSI7fQ==', 1616173196);

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
(1, 'maracay', 'maracay', NULL, NULL, NULL, '2021-03-15 15:59:27', '2021-03-15 15:59:27'),
(2, 'puerto cabello', 'carabobo', NULL, NULL, NULL, '2021-03-17 19:54:21', '2021-03-17 19:54:21');

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
(1, 'Julio H Nuñez A', 'julion23@gmail.com', NULL, '$2y$10$BXv5eXBpUyFulsj.5bSfk.xg.5bALw7sZndNryJGectQJEWLdTKfi', NULL, NULL, NULL, NULL, NULL, '2021-03-15 02:38:14', '2021-03-15 02:38:14'),
(2, 'Auditor', 'auditor@remeca.test', NULL, '$2y$10$Td7bXUbaKz0sm2v/oppAT.aJPle9IS/HPj0UtMqfJrZh5r8fxKvBy', NULL, NULL, NULL, NULL, NULL, '2021-03-15 02:38:15', '2021-03-15 02:38:15'),
(3, 'Mantenimiento', 'mantenimiento@remeca.test', NULL, '$2y$10$2ba6n979Hg38E7f.ERcAe.e0/Fp4VHpJ3tm3JHDNtv1aR1dOfgdvC', NULL, NULL, NULL, NULL, NULL, '2021-03-15 02:38:15', '2021-03-15 02:38:15'),
(4, 'Sr Miguel', 'miguel@remeca.test', NULL, '$2y$10$f5DPZ4ivIYT8PgyLVgbbS.xVCvUm7r.r94p82FIS9rZrRiJvKA2OC', NULL, NULL, NULL, NULL, NULL, '2021-03-15 02:38:16', '2021-03-15 02:38:16'),
(5, 'Sra Gusmary', 'gusmary@remeca.test', NULL, '$2y$10$oQ9m5XxSQx/uG/HsXrN1O.JjwBoa/pi3wVDgKpkpV0QMLax6S9B4y', NULL, NULL, NULL, NULL, NULL, '2021-03-15 02:38:16', '2021-03-15 02:38:16'),
(6, 'Sra Erika', 'erika@remeca.test', NULL, '$2y$10$ajWZuaBP6kM.evskp/DxU.V/mzUhekmOII6YU4se989TgeBI8kX6u', NULL, NULL, NULL, NULL, NULL, '2021-03-15 02:38:17', '2021-03-15 02:38:17'),
(7, 'Sra Katherine', 'katherine@remeca.test', NULL, '$2y$10$VeJhxGhRCHrnJ424O8TaU.02n8tvCcKYUxUw.bPV23K1xnyNZ3deS', NULL, NULL, NULL, NULL, NULL, '2021-03-15 02:38:17', '2021-03-15 02:38:17'),
(8, 'Almacen', 'almacen@remeca.test', NULL, '$2y$10$cM5qQzxwHbzdP5PQ3WtvD.UGa01/61Oe6j6PRcNJUS.UewkmRAu9.', NULL, NULL, NULL, NULL, NULL, '2021-03-15 02:38:17', '2021-03-15 02:38:17'),
(9, 'Leire Casanova', 'enegrete@example.com', '2021-03-15 02:38:18', '$2y$10$1Y5EV3qUcVqDgCORDp5Hnu2PfcXJhBga.ZCsPIKmxf2Fg7plrt0Ii', NULL, NULL, 's51jtlSe23', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(10, 'Nadia Colón', 'salinas.raquel@example.org', '2021-03-15 02:38:18', '$2y$10$zmgRk0yv8X7A338Y6nXUf..MBwQXyrl2Vx0MUS8Lj/vh02ICju9Jq', NULL, NULL, 'fEenrGqn2E', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(11, 'Ing. Beatriz Osorio', 'adam.avalos@example.net', '2021-03-15 02:38:18', '$2y$10$ZDsLk3yvfy3VjMdap/HCBeK6YbbWpwLPVmkth.TrsRP2u4g8KOKZu', NULL, NULL, 'AGPpUag7z6', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(12, 'Jimena Castaño Segundo', 'alicea.marcos@example.com', '2021-03-15 02:38:18', '$2y$10$Q4HVMCfCI2TyZyw5bV7GyOsGUjEuw68J7EUNTLFOb700crgUDI63m', NULL, NULL, 'K7qeeNjZRE', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(13, 'Lic. Eric Roque Hijo', 'wgodoy@example.com', '2021-03-15 02:38:18', '$2y$10$mJZf4cmAd4zY4.bGgv2udeOCD9uZbsjg88o2.AznhGevSxkmxSgou', NULL, NULL, 'L9oS7Tf0uy', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(14, 'Daniel Ramírez', 'isevilla@example.org', '2021-03-15 02:38:19', '$2y$10$y14HpO/iHTeTFywJjWLDN.wgKZkK4ri5fWx43WvKHDHCfUwLJqmmS', NULL, NULL, 'vKcEuDUXs7', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(15, 'Jaime Zaragoza', 'alvarez.ivan@example.org', '2021-03-15 02:38:19', '$2y$10$49rzcXRd/9HMFSY0bnDPhefd.Xrj0KW8BFUEZOuIeb2PYyd9FEvgu', NULL, NULL, '53Bl5nKpWb', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(16, 'Rosa María Amador Segundo', 'ian.alonso@example.net', '2021-03-15 02:38:19', '$2y$10$urjlEiE/Qe19hUnwz/2NwuiIgFPHLgCfJ4ygbvaojV5W9omDvxGwu', NULL, NULL, '0lAzvIVz0B', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(17, 'Diana Barroso', 'dario66@example.org', '2021-03-15 02:38:19', '$2y$10$pk3cJnJr07iGZNmLG0xZJu1NUChk6TOxoG2.SrCLBzVOdyQdT/Wby', NULL, NULL, 'D67zlzySYq', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(18, 'Eduardo Armas', 'cvalle@example.net', '2021-03-15 02:38:19', '$2y$10$kA31zH8UJyKSspIFAIigquR8lQvxjLB73qZOI/IBvxBJX1g5DYbEG', NULL, NULL, 'adkjYyg09y', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(19, 'Abril Archuleta', 'leo.oquendo@example.net', '2021-03-15 02:38:20', '$2y$10$QQBE8SV52gzKSnzlypIGqOb8vAQswOeXXu6F6/Mj/i6iWdknWcjGO', NULL, NULL, 'fMYFPVypsD', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(20, 'Lic. Yolanda Cuesta Segundo', 'vvalles@example.net', '2021-03-15 02:38:20', '$2y$10$0.eLZSKpkuAM6wdY05xKW.g.iN4ixZqn4jrwL/NOWqy4XBDP3zG5O', NULL, NULL, 'B4N1EnDLfc', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(21, 'Mar Más Hijo', 'jan06@example.net', '2021-03-15 02:38:20', '$2y$10$2LmAn4z0bHoqJLnE6KyZQem11HfezpxmqViSyWM2jJaGZ09SmrcSG', NULL, NULL, 'Eb7fVMoa3k', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(22, 'Nil Padrón', 'galcantar@example.org', '2021-03-15 02:38:20', '$2y$10$cywjwQqvMPu1iIi.eecPVOZdM/1/osmR2oaTpX9jaNhS/1Wm30Fvi', NULL, NULL, 'R0XbX8453y', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(23, 'Aleix Giménez Segundo', 'frosas@example.net', '2021-03-15 02:38:20', '$2y$10$kOikN5nKmjhdqQkgrT232.bL9XqJ2KzBHgAxocWZ5uLC9zG3tOeEK', NULL, NULL, 'VOkouXyHxk', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(24, 'Sra. Teresa Mejía Tercero', 'oscar96@example.org', '2021-03-15 02:38:21', '$2y$10$KxHZAVPGFZW4N2EynXGjl.7GffxPt2H9yOLNvy0NyJOQ/2vAUQF/u', NULL, NULL, 'hpJwDVMZkH', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(25, 'Yolanda Acosta', 'gvenegas@example.com', '2021-03-15 02:38:21', '$2y$10$ZBFl.G8PnDr8hSz3iQhereADGZDEBcnD.GV1XJUh4s9H.Z198LO12', NULL, NULL, '0gtpjAH9C4', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(26, 'Lic. Yago Olivas', 'tzuniga@example.net', '2021-03-15 02:38:21', '$2y$10$7OJmMJqxBq0T6qtFTm4r2uvwT9cwbJExyzqll8m.NiWs3iDEY/E0W', NULL, NULL, 'F2uw5VD4RM', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(27, 'Ing. Pol Castellano Tercero', 'francisca53@example.com', '2021-03-15 02:38:21', '$2y$10$f1c92YaKg4A64ZVnUO7QsetWQvJ5oBU52LgCaE.EyKn/SmJK8p.Zy', NULL, NULL, 'YlHWyBPyZL', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22'),
(28, 'Luna Navarro', 'oscar.rubio@example.org', '2021-03-15 02:38:21', '$2y$10$bWpJB.Q0lli29A8yZPbhmOv5tXWUjjmiGTszZXydwHafoOgObzmCm', NULL, NULL, 'nT7Um1bwcU', NULL, NULL, '2021-03-15 02:38:22', '2021-03-15 02:38:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_ccategoriaproducto`
--

CREATE TABLE `_ccategoriaproducto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `_ccategoriaproducto`
--

INSERT INTO `_ccategoriaproducto` (`id`, `descripcion`, `visible`, `created_at`, `updated_at`) VALUES
(1, 'METALES', 'SI', NULL, NULL);

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
  `observacionesc` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `_ccompras`
--

INSERT INTO `_ccompras` (`id`, `fecharecepcion`, `fechacompra`, `hora`, `cedula`, `idlugar`, `idestatuspago`, `idtipopago`, `totalcomra`, `totalpagado`, `diferenciapago`, `observacionesc`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 12:35:11', '2021-03-19 12:35:11'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 12:36:36', '2021-03-19 12:36:36'),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 12:36:53', '2021-03-19 12:36:53'),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 12:41:25', '2021-03-19 12:41:25'),
(5, '17-03-2021', NULL, NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 15:29:43', '2021-03-19 15:29:43'),
(6, '17-03-2021', NULL, NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 15:52:38', '2021-03-19 15:52:38'),
(7, '17-03-2021', NULL, NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 15:57:39', '2021-03-19 15:57:39'),
(8, '17-03-2021', NULL, NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 16:02:44', '2021-03-19 16:02:44'),
(9, NULL, '19-03-2021', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 16:06:00', '2021-03-19 16:06:08'),
(10, NULL, '19-03-2021', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 16:19:23', '2021-03-19 16:19:33'),
(11, NULL, '19-03-2021', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 16:21:46', '2021-03-19 16:21:57'),
(12, NULL, '19-03-2021', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 16:23:39', '2021-03-19 16:23:47'),
(13, NULL, '19-03-2021', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 16:26:51', '2021-03-19 16:26:58'),
(14, NULL, '19-03-2021', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 16:33:45', '2021-03-19 16:33:54'),
(15, NULL, '19-03-2021', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 16:34:47', '2021-03-19 16:34:54'),
(16, NULL, '19-03-2021', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 16:36:18', '2021-03-19 16:36:24'),
(17, NULL, '19-03-2021', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 16:37:49', '2021-03-19 16:37:59'),
(18, NULL, '19-03-2021', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 16:39:27', '2021-03-19 16:39:35'),
(19, NULL, '19-03-2021', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 16:40:40', '2021-03-19 16:40:47'),
(20, NULL, '19-03-2021', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 16:44:09', '2021-03-19 16:44:18'),
(21, NULL, '19-03-2021', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 16:45:41', '2021-03-19 16:45:51'),
(22, NULL, '19-03-2021', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 16:52:58', '2021-03-19 16:53:10'),
(23, NULL, '19-03-2021', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 16:55:55', '2021-03-19 16:56:07'),
(24, NULL, '19-03-2021', NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-19 16:56:47', '2021-03-19 16:56:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_ddetallecompras`
--

CREATE TABLE `_ddetallecompras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idcompra` bigint(20) DEFAULT NULL,
  `idproducto` bigint(20) DEFAULT NULL,
  `cantidadpro` decimal(8,2) DEFAULT NULL,
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
(1, 22, NULL, '1000.00', 'SUMA', NULL, NULL, '2021-03-19 16:53:10', '2021-03-19 16:53:10'),
(2, 22, NULL, '950.00', 'SUMA', NULL, NULL, '2021-03-19 16:53:10', '2021-03-19 16:53:10'),
(3, 23, NULL, '1000.00', 'SUMA', NULL, NULL, '2021-03-19 16:56:07', '2021-03-19 16:56:07'),
(4, 23, NULL, '950.00', 'SUMA', NULL, NULL, '2021-03-19 16:56:07', '2021-03-19 16:56:07'),
(5, 24, NULL, '1000.00', 'SUMA', NULL, NULL, '2021-03-19 16:56:57', '2021-03-19 16:56:57'),
(6, 24, NULL, '950.00', 'SUMA', NULL, NULL, '2021-03-19 16:56:57', '2021-03-19 16:56:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_iinventario`
--

CREATE TABLE `_iinventario` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idproducto` int(11) NOT NULL,
  `comprados` int(11) NOT NULL,
  `vendidos` int(11) NOT NULL,
  `existencia` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_pproductos`
--

CREATE TABLE `_pproductos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idcate` int(11) DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `visiblecom` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibleven` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `_pproductos`
--

INSERT INTO `_pproductos` (`id`, `idcate`, `descripcion`, `precio`, `cantidad`, `visiblecom`, `visibleven`, `created_at`, `updated_at`) VALUES
(1, 1, 'A', '100.00', 100, NULL, NULL, '2021-03-15 15:14:34', '2021-03-15 15:14:34'),
(2, 1, 'B', '50.00', 200, NULL, NULL, '2021-03-15 15:14:47', '2021-03-17 19:58:45'),
(3, 1, 'C', '300.00', 300, NULL, NULL, '2021-03-15 15:14:58', '2021-03-15 15:14:58'),
(4, 1, 'hierro', '50.00', 3000, NULL, NULL, '2021-03-17 19:51:21', '2021-03-17 19:51:21');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detallerecmat`
--
ALTER TABLE `detallerecmat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detallerecmat_recepcionmaterial_id_foreign` (`recepcionmaterial_id`);

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
-- AUTO_INCREMENT de la tabla `detallerecmat`
--
ALTER TABLE `detallerecmat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT de la tabla `_ccategoriaproducto`
--
ALTER TABLE `_ccategoriaproducto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `_ddetallecompras`
--
ALTER TABLE `_ddetallecompras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `_iinventario`
--
ALTER TABLE `_iinventario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `detallerecmat_recepcionmaterial_id_foreign` FOREIGN KEY (`recepcionmaterial_id`) REFERENCES `recepcionmaterial` (`id`);

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
