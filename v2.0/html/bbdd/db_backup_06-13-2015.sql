DROP TABLE IF EXISTS categorias;

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`id_categoria`),
  KEY `id_categoria_2` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO categorias VALUES("1","Congelados");
INSERT INTO categorias VALUES("2","Lacteos");
INSERT INTO categorias VALUES("3","Aceites");


DROP TABLE IF EXISTS productos;

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `precio` double NOT NULL,
  `stock` int(11) NOT NULL,
  `marca` varchar(200) NOT NULL,
  `tamanio` double NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO productos VALUES("3","yogures naturales","100","1","danone","0","2");
INSERT INTO productos VALUES("4","yogures vitalinea","100","1","danone","0","2");
INSERT INTO productos VALUES("5","aceite oliva","5","5","carbonell","200","3");
INSERT INTO productos VALUES("6","Aceite Girasol","3","25","Coipesol","5","3");
INSERT INTO productos VALUES("12","Quesitos","1","5","El caserio","100","2");
INSERT INTO productos VALUES("14","Aceite de coco","8","1","Corcobell","750","3");
INSERT INTO productos VALUES("16","arroz 3 delicidas","1","4","Findus","200","1");
INSERT INTO productos VALUES("17","Espinacas","1","3","HACENDADO","250","1");


DROP TABLE IF EXISTS usuarios;

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO usuarios VALUES("0","jefe","1","j3f3");
INSERT INTO usuarios VALUES("1","dependiente1","2","1234");
INSERT INTO usuarios VALUES("2","dependiente2","2","1234");
INSERT INTO usuarios VALUES("3","dependiente3","2","1234");
INSERT INTO usuarios VALUES("4","cliente1","3","abcd");
INSERT INTO usuarios VALUES("5","cliente2","3","abcd");


