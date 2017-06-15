-- phpMyAdmin SQL Dump
-- version 4.3.12
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 15 Juin 2017 à 14:43
-- Version du serveur :  5.6.35-1~dotdeb+7.1
-- Version de PHP :  5.6.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `wq8z6t_tevi`
--

-- --------------------------------------------------------

--
-- Structure de la table `Branche`
--

CREATE TABLE IF NOT EXISTS `Branche` (
  `IdBr` varchar(4) NOT NULL,
  `desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Branche`
--

INSERT INTO `Branche` (`IdBr`, `desc`) VALUES
('A2I', 'Automatique et informatique industrielle'),
('GI', 'Génie industriels'),
('GM', 'Génie mécanique'),
('ISI', 'Informatique et système d''information'),
('MM', 'Matériaux et mécanique'),
('MTE', 'Matériaux : technologie et économie '),
('RT', 'Réseau et télécommunication');

-- --------------------------------------------------------

--
-- Structure de la table `Br_Ue`
--

CREATE TABLE IF NOT EXISTS `Br_Ue` (
  `Id_Br` varchar(4) NOT NULL,
  `Id_Ue` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Categorie_UE`
--

CREATE TABLE IF NOT EXISTS `Categorie_UE` (
  `IdCat` varchar(4) NOT NULL,
  `desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Categorie_UE`
--

INSERT INTO `Categorie_UE` (`IdCat`, `desc`) VALUES
('CS', 'connaissance scientifique'),
('EC', 'expression et communication'),
('HT', 'humanité et technologies'),
('ME', 'management de l''entreprise'),
('NPML', 'Bulats anglais'),
('SE', ''),
('ST', 'Stage'),
('TM', 'technologie et méthodes');

-- --------------------------------------------------------

--
-- Structure de la table `Cursus`
--

CREATE TABLE IF NOT EXISTS `Cursus` (
  `IdCusus` varchar(4) NOT NULL,
  `desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Cursus`
--

INSERT INTO `Cursus` (`IdCusus`, `desc`) VALUES
('FCBR', 'fin de cursus de branche'),
('TC', 'tronc commun'),
('TCBR', 'tronc commun de branche'),
('UTT', 'utt');

-- --------------------------------------------------------

--
-- Structure de la table `ElemForm`
--

CREATE TABLE IF NOT EXISTS `ElemForm` (
  `IdEleve` int(7) NOT NULL,
  `sem_seq` int(2) NOT NULL,
  `sem_label` varchar(6) NOT NULL,
  `sigle` varchar(4) NOT NULL,
  `utt` varchar(1) NOT NULL,
  `profil` varchar(1) NOT NULL,
  `creditobt` int(2) NOT NULL,
  `resultat` varchar(1) NOT NULL,
  `IdParcours` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Etudiant`
--

CREATE TABLE IF NOT EXISTS `Etudiant` (
  `IdEtu` int(7) NOT NULL,
  `nom` varchar(80) NOT NULL,
  `prenom` varchar(80) NOT NULL,
  `admission` varchar(2) NOT NULL,
  `filiere` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Filiere`
--

CREATE TABLE IF NOT EXISTS `Filiere` (
  `IdFil` varchar(6) NOT NULL,
  `desc` text NOT NULL,
  `br` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Filiere`
--

INSERT INTO `Filiere` (`IdFil`, `desc`, `br`) VALUES
('?a2i', 'Tronc commun de branche A2I', 'A2I'),
('?gi', 'Tronc commun de branche GI', 'GI'),
('?gm', 'Tronc commun de branche GM', 'GM'),
('?isi', 'Tronc commun de branche ISI', 'ISI'),
('?mm', 'Tronc commun de branche MM', 'MM'),
('?mte', 'Tronc commun de branche MTE', 'MTE'),
('?rt', 'Tronc commun de branche RT', 'RT'),
('CeISME', 'Conception et Industrialisation des Systèmes Mécaniques, en lien avec l''Environnement ', 'GM'),
('CSR', 'Convergence Services et Réseaux', 'RT'),
('EME ', 'Economie des Matériaux et Environnement', 'MTE'),
('LET', 'Logistique Externe et Transport ', 'GI'),
('LIP', 'Logistique Interne et Production', 'GI'),
('MPL', 'Management de Projets Logiciels', 'ISI'),
('MRI', 'Management du Risque Informationnel', 'ISI'),
('MSI', 'Management des Systèmes d''Information', 'ISI'),
('SFeRE', 'Sûreté de Fonctionnement, Risques, Environnement', 'GI'),
('SNM', 'Simulation Numérique en Mécanique', 'GM'),
('SPI', 'Systèmes de production intelligents', 'A2I'),
('SSC', 'Sécurité des Systèmes et des Communications', 'RT'),
('TCMC', 'Technologie et Commerce des Matériaux et des Composants', 'MTE'),
('TEI', 'Technologie Embarquée et Interopérabilité ', 'A2I'),
('TIM', 'Technologie de l''Information pour la Méchanique', 'GM'),
('TMSE', 'Technologies Mobiles et Systèmes Embarqués', 'RT'),
('TQM', 'Transformation et Qualité des Matériaux', 'MTE');

-- --------------------------------------------------------

--
-- Structure de la table `Ue`
--

CREATE TABLE IF NOT EXISTS `Ue` (
  `IdUe` varchar(6) NOT NULL,
  `desc` text NOT NULL,
  `credit` int(2) NOT NULL,
  `affectation` varchar(6) NOT NULL,
  `cat` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Ue`
--

INSERT INTO `Ue` (`IdUe`, `desc`, `credit`, `affectation`, `cat`) VALUES
('LO07', '', 6, 'TCBR', 'TM'),
('PHYS04', '', 6, 'TC', 'CS');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Branche`
--
ALTER TABLE `Branche`
  ADD PRIMARY KEY (`IdBr`);

--
-- Index pour la table `Br_Ue`
--
ALTER TABLE `Br_Ue`
  ADD PRIMARY KEY (`Id_Br`,`Id_Ue`), ADD KEY `fk_ue` (`Id_Ue`);

--
-- Index pour la table `Categorie_UE`
--
ALTER TABLE `Categorie_UE`
  ADD PRIMARY KEY (`IdCat`);

--
-- Index pour la table `Cursus`
--
ALTER TABLE `Cursus`
  ADD PRIMARY KEY (`IdCusus`);

--
-- Index pour la table `ElemForm`
--
ALTER TABLE `ElemForm`
  ADD PRIMARY KEY (`IdEleve`,`sem_seq`,`sigle`), ADD UNIQUE KEY `IdParcours` (`IdParcours`), ADD KEY `fk_sigle` (`sigle`);

--
-- Index pour la table `Etudiant`
--
ALTER TABLE `Etudiant`
  ADD PRIMARY KEY (`IdEtu`), ADD KEY `filiere` (`filiere`);

--
-- Index pour la table `Filiere`
--
ALTER TABLE `Filiere`
  ADD PRIMARY KEY (`IdFil`), ADD KEY `br` (`br`);

--
-- Index pour la table `Ue`
--
ALTER TABLE `Ue`
  ADD PRIMARY KEY (`IdUe`), ADD KEY `cat` (`cat`), ADD KEY `IdUe` (`IdUe`,`affectation`,`cat`), ADD KEY `fk_aff` (`affectation`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Br_Ue`
--
ALTER TABLE `Br_Ue`
ADD CONSTRAINT `fk2_br` FOREIGN KEY (`Id_Br`) REFERENCES `Branche` (`IdBr`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_ue` FOREIGN KEY (`Id_Ue`) REFERENCES `Ue` (`IdUe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ElemForm`
--
ALTER TABLE `ElemForm`
ADD CONSTRAINT `fk_etu` FOREIGN KEY (`IdEleve`) REFERENCES `Etudiant` (`IdEtu`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_sigle` FOREIGN KEY (`sigle`) REFERENCES `Ue` (`IdUe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Etudiant`
--
ALTER TABLE `Etudiant`
ADD CONSTRAINT `fk_fil` FOREIGN KEY (`filiere`) REFERENCES `Filiere` (`IdFil`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Filiere`
--
ALTER TABLE `Filiere`
ADD CONSTRAINT `fk_br` FOREIGN KEY (`br`) REFERENCES `Branche` (`IdBr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Ue`
--
ALTER TABLE `Ue`
ADD CONSTRAINT `fk_aff` FOREIGN KEY (`affectation`) REFERENCES `Cursus` (`IdCusus`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_cat` FOREIGN KEY (`cat`) REFERENCES `Categorie_UE` (`IdCat`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
