-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 12:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zankurd`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `image`, `description`) VALUES
(12, 'جۆرج ئۆروێل', '227571.jpg', 'ئێریک ئارتور بلێر، ناوە خوازراو: جۆرج ئۆروێڵ (لەدایکبووی ٢٦ی حوزەیرانی ١٩٠٣-٢١ی کانوونی دووەمی ١٩٥٠) ڕۆماننووس، وتارنووس، ڕۆژنامەنووس و ڕەخنەگر بوو. کارەکانی نیشان دەکرێن بە پەخشانی ڕوون و ئاشکرا، ھۆشیاری لەڕووی نادادپەروەریی کۆمەڵایەتی، دژایەتی کردنی تۆتالیتاریانیزم و، ھەروەھا پشتیگیریکردنێکی ئاشکرایانەی سۆسیالیزمی دیموکراتی'),
(13, 'پاولۆ کۆیلۆ', 'download (1).jfif', 'پاولۆ کۆیلۆ دێ سووزا (/ˈkwɛl.juː, kuˈɛl-, -joʊ/ کوێ-لوو؛ گۆکردنی پۆرتووگالی: [ˈpaw.lu kuˈeʎu] پاو-لوو کوێ-لوو؛ لەدایکبووی ٢٤ی ئابی ١٩٤٧) ھۆنراوەنووس و ڕۆماننوسی بەڕازیلییە، کە بە ڕۆمانی کیمیاگەر ناسراوە. لە ٢٠١٤دا، لاپەڕە کەسییەکانی لە ئینتەرنێتدا بڵاوکردەوە بۆ دروستکردنی دامەزراوەی پاولۆ کۆیلۆی ئینتەرنێتی.'),
(14, 'مەولەوی', 'photo_2024-05-14_19-53-46.jpg', 'سەید عەبدولڕەحیمی کوڕی سەعید تاوەگۆزی (١٨٠٦–١٨٨٢) ناسراو بە مەولەوی یان مەولەویی کورد شاعیری ناوداری کورد و سۆفیی تەریقەتی نەقشبەندی بوو کە بە شێوەزاری ھەورامی ھۆنڕاوەی داناوە و لە شیعری ئەوین و دڵداری دا زۆر بەناوبانگە. لە ھۆنڕاوەکانیدا خۆی بە مەعدووم ناساندووە.'),
(16, 'ابن کثیر', 'photo_2024-05-14_19-17-32.jpg', 'اوکی فیدا عیماد دین ئیسماعیلی کوڕی عومەری کوڕی کەسیری کوڕی زۆئی کوڕی کەسیری کوری زەرعی قورەیشی (بە عەرەبی: أبو الفداء عماد الدين إسماعيل بن عمر بن كثير بن ضوء بن كثير بن زرع القرشي) ناسراو بە ئیبن کەسیر زانایەکی موسوڵمانە باوکی عمر بن كثير وتاربێژی مزگەوتی جامع بوو لە شاری بەسرە و بنچینەی دەگەڕێتەوە بۆ بەسرە دواتر بۆ شام کۆچیان کردوە.'),
(17, 'کۆساری', 'download (2).jfif', 'خدر محەممەد ڕەشید ناسراو بە کۆساری (١٩٦٧ – ١٩٩٣) شاعیرێکی کوردی خەڵکی ڕانیە بوو کۆساری یەکێک لە شاعیرە جیھادییەکانی بزووتنەوەی ئیسلامی کوردستان بوو. ئەو بە دیارترین شاعیری جیھادیی باشووری کوردستان دادەنرێت، کە بۆ ماوەی زیاتر لە دەیەیەک، بە شیعرەکانی، گڕووتینی دابووە ھێرشە چەکدارییەکانی بزووتنەوەی ئیسلامی، سەرەتا دژ بە ڕژێمی بەعس و دواتریش لە شەڕ و ململانێ نێوخۆییەکاندا بوو.'),
(18, 'بەختیار عەلی', 'baxtyar.jfif', 'ەختیار عەلی (لەدایکبووی ١٩٦٠ لە سلێمانی، عێراق) ڕۆماننووس، شاعیر و ڕۆشنبیرێکی کوردە، و یەکێکە لە دامەزرێنەرانی گۆڤاری ڕەھەند. یەکەم ڕۆمانی بە ناوی مەرگی تاقانەی دووەم، ساڵی ١٩٩٧ لە سوێد بڵاو کرایەوە.'),
(19, 'فەرهاد پیرباڵ', 'Farhad_Pirbal_Portrait_Cropped.jpg', 'فەرھاد پیرباڵ (لەدایکبووی ٢٠ی ئابی ١٩٦١ لە ھەولێر، عێراق) نووسەر، لێکۆڵەر، و مامۆستایەکی زانکۆی کوردە، خەڵکی باشووری کوردستانە و لە ھەولێر دادەنیشێت');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `author` varchar(25) NOT NULL,
  `image` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `category` varchar(25) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `author`, `image`, `file`, `category`, `description`) VALUES
(20, 'مەزرای ئاژەڵان', 'جۆرج ئۆروێل', 'photo_2024-05-14_18-59-45.jpg', 'مەزرای ئاژەڵان.pdf', 'ڕۆمان', 'مەزرای ئاژەڵان کورتە ڕۆمانێکە لە چیرۆکێکی گاڵتەجاڕیی سیاسیی پێکهاتووە و لەلایەن جۆرج ئۆڕوێڵ (George Orwell)ـەوە نووسراوە، بۆ یەکەمین جار لە ١٧ـی ئابی ١٩٤٥ بڵاوکراوەتەوە. ئەم ڕۆمانە باس لە کۆمەڵێک ئاژەڵی نێو مەزرایەک دەکات کە لە دژی خاوەنی مەزراکەیان یاخیبوون بەرپا دەکەن، بەمەبەستی دروستکردنی کۆمەڵگەیەک کە تێیدا هەمووان یەکسان و دڵخۆش و ئازادبن. لەکۆتاییدا کۆمەڵێکیان لەژێر دەستی سەرۆکێکی دیکتاتۆر و زۆردار بەناوی (ناپلیۆن بە ئینگلیزی: Napoleon) خیانەت لە یاخیبوونەکەیان دەکەن و باروودۆخی مەزراکە بەرەو خراپتر دەبەن.'),
(21, 'کیمیاگەر', 'پاولۆ کۆیلۆ', 'photo_2024-05-14_19-03-03.jpg', 'کیمیاگەر.pdf', 'ڕۆمان', 'کیمیاگەر  (بە پورتووگالی: O Alquimista) ڕۆمانێکە لە نووسینی پاولۆ کۆیلۆ کە بڵاوکراوەتەوە لە ساڵی ١٩٨٨. ڕۆمانەکە بۆ یەکەم جار بە زمانی پورتووگالی نووسرابوو، دواتر بە ھۆی ناوبانگەکەی، بە شێوەیەکی نێودەوڵەتی وەرگێڕدرا. ڕۆمانەکە چیڕۆکێکی ھێمایییە، باس لە کاروانی شوانێکی لاوی ئەندەلوسی دەکات بۆ ھەرەمە میسڕییەکان، دوای ئەوەی خەونی دۆزینەوەی گەنجینەیەک لە شوێنەکە بۆ چەند جارێک دووبارە دەبێتەوە.'),
(22, 'دیوانی مەولەوی', 'مەولەوی', 'photo_2024-05-14_19-15-49.jpg', 'دیوانی مەولەوی.pdf', 'شیعر', 'دیوانی شاعیری گەورەی کورد (مەولەوی)'),
(23, 'تەفسیری ابن کثیر بەرگی یە', 'ابن کثیر', 'photo_2024-05-14_19-17-32.jpg', 'تەفسیری ابن کثیر بەرگی یەکەم.pdf', 'ئاینی', 'تەفسیر قورئان العزیم (بە عەرەبی: تفسير القرءان العظيم ، ڕۆمانی: تەفسیر القرئان العم) ناسراوە، بە شێوەیەکی گشتی بە تەفسیر القرئان العم (بە عەرەبی: تفسير ابن کثير) ناسراوە : تەفسیر. ئیبن کاثیر)، تەفسیری قورئان (تفسیر)ی ئیبن کاثیرە. یەکێکە لە کتێبە ئیسلامییە بەناوبانگەکان کە تایبەتە بە زانستی تەفسیری قورئان.  هەروەها حوکمی فیقهی لەخۆدەگرێت، وە ئاگاداری فەرموودەکانە و بەناوبانگە بەوەی کە نزیکە لە ئیسراعیلیەت بێبەش بێت. زۆرترین تەفسیرە کە سەلەفییەکان پەیڕەوی لێ دەکەن.'),
(24, 'تەفسیری ابن کثیر بەرگی دو', 'ابن کثیر', 'photo_2024-05-14_19-17-32.jpg', 'تەفسیری ابن کثیر بەرگی دووەم.pdf', 'ئاینی', 'تەفسیر قورئان العزیم (بە عەرەبی: تفسير القرءان العظيم ، ڕۆمانی: تەفسیر القرئان العم) ناسراوە، بە شێوەیەکی گشتی بە تەفسیر القرئان العم (بە عەرەبی: تفسير ابن کثير) ناسراوە : تەفسیر. ئیبن کاثیر)، تەفسیری قورئان (تفسیر)ی ئیبن کاثیرە. یەکێکە لە کتێبە ئیسلامییە بەناوبانگەکان کە تایبەتە بە زانستی تەفسیری قورئان.  هەروەها حوکمی فیقهی لەخۆدەگرێت، وە ئاگاداری فەرموودەکانە و بەناوبانگە بەوەی کە نزیکە لە ئیسراعیلیەت بێبەش بێت. زۆرترین تەفسیرە کە سەلەفییەکان پەیڕەوی لێ دەکەن.'),
(25, 'بورکانی شیعر', 'کۆساری', 'photo_2024-05-14_19-21-26.jpg', 'بوركانی شیعر.pdf', 'شیعر', 'بورکانی شیعر لە نووسینی کۆساری'),
(26, 'کۆشکی باڵندە غەمگینەکان', 'بەختیار عەلی', 'photo_2024-05-14_19-03-03.jpg', 'کۆشکی باڵندە غەمگینەکان.pdf', 'ڕۆمان', 'کۆشکی باڵندە غەمگینەکان ڕۆمانێکی کوردی لە نووسینی بەختیار عەلییە، بۆ یەکەمجار لە ساڵی ٢٠٠٩دا بڵاوکرایەوە و لەلایەن ناوەندی ڕەھەندەوە بڵاوکرایەوە، لە ساڵی ٢٠١٤دا، ناوەندی ئەندێشە چاپی دووەمی کتێبەکەی بڵاوکردەوە کە دیزاینی ناوەوەی کتێبەکە گۆڕابوو، وەک گەورەکردنی فۆنت و گۆڕینی قەبارەی فۆنت'),
(27, 'پەتاتەخۆرەکان', 'فەرهاد پیرباڵ', 'patataxorakan.jfif', 'پەتاتەخۆرەکان.pdf', 'ڕۆمان', 'کۆمەڵەچیرۆکی فەرهاد پیرباڵە و لەلایەن چەندین دەزگەی نێوخۆیی و دەرەوە چاپ کراوە. لەوانە: ماڵی شەرەفخانی بەتلیسی، کولتوور، ماڵی وەفایی، مانگ و ..هتد'),
(28, 'سانتیاگۆ دی کۆمپۆستێلا', 'فەرهاد پیرباڵ', '1914769.jpg', '2.IntroductionToC#.pdf', 'ڕۆمان', 'کۆمەڵەچیرۆکی فەرهاد پیرباڵە و لەلایەن چەندین دەزگەی نێوخۆیی و دەرەوە چاپ کراوە. لەوانە: ماڵی شەرەفخانی بەتلیسی، کولتوور، ماڵی وەفایی، مانگ و ..هتد');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `state` varchar(25) NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_name`, `user_email`, `message`, `state`) VALUES
(1, 'UserOne', 'user@gmail.com', 'zor zor basha, daraja yak', 'read'),
(2, 'UserOne', 'user@gmail.com', 'zor zor basha, daraja yak', 'unread'),
(3, 'UserOne', 'user@gmail.com', 'zor zor basha, daraja yak', 'read'),
(4, 'UserOne', 'user@gmail.com', 'jgljg', 'unread'),
(6, 'UserOne', 'user@gmail.com', 'nfdkls', 'unread'),
(7, 'UserOne', 'user@gmail.com', 'fjd', 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `book_id`) VALUES
(61, 7, 22);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `user_type` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(5, 'rezdar', 'r@gmail.com', 'e14b4dcae93730107e2b89381d120be86c35576e3f292190a020e0c00a8868bf', 'user'),
(6, 'Owner', 'owner@gmail.com', 'b0d071a5a19db68aa881331baba9c9460b927bdf2f47652d68a20f8b31203641', 'admin'),
(7, 'UserOne', 'user@gmail.com', 'cfaadc81b86286bede7f850e80df9924c48c51ff7a7b2fe1885ec7df69e65e89', 'admin'),
(8, 'Hawkar', 'hawkar@gmail.com', '08fea5b31d20f3741fdcc6a6aba4aef07a936b77f31b5c75216c1371ba3f0a99', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
