-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th9 18, 2024 lúc 08:12 AM
-- Phiên bản máy phục vụ: 10.5.25-MariaDB
-- Phiên bản PHP: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tdichvuinfo_client`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Affiliate`
--

CREATE TABLE `Affiliate` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `referred_user_id` int(11) NOT NULL,
  `commission_amount` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Banks`
--

CREATE TABLE `Banks` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `chutaikhoan` text NOT NULL,
  `sotaikhoan` text NOT NULL,
  `toithieu` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `Banks`
--

INSERT INTO `Banks` (`id`, `name`, `chutaikhoan`, `sotaikhoan`, `toithieu`, `image`) VALUES
(11, 'MBBank', 'BUI DUC THANH', '940765', '10000', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWd8WR9FZqcxpOyeKaiFf-oSXPp17L-K0q6w&s');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `DanhSachCode`
--

CREATE TABLE `DanhSachCode` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `name` text NOT NULL,
  `theme` text NOT NULL,
  `time` text NOT NULL,
  `price` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `DanhSachCode`
--

INSERT INTO `DanhSachCode` (`id`, `username`, `name`, `theme`, `time`, `price`) VALUES
(161, 'cc3m', 'Code Tải Video TikTok No LOGO', '53', '1726480497', '0'),
(162, 'admin12345', 'Code Tải Video TikTok No LOGO', '53', '1726480766', '0'),
(163, 'cmsnt', 'Code Tải Video TikTok No LOGO', '53', '1726482054', '0'),
(164, 'webnguvcl', 'Code Tải Video TikTok No LOGO', '53', '1726486749', '0'),
(165, 'webnguvcl', 'Code Tải Video TikTok No LOGO', '53', '1726496274', '0'),
(166, 'thanhtung95', 'CODE BÁN HOST, DOMAIN, LOGO, TẠO WEBSITE AUTO', '54', '1726510047', '0'),
(167, 'thanhtung95', 'Code Tải Video TikTok No LOGO', '53', '1726510059', '0'),
(168, '1', 'CODE BÁN HOST, DOMAIN, LOGO, TẠO WEBSITE AUTO', '54', '1726510075', '0'),
(169, 'Quangdev', 'CODE BÁN HOST, DOMAIN, LOGO, TẠO WEBSITE AUTO', '54', '1726510337', '0'),
(170, 'huydzaihihi78', 'CODE BÁN HOST, DOMAIN, LOGO, TẠO WEBSITE AUTO', '54', '1726526788', '0'),
(171, 'meosimmyhihi', 'CODE BÁN HOST, DOMAIN, LOGO, TẠO WEBSITE AUTO', '54', '1726575357', '0'),
(172, 'meosimmyhihi', 'CODE BÁN HOST, DOMAIN, LOGO, TẠO WEBSITE AUTO', '54', '1726575393', '0'),
(173, 'meosimmyhihi', 'CODE BÁN HOST, DOMAIN, LOGO, TẠO WEBSITE AUTO', '54', '1726575551', '0'),
(174, 'ntt1235', 'CODE BÁN HOST, DOMAIN, LOGO, TẠO WEBSITE AUTO', '54', '1726576584', '0'),
(175, 'ntt1235', 'CODE BÁN HOST, DOMAIN, LOGO, TẠO WEBSITE AUTO', '54', '1726576949', '0'),
(176, 'luryhost', 'Code Tải Video TikTok No LOGO', '53', '1726586247', '0'),
(177, 'NguyenMinhTien', 'CODE API', '55', '1726587585', '0'),
(178, 'NguyenMinhTien', 'CODE API', '55', '1726588612', '0'),
(179, 'administrator', 'CODE BÁN HOST, DOMAIN, LOGO, TẠO WEBSITE AUTO', '54', '1726590430', '0'),
(180, 'administrator', 'CODE BÁN HOST, DOMAIN, LOGO, TẠO WEBSITE AUTO', '54', '1726591223', '0'),
(181, 'administrator', 'CODE BÁN HOST, DOMAIN, LOGO, TẠO WEBSITE AUTO', '54', '1726591283', '0'),
(182, 'administrator', 'CODE BÁN HOST, DOMAIN, LOGO, TẠO WEBSITE AUTO', '54', '1726591388', '0'),
(183, 'administrator', 'CODE BÁN HOST, DOMAIN, LOGO, TẠO WEBSITE AUTO', '54', '1726591587', '0'),
(184, 'a', 'CODE BÁN HOST, DOMAIN, LOGO, TẠO WEBSITE AUTO', '54', '1726591750', '0'),
(185, 'a', 'CODE BÁN HOST, DOMAIN, LOGO, TẠO WEBSITE AUTO', '54', '1726591922', '0'),
(186, 'a', 'Code website xem phim api phim free (không data)', '48', '1726591949', '50000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `DanhSachHost`
--

CREATE TABLE `DanhSachHost` (
  `id` int(11) NOT NULL,
  `username` text DEFAULT NULL,
  `domain` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `package` text DEFAULT NULL,
  `server` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `time` text DEFAULT NULL,
  `orvertime` text DEFAULT NULL,
  `timesuspended` text DEFAULT NULL,
  `taikhoan` text DEFAULT NULL,
  `matkhau` text DEFAULT NULL,
  `lidokhoa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `DanhSachLogo`
