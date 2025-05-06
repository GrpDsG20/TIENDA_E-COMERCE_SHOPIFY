-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2025 a las 22:46:03
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecomerce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Calzados'),
(2, 'Jeans'),
(5, 'Zapatos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_secundaria`
--

CREATE TABLE `categoria_secundaria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria_secundaria`
--

INSERT INTO `categoria_secundaria` (`id`, `nombre`) VALUES
(1, 'Mas vendido'),
(2, 'Mas populares'),
(3, 'ga'),
(4, 'JASZA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `contacto` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `departamento` varchar(50) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `distrito` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `contacto`, `correo`, `direccion`, `pais`, `departamento`, `provincia`, `distrito`) VALUES
(1, 'smith', '918231', 'dioa@gmail.com', 'av lo psas', 'Perú', 'Lima', 'Lima', 'indende'),
(2, 'smith', '918231', 'dioa@gmail.com', 'av lo psas', 'Perú', 'Lima', 'Lima', 'indende'),
(3, 'smith', '918231', 'dioa@gmail.com', 'av lo psas', 'Perú', 'Lima', 'Lima', 'indende'),
(4, 'smith', '12312', 'jsjda@gmail.com', 'asdas', 'Perú', 'La Libertad', 'Pacasmayo', 'sadasd'),
(5, 'smith', '19123', 'dison@gmail.com', '1dasd12', 'Perú', 'Moquegua', 'General Sánchez Cerro', 'qweqw'),
(6, 'hola', '918312', 'msith@gmail.com', 'asdas 123', 'Perú', 'La Libertad', 'Otuzco', '1231'),
(7, 'hola', '918312', 'msith@gmail.com', 'asdas 123', 'Perú', 'La Libertad', 'Otuzco', '1231'),
(8, 'hola qu', '12312', 'weasda@gmail.com', 'qweqw', 'Perú', 'Lambayeque', 'Chiclayo', 'qweq'),
(9, 'asda', '123', 'sada@gmail.com', '12312', 'Perú', 'Lima', 'Huaral', '123'),
(10, 'asda', '123', 'sada@gmail.com', '12312', 'Perú', 'Lima', 'Huaral', '123'),
(11, 'asda', '123', 'sada@gmail.com', '12312', 'Perú', 'Lima', 'Huaral', '123'),
(12, 'asda', '123', 'sada@gmail.com', '12312', 'Perú', 'Lima', 'Huaral', '123'),
(13, 'asda', '123', 'sada@gmail.com', '12312', 'Perú', 'Lima', 'Huaral', '123'),
(14, 'asda', '123', 'sada@gmail.com', '12312', 'Perú', 'Lima', 'Huaral', '123'),
(15, 'asda', '123', 'sada@gmail.com', '12312', 'Perú', 'Lima', 'Huaral', '123'),
(16, 'asda', '1231231', 'sada@gmail.com', 'avas 21312', 'Perú', 'Lima', 'Huaral', '123'),
(17, 'asda', '1231231', 'sada@gmail.com', 'avas 21312', 'Perú', 'Lima', 'Huaral', '123'),
(18, 'asda', '1231231', 'sada@gmail.com', 'avas 21312', 'Perú', 'Lima', 'Huaral', '123'),
(19, 'hola', '1239', 'asda@gmail.com', 'asv los pios', 'Perú', 'Junín', 'Concepción', 'asdas'),
(20, 'hola', '1239', 'asda@gmail.com', 'asv los pios', 'Perú', 'Junín', 'Concepción', 'asdas'),
(21, 'hola', '1239', 'asda@gmail.com', 'asv los pios', 'Perú', 'Junín', 'Concepción', 'asdas'),
(22, 'hola', '1239', 'asda@gmail.com', 'asv los pios', 'Perú', 'Junín', 'Concepción', 'asdas'),
(23, 'hola', '1239', 'asda@gmail.com', 'asv los pios', 'Perú', 'Junín', 'Concepción', 'asdas'),
(24, 'hola', '1239', 'asda@gmail.com', 'asv los pios', 'Perú', 'Junín', 'Concepción', 'asdas'),
(25, 'hola', '1239', 'asda@gmail.com', 'asv los pios', 'Perú', 'Junín', 'Concepción', 'asdas'),
(26, 'hola', '1239', 'asda@gmail.com', 'asv los pios', 'Perú', 'Junín', 'Concepción', 'asdas'),
(27, 'hola', '1239', 'asda@gmail.com', 'asv los pios', 'Perú', 'Junín', 'Concepción', 'asdas'),
(28, 'hola', '1239', 'asda@gmail.com', 'asv los pios', 'Perú', 'Junín', 'Concepción', 'asdas'),
(29, 'smith', '981231', 'sda@gmail.com', 'av los pinsaoi ', 'Perú', 'Ica', '', 'wqeq'),
(30, 'asdas', '1231', 'asadas@gmail.com', 'wqewqe', 'Perú', 'Loreto', 'Mariscal Ramón Castilla', 'qweq'),
(31, 'asdas', '12312', 'asda@gmail.com', 'qewqe', 'Perú', 'La Libertad', 'Otuzco', 'qweq'),
(32, 'smismafer', '12312', 'sada@gmail.com', 'qweqw', 'Perú', 'Lambayeque', 'Chiclayo', 'asda'),
(33, 'maferw', '123', 'asda@gmail.com', '1asd 123', 'Perú', 'Lima', 'Huaral', 'wqe'),
(34, 'mafersi', '1231', 'wqeqwgmail.com', 'qweqw', 'Perú', 'La Libertad', 'Pataz', 'dasdas'),
(35, 'mafeci', '123', 'sadas@gmail.com', 'qweq', 'Perú', 'Lima', 'Cañete', 'qwe'),
(36, 'amorico', '123', '', '', 'Perú', '', '', ''),
(37, 'mafer', '9812312', 'mafer@gmail.com', 'av comas', 'Perú', 'Lima', 'Lima', 'Comas'),
(38, 'jonas', '12', 'asd@gmail.com', 'rt', 'Perú', 'Lima', 'Lima', 'sadajs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_cancelacion` datetime DEFAULT NULL,
  `estado` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `id_cliente`, `total`, `fecha`, `fecha_cancelacion`, `estado`) VALUES
(1, 1, '0.00', '2025-03-19 21:24:00', NULL, ''),
(2, 2, '800.00', '2025-03-19 21:25:36', NULL, ''),
(3, 3, '1012.00', '2025-03-19 21:25:59', NULL, ''),
(4, 4, '200.00', '2025-03-19 21:34:36', NULL, ''),
(5, 5, '200.00', '2025-03-19 21:39:18', NULL, ''),
(6, 6, '1012.00', '2025-03-19 21:42:55', NULL, ''),
(7, 7, '200.00', '2025-03-19 21:45:25', NULL, ''),
(8, 8, '200.00', '2025-03-19 21:45:41', NULL, ''),
(9, 9, '200.00', '2025-03-19 21:46:47', NULL, ''),
(10, 10, '200.00', '2025-03-19 21:46:50', NULL, ''),
(11, 11, '200.00', '2025-03-19 21:46:51', NULL, 'en-proceso'),
(12, 12, '200.00', '2025-03-19 21:46:51', NULL, ''),
(13, 13, '200.00', '2025-03-19 21:46:52', NULL, ''),
(14, 14, '200.00', '2025-03-19 21:46:52', NULL, ''),
(15, 15, '200.00', '2025-03-19 21:46:53', NULL, ''),
(16, 16, '200.00', '2025-03-19 21:47:19', NULL, ''),
(17, 17, '200.00', '2025-03-19 21:47:20', NULL, ''),
(18, 18, '200.00', '2025-03-19 21:47:20', NULL, ''),
(19, 19, '412.00', '2025-03-19 21:47:51', NULL, ''),
(20, 20, '412.00', '2025-03-19 21:47:52', NULL, ''),
(21, 21, '412.00', '2025-03-19 21:47:52', NULL, ''),
(22, 22, '412.00', '2025-03-19 21:47:53', NULL, ''),
(23, 23, '412.00', '2025-03-19 21:47:53', NULL, ''),
(24, 24, '412.00', '2025-03-19 21:47:54', NULL, ''),
(25, 25, '412.00', '2025-03-19 21:47:54', NULL, ''),
(26, 26, '412.00', '2025-03-19 21:47:55', NULL, ''),
(27, 27, '412.00', '2025-03-19 21:47:55', NULL, ''),
(28, 28, '412.00', '2025-03-19 21:47:56', NULL, ''),
(29, 29, '200.00', '2025-03-19 21:50:34', NULL, ''),
(30, 30, '200.00', '2025-03-19 21:53:15', NULL, ''),
(31, 31, '400.00', '2025-03-19 21:54:11', NULL, ''),
(32, 32, '600.00', '2025-03-19 21:56:45', NULL, ''),
(33, 33, '400.00', '2025-03-19 21:58:04', NULL, ''),
(35, 35, '0.00', '2025-03-19 22:02:04', NULL, ''),
(36, 36, '200.00', '2025-03-19 22:03:11', NULL, 'cancelado'),
(37, 37, '291.00', '2025-03-19 22:43:29', NULL, 'resuelto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id`, `id_compra`, `nombre_producto`, `precio`, `cantidad`, `imagen`) VALUES
(1, 1, 'FUNCIOANR COLROES', '12.00', 1, 'uploads/BANER.png'),
(2, 1, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(3, 2, 'Smith', '800.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(4, 3, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(5, 3, 'FUNCIOANR COLROES', '12.00', 1, 'uploads/BANER.png'),
(6, 3, 'Smith', '800.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(7, 4, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(8, 5, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(9, 6, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(10, 6, 'FUNCIOANR COLROES', '12.00', 1, 'uploads/BANER.png'),
(11, 6, 'Smith', '800.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(12, 7, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(13, 8, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(14, 9, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(15, 10, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(16, 11, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(17, 12, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(18, 13, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(19, 14, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(20, 15, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(21, 16, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(22, 17, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(23, 18, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(24, 19, 'hola 2', '200.00', 2, 'uploads/Pink and Green Badge Gamer Logo.png'),
(25, 19, 'FUNCIOANR COLROES', '12.00', 1, 'uploads/BANER.png'),
(26, 20, 'hola 2', '200.00', 2, 'uploads/Pink and Green Badge Gamer Logo.png'),
(27, 20, 'FUNCIOANR COLROES', '12.00', 1, 'uploads/BANER.png'),
(28, 21, 'hola 2', '200.00', 2, 'uploads/Pink and Green Badge Gamer Logo.png'),
(29, 21, 'FUNCIOANR COLROES', '12.00', 1, 'uploads/BANER.png'),
(30, 22, 'hola 2', '200.00', 2, 'uploads/Pink and Green Badge Gamer Logo.png'),
(31, 22, 'FUNCIOANR COLROES', '12.00', 1, 'uploads/BANER.png'),
(32, 23, 'hola 2', '200.00', 2, 'uploads/Pink and Green Badge Gamer Logo.png'),
(33, 23, 'FUNCIOANR COLROES', '12.00', 1, 'uploads/BANER.png'),
(34, 24, 'hola 2', '200.00', 2, 'uploads/Pink and Green Badge Gamer Logo.png'),
(35, 24, 'FUNCIOANR COLROES', '12.00', 1, 'uploads/BANER.png'),
(36, 25, 'hola 2', '200.00', 2, 'uploads/Pink and Green Badge Gamer Logo.png'),
(37, 25, 'FUNCIOANR COLROES', '12.00', 1, 'uploads/BANER.png'),
(38, 26, 'hola 2', '200.00', 2, 'uploads/Pink and Green Badge Gamer Logo.png'),
(39, 26, 'FUNCIOANR COLROES', '12.00', 1, 'uploads/BANER.png'),
(40, 27, 'hola 2', '200.00', 2, 'uploads/Pink and Green Badge Gamer Logo.png'),
(41, 27, 'FUNCIOANR COLROES', '12.00', 1, 'uploads/BANER.png'),
(42, 28, 'hola 2', '200.00', 2, 'uploads/Pink and Green Badge Gamer Logo.png'),
(43, 28, 'FUNCIOANR COLROES', '12.00', 1, 'uploads/BANER.png'),
(44, 29, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(45, 30, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(46, 31, 'hola 2', '200.00', 2, 'uploads/Pink and Green Badge Gamer Logo.png'),
(47, 32, 'hola 2', '200.00', 3, 'uploads/Pink and Green Badge Gamer Logo.png'),
(48, 33, 'hola 2', '200.00', 2, 'uploads/Pink and Green Badge Gamer Logo.png'),
(50, 36, 'hola 2', '200.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png'),
(51, 37, 'FILTRO COLORES', '1.00', 1, 'uploads/wallpaperflare.com_wallpaper (1).jpg'),
(52, 37, 'wafercita', '290.00', 1, 'uploads/Pink and Green Badge Gamer Logo.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_productos`
--

CREATE TABLE `imagenes_productos` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagenes_productos`
--

INSERT INTO `imagenes_productos` (`id`, `producto_id`, `imagen`) VALUES
(6, 12, 'uploads/BANER.png'),
(7, 12, 'uploads/Leonardo_Phoenix_A_stylized_Bad_Tricks_logo_with_a_glitch_art_2.jpg'),
(8, 12, 'uploads/Pink and Green Badge Gamer Logo.png'),
(9, 12, 'uploads/wallpaperflare.com_wallpaper (1).jpg'),
(10, 14, 'uploads/Leonardo_Phoenix_A_stylized_Bad_Tricks_logo_with_a_glitch_art_2.jpg'),
(11, 14, 'uploads/Leonardo_Phoenix_Un_logo_estilo_hacker_que_diga_Bad_Tricks_en_1.jpg'),
(12, 15, 'uploads/BANER.png'),
(13, 15, 'uploads/Leonardo_Phoenix_A_stylized_Bad_Tricks_logo_with_a_glitch_art_2.jpg'),
(14, 15, 'uploads/Leonardo_Phoenix_Un_logo_estilo_hacker_que_diga_Bad_Tricks_en_1.jpg'),
(15, 15, 'uploads/Pink and Green Badge Gamer Logo.png'),
(16, 15, 'uploads/wallpaperflare.com_wallpaper (1).jpg'),
(17, 16, 'uploads/BANER.png'),
(18, 16, 'uploads/Leonardo_Phoenix_A_stylized_Bad_Tricks_logo_with_a_glitch_art_2.jpg'),
(19, 16, 'uploads/Leonardo_Phoenix_Un_logo_estilo_hacker_que_diga_Bad_Tricks_en_1.jpg'),
(20, 16, 'uploads/Pink and Green Badge Gamer Logo.png'),
(21, 3, 'uploads/Leonardo_Phoenix_A_stylized_Bad_Tricks_logo_with_a_glitch_art_2.jpg'),
(22, 3, 'uploads/Leonardo_Phoenix_Un_logo_estilo_hacker_que_diga_Bad_Tricks_en_1.jpg'),
(23, 3, 'uploads/Pink and Green Badge Gamer Logo.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `precio_original` decimal(10,2) NOT NULL,
  `descuento` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `imagen_principal` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoria_id` int(11) NOT NULL,
  `categoria_secundaria_id` int(11) DEFAULT NULL,
  `colores` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `precio_original`, `descuento`, `stock`, `imagen_principal`, `fecha_creacion`, `categoria_id`, `categoria_secundaria_id`, `colores`) VALUES
(3, 'mafritas2', 'hola que tal  hola que tal  hola que tal  hola que tal hola que tal hola que tal  hola que tal  hola que tal  hola que tal2', '400.00', '400.00', 0, 400, 'uploads/Pink and Green Badge Gamer Logo.png', '2025-03-14 02:04:13', 2, 2, '#926363,#2e61d6,#09c865'),
(4, 'wafercita', 'hola que tal  hola que tal  hola que tal  hola que tal  hola que tal  hola que tal  hola que tal ', '290.00', '290.00', 0, 67, 'uploads/Pink and Green Badge Gamer Logo.png', '2025-03-14 02:04:59', 1, 1, ''),
(8, 'gaaax23', 'gaa', '2.00', '2.00', 0, 2, 'uploads/Leonardo_Phoenix_Un_logo_estilo_hacker_que_diga_Bad_Tricks_en_1.jpg', '2025-03-14 02:20:10', 1, 1, ''),
(9, 'gaaaaaaaaaa', 'sda', '21.00', '12.00', 12, 123, 'uploads/Pink and Green Badge Gamer Logo.png', '2025-03-14 03:57:19', 1, 1, NULL),
(11, 'Termo Hidraulico 20ml', 'dasdasdasd asda', '12.00', '12.00', 12, 12, 'uploads/Leonardo_Phoenix_A_stylized_Bad_Tricks_logo_with_a_glitch_art_2.jpg', '2025-03-14 04:04:02', 1, 2, NULL),
(12, 'Smith', 'gfasdasdas', '800.00', '500.00', 20, 87, 'uploads/Pink and Green Badge Gamer Logo.png', '2025-03-14 23:55:20', 2, 3, NULL),
(13, 'gringa', 'asd', '12.00', '123.00', 12, 12, 'uploads/Captura de pantalla 2025-03-14 215923.png', '2025-03-15 04:23:45', 1, 1, NULL),
(14, 'mafersicha', '1 par de separador de dedos de silicona de doble anillo con volteo hacia afuera, separador de punta a separador, separador de dedos superpuestos para uso diario', '12.00', '21.00', 12, 12, 'uploads/Leonardo_Phoenix_A_stylized_Bad_Tricks_logo_with_a_glitch_art_2.jpg', '2025-03-15 04:44:00', 1, 2, NULL),
(15, 'la puta fama', 'sadas', '12.00', '12.00', 21, 12, 'uploads/BANER.png', '2025-03-15 04:54:14', 1, 2, NULL),
(16, 'auron', 'asd', '12.00', '12.00', 21, 12, 'uploads/Pink and Green Badge Gamer Logo.png', '2025-03-17 09:34:09', 1, 1, NULL),
(17, 'colores', 'Polo 100% algodón GUCCI  \r\nColores: #000 #fff #red\r\n', '270.00', '2.00', 2, 2, 'uploads/BANER.png', '2025-03-17 09:56:12', 1, 1, NULL),
(19, 'colores vacios', 'sadfasda', '200.00', '20.00', 2, 2, 'uploads/BANER.png', '2025-03-17 19:10:45', 1, 1, '#d52020,#5d63b6,#ceb722'),
(20, 'colres x2', 'dasd', '255.00', '24.00', 2, 23, 'uploads/wallpaperflare.com_wallpaper (1).jpg', '2025-03-17 19:19:51', 1, 1, ''),
(22, 'FUNCIOANR COLROES', '123', '12.00', '12.00', 21, 12, 'uploads/BANER.png', '2025-03-17 19:28:26', 2, 1, '#a15e5e,#5c5757,#6aa720,#3d447b'),
(23, 'precio con descuento', 'qweqw', '132.00', '200.00', 34, 2, 'uploads/Pink and Green Badge Gamer Logo.png', '2025-03-17 22:10:41', 1, 1, ''),
(24, 'hola ', 'asdasd', '160.00', '200.00', 20, 2, 'uploads/Pink and Green Badge Gamer Logo.png', '2025-03-17 22:37:16', 1, 1, '#269271'),
(25, 'hola 2', 'sadas', '200.00', '200.00', 0, 2, 'uploads/Pink and Green Badge Gamer Logo.png', '2025-03-17 22:37:56', 2, 1, '#9c3a3a,#1e8410,#1f5793');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `rol` enum('admin','ventas') NOT NULL,
  `ultima_conexion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contraseña`, `rol`, `ultima_conexion`) VALUES
(1, 'admin', '$2y$10$L5SnRfdhDRGMdr9YqZjqjO.r06m5EfKDIFDGiIo/k9ElZs1ne7N4K', 'admin', '2025-05-06 15:19:02'),
(6, 'admi', '$2y$10$D0UYaYB3ievjrZcKyOdk4uTo/jqHtA3lZbC0MfWiVjSTeAfaqTssu', 'admin', '2025-05-06 15:25:30'),
(7, 'ventas', '$2y$10$7VV3v3to4uUWZVJJx5HPL.TBrDd1wgLAbGNdwoTb1zBvJVaDEi2za', 'ventas', '2025-05-06 15:34:03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `categoria_secundaria`
--
ALTER TABLE `categoria_secundaria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_compra` (`id_compra`);

--
-- Indices de la tabla `imagenes_productos`
--
ALTER TABLE `imagenes_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto` (`producto_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categoria_secundaria`
--
ALTER TABLE `categoria_secundaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `imagenes_productos`
--
ALTER TABLE `imagenes_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id`);

--
-- Filtros para la tabla `imagenes_productos`
--
ALTER TABLE `imagenes_productos`
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `imagenes_productos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
