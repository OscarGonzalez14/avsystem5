-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2020 a las 23:40:34
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
(365, '25', 'Efectivo', '12-12-2020 15:09:10', 115, 1, 'RME-12', 'AVME-20', 'Metrocentro');

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
(1, '16', 'Metrocentro'),
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
(69, 'C-69', 'P-01', 'Carlos Andres Vazquez Choto', 'Contado', 'Contado', '1', '10-12-2020 12:50:33', 'Factura', '25888', 'oscar', '70.00', '1', 'Metrocentro');

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
(44, '', '', 86, 1, '2020-10-01 18:05:23', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'NINGUNA', 'n', '', '', '', '', 'n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '01-10-2020 12:03:28', 'CRISTIAN RAMIREZ', '', '2563-5665'),
(45, '', '', 86, 1, '2020-10-03 16:32:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'd', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '03-10-2020 10:31:06', 'CRISTIAN RAMIREZ', 'FFF', '2563-5665'),
(46, '', '', 90, 1, '2020-10-03 17:12:18', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 's', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '03-10-2020 11:12:00', 'S REYESANTOS', '', ''),
(47, '', '', 75, 1, '2020-10-03 18:26:28', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'c', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '03-10-2020 12:25:51', 'SONIA DAYSI MENA DURAN', '', '6312-4784'),
(48, '', '', 91, 1, '2020-10-04 22:02:50', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'NINGUNA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '04-10-2020 16:02:40', 'CARILONA SANCHEZ', '', ''),
(49, '', '', 92, 1, '2020-10-05 20:35:43', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'NINGUNA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '05-10-2020 14:35:30', 'ERICKA DIAZ', '', ''),
(50, '', '', 93, 1, '2020-10-07 22:11:15', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'NINGUNA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '07-10-2020 16:11:07', 'GENERICO', '', ''),
(51, '', '', 94, 1, '2020-10-12 22:14:42', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'NINGUNA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '12-10-2020 16:14:34', 'LISETH LEMUS', '', ''),
(52, '', '', 102, 1, '2020-10-13 17:19:13', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'NINGUNA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '13-10-2020 11:19:00', 'ANA GUADALUPE ROJAS', '', ''),
(53, '', '', 103, 1, '2020-10-19 19:51:16', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '-', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '25', '12.5 mm', '12.5 mm', '', '', '', '', '19-10-2020 13:50:26', 'LISETH LEMUS', '', ''),
(54, '', '', 104, 1, '2020-11-10 16:27:52', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'NINGUNA', '', '', '', '', '', '0.58', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '10-11-2020 10:27:26', 'RODRIGO ANTONIO REGALADO RIVAS', '', '6312-4784'),
(55, '', '', 114, 1, '2020-11-25 16:52:30', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'NINGUNA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '25-11-2020 10:51:49', 'ROSA EVELYN PERAZA', '', '2125-5555'),
(56, 'ardor de ojos', '', 115, 1, '2020-11-25 18:15:40', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 's', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '25-11-2020 12:15:18', 'ANA JULIETA HERNANDEZ', '', '2555-5555'),
(57, '', '', 116, 1, '2020-11-21 17:23:17', '', '', '', '', '', '', '', '', '', '', '', '00', '', '', '', '', '', '', '', '', '', '', '', 'NINGUNA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '21-11-2020 11:22:53', 'LUIS ALBERTO MARTINEZ', '', '6312-4784');

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
(221, '29-11-2020 13:20:16', '', 'AVME-5', '', 'ANA JULIETA HERNANDEZ', '1', '120.00', '', '', '120.00', 'Contado', 'Efectivo', 1, '0', '0', 115, 'Metrocentro', '', 'Venta'),
(222, '29-11-2020 13:21:25', 'RME-5', 'AVME-6', '', 'ROSA EVELYN PERAZA', '1', '120.00', 'Davivienda', '12.69', '107.31', 'Contado', 'Tarjeta de Credito', 1, '0', '0', 114, 'Metrocentro', 'Metrocentro', 'Venta'),
(223, '29-11-2020 14:39:57', 'RME-6', 'AVME-6', '', 'ROSA EVELYN PERAZA', '1', '120.00', 'Davivienda', '12.96', '94.35', 'Contado', 'Tarjeta de Credito', 1, '12.69', '2', 114, 'Metrocentro', 'Metrocentro', 'Recuperado'),
(224, '29-11-2020 14:46:01', 'RME-7', 'AVME-3', '', 'CAJAS PLEGADIZAS S.A DE C.V', '1', '120.00', 'Davivienda', '40.00', '40.00', 'Credito', 'Descuento en Planilla', 1, '40', '2', 112, 'Metrocentro', 'Metrocentro', 'Recuperado'),
(225, '30-11-2020 16:12:22', '', 'AVME-7', '', 'ANA JULIETA HERNANDEZ', '1', '90.00', '', '', '90.00', 'Contado', 'Contado', 1, '0', '0', 115, 'Metrocentro', '', 'Venta'),
(226, '07-12-2020 13:53:25', 'RME-8', 'AVME-8', '', 'ROSA EVELYN PERAZA', '1', '190.00', 'Efectivo', '25', '165.00', 'Contado', 'Contado', 1, '0', '0', 114, 'Metrocentro', 'Metrocentro', 'Venta'),
(227, '07-12-2020 14:38:13', 'RME-9', 'AVME-9', '', 'LUIS ALBERTO MARTINEZ', '1', '240.00', 'Efectivo', '30', '210.00', 'Contado', 'Contado', 1, '0', '0', 116, 'Metrocentro', 'Metrocentro', 'Venta'),
(228, '07-12-2020 14:39:26', 'RME-10', 'AVME-10', '', 'RODRIGO ANTONIO REGALADO RIVAS', '1', '335.00', 'Cuscatlan', '111.67', '223.33', 'Credito', 'Cargo Automatico', 1, '0', '0', 104, 'Metrocentro', 'Metrocentro', 'Venta'),
(229, '09-12-2020 09:46:13', '', 'AVME-11', '', 'ANA JULIETA HERNANDEZ', '1', '150.00', '', '', '150.00', 'Contado', 'Efectivo', 1, '0', '0', 115, 'Metrocentro', '', 'Venta'),
(230, '09-12-2020 11:04:17', '', 'AVME-12', '', 'LUIS ALBERTO MARTINEZ', '1', '90.00', '', '', '90.00', 'Contado', 'Efectivo', 1, '0', '0', 116, 'Metrocentro', '', 'Venta'),
(231, '09-12-2020 11:14:48', '', 'AVME-13', '', 'ANA JULIETA HERNANDEZ', '1', '150.00', '', '', '150.00', 'Contado', 'Contado', 1, '0', '0', 115, 'Metrocentro', '', 'Venta'),
(232, '09-12-2020 11:16:17', '', 'AVME-14', '', 'ANA JULIETA HERNANDEZ', '1', '290.00', '', '', '290.00', 'Contado', 'Efectivo', 1, '0', '0', 115, 'Metrocentro', '', 'Venta'),
(233, '09-12-2020 11:20:04', '', 'AVME-15', '', 'ROSA EVELYN PERAZA', '1', '250.00', '', '', '250.00', 'Contado', 'Contado', 1, '0', '0', 114, 'Metrocentro', '', 'Venta'),
(234, '09-12-2020 11:36:57', '', 'AVME-16', '', 'LUIS ALBERTO MARTINEZ', '1', '240.00', '', '', '240.00', 'Contado', 'Efectivo', 1, '0', '0', 116, 'Metrocentro', '', 'Venta'),
(235, '10-12-2020 13:16:20', 'RME-11', 'AVME-9', '', 'LUIS ALBERTO MARTINEZ', '1', '240.00', 'Efectivo', '10', '200.00', 'Contado', 'Contado', 1, '30', '2', 116, 'Metrocentro', 'Metrocentro', 'Recuperado'),
(240, '12-12-2020 15:09:10', 'RME-12', 'AVME-20', '', 'ANA JULIETA HERNANDEZ', '1', '220.00', 'Efectivo', '25', '195.00', 'Contado', 'Contado', 1, '0', '0', 115, 'Metrocentro', 'Metrocentro', 'Venta'),
(241, '12-12-2020 15:12:01', '', 'AVME-21', '', 'NASIF HANDAL', '1', '90.00', '', '', '90.00', 'Credito', 'Cargo Automatico', 1, '0', '0', 120, 'Metrocentro', '', 'Venta'),
(242, '12-12-2020 15:19:41', '', 'AVME-22', '', 'RODRIGO ANTONIO REGALADO RIVAS', '1', '240.00', '', '', '240.00', 'Credito', 'Descuento en Planilla', 1, '0', '0', 104, 'Metrocentro', '', 'Venta'),
(243, '12-12-2020 16:30:12', '', 'AVME-23', '', 'ANA JULIETA HERNANDEZ', '1', '150.00', '', '', '150.00', 'Contado', 'Contado', 1, '0', '0', 115, 'Metrocentro', '', 'Venta');

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
(443, 'Contado', '86.00', '0', '86.00', 'Contado', 'AVSM-1', 123, 1, '24-11-2020 16:40:23'),
(444, 'Credito', '80.00', '10', '80.00', 'Cargo Automatico', 'AVSM-2', 123, 1, '28-11-2020 15:13:57'),
(445, 'Contado', '98.00', '0', '98.00', 'Contado', 'AVSM-3', 122, 1, '28-11-2020 16:08:05'),
(446, 'Credito', '110.00', '3', '110.00', 'Cargo Automatico', 'AVSM-4', 121, 1, '29-11-2020 11:53:30'),
(447, 'Credito', '90.00', '5', '54', 'Cargo Automatico', 'AVME-1', 119, 1, '29-11-2020 12:02:36'),
(448, 'Contado', '120.00', '0', '95', 'Contado', 'AVME-2', 114, 1, '29-11-2020 12:07:02'),
(449, 'Credito', '120.00', '3', '40', 'Descuento en Planilla', 'AVME-3', 112, 1, '29-11-2020 13:08:48'),
(450, 'Contado', '120.00', '5', '120.00', 'Contado', 'AVME-4', 114, 1, '29-11-2020 13:15:08'),
(451, 'Contado', '120.00', '', '120.00', 'Efectivo', 'AVME-5', 115, 1, '29-11-2020 13:20:16'),
(452, 'Contado', '120.00', '', '94.35', 'Tarjeta de Credito', 'AVME-6', 114, 1, '29-11-2020 13:21:25'),
(453, 'Contado', '90.00', '0', '90.00', 'Contado', 'AVME-7', 115, 1, '30-11-2020 16:12:22'),
(454, 'Contado', '190.00', '0', '165', 'Contado', 'AVME-8', 114, 1, '07-12-2020 13:53:25'),
(455, 'Contado', '240.00', '0', '200', 'Contado', 'AVME-9', 116, 1, '07-12-2020 14:38:13'),
(456, 'Credito', '335.00', '3', '223.33', 'Cargo Automatico', 'AVME-10', 104, 1, '07-12-2020 14:39:26'),
(457, 'Contado', '150.00', '', '150.00', 'Efectivo', 'AVME-11', 115, 1, '09-12-2020 09:46:13'),
(458, 'Contado', '90.00', '', '90.00', 'Efectivo', 'AVME-12', 116, 1, '09-12-2020 11:04:17'),
(459, 'Contado', '150.00', '0', '150.00', 'Contado', 'AVME-13', 115, 1, '09-12-2020 11:14:48'),
(460, 'Contado', '290.00', '', '290.00', 'Efectivo', 'AVME-14', 115, 1, '09-12-2020 11:16:17'),
(461, 'Contado', '250.00', '0', '250.00', 'Contado', 'AVME-15', 114, 1, '09-12-2020 11:20:04'),
(462, 'Contado', '240.00', '', '240.00', 'Efectivo', 'AVME-16', 116, 1, '09-12-2020 11:36:57'),
(466, 'Contado', '220.00', '0', '195', 'Contado', 'AVME-20', 115, 1, '12-12-2020 15:09:10'),
(467, 'Credito', '90.00', '7', '90.00', 'Cargo Automatico', 'AVME-21', 120, 1, '12-12-2020 15:12:01'),
(468, 'Credito', '240.00', '8', '240.00', 'Descuento en Planilla', 'AVME-22', 104, 1, '12-12-2020 15:19:41'),
(469, 'Contado', '150.00', '0', '150.00', 'Contado', 'AVME-23', 115, 1, '12-12-2020 16:30:12');

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
(311, 'C-69', 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '4', '5', '12', '20', '0', 'oscar', 47, '10-12-2020 12:50:33', '3');

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
(218, 'RAY BAN 2584 ESTUCHE RAYBAN COLOR CAFÉ  ', '1', 'Metrocentro', 'GAVETA #20', 'oscar', '10-12-2020 12:53:15', 'C-69', '12', 'I-84');

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
(84, 'RQME-1', 'paquete de platos', '1', '2', 'oscar', 'Metrocentro', 'Si', '5555');

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
(797, 'AVSM-1', 75, 'PENGUIN mod.THE QUIN 53-20-143 15616145', '86.00', '1', '0', '86', '24-11-2020 16:40:23', 1, 123, ''),
(798, 'AVSM-2', 57, 'TORY BURCH mod.T455 12-48-555 C7', '80.00', '1', '0', '80', '28-11-2020 15:13:57', 1, 123, ''),
(799, 'AVSM-3', 37, 'RAY -BAN mod.58169 15-15-154 C2', '78.00', '1', '0', '78', '28-11-2020 16:08:05', 1, 122, ''),
(800, 'AVSM-4', 37, 'RAY -BAN mod.58169 15-15-154 C2', '110.00', '1', '0', '110', '29-11-2020 11:53:30', 1, 121, ''),
(801, 'AVME-1', 57, 'TORY BURCH mod.T455 12-48-555 C7', '90.00', '1', '0', '90', '29-11-2020 12:02:36', 1, 119, ''),
(802, 'AVME-2', 35, 'RAY BAN mod.RB0055 23-44-44 C3', '120.00', '1', '0', '120', '29-11-2020 12:07:02', 1, 114, ''),
(803, 'AVME-3', 35, 'RAY BAN mod.RB0055 23-44-44 C3', '120.00', '1', '0', '120', '29-11-2020 13:08:48', 1, 112, ''),
(804, 'AVME-4', 35, 'RAY BAN mod.RB0055 23-44-44 C3', '120.00', '1', '0', '120', '29-11-2020 13:15:08', 1, 114, 'ROSA EVELYN PERAZA'),
(805, 'AVME-5', 35, 'RAY BAN mod.RB0055 23-44-44 C3', '120.00', '1', '0', '120', '29-11-2020 13:20:16', 1, 115, ''),
(806, 'AVME-6', 35, 'RAY BAN mod.RB0055 23-44-44 C3', '120.00', '1', '0', '120', '29-11-2020 13:21:25', 1, 114, 'ROSA EVELYN PERAZA'),
(807, 'AVME-7', 57, 'TORY BURCH mod.T455 12-48-555 C7', '90.00', '1', '0', '90', '30-11-2020 16:12:22', 1, 115, 'ANA JULIETA HERNANDEZ'),
(808, 'AVME-8', 57, 'TORY BURCH mod.T455 12-48-555 C7', '90.00', '1', '0', '90', '07-12-2020 13:53:25', 1, 114, 'ROSA EVELYN PERAZA'),
(809, 'AVME-9', 57, 'TORY BURCH mod.T455 12-48-555 C7', '90.00', '1', '0', '90', '07-12-2020 14:38:13', 1, 116, 'LUIS ALBERTO MARTINEZ'),
(810, 'AVME-10', 37, 'RAY -BAN mod.58169 15-15-154 C2', '150.00', '1', '0', '150', '07-12-2020 14:39:26', 1, 104, 'RODRIGO ANTONIO REGALADO RIVAS'),
(811, 'AVME-11', 37, 'RAY -BAN mod.58169 15-15-154 C2', '150.00', '1', '0', '150', '09-12-2020 09:46:13', 1, 115, 'ANA JULIETA HERNANDEZ'),
(812, 'AVME-12', 57, 'TORY BURCH mod.T455 12-48-555 C7', '90.00', '1', '0', '90', '09-12-2020 11:04:17', 1, 116, 'LUIS ALBERTO MARTINEZ'),
(813, 'AVME-13', 57, 'TORY BURCH mod.T455 12-48-555 C7', '90.00', '1', '0', '90', '09-12-2020 11:14:48', 1, 115, 'ANA JULIETA HERNANDEZ'),
(814, 'AVME-14', 57, 'TORY BURCH mod.T455 12-48-555 C7', '90.00', '1', '0', '90', '09-12-2020 11:16:17', 1, 115, 'ANA JULIETA HERNANDEZ'),
(815, 'AVME-16', 57, 'TORY BURCH mod.T455 12-48-555 C7', '90.00', '1', '0', '90', '09-12-2020 11:36:57', 1, 116, 'LUIS ALBERTO MARTINEZ'),
(816, 'AVME-16', 56, 'VISION SENCILLA CR39 PHOTOCROMATICO AR', '150', '1', '0', '150', '09-12-2020 11:36:57', 1, 116, 'LUIS ALBERTO MARTINEZ'),
(817, 'AVME-17', 57, 'TORY BURCH mod.T455 12-48-555 C7', '90.00', '1', '0', '90', '12-12-2020 14:33:19', 5, 116, 'LUIS ALBERTO MARTINEZ'),
(818, 'AVME-18', 57, 'TORY BURCH mod.T455 12-48-555 C7', '90.00', '1', '0', '90', '12-12-2020 14:36:44', 5, 114, 'ROSA EVELYN PERAZA'),
(819, 'AVME-18', 36, 'VISION SENCILLA', '100', '1', '0', '100', '12-12-2020 14:36:44', 5, 114, 'ROSA EVELYN PERAZA'),
(820, 'AVME-19', 57, 'TORY BURCH mod.T455 12-48-555 C7', '100.00', '1', '0', '100', '12-12-2020 14:59:56', 5, 116, 'LUIS ALBERTO MARTINEZ'),
(821, 'AVME-19', 36, 'VISION SENCILLA', '100', '1', '0', '100', '12-12-2020 14:59:56', 5, 116, 'LUIS ALBERTO MARTINEZ'),
(822, 'AVME-20', 35, 'RAY BAN mod.RB0055 23-44-44 C3', '120.00', '1', '0', '120', '12-12-2020 15:09:10', 1, 115, 'ANA JULIETA HERNANDEZ'),
(823, 'AVME-20', 36, 'VISION SENCILLA', '100', '1', '0', '100', '12-12-2020 15:09:10', 1, 115, 'ANA JULIETA HERNANDEZ'),
(824, 'AVME-21', 57, 'TORY BURCH mod.T455 12-48-555 C7', '90.00', '1', '0', '90', '12-12-2020 15:12:01', 1, 120, ''),
(825, 'AVME-22', 57, 'TORY BURCH mod.T455 12-48-555 C7', '90.00', '1', '0', '90', '12-12-2020 15:19:41', 1, 104, 'RODRIGO ANTONIO REGALADO RIVAS'),
(826, 'AVME-22', 56, 'VISION SENCILLA CR39 PHOTOCROMATICO AR', '150', '1', '0', '150', '12-12-2020 15:19:41', 1, 104, 'RODRIGO ANTONIO REGALADO RIVAS'),
(827, 'AVME-23', 57, 'TORY BURCH mod.T455 12-48-555 C7', '90.00', '1', '0', '90', '12-12-2020 16:30:12', 1, 115, 'ANA JULIETA HERNANDEZ'),
(828, 'AVME-23', 53, 'VISIÓN SENCILLA BLANCO CR39', '60', '1', '0', '60', '12-12-2020 16:30:12', 1, 115, 'ANA JULIETA HERNANDEZ'),
(829, 'AVME-23', 63, 'DD', '0', '1', '0', '0', '12-12-2020 16:30:12', 1, 115, 'ANA JULIETA HERNANDEZ');

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
(10, 'ECOFIBRAS S.A DE C.V', 'C. ANTIGUA AL MATAZANO AL COSTADO SUR DE LA COL. SANTA LUCIA EDIF. 1 ILOPANGO SAN SALVADOR', '0614-240907-104-0', '', '', '', '', '182157-2', 'FABRICACION DE PRODUCTOS DIVERSOS DE PAPEL Y CARTÓN');

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
  `precio_venta` varchar(8) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `existencias`
--

INSERT INTO `existencias` (`id_ingreso`, `id_producto`, `stock`, `bodega`, `categoria_ub`, `fecha_ingreso`, `usuario`, `num_compra`, `precio_venta`) VALUES
(156, 64, '0', 'Metrocentro', 'GAVETA#10', '06-11-2020 14:02:01', 'oscar', 'C-50', '10'),
(157, 57, '0', 'Metrocentro', 'GAVETA#10', '06-11-2020 14:02:01', 'oscar', 'C-50', '100'),
(158, 47, '0', 'Metrocentro', 'GAVETA#10', '06-11-2020 14:02:01', 'oscar', 'C-50', '40'),
(159, 37, '0', 'Metrocentro', 'GAVETA#10', '06-11-2020 14:02:01', 'oscar', 'C-50', '110'),
(160, 35, '0', 'Metrocentro', 'GAVETA#10', '06-11-2020 14:02:01', 'oscar', 'C-50', '120'),
(161, 47, '0', 'Metrocentro', 'MALETA#1', '06-11-2020 15:09:40', '1', 'C-50', '40'),
(162, 47, '0', 'Metrocentro', 'MU#3', '06-11-2020 15:18:16', '1', 'C-50', '40'),
(163, 57, '0', 'Metrocentro', 'MU#3', '06-11-2020 15:50:01', '1', 'C-50', '100'),
(164, 57, '-1', 'Metrocentro', 'MU#3', '06-11-2020 17:24:33', '1', 'C-50', '100'),
(165, 47, '0', 'Metrocentro', 'GAVETA 2', '06-11-2020 17:25:49', '1', 'C-50', '40'),
(166, 57, '0', 'Metrocentro', 'GAVETA1 ', '07-11-2020 08:18:44', '1', 'C-50', '100'),
(167, 57, '0', 'Metrocentro', 'GAVETA#10', '07-11-2020 08:18:44', '1', 'C-50', '100'),
(168, 57, '0', 'Metrocentro', 'GAVETA 2', '07-11-2020 08:18:44', '1', 'C-50', '100'),
(169, 37, '0', 'Metrocentro', 'MU#3', '07-11-2020 08:28:38', '1', 'C-50', '110'),
(170, 47, '0', 'Metrocentro', 'GAVETA1 ', '07-11-2020 08:29:12', '1', 'C-50', '40'),
(171, 35, '0', 'Metrocentro', 'GAVETA 2', '07-11-2020 08:29:12', '1', 'C-50', '120'),
(172, 47, '0', 'Metrocentro', 'GAVETA1 ', '07-11-2020 08:30:26', '1', 'C-50', '40'),
(173, 57, '0', 'Metrocentro', 'GAVETA 2', '07-11-2020 08:30:26', '1', 'C-50', '100'),
(174, 47, '0', 'Metrocentro', 'GAVETA#10', '07-11-2020 08:30:26', '1', 'C-50', '40'),
(175, 57, '0', 'Metrocentro', 'MU#3', '07-11-2020 08:30:26', '1', 'C-50', '100'),
(176, 35, '0', 'Metrocentro', 'MALETA#1', '07-11-2020 08:30:26', '1', 'C-50', '120'),
(177, 57, '0', 'Metrocentro', 'GAVETA 2', '07-11-2020 08:42:48', '1', 'C-50', '100'),
(178, 57, '0', 'Metrocentro', 'GAVETA 2', '07-11-2020 08:42:48', '1', 'C-50', '100'),
(179, 62, '0', 'Metrocentro', 'GAVETA1 ', '10-11-2020 10:22:36', 'oscar', 'C-51', '20'),
(180, 57, '0', 'Metrocentro', 'GAVETA1 ', '10-11-2020 10:22:36', 'oscar', 'C-51', '50'),
(181, 37, '0', 'Metrocentro', 'GAVETA1 ', '10-11-2020 10:22:36', 'oscar', 'C-51', '40'),
(182, 62, '7', 'Metrocentro', 'GAVETA 2', '16-11-2020 15:45:18', 'oscar', 'C-52', '20'),
(183, 57, '0', 'Metrocentro', 'GAVETA 2', '16-11-2020 15:45:18', 'oscar', 'C-52', '20'),
(184, 65, '0', 'Metrocentro', 'GAVETA1 ', '17-11-2020 11:53:05', 'oscar', 'C-53', '1.769'),
(185, 65, '0', 'Metrocentro', 'GAVETA1 ', '17-11-2020 12:16:33', 'oscar', 'C-54', '1.769'),
(186, 66, '0', 'Metrocentro', 'GAVETA1 ', '17-11-2020 12:16:33', 'oscar', 'C-54', '4.424'),
(187, 67, '0', 'Metrocentro', 'GAVETA1 ', '17-11-2020 12:16:33', 'oscar', 'C-54', '4.424'),
(188, 68, '0', 'Metrocentro', 'GAVETA1 ', '17-11-2020 12:16:33', 'oscar', 'C-54', '2.212'),
(189, 69, '0', 'Metrocentro', 'GAVETA1 ', '17-11-2020 12:16:33', 'oscar', 'C-54', '4.424'),
(190, 70, '0', 'Metrocentro', 'GAVETA1 ', '17-11-2020 12:16:33', 'oscar', 'C-54', '1.327'),
(191, 71, '0', 'Metrocentro', 'GAVETA1 ', '17-11-2020 12:16:33', 'oscar', 'C-54', '7.964'),
(192, 65, '-37', 'Metrocentro', 'GAVETA1 ', '17-11-2020 15:17:14', 'oscar', 'C-55', '1.769'),
(193, 66, '-115', 'Metrocentro', 'GAVETA1 ', '17-11-2020 15:17:14', 'oscar', 'C-55', '4.424'),
(194, 67, '172', 'Metrocentro', 'GAVETA1 ', '17-11-2020 15:17:14', 'oscar', 'C-55', '4.424'),
(195, 68, '-10', 'Metrocentro', 'GAVETA1 ', '17-11-2020 15:17:14', 'oscar', 'C-55', '2.212'),
(196, 69, '-23', 'Metrocentro', 'GAVETA1 ', '17-11-2020 15:17:14', 'oscar', 'C-55', '4.424'),
(197, 70, '-28', 'Metrocentro', 'GAVETA1 ', '17-11-2020 15:17:14', 'oscar', 'C-55', '1.327'),
(198, 71, '367', 'Metrocentro', 'GAVETA1 ', '17-11-2020 15:17:14', 'oscar', 'C-55', '7.964'),
(199, 66, '31', 'Metrocentro', 'GAVETA1 ', '17-11-2020 16:39:58', 'oscar', 'C-56', '1.77'),
(200, 73, '-13', 'Metrocentro', 'GAVETA1 ', '17-11-2020 16:46:26', 'oscar', 'C-57', '4.42'),
(201, 72, '-13', 'Metrocentro', 'GAVETA1 ', '17-11-2020 16:46:26', 'oscar', 'C-57', '2.21'),
(202, 70, '-152', 'Metrocentro', 'GAVETA 2', '17-11-2020 16:52:52', 'oscar', 'C-59', '1.33'),
(203, 63, '6', 'Metrocentro', 'GAVETA#10', '18-11-2020 10:42:45', 'oscar', 'C-60', '5'),
(204, 57, '0', 'Metrocentro', 'GAVETA#10', '18-11-2020 10:42:45', 'oscar', 'C-60', '50'),
(205, 35, '0', 'Metrocentro', 'GAVETA#10', '18-11-2020 10:42:45', 'oscar', 'C-60', '70'),
(206, 72, '-160', 'Metrocentro', 'GAVETA 2', '18-11-2020 14:23:56', 'oscar', 'C-61', '2.212'),
(207, 57, '10', 'Metrocentro', 'GAVETA1 ', '21-11-2020 16:46:54', 'oscar', 'C-62', '90'),
(208, 37, '19', 'Metrocentro', 'GAVETA1 ', '21-11-2020 16:46:54', 'oscar', 'C-62', '150'),
(209, 35, '17', 'Metrocentro', 'GAVETA1 ', '21-11-2020 16:46:54', 'oscar', 'C-62', '120'),
(210, 35, '0', 'Metrocentro', 'GAVETA 2', '22-11-2020 13:24:59', '1', 'C-62', '120'),
(211, 57, '0', 'San Miguel', 'EXHIBICION 8', '24-11-2020 12:15:54', 'oscar', 'C-63', '100'),
(212, 37, '0', 'San Miguel', 'EXHIBICION 8', '24-11-2020 12:15:54', 'oscar', 'C-63', '150'),
(213, 35, '0', 'San Miguel', 'EXHIBICION 8', '24-11-2020 12:15:54', 'oscar', 'C-63', '120'),
(214, 58, '16', 'San Miguel', 'EXHIBICION 8', '24-11-2020 13:54:32', 'jacky', 'C-64', '10'),
(215, 57, '25', 'San Miguel', 'EXHIBICION 8', '24-11-2020 13:54:32', 'jacky', 'C-64', '80'),
(216, 48, '14', 'San Miguel', 'EXHIBICION 8', '24-11-2020 13:54:32', 'jacky', 'C-64', '20'),
(217, 37, '37', 'San Miguel', 'EXHIBICION 8', '24-11-2020 13:54:32', 'jacky', 'C-64', '110'),
(218, 35, '34', 'San Miguel', 'EXHIBICION 8', '24-11-2020 13:54:32', 'jacky', 'C-64', '90'),
(219, 75, '4', 'San Miguel', 'EXHIBICION 8', '24-11-2020 16:26:38', 'oscar', 'C-65', '86'),
(220, 74, '5', 'San Miguel', 'EXHIBICION 8', '24-11-2020 16:26:38', 'oscar', 'C-65', '50'),
(221, 48, '1', 'San Miguel', 'EXHIBICION 8', '28-11-2020 16:03:10', 'oscar', 'C-66', '5'),
(222, 37, '0', 'San Miguel', 'EXHIBICION 8', '28-11-2020 16:03:10', 'oscar', 'C-66', '78'),
(223, 63, '1', 'Metrocentro', 'MU#3', '10-12-2020 10:22:08', '1', 'C-60', '5'),
(224, 59, '1', 'Metrocentro', 'GAVETA #20', '10-12-2020 12:53:15', 'oscar', 'C-69', '10'),
(225, 57, '0', 'Metrocentro', 'GAVETA #20', '10-12-2020 12:53:15', 'oscar', 'C-69', '100'),
(226, 47, '1', 'Metrocentro', 'GAVETA #20', '10-12-2020 12:53:15', 'oscar', 'C-69', '12');

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
(84, 'I-84', 'oscar', '10-12-2020 12:53:15', 'Metrocentro');

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
(15, 'PENGUIN');

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
  `saldo_ini` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `sobrante` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `sucursal` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `movimientos_caja`
--

INSERT INTO `movimientos_caja` (`id_mov_caja`, `tipo_mov`, `usuario`, `monto`, `fecha`, `observaciones`, `saldo_ini`, `sobrante`, `sucursal`) VALUES
(2, 'Egreso', 'oscar', '5.00', '10-12-2020', '0', '21', '16', 'Metrocentro');

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
(120, 'AVME-17', 'NASIF HANDAL', '', '25', '', 'Metrocentro', '', '', '23-11-2020 14:44:38', 'oscar', '', '', '', '', 'Sucursal', '23-11-1995'),
(121, 'AVSM-1', 'LILIANA ABIGAIL CRUZ SALAMANCA', '', '13', '', 'San Miguel', '00027223-3', '', '24-11-2020 12:11:12', 'oscar', '', '', '', '', 'Sucursal', '24-11-2007'),
(122, 'AVSM-2', 'ERICK OSWALDO SORIANO ', '6312-4784', '58', '', 'San Miguel', '00027223-0', '', '24-11-2020 13:15:04', 'jacky', 'ECOFIBRAS S.A DE C.V', '', '2265-8666', 'SAN SALVADOR', 'Desc_planilla', '24-11-1962'),
(123, 'AVSM-3', 'CARLOS ANTONIO RIVERA', '', '25', '', 'San Miguel', '', '', '24-11-2020 13:46:14', 'jacky', '', '', '', '', 'Sucursal', '24-11-1995');

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
(7, 'Caja Chica');

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
(36, '0', '0', '0', '0', '0', '0', '100', 'lentes', 'VISION SENCILLA'),
(37, 'RAY -BAN', '58169', 'C2', '15-15-154', 'Completo', 'Acetato', 'Premium', 'aros', 'RAY -BAN mod.58169 15-15-154 C2'),
(47, 'RAY BAN', '2584', '0', '0', '0', '0', 'Estuche', 'accesorios', 'ESTUCHE RAYBAN COLOR CAFÉ'),
(48, 'RAY BAN', 'FRA 1', '0', '0', '0', '0', 'Estuche', 'accesorios', 'FRANELA RAYBAN'),
(49, '0', '0', '0', '0', '0', '0', '100', 'antireflejante', 'ar 1'),
(50, '0', '0', '0', '0', '0', '0', '85', 'antireflejante', 'antirreflejante 2'),
(51, '0', '0', '0', '0', '0', '0', '85', 'photosensible', 'ANTIRREFLEJANTE 1'),
(53, '0', '0', '0', '0', '0', '0', '60', 'lentes', 'VISIÓN SENCILLA BLANCO CR39'),
(54, '0', '0', '0', '0', '0', '0', '50', 'antireflejante', 'AR SUPERHIDROFOBICO ADD PROMO'),
(55, '0', '0', '0', '0', '0', '0', '50', 'photosensible', 'TRANSITIONS GEN 8 CAFE'),
(56, '0', '0', '0', '0', '0', '0', '150', 'lentes', 'VISION SENCILLA CR39 PHOTOCROMATICO AR'),
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
(75, 'PENGUIN', 'THE QUIN', '15616145', '53-20-143', 'Completo', 'Metal/Acetato', 'Intermedio', 'aros', 'PENGUIN mod.THE QUIN 53-20-143 15616145');

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
(377, 'RME-12', 'AVME-20', '220.00', '12-12-2020 15:09:10', 'Metrocentro', 115, 1, '2555-5555', 'ANA JULIETA HERNANDEZ', 'CELPAC, S.A. DE C.V.', 'VEINTICINCO DOLARES ', '0', '25', '195.00', 'Efectivo', 'RAY BAN', 'RB0055', 'C3', 'VISION SENCILLA', '', '', '', '2020-12-19', 'ANA JULIETA HERNANDEZ');

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
(42, 'RQME-1', '10-12-2020 13:11:44', '3', 'oscar', 'oscar', 'Metrocentro');

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
(111, 1, 7);

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
  `id_producto` int(11) DEFAULT NULL
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
(441, '24-11-2020 16:40:23', 'AVSM-1', 'CARLOS ANTONIO RIVERA', '1', '86.00', 'Contado', 'Contado', 1, 123, 'San Miguel', '', ''),
(442, '28-11-2020 15:13:57', 'AVSM-2', 'CARLOS ANTONIO RIVERA', '1', '80.00', 'Cargo Automatico', 'Credito', 1, 123, 'San Miguel', '', ''),
(443, '28-11-2020 16:08:05', 'AVSM-3', 'ERICK OSWALDO SORIANO ', '1', '98.00', 'Contado', 'Contado', 1, 122, 'San Miguel', '', ''),
(444, '29-11-2020 11:53:30', 'AVSM-4', 'LILIANA ABIGAIL CRUZ SALAMANCA', '1', '110.00', 'Cargo Automatico', 'Credito', 1, 121, 'San Miguel', '', ''),
(445, '29-11-2020 12:02:36', 'AVME-1', 'CARLOS ANTONIO RIVAS', '1', '90.00', 'Cargo Automatico', 'Credito', 1, 119, 'Metrocentro', '', ''),
(446, '29-11-2020 12:07:02', 'AVME-2', 'ROSA EVELYN PERAZA', '1', '120.00', 'Contado', 'Contado', 1, 114, 'Metrocentro', '', ''),
(447, '29-11-2020 13:08:48', 'AVME-3', 'CAJAS PLEGADIZAS S.A DE C.V', '1', '120.00', 'Descuento en Planilla', 'Credito', 1, 112, 'Metrocentro', '', ''),
(448, '29-11-2020 13:15:08', 'AVME-4', 'ROSA EVELYN PERAZA', '1', '120.00', 'Contado', 'Contado', 1, 114, 'Metrocentro', 'ROSA EVELYN PERAZA', '1'),
(449, '29-11-2020 13:20:16', 'AVME-5', 'ANA JULIETA HERNANDEZ', '1', '120.00', 'Efectivo', 'Contado', 1, 115, 'Metrocentro', '', ''),
(450, '29-11-2020 13:21:25', 'AVME-6', 'ROSA EVELYN PERAZA', '1', '120.00', 'Tarjeta de Credito', 'Contado', 1, 114, 'Metrocentro', 'ROSA EVELYN PERAZA', '1'),
(451, '30-11-2020 16:12:22', 'AVME-7', 'ANA JULIETA HERNANDEZ', '1', '90.00', 'Contado', 'Contado', 1, 115, 'Metrocentro', 'ANA JULIETA HERNANDEZ', '1'),
(452, '07-12-2020 13:53:25', 'AVME-8', 'ROSA EVELYN PERAZA', '1', '190.00', 'Contado', 'Contado', 1, 114, 'Metrocentro', 'ROSA EVELYN PERAZA', '1'),
(453, '07-12-2020 14:38:13', 'AVME-9', 'LUIS ALBERTO MARTINEZ', '1', '240.00', 'Contado', 'Contado', 1, 116, 'Metrocentro', 'LUIS ALBERTO MARTINEZ', '1'),
(454, '07-12-2020 14:39:26', 'AVME-10', 'RODRIGO ANTONIO REGALADO RIVAS', '1', '335.00', 'Cargo Automatico', 'Credito', 1, 104, 'Metrocentro', 'RODRIGO ANTONIO REGALADO RIVAS', '1'),
(455, '09-12-2020 09:46:13', 'AVME-11', 'ANA JULIETA HERNANDEZ', '1', '150.00', 'Efectivo', 'Contado', 1, 115, 'Metrocentro', 'ANA JULIETA HERNANDEZ', '1'),
(456, '09-12-2020 11:04:17', 'AVME-12', 'LUIS ALBERTO MARTINEZ', '1', '90.00', 'Efectivo', 'Contado', 1, 116, 'Metrocentro', 'LUIS ALBERTO MARTINEZ', '1'),
(457, '09-12-2020 11:14:48', 'AVME-13', 'ANA JULIETA HERNANDEZ', '1', '150.00', 'Contado', 'Contado', 1, 115, 'Metrocentro', 'ANA JULIETA HERNANDEZ', '1'),
(458, '09-12-2020 11:16:17', 'AVME-14', 'ANA JULIETA HERNANDEZ', '1', '290.00', 'Efectivo', 'Contado', 1, 115, 'Metrocentro', 'ANA JULIETA HERNANDEZ', '1'),
(459, '09-12-2020 11:20:04', 'AVME-15', 'ROSA EVELYN PERAZA', '1', '250.00', 'Contado', 'Contado', 1, 114, 'Metrocentro', 'ROSA EVELYN PERAZA', '1'),
(460, '09-12-2020 11:36:57', 'AVME-16', 'LUIS ALBERTO MARTINEZ', '1', '240.00', 'Efectivo', 'Contado', 1, 116, 'Metrocentro', 'LUIS ALBERTO MARTINEZ', '1'),
(461, '12-12-2020 14:33:19', 'AVME-17', 'LUIS ALBERTO MARTINEZ', '5', '90.00', 'Efectivo', 'Contado', 5, 116, 'Metrocentro', 'LUIS ALBERTO MARTINEZ', '1'),
(462, '12-12-2020 14:36:44', 'AVME-18', 'ROSA EVELYN PERAZA', '5', '190.00', 'Contado', 'Contado', 5, 114, 'Metrocentro', 'ROSA EVELYN PERAZA', '1'),
(463, '12-12-2020 14:59:56', 'AVME-19', 'LUIS ALBERTO MARTINEZ', '5', '200.00', 'Efectivo', 'Contado', 5, 116, 'Metrocentro', 'LUIS ALBERTO MARTINEZ', '1'),
(464, '12-12-2020 15:09:10', 'AVME-20', 'ANA JULIETA HERNANDEZ', '1', '220.00', 'Contado', 'Contado', 1, 115, 'Metrocentro', 'ANA JULIETA HERNANDEZ', '1'),
(465, '12-12-2020 15:12:01', 'AVME-21', 'NASIF HANDAL', '1', '90.00', 'Cargo Automatico', 'Credito', 1, 120, 'Metrocentro', '', ''),
(466, '12-12-2020 15:19:41', 'AVME-22', 'RODRIGO ANTONIO REGALADO RIVAS', '1', '240.00', 'Descuento en Planilla', 'Credito', 1, 104, 'Metrocentro', 'RODRIGO ANTONIO REGALADO RIVAS', '1'),
(467, '12-12-2020 16:30:12', 'AVME-23', 'ANA JULIETA HERNANDEZ', '1', '150.00', 'Contado', 'Contado', 1, 115, 'Metrocentro', 'ANA JULIETA HERNANDEZ', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_flotantes`
--

CREATE TABLE `ventas_flotantes` (
  `id_flot` int(11) NOT NULL,
  `tipo_venta` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `correlativo` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sucursal` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `categoria_prod` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_ingreso` varchar(4) COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoria_ub` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `num_compra` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero_venta` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`);

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
  ADD KEY `id_producto` (`id_producto`);

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
  ADD PRIMARY KEY (`id_flot`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonos`
--
ALTER TABLE `abonos`
  MODIFY `id_abono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=366;

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
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `consulta`
--
ALTER TABLE `consulta`
  MODIFY `id_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `corte_diario`
--
ALTER TABLE `corte_diario`
  MODIFY `id_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT de la tabla `creditos`
--
ALTER TABLE `creditos`
  MODIFY `id_credito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=470;

--
-- AUTO_INCREMENT de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  MODIFY `id_detalle_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;

--
-- AUTO_INCREMENT de la tabla `detalle_ingresos`
--
ALTER TABLE `detalle_ingresos`
  MODIFY `id_detalle_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT de la tabla `detalle_requisicion`
--
ALTER TABLE `detalle_requisicion`
  MODIFY `id_detalle_req` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `detalle_traslados`
--
ALTER TABLE `detalle_traslados`
  MODIFY `id_detalle_traslados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id_detalle_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=830;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `existencias`
--
ALTER TABLE `existencias`
  MODIFY `id_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id_ingresos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `movimientos_caja`
--
ALTER TABLE `movimientos_caja`
  MODIFY `id_mov_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `recibos`
--
ALTER TABLE `recibos`
  MODIFY `id_recibo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=378;

--
-- AUTO_INCREMENT de la tabla `referidos`
--
ALTER TABLE `referidos`
  MODIFY `id_ref` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `requisicion`
--
ALTER TABLE `requisicion`
  MODIFY `id_requisicion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
  MODIFY `id_usuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de la tabla `utilidades`
--
ALTER TABLE `utilidades`
  MODIFY `id_utilidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=468;

--
-- AUTO_INCREMENT de la tabla `ventas_flotantes`
--
ALTER TABLE `ventas_flotantes`
  MODIFY `id_flot` int(11) NOT NULL AUTO_INCREMENT;

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
-- Filtros para la tabla `existencias`
--
ALTER TABLE `existencias`
  ADD CONSTRAINT `existencias_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `movimientos_caja`
--
ALTER TABLE `movimientos_caja`
  ADD CONSTRAINT `movimientos_caja_ibfk_1` FOREIGN KEY (`id_mov_caja`) REFERENCES `caja_chica` (`id_caja`);

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
  ADD CONSTRAINT `utilidades_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `ventas_flotantes`
--
ALTER TABLE `ventas_flotantes`
  ADD CONSTRAINT `ventas_flotantes_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `ventas_flotantes_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`),
  ADD CONSTRAINT `ventas_flotantes_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
