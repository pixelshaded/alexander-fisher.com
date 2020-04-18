-- MySQL dump 10.16  Distrib 10.1.44-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: portfolio
-- ------------------------------------------------------
-- Server version	10.1.44-MariaDB-0+deb9u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Category`
--

DROP TABLE IF EXISTS `Category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FF3A7B97989D9B62` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Category`
--

LOCK TABLES `Category` WRITE;
/*!40000 ALTER TABLE `Category` DISABLE KEYS */;
INSERT INTO `Category` VALUES (1,'games','Games','What humans were made for','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu tortor elit, vestibulum molestie enim. Morbi elementum egestas pretium. Duis et congue metus. Duis commodo accumsan nibh volutpat lacinia. Proin volutpat justo eu lacus congue non sagittis neque blandit. Fusce sagittis ligula et massa consequat pretium vehicula dui porta. Suspendisse fringilla tempus augue sit amet hendrerit. Proin id lorem eu risus viverra congue. Duis leo magna, cursus eget suscipit non, suscipit eu turpis.'),(2,'web','Web','Bringing people together','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu tortor elit, vestibulum molestie enim. Morbi elementum egestas pretium. Duis et congue metus. Duis commodo accumsan nibh volutpat lacinia. Proin volutpat justo eu lacus congue non sagittis neque blandit. Fusce sagittis ligula et massa consequat pretium vehicula dui porta. Suspendisse fringilla tempus augue sit amet hendrerit. Proin id lorem eu risus viverra congue. Duis leo magna, cursus eget suscipit non, suscipit eu turpis.');
/*!40000 ALTER TABLE `Category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Project`
--

DROP TABLE IF EXISTS `Project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `tagline` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `intro` longtext COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `subcontent` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E00EE972989D9B62` (`slug`),
  KEY `IDX_E00EE97212469DE2` (`category_id`),
  CONSTRAINT `FK_E00EE97212469DE2` FOREIGN KEY (`category_id`) REFERENCES `Category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Project`
--

LOCK TABLES `Project` WRITE;
/*!40000 ALTER TABLE `Project` DISABLE KEYS */;
/*!40000 ALTER TABLE `Project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blacklisted_ips`
--

DROP TABLE IF EXISTS `blacklisted_ips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blacklisted_ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attempts` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blacklisted_ips`
--

LOCK TABLES `blacklisted_ips` WRITE;
/*!40000 ALTER TABLE `blacklisted_ips` DISABLE KEYS */;
INSERT INTO `blacklisted_ips` VALUES (2,'31.128.85.166',1),(3,'91.236.74.176',1),(4,'94.230.166.185',2),(5,'61.147.99.104',1),(6,'95.105.102.198',1),(7,'176.8.247.165',1),(8,'31.184.238.22',1),(9,'195.138.82.135',1),(10,'178.137.84.193',1),(11,'108.62.165.209',1),(12,'198.1.99.26',1),(13,'91.236.74.194',1),(14,'91.236.74.177',1),(15,'198.100.145.151',1),(16,'199.71.214.155',1),(17,'178.32.67.13',1);
/*!40000 ALTER TABLE `blacklisted_ips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3AF34668989D9B62` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'games','Games','What humans were made for','My love for programming is rooted in web development, but really blossomed inside the realm of gameplay programming. Video games tend to provide unique puzzles to solve as a developer. The process tends to be much more about discovery and exploration. How can we make this more user friendly? Is this fun? How does it feel to control the game? These questions need answers and are pleasing to ponder.'),(2,'web','Web','What would we do without it?','The web has so much potential these days.');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cover_id` int(11) DEFAULT NULL,
  `title` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F70E6EB7989D9B62` (`slug`),
  UNIQUE KEY `UNIQ_F70E6EB7922726E9` (`cover_id`),
  CONSTRAINT `FK_F70E6EB7922726E9` FOREIGN KEY (`cover_id`) REFERENCES `images` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (1,NULL,'Jun','jun'),(2,15,'Magnedude','magnedude'),(3,32,'Blockectomy','blockectomy'),(4,28,'Hands On Demo','hands-on-demo'),(5,NULL,'Buddy System','buddy-system'),(6,NULL,'alexander-fisher.com','alexander-fisher-com'),(7,39,'Dead Drop','dead-drop'),(8,NULL,'Campus Webstore','campus-webstore');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E01FBE6A4E7AF8F` (`gallery_id`),
  CONSTRAINT `FK_E01FBE6A4E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,1,'5065d5f869c69-UDK2012-06-0404-26-03-46.jpeg','UDK2012-06-0404-26-03-46'),(2,1,'5065d733b1c21-UDK2012-06-0404-18-53-47.jpeg','UDK2012-06-0404-18-53-47'),(3,1,'5065d7bb75674-UDK2012-06-0404-19-23-46.jpeg','UDK2012-06-0404-19-23-46'),(4,1,'5065d98173dc2-UDK2012-06-0404-18-58-47.jpeg','UDK2012-06-0404-18-58-47'),(5,1,'5065d9905214c-UDK2012-06-0404-19-33-45.jpeg','UDK2012-06-0404-19-33-45'),(6,1,'5065d99c4de75-UDK2012-06-0404-20-43-46.jpeg','UDK2012-06-0404-20-43-46'),(7,1,'5065d9abb1afc-UDK2012-06-0404-21-08-47.jpeg','UDK2012-06-0404-21-08-47'),(8,1,'5065d9b711293-UDK2012-06-0404-23-33-47.jpeg','UDK2012-06-0404-23-33-47'),(9,1,'5065d9c392a22-UDK2012-06-0404-24-23-45.jpeg','UDK2012-06-0404-24-23-45'),(10,1,'5065d9d4438c0-UDK2012-06-0404-24-28-47.jpeg','UDK2012-06-0404-24-28-47'),(11,1,'5065d9dd847d0-UDK2012-06-0404-26-28-48.jpeg','UDK2012-06-0404-26-28-48'),(12,2,'5065da436b6b7-Magnadude2012-06-0404-34-25-96.jpeg','Magnadude2012-06-0404-34-25-96'),(13,2,'5065da4ea1169-Magnadude2012-06-0404-34-35-96.jpeg','Magnadude2012-06-0404-34-35-96'),(14,2,'5065da584eca5-Magnadude2012-06-0404-34-50-96.jpeg','Magnadude2012-06-0404-34-50-96'),(15,2,'5065da623b14c-Magnadude2012-06-0404-35-05-96.jpeg','Magnadude2012-06-0404-35-05-96'),(16,2,'5065da6d4a12e-Magnadude2012-06-0404-35-10-96.jpeg','Magnadude2012-06-0404-35-10-96'),(17,2,'5065da7a29716-Magnadude2012-06-0404-36-05-96.jpeg','Magnadude2012-06-0404-36-05-96'),(18,2,'5065da843bee5-Magnadude2012-06-0404-36-50-96.jpeg','Magnadude2012-06-0404-36-50-96'),(19,2,'5065da8e7f3cc-Magnadude2012-06-0404-37-25-96.jpeg','Magnadude2012-06-0404-37-25-96'),(20,3,'5065dab5e73a6-gameplay1.jpeg','gameplay1'),(22,3,'5065dac7aca77-gameplay3.jpeg','gameplay3'),(23,3,'5065dacf3b7d2-leaderboard.jpeg','leaderboard'),(24,3,'5065dad68267d-mainmenu.jpeg','mainmenu'),(25,4,'5065db0b25737-bench.jpeg','bench'),(26,4,'5065db12e0c68-door.jpeg','door'),(27,4,'5065db1bcb368-drawers.jpeg','drawers'),(28,4,'5065db262d86b-hammer.jpeg','hammer'),(29,4,'5065db2fd164f-placeindrawer.jpeg','placeindrawer'),(30,4,'5065db38771eb-showinteractives.jpeg','showinteractives'),(32,3,'5065e6f56a3d1-gameplay2-bordered.jpeg','gameplay2-bordered'),(33,5,'5065e782a3156-TheBuddySystem2012-06-0404-39-17-48.jpeg','TheBuddySystem2012-06-0404-39-17-48'),(34,5,'5065e78bcb033-1.jpeg','1'),(35,5,'5065e7952c995-2.jpeg','2'),(36,5,'5065e79f61913-3.jpeg','3'),(37,5,'5065e7b83ddc7-4.jpeg','4'),(38,6,'5069ce8b22d62-homepage.jpeg','homepage'),(39,7,'5069dea8e8058-logo_sketched.jpeg','logo_sketched'),(40,7,'5069e686e2583-iphones.jpeg','iphones'),(42,8,'5150c3d2296fd-piratewear.jpeg','piratewear');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `tagline` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `intro` longtext COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `subcontent` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5C93B3A4989D9B62` (`slug`),
  UNIQUE KEY `UNIQ_5C93B3A44E7AF8F` (`gallery_id`),
  KEY `IDX_5C93B3A412469DE2` (`category_id`),
  CONSTRAINT `FK_5C93B3A412469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `FK_5C93B3A44E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,1,1,'Jun','jun','3rd Person Platformer','Run and gun!','Jun\'s name comes from jump + run. This was a team project between myself and some fellow art students at the Art Institute of Atlanta for Game Prototyping.','<p>Jun\'s name comes from jump + run. This was a team project between myself and some fellow art students at the Art Institute of Atlanta. The object of the game was to get the highest score by finishing in record time while shooting as many targets as possible.</p>\r\n\r\n<p>The course contains three puzzles. The first is a spiraling column with gaps which require timing to navigate. The second is also a timing based puzzle with a corridor filled with moving blocks that will crush you. The final puzzle is a physics based one where you must get a ball through a maze by moving levers.</p>\r\n\r\n<iframe width=\"560\" height=\"315\" src=\"http://www.youtube.com/embed/60MMQskKOzA\" frameborder=\"0\" allowfullscreen></iframe>','<table>\r\n<tr>\r\n	<td>Platform</td>\r\n	<td>Windows</td>\r\n</tr>\r\n<tr>\r\n	<td>Game Type</td>\r\n	<td>Platformer</td>\r\n</tr>\r\n<tr>\r\n	<td>Engine</td>\r\n	<td>\r\n		<p>Unreal Development Kit</p>\r\n		<p>Scaleform</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Langauges</td>\r\n	<td>\r\n		<p>Unrealscript</p>\r\n		<p>Actionscript 2</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Responsibilities</td>\r\n	<td>\r\n		<p>Game Design/Concept</p>\r\n		<p>Gameplay Programming</p>\r\n		<p>UI Programming</p>\r\n	</td>\r\n</tr>\r\n</table>'),(2,1,2,'Magnedude','magnedude','Physics Puzzler','Magnets oh my!','Magnedude was a game made at the Global Game Jam 2011. It is a physics puzzler based on magnets. I was lead programmer in a group of 10 artists and 2 programmers.','<p>Magnedude was a game prototype made at the Global Game Jam in 2011. It is a physics puzzler based on magnets. You can attach your magnets to objects in the world. Magnets of the same charge would push those objects apart, while if they were opposite charges, they would pull them together. This allows you to attach boxes to walls and use them as platforms for example.</p>\r\n\r\n<p>The object of the game was to get a laser from the start of the level to the end. This laser would bounce of mirrors and be blocked by object. The player had to use his magnets to not only unblock the laser, but also to traverse the level.</p>\r\n\r\n<p>I was lead programmer in a group of 10 artists and 2 programmers.</p>','<table>\r\n<tr>\r\n	<td>Platform</td>\r\n	<td>\r\n		<p>Windows</p>\r\n		<p>Mac</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Game Type</td>\r\n	<td>Puzzler</td>\r\n</tr>\r\n<tr>\r\n	<td>Engine</td>\r\n	<td>Unity 3D</td>\r\n</tr>\r\n<tr>\r\n	<td>Langauges</td>\r\n	<td>\r\n		<p>C#</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Responsibilities</td>\r\n	<td>\r\n		<p>Game Design/Concept</p>\r\n		<p>Gameplay Programming</p>\r\n	</td>\r\n</tr>\r\n</table>'),(3,1,3,'Blockectomy','blockectomy','Casual','Bubble pop meets tetris!','Blockectomy was the first game I had ever made start to finish. It is a mix of bubble pop and tetris. It was put on Newgrounds and Kongregate.','<p>Blockectomy is a casual game akin to Tetris. Blocks fall from the top of the screen and the player has to shoot them with the correctly colored balls. If the blocks stack too high, it’s game over. However, if you complete a row of blocks, they disappear and you get bonus points. The game took two weeks to write from scratch using no libraries. All art is procedurally generated except for the cannon and preloader.</p>\r\n\r\n<p>The game was submitted on <a href=\"http://www.newgrounds.com/portal/view/512898\" target=\"_blank\">Newgrounds</a> and <a href=\"http://www.kongregate.com/games/pixelshaded/blockectomy\" target=\"_blank\">Kongregrate</a>. The Kongregate version was edited to integrate with their leaderboard system.</p>','<table>\r\n<tr>\r\n	<td>Platform</td>\r\n	<td>Web</td>\r\n</tr>\r\n<tr>\r\n	<td>Game Type</td>\r\n	<td>Casual</td>\r\n</tr>\r\n<tr>\r\n	<td>Engine</td>\r\n	<td>\r\n		<p>Flash Player</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Langauges</td>\r\n	<td>\r\n		<p>Actionscript 3</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Responsibilities</td>\r\n	<td>\r\n		<p>Game Design/Concept</p>\r\n		<p>Gameplay Programming</p>\r\n		<p>UI Programming</p>\r\n	</td>\r\n</tr>\r\n</table>'),(4,1,4,'Hands On Demo','hands-on-demo','Serious Games','Interactivity to the max!','A proof of concept for hands on, interactive training for the GA Tech Research Institute. The project uses the Razer Hydra for its six degrees of freedom.','<p>In a different project at the Georgia Tech Research Institute, we were tasked with the quest of finding an extremely interactive way of training people. Naturally, we chose Unity3d as our engine. The original demo used the Xbox Kinect to track the upper body and two Wiimotes to track hand rotation. While the demo functioned, it wasn’t quite the seamless experience we were hoping for.</p>\r\n\r\n<p>As if deemed by fate, the Razer Hydra had recently been released, and not only that, some community members figured out how to interface with the dll. Yay for plugins. While we preferred a wireless solution, the Hydra was so incredibly accurate, supporting 6DOF (degrees of freedom) out of the box, that it was just impossible not to fall in love with. Oh, and it was at a reasonable price too. We did play around a bit with TrackIR and facial tracking to allow the user’s head to control the camera, but in the end opted for the traditional joystick approach.</p>\r\n\r\n<iframe width=\"560\" height=\"315\" src=\"http://www.youtube.com/embed/o2GS3TyQHDk\" frameborder=\"0\" allowfullscreen></iframe>\r\n\r\n<iframe width=\"560\" height=\"315\" src=\"http://www.youtube.com/embed/76GJ04OeXzw\" frameborder=\"0\" allowfullscreen></iframe>','<table>\r\n<tr>\r\n	<td>Platform</td>\r\n	<td>Windows</td>\r\n</tr>\r\n<tr>\r\n	<td>Game Type</td>\r\n	<td>Serious/Training</td>\r\n</tr>\r\n<tr>\r\n	<td>Engine</td>\r\n	<td>\r\n		<p>Unity 3D</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Langauges</td>\r\n	<td>\r\n		<p>C#</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Responsibilities</td>\r\n	<td>\r\n		<p>Gameplay Programming</p>\r\n		<p>UI Programming</p>\r\n		<p>Physics Programming</p>\r\n		<p>Editor Programming</p>\r\n	</td>\r\n</tr>\r\n</table>'),(5,1,5,'Buddy System','buddy-system','Coop Platformer','Forced teamwork!','Two boys connected by a child leash must work together to navigate an over sized kitchen. At the end is a huge chest of candy, but evil vegetables and fruit block their path.','<p>This was a very challenging project for one main reason – how on earth do we create a stretchy rope between the players where both players have an effect on one another, and not only that, confine those effects to 2 dimensional movement. We tried all types of joints and couldn’t get the results we wanted. We also tried some chain/rope scripts but still no luck. Finally we settled with cloth physics. INDEED! That rope is simply a stretched plane of cloth. Simply is a poor choice of words however, since getting it to attach to the players dynamically for spawning and having the right settings to get the desired result was no small task.</p>\r\n\r\n<iframe width=\"560\" height=\"315\" src=\"http://www.youtube.com/embed/KabSIyP46t8\" frameborder=\"0\" allowfullscreen></iframe>','<table>\r\n<tr>\r\n	<td>Platform</td>\r\n	<td>Windows</td>\r\n</tr>\r\n<tr>\r\n	<td>Game Type</td>\r\n	<td>Platformer</td>\r\n</tr>\r\n<tr>\r\n	<td>Engine</td>\r\n	<td>\r\n		<p>Unity 3D</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Langauges</td>\r\n	<td>\r\n		<p>C#</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Responsibilities</td>\r\n	<td>\r\n		<p>Game Design/Concept</p>\r\n		<p>Gameplay Programming</p>\r\n		<p>UI Programming</p>\r\n		<p>Editor Programming</p>\r\n	</td>\r\n</tr>\r\n</table>'),(7,2,6,'This Website','this-website','Built from Scratch','Tagline','My previous website was a heavy, bulky Wordpress site. It was convenient, but could be so much more. A friend designer came up with a design, and this site is the result.','<p>This site was a huge undertaking. Most of my web experience is in backend development. This was the first time I completed a website, start to finish, covering every area of web development possible (well...other than scaling).</p>\r\n\r\n<h3>Server Setup</h3>\r\n<p>The site was originally hosted through Amazon Web Services (free tier) running an Ubuntu 12 server instance with the LAMP server stack on an EC2 instance. Route53 was used to handle the domain and MX records. In April 2020, I decided to move away from AWS entirely, containerizing the site with docker and running that image on MassiveGRID using the Jelastic PaaS.</p>\r\n\r\n<h3>Backend</h3>\r\n<p>The entire backend is written in PHP using the Symfony2 MVC framework. Project content is all persisted with a Mysql database. The Liip Imagine bundle was used to handle thumbnail generation using the GD image library. Github is used for versioning and composer is used for dependency management.</p>\r\n\r\n<h3>Admin Section</h3>\r\n<p>Users and their encrypted credentials are stored in the database with the admin section requiring authentication. The admin section contains galleries, categories, and projects sections. Galleries are linked to projects, and projects are linked to categories. The nav bar will add links dynamically as categories are added. Images are uploaded to the server through the admin section. An IP tracking system was implemented for failed login attempts to block dictionary attacks on the user database.</p>\r\n\r\n<h3>Front End</h3>\r\n<p>The css is compiled using less and includes print media css for the resume page. JQuery was used to create the sliding project snippets on the front page and also the showcase section at the top. All pages should pass html5 validation (except for lightbox errors).</p>','<table>\r\n<tr>\r\n	<td>Host</td>\r\n	<td>MassiveGRID</td>\r\n</tr>\r\n<tr>\r\n	<td>Server</td>\r\n	<td>Debian Stretch Slim</td>\r\n</tr>\r\n<tr>\r\n	<td>Frameworks</td>\r\n	<td>\r\n		<p>Symfony2</p>\r\n		<p>JQuery</p>\r\n		<p>Less</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Langauges</td>\r\n	<td>\r\n		<p>PHP</p>\r\n		<p>Javascript</p>\r\n		<p>SQL</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Responsibilities</td>\r\n	<td>\r\n		<p>Back End</p>\r\n		<p>Front End</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Source Code</td>\r\n	<td>\r\n		<p><a href=\"https://github.com/pixelshaded/alexander-fisher.com/tree/symfony\" target=\"_blank\">Github</a></p>\r\n	</td>\r\n</tr>\r\n</table>'),(8,2,7,'Dead Drop','dead-drop','iOS Server Back End','Fun!','Dead drop is game where gps positioning is the main mechanic. The server was originally written in Cake, and I was a part of converting it to Nodejs.','<p>When I came on to the Dead Drop project it was an already completed server. It was written in php using the Cake framework. For a multiplayer game this just wasn\'t going to cut it. So my employer had the back end web team (at first 2 fellows, but shortly there after just myself) how we could get the server running faster. We thought of ways to optimize the system as it was since we wouldn\'t be able to make many changes to the iOS app. At the end of the day we settled on rewriting the whole thing using server-side javascript and Nodejs.</p>\r\n\r\n<p>My colleague handled the majority of user work (authentication etc) while I focused on the game listings and gameplay. The project makes use of  <a href=\"https://github.com/pixelshaded/routeme\" target=\"_blank\">Routeme</a>, a module I created which was inspired by Symfony2\'s routing setup. Mysql was used for persistence. JSON is the primary data model for server communication.</p>','<table>\r\n<tr>\r\n	<td>Host</td>\r\n	<td>Amazon Web Services</td>\r\n</tr>\r\n<tr>\r\n	<td>Server</td>\r\n	<td>Ubuntu 12</td>\r\n</tr>\r\n<tr>\r\n	<td>Frameworks</td>\r\n	<td>\r\n		<p>Nodejs</p>\r\n		<p>Expressjs</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Langauges</td>\r\n	<td>\r\n		<p>Javascript</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Responsibilities</td>\r\n	<td>\r\n		<p>Back End</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Links</td>\r\n	<td>\r\n		<p><a href=\"http://www.deaddropgame.com\">Website</a></p>\r\n		<p><a href=\"http://itunes.apple.com/us/app/dead-drop/id499598666\">App Store</a></p>\r\n	</td>\r\n</tr>\r\n</table>'),(9,2,8,'Campus Webstore','campus-webstore','Website for Pick Database','E-Commerce','Total Computing Solutions provides a point of sale system based on the Pick Database. Campus webstore is the ASP.NET website for this backend.','<p>Total Computing Solutions provides a point of sale system for school bookstores based on the Pick Database. Campus webstore is the ASP.NET website for this backend (e-commerce). My role on this project was to create templates for current and future clients and help implement new features. I did both back end and front end development. We added features such as ADA compliance, text only modes, a mobile version of the site, faculty adoptions (system for adopting books for classes), and more.</p>\r\n\r\n<p>\r\nThe software is promoted here: <a href=\"http://total-computing.com/SmartSuiteHE/Campus-Webstore.aspx\">Campus Webstore</a></p>\r\n<p>An example of a client website using this software: <a href=\"http://www.piratewear.com\">Piratewear</a></p>','<table>\r\n<tr>\r\n	<td>Framework</td>\r\n	<td>ASP.NET MVC4</td>\r\n</tr>\r\n<tr>\r\n	<td>Tools</td>\r\n	<td>\r\n		<p>Knockout.js</p>\r\n		<p>JQuery</p>\r\n		<p>JQuery Mobile</p>\r\n		<p>JQuery UI</p>\r\n		<p>Bootstrap</a>\r\n		<p>Less</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Langauges</td>\r\n	<td>\r\n		<p>C#</p>\r\n		<p>Javascript</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Responsibilities</td>\r\n	<td>\r\n		<p>Back End</p>\r\n		<p>Front End</p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Client Example</td>\r\n	<td>\r\n		<p><a href=\"http://www.piratewear.com/\" target=\"_blank\">Piratewear</a></p>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>Service Page</td>\r\n	<td>\r\n		<p><a href=\"http://total-computing.com/SmartSuiteHE/Campus-Webstore.aspx\" target=\"_blank\">Campus Webstore</a></p>\r\n	</td>\r\n</tr>\r\n</table>');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B63E2EC757698A6A` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'user','ROLE_USER'),(2,'admin','ROLE_ADMIN');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_2DE8C6A3A76ED395` (`user_id`),
  KEY `IDX_2DE8C6A3D60322AC` (`role_id`),
  CONSTRAINT `FK_2DE8C6A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_2DE8C6A3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES (1,1),(1,2);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(88) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'pixelshaded','1b32e702e1ce07d88a3108e21ab81c85','l8BNCDJhtZ6vdXLOGs2+scQy4tGfmapsQIv2dWbznwmaZfs1R3p2O3QOV0xAP7eNmXGcqouzXXuE8DPGBbmzpQ==','mail@alexander-fisher.com',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-18 18:39:44
