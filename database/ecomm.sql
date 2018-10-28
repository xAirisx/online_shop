SET SQL_MODE = "ONLY_FULL_GROUP_BY"; 

CREATE TABLE `users` ( 
`id` int PRIMARY KEY AUTO_INCREMENT, 
`email` varchar(200) NOT NULL, 
`password` varchar(60) NOT NULL, 
`type` int(1) NOT NULL DEFAULT '0', 
`firstname` varchar(50) NOT NULL, 
`lastname` varchar(50) NOT NULL, 
`address` text, 
`contact_info` varchar(100) DEFAULT NULL, 
`photo` varchar(200) NOT NULL DEFAULT 'profile.jpg', 
`status` int(1) NOT NULL DEFAULT '1', 
`created_on` date NOT NULL 
); 

CREATE TABLE `category` ( 
`id` int PRIMARY KEY AUTO_INCREMENT, 
`name` varchar(100) NOT NULL, 
`slug` varchar(150) DEFAULT NULL UNIQUE 
); 

CREATE TABLE `products` ( 
`id` int PRIMARY KEY AUTO_INCREMENT, 
`category_id` int NOT NULL, 
`name` text NOT NULL, 
`description` text, 
`slug` varchar(200) NOT NULL UNIQUE, 
`price` double NOT NULL, 
`photo` varchar(200) NOT NULL, 
`date_view` date DEFAULT NULL, 
`views_today` int NOT NULL DEFAULT '0' 
); 
ALTER TABLE `products` ADD FOREIGN KEY (`category_id`) REFERENCES `category` (`id`); 

CREATE TABLE `cart` ( 
`id` int PRIMARY KEY AUTO_INCREMENT, 
`user_id` int NOT NULL, 
`product_id` int NOT NULL, 
`quantity` int NOT NULL 
); 
ALTER TABLE `cart` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`); 
ALTER TABLE `cart` ADD FOREIGN KEY (`product_id`) REFERENCES `products` (`id`); 

CREATE TABLE `sales` ( 
`id` int PRIMARY KEY AUTO_INCREMENT, 
`user_id` int NOT NULL, 
`pay_id` varchar(50) NOT NULL, 
`sales_date` date NOT NULL 
); 
ALTER TABLE `sales` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`); 

CREATE TABLE `details` ( 
`id` int PRIMARY KEY AUTO_INCREMENT, 
`sales_id` int NOT NULL, 
`product_id` int NOT NULL, 
`quantity` int NOT NULL 
); 
ALTER TABLE `details` ADD FOREIGN KEY (`sales_id`) REFERENCES `sales` (`id`); 
ALTER TABLE `details` ADD FOREIGN KEY (`product_id`) REFERENCES `products` (`id`); 
ALTER TABLE `details` ADD CONSTRAINT `unique_details` UNIQUE (`sales_id`,`product_id`); 

INSERT INTO `category` (`id`, `name`, `slug`) VALUES 
(1, 'IT', 'it'), 
(2, 'Art', 'art'), 
(3, 'Law', 'law'), 
(4, 'Medicine', 'medicine'); 

