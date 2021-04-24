-- Volcado de datos para la tabla `_pproductos`
--

INSERT INTO `_pproductos` (`id`, `idcate`, `descripcion`, `precio`, `cantidad`, `visiblecom`, `visibleven`, `created_at`, `updated_at`) VALUES
(1, 1, 'DESCARTE', '0.00', 0, NULL, NULL, '2021-03-25 04:02:54', '2021-04-23 14:58:47'),
(2, 1, 'R', '0.00', 0.00, NULL, NULL, '2021-03-25 04:03:35', '2021-04-23 16:03:07'),
(3, 1, 'A', '0.00', 0.00, NULL, NULL, '2021-03-25 04:03:50', '2021-04-23 20:44:10'),
(4, 1, 'P', '0.00', 0.00, NULL, NULL, '2021-03-25 04:04:07', '2021-04-23 16:04:35'),
(5, 1, 'RL', '0.00', 0.00, NULL, NULL, '2021-03-25 04:04:28', '2021-04-23 14:57:23'),
(6, 1, 'RAC', '0.00', 0.00, NULL, NULL, '2021-03-25 04:04:43', '2021-04-23 20:59:51'),
(7, 1, 'ALUM', '0.00', 0.00, NULL, NULL, '2021-03-29 14:16:07', '2021-04-23 20:38:26'),
(8, 1, 'RAL',  '0.00', 0.00, NULL, NULL, '2021-03-25 04:03:35', '2021-04-23 16:03:07'),
(9, 1, 'CALAM', '0.00', 0.00, NULL, NULL, '2021-03-25 04:03:35', '2021-04-23 16:03:07'),
(10, 1, 'POTE', '0.00', 0.00, NULL, NULL, '2021-03-25 04:03:50', '2021-04-23 20:44:10'),
(11, 1, 'ACERO', '0.00', 0.00, NULL, NULL, '2021-03-25 04:04:07', '2021-04-23 16:04:35'),
(12, 1, 'PERFIL', '0.00', 0.00, NULL, NULL, '2021-03-25 04:04:28', '2021-04-23 14:57:23'),
(13, 1, 'BATERIA', '0.00', 0.00, NULL, NULL, '2021-03-25 04:04:43', '2021-04-23 20:59:51'),
(14, 1, 'HIERRO P', '0.00', 0.00, NULL, NULL, '2021-03-29 14:16:07', '2021-04-23 20:38:26'),
(15, 1, 'HIERRO M', '0.00', 0.00, NULL, NULL, '2021-03-29 14:16:07', '2021-04-23 20:38:26');


-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Julio H Nuñez A', 'julion23@gmail.com', NULL, '$2y$10$UhzFmfisI5TTLZjpRukh4.6EaJ96NCO6eZPUe/A6IPu6aXcVXoNbi', NULL, NULL, 'B06I1umWQyZIUJUBJ812TIOjDIarIPlAPL0yTjE1le6I0AhqnMLbx68vR6Wd', NULL, 'profile-photos/BYBkXlFVbR1CJS2pHEfsnba575kBOVSjDG9pEtVI.png', '2021-03-25 03:02:59', '2021-04-19 03:05:48'),
(2, 'Auditor', 'auditor@remeca.test', NULL, '$2y$10$Mix4D8Ahr53GYDa9.HjsqO4NSPJiBAqQfeO7QpgwRDw89o/WNlAHi', NULL, NULL, NULL, NULL, NULL, '2021-03-25 03:03:00', '2021-03-25 03:03:00'),
(3, 'Mantenimiento', 'mantenimiento@remeca.test', NULL, '$2y$10$XobXbgPqbGJvI342bTvu7.vyTl4j3dHVj1QiDy5B.2iF5iPpeDVAG', NULL, NULL, NULL, NULL, NULL, '2021-03-25 03:03:00', '2021-03-25 03:03:00'),
(4, 'Sr Miguel', 'miguel@remeca.test', NULL, '$2y$10$ojlsVPm6XaFB5PIvybGZre.6.8mMMsDBnjluifHq7zM1skOqsyufO', NULL, NULL, 'sLmJaTi01frVoxuDa2cosKotIfaXmkCoHWroFotooySv36EjmGDSrmgwv1Dm', NULL, NULL, '2021-03-25 03:03:00', '2021-03-25 03:03:00'),
(5, 'Sra Gusmary', 'gusmary@remeca.test', NULL, '$2y$10$kPkG2AL1O3EFqk9JXqpTsunzjncMNN2n6v0bE00S/ELQ1m2XKlKVy', NULL, NULL, NULL, NULL, NULL, '2021-03-25 03:03:00', '2021-03-25 03:03:00'),
(6, 'Sra Erika', 'erika@remeca.test', NULL, '$2y$10$obvg7x578b1KDDuo1KRbBueeqA/ivpMbpc3i/MHHSyqKEozG2QZ86', NULL, NULL, NULL, NULL, NULL, '2021-03-25 03:03:01', '2021-03-25 03:03:01'),
(7, 'Sra Katherine', 'katherine@remeca.test', NULL, '$2y$10$Up5QAmmMbCo6ZFXlb8FqtOb7McxeDmC8ZlJKLjRjY4SwSDcace5Em', NULL, NULL, 'RUtIvyNw46AtSyjDLzgLBRztqurDK4uvPVNh0JZrk29mKCwAQUBNq7xDMN3j', NULL, NULL, '2021-03-25 03:03:01', '2021-03-25 03:03:01'),
(8, 'Almacen', 'almacen@remeca.test', NULL, '$2y$10$VcmgFJA.Th1tWMmExmUj2e67Pnm4bUBmKwPTkQROZtlgz4QA1roSa', NULL, NULL, NULL, NULL, NULL, '2021-03-25 03:03:01', '2021-03-25 03:03:01');