--

CREATE TABLE `DanhSachLogo` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `name` text NOT NULL,
  `status` text NOT NULL,
  `theme` text NOT NULL,
  `time` text NOT NULL,
  `price` text NOT NULL,
  `link` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `DanhSachWeb`
--

CREATE TABLE `DanhSachWeb` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `domain` text NOT NULL,
  `useradmin` text NOT NULL,
  `password` text NOT NULL,
  `status` text NOT NULL,
  `theme` text NOT NULL,
  `time` text NOT NULL,
  `orvertime` text NOT NULL,
  `price` text DEFAULT NULL,
  `exprice` text DEFAULT NULL,
  `timesuspended` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `DataCard`
--

CREATE TABLE `DataCard` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `pin` text NOT NULL,
  `serial` text NOT NULL,
  `amount` text NOT NULL,
  `type` text NOT NULL,
  `status` text NOT NULL,
  `time` text NOT NULL,
  `requestid` text NOT NULL,
  `date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Domain`
--

CREATE TABLE `Domain` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `domain` text NOT NULL,
  `ns` text NOT NULL,
  `hsd` text NOT NULL,
  `status` text NOT NULL,
  `time` text NOT NULL,
  `overtime` text NOT NULL,
  `timedelete` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `DomainPackages`
--

CREATE TABLE `DomainPackages` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` text NOT NULL,
  `image` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Dots`
--

