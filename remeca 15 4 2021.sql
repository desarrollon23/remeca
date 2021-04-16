-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-04-2021 a las 05:11:41
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
CREATE DATABASE IF NOT EXISTS `remeca` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `remeca`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono_material_negociacion_ventas`
--

DROP TABLE IF EXISTS `abono_material_negociacion_ventas`;
CREATE TABLE `abono_material_negociacion_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `negociacion_id` bigint(20) UNSIGNED NOT NULL,
  `idproducton` bigint(20) UNSIGNED NOT NULL,
  `cantidadpron` decimal(8,2) NOT NULL,
  `iddespacho` bigint(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(5, 'V55555555', 'LUIS', 'Corporis ullam qui e', '+1 (381) 847-8426', 'qapecon@mailinator.com', NULL, '2021-03-25 04:28:16', '2021-03-25 13:22:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentasmaterial`
--

DROP TABLE IF EXISTS `cuentasmaterial`;
CREATE TABLE `cuentasmaterial` (
  `id` bigint(20) NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `disponible` double(8,2) NOT NULL,
  `cpc` double(8,2) NOT NULL,
  `cpp` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuentasmaterial`
--

INSERT INTO `cuentasmaterial` (`id`, `idproducto`, `disponible`, `cpc`, `cpp`, `created_at`, `updated_at`) VALUES
(1, 1, 0.00, 0.00, 0.00, NULL, NULL),
(2, 2, 0.00, 0.00, 0.00, NULL, '2021-04-15 23:02:43'),
(3, 3, 0.00, 0.00, 200.00, NULL, '2021-04-15 23:59:57'),
(4, 4, 0.00, 0.00, 250.00, NULL, '2021-04-15 23:59:57'),
(5, 5, 0.00, 0.00, 400.00, NULL, '2021-04-15 23:59:57'),
(6, 6, 0.00, 0.00, 0.00, NULL, '2021-04-15 21:33:09'),
(7, 7, 0.00, 0.00, 0.00, NULL, '2021-04-15 21:52:27');

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
  `montototal` double(8,2) DEFAULT NULL,
  `totalefectivo` double(8,2) DEFAULT NULL,
  `totaltransferencia` double(8,2) DEFAULT NULL,
  `totalpagado` double(8,2) DEFAULT NULL,
  `totalresta` double(8,2) DEFAULT NULL,
  `finalizada` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amortizando` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cuentas_por_cobrar_ventas`
--

INSERT INTO `cuentas_por_cobrar_ventas` (`id`, `idventa`, `idnegociacionventa`, `fecha`, `hora`, `cedula`, `montototal`, `totalefectivo`, `totaltransferencia`, `totalpagado`, `totalresta`, `finalizada`, `amortizando`, `created_at`, `updated_at`) VALUES
(6, 0, 1, '15-04-2021', '19:59:57', 'v33333333', 1700.00, 1850.00, 650.00, 2500.00, 0.00, 'NO', 1, NULL, '2021-04-16 03:01:50');

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
  `montototal` decimal(8,2) DEFAULT NULL,
  `totalefectivo` decimal(8,2) DEFAULT NULL,
  `totaltransferencia` decimal(8,2) DEFAULT NULL,
  `totalpagado` decimal(8,2) DEFAULT NULL,
  `totalresta` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `efectivo` decimal(8,2) DEFAULT NULL,
  `transferencia` decimal(8,2) DEFAULT NULL,
  `pagado` decimal(8,2) DEFAULT NULL,
  `resta` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_cuentas_por_cobrar_ventas`
--

INSERT INTO `detalle_cuentas_por_cobrar_ventas` (`id`, `idcpcv`, `fecha`, `hora`, `efectivo`, `transferencia`, `pagado`, `resta`, `created_at`, `updated_at`) VALUES
(6, 6, '15-04-2021', '19:59:57', '200.00', '500.00', '700.00', 1000.00, NULL, NULL),
(7, 6, '15-04-2021', '21:53:24', '50.00', '150.00', '200.00', 800.00, '2021-04-16 01:53:24', '2021-04-16 01:53:24'),
(8, 6, '15-04-2021', '23:01:50', '800.00', '0.00', '800.00', 0.00, '2021-04-16 03:01:50', '2021-04-16 03:01:50');

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
  `efectivo` decimal(8,2) DEFAULT NULL,
  `transferencia` decimal(8,2) DEFAULT NULL,
  `pagado` decimal(8,2) DEFAULT NULL,
  `resta` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_negociacion_compras`
--

DROP TABLE IF EXISTS `detalle_negociacion_compras`;
CREATE TABLE `detalle_negociacion_compras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `negociacion_id` bigint(20) UNSIGNED NOT NULL,
  `producto_idn` bigint(20) UNSIGNED NOT NULL,
  `cantidadprorecmatn` decimal(8,2) DEFAULT NULL,
  `precionegn` decimal(8,2) DEFAULT NULL,
  `totalpronegn` decimal(8,2) DEFAULT NULL,
  `cantidadprorecmatndebe` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_negociacion_ventas`
--

DROP TABLE IF EXISTS `detalle_negociacion_ventas`;
CREATE TABLE `detalle_negociacion_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `negociacion_id` bigint(20) UNSIGNED NOT NULL,
  `producto_idn` bigint(20) UNSIGNED NOT NULL,
  `cantidadprorecmatn` decimal(8,2) DEFAULT NULL,
  `precionegn` decimal(8,2) DEFAULT NULL,
  `totalpronegn` decimal(8,2) DEFAULT NULL,
  `cantidadprorecmatndebe` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_negociacion_ventas`
--

INSERT INTO `detalle_negociacion_ventas` (`id`, `negociacion_id`, `producto_idn`, `cantidadprorecmatn`, `precionegn`, `totalpronegn`, `cantidadprorecmatndebe`, `created_at`, `updated_at`) VALUES
(120, 1, 3, '200.00', '2.00', '400.00', 200.00, '2021-04-15 23:59:16', '2021-04-15 23:59:16'),
(121, 1, 5, '400.00', '2.00', '800.00', 400.00, '2021-04-15 23:59:27', '2021-04-15 23:59:27'),
(122, 1, 4, '250.00', '2.00', '500.00', 250.00, '2021-04-15 23:59:41', '2021-04-15 23:59:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

DROP TABLE IF EXISTS `detalle_ventas`;
CREATE TABLE `detalle_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idventa` bigint(20) UNSIGNED NOT NULL,
  `idproductov` bigint(20) UNSIGNED NOT NULL,
  `cantidadprov` decimal(8,2) NOT NULL,
  `operacionv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precioprov` decimal(8,2) DEFAULT NULL,
  `totalprov` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `efectivo` double(8,2) DEFAULT NULL,
  `banco` double(8,2) DEFAULT NULL,
  `descripcion` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `liquidez`
--

INSERT INTO `liquidez` (`id`, `efectivo`, `banco`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 1050.00, 650.00, 'DISPONIBLE', '2021-04-13 17:41:49', '2021-04-14 20:17:35'),
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
  `cedulan` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idlugarn` int(11) DEFAULT NULL,
  `idtipopagon` int(11) DEFAULT NULL,
  `idtipoabonon` int(11) DEFAULT NULL,
  `observaciones` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montotn` double(8,2) DEFAULT NULL,
  `totalpagado` double(8,2) DEFAULT NULL,
  `pesotn` double(8,2) DEFAULT NULL,
  `restan` double(8,2) DEFAULT NULL,
  `finalizada` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amortizando` int(11) DEFAULT NULL COMMENT 'Este campo evita que se cree una factura desde el disparador cuando se modifica esta tabla desde el abono a credito',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `montotn` double(8,2) DEFAULT NULL,
  `efectivo` double(8,2) DEFAULT NULL,
  `transferencia` double(8,2) DEFAULT NULL,
  `totalpagado` double(8,2) DEFAULT NULL,
  `pesotn` double(8,2) DEFAULT NULL,
  `restan` double(8,2) DEFAULT NULL,
  `finalizada` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amortizando` int(11) DEFAULT NULL COMMENT 'Este campo evita que se cree una factura desde el disparador cuando se modifica esta tabla desde el abono a credito',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `negociacion_ventas`
--

INSERT INTO `negociacion_ventas` (`id`, `fechan`, `horan`, `cedulan`, `idlugarn`, `idtipopagon`, `idtipoabonon`, `observaciones`, `montotn`, `efectivo`, `transferencia`, `totalpagado`, `pesotn`, `restan`, `finalizada`, `amortizando`, `created_at`, `updated_at`) VALUES
(1, '15-04-2021', '19:59:57', 'v33333333', 0, 2, 3, 'a', 1700.00, 200.00, 500.00, 700.00, 850.00, 1000.00, 'NO', 2, '2021-04-15 23:56:03', '2021-04-15 23:59:57');

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
    INSERT INTO ventas (fechaventa, cedulav, idestatuspagov, idtipopagov, idtipoabonov, negociacion_id, totalcomrav, totalpagadov, diferenciapagov, observacionesv, despachado)
	VALUES (NEW.fechan, NEW.cedulan, @statuspagov, NEW.idtipopagon, NEW.idtipoabonon, NEW.id, NEW.montotn, NEW.totalpagado, NEW.restan, CONCAT("FACTURADO DESDE LA NEGOCIACION. ", NEW.`observaciones`), "NO"
	);

INSERT INTO cuentas_por_cobrar_ventas
(idventa, idnegociacionventa, fecha, hora, cedula, montototal, totalefectivo, totaltransferencia, totalpagado, totalresta)
VALUES (0, NEW.id, NEW.fechan, NEW.horan, NEW.cedulan, NEW.montotn, NEW.efectivo, NEW.transferencia, NEW.totalpagado, NEW.restan);
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
  `monto` bigint(20) DEFAULT NULL,
  `montoefec` decimal(8,2) DEFAULT NULL,
  `montotran` decimal(8,2) DEFAULT NULL,
  `totalpago` decimal(8,2) DEFAULT NULL,
  `restapago` double(8,2) DEFAULT NULL,
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
-- Estructura de tabla para la tabla `permissions`
--

DROP TABLE IF EXISTS `permissions`;
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
(1, 'admin.dashboard', 'Ver la Página Principal', 'web', '2021-03-25 03:02:55', '2021-03-25 03:02:55'),
(2, 'livewire.sales.index', 'Ver la Lista de Ventas', 'web', '2021-03-25 03:02:55', '2021-03-25 03:02:55'),
(3, 'livewire.inventory.index', 'Ver el Inventario', 'web', '2021-03-25 03:02:55', '2021-03-25 03:02:55'),
(4, 'livewire.purchases.index', 'Ver la Lista de Compras', 'web', '2021-03-25 03:02:55', '2021-03-25 03:02:55'),
(5, 'livewire.comprador-component', 'Crear una Compra', 'web', '2021-03-25 03:02:56', '2021-03-25 03:02:56'),
(6, 'livewire.purchases.edit', 'Editar una Compra', 'web', '2021-03-25 03:02:56', '2021-03-25 03:02:56'),
(7, 'livewire.purchases.destroy', 'Eliminar una Compra', 'web', '2021-03-25 03:02:56', '2021-03-25 03:02:56'),
(8, 'livewire.almacen.material-reception.index', 'Ver la Lista de Recepcion de Materiales', 'web', '2021-03-25 03:02:56', '2021-03-25 03:02:56'),
(9, 'livewire.almacen.material-reception.create', 'Crear una Recepcion de Materiales', 'web', '2021-03-25 03:02:56', '2021-03-25 03:02:56'),
(10, 'livewire.almacen.material-reception.edit', 'Editar una Recepcion de Materiales', 'web', '2021-03-25 03:02:56', '2021-03-25 03:02:56'),
(11, 'livewire.almacen.material-reception.destroy', 'Eliminar una Recepcion de Materiales', 'web', '2021-03-25 03:02:56', '2021-03-25 03:02:56'),
(12, 'livewire.pproveedores.index', 'Ver la Lista de Proveedores', 'web', '2021-03-25 03:02:56', '2021-03-25 03:02:56'),
(13, 'livewire.pproveedores.create', 'Crear un Proveedor', 'web', '2021-03-25 03:02:57', '2021-03-25 03:02:57'),
(14, 'livewire.pproveedores.edit', 'Editar un Proveedor', 'web', '2021-03-25 03:02:57', '2021-03-25 03:02:57'),
(15, 'livewire.pproveedores.destroy', 'Eliminar un Proveedor', 'web', '2021-03-25 03:02:57', '2021-03-25 03:02:57'),
(16, 'livewire.clientes.index', 'Ver la Lista de Clientes', 'web', '2021-03-25 03:02:57', '2021-03-25 03:02:57'),
(17, 'livewire.clientes.create', 'Crear un Cliente', 'web', '2021-03-25 03:02:57', '2021-03-25 03:02:57'),
(18, 'livewire.clientes.edit', 'Editar un Cliente', 'web', '2021-03-25 03:02:57', '2021-03-25 03:02:57'),
(19, 'livewire.clientes.destroy', 'Eliminar un Cliente', 'web', '2021-03-25 03:02:57', '2021-03-25 03:02:57'),
(20, 'livewire.productos.index', 'Ver la Lista de Materiales', 'web', '2021-03-25 03:02:57', '2021-03-25 03:02:57'),
(21, 'livewire.productos.create', 'Crear un Material', 'web', '2021-03-25 03:02:57', '2021-03-25 03:02:57'),
(22, 'livewire.productos.edit', 'Editar un Material', 'web', '2021-03-25 03:02:57', '2021-03-25 03:02:57'),
(23, 'livewire.productos.destroy', 'Eliminar un Material', 'web', '2021-03-25 03:02:58', '2021-03-25 03:02:58'),
(24, 'livewire.sucursales.index', 'Ver la Lista de Lugares', 'web', '2021-03-25 03:02:58', '2021-03-25 03:02:58'),
(25, 'livewire.sucursales.create', 'Crear un Lugar', 'web', '2021-03-25 03:02:58', '2021-03-25 03:02:58'),
(26, 'livewire.sucursales.edit', 'Editar un Lugar', 'web', '2021-03-25 03:02:58', '2021-03-25 03:02:58'),
(27, 'livewire.sucursales.destroy', 'Eliminar un Lugar', 'web', '2021-03-25 03:02:58', '2021-03-25 03:02:58'),
(28, 'admin.users.index', 'Ver la Lista de Usuarios', 'web', '2021-03-25 03:02:58', '2021-03-25 03:02:58'),
(29, 'admin.users.edit', 'Editar un Usuario', 'web', '2021-03-25 03:02:58', '2021-03-25 03:02:58'),
(30, 'admin.users.update', 'Eliminar un Usuario', 'web', '2021-03-25 03:02:58', '2021-03-25 03:02:58'),
(31, 'admin.roles.index', 'Ver la Lista de Roles', 'web', '2021-03-25 03:02:59', '2021-03-25 03:02:59'),
(32, 'admin.roles.create', 'Crear un Rol', 'web', '2021-03-25 03:02:59', '2021-03-25 03:02:59'),
(33, 'admin.roles.edit', 'Editar un Rol', 'web', '2021-03-25 03:02:59', '2021-03-25 03:02:59'),
(34, 'admin.roles.destroy', 'Eliminar un Rol', 'web', '2021-03-25 03:02:59', '2021-03-25 03:02:59');

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
  `pesofull` decimal(8,2) DEFAULT NULL,
  `pesovacio` decimal(8,2) DEFAULT NULL,
  `pesoneto` decimal(8,2) DEFAULT NULL,
  `pesocalculado` decimal(8,2) DEFAULT NULL,
  `observaciones` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recibido` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facturado` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('Na3qyPCHN0iB7CHtQpt5S4OaJgYOZjcEUmJJRtmb', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiUlZzZ1BBT0hNcU9JZHZqbGxsSk5Cb3diU1piSVM1RXhvY1pjQXNvSSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vcmVtZWNhLnRlc3QvYWRtaW4vZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJFVwNVFBbW1NYkNvNlpGWGxiOEZxdE9iN01jeGVEbUM4WmxKS0xqUmpZNFN3U0RjYWNlNUVtIjt9', 1618542186);

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
(1, 'Julio H Nuñez A', 'julion23@gmail.com', NULL, '$2y$10$UhzFmfisI5TTLZjpRukh4.6EaJ96NCO6eZPUe/A6IPu6aXcVXoNbi', NULL, NULL, 'GbbtnpVgu6KWuZp3sLajaUK98pFVdnd8vlRA6hSaUyzAjABpOw4QxIIIMTOp', NULL, NULL, '2021-03-25 03:02:59', '2021-03-25 03:02:59'),
(2, 'Auditor', 'auditor@remeca.test', NULL, '$2y$10$Mix4D8Ahr53GYDa9.HjsqO4NSPJiBAqQfeO7QpgwRDw89o/WNlAHi', NULL, NULL, NULL, NULL, NULL, '2021-03-25 03:03:00', '2021-03-25 03:03:00'),
(3, 'Mantenimiento', 'mantenimiento@remeca.test', NULL, '$2y$10$XobXbgPqbGJvI342bTvu7.vyTl4j3dHVj1QiDy5B.2iF5iPpeDVAG', NULL, NULL, NULL, NULL, NULL, '2021-03-25 03:03:00', '2021-03-25 03:03:00'),
(4, 'Sr Miguel', 'miguel@remeca.test', NULL, '$2y$10$ojlsVPm6XaFB5PIvybGZre.6.8mMMsDBnjluifHq7zM1skOqsyufO', NULL, NULL, 'sLmJaTi01frVoxuDa2cosKotIfaXmkCoHWroFotooySv36EjmGDSrmgwv1Dm', NULL, NULL, '2021-03-25 03:03:00', '2021-03-25 03:03:00'),
(5, 'Sra Gusmary', 'gusmary@remeca.test', NULL, '$2y$10$kPkG2AL1O3EFqk9JXqpTsunzjncMNN2n6v0bE00S/ELQ1m2XKlKVy', NULL, NULL, NULL, NULL, NULL, '2021-03-25 03:03:00', '2021-03-25 03:03:00'),
(6, 'Sra Erika', 'erika@remeca.test', NULL, '$2y$10$obvg7x578b1KDDuo1KRbBueeqA/ivpMbpc3i/MHHSyqKEozG2QZ86', NULL, NULL, NULL, NULL, NULL, '2021-03-25 03:03:01', '2021-03-25 03:03:01'),
(7, 'Sra Katherine', 'katherine@remeca.test', NULL, '$2y$10$Up5QAmmMbCo6ZFXlb8FqtOb7McxeDmC8ZlJKLjRjY4SwSDcace5Em', NULL, NULL, 'fTGDdonq2XH7VA2V71WeUZOaaWdMY2HC6nXxYiCdMmrYDlROWNmlVrlVZWDu', NULL, NULL, '2021-03-25 03:03:01', '2021-03-25 03:03:01'),
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
  `efectivo` double(8,2) DEFAULT NULL,
  `transferencia` double(8,2) DEFAULT NULL,
  `idtipoabonov` int(11) DEFAULT NULL,
  `negociacion_id` bigint(20) DEFAULT NULL,
  `placa` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalcomrav` decimal(8,2) DEFAULT NULL,
  `totalpagadov` decimal(8,2) DEFAULT NULL,
  `diferenciapagov` decimal(8,2) DEFAULT NULL,
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
(1053, '15-04-2021', NULL, 'v33333333', NULL, 2, 2, NULL, NULL, 3, 1, NULL, '1700.00', '700.00', '1000.00', NULL, 'FACTURADO DESDE LA NEGOCIACION. a', 'NO', NULL, NULL, NULL);

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
,`abono` decimal(8,2)
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
,`efectivo` decimal(8,2)
,`transferencia` decimal(8,2)
,`pago` decimal(8,2)
,`total` double(8,2)
,`resta` double(8,2)
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
,`cantidad` decimal(8,2)
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
,`cantidad` decimal(8,2)
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
  `efectivo` double(8,2) DEFAULT NULL,
  `transferencia` double(8,2) DEFAULT NULL,
  `idtipoabonov` int(11) DEFAULT NULL,
  `negociacion_id` bigint(20) DEFAULT NULL,
  `totalcomra` decimal(8,2) DEFAULT NULL,
  `totalpagado` decimal(8,2) DEFAULT NULL,
  `diferenciapago` decimal(8,2) DEFAULT NULL,
  `observacionesc` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_ddetallecompras`
--

DROP TABLE IF EXISTS `_ddetallecompras`;
CREATE TABLE `_ddetallecompras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idcompra` bigint(20) UNSIGNED NOT NULL,
  `idproducto` bigint(20) UNSIGNED NOT NULL,
  `cantidadpro` decimal(8,2) NOT NULL,
  `operacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preciopro` decimal(8,2) DEFAULT NULL,
  `totalpro` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(69, '13-04-2021', '09:37:39', 7, 0, 0, 1000, '2021-04-13 13:37:39', '2021-04-13 13:37:39');

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
(1, 1, 'DESCARTE', '0.00', 0, NULL, NULL, '2021-03-25 04:02:54', '2021-04-13 12:38:47'),
(2, 1, 'R', '2.00', 1000, NULL, NULL, '2021-03-25 04:03:35', '2021-04-13 19:35:07'),
(3, 1, 'A', '3.00', 1000, NULL, NULL, '2021-03-25 04:03:50', '2021-04-14 20:17:35'),
(4, 1, 'P', '4.00', 1000, NULL, NULL, '2021-03-25 04:04:07', '2021-04-14 22:03:06'),
(5, 1, 'RL', '5.00', 1000, NULL, NULL, '2021-03-25 04:04:28', '2021-04-14 19:42:43'),
(6, 1, 'RAC', '6.00', 1000, NULL, NULL, '2021-03-25 04:04:43', '2021-04-14 22:03:06'),
(7, 1, 'ALUM', '7.00', 1000, NULL, NULL, '2021-03-29 14:16:07', '2021-04-13 21:34:57');

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_abono_negociacion_venta`
--
DROP TABLE IF EXISTS `vista_abono_negociacion_venta`;

DROP VIEW IF EXISTS `vista_abono_negociacion_venta`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_abono_negociacion_venta`  AS SELECT `abono_material_negociacion_ventas`.`negociacion_id` AS `negociacion`, `abono_material_negociacion_ventas`.`iddespacho` AS `despacho`, `abono_material_negociacion_ventas`.`created_at` AS `fecha`, `abono_material_negociacion_ventas`.`id` AS `id`, `_pproductos`.`descripcion` AS `material`, `abono_material_negociacion_ventas`.`cantidadpron` AS `abono` FROM (`abono_material_negociacion_ventas` join `_pproductos` on(`_pproductos`.`id` = `abono_material_negociacion_ventas`.`idproducton`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_amortizacion_negociacion_venta`
--
DROP TABLE IF EXISTS `vista_amortizacion_negociacion_venta`;

DROP VIEW IF EXISTS `vista_amortizacion_negociacion_venta`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_amortizacion_negociacion_venta`  AS SELECT `ventas`.`negociacion_id` AS `negociacion`, `ventas`.`id` AS `factura`, `detalle_cuentas_por_cobrar_ventas`.`fecha` AS `fecha`, `detalle_cuentas_por_cobrar_ventas`.`hora` AS `hora`, `detalle_cuentas_por_cobrar_ventas`.`efectivo` AS `efectivo`, `detalle_cuentas_por_cobrar_ventas`.`transferencia` AS `transferencia`, `detalle_cuentas_por_cobrar_ventas`.`pagado` AS `pago`, `cuentas_por_cobrar_ventas`.`totalpagado` AS `total`, `detalle_cuentas_por_cobrar_ventas`.`resta` AS `resta` FROM ((`ventas` join `cuentas_por_cobrar_ventas` on(`cuentas_por_cobrar_ventas`.`idnegociacionventa` = `ventas`.`negociacion_id`)) join `detalle_cuentas_por_cobrar_ventas` on(`cuentas_por_cobrar_ventas`.`id` = `detalle_cuentas_por_cobrar_ventas`.`idcpcv`)) ORDER BY `detalle_cuentas_por_cobrar_ventas`.`id` DESC ;

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
-- Estructura para la vista `vista_neg_ven_monto_por_cobrar`
--
DROP TABLE IF EXISTS `vista_neg_ven_monto_por_cobrar`;

DROP VIEW IF EXISTS `vista_neg_ven_monto_por_cobrar`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_neg_ven_monto_por_cobrar`  AS SELECT `clientes`.`cedulac` AS `cedula`, `clientes`.`nombrec` AS `nombre`, sum(`negociacion_ventas`.`restan`) AS `monto` FROM (`negociacion_ventas` join `clientes` on(`clientes`.`cedulac` = `negociacion_ventas`.`cedulan`)) WHERE `negociacion_ventas`.`finalizada` = 'NO' GROUP BY `clientes`.`cedulac`, `clientes`.`cedulac`, `clientes`.`nombrec` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abono_material_negociacion_ventas`
--
ALTER TABLE `abono_material_negociacion_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `abono_material_negociacion_ventas_idproducton_foreign` (`idproducton`) USING BTREE;

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
-- AUTO_INCREMENT de la tabla `abono_material_negociacion_ventas`
--
ALTER TABLE `abono_material_negociacion_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cuentasmaterial`
--
ALTER TABLE `cuentasmaterial`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cuentas_por_cobrar_ventas`
--
ALTER TABLE `cuentas_por_cobrar_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cuentas_por_pagar_compras`
--
ALTER TABLE `cuentas_por_pagar_compras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `despacho_material`
--
ALTER TABLE `despacho_material`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `detallerecmat`
--
ALTER TABLE `detallerecmat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `detalle_cuentas_por_cobrar_ventas`
--
ALTER TABLE `detalle_cuentas_por_cobrar_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalle_negociacion_compras`
--
ALTER TABLE `detalle_negociacion_compras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_negociacion_ventas`
--
ALTER TABLE `detalle_negociacion_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1054;

--
-- AUTO_INCREMENT de la tabla `_ccategoriaproducto`
--
ALTER TABLE `_ccategoriaproducto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `_ccompras`
--
ALTER TABLE `_ccompras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `_ddetallecompras`
--
ALTER TABLE `_ddetallecompras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `_iinventario`
--
ALTER TABLE `_iinventario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
