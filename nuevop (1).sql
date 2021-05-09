-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2021 a las 20:43:59
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nuevop`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `cuit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `apellido`, `cuit`) VALUES
(4, 'Agus', 'Sadaca', NULL),
(10, 'Agus', 'Dos', 2147483647);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_factura`
--

CREATE TABLE `cliente_factura` (
  `id` int(11) NOT NULL,
  `mes` date NOT NULL,
  `total` int(10) NOT NULL,
  `abonado` float NOT NULL,
  `debe` float NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `id_detalle_factura` int(11) NOT NULL,
  `id_Producto` int(11) DEFAULT NULL,
  `precio_unitario` int(10) NOT NULL,
  `cantidad` float NOT NULL DEFAULT 1,
  `subtotal` float DEFAULT NULL,
  `id_factura` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`id_detalle_factura`, `id_Producto`, `precio_unitario`, `cantidad`, `subtotal`, `id_factura`) VALUES
(1, 5, 100, 1, 200, 39),
(2, 7, 100, 1, 100, 39),
(10, 8, 70, 1, 70, 38),
(11, 8, 70, 1, 70, 38),
(12, 8, 70, 1, 70, 38),
(13, 8, 70, 1, 70, 38),
(16, 8, 70, 3, 210, 40),
(17, 8, 70, 1, 70, 40),
(18, 8, 70, 1, 70, 41),
(19, 8, 70, 1, 70, 41),
(20, 8, 70, 1, 70, 41),
(21, 8, 70, 1, 70, 41),
(22, 5, 200, 5, 1000, 41),
(23, 8, 70, 4, 280, 42),
(29, 8, 70, 1, 70, 43),
(30, 8, 70, 1, 70, 43),
(31, 8, 70, 1, 70, 43),
(32, 8, 70, 1, 70, 45),
(33, 8, 70, 1, 70, 45),
(34, 8, 70, 1, 70, 45),
(35, 8, 70, 1, 70, 45),
(36, 8, 70, 1, 70, 46),
(37, 8, 70, 1, 70, 46),
(38, 8, 70, 1, 70, 46),
(39, 8, 70, 1, 70, 46),
(40, 4, 0, 2, 200, 46),
(41, 5, 0, 1, 145141, 43),
(42, 7, 0, 1, 100, 47),
(49, 8, 70, 1, 70, 48),
(50, 8, 0, 1, 70, 48),
(51, 8, 70, 1, 70, 48),
(52, 7, 0, 1, 100, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `total` int(20) NOT NULL,
  `paga_con` int(10) DEFAULT NULL,
  `vuelto` int(10) DEFAULT NULL,
  `id_cliente` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `date`, `total`, `paga_con`, `vuelto`, `id_cliente`) VALUES
(46, '2021-04-09 13:06:28', 0, NULL, NULL, 6),
(48, '2021-04-10 17:09:36', 210, 300, 90, 0),
(49, '2021-04-18 14:14:18', 0, NULL, NULL, 0),
(50, '2021-04-18 16:03:15', 100, 0, -100, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_afip`
--

