-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2024 a las 00:00:12
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `compras`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `dni` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` int(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `imagen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `dni`, `nombre`, `telefono`, `mail`, `fecha_nacimiento`, `imagen`) VALUES
(14, 46555898, 'Maria Florencia Miguens', 556688, 'florenciamiguens@gmail.com', '2014-10-08', 'https://weremote.net/wp-content/uploads/2022/08/mujer-sonriente-apunta-arriba-1536x1024.jpg'),
(15, 38759465, 'Pedro Gonzales', 779635, 'pedrogonzales@gmail.com', '2014-10-05', 'https://plus.unsplash.com/premium_photo-1682096259050-361e2989706d?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(16, 35648965, 'Sofia Pereyra', 541235, 'sofiap@gmail.com', '2014-10-06', 'https://phantom-telva.unidadeditorial.es/9132d2a2c7abb6ab7cf099d4af093fa6/resize/1280/f/webp/assets/multimedia/imagenes/2023/03/05/16780029716658.jpg'),
(17, 41235698, 'Lucia Rodriguez', 458976, 'luciarodriguez@gmail.com', '2014-10-08', 'https://as1.ftcdn.net/v2/jpg/06/02/06/62/1000_F_602066201_4zhQhDW6qVGqTQSaPmZzPfxKwQCEL3Kt.jpg'),
(18, 29564879, 'Rodrigo Martinez', 548796, 'rodrigom20@gmail.com', '2024-10-01', 'https://media.revistagq.com/photos/6008111d0c66a2a0f048c638/16:9/w_1600,c_limit/chris-hemsworth.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `contrasena` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `contrasena`) VALUES
(1, 'webadmin', '$2y$10$f/VtRbqpGmrljJM1/uVbrOsGoIvHmgxSSyx.iNNmv10di.PLvd3nK');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `clave_foranea` int(11) NOT NULL,
  `fecha_compra` datetime NOT NULL,
  `monto` int(255) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `Importado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `clave_foranea`, `fecha_compra`, `monto`, `producto`, `Importado`) VALUES
(24, 17, '2024-10-17 17:38:02', 220000, 'La vie est belle', 0),
(25, 17, '2024-10-17 17:38:24', 175000, 'Olympea', 0),
(26, 14, '2024-10-17 22:39:21', 223740, 'good girl carolina herrera', 1),
(27, 15, '2024-10-17 22:39:57', 185900, 'Giorgio Armani', 1),
(28, 15, '2024-10-17 22:40:25', 161100, 'Emporio She- Giorgio Armani', 0),
(29, 18, '2024-10-17 22:40:50', 166789, 'Gentelman Society- Giorgio Armani', 1),
(30, 16, '2024-10-17 22:41:23', 153500, 'Chance- Chanel', 1),
(31, 16, '2024-10-17 22:41:50', 154615, 'Flower by kenzo', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `telefono` (`telefono`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `clave foranea` (`clave_foranea`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`clave_foranea`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
