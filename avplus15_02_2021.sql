-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-02-2021 a las 23:11:16
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
-- Estructura de tabla para la tabla `abonos`
--

CREATE TABLE `abonos` (
  `id_abono` int(11) NOT NULL,
  `monto_abono` varchar(10) DEFAULT NULL,
  `forma_pago` varchar(45) DEFAULT NULL,
  `fecha_abono` varchar(25) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `n_recibo` varchar(45) DEFAULT NULL,
  `numero_venta` varchar(100) DEFAULT NULL,
  `sucursal` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `abonos`
--

INSERT INTO `abonos` (`id_abono`, `monto_abono`, `forma_pago`, `fecha_abono`, `id_paciente`, `id_usuario`, `n_recibo`, `numero_venta`, `sucursal`) VALUES
(353, '18.00', 'Efectivo', '29-11-2020 12:06:18', 119, 1, 'RME-1', 'AVME-1', 'Metrocentro'),
(354, '25', 'Efectivo', '29-11-2020 12:07:02', 114, 1, 'RME-2', 'AVME-2', 'Metrocentro'),
(355, '18.00', 'Efectivo', '29-11-2020 12:51:52', 119, 1, 'RME-3', 'AVME-1', 'Metrocentro'),
(356, '40.00', 'Davivienda', '29-11-2020 13:09:22', 112, 1, 'RME-4', 'AVME-3', 'Metrocentro'),
(357, '12.69', 'Davivienda', '29-11-2020 13:21:25', 114, 1, 'RME-5', 'AVME-6', 'Metrocentro'),
(358, '12.96', 'Davivienda', '29-11-2020 14:39:57', 114, 1, 'RME-6', 'AVME-6', 'Metrocentro'),
(359, '40.00', 'Davivienda', '29-11-2020 14:46:01', 112, 1, 'RME-7', 'AVME-3', 'Metrocentro'),
(360, '25', 'Efectivo', '07-12-2020 13:53:25', 114, 1, 'RME-8', 'AVME-8', 'Metrocentro'),
(361, '30', 'Efectivo', '07-12-2020 14:38:13', 116, 1, 'RME-9', 'AVME-9', 'Metrocentro'),
(362, '111.67', 'Cuscatlan', '07-12-2020 14:40:18', 104, 1, 'RME-10', 'AVME-10', 'Metrocentro'),
(363, '10', 'Efectivo', '10-12-2020 13:16:20', 116, 1, 'RME-11', 'AVME-9', 'Metrocentro'),
(365, '25', 'Efectivo', '12-12-2020 15:09:10', 115, 1, 'RME-12', 'AVME-20', 'Metrocentro'),
(366, '200', 'Efectivo', '15-12-2020 13:14:51', 116, 1, 'RME-13', 'AVME-9', 'Metrocentro'),
(367, '150', 'Efectivo', '15-12-2020 14:31:35', 124, 1, 'RSA-1', 'AVSA-1', 'Santa Ana'),
(368, '150', 'Efectivo', '16-12-2020 14:14:23', 124, 1, 'RSA-2', 'AVSA-2', 'Santa Ana'),
(369, '120', 'Efectivo', '16-12-2020 14:22:18', 114, 1, 'RME-14', 'AVME-28', 'Metrocentro'),
(370, '150', 'Cheque', '16-12-2020 14:30:50', 104, 1, 'RME-15', 'AVME-1', 'Metrocentro'),
(371, '185', 'Serfinsa', '16-12-2020 14:32:51', 104, 1, 'RME-16', 'AVME-1', 'Metrocentro'),
(372, '120', 'Efectivo', '16-12-2020 15:05:47', 116, 1, 'RME-17', 'AVME-2', 'Metrocentro'),
(373, '150', 'Efectivo', '16-12-2020 15:53:44', 115, 1, 'RME-18', 'AVME-3', 'Metrocentro'),
(374, '90', 'Efectivo', '16-12-2020 15:58:27', 115, 1, 'RME-19', 'AVME-4', 'Metrocentro'),
(375, '120', 'Efectivo', '16-12-2020 16:00:20', 115, 1, 'RME-20', 'AVME-5', 'Metrocentro'),
(376, '150', 'Efectivo', '16-12-2020 16:01:20', 115, 1, 'RME-21', 'AVME-6', 'Metrocentro'),
(377, '150', 'Efectivo', '16-12-2020 16:03:44', 115, 1, 'RME-22', 'AVME-7', 'Metrocentro'),
(378, '120', 'Efectivo', '16-12-2020 16:06:29', 115, 1, 'RME-23', 'AVME-8', 'Metrocentro'),
(379, '120', 'Efectivo', '16-12-2020 16:09:29', 115, 1, 'RME-24', 'AVME-9', 'Metrocentro'),
(380, '360', 'Efectivo', '16-12-2020 16:15:38', 114, 1, 'RME-25', 'AVME-10', 'Metrocentro'),
(381, '9', 'Efectivo', '17-12-2020 11:44:00', 114, 1, 'RME-26', 'AVME-11', 'Metrocentro'),
(382, '6', 'Cheque', '17-12-2020 12:11:25', 115, 1, 'RME-27', 'AVME-12', 'Metrocentro'),
(383, '10', 'Efectivo', '17-12-2020 12:20:42', 120, 2, 'RME-28', 'AVME-13', 'Metrocentro'),
(384, '45', 'Efectivo', '17-12-2020 12:23:53', 118, 2, 'RME-29', 'AVME-14', 'Metrocentro'),
(385, '250', 'Efectivo', '17-12-2020 12:28:51', 114, 1, 'RME-30', 'AVME-15', 'Metrocentro'),
(386, '452', 'Cheque', '17-12-2020 12:33:16', 114, 1, 'RME-31', 'AVME-16', 'Metrocentro'),
(387, '144.80', 'Efectivo', '22-12-2020 10:58:37', 125, 1, 'RME-32', 'AVME-17', 'Metrocentro'),
(388, '28', 'Efectivo', '26-12-2020 14:24:57', 130, 1, 'RME-33', 'AVME-22', 'Metrocentro'),
(389, '25', 'Efectivo', '26-12-2020 14:28:03', 129, 1, 'RME-34', 'AVME-23', 'Metrocentro'),
(390, '25', 'Efectivo', '26-12-2020 14:30:08', 130, 1, 'RME-35', 'AVME-24', 'Metrocentro'),
(391, '25', 'Efectivo', '26-12-2020 14:31:39', 114, 1, 'RME-36', 'AVME-8', 'Metrocentro'),
(392, '25', 'Efectivo', '26-12-2020 14:32:03', 114, 1, 'RME-37', 'AVME-6', 'Metrocentro'),
(393, '25', 'Efectivo', '26-12-2020 14:41:39', 114, 1, 'RME-38', 'AVME-6', 'Metrocentro'),
(394, '25', 'Efectivo', '26-12-2020 14:42:41', 128, 1, 'RME-39', 'AVME-25', 'Metrocentro'),
(395, '15', 'Efectivo', '26-12-2020 14:59:23', 122, 1, 'RSM-1', 'AVSM-1', 'San Miguel'),
(396, '25', 'Efectivo', '26-12-2020 15:25:33', 121, 1, 'RSM-2', 'AVSM-2', 'San Miguel'),
(397, '25', 'Efectivo', '26-12-2020 15:30:20', 121, 1, 'RSM-3', 'AVSM-3', 'San Miguel'),
(398, '25', 'Efectivo', '26-12-2020 15:31:52', 121, 1, 'RSM-4', 'AVSM-3', 'San Miguel'),
(399, '25', 'Cheque', '26-12-2020 15:37:50', 121, 1, 'RSM-5', 'AVSM-3', 'San Miguel'),
(400, '75.25', 'Efectivo', '03-01-2021 15:20:05', 132, 1, 'RME-40', 'AVME-32', 'Metrocentro'),
(401, '18.53', 'Cheque', '06-10-2021 16:28:00', 138, 1, 'RME-41', 'AVME-14', 'Metrocentro'),
(402, '32.12', 'Cheque', '08-01-2021 15:39:28', 127, 1, 'RME-42', 'AVME-22', 'Metrocentro'),
(403, '25', 'Efectivo', '09-01-2021 09:21:25', 128, 1, 'RME-43', 'AVME-23', 'Metrocentro'),
(404, '193.13', 'Efectivo', '11-01-2021 09:50:13', 127, 1, 'RME-44', 'AVME-22', 'Metrocentro'),
(405, '25', 'Efectivo', '24-01-2021 11:53:21', 104, 1, 'RME-45', 'AVME-32', 'Metrocentro'),
(406, '25', 'Efectivo', '02-02-2021 13:27:52', 141, 1, 'RME-46', 'AVME-3', 'Metrocentro'),
(407, '25', 'Efectivo', '02-02-2021 14:33:12', 133, 1, 'RME-47', 'AVME-4', 'Metrocentro'),
(408, '25', 'Efectivo', '08-02-2021 16:07:13', 117, 1, 'RME-48', 'AVME-5', 'Metrocentro'),
(409, '100.25', 'Efectivo', '15-02-2021 11:18:50', 126, 1, 'RME-49', 'AVME-9', 'Metrocentro'),
(410, '125.25', 'Efectivo', '15-02-2021 13:54:35', 117, 1, 'RME-50', 'AVME-8', 'Metrocentro'),
(411, '225.25', 'Efectivo', '15-02-2021 13:58:36', 114, 1, 'RME-51', 'AVME-17', 'Metrocentro'),
(412, '260.25', 'Efectivo', '15-02-2021 15:09:06', 138, 1, 'RME-52', 'AVME-6', 'Metrocentro'),
(413, '50', 'Serfinsa', '08-02-2021 13:58:12', 142, 1, 'RME-53', 'AVME-18', 'Metrocentro'),
(414, '100', 'Efectivo', '11-02-2021 11:06:48', 144, 1, 'RME-54', 'AVME-20', 'Metrocentro'),
(415, '255.35', 'Efectivo', '11-02-2021 11:13:13', 144, 1, 'RME-55', 'AVME-20', 'Metrocentro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones_ordenes_lab`
--

CREATE TABLE `acciones_ordenes_lab` (
  `id_accion` int(11) NOT NULL,
  `tipo_accion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `n_orden` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `laboratorio` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `evaluado` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `sucursal` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `acciones_ordenes_lab`
--

INSERT INTO `acciones_ordenes_lab` (`id_accion`, `tipo_accion`, `fecha`, `id_usuario`, `n_orden`, `laboratorio`, `id_paciente`, `evaluado`, `sucursal`) VALUES
(144, 'Envio a laboratorio', '07-02-2021 12:26:31', 1, 'ODME-1', 'Lomed', 114, 'ROSA EVELYN PERAZA', 'Metrocentro'),
(145, 'Recibir de laboratorio', '07-02-2021 12:26:35', 1, 'ODME-1', 'Lomed', 114, 'ROSA EVELYN PERAZA', 'Metrocentro'),
(146, 'Rechazar', '07-02-2021 12:27:30', 1, 'ODME-1', 'Lomed', 114, 'ROSA EVELYN PERAZA', 'Metrocentro'),
(147, 'Envio a laboratorio', '07-02-2021 12:28:16', 1, 'ODME-1', 'Lomed', 114, 'ROSA EVELYN PERAZA', 'Metrocentro'),
(148, 'Recibir de laboratorio', '07-02-2021 12:28:24', 1, 'ODME-1', 'Lomed', 114, 'ROSA EVELYN PERAZA', 'Metrocentro'),
(149, 'Rechazar', '07-02-2021 12:30:55', 1, 'ODME-1', 'Lomed', 114, 'ROSA EVELYN PERAZA', 'Metrocentro'),
(150, 'Envio a laboratorio', '07-02-2021 12:34:30', 1, 'ODME-1', 'Lomed', 114, 'ROSA EVELYN PERAZA', 'Metrocentro'),
(151, 'Recibir de laboratorio', '07-02-2021 12:34:33', 1, 'ODME-1', 'Lomed', 114, 'ROSA EVELYN PERAZA', 'Metrocentro'),
(152, 'Envio a laboratorio', '07-02-2021 16:56:42', 1, 'ODME-2', 'Lenti', 139, 'CARLA LOPEZ', 'Metrocentro'),
(153, 'Recibir de laboratorio', '07-02-2021 17:07:53', 1, 'ODME-2', 'Lenti', 139, 'CARLA LOPEZ', 'Metrocentro'),
(154, 'Envio a laboratorio', '07-02-2021 17:08:00', 1, 'ODME-3', 'Lomed', 114, 'ROSA EVELYN PERAZA', 'Metrocentro'),
(155, 'Control de calidad', '08-02-2021 13:35:00', 1, 'ODME-2', 'Lenti', 139, 'CARLA LOPEZ', 'Metrocentro'),
(156, 'LLamada', '08-02-2021 13:35:28', 1, 'ODME-2', 'Lenti', 139, 'CARLA LOPEZ', 'Metrocentro'),
(157, 'Envio a laboratorio', '08-02-2021 16:13:05', 1, 'ODME-6', 'Lomed', 138, 'SANDRA GONZALEZ', 'Metrocentro'),
(158, 'Envio a laboratorio', '08-02-2021 16:13:06', 1, 'ODME-5', 'Lomed', 117, 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON', 'Metrocentro'),
(159, 'Recibir de laboratorio', '12-02-2021 16:14:19', 1, 'ODME-6', 'Lomed', 138, 'SANDRA GONZALEZ', 'Metrocentro'),
(160, 'Recibir de laboratorio', '12-02-2021 16:14:19', 1, 'ODME-5', 'Lomed', 117, 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON', 'Metrocentro'),
(161, 'Recibir de laboratorio', '12-02-2021 16:14:19', 1, 'ODME-6', 'Lomed', 138, 'SANDRA GONZALEZ', 'Metrocentro'),
(162, 'Recibir de laboratorio', '12-02-2021 16:14:19', 1, 'ODME-5', 'Lomed', 117, 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON', 'Metrocentro'),
(163, 'Control de calidad', '12-02-2021 16:15:07', 1, 'ODME-6', 'Lomed', 138, 'SANDRA GONZALEZ', 'Metrocentro'),
(164, 'LLamada', '12-02-2021 16:17:49', 1, 'ODME-6', 'Lomed', 138, 'SANDRA GONZALEZ', 'Metrocentro'),
(165, 'Recibir de laboratorio', '13-02-2021 22:07:39', 1, 'ODME-3', 'Lomed', 114, 'ROSA EVELYN PERAZA', 'Metrocentro'),
(166, 'LLamada', '13-02-2021 22:13:18', 1, 'ODME-6', 'Lomed', 138, 'SANDRA GONZALEZ', 'Metrocentro'),
(167, 'Control de calidad', '14-02-2021 08:09:59', 1, 'ODME-5', 'Lomed', 117, 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON', 'Metrocentro'),
(168, 'Rechazar', '14-02-2021 08:11:10', 1, 'ODME-3', 'Lomed', 114, 'ROSA EVELYN PERAZA', 'Metrocentro'),
(169, 'Envio a laboratorio', '14-02-2021 08:11:25', 1, 'ODME-3', 'Lomed', 114, 'ROSA EVELYN PERAZA', 'Metrocentro'),
(170, 'Envio a laboratorio', '14-02-2021 08:11:25', 1, 'ODME-4', 'Lomed', 126, 'CLAUDIA MARISOL CORVERA', 'Metrocentro'),
(171, 'Rechazar', '14-02-2021 13:51:53', 1, 'ODME-1', 'Lomed', 114, 'ROSA EVELYN PERAZA', 'Metrocentro'),
(172, 'Envio a laboratorio', '14-02-2021 13:52:31', 1, 'ODME-1', 'Lomed', 114, 'ROSA EVELYN PERAZA', 'Metrocentro'),
(173, 'Recibir de laboratorio', '14-02-2021 13:54:26', 1, 'ODME-4', 'Lomed', 126, 'CLAUDIA MARISOL CORVERA', 'Metrocentro'),
(174, 'Envio a laboratorio', '08-02-2021 14:01:38', 1, 'ODME-7', 'Lomed', 142, 'CARMEN ALICIA MARQUEZ ROMERO', 'Metrocentro'),
(175, 'Recibir de laboratorio', '08-02-2021 14:02:03', 1, 'ODME-7', 'Lomed', 142, 'CARMEN ALICIA MARQUEZ ROMERO', 'Metrocentro'),
(176, 'Recibir de laboratorio', '08-02-2021 14:02:03', 1, 'ODME-3', 'Lomed', 114, 'ROSA EVELYN PERAZA', 'Metrocentro'),
(177, 'Control de calidad', '08-02-2021 14:02:48', 1, 'ODME-7', 'Lomed', 142, 'CARMEN ALICIA MARQUEZ ROMERO', 'Metrocentro'),
(178, 'LLamada', '08-02-2021 14:03:04', 1, 'ODME-7', 'Lomed', 142, 'CARMEN ALICIA MARQUEZ ROMERO', 'Metrocentro'),
(179, 'LLamada', '08-02-2021 14:03:34', 1, 'ODME-7', 'Lomed', 142, 'CARMEN ALICIA MARQUEZ ROMERO', 'Metrocentro'),
(180, 'Envio a laboratorio', '09-02-2021 15:05:11', 1, 'ODME-8', 'Lomed', 142, 'CARMEN ALICIA MARQUEZ ROMERO', 'Metrocentro'),
(181, 'Recibir de laboratorio', '09-02-2021 15:05:17', 1, 'ODME-8', 'Lomed', 142, 'CARMEN ALICIA MARQUEZ ROMERO', 'Metrocentro'),
(182, 'Control de calidad', '09-02-2021 15:05:32', 1, 'ODME-8', 'Lomed', 142, 'CARMEN ALICIA MARQUEZ ROMERO', 'Metrocentro'),
(183, 'Envio a laboratorio', '12-02-2021 06:19:39', 1, 'ODME-1', 'Lomed', 120, 'NASIF HANDAL', 'Metrocentro'),
(184, 'Recibir de laboratorio', '12-02-2021 06:19:45', 1, 'ODME-1', 'Lomed', 120, 'NASIF HANDAL', 'Metrocentro'),
(185, 'Control de calidad', '12-02-2021 06:19:51', 1, 'ODME-1', 'Lomed', 120, 'NASIF HANDAL', 'Metrocentro'),
(186, 'LLamada', '12-02-2021 06:19:57', 1, 'ODME-1', 'Lomed', 120, 'NASIF HANDAL', 'Metrocentro'),
(187, 'Envio a laboratorio', '13-02-2021 09:52:55', 1, 'ODME-2', 'Lomed', 144, 'OSCAR DE FLORES', 'Metrocentro'),
(188, 'Recibir de laboratorio', '13-02-2021 09:52:58', 1, 'ODME-2', 'Lomed', 144, 'OSCAR DE FLORES', 'Metrocentro'),
(189, 'Control de calidad', '13-02-2021 09:53:09', 1, 'ODME-2', 'Lomed', 144, 'OSCAR DE FLORES', 'Metrocentro'),
(190, 'Envio a laboratorio', '13-02-2021 15:00:59', 1, 'ODME-3', 'Lomed', 145, 'JOSE RONALD FUENTES', 'Metrocentro'),
(191, 'Recibir de laboratorio', '13-02-2021 15:01:04', 1, 'ODME-3', 'Lomed', 145, 'JOSE RONALD FUENTES', 'Metrocentro'),
(192, 'Control de calidad', '13-02-2021 15:01:11', 1, 'ODME-3', 'Lomed', 145, 'JOSE RONALD FUENTES', 'Metrocentro'),
(193, 'LLamada', '13-02-2021 15:01:23', 1, 'ODME-3', 'Lomed', 145, 'JOSE RONALD FUENTES', 'Metrocentro'),
(194, 'Envio a laboratorio', '14-02-2021 10:02:31', 1, 'ODME-4', 'Lomed', 146, 'ALCLEISDER JAIMES', 'Metrocentro'),
(195, 'Recibir de laboratorio', '14-02-2021 10:02:45', 1, 'ODME-4', 'Lomed', 146, 'ALCLEISDER JAIMES', 'Metrocentro'),
(196, 'Control de calidad', '14-02-2021 10:03:53', 1, 'ODME-4', 'Lomed', 146, 'ALCLEISDER JAIMES', 'Metrocentro'),
(197, 'LLamada', '14-02-2021 10:04:13', 1, 'ODME-4', 'Lomed', 146, 'ALCLEISDER JAIMES', 'Metrocentro'),
(198, 'LLamada', '14-02-2021 10:04:47', 1, 'ODME-4', 'Lomed', 146, 'ALCLEISDER JAIMES', 'Metrocentro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_chica`
--

CREATE TABLE `caja_chica` (
  `id_caja` int(11) NOT NULL,
  `saldo` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sucursal` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `caja_chica`
--

INSERT INTO `caja_chica` (`id_caja`, `saldo`, `sucursal`) VALUES
(1, '19.88', 'Metrocentro'),
(2, '0', 'San Miguel'),
(3, '0', 'Santa Ana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `tipo_categoria` varchar(50) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `sucursal` varchar(50) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `tipo_categoria`, `nombre`, `sucursal`, `descripcion`) VALUES
(11, 'Gaveta', 'GAVETA1 ', 'Metrocentro', 'ANDVAS NIÑOS'),
(12, 'Gaveta', 'GAVETA 2', 'Metrocentro', 'NINGUNA'),
(13, 'Gaveta', 'GAVETA3', 'Santa Ana', 'NINGUNA'),
(14, 'Accesorios', 'GAVETA 4', 'Santa Ana', 'NINGUNA'),
(15, 'Gaveta', 'GAVETA 7', 'Santa Ana', 'GAVETA ANDVAS MUJER'),
(16, 'Gaveta', 'EXHIBICION 8', 'San Miguel', 'AROS DE MUJER'),
(17, 'Gaveta', 'catesanmiguel', 'San Miguel', 'ee'),
(18, 'Gaveta', 'GAVETA#10', 'Metrocentro', 'ANDVAS MUJER'),
(19, 'Gaveta', 'MU#3', 'Metrocentro', 'PREMIUM'),
(20, 'Maleta', 'MALETA#1', 'Metrocentro', 'MALETA EMPRESARIAL'),
(21, 'Gaveta', 'GAVETA #20', 'Metrocentro', 'ANDVAS MUJER');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `numero_compra` varchar(20) DEFAULT NULL,
  `codigo_proveedor` varchar(10) DEFAULT NULL,
  `nombre_proveedor` varchar(100) DEFAULT NULL,
  `tipo_compra` varchar(45) DEFAULT NULL,
  `tipo_pago` varchar(45) DEFAULT NULL,
  `plazo_meses` varchar(5) DEFAULT NULL,
  `fecha_compra` varchar(45) DEFAULT NULL,
  `tipo_doc` varchar(45) DEFAULT NULL,
  `numero_doc` varchar(45) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `total_compra` varchar(8) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `sucursal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `numero_compra`, `codigo_proveedor`, `nombre_proveedor`, `tipo_compra`, `tipo_pago`, `plazo_meses`, `fecha_compra`, `tipo_doc`, `numero_doc`, `usuario`, `total_compra`, `estado`, `sucursal`) VALUES
(42, 'C-', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '8', '28-09-2020 09:54:24', 'Factura', '25888', 'oscar', '324.00', '1', 'Metrocentro'),
(43, 'C-43', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '11', '02-10-2020 13:41:50', 'Factura', 'ee', 'oscar', '10.00', '0', 'Metrocentro'),
(44, 'C-44', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '2', '02-10-2020 15:59:58', 'Factura', '25888', 'oscar', '10.00', '0', 'Metrocentro'),
(45, 'C-45', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '9', '03-10-2020 12:02:26', 'Factura', '25888', 'oscar', '2.00', '2', 'Metrocentro'),
(46, 'C-46', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '11', '03-10-2020 12:23:43', 'Factura', '25888', 'oscar', '50.00', '2', 'Metrocentro'),
(47, 'C-47', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '9', '03-10-2020 15:09:56', 'Factura', '25888', 'oscar', '1450.00', '2', 'Metrocentro'),
(48, 'C-48', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '12', '04-10-2020 15:14:07', 'Factura', '25888', 'oscar', '2747.00', '2', 'Metrocentro'),
(49, 'C-49', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '', '05-10-2020 14:15:36', 'Factura', '25888', 'oscar', '11.00', '2', 'Metrocentro'),
(50, 'C-50', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '12', '06-11-2020 13:57:19', 'Factura', '25888', 'oscar', '1138.00', '1', 'Metrocentro'),
(51, 'C-51', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '6', '10-11-2020 10:19:56', 'Factura', '25888', 'oscar', '319.00', '1', 'Metrocentro'),
(52, 'C-52', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '', '16-11-2020 15:44:17', 'Factura', '000', 'oscar', '290.00', '2', 'Metrocentro'),
(53, 'C-53', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '4', '17-11-2020 11:51:27', 'Factura', '25888', 'oscar', '1.00', '2', 'Metrocentro'),
(54, 'C-54', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '4', '17-11-2020 11:58:09', 'Factura', '000000', 'oscar', '994.00', '2', 'Metrocentro'),
(55, 'C-55', 'P-01', 'Carlos Andres Vazquez Choto', 'Credito', 'Credito', '6', '17-11-2020 15:12:15', 'Factura', '000000', 'oscar', '3500.00', '2', 'Metrocentro'),
(56, 'C-56', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '3', '17-11-2020 16:37:06', 'Credito Fiscal', '000', 'oscar', '34.00', '2', 'Metrocentro'),
(57, 'C-57', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '1', '17-11-2020 16:44:38', 'Factura', '00000', 'oscar', '2.00', '2', 'Metrocentro'),
(58, 'C-58', 'P-01', 'Carlos Andres Vazquez Choto', 'Credito', 'Contado', '2', '17-11-2020 16:49:45', 'Factura', '000', 'oscar', '1.00', '0', 'Santa Ana'),
(59, 'C-59', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '2', '17-11-2020 16:51:34', 'Factura', '000', 'oscar', '23.00', '2', 'Metrocentro'),
(60, 'C-60', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '5', '18-11-2020 10:40:46', 'Factura', '25888', 'oscar', '583.00', '2', 'Metrocentro'),
(61, 'C-61', 'P-01', 'Carlos Andres Vazquez Choto', 'Credito', 'Contado', '4', '18-11-2020 14:21:32', 'Factura', '000', 'oscar', '1.00', '2', 'Metrocentro'),
(62, 'C-62', 'P-01', 'Carlos Andres Vazquez Choto', 'Credito', 'Contado', '7', '21-11-2020 16:45:26', 'Factura', '25888', 'oscar', '2065.00', '2', 'Metrocentro'),
(63, 'C-63', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '2', '24-11-2020 12:13:33', 'Factura', '25888', 'oscar', '60.00', '2', 'Metrocentro'),
(64, 'C-64', 'P-01', 'Carlos Andres Vazquez Choto', 'Credito', 'Contado', '4', '24-11-2020 13:52:42', 'Factura', '25888', 'oscar', '2180.00', '2', 'Metrocentro'),
(65, 'C-65', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '4', '24-11-2020 16:22:51', 'Factura', '25888', 'oscar', '150.00', '2', 'Metrocentro'),
(66, 'C-66', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '1', '28-11-2020 15:47:36', 'Factura', '25888', 'oscar', '111.00', '1', 'Metrocentro'),
(67, 'C-67', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '3', '28-11-2020 17:35:33', 'Factura', '25888', 'oscar', '10.00', '0', 'Metrocentro'),
(68, 'C-68', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '2', '10-12-2020 12:43:19', 'Factura', '25888', 'oscar', '100.00', '1', 'Metrocentro'),
(69, 'C-69', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '1', '10-12-2020 12:50:33', 'Factura', '25888', 'oscar', '70.00', '1', 'Metrocentro'),
(70, 'C-70', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '1', '17-12-2020 11:42:48', 'Factura', '25888', 'oscar', '13.00', '2', ''),
(71, 'C-71', 'P-01', 'Carlos Andres Vazquez Choto', 'Credito', 'Contado', '5', '30-12-2020 10:38:58', 'Factura', '5222', 'oscar', '625.00', '1', 'Metrocentro'),
(72, 'C-72', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '2', '14-01-2021 14:56:20', 'Factura', '00022', 'oscar', '130.00', '2', 'Metrocentro'),
(73, 'C-73', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '2', '20-01-2021 11:09:31', 'Factura', '00222', 'oscar', '1080.00', '1', 'Metrocentro'),
(74, 'C-74', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '3', '08-02-2021 14:19:05', 'Factura', '00', 'oscar', '606.00', '1', 'Metrocentro'),
(75, 'C-75', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '3', '12-02-2021 06:16:02', 'Factura', '25888', 'oscar', '1020.00', '1', 'Metrocentro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta`
--

CREATE TABLE `consulta` (
  `id_consulta` int(11) NOT NULL,
  `motivo` text DEFAULT NULL,
  `patologias` text DEFAULT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `oiesfreasl` varchar(10) DEFAULT NULL,
  `oicilindrosl` varchar(10) DEFAULT NULL,
  `oiejesl` varchar(10) DEFAULT NULL,
  `oiprismal` varchar(10) DEFAULT NULL,
  `oiadicionl` varchar(10) DEFAULT NULL,
  `odesferasl` varchar(10) DEFAULT NULL,
  `odcilndrosl` varchar(10) DEFAULT NULL,
  `odejesl` varchar(10) DEFAULT NULL,
  `odprismal` varchar(10) DEFAULT NULL,
  `odadicionl` varchar(10) DEFAULT NULL,
  `oiesferasa` varchar(10) DEFAULT NULL,
  `oicolindrosa` varchar(10) DEFAULT NULL,
  `oiejesa` varchar(10) DEFAULT NULL,
  `oiprismaa` varchar(10) DEFAULT NULL,
  `oiadiciona` varchar(10) DEFAULT NULL,
  `odesferasa` varchar(10) DEFAULT NULL,
  `odcilindrosa` varchar(10) DEFAULT NULL,
  `odejesa` varchar(10) DEFAULT NULL,
  `dprismaa` varchar(10) DEFAULT NULL,
  `oddiciona` varchar(10) DEFAULT NULL,
  `sugeridos` varchar(200) DEFAULT NULL,
  `diagnostico` text DEFAULT NULL,
  `medicamento` varchar(100) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `oiesferasf` varchar(10) DEFAULT NULL,
  `oicolindrosf` varchar(10) DEFAULT NULL,
  `oiejesf` varchar(10) DEFAULT NULL,
  `oiprismaf` varchar(10) DEFAULT NULL,
  `oiadicionf` varchar(10) DEFAULT NULL,
  `odesferasf` varchar(10) DEFAULT NULL,
  `odcilindrosf` varchar(10) DEFAULT NULL,
  `odejesf` varchar(10) DEFAULT NULL,
  `dprismaf` varchar(10) DEFAULT NULL,
  `oddicionf` varchar(10) DEFAULT NULL,
  `odavsclejos` varchar(20) DEFAULT NULL,
  `odavphlejos` varchar(20) DEFAULT NULL,
  `odavcclejos` varchar(20) DEFAULT NULL,
  `odavsccerca` varchar(20) DEFAULT NULL,
  `odavcccerca` varchar(20) DEFAULT NULL,
  `oiavesferasf` varchar(20) DEFAULT NULL,
  `oiavcolindrosf` varchar(20) DEFAULT NULL,
  `oiavejesf` varchar(20) DEFAULT NULL,
  `oiavprismaf` varchar(20) DEFAULT NULL,
  `oiavadicionf` varchar(20) DEFAULT NULL,
  `prisoicorrige` varchar(20) DEFAULT NULL,
  `addodcorrige` varchar(20) DEFAULT NULL,
  `prisodcorrige` varchar(20) DEFAULT NULL,
  `addoicorrige` varchar(20) DEFAULT NULL,
  `ishihara` varchar(200) DEFAULT NULL,
  `amsler` varchar(200) DEFAULT NULL,
  `anexos` varchar(200) DEFAULT NULL,
  `dip` varchar(20) DEFAULT NULL,
  `oddip` varchar(20) DEFAULT NULL,
  `oidip` varchar(20) DEFAULT NULL,
  `aood` varchar(20) DEFAULT NULL,
  `aooi` varchar(20) DEFAULT NULL,
  `apod` varchar(20) DEFAULT NULL,
  `opoi` varchar(20) DEFAULT NULL,
  `fecha_consulta` varchar(25) DEFAULT NULL,
  `p_evaluado` varchar(100) DEFAULT NULL,
  `parentesco_beneficiario` varchar(100) DEFAULT NULL,
  `telefono_beneficiario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `consulta`
--

INSERT INTO `consulta` (`id_consulta`, `motivo`, `patologias`, `id_paciente`, `id_usuario`, `fecha_reg`, `oiesfreasl`, `oicilindrosl`, `oiejesl`, `oiprismal`, `oiadicionl`, `odesferasl`, `odcilndrosl`, `odejesl`, `odprismal`, `odadicionl`, `oiesferasa`, `oicolindrosa`, `oiejesa`, `oiprismaa`, `oiadiciona`, `odesferasa`, `odcilindrosa`, `odejesa`, `dprismaa`, `oddiciona`, `sugeridos`, `diagnostico`, `medicamento`, `observaciones`, `oiesferasf`, `oicolindrosf`, `oiejesf`, `oiprismaf`, `oiadicionf`, `odesferasf`, `odcilindrosf`, `odejesf`, `dprismaf`, `oddicionf`, `odavsclejos`, `odavphlejos`, `odavcclejos`, `odavsccerca`, `odavcccerca`, `oiavesferasf`, `oiavcolindrosf`, `oiavejesf`, `oiavprismaf`, `oiavadicionf`, `prisoicorrige`, `addodcorrige`, `prisodcorrige`, `addoicorrige`, `ishihara`, `amsler`, `anexos`, `dip`, `oddip`, `oidip`, `aood`, `aooi`, `apod`, `opoi`, `fecha_consulta`, `p_evaluado`, `parentesco_beneficiario`, `telefono_beneficiario`) VALUES
(498, '', '', 141, 1, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '147', '', '', '', '', '125', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '78', '39 mm', '39 mm', '78', '78', '89', '89', '03-02-2021 16:24:57', 'CARMEN ARELY VASQUEZ MARTINEZ', '', '7896-1447'),
(499, '', '', 139, 1, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '11', '12', '13', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '14', '7 mm', '7 mm', '58', '58', '89', '89', '03-02-2021 16:27:10', 'CARLA LOPEZ', '', '2585-3333'),
(500, '', '', 126, 1, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '12', '', '', '', '', '11', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '85', '42.5 mm', '42.5 mm', '47', '47', '87', '87', '03-02-2021 16:29:05', 'CLAUDIA MARISOL CORVERA', '', ''),
(501, '', '', 114, 1, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '-0.14', '', '', '', '', '+012', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '47', '23.5 mm', '23.5 mm', '74', '74', '85', '85', '03-02-2021 16:57:43', 'ROSA EVELYN PERAZA', '', '2125-5555'),
(502, '', '', 117, 1, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '-1.0', '', '', '', '', '+1.0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '32', '16 mm', '16 mm', '14', '14', '15', '15', '08-02-2021 16:07:05', 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON', '', '7400-0002'),
(503, '', '', 138, 1, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '+1.0', '', '', '', '', '+2.0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '08-02-2021 16:09:21', 'SANDRA GONZALEZ', '', '2222-2222'),
(504, '', '', 142, 1, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '-0.25', '-0.25', '180', '', '', '-0.50', '-0.75', '180', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '62', '31 mm', '31 mm', '', '', '', '', '08-02-2021 13:58:01', 'CARMEN ALICIA MARQUEZ ROMERO', '', '2260-1650'),
(505, '', '', 143, 1, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '-0.50', '', '', '', '', '-0.25', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '11-02-2021 11:01:11', 'ALISSON MEJIA', '', '0000-0000'),
(506, 'DIFICULTAD EN VISION CERCANA', 'DIABETES CONTROLADO CON METFORMINA', 144, 1, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'PRESBICIA', '', 'NINGUNA ', '+2.00', '-0.75', '0', '', '+2.50', '+1.50', '-0.50', '180', '', '+2.50', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '66', '33 mm', '33 mm', '', '', '', '', '11-02-2021 11:06:21', 'OSCAR DE FLORES', '', '0000-0000'),
(507, '', '', 120, 1, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.9', '', '', '', '', '0.6', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '11-02-2021 15:09:23', 'NASIF HANDAL', '', '5555-2555'),
(508, '', '', 145, 1, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '+1.00', '', '', '', '', '+1.00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '77', '38.5 mm', '38.5 mm', '125', '125', '215', '215', '13-02-2021 14:59:21', 'JOSE RONALD FUENTES', '', ''),
(509, '', '', 146, 1, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.5', '', '', '', '', '0.1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '65', '32.5 mm', '32.5 mm', '', '', '', '', '14-02-2021 10:00:39', 'ALCLEISDER JAIMES', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_calidad_orden`
--

CREATE TABLE `control_calidad_orden` (
  `id_revision` int(11) NOT NULL,
  `numero_orden` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `estado_varilla` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `estado_frente` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `estado_codos` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `graduaciones` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `observaciones` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `productos` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `control_calidad_orden`
--

INSERT INTO `control_calidad_orden` (`id_revision`, `numero_orden`, `id_paciente`, `estado_varilla`, `estado_frente`, `estado_codos`, `graduaciones`, `observaciones`, `productos`, `id_usuario`, `fecha`) VALUES
(69, 'ODME-1', 114, '0', '0', '0', '0', 'RECHAZO', '0', 1, '07-02-2021 12:27:30'),
(70, 'ODME-1', 114, '0', '0', '0', '0', 'RECHAZO', '0', 1, '07-02-2021 12:30:55'),
(71, 'ODME-2', 139, 'Bueno', 'Bueno', 'Bueno', 'Correctas', '', 'Estuche,Spray,Franela,Bolsita', 1, '08-02-2021 13:35:00'),
(72, 'ODME-2', 139, '0', '0', '0', '0', 'LLAMADANO CONTESTA', '0', 1, '08-02-2021 13:35:28'),
(73, 'ODME-6', 138, 'Bueno', 'Bueno', 'Bueno', 'Correctas', '', 'Estuche,Spray,Franela,Bolsita', 1, '12-02-2021 16:15:07'),
(74, 'ODME-6', 138, '0', '0', '0', '0', 'LLAMADANO CONTESTA', '0', 1, '12-02-2021 16:17:49'),
(75, 'ODME-6', 138, '0', '0', '0', '0', 'LLAMADAel paciente ya contesto', '0', 1, '13-02-2021 22:13:18'),
(76, 'ODME-5', 117, 'Malo', 'Bueno', 'Bueno', 'Incorrectas', 'LAS VARILLAS VIENES DAÑADAS Y LAS GRADUACIONES NO COINCIDEN', 'Estuche,Spray,Franela,Bolsita', 1, '14-02-2021 08:09:59'),
(77, 'ODME-3', 114, '0', '0', '0', '0', 'RECHAZOSTADO DE VARILLAS DAÑADAS', '0', 1, '14-02-2021 08:11:10'),
(78, 'ODME-1', 114, '0', '0', '0', '0', 'RECHAZOVARILLAS LLAMADAS', '0', 1, '14-02-2021 13:51:53'),
(79, 'ODME-7', 142, 'Bueno', 'Bueno', 'Bueno', 'Correctas', '', 'Estuche,Spray,Franela,Bolsita', 1, '08-02-2021 14:02:48'),
(80, 'ODME-7', 142, '0', '0', '0', '0', 'LLAMADANO RESPONDIO', '0', 1, '08-02-2021 14:03:04'),
(81, 'ODME-7', 142, '0', '0', '0', '0', 'LLAMADAVENDRA  A RETIRARLOS', '0', 1, '08-02-2021 14:03:34'),
(82, 'ODME-8', 142, 'Bueno', 'Bueno', 'Bueno', 'Correctas', '', 'Estuche,Spray,Franela', 1, '09-02-2021 15:05:32'),
(83, 'ODME-1', 120, 'Bueno', 'Bueno', 'Bueno', 'Correctas', '', 'Estuche', 1, '12-02-2021 06:19:51'),
(84, 'ODME-1', 120, '0', '0', '0', '0', 'LLAMADAmnjk', '0', 1, '12-02-2021 06:19:57'),
(85, 'ODME-2', 144, 'Bueno', 'Bueno', 'Bueno', 'Correctas', '', 'Estuche,Spray', 1, '13-02-2021 09:53:09'),
(86, 'ODME-3', 145, 'Bueno', 'Bueno', 'Bueno', 'Correctas', '', 'Spray', 1, '13-02-2021 15:01:11'),
(87, 'ODME-3', 145, '0', '0', '0', '0', 'LLAMADAconfirmo retiro', '0', 1, '13-02-2021 15:01:23'),
(88, 'ODME-4', 146, 'Bueno', 'Bueno', 'Bueno', 'Incorrectas', '', 'Estuche,Spray,Franela,Bolsita', 1, '14-02-2021 10:03:53'),
(89, 'ODME-4', 146, '0', '0', '0', '0', 'LLAMADAno contesta', '0', 1, '14-02-2021 10:04:13'),
(90, 'ODME-4', 146, '0', '0', '0', '0', 'LLAMADASE LLAMO POOR SEGUNDA VEZ Y NO CONTESTO', '0', 1, '14-02-2021 10:04:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correlativo_factura`
--

CREATE TABLE `correlativo_factura` (
  `id_correlativo` int(11) NOT NULL,
  `n_correlativo` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `sucursal` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `n_venta` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` varchar(5) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `correlativo_factura`
--

INSERT INTO `correlativo_factura` (`id_correlativo`, `n_correlativo`, `sucursal`, `n_venta`, `id_usuario`) VALUES
(1, '0025', 'Metrocentro', 'AVME-25', '1'),
(2, '0024', 'Metrocentro', 'VME-28', '1'),
(3, '0010', 'Santa Ana', 'AVME-15', '1'),
(4, '11', 'Santa Ana', 'AVSA-1', '1'),
(5, '11', 'Santa Ana', 'AVSA-1', '1'),
(6, '12', 'Santa Ana', 'AVSA-1', '1'),
(7, '12', 'Santa Ana', 'AVSA-1', '1'),
(8, '13', 'Santa Ana', 'AVSA-1', '1'),
(9, '13', 'Santa Ana', 'AVSA-1', '1'),
(10, '14', 'Santa Ana', 'AVSA-1', '1'),
(11, '', 'Santa Ana', 'AVSA-1', '1'),
(12, '2', 'Santa Ana', 'AVSA-1', '1'),
(13, '3', 'Santa Ana', 'AVSA-1', '1'),
(14, '4', 'Santa Ana', 'AVSA-2', '1'),
(15, '25', 'Metrocentro', 'AVME-9', '1'),
(16, '26', 'Metrocentro', 'AVME-1', '1'),
(17, '27', 'Metrocentro', 'AVME-2', '1'),
(18, '28', 'Metrocentro', 'AVME-3', '1'),
(19, '29', 'Metrocentro', 'AVME-9', '1'),
(20, '30', 'Metrocentro', 'AVME-10', '1'),
(21, '31', 'Metrocentro', 'AVME-11', '1'),
(22, '32', 'Metrocentro', 'AVME-12', '1'),
(23, '33', 'Metrocentro', 'AVME-13', '2'),
(24, '34', 'Metrocentro', 'AVME-14', '2'),
(25, '35', 'Metrocentro', 'AVME-15', '1'),
(26, '36', 'Metrocentro', 'AVME-16', '1'),
(27, '37', 'Metrocentro', 'AVME-9', '1'),
(28, '38', 'Metrocentro', 'AVME-12', '1'),
(29, '39', 'Metrocentro', 'AVME-17', '1'),
(30, '40', 'Metrocentro', 'AVME-22', '1'),
(31, '41', 'Metrocentro', 'AVME-9', '1');

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
-- Volcado de datos para la tabla `corte_diario`
--

INSERT INTO `corte_diario` (`id_ingreso`, `fecha_ingreso`, `n_recibo`, `n_venta`, `n_factura`, `paciente`, `vendedor`, `total_factura`, `forma_cobro`, `monto_cobrado`, `saldo_credito`, `tipo_venta`, `tipo_pago`, `id_usuario`, `abono_anterior`, `abonos_realizados`, `id_paciente`, `sucursal_venta`, `sucursal_cobro`, `tipo_ingreso`) VALUES
(212, '24-11-2020 16:40:23', '', 'AVSM-1', '', 'CARLOS ANTONIO RIVERA', '1', '86.00', '', '', '86.00', 'Contado', 'Contado', 1, '0', '0', 123, 'San Miguel', '', 'Venta'),
(213, '28-11-2020 15:13:57', '', 'AVSM-2', '', 'CARLOS ANTONIO RIVERA', '1', '80.00', '', '', '80.00', 'Credito', 'Cargo Automatico', 1, '0', '0', 123, 'San Miguel', '', 'Venta'),
(214, '28-11-2020 16:08:05', '', 'AVSM-3', '', 'ERICK OSWALDO SORIANO ', '1', '98.00', '', '', '98.00', 'Contado', 'Contado', 1, '0', '0', 122, 'San Miguel', '', 'Venta'),
(215, '29-11-2020 11:53:30', '', 'AVSM-4', '', 'LILIANA ABIGAIL CRUZ SALAMANCA', '1', '110.00', '', '', '110.00', 'Credito', 'Cargo Automatico', 1, '0', '0', 121, 'San Miguel', '', 'Venta'),
(216, '29-11-2020 12:02:36', 'RME-1', 'AVME-1', '', 'CARLOS ANTONIO RIVAS', '1', '90.00', 'Efectivo', '18.00', '72.00', 'Credito', 'Cargo Automatico', 1, '0', '0', 119, 'Metrocentro', 'Metrocentro', 'Venta'),
(217, '29-11-2020 12:07:02', 'RME-2', 'AVME-2', '', 'ROSA EVELYN PERAZA', '1', '120.00', 'Efectivo', '25', '95.00', 'Contado', 'Contado', 1, '0', '0', 114, 'Metrocentro', 'Metrocentro', 'Venta'),
(218, '29-11-2020 12:51:52', 'RME-3', 'AVME-1', '', 'CARLOS ANTONIO RIVAS', '1', '90.00', 'Efectivo', '18.00', '54.00', 'Credito', 'Cargo Automatico', 1, '18', '2', 119, 'Metrocentro', 'Metrocentro', 'Recuperado'),
(219, '29-11-2020 13:08:48', 'RME-4', 'AVME-3', '', 'CAJAS PLEGADIZAS S.A DE C.V', '1', '120.00', 'Davivienda', '40.00', '80.00', 'Credito', 'Descuento en Planilla', 1, '0', '0', 112, 'Metrocentro', 'Metrocentro', 'Venta'),
(220, '29-11-2020 13:15:08', '', 'AVME-4', '', 'ROSA EVELYN PERAZA', '1', '120.00', '', '', '120.00', 'Contado', 'Contado', 1, '0', '0', 114, 'Metrocentro', '', 'Venta'),
(221, '29-11-2020 13:20:16', 'RME-20', 'AVME-5', '', 'ANA JULIETA HERNANDEZ', '1', '120.00', 'Efectivo', '120', '0.00', 'Contado', 'Efectivo', 1, '0', '0', 115, 'Metrocentro', 'Metrocentro', 'Venta'),
(222, '29-11-2020 13:21:25', 'RME-5', 'AVME-6', '', 'ROSA EVELYN PERAZA', '1', '120.00', 'Davivienda', '12.69', '107.31', 'Contado', 'Tarjeta de Credito', 1, '0', '0', 114, 'Metrocentro', 'Metrocentro', 'Venta'),
(223, '29-11-2020 14:39:57', 'RME-6', 'AVME-6', '', 'ROSA EVELYN PERAZA', '1', '120.00', 'Davivienda', '12.96', '94.35', 'Contado', 'Tarjeta de Credito', 1, '12.69', '2', 114, 'Metrocentro', 'Metrocentro', 'Recuperado'),
(224, '29-11-2020 14:46:01', 'RME-7', 'AVME-3', '', 'CAJAS PLEGADIZAS S.A DE C.V', '1', '120.00', 'Davivienda', '40.00', '40.00', 'Credito', 'Descuento en Planilla', 1, '40', '2', 112, 'Metrocentro', 'Metrocentro', 'Recuperado'),
(225, '30-11-2020 16:12:22', 'RME-22', 'AVME-7', '', 'ANA JULIETA HERNANDEZ', '1', '90.00', 'Efectivo', '150', '0.00', 'Contado', 'Contado', 1, '0', '0', 115, 'Metrocentro', 'Metrocentro', 'Venta'),
(226, '07-12-2020 13:53:25', 'RME-8', 'AVME-8', '', 'ROSA EVELYN PERAZA', '1', '190.00', 'Efectivo', '25', '165.00', 'Contado', 'Contado', 1, '0', '0', 114, 'Metrocentro', 'Metrocentro', 'Venta'),
(227, '07-12-2020 14:38:13', 'RME-9', 'AVME-9', '25', 'LUIS ALBERTO MARTINEZ', '1', '240.00', 'Efectivo', '30', '210.00', 'Contado', 'Contado', 1, '0', '0', 116, 'Metrocentro', 'Metrocentro', 'Venta'),
(228, '07-12-2020 14:39:26', 'RME-10', 'AVME-10', '', 'RODRIGO ANTONIO REGALADO RIVAS', '1', '335.00', 'Cuscatlan', '111.67', '223.33', 'Credito', 'Cargo Automatico', 1, '0', '0', 104, 'Metrocentro', 'Metrocentro', 'Venta'),
(229, '09-12-2020 09:46:13', '', 'AVME-11', '', 'ANA JULIETA HERNANDEZ', '1', '150.00', '', '', '150.00', 'Contado', 'Efectivo', 1, '0', '0', 115, 'Metrocentro', '', 'Venta'),
(230, '09-12-2020 11:04:17', '', 'AVME-12', '', 'LUIS ALBERTO MARTINEZ', '1', '90.00', '', '', '90.00', 'Contado', 'Efectivo', 1, '0', '0', 116, 'Metrocentro', '', 'Venta'),
(231, '09-12-2020 11:14:48', '', 'AVME-13', '', 'ANA JULIETA HERNANDEZ', '1', '150.00', '', '', '150.00', 'Contado', 'Contado', 1, '0', '0', 115, 'Metrocentro', '', 'Venta'),
(232, '09-12-2020 11:16:17', '', 'AVME-14', '', 'ANA JULIETA HERNANDEZ', '1', '290.00', '', '', '290.00', 'Contado', 'Efectivo', 1, '0', '0', 115, 'Metrocentro', '', 'Venta'),
(233, '09-12-2020 11:20:04', 'RME-30', 'AVME-15', '35', 'ROSA EVELYN PERAZA', '1', '250.00', 'Efectivo', '250', '0.00', 'Contado', 'Contado', 1, '0', '0', 114, 'Metrocentro', 'Metrocentro', 'Venta'),
(234, '09-12-2020 11:36:57', '', 'AVME-16', '', 'LUIS ALBERTO MARTINEZ', '1', '240.00', '', '', '240.00', 'Contado', 'Efectivo', 1, '0', '0', 116, 'Metrocentro', '', 'Venta'),
(235, '10-12-2020 13:16:20', 'RME-11', 'AVME-9', '25', 'LUIS ALBERTO MARTINEZ', '1', '240.00', 'Efectivo', '10', '200.00', 'Contado', 'Contado', 1, '30', '2', 116, 'Metrocentro', 'Metrocentro', 'Recuperado'),
(240, '12-12-2020 15:09:10', 'RME-12', 'AVME-20', '', 'ANA JULIETA HERNANDEZ', '1', '220.00', 'Efectivo', '25', '195.00', 'Contado', 'Contado', 1, '0', '0', 115, 'Metrocentro', 'Metrocentro', 'Venta'),
(241, '12-12-2020 15:12:01', '', 'AVME-21', '', 'NASIF HANDAL', '1', '90.00', '', '', '90.00', 'Credito', 'Cargo Automatico', 1, '0', '0', 120, 'Metrocentro', '', 'Venta'),
(242, '12-12-2020 15:19:41', '', 'AVME-22', '', 'RODRIGO ANTONIO REGALADO RIVAS', '1', '240.00', '', '', '240.00', 'Credito', 'Descuento en Planilla', 1, '0', '0', 104, 'Metrocentro', '', 'Venta'),
(243, '12-12-2020 16:30:12', '', 'AVME-23', '', 'ANA JULIETA HERNANDEZ', '1', '150.00', '', '', '150.00', 'Contado', 'Contado', 1, '0', '0', 115, 'Metrocentro', '', 'Venta'),
(244, '13-12-2020 12:10:37', '', 'AVME-24', '', 'LUIS ALBERTO MARTINEZ', '1', '220.00', '', '', '220.00', 'Contado', 'Efectivo', 1, '0', '0', 116, 'Metrocentro', '', 'Venta'),
(245, '13-12-2020 14:59:54', '', 'AVME-25', '', 'LUIS ALBERTO MARTINEZ', '1', '190.00', '', '', '190.00', 'Contado', 'Contado', 1, '0', '0', 116, 'Metrocentro', '', 'Venta'),
(246, '13-12-2020 15:01:27', '', 'AVME-26', '', 'ROSA EVELYN PERAZA', '1', '240.00', '', '', '240.00', 'Contado', 'Contado', 1, '0', '0', 114, 'Metrocentro', '', 'Venta'),
(247, '13-12-2020 15:31:14', '', 'AVME-27', '', 'RODRIGO ANTONIO REGALADO RIVAS', '1', '270.00', '', '', '270.00', 'Contado', 'Contado', 1, '0', '0', 104, 'Metrocentro', '', 'Venta'),
(248, '13-12-2020 15:36:14', 'RME-14', 'AVME-28', '', 'ROSA EVELYN PERAZA', '1', '120.00', 'Efectivo', '120', '0.00', 'Contado', 'Contado', 1, '0', '0', 114, 'Metrocentro', 'Metrocentro', 'Venta'),
(249, '15-12-2020 13:14:51', 'RME-13', 'AVME-9', '25', 'LUIS ALBERTO MARTINEZ', '1', '240.00', 'Efectivo', '200', '0.00', 'Contado', 'Contado', 1, '40', '3', 116, 'Metrocentro', 'Metrocentro', 'Recuperado'),
(250, '15-12-2020 14:30:50', 'RSA-1', 'AVSA-1', '3', 'OSCAR RAMOS', '1', '150.00', 'Efectivo', '150', '0.00', 'Contado', 'Contado', 1, '0', '0', 124, 'Santa Ana', 'Santa Ana', 'Venta'),
(251, '16-12-2020 14:12:21', 'RSA-2', 'AVSA-2', '4', 'OSCAR RAMOS', '1', '150.00', 'Efectivo', '150', '0.00', 'Contado', 'Efectivo', 1, '0', '0', 124, 'Santa Ana', 'Santa Ana', 'Venta'),
(252, '16-12-2020 14:30:50', 'RME-15', 'AVME-1', '26', 'RODRIGO ANTONIO REGALADO RIVAS', '1', '335.00', 'Cheque', '150', '185.00', 'Contado', 'Efectivo', 1, '0', '0', 104, 'Metrocentro', 'Metrocentro', 'Venta'),
(253, '16-12-2020 14:32:51', 'RME-16', 'AVME-1', '26', 'RODRIGO ANTONIO REGALADO RIVAS', '1', '335.00', 'Serfinsa', '185', '0.00', 'Contado', 'Efectivo', 1, '150', '2', 104, 'Metrocentro', 'Metrocentro', 'Recuperado'),
(254, '16-12-2020 15:05:47', 'RME-17', 'AVME-2', '27', 'LUIS ALBERTO MARTINEZ', '1', '120.00', 'Efectivo', '120', '0.00', 'Contado', 'Efectivo', 1, '0', '0', 116, 'Metrocentro', 'Metrocentro', 'Venta'),
(255, '16-12-2020 15:53:44', 'RME-18', 'AVME-3', '28', 'ANA JULIETA HERNANDEZ', '1', '150.00', 'Efectivo', '150', '0.00', 'Contado', 'Contado', 1, '0', '0', 115, 'Metrocentro', 'Metrocentro', 'Venta'),
(256, '16-12-2020 15:58:27', 'RME-19', 'AVME-4', '', 'ANA JULIETA HERNANDEZ', '1', '90.00', 'Efectivo', '90', '0.00', 'Contado', 'Contado', 1, '0', '0', 115, 'Metrocentro', 'Metrocentro', 'Venta'),
(257, '16-12-2020 16:00:20', 'RME-20', 'AVME-5', '', 'ANA JULIETA HERNANDEZ', '1', '120.00', 'Efectivo', '120', '0.00', 'Contado', 'Contado', 1, '0', '0', 115, 'Metrocentro', 'Metrocentro', 'Venta'),
(258, '16-12-2020 16:01:20', 'RME-21', 'AVME-6', '', 'ANA JULIETA HERNANDEZ', '1', '150.00', 'Efectivo', '150', '0.00', 'Contado', 'Contado', 1, '0', '0', 115, 'Metrocentro', 'Metrocentro', 'Venta'),
(259, '16-12-2020 16:03:44', 'RME-22', 'AVME-7', '', 'ANA JULIETA HERNANDEZ', '1', '150.00', 'Efectivo', '150', '0.00', 'Contado', 'Contado', 1, '0', '0', 115, 'Metrocentro', 'Metrocentro', 'Venta'),
(260, '16-12-2020 16:06:29', 'RME-23', 'AVME-8', '', 'ANA JULIETA HERNANDEZ', '1', '120.00', 'Efectivo', '120', '0.00', 'Contado', 'Contado', 1, '0', '0', 115, 'Metrocentro', 'Metrocentro', 'Venta'),
(261, '16-12-2020 16:09:29', 'RME-24', 'AVME-9', '37', 'ANA JULIETA HERNANDEZ', '1', '120.00', 'Efectivo', '120', '0.00', 'Contado', 'Efectivo', 1, '0', '0', 115, 'Metrocentro', 'Metrocentro', 'Venta'),
(262, '16-12-2020 16:15:38', 'RME-25', 'AVME-10', '30', 'ROSA EVELYN PERAZA', '1', '360.00', 'Efectivo', '360', '0.00', 'Contado', 'Contado', 1, '0', '0', 114, 'Metrocentro', 'Metrocentro', 'Venta'),
(263, '17-12-2020 11:44:00', 'RME-26', 'AVME-11', '31', 'ROSA EVELYN PERAZA', '1', '9.00', 'Efectivo', '9', '0.00', 'Contado', 'Contado', 1, '0', '0', 114, 'Metrocentro', 'Metrocentro', 'Venta'),
(264, '17-12-2020 12:11:25', 'RME-27', 'AVME-12', '38', 'ANA JULIETA HERNANDEZ', '1', '6.00', 'Cheque', '6', '0.00', 'Contado', 'Efectivo', 1, '0', '0', 115, 'Metrocentro', 'Metrocentro', 'Venta'),
(265, '17-12-2020 12:20:42', 'RME-28', 'AVME-13', '33', 'NASIF HANDAL', '2', '10.00', 'Efectivo', '10', '0.00', 'Contado', 'Efectivo', 2, '0', '0', 120, 'Metrocentro', 'Metrocentro', 'Venta'),
(266, '17-12-2020 12:23:53', 'RME-29', 'AVME-14', '34', 'GERSON ARMANDO FLOERS', '2', '45.00', 'Efectivo', '45', '0.00', 'Contado', 'Efectivo', 2, '0', '0', 118, 'Metrocentro', 'Metrocentro', 'Venta'),
(267, '17-12-2020 12:28:51', 'RME-30', 'AVME-15', '35', 'ROSA EVELYN PERAZA', '1', '250.00', 'Efectivo', '250', '0.00', 'Contado', 'Contado', 1, '0', '0', 114, 'Metrocentro', 'Metrocentro', 'Venta'),
(268, '17-12-2020 12:33:16', 'RME-31', 'AVME-16', '36', 'ROSA EVELYN PERAZA', '1', '452.00', 'Cheque', '452', '0.00', 'Contado', 'Efectivo', 1, '0', '0', 114, 'Metrocentro', 'Metrocentro', 'Venta'),
(269, '22-12-2020 10:58:37', 'RME-32', 'AVME-17', '39', 'FREDY VEGA', '1', '144.80', 'Efectivo', '144.80', '0.00', 'Contado', 'Contado', 1, '0', '0', 125, 'Metrocentro', 'Metrocentro', 'Venta'),
(270, '22-12-2020 13:55:57', '', 'AVME-18', '', 'ANA MARIA GONZALEZ', '1', '150.00', '', '', '150.00', 'Contado', 'Efectivo', 1, '0', '0', 127, 'Metrocentro', '', 'Venta'),
(271, '22-12-2020 16:13:27', '', 'AVME-19', '', 'MAITEH PERRONI', '1', '375.00', '', '', '375.00', 'Contado', 'Contado', 1, '0', '0', 128, 'Metrocentro', '', 'Venta'),
(272, '23-12-2020 11:00:46', '', 'AVME-20', '', 'JENCY CECIBEL LANDAVERDE MEZA', '1', '300.00', '', '', '300.00', 'Contado', 'Contado', 1, '0', '0', 130, 'Metrocentro', '', 'Venta'),
(273, '23-12-2020 16:23:12', '', 'AVME-21', '', 'JENCY CECIBEL LANDAVERDE MEZA', '1', '150.00', '', '', '150.00', 'Contado', 'Contado', 1, '0', '0', 130, 'Metrocentro', '', 'Venta'),
(274, '26-12-2020 14:24:57', 'RME-33', 'AVME-22', '', 'JENCY CECIBEL LANDAVERDE MEZA', '1', '120.00', 'Efectivo', '28', '92.00', 'Contado', 'Contado', 1, '0', '0', 130, 'Metrocentro', 'Metrocentro', 'Venta'),
(275, '26-12-2020 14:28:03', 'RME-34', 'AVME-23', '', 'SANDRA PATRICIA RAMIRES', '1', '240.00', 'Efectivo', '25', '215.00', 'Contado', 'Contado', 1, '0', '0', 129, 'Metrocentro', 'Metrocentro', 'Venta'),
(276, '26-12-2020 14:30:08', 'RME-35', 'AVME-24', '', 'JENCY CECIBEL LANDAVERDE MEZA', '1', '150.00', 'Efectivo', '25', '125.00', 'Contado', 'Contado', 1, '0', '0', 130, 'Metrocentro', 'Metrocentro', 'Venta'),
(277, '26-12-2020 14:31:39', 'RME-36', 'AVME-8', '', 'ANA JULIETA HERNANDEZ', '1', '190.00', 'Efectivo', '25', '140.00', NULL, NULL, 1, '25', '2', 114, 'Metrocentro', 'Metrocentro', 'Recuperado'),
(278, '26-12-2020 14:32:03', 'RME-37', 'AVME-6', '', 'ANA JULIETA HERNANDEZ', '1', '120.00', 'Efectivo', '25', '69.35', NULL, NULL, 1, '25.65', '3', 114, 'Metrocentro', 'Metrocentro', 'Recuperado'),
(279, '26-12-2020 14:41:39', 'RME-38', 'AVME-6', '', 'ANA JULIETA HERNANDEZ', '1', '120.00', 'Efectivo', '25', '44.35', NULL, NULL, 1, '50.65', '4', 114, 'Metrocentro', 'Metrocentro', 'Recuperado'),
(280, '26-12-2020 14:42:41', 'RME-39', 'AVME-25', '', 'MAITEH PERRONI', '1', '150.00', 'Efectivo', '25', '125.00', 'Contado', 'Contado', 1, '0', '0', 128, 'Metrocentro', 'Metrocentro', 'Venta'),
(281, '26-12-2020 14:59:23', 'RSM-1', 'AVSM-1', '', 'ERICK OSWALDO SORIANO ', '1', '90.00', 'Efectivo', '15', '75.00', 'Contado', 'Contado', 1, '0', '0', 122, 'San Miguel', 'San Miguel', 'Venta'),
(282, '26-12-2020 15:25:33', 'RSM-2', 'AVSM-2', '', 'LILIANA ABIGAIL CRUZ SALAMANCA', '1', '90.00', 'Efectivo', '25', '65.00', 'Contado', 'Efectivo', 1, '0', '0', 121, 'San Miguel', 'San Miguel', 'Venta'),
(283, '26-12-2020 15:30:20', 'RSM-3', 'AVSM-3', '', 'LILIANA ABIGAIL CRUZ SALAMANCA', '1', '90.00', 'Efectivo', '25', '65.00', 'Contado', 'Contado', 1, '0', '0', 121, 'San Miguel', 'San Miguel', 'Venta'),
(284, '26-12-2020 15:31:52', 'RSM-4', 'AVSM-3', '', 'LILIANA ABIGAIL CRUZ SALAMANCA', '1', '90.00', 'Efectivo', '25', '40.00', 'Contado', 'Contado', 1, '25', '2', 121, 'San Miguel', 'San Miguel', 'Recuperado'),
(285, '26-12-2020 15:37:50', 'RSM-5', 'AVSM-3', '', 'LILIANA ABIGAIL CRUZ SALAMANCA', '1', '90.00', 'Cheque', '25', '15.00', 'Contado', 'Contado', 1, '50', '3', 121, 'San Miguel', 'San Miguel', 'Recuperado'),
(286, '26-12-2020 16:26:14', '', 'AVSM-4', '', 'LILIANA ABIGAIL CRUZ SALAMANCA', '1', '90.00', '', '', '90.00', 'Contado', 'Contado', 1, '0', '0', 121, 'San Miguel', '', 'Venta'),
(287, '27-12-2020 11:34:52', '', 'AVME-26', '', 'CLAUDIA MARISOL CORVERA', '1', '120.00', '', '', '120.00', 'Contado', 'Contado', 1, '0', '0', 126, 'Metrocentro', '', 'Venta'),
(288, '30-12-2020 10:20:50', '', 'AVME-27', '', 'FREDY VEGA', '1', '150.00', '', '', '150.00', 'Contado', 'Contado', 1, '0', '0', 125, 'Metrocentro', '', 'Venta'),
(289, '30-12-2020 10:37:11', '', 'AVME-28', '', 'CLAUDIA MARISOL CORVERA', '1', '150.00', '', '', '150.00', 'Contado', 'Contado', 1, '0', '0', 126, 'Metrocentro', '', 'Venta'),
(290, '30-12-2020 10:59:37', '', 'AVME-29', '', 'SANDRA PATRICIA RAMIRES', '1', '75.25', '', '', '75.25', 'Contado', 'Contado', 1, '0', '0', 129, 'Metrocentro', '', 'Venta'),
(291, '30-12-2020 11:12:34', '', 'AVME-30', '', 'JENCY CECIBEL LANDAVERDE MEZA', '1', '75.25', '', '', '75.25', 'Contado', 'Contado', 1, '0', '0', 130, 'Metrocentro', '', 'Venta'),
(292, '30-12-2020 12:35:26', '', 'AVME-31', '', 'JENCY CECIBEL LANDAVERDE MEZA', '1', '75.25', '', '', '75.25', 'Contado', 'Contado', 1, '0', '0', 130, 'Metrocentro', '', 'Venta'),
(293, '03-01-2021 15:20:05', 'RME-40', 'AVME-32', '', 'NEFTALY GUZAMN', '1', '75.25', 'Efectivo', '75.25', '0.00', 'Contado', 'Efectivo', 1, '0', '0', 132, 'Metrocentro', 'Metrocentro', 'Venta'),
(294, '06-01-2021 12:44:50', '', 'AVME-1', '', 'ALEXANDER LOPEZ DIAZ', '1', '175.25', '', '', '175.25', 'Contado', 'Contado', 1, '0', '0', 134, 'Metrocentro', '', 'Venta'),
(295, '06-01-2021 13:22:07', '', 'AVME-3', '', 'JENCY CECIBEL LANDAVERDE MEZA', '1', '75.25', '', '', '75.25', 'Contado', 'Contado', 1, '0', '0', 130, 'Metrocentro', '', 'Venta'),
(296, '06-01-2021', '', 'AVME-12', '', 'SANDRA PATRICIA RAMIRES', '1', '325.25', '', '', '325.25', 'Credito', 'Descuento en Planilla', 1, '0', '0', 129, 'Metrocentro', '', 'Venta'),
(297, '06-01-2021', '', 'AVME-13', '', 'NEFTALY GUZAMN', '1', '135.25', '', '', '135.25', 'Credito', 'Descuento en Planilla', 1, '0', '0', 132, 'Metrocentro', '', 'Venta'),
(298, '06-01-2021', 'RME-41', 'AVME-14', '', 'SANDRA GONZALEZ', '1', '185.25', 'Cheque', '18.53', '166.72', 'Credito', 'Descuento en Planilla', 1, '0', '0', 138, 'Metrocentro', 'Metrocentro', 'Venta'),
(299, '06-10-2021', '', 'AVME-15', '', 'SANDRA GONZALEZ', '1', '185.25', '', '', '185.25', 'Credito', 'Descuento en Planilla', 1, '0', '0', 138, 'Metrocentro', '', 'Venta'),
(300, '06-10-2021', '', 'AVME-16', '', 'NEFTALY GUZAMN', '1', '135.25', '', '', '135.25', 'Credito', 'Descuento en Planilla', 1, '0', '0', 132, 'Metrocentro', '', 'Venta'),
(301, '06-10-2021', '', 'AVME-17', '', 'JACKELIN ASUNCION MOLINA', '1', '150.50', '', '', '150.50', 'Credito', 'Descuento en Planilla', 1, '0', '0', 137, 'Metrocentro', '', 'Venta'),
(302, '06-10-2021', '', 'AVME-18', '', 'SANDRA PATRICIA RAMIRES', '1', '325.25', '', '', '325.25', 'Credito', 'Descuento en Planilla', 1, '0', '0', 129, 'Metrocentro', '', 'Venta'),
(303, '06-10-2021', '', 'AVME-19', '', 'NEFTALY GUZAMN', '1', '310.25', '', '', '310.25', 'Credito', 'Descuento en Planilla', 1, '0', '0', 132, 'Metrocentro', '', 'Venta'),
(304, '06-10-2021', '', 'AVME-20', '', 'NEFTALY GUZAMN', '1', '175.25', '', '', '175.25', 'Credito', 'Descuento en Planilla', 1, '0', '0', 132, 'Metrocentro', '', 'Venta'),
(305, '08-01-2021', '', 'AVME-21', '', 'ALEXANDER LOPEZ DIAZ', '1', '175.25', '', '', '175.25', 'Credito', 'Descuento en Planilla', 1, '0', '0', 134, 'Metrocentro', '', 'Venta'),
(306, '08-01-2021 15:39:28', 'RME-42', 'AVME-22', '40', 'ANA MARIA GONZALEZ', '1', '225.25', 'Cheque', '32.12', '193.13', 'Contado', 'Contado', 1, '0', '0', 127, 'Metrocentro', 'Metrocentro', 'Venta'),
(307, '09-01-2021 09:21:25', 'RME-43', 'AVME-23', '', 'MAITEH PERRONI', '1', '75.25', 'Efectivo', '25', '50.25', 'Contado', 'Contado', 1, '0', '0', 128, 'Metrocentro', 'Metrocentro', 'Venta'),
(308, '11-01-2021 09:50:13', 'RME-44', 'AVME-22', '40', 'ANA MARIA GONZALEZ', '1', '225.25', 'Efectivo', '193.13', '0.00', 'Contado', 'Contado', 1, '32.12', '2', 127, 'Metrocentro', 'Metrocentro', 'Recuperado'),
(309, '12-01-2021 13:58:53', '', 'AVME-24', '', 'LUCIANA MICHELLE RAMIREZ ', '1', '135.25', '', '', '135.25', 'Contado', 'Efectivo', 1, '0', '0', 139, 'Metrocentro', '', 'Venta'),
(310, '12-01-2021 14:22:27', '', 'AVME-25', '', 'LUCIANA MICHELLE RAMIREZ ', '1', '75.25', '', '', '75.25', 'Contado', 'Contado', 1, '0', '0', 139, 'Metrocentro', '', 'Venta'),
(311, '13-01-2021 16:07:05', '', 'AVME-26', '', 'ANA MARIA GONZALEZ', '1', '235.25', '', '', '235.25', 'Contado', 'Contado', 1, '0', '0', 127, 'Metrocentro', '', 'Venta'),
(312, '13-01-2021 16:28:08', '', 'AVME-27', '', 'MARCELA  ROXANA ARRIOLA', '1', '410.25', '', '', '410.25', 'Contado', 'Efectivo', 1, '0', '0', 140, 'Metrocentro', '', 'Venta'),
(313, '14-01-2021 14:59:29', '', 'AVME-28', '', 'MARCELA  ROXANA ARRIOLA', '1', '260.00', '', '', '260.00', 'Contado', 'Efectivo', 1, '0', '0', 140, 'Metrocentro', '', 'Venta'),
(314, '14-01-2021 15:18:17', '', 'AVME-29', '', 'LUCIANA MICHELLE RAMIREZ ', '1', '335.00', '', '', '335.00', 'Contado', 'Contado', 1, '0', '0', 139, 'Metrocentro', '', 'Venta'),
(315, '14-01-2021 15:34:13', '', 'AVME-30', '', 'ROSA EVELYN PERAZA', '1', '335.00', '', '', '335.00', 'Contado', 'Contado', 1, '0', '0', 114, 'Metrocentro', '', 'Venta'),
(316, '21-01-2021', '', 'AVME-31', '', 'CARLOS ERNESTO REYES', '1', '155.25', '', '', '155.25', 'Credito', 'Descuento en Planilla', 1, '0', '0', 136, 'Metrocentro', '', 'Venta'),
(317, '24-01-2021 11:53:21', 'RME-45', 'AVME-32', '', 'RODRIGO ANTONIO REGALADO RIVAS', '1', '260.25', 'Efectivo', '25', '235.25', 'Contado', 'Contado', 1, '0', '0', 104, 'Metrocentro', 'Metrocentro', 'Venta'),
(318, '24-01-2021 12:13:21', '', 'AVME-33', '', 'RODRIGO ANTONIO REGALADO RIVAS', '1', '150.00', '', '', '150.00', 'Contado', 'Contado', 1, '0', '0', 104, 'Metrocentro', '', 'Venta'),
(319, '28-01-2021 13:50:09', '', 'AVME-34', '', 'CARMEN ARELY VASQUEZ MARTINEZ', '1', '185.25', '', '', '185.25', 'Contado', 'Contado', 1, '0', '0', 141, 'Metrocentro', '', 'Venta'),
(320, '28-01-2021 14:17:09', '', 'AVME-35', '', 'CARMEN ARELY VASQUEZ MARTINEZ', '1', '225.25', '', '', '225.25', 'Contado', 'Contado', 1, '0', '0', 141, 'Metrocentro', '', 'Venta'),
(321, '28-01-2021 14:20:56', '', 'AVME-36', '', 'CARMEN ARELY VASQUEZ MARTINEZ', '1', '350.00', '', '', '350.00', 'Contado', 'Contado', 1, '0', '0', 141, 'Metrocentro', '', 'Venta'),
(322, '02-02-2021 12:04:30', '', 'AVME-1', '', 'CARMEN ARELY VASQUEZ MARTINEZ', '1', '131.25', '', '', '131.25', 'Contado', 'Contado', 1, '0', '0', 141, 'Metrocentro', '', 'Venta'),
(323, '02-02-2021', '', 'AVME-2', '', 'LUCIANA MICHELLE RAMIREZ ', '1', '225.25', '', '', '225.25', 'Credito', 'Descuento en Planilla', 1, '0', '0', 139, 'Metrocentro', '', 'Venta'),
(324, '02-02-2021 13:27:52', 'RME-46', 'AVME-3', '', 'CARMEN ARELY VASQUEZ MARTINEZ', '1', '210.00', 'Efectivo', '25', '185.00', 'Contado', 'Contado', 1, '0', '0', 141, 'Metrocentro', 'Metrocentro', 'Venta'),
(325, '02-02-2021 14:33:12', 'RME-47', 'AVME-4', '', 'IRIS DEL CARMEN ENRRUIQUEZ', '1', '210.25', 'Efectivo', '25', '185.25', 'Contado', 'Contado', 1, '0', '0', 133, 'Metrocentro', 'Metrocentro', 'Venta'),
(326, '02-02-2021 14:54:26', '', 'AVME-5', '', 'SALVADOR ALAS', '1', '175.25', '', '', '175.25', 'Contado', 'Contado', 1, '0', '0', 131, 'Metrocentro', '', 'Venta'),
(327, '02-02-2021 15:53:25', '', 'AVME-6', '', 'CLAUDIA MARISOL CORVERA', '1', '300.00', '', '', '300.00', 'Contado', 'Contado', 1, '0', '0', 126, 'Metrocentro', '', 'Venta'),
(328, '03-02-2021 09:57:59', '', 'AVME-7', '', 'ANA JULIETA HERNANDEZ', '1', '185.00', '', '', '185.00', 'Contado', 'Contado', 1, '0', '0', 115, 'Metrocentro', '', 'Venta'),
(329, '03-02-2021 11:01:42', '', 'AVME-1', '', 'MARCELA  ROXANA ARRIOLA', '1', '125.25', '', '', '125.25', 'Contado', 'Contado', 1, '0', '0', 140, 'Metrocentro', '', 'Venta'),
(330, '03-02-2021 11:25:44', '', 'AVME-2', '', 'SALVADOR ALAS', '1', '275.25', '', '', '275.25', 'Contado', 'Contado', 1, '0', '0', 131, 'Metrocentro', '', 'Venta'),
(331, '03-02-2021 11:58:01', '', 'AVME-3', '', 'MARCELA  ROXANA ARRIOLA', '1', '270.25', '', '', '270.25', 'Contado', 'Contado', 1, '0', '0', 140, 'Metrocentro', '', 'Venta'),
(332, '03-02-2021 12:34:20', '', 'AVME-4', '', 'CARLOS ERNESTO REYES', '1', '212.00', '', '', '212.00', 'Contado', 'Contado', 1, '0', '0', 136, 'Metrocentro', '', 'Venta'),
(333, '03-02-2021 14:44:45', '', 'AVME-1', '', 'SONIA DAYSI MENA DURAN', '1', '152.25', '', '', '152.25', 'Contado', 'Contado', 1, '0', '0', 135, 'Metrocentro', '', 'Venta'),
(334, '03-02-2021 15:01:40', '', 'AVME-2', '', 'CARMEN ARELY VASQUEZ MARTINEZ', '1', '285.00', '', '', '285.00', 'Contado', 'Contado', 1, '0', '0', 141, 'Metrocentro', '', 'Venta'),
(335, '03-02-2021 15:07:55', '', 'AVME-3', '', 'CARMEN ARELY VASQUEZ MARTINEZ', '1', '287.00', '', '', '287.00', 'Contado', 'Contado', 1, '0', '0', 141, 'Metrocentro', '', 'Venta'),
(336, '03-02-2021 16:29:21', '', 'AVME-1', '', 'CLAUDIA MARISOL CORVERA', '1', '150.00', '', '', '150.00', 'Contado', 'Contado', 1, '0', '0', 126, 'Metrocentro', '', 'Venta'),
(337, '03-02-2021 16:31:32', '', 'AVME-2', '', 'LUCIANA MICHELLE RAMIREZ ', '1', '185.00', '', '', '185.00', 'Contado', 'Contado', 1, '0', '0', 139, 'Metrocentro', '', 'Venta'),
(338, '03-02-2021 16:32:16', '', 'AVME-3', '', 'CARMEN ARELY VASQUEZ MARTINEZ', '1', '177.25', '', '', '177.25', 'Contado', 'Contado', 1, '0', '0', 141, 'Metrocentro', '', 'Venta'),
(339, '03-02-2021 16:57:52', '', 'AVME-4', '', 'ROSA EVELYN PERAZA', '1', '127.00', '', '', '127.00', 'Contado', 'Contado', 1, '0', '0', 114, 'Metrocentro', '', 'Venta'),
(340, '03-02-2021 17:04:16', '', 'AVME-1', '', 'ROSA EVELYN PERAZA', '1', '177.25', '', '', '177.25', 'Contado', 'Contado', 1, '0', '0', 114, 'Metrocentro', '', 'Venta'),
(341, '03-02-2021 17:05:32', '', 'AVME-2', '', 'CLAUDIA MARISOL CORVERA', '1', '235.25', '', '', '235.25', 'Contado', 'Contado', 1, '0', '0', 126, 'Metrocentro', '', 'Venta'),
(342, '03-02-2021 17:06:35', '', 'AVME-3', '', 'LUCIANA MICHELLE RAMIREZ ', '1', '237.25', '', '', '237.25', 'Contado', 'Contado', 1, '0', '0', 139, 'Metrocentro', '', 'Venta'),
(343, '03-02-2021 17:07:41', '', 'AVME-4', '', 'CARMEN ARELY VASQUEZ MARTINEZ', '1', '287.25', '', '', '287.25', 'Contado', 'Contado', 1, '0', '0', 141, 'Metrocentro', '', 'Venta'),
(344, '08-02-2021 16:07:13', 'RME-48', 'AVME-5', '', 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON', '1', '210.25', 'Efectivo', '25', '185.25', 'Contado', 'Contado', 1, '0', '0', 117, 'Metrocentro', 'Metrocentro', 'Venta'),
(345, '08-02-2021', 'RME-52', 'AVME-6', '', 'SANDRA GONZALEZ', '1', '260.25', 'Efectivo', '260.25', '0.00', 'Credito', 'Descuento en Planilla', 1, '0', '0', 138, 'Metrocentro', 'Metrocentro', 'Venta'),
(346, '14-02-2021 15:59:56', '', 'AVME-7', '', 'SANDRA GONZALEZ', '1', '125.25', '', '', '125.25', 'Credito', 'Cargo Automatico', 1, '0', '0', 138, 'Metrocentro', '', 'Venta'),
(347, '14-02-2021 16:03:31', 'RME-50', 'AVME-8', '', 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON', '1', '125.25', 'Efectivo', '125.25', '0.00', 'Credito', 'Cargo Automatico', 1, '0', '0', 117, 'Metrocentro', 'Metrocentro', 'Venta'),
(348, '14-02-2021 16:05:55', 'RME-49', 'AVME-9', '41', 'CLAUDIA MARISOL CORVERA', '1', '100.25', 'Efectivo', '100.25', '0.00', 'Contado', 'Contado', 1, '0', '0', 126, 'Metrocentro', 'Metrocentro', 'Venta'),
(349, '15-02-2021 12:04:47', '', 'AVME-10', '', 'CARMEN ARELY VASQUEZ MARTINEZ', '1', '75.25', '', '', '75.25', 'Contado', 'Contado', 1, '0', '0', 141, 'Metrocentro', '', 'Venta'),
(350, '15-02-2021 12:13:20', '', 'AVME-11', '', 'CLAUDIA MARISOL CORVERA', '1', '75.25', '', '', '75.25', 'Contado', 'Contado', 1, '0', '0', 126, 'Metrocentro', '', 'Venta'),
(351, '15-02-2021 12:32:58', '', 'AVME-12', '', 'LUCIANA MICHELLE RAMIREZ ', '1', '227.25', '', '', '227.25', 'Contado', 'Contado', 1, '0', '0', 139, 'Metrocentro', '', 'Venta'),
(352, '15-02-2021 12:34:48', '', 'AVME-13', '', 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON', '1', '275.25', '', '', '275.25', 'Contado', 'Contado', 1, '0', '0', 117, 'Metrocentro', '', 'Venta'),
(353, '15-02-2021 12:41:07', '', 'AVME-14', '', 'LUCIANA MICHELLE RAMIREZ ', '1', '175.25', '', '', '175.25', 'Credito', 'Cargo Automatico', 1, '0', '0', 139, 'Metrocentro', '', 'Venta'),
(354, '15-02-2021', '', 'AVME-15', '', 'CARMEN ARELY VASQUEZ MARTINEZ', '1', '225.25', '', '', '225.25', 'Credito', 'Descuento en Planilla', 1, '0', '0', 141, 'Metrocentro', '', 'Venta'),
(355, '15-02-2021 13:53:28', '', 'AVME-16', '', 'CLAUDIA MARISOL CORVERA', '1', '202.25', '', '', '202.25', 'Contado', 'Contado', 1, '0', '0', 126, 'Metrocentro', '', 'Venta'),
(356, '15-02-2021 13:58:36', 'RME-51', 'AVME-17', '', 'ROSA EVELYN PERAZA', '1', '225.25', 'Efectivo', '225.25', '0.00', 'Contado', 'Contado', 1, '0', '0', 114, 'Metrocentro', 'Metrocentro', 'Venta'),
(357, '08-02-2021 13:58:12', 'RME-53', 'AVME-18', '', 'CARMEN ALICIA MARQUEZ ROMERO', '1', '100.00', 'Serfinsa', '50', '50.00', 'Contado', 'Contado', 1, '0', '0', 142, 'Metrocentro', 'Metrocentro', 'Venta'),
(358, '09-02-2021 15:02:41', '', 'AVME-19', '', 'CARMEN ALICIA MARQUEZ ROMERO', '1', '151.02', '', '', '151.02', 'Contado', 'Contado', 1, '0', '0', 142, 'Metrocentro', '', 'Venta'),
(359, '11-02-2021 11:06:48', 'RME-54', 'AVME-20', '', 'OSCAR DE FLORES', '1', '355.35', 'Efectivo', '100', '255.35', 'Contado', 'Efectivo', 1, '0', '0', 144, 'Metrocentro', 'Metrocentro', 'Venta'),
(360, '11-02-2021 11:13:13', 'RME-55', 'AVME-20', '', 'OSCAR DE FLORES', '1', '355.35', 'Efectivo', '255.35', '0.00', 'Contado', 'Efectivo', 1, '100', '2', 144, 'Metrocentro', 'Metrocentro', 'Recuperado'),
(361, '11-02-2021 15:03:14', '', 'AVME-21', '', 'BETANIA MEJIA', '1', '305.67', '', '', '305.67', 'Contado', 'Contado', 1, '0', '0', 143, 'Metrocentro', '', 'Venta'),
(362, '11-02-2021 15:09:31', '', 'AVME-22', '', 'NASIF HANDAL', '1', '172.35', '', '', '172.35', 'Contado', 'Contado', 1, '0', '0', 120, 'Metrocentro', '', 'Venta'),
(363, '12-02-2021 06:18:07', '', 'AVME-23', '', 'NASIF HANDAL', '1', '202.00', '', '', '202.00', 'Contado', 'Contado', 1, '0', '0', 120, 'Metrocentro', '', 'Venta'),
(364, '13-02-2021 09:51:55', '', 'AVME-24', '', 'OSCAR DE FLORES', '1', '77.00', '', '', '77.00', 'Contado', 'Contado', 1, '0', '0', 144, 'Metrocentro', '', 'Venta'),
(365, '13-02-2021 14:30:14', '', 'AVME-25', '', 'LUCIANA MICHELLE RAMIREZ ', '1', '160.00', '', '', '160.00', 'Contado', 'Contado', 1, '0', '0', 139, 'Metrocentro', '', 'Venta'),
(366, '13-02-2021 14:59:44', '', 'AVME-26', '', 'JOSE RONALD FUENTES', '1', '173.50', '', '', '173.50', 'Contado', 'Contado', 1, '0', '0', 145, 'Metrocentro', '', 'Venta'),
(367, '14-02-2021 10:00:46', '', 'AVME-27', '', 'ALCLEISDER JAIMES', '1', '234.48', '', '', '234.48', 'Contado', 'Contado', 1, '0', '0', 146, 'Metrocentro', '', 'Venta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditos`
--

CREATE TABLE `creditos` (
  `id_credito` int(11) NOT NULL,
  `tipo_credito` varchar(100) DEFAULT NULL,
  `monto` varchar(45) NOT NULL,
  `plazo` varchar(45) DEFAULT NULL,
  `saldo` varchar(45) DEFAULT NULL,
  `forma_pago` varchar(100) NOT NULL,
  `numero_venta` varchar(100) DEFAULT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_adquirido` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `creditos`
--

INSERT INTO `creditos` (`id_credito`, `tipo_credito`, `monto`, `plazo`, `saldo`, `forma_pago`, `numero_venta`, `id_paciente`, `id_usuario`, `fecha_adquirido`) VALUES
(515, 'Credito', '135.25', NULL, '135.25', 'Descuento en Planilla', 'AVME-7', 132, 1, '06-01-2021'),
(516, 'Credito', '135.25', NULL, '135.25', 'Descuento en Planilla', 'AVME-8', 132, 1, '06-01-2021'),
(517, 'Credito', '135.25', NULL, '135.25', 'Descuento en Planilla', 'AVME-9', 132, 1, '06-01-2021'),
(518, 'Credito', '135.25', '3', '135.25', 'Descuento en Planilla', 'AVME-10', 132, 1, '06-01-2021'),
(519, 'Credito', '133.25', '6', '133.25', 'Descuento en Planilla', 'AVME-11', 134, 1, '06-01-2021'),
(520, 'Credito', '325.25', '3', '325.25', 'Descuento en Planilla', 'AVME-12', 129, 1, '06-01-2021'),
(521, 'Credito', '135.25', '3', '135.25', 'Descuento en Planilla', 'AVME-13', 132, 1, '06-01-2021'),
(522, 'Credito', '185.25', '10', '166.72', 'Descuento en Planilla', 'AVME-14', 138, 1, '06-01-2021'),
(523, 'Credito', '185.25', '10', '185.25', 'Descuento en Planilla', 'AVME-15', 138, 1, '06-10-2021'),
(524, 'Credito', '135.25', '3', '135.25', 'Descuento en Planilla', 'AVME-16', 132, 1, '06-10-2021'),
(525, 'Credito', '150.50', '6', '150.50', 'Descuento en Planilla', 'AVME-17', 137, 1, '06-10-2021'),
(526, 'Credito', '325.25', '3', '325.25', 'Descuento en Planilla', 'AVME-18', 129, 1, '06-10-2021'),
(527, 'Credito', '310.25', '6', '310.25', 'Descuento en Planilla', 'AVME-19', 132, 1, '06-10-2021'),
(528, 'Credito', '175.25', '3', '175.25', 'Descuento en Planilla', 'AVME-20', 132, 1, '06-10-2021'),
(529, 'Credito', '175.25', '3', '175.25', 'Descuento en Planilla', 'AVME-21', 134, 1, '08-01-2021'),
(530, 'Contado', '225.25', '3', '0', 'Contado', 'AVME-22', 127, 1, '08-01-2021 15:39:28'),
(531, 'Contado', '75.25', '3', '50.25', 'Contado', 'AVME-23', 128, 1, '09-01-2021 09:21:25'),
(532, 'Contado', '135.25', '', '135.25', 'Efectivo', 'AVME-24', 139, 1, '12-01-2021 13:58:53'),
(533, 'Contado', '75.25', '1', '75.25', 'Contado', 'AVME-25', 139, 1, '12-01-2021 14:22:27'),
(534, 'Contado', '235.25', '0', '235.25', 'Contado', 'AVME-26', 127, 1, '13-01-2021 16:07:05'),
(535, 'Contado', '410.25', '', '410.25', 'Efectivo', 'AVME-27', 140, 1, '13-01-2021 16:28:08'),
(536, 'Contado', '260.00', '', '260.00', 'Efectivo', 'AVME-28', 140, 1, '14-01-2021 14:59:29'),
(537, 'Contado', '335.00', '0', '335.00', 'Contado', 'AVME-29', 139, 1, '14-01-2021 15:18:17'),
(538, 'Contado', '335.00', '0', '335.00', 'Contado', 'AVME-30', 114, 1, '14-01-2021 15:34:13'),
(539, 'Credito', '155.25', '3', '155.25', 'Descuento en Planilla', 'AVME-31', 136, 1, '21-01-2021'),
(540, 'Contado', '260.25', '0', '235.25', 'Contado', 'AVME-32', 104, 1, '24-01-2021 11:53:21'),
(541, 'Contado', '150.00', '0', '150.00', 'Contado', 'AVME-33', 104, 1, '24-01-2021 12:13:21'),
(542, 'Contado', '185.25', '0', '185.25', 'Contado', 'AVME-34', 141, 1, '28-01-2021 13:50:09'),
(543, 'Contado', '225.25', '0', '225.25', 'Contado', 'AVME-35', 141, 1, '28-01-2021 14:17:09'),
(544, 'Contado', '350.00', '1', '350.00', 'Contado', 'AVME-36', 141, 1, '28-01-2021 14:20:56'),
(545, 'Contado', '131.25', '0', '131.25', 'Contado', 'AVME-1', 141, 1, '02-02-2021 12:04:30'),
(546, 'Credito', '225.25', '7', '225.25', 'Descuento en Planilla', 'AVME-2', 139, 1, '02-02-2021'),
(547, 'Contado', '210.00', '3', '185', 'Contado', 'AVME-3', 141, 1, '02-02-2021 13:27:52'),
(548, 'Contado', '210.25', '0', '185.25', 'Contado', 'AVME-4', 133, 1, '02-02-2021 14:33:12'),
(549, 'Contado', '175.25', '0', '175.25', 'Contado', 'AVME-5', 131, 1, '02-02-2021 14:54:26'),
(550, 'Contado', '300.00', '0', '300.00', 'Contado', 'AVME-6', 126, 1, '02-02-2021 15:53:25'),
(551, 'Contado', '185.00', '0', '185.00', 'Contado', 'AVME-7', 115, 1, '03-02-2021 09:57:59'),
(552, 'Contado', '125.25', '0', '125.25', 'Contado', 'AVME-1', 140, 1, '03-02-2021 11:01:42'),
(553, 'Contado', '275.25', '0', '275.25', 'Contado', 'AVME-2', 131, 1, '03-02-2021 11:25:44'),
(554, 'Contado', '270.25', '', '270.25', 'Contado', 'AVME-3', 140, 1, '03-02-2021 11:58:01'),
(555, 'Contado', '212.00', '0', '212.00', 'Contado', 'AVME-4', 136, 1, '03-02-2021 12:34:20'),
(556, 'Contado', '152.25', '1', '152.25', 'Contado', 'AVME-1', 135, 1, '03-02-2021 14:44:45'),
(557, 'Contado', '285.00', '0', '285.00', 'Contado', 'AVME-2', 141, 1, '03-02-2021 15:01:40'),
(558, 'Contado', '287.00', '0', '287.00', 'Contado', 'AVME-3', 141, 1, '03-02-2021 15:07:55'),
(559, 'Contado', '150.00', '0', '150.00', 'Contado', 'AVME-1', 126, 1, '03-02-2021 16:29:21'),
(560, 'Contado', '185.00', '', '185.00', 'Contado', 'AVME-2', 139, 1, '03-02-2021 16:31:32'),
(561, 'Contado', '177.25', '0', '177.25', 'Contado', 'AVME-3', 141, 1, '03-02-2021 16:32:16'),
(562, 'Contado', '127.00', '0', '127.00', 'Contado', 'AVME-4', 114, 1, '03-02-2021 16:57:52'),
(563, 'Contado', '177.25', '0', '177.25', 'Contado', 'AVME-1', 114, 1, '03-02-2021 17:04:16'),
(564, 'Contado', '235.25', '0', '235.25', 'Contado', 'AVME-2', 126, 1, '03-02-2021 17:05:32'),
(565, 'Contado', '237.25', '0', '237.25', 'Contado', 'AVME-3', 139, 1, '03-02-2021 17:06:35'),
(566, 'Contado', '287.25', '0', '287.25', 'Contado', 'AVME-4', 141, 1, '03-02-2021 17:07:41'),
(567, 'Contado', '210.25', '0', '185.25', 'Contado', 'AVME-5', 117, 1, '08-02-2021 16:07:13'),
(568, 'Credito', '260.25', '4', '0', 'Descuento en Planilla', 'AVME-6', 138, 1, '08-02-2021'),
(569, 'Credito', '125.25', '4', '125.25', 'Cargo Automatico', 'AVME-7', 138, 1, '14-02-2021 15:59:56'),
(570, 'Credito', '125.25', '5', '0', 'Cargo Automatico', 'AVME-8', 117, 1, '14-02-2021 16:03:31'),
(571, 'Contado', '100.25', '0', '0', 'Contado', 'AVME-9', 126, 1, '14-02-2021 16:05:55'),
(572, 'Contado', '75.25', '0', '75.25', 'Contado', 'AVME-10', 141, 1, '15-02-2021 12:04:47'),
(573, 'Contado', '75.25', '0', '75.25', 'Contado', 'AVME-11', 126, 1, '15-02-2021 12:13:20'),
(574, 'Contado', '227.25', '0', '227.25', 'Contado', 'AVME-12', 139, 1, '15-02-2021 12:32:58'),
(575, 'Contado', '275.25', '0', '275.25', 'Contado', 'AVME-13', 117, 1, '15-02-2021 12:34:48'),
(576, 'Credito', '175.25', '6', '175.25', 'Cargo Automatico', 'AVME-14', 139, 1, '15-02-2021 12:41:07'),
(577, 'Credito', '225.25', '10', '225.25', 'Descuento en Planilla', 'AVME-15', 141, 1, '15-02-2021'),
(578, 'Contado', '202.25', '0', '202.25', 'Contado', 'AVME-16', 126, 1, '15-02-2021 13:53:28'),
(579, 'Contado', '225.25', '0', '0', 'Contado', 'AVME-17', 114, 1, '15-02-2021 13:58:36'),
(580, 'Contado', '100.00', '0', '50', 'Contado', 'AVME-18', 142, 1, '08-02-2021 13:58:12'),
(581, 'Contado', '151.02', '0', '151.02', 'Contado', 'AVME-19', 142, 1, '09-02-2021 15:02:41'),
(582, 'Contado', '355.35', '', '0', 'Efectivo', 'AVME-20', 144, 1, '11-02-2021 11:06:48'),
(583, 'Contado', '305.67', '0', '305.67', 'Contado', 'AVME-21', 143, 1, '11-02-2021 15:03:14'),
(584, 'Contado', '172.35', '0', '172.35', 'Contado', 'AVME-22', 120, 1, '11-02-2021 15:09:31'),
(585, 'Contado', '202.00', '0', '202.00', 'Contado', 'AVME-23', 120, 1, '12-02-2021 06:18:07'),
(586, 'Contado', '77.00', '0', '77.00', 'Contado', 'AVME-24', 144, 1, '13-02-2021 09:51:55'),
(587, 'Contado', '160.00', '0', '160.00', 'Contado', 'AVME-25', 139, 1, '13-02-2021 14:30:14'),
(588, 'Contado', '173.50', '0', '173.50', 'Contado', 'AVME-26', 145, 1, '13-02-2021 14:59:44'),
(589, 'Contado', '234.48', '0', '234.48', 'Contado', 'AVME-27', 146, 1, '14-02-2021 10:00:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ccf_laboratorios`
--

CREATE TABLE `detalle_ccf_laboratorios` (
  `id_ccf` int(11) NOT NULL,
  `numero_orden` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `laboratorio` varchar(75) COLLATE utf8_spanish_ci NOT NULL,
  `ccf` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `evaluado` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `subtotal` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `iva` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `total_venta` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `sucursal` varchar(75) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `cancelado_por` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_envio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_ccf_laboratorios`
--

INSERT INTO `detalle_ccf_laboratorios` (`id_ccf`, `numero_orden`, `laboratorio`, `ccf`, `evaluado`, `subtotal`, `iva`, `total_venta`, `fecha`, `id_usuario`, `sucursal`, `estado`, `cancelado_por`, `id_envio`) VALUES
(1, 'Ind-1', 'lomed', '25555', 'jaimes', '78', '2', '80', '14-02-2021', 2, 'metrocentro', '1', 'oscar', 50),
(2, '255255', 'lomed', '025255', 'jackeline', '15', '2', '17', '16-02-2021', 2, 'METROCENTRO', '0', 'ARELY', 51),
(3, '256232525', 'LOMED', '125255', 'MAURICIO', '25', '3', '28', '20-02-2021', 1, 'METROCENTRO', '0', 'JACKELINE', 52),
(4, 'ODME-4', 'LOMED', '0222', 'ALCLEISDER JAIMES', '', '', '', '2021-02-22', 1, 'Metrocentro', '0', '*', 53),
(5, 'ODME-4', 'LOMED', '0222', 'ALCLEISDER JAIMES', '', '', '', '2021-02-22', 1, 'Metrocentro', '0', '*', 53),
(6, 'ODME-3', 'LOMED', '0222', 'JOSE RONALD FUENTES', '', '', '', '2021-02-22', 1, 'Metrocentro', '0', '*', 52),
(7, 'ODME-4', 'LOMED', '4442', 'ALCLEISDER JAIMES', '$296.48', '$38.54', '$335.02', '2021-02-21', 1, 'Metrocentro', '0', '*', 53),
(8, 'ODME-4', 'LOMED', '3555', 'ALCLEISDER JAIMES', '196.48', '25.54', '222.02', '2021-02-21', 1, 'Metrocentro', '0', '*', 53),
(9, 'ODME-4', 'LOMED', '3555', 'ALCLEISDER JAIMES', '196.48', '25.54', '222.02', '2021-02-21', 1, 'Metrocentro', '0', '*', 53),
(10, 'ODME-4', 'LOMED', '330', 'ALCLEISDER JAIMES', '$144.48', '$18.78', '$163.26', '2021-02-21', 1, 'Metrocentro', '0', '*', 53),
(11, 'ODME-4', 'LOMED', '2525225', 'ALCLEISDER JAIMES', '144.48', '18.78', '163.26', '2021-02-21', 1, 'Metrocentro', '0', '*', 53),
(12, 'ODME-4', 'LOMED', '255555', 'ALCLEISDER JAIMES', '144.48', '18.78', '163.26', '2021-02-08', 1, 'Metrocentro', '0', '*', 53),
(13, 'ODME-4', 'LOMED', '002', 'ALCLEISDER JAIMES', '194.48', '25.28', '219.76', '2021-02-13', 1, 'Metrocentro', '0', '*', 53),
(14, 'ODME-4', 'LOMED', '0011', 'ALCLEISDER JAIMES', '144.48', '18.78', '163.26', '2021-02-08', 1, 'Metrocentro', '0', '*', 53),
(15, 'ODME-4', 'LOMED', '0012', 'ALCLEISDER JAIMES', '144.48', '18.78', '163.26', '2021-02-08', 1, 'Metrocentro', '0', '*', 53),
(16, 'ODME-4', 'LOMED', '11002', 'ALCLEISDER JAIMES', '144.48', '18.78', '163.26', '2021-02-16', 1, 'Metrocentro', '0', '*', 53),
(17, 'ODME-4', 'LOMED', '2555', 'ALCLEISDER JAIMES', '144.48', '18.78', '163.26', '2021-02-25', 1, 'Metrocentro', '0', '*', 53);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compras`
--

CREATE TABLE `detalle_compras` (
  `id_detalle_compra` int(11) NOT NULL,
  `numero_compra` varchar(25) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `cantidad` varchar(5) DEFAULT NULL,
  `precio_compra` varchar(5) DEFAULT NULL,
  `precio_venta` varchar(5) DEFAULT NULL,
  `subtotal` varchar(5) DEFAULT NULL,
  `estado_producto` varchar(25) DEFAULT NULL,
  `usuario` varchar(25) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `fecha_compra` varchar(25) DEFAULT NULL,
  `cant_ingreso` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_compras`
--

INSERT INTO `detalle_compras` (`id_detalle_compra`, `numero_compra`, `descripcion`, `cantidad`, `precio_compra`, `precio_venta`, `subtotal`, `estado_producto`, `usuario`, `id_producto`, `fecha_compra`, `cant_ingreso`) VALUES
(197, 'C-', 'RAY BAN RB0055 C3 23-44-44', '1', '11', '15', '11', '0', 'oscar', 35, '15-09-2020 15:48:55', '0'),
(198, 'C-30', 'RAY BAN RB0055 C3 23-44-44', '1', '12', '23', '12', '0', 'oscar', 35, '15-09-2020 16:49:13', '0'),
(199, 'C-30', 'RAY -BAN 58169 C2 15-15-154', '1', '15', '23', '15', '0', 'oscar', 37, '15-09-2020 16:49:13', '0'),
(200, 'C-31', 'RAY BAN RB0055 C3 23-44-44', '1', '4', '10', '4', '0', 'oscar', 35, '15-09-2020 17:05:37', '1'),
(201, 'C-32', 'RAY BAN RB0055 C3 23-44-44', '1', '7', '9', '7', '0', 'oscar', 35, '18-09-2020 10:51:18', '0'),
(202, 'C-32', 'RAY -BAN 58169 C2 15-15-154', '1', '11', '15', '11', '0', 'oscar', 37, '18-09-2020 10:51:18', '0'),
(203, 'C-33', 'RAY -BAN 58169 C2 15-15-154', '7', '10', '13', '70', '0', 'oscar', 37, '18-09-2020 13:59:20', '0'),
(204, 'C-33', 'RAY BAN RB0055 C3 23-44-44', '9', '13', '19', '117', '0', 'oscar', 35, '18-09-2020 13:59:20', '1'),
(205, 'C-34', 'RAY BAN RB0055 C3 23-44-44', '1', '9', '10', '9', '0', 'oscar', 35, '19-09-2020 09:35:01', '0'),
(206, 'C-34', 'RAY -BAN 58169 C2 15-15-154', '1', '10', '13', '10', '0', 'oscar', 37, '19-09-2020 09:35:01', '0'),
(207, 'C-34', 'RAY BAN 025533 ESTUCHE RAY BAN COLOR VERDE  ', '1', '10', '13', '10', '0', 'oscar', 46, '19-09-2020 09:35:01', '0'),
(208, 'C-35', 'RAY BAN RB0055 C3 23-44-44', '1', '9', '12', '9', '0', 'oscar', 35, '19-09-2020 10:12:46', '0'),
(209, 'C-35', 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '1', '11', '12', '11', '0', 'oscar', 47, '19-09-2020 10:12:46', '0'),
(210, 'C-36', 'RAY BAN RB0055 C3 23-44-44', '12', '10', '14', '120', '0', 'oscar', 35, '19-09-2020 14:03:19', '0'),
(211, 'C-36', 'RAY BAN RB0055 C3 23-44-44', '10', '11', '12', '110', '0', 'oscar', 35, '19-09-2020 14:03:19', '0'),
(212, 'C-36', 'RAY -BAN 58169 C2 15-15-154', '8', '10', '12', '80', '0', 'oscar', 37, '19-09-2020 14:03:19', '-3'),
(213, 'C-36', 'RAY BAN FRA 1 FRANELA RAYBAN  ', '10', '9', '11', '90', '0', 'oscar', 48, '19-09-2020 14:03:19', '-3'),
(214, 'C-36', 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '8', '9', '12', '72', '0', 'oscar', 47, '19-09-2020 14:03:19', '0'),
(215, 'C-36', 'RAY BAN FRA 1 FRANELA RAYBAN  ', '7', '9', '11', '63', '0', 'oscar', 48, '19-09-2020 14:03:19', '-3'),
(216, 'C-37', 'RAY BAN FRA 1 FRANELA RAYBAN  ', '10', '8', '14', '80', '0', 'oscar', 48, '20-09-2020 14:57:15', '0'),
(217, 'C-37', 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '8', '10', '17', '80', '0', 'oscar', 47, '20-09-2020 14:57:15', '0'),
(218, 'C-38', 'TORY BURCH T455 C7 12-48-555', '15', '10', '12', '150', '0', 'oscar', 57, '22-09-2020 14:25:54', '0'),
(219, 'C-38', 'RAY BAN RB0055 C3 23-44-44', '12', '11', '12', '132', '0', 'oscar', 35, '22-09-2020 14:25:54', '0'),
(220, 'C-38', 'RAY -BAN 58169 C2 15-15-154', '12', '9', '10', '108', '0', 'oscar', 37, '22-09-2020 14:25:54', '0'),
(221, 'C-38', 'RAY BAN FRA 1 FRANELA RAYBAN  ', '14', '6', '9', '84', '0', 'oscar', 48, '22-09-2020 14:25:54', '0'),
(222, 'C-38', 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '11', '9', '13', '99', '0', 'oscar', 47, '22-09-2020 14:25:54', '0'),
(223, 'C-39', 'TORY BURCH T455 C7 12-48-555', '13', '7', '10', '91', '0', 'oscar', 57, '24-09-2020 12:29:24', '0'),
(224, 'C-39', 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '13', '7', '10', '91', '0', 'oscar', 47, '24-09-2020 12:29:24', '0'),
(225, 'C-39', 'RAY BAN RB0055 C3 23-44-44', '12', '8', '10', '96', '0', 'oscar', 35, '24-09-2020 12:29:24', '0'),
(226, 'C-39', 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '12', '8', '10', '96', '0', 'oscar', 47, '24-09-2020 12:29:24', '0'),
(227, 'C-40', 'TORY BURCH T455 C7 12-48-555', '11', '5', '8', '55', '0', 'oscar', 57, '27-09-2020 14:58:57', '0'),
(228, 'C-40', 'RAY -BAN 58169 C2 15-15-154', '10', '6', '9', '60', '0', 'oscar', 37, '27-09-2020 14:58:57', '0'),
(229, 'C-40', 'RAY BAN FRA 1 FRANELA RAYBAN  ', '11', '5', '7', '55', '0', 'oscar', 48, '27-09-2020 14:58:57', '0'),
(230, 'C-41', 'TORY BURCH T455 C7 12-48-555', '9', '3', '9', '27', '0', 'oscar', 57, '27-09-2020 15:56:36', '0'),
(231, 'C-41', 'RAY BAN RB0055 C3 23-44-44', '10', '4', '10', '40', '0', 'oscar', 35, '27-09-2020 15:56:36', '0'),
(232, 'C-', 'TORY BURCH T455 C7 12-48-555', '18', '6', '9', '108', '0', 'oscar', 57, '28-09-2020 09:54:24', '9'),
(233, 'C-', 'RAY BAN RB0055 C3 23-44-44', '14', '4', '12', '56', '0', 'oscar', 35, '28-09-2020 09:54:24', '0'),
(234, 'C-', 'RAY -BAN 58169 C2 15-15-154', '14', '4', '10', '56', '0', 'oscar', 37, '28-09-2020 09:54:24', '7'),
(235, 'C-', 'RAY BAN FRA 1 FRANELA RAYBAN  ', '14', '4', '9', '56', '0', 'oscar', 48, '28-09-2020 09:54:24', '7'),
(236, 'C-', 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '12', '4', '10', '48', '0', 'oscar', 47, '28-09-2020 09:54:24', '6'),
(237, 'C-43', 'TORY BURCH T455 C7 12-48-555', '1', '10', '12', '10', '0', 'oscar', 57, '02-10-2020 13:41:50', '1'),
(238, 'C-44', 'TORY BURCH T455 C7 12-48-555', '1', '10', '20', '10', '0', 'oscar', 57, '02-10-2020 15:59:58', '1'),
(239, 'C-45', 'TORY BURCH T455 C7 12-48-555', '1', '2', '4', '2', '0', 'oscar', 57, '03-10-2020 12:02:26', '0'),
(240, 'C-46', 'TORY BURCH T455 C7 12-48-555', '1', '10', '30', '10', '0', 'oscar', 57, '03-10-2020 12:23:43', '0'),
(241, 'C-46', 'RAY BAN RB0055 C3 23-44-44', '1', '10', '20', '10', '0', 'oscar', 35, '03-10-2020 12:23:43', '0'),
(242, 'C-46', 'RAY -BAN 58169 C2 15-15-154', '1', '10', '15', '10', '0', 'oscar', 37, '03-10-2020 12:23:43', '0'),
(243, 'C-46', 'RAY BAN FRA 1 FRANELA RAYBAN  ', '1', '10', '20', '10', '0', 'oscar', 48, '03-10-2020 12:23:43', '0'),
(244, 'C-46', 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '1', '10', '30', '10', '0', 'oscar', 47, '03-10-2020 12:23:43', '0'),
(245, 'C-47', 'TORY BURCH T455 C7 12-48-555', '25', '10', '25', '250', '0', 'oscar', 57, '03-10-2020 15:09:56', '0'),
(246, 'C-47', 'RAY BAN RB0055 C3 23-44-44', '22', '20', '35', '440', '0', 'oscar', 35, '03-10-2020 15:09:56', '0'),
(247, 'C-47', 'RAY -BAN 58169 C2 15-15-154', '17', '30', '50', '510', '0', 'oscar', 37, '03-10-2020 15:09:56', '0'),
(248, 'C-47', 'RAY BAN FRA 1 FRANELA RAYBAN  ', '17', '10', '15', '170', '0', 'oscar', 48, '03-10-2020 15:09:56', '0'),
(249, 'C-47', 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '16', '5', '17', '80', '0', 'oscar', 47, '03-10-2020 15:09:56', '0'),
(250, 'C-48', 'TORY BURCH T455 C7 12-48-555', '21', '10', '30', '210', '0', 'oscar', 57, '04-10-2020 15:14:07', '0'),
(251, 'C-48', 'RAY BAN RB0055 C3 23-44-44', '22', '10', '35', '220', '0', 'oscar', 35, '04-10-2020 15:14:07', '0'),
(252, 'C-48', 'RAY -BAN 58169 C2 15-15-154', '26', '10', '30', '260', '0', 'oscar', 37, '04-10-2020 15:14:07', '0'),
(253, 'C-48', 'RAY BAN FRA 1 FRANELA RAYBAN  ', '23', '25', '45', '575', '0', 'oscar', 48, '04-10-2020 15:14:07', '0'),
(254, 'C-48', 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '19', '78', '100', '1482', '0', 'oscar', 47, '04-10-2020 15:14:07', '0'),
(255, 'C-49', 'RAY BAN 00 DD  ', '11', '1', '5', '11', '0', 'oscar', 63, '05-10-2020 14:15:36', '0'),
(256, 'C-50', 'TORY BURCH T455 C7 12-48-555', '13', '25', '100', '325', '0', 'oscar', 57, '06-11-2020 13:57:19', '9'),
(257, 'C-50', 'RAY BAN 00 MD,JSAK  ', '9', '3', '10', '27', '0', 'oscar', 64, '06-11-2020 13:57:19', '6'),
(258, 'C-50', 'RAY -BAN 58169 C2 15-15-154', '9', '25', '110', '225', '0', 'oscar', 37, '06-11-2020 13:57:19', '6'),
(259, 'C-50', 'RAY BAN RB0055 C3 23-44-44', '18', '30', '120', '540', '0', 'oscar', 35, '06-11-2020 13:57:19', '14'),
(260, 'C-50', 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '7', '3', '40', '21', '0', 'oscar', 47, '06-11-2020 13:57:19', '0'),
(261, 'C-51', 'TORY BURCH T455 C7 12-48-555', '12', '10', '50', '120', '0', 'oscar', 57, '10-11-2020 10:19:56', '4'),
(262, 'C-51', 'RAY BAN 00 RR  ', '11', '5', '20', '55', '0', 'oscar', 62, '10-11-2020 10:19:56', '3'),
(263, 'C-51', 'RAY -BAN 58169 C2 15-15-154', '12', '12', '40', '144', '0', 'oscar', 37, '10-11-2020 10:19:56', '4'),
(264, 'C-52', 'TORY BURCH T455 C7 12-48-555', '11', '10', '20', '110', '0', 'oscar', 57, '16-11-2020 15:44:17', '0'),
(265, 'C-52', 'RAY BAN 00 RR  ', '18', '10', '20', '180', '0', 'oscar', 62, '16-11-2020 15:44:17', '0'),
(266, 'C-53', '  BACILOSCOPIA  ', '1', '1', '1.769', '1', '0', 'oscar', 65, '17-11-2020 11:51:27', '0'),
(267, 'C-54', '  BACILOSCOPIA  ', '154', '1', '1.769', '154', '0', 'oscar', 65, '17-11-2020 11:58:09', '0'),
(268, 'C-54', '  EXAMENES GENERALES  ', '184', '1', '4.424', '184', '0', 'oscar', 66, '17-11-2020 11:58:09', '0'),
(269, 'C-54', '  CULTIVO FARINGEO  ', '75', '1', '4.424', '75', '0', 'oscar', 67, '17-11-2020 11:58:09', '0'),
(270, 'C-54', '  CREATININA  ', '187', '1', '2.212', '187', '0', 'oscar', 68, '17-11-2020 11:58:09', '0'),
(271, 'C-54', '  PRUEBAS DE FUNCIONAMIENTO  ', '158', '1', '4.424', '158', '0', 'oscar', 69, '17-11-2020 11:58:09', '0'),
(272, 'C-54', '  VDRL  ', '187', '1', '1.327', '187', '0', 'oscar', 70, '17-11-2020 11:58:09', '0'),
(273, 'C-54', '  GLUCOSA,COLESTEROL, TRIGLICERIDOS, ACIDO URICO  ', '49', '1', '7.964', '49', '0', 'oscar', 71, '17-11-2020 11:58:09', '0'),
(274, 'C-55', '  BACILOSCOPIA  ', '500', '1', '1.769', '500', '0', 'oscar', 65, '17-11-2020 15:12:15', '0'),
(275, 'C-55', '  EXAMENES GENERALES  ', '500', '1', '4.424', '500', '0', 'oscar', 66, '17-11-2020 15:12:15', '0'),
(276, 'C-55', '  CULTIVO FARINGEO  ', '500', '1', '4.424', '500', '0', 'oscar', 67, '17-11-2020 15:12:15', '0'),
(277, 'C-55', '  CREATININA  ', '500', '1', '2.212', '500', '0', 'oscar', 68, '17-11-2020 15:12:15', '0'),
(278, 'C-55', '  PRUEBAS DE FUNCIONAMIENTO  ', '500', '1', '4.424', '500', '0', 'oscar', 69, '17-11-2020 15:12:15', '0'),
(279, 'C-55', '  VDRL  ', '500', '1', '1.327', '500', '0', 'oscar', 70, '17-11-2020 15:12:15', '0'),
(280, 'C-55', '  GLUCOSA,COLESTEROL, TRIGLICERIDOS, ACIDO URICO  ', '500', '1', '7.964', '500', '0', 'oscar', 71, '17-11-2020 15:12:15', '0'),
(281, 'C-56', '  EXAMENES GENERALES  ', '34', '1', '1.77', '34', '0', 'oscar', 66, '17-11-2020 16:37:06', '0'),
(282, 'C-57', 'RAY BAN  PRUEBA DE FUNCIONAMIENTO HEPATICO  ', '1', '1', '4.42', '1', '0', 'oscar', 73, '17-11-2020 16:44:38', '0'),
(283, 'C-57', 'RAY BAN 0 CREATININA  ', '1', '1', '2.21', '1', '0', 'oscar', 72, '17-11-2020 16:44:38', '0'),
(284, 'C-58', '  VDRL  ', '1', '1', '1.33', '1', '0', 'oscar', 70, '17-11-2020 16:49:45', '1'),
(285, 'C-59', '  VDRL  ', '23', '1', '1.33', '23', '0', 'oscar', 70, '17-11-2020 16:51:34', '0'),
(286, 'C-60', 'TORY BURCH T455 C7 12-48-555', '27', '10', '50', '270', '0', 'oscar', 57, '18-11-2020 10:40:46', '0'),
(287, 'C-60', 'RAY BAN RB0055 C3 23-44-44', '15', '20', '70', '300', '0', 'oscar', 35, '18-11-2020 10:40:46', '0'),
(288, 'C-60', 'RAY BAN 00 DD  ', '13', '1', '5', '13', '0', 'oscar', 63, '18-11-2020 10:40:46', '0'),
(289, 'C-61', ' 0 CREATININA  ', '1', '1', '2.212', '1', '0', 'oscar', 72, '18-11-2020 14:21:32', '0'),
(290, 'C-62', 'TORY BURCH T455 C7 12-48-555', '29', '20', '90', '580', '0', 'oscar', 57, '21-11-2020 16:45:26', '0'),
(291, 'C-62', 'RAY BAN RB0055 C3 23-44-44', '27', '25', '120', '675', '0', 'oscar', 35, '21-11-2020 16:45:26', '0'),
(292, 'C-62', 'RAY -BAN 58169 C2 15-15-154', '27', '30', '150', '810', '0', 'oscar', 37, '21-11-2020 16:45:26', '0'),
(293, 'C-63', 'TORY BURCH T455 C7 12-48-555', '1', '10', '100', '10', '0', 'oscar', 57, '24-11-2020 12:13:33', '0'),
(294, 'C-63', 'RAY BAN RB0055 C3 23-44-44', '1', '20', '120', '20', '0', 'oscar', 35, '24-11-2020 12:13:33', '0'),
(295, 'C-63', 'RAY -BAN 58169 C2 15-15-154', '1', '30', '150', '30', '0', 'oscar', 37, '24-11-2020 12:13:33', '0'),
(296, 'C-64', 'TORY BURCH T455 C7 12-48-555', '27', '20', '80', '540', '0', 'oscar', 57, '24-11-2020 13:52:42', '0'),
(297, 'C-64', 'RAY BAN RB0055 C3 23-44-44', '34', '20', '90', '680', '0', 'oscar', 35, '24-11-2020 13:52:42', '0'),
(298, 'C-64', 'RAY -BAN 58169 C2 15-15-154', '40', '20', '110', '800', '0', 'oscar', 37, '24-11-2020 13:52:42', '0'),
(299, 'C-64', 'RAY BAN 355 ESTUCHE LACOSTE  ', '16', '5', '10', '80', '0', 'oscar', 58, '24-11-2020 13:52:42', '0'),
(300, 'C-64', 'RAY BAN FRA 1 FRANELA RAYBAN  ', '16', '5', '20', '80', '0', 'oscar', 48, '24-11-2020 13:52:42', '0'),
(301, 'C-65', 'PENGUIN THE QUIN 15616145 53-20-143', '5', '18', '86', '90', '0', 'oscar', 75, '24-11-2020 16:22:51', '0'),
(302, 'C-65', 'ANDVAS WILL 001 C2 00-00-000', '5', '12', '50', '60', '0', 'oscar', 74, '24-11-2020 16:22:51', '0'),
(303, 'C-66', 'TORY BURCH T455 C7 12-48-555', '2', '12', '58', '24', '0', 'oscar', 57, '28-11-2020 15:47:36', '0'),
(304, 'C-66', 'RAY -BAN 58169 C2 15-15-154', '4', '21', '78', '84', '0', 'oscar', 37, '28-11-2020 15:47:36', '1'),
(305, 'C-66', 'RAY BAN FRA 1 FRANELA RAYBAN  ', '3', '1', '5', '3', '0', 'oscar', 48, '28-11-2020 15:47:36', '0'),
(306, 'C-67', 'RAY -BAN 58169 C2 15-15-154', '1', '10', '40', '10', '0', 'oscar', 37, '28-11-2020 17:35:33', '1'),
(307, 'C-68', 'TORY BURCH T455 C7 12-48-555', '8', '5', '10', '40', '0', 'oscar', 57, '10-12-2020 12:43:19', '7'),
(308, 'C-68', 'RAY BAN 355 ESTUCHE LACOSTE  ', '10', '6', '12', '60', '0', 'oscar', 59, '10-12-2020 12:43:19', '9'),
(309, 'C-69', 'TORY BURCH T455 C7 12-48-555', '3', '10', '100', '30', '0', 'oscar', 57, '10-12-2020 12:50:33', '2'),
(310, 'C-69', 'RAY BAN 355 ESTUCHE LACOSTE  ', '4', '5', '10', '20', '0', 'oscar', 59, '10-12-2020 12:50:33', '3'),
(311, 'C-69', 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '4', '5', '12', '20', '0', 'oscar', 47, '10-12-2020 12:50:33', '3'),
(312, 'C-70', 'ANDVAS  CINTAS PARA LENTES  ', '13', '1', '3', '13', '0', 'oscar', 76, '17-12-2020 11:42:48', '0'),
(313, 'C-71', 'RAY BAN RB0055 C3 23-44-44', '15', '20', '50', '300', '0', 'oscar', 35, '30-12-2020 10:38:58', '6'),
(314, 'C-71', 'PENGUIN THE QUIN 15616145 53-20-143', '13', '25', '75', '325', '0', 'oscar', 75, '30-12-2020 10:38:58', '5'),
(315, 'C-72', 'PENGUIN THE QUIN 15616145 53-20-143', '13', '10', '50', '130', '0', 'oscar', 75, '14-01-2021 14:56:20', '0'),
(316, 'C-73', 'PENGUIN THE QUIN 15616145 53-20-143', '18', '20', '80', '360', '0', 'oscar', 75, '20-01-2021 11:09:31', '17'),
(317, 'C-73', 'RAY BAN RB0055 C3 23-44-44', '24', '30', '100', '720', '0', 'oscar', 35, '20-01-2021 11:09:31', '23'),
(318, 'C-74', 'TORY BURCH T455 C7 12-48-555', '9', '10', '100', '90', '0', 'oscar', 57, '08-02-2021 14:19:05', '8'),
(319, 'C-74', 'RAY BAN 00 RR  ', '10', '25', '120', '250', '0', 'oscar', 62, '08-02-2021 14:19:05', '9'),
(320, 'C-74', 'MARCA PAJARRACO NEW MODEL PA C45 12-55-577', '9', '14', '140', '126', '0', 'oscar', 84, '08-02-2021 14:19:05', '8'),
(321, 'C-74', 'RAY -BAN 58169 C2 15-15-154', '7', '20', '200', '140', '0', 'oscar', 37, '08-02-2021 14:19:05', '6'),
(322, 'C-75', 'PENGUIN THE QUIN 15616145 53-20-143', '10', '10', '80', '100', '0', 'oscar', 75, '12-02-2021 06:16:02', '9'),
(323, 'C-75', 'MARCA PAJARRACO NEW MODEL PA C45 12-55-577', '9', '20', '90', '180', '0', 'oscar', 84, '12-02-2021 06:16:02', '8'),
(324, 'C-75', 'TORY BURCH T455 C7 12-48-555', '10', '30', '100', '300', '0', 'oscar', 57, '12-02-2021 06:16:02', '9'),
(325, 'C-75', 'RAY BAN A2113-RAYMOD C2 53-20-149', '11', '40', '110', '440', '0', 'oscar', 77, '12-02-2021 06:16:02', '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ingresos`
--

CREATE TABLE `detalle_ingresos` (
  `id_detalle_ingreso` int(11) NOT NULL,
  `producto` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `sucursal` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `destino` varchar(75) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `n_compra` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `precio_venta` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `numero_ingreso` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_ingresos`
--

INSERT INTO `detalle_ingresos` (`id_detalle_ingreso`, `producto`, `cantidad`, `sucursal`, `destino`, `usuario`, `fecha`, `n_compra`, `precio_venta`, `numero_ingreso`) VALUES
(90, 'RAYBAN RB5050 C1 15-55-552', '1', 'Metrocentro', 'EXHIBICION 8', 'oscar', '08-09-2020 17:23:35', 'C-27', '180', 'I-39'),
(91, 'RAYBAN RB5050 C1 15-55-552', '1', 'Metrocentro', 'GAVETA 4', 'oscar', '08-09-2020 17:24:02', 'C-27', '180', 'I-40'),
(92, 'RAYBAN RB5050 C1 15-55-552', '1', 'Metrocentro', 'GAVETA 7', 'oscar', '08-09-2020 17:24:34', 'C-27', '180', 'I-41'),
(93, 'RAYBAN RB5050 C1 15-55-552', '1', 'Metrocentro', 'GAVETA 7', 'oscar', '08-09-2020 17:24:34', 'C-27', '180', 'I-41'),
(94, 'CANDIES CA0127 083 49-18-135', '1', 'Metrocentro', 'GAVETA 7', 'oscar', '08-09-2020 17:24:34', 'C-27', '100', 'I-41'),
(95, 'TORY BURCH TOR01 C3 14-55-522', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '13-09-2020 13:16:22', 'C-28', '8', 'I-42'),
(96, 'RAY BAN RB0055 C3 23-44-44', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '15-09-2020 15:49:50', 'C-', '15', 'I-43'),
(97, 'RAY -BAN 58169 C2 15-15-154', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '15-09-2020 16:52:17', 'C-30', '23', 'I-44'),
(98, 'RAY BAN RB0055 C3 23-44-44', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '15-09-2020 16:52:17', 'C-30', '23', 'I-44'),
(99, 'RAY -BAN 58169 C2 15-15-154', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '18-09-2020 10:52:53', 'C-32', '15', 'I-45'),
(100, 'RAY BAN RB0055 C3 23-44-44', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '18-09-2020 10:52:53', 'C-32', '9', 'I-45'),
(101, 'RAY -BAN 58169 C2 15-15-154', '2', 'Metrocentro', 'GAVETA1 ', 'avplus', '18-09-2020 14:00:09', 'C-33', '13', 'I-46'),
(102, 'RAY BAN RB0055 C3 23-44-44', '3', 'Metrocentro', 'GAVETA1 ', 'avplus', '18-09-2020 14:00:09', 'C-33', '19', 'I-46'),
(103, 'RAY BAN 025533 ESTUCHE RAY BAN COLOR VERDE  ', '1', 'Metrocentro', 'GAVETA 4', 'oscar', '19-09-2020 09:44:09', 'C-34', '13', 'I-47'),
(104, 'RAY -BAN 58169 C2 15-15-154', '1', 'Metrocentro', 'GAVETA 4', 'oscar', '19-09-2020 09:44:09', 'C-34', '13', 'I-47'),
(105, 'RAY BAN RB0055 C3 23-44-44', '1', 'Metrocentro', 'GAVETA 4', 'oscar', '19-09-2020 09:44:09', 'C-34', '10', 'I-47'),
(106, 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '1', 'Metrocentro', 'GAVETA 2', 'oscar', '19-09-2020 10:36:25', 'C-35', '12', 'I-48'),
(107, 'RAY BAN RB0055 C3 23-44-44', '1', 'Metrocentro', 'GAVETA 2', 'oscar', '19-09-2020 10:36:25', 'C-35', '12', 'I-48'),
(108, 'RAY BAN FRA 1 FRANELA RAYBAN  ', '5', 'Metrocentro', 'GAVETA 2', 'oscar', '19-09-2020 14:05:36', 'C-36', '11', 'I-49'),
(109, 'RAY BAN FRA 1 FRANELA RAYBAN  ', '5', 'Metrocentro', 'GAVETA 2', 'oscar', '19-09-2020 14:05:36', 'C-36', '11', 'I-49'),
(110, 'RAY -BAN 58169 C2 15-15-154', '5', 'Metrocentro', 'GAVETA 2', 'oscar', '19-09-2020 14:05:36', 'C-36', '12', 'I-49'),
(111, 'RAY BAN RB0055 C3 23-44-44', '5', 'Metrocentro', 'GAVETA 2', 'oscar', '19-09-2020 14:05:36', 'C-36', '12', 'I-49'),
(112, 'RAY BAN RB0055 C3 23-44-44', '5', 'Metrocentro', 'GAVETA 2', 'oscar', '19-09-2020 14:05:36', 'C-36', '12', 'I-49'),
(113, 'RAY -BAN 58169 C2 15-15-154', '3', 'Metrocentro', 'GAVETA 2', 'oscar', '19-09-2020 16:24:00', 'C-36', '12', 'I-50'),
(114, 'RAY -BAN 58169 C2 15-15-154', '3', 'Metrocentro', 'GAVETA 2', 'oscar', '19-09-2020 16:24:00', 'C-36', '12', 'I-50'),
(115, 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '8', 'Metrocentro', 'GAVETA 2', 'oscar', '19-09-2020 16:24:00', 'C-36', '12', 'I-50'),
(116, 'RAY -BAN 58169 C2 15-15-154', '5', 'Metrocentro', 'GAVETA 2', 'oscar', '20-09-2020 14:56:46', 'C-33', '13', 'I-51'),
(117, 'RAY BAN RB0055 C3 23-44-44', '5', 'Metrocentro', 'GAVETA 2', 'oscar', '20-09-2020 14:56:46', 'C-33', '19', 'I-51'),
(118, 'RAY BAN FRA 1 FRANELA RAYBAN  ', '5', 'Metrocentro', 'GAVETA 2', 'oscar', '20-09-2020 14:59:49', 'C-37', '14', 'I-52'),
(119, 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '5', 'Metrocentro', 'GAVETA 2', 'oscar', '20-09-2020 14:59:49', 'C-37', '17', 'I-52'),
(120, 'TORY BURCH T455 C7 12-48-555', '15', 'Metrocentro', 'GAVETA 2', 'oscar', '22-09-2020 14:46:21', 'C-38', '12', 'I-53'),
(121, 'RAY BAN FRA 1 FRANELA RAYBAN  ', '14', 'Metrocentro', 'GAVETA 2', 'oscar', '22-09-2020 14:46:21', 'C-38', '9', 'I-53'),
(122, 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '11', 'Metrocentro', 'GAVETA 2', 'oscar', '22-09-2020 14:46:21', 'C-38', '13', 'I-53'),
(123, 'RAY -BAN 58169 C2 15-15-154', '12', 'Metrocentro', 'GAVETA 2', 'oscar', '22-09-2020 14:46:21', 'C-38', '10', 'I-53'),
(124, 'RAY BAN RB0055 C3 23-44-44', '12', 'Metrocentro', 'GAVETA 2', 'oscar', '22-09-2020 14:46:21', 'C-38', '12', 'I-53'),
(125, 'RAY BAN FRA 1 FRANELA RAYBAN  ', '5', 'Metrocentro', 'GAVETA1 ', 'oscar', '24-09-2020 07:54:43', 'C-37', '14', 'I-54'),
(126, 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '3', 'Metrocentro', 'GAVETA1 ', 'oscar', '24-09-2020 07:54:43', 'C-37', '17', 'I-54'),
(127, 'TORY BURCH T455 C7 12-48-555', '13', 'Metrocentro', 'GAVETA1 ', 'oscar', '24-09-2020 12:31:06', 'C-39', '10', 'I-55'),
(128, 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '12', 'Metrocentro', 'GAVETA1 ', 'oscar', '24-09-2020 12:31:06', 'C-39', '10', 'I-55'),
(129, 'RAY BAN RB0055 C3 23-44-44', '12', 'Metrocentro', 'GAVETA1 ', 'oscar', '24-09-2020 12:31:06', 'C-39', '10', 'I-55'),
(130, 'TORY BURCH T455 C7 12-48-555', '11', 'Metrocentro', 'GAVETA1 ', 'oscar', '27-09-2020 15:00:49', 'C-40', '8', 'I-56'),
(131, 'RAY BAN FRA 1 FRANELA RAYBAN  ', '11', 'Metrocentro', 'GAVETA1 ', 'oscar', '27-09-2020 15:00:49', 'C-40', '7', 'I-56'),
(132, 'RAY -BAN 58169 C2 15-15-154', '10', 'Metrocentro', 'GAVETA1 ', 'oscar', '27-09-2020 15:00:49', 'C-40', '9', 'I-56'),
(133, 'TORY BURCH T455 C7 12-48-555', '8', 'Metrocentro', 'GAVETA1 ', 'oscar', '27-09-2020 15:57:23', 'C-41', '9', 'I-57'),
(134, 'RAY BAN RB0055 C3 23-44-44', '8', 'Metrocentro', 'GAVETA1 ', 'oscar', '27-09-2020 15:57:23', 'C-41', '10', 'I-57'),
(135, 'TORY BURCH T455 C7 12-48-555', '1', 'San Miguel', 'GAVETA1 ', 'oscar', '27-09-2020 16:00:04', 'C-41', '9', 'I-58'),
(136, 'RAY BAN RB0055 C3 23-44-44', '2', 'San Miguel', 'GAVETA1 ', 'oscar', '27-09-2020 16:00:04', 'C-41', '10', 'I-58'),
(137, 'TORY BURCH T455 C7 12-48-555', '9', 'San Miguel', 'EXHIBICION 8', 'oscar', '28-09-2020 09:56:45', 'C-', '9', 'I-'),
(138, 'RAY BAN FRA 1 FRANELA RAYBAN  ', '7', 'San Miguel', 'EXHIBICION 8', 'oscar', '28-09-2020 09:56:45', 'C-', '9', 'I-'),
(139, 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '6', 'San Miguel', 'EXHIBICION 8', 'oscar', '28-09-2020 09:56:45', 'C-', '10', 'I-'),
(140, 'RAY -BAN 58169 C2 15-15-154', '7', 'San Miguel', 'EXHIBICION 8', 'oscar', '28-09-2020 09:56:45', 'C-', '10', 'I-'),
(141, 'RAY BAN RB0055 C3 23-44-44', '7', 'San Miguel', 'EXHIBICION 8', 'oscar', '28-09-2020 09:56:45', 'C-', '12', 'I-'),
(142, 'RAY BAN RB0055 C3 23-44-44', '7', 'San Miguel', 'EXHIBICION 8', 'oscar', '28-09-2020 09:56:45', 'C-', '12', 'I-'),
(143, 'TORY BURCH T455 C7 12-48-555', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '03-10-2020 12:24:56', 'C-46', '30', 'I-60'),
(144, 'RAY BAN FRA 1 FRANELA RAYBAN  ', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '03-10-2020 12:24:56', 'C-46', '20', 'I-60'),
(145, 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '03-10-2020 12:24:56', 'C-46', '30', 'I-60'),
(146, 'RAY -BAN 58169 C2 15-15-154', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '03-10-2020 12:24:56', 'C-46', '15', 'I-60'),
(147, 'RAY BAN RB0055 C3 23-44-44', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '03-10-2020 12:24:56', 'C-46', '20', 'I-60'),
(148, 'TORY BURCH T455 C7 12-48-555', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '03-10-2020 15:05:23', 'C-45', '4', 'I-61'),
(149, 'TORY BURCH T455 C7 12-48-555', '25', 'Metrocentro', 'GAVETA1 ', 'oscar', '03-10-2020 15:11:22', 'C-47', '25', 'I-62'),
(150, 'RAY BAN FRA 1 FRANELA RAYBAN  ', '17', 'Metrocentro', 'GAVETA1 ', 'oscar', '03-10-2020 15:11:22', 'C-47', '15', 'I-62'),
(151, 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '16', 'Metrocentro', 'GAVETA1 ', 'oscar', '03-10-2020 15:11:22', 'C-47', '17', 'I-62'),
(152, 'RAY -BAN 58169 C2 15-15-154', '17', 'Metrocentro', 'GAVETA1 ', 'oscar', '03-10-2020 15:11:22', 'C-47', '50', 'I-62'),
(153, 'RAY BAN RB0055 C3 23-44-44', '22', 'Metrocentro', 'GAVETA1 ', 'oscar', '03-10-2020 15:11:22', 'C-47', '35', 'I-62'),
(154, 'TORY BURCH T455 C7 12-48-555', '21', 'San Miguel', 'EXHIBICION 8', 'oscar', '04-10-2020 15:15:35', 'C-48', '30', 'I-63'),
(155, 'RAY BAN FRA 1 FRANELA RAYBAN  ', '23', 'San Miguel', 'EXHIBICION 8', 'oscar', '04-10-2020 15:15:35', 'C-48', '45', 'I-63'),
(156, 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '19', 'San Miguel', 'EXHIBICION 8', 'oscar', '04-10-2020 15:15:35', 'C-48', '100', 'I-63'),
(157, 'RAY -BAN 58169 C2 15-15-154', '26', 'San Miguel', 'EXHIBICION 8', 'oscar', '04-10-2020 15:15:35', 'C-48', '30', 'I-63'),
(158, 'RAY BAN RB0055 C3 23-44-44', '22', 'San Miguel', 'EXHIBICION 8', 'oscar', '04-10-2020 15:15:35', 'C-48', '35', 'I-63'),
(159, 'RAY BAN 00 DD  ', '11', 'Metrocentro', 'GAVETA1 ', 'oscar', '05-10-2020 14:16:39', 'C-49', '5', 'I-64'),
(160, 'RAY BAN 00 MD,JSAK  ', '3', 'Metrocentro', 'GAVETA#10', 'oscar', '06-11-2020 14:02:01', 'C-50', '10', 'I-65'),
(161, 'TORY BURCH T455 C7 12-48-555', '4', 'Metrocentro', 'GAVETA#10', 'oscar', '06-11-2020 14:02:01', 'C-50', '100', 'I-65'),
(162, 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '7', 'Metrocentro', 'GAVETA#10', 'oscar', '06-11-2020 14:02:01', 'C-50', '40', 'I-65'),
(163, 'RAY -BAN 58169 C2 15-15-154', '3', 'Metrocentro', 'GAVETA#10', 'oscar', '06-11-2020 14:02:01', 'C-50', '110', 'I-65'),
(164, 'RAY BAN RB0055 C3 23-44-44', '4', 'Metrocentro', 'GAVETA#10', 'oscar', '06-11-2020 14:02:01', 'C-50', '120', 'I-65'),
(165, 'RAY BAN 00 RR  ', '8', 'Metrocentro', 'GAVETA1 ', 'oscar', '10-11-2020 10:22:36', 'C-51', '20', 'I-66'),
(166, 'TORY BURCH T455 C7 12-48-555', '8', 'Metrocentro', 'GAVETA1 ', 'oscar', '10-11-2020 10:22:36', 'C-51', '50', 'I-66'),
(167, 'RAY -BAN 58169 C2 15-15-154', '8', 'Metrocentro', 'GAVETA1 ', 'oscar', '10-11-2020 10:22:36', 'C-51', '40', 'I-66'),
(168, 'RAY BAN 00 RR  ', '18', 'Metrocentro', 'GAVETA 2', 'oscar', '16-11-2020 15:45:18', 'C-52', '20', 'I-67'),
(169, 'TORY BURCH T455 C7 12-48-555', '11', 'Metrocentro', 'GAVETA 2', 'oscar', '16-11-2020 15:45:18', 'C-52', '20', 'I-67'),
(170, '  BACILOSCOPIA  ', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 11:53:05', 'C-53', '1.769', 'I-68'),
(171, '  BACILOSCOPIA  ', '15', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 12:16:33', 'C-54', '1.769', 'I-69'),
(172, '  EXAMENES GENERALES  ', '18', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 12:16:33', 'C-54', '4.424', 'I-69'),
(173, '  CULTIVO FARINGEO  ', '75', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 12:16:33', 'C-54', '4.424', 'I-69'),
(174, '  CREATININA  ', '18', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 12:16:33', 'C-54', '2.212', 'I-69'),
(175, '  PRUEBAS DE FUNCIONAMIENTO  ', '15', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 12:16:33', 'C-54', '4.424', 'I-69'),
(176, '  VDRL  ', '18', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 12:16:33', 'C-54', '1.327', 'I-69'),
(177, '  GLUCOSA,COLESTEROL, TRIGLICERIDOS, ACIDO URICO  ', '49', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 12:16:33', 'C-54', '7.964', 'I-69'),
(178, '  BACILOSCOPIA  ', '50', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 15:17:14', 'C-55', '1.769', 'I-70'),
(179, '  EXAMENES GENERALES  ', '50', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 15:17:14', 'C-55', '4.424', 'I-70'),
(180, '  CULTIVO FARINGEO  ', '50', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 15:17:14', 'C-55', '4.424', 'I-70'),
(181, '  CREATININA  ', '50', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 15:17:14', 'C-55', '2.212', 'I-70'),
(182, '  PRUEBAS DE FUNCIONAMIENTO  ', '50', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 15:17:14', 'C-55', '4.424', 'I-70'),
(183, '  VDRL  ', '50', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 15:17:14', 'C-55', '1.327', 'I-70'),
(184, '  GLUCOSA,COLESTEROL, TRIGLICERIDOS, ACIDO URICO  ', '50', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 15:17:14', 'C-55', '7.964', 'I-70'),
(185, '  EXAMENES GENERALES  ', '34', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 16:39:58', 'C-56', '1.77', 'I-71'),
(186, 'RAY BAN  PRUEBA DE FUNCIONAMIENTO HEPATICO  ', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 16:46:26', 'C-57', '4.42', 'I-72'),
(187, 'RAY BAN 0 CREATININA  ', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '17-11-2020 16:46:26', 'C-57', '2.21', 'I-72'),
(188, '  VDRL  ', '23', 'Metrocentro', 'GAVETA 2', 'oscar', '17-11-2020 16:52:52', 'C-59', '1.33', 'I-73'),
(189, 'RAY BAN 00 DD  ', '13', 'Metrocentro', 'GAVETA#10', 'oscar', '18-11-2020 10:42:45', 'C-60', '5', 'I-74'),
(190, 'TORY BURCH T455 C7 12-48-555', '27', 'Metrocentro', 'GAVETA#10', 'oscar', '18-11-2020 10:42:45', 'C-60', '50', 'I-74'),
(191, 'RAY BAN RB0055 C3 23-44-44', '15', 'Metrocentro', 'GAVETA#10', 'oscar', '18-11-2020 10:42:45', 'C-60', '70', 'I-74'),
(192, ' 0 CREATININA  ', '1', 'Metrocentro', 'GAVETA 2', 'oscar', '18-11-2020 14:23:56', 'C-61', '2.212', 'I-75'),
(193, 'TORY BURCH T455 C7 12-48-555', '29', 'Metrocentro', 'GAVETA1 ', 'oscar', '21-11-2020 16:46:54', 'C-62', '90', 'I-76'),
(194, 'RAY -BAN 58169 C2 15-15-154', '27', 'Metrocentro', 'GAVETA1 ', 'oscar', '21-11-2020 16:46:54', 'C-62', '150', 'I-76'),
(195, 'RAY BAN RB0055 C3 23-44-44', '27', 'Metrocentro', 'GAVETA1 ', 'oscar', '21-11-2020 16:46:54', 'C-62', '120', 'I-76'),
(196, 'TORY BURCH T455 C7 12-48-555', '1', 'San Miguel', 'EXHIBICION 8', 'oscar', '24-11-2020 12:15:54', 'C-63', '100', 'I-77'),
(197, 'RAY -BAN 58169 C2 15-15-154', '1', 'San Miguel', 'EXHIBICION 8', 'oscar', '24-11-2020 12:15:54', 'C-63', '150', 'I-77'),
(198, 'RAY BAN RB0055 C3 23-44-44', '1', 'San Miguel', 'EXHIBICION 8', 'oscar', '24-11-2020 12:15:54', 'C-63', '120', 'I-77'),
(199, 'RAY BAN 355 ESTUCHE LACOSTE  ', '16', 'San Miguel', 'EXHIBICION 8', 'jacky', '24-11-2020 13:54:32', 'C-64', '10', 'I-78'),
(200, 'TORY BURCH T455 C7 12-48-555', '27', 'San Miguel', 'EXHIBICION 8', 'jacky', '24-11-2020 13:54:32', 'C-64', '80', 'I-78'),
(201, 'RAY BAN FRA 1 FRANELA RAYBAN  ', '16', 'San Miguel', 'EXHIBICION 8', 'jacky', '24-11-2020 13:54:32', 'C-64', '20', 'I-78'),
(202, 'RAY -BAN 58169 C2 15-15-154', '40', 'San Miguel', 'EXHIBICION 8', 'jacky', '24-11-2020 13:54:32', 'C-64', '110', 'I-78'),
(203, 'RAY BAN RB0055 C3 23-44-44', '34', 'San Miguel', 'EXHIBICION 8', 'jacky', '24-11-2020 13:54:32', 'C-64', '90', 'I-78'),
(204, 'PENGUIN THE QUIN 15616145 53-20-143', '5', 'San Miguel', 'EXHIBICION 8', 'oscar', '24-11-2020 16:26:38', 'C-65', '86', 'I-79'),
(205, 'ANDVAS WILL 001 C2 00-00-000', '5', 'San Miguel', 'EXHIBICION 8', 'oscar', '24-11-2020 16:26:38', 'C-65', '50', 'I-79'),
(206, 'TORY BURCH T455 C7 12-48-555', '1', 'San Miguel', 'EXHIBICION 8', 'oscar', '28-11-2020 15:51:35', 'C-66', '12', 'I-80'),
(207, 'RAY BAN FRA 1 FRANELA RAYBAN  ', '1', 'San Miguel', 'EXHIBICION 8', 'oscar', '28-11-2020 15:51:35', 'C-66', '1', 'I-80'),
(208, 'RAY -BAN 58169 C2 15-15-154', '1', 'San Miguel', 'EXHIBICION 8', 'oscar', '28-11-2020 15:51:35', 'C-66', '21', 'I-80'),
(209, 'TORY BURCH T455 C7 12-48-555', '1', 'San Miguel', 'EXHIBICION 8', 'oscar', '28-11-2020 15:58:30', 'C-66', '12', 'I-81'),
(210, 'RAY BAN FRA 1 FRANELA RAYBAN  ', '1', 'San Miguel', 'EXHIBICION 8', 'oscar', '28-11-2020 15:58:30', 'C-66', '1', 'I-81'),
(211, 'RAY -BAN 58169 C2 15-15-154', '1', 'San Miguel', 'EXHIBICION 8', 'oscar', '28-11-2020 15:58:30', 'C-66', '21', 'I-81'),
(212, 'RAY BAN FRA 1 FRANELA RAYBAN  ', '1', 'San Miguel', 'EXHIBICION 8', 'oscar', '28-11-2020 16:03:10', 'C-66', '5', 'I-82'),
(213, 'RAY -BAN 58169 C2 15-15-154', '1', 'San Miguel', 'EXHIBICION 8', 'oscar', '28-11-2020 16:03:10', 'C-66', '78', 'I-82'),
(214, 'RAY BAN 355 ESTUCHE LACOSTE  ', '1', 'Metrocentro', 'GAVETA #20', 'oscar', '10-12-2020 12:45:23', 'C-68', '12', 'I-83'),
(215, 'TORY BURCH T455 C7 12-48-555', '1', 'Metrocentro', 'GAVETA #20', 'oscar', '10-12-2020 12:45:23', 'C-68', '10', 'I-83'),
(216, 'RAY BAN 355 ESTUCHE LACOSTE  ', '1', 'Metrocentro', 'GAVETA #20', 'oscar', '10-12-2020 12:53:15', 'C-69', '10', 'I-84'),
(217, 'TORY BURCH T455 C7 12-48-555', '1', 'Metrocentro', 'GAVETA #20', 'oscar', '10-12-2020 12:53:15', 'C-69', '100', 'I-84'),
(218, 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '1', 'Metrocentro', 'GAVETA #20', 'oscar', '10-12-2020 12:53:15', 'C-69', '12', 'I-84'),
(219, 'ANDVAS  CINTAS PARA LENTES  ', '13', 'Metrocentro', 'GAVETA 2', 'oscar', '17-12-2020 11:43:39', 'C-70', '3', 'I-85'),
(220, 'PENGUIN THE QUIN 15616145 53-20-143', '8', 'Metrocentro', 'GAVETA1 ', 'oscar', '30-12-2020 10:40:36', 'C-71', '75', 'I-86'),
(221, 'RAY BAN RB0055 C3 23-44-44', '9', 'Metrocentro', 'GAVETA1 ', 'oscar', '30-12-2020 10:40:36', 'C-71', '50', 'I-86'),
(222, 'PENGUIN THE QUIN 15616145 53-20-143', '13', 'Metrocentro', 'GAVETA1 ', 'oscar', '14-01-2021 14:58:29', 'C-72', '50', 'I-87'),
(223, 'PENGUIN THE QUIN 15616145 53-20-143', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '20-01-2021 11:25:26', 'C-73', '80', 'I-88'),
(224, 'RAY BAN RB0055 C3 23-44-44', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '20-01-2021 11:25:26', 'C-73', '100', 'I-88'),
(225, 'MARCA PAJARRACO NEW MODEL PA C45 12-55-577', '1', 'Metrocentro', 'GAVETA 2', 'oscar', '08-02-2021 14:26:15', 'C-74', '140', 'I-89'),
(226, 'RAY BAN 00 RR  ', '1', 'Metrocentro', 'GAVETA 2', 'oscar', '08-02-2021 14:26:15', 'C-74', '120', 'I-89'),
(227, 'TORY BURCH T455 C7 12-48-555', '1', 'Metrocentro', 'GAVETA 2', 'oscar', '08-02-2021 14:26:15', 'C-74', '100', 'I-89'),
(228, 'RAY -BAN 58169 C2 15-15-154', '1', 'Metrocentro', 'GAVETA 2', 'oscar', '08-02-2021 14:26:15', 'C-74', '200', 'I-89'),
(229, 'MARCA PAJARRACO NEW MODEL PA C45 12-55-577', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '12-02-2021 06:17:40', 'C-75', '90', 'I-90'),
(230, 'RAY BAN A2113-RAYMOD C2 53-20-149', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '12-02-2021 06:17:40', 'C-75', '110', 'I-90'),
(231, 'PENGUIN THE QUIN 15616145 53-20-143', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '12-02-2021 06:17:40', 'C-75', '80', 'I-90'),
(232, 'TORY BURCH T455 C7 12-48-555', '1', 'Metrocentro', 'GAVETA1 ', 'oscar', '12-02-2021 06:17:40', 'C-75', '100', 'I-90');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_requisicion`
--

CREATE TABLE `detalle_requisicion` (
  `id_detalle_req` int(11) NOT NULL,
  `numero_requicision` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cantidad` varchar(4) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio` varchar(8) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sucursal` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `comprobante` varchar(6) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_requisicion`
--

INSERT INTO `detalle_requisicion` (`id_detalle_req`, `numero_requicision`, `descripcion`, `cantidad`, `precio`, `usuario`, `sucursal`, `estado`, `comprobante`) VALUES
(83, 'RQME-1', 'paquete de bolsas plasticas', '1', '3', 'oscar', 'Metrocentro', 'Si', '5555'),
(84, 'RQME-1', 'paquete de platos', '1', '2', 'oscar', 'Metrocentro', 'Si', '5555'),
(85, 'RQME-2', 'CAJA TERMICA', '1', '0', 'oscar', 'Metrocentro', 'No', '0000'),
(86, 'RQME-3', 'RESMA DE PAPEL HIGIENICO', '2', '1.5', 'oscar', 'Metrocentro', 'Si', '0000'),
(87, 'RQME-4', 'SELLOS DE CANCELADO', '2', '3', 'oscar', 'Metrocentro', 'Si', '5555'),
(88, 'RQME-4', 'BOLSA DE DETERGENTE', '1', '0', 'oscar', 'Metrocentro', 'No', ''),
(89, 'RQME-4', 'RESMA DE PAPEL BOND', '1', '3.5', 'oscar', 'Metrocentro', 'Si', '5255'),
(90, 'RQME-5', 'TECLADO INALAMBRICO', '1', '3', 'oscar', 'Metrocentro', 'Si', '2225'),
(91, 'RQME-5', 'MOUSE OPTICO', '1', '3', 'oscar', 'Metrocentro', 'Si', '2222'),
(92, 'RQME-6', 'agenda', '1', '1.75', 'oscar', 'Metrocentro', 'Si', ''),
(93, 'RQME-6', 'CAJA DE LAPICEROS BIC', '1', '2', 'oscar', 'Metrocentro', 'Si', ''),
(94, 'RQME-7', 'sobres manila ', '5', '2.15', 'oscar', 'Metrocentro', 'Si', '5855'),
(95, 'RQME-8', 'mesas plsaticas', '1', '4', 'oscar', 'Metrocentro', 'Si', '2355'),
(96, 'RQME-8', 'silla plastica', '1', '3', 'oscar', 'Metrocentro', 'Si', '5555'),
(97, 'RQME-9', 'sellos de cancelado', '2', '2', 'oscar', 'Metrocentro', 'Si', '0222'),
(98, 'RQME-9', 'guantes para baño', '2', '2', 'oscar', 'Metrocentro', 'Si', '2457'),
(99, 'RQME-10', 'lapiceros bic', '3', '1.25', 'oscar', 'Metrocentro', 'Si', '2555'),
(100, 'RQME-10', 'borrador', '1', '1.69', 'oscar', 'Metrocentro', 'Si', '5885'),
(101, 'RQME-11', 'paquete de servilletas', '1', '2', 'oscar', 'Metrocentro', 'Si', ''),
(102, 'RQME-11', 'rollo papel toalla', '2', '1', 'oscar', 'Metrocentro', 'Si', ''),
(103, 'RQME-12', 'paquete de papel higienico', '2', '0', 'oscar', 'Metrocentro', 'No', '0000'),
(104, 'RQME-13', 'bolosa vasos desechables', '1', '1.33', 'oscar', 'Metrocentro', 'Si', '0000'),
(105, 'RQME-14', 'rollo de papel higienico', '1', '1.65', 'oscar', 'Metrocentro', 'Si', '2222');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_traslados`
--

CREATE TABLE `detalle_traslados` (
  `id_detalle_traslados` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `cantidad` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `origen` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `destino` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `num_traslado` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_traslados`
--

INSERT INTO `detalle_traslados` (`id_detalle_traslados`, `id_producto`, `id_usuario`, `cantidad`, `origen`, `destino`, `num_traslado`, `fecha`) VALUES
(14, 37, 1, '1', 'GAVETA#10', 'MU#3', 'TME-3', '07-11-2020 08:28:38'),
(15, 47, 1, '1', 'GAVETA#10', 'GAVETA1 ', 'TME-4', '07-11-2020 08:29:12'),
(16, 35, 1, '1', 'GAVETA#10', 'GAVETA 2', 'TME-4', '07-11-2020 08:29:12'),
(17, 47, 1, '1', 'MU#3', 'GAVETA1 ', 'TME-5', '07-11-2020 08:30:26'),
(18, 57, 1, '1', 'MU#3', 'GAVETA 2', 'TME-5', '07-11-2020 08:30:26'),
(19, 47, 1, '1', 'GAVETA 2', 'GAVETA#10', 'TME-5', '07-11-2020 08:30:26'),
(20, 57, 1, '1', 'GAVETA 2', 'MU#3', 'TME-5', '07-11-2020 08:30:26'),
(21, 35, 1, '1', 'GAVETA#10', 'MALETA#1', 'TME-5', '07-11-2020 08:30:26'),
(22, 57, 1, '1', 'GAVETA1 ', 'GAVETA 2', 'TME-6', '07-11-2020 08:42:48'),
(23, 57, 1, '1', 'MU#3', 'GAVETA 2', 'TME-6', '07-11-2020 08:42:48'),
(24, 35, 1, '1', 'GAVETA1 ', 'GAVETA 2', 'TME-7', '22-11-2020 13:24:59'),
(25, 62, 1, '1', 'GAVETA 2', 'MALETA#1', 'TME-8', '10-12-2020 09:24:56'),
(26, 62, 1, '1', 'GAVETA 2', 'MALETA#1', 'TME-9', '10-12-2020 10:11:35'),
(27, 63, 1, '1', 'GAVETA#10', 'MU#3', 'TME-10', '10-12-2020 10:15:31'),
(28, 63, 1, '1', 'GAVETA#10', 'MU#3', 'TME-11', '10-12-2020 10:22:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id_detalle_ventas` int(11) NOT NULL,
  `numero_venta` varchar(100) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `precio_venta` varchar(100) NOT NULL,
  `cantidad_venta` varchar(100) NOT NULL,
  `descuento` varchar(100) NOT NULL,
  `precio_final` varchar(100) DEFAULT NULL,
  `fecha_venta` varchar(25) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `beneficiario` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id_detalle_ventas`, `numero_venta`, `id_producto`, `producto`, `precio_venta`, `cantidad_venta`, `descuento`, `precio_final`, `fecha_venta`, `id_usuario`, `id_paciente`, `beneficiario`) VALUES
(1110, 'AVME-23', 57, 'ARO: TORY BURCH MOD.: T455 COLOR: C7 MED.12-48-555 Completo', '100.00', '1', '0', '100', '12-02-2021 06:18:07', 1, 120, 'NASIF HANDAL'),
(1111, 'AVME-23', 55, 'TRATAMIENTOS: TRANSITIONS GEN 8 CAFE', '50', '1', '0', '50', '12-02-2021 06:18:07', 1, 120, 'NASIF HANDAL'),
(1112, 'AVME-23', 83, 'TRATAMIENTOS: PHTOSENSIBLE #5', '52', '1', '0', '52', '12-02-2021 06:18:07', 1, 120, 'NASIF HANDAL'),
(1113, 'AVME-24', 82, 'LENTE: LENTE #5', '25', '1', '0', '25', '13-02-2021 09:51:55', 1, 144, 'OSCAR DE FLORES'),
(1114, 'AVME-24', 83, 'TRATAMIENTOS: PHTOSENSIBLE #5', '52', '1', '0', '52', '13-02-2021 09:51:55', 1, 144, 'OSCAR DE FLORES'),
(1115, 'AVME-25', 77, 'ARO: RAY BAN MOD.: A2113-RAYMOD COLOR: C2 MED.53-20-149 Completo', '110.00', '1', '0', '110', '13-02-2021 14:30:14', 1, 139, 'CARLA LOPEZ'),
(1116, 'AVME-25', 78, 'LENTE: LENTE VS PROMO', '50', '1', '0', '50', '13-02-2021 14:30:14', 1, 139, 'CARLA LOPEZ'),
(1117, 'AVME-26', 75, 'ARO: PENGUIN MOD.: THE QUIN COLOR: 15616145 MED.53-20-143 Completo', '80.00', '1', '0', '80', '13-02-2021 14:59:44', 1, 145, 'JOSE RONALD FUENTES'),
(1118, 'AVME-26', 86, 'LENTE: VISION AIRWERE BLUE', '20.35', '1', '0', '20.35', '13-02-2021 14:59:44', 1, 145, 'JOSE RONALD FUENTES'),
(1119, 'AVME-26', 88, 'TRATAMIENTOS: ANTIRREFLEJANTE # 7', '42.48', '1', '0', '42.48', '13-02-2021 14:59:44', 1, 145, 'JOSE RONALD FUENTES'),
(1120, 'AVME-26', 87, 'TRATAMIENTOS: OVATIONS DS BLUE ', '30.67', '1', '0', '30.67', '13-02-2021 14:59:44', 1, 145, 'JOSE RONALD FUENTES'),
(1121, 'AVME-27', 84, 'ARO: MARCA PAJARRACO MOD.: NEW MODEL PA COLOR: C45 MED.12-55-577 Completo', '90.00', '1', '0', '90', '14-02-2021 10:00:46', 1, 146, 'ALCLEISDER JAIMES'),
(1122, 'AVME-27', 78, 'LENTE: LENTE VS PROMO', '50', '1', '0', '50', '14-02-2021 10:00:46', 1, 146, 'ALCLEISDER JAIMES'),
(1123, 'AVME-27', 88, 'TRATAMIENTOS: ANTIRREFLEJANTE # 7', '42.48', '1', '0', '42.48', '14-02-2021 10:00:46', 1, 146, 'ALCLEISDER JAIMES'),
(1124, 'AVME-27', 83, 'TRATAMIENTOS: PHTOSENSIBLE #5', '52', '1', '0', '52', '14-02-2021 10:00:46', 1, 146, 'ALCLEISDER JAIMES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas_flotantes`
--

CREATE TABLE `detalle_ventas_flotantes` (
  `id_detalle_venta_flotante` int(11) NOT NULL,
  `numero_orden` varchar(25) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `precio_venta` varchar(100) NOT NULL,
  `cantidad_venta` varchar(100) NOT NULL,
  `descuento` varchar(100) NOT NULL,
  `precio_final` varchar(100) DEFAULT NULL,
  `fecha_venta` varchar(25) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `beneficiario` varchar(200) DEFAULT NULL,
  `categoria_ub` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_ventas_flotantes`
--

INSERT INTO `detalle_ventas_flotantes` (`id_detalle_venta_flotante`, `numero_orden`, `id_producto`, `producto`, `precio_venta`, `cantidad_venta`, `descuento`, `precio_final`, `fecha_venta`, `id_usuario`, `id_paciente`, `beneficiario`, `categoria_ub`) VALUES
(112, 'OME-1', 37, 'RAY -BAN mod.58169 15-15-154 C2', '75.25', '1', '0', '75.25', '02-02-2021 12:41:19', 1, 139, 'LUCIANA MICHELLE RAMIREZ ', 'GAVETA1 '),
(113, 'OME-1', 78, 'LENTE VS PROMO', '50', '1', '0', '50', '02-02-2021 12:41:19', 1, 139, 'LUCIANA MICHELLE RAMIREZ ', ''),
(114, 'OME-1', 55, 'TRANSITIONS GEN 8 CAFE', '50', '1', '0', '50', '02-02-2021 12:41:19', 1, 139, 'LUCIANA MICHELLE RAMIREZ ', ''),
(115, 'OME-1', 54, 'AR SUPERHIDROFOBICO ADD PROMO', '50', '1', '0', '50', '02-02-2021 12:41:19', 1, 139, 'LUCIANA MICHELLE RAMIREZ ', ''),
(116, 'OME-2', 35, 'RAY BAN mod.RB0055 23-44-44 C3', '75.25', '1', '0', '75.25', '08-02-2021 16:09:28', 1, 138, 'SANDRA GONZALEZ', 'GAVETA1 '),
(117, 'OME-2', 80, 'LENTE VISION SENCILLA BLU CAP', '50', '1', '0', '50', '08-02-2021 16:09:28', 1, 138, 'SANDRA GONZALEZ', ''),
(118, 'OME-2', 55, 'TRANSITIONS GEN 8 CAFE', '50', '1', '0', '50', '08-02-2021 16:09:28', 1, 138, 'SANDRA GONZALEZ', ''),
(119, 'OME-2', 51, 'ANTIRREFLEJANTE 1', '85', '1', '0', '85', '08-02-2021 16:09:28', 1, 138, 'SANDRA GONZALEZ', ''),
(120, 'OME-3', 35, 'RAY BAN mod.RB0055 23-44-44 C3', '75.25', '1', '0', '75.25', '15-02-2021 12:49:44', 1, 141, 'CARMEN ARELY VASQUEZ MARTINEZ', 'GAVETA1 '),
(121, 'OME-3', 80, 'LENTE VISION SENCILLA BLU CAP', '50', '1', '0', '50', '15-02-2021 12:49:44', 1, 141, 'CARMEN ARELY VASQUEZ MARTINEZ', ''),
(122, 'OME-3', 54, 'AR SUPERHIDROFOBICO ADD PROMO', '50', '1', '0', '50', '15-02-2021 12:49:44', 1, 141, 'CARMEN ARELY VASQUEZ MARTINEZ', ''),
(123, 'OME-3', 55, 'TRANSITIONS GEN 8 CAFE', '50', '1', '0', '50', '15-02-2021 12:49:44', 1, 141, 'CARMEN ARELY VASQUEZ MARTINEZ', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `ubicacion` varchar(150) DEFAULT NULL,
  `nit` varchar(30) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `responsable` varchar(75) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `encargado_optica` varchar(50) DEFAULT NULL,
  `registro` varchar(50) DEFAULT NULL,
  `giro` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id_empresa`, `nombre`, `ubicacion`, `nit`, `telefono`, `responsable`, `correo`, `encargado_optica`, `registro`, `giro`) VALUES
(6, 'CELPAC, S.A. DE C.V.', 'BLVD. DEL EJERCITO NACIONAL KM. 7 1/2. ILOPANGO SAN SALVADOR', '0617-171072-001-5', '', '', '', '', '576-2', 'PRIMARIA: FABRICACIÓN DE PAPEL, ENVASES DE PAPEL Y CARBÓN'),
(8, 'SMURFIT KAPPA EL SALVADOR SOCIEDAD ANONIMA', 'BLVD. DEL EJERCITO NACIONAL KM. 7 1/2, SOYAPANGO, SAN SALVADOR', '0614-270862-001-2', '', '', '', '', '483-9', 'PRIMARIA: FABRICACIÓN DE PAPEL Y CARTÓN ONDULADO Y ENVASES DE PAPEL Y CARTÓN'),
(9, 'CAJAS PLEGADIZAS S.A DE C.V', 'BLVD. DEL EJERCITO NACIONAL KM. 7 1/2, SOYAPANGO, SAN SALVADOR', '0614-280800-102-1', '', '', '', '', '125136-8', 'FABRICACIÓN DE PAPEL Y CARTÓN ONDULADO Y ENVASES DE PAPEL Y CARTÓN'),
(10, 'ECOFIBRAS S.A DE C.V', 'C. ANTIGUA AL MATAZANO AL COSTADO SUR DE LA COL. SANTA LUCIA EDIF. 1 ILOPANGO SAN SALVADOR', '0614-240907-104-0', '', '', '', '', '182157-2', 'FABRICACION DE PRODUCTOS DIVERSOS DE PAPEL Y CARTÓN'),
(11, 'CRUZ ROJA', 'SAN SALVADOR', '', '', '', '', '', '', ''),
(12, 'DISZASA', 'SAN SALVADOR', '', '', '', '', '', '', ''),
(13, 'MEDIDENT', 'SAN SALVADOR', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios_lab`
--

CREATE TABLE `envios_lab` (
  `id_envio` int(11) NOT NULL,
  `numero_orden` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `laboratorio` varchar(75) COLLATE utf8_spanish_ci NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `evaluado` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `id_consulta` int(11) NOT NULL,
  `lente` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `tratamientos` varchar(225) COLLATE utf8_spanish_ci NOT NULL,
  `modelo_aro` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `color_aro` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `marca_aro` varchar(75) COLLATE utf8_spanish_ci NOT NULL,
  `diseno` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `med_a` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `med_b` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `med_c` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `med_d` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `observaciones` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `sucursal` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `prioridad` varchar(2) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `envios_lab`
--

INSERT INTO `envios_lab` (`id_envio`, `numero_orden`, `laboratorio`, `id_paciente`, `evaluado`, `id_consulta`, `lente`, `tratamientos`, `modelo_aro`, `color_aro`, `marca_aro`, `diseno`, `id_usuario`, `med_a`, `med_b`, `med_c`, `med_d`, `fecha_creacion`, `estado`, `observaciones`, `sucursal`, `prioridad`) VALUES
(50, 'ODME-1', 'Lomed', 120, 'NASIF HANDAL', 507, 'VISIÓN SENCILLA BLANCO POLY', ' TRANSITIONS GEN 8 CAFE, PHTOSENSIBLE #5', 'T455', 'C7', 'TORY BURCH', 'Completo', 1, '', '', '', '', '12-02-2021 06:18:44', '4', '', 'Metrocentro', '5'),
(51, 'ODME-2', 'Lomed', 144, 'OSCAR DE FLORES', 506, 'LENTE #5', ' PHTOSENSIBLE #5', '', '', '', '', 1, '', '', '', '', '13-02-2021 09:52:31', '3', '', 'Metrocentro', '5'),
(52, 'ODME-3', 'Lomed', 145, 'JOSE RONALD FUENTES', 508, 'VISION AIRWERE BLUE', ' OVATIONS DS BLUE , ANTIRREFLEJANTE # 7', 'THE QUIN', '15616145', 'PENGUIN', 'Completo', 1, '', '', '', '', '13-02-2021 15:00:33', '4', '', 'Metrocentro', '5'),
(53, 'ODME-4', 'Lomed', 146, 'ALCLEISDER JAIMES', 509, 'LENTE VS PROMO', ' ANTIRREFLEJANTE # 7, PHTOSENSIBLE #5', 'NEW MODEL PA', 'C45', 'MARCA PAJARRACO', 'Completo', 1, '', '', '', '', '14-02-2021 10:01:34', '4', '', 'Metrocentro', '5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `existencias`
--

CREATE TABLE `existencias` (
  `id_ingreso` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `stock` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `bodega` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoria_ub` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_ingreso` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `num_compra` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `precio_venta` varchar(11) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `existencias`
--

INSERT INTO `existencias` (`id_ingreso`, `id_producto`, `stock`, `bodega`, `categoria_ub`, `fecha_ingreso`, `usuario`, `num_compra`, `precio_venta`) VALUES
(156, 64, '0', 'Metrocentro', 'GAVETA#10', '06-11-2020 14:02:01', 'oscar', 'C-50', '75.25'),
(157, 57, '0', 'Metrocentro', 'GAVETA#10', '06-11-2020 14:02:01', 'oscar', 'C-50', '75.25'),
(158, 47, '0', 'Metrocentro', 'GAVETA#10', '06-11-2020 14:02:01', 'oscar', 'C-50', '75.25'),
(159, 37, '0', 'Metrocentro', 'GAVETA#10', '06-11-2020 14:02:01', 'oscar', 'C-50', '75.25'),
(160, 35, '0', 'Metrocentro', 'GAVETA#10', '06-11-2020 14:02:01', 'oscar', 'C-50', '75.25'),
(161, 47, '0', 'Metrocentro', 'MALETA#1', '06-11-2020 15:09:40', '1', 'C-50', '75.25'),
(162, 47, '0', 'Metrocentro', 'MU#3', '06-11-2020 15:18:16', '1', 'C-50', '75.25'),
(163, 57, '0', 'Metrocentro', 'MU#3', '06-11-2020 15:50:01', '1', 'C-50', '75.25'),
(164, 57, '-1', 'Metrocentro', 'MU#3', '06-11-2020 17:24:33', '1', 'C-50', '75.25'),
(165, 47, '0', 'Metrocentro', 'GAVETA 2', '06-11-2020 17:25:49', '1', 'C-50', '75.25'),
(166, 57, '0', 'Metrocentro', 'GAVETA1 ', '07-11-2020 08:18:44', '1', 'C-50', '75.25'),
(167, 57, '0', 'Metrocentro', 'GAVETA#10', '07-11-2020 08:18:44', '1', 'C-50', '75.25'),
(168, 57, '0', 'Metrocentro', 'GAVETA 2', '07-11-2020 08:18:44', '1', 'C-50', '75.25'),
(169, 37, '0', 'Metrocentro', 'MU#3', '07-11-2020 08:28:38', '1', 'C-50', '75.25'),
(170, 47, '0', 'Metrocentro', 'GAVETA1 ', '07-11-2020 08:29:12', '1', 'C-50', '75.25'),
(171, 35, '0', 'Metrocentro', 'GAVETA 2', '07-11-2020 08:29:12', '1', 'C-50', '75.25'),
(172, 47, '0', 'Metrocentro', 'GAVETA1 ', '07-11-2020 08:30:26', '1', 'C-50', '75.25'),
(173, 57, '0', 'Metrocentro', 'GAVETA 2', '07-11-2020 08:30:26', '1', 'C-50', '75.25'),
(174, 47, '0', 'Metrocentro', 'GAVETA#10', '07-11-2020 08:30:26', '1', 'C-50', '75.25'),
(175, 57, '0', 'Metrocentro', 'MU#3', '07-11-2020 08:30:26', '1', 'C-50', '75.25'),
(176, 35, '0', 'Metrocentro', 'MALETA#1', '07-11-2020 08:30:26', '1', 'C-50', '75.25'),
(177, 57, '0', 'Metrocentro', 'GAVETA 2', '07-11-2020 08:42:48', '1', 'C-50', '75.25'),
(178, 57, '0', 'Metrocentro', 'GAVETA 2', '07-11-2020 08:42:48', '1', 'C-50', '75.25'),
(179, 62, '0', 'Metrocentro', 'GAVETA1 ', '10-11-2020 10:22:36', 'oscar', 'C-51', '75.25'),
(180, 57, '0', 'Metrocentro', 'GAVETA1 ', '10-11-2020 10:22:36', 'oscar', 'C-51', '75.25'),
(181, 37, '0', 'Metrocentro', 'GAVETA1 ', '10-11-2020 10:22:36', 'oscar', 'C-51', '75.25'),
(182, 62, '7', 'Metrocentro', 'GAVETA 2', '16-11-2020 15:45:18', 'oscar', 'C-52', '75.25'),
(183, 57, '0', 'Metrocentro', 'GAVETA 2', '16-11-2020 15:45:18', 'oscar', 'C-52', '75.25'),
(184, 65, '0', 'Metrocentro', 'GAVETA1 ', '17-11-2020 11:53:05', 'oscar', 'C-53', '75.25'),
(185, 65, '0', 'Metrocentro', 'GAVETA1 ', '17-11-2020 12:16:33', 'oscar', 'C-54', '75.25'),
(186, 66, '0', 'Metrocentro', 'GAVETA1 ', '17-11-2020 12:16:33', 'oscar', 'C-54', '75.25'),
(187, 67, '0', 'Metrocentro', 'GAVETA1 ', '17-11-2020 12:16:33', 'oscar', 'C-54', '75.25'),
(188, 68, '0', 'Metrocentro', 'GAVETA1 ', '17-11-2020 12:16:33', 'oscar', 'C-54', '75.25'),
(189, 69, '0', 'Metrocentro', 'GAVETA1 ', '17-11-2020 12:16:33', 'oscar', 'C-54', '75.25'),
(190, 70, '0', 'Metrocentro', 'GAVETA1 ', '17-11-2020 12:16:33', 'oscar', 'C-54', '75.25'),
(191, 71, '0', 'Metrocentro', 'GAVETA1 ', '17-11-2020 12:16:33', 'oscar', 'C-54', '75.25'),
(192, 65, '-37', 'Metrocentro', 'GAVETA1 ', '17-11-2020 15:17:14', 'oscar', 'C-55', '75.25'),
(193, 66, '-115', 'Metrocentro', 'GAVETA1 ', '17-11-2020 15:17:14', 'oscar', 'C-55', '75.25'),
(194, 67, '172', 'Metrocentro', 'GAVETA1 ', '17-11-2020 15:17:14', 'oscar', 'C-55', '75.25'),
(195, 68, '-10', 'Metrocentro', 'GAVETA1 ', '17-11-2020 15:17:14', 'oscar', 'C-55', '75.25'),
(196, 69, '-23', 'Metrocentro', 'GAVETA1 ', '17-11-2020 15:17:14', 'oscar', 'C-55', '75.25'),
(197, 70, '-28', 'Metrocentro', 'GAVETA1 ', '17-11-2020 15:17:14', 'oscar', 'C-55', '75.25'),
(198, 71, '367', 'Metrocentro', 'GAVETA1 ', '17-11-2020 15:17:14', 'oscar', 'C-55', '75.25'),
(199, 66, '31', 'Metrocentro', 'GAVETA1 ', '17-11-2020 16:39:58', 'oscar', 'C-56', '75.25'),
(200, 73, '-13', 'Metrocentro', 'GAVETA1 ', '17-11-2020 16:46:26', 'oscar', 'C-57', '75.25'),
(201, 72, '-13', 'Metrocentro', 'GAVETA1 ', '17-11-2020 16:46:26', 'oscar', 'C-57', '75.25'),
(202, 70, '-152', 'Metrocentro', 'GAVETA 2', '17-11-2020 16:52:52', 'oscar', 'C-59', '75.25'),
(203, 63, '6', 'Metrocentro', 'GAVETA#10', '18-11-2020 10:42:45', 'oscar', 'C-60', '75.25'),
(204, 57, '0', 'Metrocentro', 'GAVETA#10', '18-11-2020 10:42:45', 'oscar', 'C-60', '75.25'),
(205, 35, '0', 'Metrocentro', 'GAVETA#10', '18-11-2020 10:42:45', 'oscar', 'C-60', '75.25'),
(206, 72, '-160', 'Metrocentro', 'GAVETA 2', '18-11-2020 14:23:56', 'oscar', 'C-61', '75.25'),
(207, 57, '0', 'Metrocentro', 'GAVETA1 ', '21-11-2020 16:46:54', 'oscar', 'C-62', '75.25'),
(208, 37, '0', 'Metrocentro', 'GAVETA1 ', '21-11-2020 16:46:54', 'oscar', 'C-62', '75.25'),
(209, 35, '0', 'Metrocentro', 'GAVETA1 ', '21-11-2020 16:46:54', 'oscar', 'C-62', '75.25'),
(210, 35, '0', 'Metrocentro', 'GAVETA 2', '22-11-2020 13:24:59', '1', 'C-62', '75.25'),
(211, 57, '0', 'San Miguel', 'EXHIBICION 8', '24-11-2020 12:15:54', 'oscar', 'C-63', '75.25'),
(212, 37, '0', 'San Miguel', 'EXHIBICION 8', '24-11-2020 12:15:54', 'oscar', 'C-63', '75.25'),
(213, 35, '0', 'San Miguel', 'EXHIBICION 8', '24-11-2020 12:15:54', 'oscar', 'C-63', '75.25'),
(214, 58, '16', 'San Miguel', 'EXHIBICION 8', '24-11-2020 13:54:32', 'jacky', 'C-64', '75.25'),
(215, 57, '25', 'San Miguel', 'EXHIBICION 8', '24-11-2020 13:54:32', 'jacky', 'C-64', '75.25'),
(216, 48, '14', 'San Miguel', 'EXHIBICION 8', '24-11-2020 13:54:32', 'jacky', 'C-64', '75.25'),
(217, 37, '37', 'San Miguel', 'EXHIBICION 8', '24-11-2020 13:54:32', 'jacky', 'C-64', '75.25'),
(218, 35, '34', 'San Miguel', 'EXHIBICION 8', '24-11-2020 13:54:32', 'jacky', 'C-64', '75.25'),
(219, 75, '4', 'San Miguel', 'EXHIBICION 8', '24-11-2020 16:26:38', 'oscar', 'C-65', '75.25'),
(220, 74, '5', 'San Miguel', 'EXHIBICION 8', '24-11-2020 16:26:38', 'oscar', 'C-65', '75.25'),
(221, 48, '1', 'San Miguel', 'EXHIBICION 8', '28-11-2020 16:03:10', 'oscar', 'C-66', '75.25'),
(222, 37, '0', 'San Miguel', 'EXHIBICION 8', '28-11-2020 16:03:10', 'oscar', 'C-66', '75.25'),
(223, 63, '1', 'Metrocentro', 'MU#3', '10-12-2020 10:22:08', '1', 'C-60', '75.25'),
(224, 59, '1', 'Metrocentro', 'GAVETA #20', '10-12-2020 12:53:15', 'oscar', 'C-69', '75.25'),
(225, 57, '0', 'Metrocentro', 'GAVETA #20', '10-12-2020 12:53:15', 'oscar', 'C-69', '75.25'),
(226, 47, '1', 'Metrocentro', 'GAVETA #20', '10-12-2020 12:53:15', 'oscar', 'C-69', '75.25'),
(227, 76, '13', 'Metrocentro', 'GAVETA 2', '17-12-2020 11:43:39', 'oscar', 'C-70', '75.25'),
(228, 75, '0', 'Metrocentro', 'GAVETA1 ', '14-01-2021 14:58:29', 'oscar', 'C-72', '50'),
(229, 75, '0', 'Metrocentro', 'GAVETA1 ', '20-01-2021 11:25:26', 'oscar', 'C-73', '80'),
(230, 35, '0', 'Metrocentro', 'GAVETA1 ', '20-01-2021 11:25:26', 'oscar', 'C-73', '100'),
(231, 84, '0', 'Metrocentro', 'GAVETA 2', '08-02-2021 14:26:15', 'oscar', 'C-74', '140'),
(232, 62, '1', 'Metrocentro', 'GAVETA 2', '08-02-2021 14:26:15', 'oscar', 'C-74', '120'),
(233, 57, '0', 'Metrocentro', 'GAVETA 2', '08-02-2021 14:26:15', 'oscar', 'C-74', '100'),
(234, 37, '0', 'Metrocentro', 'GAVETA 2', '08-02-2021 14:26:15', 'oscar', 'C-74', '200'),
(235, 84, '0', 'Metrocentro', 'GAVETA1 ', '12-02-2021 06:17:40', 'oscar', 'C-75', '90'),
(236, 77, '0', 'Metrocentro', 'GAVETA1 ', '12-02-2021 06:17:40', 'oscar', 'C-75', '110'),
(237, 75, '0', 'Metrocentro', 'GAVETA1 ', '12-02-2021 06:17:40', 'oscar', 'C-75', '80'),
(238, 57, '0', 'Metrocentro', 'GAVETA1 ', '12-02-2021 06:17:40', 'oscar', 'C-75', '100');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id_ingresos` int(11) NOT NULL,
  `numero_ingreso` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `sucursal` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id_ingresos`, `numero_ingreso`, `usuario`, `fecha`, `sucursal`) VALUES
(59, 'I-', 'oscar', '28-09-2020 09:56:45', 'San Miguel'),
(60, 'I-60', 'oscar', '03-10-2020 12:24:56', 'Metrocentro'),
(61, 'I-61', 'oscar', '03-10-2020 15:05:23', 'Metrocentro'),
(62, 'I-62', 'oscar', '03-10-2020 15:11:22', 'Metrocentro'),
(63, 'I-63', 'oscar', '04-10-2020 15:15:35', 'San Miguel'),
(64, 'I-64', 'oscar', '05-10-2020 14:16:39', 'Metrocentro'),
(65, 'I-65', 'oscar', '06-11-2020 14:02:01', 'Metrocentro'),
(66, 'I-66', 'oscar', '10-11-2020 10:22:36', 'Metrocentro'),
(67, 'I-67', 'oscar', '16-11-2020 15:45:18', 'Metrocentro'),
(68, 'I-68', 'oscar', '17-11-2020 11:53:05', 'Metrocentro'),
(69, 'I-69', 'oscar', '17-11-2020 12:16:33', 'Metrocentro'),
(70, 'I-70', 'oscar', '17-11-2020 15:17:14', 'Metrocentro'),
(71, 'I-71', 'oscar', '17-11-2020 16:39:58', 'Metrocentro'),
(72, 'I-72', 'oscar', '17-11-2020 16:46:26', 'Metrocentro'),
(73, 'I-73', 'oscar', '17-11-2020 16:52:52', 'Metrocentro'),
(74, 'I-74', 'oscar', '18-11-2020 10:42:45', 'Metrocentro'),
(75, 'I-75', 'oscar', '18-11-2020 14:23:56', 'Metrocentro'),
(76, 'I-76', 'oscar', '21-11-2020 16:46:54', 'Metrocentro'),
(77, 'I-77', 'oscar', '24-11-2020 12:15:54', 'San Miguel'),
(78, 'I-78', 'jacky', '24-11-2020 13:54:32', 'San Miguel'),
(79, 'I-79', 'oscar', '24-11-2020 16:26:38', 'San Miguel'),
(80, 'I-80', 'oscar', '28-11-2020 15:51:35', 'San Miguel'),
(81, 'I-81', 'oscar', '28-11-2020 15:58:30', 'San Miguel'),
(82, 'I-82', 'oscar', '28-11-2020 16:03:10', 'San Miguel'),
(83, 'I-83', 'oscar', '10-12-2020 12:45:23', 'Metrocentro'),
(84, 'I-84', 'oscar', '10-12-2020 12:53:15', 'Metrocentro'),
(85, 'I-85', 'oscar', '17-12-2020 11:43:39', 'Metrocentro'),
(86, 'I-86', 'oscar', '30-12-2020 10:40:36', 'Metrocentro'),
(87, 'I-87', 'oscar', '14-01-2021 14:58:29', 'Metrocentro'),
(88, 'I-88', 'oscar', '20-01-2021 11:25:26', 'Metrocentro'),
(89, 'I-89', 'oscar', '08-02-2021 14:26:15', 'Metrocentro'),
(90, 'I-90', 'oscar', '12-02-2021 06:17:40', 'Metrocentro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `marca` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `marca`) VALUES
(11, 'RAY BAN'),
(12, 'RAY -BAN'),
(13, 'TORY BURCH'),
(14, 'ANDVAS'),
(15, 'PENGUIN'),
(16, 'MARCA PAJARRACO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_caja`
--

CREATE TABLE `movimientos_caja` (
  `id_mov_caja` int(11) NOT NULL,
  `tipo_mov` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `monto` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `saldo_ini` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sobrante` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sucursal` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `movimientos_caja`
--

INSERT INTO `movimientos_caja` (`id_mov_caja`, `tipo_mov`, `usuario`, `monto`, `fecha`, `observaciones`, `saldo_ini`, `sobrante`, `sucursal`) VALUES
(1, 'Egreso', 'oscar', '1.65', '07-01-2021', '0', '21.53', '19.88', 'Metrocentro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_credito`
--

CREATE TABLE `orden_credito` (
  `id_orden` int(11) NOT NULL,
  `numero_orden` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `ref_uno` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `tel_ref_uno` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `ref_dos` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `tel_ref_dos` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_registro` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_finalizacion` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `sucursal` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `monto` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `plazo` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `orden_credito`
--

INSERT INTO `orden_credito` (`id_orden`, `numero_orden`, `id_paciente`, `ref_uno`, `tel_ref_uno`, `ref_dos`, `tel_ref_dos`, `fecha_registro`, `fecha_inicio`, `fecha_finalizacion`, `estado`, `id_usuario`, `sucursal`, `monto`, `plazo`) VALUES
(46, 'OME-1', 139, 'REF1', '2352-2352', 'REF2', '2211-1444', '02-02-2021 12:41:19', '2021-02-09', '09-09-2021', '1', 1, 'Metrocentro', '225.25', '7'),
(47, 'OME-2', 138, 'DDDSFD', '2112-121', 'EEE', '222', '08-02-2021 16:09:28', '2021-02-15', '15-06-2021', '1', 1, 'Metrocentro', '260.25', '4'),
(48, 'OME-3', 141, 'DQSW', 'EE', 'EEW', 'EE', '15-02-2021 12:49:44', '2021-02-22', '22-12-2021', '1', 1, 'Metrocentro', '225.25', '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `codigo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombres` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `edad` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ocupacion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sucursal` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dui` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `correo` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_reg` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresas` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nit` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono_oficina` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_paciente` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nac` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `codigo`, `nombres`, `telefono`, `edad`, `ocupacion`, `sucursal`, `dui`, `correo`, `fecha_reg`, `usuario`, `empresas`, `nit`, `telefono_oficina`, `direccion`, `tipo_paciente`, `fecha_nac`) VALUES
(104, 'AVME-1', 'RODRIGO ANTONIO REGALADO RIVAS', '6312-4784', '14', '', 'Metrocentro', '00027223-3', '', '10-11-2020 10:23:35', 'oscar', 'Bimbo', '', '', 'Santo Tomas', 'Sucursal', '10-11-2006'),
(105, 'AVME-2', 'SONIA DAYSI MENA DURAN', '', '25', '', 'Metrocentro', '', '', '30-11-2020 14:45:28', 'oscar', '', '', '', '', 'Sucursal', '30-11-1995'),
(106, 'AVME-3', 'SOFIA GUADALUPE GONZALEZ', '', '25', '', 'Metrocentro', '', '', '10-11-2020 10:51:42', 'oscar', '', '', '', '', 'Sucursal', '10-11-1995'),
(107, 'AVME-4', 'KAPPA', '6312-4784', '25', '', 'Metrocentro', '00027223-1', '', '16-11-2020 10:11:41', 'oscar', 'KAPPA', '', '2558-8888', 'SAN SALVADOR', 'Desc_planilla', '16-11-1995'),
(108, 'AVME-5', 'CAROLINA SANCHEZ', '6312-4784', '0', '', 'Metrocentro', '25125888-8', '', '16-11-2020 10:16:12', 'oscar', 'EXCEL AUTOMOTRIZ', '', '0000-0000', 'SAN MIGUEL', 'Desc_planilla', '16-11-2020'),
(109, 'AVME-6', 'KAPPA', '2555-55', '25', '', 'Metrocentro', '12272233-', '', '17-11-2020 11:29:50', 'oscar', 'KAPPA', '', '2255-5585', 'SAN SALVADOR', 'Desc_planilla', '17-11-1995'),
(110, 'AVME-7', 'CELPAC, S.A. DE C.V.', '6312-4784', '25', '', 'Metrocentro', '55855567-2', '', '17-11-2020 12:05:05', 'oscar', 'CELPAC, S.A. DE C.V.', '', '2555-5555', 'SAN SALVADOR', 'Desc_planilla', '17-11-1995'),
(111, 'AVME-8', 'SMURFIT KAPPA EL SALVADOR SOCIEDAD ANONIMA', '0000-0000', '000', '', 'Metrocentro', '45277575-7', '', '17-11-2020 15:09:51', 'oscar', 'SMURFIT KAPPA EL SALVADOR SOCIEDAD ANONIMA', '', '2352-5555', 'SS', 'Desc_planilla', '17-11-2020'),
(112, 'AVME-9', 'CAJAS PLEGADIZAS S.A DE C.V', '4555-5555', '00', '', 'Metrocentro', '25656666-5', '', '17-11-2020 15:11:23', 'oscar', 'CAJAS PLEGADIZAS S.A DE C.V', '', '0000-0000', 'SS', 'Desc_planilla', '17-11-2020'),
(113, 'AVME-10', 'ECOFIBRAS S.A DE C.V', '2564-5222', '0', '', 'Metrocentro', '45235221-2', '', '17-11-2020 16:28:09', 'oscar', 'ECOFIBRAS S.A DE C.V', '', '2253-5666', 'SS', 'Desc_planilla', '17-11-2020'),
(114, 'AVME-11', 'ROSA EVELYN PERAZA', '2125-5555', '40', '', 'Metrocentro', '02545578-8', '', '25-11-2020 10:48:31', 'oscar', 'ECOFIBRAS S.A DE C.V', '', '4114-1141', 'SS', 'Desc_planilla', '25-11-1980'),
(115, 'AVME-12', 'ANA JULIETA HERNANDEZ', '2555-5555', '25', '', 'Metrocentro', '54441111-1', 'iandvas.opto@gmail.com', '25-11-2020 12:14:22', 'oscar', 'CELPAC, S.A. DE C.V.', '', 'DDDD-', 'SDD', 'Desc_planilla', '25-11-1995'),
(116, 'AVME-13', 'LUIS ALBERTO MARTINEZ', '6312-4784', '25', 'MECANICO', 'Metrocentro', '00027223-3', 'eyter@gmail.com', '21-11-2020 11:22:07', 'oscar', '', '', '', '', 'Sucursal', '21-11-1995'),
(117, 'AVME-14', 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON', '7400-0002', '25', '', 'Metrocentro', '00027258-8', '', '21-11-2020 16:43:09', 'oscar', 'CAJAS PLEGADIZAS S.A DE C.V', '', '2555-8888', 'SS', 'Desc_planilla', '21-11-1995'),
(118, 'AVME-15', 'GERSON ARMANDO FLOERS', '', '25', '', 'Metrocentro', '', '', '22-11-2020 14:59:11', 'oscar', '', '', '', '', 'Sucursal', '22-11-1995'),
(119, 'AVME-16', 'CARLOS ANTONIO RIVAS', '', '24', '', 'Metrocentro', '', '', '23-11-2020 14:07:51', 'oscar', '', '', '', '', 'Sucursal', '23-11-1996'),
(120, 'AVME-17', 'NASIF HANDAL', '5555-2555', '25', 'GERENTE DE OPERACIONES', 'Metrocentro', '22222222-2', 'rodgmail.com', '23-11-2020 14:44:38', 'oscar', 'CELPAC, S.A. DE C.V.', '4444-444444-44', '2222-2222', 'ZACATECOLUCA ..CALLE PRINCIPAL COLONIA 1 CASA \"4', 'Sucursal', '23-11-1995'),
(121, 'AVSM-1', 'LILIANA ABIGAIL CRUZ SALAMANCA', '', '13', '', 'San Miguel', '00027223-3', '', '24-11-2020 12:11:12', 'oscar', '', '', '', '', 'Sucursal', '24-11-2007'),
(122, 'AVSM-2', 'ERICK OSWALDO SORIANO ', '6312-4784', '58', '', 'San Miguel', '00027223-0', '', '24-11-2020 13:15:04', 'jacky', 'ECOFIBRAS S.A DE C.V', '', '2265-8666', 'SAN SALVADOR', 'Desc_planilla', '24-11-1962'),
(123, 'AVSM-3', 'CARLOS ANTONIO RIVERA', '', '25', '', 'San Miguel', '', '', '24-11-2020 13:46:14', 'jacky', '', '', '', '', 'Sucursal', '24-11-1995'),
(124, 'AVSA-1', 'OSCAR RAMOS', '', '25', '', 'Santa Ana', '', '', '15-12-2020 14:28:44', 'oscar', '', '', '', '', 'Sucursal', '15-12-1995'),
(125, 'AVME-18', 'FREDY VEGA', '', '25', '', 'Metrocentro', '', '', '21-12-2020 11:35:53', 'oscar', '', '', '', '', 'Sucursal', '21-12-1995'),
(126, 'AVME-19', 'CLAUDIA MARISOL CORVERA', '', '25', '', 'Metrocentro', '', '', '21-12-2020 13:06:58', 'oscar', '', '', '', '', 'Sucursal', '21-12-1995'),
(127, 'AVME-20', 'ANA MARIA GONZALEZ', '0000-0000', '47', '', 'Metrocentro', '', '', '22-12-2020 11:41:33', 'oscar', '', '', '', '', 'Sucursal', '22-12-1973'),
(128, 'AVME-21', 'MAITEH PERRONI', '2333-3333', '54', 'ENFERMERA', 'Metrocentro', '25355555-5', 'sin correo', '22-12-2020 16:12:27', 'oscar', 'DISZASA', '5855-522222-22', '2255-5555', 'SAN JACINTO AVENIDA LOS COCOS', 'Sucursal', '22-12-1966'),
(129, 'AVME-22', 'SANDRA PATRICIA RAMIRES', '2255-5225', '29', 'SECRETARIA', 'Metrocentro', '02222555-5', 'sabdra@gmail.com', '23-12-2020 09:54:05', 'oscar', 'CRUZ ROJA', '2322-222252-555-5', '2255-5555', 'SAN FRANCISCO CHINAMECA DEPARTAMENTO DE LA PAZ', 'Sucursal', '23-12-1991'),
(130, 'AVME-23', 'JENCY CECIBEL LANDAVERDE MEZA', '7785-6565', '14', 'ENFERMERA', 'Metrocentro', '22555555-5', 'jencyyyyyyyyyyyyyyy', '23-12-2020 10:51:58', 'oscar', 'ECOFIBRAS S.A DE C.V', '', '2555-5555', 'SANTO TOMAS COLONIA EL CARMEN CASA #2', 'Sucursal', '23-12-2006'),
(131, 'AVME-24', 'SALVADOR ALAS', '2555-5585', '61', 'ABOGADO', 'Metrocentro', '25555555-5', 'salvador@gmail.com', '28-12-2020 13:13:14', 'oscar', '', '', '', '', 'Sucursal', '28-12-1959'),
(132, 'AVME-25', 'NEFTALY GUZAMN', '0000-0000', '58', 'EMPLEADO', 'Metrocentro', '02225555-5', 'sin correo', '02-01-2021 09:22:09', 'oscar', 'CRUZ ROJA', '1155-55', '2222-2225', 'PLANES DE RENDEROS', 'Sucursal', '02-01-1963'),
(133, 'AVME-26', 'IRIS DEL CARMEN ENRRUIQUEZ', '0000-0000', '28', 'ESTUDIANTE', 'Metrocentro', '22222222-2', 'sin correo', '03-01-2021 12:36:59', 'oscar', 'ECOFIBRAS S.A DE C.V', '', '2522-2222', 'SAN MIGUEL', 'Sucursal', '03-01-1993'),
(134, 'AVME-27', 'ALEXANDER LOPEZ DIAZ', '5222-2222', '25', 'PANADERO', 'Metrocentro', '25553333-3', 'sc', '03-01-2021 14:12:52', 'oscar', 'MEDIDENT', '2255-555555-555-5', '2222-5555', 'SAN FRANCISCO CHINAMECA', 'Sucursal', '03-01-1996'),
(135, 'AVME-28', 'SONIA DAYSI MENA DURAN', '', '25', '', 'Metrocentro', '', '', '04-01-2021 12:23:28', 'oscar', '', '', '', '', 'Sucursal', '04-01-1996'),
(136, 'AVME-29', 'CARLOS ERNESTO REYES', '7522-5555', '14', 'PROGRAMADOR', 'Metrocentro', '00027202-3', 'sc', '04-01-2021 12:53:30', 'oscar', 'ECOFIBRAS S.A DE C.V', '', '2225-5888', 'SAN SALVADOR', 'Sucursal', '04-01-2007'),
(137, 'AVME-30', 'JACKELIN ASUNCION MOLINA', '7555-5522', '27', 'SECRETARIA', 'Metrocentro', '00000144-4', '---', '04-01-2021 16:48:28', 'oscar', 'DISZASA', '5555-555555-555-2', '2222-2222', 'SAN SALVADOR', 'Sucursal', '04-01-1994'),
(138, 'AVME-31', 'SANDRA GONZALEZ', '2222-2222', '45', 'SECRETARIA', 'Metrocentro', '32212222-2', 'sc', '06-01-2021 16:13:09', 'oscar', 'MEDIDENT', '', '2222-2222', 'SAN SALVADOR', 'Sucursal', '06-01-1976'),
(139, 'AVME-32', 'LUCIANA MICHELLE RAMIREZ ', '2585-3333', '29', 'SECRETARIA', 'Metrocentro', '02223333-3', 'SC', '12-01-2021 13:37:34', 'oscar', 'DISZASA', '2555-536585-555-5', '2255-2568', 'SAN MARCOS LEMPA', 'Sucursal', '12-01-1992'),
(140, 'AVME-33', 'MARCELA  ROXANA ARRIOLA', '', '19', '', 'Metrocentro', '', '', '13-01-2021 16:25:18', 'oscar', '', '', '', '', 'Sucursal', '13-01-2002'),
(141, 'AVME-34', 'CARMEN ARELY VASQUEZ MARTINEZ', '7896-1447', '25', 'GERENTE', 'Metrocentro', '00000000-0', '', '28-01-2021 13:47:38', 'oscar', 'CAJAS PLEGADIZAS S.A DE C.V', '', 'DDEW-D', 'SS', 'Sucursal', '28-01-1996'),
(142, 'AVME-35', 'CARMEN ALICIA MARQUEZ ROMERO', '2260-1650', '21', 'ESTUDIANTE', 'Metrocentro', '', '', '08-02-2021 13:56:10', 'oscar', '', '', '', '', 'Sucursal', '08-02-2000'),
(143, 'AVME-36', 'BETANIA MEJIA', '0000-0000', '28', '', 'Metrocentro', '00000', '', '11-02-2021 11:00:21', 'oscar', '', '', '', '', 'Sucursal', '11-02-1993'),
(144, 'AVME-37', 'OSCAR DE FLORES', '0000-0000', '50', 'ORDENANZA', 'Metrocentro', '', '', '11-02-2021 11:02:15', 'oscar', '', '', '', '', 'Sucursal', '11-02-1971'),
(145, 'AVME-38', 'JOSE RONALD FUENTES', '', '35', '', 'Metrocentro', '', '', '13-02-2021 14:45:17', 'oscar', '', '', '', '', 'Sucursal', '13-02-1986'),
(146, 'AVME-39', 'ALCLEISDER JAIMES', '', '27', '', 'Metrocentro', '', '', '14-02-2021 09:58:58', 'oscar', '', '', '', '', 'Sucursal', '14-02-1994');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `nombre`) VALUES
(1, 'Empresas'),
(2, 'Compras'),
(3, 'Inventarios'),
(4, 'Pacientes&Consultas'),
(5, 'Ventas'),
(6, 'Creditos&Cobros'),
(7, 'Caja Chica'),
(8, 'EnviosLab');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `marca` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `modelo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `color` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `medidas` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `diseno` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `materiales` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `categoria_producto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `desc_producto` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `marca`, `modelo`, `color`, `medidas`, `diseno`, `materiales`, `categoria`, `categoria_producto`, `desc_producto`) VALUES
(35, 'RAY BAN', 'RB0055', 'C3', '23-44-44', 'Completo', 'Metal', 'Básico', 'aros', 'RAY BAN mod.RB0055 23-44-44 C3'),
(37, 'RAY -BAN', '58169', 'C2', '15-15-154', 'Completo', 'Acetato', 'Premium', 'aros', 'RAY -BAN mod.58169 15-15-154 C2'),
(47, 'RAY BAN', '2584', '0', '0', '0', '0', 'Estuche', 'accesorios', 'ESTUCHE RAYBAN COLOR CAFÉ'),
(48, 'RAY BAN', 'FRA 1', '0', '0', '0', '0', 'Estuche', 'accesorios', 'FRANELA RAYBAN'),
(51, '0', '0', '0', '0', '0', '0', '85', 'Photosensible', 'ANTIRREFLEJANTE 1'),
(55, '0', '0', '0', '0', '0', '0', '50', 'Photosensible', 'TRANSITIONS GEN 8 CAFE'),
(57, 'TORY BURCH', 'T455', 'C7', '12-48-555', 'Completo', 'Metal', 'Básico', 'aros', 'TORY BURCH mod.T455 12-48-555 C7'),
(58, 'RAY BAN', '355', '0', '0', '0', '0', 'Estuche', 'accesorios', 'ESTUCHE LACOSTE'),
(59, 'RAY BAN', '355', '0', '0', '0', '0', 'Estuche', 'accesorios', 'ESTUCHE LACOSTE'),
(60, 'RAY BAN', '55414', '0', '0', '0', '0', 'Estuche', 'accesorios', 'KHKHASJ'),
(61, 'RAY BAN', '55555', '0', '0', '0', '0', 'Franela', 'accesorios', '255'),
(62, 'RAY BAN', '00', '0', '0', '0', '0', 'Estuche', 'accesorios', 'RR'),
(63, 'RAY BAN', '00', '0', '0', '0', '0', 'Spray de limpieza', 'accesorios', 'DD'),
(64, 'RAY BAN', '00', '0', '0', '0', '0', 'Estuche', 'accesorios', 'MD,JSAK'),
(65, '', '', '0', '0', '0', '0', '', 'accesorios', 'BACILOSCOPIA'),
(66, '', '', '0', '0', '0', '0', '', 'accesorios', 'EXAMENES GENERALES'),
(67, '', '', '0', '0', '0', '0', '', 'accesorios', 'CULTIVO FARINGEO'),
(68, '', '', '0', '0', '0', '0', '', 'accesorios', 'CREATININA'),
(69, '', '', '0', '0', '0', '0', '', 'accesorios', 'PRUEBAS DE FUNCIONAMIENTO'),
(70, '', '', '0', '0', '0', '0', '', 'accesorios', 'VDRL'),
(71, '', '', '0', '0', '0', '0', '', 'accesorios', 'GLUCOSA,COLESTEROL, TRIGLICERIDOS, ACIDO URICO'),
(72, '', '0', '0', '0', '0', '0', '', 'accesorios', 'CREATININA'),
(73, '', '', '0', '0', '0', '0', '', 'accesorios', 'PRUEBA DE FUNCIONAMIENTO HEPATICO'),
(74, 'ANDVAS', 'WILL 001', 'C2', '00-00-000', 'Completo', 'Acetato', 'Básico', 'aros', 'ANDVAS mod.WILL 001 00-00-000 C2'),
(75, 'PENGUIN', 'THE QUIN', '15616145', '53-20-143', 'Completo', 'Metal/Acetato', 'Intermedio', 'aros', 'PENGUIN mod.THE QUIN 53-20-143 15616145'),
(76, 'ANDVAS', '', '0', '0', '0', '0', 'Adaptador Anatomico', 'accesorios', 'CINTAS PARA LENTES'),
(77, 'RAY BAN', 'A2113-RAYMOD', 'C2', '53-20-149', 'Completo', 'Metal', 'Básico', 'aros', 'RAY BAN mod.A2113-RAYMOD 53-20-149 C2'),
(78, '0', '0', '0', '0', '0', '0', '50', 'Lentes', 'LENTE VS PROMO'),
(79, 'PENGUIN', 'MPENGUIN 01', 'CP01', '11-11-111', 'Completo', 'Metal', 'Básico', 'aros', 'PENGUIN mod.MPENGUIN 01 11-11-111 CP01'),
(80, '0', '0', '0', '0', '0', '0', '50', 'Lentes', 'LENTE VISION SENCILLA BLU CAP'),
(82, '0', '0', '0', '0', '0', '0', '25', 'Lentes', 'LENTE #5'),
(83, '0', '0', '0', '0', '0', '0', '52', 'Photosensible', 'PHTOSENSIBLE #5'),
(84, 'MARCA PAJARRACO', 'NEW MODEL PA', 'C45', '12-55-577', 'Completo', 'Metal', 'Básico', 'aros', 'MARCA PAJARRACO mod.NEW MODEL PA 12-55-577 C45'),
(85, 'MARCA PAJARRACO', 'NINGUNO', 'ANARANJAFO', '13-32-456', 'Completo', 'Metal', 'Intermedio', 'aros', 'MARCA PAJARRACO mod.NINGUNO 13-32-456 ANARANJAFO'),
(86, '0', '0', '0', '0', '0', '0', '20.35', 'Lentes', 'VISION AIRWERE BLUE'),
(87, '0', '0', '0', '0', '0', '0', '30.67', 'Photosensible', 'OVATIONS DS BLUE '),
(88, '0', '0', '0', '0', '0', '0', '42.48', 'Photosensible', 'ANTIRREFLEJANTE # 7'),
(89, '0', '0', '0', '0', '0', '0', '50.25', 'Lentes', 'LENTE NUEVO 15/02/2021');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `codigo_proveedor` varchar(25) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `codigo_proveedor`, `nombre`) VALUES
(1, 'P-01', 'Carlos Andres Vazquez Choto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos`
--

CREATE TABLE `recibos` (
  `id_recibo` int(11) NOT NULL,
  `numero_recibo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_venta` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monto` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sucursal` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recibi_de` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empresa` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cant_letras` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_anteriores` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abono_act` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saldo` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forma_pago` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marca_aro` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modelo_aro` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_aro` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lente` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anti_r` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observaciones` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prox_abono` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `servicio_para` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `recibos`
--

INSERT INTO `recibos` (`id_recibo`, `numero_recibo`, `numero_venta`, `monto`, `fecha`, `sucursal`, `id_paciente`, `id_usuario`, `telefono`, `recibi_de`, `empresa`, `cant_letras`, `a_anteriores`, `abono_act`, `saldo`, `forma_pago`, `marca_aro`, `modelo_aro`, `color_aro`, `lente`, `anti_r`, `photo`, `observaciones`, `prox_abono`, `servicio_para`) VALUES
(365, 'RME-1', 'AVME-1', '90.00', '29-11-2020 12:06:18', 'Metrocentro', 119, 1, '', 'CARLOS ANTONIO RIVAS', '', '', '0', '18.00', '72.00', 'Efectivo', 'TORY BURCH', 'T455', 'C7', '', '', '', '', '2020-11-30', ''),
(366, 'RME-2', 'AVME-2', '120.00', '29-11-2020 12:07:02', 'Metrocentro', 114, 1, '2125-5555', 'ROSA EVELYN PERAZA', 'ECOFIBRAS S.A DE C.V', 'VEINTICINCO DOLARES ', '0', '25', '95.00', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '2020-11-30', ''),
(367, 'RME-3', 'AVME-1', '90.00', '29-11-2020 12:51:52', 'Metrocentro', 119, 1, '', 'CARLOS ANTONIO RIVAS', '', '', '18.00', '18.00', '54.00', 'Efectivo', 'TORY BURCH', 'T455', 'C7', '', '', '', '', '2020-12-06', ''),
(368, 'RME-4', 'AVME-3', '120.00', '29-11-2020 13:09:22', 'Metrocentro', 112, 1, '4555-5555', 'CAJAS PLEGADIZAS S.A DE C.V', 'CAJAS PLEGADIZAS S.A DE C.V', '', '0', '40.00', '80.00', 'Davivienda', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '2020-12-07', ''),
(369, 'RME-5', 'AVME-6', '120.00', '29-11-2020 13:21:25', 'Metrocentro', 114, 1, '2125-5555', 'ROSA EVELYN PERAZA', 'ECOFIBRAS S.A DE C.V', 'DOCE DOLARES CON SESENTA Y NUEVE CENTAVOS ', '0', '12.69', '107.31', 'Davivienda', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '2020-11-30', 'ROSA EVELYN PERAZA'),
(370, 'RME-6', 'AVME-6', '120.00', '29-11-2020 14:39:57', 'Metrocentro', 114, 1, '2125-5555', 'ROSA EVELYN PERAZA', 'ECOFIBRAS S.A DE C.V', 'DOCE DOLARES CON NOVENTA Y SEIS CENTAVOS ', '12.69', '12.96', '94.35', 'Davivienda', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '2020-12-06', 'ROSA EVELYN PERAZA'),
(371, 'RME-7', 'AVME-3', '120.00', '29-11-2020 14:46:01', 'Metrocentro', 112, 1, '4555-5555', 'CAJAS PLEGADIZAS S.A DE C.V', 'CAJAS PLEGADIZAS S.A DE C.V', '', '40.00', '40.00', '40.00', 'Davivienda', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '2020-11-30', ''),
(372, 'RME-8', 'AVME-8', '190.00', '07-12-2020 13:53:25', 'Metrocentro', 114, 1, '2125-5555', 'ROSA EVELYN PERAZA', 'ECOFIBRAS S.A DE C.V', 'VEINTICINCO DOLARES ', '0', '25', '165.00', 'Efectivo', 'TORY BURCH', 'T455', 'C7', '', '', '', '', '2020-12-14', 'ROSA EVELYN PERAZA'),
(373, 'RME-9', 'AVME-9', '240.00', '07-12-2020 14:38:13', 'Metrocentro', 116, 1, '6312-4784', 'LUIS ALBERTO MARTINEZ', '', 'TREINTA DOLARES ', '0', '30', '210.00', 'Efectivo', 'TORY BURCH', 'T455', 'C7', '', '', '', '', '2020-12-14', 'LUIS ALBERTO MARTINEZ'),
(374, 'RME-10', 'AVME-10', '335.00', '07-12-2020 14:40:18', 'Metrocentro', 104, 1, '6312-4784', 'RODRIGO ANTONIO REGALADO RIVAS', 'Bimbo', '', '0', '111.67', '223.33', 'Cuscatlan', 'RAY -BAN', '58169', 'C2', '', '', '', '', '2020-12-20', 'RODRIGO ANTONIO REGALADO RIVAS'),
(375, 'RME-11', 'AVME-9', '240.00', '10-12-2020 13:16:20', 'Metrocentro', 116, 1, '6312-4784', 'LUIS ALBERTO MARTINEZ', '', 'DIEZ DOLARES ', '30', '10', '200.00', 'Efectivo', 'TORY BURCH', 'T455', 'C7', '', '', '', '', '2020-12-23', 'LUIS ALBERTO MARTINEZ'),
(377, 'RME-12', 'AVME-20', '220.00', '12-12-2020 15:09:10', 'Metrocentro', 115, 1, '2555-5555', 'ANA JULIETA HERNANDEZ', 'CELPAC, S.A. DE C.V.', 'VEINTICINCO DOLARES ', '0', '25', '195.00', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', 'VISION SENCILLA', '', '', '', '2020-12-19', 'ANA JULIETA HERNANDEZ'),
(378, 'RME-13', 'AVME-9', '240.00', '15-12-2020 13:14:51', 'Metrocentro', 116, 1, '6312-4784', 'LUIS ALBERTO MARTINEZ', '', 'DOSCIENTOS  DOLARES ', '10', '200', '0.00', 'Efectivo', 'TORY BURCH', 'T455', 'C7', '', '', '', '', '', 'LUIS ALBERTO MARTINEZ'),
(379, 'RSA-1', 'AVSA-1', '150.00', '15-12-2020 14:31:35', 'Santa Ana', 124, 1, '', 'OSCAR RAMOS', '', 'CIENTO CINCUENTA DOLARES ', '0', '150', '0.00', 'Efectivo', '', '', '', 'VISION SENCILLA CR39 PHOT', '', '', '', '', 'OSCAR RAMOS'),
(380, 'RSA-2', 'AVSA-2', '150.00', '16-12-2020 14:14:23', 'Santa Ana', 124, 1, '', 'OSCAR RAMOS', '', 'CIENTO CINCUENTA DOLARES ', '0', '150', '0.00', 'Efectivo', '', '', '', 'VISION SENCILLA CR39 PHOT', '', '', '', '', 'OSCAR RAMOS'),
(381, 'RME-14', 'AVME-28', '120.00', '16-12-2020 14:22:18', 'Metrocentro', 114, 1, '2125-5555', 'ROSA EVELYN PERAZA', 'ECOFIBRAS S.A DE C.V', 'CIENTO VEINTE DOLARES ', '0', '120', '0.00', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '', 'ROSA EVELYN PERAZA'),
(382, 'RME-15', 'AVME-1', '335.00', '16-12-2020 14:30:50', 'Metrocentro', 104, 1, '6312-4784', 'RODRIGO ANTONIO REGALADO RIVAS', 'Bimbo', 'CIENTO CINCUENTA DOLARES ', '0', '150', '185.00', 'Cheque', 'RAY -BAN', '58169', 'C2', 'VISION SENCILLA', '', 'ANTIRREFLEJANTE 1', '', '2020-12-17', 'RODRIGO ANTONIO REGALADO RIVAS'),
(383, 'RME-16', 'AVME-1', '335.00', '16-12-2020 14:32:51', 'Metrocentro', 104, 1, '6312-4784', 'RODRIGO ANTONIO REGALADO RIVAS', 'Bimbo', 'CIENTO OCHENTA Y CINCO DOLARES ', '150', '185', '0.00', 'Serfinsa', 'RAY -BAN', '58169', 'C2', 'VISION SENCILLA', '', 'ANTIRREFLEJANTE 1', '', '', 'RODRIGO ANTONIO REGALADO RIVAS'),
(384, 'RME-17', 'AVME-2', '120.00', '16-12-2020 15:05:47', 'Metrocentro', 116, 1, '6312-4784', 'LUIS ALBERTO MARTINEZ', '', 'CIENTO VEINTE DOLARES ', '0', '120', '0.00', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '', 'LUIS ALBERTO MARTINEZ'),
(385, 'RME-18', 'AVME-3', '150.00', '16-12-2020 15:53:44', 'Metrocentro', 115, 1, '2555-5555', 'ANA JULIETA HERNANDEZ', 'CELPAC, S.A. DE C.V.', 'CIENTO CINCUENTA DOLARES ', '0', '150', '0.00', 'Efectivo', 'RAY -BAN', '58169', 'C2', '', '', '', '', '', 'ANA JULIETA HERNANDEZ'),
(386, 'RME-19', 'AVME-4', '90.00', '16-12-2020 15:58:27', 'Metrocentro', 115, 1, '2555-5555', 'ANA JULIETA HERNANDEZ', 'CELPAC, S.A. DE C.V.', 'NOVENTA DOLARES ', '0', '90', '0.00', 'Efectivo', 'TORY BURCH', 'T455', 'C7', '', '', '', '', '', 'ANA JULIETA HERNANDEZ'),
(387, 'RME-20', 'AVME-5', '120.00', '16-12-2020 16:00:20', 'Metrocentro', 115, 1, '2555-5555', 'ANA JULIETA HERNANDEZ', 'CELPAC, S.A. DE C.V.', 'CIENTO VEINTE DOLARES ', '0', '120', '0.00', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '', 'ANA JULIETA HERNANDEZ'),
(388, 'RME-21', 'AVME-6', '150.00', '16-12-2020 16:01:20', 'Metrocentro', 115, 1, '2555-5555', 'ANA JULIETA HERNANDEZ', 'CELPAC, S.A. DE C.V.', 'CIENTO CINCUENTA DOLARES ', '0', '150', '0.00', 'Efectivo', 'RAY -BAN', '58169', 'C2', '', '', '', '', '', 'ANA JULIETA HERNANDEZ'),
(389, 'RME-22', 'AVME-7', '150.00', '16-12-2020 16:03:44', 'Metrocentro', 115, 1, '2555-5555', 'ANA JULIETA HERNANDEZ', 'CELPAC, S.A. DE C.V.', 'CIENTO CINCUENTA DOLARES ', '0', '150', '0.00', 'Efectivo', 'RAY -BAN', '58169', 'C2', '', '', '', '', '', 'ANA JULIETA HERNANDEZ'),
(390, 'RME-23', 'AVME-8', '120.00', '16-12-2020 16:06:29', 'Metrocentro', 115, 1, '2555-5555', 'ANA JULIETA HERNANDEZ', 'CELPAC, S.A. DE C.V.', 'CIENTO VEINTE DOLARES ', '0', '120', '0.00', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '', 'ANA JULIETA HERNANDEZ'),
(391, 'RME-24', 'AVME-9', '120.00', '16-12-2020 16:09:29', 'Metrocentro', 115, 1, '2555-5555', 'ANA JULIETA HERNANDEZ', 'CELPAC, S.A. DE C.V.', 'CIENTO VEINTE DOLARES ', '0', '120', '0.00', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '', 'ANA JULIETA HERNANDEZ'),
(392, 'RME-25', 'AVME-10', '360.00', '16-12-2020 16:15:38', 'Metrocentro', 114, 1, '2125-5555', 'ROSA EVELYN PERAZA', 'ECOFIBRAS S.A DE C.V', 'TRESCIENTOS SESENTA DOLARES ', '0', '360', '0.00', 'Efectivo', 'TORY BURCH', 'T455', 'C7', 'VISION SENCILLA', 'antirreflejante 2', 'ANTIRREFLEJANTE 1', 'NO HAY NINGUNA OBSERVACION', '', 'ROSA EVELYN PERAZA'),
(393, 'RME-26', 'AVME-11', '9.00', '17-12-2020 11:44:00', 'Metrocentro', 114, 1, '2125-5555', 'ROSA EVELYN PERAZA', 'ECOFIBRAS S.A DE C.V', 'NUEVE DOLARES ', '0', '9', '0.00', 'Efectivo', '', '', '', '', '', '', '', '', 'ROSA EVELYN PERAZA'),
(394, 'RME-27', 'AVME-12', '6.00', '17-12-2020 12:11:25', 'Metrocentro', 115, 1, '2555-5555', 'ANA JULIETA HERNANDEZ', 'CELPAC, S.A. DE C.V.', 'SEIS DOLARES ', '0', '6', '0.00', 'Cheque', '', '', '', '', '', '', '', '', 'ANA JULIETA HERNANDEZ'),
(395, 'RME-28', 'AVME-13', '10.00', '17-12-2020 12:20:42', 'Metrocentro', 120, 2, '', 'NASIF HANDAL', '', 'DIEZ DOLARES ', '0', '10', '0.00', 'Efectivo', '', '', '', '', '', '', '', '', ''),
(396, 'RME-29', 'AVME-14', '45.00', '17-12-2020 12:23:53', 'Metrocentro', 118, 2, '', 'GERSON ARMANDO FLOERS', '', 'CUARENTA Y CINCO DOLARES ', '0', '45', '0.00', 'Efectivo', '', '', '', '', '', '', '', '', ''),
(397, 'RME-30', 'AVME-15', '250.00', '17-12-2020 12:28:51', 'Metrocentro', 114, 1, '2125-5555', 'ROSA EVELYN PERAZA', 'ECOFIBRAS S.A DE C.V', 'DOSCIENTOS CINCUENTA DOLARES ', '0', '250', '0.00', 'Efectivo', 'RAY -BAN', '58169', 'C2', 'VISION SENCILLA', '', '', '', '', 'ROSA EVELYN PERAZA'),
(398, 'RME-31', 'AVME-16', '452.00', '17-12-2020 12:33:16', 'Metrocentro', 114, 1, '2125-5555', 'ROSA EVELYN PERAZA', 'ECOFIBRAS S.A DE C.V', 'CUATROCIENTOS CINCUENTA Y DOS DOLARES ', '0', '452', '0.00', 'Cheque', 'RAY -BAN', '58169', 'C2', 'VISIÓN SENCILLA BLANCO CR', '', 'TRANSITIONS GEN 8 CAFE', '', '', 'ROSA EVELYN PERAZA'),
(399, 'RME-32', 'AVME-17', '144.80', '22-12-2020 10:58:37', 'Metrocentro', 125, 1, '', 'FREDY VEGA', '', 'CIENTO CUARENTA Y CUATRO DOLARES CON OCHENTA CENTAVOS ', '0', '144.80', '0.00', 'Efectivo', 'TORY BURCH', 'T455', 'C7', 'VISIÓN SENCILLA BLANCO CR', '', '', '', '', 'FREDY VEGA'),
(400, 'RME-33', 'AVME-22', '120.00', '26-12-2020 14:24:57', 'Metrocentro', 130, 1, '', 'JENCY CECIBEL LANDAVERDE MEZA', '', 'VEINTIOCHO DOLARES ', '0', '28', '92.00', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '2021-01-02', 'JENCY CECIBEL LANDAVERDE MEZA'),
(401, 'RME-34', 'AVME-23', '240.00', '26-12-2020 14:28:03', 'Metrocentro', 129, 1, '', 'SANDRA PATRICIA RAMIRES', '', 'VEINTICINCO DOLARES ', '0', '25', '215.00', 'Efectivo', 'TORY BURCH', 'T455', 'C7', 'VISION SENCILLA CR39 PHOT', '', '', '', '2021-01-02', 'SANDRA PATRICIA RAMIRES'),
(402, 'RME-35', 'AVME-24', '150.00', '26-12-2020 14:30:08', 'Metrocentro', 130, 1, '', 'JENCY CECIBEL LANDAVERDE MEZA', '', 'VEINTICINCO DOLARES ', '0', '25', '125.00', 'Efectivo', 'RAY -BAN', '58169', 'C2', '', '', '', '', '2021-01-02', 'JENCY CECIBEL LANDAVERDE MEZA'),
(403, 'RME-36', 'AVME-8', '190.00', '26-12-2020 14:31:39', 'Metrocentro', 114, 1, '2125-5555', 'ANA JULIETA HERNANDEZ', 'ECOFIBRAS S.A DE C.V', 'VEINTICINCO DOLARES ', '25', '25', '140.00', 'Efectivo', 'TORY BURCH', 'T455', 'C7', '', '', '', '', '2020-12-25', 'ANA JULIETA HERNANDEZ'),
(404, 'RME-37', 'AVME-6', '120.00', '26-12-2020 14:32:03', 'Metrocentro', 114, 1, '2125-5555', 'ANA JULIETA HERNANDEZ', 'ECOFIBRAS S.A DE C.V', 'VEINTICINCO DOLARES ', '12.96', '25', '69.35', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '2021-01-02', 'ANA JULIETA HERNANDEZ'),
(405, 'RME-38', 'AVME-6', '120.00', '26-12-2020 14:41:39', 'Metrocentro', 114, 1, '2125-5555', 'ANA JULIETA HERNANDEZ', 'ECOFIBRAS S.A DE C.V', 'VEINTICINCO DOLARES ', '25', '25', '44.35', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '2021-01-02', 'ANA JULIETA HERNANDEZ'),
(406, 'RME-39', 'AVME-25', '150.00', '26-12-2020 14:42:41', 'Metrocentro', 128, 1, '', 'MAITEH PERRONI', '', 'VEINTICINCO DOLARES ', '0', '25', '125.00', 'Efectivo', 'RAY -BAN', '58169', 'C2', '', '', '', '', '2021-01-02', 'MAITEH PERRONI'),
(407, 'RSM-1', 'AVSM-1', '90.00', '26-12-2020 14:59:23', 'San Miguel', 122, 1, '6312-4784', 'ERICK OSWALDO SORIANO ', 'ECOFIBRAS S.A DE C.V', 'QUINCE DOLARES ', '0', '15', '75.00', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '2021-01-02', ''),
(408, 'RSM-2', 'AVSM-2', '90.00', '26-12-2020 15:25:33', 'San Miguel', 121, 1, '', 'LILIANA ABIGAIL CRUZ SALAMANCA', '', 'VEINTICINCO DOLARES ', '0', '25', '65.00', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '2021-01-02', ''),
(409, 'RSM-3', 'AVSM-3', '90.00', '26-12-2020 15:30:20', 'San Miguel', 121, 1, '', 'LILIANA ABIGAIL CRUZ SALAMANCA', '', 'VEINTICINCO DOLARES ', '0', '25', '65.00', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '2021-01-02', ''),
(410, 'RSM-4', 'AVSM-3', '90.00', '26-12-2020 15:31:52', 'San Miguel', 121, 1, '', 'LILIANA ABIGAIL CRUZ SALAMANCA', '', 'VEINTICINCO DOLARES ', '25', '25', '40.00', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '2021-01-02', ''),
(411, 'RSM-5', 'AVSM-3', '90.00', '26-12-2020 15:37:50', 'San Miguel', 121, 1, '', 'LILIANA ABIGAIL CRUZ SALAMANCA', '', 'VEINTICINCO DOLARES ', '25', '25', '15.00', 'Cheque', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '2021-01-02', ''),
(412, 'RME-40', 'AVME-32', '75.25', '03-01-2021 15:20:05', 'Metrocentro', 132, 1, '0000-0000', 'NEFTALY GUZAMN', 'SMURFIT KAPPA EL SALVADOR SOCIEDAD ANONIMA', 'SETENTA Y CINCO DOLARES CON VEINTICINCO CENTAVOS ', '0', '75.25', '0.00', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', '', '', '', '', '', ''),
(413, 'RME-41', 'AVME-14', '185.25', '06-10-2021 16:28:00', 'Metrocentro', 138, 1, '2222-2222', 'SANDRA GONZALEZ', 'MEDIDENT', 'DIECIOCHO DOLARES CON CINCUENTA Y TRES CENTAVOS ', '0', '18.53', '166.72', 'Cheque', 'RAY BAN', 'RB0055', 'C3', 'VISIÓN SENCILLA BLANCO CR', 'AR SUPERHIDROFOBICO ADD PROMO', '', '', '2021-10-30', 'SANDRA GONZALEZ'),
(414, 'RME-42', 'AVME-22', '225.25', '08-01-2021 15:39:28', 'Metrocentro', 127, 1, '0000-0000', 'ANA MARIA GONZALEZ', '', 'TREINTA Y DOS DOLARES CON DOCE CENTAVOS ', '0', '32.12', '193.13', 'Cheque', 'TORY BURCH', 'T455', 'C7', 'VISION SENCILLA CR39 PHOT', '', '', '', '2021-01-15', 'ANA MARIA GONZALEZ'),
(415, 'RME-43', 'AVME-23', '75.25', '09-01-2021 09:21:25', 'Metrocentro', 128, 1, '2333-3333', 'MAITEH PERRONI', 'DISZASA', 'VEINTICINCO DOLARES ', '0', '25', '50.25', 'Efectivo', 'RAY -BAN', '58169', 'C2', '', '', '', '', '2021-01-16', 'MAITEH PERRONI'),
(416, 'RME-44', 'AVME-22', '225.25', '11-01-2021 09:50:13', 'Metrocentro', 127, 1, '0000-0000', 'ANA MARIA GONZALEZ', '', 'CIENTO NOVENTA Y TRES DOLARES CON TRECE CENTAVOS ', '32.12', '193.13', '0.00', 'Efectivo', 'TORY BURCH', 'T455', 'C7', 'VISION SENCILLA CR39 PHOT', '', '', '', '', 'ANA MARIA GONZALEZ'),
(417, 'RME-45', 'AVME-32', '260.25', '24-01-2021 11:53:21', 'Metrocentro', 104, 1, '6312-4784', 'RODRIGO ANTONIO REGALADO RIVAS', 'Bimbo', 'VEINTICINCO DOLARES ', '0', '25', '235.25', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', 'VISION SENCILLA', '', 'ANTIRREFLEJANTE 1', '', '2021-01-25', 'RODRIGO ANTONIO REGALADO RIVAS'),
(418, 'RME-46', 'AVME-3', '210.00', '02-02-2021 13:27:52', 'Metrocentro', 141, 1, '7896-1447', 'CARMEN ARELY VASQUEZ MARTINEZ', '', 'VEINTICINCO DOLARES ', '0', '25', '185.00', 'Efectivo', 'PENGUIN', 'THE QUIN', '15616145', 'VISIÓN SENCILLA BLANCO CR', 'ar 1', '', '', '2021-02-10', 'MAURICIO FLORES'),
(419, 'RME-47', 'AVME-4', '210.25', '02-02-2021 14:33:12', 'Metrocentro', 133, 1, '0000-0000', 'IRIS DEL CARMEN ENRRUIQUEZ', 'ECOFIBRAS S.A DE C.V', 'VEINTICINCO DOLARES ', '0', '25', '185.25', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', 'VISION SENCILLA BLU CAP', '', 'ANTIRREFLEJANTE 1', '', '2021-02-10', 'IRIS DEL CARMEN ENRRUIQUEZ'),
(420, 'RME-48', 'AVME-5', '210.25', '08-02-2021 16:07:13', 'Metrocentro', 117, 1, '7400-0002', 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON', 'CAJAS PLEGADIZAS S.A DE C.V', 'VEINTICINCO DOLARES ', '0', '25', '185.25', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', 'LENTE VISION SENCILLA BLU', 'antirreflejante 2', '', '', '2021-02-15', 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON'),
(421, 'RME-49', 'AVME-9', '100.25', '15-02-2021 11:18:50', 'Metrocentro', 126, 1, '', 'CLAUDIA MARISOL CORVERA', '', 'CIEN DOLARES CON VEINTICINCO CENTAVOS ', '0', '100.25', '0.00', 'Efectivo', 'RAY -BAN', '58169', 'C2', 'LENTE #5', '', '', '', '', 'CLAUDIA MARISOL CORVERA'),
(422, 'RME-50', 'AVME-8', '125.25', '15-02-2021 13:54:35', 'Metrocentro', 117, 1, '7400-0002', 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON', 'CAJAS PLEGADIZAS S.A DE C.V', 'CIENTO VEINTICINCO DOLARES CON VEINTICINCO CENTAVOS ', '0', '125.25', '0.00', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', 'LENTE VISION SENCILLA BLU', '', '', '', '', 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON'),
(423, 'RME-51', 'AVME-17', '225.25', '15-02-2021 13:58:36', 'Metrocentro', 114, 1, '2125-5555', 'ROSA EVELYN PERAZA', 'ECOFIBRAS S.A DE C.V', 'DOSCIENTOS VEINTICINCO DOLARES CON VEINTICINCO CENTAVOS ', '0', '225.25', '0.00', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', 'LENTE: LENTE VISION SENCI', 'LENTE: LENTE VISION SENCILLA BLU CAP', '', '', '', 'ROSA EVELYN PERAZA'),
(424, 'RME-52', 'AVME-6', '260.25', '15-02-2021 15:09:06', 'Metrocentro', 138, 1, '2222-2222', 'SANDRA GONZALEZ', 'MEDIDENT', 'DOSCIENTOS SESENTA DOLARES CON VEINTICINCO CENTAVOS ', '0', '260.25', '0.00', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', 'LENTE VISION SENCILLA BLU', '', 'ANTIRREFLEJANTE 1', '', '', 'SANDRA GONZALEZ'),
(425, 'RME-53', 'AVME-18', '100.00', '08-02-2021 13:58:12', 'Metrocentro', 142, 1, '2260-1650', 'CARMEN ALICIA MARQUEZ ROMERO', '', 'CINCUENTA DOLARES ', '0', '50', '50.00', 'Serfinsa', '', '', '', 'LENTE: LENTE VISION SENCI', 'LENTE: LENTE VISION SENCILLA BLU CAP', '', '', '2021-02-15', 'CARMEN ALICIA MARQUEZ ROMERO'),
(426, 'RME-54', 'AVME-20', '355.35', '11-02-2021 11:06:48', 'Metrocentro', 144, 1, '0000-0000', 'OSCAR DE FLORES', '', 'CIEN DOLARES ', '0', '100', '255.35', 'Efectivo', 'RAY -BAN', '58169', 'C2', 'LENTE: VISION AIRWERE BLU', 'LENTE: VISION AIRWERE BLUE', 'TRATAMIENTOS: ANTIRREFLEJANTE 1', '', '2021-02-18', 'OSCAR DE FLORES'),
(427, 'RME-55', 'AVME-20', '355.35', '11-02-2021 11:13:13', 'Metrocentro', 144, 1, '0000-0000', 'OSCAR DE FLORES', '', 'DOSCIENTOS CINCUENTA Y CINCO DOLARES CON TREINTA Y CINCO CENTAVOS ', '100', '255.35', '0.00', 'Efectivo', 'RAY -BAN', '58169', 'C2', 'LENTE: VISION AIRWERE BLU', 'LENTE: VISION AIRWERE BLUE', 'TRATAMIENTOS: ANTIRREFLEJANTE 1', '', '', 'OSCAR DE FLORES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referidos`
--

CREATE TABLE `referidos` (
  `id_ref` int(11) NOT NULL,
  `id_paciente_refiere` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_paciente_referido` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sucursal` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `referidos`
--

INSERT INTO `referidos` (`id_ref`, `id_paciente_refiere`, `id_paciente_referido`, `fecha`, `sucursal`) VALUES
(1, '66', '103', '26-10-2020 13:43:51', 'Metrocentro'),
(2, '66', '92', '26-10-2020 14:45:28', 'Metrocentro'),
(3, '97', '103', '26-10-2020 14:56:15', 'Metrocentro'),
(4, '97', '92', '26-10-2020 15:28:38', 'Metrocentro'),
(5, '101', '102', '26-10-2020 15:45:04', 'Metrocentro'),
(6, '97', '103', '26-10-2020 15:47:30', 'Metrocentro'),
(7, '102', '102', '26-10-2020 15:48:13', 'Metrocentro'),
(8, '97', '102', '26-10-2020 15:49:05', 'Metrocentro'),
(9, '97', '93', '26-10-2020 15:50:09', 'Metrocentro'),
(10, '94', '94', '27-10-2020 16:10:43', 'Metrocentro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisicion`
--

CREATE TABLE `requisicion` (
  `id_requisicion` int(11) NOT NULL,
  `n_requisicion` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `aprobado_por` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sucursal` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `requisicion`
--

INSERT INTO `requisicion` (`id_requisicion`, `n_requisicion`, `fecha`, `estado`, `usuario`, `aprobado_por`, `sucursal`) VALUES
(42, 'RQME-1', '10-12-2020 13:11:44', '3', 'oscar', 'oscar', 'Metrocentro'),
(43, 'RQME-2', '21-12-2020 16:30:51', '2', 'oscar', 'oscar', 'Metrocentro'),
(44, 'RQME-3', '21-12-2020 16:32:00', '3', 'oscar', 'oscar', 'Metrocentro'),
(45, 'RQME-4', '07-01-2021 11:14:10', '3', 'oscar', 'oscar', 'Metrocentro'),
(46, 'RQME-5', '07-01-2021 11:27:04', '3', 'oscar', 'oscar', 'Metrocentro'),
(47, 'RQME-6', '07-01-2021 11:37:45', '3', 'oscar', 'oscar', 'Metrocentro'),
(48, 'RQME-7', '07-01-2021 11:48:05', '3', 'oscar', 'oscar', 'Metrocentro'),
(49, 'RQME-8', '07-01-2021 11:53:15', '3', 'oscar', 'oscar', 'Metrocentro'),
(50, 'RQME-9', '07-01-2021 13:04:14', '3', 'oscar', 'oscar', 'Metrocentro'),
(51, 'RQME-10', '07-01-2021 13:15:57', '3', 'oscar', 'oscar', 'Metrocentro'),
(52, 'RQME-11', '07-01-2021 13:22:59', '3', 'oscar', 'oscar', 'Metrocentro'),
(53, 'RQME-12', '07-01-2021 13:29:11', '1', 'oscar', 'oscar', 'Metrocentro'),
(54, 'RQME-13', '07-01-2021 13:29:49', '3', 'oscar', 'oscar', 'Metrocentro'),
(55, 'RQME-14', '07-01-2021 13:41:05', '3', 'oscar', 'oscar', 'Metrocentro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traslados`
--

CREATE TABLE `traslados` (
  `id_traslado` int(11) NOT NULL,
  `num_traslado` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_traslado` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sucursal` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `traslados`
--

INSERT INTO `traslados` (`id_traslado`, `num_traslado`, `fecha`, `tipo_traslado`, `sucursal`, `id_usuario`) VALUES
(11, 'TME-2', '07-11-2020 08:18:44', 'interno', 'Metrocentro', 1),
(12, 'TME-3', '07-11-2020 08:28:38', 'interno', 'Metrocentro', 1),
(13, 'TME-4', '07-11-2020 08:29:12', 'interno', 'Metrocentro', 1),
(14, 'TME-5', '07-11-2020 08:30:26', 'interno', 'Metrocentro', 1),
(15, 'TME-6', '07-11-2020 08:42:48', 'interno', 'Metrocentro', 1),
(16, 'TME-7', '22-11-2020 13:24:59', 'interno', 'Metrocentro', 1),
(17, 'TME-8', '10-12-2020 09:24:56', 'interno', 'Metrocentro', 1),
(18, 'TME-9', '10-12-2020 10:11:35', 'interno', 'Metrocentro', 1),
(19, 'TME-10', '10-12-2020 10:15:31', 'interno', 'Metrocentro', 1),
(20, 'TME-11', '10-12-2020 10:22:08', 'interno', 'Metrocentro', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_ingreso` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoria` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sucursal` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `id_user_emp` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombres`, `telefono`, `correo`, `direccion`, `usuario`, `password`, `fecha_ingreso`, `categoria`, `estado`, `sucursal`, `id_user_emp`) VALUES
(1, 'Oscar Antonio Gonzalez', '222888', 'oscar@gmail.com', 'San Salavdor', 'oscar', '12345', '0000', 'administrador', '1', 'Metrocentro', 'AV-1'),
(2, 'Jackeline Molina', '0000', '000', 'ss', 'jacky', 'jack963', '0000', 'administrador', '1', 'San Miguel', 'AV-2'),
(3, 'CARLOS ANDRES VASQUEZ', '00000000000', NULL, 'San Salvador', 'andvas', 'and20vas08', NULL, 'Administrador', '1', 'Metrocentro', 'AV-3'),
(17, 'CLAUDIA ROJAS', '2585-8255', 'ss', 'SS', 'edgar', '12345', ' 26-11-2020 15:52:54', 'optometra', '1', 'Metrocentro', 'AV-4'),
(18, 'CAROLINA SANCHEZ', '0000-0000', '..', 'SS', 'oscar', '12345', ' 26-11-2020 16:18:48', 'administrador', '1', 'Metrocentro', 'AV-5'),
(19, 'CARMEN ARELY FLORES', '0000-0000', '', 'SAN MIGUEL', 'carmen', '54128', ' 27-11-2020 18:31:24', 'administrador', '1', 'Metrocentro', 'AV-6'),
(20, 'CLARA YAMILETH ROJAS', '6312-4784', '', 'SAN MIGUEL', 'clara', '12345', ' 27-11-2020 18:42:18', 'optometra', '1', 'San Miguel', 'AV-7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `id_usuario_permiso` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_permiso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`id_usuario_permiso`, `id_usuario`, `id_permiso`) VALUES
(1, 8, 1),
(2, 8, 2),
(3, 8, 4),
(4, 9, 1),
(5, 9, 6),
(6, 10, 1),
(7, 10, 2),
(8, 10, 3),
(9, 10, 6),
(10, 11, 1),
(11, 11, 6),
(12, 12, 1),
(13, 12, 6),
(17, 13, 1),
(18, 13, 4),
(19, 13, 6),
(20, 14, 1),
(21, 14, 6),
(22, 15, 1),
(23, 15, 6),
(24, 16, 1),
(25, 16, 6),
(34, 20, 1),
(35, 20, 2),
(36, 18, 5),
(37, 18, 6),
(81, 19, 1),
(82, 19, 2),
(83, 19, 3),
(84, 19, 4),
(85, 19, 5),
(86, 19, 6),
(87, 19, 7),
(88, 17, 1),
(89, 17, 3),
(90, 17, 6),
(91, 17, 7),
(105, 1, 1),
(106, 1, 2),
(107, 1, 3),
(108, 1, 4),
(109, 1, 5),
(110, 1, 6),
(111, 1, 7),
(112, 1, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `utilidades`
--

CREATE TABLE `utilidades` (
  `id_utilidad` int(11) NOT NULL,
  `costo` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio_venta` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descuento` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio_final` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `sucursal` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `n_venta` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_ventas` int(11) NOT NULL,
  `fecha_venta` varchar(25) NOT NULL,
  `numero_venta` varchar(100) NOT NULL,
  `paciente` varchar(100) NOT NULL,
  `vendedor` varchar(100) NOT NULL,
  `monto_total` varchar(10) DEFAULT NULL,
  `tipo_pago` varchar(100) NOT NULL,
  `tipo_venta` varchar(100) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `sucursal` varchar(100) NOT NULL,
  `evaluado` varchar(200) DEFAULT NULL,
  `optometra` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_ventas`, `fecha_venta`, `numero_venta`, `paciente`, `vendedor`, `monto_total`, `tipo_pago`, `tipo_venta`, `id_usuario`, `id_paciente`, `sucursal`, `evaluado`, `optometra`) VALUES
(565, '03-02-2021 17:04:16', 'AVME-1', 'ROSA EVELYN PERAZA', '1', '177.25', 'Contado', 'Contado', 1, 114, 'Metrocentro', 'ROSA EVELYN PERAZA', '1'),
(566, '03-02-2021 17:05:32', 'AVME-2', 'CLAUDIA MARISOL CORVERA', '1', '235.25', 'Contado', 'Contado', 1, 126, 'Metrocentro', 'CLAUDIA MARISOL CORVERA', '1'),
(567, '03-02-2021 17:06:35', 'AVME-3', 'LUCIANA MICHELLE RAMIREZ ', '1', '237.25', 'Contado', 'Contado', 1, 139, 'Metrocentro', 'CARLA LOPEZ', '1'),
(568, '03-02-2021 17:07:41', 'AVME-4', 'CARMEN ARELY VASQUEZ MARTINEZ', '1', '287.25', 'Contado', 'Contado', 1, 141, 'Metrocentro', 'CARMEN ARELY VASQUEZ MARTINEZ', '1'),
(569, '08-02-2021 16:07:13', 'AVME-5', 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON', '1', '210.25', 'Contado', 'Contado', 1, 117, 'Metrocentro', 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON', '1'),
(570, '08-02-2021', 'AVME-6', 'SANDRA GONZALEZ', '1', '260.25', 'Descuento en Planilla', 'Credito', 1, 138, 'Metrocentro', 'SANDRA GONZALEZ', '1'),
(571, '14-02-2021 15:59:56', 'AVME-7', 'SANDRA GONZALEZ', '1', '125.25', 'Cargo Automatico', 'Credito', 1, 138, 'Metrocentro', 'SANDRA GONZALEZ', '1'),
(572, '14-02-2021 16:03:31', 'AVME-8', 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON', '1', '125.25', 'Cargo Automatico', 'Credito', 1, 117, 'Metrocentro', 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON', '1'),
(573, '14-02-2021 16:05:55', 'AVME-9', 'CLAUDIA MARISOL CORVERA', '1', '100.25', 'Contado', 'Contado', 1, 126, 'Metrocentro', 'CLAUDIA MARISOL CORVERA', '1'),
(574, '15-02-2021 12:04:47', 'AVME-10', 'CARMEN ARELY VASQUEZ MARTINEZ', '1', '75.25', 'Contado', 'Contado', 1, 141, 'Metrocentro', '', ''),
(575, '15-02-2021 12:13:20', 'AVME-11', 'CLAUDIA MARISOL CORVERA', '1', '75.25', 'Contado', 'Contado', 1, 126, 'Metrocentro', 'CLAUDIA MARISOL CORVERA', '1'),
(576, '15-02-2021 12:32:58', 'AVME-12', 'LUCIANA MICHELLE RAMIREZ ', '1', '227.25', 'Contado', 'Contado', 1, 139, 'Metrocentro', 'CARLA LOPEZ', '1'),
(577, '15-02-2021 12:34:48', 'AVME-13', 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON', '1', '275.25', 'Contado', 'Contado', 1, 117, 'Metrocentro', 'TOMAS ALEJANDRO ENRRIQUEZ SERBELLON', '1'),
(578, '15-02-2021 12:41:07', 'AVME-14', 'LUCIANA MICHELLE RAMIREZ ', '1', '175.25', 'Cargo Automatico', 'Credito', 1, 139, 'Metrocentro', 'CARLA LOPEZ', '1'),
(579, '15-02-2021', 'AVME-15', 'CARMEN ARELY VASQUEZ MARTINEZ', '1', '225.25', 'Descuento en Planilla', 'Credito', 1, 141, 'Metrocentro', 'CARMEN ARELY VASQUEZ MARTINEZ', '1'),
(580, '15-02-2021 13:53:28', 'AVME-16', 'CLAUDIA MARISOL CORVERA', '1', '202.25', 'Contado', 'Contado', 1, 126, 'Metrocentro', 'CLAUDIA MARISOL CORVERA', '1'),
(581, '15-02-2021 13:58:36', 'AVME-17', 'ROSA EVELYN PERAZA', '1', '225.25', 'Contado', 'Contado', 1, 114, 'Metrocentro', 'ROSA EVELYN PERAZA', '1'),
(582, '08-02-2021 13:58:12', 'AVME-18', 'CARMEN ALICIA MARQUEZ ROMERO', '1', '100.00', 'Contado', 'Contado', 1, 142, 'Metrocentro', 'CARMEN ALICIA MARQUEZ ROMERO', '1'),
(583, '09-02-2021 15:02:41', 'AVME-19', 'CARMEN ALICIA MARQUEZ ROMERO', '1', '151.02', 'Contado', 'Contado', 1, 142, 'Metrocentro', 'CARMEN ALICIA MARQUEZ ROMERO', '1'),
(584, '11-02-2021 11:06:48', 'AVME-20', 'OSCAR DE FLORES', '1', '355.35', 'Efectivo', 'Contado', 1, 144, 'Metrocentro', 'OSCAR DE FLORES', '1'),
(585, '11-02-2021 15:03:14', 'AVME-21', 'BETANIA MEJIA', '1', '305.67', 'Contado', 'Contado', 1, 143, 'Metrocentro', 'ALISSON MEJIA', '1'),
(586, '11-02-2021 15:09:31', 'AVME-22', 'NASIF HANDAL', '1', '172.35', 'Contado', 'Contado', 1, 120, 'Metrocentro', 'NASIF HANDAL', '1'),
(587, '12-02-2021 06:18:07', 'AVME-23', 'NASIF HANDAL', '1', '202.00', 'Contado', 'Contado', 1, 120, 'Metrocentro', 'NASIF HANDAL', '1'),
(588, '13-02-2021 09:51:55', 'AVME-24', 'OSCAR DE FLORES', '1', '77.00', 'Contado', 'Contado', 1, 144, 'Metrocentro', 'OSCAR DE FLORES', '1'),
(589, '13-02-2021 14:30:14', 'AVME-25', 'LUCIANA MICHELLE RAMIREZ ', '1', '160.00', 'Contado', 'Contado', 1, 139, 'Metrocentro', 'CARLA LOPEZ', '1'),
(590, '13-02-2021 14:59:44', 'AVME-26', 'JOSE RONALD FUENTES', '1', '173.50', 'Contado', 'Contado', 1, 145, 'Metrocentro', 'JOSE RONALD FUENTES', '1'),
(591, '14-02-2021 10:00:46', 'AVME-27', 'ALCLEISDER JAIMES', '1', '234.48', 'Contado', 'Contado', 1, 146, 'Metrocentro', 'ALCLEISDER JAIMES', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_flotantes`
--

CREATE TABLE `ventas_flotantes` (
  `id_venta_flotante` int(11) NOT NULL,
  `numero_orden` varchar(25) DEFAULT NULL,
  `fecha_venta` varchar(25) DEFAULT NULL,
  `numero_venta` varchar(100) DEFAULT NULL,
  `paciente` varchar(100) DEFAULT NULL,
  `vendedor` varchar(100) DEFAULT NULL,
  `monto_total` varchar(10) DEFAULT NULL,
  `tipo_pago` varchar(100) DEFAULT NULL,
  `tipo_venta` varchar(100) DEFAULT NULL,
  `id_usuario` varchar(11) DEFAULT NULL,
  `id_paciente` varchar(11) DEFAULT NULL,
  `sucursal` varchar(100) DEFAULT NULL,
  `evaluado` varchar(200) DEFAULT NULL,
  `optometra` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas_flotantes`
--

INSERT INTO `ventas_flotantes` (`id_venta_flotante`, `numero_orden`, `fecha_venta`, `numero_venta`, `paciente`, `vendedor`, `monto_total`, `tipo_pago`, `tipo_venta`, `id_usuario`, `id_paciente`, `sucursal`, `evaluado`, `optometra`) VALUES
(75, 'OME-1', '02-02-2021 12:41:19', 'AVME-2', 'LUCIANA MICHELLE RAMIREZ ', '1', '225.25', 'Descuento en Planilla', 'Credito', '1', '139', 'Metrocentro', 'LUCIANA MICHELLE RAMIREZ ', '1'),
(76, 'OME-2', '08-02-2021 16:09:28', 'AVME-6', 'SANDRA GONZALEZ', '1', '260.25', 'Descuento en Planilla', 'Credito', '1', '138', 'Metrocentro', 'SANDRA GONZALEZ', '1'),
(77, 'OME-3', '15-02-2021 12:49:44', 'AVME-15', 'CARMEN ARELY VASQUEZ MARTINEZ', '1', '225.25', 'Descuento en Planilla', 'Credito', '1', '141', 'Metrocentro', 'CARMEN ARELY VASQUEZ MARTINEZ', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD PRIMARY KEY (`id_abono`),
  ADD KEY `fk_abonos_pacientes_idx` (`id_paciente`),
  ADD KEY `fk_abonos_usuarios_idx` (`id_usuario`);

--
-- Indices de la tabla `acciones_ordenes_lab`
--
ALTER TABLE `acciones_ordenes_lab`
  ADD PRIMARY KEY (`id_accion`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `caja_chica`
--
ALTER TABLE `caja_chica`
  ADD PRIMARY KEY (`id_caja`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`);

--
-- Indices de la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`id_consulta`);

--
-- Indices de la tabla `control_calidad_orden`
--
ALTER TABLE `control_calidad_orden`
  ADD PRIMARY KEY (`id_revision`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `correlativo_factura`
--
ALTER TABLE `correlativo_factura`
  ADD PRIMARY KEY (`id_correlativo`);

--
-- Indices de la tabla `corte_diario`
--
ALTER TABLE `corte_diario`
  ADD PRIMARY KEY (`id_ingreso`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD PRIMARY KEY (`id_credito`),
  ADD KEY `fk_creditos_pacientes` (`id_paciente`),
  ADD KEY `fk_creditos_usuarios` (`id_usuario`);

--
-- Indices de la tabla `detalle_ccf_laboratorios`
--
ALTER TABLE `detalle_ccf_laboratorios`
  ADD PRIMARY KEY (`id_ccf`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_envio` (`id_envio`);

--
-- Indices de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD PRIMARY KEY (`id_detalle_compra`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `detalle_ingresos`
--
ALTER TABLE `detalle_ingresos`
  ADD PRIMARY KEY (`id_detalle_ingreso`);

--
-- Indices de la tabla `detalle_requisicion`
--
ALTER TABLE `detalle_requisicion`
  ADD PRIMARY KEY (`id_detalle_req`);

--
-- Indices de la tabla `detalle_traslados`
--
ALTER TABLE `detalle_traslados`
  ADD PRIMARY KEY (`id_detalle_traslados`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id_detalle_ventas`),
  ADD KEY `fk_detalle_ventas_producto_idx` (`id_producto`),
  ADD KEY `fk_detalle_ventas_usuario_idx` (`id_usuario`),
  ADD KEY `fk_detalle_ventas_clientes_idx` (`id_paciente`);

--
-- Indices de la tabla `detalle_ventas_flotantes`
--
ALTER TABLE `detalle_ventas_flotantes`
  ADD PRIMARY KEY (`id_detalle_venta_flotante`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `envios_lab`
--
ALTER TABLE `envios_lab`
  ADD PRIMARY KEY (`id_envio`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_consulta` (`id_consulta`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `existencias`
--
ALTER TABLE `existencias`
  ADD PRIMARY KEY (`id_ingreso`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id_ingresos`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `movimientos_caja`
--
ALTER TABLE `movimientos_caja`
  ADD PRIMARY KEY (`id_mov_caja`);

--
-- Indices de la tabla `orden_credito`
--
ALTER TABLE `orden_credito`
  ADD PRIMARY KEY (`id_orden`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `recibos`
--
ALTER TABLE `recibos`
  ADD PRIMARY KEY (`id_recibo`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `referidos`
--
ALTER TABLE `referidos`
  ADD PRIMARY KEY (`id_ref`);

--
-- Indices de la tabla `requisicion`
--
ALTER TABLE `requisicion`
  ADD PRIMARY KEY (`id_requisicion`);

--
-- Indices de la tabla `traslados`
--
ALTER TABLE `traslados`
  ADD PRIMARY KEY (`id_traslado`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`id_usuario_permiso`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- Indices de la tabla `utilidades`
--
ALTER TABLE `utilidades`
  ADD PRIMARY KEY (`id_utilidad`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_ventas`),
  ADD KEY `fk_ventas_usuarios_idx` (`id_usuario`),
  ADD KEY `fk_ventas_pacientes_idx` (`id_paciente`);

--
-- Indices de la tabla `ventas_flotantes`
--
ALTER TABLE `ventas_flotantes`
  ADD PRIMARY KEY (`id_venta_flotante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonos`
--
ALTER TABLE `abonos`
  MODIFY `id_abono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;

--
-- AUTO_INCREMENT de la tabla `acciones_ordenes_lab`
--
ALTER TABLE `acciones_ordenes_lab`
  MODIFY `id_accion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT de la tabla `caja_chica`
--
ALTER TABLE `caja_chica`
  MODIFY `id_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `consulta`
--
ALTER TABLE `consulta`
  MODIFY `id_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=510;

--
-- AUTO_INCREMENT de la tabla `control_calidad_orden`
--
ALTER TABLE `control_calidad_orden`
  MODIFY `id_revision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `correlativo_factura`
--
ALTER TABLE `correlativo_factura`
  MODIFY `id_correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `corte_diario`
--
ALTER TABLE `corte_diario`
  MODIFY `id_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=368;

--
-- AUTO_INCREMENT de la tabla `creditos`
--
ALTER TABLE `creditos`
  MODIFY `id_credito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=590;

--
-- AUTO_INCREMENT de la tabla `detalle_ccf_laboratorios`
--
ALTER TABLE `detalle_ccf_laboratorios`
  MODIFY `id_ccf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  MODIFY `id_detalle_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT de la tabla `detalle_ingresos`
--
ALTER TABLE `detalle_ingresos`
  MODIFY `id_detalle_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT de la tabla `detalle_requisicion`
--
ALTER TABLE `detalle_requisicion`
  MODIFY `id_detalle_req` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `detalle_traslados`
--
ALTER TABLE `detalle_traslados`
  MODIFY `id_detalle_traslados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id_detalle_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1125;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas_flotantes`
--
ALTER TABLE `detalle_ventas_flotantes`
  MODIFY `id_detalle_venta_flotante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `envios_lab`
--
ALTER TABLE `envios_lab`
  MODIFY `id_envio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `existencias`
--
ALTER TABLE `existencias`
  MODIFY `id_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id_ingresos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `movimientos_caja`
--
ALTER TABLE `movimientos_caja`
  MODIFY `id_mov_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `orden_credito`
--
ALTER TABLE `orden_credito`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `recibos`
--
ALTER TABLE `recibos`
  MODIFY `id_recibo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=428;

--
-- AUTO_INCREMENT de la tabla `referidos`
--
ALTER TABLE `referidos`
  MODIFY `id_ref` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `requisicion`
--
ALTER TABLE `requisicion`
  MODIFY `id_requisicion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `traslados`
--
ALTER TABLE `traslados`
  MODIFY `id_traslado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `id_usuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT de la tabla `utilidades`
--
ALTER TABLE `utilidades`
  MODIFY `id_utilidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=592;

--
-- AUTO_INCREMENT de la tabla `ventas_flotantes`
--
ALTER TABLE `ventas_flotantes`
  MODIFY `id_venta_flotante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD CONSTRAINT `fk_abonos_pacientes` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_abonos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `acciones_ordenes_lab`
--
ALTER TABLE `acciones_ordenes_lab`
  ADD CONSTRAINT `acciones_ordenes_lab_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`),
  ADD CONSTRAINT `acciones_ordenes_lab_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `control_calidad_orden`
--
ALTER TABLE `control_calidad_orden`
  ADD CONSTRAINT `control_calidad_orden_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`),
  ADD CONSTRAINT `control_calidad_orden_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `corte_diario`
--
ALTER TABLE `corte_diario`
  ADD CONSTRAINT `corte_diario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `corte_diario_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`);

--
-- Filtros para la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD CONSTRAINT `fk_creditos_pacientes` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_creditos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_ccf_laboratorios`
--
ALTER TABLE `detalle_ccf_laboratorios`
  ADD CONSTRAINT `detalle_ccf_laboratorios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `detalle_ccf_laboratorios_ibfk_2` FOREIGN KEY (`id_envio`) REFERENCES `envios_lab` (`id_envio`);

--
-- Filtros para la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD CONSTRAINT `detalle_compras_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `detalle_traslados`
--
ALTER TABLE `detalle_traslados`
  ADD CONSTRAINT `detalle_traslados_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `detalle_traslados_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `envios_lab`
--
ALTER TABLE `envios_lab`
  ADD CONSTRAINT `envios_lab_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`),
  ADD CONSTRAINT `envios_lab_ibfk_2` FOREIGN KEY (`id_consulta`) REFERENCES `consulta` (`id_consulta`),
  ADD CONSTRAINT `envios_lab_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `envios_lab_ibfk_4` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `envios_lab_ibfk_5` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `existencias`
--
ALTER TABLE `existencias`
  ADD CONSTRAINT `existencias_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `orden_credito`
--
ALTER TABLE `orden_credito`
  ADD CONSTRAINT `orden_credito_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`),
  ADD CONSTRAINT `orden_credito_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `recibos`
--
ALTER TABLE `recibos`
  ADD CONSTRAINT `recibos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `recibos_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`);

--
-- Filtros para la tabla `traslados`
--
ALTER TABLE `traslados`
  ADD CONSTRAINT `traslados_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `usuario_permiso_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `usuario_permiso_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`);

--
-- Filtros para la tabla `utilidades`
--
ALTER TABLE `utilidades`
  ADD CONSTRAINT `utilidades_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `utilidades_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
