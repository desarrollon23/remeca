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

--