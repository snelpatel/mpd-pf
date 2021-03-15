-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2018 at 10:51 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentloan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `id` int(25) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `admin_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`id`, `user_name`, `passwd`, `admin_type`) VALUES
(1, 'nilay', 'b0c251c1f407dd0e9958d161c00ecfd6', 'Administrator'),
(4, 'dhaval', '975ef70ce2dd7ae8dd7de7c930d90d0d', 'Staff'),
(6, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'Administrator'),
(7, 'chinmay', '72264e113943a77136e9a82eecd01274', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `f_name` varchar(25) DEFAULT NULL,
  `m_name` varchar(25) DEFAULT NULL,
  `l_name` varchar(25) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(15) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `pincode` varchar(8) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `passportno` varchar(15) DEFAULT NULL,
  `passportnews` varchar(255) DEFAULT NULL,
  `passportolds` varchar(255) DEFAULT NULL,
  `panno` varchar(15) DEFAULT NULL,
  `pannos` varchar(255) DEFAULT NULL,
  `aadharno` varchar(25) DEFAULT NULL,
  `aadharnos` varchar(255) DEFAULT NULL,
  `resumes` varchar(255) DEFAULT NULL,
  `parentsname` varchar(255) DEFAULT NULL,
  `parentsphone` varchar(255) DEFAULT NULL,
  `parentsemail` varchar(255) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `roi` float NOT NULL,
  `duedate` date NOT NULL,
  `days` int(11) NOT NULL,
  `intrest` int(11) NOT NULL,
  `advancepaid` int(11) NOT NULL,
  `balanceduedate` date NOT NULL,
  `balance` int(11) NOT NULL,
  `bankwithdrawdate` date NOT NULL,
  `tobedepositdate` date NOT NULL,
  `bankdeposit` varchar(255) NOT NULL,
  `depositmode` varchar(255) NOT NULL,
  `bankname` varchar(255) NOT NULL,
  `chequeno` varchar(255) NOT NULL,
  `depositamount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `withdrawn` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `photo`, `f_name`, `m_name`, `l_name`, `gender`, `address`, `city`, `state`, `pincode`, `phone`, `email`, `date_of_birth`, `passportno`, `passportnews`, `passportolds`, `panno`, `pannos`, `aadharno`, `aadharnos`, `resumes`, `parentsname`, `parentsphone`, `parentsemail`, `amount`, `roi`, `duedate`, `days`, `intrest`, `advancepaid`, `balanceduedate`, `balance`, `bankwithdrawdate`, `tobedepositdate`, `bankdeposit`, `depositmode`, `bankname`, `chequeno`, `depositamount`, `created_at`, `updated_at`, `withdrawn`) VALUES
