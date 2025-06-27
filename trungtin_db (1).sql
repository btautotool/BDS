-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 27, 2025 lúc 10:07 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `trungtin_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `albums`
--

CREATE TABLE `albums` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Tin hành chính', 'tin-hanh-chinh', 'tin-hanh-chinh-2025-04-21-5e9e4f9d7da0d.jpg', '2025-04-20 18:42:53', '2025-04-20 18:42:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_post`
--

CREATE TABLE `category_post` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category_post`
--

INSERT INTO `category_post` (`id`, `category_id`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-04-20 18:44:02', '2025-04-20 18:44:02'),
(2, 1, 2, '2025-04-20 18:45:11', '2025-04-20 18:45:11'),
(4, 1, 4, '2025-06-23 02:00:20', '2025-06-23 02:00:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` int(11) NOT NULL,
  `commentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) DEFAULT NULL,
  `approved` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `features`
--

CREATE TABLE `features` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `features`
--

INSERT INTO `features` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Garage', 'garage', '2025-04-20 18:01:31', '2025-04-20 18:01:31'),
(2, 'Bể bơi', 'be-boi', '2025-04-20 18:01:39', '2025-04-20 18:01:39'),
(3, 'Bida', 'bida', '2025-06-18 07:55:29', '2025-06-18 07:55:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feature_property`
--