-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `descripcion`, `direccion`, `telefono`, `idencargado`, `visible`, `created_at`, `updated_at`) VALUES
(1, 'san vicente', 'maracay edo aragua', NULL, NULL, NULL, '2021-03-25 03:39:28', '2021-03-25 03:39:28');


-- Volcado de datos para la tabla `liquidez`
--

INSERT INTO `liquidez` (`id`, `efectivo`, `banco`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 0.00, 0.00, 'DISPONIBLE', '2021-04-13 17:41:49', '2021-04-23 20:33:44'),
(2, 0.00, 0.00, 'CPC', '2021-04-15 20:16:35', '2021-04-15 20:16:35'),
(3, 0.00, 0.00, 'CPP', '2021-04-15 20:16:35', '2021-04-15 20:16:35');

-- Volcado de datos para la tabla `cuentasmaterial`
--

INSERT INTO `cuentasmaterial` (`id`, `idproducto`, `disponible`, `cpc`, `cpp`, `created_at`, `updated_at`) VALUES
(1, 1, 0.00, 0.00, 0.00, NULL, NULL),
(2, 2, 0.00, 0.00, 0.00, NULL, '2021-04-22 19:50:15'),
(3, 3, 0.00, 0.00, 0.00, NULL, '2021-04-23 16:49:48'),
(4, 4, 0.00, 0.00, 0.00, NULL, '2021-04-23 13:54:45'),
(5, 5, 0.00, 0.00, 0.00, NULL, '2021-04-22 19:52:24'),
(6, 6, 0.00, 0.00, 0.00, NULL, '2021-04-22 19:52:25'),
(7, 7, 0.00, 0.00, 0.00, NULL, '2021-04-22 19:52:25'),
(8, 8, 0.00, 0.00, 0.00, NULL, '2021-04-22 19:50:15'),
(9, 9, 0.00, 0.00, 0.00, NULL, '2021-04-23 16:49:48'),
(10, 10, 0.00, 0.00, 0.00, NULL, '2021-04-23 13:54:45'),
(11, 11, 0.00, 0.00, 0.00, NULL, '2021-04-22 19:52:24'),
(12, 12, 0.00, 0.00, 0.00, NULL, '2021-04-22 19:52:25'),
(13, 13, 0.00, 0.00, 0.00, NULL, '2021-04-22 19:52:25'),
(14, 14, 0.00, 0.00, 0.00, NULL, '2021-04-22 19:52:25'),
(15, 15, 0.00, 0.00, 0.00, NULL, '2021-04-22 19:52:25');


-- ELIMINAR LAS TABLAS DE ABAJO PARA INICIALIZAR


-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `cedula`, `nombre`, `direccion`, `telefono`, `correo`, `visible`, `created_at`, `updated_at`) VALUES
(1, 'V66666666', 'JUAN CARLOS', 'Et non ut in rerum n', '+1 (923) 281-7684', 'zemeruvyf@mailinator.com', NULL, '2021-03-25 04:33:23', '2021-03-25 13:22:54'),
(2, 'V77777777', 'MANUEL', 'Eum non nihil ab rem', '+1 (535) 878-5983', 'walolib@mailinator.com', NULL, '2021-03-25 04:33:39', '2021-03-25 13:23:06'),
(3, 'V88888888', 'ROBERTO', 'Ab dicta sit quaerat', '+1 (941) 142-2648', 'lorunyve@mailinator.com', NULL, '2021-03-25 04:33:56', '2021-03-25 13:23:18'),
(4, 'V99999999', 'PEDRO', 'Quaerat ullam quia i', '+1 (558) 285-4931', 'cokovuqog@mailinator.com', NULL, '2021-03-25 04:34:12', '2021-03-25 13:23:40'),
(5, 'V12345678', 'LUIS MANUEL', 'Consequatur consequa', '+1 (488) 122-9185', 'qimy@mailinator.com', NULL, '2021-03-25 04:34:37', '2021-03-25 13:24:05');


-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `cedulac`, `nombrec`, `direccionc`, `telefonoc`, `correoc`, `visiblec`, `created_at`, `updated_at`) VALUES
(1, 'V11111111', 'PEDRO PEREZ', 'MARACAY', '333', 'a@b.com', NULL, '2021-03-25 04:25:59', '2021-03-25 04:25:59'),
(2, 'V22222222', 'CARLOS', 'Animi aut odio et c', '+1 (693) 814-9635', 'wikocoj@mailinator.com', NULL, '2021-03-25 04:26:35', '2021-03-25 13:21:42'),
(3, 'V33333333', 'JUAN', 'Est commodi aut sunt', '+1 (779) 459-5104', 'tavumasujy@mailinator.com', NULL, '2021-03-25 04:27:07', '2021-03-25 13:21:51'),
(4, 'V44444444', 'MARCOS', 'Suscipit quia dignis', '+1 (465) 945-7076', 'qihelac@mailinator.com', NULL, '2021-03-25 04:27:53', '2021-03-25 13:22:02'),
(5, 'V55555555', 'LUIS', 'Corporis ullam qui e', '+1 (381) 847-8426', 'qapecon@mailinator.com', NULL, '2021-03-25 04:28:16', '2021-03-25 13:22:16'),
(6, '123', 'maria ', 'maracay ', '0412-456321', 'akire56@hotmail.com', NULL, '2021-04-16 21:10:55', '2021-04-16 21:10:55');


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


