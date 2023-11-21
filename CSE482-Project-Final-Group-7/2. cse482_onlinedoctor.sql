-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 08:15 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cse482_onlinedoctor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin@admin.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `aptID` int(10) NOT NULL,
  `pID` int(10) DEFAULT NULL,
  `dID` int(11) NOT NULL,
  `aptDate` datetime DEFAULT NULL,
  `completed` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`aptID`, `pID`, `dID`, `aptDate`, `completed`) VALUES
(100028, 20000, 10012, '2023-06-03 06:30:00', 0),
(100029, 20000, 10011, '2023-06-01 08:30:00', 1),
(100030, 20001, 10011, '2023-06-03 03:00:00', 0),
(100031, 20000, 10014, '2023-05-30 06:30:00', 1),
(100032, 20000, 10009, '2023-05-28 02:00:00', 1),
(100033, 20001, 10009, '2023-05-29 03:00:00', 0),
(100034, 20002, 10009, '2023-05-28 04:30:00', 1),
(100035, 20003, 10009, '2023-05-28 04:30:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctortable`
--

CREATE TABLE `doctortable` (
  `id` int(10) NOT NULL,
  `fullname` varchar(250) DEFAULT NULL,
  `phone` bigint(11) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `specialization` varchar(250) DEFAULT NULL,
  `password` varchar(259) DEFAULT NULL,
  `description` varchar(8000) DEFAULT NULL,
  `imgLoc` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctortable`
--

INSERT INTO `doctortable` (`id`, `fullname`, `phone`, `email`, `specialization`, `password`, `description`, `imgLoc`) VALUES
(10009, 'Dr. Md.  Towhiduzzaman', 1711111118, 'towhid@gmail.com', 'Cardiologist', 'towhiduzzaman', 'Dr. Towhiduzzaman graduated with MBBS degree in January 1994 from Sher-e-Bangla Medical College, Barisal and Doctor of Medicine (MD) in Cardiology degree   in January 2002 from National Institute of Cardiovascular diseases (NICVD) under university of Dhaka.', 'Doctor8.jpg'),
(10010, 'Dr. Reazur Rahman', 1711111117, 'rahman@gmail.com', 'Cardiologist', 'reazurrahman', 'Dr. Reazur Rahman passed MBBS in 1994 from Sir Salimullah Medical College under University of Dhaka. He did DTM&H from Mahidol University, Bangkok in 1996. He completed his D-Card from Dhaka University in 2006. He worked in National Heart Foundation Hospital from 2000 to 2005. After that he joined in United Hospital in 2006.\n\n ', 'Doctor7.jpg'),
(10011, 'Dr. Sayeda  Shabnam Malik ', 1711111116, 'malik@gmail.com', 'Medicine', 'shabnammalik', 'DR. Sayeda Shabnam Malik graduated from Sir Salimullah Medical College, Dhaka. She pursued her career in Surgery and completed her surgical training in Mitford Hospital and Dhaka Medical College Hospital. She has been awarded Fellowship (FCPS, Surgery) by BCPS (Bangladesh College of \n\nPhysicians and Surgeons). To further increase her knowledge, she availed Membership (MRCS) of Royal College of Surgeons, UK. ', 'Doctor6.jpg'),
(10012, 'Dr. A K M  Mohiuddin', 1711111116, 'mohiuddin@gmail.com', 'Medicine', 'mohiuddin', 'Dr. A K M Mohiuddin graduated with MBBS (DMC), MS (Ortho), FACS (USA), Fellow Hand, Upper Limb & Microsurgery (Thailand), Fellow Hip & Knee Joint Replacement Surgery (India)', 'Doctor5.jpg'),
(10013, 'DR. Aminul Hashan', 1711111115, 'hashan@gmail.com', 'Orthopedics', 'aminulhashan', 'Dr. Aminul Hashan  graduated (MBBS) in 1981 from Rajshahi Medical College and the joined in government services in Bangladesh.  He received his Diploma in Orthopedic surgery in 1990 from the University of Vienna Austria and achieved specialization in orthopedics surgery (Facharzt).\n\nHe completed Fellowship of Austrian Medical Association (FAMA and worked as a research Fellow in Spine at A. I. DuPont Institute at Wilmington, Delaware, USA. Later Dr. Fazlul Hoque joined in Centre for the Rehabilitation of Paralyzed (CRP), Savar, Dhaka. He worked at CRP about 13 years as a Consultant, Orthopedics & Spine Surgery which was followed to as Medical Director.', 'Doctor4.jpg'),
(10014, 'Dr. M A Mamun', 1711111115, 'mamun@gmail.com', 'Orthopedics', 'mamamuna', 'Dr. M A Mamun graduated from Dhaka Medical College and later did his MS in Orthopedic from National Institute of Trauma &Orthopedic Rehabilitation (NITOR), Dhaka. He also completed AO advance course in trauma from Malaysia.', 'Doctor3.jpg'),
(10015, 'Prof. Dr.  Kaniz Fatema', 1711111112, 'kaniz@gmail.com', 'Gynocologist', 'kanizfatema', 'Prof. Dr. Kaniz Fatema is a medical graduate from Mymensingh Medical College. She obtained her FCPS in Obstetrics and Gynaecology from Bangladesh College Of Physicians And Surgeons in the year 2011.', 'Doctor2.jpg'),
(10016, 'Dr. Alif Uddin', 1711111111, 'alif@gmail.com', 'Gynocologist', 'alifuddin', 'Dr. Alif Uddin Prof. Dr. AHM Touhidul Anowar Chowdhury, commonly known as Prof. Dr. TA Chowdhury, is a legendary Bangladeshi gynecologist and obstetrician. His qualification is MBBS, FRCS, FRCOG, FRCP, FCPS (PK), FCPS (BD). He is a Senior Consultant in the Department of Gynecology & Obstetrics at Birdem General Hospital & Ibrahim Medical College. He regularly provides treatment to his patients at Farida Clinic, Dhaka.', 'Doctor1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `patienttable`
--

CREATE TABLE `patienttable` (
  `id` int(10) NOT NULL,
  `fullname` varchar(250) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patienttable`
--

INSERT INTO `patienttable` (`id`, `fullname`, `phone`, `email`, `password`) VALUES
(20000, 'Numaer M. Islam', '01713375701', 'turjo@gmail.com', 'password-turjo'),
(20001, 'Shazzad Ali Shozol', '01713375702', 'shozol@gmail.com', 'password-shozol'),
(20002, 'Md. Baktiyar-Ul-Alam', '01713375703', 'sagar@gmail.com', 'password-sagar'),
(20003, 'Swobaat Reeswa', '01713375704', 'swobaat@gmail.com', 'password-swobaat'),
(20009, 'Nuha Islam', '01713375789', 'nuha@gmail.com', 'password-nuha');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`aptID`);

--
-- Indexes for table `doctortable`
--
ALTER TABLE `doctortable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patienttable`
--
ALTER TABLE `patienttable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `aptID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100036;

--
-- AUTO_INCREMENT for table `doctortable`
--
ALTER TABLE `doctortable`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10017;

--
-- AUTO_INCREMENT for table `patienttable`
--
ALTER TABLE `patienttable`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20010;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