CREATE TABLE `feature_property` (
  `id` int(10) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `feature_property`
--

INSERT INTO `feature_property` (`id`, `property_id`, `feature_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-04-20 18:10:39', '2025-04-20 18:10:39'),
(2, 2, 1, '2025-04-20 18:22:58', '2025-04-20 18:22:58'),
(3, 3, 1, '2025-04-20 18:27:39', '2025-04-20 18:27:39'),
(4, 4, 1, '2025-05-08 01:40:42', '2025-05-08 01:40:42'),
(5, 5, 1, '2025-05-08 01:59:29', '2025-05-08 01:59:29'),
(6, 6, 1, '2025-05-08 02:20:29', '2025-05-08 02:20:29'),
(7, 7, 1, '2025-05-08 18:32:38', '2025-05-08 18:32:38'),
(8, 7, 2, '2025-05-08 18:32:38', '2025-05-08 18:32:38'),
(9, 8, 1, '2025-05-09 00:50:56', '2025-05-09 00:50:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `galleries`
--

CREATE TABLE `galleries` (
  `id` int(10) UNSIGNED NOT NULL,
  `album_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `agent_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`id`, `agent_id`, `user_id`, `property_id`, `name`, `time`, `email`, `phone`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 3, 'Người', NULL, 'user@user.com', '0865529961', 'ngay mai 8h', 1, '2025-05-08 01:35:09', '2025-06-22 23:48:38'),
(23, 2, 2, 6, 'Tin', '2025-05-22T20:44', 'nguyentrungtin717@gmail.com', '0333582495', 'ok', 0, '2025-06-22 09:56:39', '2025-06-22 09:56:39'),
(24, 2, 2, 8, 'Trung Tin', '2025-06-27T23:50', 'nguyentrungtin417@gmail.com', '0333582495', '9h ngay mai', 0, '2025-06-23 01:49:43', '2025-06-23 01:49:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_10_12_000000_create_users_table', 1),
(2, '2025_10_12_100000_create_password_resets_table', 1),
(3, '2025_05_07_134045_create_roles_table', 1),
(4, '2025_05_09_054206_create_tags_table', 1),
(5, '2025_05_09_135424_create_categories_table', 1),
(6, '2025_05_10_171517_create_posts_table', 1),
(7, '2025_05_10_172731_create_category_post_table', 1),
(8, '2025_05_10_172800_create_post_tag_table', 1),
(9, '2025_05_19_134221_create_features_table', 1),
(10, '2025_05_19_134753_create_feature_property_table', 1),
(11, '2025_07_06_171008_create_property_image_galleries_table', 1),
(12, '2025_07_18_042846_create_galleries_table', 1),
(13, '2025_08_12_081814_create_sliders_table', 1),
(14, '2025_08_12_113108_create_testimonials_table', 1),
(15, '2025_08_12_142529_create_albums_table', 1),
(16, '2025_08_15_194359_create_messages_table', 1),
(17, '2025_08_20_070748_create_settings_table', 1),
(18, '2025_08_24_073322_create_properties_table', 1),
(19, '2025_08_25_110649_create_comments_table', 1),
(20, '2025_09_04_183409_create_ratings_table', 1),
(21, '2025_04_20_180257_add_is_report_column_to_users_table', 1),
(22, '2025_04_20_190439_add_reason_column_to_users_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `image`, `body`, `view_count`, `status`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, 1, 'AI CÓ QUYỀN THỪA KẾ KHI ĐẤT ÔNG BÀ ĐỂ LẠI KHÔNG DI CHÚC?', 'ai-co-quyen-thua-ke-khi-dat-ong-ba-de-lai-khong-di-chuc', 'ai-co-quyen-thua-ke-khi-dat-ong-ba-de-lai-khong-di-chuc-2020-04-21-5e9e4fe22f922.jpg', '<h1>Ai c&oacute; quyền thừa kế khi đất &ocirc;ng b&agrave; để lại kh&ocirc;ng di ch&uacute;c?</h1>\r\n<h2>Gia đ&igrave;nh chị Ngọc c&oacute; 3 anh em đều đ&atilde; lập gia đ&igrave;nh v&agrave; ra ở ri&ecirc;ng. Nay bố mẹ chị mất nhưng kh&ocirc;ng để lại di ch&uacute;c, vậy mảnh đất của &ocirc;ng b&agrave; để lại cho con ch&aacute;u sẽ được chia quyền thừa kế như thế n&agrave;o?</h2>\r\n<p>Theo Bộ luật D&acirc;n sự 2015, trường hợp người để lại di sản thừa kế chết m&agrave; kh&ocirc;ng để lại di ch&uacute;c th&igrave; di sản thừa kế được chia theo c&aacute;c h&agrave;ng, những người c&ugrave;ng h&agrave;ng được hưởng phần thừa kế bằng nhau. Thứ tự c&aacute;c h&agrave;ng như sau:</p>\r\n<ul>\r\n<li>H&agrave;ng thừa kế thứ nhất gồm: vợ, chồng, cha đẻ, mẹ đẻ, cha nu&ocirc;i, mẹ nu&ocirc;i, con đẻ, con nu&ocirc;i của người chết.</li>\r\n<li>H&agrave;ng thừa kế thứ hai gồm: &ocirc;ng nội, b&agrave; nội, &ocirc;ng ngoại, b&agrave; ngoại, anh ruột, chị ruột, em ruột của người chết; ch&aacute;u ruột của người chết m&agrave; người chết l&agrave; &ocirc;ng nội, b&agrave; nội, &ocirc;ng ngoại, b&agrave; ngoại.</li>\r\n<li>H&agrave;ng thừa kế thứ ba gồm: cụ nội, cụ ngoại của người chết; b&aacute;c ruột, ch&uacute; ruột, cậu ruột, c&ocirc; ruột, d&igrave; ruột của người chết; ch&aacute;u ruột của người chết m&agrave; người chết l&agrave; b&aacute;c ruột, ch&uacute; ruột, cậu ruột, c&ocirc; ruột, d&igrave; ruột, chắt ruột của người chết m&agrave; người chết l&agrave; cụ nội, cụ ngoại.</li>\r\n</ul>\r\n<p>Lưu &yacute;, những người ở h&agrave;ng sau chỉ được hưởng thừa kế nếu kh&ocirc;ng c&ograve;n ai ở h&agrave;ng trước (do đ&atilde; chết, kh&ocirc;ng c&oacute; quyền hưởng thừa kế, bị truất quyền thừa kế hoặc từ chối nhận thừa kế). Như vậy, với trường hợp của gia đ&igrave;nh chị Ngọc, 3 anh em chị sẽ được chia quyền thừa kế ngang bằng nhau, tức l&agrave; mỗi người được hưởng 1/3 gi&aacute; trị mảnh đất m&agrave; bố mẹ để lại (kh&ocirc;ng di ch&uacute;c).</p>\r\n<p>B&ecirc;n cạnh việc được hưởng quyền lợi, 3 anh em chị Ngọc l&agrave; người thừa kế n&ecirc;n sẽ phải thực hiện nghĩa vụ t&agrave;i sản trong phạm vi di sản do bố mẹ để lại, trừ trường hợp c&oacute; thỏa thuận kh&aacute;c.</p>\r\n<p>Về thủ tục ph&acirc;n chia đất thừa kế, trước hết sẽ họp mặt gia đ&igrave;nh để c&ocirc;ng bố về c&aacute;ch thức ph&acirc;n chia tr&ecirc;n cơ sở quy định của ph&aacute;p luật (Bộ luật d&acirc;n sự năm 2015). Sau khi đ&atilde; thỏa thuận được về vấn đề ph&acirc;n chia di sản thừa kế th&igrave; bạn cần l&agrave;m thủ tục khai nhận di sản thừa kế tại tổ chức h&agrave;nh nghề c&ocirc;ng chứng theo Điều 58 Luật c&ocirc;ng chứng 2014.</p>\r\n<p>Một số giấy tờ anh em chị Ngọc cần chuẩn bị để ho&agrave;n thiện thủ tục n&agrave;y bao gồm: Văn bản thỏa thuận ph&acirc;n chia đất giữa c&aacute;c anh chị em trong gia đ&igrave;nh; Giấy chứng nhận quyền sử dụng đất, quyền sở hữu nh&agrave; v&agrave; c&aacute;c t&agrave;i sản kh&aacute;c gắn liền với đất (đứng t&ecirc;n bố mẹ chị Ngọc); Giấy chứng tử v&agrave; giấy tờ t&ugrave;y th&acirc;n của bố mẹ chị Ngọc; Giấy tờ t&ugrave;y th&acirc;n của 3 anh em chị Ngọc; Giấy tờ chứng minh quan hệ của người để lại t&agrave;i sản thừa kế v&agrave; người được hưởng thừa kế theo quy định của ph&aacute;p luật thừa kế&hellip;</p>', 4, 1, 1, '2025-04-20 18:44:02', '2025-06-22 23:41:53'),
(2, 1, 'Ở CHUNG CƯ HẠNG SANG: KHẨU VỊ MỚI CỦA GIỚI NHÀ GIÀU SÀI GÒN', 'o-chung-cu-hang-sang-khau-vi-moi-cua-gioi-nha-giau-sai-gon', 'o-chung-cu-hang-sang-khau-vi-moi-cua-gioi-nha-giau-sai-gon-2020-04-21-5e9e50271b76d.jpg', '<p class=\"sapo\"><strong>Kh&aacute;ch h&agrave;ng thuộc giới nh&agrave; gi&agrave;u tại th&agrave;nh phố Hồ Ch&iacute; Minh hiện nay đang hướng tới ph&acirc;n kh&uacute;c chung cư hạng sang sở hữu vị tr&iacute; đắc địa c&ugrave;ng những tiện &iacute;ch đặc quyền.</strong></p>\r\n<p>Theo b&aacute;o c&aacute;o thị trường BĐS TPHCM 6 th&aacute;ng đầu năm được Hội m&ocirc;i giới BĐS Việt Nam c&ocirc;ng bố mới đ&acirc;y, tỷ lệ hấp thụ ph&acirc;n kh&uacute;c căn hộ chung cư cao cấp tại S&agrave;i G&ograve;n đang c&oacute; sự biến động mạnh mẽ.</p>\r\n<p>Nếu trong năm 2018, ph&acirc;n kh&uacute;c căn hộ chung cư cao cấp, si&ecirc;u cao cấp tỷ lệ hấp thụ chỉ khoảng gần 64% th&igrave; đến qu&yacute; 2/2019 con số n&agrave;y đ&atilde; tăng đ&aacute;ng kể l&ecirc;n mức 81,3%, dẫn đầu sức thanh khoản tr&ecirc;n to&agrave;n thị trường</p>\r\n<p><img src=\"https://www.finhou.com/Resource/Blogs/Thumbnails/106/4184/o-chung-cu-hang-sang-khau-vi-moi-cua-gioi-nha-giau-sai-gon-4184.png\" alt=\"\" width=\"597\" height=\"295\" /></p>\r\n<p>Nhận định về ph&acirc;n kh&uacute;c cao cấp d&ugrave; đắt tiền nhưng vẫn dễ b&aacute;n, &ocirc;ng Nguyễn Văn Đ&iacute;nh, Ph&oacute; tổng thư k&yacute; Hội m&ocirc;i giới BĐS Việt Nam cho rằng do quỹ đất ở nội đ&ocirc; c&ograve;n rất &iacute;t n&ecirc;n c&aacute;c chủ đầu tư thường chọn phương &aacute;n l&agrave;m nh&agrave; cao cấp, hơn nữa với những dự &aacute;n như vậy, họ c&oacute; thể đầu tư hơn chăm ch&uacute;t hơn, tạo ra sự kh&aacute;c biệt, n&eacute;t đặc sắc v&agrave; điểm nhấn thu h&uacute;t kh&aacute;ch h&agrave;ng.</p>\r\n<p>C&ograve;n theo b&agrave; V&otilde; Thị Kh&aacute;nh Trang - Trưởng bộ phận nghi&ecirc;n cứu tư vấn Savills thị trường căn hộ hạng sang v&agrave; cao cấp thực sự hiện nay c&oacute; sức ti&ecirc;u thụ kh&aacute; tốt. Đối tượng hướng tới của loại h&igrave;nh sản phẩm n&agrave;y l&agrave; kh&aacute;ch h&agrave;ng mua căn hộ cao cấp ngo&agrave;i người Việt Nam th&igrave; c&ograve;n c&oacute; cả những người nước ngo&agrave;i. Những kh&aacute;ch h&agrave;ng l&agrave; người nước thường muốn sống trong những khu chung cư cao cấp, hạng sang với những y&ecirc;u cầu khắt khe về tiện &iacute;ch.</p>\r\n<p>Ở một kh&iacute;a cạnh kh&aacute;c, nhiều chuy&ecirc;n gia cũng cho rằng tầng lớp trung lưu ở Việt Nam đang gia tăng nhanh ch&oacute;ng l&agrave; đ&ograve;n bẩy th&uacute;c đẩy ph&acirc;n kh&uacute;c BĐS cao cấp v&agrave; hạng sang ph&aacute;t triển. Căn hộ hạng sang l&agrave; sự t&iacute;ch hợp tất cả trong một những tiện &iacute;ch đạt ti&ecirc;u chuẩn 5 sao, kết nối mọi kh&ocirc;ng gian sống v&agrave; đem đến cho cư d&acirc;n một thi&ecirc;n đường sống ngay tại nh&agrave; vẫn l&agrave; những sản phẩm tạo được sức h&uacute;t tr&ecirc;n thị trường.</p>\r\n<p>Quan s&aacute;t thực tế tr&ecirc;n thị trường BĐS TPHCM thời gian gần đ&acirc;y c&oacute; thể thấy, nhiều chủ đầu tư lớn đang tạo ra những sản phẩm bất động sản cao cấp kh&aacute;c biệt, phục vụ \"khẩu vị\" ng&agrave;y c&agrave;ng thay đổi của giới nh&agrave; gi&agrave;u thời gian gần đ&acirc;y.</p>\r\n<p><img src=\"https://www.finhou.com/Resource/Blogs/Thumbnails/106/4185/o-chung-cu-hang-sang-khau-vi-moi-cua-gioi-nha-giau-sai-gon-4185.jpg\" alt=\"\" width=\"600\" height=\"323\" /></p>\r\n<p>C&oacute; thể kể đến như căn hộ mang thương hiệu Branded Residence (căn hộ c&oacute; thương hiệu quốc tế) tại dự &aacute;n D1mension của CapitaLand.&nbsp;Đặt cạnh t&ograve;a th&aacute;p căn hộ dịch vụ Somerset quận 1, D1mension do The Ascott Limited trực tiếp quản l&yacute; v&agrave; vận h&agrave;nh, D1mension l&agrave; Branded Residence đầu ti&ecirc;n tại trung t&acirc;m TP HCM sở hữu bởi chủ đầu tư nước ngo&agrave;i uy t&iacute;n.</p>\r\n<div class=\"VCSortableInPreviewMode\">\r\n<div class=\"PhotoCMS_Caption\">\r\n<p class=\"\" data-placeholder=\"[nhập ch&uacute; th&iacute;ch]\">BĐS cao cấp với những tiện &iacute;ch vượt trội phục vụ nhu cầu của giới nh&agrave; gi&agrave;u S&agrave;i G&ograve;n.</p>\r\n</div>\r\n</div>\r\n<p>Hay mới đ&acirc;y nhất, khu căn hộ cao cấp v&agrave; trung t&acirc;m thương mại Sunshine Diamond River tọa lạc tại mặt tiền đường Đ&agrave;o Tr&iacute;, Phường Ph&uacute; Thuận, Q.7, Tp.HCM, s&aacute;t b&ecirc;n s&ocirc;ng S&agrave;i G&ograve;n vừa ra mắt cũng tạo được những điểm nhấn ri&ecirc;ng ở ph&acirc;n kh&uacute;c BĐS cao cấp khi được x&acirc;y dựng như một &ldquo;quần thể xanh, hiện đại, th&ocirc;ng minh&rdquo; ứng dụng c&ocirc;ng nghệ 4.0 v&agrave; IoT v&agrave;o quản l&yacute; vận h&agrave;nh&nbsp;với chuỗi tiện &iacute;ch chuẩn resort.</p>\r\n<p>Theo t&igrave;m hiểu, chủ đầu tư Sunshine Group đ&atilde; ch&uacute; trọng nghi&ecirc;n cứu kỹ nhu cầu của người mua nh&agrave; S&agrave;i G&ograve;n để ph&aacute;t triển hệ thống căn hộ, sky villas c&oacute; s&acirc;n vườn ri&ecirc;ng, thiết kế độc đ&aacute;o kết hợp c&ugrave;ng vật liệu cao cấp được lựa chọn kỹ c&agrave;ng như k&iacute;nh Lowe chống bức xạ nhiệt cao cấp ph&ugrave; hợp với thời tiết của S&agrave;i G&ograve;n...</p>\r\n<p>Nằm c&aacute;ch Sunshine Diamond River kh&ocirc;ng xa, Ph&uacute; Mỹ Hưng Midtown cũng g&acirc;y ch&uacute; &yacute; khi chi ngh&igrave;n tỷ ph&aacute;t triển cảnh quan, tiện &iacute;ch với điểm nhấn l&agrave; phố hoa anh đ&agrave;o c&ugrave;ng nhiều tiện &iacute;ch d&agrave;nh cho phụ nữ, trẻ em. Đại diện Ph&uacute; Mỹ Hưng cho biết đ&acirc;y l&agrave; dự &aacute;n tốn k&eacute;m nhất năm v&igrave; doanh nghiệp đầu tư lớn cho cảnh quan. B&ugrave; lại, dự &aacute;n đ&atilde; ch&agrave;o b&aacute;n th&agrave;nh c&ocirc;ng hai giai đoạn đầu.</p>\r\n<p>Hay một dự &aacute;n kh&aacute;c do Novaland l&agrave;m đơn vị ph&aacute;t triển l&agrave;&nbsp;The Grand Manhattan cũng g&acirc;y ấn tượng tr&ecirc;n thị trường bằng chỗ đậu xe định danh d&agrave;nh cho chủ nh&acirc;n của c&aacute;c căn hộ. Theo chủ đầu tư, ưu đ&atilde;i chỗ đậu xe ngay trung t&acirc;m Q.1 của The Grand Manhattan đ&aacute;p ứng &ldquo;cơn kh&aacute;t&rdquo; chỗ đậu xe an to&agrave;n văn minh cho cư d&acirc;n khi sống tại đ&acirc;y.</p>\r\n<p>Hướng đến đối tượng người trẻ, hiện đại, ưa th&iacute;ch lối sống năng động, dự &aacute;n Alpha Hill lại c&oacute; c&aacute;ch \"chiều l&ograve;ng\" kh&aacute;ch h&agrave;ng kh&aacute;c biệt khi thiết kế c&aacute;c \"căn hộ biến h&igrave;nh - transformer apartment\" kh&ocirc;ng gian nhỏ khoảng 40m2 nhưng đa năng, linh hoạt với với giường ngủ, bồn tắm thư gi&atilde;n, b&agrave;n l&agrave;m việc, nơi thết đ&atilde;i d&agrave;nh cho 6-8 kh&aacute;ch.</p>\r\n<p>Thực tế cho thấy, c&agrave;ng ng&agrave;y c&aacute;c chủ đầu tư c&agrave;ng quan t&acirc;m đến khẩu vị mới của người mua nh&agrave;, khi những tiện &iacute;ch kh&aacute;c biệt, lối kiến tr&uacute;c mới kh&ocirc;ng ngừng được ph&aacute;t triển. Đặc biệt, sự quan t&acirc;m kh&ocirc;ng chỉ dừng lại ở những tiện &iacute;ch cao cấp m&agrave; c&ograve;n hướng đến chất lượng dịch vụ khi căn hộ được b&agrave;n giao v&agrave; đưa v&agrave;o sử dụng. Theo đ&aacute;nh gi&aacute; của c&aacute;c chuy&ecirc;n gia, đ&acirc;y cũng l&agrave; một trong những nguy&ecirc;n nh&acirc;n l&yacute; giải cho việc nhiều căn hộ cao cấp đắt tiền nhưng vẫn lu&ocirc;n h&uacute;t kh&aacute;ch.</p>', 1, 1, 1, '2025-04-20 18:45:11', '2025-06-18 07:17:36'),
(4, 1, 'Tin chính trị', 'tin-chinh-tri', 'tin-chinh-tri-2025-06-23-685917a4c4a35.jpg', '<p>Tin ch&iacute;nh trị</p>', 0, 1, 1, '2025-06-23 02:00:20', '2025-06-23 02:00:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_tag`
--

CREATE TABLE `post_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_tag`
--

INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2025-04-20 18:44:02', '2025-04-20 18:44:02'),
(2, 2, 2, '2025-04-20 18:45:11', '2025-04-20 18:45:11'),
(4, 4, 4, '2025-06-23 02:00:20', '2025-06-23 02:00:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `properties`
--

CREATE TABLE `properties` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `purpose` enum('sale','rent') COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('house','apartment') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bedroom` int(11) NOT NULL,
  `bathroom` int(11) NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `time` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor_plan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_latitude` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_longitude` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nearby` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `properties`
--

INSERT INTO `properties` (`id`, `title`, `slug`, `price`, `featured`, `purpose`, `type`, `image`, `bedroom`, `bathroom`, `city`, `city_slug`, `address`, `area`, `agent_id`, `description`, `active`, `time`, `video`, `floor_plan`, `location_latitude`, `location_longitude`, `nearby`, `created_at`, `updated_at`) VALUES
(1, 'Phòng 401 tầng 4 cho thuê đầy đủ tiện nghi trong căn nhà 6 tầng khu vực Nguyễn Thị Định', 'phong-401-tang-4-cho-thue-day-du-tien-nghi-trong-can-nha-6-tang-khu-vuc-nguyen-thi-dinh', 6.00, 1, 'rent', 'house', 'phong-401-tang-4-cho-thue-day-du-tien-nghi-trong-can-nha-6-tang-khu-vuc-nguyen-thi-dinh-2020-04-21-5e9e480ed444e.jpg', 2, 1, 'Hà Nội', 'ha-noi', '48 Nguyễn Thị Định, Trung Hòa, Cầu Giấy, Hà Nội, Việt Nam', 100, 1, '<p>Căn nh&agrave; 6 tầng với diện t&iacute;ch 120m2 ở khu vực Nguyễn &nbsp;Thị Định</p>\r\n<p>C&aacute;c ph&ograve;ng đều được thiết kế tho&aacute;ng m&aacute;t, rất rộng , ph&ugrave; hợp với c&aacute;c bạn đang l&agrave; sinh vi&ecirc;n &nbsp;hoặc người đi l&agrave;m.</p>\r\n<p>Nh&agrave; nằm trong khu vực an ninh tốt, d&acirc;n tr&iacute; cao, những h&agrave;ng x&oacute;m xung quanh l&agrave;m văn ph&ograve;ng v&agrave; c&aacute;n bộ hưu tr&iacute;.</p>\r\n<p>Nh&agrave; được thiết kế hợp l&yacute; với mục đ&iacute;ch cho thu&ecirc; từng ph&ograve;ng l&acirc;u d&agrave;i. Nh&agrave; c&ograve;n đang rất mới, đi v&agrave;o hoạt động được gần 3 năm nay.</p>\r\n<p>Căn nh&agrave; nằm gần c&aacute;c trường đại học lớn. C&aacute;ch BigC Thăng Long 1km, c&aacute;ch ng&atilde; tư sở 2km v&agrave; c&aacute;ch cầu vượt Nguyễn Ch&iacute; Thanh Trần Duy Hưng 200m<br />T&ograve;a nh&agrave; c&oacute; hệ thống thang m&aacute;y, thuận lợi cho việc đi lại</p>\r\n<p>Để xe ở tầng 1 rất rộng r&atilde;i n&ecirc;n kh&ocirc;ng hạn chế chỗ để xe.</p>\r\n<p>Tất cả c&aacute;c ph&ograve;ng đều chia ra l&agrave;m 2 ph&ograve;ng 1 ngủ 1 kh&aacute;ch 1 vệ sinh, trang bị đầy đủ nội thất, sooffa, tủ lạnh, quạt trần, kệ tủ bếp, h&uacute;t m&ugrave;i mới ho&agrave;n to&agrave;n, nh&agrave; vệ sinh thiết bị mới, n&oacute;ng lạnh, điều h&ograve;a 2 chiều Funiki 12000, tủ đồ 1.2x2.5, giường 1.6, đều c&oacute; ban c&ocirc;ng phơi đồ ri&ecirc;ng</p>\r\n<p>Nh&agrave; được trang bị đầy đủ hệ thống chữa ch&aacute;y, đ&egrave;n cầu thang tự động v&agrave; hệ thống thang m&aacute;y gi&uacute;p người d&ugrave;ng thuận &nbsp;tiện đi lại ở trong nh&agrave;&nbsp;</p>\r\n<p>Những người đ&atilde; từng thu&ecirc; nh&agrave; đ&aacute;nh gi&aacute; chủ nh&agrave; l&agrave; người trẻ tuổi rất th&acirc;n thiện, dễ mến v&agrave; hiện đại. Căn nh&agrave; c&oacute; người quản l&yacute; ở c&ugrave;ng để hỗ trợ cho những người thu&ecirc;.</p>\r\n<p>H&agrave;ng tuần c&oacute; người dọn vệ sinh tổng quan khiến cho kh&ocirc;ng gian chung lu&ocirc;n sạch sẽ</p>\r\n<p>Để thu&ecirc; được ph&ograve;ng trong căn nh&agrave; n&agrave;y một c&aacute;ch dễ d&agrave;ng v&agrave; thuận tiện th&igrave; bạn n&ecirc;n thu&ecirc; qua hệ thống Finhou.com. Thường th&igrave; khi c&oacute; một ph&ograve;ng chuyển đi th&igrave; sẽ c&oacute; ngay người mới thu&ecirc;. Do vậy bạn c&oacute; thể đặt thu&ecirc; trước qua hệ thống Finhou.com. Bạn nhấn v&agrave;o n&uacute;t &ldquo;Đặt thu&ecirc; ngay&rdquo; để c&oacute; thể thu&ecirc; được căn ph&ograve;ng ph&ugrave; hợp với bạn.</p>', 1, '2025-05-22T20:44', 'https://www.youtube.com/watch?v=FYmNqrm3T0Y', 'floor-plan-2025-04-21-5e9e480ef115f.jpg', '21.0094649', '105.8027015', '<p>Căn nh&agrave; nằm gần c&aacute;c trường đại học lớn. C&aacute;ch BigC Thăng Long 1km, c&aacute;ch ng&atilde; tư sở 2km v&agrave; c&aacute;ch cầu vượt Nguyễn Ch&iacute; Thanh Trần Duy Hưng 200m</p>', '2025-04-20 18:10:38', '2025-04-20 18:10:38'),
(2, 'Phòng 507 tầng 5 cho thuê đầy đủ tiện nghi trong căn nhà 6 tầng khu vực Gốc Đề', 'phong-507-tang-5-cho-thue-day-du-tien-nghi-trong-can-nha-6-tang-khu-vuc-goc-de', 2.00, 1, 'rent', 'house', 'phong-507-tang-5-cho-thue-day-du-tien-nghi-trong-can-nha-6-tang-khu-vuc-goc-de-2020-04-21-5e9e4af2dd497.jpg', 1, 1, 'Hà Nội', 'ha-noi', 'Phường Hoàng Văn Thụ, Quận Hoàng Mai, Hà Nội', 12, 1, '<p>Ch&uacute;ng t&ocirc;i đặc biệt thiết kế nh&agrave; cho thu&ecirc; gồm 40 &nbsp;ph&ograve;ng với mức gi&aacute; ph&ugrave; hợp cho c&aacute;c bạn sinh vi&ecirc;n thu&ecirc;.</p>\r\n<p>Ng&ocirc;i nh&agrave; của ch&uacute;ng t&ocirc;i được thiết kế gồm 7 tầng c&oacute; c&aacute;c ph&ograve;ng cho thu&ecirc; với mục đ&iacute;ch l&acirc;u d&agrave;i &nbsp;tầng. Nh&agrave; hướng Bắc n&ecirc;n rất tho&aacute;ng m&aacute;t. Căn nh&agrave; bao gồm: &nbsp;40 ph&ograve;ng ngủ, nh&agrave; vệ sinh kh&eacute;p k&iacute;n, khu để xe tầng trệt, s&acirc;n thượng phơi đồ. Diện t&iacute;ch to&agrave;n bộ khoảng 165m2.</p>\r\n<p>Nh&agrave; nằm trong khu vực an ninh tốt, d&acirc;n tr&iacute; cao,xung quanh đều l&agrave; c&aacute;c bạn sinh vi&ecirc;n n&ecirc;n m&ocirc;i trường rất th&acirc;n thiện, h&ograve;a đồng vui vẻ. Mọi người lu&ocirc;n hỗ trợ v&agrave; gi&uacute;p đỡ lẫn nhau trong.&nbsp;</p>\r\n<p>Tầng 1 c&oacute; nh&agrave; để xe rất rộng gi&uacute;p thuận tiện đi lại cho c&aacute;c bạn. Để đảm bảo cho mọi người y&ecirc;n t&acirc;m để xe n&ecirc;n chủ nh&agrave; đ&atilde; &nbsp;lắp đặt hệ thống camera gi&aacute;m s&aacute;t 24/24, thời gian ra v&agrave;o thoải m&aacute;i, kh&ocirc;ng ở chung với chủ, mỗi người đều c&oacute; ch&igrave;a kh&oacute;a cửa ri&ecirc;ng. C&aacute;c ph&ograve;ng được trang bị 1 số đồ d&ugrave;ng cần thiết như tủ đồ c&aacute; nh&acirc;n, giường..v.v</p>\r\n<p>Đặc biệt thuận lợi cho c&aacute;c bạn sinh vi&ecirc;n thuộc 3 trường đại học lớn Đại học B&aacute;ch Khoa, Đại học Kinh Tế Quốc D&acirc;n, Đai học X&acirc;y Dựng. Ngay b&ecirc;n dưới c&oacute; chợ lớn, c&aacute;c tạp h&oacute;a v&agrave; si&ecirc;u thị nhỏ thuận tiện mua b&aacute;n cho c&aacute;c bạn</p>\r\n<p>B&ecirc;n trong c&aacute;c ph&ograve;ng đều kh&aacute; rộng, c&oacute; thiết kế g&aacute;c x&eacute;p lớn c&oacute; thể ngủ hoặc để đồ, c&oacute; kệ bếp phục vụ nấu nướng cho c&aacute;c bạn. Khu nh&agrave; vệ sinh mới v&agrave; sạch sẽ, c&oacute; b&igrave;nh nước n&oacute;ng.&nbsp;</p>\r\n<p>Hệ thống nước sạch đảm bảo sinh hoạt cũng như nấu nướng cho c&aacute;c bạn. Mạng internet cấp độ cao. S&acirc;n phơi đồ tr&ecirc;n tầng thượng rất rộng&nbsp;</p>\r\n<p>Chủ nh&agrave; được đ&aacute;nh gi&aacute; v&agrave; thoải m&aacute;i v&agrave; dễ t&iacute;nh, lu&ocirc;n tạo điều kiện tốt nhất cho c&aacute;c bạn đến thu&ecirc; nh&agrave;. C&oacute; thể k&iacute; hợp đồng d&agrave;i hoặc ngắn hạn.&nbsp;</p>\r\n<p>Finhou.com l&agrave; một nền tảng gi&uacute;p bạn dễ d&agrave;ng nhất để t&igrave;m những ng&ocirc;i nh&agrave; ưng &yacute; của m&igrave;nh chỉ với 3 n&uacute;t click. H&atilde;y l&ecirc;n kế hoạch v&agrave; li&ecirc;n hệ tại đ&acirc;y để tận hưởng những khoảnh khắc sống tuyệt vời.</p>', 1, NULL, 'https://www.youtube.com/watch?v=KQJ-R9uwh7U', 'floor-plan-2025-04-21-5e9e4af2eb279.jpg', '20.9864141', '105.8514798', '<ul class=\"mt-2 mb-3 ListUtilitiesOther\">\r\n<li class=\"mb-2\"><span class=\"font-weight-semibold\">Gần trường đại học:&nbsp;</span>B&aacute;ch khoa, x&acirc;y dựng, kinh tế, Mở</li>\r\n<li class=\"mb-2\"><span class=\"font-weight-semibold\">Gần trường học:&nbsp;</span>Hai B&agrave; Trưng, H&agrave; Huy Tập...</li>\r\n<li class=\"mb-2\"><span class=\"font-weight-semibold\">Gần bệnh viện:&nbsp;</span>Bạch mai, Thanh nh&agrave;n,...</li>\r\n</ul>', '2025-04-20 18:22:58', '2025-04-20 18:22:58'),
(3, 'Cho thuê nhà khu vực đại học BKX- Ngõ Gốc Đề', 'cho-thue-nha-khu-vuc-dai-hoc-bkx-ngo-goc-de', 3.00, 1, 'rent', 'house', 'cho-thue-nha-khu-vuc-dai-hoc-bkx-ngo-goc-de-2020-04-21-5e9e4c0bde72b.jpg', 1, 1, 'Hà Nội', 'ha-noi', 'Ngõ Gốc Đề, Hai Bà Trưng, Hà Nội', 18, 1, '<p>Ch&uacute;ng t&ocirc;i đặc biệt thiết kế nh&agrave; cho thu&ecirc; gồm 31 ph&ograve;ng với mức gi&aacute; ph&ugrave; hợp cho c&aacute;c bạn sinh vi&ecirc;n thu&ecirc;.</p>\r\n<p>Ng&ocirc;i nh&agrave; của ch&uacute;ng t&ocirc;i được thiết kế gồm 7 tầng c&oacute; c&aacute;c ph&ograve;ng cho thu&ecirc; với mục đ&iacute;ch l&acirc;u d&agrave;i&nbsp;&nbsp;tầng. Nh&agrave; hướng Đ&ocirc;ng n&ecirc;n rất tho&aacute;ng m&aacute;t. Căn nh&agrave; bao gồm: 31 ph&ograve;ng ngủ, nh&agrave; vệ sinh kh&eacute;p k&iacute;n, khu để xe, s&acirc;n thượng phơi đồ. Diện t&iacute;ch to&agrave;n bộ khoảng 120m2.</p>\r\n<p>Nh&agrave; nằm trong khu vực an ninh tốt, d&acirc;n tr&iacute; cao,xung quanh đều l&agrave; c&aacute;c bạn sinh vi&ecirc;n n&ecirc;n m&ocirc;i trường rất th&acirc;n thiện, h&ograve;a đồng vui vẻ. Mọi người lu&ocirc;n hỗ trợ v&agrave; gi&uacute;p đỡ lẫn nhau trong.&nbsp;</p>\r\n<p>Tầng 1 c&oacute; nh&agrave; để xe rất rộng gi&uacute;p thuận tiện đi lại cho c&aacute;c bạn. Để đảm bảo cho mọi người y&ecirc;n t&acirc;m để xe n&ecirc;n chủ nh&agrave; đ&atilde;&nbsp;&nbsp;lắp đặt hệ thống camera gi&aacute;m s&aacute;t 24/24, thời gian ra v&agrave;o thoải m&aacute;i, kh&ocirc;ng ở chung với chủ, mỗi người đều c&oacute; ch&igrave;a kh&oacute;a cửa ri&ecirc;ng. C&aacute;c ph&ograve;ng được trang bị 1 số đồ d&ugrave;ng cần thiết như tủ đồ c&aacute; nh&acirc;n, giường..v.v</p>\r\n<p>Đặc biệt thuận lợi cho c&aacute;c bạn sinh vi&ecirc;n thuộc 3 trường đại học lớn Đại học B&aacute;ch Khoa, Đại học Kinh Tế Quốc D&acirc;n, Đai học X&acirc;y Dựng. Ngay b&ecirc;n dưới c&oacute; chợ lớn, c&aacute;c tạp h&oacute;a v&agrave; si&ecirc;u thị nhỏ thuận tiện mua b&aacute;n cho c&aacute;c bạn</p>\r\n<p>B&ecirc;n trong c&aacute;c ph&ograve;ng đều kh&aacute; rộng, c&oacute; thiết kế g&aacute;c x&eacute;p lớn c&oacute; thể ngủ hoặc để đồ, c&oacute; kệ bếp phục vụ nấu nướng cho c&aacute;c bạn. Khu nh&agrave; vệ sinh mới v&agrave; sạch sẽ, c&oacute; b&igrave;nh nước n&oacute;ng.&nbsp;</p>\r\n<p>Hệ thống nước sạch đảm bảo sinh hoạt cũng như nấu nướng cho c&aacute;c bạn. Mạng internet cấp độ cao. S&acirc;n phơi đồ tr&ecirc;n tầng thượng rất rộng&nbsp;</p>\r\n<p>Chủ nh&agrave; được đ&aacute;nh gi&aacute; v&agrave; thoải m&aacute;i v&agrave; dễ t&iacute;nh, lu&ocirc;n tạo điều kiện tốt nhất cho c&aacute;c bạn đến thu&ecirc; nh&agrave;. C&oacute; thể k&iacute; hợp đồng d&agrave;i hoặc ngắn hạn.&nbsp;</p>', 1, '2025-05-22T20:44', 'https://www.youtube.com/watch?v=0LOhqz0C5Zc', 'floor-plan-2025-04-21-5e9e4c0beabc2.jpg', '20.9931453', '105.8526457', '<ul class=\"mt-2 mb-3 ListUtilitiesOther\">\r\n<li class=\"mb-2\"><span class=\"font-weight-semibold\">Gần trường đại học:&nbsp;</span>Kinh tế Quốc D&acirc;n, B&aacute;ch Khoa, X&acirc;y dựng, Kinh doanh v&agrave; C&ocirc;ng Nghệ</li>\r\n<li class=\"mb-2\"><span class=\"font-weight-semibold\">Gần bệnh viện:&nbsp;</span>Bệnh Viện Bạch Mai, Bệnh viện Thanh Nh&agrave;n</li>\r\n<li class=\"mb-2\"><span class=\"font-weight-semibold\">Gần c&ocirc;ng vi&ecirc;n:&nbsp;</span>C&ocirc;ng vi&ecirc;n tuổi trẻ</li>\r\n</ul>', '2025-04-20 18:27:39', '2025-04-20 18:27:39'),
(4, 'Nhà hẻm xe hơi Nguyễn Duy, P12 Q8, 2 lầu + ST, 3.7 x 20m, sổ hồng riêng, ĐT: 0909 428 *** (Mr. Tâm)', 'nha-hem-xe-hoi-nguyen-duy-p12-q8-2-lau-st-37-x-20m-so-hong-rieng-dt-0909-428-mr-tam', 6900.00, 1, 'sale', 'house', 'nha-hem-xe-hoi-nguyen-duy-p12-q8-2-lau-st-37-x-20m-so-hong-rieng-dt-0909-428-mr-tam-2020-05-08-5eb51b0aaf4e5.jpg', 5, 3, 'Hồ Chí Minh', 'ho-chi-minh', 'Đường Nguyễn Duy, Phường 12, Quận 8, Hồ Chí Minh', 74, 2, 'Bán nhà hẻm xe hơi đường Nguyễn Duy, P12, Q8.\r\nDiện tích: 3.7 x 20m (nở hậu 6m).\r\nKết cấu: 1 trệt, 2 lầu + sân thượng, 4 phòng ngủ, 5WC.\r\nNhà xây mới 100% đẹp xinh lung linh, thiết kế sang trọng nội thất cao cấp. Hẻm xe hơi thông thoáng, khu dân cư an ninh hiện hữu, gần chợ trường học & nhiều tiện ích xung quanh.\r\nTiện ích: Gần cầu chà và thuận tiện di chuyển đại lộ Võ Văn Kiệt ra quận 1,3,5,10.\r\nHướng: Bắc.\r\nSổ hồng riêng chính chủ, hoàn công đầy đủ.\r\nGiá: 6 tỷ 900 triệu, thương lượng.', 1, '2025-05-22T20:44', 'https://www.youtube.com/watch?v=QNBUT4lFy8k', 'floor-plan-2025-05-08-5eb51b0ab59ac.jpg', '102,34', '45,76', 'đường Nguyễn Duy', '2025-05-08 01:40:42', '2025-05-08 01:40:42'),
(5, 'BÁN NHÀ PHỐ QUẬN 8, 4 TẤM, CÁCH BƯU ĐIỆN Q. 5 4KM', 'ban-nha-pho-quan-8-4-tam-cach-buu-dien-q-5-4km', 1750.00, 1, 'sale', 'house', 'ban-nha-pho-quan-8-4-tam-cach-buu-dien-q-5-4km-2020-05-08-5eb51f7106679.jpg', 4, 2, 'Hồ Chí Minh', 'ho-chi-minh', 'Đường Bến Mễ Cốc, Phường 15, Quận 8, Hồ Chí Minh', 33, 2, 'Bán nhà phố quận 8, 4 tấm, cách Bưu Điện Q. 5 4km, giá chỉ 1.75 tỷ, 0902331***.\r\n- DTXD: 3.2mx7m.\r\n- DTSD: 84m2.\r\n- 1PK + 2PN + 3WC - trệt 2 lầu 1 sân thượng - Kiến trúc hiện đại - nội thất cực kì cao cấp và hiện đại.\r\n\r\n- Giấy tờ đầy đủ, đi công chứng trong ngày.\r\n- Vị trí rất đẹp, gần chợ, trường học, BV...\r\n- Tiện ở, cho thuê, đầu tư sinh lợi.\r\n- Nhà giống hình 100%.\r\n\r\n- Giá bán: 1.75 tỷ.', 1, '2025-05-22T20:44', 'https://www.youtube.com/watch?v=0LOhqz0C5Zc', 'floor-plan-2025-05-08-5eb51f710b4cc.jpg', '10.9456095', '23.788', 'Đường Bến Mễ Cốc', '2025-05-08 01:59:29', '2025-05-08 01:59:29'),
(6, 'Bán nhà phố quận 8 4 tấm cách Bưu Điện Q.5', 'ban-nha-pho-quan-8-4-tam-cach-buu-dien-q5', 1700.00, 1, 'sale', 'house', 'ban-nha-pho-quan-8-4-tam-cach-buu-dien-q5-2020-05-08-5eb5245db803f.jpg', 2, 2, 'Hồ Chí Minh', 'ho-chi-minh', 'Đường Bến Mễ Cốc, Phường 15, Quận 8, Hồ Chí Minh', 30, 2, 'Bán nhà phố quận 8, 4 tấm cách Bưu Điện Q. 5 4km giá chỉ 1.7 tỷ cách mặt tiền đường chỉ 10m.\r\n\r\n- DTXD: 3.2mx7m.\r\n- DTSD: 84m2.\r\n- 1PK + 2PN + 3WC - trệt 2 lầu 1 sân thượng - kiến trúc hiện đại - nội thất cực kì cao cấp và hiện đại.\r\n\r\n- Giấy tờ đầy đủ, đi công chứng trong ngày.\r\n- Vị trí rất đẹp, gần chợ, trường học, bv...\r\n- Tiện ở, cho thuê, đầu tư sinh lợi.\r\n- Nhà giống hình 100%.\r\n\r\n- Giá bán: 1.7 tỷ.', 1, '2025-05-22T20:44', 'https://www.youtube.com/watch?v=0LOhqz0C5Zc', 'floor-plan-2025-05-08-5eb5245dbe010.jpg', '10.9456095', '37.90', 'Đường Bến Mễ Cốc', '2025-05-08 02:20:29', '2025-05-08 02:20:29'),
(7, 'Bán nhà cấp 4 hẻm Thùy Vân rộng 2 ô tô tránh nhau', 'ban-nha-cap-4-hem-thuy-van-rong-2-o-to-tranh-nhau', 22000.00, 1, 'sale', 'house', 'ban-nha-cap-4-hem-thuy-van-rong-2-o-to-tranh-nhau-2020-05-09-5eb60835e85e1.jpg', 8, 6, 'Vũng Tàu', 'vung-tau', 'Đường Thùy Vân, Phường 2, Vũng Tàu, Bà Rịa Vũng Tàu', 200, 6, 'Bán nhà cấp 4 hẻm rộng 2 ô tô tránh nhau, Thùy Vân, P2, TP Vũng Tàu, DT: 8 x 25m hướng đông bắc. Cách mặt đường 50m và biển 100m rất thuận tiện cho việc xây nhà nghỉ hoặc nghỉ dưỡng tuổi già già. Giá bán: 22 tỷ còn thương lượng.', 1, '2025-05-22T20:44', 'https://www.youtube.com/watch?v=Fua-Ld6blG0', 'floor-plan-2025-05-09-5eb608360027f.jpg', '102.34', '68.382', 'Bãi biển Bà Rịa Vũng Tàu', '2025-05-08 18:32:38', '2025-05-08 18:32:38'),
(8, 'Tai san nha dat can ban o Ho Chi Minh 1', 'tai-san-nha-dat-can-ban-o-ho-chi-minh-1', 1700.00, 1, 'sale', 'house', 'tai-san-nha-dat-can-ban-o-ho-chi-minh-2020-05-09-5eb660e00e124.jpg', 5, 2, 'Hồ Chí Minh', 'ho-chi-minh', 'Đường Bến Mễ Cốc, Phường 15, Quận 8, Hồ Chí Minh', 20, 2, '<p>Can ban can ho o quan 8 TP Ho Chi Minh</p>', 1, '2025-06-27T23:50', 'https://www.youtube.com/watch?v=1DJHyEleguI&ab_channel=Ngh%E1%BB%87AnTV', 'floor-plan-2025-05-09-5eb660e014c4d.jpg', '10.87', '103.87', '<p>Khu Cong Nghiep Trung Tam Ho Chi Minh</p>', '2025-05-09 00:50:56', '2025-06-22 10:09:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `property_image_galleries`
--

CREATE TABLE `property_image_galleries` (
  `id` int(10) UNSIGNED NOT NULL,
  `property_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `property_image_galleries`
--

INSERT INTO `property_image_galleries` (`id`, `property_id`, `name`, `size`, `created_at`, `updated_at`) VALUES
(1, 1, 'gallary-2025-04-21-5e9e480f08b2b.jpg', '57105', '2025-04-20 18:10:39', '2020-04-20 18:10:39'),
(2, 1, 'gallary-2025-04-21-5e9e480f18358.jpg', '349860', '2025-04-20 18:10:39', '2025-04-20 18:10:39'),
(3, 1, 'gallary-2025-04-21-5e9e480f1aac0.jpg', '359642', '2025-04-20 18:10:39', '2025-04-20 18:10:39'),
(4, 1, 'gallary-2025-04-21-5e9e480f1d31d.jpg', '288964', '2025-04-20 18:10:39', '2025-04-20 18:10:39'),
(5, 2, 'gallary-2025-04-21-5e9e4af2f2603.jpg', '383147', '2025-04-20 18:22:59', '2025-04-20 18:22:59'),
(6, 2, 'gallary-2025-04-21-5e9e4af303bd7.jpg', '385177', '2025-04-20 18:22:59', '2025-04-20 18:22:59'),
(7, 2, 'gallary-2025-04-21-5e9e4af306713.jpg', '405074', '2025-04-20 18:22:59', '2025-04-20 18:22:59'),
(8, 2, 'gallary-2025-04-21-5e9e4af30977b.jpg', '191291', '2025-04-20 18:22:59', '2025-04-20 18:22:59'),
(9, 2, 'gallary-2025-04-21-5e9e4af30b9a3.jpg', '191604', '2025-04-20 18:22:59', '2025-04-20 18:22:59'),
(10, 2, 'gallary-2025-04-21-5e9e4af30e33e.jpg', '191604', '2025-04-20 18:22:59', '2025-04-20 18:22:59'),
(11, 3, 'gallary-2025-04-21-5e9e4c0bf187b.jpg', '416052', '2025-04-20 18:27:40', '2025-04-20 18:27:40'),
(12, 3, 'gallary-2025-04-21-5e9e4c0c03f40.jpg', '310503', '2025-04-20 18:27:40', '2025-04-20 18:27:40'),
(13, 3, 'gallary-2025-04-21-5e9e4c0c05c53.jpg', '316317', '2025-04-20 18:27:40', '2025-04-20 18:27:40'),
(14, 3, 'gallary-2025-04-21-5e9e4c0c083bf.jpg', '158515', '2025-04-20 18:27:40', '2025-04-20 18:27:40'),
(15, 4, 'gallary-2025-05-08-5eb51b0ac0e83.jpg', '32445', '2025-05-08 01:40:42', '2025-05-08 01:40:42'),
(16, 4, 'gallary-2025-05-08-5eb51b0ae1586.jpg', '52121', '2025-05-08 01:40:43', '2025-05-08 01:40:43'),
(17, 4, 'gallary-2025-05-08-5eb51b0b0af43.jpg', '44864', '2025-05-08 01:40:43', '2025-05-08 01:40:43'),
(18, 4, 'gallary-2025-05-08-5eb51b0b1b296.jpg', '45908', '2025-05-08 01:40:43', '2025-05-08 01:40:43'),
(19, 4, 'gallary-2025-05-08-5eb51b0b2fd64.jpg', '37742', '2025-05-08 01:40:43', '2025-05-08 01:40:43'),
(20, 5, 'gallary-2025-05-08-5eb51f7110f3b.jpg', '32445', '2025-05-08 01:59:29', '2025-05-08 01:59:29'),
(21, 5, 'gallary-2025-05-08-5eb51f71259b5.jpg', '52121', '2025-05-08 01:59:29', '2025-05-08 01:59:29'),
(22, 5, 'gallary-2025-05-08-5eb51f713a951.jpg', '44864', '2025-05-08 01:59:29', '2025-05-08 01:59:29'),
(23, 5, 'gallary-2025-05-08-5eb51f714cae5.jpg', '45908', '2025-05-08 01:59:29', '2025-05-08 01:59:29'),
(24, 5, 'gallary-2025-05-08-5eb51f716326a.jpg', '37742', '2025-05-08 01:59:29', '2025-05-08 01:59:29'),
(25, 6, 'gallary-2025-05-08-5eb5245dc44af.jpg', '32445', '2025-05-08 02:20:29', '2025-05-08 02:20:29'),
(26, 6, 'gallary-2020-05-08-5eb5245dd7c10.jpg', '52121', '2020-05-08 02:20:29', '2020-05-08 02:20:29'),
(27, 6, 'gallary-2020-05-08-5eb5245de99a8.jpg', '44864', '2020-05-08 02:20:29', '2020-05-08 02:20:29'),
(28, 6, 'gallary-2020-05-08-5eb5245df403b.jpg', '45908', '2020-05-08 02:20:30', '2020-05-08 02:20:30'),
(29, 6, 'gallary-2020-05-08-5eb5245e0e67d.jpg', '37742', '2020-05-08 02:20:30', '2020-05-08 02:20:30'),
(30, 7, 'gallary-2020-05-09-5eb60836068e7.jpg', '32445', '2020-05-08 18:32:38', '2020-05-08 18:32:38'),
(31, 7, 'gallary-2020-05-09-5eb608361e59c.jpg', '52121', '2020-05-08 18:32:38', '2020-05-08 18:32:38'),
(32, 7, 'gallary-2020-05-09-5eb60836388d0.jpg', '44864', '2020-05-08 18:32:38', '2020-05-08 18:32:38'),
(33, 7, 'gallary-2020-05-09-5eb6083648825.jpg', '45908', '2020-05-08 18:32:38', '2020-05-08 18:32:38'),
(34, 7, 'gallary-2020-05-09-5eb608365d914.jpg', '37742', '2020-05-08 18:32:38', '2020-05-08 18:32:38'),
(35, 8, 'gallary-2020-05-09-5eb660e018802.jpg', '32445', '2020-05-09 00:50:56', '2020-05-09 00:50:56'),
(36, 8, 'gallary-2020-05-09-5eb660e021cb7.jpg', '52121', '2020-05-09 00:50:56', '2020-05-09 00:50:56'),
(37, 8, 'gallary-2020-05-09-5eb660e02a226.jpg', '44864', '2020-05-09 00:50:56', '2020-05-09 00:50:56'),
(38, 8, 'gallary-2020-05-09-5eb660e02f5d1.jpg', '45908', '2020-05-09 00:50:56', '2020-05-09 00:50:56'),
(39, 8, 'gallary-2020-05-09-5eb660e036c13.jpg', '37742', '2020-05-09 00:50:56', '2020-05-09 00:50:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `rating` decimal(8,2) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '2025-04-20 17:03:52', NULL),
(2, 'Agent', 'agent', '2025-04-20 17:03:52', NULL),
(3, 'User', 'user', '2025-04-20 17:03:52', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aboutus` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Các nhà đầu tư lớn', 'Chúng tôi luôn được các nhà đầu tư bất động sản hàng đầu tin dùng', 'cac-nha-dau-tu-lon-2025-06-23-685916f587ed4.jpg', '2025-04-20 17:58:35', '2025-06-23 01:57:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Tin hình sự', 'tin-hinh-su', '2025-04-20 18:43:07', '2025-04-20 18:43:07'),
(2, 'Tin đất đai', 'tin-dat-dai', '2025-04-20 18:43:16', '2025-06-18 07:04:58'),
(4, 'Tin Chính Trị', 'tin-chinh-tri', '2025-06-23 01:59:14', '2025-06-23 01:59:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonial` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `image`, `testimonial`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Trung Tín', '-2025-06-18-6852c3c339f0a.jpg', 'Tôi đã từng thực hiện thành công giao dịch trên Bất Động Sản Việt. Nhân viên chăm sóc chu đáo, nhiệt tình', '2025-04-20 18:35:33', '2025-06-18 07:54:13'),
(2, 'Nguyễn Trung Tín', '-2025-06-18-6852c3b818091.png', 'Những nội dung được đăng tải trên Bất Động Sản Việt hoàn toàn chính xác và đáng tin cậy', '2025-04-20 18:36:44', '2025-06-18 07:53:59'),
(3, 'Chị Hoàng Ý Lan', '-2025-06-18-6852c3ae829f0.jpg', 'Nhờ Bất Động Sản Việt mà gia đình tôi đã tìm được căn nhà như ý', '2025-04-20 18:38:14', '2025-06-18 06:48:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `about` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isReport` int(11) NOT NULL DEFAULT 0,
  `reason` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `username`, `email`, `image`, `about`, `password`, `status`, `remember_token`, `created_at`, `updated_at`, `isReport`, `reason`) VALUES
(1, 1, 'Admin', 'admin', 'admin@admin.com', 'user.png', 'Quản trị website', '$2y$10$oDB6w5GV6KW9nVSVNrYmduwmaJgxUF58J1/d1PQzMcBAV0PxweH.6', 1, 'qw5U95CzVhWV5PltonL4jR21aSMGNFMrKfddee6KlbhvYOsvYJpI8QrtR7XK', '2025-04-20 17:03:52', NULL, 0, ''),
(2, 2, 'Chủ nhà đất', 'agent', 'nguyentrungtin417@gmail.com', 'user.png', '', '$2y$10$GUJCCeWbQ0ux/ByNmlwEEeiLXvOL7qWbbcsXp56G8/hmIN17wPJLS', 0, 'HqUcbzQ9Q9cbAkgfLctQV44KXZbcLUkQEsUm22YWPgW7pOO0fOLJKaItKS7P', '2025-04-20 17:03:52', '2025-06-23 01:52:26', 0, ''),
(3, 3, 'Người dùng', 'user', 'user@user.com', 'user.png', NULL, '$2y$10$wLn4/KUUAqXkRMmv8Ja9KO5ufIBaSLv07tGmH5fOIoVPN3sRkoshm', 1, 'HKz2OBtMBqpczrOipxt9zoIh9Vku72SbfZhvVMaR7bdvKAxZli89g27dWQFN', '2025-04-20 17:03:52', '2025-06-22 10:24:41', 0, ''),
(6, 2, 'Người dùng Se bi to cao', 'agent2', 'agent2@agent.com', 'agent2.png', NULL, '$2y$10$CVQaD//3RDRyV4Jg9FUuIuI74bW1JtdINH6yuKnzUodH5siH.rqk6', 0, 'tGRkZMqD1tOcwOZLidSATHFCDNPUEfbdCssz1CcxTtCuwmxeWE2sLLS9XBt0', '2025-04-20 17:03:52', '2025-05-09 00:56:07', 1, 'Dang tin khong chinh xac'),
(7, 3, 'Trung Tín', 'Trung', 'nguyentrungtin717@gmail.com', 'default.png', NULL, '$2y$10$hXAEsQhoXgLfafKnHS7FT.ten05f4kf4NqLnVmL2VB5mqvHVaxPMW', 1, 'KdN8IYUUIP4CZLVzGCVaqI46Y76iMc12xCefnrwi6eM6fjmSB527ubXAZwcH', '2025-05-11 02:52:08', '2025-05-11 03:52:30', 0, ''),
(10, 2, 'Ok', 'Ok', 'nguyentrungtin073@gmail.com', 'default.png', NULL, '$2y$10$Jpw4kRzsWRHkDp5YkRiA1eMs6OqWlko9GcMNe1I0cHTZOxSUB7jcK', 1, 'grnCYKMkdwzuoitpjTGSt1GMr9aRfqyWwKHGL2zgH2IypnAKlonTDj78dqrh', '2025-06-18 10:18:40', '2025-06-23 02:01:40', 0, ''),
(11, 3, 'Hai', 'Hai', 'nguyentrungtin074@gmail.com', 'default.png', NULL, '$2y$10$tJTVGj1rWyeJdTXLPoZVwe6AsuGrkGPYsNrbC7l9e/iL19uFugqIe', 1, NULL, '2025-06-18 10:21:02', '2025-06-18 10:21:02', 0, '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_post`
--
ALTER TABLE `category_post`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `feature_property`
--
ALTER TABLE `feature_property`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `properties_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `property_image_galleries`
--
ALTER TABLE `property_image_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `category_post`
--
ALTER TABLE `category_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `features`
--
ALTER TABLE `features`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `feature_property`
--
ALTER TABLE `feature_property`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `property_image_galleries`
--
ALTER TABLE `property_image_galleries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
