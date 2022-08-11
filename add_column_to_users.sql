--
-- ALTER table `users`
--

ALTER table `users`
ADD `username` varchar(255) AFTER `name`,
ADD `role` varchar(255) AFTER `password`;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `username`, `email`, `password`, `role`) VALUES 
('admin', 'admin1', 'admin@admin.com', '$2a$12$pXIYa9Ld/AFl65QNAmWV/uSVj2C5WzyKVhrBwSqXOhIlsHfoMq3W6', '0'),
('teknisi1', 'teknisi1', 'teknisi@gmail.com', '$2a$12$pXIYa9Ld/AFl65QNAmWV/uSVj2C5WzyKVhrBwSqXOhIlsHfoMq3W6', '1');

--
--
--