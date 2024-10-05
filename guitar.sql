CREATE DATABASE `guitars`;

USE `guitars`;

-- Store tábla
DROP TABLE IF EXISTS `store`;

CREATE TABLE `store` (
  `storeno` VARCHAR(10) PRIMARY KEY NOT NULL,
  `location` VARCHAR(50) NOT NULL
);

-- Guitars tábla
DROP TABLE IF EXISTS `guitar`;

CREATE TABLE `guitar` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `type` VARCHAR(100) NOT NULL,
  `body` VARCHAR(100) NOT NULL,
  `neckProfile` VARCHAR(100) NOT NULL,
  `fretsSize` VARCHAR(100) NOT NULL,
  `fretCount` VARCHAR(30) NOT NULL,
  `bridgePU` VARCHAR(100) NOT NULL,
  `neckPU` VARCHAR(100),
  `price` DECIMAL(10, 2) NOT NULL,
  `image_url` VARCHAR(255),
  `storeno` VARCHAR(10),
  FOREIGN KEY (`storeno`) REFERENCES `store`(`storeno`)
);

INSERT INTO `store` (`storeno`, `location`) 
VALUES 
('S010', 'TEXAS'),
('S020', 'NEW YORK');

INSERT INTO `guitar` 
(`name`, `type`, `body`, `neckProfile`, `fretsSize`, `fretCount`, `bridgePU`, `neckPU`, `price`, `image_url`, `storeno`) 
VALUES 
('Les Paul Junior Double Cut', 'Electric', 'Mahogany', '50s Vintage', 'Medium Jumbo', '22', 'Dogear P-90', NULL, 1699.00, 'http://localhost/SzakkepesitoVizsga/images/junior.png', 'S010'),
('Les Paul Standard 60s Plain Top', 'Electric', 'Mahogany', 'SlimTaper', 'Medium Jumbo', '22', '60s Burstbucker', '60s Burstbucker', 2599.00, 'http://localhost/SzakkepesitoVizsga/images/lespaul.png', 'S010'),
('1962 Les Paul SG Standard', 'Electric', 'Solid Mahogany', '60s SlimTaper', 'Authentic Medium-Jumbo', '22', 'Custombucker (Unpotted)', 'Custombucker (Unpotted)', 6199.00, 'http://localhost/SzakkepesitoVizsga/images/sg.png', 'S010'),
('70s Flying V Standard', 'Electric', 'Mahogany', 'SlimTaper', 'Medium Jumbo', '22', '70s Tribute', '70s Tribute', 2499.00, 'http://localhost/SzakkepesitoVizsga/images/flyingv.png', 'S010'),
('ES-345 Standard Walnut', 'Electric', '3-ply Maple/Poplar/Maple', 'Rounded "C"', 'Medium Jumbo', '22', 'Calibrated T-Type, Lead', 'Calibrated T-Type, Rhythm', 3899.00, 'http://localhost/SzakkepesitoVizsga/images/es345.png', 'S010'),
('ES Supreme Exclusive', 'Electric', '3-ply Maple/Poplar/Maple', 'Rounded "C"', 'Medium Jumbo', '22', 'Burstbucker Mid Pro', 'Burstbucker Rhythm Pro', 4299.00, 'http://localhost/SzakkepesitoVizsga/images/essupremee.png', 'S010'),
('ES Supreme Exclusive 2', 'Electric', '3-ply AAA Maple/Poplar/Maple', 'Rounded "C"', 'Medium Jumbo', '22', 'Burstbucker Lead Pro', 'Burstbucker Rhythm Pro', 4299.00, 'http://localhost/SzakkepesitoVizsga/images/essupremebb.png', 'S010'),
('Les Paul Modern Koa', 'Electric', '3-ply Maple/Poplar/Maple', 'SlimTaper with Modern Contoured Heel', 'Medium Jumbo', '22', 'Burstbucker Pro +', 'Burstbucker Pro', 3799.00, 'http://localhost/SzakkepesitoVizsga/images/lespaulmodern.png', 'S010'),
('Jeff Beck “YardBurst” 1959 Les Paul Standard', 'Electric', '1-piece Lightweight Mahogany', '50s Rounded Medium C', 'Authentic Medium-Jumbo', '22', 'Custombucker, Double Classic White Bobbins (Unpotted)', 'Custombucker, Double Classic White Bobbins (Unpotted)', 9999.00, 'http://localhost/SzakkepesitoVizsga/images/jeff.png', 'S020'),
('Charlie Starr Les Paul Junior 1959 Standard', 'Electric', 'Mahogany', 'Artist Spec 50s', 'Medium Jumbo', '22', 'Overwound Dogear P-90', NULL, 1999.00, 'http://localhost/SzakkepesitoVizsga/images/charlie.png', 'S020'),
('Jason Isbell Red Eye 1959 Les Paul Standard', 'Electric', 'One Piece Lightweight Mahogany', 'Red Eye Profile', 'Authentic Medium-Jumbo', '22', 'Custombucker, Alnico 2, Double Classic White Bobbins (Unpotted)', 'Custombucker, Alnico 2, Zebra Bobbins (Unpotted)', 21999.00, 'http://localhost/SzakkepesitoVizsga/images/jason.png', 'S020'),
('1959 Les Paul Standard 2-Piece 5A Quilt Maple', 'Electric', '2-Piece 5A Quilt Maple Lightweight', '50s Rounded Medium C', 'Historic Medium Jumbo', '22', 'Custombucker Alnico 3 (Unpotted)', 'Custombucker Alnico 3 (Unpotted)', 8999.00, 'http://localhost/SzakkepesitoVizsga/images/19592p.png', 'S020'),
('1959 Les Paul Standard 2-Piece 5A Quilt Maple', 'Electric', '2-Piece 5A Quilt Maple', '50s Rounded Medium C', 'Historic Medium Jumbo', '22', 'Custombucker Alnico 3 (Unpotted)', 'Custombucker Alnico 3 (Unpotted)', 8999.00, 'http://localhost/SzakkepesitoVizsga/images/19592p5a.png', 'S020'),
('Les Paul Custom 1-Piece 5A Quilt Maple Top', 'Electric', '1-Piece Mahogany', '50s Rounded Medium C', 'Authentic Medium Jumbo', '22', '498T Humbucker', '490R Humbucker', 10199.00, 'http://localhost/SzakkepesitoVizsga/images/custom1porange.png', 'S020'),
('Les Paul Custom 1-Piece AAA Quilt Maple Top', 'Electric', '1-Piece Mahogany', '50s Rounded Medium C', 'Authentic Medium-Jumbo', '22', '498T Humbucker', '490R Humbucker', 9299.00, 'http://localhost/SzakkepesitoVizsga/images/custom1ppeacan.png', 'S020'),
('Les Paul Custom Quilt Sapele Murphy Lab', 'Electric', 'Mahogany', '50s Rounded Medium C', 'Authentic Medium Jumbo', '22', '498T Humbucker', '490R Humbucker', 8099.00, 'http://localhost/SzakkepesitoVizsga/images/custommurphy.png', 'S020');


SELECT * FROM `guitar`;