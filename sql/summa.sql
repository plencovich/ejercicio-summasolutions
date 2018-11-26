-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-11-2018 a las 19:52:46
-- Versión del servidor: 10.1.34-MariaDB-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `summa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `business`
--

CREATE TABLE `business` (
  `b_id` int(11) NOT NULL,
  `b_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `business`
--

INSERT INTO `business` (`b_id`, `b_name`) VALUES
(1, 'Summa Solutions');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `e_id` int(11) NOT NULL,
  `e_first_name` varchar(60) NOT NULL,
  `e_last_name` varchar(60) NOT NULL,
  `e_age` tinyint(2) NOT NULL,
  `e_type` tinyint(1) NOT NULL,
  `e_sub_type` int(11) NOT NULL,
  `e_biz_id` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees_sub_type`
--

CREATE TABLE `employees_sub_type` (
  `est_id` int(11) NOT NULL,
  `est_et_id` int(11) NOT NULL,
  `est_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `employees_sub_type`
--

INSERT INTO `employees_sub_type` (`est_id`, `est_et_id`, `est_name`) VALUES
(1, 1, 'PHP'),
(2, 1, 'NET'),
(3, 1, 'Python'),
(4, 2, 'Gráfico'),
(5, 2, 'Web');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees_type`
--

CREATE TABLE `employees_type` (
  `et_id` int(11) NOT NULL,
  `et_name` varchar(20) NOT NULL,
  `et_question_text` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `employees_type`
--

INSERT INTO `employees_type` (`et_id`, `et_name`, `et_question_text`) VALUES
(1, 'Programador', 'Lenguaje en el que programa'),
(2, 'Diseñador', 'Tipo de Diseñador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`b_id`),
  ADD UNIQUE KEY `b_id` (`b_id`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`e_id`),
  ADD UNIQUE KEY `e_id` (`e_id`),
  ADD KEY `e_biz_id` (`e_biz_id`);

--
-- Indices de la tabla `employees_sub_type`
--
ALTER TABLE `employees_sub_type`
  ADD UNIQUE KEY `est_id` (`est_id`),
  ADD KEY `est_et_id` (`est_et_id`);

--
-- Indices de la tabla `employees_type`
--
ALTER TABLE `employees_type`
  ADD PRIMARY KEY (`et_id`),
  ADD UNIQUE KEY `et_id` (`et_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `business`
--
ALTER TABLE `business`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `employees_sub_type`
--
ALTER TABLE `employees_sub_type`
  MODIFY `est_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `employees_type`
--
ALTER TABLE `employees_type`
  MODIFY `et_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
