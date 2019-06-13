-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 13, 2019 at 11:27 PM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mondocine`
--

-- --------------------------------------------------------

--
-- Table structure for table `acteur`
--

CREATE TABLE `acteur` (
  `acteur_id` int(11) NOT NULL,
  `acteur_name` varchar(100) DEFAULT NULL,
  `acteur_nationalite` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_user`
--

CREATE TABLE `app_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_mail` varchar(100) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `user_photo` varchar(150) DEFAULT '/users/unknown.jpg',
  `user_dateinscription` date DEFAULT NULL,
  `user_role_role_id` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_user`
--

INSERT INTO `app_user` (`user_id`, `user_name`, `user_mail`, `user_password`, `user_photo`, `user_dateinscription`, `user_role_role_id`) VALUES
(1, 'tib', 'tib@tib.fr', '$2y$10$CKRYtEYZfZ9zjtFqbTx0WuO8b/3eMkfuSHIILk1tJWO0SLtF3gKfy', '/users/unknown.jpg', NULL, 2),
(2, 'tib2', 'tib2@tib2.fr', '$2y$10$tpYZhY/YKVMATCDFTXvZd.zdRrw8aVef.Za9ZQ44xE9o4Kq6l7AeC', '/users/unknown.jpg', NULL, 1),
(3, 'tib3', 'tib3@tib3.fr', '$2y$10$pofbjLHS9o9FWuw2gPhq/uOtXpV7nYa8byEaBHH7LWjeRgtqc04lS', '/users/unknown.jpg', NULL, 3),
(4, 'tib5', 'tib5@tib5.fr', '$2y$10$NqYPdBiTNkJSjoPyMDcjNu92PFuoiHQdtWimjxMBl3FJGT5kaEoWO', '/users/tib.jpg', '2019-06-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `critique`
--

CREATE TABLE `critique` (
  `critique_id` int(11) NOT NULL,
  `critique_titre` varchar(150) DEFAULT NULL,
  `critique_contenu` text,
  `isPublished` tinyint(4) NOT NULL DEFAULT '0',
  `critique_date` datetime DEFAULT NULL,
  `app_user_user_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `critique`
--

