-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-04-2021 a las 19:08:18
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
-- Estructura de tabla para la tabla `abono_material_negociacion_compras`
--
-- Creación: 20-04-2021 a las 22:12:05
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
-- RELACIONES PARA LA TABLA `abono_material_negociacion_compras`:
--

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
-- Creación: 13-04-2021 a las 03:05:42
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
-- RELACIONES PARA LA TABLA `abono_material_negociacion_ventas`:
--

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
-- Creación: 17-04-2021 a las 17:14:00
-- Última actualización: 21-04-2021 a las 16:49:28
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
-- RELACIONES PARA LA TABLA `auditoria`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--
-- Creación: 25-03-2021 a las 02:54:22
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
-- RELACIONES PARA LA TABLA `clientes`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentasmaterial`
--
-- Creación: 20-04-2021 a las 01:57:23
-- Última actualización: 21-04-2021 a las 00:14:07
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
-- RELACIONES PARA LA TABLA `cuentasmaterial`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_por_cobrar_ventas`
--
-- Creación: 20-04-2021 a las 01:56:17
-- Última actualización: 21-04-2021 a las 04:15:31
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
-- RELACIONES PARA LA TABLA `cuentas_por_cobrar_ventas`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_por_pagar_compras`
--
-- Creación: 20-04-2021 a las 20:24:00
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
-- RELACIONES PARA LA TABLA `cuentas_por_pagar_compras`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho_material`
--
-- Creación: 13-04-2021 a las 00:38:01
-- Última actualización: 21-04-2021 a las 04:14:12
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
-- RELACIONES PARA LA TABLA `despacho_material`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallerecmat`
--
-- Creación: 23-03-2021 a las 13:22:33
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
-- RELACIONES PARA LA TABLA `detallerecmat`:
--   `recepcionmaterial_id`
--       `recepcionmaterial` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cuentas_por_cobrar_ventas`
--
-- Creación: 20-04-2021 a las 01:52:31
-- Última actualización: 21-04-2021 a las 04:15:31
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
-- RELACIONES PARA LA TABLA `detalle_cuentas_por_cobrar_ventas`:
--

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
-- Creación: 20-04-2021 a las 01:51:32
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
-- RELACIONES PARA LA TABLA `detalle_cuentas_por_pagar_compras`:
--

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
-- Creación: 20-04-2021 a las 01:49:33
-- Última actualización: 21-04-2021 a las 00:02:46
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
-- RELACIONES PARA LA TABLA `detalle_negociacion_compras`:
--   `negociacion_id`
--       `negociacion_compras` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_negociacion_ventas`
--
-- Creación: 20-04-2021 a las 01:48:46
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
-- RELACIONES PARA LA TABLA `detalle_negociacion_ventas`:
--   `negociacion_id`
--       `negociacion_ventas` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--
-- Creación: 20-04-2021 a las 01:50:25
-- Última actualización: 21-04-2021 a las 04:14:01
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
-- RELACIONES PARA LA TABLA `detalle_ventas`:
--   `idventa`
--       `ventas` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--
-- Creación: 16-02-2021 a las 08:12:01
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

--
-- RELACIONES PARA LA TABLA `failed_jobs`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liquidez`
--
-- Creación: 20-04-2021 a las 02:17:15
-- Última actualización: 21-04-2021 a las 04:15:31
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
-- RELACIONES PARA LA TABLA `liquidez`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--
-- Creación: 16-02-2021 a las 08:12:01
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELACIONES PARA LA TABLA `migrations`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--
-- Creación: 22-03-2021 a las 07:21:43
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELACIONES PARA LA TABLA `model_has_permissions`:
--   `permission_id`
--       `permissions` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--
-- Creación: 22-03-2021 a las 07:21:43
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELACIONES PARA LA TABLA `model_has_roles`:
--   `role_id`
--       `roles` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negociacion_compras`
--
-- Creación: 20-04-2021 a las 02:16:23
-- Última actualización: 21-04-2021 a las 14:27:29
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
-- RELACIONES PARA LA TABLA `negociacion_compras`:
--

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
    INSERT INTO  (fechacompra, hora, cedula, idlugar, idestatuspago, idtipopago, efectivo, transferencia, idtipoabonov, negociacion_id, totalcomra, totalpagado, diferenciapago, observacionesc)
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
-- Creación: 20-04-2021 a las 02:15:06
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
-- RELACIONES PARA LA TABLA `negociacion_ventas`:
--

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
-- Creación: 15-04-2021 a las 00:26:35
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

--
-- RELACIONES PARA LA TABLA `pago_negociacion_ventas`:
--   `negociacion_id`
--       `negociacion_ventas` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--
-- Creación: 16-02-2021 a las 08:12:01
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELACIONES PARA LA TABLA `password_resets`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--
-- Creación: 22-03-2021 a las 07:21:43
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
-- RELACIONES PARA LA TABLA `permissions`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--
-- Creación: 16-02-2021 a las 08:12:01
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

--
-- RELACIONES PARA LA TABLA `personal_access_tokens`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios_productos_prov_clie`
--
-- Creación: 20-04-2021 a las 02:10:18
--

