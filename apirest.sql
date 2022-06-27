-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2022 a las 01:16:55
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `apirest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `email` text NOT NULL,
  `id_cliente` text NOT NULL,
  `llave_secreta` text NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `email`, `id_cliente`, `llave_secreta`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'Administrador', 'Sistema', 'administrador@sistema.com', 'a2ya10a1Dr1WY/GrB99.zssr.4n6ex0cy5MS3cBNe6G0MhHEKwgwYnzugb4K', 'o2yo12oPGJq.G72z9uF39Hw8bEYte3SGa6WkBslKwmgN2BDTpjq4rTmJUR26', '2019-12-14 02:34:37', '2019-12-14 02:34:37'),
(2, 'Nombre', 'Apellido', 'nombre@apellido.com', 'a2aa07aafartwetsdAD52356FEDGektPvQO0cdicQV1wHdgd1ID7wo8hXetm', 'o2ao07oafartwetsdAD52356FEDGedIS0H3UaXdXHh3c5IN/dA/bThUCSNnW', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `descripcion` text NOT NULL,
  `instructor` text NOT NULL,
  `imagen` text NOT NULL,
  `precio` float NOT NULL,
  `id_creador` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `titulo`, `descripcion`, `instructor`, `imagen`, `precio`, `id_creador`, `created_at`, `updated_at`) VALUES
(1, 'Angular: De cero a experto creando aplicaciones (Angular 8+)', 'Todo lo que necesitas saber de angular utilizando TypeScript y buenas prácticas ofrecidas por el equipo de angular.', 'Fernando Herrera', 'https://i.udemycdn.com/course/480x270/1075334_8b5f_4.jpg', 199.99, 1, NULL, NULL),
(2, 'Desarrollo Web Completo con HTML5, CSS3, JS AJAX PHP y MySQL', 'Aprende Desarrollo Web con este curso 100% práctico, paso a paso y sin conocimientos previos, INCLUYE PROYECTO FINAL', 'Juan Pablo De la torre Valdez', 'https://i.udemycdn.com/course/480x270/980450_7fc0_3.jpg', 199.99, 1, NULL, NULL),
(3, 'Programación de Android desde Cero +35 horas Curso COMPLETO', 'Aprender a programar aplicaciones y juegos para Android de forma profesional y desde cero.', 'Jose Javier Villena', 'https://i.udemycdn.com/course/480x270/957106_270f_6.jpg', 199.99, 1, NULL, NULL),
(4, 'Universidad Java: De Cero a Master +82 hrs (JDK 13 update)!', 'El mejor curso para aprender Java, POO, JDBC, Servlets, JSPs, Java EE, Web Services, JSF, EJB, JPA, PrimeFaces y JAX-RS!', 'Global Mentoring', 'https://i.udemycdn.com/course/480x270/1265942_7e2f_9.jpg', 199.99, 1, NULL, NULL),
(5, 'Curso Maestro de Python 3: Aprende Desde Cero', 'Aprende a programar con clases y objetos, a usar ficheros y bases de datos SQLite, interfaces gráficas y más con Python', 'Héctor Costa Guzmán', 'https://i.udemycdn.com/course/480x270/882422_0549_9.jpg', 199.99, 1, NULL, NULL),
(6, 'Master en JavaScript: Aprender JS, jQuery, Angular 8, NodeJS', 'Master en JavaScript: Aprender JS, jQuery, Angular 8, NodeJS', 'Víctor Robles', 'https://i.udemycdn.com/course/480x270/1337000_0d99.jpg', 199.99, 1, NULL, NULL),
(7, 'Master en Programación de Videojuegos con Unity® 2019 y C#', 'Aprende a programar videojuegos desde cero a nivel AVANZADO y profesional con Unity® 2019', 'Mariano Rivas', 'https://i.udemycdn.com/course/480x270/371090_f92b_6.jpg', 199.99, 1, NULL, NULL),
(8, 'Diseño Web Desde Cero a Avanzado 45h Curso COMPLETO', 'Aprende a Diseñar Páginas Web Responsive Design, atractivas, de forma profesional y sin dificultad con HTML5 y CSS3', 'Jose Javier Villena', 'https://i.udemycdn.com/course/480x270/809410_4666_6.jpg', 199.99, 1, NULL, NULL),
(9, 'Diseño Web Profesional El Curso Completo, Práctico y desde 0', 'HTML5, CSS3, Responsive Design, Adobe XD, SASS, JavaScript, jQuery, Bootstrap 4, WordPress, Git, GitHub', 'Carlos Arturo Esparza', 'https://i.udemycdn.com/course/480x270/782428_b5cf_4.jpg', 199.99, 1, NULL, NULL),
(10, 'PHP 7 y MYSQL: El Curso Completo, Práctico y Desde Cero !', 'HTML5, CSS3, Responsive Design, Adobe XD, SASS, JavaScript, jQuery, Bootstrap 4, WordPress, Git, GitHub', 'Carlos Arturo Esparza', 'https://i.udemycdn.com/course/480x270/672600_1def_7.jpg', 199.99, 1, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
