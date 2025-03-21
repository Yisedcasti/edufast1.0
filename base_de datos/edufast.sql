-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-03-2025 a las 22:23:14
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
-- Base de datos: `edufast`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `id_actividad` int(11) NOT NULL,
  `nombre_act` char(100) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `logro_id_logro` int(11) NOT NULL,
  `logro_materia_id_materia` int(11) NOT NULL,
  `logro_materia_grado_id_grado` int(11) NOT NULL,
  `logro_materia_area_id_area` int(11) NOT NULL,
  `docente_id_docente` int(11) NOT NULL,
  `docente_cursos_id_cursos` int(11) NOT NULL,
  `docente_cursos_grado_id_grado` int(11) NOT NULL,
  `docente_registro_num_doc` int(11) NOT NULL,
  `docente_registro_rol_id_rol` int(11) NOT NULL,
  `docente_registro_jornada_id_jornada` int(11) NOT NULL,
  `materia_id_materia` int(11) NOT NULL,
  `materia_grado_id_grado` int(11) NOT NULL,
  `materia_area_id_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id_area` int(11) NOT NULL,
  `nombre_area` char(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id_area`, `nombre_area`) VALUES
(1, 'Lógico Creativo'),
(2, 'Ambiente Artístico'),
(3, 'Ambiente Integral'),
(4, 'Ambiente ético social'),
(5, 'Ambiente Técnico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `idAsistencia` int(11) NOT NULL,
  `fecha_asistencia` date DEFAULT NULL,
  `asistencia` char(10) DEFAULT NULL,
  `matricula_id_matricula` int(11) NOT NULL,
  `matricula_grado_id_grado` int(11) NOT NULL,
  `matricula_cursos_id_cursos` int(11) NOT NULL,
  `matricula_estudiante_id_estudiante` int(11) NOT NULL,
  `matricula_estudiante_registro_num_doc` int(11) NOT NULL,
  `matricula_estudiante_registro_rol_id_rol` int(11) NOT NULL,
  `matricula_estudiante_registro_jornada_id_jornada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletin`
--

CREATE TABLE `boletin` (
  `id_boletin` int(11) NOT NULL,
  `periodo` char(10) DEFAULT NULL,
  `puesto` char(10) DEFAULT NULL,
  `observador_id_observador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_cursos` int(11) NOT NULL,
  `curso` char(10) DEFAULT NULL,
  `grado_id_grado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_cursos`, `curso`, `grado_id_grado`) VALUES
(6, '106', 2),
(7, '406', 5),
(8, '405', 5),
(9, '05', 1),
(12, '04', 1),
(13, '03', 1),
(14, '02', 1),
(16, '103', 2),
(17, '104', 2),
(18, '105', 2),
(19, '205', 3),
(20, '304', 4),
(21, '06', 1),
(22, '01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `id_docente` int(11) NOT NULL,
  `profesion` char(45) DEFAULT NULL,
  `cursos_id_cursos` int(11) NOT NULL,
  `cursos_grado_id_grado` int(11) NOT NULL,
  `registro_num_doc` int(11) NOT NULL,
  `registro_rol_id_rol` int(11) NOT NULL,
  `registro_jornada_id_jornada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_has_materia`
--

CREATE TABLE `docente_has_materia` (
  `docente_id_docente` int(11) NOT NULL,
  `docente_cursos_id_cursos` int(11) NOT NULL,
  `docente_cursos_grado_id_grado` int(11) NOT NULL,
  `docente_registro_num_doc` int(11) NOT NULL,
  `docente_registro_rol_id_rol` int(11) NOT NULL,
  `docente_registro_jornada_id_jornada` int(11) NOT NULL,
  `materia_id_materia` int(11) NOT NULL,
  `materia_grado_id_grado` int(11) NOT NULL,
  `materia_area_id_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `id_estudiante` int(11) NOT NULL,
  `sexo` char(10) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `Eps` varchar(45) DEFAULT NULL,
  `RH` char(10) DEFAULT NULL,
  `NIvel_educativo` char(45) DEFAULT NULL,
  `Estado` char(25) DEFAULT NULL,
  `registro_num_doc` int(11) NOT NULL,
  `registro_rol_id_rol` int(11) NOT NULL,
  `registro_jornada_id_jornada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`id_estudiante`, `sexo`, `fecha_nacimiento`, `Eps`, `RH`, `NIvel_educativo`, `Estado`, `registro_num_doc`, `registro_rol_id_rol`, `registro_jornada_id_jornada`) VALUES
(1, ' disabled', '2008-01-03', 'nose', 'O-', 'Secundaria', ' disabled selected>Selecc', 1012366209, 6, 2),
(2, ' disabled', '2020-06-09', 'nose', ' disabled', 'Secundaria', ' disabled selected>Selecc', 1016950743, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `id_grado` int(11) NOT NULL,
  `nivel_educativo` char(45) DEFAULT NULL,
  `grado` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id_grado`, `nivel_educativo`, `grado`) VALUES
