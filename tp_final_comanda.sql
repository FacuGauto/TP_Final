-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-12-2019 a las 11:22:01
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tp_final_comanda`
--
CREATE DATABASE IF NOT EXISTS `tp_final_comanda` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci;
USE `tp_final_comanda`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(60) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_tipo_empleado` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `apellido`, `id_tipo_empleado`, `usuario`, `clave`, `created_at`, `updated_at`) VALUES
(1, 'Cristian', 'Ferreira', 1, 'cristian', 'stbu3CrK.J7XE', '2019-12-13 03:44:00', '2019-12-16 02:14:48'),
(2, 'Federico', 'Lopez', 1, 'federico', 'stbu3CrK.J7XE', '2019-12-13 03:44:00', '2019-12-16 02:14:40'),
(3, 'Nicolas', 'Vazquez', 1, 'nicolas', 'stbu3CrK.J7XE', '2019-12-13 03:44:00', '2019-12-15 05:51:09'),
(4, 'Martina', 'Rolon', 3, 'luciano', 'stbu3CrK.J7XE', '2019-12-13 03:44:00', '2019-12-15 05:51:29'),
(5, 'Luciano', 'Zarate', 4, 'luciano', 'stbu3CrK.J7XE', '2019-12-13 03:44:00', '2019-12-16 02:15:10'),
(7, 'Morena', 'Pardo', 3, 'morena', 'stbu3CrK.J7XE', '2019-12-15 00:41:05', '2019-12-16 02:15:26'),
(9, 'Julian', 'Acosta', 5, 'julian', 'stbu3CrK.J7XE', '2019-12-15 03:33:27', '2019-12-16 02:15:44'),
(11, 'Ayrton', 'Zarate', 1, 'ayrton', 'stbu3CrK.J7XE', '2019-12-16 02:14:12', '2019-12-16 02:14:12'),
(12, 'Julieta', 'Garcia', 5, 'julieta', 'stbu3CrK.J7XE', '2019-12-16 02:20:01', '2019-12-16 02:20:01'),
(13, 'Pablo', 'Ramires', 5, 'pablo', 'stbu3CrK.J7XE', '2019-12-16 02:27:27', '2019-12-16 02:27:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_mesa`
--

CREATE TABLE `estados_mesa` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `estados_mesa`
--

INSERT INTO `estados_mesa` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'con cliente esperando pedido', '2019-12-15 03:03:48', '2019-12-15 03:03:48'),
(2, 'con clientes comiendo', '2019-12-15 03:03:48', '2019-12-15 03:03:48'),
(3, 'con clientes pagando', '2019-12-15 03:03:48', '2019-12-15 03:03:48'),
(4, 'cerrada', '2019-12-15 03:03:48', '2019-12-15 03:03:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pedidos`
--

CREATE TABLE `estado_pedidos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `estado_pedidos`
--

INSERT INTO `estado_pedidos` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'recibido', '2019-12-15 02:59:39', '2019-12-15 02:59:39'),
(2, 'en preparacion', '2019-12-15 02:59:39', '2019-12-15 02:59:39'),
(3, 'listo para servir', '2019-12-15 02:59:39', '2019-12-15 02:59:39'),
(4, 'servido', '2019-12-15 02:59:39', '2019-12-15 02:59:39'),
(5, 'cobrado', '2019-12-15 02:59:39', '2019-12-15 02:59:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `codigo_mesa` varchar(10) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_estado_mesa` int(11) NOT NULL,
  `foto` varchar(200) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `codigo_mesa`, `id_estado_mesa`, `foto`, `created_at`, `updated_at`) VALUES