DROP TABLE IF EXISTS `precios_productos_prov_clie`;
CREATE TABLE `precios_productos_prov_clie` (
  `id` bigint(20) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `precio` double(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `precios_productos_prov_clie`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--
-- Creación: 20-02-2021 a las 22:05:58
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
-- RELACIONES PARA LA TABLA `proveedores`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcionmaterial`
--
-- Creación: 20-04-2021 a las 02:09:19
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
-- RELACIONES PARA LA TABLA `recepcionmaterial`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--
-- Creación: 22-03-2021 a las 07:21:43
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
-- RELACIONES PARA LA TABLA `roles`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--
-- Creación: 22-03-2021 a las 07:21:46
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELACIONES PARA LA TABLA `role_has_permissions`:
--   `permission_id`
--       `permissions` -> `id`
--   `role_id`
--       `roles` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--
-- Creación: 16-02-2021 a las 08:12:01
-- Última actualización: 21-04-2021 a las 16:59:55
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
-- RELACIONES PARA LA TABLA `sessions`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--
-- Creación: 20-02-2021 a las 22:05:58
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
-- RELACIONES PARA LA TABLA `sucursales`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teams`
--
-- Creación: 16-02-2021 a las 08:12:01
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

--
-- RELACIONES PARA LA TABLA `teams`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `team_invitations`
--
-- Creación: 16-02-2021 a las 08:12:02
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

--
-- RELACIONES PARA LA TABLA `team_invitations`:
--   `team_id`
--       `teams` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `team_user`
--
-- Creación: 16-02-2021 a las 08:12:01
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

--
-- RELACIONES PARA LA TABLA `team_user`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--
-- Creación: 16-02-2021 a las 08:12:01
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
-- RELACIONES PARA LA TABLA `users`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--
-- Creación: 20-04-2021 a las 02:01:54
-- Última actualización: 21-04-2021 a las 04:14:12
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
-- RELACIONES PARA LA TABLA `ventas`:
--

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
-- Creación: 22-03-2021 a las 03:52:10
--

DROP TABLE IF EXISTS `_ccategoriaproducto`;
CREATE TABLE `_ccategoriaproducto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELACIONES PARA LA TABLA `_ccategoriaproducto`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_ccompras`
--
-- Creación: 20-04-2021 a las 02:00:46
-- Última actualización: 21-04-2021 a las 16:49:28
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
-- RELACIONES PARA LA TABLA `_ccompras`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_ddetallecompras`
--
-- Creación: 20-04-2021 a las 01:59:11
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
-- RELACIONES PARA LA TABLA `_ddetallecompras`:
--   `idcompra`
--       `_ccompras` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_iinventario`
--
-- Creación: 20-04-2021 a las 22:24:42
-- Última actualización: 21-04-2021 a las 04:14:12
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
-- RELACIONES PARA LA TABLA `_iinventario`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_pproductos`
--
-- Creación: 22-03-2021 a las 03:52:11
-- Última actualización: 21-04-2021 a las 04:14:12
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
-- RELACIONES PARA LA TABLA `_pproductos`:
--

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentasmaterial`
--
ALTER TABLE `cuentasmaterial`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentas_por_cobrar_ventas`
--
ALTER TABLE `cuentas_por_cobrar_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentas_por_pagar_compras`
--
ALTER TABLE `cuentas_por_pagar_compras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `despacho_material`
--
ALTER TABLE `despacho_material`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detallerecmat`
--
ALTER TABLE `detallerecmat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_cuentas_por_cobrar_ventas`
--
ALTER TABLE `detalle_cuentas_por_cobrar_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_negociacion_compras`
--
ALTER TABLE `detalle_negociacion_compras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT de la tabla `liquidez`
--
ALTER TABLE `liquidez`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `negociacion_compras`
--
ALTER TABLE `negociacion_compras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `negociacion_ventas`
--
ALTER TABLE `negociacion_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pago_negociacion_ventas`
--
ALTER TABLE `pago_negociacion_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `precios_productos_prov_clie`
--
ALTER TABLE `precios_productos_prov_clie`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recepcionmaterial`
--
ALTER TABLE `recepcionmaterial`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `_ddetallecompras`
--
ALTER TABLE `_ddetallecompras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `_iinventario`
--
ALTER TABLE `_iinventario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `_pproductos`
--
ALTER TABLE `_pproductos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
