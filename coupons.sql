-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2024 年 06 月 05 日 13:49
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `my_test_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `coupons`
--

CREATE TABLE `coupons` (
  `id` int(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(20) NOT NULL,
  `category` varchar(10) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `min_spend_amount` decimal(20,0) DEFAULT NULL,
  `stock` int(3) NOT NULL,
  `status` varchar(5) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `valid` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `code`, `category`, `discount`, `min_spend_amount`, `stock`, `status`, `start_time`, `end_time`, `valid`) VALUES
(1, '冬季特賣紅茶', 'SUWRYF', '百分比', 0.90, 1500, 200, '', '2024-11-01 21:57:00', '2024-12-31 21:57:00', 1),
(2, '入會折扣', 'S3A1C4', '金額', 200.00, 2000, 999, '', '2024-06-03 21:57:00', '2024-12-31 22:00:00', 1),
(3, '茶香滿堂', 'M5DB55', '百分比', 0.92, 2000, 100, '', '2024-06-03 15:00:00', '2024-06-03 15:00:00', 1),
(4, '春季特賣', '2CR2T0', '百分比', 0.85, 5000, 300, '', '2024-03-01 22:01:00', '2024-03-31 22:01:00', 1),
(5, '夏季特賣', 'JZDVGQ', '金額', 100.00, 1500, 300, '', '2024-06-04 09:29:00', '2024-07-31 09:29:00', 1),
(6, '夏季折扣', '6A7VJK', '百分比', 0.92, 2000, 300, '', '2024-06-04 09:30:00', '2024-06-30 09:30:00', 1),
(7, '冬季折扣', 'B7TXXQ', '百分比', 0.92, 2000, 300, '', '2024-11-01 09:31:00', '2025-01-31 09:31:00', 1),
(8, '秋季特賣', '5MFTX2', '金額', 200.00, 2000, 500, '', '2024-09-04 09:32:00', '2024-10-31 09:32:00', 1),
(9, '春季折扣', 'II74R3', '百分比', 0.95, 1000, 500, '', '2024-03-01 10:21:00', '2024-04-30 10:21:00', 1),
(10, '秋季折扣', '3Y1EDF', '金額', 0.95, 2000, 500, '', '2024-09-04 10:23:00', '2024-10-31 10:23:00', 1),
(11, '限時特賣', 'RTPKVK', '百分比', 0.85, 5000, 100, '', '2024-06-04 10:24:00', '2024-06-19 10:24:00', 1),
(12, '茶友專屬', 'G8O4PE', '百分比', 0.80, 5000, 200, '', '2024-07-06 11:57:00', '2024-08-03 11:57:00', 1),
(13, '品茗之樂', 'FP4L3J', '百分比', 0.95, 5000, 200, '', '2024-06-05 11:57:00', '2024-06-19 11:57:00', 1),
(14, '茶韻悠揚', 'TT8GTW', '百分比', 0.80, 900, 200, '', '2024-06-05 11:57:00', '2024-06-05 11:57:00', 1),
(15, '茶趣滿滿', 'MLWPLD', '百分比', 0.95, 10000, 500, '', '2024-06-05 11:57:00', '2024-06-05 11:57:00', 1),
(16, '品茗享優惠', 'L6VYCU', '百分比', 0.80, 100, 200, '', '2024-06-05 11:58:00', '2024-06-06 11:58:00', 1),
(17, '全館優惠', 'FFJO8F', '金額', 1000.00, 5000, 500, '可使用', '2024-06-05 11:58:00', '2024-06-21 11:58:00', 1),
(18, '清香入心', 'WLNEIW', '百分比', 0.95, 900, 100, '', '2024-06-20 11:58:00', '2024-07-05 11:58:00', 1),
(19, '茶藝禮讚', 'ZQDMSZ', '百分比', 0.80, 10000, 200, '', '2024-06-05 11:58:00', '2024-06-27 11:58:00', 1),
(20, '綠茶狂歡節', 'T5LIY5', '金額', 1000.00, 10000, 500, '', '2024-06-05 11:59:00', '2024-06-29 11:59:00', 1),
(21, '茶香四溢', '16X4DQ', '百分比', 0.95, 100, 100, '', '2024-06-05 12:00:00', '2024-06-28 12:00:00', 1),
(22, '茶香撲鼻', 'VRMG5V', '百分比', 0.92, 2000, 200, '可使用', '2024-06-05 12:44:00', '2024-06-08 12:44:00', 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
