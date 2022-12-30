-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2022 a las 03:52:29
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `argosysmarkt`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acd`
--

CREATE TABLE `acd` (
  `region` char(20) DEFAULT NULL,
  `pdv` char(10) DEFAULT NULL,
  `nombre` char(100) DEFAULT NULL,
  `entrega` char(20) DEFAULT NULL,
  `pdvsisact` char(100) DEFAULT NULL,
  `codpdv` char(10) DEFAULT NULL,
  `descripcion` char(100) DEFAULT NULL,
  `direccion` char(255) DEFAULT NULL,
  `distrito` char(50) DEFAULT NULL,
  `provincia` char(50) DEFAULT NULL,
  `departamento` char(50) DEFAULT NULL,
  `horario` char(100) DEFAULT NULL,
  `estado` char(15) DEFAULT NULL,
  `alta` datetime DEFAULT NULL,
  `baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cac`
--

CREATE TABLE `cac` (
  `region` char(15) DEFAULT NULL,
  `pdv` char(10) DEFAULT NULL,
  `nombre` char(50) DEFAULT NULL,
  `entrega` char(20) DEFAULT NULL,
  `direccion` char(255) DEFAULT NULL,
  `distrito` char(30) DEFAULT NULL,
  `provincia` char(20) DEFAULT NULL,
  `departamento` char(20) DEFAULT NULL,
  `horario` char(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cadena`
--

CREATE TABLE `cadena` (
  `region` char(15) DEFAULT NULL,
  `razonsocial` char(100) DEFAULT NULL,
  `codigointer` char(10) DEFAULT NULL,
  `codpdv` char(10) DEFAULT NULL,
  `pdvsisact` char(100) DEFAULT NULL,
  `entrega` char(20) DEFAULT NULL,
  `direccion` char(255) DEFAULT NULL,
  `distrito` char(50) DEFAULT NULL,
  `provincia` char(50) DEFAULT NULL,
  `departamento` char(50) DEFAULT NULL,
  `dias` char(50) DEFAULT NULL,
  `horario` char(100) DEFAULT NULL,
  `estado` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dac`
--

CREATE TABLE `dac` (
  `nombre` char(100) DEFAULT NULL,
  `distrito` char(30) DEFAULT NULL,
  `provincia` char(30) DEFAULT NULL,
  `departamento` char(30) DEFAULT NULL,
  `region` char(20) DEFAULT NULL,
  `direccion` char(255) DEFAULT NULL,
  `descripcion` char(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `landing`
--

CREATE TABLE `landing` (
  `documento` char(12) NOT NULL,
  `telefono` char(11) NOT NULL,
  `planes` char(25) NOT NULL,
  `fechaRegistro` datetime DEFAULT current_timestamp(),
  `estado` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `masiva`
--

CREATE TABLE `masiva` (
  `documento` char(12) NOT NULL,
  `nombre` char(50) NOT NULL,
  `tel_Fijo` char(10) NOT NULL,
  `celular` char(11) NOT NULL,
  `fechaActivacion` datetime NOT NULL DEFAULT current_timestamp(),
  `operador` char(10) NOT NULL,
  `tipo_plan` char(25) NOT NULL,
  `direccion` char(50) NOT NULL,
  `distrito` char(25) NOT NULL,
  `provincia` char(25) NOT NULL,
  `departamento` char(25) NOT NULL,
  `fechaRegistro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metas`
--

CREATE TABLE `metas` (
  `dniAsesor` char(8) NOT NULL,
  `portamenor69` char(3) NOT NULL,
  `portamayor69` char(3) NOT NULL,
  `altapost` char(3) NOT NULL,
  `altaprepa` char(3) NOT NULL,
  `portaprepa` char(3) NOT NULL,
  `renovacion` char(3) NOT NULL,
  `hfc_ftth` char(3) NOT NULL,
  `ifi` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `metas`
--

INSERT INTO `metas` (`dniAsesor`, `portamenor69`, `portamayor69`, `altapost`, `altaprepa`, `portaprepa`, `renovacion`, `hfc_ftth`, `ifi`) VALUES
('general', '30', '25', '10', '1', '1', '10', '10', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `region` char(10) DEFAULT NULL,
  `nombre` char(50) DEFAULT NULL,
  `centro` char(10) DEFAULT NULL,
  `almacen` char(10) DEFAULT NULL,
  `nombreAlmacen` char(50) DEFAULT NULL,
  `material` char(20) DEFAULT NULL,
  `descripcion` char(50) DEFAULT NULL,
  `libres` char(5) DEFAULT NULL,
  `bloqueados` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `dni` char(8) NOT NULL,
  `nombre` char(50) NOT NULL,
  `clave` char(40) NOT NULL,
  `tipo` char(1) NOT NULL,
  `fechaRegistro` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` char(1) NOT NULL DEFAULT '0',
  `fotoPerfil` char(100) NOT NULL DEFAULT 'default.png',
  `activo` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nombre`, `clave`, `tipo`, `fechaRegistro`, `estado`, `fotoPerfil`, `activo`) VALUES
('73179455', 'Christian Campaña', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1', '2022-12-14 18:36:45', '1', 'default.png', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `whatsapp`
--

CREATE TABLE `whatsapp` (
  `codigo` int(11) NOT NULL,
  `dniAsesor` char(8) NOT NULL,
  `nombre` char(50) NOT NULL,
  `dni` char(8) NOT NULL,
  `telefono` char(11) NOT NULL,
  `producto` char(1) NOT NULL,
  `lineaProcedente` char(8) NOT NULL,
  `operadorCedente` char(15) NOT NULL,
  `modalidad` char(1) NOT NULL,
  `tipo` char(1) NOT NULL,
  `planR` char(50) NOT NULL,
  `equipo` char(50) NOT NULL,
  `formaDePago` char(10) NOT NULL,
  `numeroReferencia` char(11) NOT NULL,
  `sec` char(15) DEFAULT NULL,
  `tipoFija` char(1) NOT NULL,
  `planFija` char(50) NOT NULL,
  `modoFija` char(4) NOT NULL,
  `estado` char(1) NOT NULL,
  `observaciones` varchar(300) NOT NULL,
  `promocion` char(50) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `distrito` char(25) NOT NULL,
  `fechaRegistro` datetime DEFAULT current_timestamp(),
  `fechaActualizacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `whatsapp`
--
ALTER TABLE `whatsapp`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `dniAsesor` (`dniAsesor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `whatsapp`
--
ALTER TABLE `whatsapp`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `whatsapp`
--
ALTER TABLE `whatsapp`
  ADD CONSTRAINT `whatsapp_ibfk_1` FOREIGN KEY (`dniAsesor`) REFERENCES `usuarios` (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