CREATE TABLE `factura_afip` (
  `id` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `total` float NOT NULL,
  `nro_cae` int(11) DEFAULT NULL,
  `id_cliente` int(10) DEFAULT NULL,
  `id_tipo_comprobante` int(10) DEFAULT NULL,
  `id_factura_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura_afip`
--

INSERT INTO `factura_afip` (`id`, `fecha_creacion`, `total`, `nro_cae`, `id_cliente`, `id_tipo_comprobante`, `id_factura_estado`) VALUES
(3, '2021-05-03', 333, NULL, NULL, NULL, 0),
(8, '2021-05-03', 4444, NULL, 10, 6, 0),
(9, '2021-05-04', 132, NULL, 4, 6, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_estado`
--

CREATE TABLE `factura_estado` (
  `id` int(11) NOT NULL,
  `nombre_estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura_estado`
--

INSERT INTO `factura_estado` (`id`, `nombre_estado`) VALUES
(1, 'procesando'),
(2, 'error'),
(5, 'creada con exito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_estado_fecha`
--

CREATE TABLE `factura_estado_fecha` (
  `id` int(10) NOT NULL,
  `fecha_desde` date DEFAULT NULL,
  `fecha_hasta` date DEFAULT NULL,
  `id_factura` int(11) DEFAULT NULL,
  `id_factura_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_de_precios`
--

CREATE TABLE `lista_de_precios` (
  `id` int(10) NOT NULL,
  `fechaDesde` date NOT NULL,
  `fechaHasta` date DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `id_Producto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lista_de_precios`
--

INSERT INTO `lista_de_precios` (`id`, `fechaDesde`, `fechaHasta`, `precio`, `id_Producto`) VALUES
(1, '2021-02-15', NULL, 100, 4),
(2, '2021-02-15', '2021-04-08', 115, 3),
(3, '2021-03-04', '2021-04-09', 200, 5),
(4, '2021-03-15', NULL, 100, 7),
(5, '2021-03-15', NULL, 70, 8),
(6, '2021-03-22', NULL, 80, 9),
(7, '2021-03-30', '2021-04-08', 15, 10),
(10, '2021-04-08', NULL, 100, 11),
(11, '2021-04-08', NULL, 44, 14),
(12, '2021-04-08', '2021-04-08', 300, 10),
(13, '2021-04-08', NULL, 0, 11),
(14, '2021-04-08', NULL, 0, 12),
(15, '2021-04-08', NULL, 500, 10),
(16, '2021-04-08', '2021-04-09', 30, 3),
(17, '2021-04-08', '2021-04-08', 30013, 3),
(18, '2021-04-08', NULL, 200, 3),
(19, '2021-04-09', '2021-04-10', 145141, 5),
(20, '2021-04-10', '2021-04-10', 100, 5),
(21, '2021-04-10', NULL, 115, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `id` int(11) NOT NULL,
  `fechaCompra` date NOT NULL,
  `fechaVencimiento` date NOT NULL,
  `cantidad` float NOT NULL,
  `id_Producto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`id`, `fechaCompra`, `fechaVencimiento`, `cantidad`, `id_Producto`) VALUES
(1, '0000-00-00', '0000-00-00', 123, 0),
(2, '2021-03-10', '2021-03-10', 2, 13),
(3, '2021-03-10', '2021-03-10', 1, 6),
(4, '2021-03-15', '2021-06-16', 22, 7),
(5, '2021-03-15', '2021-06-15', 0, 8),
(6, '2021-03-22', '2021-11-21', 28, 9),
(9, '2021-03-10', '2021-03-10', 0, 8),
(10, '2021-03-29', '2021-04-21', 0, 8),
(13, '2021-03-29', '2021-03-31', 0, 5),
(14, '2021-03-30', '2021-03-30', 5, 10),
(15, '2021-03-30', '2021-03-30', 1, 10),
(20, '2021-03-30', '2021-06-23', 0, 8),
(21, '2021-03-30', '2021-07-14', 40, 3),
(22, '2021-04-05', '2019-07-24', 100, 10),
(23, '0000-00-00', '2021-06-29', 8, 8),
(24, '2021-04-08', '2021-04-30', 20, 11),
(25, '2021-04-08', '2021-04-22', 100, 11),
(26, '2021-04-08', '2021-04-08', 21, 11),
(27, '2021-04-08', '2021-04-08', 21, 11),
(28, '2021-04-08', '2021-04-08', 12, 11),
(29, '2021-04-08', '2021-04-08', 12, 11),
(30, '2021-04-08', '2021-04-08', 12, 11),
(31, '2021-04-08', '2021-04-22', 98, 3),
(32, '2021-04-08', '2021-04-08', 44, 14),
(33, '2021-04-08', '2021-04-08', 3, 17),
(34, '2021-04-08', '2021-04-08', 1, 18),
(35, '2021-04-08', '2021-04-08', 13, 19),
(36, '2021-04-08', '2021-04-08', 1313, 21),
(37, '2021-04-08', '2021-04-08', 133, 22),
(38, '2021-04-08', '2021-04-08', 444, 29),
(39, '2021-04-08', '2021-04-08', 44, 35),
(40, '2021-04-08', '2021-04-08', 13, 36),
(41, '2021-04-08', '2021-04-08', 13333, 11),
(42, '2021-04-08', '2021-04-08', 333, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nombre` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `root` int(11) DEFAULT NULL,
  `url` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `target` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `orden` int(2) DEFAULT NULL,
  `menu` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `nombre`, `parent`, `root`, `url`, `target`, `orden`, `menu`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 'Inicio', NULL, NULL, 'Login/inicio', NULL, NULL, 1, NULL, NULL, NULL),
(12, 'Punto de Venta', NULL, NULL, 'PuntoVenta/venta', NULL, NULL, 1, NULL, NULL, NULL),
(13, 'Productos', NULL, NULL, 'Productos/listadoProductos', NULL, NULL, 1, NULL, NULL, NULL),
(15, 'Administrar productos', 13, NULL, 'Productos/listadoProductos', NULL, NULL, 1, NULL, NULL, NULL),
(16, 'Clientes', NULL, NULL, 'Clientes/clientes', NULL, NULL, 1, NULL, NULL, NULL),
(17, 'Importar productos', 13, NULL, 'Productos/listadoProductos', NULL, NULL, 1, NULL, NULL, NULL),
(18, 'Reportes', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(19, 'Facturación Afip', NULL, NULL, 'AfipFacturacion/afip', NULL, NULL, 1, NULL, NULL, NULL),
(20, 'Salir', NULL, NULL, 'login/salir', NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_Producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cod_barras` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_Producto`, `nombre`, `cod_barras`) VALUES
(3, 'coca 1.5lts', '7790520009494'),
(4, 'pepsi 1.5lts', '7790520017420'),
(5, 'alcohol en gel sanigel 250cm3', '7798188650348'),
(7, 'cafe instantaneo La Virginia 100g', '7790150102039'),
(8, 'chocolino 180g', '7790150830857'),
(9, 'Frutigran avena, chia y lino 240g', '7790045825395');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_comprobante`
--

CREATE TABLE `tipo_comprobante` (
  `id` int(11) NOT NULL,
  `nombre_tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_comprobante`
--

INSERT INTO `tipo_comprobante` (`id`, `nombre_tipo`) VALUES
(1, 'Factura A'),
(2, 'Nota de Débito A\r\n'),
(3, 'Nota de Crédito A'),
(6, 'Factura B'),
(7, 'Nota de Débito B'),
(8, 'Nota de Crédito B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text DEFAULT NULL,
  `deleted_at` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `deleted_at`) VALUES
(1, 'admin', 'admin', 1),
(2, 'david', '123asda', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente_factura`
--
ALTER TABLE `cliente_factura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_detalle_factura`),
  ADD UNIQUE KEY `id_detalle_factura` (`id_detalle_factura`),
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `id_factura_2` (`id_factura`),
  ADD KEY `id_factura_3` (`id_factura`),
  ADD KEY `id_factura_4` (`id_factura`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura_afip`
--
ALTER TABLE `factura_afip`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura_estado`
--
ALTER TABLE `factura_estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura_estado_fecha`
--
ALTER TABLE `factura_estado_fecha`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lista_de_precios`
--
ALTER TABLE `lista_de_precios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_Producto`);

--
-- Indices de la tabla `tipo_comprobante`
--
ALTER TABLE `tipo_comprobante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cliente_factura`
--
ALTER TABLE `cliente_factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `factura_afip`
--
ALTER TABLE `factura_afip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `factura_estado`
--
ALTER TABLE `factura_estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `factura_estado_fecha`
--
ALTER TABLE `factura_estado_fecha`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lista_de_precios`
--
ALTER TABLE `lista_de_precios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
