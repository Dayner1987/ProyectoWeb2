-- MySQL Forward Engineering para bdPeluqueria (versión mejorada)
-- Collation utf8mb4_spanish_ci

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bdPeluqueria
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bdPeluqueria` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;
USE `bdPeluqueria`;

-- -----------------------------------------------------
-- Tabla Roles
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Roles` (
    `idRoles` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombreRol` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`idRoles`),
    UNIQUE INDEX `nombreRol_UNIQUE` (`nombreRol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- -----------------------------------------------------
-- Tabla Usuarios
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Usuarios` (
    `idUsuarios` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombreUsuario` VARCHAR(45) NOT NULL,
    `ciUsuario` VARCHAR(20) NOT NULL,
    `mailUsuario` VARCHAR(45) NOT NULL UNIQUE,
    `contrasenia` VARCHAR(200) NOT NULL,
    `Roles_idRoles` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`idUsuarios`),
    FOREIGN KEY (`Roles_idRoles`) REFERENCES `Roles`(`idRoles`)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- -----------------------------------------------------
-- Tabla Servicios
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Servicios` (
    `idServicios` INT NOT NULL AUTO_INCREMENT,
    `nombreServicio` VARCHAR(25) NOT NULL,
    `costoServicio` DOUBLE NOT NULL,
    `descripcionServicio` TEXT NULL,
    PRIMARY KEY (`idServicios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- -----------------------------------------------------
-- Tabla intermedia Servicios_Empleados (muchos a muchos)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Servicios_Empleados` (
    `servicio_id` INT UNSIGNED NOT NULL,
    `empleado_id` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`servicio_id`, `empleado_id`),
    FOREIGN KEY (`servicio_id`) REFERENCES `Servicios`(`idServicios`)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`empleado_id`) REFERENCES `Usuarios`(`idUsuarios`)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- -----------------------------------------------------
-- Tabla Disponibilidades
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Disponibilidades` (
    `idDisponibilidad` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `empleado_id` INT UNSIGNED NOT NULL,
    `fecha` DATE NOT NULL,
    `horaInicio` TIME NOT NULL,
    `horaFin` TIME NOT NULL,
    PRIMARY KEY (`idDisponibilidad`),
    FOREIGN KEY (`empleado_id`) REFERENCES `Usuarios`(`idUsuarios`)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- -----------------------------------------------------
-- Tabla Reservas
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Reservas` (
    `idReservas` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `cliente_id` INT UNSIGNED NOT NULL,
    `disponibilidad_id` INT UNSIGNED NOT NULL,
    `hora` TIME NOT NULL,
    `detalle` TEXT NULL,
    `estado` ENUM('pendiente','confirmada','cancelada') DEFAULT 'pendiente',
    PRIMARY KEY (`idReservas`),
    FOREIGN KEY (`cliente_id`) REFERENCES `Usuarios`(`idUsuarios`)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`disponibilidad_id`) REFERENCES `Disponibilidades`(`idDisponibilidad`)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- -----------------------------------------------------
-- Tabla intermedia Reservas_Servicios (muchos a muchos)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Reservas_Servicios` (
    `reserva_id` INT UNSIGNED NOT NULL,
    `servicio_id` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`reserva_id`, `servicio_id`),
    FOREIGN KEY (`reserva_id`) REFERENCES `Reservas`(`idReservas`)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`servicio_id`) REFERENCES `Servicios`(`idServicios`)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- -----------------------------------------------------
-- Tabla Empresa
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Empresa` (
    `idEmpresa` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombreEmpresa` VARCHAR(45) NOT NULL,
    `imageLogo` VARCHAR(60) NULL,
    `imageQR` VARCHAR(60) NULL,
    `numeroE` VARCHAR(15) NULL,
    `correoE` VARCHAR(30) NULL,
    `DireccionE` VARCHAR(100) NULL,
    PRIMARY KEY (`idEmpresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Restaurar configuración
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
