CREATE SCHEMA owl_control;

CREATE  TABLE owl_control.administradores ( 
	administradores_id   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	administrador_username VARCHAR(25)    NOT NULL   ,
	administrador_nombre VARCHAR(50)    NOT NULL   ,
	administrador_email  VARCHAR(60)    NOT NULL   ,
	administrador_password VARCHAR(20)    NOT NULL   ,
	administrador_registro DATE  DEFAULT (curdate())     
 ) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE  TABLE owl_control.albumes ( 
	album_id             INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	album_titulo         VARCHAR(75)    NOT NULL   ,
	album_lanzamiento    DATE       ,
	album_duracion       INT       ,
	album_stock          INT       ,
	album_estado         BIT  DEFAULT (1)  NOT NULL   ,
	album_precio         DECIMAL(18,8)       
 ) engine=InnoDB;

CREATE  TABLE owl_control.artistas ( 
	artista_id           INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	artista_nombre       VARCHAR(50)    NOT NULL   ,
	artista_estado       BIT  DEFAULT (1)  NOT NULL   ,
	artista_registro     DATE  DEFAULT (curdate())     
 ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE  TABLE owl_control.generos ( 
	genero_id            INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	genero_nombre        VARCHAR(50)    NOT NULL   ,
	genero_registro      DATE  DEFAULT (curdate())     ,
	genero_estado        BIT  DEFAULT (1)  NOT NULL   
 ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE  TABLE owl_control.generos_artistas ( 
	id_genero_artista    INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	genero_id            INT       ,
	artista_id           INT       ,
	CONSTRAINT fk_generos_artistas_artistas FOREIGN KEY ( artista_id ) REFERENCES owl_control.artistas( artista_id ) ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT fk_generos_artistas_generos FOREIGN KEY ( genero_id ) REFERENCES owl_control.generos( genero_id ) ON DELETE SET NULL ON UPDATE CASCADE
 ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE INDEX fk_generos_artistas_generos ON owl_control.generos_artistas ( genero_id );

CREATE INDEX fk_generos_artistas_artistas ON owl_control.generos_artistas ( artista_id );

CREATE  TABLE owl_control.albumes_artistas ( 
	id_albumes_artistas  INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	album_id             INT       ,
	artista_id           INT       ,
	CONSTRAINT fk_albumes_artistas_artistas FOREIGN KEY ( artista_id ) REFERENCES owl_control.artistas( artista_id ) ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT fk_albumes_artistas_albumes FOREIGN KEY ( album_id ) REFERENCES owl_control.albumes( album_id ) ON DELETE SET NULL ON UPDATE CASCADE
 ) engine=InnoDB;

CREATE  TABLE owl_control.albumes_generos ( 
	id_genero_album      INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	album_id             INT       ,
	genero_id            INT       ,
	CONSTRAINT fk_generos_albumes_albumes FOREIGN KEY ( album_id ) REFERENCES owl_control.albumes( album_id ) ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT fk_generos_albumes_generos FOREIGN KEY ( genero_id ) REFERENCES owl_control.generos( genero_id ) ON DELETE SET NULL ON UPDATE CASCADE
 ) engine=InnoDB;

INSERT INTO owl_control.administradores( administrador_username, administrador_nombre, administrador_email, administrador_password, administrador_registro ) VALUES ( 'sus', 'sus pero nombre', 'sus@sus', 'sus pero pass', '30/06/2024');
INSERT INTO owl_control.administradores( administrador_username, administrador_nombre, administrador_email, administrador_password, administrador_registro ) VALUES ( 'Juan', 'Juan', 'Juan@juna', 'Juan', '30/06/2024');
INSERT INTO owl_control.administradores( administrador_username, administrador_nombre, administrador_email, administrador_password, administrador_registro ) VALUES ( 'pedra', 'pedra', 'fumapiedra@gmail.com', '1234', '30/06/2024');
INSERT INTO owl_control.albumes( album_titulo, album_lanzamiento, album_duracion, album_stock, album_estado, album_precio ) VALUES ( 'IGOR', '17/05/2019', 40, 10, 1, 100);
INSERT INTO owl_control.albumes( album_titulo, album_lanzamiento, album_duracion, album_stock, album_estado, album_precio ) VALUES ( 'Ye', '01/06/2018', 25, 120, 0, 25);
INSERT INTO owl_control.albumes( album_titulo, album_lanzamiento, album_duracion, album_stock, album_estado, album_precio ) VALUES ( 'Jeffery', '26/08/2016', 42, 50, 1, 80);
INSERT INTO owl_control.artistas( artista_nombre, artista_estado, artista_registro ) VALUES ( 'Kanye West', 1, '30/06/2024');
INSERT INTO owl_control.artistas( artista_nombre, artista_estado, artista_registro ) VALUES ( 'Kendrick Lamar', 1, '30/06/2024');
INSERT INTO owl_control.artistas( artista_nombre, artista_estado, artista_registro ) VALUES ( 'Tyler The Creator', 0, '30/06/2024');
INSERT INTO owl_control.artistas( artista_nombre, artista_estado, artista_registro ) VALUES ( 'Young Thug', 0, '30/06/2024');
INSERT INTO owl_control.generos( genero_nombre, genero_registro, genero_estado ) VALUES ( 'HipHop', '30/06/2024', 1);
INSERT INTO owl_control.generos( genero_nombre, genero_registro, genero_estado ) VALUES ( 'Metal cumbiero', '30/06/2024', 0);
INSERT INTO owl_control.generos( genero_nombre, genero_registro, genero_estado ) VALUES ( 'Industrial', '01/07/2024', 1);
INSERT INTO owl_control.generos_artistas( genero_id, artista_id ) VALUES ( 1, 1);
INSERT INTO owl_control.generos_artistas( genero_id, artista_id ) VALUES ( 1, 3);
INSERT INTO owl_control.generos_artistas( genero_id, artista_id ) VALUES ( 1, 4);
INSERT INTO owl_control.albumes_artistas( album_id, artista_id ) VALUES ( 1, 3);
INSERT INTO owl_control.albumes_artistas( album_id, artista_id ) VALUES ( 2, 1);
INSERT INTO owl_control.albumes_artistas( album_id, artista_id ) VALUES ( 3, 4);
INSERT INTO owl_control.albumes_artistas( album_id, artista_id ) VALUES ( null, 1);
INSERT INTO owl_control.albumes_generos( album_id, genero_id ) VALUES ( 1, 1);
INSERT INTO owl_control.albumes_generos( album_id, genero_id ) VALUES ( 2, 1);
INSERT INTO owl_control.albumes_generos( album_id, genero_id ) VALUES ( 3, 1);
INSERT INTO owl_control.albumes_generos( album_id, genero_id ) VALUES ( null, 1);
