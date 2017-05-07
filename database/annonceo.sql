-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: annonceo
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `annonce` (
  `id_annonce` int(3) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description_courte` varchar(255) NOT NULL,
  `description_longue` text NOT NULL,
  `prix` float NOT NULL,
  `pays` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` int(5) NOT NULL,
  `membre_id` int(3) NOT NULL,
  `photo_id` int(3) NOT NULL,
  `categorie_id` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  PRIMARY KEY (`id_annonce`),
  KEY `membre_id` (`membre_id`),
  KEY `photo_id` (`photo_id`),
  KEY `categorie_id` (`categorie_id`),
  CONSTRAINT `categorie_id` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `membre_id` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id_membre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `photo_id` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id_photo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `annonce`
--

LOCK TABLES `annonce` WRITE;
/*!40000 ALTER TABLE `annonce` DISABLE KEYS */;
INSERT INTO `annonce` VALUES (1,'Vélo tout terrain','super vélo, tout terrain, comme neuf','Vélo de marque décathlon, type tout terrain, parfait état.\r\nRevu, réparé et nettoyé récemment, comme neuf.\r\n5 vitesses + selle confort.\r\nA récupérer sur place, possibilité de s\'arranger sur 5-10km max.',100,'France','Clichy','10 rue Villeneuve',92110,1,1,1,'2017-04-16 00:00:00'),(3,'bonjour','dfgshj','fsdgh',123,'France','Clichy','81 boulevard du général leclerc',92110,22,4,1,'2017-05-06 13:33:18'),(4,'bonjour','dfgshj','fsdgh',123,'France','Clichy','81 boulevard du général leclerc',92110,22,5,2,'2017-05-06 13:40:22'),(5,'bonjour','super souris bleue','81 boulevard du général leclerc',955,'France','Clichy','81 boulevard du général leclerc',92110,22,7,1,'2017-05-06 13:44:50'),(6,'Croquettes pour chat','Paquet de croquettes 10kg','Gros paquet de croquettes pour chat 10kg jamais ouvert, croquettes spéciales chat mignon et soyeux, marque Whiskas.\r\nDisponible en livraison ou en récupération à domicile',20,'France','Neuilly sur Seine','93 avenue du Charles de Gaulle',92200,21,8,3,'2017-05-06 13:50:37'),(7,'Appartement Montreuil','Grand appartement 3 pièces','Appartement tout confort non meublé 3 pièces (salon, 2 chambres, 1 sdb) à Montreuil proche métro 75m²',700000,'France','Montreuil','77 rue des Sorins',93100,22,9,4,'2017-05-07 16:33:42');
/*!40000 ALTER TABLE `annonce` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `motscles` text,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` VALUES (1,'Véhicules','voiture, véhicules, car, camion, vélo, moto'),(2,'Emploi','offres d\'emploi, jobs, boulot'),(3,'Produit pour animaux de compagnie','animaux, chat, chien, animal de compagnie, croquettes, pâté, jouets'),(4,'Immobilier','vente, location, colocation, bureaux, logement'),(5,'Vacances','camping, hôtel, hôte'),(6,'Multimedia','jeux vidéo, informatique, image, son téléphone, télé, ordinateur'),(7,'Loisirs','films, musiques, livres'),(8,'Matériel','outillage, fournitures de bureau, matériel agricole'),(9,'Services','prestations de services, événements'),(10,'Maison','ameublement, électroménager, bricolage, jardinage'),(11,'Vêtements','jean, chemise, robe, chaussures');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commentaire` (
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `membre_id` int(11) NOT NULL,
  `annonce_id` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `date_enregistrement` date NOT NULL,
  PRIMARY KEY (`id_commentaire`),
  KEY `annonce_id` (`annonce_id`),
  KEY `membre_id` (`membre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaire`
--

LOCK TABLES `commentaire` WRITE;
/*!40000 ALTER TABLE `commentaire` DISABLE KEYS */;
INSERT INTO `commentaire` VALUES (1,1,1,'Super vélo ! :-)','2017-05-03'),(7,13,1,'FAUX VELO ATTENTION ARNAQUE','2017-05-06');
/*!40000 ALTER TABLE `commentaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membre`
--

DROP TABLE IF EXISTS `membre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membre` (
  `id_membre` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `civilite` enum('m','f') NOT NULL,
  `statut` int(11) NOT NULL,
  `date_enregistrement` date NOT NULL,
  PRIMARY KEY (`id_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membre`
--

LOCK TABLES `membre` WRITE;
/*!40000 ALTER TABLE `membre` DISABLE KEYS */;
INSERT INTO `membre` VALUES (1,'michel92','2c7f9fd20fbeb41ce8894ec4653d66fa7f3b6e1a','Quatrevingtdouze','Michel','06','michel92@laposte.net','m',0,'2017-04-16'),(13,'admin','2dd07c9ce0189aaacacff6a86a5fc61a8d38d851','Admin','Admin','0123456789','admin@admin.fr','m',1,'2017-04-25'),(19,'User001','d3961aa89e29d15cfb52600dc0bd51548fc538a4','Dupond','Dupont','0123456789','dupond@dupont.fr','f',0,'2017-05-04'),(20,'User002','12dea96fec20593566ab75692c9949596833adc9','User','User','user@user.ok','0987654321','m',0,'2017-05-05'),(21,'Midono','1024383a2abd3e5967b4cf9b68db9f416bc52af6','Dono','Mi','0612345789','mi.dono@caramail.fr','m',0,'2017-05-05'),(22,'feelic','7674034569647409a94369422b92edd5cc1379e1','GOALEC','Félix','0625794414','feelics@gmail.com','m',0,'2017-05-05');
/*!40000 ALTER TABLE `membre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `note` (
  `id_note` int(11) NOT NULL AUTO_INCREMENT,
  `membre_id1` int(11) NOT NULL,
  `membre_id2` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `avis` text NOT NULL,
  `date_enregistrement` date NOT NULL,
  PRIMARY KEY (`id_note`),
  KEY `membre_id1` (`membre_id1`),
  KEY `membre_id2` (`membre_id2`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note`
--

LOCK TABLES `note` WRITE;
/*!40000 ALTER TABLE `note` DISABLE KEYS */;
INSERT INTO `note` VALUES (7,19,1,2,'mdr','2017-05-04'),(8,13,1,4,'trop marrant','2017-05-04'),(9,20,1,3,'Bofbof','2017-05-05'),(10,21,1,5,'Au poil !','2017-05-06'),(11,13,19,4,'top','2017-05-06'),(12,13,21,5,'MEILLEUR CHATON','2017-05-06');
/*!40000 ALTER TABLE `note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo` (
  `id_photo` int(11) NOT NULL AUTO_INCREMENT,
  `photo1` varchar(255) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `photo4` varchar(255) DEFAULT NULL,
  `photo5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_photo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo`
--

LOCK TABLES `photo` WRITE;
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
INSERT INTO `photo` VALUES (1,'1494008404-velo-de-course-fuji-altamira-11-gris-bleu.jpg','1494008404-560bac765f388.jpg','1494065988-0zsbg7K.gif','1494065988-creyin.gif','1494065988-lXgzI17.gif'),(2,'1494070376-attempt.png',NULL,NULL,NULL,NULL),(3,'1494070390-attempt.png',NULL,NULL,NULL,NULL),(4,'1494070398-attempt.png',NULL,NULL,NULL,NULL),(5,'1494070822-attempt.png',NULL,NULL,NULL,NULL),(6,'1494070856-attempt.png',NULL,NULL,NULL,NULL),(7,'1494071090-pew.gif','1494071090-youtried.png',NULL,NULL,NULL),(8,'1494071437-00062391-t0.jpg','1494071437-croquettes-alimentation.jpg','1494071437-croquettes-pour-chat2.jpg',NULL,NULL),(9,'1494167621-couch-1835923_640.jpg','1494167621-bedroom-389254_640.jpg','1494167621-bathroom-2094716_640.jpg','1494167621-hob-2141024_640.jpg',NULL);
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-07 17:45:34
