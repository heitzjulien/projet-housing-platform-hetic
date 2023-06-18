-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 07 juin 2023 à 17:29
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+02:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `aparis`
--

-- --------------------------------------------------------

--
-- Structure de la table `authentifications`
--

CREATE TABLE `authentifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `agent` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `token_start` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token_end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `housekeeping`
--

CREATE TABLE `housekeeping` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `housing_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `instruction` varchar(255) NOT NULL,
  `status` enum('ToDo','InProgress','Done') NOT NULL DEFAULT 'ToDo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `housekeeping_notes`
--

CREATE TABLE `housekeeping_notes` (
  `id` int(11) NOT NULL,
  `housekeeping_id` int(11) NOT NULL,
  `note_content` text NOT NULL,
  `note_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `housing`
--

CREATE TABLE `housing` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `note` text,
  `instruction` text,
  `number_pieces` int(11) NOT NULL,
  `number_rooms` int(11) NOT NULL,
  `number_bathroom` int(11) NOT NULL,
  `exterior` set('pool','terrace','garden') DEFAULT NULL,
  `car_park` set('garage','underground_parking','Parking_spot','Covered_parking_space') DEFAULT NULL,
  `area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `housing_images`
--

CREATE TABLE `housing_images` (
  `housing_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `housing_location`
--

CREATE TABLE `housing_location` (
  `housing_id` int(11) NOT NULL,
  `country` enum('France') NOT NULL DEFAULT 'France',
  `city` enum('Paris') NOT NULL DEFAULT 'Paris',
  `zip` enum('75001','75002','75003','75004','75005','75006','75007','75008','75009','75010','75011','75012','75013','75014','75015','75016','75017','75018','75019','75020') NOT NULL,
  `district` enum('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20') NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `housing_services`
--

CREATE TABLE `housing_services` (
  `housing_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `housing_unavailability`
--

CREATE TABLE `housing_unavailability` (
  `id` int(11) NOT NULL,
  `housing_id` int(11) NOT NULL,
  `unavailability_start` datetime NOT NULL,
  `unavailability_end` datetime NOT NULL,
  `unavailability_status` enum('booked','checkout','renovation') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `housing_unavailability_booked_extra`
--

CREATE TABLE `housing_unavailability_booked_extra` (
  `unavailability_id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('send','read') NOT NULL DEFAULT 'send'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `messages_images`
--

CREATE TABLE `messages_images` (
  `message_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `opinions`
--

CREATE TABLE `opinions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `housing_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `display` enum('hide','show') NOT NULL DEFAULT 'hide'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `opinions_images`
--

CREATE TABLE `opinions_images` (
  `opinion_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `housing_id` int(11) NOT NULL,
  `reservation_period` int(11) NOT NULL,
  `reservation_total_price` int(11) NOT NULL,
  `reservation_status` enum('pass','accept','cancel') NOT NULL DEFAULT 'accept'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `roles` set('client','management','maintenance','admin') NOT NULL DEFAULT 'client',
  `account_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `account_status` enum('waiting','valid','disable') NOT NULL DEFAULT 'waiting',
  `last_seen` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users_admins_extra`
--

CREATE TABLE `users_admins_extra` (
  `user_id` int(11) NOT NULL,
  `role_subrogation` enum('client','management','maintenance','admin') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `authentifications`
--
ALTER TABLE `authentifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_user_agent` (`user_id`,`agent`);

--
-- Index pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_reservation_id` (`reservation_id`);

--
-- Index pour la table `housekeeping`
--
ALTER TABLE `housekeeping`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `housekeeping_notes`
--
ALTER TABLE `housekeeping_notes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `housing`
--
ALTER TABLE `housing`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `housing_images`
--
ALTER TABLE `housing_images`
  ADD PRIMARY KEY (`housing_id`,`image`);

--
-- Index pour la table `housing_location`
--
ALTER TABLE `housing_location`
  ADD PRIMARY KEY (`housing_id`),
  ADD UNIQUE KEY `uc_location` (`country`,`city`,`zip`,`district`,`address`);

--
-- Index pour la table `housing_services`
--
ALTER TABLE `housing_services`
  ADD PRIMARY KEY (`housing_id`,`service_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Index pour la table `housing_unavailability`
--
ALTER TABLE `housing_unavailability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `housing_id` (`housing_id`);

--
-- Index pour la table `housing_unavailability_booked_extra`
--
ALTER TABLE `housing_unavailability_booked_extra`
  ADD PRIMARY KEY (`unavailability_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages_images`
--
ALTER TABLE `messages_images`
  ADD PRIMARY KEY (`message_id`,`image`);

--
-- Index pour la table `opinions`
--
ALTER TABLE `opinions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `opinions_images`
--
ALTER TABLE `opinions_images`
  ADD PRIMARY KEY (`opinion_id`,`image`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Index pour la table `users_admins_extra`
--
ALTER TABLE `users_admins_extra`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `housekeeping`
--
ALTER TABLE `housekeeping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `housekeeping_notes`
--
ALTER TABLE `housekeeping_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `housing`
--
ALTER TABLE `housing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `authentifications`
--
ALTER TABLE `authentifications`
  ADD CONSTRAINT `authentifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `housing_services`
--
ALTER TABLE `housing_services`
  ADD CONSTRAINT `housing_services_ibfk_1` FOREIGN KEY (`housing_id`) REFERENCES `housing` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `housing_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `housing_unavailability`
--
ALTER TABLE `housing_unavailability`
  ADD CONSTRAINT `housing_unavailability_ibfk_1` FOREIGN KEY (`housing_id`) REFERENCES `housing` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users_admins_extra`
--
ALTER TABLE `users_admins_extra`
  ADD CONSTRAINT `users_admins_extra_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
