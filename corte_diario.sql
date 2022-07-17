-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2020 a las 17:07:41
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `avplu3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corte_diario`
--

CREATE TABLE `corte_diario` (
  `id_ingreso` int(11) NOT NULL,
  `fecha_ingreso` varchar(25) DEFAULT NULL,
  `n_recibo` varchar(10) DEFAULT NULL,
  `n_venta` varchar(20) DEFAULT NULL,
  `n_factura` varchar(10) DEFAULT NULL,
  `paciente` varchar(150) DEFAULT NULL,
  `vendedor` varchar(150) DEFAULT NULL,
  `total_factura` varchar(10) DEFAULT NULL,
  `forma_cobro` varchar(50) DEFAULT NULL,
  `monto_cobrado` varchar(10) DEFAULT NULL,
  `saldo_credito` varchar(10) DEFAULT NULL,
  `tipo_venta` varchar(25) DEFAULT NULL,
  `tipo_pago` varchar(25) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `abono_anterior` varchar(10) DEFAULT NULL,
  `abonos_realizados` varchar(3) DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `sucursal_venta` varchar(25) NOT NULL,
  `sucursal_cobro` varchar(25) NOT NULL,
  `tipo_ingreso` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `corte_diario`
--
ALTER TABLE `corte_diario`
  ADD PRIMARY KEY (`id_ingreso`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `corte_diario`
--
ALTER TABLE `corte_diario`
  MODIFY `id_ingreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `corte_diario`
--
ALTER TABLE `corte_diario`
  ADD CONSTRAINT `corte_diario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `corte_diario_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
