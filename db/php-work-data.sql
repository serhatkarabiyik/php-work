-- Base de données : `php-work`

-- --------------------------------------------------------
-- Données de la table User

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Toto', 'TOTO', 'toto@work.com', 'toto');

-- --------------------------------------------------------
-- Données de la table Url

INSERT INTO `url` (`url_id`, `user_id`, `url`, `cut_url`, `isActive`, `click`) VALUES
(1, 1, 'https://www.google.com/webhp?hl=fr&sa=X&ved=0ahUKEwiX3pHhnJP-AhW6SaQEHQjUBCAQPAgI', 'google.com', 1, 0);