CREATE TABLE `Dots` (
  `id` int(11) NOT NULL,
  `dot` text NOT NULL,
  `price` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `GiaoDien`
--

CREATE TABLE `GiaoDien` (
  `id` int(11) NOT NULL,
  `category` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `images` text NOT NULL,
  `price` text NOT NULL,
  `exprice` text DEFAULT NULL,
  `sold` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `HostPackage`
--

CREATE TABLE `HostPackage` (
  `id` int(11) NOT NULL,
  `disk` text NOT NULL,
  `bandwidth` text NOT NULL,
  `addondomain` text NOT NULL,
  `subdomain` text NOT NULL,
  `server` text NOT NULL,
  `package` text NOT NULL,
  `price` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_cron`
--

CREATE TABLE `list_cron` (
  `id` int(11) NOT NULL,
  `trans_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `server_cron` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `interval_seconds` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `error_count` int(11) DEFAULT 0,
  `response` text DEFAULT NULL,
  `last_cron` datetime DEFAULT NULL,
  `ngay_mua` date NOT NULL,
  `ngay_het` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Logo`
--

CREATE TABLE `Logo` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `price` text NOT NULL,
  `sold` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `MaGiamGia`
--

CREATE TABLE `MaGiamGia` (
  `id` int(11) NOT NULL,
  `service` text DEFAULT NULL,
  `code` text NOT NULL,
  `max` int(11) NOT NULL,
  `sold` int(11) NOT NULL,
  `type` text NOT NULL,
  `amount` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `MaGiamGia`
--

INSERT INTO `MaGiamGia` (`id`, `service`, `code`, `max`, `sold`, `type`, `amount`) VALUES
(34, 'Website', '2FaN31eCnI', 50, 0, 'perce', '10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `MaNguon`
--

CREATE TABLE `MaNguon` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` int(255) NOT NULL,
  `linkcode` text NOT NULL,
  `image` text NOT NULL,
  `images` text DEFAULT NULL,
  `sold` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `MauGiaoDien`
--

CREATE TABLE `MauGiaoDien` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `time_date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Server`
--

CREATE TABLE `Server` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `uname` text DEFAULT NULL,
  `ssl_key` text DEFAULT NULL,
  `backup` text DEFAULT NULL,
  `hostname` text DEFAULT NULL,
  `whmusername` text DEFAULT NULL,
  `whmpassword` text DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `nameserver1` text DEFAULT NULL,
  `nameserver2` text DEFAULT NULL,
  `value` text DEFAULT NULL,
  `ghichu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `server_cron_auto`
--

CREATE TABLE `server_cron_auto` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `count` int(11) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `limit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `server_cron_auto`
--

INSERT INTO `server_cron_auto` (`id`, `name`, `count`, `rate`, `limit`) VALUES
(17, 'Máy chủ 1', 0, 5000, 51),
(18, 'Máy chủ 2', 0, 10000, 21);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `System`
--

CREATE TABLE `System` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `modal` text DEFAULT NULL,
  `affiliate` decimal(5,2) NOT NULL,
  `facebook` text DEFAULT NULL,
  `zalo_group` text DEFAULT NULL,
  `telegram` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `shortcut` text DEFAULT NULL,
  `date_cron` text DEFAULT NULL,
  `sitecard` text DEFAULT NULL,
  `partner_id` text DEFAULT NULL,
  `partner_key` text DEFAULT NULL,
  `token_momo` text DEFAULT NULL,
  `copyright` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `System`
--

INSERT INTO `System` (`id`, `title`, `description`, `keywords`, `modal`, `affiliate`, `facebook`, `zalo_group`, `telegram`, `logo`, `image`, `shortcut`, `date_cron`, `sitecard`, `partner_id`, `partner_key`, `token_momo`, `copyright`) VALUES
(1, 'WEBSITE CHUYÊN CUNG CẤP VPS - HOSTING - MÃ NGUỒN GIÁ RẺ UY TÍN CHẤT LƯỢNG', 'Dịch vụ thiết kế website theo yêu cầu, mua bán mã nguồn, dịch vụ uy tín, hỗ trợ nhiệt tình. Đội ngũ chăm sóc khách hàng 24/24', 'dichvu, dichvu.info , dịch vụ tạo web, bán code, mua code uy tín, dichvu.info, ytb dichvu, tạo website, hướng dẫn làm website, bán clone, api thanh toán, api dichvu, api.dichvu.info, it, làm web, làm shop acc', '', 10.00, 'https://www.facebook.com/bdt.user', 'https://zalo.me/g/dgxeed458', 'https://t.me/BuiDucThanh', '/img/logo.png', '/img/logo.png', '/img/favico.png', '1714899728', 'doithe1s.vn', '59277927943', '75a419e22347f076e75c526fee6a4681', NULL, 'Bản quyền thuộc về chúng tôi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `TranIDMomo`
--

CREATE TABLE `TranIDMomo` (
  `id` int(11) NOT NULL,
  `requestid` text NOT NULL,
  `amount` text NOT NULL,
  `comment` text NOT NULL,
  `time` text NOT NULL,
  `nameBank` text NOT NULL,
  `status` text NOT NULL,
  `date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `money` int(11) DEFAULT 0,
  `remoney` int(11) DEFAULT 0,
  `money_aff` int(11) NOT NULL DEFAULT 0,
  `id_aff` int(11) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `level` enum('admin','member') DEFAULT 'member',
  `band` enum('yes','no') DEFAULT 'no',
  `date_online` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `Users`
--

INSERT INTO `Users` (`id`, `Name`, `username`, `password`, `email`, `money`, `remoney`, `money_aff`, `id_aff`, `ip`, `time`, `level`, `band`, `date_online`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 0, 0, 0, NULL, NULL, 1726474463, 'admin', 'no', 1726592172);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Withdrawal_history`
--

CREATE TABLE `Withdrawal_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `withdrawal_amount` decimal(10,2) NOT NULL,
  `status` enum('Đang chờ xử lý','Đã hoàn thành','Bị từ chối') NOT NULL,
  `withdrawal_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `Affiliate`
--
ALTER TABLE `Affiliate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `referred_user_id` (`referred_user_id`);

--
-- Chỉ mục cho bảng `Banks`
--
ALTER TABLE `Banks`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `DanhSachCode`
--
ALTER TABLE `DanhSachCode`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `DanhSachHost`
--
ALTER TABLE `DanhSachHost`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `DanhSachLogo`
--
ALTER TABLE `DanhSachLogo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `DanhSachWeb`
--
ALTER TABLE `DanhSachWeb`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `DataCard`
--
ALTER TABLE `DataCard`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `Domain`
--
ALTER TABLE `Domain`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `DomainPackages`
--
ALTER TABLE `DomainPackages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `Dots`
--
ALTER TABLE `Dots`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `GiaoDien`
--
ALTER TABLE `GiaoDien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `HostPackage`
--
ALTER TABLE `HostPackage`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `list_cron`
--
ALTER TABLE `list_cron`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `Logo`
--
ALTER TABLE `Logo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `MaGiamGia`
--
ALTER TABLE `MaGiamGia`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `MaNguon`
--
ALTER TABLE `MaNguon`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `MauGiaoDien`
--
ALTER TABLE `MauGiaoDien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `Server`
--
ALTER TABLE `Server`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `server_cron_auto`
--
ALTER TABLE `server_cron_auto`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `System`
--
ALTER TABLE `System`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `TranIDMomo`
--
ALTER TABLE `TranIDMomo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `Withdrawal_history`
--
ALTER TABLE `Withdrawal_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `Affiliate`
--
ALTER TABLE `Affiliate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `Banks`
--
ALTER TABLE `Banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `DanhSachCode`
--
ALTER TABLE `DanhSachCode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT cho bảng `DanhSachHost`
--
ALTER TABLE `DanhSachHost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=437;

--
-- AUTO_INCREMENT cho bảng `DanhSachLogo`
--
ALTER TABLE `DanhSachLogo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `DanhSachWeb`
--
ALTER TABLE `DanhSachWeb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `DataCard`
--
ALTER TABLE `DataCard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `Domain`
--
ALTER TABLE `Domain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `DomainPackages`
--
ALTER TABLE `DomainPackages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `Dots`
--
ALTER TABLE `Dots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `GiaoDien`
--
ALTER TABLE `GiaoDien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `HostPackage`
--
ALTER TABLE `HostPackage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT cho bảng `list_cron`
--
ALTER TABLE `list_cron`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `Logo`
--
ALTER TABLE `Logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `MaGiamGia`
--
ALTER TABLE `MaGiamGia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `MaNguon`
--
ALTER TABLE `MaNguon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `MauGiaoDien`
--
ALTER TABLE `MauGiaoDien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `Name_users`
--
ALTER TABLE `Name_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=688;

--
-- AUTO_INCREMENT cho bảng `Server`
--
ALTER TABLE `Server`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT cho bảng `server_cron_auto`
--
ALTER TABLE `server_cron_auto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `System`
--
ALTER TABLE `System`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `TranIDMomo`
--
ALTER TABLE `TranIDMomo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=696;

--
-- AUTO_INCREMENT cho bảng `Withdrawal_history`
--
ALTER TABLE `Withdrawal_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `Affiliate`
--
ALTER TABLE `Affiliate`
  ADD CONSTRAINT `Affiliate_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Name_users` (`id`),
  ADD CONSTRAINT `Affiliate_ibfk_2` FOREIGN KEY (`referred_user_id`) REFERENCES `Name_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
