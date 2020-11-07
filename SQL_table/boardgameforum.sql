-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 07 nov. 2020 à 13:07
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boardgameforum`
--

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `country`
--

INSERT INTO `country` (`id`, `country_name`) VALUES
(1, 'Afghanistan'),
(2, 'Aland Islands'),
(3, 'Albania'),
(4, 'Algeria'),
(5, 'American Samoa'),
(6, 'Andorra'),
(7, 'Angola'),
(8, 'Anguilla'),
(9, 'Antarctica'),
(10, 'Antigua and Barbuda'),
(11, 'Argentina'),
(12, 'Armenia'),
(13, 'Aruba'),
(14, 'Australia'),
(15, 'Austria'),
(16, 'Azerbaijan'),
(17, 'Bahamas'),
(18, 'Bahrain'),
(19, 'Bangladesh'),
(20, 'Barbados'),
(21, 'Belarus'),
(22, 'Belgium'),
(23, 'Belize'),
(24, 'Benin'),
(25, 'Bermuda'),
(26, 'Bhutan'),
(27, 'Bolivia'),
(28, 'Bonaire, Sint Eustatius and Saba'),
(29, 'Bosnia and Herzegovina'),
(30, 'Botswana'),
(31, 'Bouvet Island'),
(32, 'Brazil'),
(33, 'British Indian Ocean Territory'),
(34, 'Brunei Darussalam'),
(35, 'Bulgaria'),
(36, 'Burkina Faso'),
(37, 'Burundi'),
(38, 'Cambodia'),
(39, 'Cameroon'),
(40, 'Canada'),
(41, 'Cape Verde'),
(42, 'Cayman Islands'),
(43, 'Central African Republic'),
(44, 'Chad'),
(45, 'Chile'),
(46, 'China'),
(47, 'Christmas Island'),
(48, 'Cocos (Keeling) Islands'),
(49, 'Colombia'),
(50, 'Comoros'),
(51, 'Congo'),
(52, 'Congo, the Democratic Republic of the'),
(53, 'Cook Islands'),
(54, 'Costa Rica'),
(55, 'Cote D\'Ivoire'),
(56, 'Croatia'),
(57, 'Cuba'),
(58, 'Curacao'),
(59, 'Cyprus'),
(60, 'Czech Republic'),
(61, 'Denmark'),
(62, 'Djibouti'),
(63, 'Dominica'),
(64, 'Dominican Republic'),
(65, 'Ecuador'),
(66, 'Egypt'),
(67, 'El Salvador'),
(68, 'Equatorial Guinea'),
(69, 'Eritrea'),
(70, 'Estonia'),
(71, 'Ethiopia'),
(72, 'Falkland Islands (Malvinas)'),
(73, 'Faroe Islands'),
(74, 'Fiji'),
(75, 'Finland'),
(76, 'France'),
(77, 'French Guiana'),
(78, 'French Polynesia'),
(79, 'French Southern Territories'),
(80, 'Gabon'),
(81, 'Gambia'),
(82, 'Georgia'),
(83, 'Germany'),
(84, 'Ghana'),
(85, 'Gibraltar'),
(86, 'Greece'),
(87, 'Greenland'),
(88, 'Grenada'),
(89, 'Guadeloupe'),
(90, 'Guam'),
(91, 'Guatemala'),
(92, 'Guernsey'),
(93, 'Guinea'),
(94, 'Guinea-Bissau'),
(95, 'Guyana'),
(96, 'Haiti'),
(97, 'Heard Island and Mcdonald Islands'),
(98, 'Holy See (Vatican City State)'),
(99, 'Honduras'),
(100, 'Hong Kong'),
(101, 'Hungary'),
(102, 'Iceland'),
(103, 'India'),
(104, 'Indonesia'),
(105, 'Iran, Islamic Republic of'),
(106, 'Iraq'),
(107, 'Ireland'),
(108, 'Isle of Man'),
(109, 'Israel'),
(110, 'Italy'),
(111, 'Jamaica'),
(112, 'Japan'),
(113, 'Jersey'),
(114, 'Jordan'),
(115, 'Kazakhstan'),
(116, 'Kenya'),
(117, 'Kiribati'),
(118, 'Korea, Democratic People\"s Republic of'),
(119, 'Korea, Republic of'),
(120, 'Kosovo'),
(121, 'Kuwait'),
(122, 'Kyrgyzstan'),
(123, 'Lao People\'s Democratic Republic'),
(124, 'Latvia'),
(125, 'Lebanon'),
(126, 'Lesotho'),
(127, 'Liberia'),
(128, 'Libyan Arab Jamahiriya'),
(129, 'Liechtenstein'),
(130, 'Lithuania'),
(131, 'Luxembourg'),
(132, 'Macao'),
(133, 'Macedonia, the Former Yugoslav Republic of'),
(134, 'Madagascar'),
(135, 'Malawi'),
(136, 'Malaysia'),
(137, 'Maldives'),
(138, 'Mali'),
(139, 'Malta'),
(140, 'Marshall Islands'),
(141, 'Martinique'),
(142, 'Mauritania'),
(143, 'Mauritius'),
(144, 'Mayotte'),
(145, 'Mexico'),
(146, 'Micronesia, Federated States of'),
(147, 'Moldova, Republic of'),
(148, 'Monaco'),
(149, 'Mongolia'),
(150, 'Montenegro'),
(151, 'Montserrat'),
(152, 'Morocco'),
(153, 'Mozambique'),
(154, 'Myanmar'),
(155, 'Namibia'),
(156, 'Nauru'),
(157, 'Nepal'),
(158, 'Netherlands'),
(159, 'Netherlands Antilles'),
(160, 'New Caledonia'),
(161, 'New Zealand'),
(162, 'Nicaragua'),
(163, 'Niger'),
(164, 'Nigeria'),
(165, 'Niue'),
(166, 'Norfolk Island'),
(167, 'Northern Mariana Islands'),
(168, 'Norway'),
(169, 'Oman'),
(170, 'Pakistan'),
(171, 'Palau'),
(172, 'Palestinian Territory, Occupied'),
(173, 'Panama'),
(174, 'Papua New Guinea'),
(175, 'Paraguay'),
(176, 'Peru'),
(177, 'Philippines'),
(178, 'Pitcairn'),
(179, 'Poland'),
(180, 'Portugal'),
(181, 'Puerto Rico'),
(182, 'Qatar'),
(183, 'Reunion'),
(184, 'Romania'),
(185, 'Russian Federation'),
(186, 'Rwanda'),
(187, 'Saint Barthelemy'),
(188, 'Saint Helena'),
(189, 'Saint Kitts and Nevis'),
(190, 'Saint Lucia'),
(191, 'Saint Martin'),
(192, 'Saint Pierre and Miquelon'),
(193, 'Saint Vincent and the Grenadines'),
(194, 'Samoa'),
(195, 'San Marino'),
(196, 'Sao Tome and Principe'),
(197, 'Saudi Arabia'),
(198, 'Senegal'),
(199, 'Serbia'),
(200, 'Serbia and Montenegro'),
(201, 'Seychelles'),
(202, 'Sierra Leone'),
(203, 'Singapore'),
(204, 'Sint Maarten'),
(205, 'Slovakia'),
(206, 'Slovenia'),
(207, 'Solomon Islands'),
(208, 'Somalia'),
(209, 'South Africa'),
(210, 'South Georgia and the South Sandwich Islands'),
(211, 'South Sudan'),
(212, 'Spain'),
(213, 'Sri Lanka'),
(214, 'Sudan'),
(215, 'Suriname'),
(216, 'Svalbard and Jan Mayen'),
(217, 'Swaziland'),
(218, 'Sweden'),
(219, 'Switzerland'),
(220, 'Syrian Arab Republic'),
(221, 'Taiwan, Province of China'),
(222, 'Tajikistan'),
(223, 'Tanzania, United Republic of'),
(224, 'Thailand'),
(225, 'Timor-Leste'),
(226, 'Togo'),
(227, 'Tokelau'),
(228, 'Tonga'),
(229, 'Trinidad and Tobago'),
(230, 'Tunisia'),
(231, 'Turkey'),
(232, 'Turkmenistan'),
(233, 'Turks and Caicos Islands'),
(234, 'Tuvalu'),
(235, 'Uganda'),
(236, 'Ukraine'),
(237, 'United Arab Emirates'),
(238, 'United Kingdom'),
(239, 'United States'),
(240, 'United States Minor Outlying Islands'),
(241, 'Uruguay'),
(242, 'Uzbekistan'),
(243, 'Vanuatu'),
(244, 'Venezuela'),
(245, 'Viet Nam'),
(246, 'Virgin Islands, British'),
(247, 'Virgin Islands, U.s.'),
(248, 'Wallis and Futuna'),
(249, 'Western Sahara'),
(250, 'Yemen'),
(251, 'Zambia'),
(252, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Structure de la table `follows`
--

CREATE TABLE `follows` (
  `id_user` int(11) NOT NULL,
  `id_friend` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `follows`
--

INSERT INTO `follows` (`id_user`, `id_friend`) VALUES
(2, 3),
(3, 2),
(3, 4),
(5, 2),
(5, 6),
(6, 2),
(6, 3),
(6, 5),
(7, 4),
(7, 6),
(7, 7);

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `creator` varchar(255) DEFAULT NULL,
  `publisher` char(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `image` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `game`
--

INSERT INTO `game` (`id`, `name`, `creator`, `publisher`, `price`, `image`) VALUES
(1, 'Nessos', 'Takaaki Sayama et Toshiki Arao', 'IELLO', 0, 1),
(2, '7 wonders', ' Antoine Bauza', 'Repos production', 25, 1),
(3, 'Catan', 'Klaus Teuber', 'Kosmos', 35, 1),
(4, 'Shadow Hunter', 'Yasutaka Ikeda', 'Matagot', 22, 1),
(5, 'King of Tokyo', 'Richard Garfield', 'IELLO', 32, 1),
(6, 'Munchkin', 'Steve Jackson', 'Edge', 22, 1),
(7, 'Concepte', 'Alain Rivollet, Gaëtan Beaujannot', 'Repos Production', 27, 1),
(8, 'The Crew', 'Thomas Sing', 'IELLO', 14, 1),
(9, 'Troyes Dice', 'Sébastien Dujardin, Alain Orban, Xavier Georges', 'Pearl Games', 23, 1),
(10, 'Dixit', 'Jean-Louis Roubira', 'Libellud', 27, 1),
(11, 'Roll to the Top ! Laminate', 'Peter Joustra, Corné van Moorsel', 'Cwali', 17, 1),
(12, 'Pictures', 'Christian Stöhr, Daniela Stöhr', 'Matagot', 43, 1);

-- --------------------------------------------------------

--
-- Structure de la table `relation_tag`
--

CREATE TABLE `relation_tag` (
  `id_game` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `relation_tag`
--

INSERT INTO `relation_tag` (`id_game`, `id_tag`) VALUES
(1, 3),
(1, 6),
(1, 7),
(3, 8),
(4, 5),
(4, 10),
(5, 9),
(6, 11),
(6, 12),
(7, 13),
(8, 12),
(8, 14),
(9, 9),
(10, 13),
(11, 9),
(12, 13);

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `comment` varchar(4000) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_game` int(11) NOT NULL,
  `date_publication` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `review`
