-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 28 juil. 2023 à 12:54
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `clm`
--

-- --------------------------------------------------------

--
-- Structure de la table `charging_report`
--

CREATE TABLE `charging_report` (
  `id_report` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `charge_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_cas` int(10) NOT NULL,
  `id_case` int(10) NOT NULL,
  `emp_case` varchar(20) NOT NULL,
  `NI` varchar(20) NOT NULL,
  `codice` varchar(20) NOT NULL,
  `qte_charg` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `component`
--

CREATE TABLE `component` (
  `id_component` int(50) NOT NULL,
  `Codice` varchar(50) NOT NULL,
  `Product_name` varchar(40) NOT NULL,
  `Machine` varchar(20) NOT NULL,
  `Table_Machine` int(11) NOT NULL,
  `Emplacement` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `component`
--

INSERT INTO `component` (`id_component`, `Codice`, `Product_name`, `Machine`, `Table_Machine`, `Emplacement`) VALUES
(111, 'CON00281', 'BRD04529', 'F5', 2, '61-1'),
(112, 'CON00292', 'BRD04529', 'F5', 2, '73-1'),
(113, 'B0100025', 'BRD04529', 'F5', 2, '97-1'),
(114, 'R0603J331', 'BRD04529', 'H60', 4, '61-1'),
(115, 'R0603J103', 'BRD04529', 'H60', 4, '61-2'),
(116, 'R0100135', 'BRD04529', 'H60', 4, '67-1'),
(117, 'C0100204', 'BRD04529', 'H60', 4, '67-2'),
(118, 'R0101106', 'BRD04529', 'H60', 4, '61-3'),
(119, 'C0100091', 'BRD04529', 'H60', 4, '67-3'),
(120, 'R0101727', 'BRD04529', 'H60', 3, '7-1'),
(121, 'T0100030', 'BRD04529', 'H60', 3, '7-2'),
(122, 'R0101865', 'BRD04529', 'H60', 3, '7-3'),
(123, 'D0300358', 'BRD04529', 'H60', 3, '13-1'),
(124, 'B0805-BLM21P', 'BRD04529', 'H60', 3, '13-2'),
(125, 'R0101102', 'BRD04529', 'H60', 3, '13-3'),
(126, 'C0100040', 'BRD04529', 'H60', 2, '67-1'),
(127, 'C0100642', 'BRD04529', 'H60', 2, '67-2'),
(128, 'R0100050', 'BRD04529', 'H60', 2, '67-3'),
(129, 'I0100239', 'BRD04529', 'H60', 1, '1-1'),
(130, 'I0101171', 'BRD04529', 'H60', 1, '7-1'),
(131, 'D0200415', 'BRD04529', 'H60', 1, '55-1'),
(132, 'D0200320', 'BRD04529', 'H60', 1, '61-1'),
(133, 'C0100205', 'BRD04529', 'H60', 1, '61-2'),
(134, 'T0200073', 'BRD04529', 'H60', 1, '61-3'),
(135, 'R0101103', 'BRD04529', 'H60', 1, '67-1'),
(136, 'R0100817', 'BRD04529', 'H60', 1, '67-2'),
(137, 'R0100267', 'BRD04529', 'H60', 1, '67-3');

-- --------------------------------------------------------

--
-- Structure de la table `component_verification`
--

CREATE TABLE `component_verification` (
  `id` int(11) NOT NULL,
  `component_ni` varchar(255) DEFAULT NULL,
  `codice` varchar(50) NOT NULL,
  `id_component` int(50) NOT NULL,
  `verification_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `component_verification`
--

INSERT INTO `component_verification` (`id`, `component_ni`, `codice`, `id_component`, `verification_date`) VALUES
(64, '1017110234', 'CON00281', 111, '2023-07-28 09:47:21'),
(65, '1022600014', 'B0100025', 113, '2023-07-28 09:52:52'),
(66, '1025440015', 'CON00292', 112, '2023-07-28 09:53:57');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `Product_id` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `Creation_date` varchar(40) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`Product_id`, `Name`, `Description`, `Creation_date`, `Status`) VALUES
('BRD04529', 'BRD04529', '7 touch', '2023-07-28 10:54:17', 'Enabled');

-- --------------------------------------------------------

--
-- Structure de la table `retour`
--

CREATE TABLE `retour` (
  `id_report` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `NI` varchar(20) NOT NULL,
  `qte_retour` bigint(255) NOT NULL,
  `retour_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_cas` int(10) NOT NULL,
  `id_case` int(10) NOT NULL,
  `emp_case` varchar(20) NOT NULL,
  `codice` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `testing_report`
--

CREATE TABLE `testing_report` (
  `id_report` int(11) NOT NULL,
  `Agent_name` varchar(50) NOT NULL,
  `Ni` bigint(40) NOT NULL,
  `Codice` varchar(40) NOT NULL,
  `Machine` varchar(30) NOT NULL,
  `Table_machine` int(10) NOT NULL,
  `Emplacement` int(10) NOT NULL,
  `Feder` int(10) NOT NULL,
  `Changed_Feder` int(10) NOT NULL,
  `New_Ni` int(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `testing_report`
--

INSERT INTO `testing_report` (`id_report`, `Agent_name`, `Ni`, `Codice`, `Machine`, `Table_machine`, `Emplacement`, `Feder`, `Changed_Feder`, `New_Ni`, `date`) VALUES
(64, 'Operator', 1017110234, 'CON00281', 'F5', 2, 61, 0, 0, 0, '2023-07-28 09:45:39'),
(65, 'Operator', 1017110234, 'CON00281', 'F5', 2, 61, 0, 0, 0, '2023-07-28 09:47:21'),
(66, 'Operator', 1022600014, 'B0100025', 'F5', 2, 97, 0, 0, 0, '2023-07-28 09:52:52'),
(67, 'Operator', 1025440015, 'CON00292', 'F5', 2, 73, 0, 0, 0, '2023-07-28 09:53:57');

-- --------------------------------------------------------

--
-- Structure de la table `uncharging_repport`
--

CREATE TABLE `uncharging_repport` (
  `id_report_uncharging` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `id_cas` int(10) NOT NULL,
  `id_case` int(10) NOT NULL,
  `emp_case` varchar(20) NOT NULL,
  `NI` varchar(20) NOT NULL,
  `codice` varchar(20) NOT NULL,
  `qte_dump` bigint(255) NOT NULL,
  `dump_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` int(40) NOT NULL,
  `privelege` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `privelege`) VALUES
(13, 'LAdmin', 123456, 'Locker Admin'),
(14, 'LAgent', 123456, 'Locker Agent'),
(18, 'PAdmin', 123456, 'Production Admin'),
(19, 'Operator', 123456, 'Production Agent'),
(26, 'SAdmin', 123456, 'Super Admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `charging_report`
--
ALTER TABLE `charging_report`
  ADD PRIMARY KEY (`id_report`);

--
-- Index pour la table `component`
--
ALTER TABLE `component`
  ADD PRIMARY KEY (`id_component`);

--
-- Index pour la table `component_verification`
--
ALTER TABLE `component_verification`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_id`);

--
-- Index pour la table `retour`
--
ALTER TABLE `retour`
  ADD PRIMARY KEY (`id_report`);

--
-- Index pour la table `testing_report`
--
ALTER TABLE `testing_report`
  ADD PRIMARY KEY (`id_report`);

--
-- Index pour la table `uncharging_repport`
--
ALTER TABLE `uncharging_repport`
  ADD PRIMARY KEY (`id_report_uncharging`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `charging_report`
--
ALTER TABLE `charging_report`
  MODIFY `id_report` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `component`
--
ALTER TABLE `component`
  MODIFY `id_component` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT pour la table `component_verification`
--
ALTER TABLE `component_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `retour`
--
ALTER TABLE `retour`
  MODIFY `id_report` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `testing_report`
--
ALTER TABLE `testing_report`
  MODIFY `id_report` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT pour la table `uncharging_repport`
--
ALTER TABLE `uncharging_repport`
  MODIFY `id_report_uncharging` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
