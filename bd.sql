create database farm;
use farm;

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `categoria` varchar(30) NOT NULL
);

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text,
  `Precio` double DEFAULT NULL,
  `Stock` int(11) NOT NULL,
  `Imagen` varchar(100) DEFAULT NULL,
  `Status` tinyint(1) NOT NULL
);

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `Nick` varchar(55) NOT NULL,
  `Contrasenia` varchar(200) NOT NULL,
  `Tipo` varchar(50) NOT NULL
);

INSERT INTO `usuario` (`idUsuario`, `Nick`, `Contrasenia`, `Tipo`) VALUES
(1, 'admin', 'd3efd2a51cb300369c10d9c413317722ca520ac1fde5bb93d3ae59ffa016292b87358d13e98249fbd5f5968fccabd7795254d57d16fb746efe0e22e6ed8c0893bWzPku4scG+2E9DjqNMUsaMR9Yzuc2+T9iIW6lyR0ws=', 'Administrador'),

CREATE TABLE `venta` (
  `idVenta` int(11) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL,
  `Total` double NOT NULL,
  `_idUsuario` int(11) DEFAULT NULL
);


CREATE TABLE `venta_contiene_producto` (
  `_idVenta` int(11) NOT NULL,
  `_idProducto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
);

ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

ALTER TABLE `venta`
  ADD PRIMARY KEY (`idVenta`),
  ADD KEY `Usuario_idx` (`_idUsuario`);

ALTER TABLE `venta_contiene_producto`
  ADD PRIMARY KEY (`_idVenta`,`_idProducto`),
  ADD KEY `Producto_idx` (`_idProducto`);

ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `venta`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;
