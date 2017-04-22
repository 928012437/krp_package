-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-04-22 10:14:24
-- 服务器版本： 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `we7`
--

-- --------------------------------------------------------

--
-- 表的结构 `ims_krp_package_good`
--

CREATE TABLE `ims_krp_package_good` (
  `id` int(10) NOT NULL,
  `uniacid` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `kucun` int(10) NOT NULL,
  `probability` int(10) NOT NULL,
  `imgurl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- 表的结构 `ims_krp_package_set`
--

CREATE TABLE `ims_krp_package_set` (
  `id` int(10) NOT NULL,
  `uniacid` int(10) NOT NULL,
  `actname` varchar(20) NOT NULL,
  `starttime` int(20) NOT NULL,
  `endtime` int(20) NOT NULL,
  `opportunity` int(10) NOT NULL,
  `roundmin` int(10) NOT NULL,
  `roundmax` int(10) NOT NULL,
  `okgoodnum` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- 表的结构 `ims_krp_package_user`
--

CREATE TABLE `ims_krp_package_user` (
  `id` int(10) NOT NULL,
  `uniacid` int(10) NOT NULL,
  `openid` varchar(32) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `headimgurl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-----------------------------------------

--
-- 表的结构 `ims_krp_package_winlist`
--

CREATE TABLE `ims_krp_package_winlist` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `uniacid` int(10) NOT NULL,
  `goodid` int(10) NOT NULL,
  `time` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `ims_krp_package_good`
--
ALTER TABLE `ims_krp_package_good`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_krp_package_set`
--
ALTER TABLE `ims_krp_package_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_krp_package_user`
--
ALTER TABLE `ims_krp_package_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_krp_package_winlist`
--
ALTER TABLE `ims_krp_package_winlist`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--
