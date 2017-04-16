-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-03-17 08:06:24
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testbank`
--

-- --------------------------------------------------------

--
-- 表的结构 `timu`
--

CREATE TABLE `timu` (
  `id` int(11) NOT NULL,
  `question` varchar(300) NOT NULL,
  `answer` varchar(500) NOT NULL,
  `correct` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `timu`
--

INSERT INTO `timu` (`id`, `question`, `answer`, `correct`) VALUES
(1, '单处理机系统中，可并行的是（） <p></p>\r\nⅠ进程与进程  Ⅱ处理机与设备 Ⅲ处理机与通道 Ⅳ设备与设备 ', 'A．Ⅰ、Ⅱ和Ⅲ ###B．Ⅰ、Ⅱ和Ⅳ ###C．Ⅰ、Ⅲ和Ⅳ ###D．Ⅱ、Ⅲ和Ⅳ ', 'D'),
(2, '下列进程调度算法中，综合考虑进程等待时间和执行时间的是（） ', 'A．时间片轮转调度算法 ###B．短进程优先调度算法 ###C．先来先服务调度算法 ###D．高响应比优先调度算法 ', 'D'),
(3, '某计算机系统中有 8 台打印机，由 K 个进程竞争使用，每个进程最多需要 3 台打印机。该系统 可能会发生死锁的 K 的最小值是（）', 'A．2    ###B．3    ###C．4    ###D．5 ', 'C'),
(4, '分区分配内存管理方式的主要保护措施是（） ', 'A．界地址保护  ###B．程序代码保护 ###C．数据保护 ###D．栈保护 ', 'A'),
(5, '一个分段存储管理系统中，地址长度为 32 位，其中段号占 8 位，则最大段长是（）', 'A．2<sup>8</sup>B      ###B．2<sup>16</sup>B     ###C．2<sup>24</sup>B    ###D．2<sup>32</sup>B ', 'C'),
(6, '下列文件物理结构中，适合随机访问且易于文件扩展的是（）', 'A．连续结构   ###B．索引结构 ###C．链式结构且磁盘块定长 ###D．链式结构且磁盘块变长 ', 'B'),
(7, '假设磁头当前位于第 105 道，正在向磁道序号增加的方向移动。现有一个磁道访问请求序列为 35，45，12，68，110，180，170，195，采用 SCAN 调度（电梯调度）算法得到的磁道访问序列是（）', 'A．110，170，180，195，68，45，35，12  ###B．110，68，45，35，12，170，180，195 ###C．110，170，180，195，12，35，45，68  ###D．12，35，45，68，110，170，180，195 ', 'A'),
(8, '文件系统中，文件访问控制信息存储的合理位置是 （）', 'A．文件控制块 ###B．文件分配表 ###C．用户口令表 ###D．系统注册表 ', 'A'),
(9, '设文件 F1 的当前引用计数值为 1，先建立 F1 的符号链接（软链接）文件 F2，再建立 F1 的硬 链接文件 F3，然后删除 F1。此时，F2 和 F3 的引用计数值分别是（）', 'A．0、1   ###B．1、1  ### C．1、2 ###  D．2、1 ', 'B'),
(10, '程序员利用系统调用打开 I/O 设备时，通常使用的设备标识是（）', 'A．逻辑设备名 ###B．物理设备名 ###C．主设备号  ###D．从设备号 ', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `timu`
--
ALTER TABLE `timu`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `timu`
--
ALTER TABLE `timu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
