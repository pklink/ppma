CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `settings` (`id`, `name`, `value`)
VALUES
  (1, 'force_ssl', '0'),
  (2, 'recent_entries_widget_count', '10'),
  (3, 'recent_entries_widget_enabled', '1'),
  (4, 'recent_entries_widget_position', '2'),
  (5, 'most_viewed_entries_widget_count', '10'),
  (6, 'most_viewed_entries_widget_enabled', '1'),
  (7, 'most_viewed_entries_widget_position', '1'),
  (8, 'tag_cloud_widget_position', '0'),
  (9, 'pagination_page_size_entries', '10'),
  (10, 'pagination_page_size_tags', '10');

CREATE TABLE `entries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` text,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `entries` (`id`, `name`, `username`, `password`)
VALUES
  (1, 'github.com', 'pklink', '123456');

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `username`, `password`)
VALUES
  (1, 'pierre', '$2y$10$DmDAfMQvhPJdxZu6xOOWgegz1WMtbJkJLZZ/vI36gqdzQU4zkmyja');

