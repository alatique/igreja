CREATE TABLE `igreja` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;


CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `birth` date DEFAULT NULL,
  `address` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cel` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sta_ativo` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_igreja` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_igreja` (`id_igreja`),
  CONSTRAINT `fk_igreja` FOREIGN KEY (`id_igreja`) REFERENCES `igreja` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;


CREATE TABLE `dizimo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vl_dizimo` decimal(10,0) DEFAULT NULL,
  `vl_oferta` decimal(10,0) DEFAULT NULL,
  `id_users` int DEFAULT NULL,
  `dt_dizimo` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users` (`id_users`),
  CONSTRAINT `fk_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;


INSERT INTO `igreja` VALUES (1,'IGREJA PRESBITERIANA DO MORUMBI');
INSERT INTO `users` VALUES (1,'André Luis Atique','1987-05-25','Rua Itamatai, 50','Vila Andrade','São Paulo','05715020','SP','Brasil','','11 98222-3892','andreatique@hotmail.com','PB','S','andreatique@hotmail.com','1234',1),(2,'Marcela Rodgers Atique','1990-06-08','Rua Itamatai, 50','Vila Andrade','São Paulo','05715020','SP','Brasil','','11 98331-2422','mratique@hotmail.com','MB','S','mratique@hotmail.com','1234',1),(3,'Helson Wagner Monteiro de Oliveira','1955-07-26','Rua José de Oliveira Coelho, 165','Vila Andrade','São Paulo','05715020','SP','Brasil','','11 98765-3211','hwmo@terra.com.br','PB','S','hwmo@terra.com.br','1234',1),(4,'Ivete Rodgers de Oliveira','1955-12-28','Rua José de Oliveira Coelho, 165','Vila Andrade','São Paulo','05715020','SP','Brasil','','11 95678-1233','iveterodgers@gmail.com','MB','S','iveterodgers@gmail.com','1234',1);