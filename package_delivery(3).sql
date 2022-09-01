-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2022 at 04:13 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `package_delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `arrived_package`
--

CREATE TABLE `arrived_package` (
  `id` int(50) NOT NULL,
  `pickup_id` varchar(50) DEFAULT NULL,
  `staff` varchar(50) DEFAULT NULL,
  `booking` varchar(50) DEFAULT NULL,
  `delivery_status` varchar(50) DEFAULT NULL,
  `arrival_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `arrived_package`
--

INSERT INTO `arrived_package` (`id`, `pickup_id`, `staff`, `booking`, `delivery_status`, `arrival_date`) VALUES
(57, 'q7ftzp', '20220422115313', '20220502020708', '1', '2022-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `dbooking`
--

CREATE TABLE `dbooking` (
  `id` int(10) NOT NULL,
  `dbooking_id` varchar(50) NOT NULL,
  `staff_id` varchar(50) DEFAULT NULL,
  `dcustomer_id` varchar(50) DEFAULT NULL,
  `dpackage` varchar(50) DEFAULT NULL,
  `dvehicle_id` varchar(50) DEFAULT NULL,
  `dstate_id` varchar(50) DEFAULT NULL,
  `dlocation_id` varchar(50) DEFAULT NULL,
  `dweight` varchar(10) DEFAULT NULL,
  `ddelivery_method` varchar(15) DEFAULT NULL,
  `damount` varchar(50) DEFAULT NULL,
  `dbooking_status` varchar(10) DEFAULT NULL,
  `dbooking_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbooking`
--

INSERT INTO `dbooking` (`id`, `dbooking_id`, `staff_id`, `dcustomer_id`, `dpackage`, `dvehicle_id`, `dstate_id`, `dlocation_id`, `dweight`, `ddelivery_method`, `damount`, `dbooking_status`, `dbooking_date`) VALUES
(148, '20220422022303', '20220422115313', '20220422055450', '20220422020139', '20220422125842', '20220422115416', '20220422115708', '50', NULL, '10', 'arrived', '2022-04-22'),
(149, '20220422023252', '20220422115313', '20220422055450', '20220422020114', '20220422023157', '20220422115407', '20220422115449', '70', NULL, '50', 'in-transit', '2022-04-22'),
(150, '20220422063010', '20220422115313', '20220422060050', '20220422061046', '20220422023157', '20220422115416', '20220422115708', '50', NULL, '28', 'canceled', '2022-04-22'),
(151, '20220423063120', '20220422115313', '20220422060050', '20220422060949', '20220422023157', '20220422115416', '20220422115708', '80', NULL, '80', 'canceled', '2022-04-23'),
(152, '20220424124423', '20220422115313', '20220422060050', '20220424122629', '20220422023157', '20220422115416', '20220422115708', '50', NULL, '30', 'delivered', '2022-04-24'),
(153, '20220426035715', '20220422115313', '20220422055450', '20220426035459', '20220422125842', '20220422115416', '20220422115708', '50', NULL, '20', 'delivered', '2022-04-26'),
(154, '20220502020708', '20220422115313', '20220422060050', '20220502020545', '20220422125842', '20220422115416', '20220422115708', '55', NULL, '200', 'arrived', '2022-05-02'),
(155, '20220510013824', '20220422115313', '20220422055450', '20220510013500', '20220422125842', '20220422115416', '20220422115708', '60', NULL, '100', 'delivered', '2022-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `dinbox`
--

CREATE TABLE `dinbox` (
  `id` int(50) NOT NULL,
  `duser_id` varchar(50) DEFAULT NULL,
  `dpackage_id` varchar(50) DEFAULT NULL,
  `dinbox_status` varchar(50) DEFAULT NULL,
  `dinbox_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dinbox`
--

INSERT INTO `dinbox` (`id`, `duser_id`, `dpackage_id`, `dinbox_status`, `dinbox_date`) VALUES
(325, '20220422055450', '20220422020114', '1', '2022-04-22'),
(327, '20220422055450', '20220422020139', '2', '2022-04-22'),
(328, '20220422055450', '20220422020114', '2', '2022-04-22'),
(329, '20220422055450', '20220422020139', '4', '2022-04-22'),
(332, '20220422060050', '20220422061046', '1', '2022-04-22'),
(333, '20220422060050', '20220422061046', '2', '2022-04-22'),
(334, '20220422060050', '20220422061046', '3', '2022-04-23'),
(335, '20220422060050', '20220422060949', '2', '2022-04-23'),
(336, '20220422060050', '20220422060949', '3', '2022-04-23'),
(338, '20220422060050', '20220424122142', '1', '2022-04-24'),
(339, '20220422060050', '20220424122142', '3', '2022-04-24'),
(340, '20220422060050', '20220424122629', '1', '2022-04-24'),
(348, '20220422060050', '20220502020545', '1', '2022-05-02'),
(349, '20220422060050', '20220502020545', '2', '2022-05-02'),
(350, '20220422060050', '20220502020545', '4', '2022-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `dlocation`
--

CREATE TABLE `dlocation` (
  `id` int(32) NOT NULL,
  `dlocation_id` varchar(32) DEFAULT NULL,
  `dstate` varchar(32) DEFAULT NULL,
  `dterminal` varchar(50) DEFAULT NULL,
  `dlocation_status` varchar(32) DEFAULT NULL,
  `dregdate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dlocation`
--

INSERT INTO `dlocation` (`id`, `dlocation_id`, `dstate`, `dterminal`, `dlocation_status`, `dregdate`) VALUES
(49, '20220422115449', '20220422115407', 'No. 30 oro-aka street rumuagholu, port-harcourt', 'active', '2022-04-22'),
(50, '20220422115620', '20220422115535', 'Uniuyo school, nwaniba uyo', 'active', '2022-04-22'),
(51, '20220422115708', '20220422115416', 'Prince okocha street, enugu', 'active', '2022-04-22'),
(52, '20220424123936', '20220422115535', '50 bassey street uyo', 'active', '2022-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `dpackage_registration`
--

CREATE TABLE `dpackage_registration` (
  `id` int(32) NOT NULL,
  `dpackage_id` varchar(50) NOT NULL,
  `dsender_id` varchar(50) DEFAULT NULL,
  `dstate_id` varchar(50) DEFAULT NULL,
  `dlocation_id` varchar(50) DEFAULT NULL,
  `dreceiver` varchar(32) DEFAULT NULL,
  `dreceiver_phone` varchar(30) DEFAULT NULL,
  `dpackage_name` varchar(50) DEFAULT NULL,
  `dpackage_status` varchar(30) DEFAULT NULL,
  `daddress` varchar(50) DEFAULT NULL,
  `dregdate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dpackage_registration`
--

INSERT INTO `dpackage_registration` (`id`, `dpackage_id`, `dsender_id`, `dstate_id`, `dlocation_id`, `dreceiver`, `dreceiver_phone`, `dpackage_name`, `dpackage_status`, `daddress`, `dregdate`) VALUES
(173, '20220422020114', '20220422055450', '20220422115416', '20220422115708', 'James', '07055553109', 'Pairs of shoes', 'approved', NULL, '2022-04-22'),
(174, '20220422020139', '20220422055450', '20220422115535', '20220422115620', 'Iyambo', '08165188232', 'Laptops and beans', 'arrived', NULL, '2022-04-22'),
(175, '20220422060248', '20220422060050', '20220422115535', '20220422115620', 'Mummy oge', '070556356556', 'Bag of rice', 'canceled', NULL, '2022-04-22'),
(176, '20220422060949', '20220422060050', '20220422115407', '20220422115449', 'Tresh', '070556356556', 'Laptop', 'canceled', NULL, '2022-04-22'),
(177, '20220422061046', '20220422060050', '20220422115535', '20220422115620', 'Chinedu', '070555555322', 'Food stocks', 'canceled', NULL, '2022-04-22'),
(178, '20220424122142', '20220422060050', '20220422115535', '20220422115620', 'Okoro', '07055553109', 'Laptop and phone', 'canceled', NULL, '2022-04-24'),
(179, '20220424122629', '20220422060050', '20220422115535', '20220422115620', 'James', '090363553663', 'Pairs of shoes', 'delivered', NULL, '2022-04-24'),
(180, '20220426035459', '20220422055450', '20220422115535', '20220424123936', 'Elijah', '090363553663', 'Bag of vegetables', 'delivered', NULL, '2022-04-26'),
(181, '20220502020545', '20220422060050', '20220422115535', '20220424123936', 'Iyambo', '08165188232', 'Pairs of shoes', 'arrived', NULL, '2022-05-02'),
(182, '20220510013500', '20220422055450', '20220422115535', '20220424123936', 'Okoro', '07055553109', 'Laptop and phone', 'delivered', NULL, '2022-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(50) NOT NULL,
  `driver_id` varchar(50) DEFAULT NULL,
  `vehicle_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `driver_id`, `vehicle_id`) VALUES
(8, '20220422122722', '20220422125842'),
(9, '20220422023009', '20220422023157');

-- --------------------------------------------------------

--
-- Table structure for table `driver_inbox`
--

CREATE TABLE `driver_inbox` (
  `id` int(50) NOT NULL,
  `vehicle_id` varchar(50) DEFAULT NULL,
  `booking_id` varchar(50) DEFAULT NULL,
  `inbox_status` varchar(50) DEFAULT NULL,
  `reg_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver_inbox`
--

INSERT INTO `driver_inbox` (`id`, `vehicle_id`, `booking_id`, `inbox_status`, `reg_date`) VALUES
(92, '20220422023157', '20220422023252', '2', '2022-04-22'),
(93, '20220422023157', '20220422063010', '3', '2022-04-22'),
(94, '20220422023157', '20220423063120', '3', '2022-04-23'),
(95, '20220422023157', '20220424124423', '4', '2022-04-24'),
(96, '20220422125842', '20220426035715', '4', '2022-04-26'),
(97, '20220422125842', '20220502020708', '4', '2022-05-02'),
(98, '20220422125842', '20220510013824', '4', '2022-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `dstaff_registration`
--

CREATE TABLE `dstaff_registration` (
  `id` int(50) NOT NULL,
  `dstaff_id` varchar(30) DEFAULT NULL,
  `dstaff_state` varchar(30) DEFAULT NULL,
  `dterminal_id` varchar(30) DEFAULT NULL,
  `dfname` varchar(32) DEFAULT NULL,
  `dlname` varchar(32) DEFAULT NULL,
  `demail` varchar(32) DEFAULT NULL,
  `dusername` varchar(50) DEFAULT NULL,
  `dposition` varchar(32) DEFAULT NULL,
  `dgender` varchar(10) DEFAULT NULL,
  `dstaff_status` varchar(10) DEFAULT NULL,
  `dads` varchar(50) DEFAULT NULL,
  `ddob` varchar(15) DEFAULT NULL,
  `dpassword` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dstaff_registration`
--

INSERT INTO `dstaff_registration` (`id`, `dstaff_id`, `dstaff_state`, `dterminal_id`, `dfname`, `dlname`, `demail`, `dusername`, `dposition`, `dgender`, `dstaff_status`, `dads`, `ddob`, `dpassword`) VALUES
(107, '20220422115313', '20220422115416', '20220422115708', '', '', 'admin@quickdelivery.com', 'admin', 'admin', 'MALE', 'online', '', '', '18b76913adb62216df0e7a66f3295663'),
(108, '20220422122343', '20220422115407', '20220422115449', 'Nice', 'Nice', 'nice@gmail.com', 'Office-staff', 'Office-staff', 'MALE', 'offline', 'hjklhgnjk', '2022-04-03', '202cb962ac59075b964b07152d234b70'),
(109, '20220422122722', '20220422115416', '20220422115449', 'Richman', 'Owner', 'pilot@gmail.com', 'Driver', 'Driver', 'MALE', 'offline', 'hjkjiuh', '2022-04-19', '202cb962ac59075b964b07152d234b70'),
(110, '20220422023009', 'in-transit', '20220422115449', 'Okon', 'Okon', 'okon@gmail.com', 'Driver', 'Driver', 'MALE', 'offline', 'vbnplojih', '2022-04-11', '202cb962ac59075b964b07152d234b70'),
(111, '20220424124140', '20220422115535', '20220424123936', 'Richman', 'John', 'john111@gmail.com', 'Office-staff', 'Office-staff', 'MALE', 'offline', 'hhkjhwiqjwopk', '2022-04-21', '698d51a19d8a121ce581499d7b701668');

-- --------------------------------------------------------

--
-- Table structure for table `dstate_registration`
--

CREATE TABLE `dstate_registration` (
  `id` int(50) NOT NULL,
  `dstate_id` varchar(50) DEFAULT NULL,
  `dstate_name` varchar(50) DEFAULT NULL,
  `dreg_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dstate_registration`
--

INSERT INTO `dstate_registration` (`id`, `dstate_id`, `dstate_name`, `dreg_date`) VALUES
(24, '20220422115407', 'Rivers state', '2022-04-22'),
(25, '20220422115416', 'Enugu state', '2022-04-22'),
(26, '20220422115535', 'Akwa-ibom state', '2022-04-22'),
(27, '20220424123350', 'Bayelsa', '2022-04-24'),
(28, '20220426033204', 'Edo state', '2022-04-26'),
(29, '20220426033501', 'Kogi state', '2022-04-26'),
(30, '20220426033656', 'Abia state', '2022-04-26'),
(31, '20220502011517', 'Oyo state', '2022-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `duser_registration`
--

CREATE TABLE `duser_registration` (
  `id` int(50) NOT NULL,
  `duser_id` varchar(50) NOT NULL,
  `dfname` varchar(50) DEFAULT NULL,
  `dlname` varchar(50) DEFAULT NULL,
  `dusername` varchar(50) DEFAULT NULL,
  `demail` varchar(50) DEFAULT NULL,
  `dphn` varchar(30) DEFAULT NULL,
  `daddress` varchar(50) DEFAULT NULL,
  `dgender` varchar(50) DEFAULT NULL,
  `duser_status` varchar(50) DEFAULT NULL,
  `ddob` varchar(50) DEFAULT NULL,
  `dpassword` varchar(50) DEFAULT NULL,
  `dregdate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `duser_registration`
--

INSERT INTO `duser_registration` (`id`, `duser_id`, `dfname`, `dlname`, `dusername`, `demail`, `dphn`, `daddress`, `dgender`, `duser_status`, `ddob`, `dpassword`, `dregdate`) VALUES
(29, '20220422055450', 'Richman', 'Loveday', 'richy', 'richy@gmail.com', '07055553109', NULL, 'MALE', 'offline', NULL, '202cb962ac59075b964b07152d234b70', '2022-04-22'),
(30, '20220422060050', 'Saviour', 'Simeon', 'Save', 'saviour@gmail.com', '070662626626', NULL, 'MALE', 'offline', NULL, '202cb962ac59075b964b07152d234b70', '2022-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `dvehicle_registration`
--

CREATE TABLE `dvehicle_registration` (
  `id` int(10) NOT NULL,
  `dvehicle_id` varchar(50) DEFAULT NULL,
  `ddriver_id` varchar(50) DEFAULT NULL,
  `dvehicle_num` varchar(50) DEFAULT NULL,
  `dvname` varchar(50) DEFAULT NULL,
  `dvehicle_type` varchar(50) DEFAULT NULL,
  `dvehicle_dest` varchar(50) DEFAULT NULL,
  `dvehicle_status` varchar(50) DEFAULT NULL,
  `dregdate` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dvehicle_registration`
--

INSERT INTO `dvehicle_registration` (`id`, `dvehicle_id`, `ddriver_id`, `dvehicle_num`, `dvname`, `dvehicle_type`, `dvehicle_dest`, `dvehicle_status`, `dregdate`) VALUES
(47, '20220422125842', '20220422122722', '934-374-24', 'Toyota', 'Corola-123', '20220422115535', 'active', '2022-04-22'),
(48, '20220422023157', '20220422023009', '06H-034RV', 'Toyota Hilux', 'Hilux-2003', '20220422115535', 'active', '2022-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `track_package`
--

CREATE TABLE `track_package` (
  `id` int(50) NOT NULL,
  `booking_id` varchar(50) NOT NULL,
  `tracking_status` varchar(50) DEFAULT NULL,
  `tracking_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `track_package`
--

INSERT INTO `track_package` (`id`, `booking_id`, `tracking_status`, `tracking_date`) VALUES
(101, '20220422022303', '1', '2022-04-22'),
(102, '20220422022303', '3', '2022-04-22'),
(103, '20220422023252', '1', '2022-04-22'),
(104, '20220422023252', '3', '2022-04-22'),
(105, '20220422022303', '4', '2022-04-22'),
(106, '20220422063010', '1', '2022-04-22'),
(108, '20220423063120', '1', '2022-04-23'),
(109, '20220423063120', '2', '2022-04-23'),
(110, '20220424124423', '1', '2022-04-24'),
(111, '20220424124423', '3', '2022-04-24'),
(112, '20220424124423', '4', '2022-04-24'),
(113, '20220424124423', '5', '2022-04-24'),
(114, '20220426035715', '1', '2022-04-26'),
(115, '20220426035715', '3', '2022-04-26'),
(116, '20220426035715', '4', '2022-04-26'),
(117, '20220426035715', '5', '2022-04-26'),
(118, '20220502020708', '1', '2022-05-02'),
(119, '20220502020708', '3', '2022-05-02'),
(120, '20220502020708', '4', '2022-05-02'),
(121, '20220510013824', '1', '2022-05-10'),
(122, '20220510013824', '3', '2022-05-10'),
(123, '20220510013824', '4', '2022-05-10'),
(124, '20220510013824', '5', '2022-05-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arrived_package`
--
ALTER TABLE `arrived_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dbooking`
--
ALTER TABLE `dbooking`
  ADD PRIMARY KEY (`id`,`dbooking_id`);

--
-- Indexes for table `dinbox`
--
ALTER TABLE `dinbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dlocation`
--
ALTER TABLE `dlocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dpackage_registration`
--
ALTER TABLE `dpackage_registration`
  ADD PRIMARY KEY (`id`,`dpackage_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_inbox`
--
ALTER TABLE `driver_inbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dstaff_registration`
--
ALTER TABLE `dstaff_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dstate_registration`
--
ALTER TABLE `dstate_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duser_registration`
--
ALTER TABLE `duser_registration`
  ADD PRIMARY KEY (`id`,`duser_id`);

--
-- Indexes for table `dvehicle_registration`
--
ALTER TABLE `dvehicle_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `track_package`
--
ALTER TABLE `track_package`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arrived_package`
--
ALTER TABLE `arrived_package`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `dbooking`
--
ALTER TABLE `dbooking`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `dinbox`
--
ALTER TABLE `dinbox`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;

--
-- AUTO_INCREMENT for table `dlocation`
--
ALTER TABLE `dlocation`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `dpackage_registration`
--
ALTER TABLE `dpackage_registration`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `driver_inbox`
--
ALTER TABLE `driver_inbox`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `dstaff_registration`
--
ALTER TABLE `dstaff_registration`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `dstate_registration`
--
ALTER TABLE `dstate_registration`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `duser_registration`
--
ALTER TABLE `duser_registration`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `dvehicle_registration`
--
ALTER TABLE `dvehicle_registration`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `track_package`
--
ALTER TABLE `track_package`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