INSERT INTO `users` (`id`, `email`, `password`, `type`, `firstname`, `lastname`, `address`, `contact_info`, `photo`, `status`, `created_on`) VALUES 
(1, 'admin@gmail.com', '$2y$10$OafPajbZTdbDWSjOHWzg/ebDRaqjeSLhRwGgInihq9LJRQ5Ogqmia', 1, 'Alex', 'McMaffin', '', '', 'admin.jpg', 1, '2018-09-01'), 
(2, 'valya@yandex.ru', '$2y$10$VwH9MZ2PqEczGkwo39P96OxPgFpQBoQoBzY8WruvB6xHKKZ7NZ4nG', 0, 'Valya', 'Endovitskaya', 'Russia, Voronezh', '+79192376093', 'valya.png', 1, '2018-09-09'), 
(3, 'andrew@gmail.com', '$2y$10$/7zmD8nPC9b/qQwW7R06tOJUbNFGPUqRD5rMpGm/4Z0FMx0oAQL62', 0, 'Andrew', 'Nadraliev', 'Russia, Voronezh', ' +79204041048', 'andrew.jpg', 1, '2018-09-09'); 

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `slug`, `price`, `photo`, `date_view`, `views_today`) VALUES 
(1, 1, 'PHP for Absolute Beginners', '<p>author: <strong>Jason Lengdtorf</strong></p><p>pages :&nbsp;<em>210</em></p><p>year<em>:2015</em></p><p>&nbsp;</p>', 'php-absolute-beginners', 899, 'PHP_For_Absolute_Beginners.jpg', '2018-10-21', 2), 
(2, 1, 'Beginning Ruby', '<p>author: <strong>Peter Cooper</strong></p><p>pages :&nbsp;<em>290</em></p><p>year<em>:2017</em></p><p>&nbsp;</p>', 'beginning-ruby', 799, 'ruby.jpg', '2018-10-21', 2), 
(3, 1, 'Practical Web 2.0 Applications with PHP', '<p>author: <strong>Quentin Zervaas</strong></p><p>pages :&nbsp;<em>356</em></p><p>year<em>:2018</em></p><p>&nbsp;</p>', 'practical-web-2-0-applications-php', 599, 'webphp.jpg', '2018-10-21', 2), 
(4, 1, 'Java Cookbook', '<p>author: <strong>Ian F/ Darwin</strong></p><p>pages :&nbsp;<em>340</em></p><p>year<em>:2016</em></p><p>&nbsp;</p>', 'java-cookbook', 399, 'java-cookbook.jpg', '2018-05-10', 3), 
(5, 1, 'The Complete Reference Java', '<p>author: <strong>Herbert Schildt</strong></p><p>pages :&nbsp;<em>590</em></p><p>year<em>:2018</em></p><p>&nbsp;</p>', 'complete-reference-java', 999, 'java_complete.jpg', '2018-07-09', 3), 
(6, 2, 'Book for the Art Center', '<p>author: <strong>Karen Bertumond</strong></p><p>pages :&nbsp;<em>190</em></p><p>year<em>:2014</em></p><p>&nbsp;</p>', 'book-art-center', 449.99, 'art_center.jpg', '2018-10-10', 0), 
(7, 2, 'Tell Me A Picture', '<p>author: <strong>Qunentin Blake</strong></p><p>pages :&nbsp;<em>390</em></p><p>year<em>:2014</em></p><p>&nbsp;</p>', 'tell-me-picture', 619, 'tell-me-picture.jpg', '2018-10-10', 0), 
(8, 3, 'A Book About Lawyers', '<p>author: <strong>Jeafferson John Cordy</strong></p><p>pages :&nbsp;<em>490</em></p><p>year<em>:2018</em></p><p>&nbsp;</p>', 'book-about-lawyers', 549.99, 'lawers.jpg', '2018-10-10', 0), 
(9, 4, 'Handbook of Transfusion Medicine', '<p>author: <strong>Dr. Derek Norfolk</strong></p><p>pages :&nbsp;<em>990</em></p><p>year<em>:2016</em></p><p>&nbsp;</p>', 'handbook-of-transfusion-medicine', 599.99, 'transfusion_medicine.jpeg', '2018-10-10', 0); 

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES 
(1, 2, 1,1), 
(2, 2, 2,2), 
(3, 2, 4,1), 
(4, 3, 4,3), 
(5, 3, 6,1); 

INSERT INTO `sales` (`id`, `user_id`, `pay_id`, `sales_date`) VALUES 
(1, 2, '1540732415816', '2018-10-10'), 
(2, 3, '1540732415815', '2018-10-9'); 

INSERT INTO `details` (`id`, `sales_id`, `product_id`, `quantity`) VALUES 
(1, 1, 1,1), 
(2, 1, 2,1), 
(3, 1, 7,2), 
(4, 2, 7,2), 
(5, 2, 9,1), 
(6, 2, 3,2);