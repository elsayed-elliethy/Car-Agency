-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: 05 يونيو 2020 الساعة 18:50
-- إصدار الخادم: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- بنية الجدول `categories`
--

CREATE TABLE `categories` (
  `Allow_Ads` int(11) NOT NULL DEFAULT 0,
  `Allow_Comment` int(11) NOT NULL DEFAULT 0,
  `Description` varchar(255) NOT NULL,
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Ordering` int(11) NOT NULL DEFAULT 0,
  `Visibility` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `categories`
--

INSERT INTO `categories` (`Allow_Ads`, `Allow_Comment`, `Description`, `ID`, `Name`, `Ordering`, `Visibility`) VALUES
(0, 0, 'new car for sale', 1, 'NewCar', 1, 0),
(0, 0, 'usedcar for sale', 2, 'UsedCar', 2, 0),
(0, 0, 'Cars For Rent', 3, 'ForRent', 3, 0);

-- --------------------------------------------------------

--
-- بنية الجدول `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` int(11) NOT NULL,
  `comment_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `comments`
--

INSERT INTO `comments` (`c_id`, `comment`, `status`, `comment_date`, `item_id`, `user_id`) VALUES
(28, 'my favourite car', 1, '2020-06-05', 53, 9),
(29, 'my favourite car', 1, '2020-06-05', 53, 9),
(30, '000', 1, '2020-06-05', 53, 9),
(31, '000', 1, '2020-06-05', 53, 9),
(32, '000', 1, '2020-06-05', 53, 9),
(33, '000', 1, '2020-06-05', 53, 9),
(34, '000', 1, '2020-06-05', 53, 9);

-- --------------------------------------------------------

--
-- بنية الجدول `items`
--

CREATE TABLE `items` (
  `Add_Data` date NOT NULL,
  `Approve` int(11) NOT NULL DEFAULT 0,
  `avater` varchar(255) NOT NULL,
  `Cat_ID` int(11) NOT NULL,
  `Country_Made` varchar(255) DEFAULT NULL,
  `Description` varchar(255) NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Rating` int(11) NOT NULL DEFAULT 0,
  `Status` int(11) NOT NULL DEFAULT 0,
  `Brand` varchar(255) DEFAULT NULL,
  `Color` varchar(255) NOT NULL,
  `First registration` varchar(255) NOT NULL,
  `Fuel` varchar(255) NOT NULL,
  `Gearbox` varchar(255) NOT NULL,
  `avater1` varchar(255) NOT NULL,
  `avater2` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `items`
--

INSERT INTO `items` (`Add_Data`, `Approve`, `avater`, `Cat_ID`, `Country_Made`, `Description`, `Item_ID`, `Member_ID`, `Name`, `Price`, `Rating`, `Status`, `Brand`, `Color`, `First registration`, `Fuel`, `Gearbox`, `avater1`, `avater2`, `tags`, `img`) VALUES
('2020-05-07', 1, '', 1, 'Japan', 'Accord Crosstour EX-L', 29, 7, 'Honda', '104000', 0, 3, 'honda', 'white', '2015', 'gas', 'automatic', '', '', 'Honda,GURANTEE', '910791honda1..jpg.jpg,946363honda1...jpg.jpg,594980honda1....jpg.jpg'),
('2020-05-07', 1, '', 2, 'Jaban', 'Accord Crosstour EX-L', 30, 7, 'Honda', '10440', 0, 3, 'honda', 'silver', '2015', 'gas', 'automatic', '', '', 'Honda,GURANTEE', '390385honda.jpg.jpg,519151honda..jpg.jpg,186300honda...jpg.jpg'),
('2020-05-07', 1, '', 1, 'Germany', ' X2 sDrive28i', 31, 7, 'BMW', '41', 0, 1, 'bmw', 'black', '2018', 'diesel', 'automatic', '', '', 'BMW,SPECIALOFFERS,GURANTEE', '956608pmw.jpg.jpg,277390pmw...jpg.jpg,275725pmw..jpg.jpg'),
('2020-05-07', 1, '', 1, 'Germany', 'M2 Competition', 32, 7, 'BMW', '73', 0, 1, 'bmw', 'blue', '2020', 'gas', 'automatic', '', '', 'BMW,SPECIALOFFERS,GURANTEE', '129004pmw2...jpg.jpg,867379pmw2.jpg.jpg,243876pmw2..jpg.jpg'),
('2020-05-07', 1, '', 2, 'Germany', ' 230 i xDrive', 33, 7, 'BMW', '52', 0, 3, 'bmw', 'white', '2019', 'diesel', 'automatic', '', '', 'BMW,SPECIALOFFERS,GURANTEE', '906803pmw3.jpg.jpg,144307pmw3..jpg.jpg,162614pmw3...jpg.jpg'),
('2020-05-07', 1, '', 3, 'Germany', '- X2 sDrive28i', 34, 7, 'BMW', '1000', 0, 1, 'bmw', 'silver', '2020', 'diesel', 'automatic', '', '', 'BMW,SPECIALOFFERS,GURANTEE', '870882pmw4.jpg.jpg,880989pmw4..jpg.jpg,230622pmw4...jpg.jpg'),
('2020-05-07', 1, '', 2, 'Italia', '- Stelvio Base', 35, 7, 'Alfa Romeo', '42', 0, 3, 'alfa-romeo', 'red', '2019', 'diesel', 'automatic', '', '', 'AlfaRomeo,SPECIALOFFERS,GURANTEE', '151631alfa...jpg.jpg,252104alfa..jpg.jpg,671495alfa.jpg.jpg'),
('2020-05-07', 1, '', 3, 'italia', 'Stelvio Ti Sport ', 36, 7, 'Alfa Romeo', '492', 0, 3, 'alfa-romeo', 'silver', '2019', 'gas', 'automatic', '', '', 'AlfaRomeo,SPECIALOFFERS,GURANTEE', '175005alfa1..jpg.jpg,332479alfa1.jpg.jpg,488015alfa1...jpg.jpg'),
('2020-05-07', 1, '', 2, 'America', ' - Suburban LT', 37, 7, 'Chevrolet', '33', 0, 3, 'chevrolet', 'white', '2019', 'diesel', 'automatic', '', '', 'Chevrolet,SPECIALOFFERS,GURANTEE', '81897chiverolet.jpg.jpg,908983chiverolet...jpg.jpg,742588chiverolet..jpg.jpg'),
('2020-05-07', 1, '', 3, 'Italia', '812 Superfast Base', 38, 7, 'Ferrari', '382', 0, 1, 'ferrari', 'gray', '2020', 'gas', 'automatic', '', '', 'Ferrari,SPECIALOFFERS,GURANTEE', '184190ferari1.jpg.jpg,610210ferari1..jpg.jpg,156726ferari1...jpg.jpg'),
('2020-05-07', 1, '', 1, 'Italia', '488 Spider Base', 39, 7, 'Ferrari', '28990', 0, 1, 'ferrari', 'red', '2018', 'gas', 'automatic', '', '', 'Ferrari,SPECIALOFFERS,GURANTEE', '760549ferari...jpg.jpg,49525ferari..jpg.jpg,885487ferari.jpg.jpg'),
('2020-05-07', 1, '', 2, 'Italia', '500X Easy', 40, 7, 'FIAT', '13000', 0, 1, 'fiat', 'white', '2016', 'gas', 'automatic', '', '', 'FIAT,GURANTEE', '6753fiat1..jpg.jpg,216757fiat1.jpg.jpg,522998fiat1...jpg.jpg'),
('2020-05-07', 1, '', 1, 'Italia', '-500 Pop', 41, 7, 'FIAT', '17', 0, 3, 'fiat', 'gray', '2019', 'gas', 'automatic', '', '', 'FIAT,GURANTEE', '548943fiat...jpg.jpg,2850fiat.jpg.jpg,973855fiat..jpg.jpg'),
('2020-05-07', 1, '', 3, 'America', '- Explorer XLT', 42, 7, 'Ford', '500/Day', 0, 3, 'ford', 'black', '2017', 'diesel', 'automatic', '', '', 'Ford,SPECIALOFFERS,GURANTEE', '513848ford.jpg.jpg,237214ford..jpg.jpg,96051ford...jpg.jpg'),
('2020-05-07', 1, '', 3, 'Korea', '-Accent SEL', 43, 7, 'Hyundai', '180/Day', 0, 1, 'hyundai', 'gray', '2020', 'gas', 'automatic', '', '', 'Hyundai,GURANTEE', '782584hundai1.jpg.jpg,995308hundai1..jpg.jpg,89905hundai1...jpg.jpg'),
('2020-05-07', 1, '', 1, 'Korea', '-Accent Limited', 44, 7, 'Hyundai', '16825', 0, 1, 'hyundai', 'silver', '2020', 'gas', 'automatic', '', '', 'Hyundai,GURANTEE', '950762hundai...jpg.jpg,486663hundai.jpg.jpg,217590hundai..jpg.jpg'),
('2020-05-07', 1, '', 3, 'America', '- Compass Latitude', 46, 7, 'Jeep', '193/Day', 0, 1, 'jeep', 'red', '2020', 'diesel', 'automatic', '', '', 'Jeep,SPECIALOFFERS,GURANTEE', '78596Jeep...jpg.jpg,601452Jeep.jpg.jpg,474198Jeep..jpg.jpg'),
('2020-05-07', 1, '', 3, 'Korea', '-Forte LXS', 47, 7, 'Kia', '157/Day', 0, 1, 'kia', 'blue', '2020', 'gas', 'automatic', '', '', 'Kia,GURANTEE', '376377kia1...jpg.jpg,137489kia1.jpg.jpg,618040kia1..jpg.jpg'),
('2020-05-07', 1, '', 1, 'Korea', '-Forte LXS', 48, 7, 'Kia', '15729', 0, 1, 'kia', 'red', '2020', 'gas', 'automatic', '', '', 'Kia,GURANTEE', '840546kia...jpg.jpg,213849kia.jpg.jpg,56936kia..jpg.jpg'),
('2020-05-07', 1, '', 2, 'Italia', 'Aventador LP700', 49, 7, 'Lamborghini', '289,867', 0, 3, 'lamborghini', 'black', '2015', 'diesel', 'automatic', '', '', 'Lamborghini,SPECIALOFFERS,GURANTEE', '236553lamporgine1...jpg.jpg,985674lamporgine1..jpg.jpg,426562lamporgine1.jpg.jpg'),
('2020-05-07', 1, '', 1, 'Italia', ' -Huracan EVO Base', 50, 7, 'Lamborghini', '270,897', 0, 1, 'lamborghini', 'white', '2020', 'gas', 'automatic', '', '', 'Lamborghini,SPECIALOFFERS,GURANTEE', '899691lamporgine.jpg.jpg,23221lamporgine...jpg.jpg,526566lamporgine..jpg.jpg'),
('2020-05-08', 1, '', 3, 'Britain', ' -Discovery SE', 51, 7, 'Land Rover', '359/Day', 0, 1, 'land rover', 'gray', '2019', 'diesel', 'automatic', '', '', 'LandRover,SPECIALOFFERS,GURANTEE', '537188land rover..jpg.jpg,56120land rover...jpg.jpg,929917land rover.jpg.jpg'),
('2020-05-08', 1, '', 2, 'Japan', ' - Eclipse GS', 52, 7, 'Mitsubishi', '8000', 0, 3, 'mitsubishi', 'black', '2015', 'diesel', 'automatic', '', '', 'Mitsubishi,SPECIALOFFERS,GURANTEE', '181608mistbitchi..jpg.jpg,816983mistbitchi.jpg.jpg,507415mistbitchi...jpg.jpg'),
('2020-05-08', 1, '', 2, 'Japan', '- Altima 2.5 SL', 53, 7, 'Nissan', '12888', 0, 3, 'nissan', 'silver', '2018', 'diesel', 'automatic', '', '', 'Nissan,SPECIALOFFERS,GURANTEE', '181727nissan.jpg.jpg,372570nissan...jpg.jpg,183537nissan..jpg.jpg');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `userID` int(11) NOT NULL,
  `TrustStatus` int(11) NOT NULL DEFAULT 0,
  `RegStatus` int(11) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `GroubID` int(11) NOT NULL DEFAULT 0,
  `Fullname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `avater` varchar(255) NOT NULL,
  `jop` varchar(255) NOT NULL DEFAULT 'user',
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`username`, `userID`, `TrustStatus`, `RegStatus`, `password`, `GroubID`, `Fullname`, `Email`, `Date`, `avater`, `jop`, `address`, `phone`) VALUES
('admin', 7, 1, 1, '8cb2237d0679ca88db6464eac60da96345513964', 0, 'admin ', 'admin1@yahoo.com', '2020-05-07', '17318377_89426532_1376675909183923_5702545460355399680_o.jpg', 'user', NULL, '01225933893'),
('Elsayed', 8, 1, 1, '8cb2237d0679ca88db6464eac60da96345513964', 1, 'Elsayed Elliethy', 'Elsayed@elsayed.com', '2020-05-08', '84247452_19620872_1122410071236944_5213020705574055850_o.jpg', 'Chief Executive Officer', NULL, NULL),
('islam', 9, 1, 1, '8cb2237d0679ca88db6464eac60da96345513964', 1, 'islam Nasf', 'islamnasf19@gmail.com', '2020-05-08', '18201786_89426532_1376675909183923_5702545460355399680_o.jpg', 'Chief Legal Officer', NULL, '01225933893'),
('eslam', 11, 0, 1, '8cb2237d0679ca88db6464eac60da96345513964', 0, 'islam nasef', 'islam@yahoo.com', '2020-05-25', '36646626_87818695_1367740510077463_5375996159082889216_o.jpg', 'user', NULL, '01225933893');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `items_comment` (`item_id`),
  ADD KEY `comment_user` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_comment` FOREIGN KEY (`item_id`) REFERENCES `items` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
