SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `bd_soundity` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `bd_soundity`;

/* Taula USUARI */
	/*creacio de la taula*/
	CREATE TABLE IF NOT EXISTS `tbl_usuari` (
		`usu_id` int(11) NOT NULL,
		`usu_mail` varchar(50) NULL,
	  	`usu_contra` varchar(50) NULL,
		`usu_nom` varchar(30) NULL,
		`usu_avatar` varchar(50) NULL,
		`usu_descripcio` varchar(250) NULL,
		`usu_rang` varchar(3) NULL,
		`usu_idioma` varchar(20) NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
	/*  Canvi a Primari Key */
			ALTER TABLE `tbl_usuari`
			ADD CONSTRAINT PRIMARY KEY (usu_id);
	/*  Canvi a autoincremental*/
			ALTER TABLE `tbl_usuari`
			MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT;	
			
/* Taula MUSICA */
	/*creacio de la taula */
	CREATE TABLE IF NOT EXISTS `tbl_musica` (
		`mus_id` int(11) NOT NULL,
		`mus_nom` varchar(30) NULL,
		`mus_titol` varchar(50) NULL,
		`usu_comptador` int(11) NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
	/*  Canvi a Primari Key */
			ALTER TABLE `tbl_musica`
			ADD CONSTRAINT PRIMARY KEY (mus_id);
	/*  Canvi a autoincremental*/
			ALTER TABLE `tbl_musica`
			MODIFY `mus_id` int(11) NOT NULL AUTO_INCREMENT;	
	/* Modificació de la taula musica*/;
			ALTER TABLE `tbl_musica`
			ADD usu_id int(11) NULL;	
			ALTER TABLE `tbl_musica`
			ADD gen_id int(11) NULL;
			
/* Taula LLISTES */
	/*creacio de la taula */
	CREATE TABLE IF NOT EXISTS `tbl_llistes` (
		`lli_id` int(11) NOT NULL,
		`lli_nom` varchar(30) NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
	/*  Canvi a Primari Key */
			ALTER TABLE `tbl_llistes`
			ADD CONSTRAINT PRIMARY KEY (lli_id);
	/*  Canvi a autoincremental*/
			ALTER TABLE `tbl_llistes`
			MODIFY `lli_id` int(11) NOT NULL AUTO_INCREMENT;	
	/* Modificació de la taula llistes*/;
			ALTER TABLE `tbl_llistes`
			ADD usu_id int(11) NULL;				

/* Taula LLISTES-MUSICA */
	/*creacio de la taula */
	CREATE TABLE IF NOT EXISTS `tbl_llistes_musica` (
		`lmu_id` int(11) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
	/*  Canvi a Primari Key */
			ALTER TABLE `tbl_llistes_musica`
			ADD CONSTRAINT PRIMARY KEY (lmu_id);
	/*  Canvi a autoincremental*/
			ALTER TABLE `tbl_llistes_musica`
			MODIFY `lmu_id` int(11) NOT NULL AUTO_INCREMENT;	
	/* Modificació de la taula llistes-musica*/;
			ALTER TABLE `tbl_llistes_musica`
			ADD lli_id int(11) NULL;
			ALTER TABLE `tbl_llistes_musica`
			ADD mus_id int(11) NULL;
			
/* Taula VALORACIO */
	/*creacio de la taula */
	CREATE TABLE IF NOT EXISTS `tbl_valoracio` (
		`val_id` int(11) NOT NULL,
		`val_puntuacio` varchar(3) NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
	/*  Canvi a Primari Key */
			ALTER TABLE `tbl_valoracio`
			ADD CONSTRAINT PRIMARY KEY (val_id);
	/*  Canvi a autoincremental*/
			ALTER TABLE `tbl_valoracio`
			MODIFY `val_id` int(11) NOT NULL AUTO_INCREMENT;	
	/* Modificació de la taula valoracio*/;
			ALTER TABLE `tbl_valoracio`
			ADD mus_id int(11) NULL;
			ALTER TABLE `tbl_valoracio`
			ADD usu_id int(11) NULL;			
			
/* Taula GENERE */
	/*creacio de la taula */
	CREATE TABLE IF NOT EXISTS `tbl_genere` (
		`gen_id` int(11) NOT NULL,
		`gen_nom` varchar(30) NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
	/*  Canvi a Primari Key */
			ALTER TABLE `tbl_genere`
			ADD CONSTRAINT PRIMARY KEY (gen_id);
	/*  Canvi a autoincremental*/
			ALTER TABLE `tbl_genere`
			MODIFY `gen_id` int(11) NOT NULL AUTO_INCREMENT;	
			
/* Taula SUBSCRIPCIONS */
	/*creacio de la taula */
	CREATE TABLE IF NOT EXISTS `tbl_subscripcions` (
		`sub_id` int(11) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
	/*  Canvi a Primari Key */
			ALTER TABLE `tbl_subscripcions`
			ADD CONSTRAINT PRIMARY KEY (sub_id);
	/*  Canvi a autoincremental*/
			ALTER TABLE `tbl_subscripcions`
			MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT;	
	/* Modificació de la taula subscripcions*/;
			ALTER TABLE `tbl_subscripcions`
			ADD usu_idorigen int(11) NULL;
			ALTER TABLE `tbl_subscripcions`
			ADD usu_id int(11) NULL;
			
/* Taula GENERE_USUARI */
	/*creacio de la taula */
	CREATE TABLE IF NOT EXISTS `tbl_genere_usuari` (
		`gus_id` int(11) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
	/*  Canvi a Primari Key */
			ALTER TABLE `tbl_genere_usuari`
			ADD CONSTRAINT PRIMARY KEY (gus_id);
	/*  Canvi a autoincremental*/
			ALTER TABLE `tbl_genere_usuari`
			MODIFY `gus_id` int(11) NOT NULL AUTO_INCREMENT;	
	/* Modificació de la taula llistes-musica*/;
			ALTER TABLE `tbl_genere_usuari`
			ADD gen_id int(11) NULL;
			ALTER TABLE `tbl_genere_usuari`
			ADD usu_id int(11) NULL;
			
			
		/* RELACIONS*/
/* PK tbl_llistes FK tbl_usuari */;
	ALTER TABLE `tbl_llistes`
	ADD CONSTRAINT FOREIGN KEY (usu_id)
	REFERENCES `tbl_usuari` (usu_id);
	
/* PK tbl_musica FK tbl_usuari */;
	ALTER TABLE `tbl_musica`
	ADD CONSTRAINT FOREIGN KEY (usu_id)
	REFERENCES `tbl_usuari` (usu_id);
	
/* PK tbl_valoracio FK tbl_usuari */;
	ALTER TABLE `tbl_valoracio`
	ADD CONSTRAINT FOREIGN KEY (usu_id)
	REFERENCES `tbl_usuari` (usu_id);
	
/* PK tbl_llistes_musica FK tbl_musica */;
	ALTER TABLE `tbl_llistes_musica`
	ADD CONSTRAINT FOREIGN KEY (mus_id)
	REFERENCES `tbl_musica` (mus_id);
	
/* PK tbl_valoracio FK tbl_musica */;
	ALTER TABLE `tbl_valoracio`
	ADD CONSTRAINT FOREIGN KEY (mus_id)
	REFERENCES `tbl_musica` (mus_id);
	
/* PK tbl_llistes FK tbl_llistes_musica */;
	ALTER TABLE `tbl_llistes_musica`
	ADD CONSTRAINT FOREIGN KEY (lli_id)
	REFERENCES `tbl_llistes` (lli_id);	
	
/* PK tbl_musica FK tbl_genere */;
	ALTER TABLE `tbl_musica`
	ADD CONSTRAINT FOREIGN KEY (gen_id)
	REFERENCES `tbl_genere` (gen_id);	
	
/* PK tbl_subscripcions FK tbl_usuari */;
	ALTER TABLE `tbl_subscripcions`
	ADD CONSTRAINT FOREIGN KEY (usu_id)
	REFERENCES `tbl_usuari` (usu_id);
	
/* PK tbl_subscripcions FK tbl_usuari */;
	ALTER TABLE `tbl_subscripcions`
	ADD CONSTRAINT FOREIGN KEY (usu_idorigen)
	REFERENCES `tbl_usuari` (usu_id);
	
	/* PK tbl_genere_usuari FK tbl_usuari */;
	ALTER TABLE `tbl_genere_usuari`
	ADD CONSTRAINT FOREIGN KEY (usu_id)
	REFERENCES `tbl_usuari` (usu_id);
	/* PK tbl_genere_usuari FK tbl_genere */;
	ALTER TABLE `tbl_genere_usuari`
	ADD CONSTRAINT FOREIGN KEY (gen_id)
	REFERENCES `tbl_genere` (gen_id);	