(4, 'AA1235', 1, './Fotos/Mesas/AA1235.jpg', '2019-12-15 10:18:56', '2019-12-16 04:45:43'),
(7, 'AA1238', 2, './Fotos/Mesas/AA1238.jpg', '2019-12-16 02:37:37', '2019-12-16 02:39:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_estado_pedido` int(11) NOT NULL,
  `codigo_pedido` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `productos` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `tiempo` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_estado_pedido`, `codigo_pedido`, `id_mesa`, `id_empleado`, `productos`, `tiempo`, `created_at`, `updated_at`) VALUES
(1, 2, '23', 4, 3, '', 60, '2019-12-16 00:52:08', '2019-12-16 00:52:08'),
(3, 1, '1', 4, 1, '', 60, '2019-12-16 06:50:58', '2019-12-16 06:50:58'),
(4, 1, '1', 4, 1, '', 60, '2019-12-17 02:52:05', '2019-12-17 02:52:05'),
(5, 1, '1', 5, 1, '', 60, '2019-12-17 02:52:11', '2019-12-17 02:52:11'),
(6, 1, 'AB12', 4, 1, '', 60, '2019-12-17 03:20:46', '2019-12-17 03:20:46'),
(7, 1, 'AB12', 4, 1, '', 60, '2019-12-17 03:20:58', '2019-12-17 03:20:58'),
(8, 1, 'AB12', 4, 1, '', 60, '2019-12-17 03:37:59', '2019-12-17 03:37:59'),
(9, 3, 'AB12', 4, 1, 'sprite,te,milanesa de carne,hamburguesa sola', 0, '2019-12-17 04:54:01', '2019-12-17 05:42:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

CREATE TABLE `pedidos_productos` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `pedidos_productos`
--

INSERT INTO `pedidos_productos` (`id`, `id_producto`, `id_pedido`, `created_at`, `updated_at`) VALUES
(1, 1, 7, '2019-12-16 23:31:56', '2019-12-16 23:31:56'),
(2, 2, 7, '2019-12-16 23:31:56', '2019-12-16 23:31:56'),
(3, 4, 7, '2019-12-16 23:31:56', '2019-12-16 23:31:56'),
(4, 7, 7, '2019-12-16 23:31:56', '2019-12-16 23:31:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `descripcion`, `precio`, `created_at`, `updated_at`) VALUES
(1, 'Sprite', 80, '2019-12-15 03:24:52', '2019-12-15 03:24:52'),
(2, 'Coca Cola', 80, '2019-12-15 03:24:52', '2019-12-15 03:24:52'),
(3, 'Te', 50, '2019-12-15 03:24:52', '2019-12-15 03:24:52'),
(4, 'Agua', 60, '2019-12-15 03:24:52', '2019-12-15 03:24:52'),
(5, 'Cafe', 80, '2019-12-15 03:24:52', '2019-12-15 03:24:52'),
(6, 'Milanesa de carne', 160, '2019-12-15 03:50:17', '2019-12-15 07:50:17'),
(7, 'Pizza Muzzarella', 200, '2019-12-15 03:24:52', '2019-12-15 03:24:52'),
(8, 'Fideos caprese', 180, '2019-12-15 03:24:52', '2019-12-15 03:24:52'),
(9, 'Hamburguesa completa', 210, '2019-12-15 07:43:07', '2019-12-15 07:43:07'),
(11, 'Hamburguesa sola', 180, '2019-12-15 07:46:16', '2019-12-15 07:46:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_empleado`
--

CREATE TABLE `tipo_empleado` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_empleado`
--

INSERT INTO `tipo_empleado` (`id`, `descripcion`, `estado`) VALUES
(1, 'socio', 1),
(2, 'bartender', 1),
(3, 'cervecero', 1),
(4, 'cocinero', 1),
(5, 'mozo', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados_mesa`
--
ALTER TABLE `estados_mesa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_pedidos`
--
ALTER TABLE `estado_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_empleado`
--
ALTER TABLE `tipo_empleado`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `estados_mesa`
--
ALTER TABLE `estados_mesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estado_pedidos`
--
ALTER TABLE `estado_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tipo_empleado`
--
ALTER TABLE `tipo_empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
