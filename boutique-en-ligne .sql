-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 10 mai 2022 à 05:23
-- Version du serveur : 5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique-en-ligne`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `image`) VALUES
(25, 'Sandwichs', '../assets/upload/62791784802f9.jpg'),
(26, 'Snacks', '../assets/upload/6279178e7147e.jpg'),
(27, 'Boissons', '../assets/upload/6279179cea04f.jpg'),
(28, 'Salades', '../assets/upload/627917cde66c3.jpg'),
(29, 'Dessert', '../assets/upload/627917dea6264.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `id_utilisateur` int(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

CREATE TABLE `droits` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id`, `nom`) VALUES
(1, 'utilisateurs'),
(1337, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `livraisons`
--

CREATE TABLE `livraisons` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `livraisons`
--

INSERT INTO `livraisons` (`id`, `nom`, `prenom`, `adresse`, `code_postal`, `ville`, `telephone`, `id_utilisateur`) VALUES
(1, 'bouasria', 'Ismail', '9 bis chemin de Paradis', 668931547, '13500', 'Martigues', 2);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  `stock` int(11) NOT NULL,
  `id_sous_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `image`, `nom`, `description`, `prix`, `stock`, `id_sous_categorie`) VALUES
(6, '../assets/upload/6279288e022da.jpg', 'Crousti Poulet', 'Bread au poulet croustillant et sa sauce mayonnaise maison ', 6, 4, 19),
(7, '../assets/upload/62792aaa61580.jpg', 'Poulet Legumes', 'Poulet braisé et légumes de saison ', 7, 3, 19),
(8, '../assets/upload/62792c025d70a.jpg', 'Burgers steack &amp; Bacon', 'Burger à base de boeuf et tranches de bacons à la sauce moutarde', 8, 10, 20),
(9, '../assets/upload/62792ce600952.jpg', 'Burger &amp; frites pepper', 'Burgers à la viande de boeuf accompagné de frites ', 10, 6, 20),
(10, '../assets/upload/62792d9330513.jpg', 'Double Cheese', 'Double cheese bacon accompagné de frites rustiques', 11, 9, 20),
(11, '../assets/upload/62792e6480ce4.jpg', 'Triangle &amp; Fries', 'Pain de mie toaster à la viande hachée et crudités, accompagné de frites', 6, 6, 21),
(12, '../assets/upload/62793007e0ee3.jpg', 'Wrap Poulet &amp; Crudité', 'Wrap au Poulet &amp; Crudité', 5, 7, 22),
(13, '../assets/upload/627930fd14a7c.jpg', 'Patates douces', 'Frites à la patates douces', 3, 15, 23),
(14, '../assets/upload/627933273137e.jpg', 'Potatoes', 'Potatoes maison et sauce tomate basilique', 2, 7, 23),
(15, '../assets/upload/627934d17b627.jpg', 'Nuggets ', 'Croquettes de poulet maison x 4', 3, 10, 24),
(16, '../assets/upload/62793751ac3b1.jpg', 'Oignons rings', 'Oignons rings Maison x 6', 2, 12, 25),
(17, '../assets/upload/62793893061ed.jpg', 'Coca Cola', 'Canette de 33cl', 1.5, 30, 26),
(18, '../assets/upload/6279392178354.jpg', 'Jus d\'Orange', 'Jus d\'Orange pressé', 2.5, 10, 26),
(19, '../assets/upload/62793a72560ca.jpg', 'Café', 'Café moulu 10cl', 1.5, 20, 27),
(20, '../assets/upload/62793b06abb4e.jpg', 'Thé', 'Thé à la menthe', 1.5, 20, 27),
(21, '../assets/upload/62793c40a107c.jpg', 'Salade Cesar', 'Salade  Cesar à base de poulet crouton et parmesan', 8, 12, 28),
(22, '../assets/upload/62793d06ae088.jpg', 'Salade légumineuse', 'Salade à base de lentille pois chiche', 7, 10, 29),
(23, '../assets/upload/62793dd5bb5c8.jpg', 'Vanille &amp; fraise', '2 boules de glaces vanille &amp; fraise ', 4, 10, 30),
(24, '../assets/upload/62793f22d3dc7.jpg', 'Cheese Cake', 'Cheese Cake avec coulis au caramel', 5, 12, 31);

-- --------------------------------------------------------

--
-- Structure de la table `sous_categorie`
--

CREATE TABLE `sous_categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `id_categorie` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sous_categorie`
--

INSERT INTO `sous_categorie` (`id`, `nom`, `id_categorie`) VALUES
(19, 'Breads', 25),
(20, 'Burgers', 25),
(21, 'Triangles', 25),
(22, 'Wraps', 25),
(23, 'Frites', 26),
(24, 'Nuggets', 26),
(25, 'oignons rings', 26),
(26, 'Boissons Froides', 27),
(27, 'Boissons Chaudes', 27),
(28, 'Salades ', 28),
(29, 'Salades Veggies', 28),
(30, 'Glaces', 29),
(31, 'Pâtisseries', 29);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_droit` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `email`, `password`, `id_droit`) VALUES
(1, 'admin', 'admin@g.fr', '$2y$10$31ktMQhDWmlULOKv7fFIZOA.2LKL.KsCVY.joc1jc7bsK4lqZDiga', 1337),
(2, 'ismail', 'b@g.fr', '$2y$10$H9w2WoebsgJ1AN.JQbtlNu.aeinIKPLmihwPxCRVE6h/9p85jOByO', 1),
(3, 'a', 'a@gm.com', '$2y$10$wNuiPVHWEuYMkoIo3lXBC.J7fWAdTSg9Qd0dh7cWJkCgWQixviClu', 1),
(4, 'sosoz', 'p@g.fr', '$2y$10$g.9yVRYWpz3PtAdwgb9cq.RqQynQqbcbIQGgRwgCNbSyrKqMDsNue', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `droits`
--
ALTER TABLE `droits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livraisons`
--
ALTER TABLE `livraisons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_commande` (`id_sous_categorie`),
  ADD KEY `id_sous_categorie` (`id_sous_categorie`),
  ADD KEY `id_sous_categorie_2` (`id_sous_categorie`);

--
-- Index pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_droit` (`id_droit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `droits`
--
ALTER TABLE `droits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `livraisons`
--
ALTER TABLE `livraisons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  ADD CONSTRAINT `sous_categorie_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`id_droit`) REFERENCES `droits` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
