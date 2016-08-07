CREATE TABLE `Setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `Setting` (`id`, `name`, `value`)
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

