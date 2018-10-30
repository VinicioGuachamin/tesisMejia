-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2018 a las 02:02:39
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tesismejia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bachillerato`
--

CREATE TABLE `bachillerato` (
  `id` int(11) NOT NULL,
  `empleado_a_id` int(11) NOT NULL,
  `titulo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institucion` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_titulo` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bachillerato`
--

INSERT INTO `bachillerato` (`id`, `empleado_a_id`, `titulo`, `institucion`, `fecha_titulo`) VALUES
(2, 2, 'Fisico Matematico', 'Colegio Mejia', '2018-10-02 00:00:00'),
(3, 3, 'Fisico Matematico', 'Colegio Mejia', '2018-10-18 00:00:00'),
(4, 4, 'CIENCIAS ESPECIALIDAD INFORMATICA', '5 DE JUNIO', '1996-08-16 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bachillerato_b`
--

CREATE TABLE `bachillerato_b` (
  `id` int(11) NOT NULL,
  `empleado_b_id` int(11) NOT NULL,
  `titulo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institucion` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_titulo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bachillerato_b`
--

INSERT INTO `bachillerato_b` (`id`, `empleado_b_id`, `titulo`, `institucion`, `fecha_titulo`) VALUES
(1, 1, 'Estudiando', 'Estudiando', '2018-10-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canton`
--

CREATE TABLE `canton` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `canton`
--

INSERT INTO `canton` (`id`, `nombre`) VALUES
(1, 'Quito'),
(2, 'Cayambe'),
(3, 'Mejia'),
(4, 'Pedro Moncayo'),
(5, 'Rumiñahui'),
(6, 'San Miguel de los Bancos'),
(7, 'Pedro Vicente Maldonado'),
(8, 'Puerto Quito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_a`
--

CREATE TABLE `empleado_a` (
  `id` int(11) NOT NULL,
  `sueldo_id` int(11) NOT NULL,
  `canton_id` int(11) NOT NULL,
  `parroquia_id` int(11) NOT NULL,
  `horario_id` int(11) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rol` enum('ROLE_ADMIN','ROLE_SUPERUSER','ROLE_USER','NINGUNO') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoempleado` enum('Docente','Médico','Oficina') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombres` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codbiometrico` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fnacimiento` date NOT NULL,
  `ecivil` enum('Soltero/a','Unión de Hecho','Casado/a','Divorciado/a','Viudo/a') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tsangre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombreconyugue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cedulaconyugue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargafamiliar` int(11) NOT NULL,
  `hijos` int(11) NOT NULL,
  `cargaeduc` int(11) NOT NULL,
  `carnetconadis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discapacidad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cuentabanco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombrebanco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipocuenta` enum('Ahorro','Corriente') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ingresomagisterio` date NOT NULL,
  `ingresoinstitucion` date NOT NULL,
  `nombramiento` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  `jornada` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  `niveljornada` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  `asignaturas` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edificiolabora` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  `directorarea` enum('Si','No') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripdirarea` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comision` enum('Si','No') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipocomision` enum('Coordinador','Integrante') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombrecomision` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calleprincipal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calletransversal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numcasa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barrio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sector` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teldomicilio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teloficina` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operadora` enum('Movi','Claro','CNT','Otro') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emailprincipal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailalterno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombreemergencia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentescoemergencia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telemergencia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleado_a`
--

INSERT INTO `empleado_a` (`id`, `sueldo_id`, `canton_id`, `parroquia_id`, `horario_id`, `foto`, `rol`, `tipoempleado`, `nombres`, `apellidos`, `codbiometrico`, `cedula`, `fnacimiento`, `ecivil`, `tsangre`, `nombreconyugue`, `cedulaconyugue`, `cargafamiliar`, `hijos`, `cargaeduc`, `carnetconadis`, `discapacidad`, `cuentabanco`, `nombrebanco`, `tipocuenta`, `ingresomagisterio`, `ingresoinstitucion`, `nombramiento`, `jornada`, `niveljornada`, `asignaturas`, `edificiolabora`, `directorarea`, `descripdirarea`, `comision`, `tipocomision`, `nombrecomision`, `calleprincipal`, `calletransversal`, `numcasa`, `barrio`, `sector`, `teldomicilio`, `teloficina`, `celular`, `operadora`, `emailprincipal`, `emailalterno`, `nombreemergencia`, `parentescoemergencia`, `telemergencia`) VALUES
(2, 1, 1, 8, 6, '64c188c67647ed0676660ae0bad4b8fa.gif', 'ROLE_ADMIN', 'Docente', 'Vinicio Geovanny', 'Guachamin Quingaluisa', '2', '1721707568', '2018-11-01', 'Soltero/a', 'Orh', 'Ninguno', 'Ninguno', 0, 0, 0, 'Ninguno', 'Ninguno', '1111111111111', 'Pichincha', 'Ahorro', '2018-10-04', '2018-10-03', 'Definitivo', 'Vespertina', 'EGBS', 'Niguna materia', 'Sur', 'No', NULL, 'No', NULL, NULL, 'carapungos', 'alto mirador', '5323', 'La raya', 'Biloxi', '12345678', '12345678', '1234567890', 'Claro', 'v@v.com', 'v@v.com', 'sdfsd', 'sdfsd', '12345678'),
(3, 3, 1, 8, 5, NULL, 'ROLE_ADMIN', 'Docente', 'Juan Perez', 'Samaniego Sanchez', '2323', '1721707560', '2018-10-22', 'Unión de Hecho', 'orh+', 'Maria Jimenez', '1287654567', 0, 0, 0, 'Ninguno', 'Ninguno', '1241231231', 'Guayaquil', 'Ahorro', '2018-10-01', '2018-10-01', 'Definitivo', 'Vespertina', 'EGBS', 'Ninguna', 'Sur', 'No', NULL, 'No', NULL, NULL, 'carapungos', 'gggggggggg', '5323', 'la Biloxi', 'Pintado', '12345678', '123445667', '0987658766', 'Claro', 'v@v.com', 'v@v.com', 'sdfsd', 'sdfsd', '12345678'),
(4, 4, 1, 8, 7, '30d451b64aa1822c0a11dd6cb9ef29f4.jpeg', 'NINGUNO', 'Docente', 'MARCO ALONSO', 'ANDINO ANDINO', '54', '1715108328', '1977-10-25', 'Casado/a', 'O+', 'PAOLA SUAREZ', 'Ninguno', 0, 0, 0, 'Ninguno', 'Ninguno', '20302602', 'GUAYAQUIL', 'Ahorro', '2007-11-01', '2007-11-01', 'Definitivo', 'Matutina', 'EGBS', 'MATEMÁTICA, CAS', 'Central', 'No', NULL, 'No', NULL, NULL, 'AMADEO IZQUIETA', 'S47-35', 'S46-35', 'LA INMACULADA', 'CHILLOGALLO', '22696427', NULL, '0983769143', 'Movi', 'marandino77@gmail.com', 'marandino77@gmail.com', 'PAOLA SUAREZ', 'ESPOSA', '983769208');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_b`
--

CREATE TABLE `empleado_b` (
  `id` int(11) NOT NULL,
  `sueldo_id` int(11) NOT NULL,
  `canton_id` int(11) NOT NULL,
  `parroquia_id` int(11) NOT NULL,
  `horario_id` int(11) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rol` enum('ROLE_ADMIN','ROLE_SUPERUSER','ROLE_USER','NINGUNO') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoempleado` enum('Conserje','Operario de imprenta') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombres` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codbiometrico` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fnacimiento` date NOT NULL,
  `ecivil` enum('Soltero/a','Unión de Hecho','Casado/a','Divorciado/a','Viudo/a') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tsangre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombreconyugue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cedulaconyugue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargafamiliar` int(11) NOT NULL,
  `hijos` int(11) NOT NULL,
  `cargaeduc` int(11) NOT NULL,
  `carnetconadis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discapacidad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cuentabanco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombrebanco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipocuenta` enum('Ahorro','Corriente') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ingresoinstitucion` date NOT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dptolabora` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edificiolabora` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  `calleprincipal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calletransversal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numcasa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barrio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sector` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teldomicilio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teloficina` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operadora` enum('Movi','Claro','CNT','Otro') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emailprincipal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailalterno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombreemergencia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentescoemergencia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telemergencia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleado_b`
--

INSERT INTO `empleado_b` (`id`, `sueldo_id`, `canton_id`, `parroquia_id`, `horario_id`, `foto`, `rol`, `tipoempleado`, `nombres`, `apellidos`, `codbiometrico`, `cedula`, `fnacimiento`, `ecivil`, `tsangre`, `nombreconyugue`, `cedulaconyugue`, `cargafamiliar`, `hijos`, `cargaeduc`, `carnetconadis`, `discapacidad`, `cuentabanco`, `nombrebanco`, `tipocuenta`, `ingresoinstitucion`, `cargo`, `dptolabora`, `edificiolabora`, `calleprincipal`, `calletransversal`, `numcasa`, `barrio`, `sector`, `teldomicilio`, `teloficina`, `celular`, `operadora`, `emailprincipal`, `emailalterno`, `nombreemergencia`, `parentescoemergencia`, `telemergencia`) VALUES
(1, 1, 1, 18, 5, 'd90a981c993a57f681d9228371b699f1.gif', 'ROLE_ADMIN', 'Conserje', 'Vinicio Geovanny', 'Guachamin Quingaluisa', '1212', '1721707568', '2018-10-12', 'Unión de Hecho', 'Orh', 'Ninguno', '1721787672', 0, 0, 0, 'Ninguno', 'Ninguno', '1111111111111', 'Pichincha', 'Ahorro', '2018-10-04', 'Conserje', 'Institucion', 'Central', 'assssssssssss', 'gggggggggg', '5323', 'sddfsdfsdfsd', 'bbbbb', '12345678', '12345678', '1234567890', 'Movi', 'v@v.com', 'v@v.com', 'sdfsd', 'sdfsd', '12345678');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id` int(11) NOT NULL,
  `lunes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `martes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `miercoles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jueves` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viernes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sabado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `sabado`) VALUES
(4, '9:49 PM,9:49 PM,9:49 PM,9:49 PM', '9:49 PM,,,9:49 PM', '9:49 PM,,,9:50 PM', '9:50 PM,9:50 PM,9:50 PM,9:50 PM', '9:50 PM,9:50 PM,9:50 PM,9:50 PM', '9:50 PM,,,9:50 PM'),
(5, '9:58 PM,9:58 PM,9:58 PM,9:58 PM', '9:58 PM,9:58 PM,9:58 PM,9:58 PM', '9:58 PM,9:58 PM,9:58 PM,9:58 PM', '9:58 PM,9:58 PM,9:58 PM,9:58 PM', '9:58 PM,9:58 PM,9:58 PM,9:58 PM', '9:58 PM,9:58 PM,9:58 PM,9:58 PM'),
(6, '8:00 AM,12:30 PM,1:30 PM,5:00 PM', '10:00 AM,,,2:00 PM', '8:00 AM,,,2:30 PM', '8:00 AM,12:30 PM,1:30 PM,5:00 PM', '8:00 AM,12:30 PM,1:30 PM,5:00 PM', ',,,'),
(7, '7:00 AM,,,2:30 PM', '7:00 AM,,,1:00 PM', '7:00 AM,,,1:00 PM', '7:00 AM,,,3:30 PM', '7:00 AM,,,11:30 PM', '7:00 AM,,,12:00 PM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migration_versions`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquia`
--

CREATE TABLE `parroquia` (
  `id` int(11) NOT NULL,
  `canton_id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `parroquia`
--

INSERT INTO `parroquia` (`id`, `canton_id`, `nombre`) VALUES
(1, 1, 'Belisario Quevedo'),
(2, 1, 'Carcelén'),
(3, 1, 'Centro Histórico'),
(4, 1, 'Cochapamba'),
(5, 1, 'Comité del Pueblo'),
(6, 1, 'Cotocollao'),
(7, 1, 'Chilibulo'),
(8, 1, 'Chillogallo'),
(9, 1, 'Chimbacalle'),
(10, 1, 'EL Condado'),
(11, 1, 'Guamaní'),
(12, 1, 'Iñaquito'),
(13, 1, 'Itchimbía'),
(14, 1, 'Jipijapa'),
(15, 1, 'Kennedy'),
(16, 1, 'La Argelia'),
(17, 1, 'La Concepción'),
(18, 1, 'La Ecuatoriana'),
(19, 1, 'La Ferroviaria'),
(20, 1, 'La Libertad'),
(21, 1, 'La Magdalena'),
(22, 1, 'La Mena'),
(23, 1, 'Mariscal Sucre'),
(24, 1, 'Ponceano'),
(25, 1, 'Puengasí'),
(26, 1, 'Quitumbe'),
(27, 1, 'Rumipamba'),
(28, 1, 'San Bartolo'),
(29, 1, 'San Isidro del Inca'),
(30, 1, 'San Juan'),
(31, 1, 'Solanda'),
(32, 1, 'Turubamba'),
(33, 1, 'Quito Distrito Metropolitano'),
(34, 1, 'Alangasí'),
(35, 1, 'Amaguaña'),
(36, 1, 'Atahualpa'),
(37, 1, 'Calacalí'),
(38, 1, 'Calderón'),
(39, 1, 'Conocoto'),
(40, 1, 'Cumbayá'),
(41, 1, 'Chavezpamba'),
(42, 1, 'Checa'),
(43, 1, 'El Quinche'),
(44, 1, 'Gualea'),
(45, 1, 'Guangopolo'),
(46, 1, 'Guayllabamba'),
(47, 1, 'La Merced'),
(48, 1, 'Llano Chico'),
(49, 1, 'Lloa'),
(50, 1, 'Mindo'),
(51, 1, 'Nanegal'),
(52, 1, 'Nanegalito'),
(53, 1, 'Nayón'),
(54, 1, 'Nono'),
(55, 1, 'Pacto'),
(56, 1, 'Predo Vicente Maldonado'),
(57, 1, 'Perucho'),
(58, 1, 'Pifo'),
(59, 1, 'Pomasqui'),
(60, 1, 'Pínta'),
(61, 1, 'Puéllaro'),
(62, 1, 'Puembo'),
(63, 1, 'San Antonio'),
(64, 1, 'San José de Minas'),
(65, 1, 'San Miguel de los Bancos'),
(66, 1, 'Tababela'),
(67, 1, 'Tumbaco'),
(68, 1, 'Yaruquí'),
(69, 1, 'Zambiza'),
(70, 1, 'Puerto Quito'),
(71, 2, 'Ayora'),
(72, 2, 'Cayambe'),
(73, 2, 'Juan Montalvo'),
(74, 2, 'Ascázubi'),
(75, 2, 'Cangahua'),
(76, 2, 'Olmedo(Pesillo)'),
(77, 2, 'Otón'),
(78, 2, 'Santa Rosa de Cuzubamba'),
(79, 3, 'Machachi'),
(80, 3, 'Alóag'),
(81, 3, 'Aloasí'),
(82, 3, 'Cutuglahua'),
(83, 3, 'El Chaupi'),
(84, 3, 'Manuel Cornejo Astorga(Tandapi)'),
(85, 3, 'Tambillo'),
(86, 3, 'Uyumbicho'),
(87, 4, 'Tabacundo'),
(88, 4, 'La Esperanza'),
(89, 4, 'Malchinguí'),
(90, 4, 'Tocachi'),
(91, 4, 'Tupigachi'),
(92, 5, 'Sangolquí'),
(93, 5, 'San Pedro de Taboada'),
(94, 5, 'San Rafael'),
(95, 5, 'Cotogchoa'),
(96, 5, 'Rumipamba'),
(97, 6, 'San Miguel de los Bancos'),
(98, 6, 'Mindo'),
(99, 6, 'Pedro Vicente Maldonado'),
(100, 6, 'Puerto Quito'),
(101, 7, 'Pedro Vicente Maldonado'),
(102, 8, 'Puerto QUito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postbachillerato`
--

CREATE TABLE `postbachillerato` (
  `id` int(11) NOT NULL,
  `empleado_a_id` int(11) NOT NULL,
  `titulo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institucion` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_titulo` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `postbachillerato`
--

INSERT INTO `postbachillerato` (`id`, `empleado_a_id`, `titulo`, `institucion`, `fecha_titulo`) VALUES
(1, 2, 'dddd', 'aaaa', '2018-10-05 00:00:00'),
(2, 3, 'aaa', 'aaaa', '2018-10-02 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postbachillerato_b`
--

CREATE TABLE `postbachillerato_b` (
  `id` int(11) NOT NULL,
  `empleado_b_id` int(11) NOT NULL,
  `titulo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institucion` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_titulo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `postbachillerato_b`
--

INSERT INTO `postbachillerato_b` (`id`, `empleado_b_id`, `titulo`, `institucion`, `fecha_titulo`) VALUES
(1, 1, 'aaa', 'aaaa', '2018-10-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sueldo`
--

CREATE TABLE `sueldo` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sueldo`
--

INSERT INTO `sueldo` (`id`, `categoria`, `valor`) VALUES
(1, 'A', '1545'),
(3, 'B', '1435'),
(4, 'E', '987');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `superior`
--

CREATE TABLE `superior` (
  `id` int(11) NOT NULL,
  `empleado_a_id` int(11) NOT NULL,
  `titulo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institucion` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registro_senescyt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nivel` enum('Tecnólogo','3','4') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `superior`
--

INSERT INTO `superior` (`id`, `empleado_a_id`, `titulo`, `institucion`, `registro_senescyt`, `nivel`) VALUES
(2, 2, 'qqqq', 'zzzz', '1231213', '3'),
(3, 3, 'qqqq', 'zzzz', '1231213', 'Tecnólogo'),
(4, 4, 'LICENCIADO CIENCIAS EDUCACION INFORMATICA', 'UNIVERSIDAD CENTRAL', '1005-02-258158', '3'),
(5, 4, 'INGENIERO EDUCACION INFORMATICA', 'UNIVERSIDAD AUTONOMA QUITO', '1048-02-189875', '3'),
(6, 4, 'MAGISTER EN GERENCIA DE PROYECTOS', 'UNIVERSIDAD CENTRAL', '1005-2016-1672034', '4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `superior_b`
--

CREATE TABLE `superior_b` (
  `id` int(11) NOT NULL,
  `empleado_b_id` int(11) NOT NULL,
  `titulo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institucion` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registro_senescyt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nivel` enum('Tecnólogo','3','4') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bachillerato`
--
ALTER TABLE `bachillerato`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_40A642E9B39B91CD` (`empleado_a_id`);

--
-- Indices de la tabla `bachillerato_b`
--
ALTER TABLE `bachillerato_b`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C8287BAFA12E3E23` (`empleado_b_id`);

--
-- Indices de la tabla `canton`
--
ALTER TABLE `canton`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado_a`
--
ALTER TABLE `empleado_a`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_951C4AB87BF39BE0` (`cedula`),
  ADD KEY `IDX_951C4AB8FBD8F2D3` (`sueldo_id`),
  ADD KEY `IDX_951C4AB88D070D0B` (`canton_id`),
  ADD KEY `IDX_951C4AB874AFDC17` (`parroquia_id`),
  ADD KEY `IDX_951C4AB84959F1BA` (`horario_id`);

--
-- Indices de la tabla `empleado_b`
--
ALTER TABLE `empleado_b`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C151B027BF39BE0` (`cedula`),
  ADD KEY `IDX_C151B02FBD8F2D3` (`sueldo_id`),
  ADD KEY `IDX_C151B028D070D0B` (`canton_id`),
  ADD KEY `IDX_C151B0274AFDC17` (`parroquia_id`),
  ADD KEY `IDX_C151B024959F1BA` (`horario_id`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_23A716688D070D0B` (`canton_id`);

--
-- Indices de la tabla `postbachillerato`
--
ALTER TABLE `postbachillerato`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F25B7A38B39B91CD` (`empleado_a_id`);

--
-- Indices de la tabla `postbachillerato_b`
--
ALTER TABLE `postbachillerato_b`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_78098592A12E3E23` (`empleado_b_id`);

--
-- Indices de la tabla `sueldo`
--
ALTER TABLE `sueldo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `superior`
--
ALTER TABLE `superior`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7903BCAAB39B91CD` (`empleado_a_id`);

--
-- Indices de la tabla `superior_b`
--
ALTER TABLE `superior_b`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_497981D7A12E3E23` (`empleado_b_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bachillerato`
--
ALTER TABLE `bachillerato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `bachillerato_b`
--
ALTER TABLE `bachillerato_b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `canton`
--
ALTER TABLE `canton`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `empleado_a`
--
ALTER TABLE `empleado_a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `empleado_b`
--
ALTER TABLE `empleado_b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT de la tabla `postbachillerato`
--
ALTER TABLE `postbachillerato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `postbachillerato_b`
--
ALTER TABLE `postbachillerato_b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `sueldo`
--
ALTER TABLE `sueldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `superior`
--
ALTER TABLE `superior`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `superior_b`
--
ALTER TABLE `superior_b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bachillerato`
--
ALTER TABLE `bachillerato`
  ADD CONSTRAINT `FK_40A642E9B39B91CD` FOREIGN KEY (`empleado_a_id`) REFERENCES `empleado_a` (`id`);

--
-- Filtros para la tabla `bachillerato_b`
--
ALTER TABLE `bachillerato_b`
  ADD CONSTRAINT `FK_C8287BAFA12E3E23` FOREIGN KEY (`empleado_b_id`) REFERENCES `empleado_b` (`id`);

--
-- Filtros para la tabla `empleado_a`
--
ALTER TABLE `empleado_a`
  ADD CONSTRAINT `FK_951C4AB84959F1BA` FOREIGN KEY (`horario_id`) REFERENCES `horario` (`id`),
  ADD CONSTRAINT `FK_951C4AB874AFDC17` FOREIGN KEY (`parroquia_id`) REFERENCES `parroquia` (`id`),
  ADD CONSTRAINT `FK_951C4AB88D070D0B` FOREIGN KEY (`canton_id`) REFERENCES `canton` (`id`),
  ADD CONSTRAINT `FK_951C4AB8FBD8F2D3` FOREIGN KEY (`sueldo_id`) REFERENCES `sueldo` (`id`);

--
-- Filtros para la tabla `empleado_b`
--
ALTER TABLE `empleado_b`
  ADD CONSTRAINT `FK_C151B024959F1BA` FOREIGN KEY (`horario_id`) REFERENCES `horario` (`id`),
  ADD CONSTRAINT `FK_C151B0274AFDC17` FOREIGN KEY (`parroquia_id`) REFERENCES `parroquia` (`id`),
  ADD CONSTRAINT `FK_C151B028D070D0B` FOREIGN KEY (`canton_id`) REFERENCES `canton` (`id`),
  ADD CONSTRAINT `FK_C151B02FBD8F2D3` FOREIGN KEY (`sueldo_id`) REFERENCES `sueldo` (`id`);

--
-- Filtros para la tabla `parroquia`
--
ALTER TABLE `parroquia`
  ADD CONSTRAINT `FK_23A716688D070D0B` FOREIGN KEY (`canton_id`) REFERENCES `canton` (`id`);

--
-- Filtros para la tabla `postbachillerato`
--
ALTER TABLE `postbachillerato`
  ADD CONSTRAINT `FK_F25B7A38B39B91CD` FOREIGN KEY (`empleado_a_id`) REFERENCES `empleado_a` (`id`);

--
-- Filtros para la tabla `postbachillerato_b`
--
ALTER TABLE `postbachillerato_b`
  ADD CONSTRAINT `FK_78098592A12E3E23` FOREIGN KEY (`empleado_b_id`) REFERENCES `empleado_b` (`id`);

--
-- Filtros para la tabla `superior`
--
ALTER TABLE `superior`
  ADD CONSTRAINT `FK_7903BCAAB39B91CD` FOREIGN KEY (`empleado_a_id`) REFERENCES `empleado_a` (`id`);

--
-- Filtros para la tabla `superior_b`
--
ALTER TABLE `superior_b`
  ADD CONSTRAINT `FK_497981D7A12E3E23` FOREIGN KEY (`empleado_b_id`) REFERENCES `empleado_b` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