(1, 'Primaria', '0°'),
(2, 'Primaria', '1°'),
(3, 'Primaria', '2°'),
(4, 'Primaria', '3°'),
(5, 'Primaria', '4°'),
(6, 'Primaria', '5°'),
(7, 'Bachillerato', '6°'),
(8, 'Bachillerato', '7°'),
(9, 'Bachillerato', '8°'),
(10, 'Bachillerato', '9°'),
(11, 'Bachillerato', '10°'),
(12, 'Bachillerato', '11°');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada`
--

CREATE TABLE `jornada` (
  `id_jornada` int(11) NOT NULL,
  `jornada` char(20) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_final` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jornada`
--

INSERT INTO `jornada` (`id_jornada`, `jornada`, `hora_inicio`, `hora_final`) VALUES
(1, 'Mañana', '12:00:00', '18:00:00'),
(2, 'sin jornada', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logro`
--

CREATE TABLE `logro` (
  `id_logro` int(11) NOT NULL,
  `nombre_logro` char(100) DEFAULT NULL,
  `descripcion_logro` char(200) DEFAULT NULL,
  `materia_id_materia` int(11) NOT NULL,
  `materia_grado_id_grado` int(11) NOT NULL,
  `materia_area_id_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `logro`
--

INSERT INTO `logro` (`id_logro`, `nombre_logro`, `descripcion_logro`, `materia_id_materia`, `materia_grado_id_grado`, `materia_area_id_area`) VALUES
(3982, ' Dominio de la Expresión Escrita y Oral', 'El estudiante desarrolla habilidades para comunicarse de manera clara y efectiva en diferentes contextos, utilizando un vocabulario preciso y estructuras gramaticales adecuadas. Además, demuestra capa', 1, 12, 4),
(3983, 'preciación y Creación Musical', ' El estudiante reconoce y valora la música como una forma de expresión cultural y artística, identificando sus elementos fundamentales. Además, demuestra creatividad al interpretar, componer o experim', 2, 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL,
  `materia` char(45) DEFAULT NULL,
  `grado_id_grado` int(11) NOT NULL,
  `area_id_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id_materia`, `materia`, `grado_id_grado`, `area_id_area`) VALUES
(1, 'español', 12, 4),
(2, 'musica', 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `id_matricula` int(11) NOT NULL,
  `grado_id_grado` int(11) NOT NULL,
  `cursos_id_cursos` int(11) NOT NULL,
  `estudiante_id_estudiante` int(11) NOT NULL,
  `estudiante_registro_num_doc` int(11) NOT NULL,
  `estudiante_registro_rol_id_rol` int(11) NOT NULL,
  `estudiante_registro_jornada_id_jornada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE `nota` (
  `id_nota` int(11) NOT NULL,
  `fecha_nota` date DEFAULT NULL,
  `nota` decimal(10,0) DEFAULT NULL,
  `boletin_id_boletin` int(11) NOT NULL,
  `matricula_id_matricula` int(11) NOT NULL,
  `matricula_grado_id_grado` int(11) NOT NULL,
  `matricula_cursos_id_cursos` int(11) NOT NULL,
  `matricula_estudiante_id_estudiante` int(11) NOT NULL,
  `matricula_estudiante_registro_num_doc` int(11) NOT NULL,
  `matricula_estudiante_registro_rol_id_rol` int(11) NOT NULL,
  `matricula_estudiante_registro_jornada_id_jornada` int(11) NOT NULL,
  `actividad_id_actividad` int(11) NOT NULL,
  `actividad_logro_id_logro` int(11) NOT NULL,
  `actividad_logro_materia_id_materia` int(11) NOT NULL,
  `actividad_logro_materia_grado_id_grado` int(11) NOT NULL,
  `actividad_logro_materia_area_id_area` int(11) NOT NULL,
  `actividad_docente_id_docente` int(11) NOT NULL,
  `actividad_docente_cursos_id_cursos` int(11) NOT NULL,
  `actividad_docente_cursos_grado_id_grado` int(11) NOT NULL,
  `actividad_docente_registro_num_doc` int(11) NOT NULL,
  `actividad_docente_registro_rol_id_rol` int(11) NOT NULL,
  `actividad_docente_registro_jornada_id_jornada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observador`
--

CREATE TABLE `observador` (
  `id_observador` int(11) NOT NULL,
  `fecha_ob` date DEFAULT NULL,
  `comentario` char(200) DEFAULT NULL,
  `Tel_emergencia` char(25) DEFAULT NULL,
  `padre_nombre` char(90) DEFAULT NULL,
  `padre_apellido` char(90) DEFAULT NULL,
  `padre_ocupacion` char(150) DEFAULT NULL,
  `padre_cedula` char(15) DEFAULT NULL,
  `padre_direccion` varchar(260) DEFAULT NULL,
  `padre_telefono` char(13) DEFAULT NULL,
  `padre_correo` char(200) DEFAULT NULL,
  `madre_nombre` char(90) DEFAULT NULL,
  `madre_apellido` char(90) DEFAULT NULL,
  `madre_ocupacion` char(150) DEFAULT NULL,
  `madre_cedula` char(15) DEFAULT NULL,
  `madre_direccion` varchar(260) DEFAULT NULL,
  `madre_telefono` char(13) DEFAULT NULL,
  `madre_correo` char(200) DEFAULT NULL,
  `acudiente_nombre` char(90) DEFAULT NULL,
  `acudiente_apellido` char(90) DEFAULT NULL,
  `acudiente_ocupacion` char(150) DEFAULT NULL,
  `acudiente_cedula` char(15) DEFAULT NULL,
  `acudiente_direccion` varchar(260) DEFAULT NULL,
  `acudiente_telefono` char(13) DEFAULT NULL,
  `acudiente_correo` char(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observador_has_estudiante`
--

CREATE TABLE `observador_has_estudiante` (
  `observador_id_observador` int(11) NOT NULL,
  `estudiante_id_estudiante` int(11) NOT NULL,
  `estudiante_registro_num_doc` int(11) NOT NULL,
  `estudiante_registro_rol_id_rol` int(11) NOT NULL,
  `estudiante_registro_jornada_id_jornada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `public_eventos`
--

CREATE TABLE `public_eventos` (
  `id_evento` int(11) NOT NULL,
  `img` longblob DEFAULT NULL,
  `evento` varchar(255) DEFAULT NULL,
  `fecha_evento` date DEFAULT NULL,
  `registro_num_doc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `public_noticias`
--

CREATE TABLE `public_noticias` (
  `id_noticia` int(11) NOT NULL,
  `titulo` char(100) DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL,
  `registro_num_doc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `public_noticias`
--

INSERT INTO `public_noticias` (`id_noticia`, `titulo`, `info`, `registro_num_doc`) VALUES
(2, 'sacada de sangre', 'el dia 4 de marzo habrá sacada de sangre lo cual es voluntario si desean asistir es alas 4 de la tarde hasta las 6 los esperamos  ', 10137654),
(3, 'sacada de sangre', 'el dia 4 de marzo habrá sacada de sangre lo cual es voluntario si desean asistir es alas 4 de la tarde hasta las 6 los esperamos  ', 10137654);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `num_doc` int(11) NOT NULL,
  `tipo_doc` char(15) DEFAULT NULL,
  `foto_perfil` longblob DEFAULT NULL,
  `nombres` char(45) DEFAULT NULL,
  `apellidos` char(45) DEFAULT NULL,
  `celular` char(12) DEFAULT NULL,
  `telefono` char(15) DEFAULT NULL,
  `direccion` char(45) DEFAULT NULL,
  `correo` char(45) DEFAULT NULL,
  `pass` char(200) DEFAULT NULL,
  `rol_id_rol` int(11) NOT NULL,
  `jornada_id_jornada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`num_doc`, `tipo_doc`, `foto_perfil`, `nombres`, `apellidos`, `celular`, `telefono`, `direccion`, `correo`, `pass`, `rol_id_rol`, `jornada_id_jornada`) VALUES
(10137654, 'CC', 0x363763363236343964356630385f352e6a706567, 'Dylan Santiago', 'Herrera Espinosa', '3213675463', '3788938', 'CLL 80', 'dylan@gmail.com', '$2y$10$C5dWhpDAoE3ujPLLKb5QyeHN8CirxBg0wBM8q6BttHadNgtjD/3au', 4, 2),
(1012346778, 'CC', 0x363763363236313831323963655f352e6a706567, 'Ccristiam David', 'Cadena Gutierrez', '3213675468', '1233333', 'CLL 80', 'cristgma@gamil.com', '$2y$10$m7o42mz5u.7ouCq9liNM/.oL58RiynEc.Bj/iYaXO6Yrp/vin87cW', 3, 2),
(1012349306, 'CC', 0x363763363235313564393032345f352e6a706567, 'Laura Vannesa', 'Sanchez Salgado', '3213675468', '3213675', 'CLL 80', 'laura@gmail.com', '$2y$10$RqY/83H7bo9kIOCu2bzTi.v1lxk.Wy9L.RpNcM2KBQOFDX8Mj4z7q', 1, 2),
(1012366209, 'CC', 0x363763363237306166313530635f352e6a706567, 'Johan Stiven', 'Castiblanco Herrera', '3213675463', '3213675', 'CLL 80', 'johan@gmail.com', '$2y$10$.9LFU5x53FQQOFTWaknituT2DaBgbvpCvrNaq/M0VFM7t2EAyeCay', 6, 2),
(1016950743, 'CC', 0x363764343839616434323634325f496d6167656e20646520576861747341707020323032342d31302d31342061206c61732031362e31342e33385f31313435653932652e6a7067, 'cristiam Cadena', 'Cadena', '3265824763', '2948291', 'si', 'fwhvvh@gmail.com', '$2y$10$y34zCUTc3xk5/p1OV0c.2.1vk4BGVLbicz.PB5hzK3FhPYOP0GkOq', 6, 2),
(1084926214, 'CC', 0x363763363236643537633664375f352e6a706567, 'Englis Alexander', 'Barros Osuna', '3213675463', '3333333', 'CLL 80', 'englis@gmail.com', '$2y$10$AKXZCGaXmf5boc.aLVftd.v9w3.ei3r4LG2gUTnyqG2DB89ybsony', 5, 2),
(1141114912, 'CC', 0x363763363235386339626563645f352e6a706567, 'Yised Dayana', 'Castiblanco Herrera', '3213675468', '3213675', 'CLL 80', 'yised@gmail.com', '$2y$10$XJi3MHfYGgWt/u9mcBjwv.kpr4ghfwU6FhvhF8ayYC2WCJFvd5V1a', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'Admin'),
(2, 'Coordinador'),
(3, 'Rector'),
(4, 'Secretaria'),
(5, 'Profesor'),
(6, 'Estudiante');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id_actividad`,`logro_id_logro`,`logro_materia_id_materia`,`logro_materia_grado_id_grado`,`logro_materia_area_id_area`,`docente_id_docente`,`docente_cursos_id_cursos`,`docente_cursos_grado_id_grado`,`docente_registro_num_doc`,`docente_registro_rol_id_rol`,`docente_registro_jornada_id_jornada`,`materia_id_materia`,`materia_grado_id_grado`,`materia_area_id_area`) USING BTREE,
  ADD UNIQUE KEY `materia_id_materia` (`materia_id_materia`,`materia_grado_id_grado`,`materia_area_id_area`),
  ADD KEY `fk_actividad_logro1_idx` (`logro_id_logro`,`logro_materia_id_materia`,`logro_materia_grado_id_grado`,`logro_materia_area_id_area`),
  ADD KEY `fk_actividad_docente1_idx` (`docente_id_docente`,`docente_cursos_id_cursos`,`docente_cursos_grado_id_grado`,`docente_registro_num_doc`,`docente_registro_rol_id_rol`,`docente_registro_jornada_id_jornada`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`idAsistencia`,`matricula_id_matricula`,`matricula_grado_id_grado`,`matricula_cursos_id_cursos`,`matricula_estudiante_id_estudiante`,`matricula_estudiante_registro_num_doc`,`matricula_estudiante_registro_rol_id_rol`,`matricula_estudiante_registro_jornada_id_jornada`),
  ADD KEY `fk_Asistencia_matricula1_idx` (`matricula_id_matricula`,`matricula_grado_id_grado`,`matricula_cursos_id_cursos`,`matricula_estudiante_id_estudiante`,`matricula_estudiante_registro_num_doc`,`matricula_estudiante_registro_rol_id_rol`,`matricula_estudiante_registro_jornada_id_jornada`);

--
-- Indices de la tabla `boletin`
--
ALTER TABLE `boletin`
  ADD PRIMARY KEY (`id_boletin`,`observador_id_observador`),
  ADD KEY `fk_boletin_observador1_idx` (`observador_id_observador`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_cursos`,`grado_id_grado`),
  ADD KEY `fk_cursos_grado1_idx` (`grado_id_grado`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id_docente`,`cursos_id_cursos`,`cursos_grado_id_grado`,`registro_num_doc`,`registro_rol_id_rol`,`registro_jornada_id_jornada`),
  ADD KEY `fk_docente_cursos1_idx` (`cursos_id_cursos`,`cursos_grado_id_grado`),
  ADD KEY `fk_docente_registro1_idx` (`registro_num_doc`,`registro_rol_id_rol`,`registro_jornada_id_jornada`);

--
-- Indices de la tabla `docente_has_materia`
--
ALTER TABLE `docente_has_materia`
  ADD PRIMARY KEY (`docente_id_docente`,`docente_cursos_id_cursos`,`docente_cursos_grado_id_grado`,`docente_registro_num_doc`,`docente_registro_rol_id_rol`,`docente_registro_jornada_id_jornada`,`materia_id_materia`,`materia_grado_id_grado`,`materia_area_id_area`),
  ADD KEY `fk_docente_has_materia_materia1_idx` (`materia_id_materia`,`materia_grado_id_grado`,`materia_area_id_area`),
  ADD KEY `fk_docente_has_materia_docente1_idx` (`docente_id_docente`,`docente_cursos_id_cursos`,`docente_cursos_grado_id_grado`,`docente_registro_num_doc`,`docente_registro_rol_id_rol`,`docente_registro_jornada_id_jornada`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`id_estudiante`,`registro_num_doc`,`registro_rol_id_rol`,`registro_jornada_id_jornada`),
  ADD KEY `fk_estudiante_registro1_idx` (`registro_num_doc`,`registro_rol_id_rol`,`registro_jornada_id_jornada`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`id_grado`);

--
-- Indices de la tabla `jornada`
--
ALTER TABLE `jornada`
  ADD PRIMARY KEY (`id_jornada`);

--
-- Indices de la tabla `logro`
--
ALTER TABLE `logro`
  ADD PRIMARY KEY (`id_logro`,`materia_id_materia`,`materia_grado_id_grado`,`materia_area_id_area`),
  ADD KEY `fk_logro_materia1_idx` (`materia_id_materia`,`materia_grado_id_grado`,`materia_area_id_area`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`,`grado_id_grado`,`area_id_area`),
  ADD KEY `fk_materia_grado1_idx` (`grado_id_grado`),
  ADD KEY `fk_materia_area1_idx` (`area_id_area`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`id_matricula`,`grado_id_grado`,`cursos_id_cursos`,`estudiante_id_estudiante`,`estudiante_registro_num_doc`,`estudiante_registro_rol_id_rol`,`estudiante_registro_jornada_id_jornada`),
  ADD KEY `fk_matricula_grado1_idx` (`grado_id_grado`),
  ADD KEY `fk_matricula_cursos1_idx` (`cursos_id_cursos`),
  ADD KEY `fk_matricula_estudiante1_idx` (`estudiante_id_estudiante`,`estudiante_registro_num_doc`,`estudiante_registro_rol_id_rol`,`estudiante_registro_jornada_id_jornada`);

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`,`boletin_id_boletin`,`matricula_id_matricula`,`matricula_grado_id_grado`,`matricula_cursos_id_cursos`,`matricula_estudiante_id_estudiante`,`matricula_estudiante_registro_num_doc`,`matricula_estudiante_registro_rol_id_rol`,`matricula_estudiante_registro_jornada_id_jornada`,`actividad_id_actividad`,`actividad_logro_id_logro`,`actividad_logro_materia_id_materia`,`actividad_logro_materia_grado_id_grado`,`actividad_logro_materia_area_id_area`,`actividad_docente_id_docente`,`actividad_docente_cursos_id_cursos`,`actividad_docente_cursos_grado_id_grado`,`actividad_docente_registro_num_doc`,`actividad_docente_registro_rol_id_rol`,`actividad_docente_registro_jornada_id_jornada`),
  ADD KEY `fk_nota_boletin1_idx` (`boletin_id_boletin`),
  ADD KEY `fk_nota_matricula1_idx` (`matricula_id_matricula`,`matricula_grado_id_grado`,`matricula_cursos_id_cursos`,`matricula_estudiante_id_estudiante`,`matricula_estudiante_registro_num_doc`,`matricula_estudiante_registro_rol_id_rol`,`matricula_estudiante_registro_jornada_id_jornada`),
  ADD KEY `fk_nota_actividad1_idx` (`actividad_id_actividad`,`actividad_logro_id_logro`,`actividad_logro_materia_id_materia`,`actividad_logro_materia_grado_id_grado`,`actividad_logro_materia_area_id_area`,`actividad_docente_id_docente`,`actividad_docente_cursos_id_cursos`,`actividad_docente_cursos_grado_id_grado`,`actividad_docente_registro_num_doc`,`actividad_docente_registro_rol_id_rol`,`actividad_docente_registro_jornada_id_jornada`);

--
-- Indices de la tabla `observador`
--
ALTER TABLE `observador`
  ADD PRIMARY KEY (`id_observador`);

--
-- Indices de la tabla `observador_has_estudiante`
--
ALTER TABLE `observador_has_estudiante`
  ADD PRIMARY KEY (`observador_id_observador`,`estudiante_id_estudiante`,`estudiante_registro_num_doc`,`estudiante_registro_rol_id_rol`,`estudiante_registro_jornada_id_jornada`),
  ADD KEY `fk_observador_has_estudiante_estudiante1_idx` (`estudiante_id_estudiante`,`estudiante_registro_num_doc`,`estudiante_registro_rol_id_rol`,`estudiante_registro_jornada_id_jornada`),
  ADD KEY `fk_observador_has_estudiante_observador1_idx` (`observador_id_observador`);

--
-- Indices de la tabla `public_eventos`
--
ALTER TABLE `public_eventos`
  ADD PRIMARY KEY (`id_evento`,`registro_num_doc`),
  ADD KEY `fk_public_eventos_registro_idx` (`registro_num_doc`);

--
-- Indices de la tabla `public_noticias`
--
ALTER TABLE `public_noticias`
  ADD PRIMARY KEY (`id_noticia`,`registro_num_doc`),
  ADD KEY `fk_public_noticias_registro1_idx` (`registro_num_doc`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`num_doc`,`rol_id_rol`,`jornada_id_jornada`),
  ADD KEY `fk_registro_rol1_idx` (`rol_id_rol`),
  ADD KEY `fk_registro_jornada1_idx` (`jornada_id_jornada`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `boletin`
--
ALTER TABLE `boletin`
  MODIFY `id_boletin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_cursos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id_estudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `id_grado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `jornada`
--
ALTER TABLE `jornada`
  MODIFY `id_jornada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `id_matricula` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `observador`
--
ALTER TABLE `observador`
  MODIFY `id_observador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `public_eventos`
--
ALTER TABLE `public_eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `public_noticias`
--
ALTER TABLE `public_noticias`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `actividad_ibfk_1` FOREIGN KEY (`materia_id_materia`,`materia_grado_id_grado`,`materia_area_id_area`) REFERENCES `docente_has_materia` (`materia_id_materia`, `materia_grado_id_grado`, `materia_area_id_area`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_actividad_docente1` FOREIGN KEY (`docente_id_docente`,`docente_cursos_id_cursos`,`docente_cursos_grado_id_grado`,`docente_registro_num_doc`,`docente_registro_rol_id_rol`,`docente_registro_jornada_id_jornada`) REFERENCES `docente_has_materia` (`docente_id_docente`, `docente_cursos_id_cursos`, `docente_cursos_grado_id_grado`, `docente_registro_num_doc`, `docente_registro_rol_id_rol`, `docente_registro_jornada_id_jornada`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_actividad_logro1` FOREIGN KEY (`logro_id_logro`,`logro_materia_id_materia`,`logro_materia_grado_id_grado`,`logro_materia_area_id_area`) REFERENCES `logro` (`id_logro`, `materia_id_materia`, `materia_grado_id_grado`, `materia_area_id_area`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk_Asistencia_matricula1` FOREIGN KEY (`matricula_id_matricula`,`matricula_grado_id_grado`,`matricula_cursos_id_cursos`,`matricula_estudiante_id_estudiante`,`matricula_estudiante_registro_num_doc`,`matricula_estudiante_registro_rol_id_rol`,`matricula_estudiante_registro_jornada_id_jornada`) REFERENCES `matricula` (`id_matricula`, `grado_id_grado`, `cursos_id_cursos`, `estudiante_id_estudiante`, `estudiante_registro_num_doc`, `estudiante_registro_rol_id_rol`, `estudiante_registro_jornada_id_jornada`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `boletin`
--
ALTER TABLE `boletin`
  ADD CONSTRAINT `fk_boletin_observador1` FOREIGN KEY (`observador_id_observador`) REFERENCES `observador` (`id_observador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `fk_cursos_grado1` FOREIGN KEY (`grado_id_grado`) REFERENCES `grado` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `fk_docente_cursos1` FOREIGN KEY (`cursos_id_cursos`,`cursos_grado_id_grado`) REFERENCES `cursos` (`id_cursos`, `grado_id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docente_registro1` FOREIGN KEY (`registro_num_doc`,`registro_rol_id_rol`,`registro_jornada_id_jornada`) REFERENCES `registro` (`num_doc`, `rol_id_rol`, `jornada_id_jornada`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `docente_has_materia`
--
ALTER TABLE `docente_has_materia`
  ADD CONSTRAINT `fk_docente_has_materia_docente1` FOREIGN KEY (`docente_id_docente`,`docente_cursos_id_cursos`,`docente_cursos_grado_id_grado`,`docente_registro_num_doc`,`docente_registro_rol_id_rol`,`docente_registro_jornada_id_jornada`) REFERENCES `docente` (`id_docente`, `cursos_id_cursos`, `cursos_grado_id_grado`, `registro_num_doc`, `registro_rol_id_rol`, `registro_jornada_id_jornada`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docente_has_materia_materia1` FOREIGN KEY (`materia_id_materia`,`materia_grado_id_grado`,`materia_area_id_area`) REFERENCES `materia` (`id_materia`, `grado_id_grado`, `area_id_area`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `fk_estudiante_registro1` FOREIGN KEY (`registro_num_doc`,`registro_rol_id_rol`,`registro_jornada_id_jornada`) REFERENCES `registro` (`num_doc`, `rol_id_rol`, `jornada_id_jornada`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `logro`
--
ALTER TABLE `logro`
  ADD CONSTRAINT `fk_logro_materia1` FOREIGN KEY (`materia_id_materia`,`materia_grado_id_grado`,`materia_area_id_area`) REFERENCES `materia` (`id_materia`, `grado_id_grado`, `area_id_area`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `fk_materia_area1` FOREIGN KEY (`area_id_area`) REFERENCES `area` (`id_area`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materia_grado1` FOREIGN KEY (`grado_id_grado`) REFERENCES `grado` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `fk_matricula_cursos1` FOREIGN KEY (`cursos_id_cursos`) REFERENCES `cursos` (`id_cursos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_estudiante1` FOREIGN KEY (`estudiante_id_estudiante`,`estudiante_registro_num_doc`,`estudiante_registro_rol_id_rol`,`estudiante_registro_jornada_id_jornada`) REFERENCES `estudiante` (`id_estudiante`, `registro_num_doc`, `registro_rol_id_rol`, `registro_jornada_id_jornada`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_grado1` FOREIGN KEY (`grado_id_grado`) REFERENCES `grado` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `fk_nota_actividad1` FOREIGN KEY (`actividad_id_actividad`,`actividad_logro_id_logro`,`actividad_logro_materia_id_materia`,`actividad_logro_materia_grado_id_grado`,`actividad_logro_materia_area_id_area`,`actividad_docente_id_docente`,`actividad_docente_cursos_id_cursos`,`actividad_docente_cursos_grado_id_grado`,`actividad_docente_registro_num_doc`,`actividad_docente_registro_rol_id_rol`,`actividad_docente_registro_jornada_id_jornada`) REFERENCES `actividad` (`id_actividad`, `logro_id_logro`, `logro_materia_id_materia`, `logro_materia_grado_id_grado`, `logro_materia_area_id_area`, `docente_id_docente`, `docente_cursos_id_cursos`, `docente_cursos_grado_id_grado`, `docente_registro_num_doc`, `docente_registro_rol_id_rol`, `docente_registro_jornada_id_jornada`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nota_boletin1` FOREIGN KEY (`boletin_id_boletin`) REFERENCES `boletin` (`id_boletin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nota_matricula1` FOREIGN KEY (`matricula_id_matricula`,`matricula_grado_id_grado`,`matricula_cursos_id_cursos`,`matricula_estudiante_id_estudiante`,`matricula_estudiante_registro_num_doc`,`matricula_estudiante_registro_rol_id_rol`,`matricula_estudiante_registro_jornada_id_jornada`) REFERENCES `matricula` (`id_matricula`, `grado_id_grado`, `cursos_id_cursos`, `estudiante_id_estudiante`, `estudiante_registro_num_doc`, `estudiante_registro_rol_id_rol`, `estudiante_registro_jornada_id_jornada`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `observador_has_estudiante`
--
ALTER TABLE `observador_has_estudiante`
  ADD CONSTRAINT `fk_observador_has_estudiante_estudiante1` FOREIGN KEY (`estudiante_id_estudiante`,`estudiante_registro_num_doc`,`estudiante_registro_rol_id_rol`,`estudiante_registro_jornada_id_jornada`) REFERENCES `estudiante` (`id_estudiante`, `registro_num_doc`, `registro_rol_id_rol`, `registro_jornada_id_jornada`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_observador_has_estudiante_observador1` FOREIGN KEY (`observador_id_observador`) REFERENCES `observador` (`id_observador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `public_eventos`
--
ALTER TABLE `public_eventos`
  ADD CONSTRAINT `fk_public_eventos_registro` FOREIGN KEY (`registro_num_doc`) REFERENCES `registro` (`num_doc`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `public_noticias`
--
ALTER TABLE `public_noticias`
  ADD CONSTRAINT `fk_public_noticias_registro1` FOREIGN KEY (`registro_num_doc`) REFERENCES `registro` (`num_doc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `fk_registro_jornada1` FOREIGN KEY (`jornada_id_jornada`) REFERENCES `jornada` (`id_jornada`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_registro_rol1` FOREIGN KEY (`rol_id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
