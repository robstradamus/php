-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 27, 2025 at 10:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_biblioteca`
--

-- --------------------------------------------------------

--
-- Table structure for table `detalleprestamo`
--

CREATE TABLE `detalleprestamo` (
  `cod_detalle` int(11) NOT NULL,
  `cod_prestamo` int(11) DEFAULT NULL,
  `cod_libro` int(11) DEFAULT NULL,
  `observaciones` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detalleprestamo`
--
-- --------------------------------------------------------

--
-- Table structure for table `libro`
--

CREATE TABLE `libro` (
  `cod_libro` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `editorial` varchar(100) DEFAULT NULL,
  `f_edicion` date DEFAULT NULL,
  `idioma` varchar(100) DEFAULT NULL,
  `cant_pag` int(11) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `libro`
--

INSERT INTO `libro` (`cod_libro`, `titulo`, `editorial`, `f_edicion`, `idioma`, `cant_pag`, `estado`) VALUES
(2, 'Sobre Mí', 'Editorial 1', '2025-05-05', 'Ingles', 325, 'Prestado'),
(3, 'Cien Años de Soledad', 'Sudamericana', '1967-05-30', 'Español', 417, 'En Reparacion'),
(4, '1984', 'Secker & Warburg', '1949-06-08', 'Inglés', 328, 'En Reparacion'),
(5, 'Don Quijote de la Mancha', 'Francisco de Robles', '1605-01-16', 'Español', 863, 'Prestado'),
(6, 'Orgullo y Prejuicio', 'T. Egerton', '1813-01-28', 'Inglés', 432, 'Prestado'),
(7, 'El Principito', 'Gallimard', '1943-04-06', 'Francés', 96, 'Prestado'),
(8, 'La Sombra del Viento', 'Planeta', '2001-04-12', 'Español', 565, 'Prestado'),
(9, 'Harry Potter y la Piedra Filosofal', 'Bloomsbury', '1997-06-26', 'Inglés', 223, 'Prestado'),
(10, 'Los Juegos del Hambre', 'Scholastic Press', '2008-09-14', 'Inglés', 374, 'En Biblioteca'),
(11, 'Crónica de una Muerte Anunciada', 'Sudamericana', '1981-03-01', 'Español', 120, 'En Biblioteca'),
(12, 'Rayuela', 'Sudamericana', '1963-06-28', 'Español', 688, 'En Biblioteca'),
(15, 'Cien años de soledad', 'Sudamericana', '1967-05-30', 'Español', 417, 'En Biblioteca'),
(16, '1984', 'Secker & Warburg', '1949-06-08', 'Inglés', 328, 'En Biblioteca'),
(17, 'El Principito', 'Reynal & Hitchcock', '1943-04-06', 'Francés', 96, 'Prestado'),
(18, 'Don Quijote de la Mancha', 'Francisco de Robles', '1605-01-16', 'Español', 863, 'En Biblioteca'),
(19, 'La sombra del viento', 'Planeta', '2001-04-12', 'Español', 565, 'En Biblioteca'),
(20, 'Crónica de una muerte anunciada', 'Editorial Oveja Negra', '1981-03-01', 'Español', 122, 'En Biblioteca'),
(21, 'Fahrenheit 451', 'Ballantine Books', '1953-10-19', 'Inglés', 249, 'Prestado'),
(22, 'El nombre de la rosa', 'Bompiani', '1980-09-01', 'Italiano', 512, 'En Biblioteca'),
(23, 'Rayuela', 'Sudamericana', '1963-06-28', 'Español', 736, 'En Biblioteca'),
(24, 'El perfume', 'Diogenes Verlag', '1985-10-01', 'Alemán', 255, 'En Reparacion');

-- --------------------------------------------------------

--
-- Table structure for table `prestamo`
--

CREATE TABLE `prestamo` (
  `cod_prestamo` int(11) NOT NULL,
  `f_prestamo` date DEFAULT NULL,
  `f_devolucion` date DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `cod_socio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prestamo`
--
-- --------------------------------------------------------

--
-- Table structure for table `reparacion`
--

CREATE TABLE `reparacion` (
  `cod_reparacion` int(11) NOT NULL,
  `cod_libro` int(11) DEFAULT NULL,
  `f_ingreso` date DEFAULT NULL,
  `f_egreso` date DEFAULT NULL,
  `motivo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reparacion`
--
-- --------------------------------------------------------

--
-- Table structure for table `socio`
--

CREATE TABLE `socio` (
  `cod_socio` int(11) NOT NULL,
  `nom_socio` varchar(100) DEFAULT NULL,
  `f_nacimiento` date DEFAULT NULL,
  `dir_socio` varchar(100) DEFAULT NULL,
  `tel_socio` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `socio`
--
-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usser` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detalleprestamo`
--
ALTER TABLE `detalleprestamo`
  ADD PRIMARY KEY (`cod_detalle`),
  ADD KEY `cod_prestamo` (`cod_prestamo`),
  ADD KEY `cod_libro` (`cod_libro`);

--
-- Indexes for table `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`cod_libro`);

--
-- Indexes for table `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`cod_prestamo`),
  ADD KEY `cod_socio` (`cod_socio`);

--
-- Indexes for table `reparacion`
--
ALTER TABLE `reparacion`
  ADD PRIMARY KEY (`cod_reparacion`),
  ADD KEY `cod_libro` (`cod_libro`);

--
-- Indexes for table `socio`
--
ALTER TABLE `socio`
  ADD PRIMARY KEY (`cod_socio`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detalleprestamo`
--
ALTER TABLE `detalleprestamo`
  MODIFY `cod_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `libro`
--
ALTER TABLE `libro`
  MODIFY `cod_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `cod_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reparacion`
--
ALTER TABLE `reparacion`
  MODIFY `cod_reparacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `socio`
--
ALTER TABLE `socio`
  MODIFY `cod_socio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalleprestamo`
--
ALTER TABLE `detalleprestamo`
  ADD CONSTRAINT `detalleprestamo_ibfk_1` FOREIGN KEY (`cod_prestamo`) REFERENCES `prestamo` (`cod_prestamo`),
  ADD CONSTRAINT `detalleprestamo_ibfk_2` FOREIGN KEY (`cod_libro`) REFERENCES `libro` (`cod_libro`);

--
-- Constraints for table `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`cod_socio`) REFERENCES `socio` (`cod_socio`);

--
-- Constraints for table `reparacion`
--
ALTER TABLE `reparacion`
  ADD CONSTRAINT `reparacion_ibfk_1` FOREIGN KEY (`cod_libro`) REFERENCES `libro` (`cod_libro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
