-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 05:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `property_npl`
--

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `google_map` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `property_type` varchar(255) NOT NULL,
  `land_area` varchar(255) NOT NULL,
  `building_area` varchar(255) NOT NULL,
  `floors` int(11) NOT NULL,
  `bedrooms` int(11) NOT NULL,
  `living_rooms` int(11) NOT NULL,
  `bathrooms` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `title`, `address`, `google_map`, `location`, `property_type`, `land_area`, `building_area`, `floors`, `bedrooms`, `living_rooms`, `bathrooms`, `price`, `image`, `hidden`) VALUES
(1, 'A unit of house and car garage.', 'Phum 3, Sangkat 3, Sihanoukville, Preah Sihanouk province.', 'https://www.google.com/maps/@10.6264712,103.5138249,3a,75y,105.31h,106.73t/data=!3m6!1e1!3m4!1suNC-C2hkg5Z1GvBpl2xmNw!2e0!7i13312!8i6656?coh=205409&entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D', 'Preah Sihanouk', 'Residential, Car Garage, Business.', '162 sqm', '166 sqm', 0, 1, 0, 1, '515187.00', NULL, 0),
(2, '2 parcels of land erected with an under-construction 7 storey building.', 'Phum 3, Sangkat 3, Sihanoukville, Preah Sihanouk province.', 'https://maps.app.goo.gl/CqXr9sWxkmknpgqM8', 'Preah Sihanouk', 'An under-construction 7 storey building (approximately 60%)', '1,050sqm', '2,073 sqm', 0, 0, 0, 0, '2082000.00', NULL, 0),
(3, 'A parcel of land erected upon with a 4-storey detached house.', 'Phum 2, Sangkat 3, Sihanoukville, Preah Sihanouk province.', 'https://www.google.com/maps/place/JGP7%2B4HC,+%E1%9E%80%E1%9F%92%E1%9E%9A%E1%9E%BB%E1%9E%84%E1%9E%96%E1%9F%92%E1%9E%9A%E1%9F%87%E1%9E%9F%E1%9E%B8%E1%9E%A0%E1%9E%93%E1%9E%BB/@10.6354303,103.5139545,3a,75y,275.4h,107.05t/data=!3m6!1e1!3m4!1sDaEX-deHtiarieBt', 'Preah Sihanouk ', '4-storey house', '106 sqm', '303 sqm', 0, 0, 0, 0, '229000.00', NULL, 1),
(4, 'A parcel of land erected upon with a 4-storey detached house.', 'Phum 3, Sangkat 1, Sihanoukville, Preah Sihanouk province.', 'https://www.google.com/maps/place/Camp+Tentara+langit/@10.633341,103.5359282,48m/data=!3m1!1e3!4m6!3m5!1s0x3107e100670a633f:0xdf1d42e51dfc916!8m2!3d10.6333088!4d103.5360501!16s%2Fg%2F11vrgf3g3y!5m1!1e4?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D', 'Preah Sihanouk ', '4-storey house', '258 sqm', '689 sqm', 0, 0, 0, 0, '304000.00', NULL, 1),
(5, 'The Memoire Palace Resort & Spa Siem Reap is a fabulous 5-star hotel with 64 stylish rooms.', 'Sangkat Svay Dangkum, Siem Reap City, Siem Reap Province.', 'https://www.google.com/maps/place/Memoire+D+\'Angkor+Boutique+Hotel/@13.3621661,103.8558912,3a,84.8y,298.43h,94.96t/data=!3m7!1e1!3m5!1sJp8GnLfEM5VanVxo5P3hWQ!2e0!6shttps:%2F%2Fstreetviewpixels-pa.googleapis.com%2Fv1%2Fthumbnail%3Fpanoid%3DJp8GnLfEM5VanVxo', 'Siem Reap', 'Hotel, Restaurant. ', '14,160 sqm', '13,772sqm', 0, 0, 0, 0, '14238000.00', NULL, 1),
(6, 'A ground floor of 3 storey terraced house.', 'No. 331EE0 and 331FE0, Street 109, Sangkat Ou Russei Ti Buon, Khan Prampir Makara, Phnom Penh.', 'https://www.google.com/maps/@11.5648189,104.9187983,3a,75y,128.43h,90.62t/data=!3m6!1e1!3m4!1sg0YOZkqMlg8mA8W59Ti9Iw!2e0!7i13312!8i6656!5m1!1e4?coh=205409&entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D', 'Phnom Penh.', 'Residential, Operate business.', '229.80 sqm', 'N/A sqm', 0, 0, 0, 0, '897000.00', NULL, 1),
(7, 'A parcel land erected with double storey linked house.', 'Borey Chhouk Va I, No. 171E1, Street B, Phum Plou Phaeam, Sangkat Kok Roka, Khan Prey Pnov, Phnom Penh.', 'https://www.google.com/maps/@11.5951531,104.8094474,3a,75y,26.9h,85.62t/data=!3m7!1e1!3m5!1s_GWoUJVU1ehr1dl5IQvggg!2e0!6shttps:%2F%2Fstreetviewpixels-pa.googleapis.com%2Fv1%2Fthumbnail%3Fpanoid%3D_GWoUJVU1ehr1dl5IQvggg%26cb_client%3Dsearch.revgeo_and_fetc', 'Phnom Penh.', 'Double Storey linked house.', '56 sqm', '112 sqm', 0, 0, 0, 0, '73248.00', NULL, 1),
(8, 'A parcel of land erected with a 4-storey detached house. ', 'House No. GI03, Street Malis (Borey Orkide the Grand), Phum Trapaing, Chhouk, Sangkat Teok Thla, Khan Sek Sok, Phnom Penh.', 'https://www.google.com/maps/place/11%C2%B033\'00.3%22N+104%C2%B052\'41.7%22E/@11.5501339,104.8780404,48m/data=!3m1!1e3!4m4!3m3!8m2!3d11.5500833!4d104.87825!5m1!1e4?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D', 'Phnom Penh.', '4-storey house.', '693.95 sqm', '323 sqm', 0, 3, 1, 4, '16776.00', NULL, 1),
(9, 'Parcels of land erected upon with multiple buildings.', 'National Road No. 71, Khel Chey Village, Osvey Commune, Kampong Siem District, Kampong Cham Province, Kingdom of Cambodia.', 'https://www.google.com/maps/place/12%C2%B003\'24.5%22N+105%C2%B021\'22.4%22E/@12.0567941,105.3536441,761m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d12.0567941!4d105.356219?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D', 'Kampong Cham.', 'Multiple buildings.', '1,535.00 sqm', '829.55 sqm', 0, 0, 0, 0, '218000.00', NULL, 0),
(10, '15 parcels (Block A) and 8 parcels (Block B) of vacant land.', 'Toul Beng and Sdach Non-Village, Kro La Commune, Kampong Siem District, Kampong Cham Province, Kingdom of Cambodia. ', 'https://maps.app.goo.gl/ConVHQt3Kpx1oHq59', 'Kampong Cham.', 'Vacant land.', '105.739.00 sqm ', '0 sqm', 0, 0, 0, 0, '1677690.00', NULL, 0),
(11, 'A one-Storey shop house.', 'Village 6, Sangkat Boeng Kengkong 3, Khann Chamkar Morn, Phnom Penh City.', 'https://www.google.com/maps/place/11%C2%B033\'02.2%22N+104%C2%B055\'09.2%22E/@11.550609,104.9166373,17z/data=!3m1!4b1!4m4!3m3!8m2!3d11.550609!4d104.9192122?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D', 'Phnom Penh.', 'Shop house.', '86 sqm', '93.24 sqm', 0, 0, 0, 0, '247700.00', NULL, 0),
(12, 'A parcel of land erected with 2 units of three-Storey house.', 'Phum Ti 6, Sangkat Veal Vong, Krong Kampong Cham, Kampong Cham Province, Kingdom of Cambodia.', 'https://maps.app.goo.gl/d1dDnPh8o49jDwNg6', 'Kampong Cham.', '2 units of three-Storey house.', '129.00 sqm', '497.60 sqm', 0, 0, 0, 0, '321000.00', NULL, 0),
(13, 'Shop House ', 'Street No. 608 corner concrete road, Phum 23, Sangkat Boeng Kak Ti Pir, Khan Tuol Kouk, Phnom Penh City. ', 'https://maps.app.goo.gl/tpSTd44oUUZNSnbx5', 'Phnom Penh ', 'Two-Story Flat ', '154 sqm', '258.80', 2, 5, 1, 6, '500000.00', NULL, 0),
(14, 'Link House (Borey New World Kombol I) ', '204, Street 03 (Borey New World Kombol I), Snuongpich, Khan Kombol,Phnom Penh. ', 'https://maps.app.goo.gl/pY8etMLpjvQMuwBu6', 'Phnom Penh ', 'Link House ', '73 sqm', '124 sqm', 1, 2, 1, 3, '63000.00', NULL, 0),
(15, 'Villa ', 'Phum Tanguon, Sangkat Kakab, Khan porsenchey, Phnom Penh. ', 'https://maps.app.goo.gl/TXtQ6VgLeZZEw1FZ8', 'Phnom Penh ', 'Three-Storey Villa ', '288 sqm ', '337.50', 3, 8, 2, 10, '450000.00', NULL, 0),
(16, 'A parcel of land erected with double-storey detached house.', 'Mitipheap Village, Sangkat Poi Pet, Krong Poi Pet, Banteay Meanchey Province, Kingdom of Cambodia.', 'https://maps.app.goo.gl/dot4JZHbMJh19ZCy7', 'Banteay Meanchey.', 'Double-Storey detached house.', '488.00 sqm', '259.00 sqm', 0, 0, 0, 0, '281000.00', NULL, 0),
(17, 'A parcel of land and erected with double-Storey shop house', 'No. 610E0E1, Street Lum, Phum Trea, Sangkat Stoeung Meanchey, Khan Meanchey, Phnom Penh.', 'https://maps.app.goo.gl/MEZf5iwa1EQZh58b9', 'Phnom Penh.', 'Double-Storey shop house with 6 Stalls surrounding Residence House.', '626 sqm', '456 sqm', 0, 0, 0, 0, '643000.00', NULL, 0),
(18, 'A parcel of vacant land.', 'Kandalkroam Village, Bonteay dek, commune, Kean Svay District, Phnom Penh City, \r\nCambodia.', 'https://maps.app.goo.gl/h9FD8u2wWG8kePS1A', 'Phnom Penh.', 'Vacant land.', '10,602 sqm', '0', 0, 0, 0, 0, '1100000.00', NULL, 0),
(19, 'A parcel land erected with a unit of a single-Storey house. ', 'No. B05, Street 11BT, Phum Oudem, Sangkat Chaom Chao, Khan Pursenchey, Phnom Penh.', 'https://www.google.com/maps/place/11%C2%B032\'05.6%22N+104%C2%B048\'28.6%22E/@11.5348618,104.8077947,48m/data=!3m1!1e3!4m4!3m3!8m2!3d11.5348889!4d104.8079444?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D', 'Phnom Penh.', 'A unit of a single-Storey house. ', '81 sqm', '186.55 sqm', 0, 0, 0, 0, '61705.00', NULL, 0),
(20, 'A parcel of land erected with a 3-storey semi-detached house.', 'No. B05, Street 11BT, Phum Oudem, Sangkat Chaom Chao, Khan Pursenchey, Phnom Penh.', 'https://www.google.com/maps/place/11%C2%B038\'47.8%22N+104%C2%B054\'13.3%22E/@11.6465796,104.9035545,48m/data=!3m1!1e3!4m4!3m3!8m2!3d11.646611!4d104.903694?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D', 'Phnom Penh.', '3-storey semi-detached house.', '168 sqm', '258 sqm', 3, 4, 1, 5, '265000.00', NULL, 0),
(21, 'A parcel land erected with a 3 Storey villa.', 'Borey Vimean Phnom Penh, No. 61, Street 205, Phum Ti 4, Sangkat Chrang Chomres Ti 1, Khan Russey Keo, Phnom Penh.', 'https://www.google.com/maps/place/11%C2%B037\'56.4%22N+104%C2%B052\'48.6%22E/@11.6323333,104.8775918,762m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d11.6323333!4d104.8801667?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D', 'Phnom Penh.', '3 Storey villa.', '203 sqm', '274 sqm', 0, 0, 0, 0, '282198.00', NULL, 0),
(22, 'A single storey shop house', 'Phum Chres, S/K Phnom Penh Thmey, K/H Sen Sok, Phnom Penh.', 'https://maps.app.goo.gl/iPuJM5GqefANiX6Y7', 'Phnom Penh.', 'Shop house.', '443 sqm', '120sqm', 0, 0, 0, 0, '546000.00', NULL, 0),
(23, '2 units of a 2-storey terrace house.', 'Phum 3, Sangkat 2, Sihanoukville, Preah Sihanouk province', 'https://maps.app.goo.gl/yFt6U9QzvxMGEJro7', 'Preah Sihanouk ', 'Shop house.', '1,092sqm', '712sqm', 0, 0, 0, 0, '2597000.00', NULL, 0),
(24, 'A unit of 3 storey shophouse (E0-E2). ', 'Borey Kimsoing, House No. 11A, St. L-06, Rorbos Angkanh Village, Prek Eng Commune, Chbar Ampov District, Phnom Penh City, Cambodia.', 'https://www.google.com/maps/@11.4990369,104.9923881,3a,75y,185.68h,76.27t/data=!3m7!1e1!3m5!1sXdBWHc-tMO6dNwZwifrOqA!2e0!6shttps:%2F%2Fstreetviewpixels-pa.googleapis.com%2Fv1%2Fthumbnail%3Fpanoid%3DXdBWHc-tMO6dNwZwifrOqA%26cb_client%3Dsearch.revgeo_and_fe', 'Phnom Penh.', 'A unit of 3 storey shophouse.', '63 sqm ', '162 sqm ', 0, 0, 0, 0, '171463.00', NULL, 1),
(25, 'A parcel of land erected with a 3-storey linked-house.', 'House No. 39, Street P-23, Phum Veal Sbov, Sangkat Veal Sbov, Khan Chbar Ampov, Phnom Penh.', 'https://www.google.com/maps/@11.5240689,104.9600971,3a,75y,111.82h,74.38t/data=!3m7!1e1!3m5!1sg5b_xYqdm2gU1XqMTeIJew!2e0!6shttps:%2F%2Fstreetviewpixels-pa.googleapis.com%2Fv1%2Fthumbnail%3Fpanoid%3Dg5b_xYqdm2gU1XqMTeIJew%26cb_client%3Dsearch.revgeo_and_fe', 'Phnom Penh.', '3-storey linked-house.', '61.00sqm', '161.15sqm', 0, 4, 1, 3, '149710.00', NULL, 1),
(26, '2 unit of twin villa faces to the west onto street Malis (Within Borey Orkide the Grand) ', 'House GI03, St. Malis, Trapeang Chhuk Village, Ou Baek K\'am Communce, Saensokh District, Phnom Penh, Kingdom of Cambodia. ', 'https://www.google.com/maps/place/11%C2%B033\'00.0%22N+104%C2%B052\'41.7%22E/@11.5499124,104.8782137,48m/data=!3m1!1e3!4m4!3m3!8m2!3d11.55!4d104.87825?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D', 'Phnom Penh.', 'Twin Villa', '323.00sqm', '693.95sqm ', 0, 8, 1, 10, '916776.00', NULL, 0),
(27, 'A parcel of land erected upon with a 2storey detached house.  ', 'Sala Kansaeng Village, Svay Dangkum Commune, Siem Reap City, Siem Reap Province, Kingdom of Cambodia.', 'https://www.google.com/maps/place/13%C2%B022\'29.8%22N+103%C2%B050\'42.6%22E/@13.3755711,103.8442149,80m/data=!3m1!1e3!4m4!3m3!8m2!3d13.3749494!4d103.8451578?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D', 'Siem Reap', '2storey detached house, Rental House.', '664sqm ', '376.10sqm ', 0, 8, 0, 8, '284000.00', NULL, 0),
(28, 'A parcel of land erected upon with a single-storey shop house.    ', 'Trapeang Seh Village, Sangkat Kork Chak, Siem Reap City, Siem Reap \r\nProvince, Kingdom of Cambodia.  ', 'https://maps.app.goo.gl/hsJuQ3Tw9ENifwi7A', 'Siem Reap', '10 rental houses', '1,197sqm ', '580sqm ', 0, 0, 0, 0, '744000.00', NULL, 0),
(29, 'A parcel of land accommodating three stories flat. ', 'III Village, Preah Ponlea Commune, Serei Saophoan City, Banteay Meanchey\r\nProvince, Kingdom of Cambodia. \r\n', 'https://www.google.com/maps/place/13%C2%B035\'05.2%22N+102%C2%B058\'25.9%22E/@13.5846968,102.9737209,47m/data=!3m1!1e3!4m4!3m3!8m2!3d13.584767!4d102.973852?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D', 'Banteay Meanchey.', '3 Storey flat.', '128sqm', '384sqm', 0, 11, 0, 11, '363520.00', NULL, 0),
(30, 'A parcel of land accommodating three stories flat.  ', '7 Makara Street, Wat Bo Village, Sangkat Salakamreuk, Siem Reap City, Siem Reap Province, Kingdom of Cambodia.  ', 'https://maps.app.goo.gl/MjaExi8M2TTvhz717', 'Siem Reap', '3 Storey flat.', '98sqm ', '249.75sqm ', 0, 4, 1, 5, '304203.00', NULL, 0),
(31, 'A parcel of construction land.  ', 'The corner of dusty road and canal at Phum Spean Chreav, Sangkat Siem Reap, Siem Reap Town, Siem Reap Province, Kingdom of Cambodia. ', 'https://www.google.com/maps/place/13%C2%B019\'12.2%22N+103%C2%B050\'52.3%22E/@13.3200697,103.847832,47m/data=!3m1!1e3!4m4!3m3!8m2!3d13.320065!4d103.847865?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D', 'Siem Reap', 'Vacant land.', '922sqm ', '0 sqm', 0, 0, 0, 0, '110640.00', NULL, 0),
(32, 'A parcel of land erected upon with a 2storey dwelling.', 'The corner of dusty road and canal at Phum Spean Chreav, Sangkat Siem Reap, Siem Reap Town, Siem Reap Province, Kingdom of Cambodia. ', 'https://www.google.com/maps/place/13%C2%B019\'58.4%22N+103%C2%B051\'02.5%22E/@13.3328975,103.8481063,757m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d13.3328975!4d103.8506812?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D', 'Siem Reap', '2 storey dwelling.', '246sqm ', '217.60sqm ', 0, 0, 0, 0, '144000.00', NULL, 0),
(33, ' A parcel of land erected upon with a 2-storey dwelling and a 3-storey terraced house. ', 'Concreted Road, Por Village, Siem Reap Commune, Siem Reap City, Siem Reap Province, Kingdom of Cambodia. ', 'https://www.google.com/maps/place/13%C2%B019\'05.0%22N+103%C2%B051\'01.1%22E/@13.318065,103.8477281,757m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d13.318065!4d103.850303?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D', 'Siem Reap', '2 -storey dwelling and a 3-storey terraced house. ', '797sqm', '989.85sqm', 0, 0, 0, 0, '343000.00', NULL, 0),
(34, 'Two (2) adjoining parcels of lands erected upon with a 3-storey detached house with rooftop. ', 'Laterite Road, Phnhea Chey Village, Svay Dangkum Commune, Siem Reap City, Siem Reap Province, Kingdom of Cambodia. ', 'https://www.google.com/maps/place/13%C2%B020\'47.1%22N+103%C2%B050\'08.8%22E/@13.346406,103.8332091,757m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d13.346406!4d103.835784?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D', 'Siem Reap', '3-storey detached house with rooftop. ', '482sqm', '804sqm', 0, 8, 3, 0, '294000.00', NULL, 0),
(35, 'The property is a parcel erected with a double-storey detached-house.', 'No. V23 and V24, Street G8 (with Borey Galaxy 11) corner an unnamed paved road, Phum Prek Chrey, Sangkat Spean Thmor, Khan Dangkor, Phnom Penh.', 'https://maps.app.goo.gl/NVRNNGzpDxTgnoU59', 'Phnom Penh.', 'Double-storey detached-house.', '376 sqm', '300 sqm', 0, 0, 0, 0, '327500.00', NULL, 0),
(36, 'A unit of a 3-story shophouse. ', 'Lot No. A9, Phum Dei Thmey, Sangkat Phnm Penh Thmey, Khan Saen Sok, Phnom Penh.', 'https://maps.app.goo.gl/FUL5KGP2jg1k3zn86', 'Phnom Penh.', '3-story shophouse. ', '94 sqm', '242 sqm', 0, 0, 0, 0, '281400.00', NULL, 0),
(37, 'The property is located within the tourist areas can be operated as resort & hotel.', 'Neang Kok Village, Pak Khlang Commune, Mondol Seima District, Koh Kong Province.', 'https://maps.app.goo.gl/gGYa7BupGSzFNE2w5', 'Koh Kong', 'Vacant land.', '37,474 sqm', '0 sqm', 0, 0, 0, 0, '6370580.00', NULL, 0),
(38, 'The property is located within the tourist areas can be operated as resort.', 'Tropeing Kea Village, Choeng Kor Commune, Prey Nop District, Preah Sihanouk Province. ', 'https://www.google.com/maps/place/10%C2%B046\'55.8%22N+103%C2%B047\'23.7%22E/@10.7820234,103.789383,161m/data=!3m1!1e3!4m4!3m3!8m2!3d10.7821667!4d103.7899167?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D', 'Preah Sihanouk ', 'Vacant land.', '98,826 sqm', '0 sqm', 0, 0, 0, 0, '98826.00', NULL, 0),
(39, 'A parcel of land erected upon with a 4-storey detached house.', 'Phum 2, Sangkat 3, Sihanoukville, Preah Sihanouk province.', 'https://www.google.com/maps/place/JGP7%2B4HC,+%E1%9E%80%E1%9F%92%E1%9E%9A%E1%9E%BB%E1%9E%84%E1%9E%96%E1%9F%92%E1%9E%9A%E1%9F%87%E1%9E%9F%E1%9E%B8%E1%9E%A0%E1%9E%93%E1%9E%BB/@10.6354303,103.5139545,3a,75y,275.4h,107.05t/data=!3m6!1e1!3m4!1sDaEX-deHtiarieBt', 'Preah Sihanouk ', '4-storey house', '106sqm', '303sqm', 0, 0, 0, 0, '229000.00', NULL, 0),
(40, 'A parcel of land erected upon with a 4-storey detached house.', 'Phum 3, Sangkat 1, Sihanoukville, Preah Sihanouk province.', 'https://www.google.com/maps/place/Camp+Tentara+langit/@10.633341,103.5359282,48m/data=!3m1!1e3!4m6!3m5!1s0x3107e100670a633f:0xdf1d42e51dfc916!8m2!3d10.6333088!4d103.5360501!16s%2Fg%2F11vrgf3g3y!5m1!1e4?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D', 'Preah Sihanouk ', '4-storey house', '258sqm', '689sqm', 0, 0, 0, 0, '304000.00', NULL, 0),
(41, 'A ground floor of 3 Storey terraced house. ', 'No. 331EE0 and 331FE0, Street 109, Sangkat Ou Russei Ti Buon, Khan Prampir Makara, Phnom Penh', 'https://www.google.com/maps/@11.5648189,104.9187983,3a,75y,128.43h,90.62t/data=!3m6!1e1!3m4!1sg0YOZkqMlg8mA8W59Ti9Iw!2e0!7i13312!8i6656!5m1!1e4?coh=205409&entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D', 'Phnom Penh.', 'Residential, Operate business.', '229.80 sqm', 'N/A sqm', 0, 0, 0, 0, '897000.00', NULL, 0),
(42, 'The Memoire Palace Resort & Spa Siem Reap is a fabulous 5-star hotel with 64 stylish rooms.', 'Sangkat Svay Dangkum, Siem Reap City, Siem Reap Province.', 'https://www.google.com/maps/place/Memoire+D+\'Angkor+Boutique+Hotel/@6.7270655,9.7402583,12656264m/data=!3m1!1e3!4m9!3m8!1s0x3110176d9310adc3:0x8638527267bfedbc!5m2!4m1!1i2!8m2!3d13.3623453!4d103.8555166!16s%2Fg%2F1tgdfffm?entry=ttu&g_ep=EgoyMDI0MDkwMy4wIK', 'Siem Reap', 'Hotel, Restaurant. ', '14,160 sqm', '13,772sqm', 0, 0, 0, 0, '14238000.00', NULL, 0),
(43, 'A parcel land erected with double storey linked house.', 'Borey Chhouk Va I, No. 171E1, Street B, Phum Plou Phaeam, Sangkat Kok Roka, Khan Prey Pnov, Phnom Penh.', 'https://maps.app.goo.gl/KozDbCTX9Sjj4Dkt7', 'Phnom Penh.', 'Double Storey linked house.', '56 sqm', '112 sqm', 0, 0, 0, 0, '73248.00', NULL, 0),
(44, 'A parcel of land erected with a 4-storey detached house. ', 'House No. GI03, Street Malis (Borey Orkide the Grand), Phum Trapaing, Chhouk, Sangkat Teok Thla, Khan Sek Sok, Phnom Penh.', 'https://www.google.com/maps/place/11%C2%B033\'00.3%22N+104%C2%B052\'41.7%22E/@11.5501339,104.8780404,48m/data=!3m1!1e3!4m4!3m3!8m2!3d11.5500833!4d104.87825!5m1!1e4?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D', 'Phnom Penh.', '4-storey house.', '693.95 sqm', '323 sqm', 0, 0, 0, 0, '16776.00', NULL, 0),
(45, 'A parcel of land erected with a 3-storey linked-house.', 'House No. 39, Street P-23, Phum Veal Sbov, Sangkat Veal Sbov, Khan Chbar Ampov, Phnom Penh.', 'https://maps.app.goo.gl/ySKGQfv2ks94p6gy6', 'Phnom Penh.', '3-storey linked-house.', '61.00sqm', '161.15sqm', 0, 0, 0, 0, '149710.00', NULL, 0),
(46, 'A unit of 3 storey shophouse (E0-E2). ', 'Borey Kimsoing, House No. 11A, St. L-06, Rorbos Angkanh Village, Prek Eng Commune, Chbar Ampov District, Phnom Penh City, Cambodia.', 'https://maps.app.goo.gl/VaAyxCcMSbGdFBVS9', 'Phnom Penh.', 'A unit of 3 storey shophouse.', '63 sqm ', '162 sqm ', 0, 0, 0, 0, '171463.00', NULL, 0),
(47, 'A parcel of land erected with a 3-storey flat house ', 'No.10B, Phum Khor 1, Sangkat Chrang Chomres Ti2, Khan Russey Keo, Phnom Penh, Cambodia.\r\n', 'https://maps.app.goo.gl/adLG3mqvvH3U19Pv8', 'Phnom Penh.', '3-storey flat house ', '79 sqm', '236 sqm', 0, 4, 1, 6, '165000.00', NULL, 0),
(48, 'The property is kind of link-house with three-Storey', '#19, Phum Boeung Salang, Sangkat Russey Keo, Khan Russey Keo, Phnom Penh.', 'https://maps.app.goo.gl/a2MmivquUAFBhGAV8', 'Phnom Penh.', '3 Storey of link-house.', '67 sqm', ' 160 sqm', 3, 6, 3, 7, '110000.00', NULL, 0),
(49, 'Borey Borey ML  Prek Chrey Projection.', 'Borey ML, Single Villa No.08, Street 02, Phum Daung, S/K Spean Thma, Khan Dangkao, Phnom Penh.', 'https://maps.app.goo.gl/GynuyYU2NW9SHbKd7', 'Phnom Penh.', 'Single Villa', '192sqm', '294sqm', 0, 0, 0, 0, '240000.00', NULL, 0),
(50, 'Link-house onestorey', 'Phum Trapaingnub, Krang Makak Commune, Angsnoul District, Kandal Province.', 'https://maps.app.goo.gl/E8KV67ugvdbENgqK9', 'Kandal.', '1 Storey link house.', '91 sqm ', '106 sqm ', 0, 2, 0, 3, '50000.00', NULL, 0),
(51, 'Link-house one-storey', 'No. 04 (P2), Concrete Road, Phum Snao Kheut, Sangkat Snao, Khan Kambol, Phnom Penh. ', 'https://maps.app.goo.gl/hYtgbLXmqyt1Dx1f6', 'Phnom Penh.', '1 Storey link house.', '132 sqm', '135 sqm', 0, 2, 0, 3, '90000.00', NULL, 0),
(52, 'A parcel of land erected with a double-storey flat', 'Phum Sansam Kosal I, Sanfkat Beoung Tumpon, Khan Meanchey, Phnom Penh, Kingdom of Cambodia.', 'https://maps.app.goo.gl/R5n2RLrdHrJdAsgS8', 'Phnom Penh.', 'Double Storey flat house.', '245.00 sqm', '202.50 sqm', 0, 4, 0, 4, '280000.00', NULL, 0),
(53, '2 units of Penthouse.', 'Phum 03, SangKat Chroy Changva, Khan Chroy Changva, Phnom Penh.', 'https://maps.app.goo.gl/mxiJZKvtL2jbmVdz6', 'Phnom Penh.', 'Penthouse', 'N/A', 'N/A', 0, 0, 0, 0, '700000.00', NULL, 0),
(54, '2 unit of double storey Shop House ', 'Street BT samrong Andet, Sangkat Phnom Penh Thmey, Khan Sen Sok, Phnom Penh City.', 'https://maps.app.goo.gl/NvqNhyRMeYR4w5s69', 'Phnom Penh.', 'Shop house.', '132 sqm', '436.60 sqm', 0, 7, 2, 8, '320000.00', NULL, 0),
(55, 'Vacant land.', 'Street. 99, Sangkat Russey Keo, Khan Russey Keo, Phnom Penh. ', 'https://maps.app.goo.gl/N1z5v1uqR9ZYm4N18', 'Phnom Penh.', 'Vacant land.', '4,809 sqm', 'N/A sqm', 0, 0, 0, 0, '2840000.00', NULL, 0),
(56, 'Double- storey single villa.', 'Phum 3, S/K Boengkak1, Khan Toul Kork, Phnom Penh. ', 'https://maps.app.goo.gl/YZKCvg3HM4aexEWs7', 'Phnom Penh.', 'Villa', '1,508 sqm', '2,547 sqm', 0, 0, 0, 0, '1909500.00', NULL, 0),
(57, 'Parcel land erected with a 3- storey flat', 'House No. 6, Street 1007, Phum Bayab, Sangkat Phnom Penh Thmey, Khan Sensok, Phnom Penh.', 'https://maps.app.goo.gl/yiCpJt1yBxiixGsj7', 'Phnom Penh.', '3 Storey flat.', '82sqm', '233.60sqm', 0, 6, 0, 4, '254000.00', NULL, 0),
(58, 'Parcel of land erected with a 3-storey flat', 'House No. 04, Street 04 (Borey Phnom Penh Thmey, The Harmony Villa), Phum Phum Pongpeay, Sangkat Toul SangkeII, Khan Russey Keo, Phnom Penh.', 'https://maps.app.goo.gl/95tokHfeLuLcFq5Y8', 'Phnom Penh.', '3 Storey flat.', '103sqm', '191sqm', 0, 6, 0, 4, '250500.00', NULL, 0),
(59, 'Duplex house two-storey', 'Street Concrete, Hum Traoaingsvay, Kraing Makak Commune, Angsnoul District, Kandal Province, Cambodia.', 'https://maps.app.goo.gl/TmWTUzDzSe4AUFcw9', 'Phnom Penh.', 'Duplex house.', '87m ', '126sqm', 0, 2, 0, 3, '132222.00', NULL, 0),
(60, 'three-storey of house in Borey J&C ', 'House No. T16, Street 05 corner of an unnamed paved road, (Borey J&C), Phun  Kraing Angkrong, Sangkat Kraing Thnung, Khan Sensok, Phnom Penh, Cambodia. ', 'https://maps.app.goo.gl/cQn6Rf8f3SH2qYuK7', 'Phnom Penh.', 'House.', '126m ', '357sqm', 0, 5, 0, 5, '203000.00', NULL, 0),
(61, 'Parcel of land erected with a single-storey detect house ', 'Village of 2, Commune of 04, District of Preah Sihanouk, City of Preah Sihanouk, Kingdom of Cambodia. ', 'https://maps.app.goo.gl/QyQM9NvaWqW8ANdMA', 'Preah Sihanouk ', 'Single stroey.', '474sqm', '216sqm', 0, 3, 0, 4, '915000.00', NULL, 0),
(62, '2-storey detached house.', 'Concrete Road, Phum Boeng Sangkat Russeykeo, Khan Russeykeo, Phnom Penh. ', 'https://maps.app.goo.gl/CKV63v5bgoC1H2rM6', 'Phnom Penh.', '2 storey house.', '197 sqm', '248 sqm', 0, 2, 0, 3, '270000.00', NULL, 0),
(63, '3 parcels of vacant land.', 'Phum Snguon Pich, Sangkat Kantork, Khan Kambol, Phnom Penh.', 'https://maps.app.goo.gl/PDYPgEvCgbCttUgq6', 'Phnom Penh.', 'Vacant land.', '5,078.00 sqm', 'N/A sqm', 0, 0, 0, 0, '650000.00', NULL, 0),
(64, 'A parcel of A 3 storey villa.', 'No. 23, Street 03, Village Trapaing Chouk, Sangkat Teuk Thla, Khan Sen Sok, Phnom Penh.', 'https://maps.app.goo.gl/LQcFPSddXfMcDj2H7', 'Phnom Penh.', 'Villa', '154 sqm', '258.80 sqm', 0, 0, 1, 5, '280000.00', NULL, 0),
(65, 'Vacant Land ', 'Anlong Kgan Village, Sangkat Khmuonh, Khan Russey Keo, Phnom Penh', 'https://maps.app.goo.gl/r8FDUybzwWKDwJJ76', 'Phnom Penh.', 'Vacant land.', '3,959 sqm', 'N/A sqm', 0, 0, 0, 0, '277000.00', NULL, 0),
(66, 'A parcel of land with a unit of double storey house. ', 'No. 23 Lot No.7413, Phum 05, S/K No.4, Krong Preah Sihanouk, Preash Sihanouk Province.', 'https://maps.app.goo.gl/admBasKVGyK8U7BL7', 'Preah Sihanouk ', 'Double Storey house.', '91 sqm', '180 sqm', 0, 3, 0, 4, '150000.00', NULL, 0),
(67, 'A parcel of land with a unit of double stories link house.', 'In Borey Rachana No.11MEoE1, Phum Khor I, Sangkat Chrang Chamres Ti II, Khan Russey Keo, Phnom Penh. (598)', 'https://maps.app.goo.gl/hAZ4tzemUEQuvEiG8', 'Phnom Penh.', 'Double Storey link house.', '93 sqm', '140 sqm', 0, 4, 0, 5, '120000.00', NULL, 0),
(68, 'Villa decorated into 2 units of shop house ', 'No.46, Street 608, Sangkat Boeung Kak2, Khan Toul Kork, Phnom Penh.', 'https://maps.app.goo.gl/nFX5K2AvQtsB2dvm7', 'Phnom Penh.', '2 Unite shop house.', '513 sqm', '750.75 sqm', 0, 0, 0, 0, '1124000.00', NULL, 0),
(69, 'A parcel erected with a double-storey detached-house.', 'No. V23 and V24, Street G8 (with Borey Galaxy 11) corner an unnamed paved road, Phum Prek Chrey, Sangkat Spean Thmor, Khan Dangkor, Phnom Penh.', 'https://maps.app.goo.gl/rDes1833npTtx9sS7', 'Phnom Penh.', 'Double-Storey detached house.', '376 sqm', '300 sqm', 0, 0, 0, 0, '327500.00', NULL, 1),
(70, 'A parcel of land with garage.', 'No. 635, Phum Kraing Angkroung, Sangkat Kraing Thnoung, Khan Sensok, Phnom Penh.', 'https://maps.app.goo.gl/dUxzfjXYfrKrMkqA8', 'Phnom Penh.', 'Garage rental', '1,552 sqm', '1,278 sqm', 0, 0, 0, 0, '1280568.00', NULL, 0),
(71, 'A parcel of land erected upon with a 2-storey detached house.', 'No. N/A, Street 345, Buon Village, Boeng Kak Ti Muoy Commune, Tuol Kouk District, Phnom Penh Capital, Kingdom of Cambodia.', 'https://maps.app.goo.gl/fgnvAkrJSamonE2E6', 'Phnom Penh.', '2-storey detached house', '284sqm', '332.87sqm', 0, 0, 0, 0, '774000.00', NULL, 0),
(72, 'The subject property is four parcels of construction land.', 'Phum Ang Boeng, Sangkat Kamboul, Khan Kamboul, Phnom Penh.', 'https://maps.app.goo.gl/gCQjMosVw5xgK23j6', 'Phnom Penh.', 'Land', '40,645sqm', 'N/A sqm', 0, 0, 0, 0, '6909650.00', NULL, 0),
(73, 'A parcel of land erected with a double-storey detached house.', 'Borey Modern No. MH273, An unnamed paved road, Phum Pongror, Sangkat Snao, Khan Kombol, Phnom Penh.', 'https://maps.app.goo.gl/pxDCVDJaCSiz8BFn6', 'Phnom Penh.', 'Double-Storey detached house.', '330 sqm', '184 sqm', 0, 0, 0, 0, '107000.00', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `property_images`
--

INSERT INTO `property_images` (`id`, `property_id`, `image`) VALUES
(37, 13, 'property_13/431869536_1076158540135192_382569246154379955_n (1).jpg'),
(38, 13, 'property_13/Screenshot 2024-08-09 110944.jpg'),
(39, 13, 'property_13/Screenshot 2024-08-16 134723.jpg'),
(40, 13, 'property_13/Screenshot 2024-08-16 134755.jpg'),
(41, 13, '431864261_7032633876843175_2424077978557718211_n (1).jpg'),
(42, 13, '431879855_386631630861031_1561945931543438079_n (1).jpg'),
(43, 13, '431949902_362345942811284_3518773767868675912_n (1).jpg'),
(44, 13, '431992492_1294840954805365_4676730338602383221_n (1).jpg'),
(45, 13, '432194348_451536620870603_6580968926161383063_n (1).jpg'),
(46, 14, 'property_14/387344763_738961580988052_4322076816663715382_n.jpg'),
(47, 14, 'property_14/404150912_1087260725653548_9220453267646477989_n.jpg'),
(48, 14, 'property_14/405003450_323882160488426_7741126273121221748_n.jpg'),
(49, 14, 'property_14/415140453_936999120600936_5614333552358641078_n.jpg'),
(50, 15, 'property_15/454058083_848931423996991_8616201977086216263_n.jpg'),
(51, 15, 'property_15/454157946_1222518372231167_8328496881317085763_n.jpg'),
(52, 15, 'property_15/454199600_3587178974866900_7167876306273765067_n.jpg'),
(53, 15, 'property_15/454882192_886060650086689_4866379085400227270_n.jpg'),
(54, 15, 'property_15/455263927_496529829801368_4879418649575682827_n.jpg'),
(55, 15, 'property_15/-6298836738545660560_121.jpg'),
(56, 15, 'property_15/-6298836738545660563_121.jpg'),
(57, 15, 'property_15/-6298836738545660566_121.jpg'),
(59, 1, 'Loek Sophoen 1.jpg'),
(62, 1, 'Loek Sophorn 2.jpg'),
(63, 1, 'Loek Sophorn.jpg'),
(64, 2, 'p1....jpg'),
(65, 2, 'P1...jpg'),
(66, 2, 'P1..jpg'),
(67, 2, 'P1.jpg'),
(83, 4, 'P3I.jpg'),
(84, 4, 'P3II.jpg'),
(93, 9, 'Capture P1.PNG'),
(94, 10, 'Capture P2.PNG'),
(95, 11, 'Capture 2.PNG'),
(97, 12, 'P1...PNG'),
(98, 12, 'P1..PNG'),
(99, 16, 'property_16/P2...PNG'),
(101, 17, 'property_17/Capture.PNG'),
(102, 18, 'property_18/Capture.PNG'),
(103, 19, 'property_19/Capture.PNG'),
(104, 20, 'property_20/Capture.PNG'),
(105, 21, 'property_21/Capture.PNG'),
(106, 22, 'property_22/Capture.PNG'),
(107, 23, 'property_23/Capture.PNG'),
(111, 26, 'property_26/Capture.PNG'),
(112, 27, 'property_27/Capture.PNG'),
(113, 28, 'property_28/p1....jpg'),
(114, 28, 'property_28/p1...jpg'),
(115, 28, 'property_28/P1.jpg'),
(116, 29, 'property_29/Capture p1.PNG'),
(117, 30, 'property_30/Capture p1.PNG'),
(118, 31, 'property_31/Capture P2.PNG'),
(119, 32, 'property_32/Capture P3.PNG'),
(120, 33, 'property_33/Capture 4.PNG'),
(121, 34, 'property_34/Capture 5.PNG'),
(122, 35, 'property_35/Capture.PNG'),
(123, 36, 'property_36/Capture.PNG'),
(124, 37, 'property_37/Capture p1.PNG'),
(125, 38, 'property_38/Capture p2.PNG'),
(136, 8, 'Capture.PNG'),
(137, 24, 'Capture.PNG'),
(138, 25, 'Capture.PNG'),
(145, 25, '0-6283_cute-wallpapers-hd-cute-paris-wallpaper-hd.jpg'),
(146, 4, '2cb974c4e775596c743585c2972acdb5.jpg'),
(147, 5, 'Capture.PNG'),
(148, 39, 'property_39/P2.....jpg'),
(149, 39, 'property_39/P2....jpg'),
(151, 39, 'property_39/P2..jpg'),
(152, 39, 'property_39/P2.jpg'),
(159, 40, 'P3I.jpg'),
(160, 40, 'P3II.jpg'),
(161, 40, 'P3III.jpg'),
(162, 41, 'property_41/p.jpg'),
(163, 42, 'property_42/P.jpg'),
(164, 43, 'property_43/p.jpg'),
(165, 44, 'property_44/Capture.PNG'),
(166, 45, 'property_45/Capture.PNG'),
(167, 46, 'property_46/Capture.PNG'),
(168, 47, 'property_47/Capture.PNG'),
(169, 48, 'property_48/Capture 1.PNG'),
(170, 49, 'property_49/Capture 2.PNG'),
(171, 50, 'property_50/Capture 3.PNG'),
(172, 51, 'property_51/Capture 4.PNG'),
(173, 52, 'property_52/Capture5.PNG'),
(174, 53, 'property_53/Capture6.PNG'),
(175, 54, 'property_54/Capture7.PNG'),
(176, 55, 'property_55/Capture8.PNG'),
(177, 56, 'property_56/Capture9.PNG'),
(178, 57, 'property_57/Capture10.PNG'),
(179, 58, 'property_58/Capture11.PNG'),
(180, 59, 'property_59/Capture12.PNG'),
(181, 60, 'property_60/Capture13.PNG'),
(182, 61, 'property_61/Capture14.PNG'),
(183, 62, 'property_62/Capture15.PNG'),
(184, 63, 'property_63/Capture16.PNG'),
(186, 65, 'property_65/Capture19.PNG'),
(187, 64, 'Capture18...PNG'),
(188, 64, 'Capture18..PNG'),
(189, 64, 'Capture18.PNG'),
(190, 66, 'property_66/Capture20.PNG'),
(192, 67, 'Capture21.PNG'),
(193, 68, 'property_68/Capture22.PNG'),
(194, 69, 'property_69/Capture23.PNG'),
(195, 70, 'property_70/Capture.PNG'),
(196, 71, 'property_71/1.png'),
(197, 72, 'property_72/2.png'),
(198, 73, 'property_73/Seang Malody.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin1', '$2y$10$8/pdE/Z2HV4.thC.0dorLeF6DPebd948KpOsV4CS95PGffcnVw5XG', 'admin'),
(2, 'admin2', '$2y$10$x9EMW9kXPmp5BLBYSbX1mu5r6WE8ItrYEFnxfvB.0o/ACX.BueiIi', 'admin'),
(3, 'admin3', '$2y$10$Qo8/dkZY6EjGCcj1IXjWzevEynBOsF5J3FsWjUyKTxYVYQ93aRE4.', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `property_images`
--
ALTER TABLE `property_images`
  ADD CONSTRAINT `property_images_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
