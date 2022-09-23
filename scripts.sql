CREATE TABLE ventas_flotantes(
	id_flot int not null auto_increment,
    tipo_venta varchar(50),
    correlativo varchar(25),
    sucursal varchar(50),
    id_producto int,
    categoria_prod varchar(50),
    id_paciente int,
    id_usuario int,
    primary key(id_flot),
    foreign key(id_producto) references productos(id_producto),
    foreign key(id_paciente) references pacientes(id_paciente),
    foreign key(id_usuario) references usuarios(id_usuario)
);

ALTER TABLE `ventas_flotantes` 
ADD COLUMN `id_ingreso` VARCHAR(4) NULL DEFAULT NULL AFTER `id_usuario`,
ADD COLUMN `categoria_ub` VARCHAR(100) NULL DEFAULT NULL AFTER `id_ingreso`,
ADD COLUMN `num_compra` VARCHAR(45) NULL DEFAULT NULL AFTER `categoria_ub`;

/*/////////////////////////BUS ORDENES DE DESCUENTO EN PLANILLA ///////*/
alter table creditos  add column numero_orden varchar(50) null DEFAULT '0';
alter table ventas add add column n_orden varchar(50) null DEFAULT '0'; 
INSERT INTO `permisos` (`id_permiso`, `nombre`) VALUES (NULL, 'Control_labs');
-- #######

create table correlativo_ventas(
id_correlativo INT auto_increment not null,
numero_correlativo varchar(50) not null unique,
sucursal varchar(100),
primary key(id_correlativo)
);




/*////////////////////CAMBIOS VENTAS CREDITOS AGRPADAS*/

-- #MODIFICAR TABLA VENTAS Y CREDITOS

CREATE TABLE ordenes_lab(
id_orden_lab INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
cod_orden varchar(25) unique not null,
paciente varchar(200),
empresa varchar(200),
laboratorio varchar(150),
lente varchar(250),
modelo_aro varchar(25),
marca_aro varchar(50),
color_aro varchar(15) null,
diseno_aro varchar(50) null,
usuario varchar(100),
sucursal varchar(100) not null,
prioridad varchar(5) not null
);

ALTER TABLE `ordenes_lab` ADD `fecha_creacion` VARCHAR(25) NOT NULL AFTER `cod_orden`;
ALTER TABLE `ordenes_lab` CHANGE `emppresa` `empresa` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL;
alter table ordenes_lab add column estado varchar(2);

create table acciones_ordenes_envios(
id_accion  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
fecha varchar(25),
usuario varchar(100),
cod_orden varchar(25),
paciente varchar(100),
observaciones varchar(200),
tipo_accion varchar(50),
id_orden_lab INT,
foreign key(id_orden_lab) references ordenes_lab(id_orden_lab)
);