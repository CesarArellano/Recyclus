-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-12-2020 a las 14:24:47
-- Versión del servidor: 5.7.32-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ic19cav`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`ic19cav`@`localhost` PROCEDURE `autorizarFoto` (IN `idFotoTemp` INT(20), IN `idUsuarioTemp` BIGINT(20), IN `idAlbumTemp` INT(20), IN `mensajeTemp` VARCHAR(500) CHARSET utf8)  BEGIN
    DECLARE siguienteUsuario, Salida INT;
    DECLARE cursorUsuarios CURSOR FOR SELECT idUsuario FROM Suscripciones WHERE idAlbum = idAlbumTemp;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET Salida = 1;
	SET Salida = 0;
	UPDATE Fotos SET autorizada = 1 WHERE idFoto = idFotoTemp;
	INSERT INTO Notificaciones(idAlbum, contenido) VALUES(idAlbumTemp, mensajeTemp);
    OPEN cursorUsuarios;
    	FETCH cursorUsuarios INTO siguienteUsuario;
    notificarCadaUsuario: WHILE
	Salida = 0 DO
   	 INSERT INTO NotificacionesLeidas(idNotificacion, idUsuario, estado) VALUES(obtenerUltimaNotificacion(), siguienteUsuario, 'No Leída');
     FETCH cursorUsuarios INTO siguienteUsuario;
    END WHILE notificarCadaUsuario;
    CLOSE cursorUsuarios;
END$$

CREATE DEFINER=`ic19cav`@`localhost` PROCEDURE `MejorPromedio` (OUT `Mejor_Promedio` DECIMAL(5,2), OUT `Mejor_Alumno` CHAR(40))  BEGIN
	DECLARE Salida,Calif,Contador INT;
    DECLARE NomAlumno CHAR(40);
    DECLARE Promedio, CalTotal DECIMAL(5,2);
    DECLARE CurCalif CURSOR FOR 
		SELECT Calificacion FROM vestudiantes WHERE Nombre = NomAlumno;
	DECLARE CurAlumnos CURSOR FOR 
		SELECT Nombre FROM a_Alumnos;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET Salida = 1;
	SET Promedio = 0;
	SET CalTotal = 0;
	SET Contador = 0;
    SET Salida = 0;
    OPEN CurAlumnos;
    Cur_Al: REPEAT
        FETCH CurAlumnos INTO NomAlumno;
        IF Salida = 1  THEN
            LEAVE Cur_Al;
        END IF;
        OPEN CurCalif;
        Cur_Cal: REPEAT
            FETCH CurCalif INTO Calif;
            IF Salida = 1 THEN
                LEAVE Cur_Cal;
            END IF;
            SET CalTotal = CalTotal + Calif;
            SET Contador = Contador + 1;
            UNTIL Salida = 1
        END REPEAT Cur_Cal;
        CLOSE CurCalif;
        SET Salida = 0;
        IF Contador > 0 THEN
            SET CalTotal = CalTotal /Contador;
        END IF;
        IF Promedio < CalTotal THEN
            SET Mejor_Alumno =  NomAlumno;
            SET Promedio = CalTotal;
        END IF;
        SET CalTotal = 0;
        SET Contador = 0;
        UNTIL Salida = 1
    END REPEAT Cur_al;
    CLOSE CurAlumnos;
    SET Mejor_Promedio = Promedio;
END$$

CREATE DEFINER=`ic19cav`@`localhost` PROCEDURE `MejorPromedio2` (OUT `Mejor_Promedio` DECIMAL(5,2), OUT `Mejor_Alumno` CHAR(40))  BEGIN
	DECLARE Salida INT;
    DECLARE NomAlumno CHAR(40);
    DECLARE Promedio, TempProm DECIMAL(5,2);
    DECLARE CurCalif CURSOR FOR
		SELECT Nombre,AVG(Calificacion) FROM verestudiantes GROUP BY Nombre;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET Salida = 1;
	SET Promedio = 0;
  SET Salida = 0;
  OPEN CurCalif;
  Cur_Calif: REPEAT
	FETCH CurCalif INTO NomAlumno,TempProm;
      IF Salida = 1  THEN
          LEAVE Cur_Calif;
      END IF;
      IF TempProm > Promedio THEN
		SET Mejor_Alumno = NomAlumno;
		SET Promedio = TempProm;
      END IF;
	UNTIL Salida = 1
  END REPEAT Cur_Calif;
  CLOSE CurCalif;
  SET Mejor_Promedio = Promedio;
END$$

CREATE DEFINER=`ic19cav`@`localhost` PROCEDURE `MejorPromedio3` (OUT `Mejor_Promedio` DECIMAL(5,2), OUT `Mejor_Alumno` CHAR(40))  BEGIN
	DECLARE CurCalif CURSOR FOR SELECT Nombre,AVG(Calificacion) AS Promedio FROM verestudiantes GROUP BY Nombre ORDER BY Promedio DESC LIMIT 1;
	OPEN CurCalif;
		FETCH CurCalif INTO Mejor_Alumno, Mejor_Promedio;
	CLOSE CurCalif;
END$$

CREATE DEFINER=`ic19cav`@`localhost` PROCEDURE `nacio_en_anio` (`anio_nacimiento` INT)  SELECT nombre, ap_paterno, nacimiento, muerte FROM presidentes WHERE YEAR(nacimiento) = anio_nacimiento$$

--
-- Funciones
--
CREATE DEFINER=`ic19cav`@`localhost` FUNCTION `edad` (`date1` DATE, `date2` DATE) RETURNS INT(11) BEGIN
DECLARE age INT;
SET age = (YEAR(date2)-YEAR(date1))-IF(RIGHT(date2,5) < RIGHT(date1,5),1,0);
RETURN age;
END$$

CREATE DEFINER=`ic19cav`@`localhost` FUNCTION `factorial_loop` (`numero` INT) RETURNS INT(11) BEGIN
DECLARE resultado, contador INT;
SET resultado = 1;
SET contador = 1;
factorial: LOOP
    SET resultado = resultado * contador;
    SET contador = contador + 1;
    IF (contador > numero) THEN
        LEAVE factorial;
    END IF;
END LOOP factorial;
RETURN resultado;
END$$

CREATE DEFINER=`ic19cav`@`localhost` FUNCTION `factorial_repeat` (`numero` INT) RETURNS INT(11) BEGIN
    DECLARE resultado, contador INT;
  SET resultado = 1;
  SET contador = 1;
  REPEAT
    SET resultado = resultado * contador;
    SET contador = contador + 1;
  UNTIL contador > numero
  END REPEAT;
RETURN resultado;
END$$

CREATE DEFINER=`ic19cav`@`localhost` FUNCTION `factorial_while` (`numero` INT) RETURNS INT(11) BEGIN
DECLARE resultado, contador INT;
SET resultado = 1;
SET contador = 1;
factorial: WHILE
    contador <= numero DO
        SET resultado = resultado * contador;
        SET contador = contador + 1;
    END WHILE factorial;
RETURN resultado;
END$$

CREATE DEFINER=`ic19cav`@`localhost` FUNCTION `obtenerUltimaNotificacion` () RETURNS INT(20) BEGIN
    DECLARE ultimaNotificacion INT;
	DECLARE cursorIdNotificacion CURSOR FOR SELECT idNotificacion FROM Notificaciones ORDER BY idNotificacion DESC LIMIT 1;
    OPEN cursorIdNotificacion;
    	FETCH cursorIdNotificacion INTO ultimaNotificacion;
    CLOSE cursorIdNotificacion;
    RETURN ultimaNotificacion;
END$$

CREATE DEFINER=`ic19cav`@`localhost` FUNCTION `potencia_loop` (`base` INT, `exponente` INT) RETURNS INT(11) BEGIN
DECLARE resultado, contador INT;
  SET resultado = 1;
  SET contador = 1;
  potencia: LOOP
    SET resultado = resultado * base;
    SET contador = contador + 1;
    IF contador > exponente THEN
      LEAVE potencia;
    END IF;
  END LOOP potencia;
RETURN resultado;
END$$

CREATE DEFINER=`ic19cav`@`localhost` FUNCTION `potencia_repeat` (`base` INT, `exponente` INT) RETURNS INT(11) BEGIN
    DECLARE resultado, contador INT;
    SET resultado = 1;
    SET contador = 1;
    potencia: REPEAT
        SET resultado = resultado * base;
        SET contador = contador + 1;
    UNTIL contador > exponente
    END REPEAT potencia;
RETURN resultado;
END$$

CREATE DEFINER=`ic19cav`@`localhost` FUNCTION `potencia_while` (`base` INT, `exponente` INT) RETURNS INT(11) BEGIN
    DECLARE resultado, contador INT;
    SET resultado = 1;
    SET contador = 1;
    potencia: WHILE
    contador <= exponente DO
        SET resultado = resultado * base;
        SET contador = contador + 1;
    END WHILE potencia;
RETURN resultado;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contribucionesDesechos`
--

