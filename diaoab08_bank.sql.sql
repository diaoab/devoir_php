-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 19 mai 2024 à 21:56
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `form`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `solde` decimal(10,2) NOT NULL,
  `numero_compte` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `prenom`, `nom`, `adresse`, `telephone`, `solde`, `numero_compte`) VALUES
(4, 'saly', 'diouf', 'mermoz', '06321212', 9500000.00, '00014748129918313253'),
(5, 'ahmed', 'ndiaye', 'pikine', '780986454', 10000.00, '00269196567423193222'),
(8, 'ali', 'sow', 'almadies', '705436754', 35000.00, '00786161327076524909'),
(9, 'abou', 'diao', 'ngor', '711235576', 725200.00, '99734582836377173870'),
(10, 'jo', 'ly', 'thies', '707986758', 0.00, '07952767766720371920'),
(11, 'ami', 'seck', 'liberte 6', '712340965', 0.00, '97232097132493514574'),
(12, 'jean', 'cisse', 'ouakam', '776547890', 95000.00, '33216004050920103257'),
(15, 'momo', 'ndiang', 'scat urbam', '709876785', 1029410.00, '863706691890'),
(16, 'lamine', 'ndiaye', 'ngor', '779865363', 100000.00, '349690348341'),
(17, 'saly', 'ndour', 'tamba', '709873525', 190500.00, '311863553256'),
(19, 'saly', 'ndour', 'tamba', '709873525', 190500.00, '107414799006'),
(20, 'ami', 'ndoye', 'sicap', '787654523', 235000.00, '845409687771'),
(23, 'saly', 'ndour', 'tamba', '709873525', 190500.00, '500251381907'),
(24, 'haby ', 'sall', 'SACRE COEUR', '764563892', 20000.00, '798717337199'),
(25, 'saly', 'ndour', 'tamba', '709873525', 190500.00, '280205937961');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_compte` (`numero_compte`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
