-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-09-2022 a las 03:19:13
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `testsisas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `afiliacion`
--

CREATE TABLE `afiliacion` (
  `ID_AFIL` int(11) NOT NULL,
  `ID_MAS` int(11) NOT NULL,
  `FCHINI_AFIL` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `ID_EST` int(11) NOT NULL,
  `NOM_EST` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`ID_EST`, `NOM_EST`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Sano'),
(4, 'Enfermo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `ID_MAS` int(11) NOT NULL,
  `ID_TMAS` int(11) NOT NULL,
  `ID_USU` int(11) NOT NULL,
  `NOM_MAS` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `COLOR_MAS` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `RAZA_MAS` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `AFIL_MAS` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `ID_MED` int(11) NOT NULL,
  `NOMMED_MED` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibosmed`
--

CREATE TABLE `recibosmed` (
  `ID_RMED` int(11) NOT NULL,
  `ID_MED` int(11) NOT NULL,
  `ID_VIS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomascota`
--

CREATE TABLE `tipomascota` (
  `ID_TMAS` int(11) NOT NULL,
  `TIPO_TMAS` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `ID_TUSU` int(11) NOT NULL,
  `USER_TUSU` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`ID_TUSU`, `USER_TUSU`) VALUES
(1, 'Administrador'),
(2, 'Veterinario'),
(3, 'Duenio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_USU` int(11) NOT NULL,
  `ID_TUSU` int(11) NOT NULL,
  `ID_EST` int(11) NOT NULL,
  `IDENT_USU` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `PNOMBRE_USU` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `SNOMBRE_USU` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `APELLIDOP_USU` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOM_USU` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `DIRECCION_USU` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `TELEFONO_USU` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `CORREO_USU` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `TPROF_USU` int(11) DEFAULT NULL,
  `PASSWD_USU` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `ALIAS_USU` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_USU`, `ID_TUSU`, `ID_EST`, `IDENT_USU`, `PNOMBRE_USU`, `SNOMBRE_USU`, `APELLIDOP_USU`, `APELLIDOM_USU`, `DIRECCION_USU`, `TELEFONO_USU`, `CORREO_USU`, `TPROF_USU`, `PASSWD_USU`, `ALIAS_USU`) VALUES
(1, 1, 1, '9999999999', 'Admin', 'Admin', 'Admin', 'Admin', 'Admin', 'Admin', 'admin@admin.com', 0, '1234', 'admin'),
(2, 2, 1, '10101010', 'Vet', 'Vet', 'Vet', 'Vet', 'Vet', 'Vet', 'vet@vet.com', 98765, '5678', 'vet'),
(3, 3, 1, '20202020', 'duenio', 'duenio', 'duenio', 'duenio', 'duenio', 'duenio', 'duenio@duenio.com', 0, '112233', 'duenio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita`
--

CREATE TABLE `visita` (
  `ID_VIS` int(11) NOT NULL,
  `ID_USU` int(11) NOT NULL,
  `ID_MAS` int(11) NOT NULL,
  `ID_EST` int(11) NOT NULL,
  `FECHA_VIS` date NOT NULL,
  `HORA_VIS` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `TEMP_VIS` float NOT NULL,
  `PESO_VIS` float NOT NULL,
  `FRCAR_VIS` int(11) NOT NULL,
  `FRRES_VIS` int(11) NOT NULL,
  `ANIMO_VIS` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `RECOM_VIS` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `COSTO_VIS` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `DIAG_VIS` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `afiliacion`
--
ALTER TABLE `afiliacion`
  ADD PRIMARY KEY (`ID_AFIL`),
  ADD KEY `FK_TIENE` (`ID_MAS`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`ID_EST`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`ID_MAS`),
  ADD KEY `FK_PERTENECE` (`ID_TMAS`),
  ADD KEY `FK_POSEE` (`ID_USU`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`ID_MED`);

--
-- Indices de la tabla `recibosmed`
--
ALTER TABLE `recibosmed`
  ADD PRIMARY KEY (`ID_RMED`),
  ADD KEY `FK_ASIGNA` (`ID_VIS`),
  ADD KEY `FK_FORMULA` (`ID_MED`);

--
-- Indices de la tabla `tipomascota`
--
ALTER TABLE `tipomascota`
  ADD PRIMARY KEY (`ID_TMAS`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`ID_TUSU`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_USU`),
  ADD KEY `FK_PUEDE` (`ID_TUSU`),
  ADD KEY `FK_SITUACION` (`ID_EST`);

--
-- Indices de la tabla `visita`
--
ALTER TABLE `visita`
  ADD PRIMARY KEY (`ID_VIS`),
  ADD KEY `FK_ACOMPANIA` (`ID_USU`),
  ADD KEY `FK_ASISTE` (`ID_MAS`),
  ADD KEY `FK_SALUD` (`ID_EST`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `afiliacion`
--
ALTER TABLE `afiliacion`
  MODIFY `ID_AFIL` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `ID_EST` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `ID_MAS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `ID_MED` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recibosmed`
--
ALTER TABLE `recibosmed`
  MODIFY `ID_RMED` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipomascota`
--
ALTER TABLE `tipomascota`
  MODIFY `ID_TMAS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `ID_TUSU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_USU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `visita`
--
ALTER TABLE `visita`
  MODIFY `ID_VIS` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `afiliacion`
--
ALTER TABLE `afiliacion`
  ADD CONSTRAINT `FK_TIENE` FOREIGN KEY (`ID_MAS`) REFERENCES `mascota` (`ID_MAS`);

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `FK_PERTENECE` FOREIGN KEY (`ID_TMAS`) REFERENCES `tipomascota` (`ID_TMAS`),
  ADD CONSTRAINT `FK_POSEE` FOREIGN KEY (`ID_USU`) REFERENCES `usuario` (`ID_USU`);

--
-- Filtros para la tabla `recibosmed`
--
ALTER TABLE `recibosmed`
  ADD CONSTRAINT `FK_ASIGNA` FOREIGN KEY (`ID_VIS`) REFERENCES `visita` (`ID_VIS`),
  ADD CONSTRAINT `FK_FORMULA` FOREIGN KEY (`ID_MED`) REFERENCES `medicamentos` (`ID_MED`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_PUEDE` FOREIGN KEY (`ID_TUSU`) REFERENCES `tipousuario` (`ID_TUSU`),
  ADD CONSTRAINT `FK_SITUACION` FOREIGN KEY (`ID_EST`) REFERENCES `estados` (`ID_EST`);

--
-- Filtros para la tabla `visita`
--
ALTER TABLE `visita`
  ADD CONSTRAINT `FK_ACOMPANIA` FOREIGN KEY (`ID_USU`) REFERENCES `usuario` (`ID_USU`),
  ADD CONSTRAINT `FK_ASISTE` FOREIGN KEY (`ID_MAS`) REFERENCES `mascota` (`ID_MAS`),
  ADD CONSTRAINT `FK_SALUD` FOREIGN KEY (`ID_EST`) REFERENCES `estados` (`ID_EST`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
