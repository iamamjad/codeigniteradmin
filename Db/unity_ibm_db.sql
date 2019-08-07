-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 07, 2019 at 05:53 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unity_ibm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset_management_animations`
--

CREATE TABLE `asset_management_animations` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `animations_url` varchar(128) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset_management_animations`
--

INSERT INTO `asset_management_animations` (`id`, `name`, `animations_url`, `date_created`, `date_modified`) VALUES
(1, 'Abc', 'https://github.com/ketoo/NoahGameFrame', '2019-07-29', '2019-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `asset_management_materials`
--

CREATE TABLE `asset_management_materials` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `materials_url` varchar(128) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `asset_management_models`
--

CREATE TABLE `asset_management_models` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `model_url` varchar(128) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `asset_management_music_track`
--

CREATE TABLE `asset_management_music_track` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `music_tracks_url` varchar(128) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `asset_management_shaders`
--

CREATE TABLE `asset_management_shaders` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `shaderFileName` varchar(64) NOT NULL,
  `shaders_path` varchar(128) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset_management_shaders`
--

INSERT INTO `asset_management_shaders` (`id`, `name`, `shaderFileName`, `shaders_path`, `date_created`) VALUES
(1, 'shader test', 'Works_w27-29_Amjad.pdf', 'http://localhost/unityibm/upload/Works_w27-29_Amjad.pdf', '2019-08-07 03:45:38'),
(2, 'Final done', 'wk31-32_tasks.pdf', 'http://localhost/unityibm/upload/wk31-32_tasks.pdf', '2019-08-07 03:47:27'),
(3, 'Final done', 'Tasks_for_wk29.txt', 'http://localhost/unityibm/upload/Tasks_for_wk29.txt', '2019-08-07 03:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `asset_management_skybox`
--

CREATE TABLE `asset_management_skybox` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `skyBox_url` varchar(128) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `asset_management_sound_effects`
--

CREATE TABLE `asset_management_sound_effects` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `sounds_effects` varchar(128) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`id`, `name`, `email`, `password`, `date_created`, `date_modified`) VALUES
(1, 'logan', 'logan@dontbelieveinstyle.com', '123456', '2019-08-06 04:10:23', '0000-00-00 00:00:00'),
(2, 'Amjad', 'admin', 'admin', '2019-08-06 04:24:07', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset_management_animations`
--
ALTER TABLE `asset_management_animations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_management_materials`
--
ALTER TABLE `asset_management_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_management_models`
--
ALTER TABLE `asset_management_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_management_music_track`
--
ALTER TABLE `asset_management_music_track`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_management_shaders`
--
ALTER TABLE `asset_management_shaders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_management_skybox`
--
ALTER TABLE `asset_management_skybox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_management_sound_effects`
--
ALTER TABLE `asset_management_sound_effects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset_management_animations`
--
ALTER TABLE `asset_management_animations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asset_management_materials`
--
ALTER TABLE `asset_management_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_management_models`
--
ALTER TABLE `asset_management_models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_management_music_track`
--
ALTER TABLE `asset_management_music_track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_management_shaders`
--
ALTER TABLE `asset_management_shaders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `asset_management_skybox`
--
ALTER TABLE `asset_management_skybox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_management_sound_effects`
--
ALTER TABLE `asset_management_sound_effects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