--

INSERT INTO `review` (`id`, `score`, `comment`, `id_user`, `id_game`, `date_publication`) VALUES
(1, 9, 'Excellent jeu de bluff, très rapide à jouer', 2, 1, '2020-10-16 16:52:13'),
(2, 4, 'J\'ai pas arrêté de perdre c\'était nul!', 4, 1, '2020-10-16 16:52:54'),
(3, 10, 'Meilleur jeu au monde, on a pu apprendre les règles en 2 minutes et s\'amuser pendant des heures!', 3, 1, '2020-10-16 16:53:44'),
(4, 10, 'C\'est mon jeu de dés préféré!', 5, 5, '2020-11-07 12:39:35'),
(5, 4, 'J\'aime beaucoup les jeux de dés, mais celui là c\'est pas le meilleur.', 5, 9, '2020-11-07 12:40:21'),
(6, 8, 'C\'est mon deuxième jeu de dés préféré!', 5, 11, '2020-11-07 12:42:48'),
(7, 10, 'Mon jeu de devinettes préféré, surtout que ce que l\'on doit faire deviner est trop drôle!', 6, 7, '2020-11-07 12:50:31'),
(8, 7, 'Un très bon jeu de devinettes, mais il est un peu lent :/', 6, 10, '2020-11-07 12:51:10'),
(9, 3, 'J\'y ai pas joué plus de 15 minutes parce que ce jeu est ennuyant.', 6, 12, '2020-11-07 12:51:56'),
(10, 2, 'c\'est un jeu où il n\'y a pas besoin de réfléchir, c\'est nul!', 6, 11, '2020-11-07 12:53:19'),
(11, 8, 'J\'aime jeu de bluff, mais celui la, moins bien que poker.', 7, 1, '2020-11-07 12:59:02'),
(12, 10, 'On peut utiliser triche! c\'est mieux que poker!', 7, 6, '2020-11-07 13:00:13'),
(13, 1, 'On doit tuer amis pour victoire! c\'est hérésie!', 7, 4, '2020-11-07 13:01:20'),
(14, 7, 'Beaucoup compter dans ce jeu, comme dans poker, je suis fort à compter.', 7, 2, '2020-11-07 13:02:41'),
(15, 5, '', 7, 12, '2020-11-07 13:03:40');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `tag_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id`, `tag_name`) VALUES
(1, 'reflexion'),
(2, 'reflexes'),
(3, 'bluff'),
(4, 'mensonge'),
(5, 'trahison'),
(6, 'rapide à apprendre'),
(7, 'rapide à jouer'),
(8, 'commerce'),
(9, 'dés'),
(10, 'rôles cachés'),
(11, 'triche'),
(12, 'cartes'),
(13, 'devinette'),
(14, 'coopératif');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pseudonym` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` int(1) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `date_account_creation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudonym`, `email`, `password`, `profile_picture`, `country`, `birthdate`, `date_account_creation`) VALUES
(2, 'kalharko', 'oscar.dewasmes@utbm.fr', '*A28D6A233B76FC581A8E711B8966883C91C97612', 1, 76, '2001-08-21', '2020-10-16 16:14:57'),
(3, 'racsomc', 'oscar.dewasmes@gmail.com', '*4AD47E08DAE2BD4F0977EED5D23DC901359DF617', 0, 76, '2001-08-21', '2020-10-16 16:16:25'),
(4, 'ppoussin', 'p.poussin@yahoo.fr', '*F207EE4F2A07EC1ED5ECE65E0BC10E957A7DADBD', 1, 76, '2001-08-21', '2020-10-16 16:17:05'),
(5, 'oka', 'oka@oka.oka', '$2y$10$TXxDNnNK.dply.E6ma7gee9VEbEq/TBJNFuzdmhDIgeUv6geeColu', 1, 9, '2020-10-26', '2020-11-07 11:54:20'),
(6, 'Devinette_Master', 'master@devinettes.fr', '$2y$10$aizdVFtDdF8ovMhrpw1ff.b24K6RgsIv.fK2WPzf5RsJSS6x54PeK', 1, 76, '1999-11-10', '2020-11-07 12:49:19'),
(7, 'poker_god', 'poker@god.fr', '$2y$10$1/PGVl0KKV83KriucCBt.O6ykloCwDOLAqOHKmd.YuSIgfHotv5u6', 1, 185, '1984-11-15', '2020-11-07 12:57:49');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `id_user` int(11) NOT NULL,
  `id_review` int(11) NOT NULL,
  `positive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vote`
--

INSERT INTO `vote` (`id_user`, `id_review`, `positive`) VALUES
(2, 2, 0),
(3, 1, 1),
(6, 1, 1),
(6, 2, -1),
(6, 3, 1),
(6, 4, -1),
(6, 5, 1),
(6, 6, 1),
(6, 7, 1),
(7, 1, 1),
(7, 9, 1),
(7, 12, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id_user`,`id_friend`),
  ADD KEY `id_friend` (`id_friend`);

--
-- Index pour la table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `relation_tag`
--
ALTER TABLE `relation_tag`
  ADD PRIMARY KEY (`id_game`,`id_tag`),
  ADD KEY `id_tag` (`id_tag`);

--
-- Index pour la table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_game` (`id_game`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudonym` (`pseudonym`),
  ADD KEY `country` (`country`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id_user`,`id_review`),
  ADD KEY `id_review` (`id_review`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT pour la table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`id_friend`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `relation_tag`
--
ALTER TABLE `relation_tag`
  ADD CONSTRAINT `relation_tag_ibfk_1` FOREIGN KEY (`id_game`) REFERENCES `game` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `relation_tag_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id_game`) REFERENCES `game` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`country`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`id_review`) REFERENCES `review` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
