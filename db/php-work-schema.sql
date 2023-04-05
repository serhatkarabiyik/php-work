-- Base de données : `php-work`

-- --------------------------------------------------------
-- Structure de la table `user`

CREATE TABLE `user` (
  `user_id` smallint(5) NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(180) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 NOT NULL
);

-- --------------------------------------------------------
-- Index pour la table `user`

ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

-- --------------------------------------------------------
-- AUTO_INCREMENT pour la table `user`

ALTER TABLE `user`
  MODIFY `user_id` smallint(5) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------
-- Structure de la table `url`

CREATE TABLE `url` (
  `url_id` smallint(5) NOT NULL,
  `user_id` smallint(5) NOT NULL,
  `url` varchar(400) CHARACTER SET utf8mb4 NOT NULL,
  `cut_url` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `click` smallint(5) NOT NULL
);

-- --------------------------------------------------------
-- Index pour la table `url`

ALTER TABLE `url`
  ADD PRIMARY KEY (`url_id`),
  ADD KEY `fk_user_id` (`user_id`);

-- --------------------------------------------------------
-- AUTO_INCREMENT pour la table `url`

ALTER TABLE `url`
  MODIFY `url_id` smallint(5) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------
-- Contraintes pour la table `url`

ALTER TABLE `url`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

