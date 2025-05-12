-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 28-12-2023 a las 19:38:14
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_mega`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int NOT NULL,
  `nombre_categoria` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `estado`) VALUES
(71, 'equipos de comunicacion', 1),
(72, 'productos electronico', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int NOT NULL,
  `id_persona` int NOT NULL,
  `serie` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `numero` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `igv` decimal(10,3) NOT NULL,
  `tipo_moneda` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_soles` decimal(11,3) NOT NULL,
  `total_dolares` decimal(10,3) NOT NULL,
  `fecha_registro` date NOT NULL,
  `valor_moneda` decimal(10,3) NOT NULL,
  `estado` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_compra`, `id_persona`, `serie`, `numero`, `igv`, `tipo_moneda`, `total_soles`, `total_dolares`, `fecha_registro`, `valor_moneda`, `estado`) VALUES
(162, 187, '12121', '12121', 5.400, 'soles', 35.400, 9.486, '2023-11-29', 3.732, '1'),
(163, 192, '12121', '12121', 3.600, 'dolar', 88.240, 23.600, '2023-12-01', 3.739, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int NOT NULL,
  `ruc` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` int NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `razon_social` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `nombre_comercial` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `Direccion` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `ruc`, `telefono`, `email`, `razon_social`, `nombre_comercial`, `Direccion`) VALUES
(1, '20606476834', 978030479, 'Inversionesventasfyc@gmail.com', 'INVERSIONES EN BIENES Y SERVICIOS MEGA F Y C E.I.R.L', 'Inversiones Mega', 'Cal. Juan Cuglievan Nro. 856 Int. 30 Cercado de Chiclayo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id_detc` int NOT NULL,
  `id_compra` int NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad_detc` int NOT NULL,
  `precio_detc` decimal(10,3) NOT NULL,
  `subtotal_fila` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id_detc`, `id_compra`, `id_producto`, `cantidad_detc`, `precio_detc`, `subtotal_fila`) VALUES