INSERT INTO `critique` (`critique_id`, `critique_titre`, `critique_contenu`, `isPublished`, `critique_date`, `app_user_user_id`, `film_id`) VALUES
(1, 'Super !', 'La saga \"X-Men\" peut-elle vaincre la malédiction des troisièmes épisodes ? C\'est la grande question posée par ce \"Dark Phoenix\". L\'échec de \"L\'Affrontement final\" signé Brett Ratner avait condamné la première phase de la licence à subir un faux reboot et, dans une moindre mesure, celui du dernier en date, \"Apocalypse\", a presque gommé la réussite des deux films l\'ayant précédé et condamné les jeunes mutants mis en scène à l\'indifférence générale tant l\'arrivée de leur dernier adversaire surpuissant a sacrifié la force de ces personnages sur l\'autel des combats spectaculaires... Comme si cela ne suffisait pas, \"Dark Phœnix\" part avec une tripotée d\'handicaps supplémentaires ! Pour commencer, on le sait, il est le dernier représentant des X-Men tel qu\'on les connaît, ceux-ci étant tous amenés à rejoindre le giron du MCU dans les années à venir, \"Dark Phoenix\" est donc un film conçu presque par obligation par la Fox et pour ses acteurs en fin de contrat. Autant dire que ce statut est à double tranchant question qualité : soit toute l\'équipe a décidé de se lâcher pour offrir un point final en forme de feu d\'artifice à cette période mutante glorieuse (et rattraper \"Apocalypse\" en passant), soit... ben... tout le monde s\'en fiche un peu et va donner le strict minimum (au vu du peu d\'attentes que suscite le film, les spectateurs semblent d\'emblée avoir envisagé la deuxième solution). De plus, \"Dark Phœnix\" reprend évidemment l\'histoire du passage du côté obscur de Jean Grey déjà au cœur de \"L\'Affrontement Final\". Si cela en rajoute au côté \"film maudit\" de ce quatrième opus, on peut aussi dire qu\'une nouvelle approche ne pourra que surpasser celle de Brett Ratner mais, là encore, quelques doutes subsistent : hormis les figures emblématiques, peu de mutants de la nouvelle génération ont réussi à effacer le souvenir de ceux de la précédente, à commencer par la Jean Grey du rôle-titre, malgré tout le respect que l\'on doit à Sophie Turner, l\'actrice n\'est jamais parvenue à faire oublier la présence ô combien charismatique de Famke Janssen. Ajoutez à cela une production un brin chaotique (toute la dernière partie a été retournée à cause d\'une trop grande promiscuité avec celle de \"Captain Marvel\") ou encore une campagne promo certes consistante mais qui n\'a pas emballé grand monde, et vous obtiendrez un épisode conclusif qui a tout pour se vautrer dès la ligne départ. Heureusement, \"Dark Phœnix\" va tout de même déjouer quelques-unes de ces pires appréhensions pour un résultat global pas si mauvais que prévu... D\'abord, \"Dark Phoenix\" démarre de la meilleure des manières en misant sur un aspect finalement peu entrevu chez les \"X-Men\" au travers des différents films jusqu\'ici : ce sont bel et bien des super-héros avant tout ! Ben oui, entre les âmes archi-torturées, les guerres intestines et les supra-vilains mutants, c\'est un peu bête à dire mais on avait oublié cette donne essentielle de leur identité. Nous les présenter dans un monde où ils sont enfin traités comme tels après les péripéties de \"Apocalypse\" fait donc un bien fou, apportant un vent de fraîcheur rétro issu de comics au papier que l\'on imagine jauni par le temps. Mieux, cela permet enfin de mettre enfin en avant les plus jeunes membres de l\'équipe -leurs individualités et leur unité- dans un sauvetage vu par le prisme d\'un premier degré très naïf complètement à l\'opposé de leurs tergiversations existentielles habituelles. Évidemment, cela ne dure qu\'un temps et la problématique Jean Grey va venir rapidement changer la donne mais, bon sang, que cela a fait plaisir de voir les X-Men revêtir leur rôle le plus archaïque ! Sur l\'ampleur du bouleversement que va impliquer Jean Grey/Phœnix, le film va rentrer dans le rang des épisodes précédents en tentant de mettre en lumière toutes les conséquences qu\'implique son level-up sur son entourage mutant. Comme d\'habitude, Charles Xavier est confronté à ses propres fautes, ses petits copains remettent en cause sa parole et des changements de camps s\'opèrent avec le retour de Magneto dans l\'équation quant à la marche à adopter face à la mutante surpuissante. On navigue dans des eaux archi-connues dont Simon Kinberg se montre incapable de tirer le moindre élément nouveau. \"Dark Phœnix\" pourrait pourtant être vraiment bon à ce moment mais, pendant une bonne heure, le réalisateur débutant se montre incapable de créer la moindre intensité dramatique ou dynamisme dans les scènes d\'action alors que tout s\'y prête, punaise ! Lorsque la tragédie frappe l\'équipe des X-Men, c\'est bien simple, le tout paraît expédié à la vitesse de la lumière sans qu\'aucun impact émotionnel ne se fasse véritablement ressentir. Du côté des quelques affrontements, on reste bouche bée sur le manque de percussion et le rythme mollasson sur lequel les mutants se renvoient les coups (on se croirait presque dans un format de série TV, même une baston dans \"The Gifted\" est plus enthousiasmante!). Pendant que la majorité des vieux de la vieille du casting parait éteinte, quelques-uns parviennent néanmoins à donner le change (merci Michael Fassbender et Nicholas Hoult notamment) pour insuffler un peu d\'âme à un ensemble qui en manque désespérément. Même Sophie Turner que l\'on redoutait le plus pour soutenir un tel rôle sur ses frêles épaules arrive à retransmettre ce dilemme de fragilité et de force à travers sa Jean Grey mais, encore une fois, la caméra de Kinberg n\'arrive que rarement à la mettre en valeur. Enfin, si l\'entrée en scène du personnage de Jessica Chastain crée un climat de mystère plutôt bienvenu dans un premier temps, on réalise assez vite que son rôle se limitera à un antagoniste aux motivations pas vraiment des plus passionnantes... Cependant, un petit miracle se produit : la dernière partie (qui est donc le fruit de reshoots tardifs) va venir bousculer ce tempo de gastéropode neurasthénique et ces situations plus que convenues dans lesquels le film s\'enfermait dangereusement en effectuant un virage inopinée vers le grand spectacle ! Dès lors, même avec la meilleur volonté du monde, il est impossible de croire que ce soit encore Simon Kinberg derrière la caméra (ou qu\'il n\'est pas reçu un énorme coup de main du moins) tant \"Dark Phoenix\" devient un tout autre film ! Les séquences d\'action prennent ainsi une dimension beaucoup plus jouissive, chaque mutant a son propre moment pour y briller et on ressent même enfin toute la puissance qui habite Jean Grey et ses collègues ! Ce n\'est sans doute pas assez pour faire oublier le déroulement boiteux de tout ce qui a précédé ou nous faire croire à la fin subite des dissensions de groupe au profit de l\'union sacrée (tout est terriblement facile à ce niveau) mais c\'est suffisant pour nous gratifier d\'un très bon final et rendre justice à tous ces personnages à travers ce qu\'ils savent faire de mieux : nous en mettre plein la vue avec leurs pouvoirs ! Et là-dessus, \"Dark Phoenix\" sauve incontestablement la partie avec son dernier acte. Dommage que l\'épilogue vienne ternir le tableau en revenant à un ton plus expéditif pas du tout à la hauteur d\'une conclusion d\'une telle saga (si ce n\'est un amusant un clin d\'oeil à ses débuts)... À l\'instar d\'un \"Apocalypse\", \"Dark Phoenix\" souffre de trop nombreux problèmes pour convaincre totalement mais, entre une première partie puisant dans l\'esprit des comics originels et une dernière tenant ses promesses de divertissement, le film fait plutôt bien son job à condition d\'oublier les critères qualitatifs instaurés par les meilleurs opus de la franchise. Supérieur à l\'affront commis par Brett Ratner, \"Dark Phoenix\" se traîne hélas le boulet d\'un réalisateur sans vision qui l\'empêche de prétendre à plus. Avec un metteur en scène expérimenté, cette conclusion aurait pu faire taire les doutes installés en amont, elle en avait clairement le potentiel en tout cas. Ici, le manque d\'ambition se fait trop cruellement sentir pendant une bonne partie du film pour n\'y voir autre chose qu\'un au revoir fait un peu par obligation à nos mutants préférés... ', 1, '2019-06-11 10:13:34', 2, 3),
(2, 'Un grand film !', 'Je ne comprends pas les critiques négatives. C\'est un grand moment de la vie des X-men et particulièrement du plus puissant. Film spectaculaire, une fois sortie, on en redemande. ', 1, '2019-06-02 16:18:00', 1, 3),
(3, 'Nul!', 'Décevant et en dessous des promesses de la bande annonce. Le film manque de rythme et le scénario s’essouffle assez vite. ', 1, '2019-06-04 08:48:00', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `film_id` int(11) NOT NULL,
  `film_titre` varchar(150) DEFAULT NULL,
  `film_date` date DEFAULT NULL,
  `film_sinopsys` text,
  `genre_id` int(11) NOT NULL,
  `film_image_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`film_id`, `film_titre`, `film_date`, `film_sinopsys`, `genre_id`, `film_image_name`) VALUES
(3, 'X-Men : Dark Phoenix', '2019-06-05', 'Dans cet ultime volet, les X-MEN affrontent leur ennemi le plus puissant, Jean Grey, l’une des leurs.\r\nAu cours d\'une mission de sauvetage dans l\'espace, Jean Grey frôle la mort, frappée par une mystérieuse force cosmique. De retour sur Terre, cette force la rend non seulement infiniment plus puissante, mais aussi beaucoup plus instable. En lutte contre elle-même, Jean Grey déchaîne ses pouvoirs, incapable de les comprendre ou de les maîtriser. Devenue incontrôlable et dangereuse pour ses proches, elle défait peu à peu les liens qui unissent les X-Men. ', 3, '/films/2839812.jpg-r_1920_1080-f_jpg-q_x-xxyxx.jpg'),
(4, 'Ma', '2019-06-05', 'Sue Ann, une femme solitaire vit dans une petite ville de l&rsquo;Ohio. Un jour, une adolescente ayant r&eacute;cemment emm&eacute;nag&eacute;, lui demande d&rsquo;acheter de l&rsquo;alcool pour elle et ses amis ; Sue Ann y voit la possibilit&eacute; de se faire de nouveaux amis plus jeunes qu&rsquo;elle. Elle propose aux adolescents de tra&icirc;ner et de boire en s&ucirc;ret&eacute; dans le sous-sol am&eacute;nag&eacute; de sa maison. Mais Sue Ann a quelques r&egrave;gles : ne pas blasph&eacute;mer, l&rsquo;adolescent qui conduit doit rester sobre, ne jamais monter dans sa maison et l&rsquo;appeler MA. Mais l&rsquo;hospitalit&eacute; de MA commence &agrave; virer &agrave; l&rsquo;obsession. Le sous-sol qui au d&eacute;but &eacute;tait pour les adolescents l&rsquo;endroit r&ecirc;v&eacute; pour faire la f&ecirc;te va devenir le pire endroit sur terre. ', 3, '/films/MA.jpg'),
(5, 'Parasite', '2019-06-05', 'Toute la famille de Ki-taek est au chômage, et s’intéresse fortement au train de vie de la richissime famille Park. Un jour, leur fils réussit à se faire recommander pour donner des cours particuliers d’anglais chez les Park. C’est le début d’un engrenage incontrôlable, dont personne ne sortira véritablement indemne... ', 3, '/films/1087814.jpg-r_1920_1080-f_jpg-q_x-xxyxx.jpg'),
(6, 'Amazing Grace - Aretha Franklin\r\n', '2019-06-12', 'En janvier 1972, Aretha Franklin enregistre un album live dans une église intimiste du quartier de Watts à Los Angeles. Le disque de ce concert mythique, AMAZING GRACE, devient l’album de Gospel le plus vendu de tous les temps, consacrant le succès de la Reine de la Soul. Si ce concert a été totalement filmé, les images n’ont jamais été dévoilées… Jusqu’à aujourd’hui. Découvrez le film inédit d\'un concert exceptionnel et l\'incroyable grâce d\'une Aretha Franklin bouleversante. ', 3, '/films/2151123.jpg-r_1920_1080-f_jpg-q_x-xxyxx.jpg'),
(7, 'Piranhas', '2019-06-12', 'Nicola et ses amis ont entre dix et quinze ans. Ils se déplacent à scooter, ils sont armés et fascinés par la criminalité. Ils ne craignent ni la prison ni la mort, seulement de mener une vie ordinaire comme leurs parents. Leurs modèles : les parrains de la Camorra. Leurs valeurs : l’argent et le pouvoir. Leurs règles : fréquenter les bonnes personnes, trafiquer dans les bons endroits, et occuper la place laissée vacante par les anciens mafieux pour conquérir les quartiers de Naples, quel qu’en soit le prix. ', 3, '/films/4741383.jpg-r_1920_1080-f_jpg-q_x-xxyxx.jpg'),
(8, 'L\'Autre continent\r\n', '2019-06-12', 'Maria a 30 ans, elle est impatiente, frondeuse, et experte en néerlandais. Olivier a le même âge, il est lent, timide et parle quatorze langues. Ils se rencontrent à Taïwan. Et puis soudain, la nouvelle foudroyante. C’est leur histoire. Celle de la force incroyable d’un amour. Et celle de ses confins, où tout se met à lâcher. Sauf Maria.', 3, '/films/1415730.jpg-r_1920_1080-f_jpg-q_x-xxyxx.jpg'),
(9, 'Et je choisis de vivre\r\n', '2019-06-12', '\" Quand on perd son père ou sa mère on est orpheline, quand on perd son conjoint on est veuve mais quand on perd son enfant, il n’y a plus de mots \". À tout juste 30 ans, Amande perd son enfant. Pour se reconstruire, elle entreprend alors un parcours initiatique dans la Drôme, accompagnée de son ami réalisateur, Nans Thomassey. Ensemble, et sous l’œil de la caméra, ils partent à la rencontre d’hommes et de femmes qui ont, comme Amande, vécu la perte d’un enfant. De cette quête de sens naît Et je choisis de vivre, un film sur le deuil, à la fois sensible, émouvant et rempli d’espoir. ', 3, '/films/4962529.jpg-r_1920_1080-f_jpg-q_x-xxyxx.jpg'),
(10, 'test titres film', '2019-06-12', 'Test synopsis film Test synopsis filmTest synopsis filmTest synopsis filmTest synopsis filmTest synopsis filmTest synopsis filmTest synopsis filmTest synopsis film', 3, '/films/1087814.jpg-r_1920_1080-f_jpg-q_x-xxyxx.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `films_acteurs`
--

CREATE TABLE `films_acteurs` (
  `film_film_id` int(11) NOT NULL,
  `acteur_acteur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `genre_libelle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre_libelle`) VALUES