CREATE TABLE `contribucionesDesechos` (
  `idContribucionD` int(11) NOT NULL,
  `puntoReciclaje` varchar(80) NOT NULL,
  `tipoDesecho` varchar(80) NOT NULL,
  `tipoProducto` varchar(80) NOT NULL,
  `peso` decimal(8,2) NOT NULL,
  `estadoContribucion` tinyint(1) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contribucionesDesechos`
--

INSERT INTO `contribucionesDesechos` (`idContribucionD`, `puntoReciclaje`, `tipoDesecho`, `tipoProducto`, `peso`, `estadoContribucion`, `idUsuario`) VALUES
(1, 'Lugar 4', 'Orgánico', 'Frutas', '19.40', 0, 11),
(2, 'Lugar 3', 'Inorgánico', 'Plástico', '50.00', 0, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contribucionesTecnologicas`
--

CREATE TABLE `contribucionesTecnologicas` (
  `idContribucionT` int(11) NOT NULL,
  `puntoReciclaje` varchar(80) NOT NULL,
  `tipoProducto` varchar(50) NOT NULL,
  `nombreProducto` varchar(80) NOT NULL,
  `marcaProducto` varchar(80) NOT NULL,
  `descripcionProducto` varchar(300) NOT NULL,
  `gamaProducto` varchar(80) NOT NULL,
  `tiempoUsoProducto` int(11) NOT NULL,
  `estadoContribucion` tinyint(1) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contribucionesTecnologicas`
--

INSERT INTO `contribucionesTecnologicas` (`idContribucionT`, `puntoReciclaje`, `tipoProducto`, `nombreProducto`, `marcaProducto`, `descripcionProducto`, `gamaProducto`, `tiempoUsoProducto`, `estadoContribucion`, `idUsuario`) VALUES
(1, 'Lugar 2', 'Teléfono', 'Huawei P10', 'Huawei', 'Todo sirve, solo le falla la huella', 'Media', 3, 0, 4),
(2, 'Lugar 2', 'Teléfono', 'Redmi Note 6', 'Xiaomi', 'Equipo en buen estado', 'Alta', 2, 0, 11),
(3, 'Lugar 2', 'Teléfono', 'S7', 'Samsung', 'Todo funciona genial pero quiero cambiarlo', 'Alta', 4, 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccionesUsuarios`
--

CREATE TABLE `direccionesUsuarios` (
  `idDireccion` int(11) NOT NULL,
  `pais` varchar(80) NOT NULL,
  `provincia` varchar(80) NOT NULL,
  `municipio` varchar(80) NOT NULL,
  `colonia` varchar(80) NOT NULL,
  `calle` varchar(80) NOT NULL,
  `codigoPostal` varchar(10) NOT NULL,
  `latitud` decimal(10,6) NOT NULL,
  `longitud` decimal(10,6) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direccionesUsuarios`
--

INSERT INTO `direccionesUsuarios` (`idDireccion`, `pais`, `provincia`, `municipio`, `colonia`, `calle`, `codigoPostal`, `latitud`, `longitud`, `idUsuario`) VALUES
(1, 'Colombia', 'valle del cauca', 'Valle', 'Cali', '34', '76001', '3.451600', '-76.532000', 4),
(2, 'México', 'Estado de México', 'Tecámac', 'Villa del Real 5ta Sección', 'Privada Lucca', '55749', '19.673422', '-98.978301', 11),
(3, 'Argentina', 'Salta', 'Salta', 'Capital', 'Barlarce 514', '4400', '-24.846840', '-65.450056', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `idNotificacion` int(11) NOT NULL,
  `contenido` varchar(300) NOT NULL,
  `tipoContribucion` int(11) DEFAULT NULL,
  `idContribucion` int(11) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`idNotificacion`, `contenido`, `tipoContribucion`, `idContribucion`, `idUsuario`) VALUES
(1, 'El dia de mañana ', 1, 3, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntosALiberar`
--

CREATE TABLE `puntosALiberar` (
  `idPuntoLiberar` int(11) NOT NULL,
  `tipoPuntos` varchar(50) NOT NULL,
  `puntos` int(11) NOT NULL,
  `idContribucion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntosLiberados`
--

CREATE TABLE `puntosLiberados` (
  `idPuntoLiberado` int(11) NOT NULL,
  `puntosT` int(11) NOT NULL,
  `puntosO` int(11) NOT NULL,
  `puntosI` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `nombreRol`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(100) NOT NULL,
  `apPaternoUsuario` varchar(50) NOT NULL,
  `apMaternoUsuario` varchar(50) NOT NULL,
  `telefonoUsuario` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(70) NOT NULL,
  `puntos` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombreUsuario`, `apPaternoUsuario`, `apMaternoUsuario`, `telefonoUsuario`, `email`, `password`, `puntos`, `activo`, `idRol`) VALUES
(1, 'César Mauricio', 'Arellano', 'Velásquez', '+525567879498', 'cesarmauricio.arellano@gmail.com', '$2y$10$GDyjuv3zIuxlxXm/lhlkCulR6lZ1mJTKeTIIdd/N.zytYMmRjT6IW', 300, 1, 2),
(2, 'Daniela Alejandra', 'Flores', 'Poblete', '+56971228958', 'daniela.flores.p29@gmail.com', '$2y$10$wAE9Fd.WQyVBx6SpW5SR/utL44Ho1O6UD1R3SOiOPjXapri3lDF9u', 1000, 1, 2),
(3, 'Joaquin', 'Macaroff', 'Perez', '3874779262', 'jomax1398@gmail.com', '$2y$10$1ffht2EKQZU1Og/wYYkxGubMCMFsfmgnGwMp6I.8gnnbO.YryJ1T.', 300, 1, 2),
(4, 'Allison', 'García', 'Garzón', '3168233662', 'allison.giseth@gmail.com', '$2y$10$2OFXoTTsfJUo6zi1kdJ6Fu6kJDgv3mJ06Ht27rt7TAOiTmSobEmUS', 1000, 1, 2),
(5, 'Maria', 'Gallego', 'Gongora', '662937410', 'maria.gallegogongora@gmail.com', '$2y$10$IGisPjqEKLgQM8GnnoNkkOVexzjiw5PShTjUueNsGx4j8NT.FMd4a', 1000, 1, 2),
(6, 'César', 'Arellano', 'Velásquez', '5544332211', 'raywayday@gmail.com', '$2y$10$GDyjuv3zIuxlxXm/lhlkCulR6lZ1mJTKeTIIdd/N.zytYMmRjT6IW', 0, 1, 1),
(7, 'PATRICIA CAROL', 'VELASQUEZ', 'RIVERA', '+15567879498', 'virushkacatherine@hotmail.com', '$2y$10$8C4hntewu.N8xsZ5GGW4ROGbv9zP5NMiUW4lliPbNaKQEh0BYOdya', 0, 1, 1),
(9, 'Joaquin Antonio', 'Macaroff', 'Perez', '3874779262', 'joaquin.macaroff@hotmail.com', '$2y$10$687q4slFcKs51rXTUoX4VOph1WdAs3mj0PZpoVkRNRsMuZYqU80LK', 100, 0, 2),
(10, 'Antonio', 'Macaroff', 'Perez', '3874779262', 'joantmacaroff_perez@hotmail.com', '$2y$10$EPZTCfO1sAheo5qJtmotKetSoEML1gjpA3OLXSgL8gTJM6x1gdWQ2', 100, 1, 2),
(11, 'César Mauricio', 'Arellano', 'Velásquez', '+525567879498', 'cesarmau2011@live.com.mx', '$2y$10$hjMdCQXm5xn8Jke8Uelh7./6Fr8xCsFW0lRdlwO/qU4l6tjWjrEeC', 100, 1, 2),
(12, 'Administrador', 'Sistema', 'Admin', '+525567879492', 'admin@gmail.com', '$2y$10$saJH.KCPIawVWEj.3XLwVOz2dhDDaGaN.l9to3fFNgCCJ4HGp6PgG', 0, 1, 1),
(13, 'Ulises', 'Magaña', 'Estrada', '30984129123', 'ulises@mail.com', '$2y$10$Vp6JcUxgTKzOku9WWoxOtu.aCEMdXJOZrbdJnpAzIs8J0QyfKO/mG', 0, 0, 2),
(14, 'Ulises', 'Magaña', 'Estrada', '30984129123', 'ulises.st.99@gmail.com', '$2y$10$nzFGebhA4vHRkXaGqIt/TOwRE5BiN1.u49Q7/mZ4AB4AZsUV6NZCy', 0, 1, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contribucionesDesechos`
--
ALTER TABLE `contribucionesDesechos`
  ADD PRIMARY KEY (`idContribucionD`),
  ADD KEY `idUsuario_contribucionesDesechos` (`idUsuario`);

--
-- Indices de la tabla `contribucionesTecnologicas`
--
ALTER TABLE `contribucionesTecnologicas`
  ADD PRIMARY KEY (`idContribucionT`),
  ADD KEY `idUsuario_contribucionesTecnologicas` (`idUsuario`);

--
-- Indices de la tabla `direccionesUsuarios`
--
ALTER TABLE `direccionesUsuarios`
  ADD PRIMARY KEY (`idDireccion`),
  ADD UNIQUE KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`idNotificacion`),
  ADD KEY `idUsuario_Notificaciones` (`idUsuario`);

--
-- Indices de la tabla `puntosALiberar`
--
ALTER TABLE `puntosALiberar`
  ADD PRIMARY KEY (`idPuntoLiberar`);

--
-- Indices de la tabla `puntosLiberados`
--
ALTER TABLE `puntosLiberados`
  ADD PRIMARY KEY (`idPuntoLiberado`),
  ADD KEY `idUsuario_puntosLiberados` (`idUsuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idRol_usuarios` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contribucionesDesechos`
--
ALTER TABLE `contribucionesDesechos`
  MODIFY `idContribucionD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `contribucionesTecnologicas`
--
ALTER TABLE `contribucionesTecnologicas`
  MODIFY `idContribucionT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `direccionesUsuarios`
--
ALTER TABLE `direccionesUsuarios`
  MODIFY `idDireccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `idNotificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `puntosALiberar`
--
ALTER TABLE `puntosALiberar`
  MODIFY `idPuntoLiberar` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `puntosLiberados`
--
ALTER TABLE `puntosLiberados`
  MODIFY `idPuntoLiberado` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contribucionesDesechos`
--
ALTER TABLE `contribucionesDesechos`
  ADD CONSTRAINT `idUsuario_contribucionesDesechos` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `contribucionesTecnologicas`
--
ALTER TABLE `contribucionesTecnologicas`
  ADD CONSTRAINT `idUsuario_contribucionesTecnologicas` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `direccionesUsuarios`
--
ALTER TABLE `direccionesUsuarios`
  ADD CONSTRAINT `idUsuario_direccionesUsuarios` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `idUsuario_Notificaciones` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `puntosLiberados`
--
ALTER TABLE `puntosLiberados`
  ADD CONSTRAINT `idUsuario_puntosLiberados` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `idRol_usuarios` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
