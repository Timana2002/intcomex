-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2022 a las 21:47:00
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `systemstudents`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ratings`
--

CREATE TABLE `ratings` (
  `id_rating` int(11) NOT NULL,
  `fk_subject_id` int(11) NOT NULL,
  `fk_user_student` int(11) NOT NULL,
  `rating_assign` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ratings`
--

INSERT INTO `ratings` (`id_rating`, `fk_subject_id`, `fk_user_student`, `rating_assign`) VALUES
(1, 1, 3, 45),
(2, 1, 4, 30),
(3, 1, 3, 29),
(4, 1, 4, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `description_rol` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `description_rol`) VALUES
(1, 'Administrador'),
(2, 'Estudiante'),
(3, 'Profesor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subjects`
--

CREATE TABLE `subjects` (
  `id_subject` int(11) NOT NULL,
  `description_subject` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fk_user_teacher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `subjects`
--

INSERT INTO `subjects` (`id_subject`, `description_subject`, `fk_user_teacher`) VALUES
(1, 'Matematicas', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subject_student`
--

CREATE TABLE `subject_student` (
  `id_sub_st` int(11) NOT NULL,
  `fk_user_student` int(11) NOT NULL,
  `fk_subject_st` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `subject_student`
--

INSERT INTO `subject_student` (`id_sub_st`, `fk_user_student`, `fk_subject_st`, `date`) VALUES
(1, 3, 1, '2022-03-15 18:34:59'),
(2, 4, 1, '2022-03-15 18:35:03'),
(3, 3, 1, '2022-03-15 21:25:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `token_user` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `second_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `name_user` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fk_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `token_user`, `first_name`, `second_name`, `name_user`, `password`, `fk_rol`) VALUES
(1, '84d818e1543d1fbe1be2a14cee5ebb74', 'Administrador', 'Administrador', 'admin.admin', '$2y$10$I9ZgQBL.3yuReOqfu398.O.gThxvftYGFTTey8iezi8wdIGhIVl0W', 1),
(2, 'f499ca69b4bf22a208cbb13f4f0e086f', 'Profesor', '1', 'profesor1.user', '$2y$10$5P4RjqeM18pX2Srjx/dSWepG1Zaf4uljEWpP8M3zL4BnV/y8NzoIa', 3),
(3, 'fb1ac6cd56f31fe51a30697d458b3f76', 'estudiante', '1', 'estu1.user', '$2y$10$51It2EPV/dVc0F6iISwPq.I5M6QF5anm8QWm.K2lWU9ziSrq3TXr.', 2),
(4, '1ff7ca35b27201b1abbc09465df4c32e', 'estudiante', '2', 'estu2.user', '$2y$10$cJ2FOouCZR3CstRWtVIVfOXnlsgnypHNVWPwVrjdKI2XFPjgfkmhC', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `fk_subject_id` (`fk_subject_id`),
  ADD KEY `fk_user_student` (`fk_user_student`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id_subject`),
  ADD KEY `fk_user_teacher` (`fk_user_teacher`);

--
-- Indices de la tabla `subject_student`
--
ALTER TABLE `subject_student`
  ADD PRIMARY KEY (`id_sub_st`),
  ADD KEY `fk_user_student` (`fk_user_student`),
  ADD KEY `fk_subject_st` (`fk_subject_st`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_rol` (`fk_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id_subject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `subject_student`
--
ALTER TABLE `subject_student`
  MODIFY `id_sub_st` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`fk_subject_id`) REFERENCES `subjects` (`id_subject`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`fk_user_student`) REFERENCES `users` (`id_user`);

--
-- Filtros para la tabla `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`fk_user_teacher`) REFERENCES `users` (`id_user`);

--
-- Filtros para la tabla `subject_student`
--
ALTER TABLE `subject_student`
  ADD CONSTRAINT `subject_student_ibfk_1` FOREIGN KEY (`fk_user_student`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `subject_student_ibfk_2` FOREIGN KEY (`fk_subject_st`) REFERENCES `subjects` (`id_subject`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