(41, NULL, 'Krishna', 'Jitubhai', 'Shah', 'female', 'Krishna Township', 'Nadiad', 'Gujarat', NULL, '234234234', 'krishna@gmail.com', '1990-12-02', '', NULL, NULL, '', NULL, '', NULL, NULL, '', '', NULL, 0, 0, '0000-00-00', 0, 0, 0, '0000-00-00', 0, '0000-00-00', '2018-11-17', '', '', '', '', 0, '2018-11-14 19:30:00', '2018-11-14 08:04:21', 0),
(43, NULL, 'Ketan', 'Manubhai', 'Dave', 'male', 'Kesav Nagar', 'Nadiad', 'Gujarat', '387001', '9825025', 'kesav@gmail.com', '1990-02-12', '', NULL, NULL, '', NULL, '', NULL, NULL, 'Manubhai Shivabhai Patel', '9825026', '', 0, 0, '2018-12-31', 0, 0, 0, '2018-12-31', 0, '2018-12-30', '2018-11-19', '', '', '', '', 0, '2018-11-14 19:30:00', '2018-10-23 07:20:47', 0),
(44, NULL, 'Jivanlal', 'Maganlal', 'Tandel', 'male', 'College Road', 'Nadiad', 'Gujarat', '387001', '98251', 'jivanlal@gmail.com', '1967-02-10', 'F515522', NULL, NULL, 'AVXPP4471G', NULL, '154544123', NULL, NULL, 'Managanlal Gendalal Tandel', '98253', '', 0, 0, '2018-12-31', 0, 0, 0, '2018-12-31', 0, '2018-11-21', '2018-11-18', '', '', '', '', 0, '2018-11-15 19:30:00', NULL, 0),
(47, NULL, 'Pralaynath', 'Genda', 'Swami', 'male', 'unknwon street', 'Nadiad', 'Gujarat', '387001', '982501', 'paral@gmail.com', '2003-02-10', 'F45124', '1540298324127.0.0.1pdf', '1540298324127.0.0.1pdf', 'AVX234234', '1540298324127.0.0.1png', '234234234', '1540298324127.0.0.145.36.jpeg', '1540298324127.0.0.1doc', 'Gendalal Kuttu Swami', '982551', '', 0, 0, '2018-12-12', 0, 0, 0, '2018-12-12', 0, '2018-12-11', '2018-11-15', '', '', '', '', 0, '2018-11-14 19:30:00', NULL, 0),
(48, '1540299285.jpg', 'Bhupendra', 'Kanubhai', 'Patel', 'male', 'Civil Road', 'Nadiad', 'Gujarat', '387001', '9909722459', 'bhupa28287@gmail.com', '1968-02-10', 'F46412', '1540299285.pdf', '1540299285.pdf', 'Av234234', '1540299285.png', '23423434', '1540299285.png', '1540299285.PDF', 'Kanubhai Patel', '234234234', '', 0, 0, '0000-00-00', 0, 0, 0, '0000-00-00', 0, '0000-00-00', '2018-11-09', '', '', '', '', 0, '2018-10-20 18:30:00', NULL, 0),
(50, '1540366658.jpg', 'Guruom', 'Maheshbhai', 'Desai', 'male', 'F-401, KRISH RESIDENCY, B/H UMA SCHOOL\r\nNIKOL NARODA ROAD', 'AHMEDABAD', 'Gujarat', '382350', '9100000000', 'dhavalpat232@gmail.com', '1982-09-30', 'F315646', '1540366658.png', '1540366658.png', 'AV3424', '1540366658.png', '234234234', '1540366658.pdf', '1540366658.pdf', 'mahesh', '234234', 'none@none.com', 1000000, 1.8, '2018-01-24', 60, 36000, 16000, '2018-01-24', 20000, '2018-11-30', '0000-00-00', 'Student', 'Cheque', 'Bank of Baroda', '464654', 3000, '2018-11-14 19:30:00', '2018-10-14 10:02:53', 0),
(51, '1540368997.png', 'shalin', 'gitu', 'mehta', 'male', '701 levick st', 'philadelphia', 'Gujarat', '19111', '5084442306', 'shalin.mehta@gmail.com', '2010-10-10', 'F131', '1540368997.png', '1540368997.png', 'AV324', '1540368997.png', '234234234', '1540368997.png', '1540368997.png', 'asdfafd', '234234', 'asdf@asdfaf.com', 500000, 1.8, '2018-12-24', 60, 12000, 4000, '2018-12-24', 8000, '2018-11-15', '0000-00-00', 'Student', 'Cheque', 'Bank of Baroda', '464', 4000, '2018-10-22 18:30:00', '2018-10-23 18:30:00', 1),
(52, '1540391347.jpg', 'Jaimin', 'Dhimant', 'Purohit', 'male', 'desai vago', 'Nadiad', 'Gujarat', '387001', '982544', 'jaimin@gmail.com', '1980-10-20', 'F1455454', '1540391347.PDF', '1540391347.PDF', 'AV5555', '1540391347.jpg', '234234234', '1540391347.jpg', '1540391347.PDF', 'Dhimantbhai Purohit', '2344234', '', 1000000, 1.8, '2019-02-24', 123, 73800, 25000, '2019-02-24', 0, '2019-02-26', '0000-00-00', 'Student', 'Cash', '', '', 3000, '2018-10-23 18:30:00', NULL, 1),
(53, '1540794576.jpg', 'test', 'test', 'test', 'male', 'test', 'test', 'Gujarat', '23423', '23423', 'test@aa.com', '1969-02-10', 'F324234', '1540794576.PDF', '1540794576.PDF', '23423423', '1540794576.PDF', '234234', '1540794576.jpg', '1540794576.PDF', 'asdfasdf', '2323434', 'test@tes.com', 500000, 1.8, '2018-12-29', 66, 19800, 800, '2018-12-29', 19000, '2018-12-30', '0000-00-00', 'Self', 'Cheque', 'BOB', '234234', 3000, '2018-10-28 18:30:00', NULL, 0),
(54, '1540794818.jpg', 'test', 'test', 'test', 'male', 'test', 'test', 'Gujarat', '23423', '23423', 'test@aa.com', '1969-02-10', 'F324234', '1540794818.PDF', '1540794818.PDF', '23423423', '1540794818.PDF', '234234', '1540794818.jpg', '1540794818.PDF', 'asdfasdf', '2323434', 'test@tes.com', 500000, 1.8, '2018-12-29', 66, 19800, 800, '2018-12-29', 19000, '2018-12-30', '0000-00-00', 'Self', 'Cheque', 'BOB', '234234', 3000, '2018-10-28 18:30:00', NULL, 0),
(55, '1540797997.jpg', 'test1', 'test1', 'test1', 'male', 'asdfasdf', 'asdfasd', 'Gujarat', '234234', '9879000420', 'asdfa@asdfadf.com', '1990-02-10', '234234', '1540797997.PDF', '1540797997.PDF', 'asdfadf', '1540797997.PDF', '234234', '1540797997.jpg', '1540797997.PDF', 'asdfasdf', '234234', 'PATEL.KEVIN61@YAHOO.COM', 500000, 1.8, '2019-10-20', 361, 108300, 83000, '2019-10-20', 25300, '2019-10-21', '2018-11-09', 'Self', 'Cash', 'NA', 'NA', 3000, '2018-10-28 18:30:00', NULL, 0),
(56, '1540798309.jpg', 'test1', 'test1', 'test1', 'male', 'asdfasdf', 'asdfasd', 'Gujarat', '234234', '9879000420', 'asdfa@asdfadf.com', '1990-02-10', '234234', '1540798309.PDF', '1540798309.PDF', 'asdfadf', '1540798309.PDF', '234234', '1540798309.jpg', '1540798309.PDF', 'asdfasdf', '234234', 'PATEL.KEVIN61@YAHOO.COM', 500000, 1.8, '2019-10-20', 361, 108300, 83000, '2019-10-20', 25300, '2019-10-21', '2018-11-02', 'Self', 'Cash', 'NA', 'NA', 3000, '2018-10-28 18:30:00', NULL, 0),
(57, '1540798433.jpg', 'Test2', 'Test2', 'Test2', 'male', 'Test2', 'Test2', 'Gujarat', '234234', '9879000420', 'none@non.com', '1986-02-10', '234234', '1540798433.PDF', '1540798433.PDF', '2342434', '1540798433.PDF', '234234', '1540798433.PDF', '1540798433.PDF', 'adfadf', '324234234', 'fime@informa.com', 500000, 1.8, '2018-12-29', 66, 19800, 800, '2018-12-29', 19000, '2018-12-29', '2018-11-01', 'Self', 'Cash', 'na', 'na', 3000, '2018-10-28 18:30:00', NULL, 0),
(58, '1540799177.jpg', 'TEst2', 'TEst2', 'TEst2', 'male', 'a-5 sardar park society, bh bhavna flat', 'nadiad', 'Gujarat', '387001', '9879000420', 'rcshahnadiad@gmail.com', '1999-02-20', '23234234', '1540799177.PDF', '1540799177.PDF', '234234', '1540799177.PDF', '234234234', '1540799177.PDF', '1540799177.PDF', 'asdfasdf', '23423423', 'mrugeshdesai1787@gmail.com', 500000, 1.8, '2018-10-29', 5, 1500, 500, '2018-10-29', 1000, '2018-10-20', '2018-11-01', 'Self', 'Cash', 'na', 'na', 3000, '2018-10-28 18:30:00', NULL, 0),
(59, '1540799549.jpg', 'TEst2', 'TEst2', 'TEst2', 'male', 'a-5 sardar park society, bh bhavna flat', 'nadiad', 'Gujarat', '387001', '9879000420', 'rcshahnadiad@gmail.com', '1999-02-20', '23234234', '1540799549.PDF', '1540799549.PDF', '234234', '1540799549.PDF', '234234234', '1540799549.PDF', '1540799549.PDF', 'asdfasdf', '23423423', 'mrugeshdesai1787@gmail.com', 500000, 1.8, '2018-10-29', 5, 1500, 500, '2018-10-29', 1000, '2018-10-20', '2018-11-01', 'Self', 'Cash', 'na', 'na', 3000, '2018-10-28 18:30:00', NULL, 0),
(60, '1540800545.jpg', 'Test1', 'Test1', 'Test1', 'male', 'Test1', 'Test1', 'Gujarat', '34234', '9879000420', 'vaishu73@att.net', '2018-10-20', '23423423', '1540800545.PDF', '1540800545.PDF', '234234234', '1540800545.PDF', '4234234', '1540800545.PDF', '1540800545.PDF', 'asfasdfasfd', '23234234', 'bhupa28287@gmail.com', 500000, 1.8, '2018-12-29', 66, 19800, 800, '2018-12-29', 19000, '2018-12-29', '2018-10-31', 'Self', 'Cash', 'na', 'na', 3000, '2018-10-28 18:30:00', NULL, 1),
(61, '1540802307.jpg', 'BHUPENDRA', 'Kanubhai', 'PATEL', 'male', '12 A  BLOCK B NAVKAR FLATS, BH KIDNEY\r\nHOSPITAL', 'Nadiad', 'Gujarat', '387001', '9879000420', 'bhupa28287@gmail.com', '1969-01-20', 'F23423423', '1540802307.PDF', '1540802307.PDF', 'AV324234', '1540802307.PDF', '234234234234', '1540802307.PDF', '1540802307.PDF', 'Kanubhai PATEL', '2234234', 'kanubhai@gmail.com', 1000000, 1.8, '2018-12-29', 66, 39600, 9600, '2018-12-29', 30000, '2018-12-30', '2018-10-31', 'Self', 'Cash', 'NA', 'NA', 3000, '2018-10-28 18:30:00', NULL, 0),
(62, '1540964492.png', 'Shailin', 'Kirit', 'Patel', 'male', '701 levick st', 'Nadiad', 'Gujarat', '19111', '5084442306', 'shalin.mehta@gmail.com', '1982-10-20', '24234234', '1540964492.png', '1540964492.png', 'AF324', '1540964492.png', '234234234', '1540964492.png', '1540964492.png', 'Kirit Patel', '9879000420', 'kirit@gmail.com', 1000000, 1.8, '2018-12-31', 68, 40800, 800, '2018-12-31', 40000, '2019-01-01', '2018-11-02', 'Student', 'Cash', 'NA', 'NA', 3000, '2018-10-30 18:30:00', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `paiddate` date NOT NULL,
  `remarks` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `studentid`, `amount`, `paiddate`, `remarks`) VALUES
(3, 52, 48800, '2018-11-15', 'cash payment');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
