-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2022 a las 18:27:05
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
  `cuit` bigint(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `apellido`, `cuit`) VALUES
(4, 'Agus', 'Sadaca', 20389081966),
(10, 'Agus', 'Dos', 20389081966),
(11, 'Agustin Sadaca3', 'Sadaca', 20389081966),
(12, 'Matias', 'Reinoso', 20365454136),
(13, 'Jorge', 'Sadaca', NULL);

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
(38, 8, 70, 1, 70, 46),
(39, 8, 70, 1, 70, 46),
(40, 4, 0, 2, 200, 46),
(41, 5, 0, 1, 145141, 43),
(42, 7, 0, 1, 100, 47),
(49, 8, 70, 1, 70, 48),
(50, 8, 0, 1, 70, 48),
(51, 8, 70, 1, 70, 48),
(52, 7, 0, 1, 100, 50),
(53, 8, 0, 1, 70, 49),
(54, 7, 0, 1, 100, 54),
(55, 10, 0, 3, 1500, 55),
(56, 8, 0, 1, 70, 55),
(57, 5, 0, 3, 345, 54),
(58, 8, 0, 1, 70, 54),
(59, 10, 0, 3, 1500, 54),
(60, 10, 0, 4, 2000, 56),
(61, 7, 0, 3, 300, 57),
(62, 3, 0, 1, 200, 58),
(63, 10, 0, 1, 500, 59),
(64, 5, 0, 4, 460, 63),
(65, 5, 0, 1, 115, 63),
(66, 5, 0, 1, 115, 64),
(67, 46, 30, 1, 30, 55),
(69, 46, 30, 1, 30, 67),
(73, 46, 30, 1, 30, 68),
(74, 46, 30, 1, 30, 68),
(76, 47, 100, 3, 300, 69),
(81, 5, 115, 3, 345, 70),
(82, 48, 200, 1, 200, 70),
(83, 46, 50, 4, 200, 70),
(84, 51, 100, 1, 100, 72),
(88, 46, 50, 1, 50, 74),
(89, 46, 50, 1, 50, 72),
(90, 5, 115, 1, 115, 75),
(91, 9, 80, 3, 240, 76),
(92, 52, 50, 13, 650, 77),
(93, 8, 70, 5, 350, 78);

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
(54, '2021-09-27 23:09:46', 100, 0, -100, 10),
(55, '2021-10-10 00:46:40', 1600, 1700, 100, 4),
(56, '2021-10-10 01:22:44', 0, NULL, NULL, 10),
(57, '2021-10-11 12:21:50', 300, 0, -300, 0),
(58, '2021-07-11 12:22:17', 200, 0, -200, 10),
(59, '2021-10-11 12:34:16', 500, 0, -500, 10),
(67, '2021-10-17 18:06:04', 30, 30, 0, 4),
(72, '2021-10-18 18:00:13', 150, 0, -150, 12),
(74, '2021-10-18 19:57:52', 50, 100, 50, 0),
(75, '2022-03-20 15:48:35', 115, 0, -115, 10),
(76, '2022-03-20 15:48:59', 240, 0, -240, 11),
(77, '2022-02-20 15:49:46', 650, 0, -650, 13),
(78, '2022-02-20 15:50:12', 350, 0, -350, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_afip`
--

CREATE TABLE `factura_afip` (
  `id` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `total` float NOT NULL,
  `nro_cae` bigint(33) DEFAULT NULL,
  `nro_comprobante` int(15) NOT NULL,
  `id_cliente` int(10) DEFAULT NULL,
  `id_tipo_comprobante` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura_afip`
--

INSERT INTO `factura_afip` (`id`, `fecha_creacion`, `total`, `nro_cae`, `nro_comprobante`, `id_cliente`, `id_tipo_comprobante`) VALUES
(57, '2021-06-01', 345, 71249946095901, 58, 10, 6),
(58, '2021-06-01', 13, 71249946358270, 59, NULL, 6),
(59, '2021-07-19', 13, 71359964164100, 13, 10, 1),
(60, '2021-07-20', 3, 71359964164113, 60, NULL, 6),
(61, '2021-08-01', 1, 71359964164126, 61, 10, 6),
(62, '2021-08-01', 200, 71359964165923, 14, 4, 1),
(67, '2021-10-17', 300, NULL, 0, NULL, 6),
(69, '2021-10-17', 13, NULL, 0, 10, 6),
(70, '2021-10-18', 30000, NULL, 0, 4, 6),
(72, '2021-10-18', 100, NULL, 0, NULL, 6),
(73, '2021-10-18', 300, NULL, 2147483647, 10, 8);

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

--
-- Volcado de datos para la tabla `factura_estado_fecha`
--

INSERT INTO `factura_estado_fecha` (`id`, `fecha_desde`, `fecha_hasta`, `id_factura`, `id_factura_estado`) VALUES
(9, '2021-05-24', NULL, 3, 5),
(10, '2021-05-24', NULL, 8, 5),
(11, '2021-05-24', NULL, 9, 5),
(12, '2021-05-24', NULL, 10, 5),
(13, '2021-05-24', NULL, 11, 5),
(14, '2021-05-24', NULL, 12, 5),
(15, '2021-05-24', NULL, 13, 5),
(16, '2021-05-24', NULL, 14, 1),
(17, '2021-05-24', NULL, 15, 1),
(18, '2021-05-24', NULL, 16, 1),
(19, '2021-06-05', NULL, 17, 5),
(20, '2021-06-05', NULL, 18, 5),
(21, '2021-06-05', NULL, 19, 5),
(22, '2021-06-05', NULL, 20, 5),
(23, '2021-06-05', NULL, 21, 2),
(24, '2021-06-05', NULL, 22, 5),
(25, '2021-06-10', NULL, 23, 1),
(26, '2021-06-10', NULL, 24, 5),
(27, '2021-06-05', NULL, 26, 1),
(28, '2021-06-10', NULL, 27, 1),
(29, '2021-06-10', NULL, 34, 5),
(30, '2021-06-10', NULL, 35, 5),
(31, '2021-06-10', NULL, 36, 1),
(32, '2021-06-10', NULL, 37, 5),
(33, '2021-06-10', NULL, 38, 1),
(34, '2021-06-10', NULL, 39, 5),
(35, '2021-06-10', NULL, 40, 5),
(36, '2021-06-10', NULL, 41, 5),
(37, '2021-06-10', NULL, 42, 5),
(38, '2021-06-10', NULL, 43, 5),
(39, '2021-06-10', NULL, 44, 5),
(40, '2021-06-10', NULL, 45, 5),
(41, '2021-06-10', NULL, 46, 5),
(42, '2021-06-10', NULL, 47, 5),
(43, '2021-06-10', NULL, 48, 5),
(44, '2021-06-10', NULL, 49, 5),
(45, '2021-06-12', NULL, 57, 5),
(46, '2021-06-13', NULL, 58, 5),
(47, '2021-08-31', NULL, 59, 5),
(48, '2021-08-31', NULL, 60, 5),
(49, '2021-08-31', NULL, 61, 5),
(50, '2021-09-01', NULL, 62, 5),
(51, '2021-10-11', NULL, 64, 5),
(52, '2021-10-11', NULL, 65, 1),
(53, '2021-10-17', NULL, 66, 1),
(54, '2021-10-17', NULL, 63, 1),
(55, '2021-10-18', NULL, 67, 2),
(56, '2021-10-17', NULL, 68, 1),
(57, '2021-10-18', NULL, 69, 2),
(58, '2021-10-18', NULL, 70, 2),
(59, '2021-10-18', NULL, 72, 2);

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
(15, '2021-04-08', NULL, 500, 10),
(16, '2021-04-08', '2021-04-09', 30, 3),
(17, '2021-04-08', '2021-04-08', 30013, 3),
(18, '2021-04-08', '2021-10-18', 200, 3),
(19, '2021-04-09', '2021-04-10', 145141, 5),
(20, '2021-04-10', '2021-04-10', 100, 5),
(21, '2021-04-10', NULL, 115, 5),
(22, '2021-08-16', NULL, 0, 10),
(23, '2021-08-31', NULL, 200, 10),
(24, '2021-08-31', NULL, 200, 10),
(25, '2021-10-11', NULL, 10, 11),
(26, '2021-10-11', NULL, 13, 11),
(39, '2021-10-16', NULL, 1, 44),
(42, '2021-10-17', '2021-10-17', 30, 46),
(45, '2021-10-17', NULL, 1, 48),
(46, '2021-10-17', NULL, 50, 46),
(47, '2021-10-18', '2021-10-18', 110, 3),
(48, '2021-10-18', NULL, 200, 3),
(50, '2021-10-18', '2021-10-18', 100, 51),
(51, '2021-10-18', NULL, 120, 51),
(52, '2021-10-18', NULL, 50, 52);

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
(4, '2021-03-15', '2021-06-16', 18, 7),
(5, '2021-03-15', '2021-06-15', 0, 8),
(6, '2021-03-22', '2021-11-21', 25, 9),
(9, '2021-03-10', '2021-03-10', 0, 8),
(10, '2021-03-29', '2021-04-21', 0, 8),
(13, '2021-03-29', '2021-03-31', 12, 5),
(14, '2021-03-30', '2021-03-30', 5, 10),
(15, '2021-03-30', '2021-03-30', 1, 10),
(20, '2021-03-30', '2021-06-23', 0, 8),
(21, '2021-03-30', '2021-07-14', 40, 3),
(22, '2021-04-05', '2019-07-24', 89, 10),
(23, '0000-00-00', '2021-06-29', -2, 8),
(31, '2021-04-08', '2021-04-22', 97, 3),
(32, '2021-04-08', '2021-04-08', 44, 14),
(33, '2021-04-08', '2021-04-08', 3, 17),
(34, '2021-04-08', '2021-04-08', 1, 18),
(35, '2021-04-08', '2021-04-08', 13, 19),
(36, '2021-04-08', '2021-04-08', 1313, 21),
(37, '2021-04-08', '2021-04-08', 133, 22),
(38, '2021-04-08', '2021-04-08', 444, 29),
(39, '2021-04-08', '2021-04-08', 44, 35),
(40, '2021-04-08', '2021-04-08', 13, 36),
(43, '2021-08-16', '2021-08-16', 1, 10),
(44, '2021-08-31', '2021-08-31', 20, 10),
(45, '2021-08-31', '2021-08-31', 20, 10),
(47, '2021-10-11', '2021-10-11', 13, 11),
(50, '2021-10-16', '2021-10-20', 1, 44),
(53, '2021-10-10', '2022-10-05', 16, 5),
(54, '2021-10-17', '2022-10-12', 29, 46),
(55, '2021-10-01', '2022-10-02', 9, 46),
(58, '2021-10-17', '2031-10-31', 100000000, 48),
(61, '2021-10-18', '2021-10-18', 60, 51),
(62, '2021-10-18', '2022-10-18', 37, 52),
(63, '2021-10-01', '2022-10-31', 60, 52);

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
(18, 'Reportes', NULL, NULL, 'Reportes/getReportes', NULL, NULL, 1, NULL, NULL, NULL),
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
(5, 'alcohol en gel sanigel 250cm3', '7798188650348'),
(7, 'cafe instantaneo La Virginia 100g', '7790150102039'),
(8, 'chocolino 180g', '7790150830857'),
(9, 'Frutigran avena, chia y lino 240g', '7790045825395'),
(10, 'Alcohol x240ml', ''),
(11, 'Bronceador1', ''),
(46, 'ticTac', '7861002901831'),
(48, 'Otro', '1'),
(51, 'Cafe La Virginia x 170g', '7790150100356'),
(52, 'Te', '7790150396162');

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
(2, 'david', '123asda', 1),
(3, 'vendedor', 'vendedor', 1);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `cliente_factura`
--
ALTER TABLE `cliente_factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `factura_afip`
--
ALTER TABLE `factura_afip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `factura_estado`
--
ALTER TABLE `factura_estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `factura_estado_fecha`
--
ALTER TABLE `factura_estado_fecha`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `lista_de_precios`
--
ALTER TABLE `lista_de_precios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