(592, 163, 39, 4, 5.000, 20.000),
(593, 162, 39, 5, 6.000, 30.000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detv` int NOT NULL,
  `id_venta` int NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad_detv` int NOT NULL,
  `precio_detv` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidad`
--

CREATE TABLE `entidad` (
  `id_entidad` int NOT NULL,
  `id_persona` int NOT NULL,
  `tipo_entidad` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `subtipo_entidad` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `n_documentacion` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `correo_entidad` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `direccion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `referencia` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `distrito` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `provincia` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `departamento` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `razon_social` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `razon_comercial` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estado` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entidad`
--

INSERT INTO `entidad` (`id_entidad`, `id_persona`, `tipo_entidad`, `subtipo_entidad`, `n_documentacion`, `correo_entidad`, `direccion`, `referencia`, `distrito`, `provincia`, `departamento`, `razon_social`, `razon_comercial`, `descripcion`, `estado`) VALUES
(89, 187, 'vendedor', 'proveedor', '20170072465', '23@gmail.com', 'CAL. JACINTO IBAÑEZ NRO 315 URB. PARQUE INDUSTRIAL ', '  Jirón Río Huara, 5369, Urb Villa Del Norte', 'AREQUIPA', 'AREQUIPA', 'AREQUIPA', 'SOCIEDAD MINERA CERRO VERDE S.A.A.', 'Sociedad minera del peru', 'Mejor calidad de minerales para su uso continuo ', 1),
(90, 188, 'comprador', 'natural', '73887271', '9932@gmail.com', NULL, NULL, NULL, NULL, 'lambayeque', NULL, NULL, NULL, 1),
(93, 192, 'vendedor', 'proveedor', '20606476834', 'a@gmail.com', 'CAL. JUAN CUGLIEVAN NRO 856 INT. 30 CERCADO DE CHICLAYO ', 'asdasd', 'CHICLAYO', 'CHICLAYO', 'LAMBAYEQUE', 'INVERSIONES EN BIENES Y SERVICIOS MEGA F Y C E.I.R.L.', 'INVERSIONES MEGA', 'Su objetivo es la venta o compra de productos electronicos ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familia`
--

CREATE TABLE `familia` (
  `id_familia` int NOT NULL,
  `nombre_familia` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `id_marca` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `familia`
--

INSERT INTO `familia` (`id_familia`, `nombre_familia`, `estado`, `id_marca`) VALUES
(50, 'POCO M14 SERIESS', 0, 49),
(51, 'g104 mouse serie', 1, 53),
(52, 'Redmi series', 1, 49);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int NOT NULL,
  `nombre_marca` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `id_subcategoria` int NOT NULL,
  `estado` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `nombre_marca`, `id_subcategoria`, `estado`) VALUES
(49, 'XIAMOI', 87, 1),
(50, 'motora lss ', 86, 1),
(52, 'motoralss', 86, 1),
(53, 'logitech', 88, 1),
(54, 'logitech', 87, 1),
(55, '123123', 86, 1),
(56, '123123', 87, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `id_modelo` int NOT NULL,
  `nombre_modelo` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion_modelo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `id_familia` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`id_modelo`, `nombre_modelo`, `descripcion_modelo`, `estado`, `id_familia`) VALUES
(131, 'poco-m14-2018', '- MPN: 36487\n- Color: Cool Blue\n- Garantía: 1 año\n- El Xiaomi Poco M4 Pro 5G es el sucesor del Poco M3 Pro. Con una pantalla de 6.6 pulgadas a resolución FHD+ y un refresh rate de 90Hz, el Poco M4 Pro 5G está potenciado por un procesador Media Tek Dimensity 810 con versiones de 6GB de RAM con 128GB de almacenamiento.', 1, 50),
(132, 'poco-m14-2019', '- MPN: 36488\n- Color: Cool Blue\n- Garantía: 1 año\n- El Xiaomi Poco M4 Pro 5G es el sucesor del Poco M3 Pro. Con una pantalla de 6.6 pulgadas a resolución FHD+ y un refresh rate de 90Hz, el Poco M4 Pro 5G está potenciado por un procesador Media Tek Dimensity 810 con versiones de 6GB de RAM con 128GB de almacenamiento.', 1, 51),
(133, ' Xiaomi Redmi Note 10 Pro', '- Procesador: Qualcomm® Snapdragon™ 732G\n- Almacenamiento y RAM: 6 GB + 64 GB | 6 GB + 128 GB | 8 GB + 128 GB RAM LPDDR4X + UFS 2.2\n- Dimensiones: 164 mm * 76,5 mm * 8,1 mm', 1, 52),
(134, 'Redmi Note 12 ', '- Procesador: MediaTek Helio G88\n- Pantalla: Pantalla DotDisplay FHD+ de 6,79\"\n- Diseño: Cuerpo curvo\n- Cámara trasera:\n- Cámara triple de 50 MP + 8 MP + 2 MP\n- Cámara frontal: Cámara selfie de 8 MP\n- Batería de 5000 mAh\n- Seguridad y autentificación: Sensor lateral de huellas dactilares, Desbloqueo facial por IA\n- Capacidad: 4GB+128GB', 1, 52);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `n_serie`
--

CREATE TABLE `n_serie` (
  `id` int NOT NULL,
  `img_serie` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int NOT NULL,
  `nombres` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `priapellido_persona` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `segapellido_persona` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `celular_persona` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefono_persona` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `nombres`, `priapellido_persona`, `segapellido_persona`, `celular_persona`, `telefono_persona`) VALUES
(121, 'WILFREDO', 'CAMPOS', 'CATUNTA', '948857714', NULL),
(184, 'PEDRO', 'GONZALES', 'AYMA', '987653231', NULL),
(185, 'PATRICIA ALEJANDRINA', 'PUICON', 'PINDAY', '123232323', NULL),
(187, NULL, NULL, NULL, '987653231', '987456'),
(188, 'PERSEO LUCHYANO', 'PANDO', 'VARGAS', '988327731', NULL),
(192, NULL, NULL, NULL, '939293929', '123718');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int NOT NULL,
  `codigo_referencia` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `id_modelo` int NOT NULL,
  `stock_actual` int NOT NULL DEFAULT '0',
  `estado` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `codigo_referencia`, `id_modelo`, `stock_actual`, `estado`) VALUES
(36, 'k01-1313', 131, 0, 1),
(37, 'k01-1311', 132, 0, 0),
(38, 'K001-A256-356', 133, 0, 1),
(39, 'K001-A256-355', 134, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int NOT NULL,
  `usuario_rol` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `usuario_rol`) VALUES
(1, 'Administrador'),
(2, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id_subcategoria` int NOT NULL,
  `nombre_subcategoria` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `id_categoria` int NOT NULL,
  `estado` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id_subcategoria`, `nombre_subcategoria`, `id_categoria`, `estado`) VALUES
(86, 'telefono', 71, 0),
(87, 'celulares', 71, 1),
(88, 'mouses', 72, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL,
  `id_persona` int NOT NULL,
  `dni_usuario` int NOT NULL,
  `correo_usuario` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `user_usuario` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `contrasena_usuario` varchar(260) COLLATE utf8mb4_general_ci NOT NULL,
  `id_rol` int DEFAULT NULL,
  `estado` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `id_persona`, `dni_usuario`, `correo_usuario`, `user_usuario`, `contrasena_usuario`, `id_rol`, `estado`) VALUES
(47, 121, 74663747, 'ab@gmail.com', 'admin', '$2y$10$rZ16a1QtXn3g3so729rCyeZLoZdOW8xhRAfM1ldXhruiWj5SGFSD6', 1, 1),
(60, 184, 73662511, 'abc@gmail.com', 'Administrador', '$2y$10$iL37VhPdKTQ7KR6KPNwZA.dKyheTujEnyNv1PW7XZsAidDV6xpZz2', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int NOT NULL,
  `id_entidad` int NOT NULL,
  `factura` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `total` int NOT NULL,
  `fecha_registro` date NOT NULL,
  `estado` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `fk_persona_compra` (`id_persona`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id_detc`),
  ADD KEY `fk_compra_det` (`id_compra`),
  ADD KEY `fk_pro_det` (`id_producto`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detv`),
  ADD KEY `fk_venta_detv` (`id_venta`),
  ADD KEY `fk_producto_detv` (`id_producto`);

--
-- Indices de la tabla `entidad`
--
ALTER TABLE `entidad`
  ADD PRIMARY KEY (`id_entidad`),
  ADD KEY `fk_persona_entidad` (`id_persona`);

--
-- Indices de la tabla `familia`
--
ALTER TABLE `familia`
  ADD PRIMARY KEY (`id_familia`),
  ADD KEY `fk_marca` (`id_marca`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`),
  ADD KEY `fk_subcategoria` (`id_subcategoria`);

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id_modelo`),
  ADD KEY `fk_subfamilia` (`id_familia`);

--
-- Indices de la tabla `n_serie`
--
ALTER TABLE `n_serie`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_modelo` (`id_modelo`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id_subcategoria`),
  ADD KEY `fk_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_persona_usuario` (`id_persona`),
  ADD KEY `fk_rol_usuario` (`id_rol`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id_detc` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=594;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detv` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entidad`
--
ALTER TABLE `entidad`
  MODIFY `id_entidad` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `familia`
--
ALTER TABLE `familia`
  MODIFY `id_familia` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id_modelo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT de la tabla `n_serie`
--
ALTER TABLE `n_serie`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id_subcategoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_persona_compra` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`);

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `fk_compra_det` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`),
  ADD CONSTRAINT `fk_pro_det` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_producto_detv` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `fk_venta_detv` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`);

--
-- Filtros para la tabla `entidad`
--
ALTER TABLE `entidad`
  ADD CONSTRAINT `fk_persona_entidad` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `familia`
--
ALTER TABLE `familia`
  ADD CONSTRAINT `fk_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`);

--
-- Filtros para la tabla `marca`
--
ALTER TABLE `marca`
  ADD CONSTRAINT `fk_subcategoria` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategoria` (`id_subcategoria`);

--
-- Filtros para la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `fk_subfamilia` FOREIGN KEY (`id_familia`) REFERENCES `familia` (`id_familia`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_modelo` FOREIGN KEY (`id_modelo`) REFERENCES `modelo` (`id_modelo`);

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_persona_usuario` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`),
  ADD CONSTRAINT `fk_rol_usuario` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