(1, 'Horreur'),
(2, 'Aventure'),
(3, 'Thriller'),
(4, 'Documentaire'),
(5, 'Drame');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `role_libelle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_libelle`) VALUES
(1, 'utilisateur'),
(2, 'moderateur'),
(3, 'administrateur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acteur`
--
ALTER TABLE `acteur`
  ADD PRIMARY KEY (`acteur_id`);

--
-- Indexes for table `app_user`
--
ALTER TABLE `app_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_app_user_user_role1_idx` (`user_role_role_id`);

--
-- Indexes for table `critique`
--
ALTER TABLE `critique`
  ADD PRIMARY KEY (`critique_id`),
  ADD KEY `fk_critique_app_user_idx` (`app_user_user_id`),
  ADD KEY `fk_critique_film1_idx` (`film_id`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`film_id`),
  ADD UNIQUE KEY `film_titre` (`film_titre`),
  ADD KEY `fk_film_genre1_idx` (`genre_id`);

--
-- Indexes for table `films_acteurs`
--
ALTER TABLE `films_acteurs`
  ADD PRIMARY KEY (`film_film_id`,`acteur_acteur_id`),
  ADD KEY `fk_film_has_acteur_acteur1_idx` (`acteur_acteur_id`),
  ADD KEY `fk_film_has_acteur_film1_idx` (`film_film_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acteur`
--
ALTER TABLE `acteur`
  MODIFY `acteur_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_user`
--
ALTER TABLE `app_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `critique`
--
ALTER TABLE `critique`
  MODIFY `critique_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `film_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_user`
--
ALTER TABLE `app_user`
  ADD CONSTRAINT `fk_app_user_user_role1` FOREIGN KEY (`user_role_role_id`) REFERENCES `user_role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `fk_film_genre1` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `films_acteurs`
--
ALTER TABLE `films_acteurs`
  ADD CONSTRAINT `fk_film_has_acteur_acteur1` FOREIGN KEY (`acteur_acteur_id`) REFERENCES `acteur` (`acteur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_film_has_acteur_film1` FOREIGN KEY (`film_film_id`) REFERENCES `film` (`film_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
