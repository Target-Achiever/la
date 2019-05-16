-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 11, 2019 at 10:02 PM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `linkaesthetics_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(10) UNSIGNED NOT NULL,
  `about_header` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `about_content` text COLLATE utf8_unicode_ci NOT NULL,
  `about_readmore` text COLLATE utf8_unicode_ci NOT NULL,
  `about_banner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `about_status` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-active,2-deactivate',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `about_header`, `about_content`, `about_readmore`, `about_banner`, `about_status`, `created_at`, `updated_at`) VALUES
(1, 'About Us', '<p><strong>Overview</strong></p>\r\n\r\n<p>LinkAesthetics was created to provide a professional platform for the growing aesthetics industry. LinkAesthetics addresses the need to bridge the gap between customers and freelance aesthetics providers, providing a convenient way to connect and arrange consultations.</p>\r\n\r\n<p><strong>Customers</strong></p>\r\n\r\n<p>For customers seeking aesthetics services, LinkAesthetics enables you to browse providers from across the country, compare prices and procedures, and book consultations. Our providers are certified health care professionals with specialisms in a wide variety of aesthetics procedures, so you can feel confident and assured when making your choice.</p>\r\n\r\n<p><strong>Providers</strong></p>\r\n\r\n<p>For aesthetics providers, LinkAesthetics provides a platform on which you can showcase your work nationwide and connect with new customers. We aim to support you in maximising your potential clientele and building your professional network.</p>\r\n\r\n<p><strong>Prescribing</strong></p>\r\n\r\n<p>In addition, non-prescribing providers can benefit from our growing network of prescribers trained in&nbsp; aesthetics.</p>\r\n', '<p>Test</p>\r\n', '2_1530293285.jpeg', '1', '2018-05-22 06:05:37', '2018-07-14 11:26:48'),
(2, 'Our Vision', '<p>Our ethos is simple &ndash; at LinkAesthetics we aim to make your booking experience convenient, professional and affordable. Here&rsquo;s how:</p>\r\n\r\n<p><strong>Convenient</strong></p>\r\n\r\n<p>Whether you&rsquo;re wanting regular procedures in your own area or looking for a last-minute appointment whilst traveling, Link Aesthetics enables you to arrange appointments at your own home, or at your provider&rsquo;s location.&nbsp;</p>\r\n\r\n<p><strong>Professional</strong></p>\r\n\r\n<p>Link Aesthetics connects you to certified health care professionals with specialisms in a wide variety of aesthetics procedures ranging from lip fillers&nbsp;to anti-wrinkling treatments. All providers have approved qualifications in injectable aesthetics&nbsp;and have a wealth of experience in practicing their specialisms. View provider profiles to see images showcasing their previous work.</p>\r\n\r\n<p><strong>Affordable</strong></p>\r\n\r\n<p>Compare prices, read testimonials, and enjoy great deals and discounts. Link Aesthetics brings together freelance providers from across the country to offer an affordable alternative to clinics and salons.</p>\r\n', '<p>Our ethos is simple &ndash; at LinkAesthetics we aim to make your booking experience convenient, professional and affordable. Here&rsquo;s how:</p>\r\n\r\n<p><strong>Convenient</strong></p>\r\n\r\n<p>Whether you&rsquo;re wanting regular procedures in your own area or looking for a last-minute appointment whilst traveling, Link Aesthetics enables you to arrange appointments at your own home, or at your provider&rsquo;s location.&nbsp;</p>\r\n\r\n<p><strong>Professional</strong></p>\r\n\r\n<p>Link Aesthetics connects you to certified health care professionals with specialisms in a wide variety of aesthetics procedures ranging from lip fillers&nbsp;to anti-wrinkling treatments. All providers have approved qualifications in injectable aesthetics&nbsp;and have a wealth of experience in practicing their specialisms. View provider profiles to see images showcasing their previous work.</p>\r\n\r\n<p><strong>Affordable</strong></p>\r\n\r\n<p>Compare prices, read testimonials, and enjoy great deals and discounts. Link Aesthetics brings together freelance providers from across the country to offer an affordable alternative to clinics and salons.</p>\r\n', '2_1530293311.jpeg', '1', '2018-05-22 07:23:52', '2018-08-27 00:22:16');

-- --------------------------------------------------------

--
-- Table structure for table `admin_settings`
--

CREATE TABLE `admin_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `header_text` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'la home header text',
  `home_banner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `home_page` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('home_banner','home_sub_banner','home_page') COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('1','2') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_settings`
--

INSERT INTO `admin_settings` (`id`, `header_text`, `home_banner`, `home_page`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, '<p>LinkAesthetics</p>\r\n', '', '', 'home_banner', '2', '2018-06-22 01:12:50', '2018-06-22 02:32:59'),
(2, '', '2_1530810260.png', '', 'home_sub_banner', '2', '2018-06-22 01:45:00', '2018-08-25 04:11:48'),
(3, '<p>Sub Banner</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>For LinkAesthetics</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2_1529593676.png', '', 'home_sub_banner', '2', '2018-06-22 03:13:42', '2018-06-22 03:53:05'),
(4, '<h1><span style=\"color:#000000\"><span style=\"font-size:36px\"><strong>Connecting You With Aesthetics Providers</strong><span style=\"background-color:#000000\">​</span></span></span>.</h1>\r\n', '2_1530296837.png', '', 'home_banner', '1', '2018-06-22 09:55:43', '2018-11-21 02:15:54'),
(5, '', '', 'true', 'home_page', '2', '2018-06-26 02:50:07', '2018-11-21 02:15:02'),
(6, '', '2_1535144305.png', '', 'home_sub_banner', '2', '2018-08-25 04:47:23', '2018-08-25 05:43:17'),
(7, '', '2_1535147347.png', '', 'home_banner', '2', '2018-08-25 05:49:08', '2018-08-25 05:49:27'),
(8, '', '2_1535315624.png', '', 'home_sub_banner', '1', '2018-08-25 05:50:02', '2018-08-27 04:33:44');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'created by',
  `service` int(11) NOT NULL COMMENT 'advertisement for service',
  `ad_banner` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'banner name,path',
  `ad_header` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'banner header txt',
  `ad_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'banner description',
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'amount paid for advertisement',
  `ad_offer` enum('2','1') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-yes,2-no',
  `ad_offer_percentage` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ad offer in percentage',
  `time_slot` enum('1','2','3') COLLATE utf8_unicode_ci DEFAULT NULL,
  `days_slots` enum('1','2','3','4','5','6') COLLATE utf8_unicode_ci DEFAULT NULL,
  `period_from` datetime NOT NULL COMMENT 'ad show from',
  `period_to` datetime NOT NULL COMMENT 'ad show from',
  `ad_status` enum('1','2','3','4') COLLATE utf8_unicode_ci DEFAULT NULL,
  `ad_payment_status` enum('2','1') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-payment success,2-not yet done',
  `payment_id` int(11) NOT NULL COMMENT 'payment history id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`id`, `user_id`, `service`, `ad_banner`, `ad_header`, `ad_description`, `amount`, `ad_offer`, `ad_offer_percentage`, `time_slot`, `days_slots`, `period_from`, `period_to`, `ad_status`, `ad_payment_status`, `payment_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 36, 110, '1533594000.png', 'Pay for 2 Restylane fillers (cheeks and lips only) and get the third for free. ', 'Limited time ', '200', '1', 'Pay for 2 Restylane fillers (cheeks and lips only) and get the third for free. ', '1', '', '2018-08-06 00:00:00', '2018-08-12 00:00:00', '3', '1', 1, '2018-08-07 06:21:28', '2018-08-07 07:00:05', NULL),
(2, 36, 110, '1533922515.png', 'LIP FILLER CLINICS IN SHEFFIELD & YORK. BOOK NOW!!', 'first advert', '100', '2', '', '1', '', '2018-08-10 00:00:00', '2018-08-16 00:00:00', '1', '1', 2, '2018-08-11 01:36:12', '2018-08-11 03:48:07', NULL),
(8, 36, 110, '1534514292.png', 'LIP FILLER CLINICS IN SHEFFIELD & YORK. BOOK NOW!!', '1st', '100', '2', '', '1', '', '2018-08-17 00:00:00', '2018-08-23 00:00:00', '1', '1', 8, '2018-08-17 21:58:45', '2018-08-17 21:58:48', NULL),
(11, 36, 110, '1535140878.png', 'LIP FILLER CLINICS IN SHEFFIELD & YORK. BOOK NOW!!', '1st', '0', '2', '', '3', '', '2018-08-24 00:00:00', '2018-09-13 00:00:00', NULL, '2', 0, '2018-08-25 04:01:44', '2018-08-25 04:01:44', NULL),
(12, 36, 110, '1535141060.png', 'LIP FILLER CLINICS IN SHEFFIELD & YORK. BOOK NOW!!', '1st', '150', '2', '', '3', '', '2018-08-24 00:00:00', '2018-09-13 00:00:00', NULL, '2', 0, '2018-08-25 04:05:18', '2018-08-25 04:05:18', NULL),
(16, 36, 110, '1535241218.png', 'LIP FILLER CLINICS IN SHEFFIELD & YORK. BOOK NOW!!', '2nd', '150', '2', '', '3', '', '2018-08-26 00:00:00', '2018-09-15 00:00:00', '1', '1', 14, '2018-08-26 07:53:43', '2018-08-26 07:53:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `advertisement_amount`
--

CREATE TABLE `advertisement_amount` (
  `id` int(10) UNSIGNED NOT NULL,
  `ad_type` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-weeks,2-days',
  `ad_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'advertisement amount by super-admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `advertisement_amount`
--

INSERT INTO `advertisement_amount` (`id`, `ad_type`, `ad_amount`, `created_at`, `updated_at`) VALUES
(3, '2', '200', '2018-08-07 05:44:03', '2018-08-07 05:44:03'),
(4, '1', '100', '2018-08-07 06:18:06', '2018-08-11 01:31:11'),
(6, '1', '50', '2018-08-25 04:03:11', '2018-08-25 04:03:11');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement_type`
--

CREATE TABLE `advertisement_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `ad_days` enum('1','2') COLLATE utf8_unicode_ci NOT NULL,
  `ad_weeks` enum('1','2') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `advertisement_type`
--

INSERT INTO `advertisement_type` (`id`, `ad_days`, `ad_weeks`, `created_at`, `updated_at`) VALUES
(1, '2', '1', '2018-06-30 01:00:47', '2018-06-30 01:00:47'),
(2, '1', '2', '2018-06-30 01:16:10', '2018-06-30 01:16:10'),
(3, '2', '1', '2018-06-30 01:18:08', '2018-06-30 01:18:08'),
(4, '2', '1', '2018-06-30 03:31:29', '2018-06-30 03:31:29'),
(5, '2', '1', '2018-06-30 03:32:12', '2018-06-30 03:32:12'),
(6, '2', '1', '2018-08-29 00:19:53', '2018-08-29 00:19:53'),
(7, '2', '1', '2018-10-04 17:49:29', '2018-10-04 17:49:29');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'end user id',
  `provider_id` int(11) NOT NULL COMMENT 'provider id',
  `service_needed` int(11) NOT NULL COMMENT 'service id',
  `service_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'service amount when appointment requested',
  `quantity` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'brand volume',
  `time_needed` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'time needed for surgery(in hrs)',
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preferred_date` date NOT NULL,
  `appointment_time_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ex: 11:00 - 13:00',
  `appointment_time_to` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ex: 11:00 - 13:00',
  `appointment_status` enum('1','2','3','4','5','6') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-request,2-accepted,3-declined by provider,4-cancelled by user,5-cancelled by provider,6-cancelled due to no payment within 1 day',
  `appointment_type` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-(user to provider ), 2-(non-prescriber to prescriber)',
  `payment_status` enum('2','1') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-paid,2-appointment request sent status',
  `payment_id` int(11) NOT NULL COMMENT 'payment history id',
  `declined_by` int(11) NOT NULL COMMENT 'by provider or user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'provider id',
  `account_info` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'json data of form post',
  `account_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'account id in stripe connected account',
  `stripe_response` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'stripe response after create custom bank account',
  `status` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT 'account_status',
  `default_account` enum('2','1') COLLATE utf8_unicode_ci NOT NULL COMMENT 'this external account will be the default account',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(10) UNSIGNED NOT NULL,
  `blog_header` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `blog_content` text COLLATE utf8_unicode_ci NOT NULL,
  `blog_banner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `blog_status` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-active,2-deactivate',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `blog_header`, `blog_content`, `blog_banner`, `blog_status`, `created_at`, `updated_at`) VALUES
(2, 'Eye Trend', '<h4>CoolSculpting: The Fat Reducer</h4>\r\n\r\n<p>The aesthetic market is not too different to the property market in many ways.&nbsp; While Brexit and London politics delay consumers&rsquo; impulses to invest in big changes, a similar trend is becoming noticeable in surgery, where smaller less invasive treatments are increasing in popularity.</p>\r\n\r\n<p>With summer around the corner and physical appearances is at the forefront of minds making, we will evaluate a trending treatment on the rise, as advancements in technology allow for maximum results without surgical intervention. Body contouring has evolved from a beauty buzzword to big business with CoolSculpting considered the latest safest FDA approved non-surgical treatment available at medi-spas and clinics worldwide.</p>\r\n\r\n<p>Body fat, mummy tummies, muffin tops, love handles, double chins and the likes can be incredibly difficult to shift, despite trying the latest fad diet or exercise. What if we could tell you it&rsquo;s possible in less than an hour? CoolSculpting is a treatment that is instantly noticeable and long lasting. Spotted in the brochures of leading spas and clinics, glossing the pages of beauty and fashion magazines, but what exactly does it do and how does it help turn back the clock?</p>\r\n\r\n<p>Targeting unwanted fat from different areas of the body, from love handles to double chins, the stomach to thigh fat, this procedure cryolipolysis&nbsp;uses the concept of cold temperature freezing and eliminating pockets of fat cells. It safely delivers precisely controlled cooling to fat cells beneath the skin; the targeted cells crystallises then shrivel and die over the coming weeks, your body then metabolises this and disposes of them naturally.</p>\r\n\r\n<p>Discovered by two Harvard scientists who made the observation and started looking into the effect cold has on fat when they noticed children getting dimples after eating popsicles. They realized the icy treats were freezing pockets of fat cells. A process that could remove unwanted fat without damaging the skin was born.</p>\r\n\r\n<p>CoolSculpting is considered to be a trusted procedure amongst the likes of Dr Edward Fruitman, Founder of Trifecta Med Spa, New York. Acknowledged as &ldquo;the most successful non-surgical fat removal treatment for many reasons, mainly because it works, on average patients lose 25-30% of fat in the treatment area. Also, it&rsquo;s quick &ndash; it&rsquo;s only a 35 min lunchtime procedure- painless and has no downtime&rdquo;.</p>\r\n\r\n<p>The appropriate candidate for the procedure, ideally have to be those who eat a healthy diet and exercise; they need to have subcutaneous fat, which is grabbable or pinchable fat to ensure effectiveness and maximum results. It can also be used for curvier patients to reduce the fat throughout a weight-loss lifestyle programme.</p>\r\n\r\n<p>Results can show from 3 weeks with optimum results at 12 weeks and a post review is necessary to ensure the procedure reached maximum effectiveness. The process offers long lasting results because the body permanently gets rid the fat cells. And since it is non-surgical, there is no downtime. Patients can resume their normal activities immediately after their treatment.</p>\r\n\r\n<p>Reshape, redefine and re-contour your body non-surgically with little down time. For more information or to book a consultation, get in touch today to find out how we can help you.</p>\r\n', '2_1536061605.jpg', '1', '2018-09-04 19:38:31', '2018-09-04 19:46:45'),
(3, 'Save Face: Jane Iredale Lemongrass Hydration Spray', '<p>Hydration sprays are an overlooked beauty staple, we love them but what do they actually do? We recognise that they have an official purpose but interestingly, there are also alternative and creative uses for these beauty products. Hydration Sprays work simply as a facial spray, formulated to hydrate your skin and set your mineral powder. Individual hydration sprays have their own special added benefits depending on the product itself. Use hydrating sprays prior to applying foundation so as to ensure your skin is suitably nourished otherwise to set your mineral powder, a spritz helps captures the dewiness whilst keeping your makeup intact.</p>\r\n\r\n<p>This is where <u><a href=\"https://www.janeiredale.co.uk/\"><span style=\"color:#3498db\">Jane Iredale</span></a></u> comes in &ndash; notorious for her collection of eco-friendly and high-end mineral cosmetics, she introduced a makeup line which nurtures and protects skin.</p>\r\n\r\n<p>Jane Iredale&rsquo;s <u><a href=\"https://www.janeiredale.co.uk/hydration-sprays\"><span style=\"color:#3498db\">Lemongrass Love Hydration Spray</span></a></u> is a soothing facial spritz with a lemony scent and ideal for all skin types. Formulated to hydrate, protect and condition skin, it is the perfect handbag staple for the summer. Minimising oiliness and pore appearance, celebrities swear by this product. Free from parabens and ECCOCERT &ndash; certified natural and organic, it has been proven to help minimise excess shine and the appearance of pores, as worn by actress Carice van Houten in Game of Thrones.</p>\r\n\r\n<h4>Key ingredients in Lemongrass Love:</h4>\r\n\r\n<ul>\r\n	<li>Aloe Leaf Juice</li>\r\n	<li>Lemon Grass Oil and Lemon Grass Extract</li>\r\n	<li>Chamomile Flower Extract</li>\r\n</ul>\r\n\r\n<h4>Why Invest?</h4>\r\n\r\n<ul>\r\n	<li>Minimises the appearance of pores and keeps oiliness in check.</li>\r\n	<li>Hydrates, conditions and protects all skin types leaving skin looking refreshed and smooth.</li>\r\n	<li>A boost of hydration that reenergizes and awakens the senses.</li>\r\n	<li>An instant pick-me-up that relieves symptoms of jetlag and stress.</li>\r\n	<li>Created without the use of parabens, sulfates and phthalates.</li>\r\n	<li>Certified ECOCERT Natural &amp; Organic.</li>\r\n	<li>Revives &amp; refreshes .</li>\r\n	<li>Calms and soothes.</li>\r\n	<li>Reduces dryness, redness, itching and sensitivity.</li>\r\n</ul>\r\n', '2_1536062407.png', '1', '2018-09-04 20:00:07', '2018-09-16 22:16:28'),
(4, 'It’s a Game Changer: Top 5 Beauty Innovations ', '<p>It&rsquo;s been noted that the number of people willing to go under the knife in the name of beauty is on the decline (research from the British Association of Aesthetic Plastic Surgeons shows a fall in cosmetic surgical procedures of nearly 8% in 2017 YoY), so naturally now is the perfect time to consider and explore procedures that do not require a intensive surgery. We checked out the latest game-changing beauty innovations, letting you look your best without the fear-inducing invasive surgery.</p>\r\n\r\n<p>It&rsquo;s evident that the search for the fountain of youth has been going on for centuries what with all the beauty serums, pills and products making promise after promise. However non-invasive beauty treatments are effective in better and longer lasting results. As we age, we know our skin naturally starts to sag and lose its youthful elasticity.</p>\r\n\r\n<p><strong>Reverse aging through&nbsp;Rejuran Skin Healer</strong> is gaining popularity as an age-reversal medical treatment at the cellular level. Unlike other aesthetic treatments, Rejuran Healer is filler made of&nbsp;<strong><em>polynucleotides</em></strong>, also known as DNA, which is harvested from salmon (interestingly Victoria&rsquo;s dermatologist had always told to eat salmon for her problematic skin!) Doctors to foster wound healing in diabetic patients have traditionally used salmon DNA. The filler is given to the patient using a micro-needle into the superficial layer of the skin, which allows its anti-aging benefits seep into the skin.</p>\r\n\r\n<p><strong>K Beauty has brought with it, the latest trend that is &#39;Glass skin&rsquo;:</strong> it refers to a glowing complexion so smooth and flawless that it looks like a pane of glass.&nbsp;Achieving a glowing, almost reflective skin is only possible if there are no facial wrinkles, pigmentation, enlarged pores, and scars. As such, the only way to achieve &lsquo;glass skin&rsquo; is to eliminate pigmentation and reduce pore size.&nbsp;This can be achieved with&nbsp;laser treatment for pigmentation&nbsp;and&nbsp;carbon laser peel treatment.</p>\r\n\r\n<p><strong>Facial Slimming</strong> is now possible and you can easily blitz your baby fat with Radiolysis Facial Slimming, which is an entirely safe&nbsp;non-surgical face slimming&nbsp;treatment&nbsp;which uses micro-needles to&nbsp; &#39;melt&#39; the fats in your face&nbsp;by applying radiofrequency waves into the fatty deposits. As the fatty tissues are broken down, your body will drain them naturally from the circulatory system. Voila - a youthful, slimmer face is now yours all in a short time.</p>\r\n\r\n<p><strong>Cellfina</strong></p>\r\n\r\n<p>Our obsession to achieve the perfect bum reminiscent of Kim K has led to seeking non-surgery alternatives. The first FDA-approved minimally invasive cellulite procedure to target bottom and thigh dimples, Cellfina claims to reduce the appearance of &#39;orange peel&#39; skin by 90%. Unlike other procedures, Cellfina treats the structural cause of cellulite, breaking up networks of connective tissue bands that can lead to puckering on the skin&#39;s surface. A session takes just 45 minutes and can last for up to three years.</p>\r\n', '2_1536063169.jpg', '1', '2018-09-04 20:12:49', '2018-09-04 20:19:08'),
(5, 'Top Skincare Secrets As Told By Celebs', '<p>In the world of beauty and skincare, everyday brings with it an influx of new beauty &lsquo;tricks&rsquo; and words of wisdom being imparted; from alternative ways to use a beauty blender to things you never knew you could do with primer. We give you the low down on beauty secrets that are literal game changers from celebrities themselves. With skin secrets good enough for the red carpet to make up hacks, A-listers are the perfect people to offer their insight into skin and beauty regimes.</p>\r\n\r\n<h4>Victoria Beckham</h4>\r\n\r\n<p>A loyal fan of Lancer products, Beckham&rsquo;s dermatologist is the leading person behind the product. Loaded with exfoliating acids, glycolic and phytic and retinol, the product promises to renew the surface of the skin, making it baby soft and bouncy. Victoria has been known to share details of Lancer products especially their peeling cream on her social media, posting it on her Stories with the caption &ldquo;Love it!&rdquo;<em><strong> (Lancer Caviar Lime Acid Peel, &pound;90)</strong></em></p>\r\n\r\n<h4>Gwyneth Paltrow</h4>\r\n\r\n<p>Gwyneth Paltrow attributes the cleaning solution as &quot;the best make-up remover&quot;. She explains, &quot;it&#39;s unscented, doesn&#39;t dry your skin or sting, and gets rid of all your make-up with a few swipes. You&#39;re left with soft, clean skin.&quot;</p>\r\n\r\n<p><strong>Bioderma Sensibio H2O Micellar Water, &pound;7.82</strong></p>\r\n\r\n<p>Before Amal Clooney graces the red carpet, make-up artist Charlotte Tilbury preps the star&#39;s skin with her dry sheet mask, which reduces wrinkles, smooth, brighten, lift and hydrate the skin. No need for foundation here.</p>\r\n\r\n<p><strong>Charlotte Tilbury Instant Magic Facial Dry Sheet Mask, &pound;18</strong></p>\r\n\r\n<p><strong>Priyanka Chopra</strong></p>\r\n\r\n<p>Actress Priyanka uses the luxe 111Skin Bio-Cellulose Facial Treatment Mask to prime her skin. As mentioned in People Style, Chopra&nbsp;said she uses it&nbsp;daily:&nbsp;&quot;It&#39;s the first thing that goes on my face before any make-up, and it makes anything I put on after look flawless.&quot; This is more on the high end of skin rituals but perhaps one that makes for complexion perfection.</p>\r\n\r\n<p><strong>111Skin Bio-Cellulose Facial Treatment Mask, &pound;85</strong></p>\r\n\r\n<p><strong>Gal Gadot</strong></p>\r\n\r\n<p>With La Mer being a brand recently back on everyone&rsquo;s minds due to their London pop up events, it is no wonder their classic products are a favourite with Gal Gadot. Refreshingly light and a trusted product, Gadot is a fan of their Cleansing Oil and moisturiser. &quot;Before I go to bed, I take off all my make-up with La Mer Cleansing Oil and moisturise my face.&quot;</p>\r\n\r\n<p><strong>Cr&egrave;me de la Mer - The Cleansing Oil, &pound;65</strong></p>\r\n', '2_1536063619.jpg', '1', '2018-09-04 20:20:19', '2018-09-04 20:24:10'),
(7, 'Get the Perfect Pout with LinkAesthetics', '<p>Lip fillers, an ever popular trend are constantly on the rise, with the surge of celebrities opting to seek out the perfect pout. We at LinkAesthetics pride ourselves on ensuring you receive the best quality treatment by authorised and thoroughly vetted practioners, avoiding the problematic issue of cowboy injectors exploiting unsuspecting patients. However, if you are having lip augmentation elsewhere, here is what to look out for.</p>\r\n\r\n<p><strong>Having lip fillers for the first time? This is what your practitioner should guarantee you with, for satisfactory results:</strong></p>\r\n\r\n<p><em><strong>A thorough consultation:</strong></em></p>\r\n\r\n<p>You receive quality time with your practitioner for the initial consultation alone. &ldquo;The consultation consists of a medical history being taken and discussed, including any medicines and allergies noted. The client&rsquo;s desires and expectations should be discussed in detail, including shape, definition and volume.&rdquo; Your lip filler practitioner should also take a psychological and physical assessment, and explain the procedure, the brand of filler they use, the possible side effects and the aftercare you need.</p>\r\n\r\n<p><em><strong>They should allow you time to change your mind:</strong></em></p>\r\n\r\n<p>Your practitioner should want you to be 100% satisfied that you have had the chance to consider if this is something you really want. Your consultation should just be a first step, a chance for the lip filler/augmentation practitioner to make sure you&rsquo;re an appropriate candidate for the treatment, and more importantly, for you to be certain it&rsquo;s the right choice for you. Having a consultation before the treatment gives you the opportunity to research the treatments and return with any questions.</p>\r\n\r\n<p><em><strong>Reach a decision with your practitioner:</strong></em></p>\r\n\r\n<p>What should happen? You have done your research and looked into how much filler you want, but your aesthetics injector is the professional and have their own opinion based on their knowledge and experience. They should have a thorough discussion with yourself to decide on a treatment plan together, based on the physical assessment and their expertise as well as your desired results.</p>\r\n\r\n<p><em><strong>Your aesthetics practitioner should guarantee you thorough aftercare:</strong></em></p>\r\n\r\n<p>Before you leave the treatment room, your practitioner should supply you with both aftercare advice and contact details including an out-of-hours service that you can contact if you are worried about anything.</p>\r\n\r\n<p>LinkAesthetics can help you to minimise risks with your treatments, as we strive to guarantee quality services and aftercare. No more botched lip fillers and cheek augmentations.</p>\r\n', '2_1536268323.jpg', '1', '2018-09-07 05:12:03', '2018-09-07 05:49:53'),
(8, 'Superdrug to Offer In-Store Aesthetics Treatments such as Botox and Lip Fillers: What Does This Mean for Existing Aestheticians? ', '<p>&nbsp;</p>\r\n\r\n<p>The recent news that Superdrug is set to start offering aesthetics treatments such as Botox&nbsp;and lip fillers in their&nbsp;high-street&nbsp;stores raises a lot of questions about what the future holds for existing aestheticians. Whilst this new competition may be daunting for existing aestheticians, are there elements of the customer &ndash; provider relationship that a&nbsp;high street&nbsp;chain simply can&rsquo;t match?&nbsp;</p>\r\n\r\n<p><strong>What is Superdrug offering?&nbsp;</strong></p>\r\n\r\n<p>The aesthetics treatments on offer at Superdrug will begin at &pound;99 for a standard Botox treatment for areas such as forehead or crow&rsquo;s feet.&nbsp;Superdrug is hiring only qualified nurses to carry out the lip filler, anti-wrinkling and Botox treatments, and insists that they are committed to providing the highest standard of service and safety.&nbsp;&nbsp;</p>\r\n\r\n<p>It is thought that&nbsp;recent television&nbsp;programs such as Love Island have further popularised treatments such as Botox, lip fillers such as&nbsp;Juviderm&nbsp;and Restylane, and anti-wrinkle treatments, particularly amongst younger clients.&nbsp;Superdrug&nbsp;hopes to capitalise on this increased demand, and has begun delivering treatments at its flagship store in London before branching out across its national network of high-street stores.&nbsp;</p>\r\n\r\n<p>However, the fact that&nbsp;Superdrug will only be offering aesthetics treatments to people over the age of 25&nbsp;means&nbsp;that a significant portion of younger clients will not be able to use this service.&nbsp;This perhaps points to some of the limitations of Superdrug&rsquo;s venture in to the aesthetics market, especially given the significant increase in the number of 18-25 years&nbsp;olds&nbsp;seeking lip filler treatments such as Restylane and&nbsp;Juviderm, as well as more traditional Botox treatments.&nbsp;</p>\r\n\r\n<p><strong>What does this mean for freelance&nbsp;aestheticians and clinics?&nbsp;</strong></p>\r\n\r\n<p>Whilst this new competition in the aesthetics market may concern some existing aestheticians, it is important to remember that the demand on freelancers and clinics&nbsp;for lip fillers, Botox and anti-wrinkling, as well as a growing number of new treatments, has never been higher. In recent years, around 100,000 Botox treatments have been carried out in the UK annually, with non-surgical treatments generating almost 3 billion pounds a year. The opportunities for existing aestheticians to grow their businesses continue to emerge.&nbsp;&nbsp;</p>\r\n\r\n<p>One&nbsp;area&nbsp;where&nbsp;high street&nbsp;chains will struggle to measure up with freelance aestheticians is in terms of building and maintaining client relationships. Aestheticians with a regular client base have much greater opportunities to&nbsp;build trust and confidence with their clients, to&nbsp;recommend new treatments and introduce new products.&nbsp;&nbsp;</p>\r\n\r\n<p>Building a strong client base and developing relationships with clients gives aesthetics providers the opportunity&nbsp;to market their skills and expertise, and introduce clients to&nbsp;new treatments that they offer. For&nbsp;high-street&nbsp;chains offering aesthetic treatments, it is likely to be more difficult to establish that personal touch and build trust between client and provider.&nbsp;&nbsp;</p>\r\n', '2_1536270788.jpg', '1', '2018-09-07 05:53:08', '2018-09-07 05:53:08');

-- --------------------------------------------------------

--
-- Table structure for table `cancelled_appointment`
--

CREATE TABLE `cancelled_appointment` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` enum('end_user','non_prescriber','prescriber','super_admin') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-end user,2-prescriber,3-noprescriber,4-super admin',
  `appointment_type` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-user appointment,2-nonprescriber appointment',
  `appointment_id` int(11) NOT NULL,
  `status` enum('1','2','3') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-dedcted the amount form the payout,2-pending,3-cancelled by user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disclaimers`
--

CREATE TABLE `disclaimers` (
  `id` int(10) UNSIGNED NOT NULL,
  `disclaimer` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('1','2','3') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `disclaimers`
--

INSERT INTO `disclaimers` (`id`, `disclaimer`, `type`, `created_at`, `updated_at`) VALUES
(1, '<p>Please ensure that you have checked all details concerning your booking including the provider&#39;s refund, cancellation and customer dissatisfaction policy. As per our terms and conditions, please be aware that if you cancel your appointment after payment is made, any refund due will not include the commission taken by LinkAesthetics. By continuing with your booking, you agree that you have read and understood our terms and conditions.</p>\n', '1', '2018-06-22 19:31:50', '2018-07-09 16:59:35'),
(3, '<p><span style=\"font-size:12pt\"><span style=\"color:black\"><strong><u><span style=\"font-size:11.0pt\">LinkAesthetics</span></u></strong><strong><u><span style=\"font-size:11.0pt\">: Privacy &amp; Cookie Policy &nbsp;</span></u></strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\">1.&nbsp; Introduction</span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">1.1</span>&nbsp; <span style=\"font-size:11.0pt\">The LINKAESTHETICS website is owned and operated by </span><span style=\"font-size:11.0pt\">LinkAesthetics Ltd of Flat 27, Lovell House, Skinner Lane, Leeds LS7 1AR </span><span style=\"font-size:11.0pt\">(<strong>we</strong>, <strong>us</strong>). </span><span style=\"font-size:11.0pt\">This Privacy &amp; Cookie Policy affects your legal rights and obligations so please read it carefully. If you do not agree to be bound by this Privacy &amp; Cookie Policy, do not use our</span><span style=\"font-size:11.0pt\"> website</span><span style=\"font-size:11.0pt\">. If you have any questions, you can contact us at info@linkaesthetics.com.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-size:11.0pt\">1.2&nbsp;&nbsp; We reserve the right to amend this Privacy &amp; Cookie Policy from time to time at our discretion. </span><span style=\"font-size:11.0pt\">If we reasonably believe that the amendment is significant, we shall notify all registered users by email.&nbsp; Otherwise, the amended </span><span style=\"font-size:11.0pt\">Privacy &amp; Cookie Policy</span><span style=\"font-size:11.0pt\"> will be effective as soon as it is accessible. You are responsible for regularly reviewing this </span><span style=\"font-size:11.0pt\">Privacy &amp; Cookie Policy</span><span style=\"font-size:11.0pt\"> so that you are aware of any amendments.</span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">1.3&nbsp;&nbsp; This Privacy &amp; Cookie Policy applies to all users of our</span><span style=\"font-size:11.0pt\"> website, including consumers and service providers together with</span><span style=\"font-size:11.0pt\"> anyone else who provides information to us.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">1.4&nbsp;&nbsp; We are the controller of the personal data that you provide to us.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\">2.&nbsp; Collecting Your Data&nbsp; </span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">2.1&nbsp;&nbsp;&nbsp; When you register as a customer on our website we will collect details of your name, email address, geographical address and telephone number.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">2.2&nbsp;&nbsp; When you register as a service provider on our website, we will collect details of your name, email address, geographical address, telephone number, relevant certifications and experience, together with all additional information you upload to your profile. </span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">2.3&nbsp;&nbsp; </span><span style=\"font-size:11.0pt\">If you link, connect, or login to your LinkAesthetics Account with a third party service (e.g.Facebook), the third party service may send us information such as your registration and profile information from that service. This information varies and is controlled by that service or as authorized by you via your privacy settings at that service.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">2.4&nbsp;&nbsp; All personal data that you provide to us must be true, complete and accurate and you must not register under someone else&rsquo;s name.&nbsp; &nbsp;</span><span style=\"font-size:11.0pt\">When you contact us by email or post, we may keep a record of the correspondence and we may also record any telephone call we have with you.</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\">3.&nbsp; Use of your personal data</span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-size:11.0pt\">3.1&nbsp;&nbsp; </span><span style=\"font-size:11.0pt\">We shall use your personal data in order to fulfill our contractual obligations to you, in particular to enable you to access and use the Site and services available through the site,</span><span style=\"font-size:11.0pt\"> and accordingly, as a service provider, you agree that your personal data is accessible by all users of our website; </span><span style=\"font-size:11.0pt\">to notify you about changes to this Privacy Policy and our Terms of Use; and to provide you with requested information in response from an enquiry from you.</span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-size:11.0pt\">3.2&nbsp;&nbsp; In addition, for our legitimate interests, we shall use your personal data to enforce our Privacy Policy and our Terms of Use, and for regulatory, legal purposes and audit purposes</span><span style=\"font-size:11.0pt\">.</span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">3.3&nbsp;&nbsp; We may share your personal data with third parties for our legitimate interests. We may share your personal data </span><span style=\"font-size:11.0pt\">with any service providers, sub-contractors and agents that we may appoint to perform functions on our behalf and in accordance with our instructions, including IT service providers, payment providers, email service providers, accountants, auditors and lawyers.</span><span style=\"font-size:11.0pt\">&nbsp; We shall provide our </span><span style=\"font-size:11.0pt\">service providers, sub-contractors and agents only with such of your personal data as they need to provide the service for us and if we stop using their services, we shall request that they delete your personal data or make it anonymous within their systems.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">3.4&nbsp;&nbsp; Under certain circumstances we may have to disclose your personal data under applicable laws and/or regulations, for example, to</span><span style=\"font-size:11.0pt\"> protect a third party&rsquo;s rights, property, or safety.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">3.5&nbsp;&nbsp; For our legitimate interests, we</span><span style=\"font-size:11.0pt\"> may also share your personal data in </span><span style=\"font-size:11.0pt\">connection with, or during negotiations of, any merger, sale of assets, consolidation or restructuring, financing, or acquisition of all or a portion of our business by or into another company.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\">4.&nbsp;&nbsp; Marketing</span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-size:11.0pt\">4.1&nbsp;&nbsp; When you register with </span><span style=\"font-size:11.0pt\">our website</span><span style=\"font-size:11.0pt\">, you may consent to receive marketing email messages from us.&nbsp; You can choose to no longer receive marketing emails from us by updating your account, contacting us at [<em>email address</em>] or clicking unsubscribe from a marketing email. </span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-size:11.0pt\">4.2&nbsp;&nbsp; </span><span style=\"font-size:11.0pt\">We shall therefore retain your personal data in our records for marketing purposes until you notify us that you no longer wish to receive </span><span style=\"font-size:11.0pt\">marketing </span><span style=\"font-size:11.0pt\">emails from us. </span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\">5.&nbsp;&nbsp; Information about your device</span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">5.1&nbsp;&nbsp; When you use </span><span style=\"font-size:11.0pt\">our website</span><span style=\"font-size:11.0pt\"> we automatically collect and store information about your device and your activities. This information could include (a) your device&rsquo;s unique ID number; (b) your device&rsquo;s geographic location; (c) your IP address; (d) technical information about your device such as type of device, web browser or operating system; (e) your preferences and settings such as time zone and language; (f) how long you used the app and which services and features you used. </span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">5.2&nbsp;&nbsp; We will use information about your device to customise, measure and improve our services, content and advertising and to understand our users better.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\">6.&nbsp;&nbsp; Where we hold and process your personal data</span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">6.1&nbsp;&nbsp; </span><span style=\"font-size:11.0pt\">Some or all of your personal data may be stored or transferred outside of the European Economic Area (the <strong>EEA</strong>) for any reason, including for example, if our email server is located in a country outside the EEA or if any of our service providers are based outside of the EEA. You are deemed to accept and agree to this by using the system and submitting information to us. </span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">6.2&nbsp;&nbsp; If we do store or transfer your personal data outside the EEA, we will take all reasonable steps to ensure that your data is treated as safely and securely as it would be within the EEA and under applicable laws.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\">7.&nbsp;&nbsp; Security</span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-size:11.0pt\">7.1&nbsp;&nbsp; We take appropriate security measures (including physical, electronic and procedural measures) to help safeguard your personal data from unauthorized access and disclosure.</span><span style=\"font-size:11.0pt\"><span style=\"color:black\"> The technology that we use and the security policies which we have implemented are intended to safeguard your information from unauthorised access and improper use. </span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-size:11.0pt\">7.2&nbsp;&nbsp; Notwithstanding the above, you agree that no system can be completely secure. Therefore, although we take steps to secure your information, we do not promise that your personal data or other content that you upload to our website will always remain secure.&nbsp; </span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><strong><span style=\"font-size:11.0pt\">8.&nbsp;&nbsp; Your rights</span></strong></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">8.1&nbsp;&nbsp; </span><span style=\"font-size:11.0pt\">You have a number of rights under applicable laws.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">8.2&nbsp;&nbsp; You have the right to access data that we hold about you, the right to correct and update data that we hold about you, the right to have your data erased, the right to object to processing of your data, the right to ask us to stop contacting you for marketing purposes, the right to request that we transfer your data to another controller and the right to object to automated decision making and/or profiling.&nbsp; </span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">8.3&nbsp;&nbsp; To exercise these rights, or any other rights you may have under applicable laws, please contact us</span><span style=\"font-size:11.0pt\">.&nbsp; We shall confirm when we have carried out your request.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-size:11.0pt\">8.4&nbsp;&nbsp; Please note, we reserve the right to charge an administrative fee if your request is manifestly unfounded or excessive.</span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-size:11.0pt\">8.5&nbsp;&nbsp; If you have any complaints in relation to this policy or otherwise in relation to our processing of your personal data, please contact us. You can also contact the UK supervisory authority:&nbsp; the Information Commissioner, see </span><a href=\"http://www.ico.org.uk\"><span style=\"font-size:11.0pt\">www.ico.org.uk</span></a><span style=\"font-size:11.0pt\">. <u>If<em> </em>you are outside of the UK, you have the right to lodge your complaint with the relevant data protection regulator in your country of residence.</u></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\">9.&nbsp;&nbsp; Cookies</span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">9.1&nbsp;&nbsp; A cookie is a small file that asks permission to be placed on your </span><span style=\"font-size:11.0pt\">browser&rsquo;s memory or alternatively </span><span style=\"font-size:11.0pt\">your computer&#39;s hard drive.</span><span style=\"font-size:11.0pt\">&nbsp; Cookies placed in your browser&rsquo;s memory are called session cookies and cookies placed on your computer&rsquo;s hard drive are called persistent cookies. Session cookies are deleted when you close your browser, while persistent cookies remain on your hard drive, even after closing your browser. Session cookies are generally used to improve the user experience when using a website. Persistent cookies are generally used to store user preferences, including the preference to keep a user signed in, between browser sessions.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">9.2&nbsp;&nbsp; Cookies help us to provide you with a better website, by enabling us to monitor which pages you find useful and which you do not. </span><span style=\"font-size:11.0pt\">You can delete cookies at any time or you can set your browser to reject or disable cookies although this may disable some of the functionality of the website.&nbsp;&nbsp; </span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-size:11.0pt\">9.3&nbsp;&nbsp; On this website we use a session cookie to track whether a user is logged into the website or not.&nbsp; We also allow analytics companies, such as Google Analytics, to use tracking technologies to collect information about our users&rsquo; computers or mobile devices and their online activities. These companies analyse this information to help us understand how the website is being used. Unlike cookies, this tracking technology cannot be deleted.&nbsp; In order to recognize you, store your preferences, and track your use of the website, we may store your device IDs (the unique identifier assigned to a device by the manufacturer) when you use the website. </span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">9.4&nbsp;&nbsp; We may collect anonymous data through cookies to enable us</span><span style=\"font-size:11.0pt\"> &nbsp;better to understand our users, diagnose and fix problems with out website; and for research purposes and for our general business purposes.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\">10. General</span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">10.1&nbsp; If any provision of this Privacy &amp; Cookie Policy is held by a court of competent jurisdiction to be invalid or unenforceable, then such provision shall be construed, as nearly as possible, to reflect the intentions of the parties and all other provisions shall remain in full force and effect.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">10.2&nbsp; This Privacy &amp; Cookie Policy shall be governed by and construed in accordance with the law of England and Wales, and you agree to submit to the exclusive jurisdiction of the English Courts.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\"><span style=\"font-size:11.0pt\">Last updated: May 2018</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"color:black\">&nbsp;</span></span></p>\r\n', '3', '2018-07-07 00:12:00', '2018-07-09 20:35:43');
INSERT INTO `disclaimers` (`id`, `disclaimer`, `type`, `created_at`, `updated_at`) VALUES
(5, '<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><u><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">LinkAesthetics</span></span></u></strong><strong><u><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">: </span></span></u></strong><strong><u><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Terms of Use</span></span></u></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Introduction </span></span></strong></span></span></p>\r\n\r\n<ol>\r\n	<li>\r\n	<ol>\r\n		<li><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">The LinkAesthetics website (the <strong>Site</strong>) is owned and operated by LinkAesthetics</span></span> <span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Ltd, a company registered in England and Wales with registered number 11032830 and with its registered office at Flat 27, Lovell House, Skinner Lane, Leeds, LS7 1AR </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(<strong>LinkAesthetics</strong>, <strong>we</strong>, <strong>us</strong>).&nbsp; By using the Site you agree to be bound by these terms of use (the <strong>Terms</strong>) together with the privacy and cookie policy accessible in the Site (the <strong>Privacy &amp; Cookie Policy</strong>). These Terms and the Privacy &amp; Cookie Policy affect your legal rights and obligations so please read them carefully. If you do not agree to be bound by these Terms and/or the Privacy &amp; Cookie Policy, do not use the Site. If you have any questions, you can contact us by email at </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">info@linkaesthetics.com.</span></span></span></span></span></li>\r\n		<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">We reserve the right to amend these Terms from time to time at our discretion. </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#262626\">We may do so for technical or legal reasons, or because the needs of our business have changed. You agree that if you do not accept any amendment to our Terms then you shall immediately stop accessing and/or using the Site.</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> If we reasonably believe that the amendment is significant, we shall notify all registered users by email. Otherwise, the amended Terms will be effective as soon as they are accessible. You are responsible for regularly reviewing these Terms so that you are aware of any amendments.</span></span></span></span></li>\r\n		<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">The Site operates as a platform for providers of Aesthetic Procedures to promote their services, and for Customers to connect, book such services and pay for those services.&nbsp; We also enable Non-Prescribing Providers to communicate with Prescribing Providers for the purposes of obtaining Prescription Services.&nbsp; LinkAesthetics does not provide Aesthetic Procedures and/or Prescription Services itself.</span></span></span></span></li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Definitions</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">2.1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">In these Terms, the following words have the following meanings: </span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Aesthetic Procedure: </span></span></strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">procedures that focus on improving cosmetic appearance;</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Commission:</span></span></strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> the sum retained from the Fee by LinkAesthetics in consideration of the provision of the platform services calculated as 10% of the Fees;</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Customer: </span></span></strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">an individual who registers on the Site and/or books an Aesthetic Procedure through the Site;</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Fees: </span></span></strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">the fees due from a Customer for an Aesthetic Procedure or from a &nbsp;Non-Prescribing Provider for Prescription Services;</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Non-Prescribing</span></span></strong> <strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Provider: </span></span></strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;a provider of Aesthetic Procedures accepted on to the Site by LinkAesthetics but who is not authorised to carry out Prescription Services; </span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Prescription Service: </span></span></strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">a physical face-to-face examination and medical consultation with a patient and if the </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Prescribing</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Provider in its sole discretion agrees, the prescribing of the injectable aesthetic medicines<strong> </strong>for the patient;</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Prescribing</span></span></strong> <strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Provider: </span></span></strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;a provider of Aesthetic Procedures and &nbsp;Prescription Services accepted on to the Site by LinkAesthetics;</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Provider:&nbsp; </span></span></strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">a </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Prescribing</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Provider and/or a non-</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Prescribing</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Provider as the case may be;</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Provider Advertisement: </span></span></strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">has the meaning given to it in Condition 6;</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Site</span></span></strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">: the </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">LinkAesthetics </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">website;</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Site Content</span></span></strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">: all materials on the Site, </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">including all information, data, text, images, recordings and software excluding any content posted by a Provider and/or a Customer;</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Terms</span></span></strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">: these terms and conditions; and</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"color:black\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">You:</span></span></strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> any user of the Site, including a Provider and/or a Customer.</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">2.2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">In these Terms (a) headings are for convenience only and do not affect interpretation; (b) words in the singular include the plural; and (c) including means including but not limited to.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">2.3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Any reference to a statutory provision shall be a reference to such provision as may be updated or amended from time to time.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#18171c\">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Registering on the Site and Use of the Site</span></span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">3.1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; When you register on the Site you will create a username and password. You are responsible for keeping your username and password confidential and you are responsible for any activity under your LinkAesthetics account.</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Please take precautions to protect your password and contact us immediately by email at</span></span> <em><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">info@linkaesthetics.com</span></span></em> <span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">if you believe there has been any unauthorised use of your LinkAesthetics account.&nbsp;&nbsp; </span></span></span></span></p>\r\n\r\n<ol>\r\n	<li>\r\n	<ol>\r\n		<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">When you use the Site you must comply with all applicable laws. In particular, but without limitation, you agree not to:</span></span></span></span></li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(a) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; try to gain unauthorised access to the Site or any networks, servers or computer systems connected to the Site; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(b) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#343434\">harvest or otherwise collect non-public information about another user obtained through the Site (including without limitation email addresses), without the prior written consent of the holder of the appropriate rights to such information; </span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#343434\">(c) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; add a Site user to your email or physical mailing list without their consent after adequate disclosure, or use their email address or contact details for antisocial, disruptive, or destructive purposes; </span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">and/or </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(d) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; reproduce, redistribute, sell, create derivative works from, decompile, reverse engineer, or disassemble all or part of the Site save to the extent expressly permitted by law not capable of lawful exclusion.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#18171c\">4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Customers</span></span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#18171c\">4.1</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; If you wish to register as a Customer on the Site,</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> you must:</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; be at least 18 years old; and </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; be legally capable of entering into a contract.</span></span> </span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">At our request, you shall provide evidence of your compliance with this Condition 4.1.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">4.2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No fees are due from Customers in relation to the registration on the Site.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">4.3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You may use our Site to search for and book an Aesthetic Procedure with a Provider.&nbsp; When you book the Aesthetic Procedure, we take payment of the Fee on behalf of the Provider. &nbsp;A Customer may not use the Site to order Prescription Services.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">4.4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You agree that on booking the Aesthetic Procedure you are entering into a contract with the Provider, and not with LinkAesthetics, for the provision of the Aesthetic Procedure. You should carefully review the Provider&rsquo;s terms and conditions for the provision of the Aesthetic Procedure, in particular the cancellation policy.&nbsp; As a result, we are not responsible or liable to you in relation to the provision of the Aesthetic Procedure or any act or omissions of the Provider.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">4.5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We do not recommend or endorse any Provider, the suitability or need for an Aesthetic Procedure and/or the quality of the Aesthetic Procedure.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Providers </strong></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">5.1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">If a Prescribing Provider wishes to offer Prescription Services, then the Prescribing Provider must set up two accounts on the Site: one to provide </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Aesthetic Procedures, and one to provide Prescription Services</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">.&nbsp; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">5.2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">If you wish to apply to register as a Provider on the Site,</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> you must:</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(a) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; have the authority to bind any organisation that you purport to represent to these Terms; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(b) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; be based in the UK; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(c) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; have appropriate experience and certification in respect of the </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Aesthetic</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Procedures and/or Prescription Services you wish to offer through the Site; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(d) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; have in place and maintain all consents, permissions and insurances required in order to provide the </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Aesthetic</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Procedures and/or Prescription Services you wish to offer through the Site.</span></span> </span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">At our request, you shall provide evidence of your compliance with this Condition 5.2. We shall consider any application, and if we agree to include you on the Site, we shall notify you accordingly. You shall immediately notify us if at any time you cease to comply with the provisions in this Condition 5.2, and you agree that we shall be entitled immediately to remove you from the Site in such circumstances.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">5.3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Providers are encouraged to create a profile on the Site including photographs of their </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Aesthetic</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Procedures.&nbsp; However, Providers must not upload any photographs to their profile on the Site that show:</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; an individual without the consent of that individual; </span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(b) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; examples of </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Aesthetic</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Procedures that the Provider does not offer on the Site; and/or </span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (c) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; work that the Provider has not itself carried out.</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; information which could be used to identify or contact the&nbsp;&nbsp; provider outside of this platform.</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">5.4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; In addition to the requirements of Condition 5.2 above, Providers warrant and represent that all content included in a profile and any interactions on the Site must not:</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">breach the provisions of any law, statute or regulation including any data protection laws and/or regulations;</span></span> </span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">infringe the copyright, database rights, trade mark rights or other intellectual property rights of any </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">third party; </span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">be made in breach of any legal duty owed to any third party, such as a contractual duty or a duty of confidence;</span></span> </span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(d&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">be deliberately or knowingly false, inaccurate or misleading; &nbsp;&nbsp;&nbsp;&nbsp; </span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#343434\">include any content which promotes fraudulent, obscene, pornographic, inappropriate or illegal activities; promotes violence or hatred; is or discriminatory of any group of people; is sexually explicit; or is obscene, offensive, hateful or inflammatory; </span></span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#343434\">(f)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; not contain any virus; &nbsp;</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">and/or </span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(g)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; give rise to any cause of action against LinkAesthetics.</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">5.5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Providers must upload to their profile a copy of their terms and conditions and their Fees for a Customer to review before booking an </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Aesthetic</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Procedure and/or a Non-Prescribing Provider to review before ordering a Prescription Service.&nbsp; The Provider warrants that their terms and conditions comply with all provisions of applicable laws, including but not limited to consumer law and data protection laws.</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">5.6&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We do not monitor or review any content uploaded to the Site by a Provider.&nbsp; However, we may remove any such content at any time and without notice&nbsp; if we reasonably believe that such content infringes any of the provisions of these Terms.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">5.7&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The Provider must also keep its schedule of availability for </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Aesthetic</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Procedures up-to-date within the Site.&nbsp; The Provider agrees that the Customers and Non-Prescribing Providers rely on the accuracy of a Provider&rsquo;s schedule, and if the schedule is frequently found to be out of date and </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">the Provider cancels Aesthetic Procedures and/or Prescription Services</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">, this shall be considered a material breach of these Terms.</span></span></span></span></p>\r\n\r\n<ol>\r\n	<li>\r\n	<ol>\r\n		<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Providers acknowledge that LinkAesthetics acts as a Provider&rsquo;s agent to receive the Fee for an </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Aesthetic</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Procedure booked or a Prescription Service booked &nbsp;through the Site.</span></span></span></span></li>\r\n		<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">The Provider is responsible for the </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Aesthetic</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Procedures provided to Customers and the contract for those </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Aesthetic</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Procedures is between the Provider and the Customer. We are in no way liable to Customers for the </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Aesthetic</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Procedures they receive from you. The Provider warrants and represents that it shall use its best endeavours to provide an excellent service to Customers, and shall promptly deal with any sales enquiries, matters or issues received from Customers.</span></span></span></span></li>\r\n		<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">The Prescribing Provider is responsible for the Prescription Service booked by Non Prescribing Providers, and the contract for sale and provision of Prescription Services is between the Prescribing Provider and the Non- Prescribing provider. We are in no way liable to Non- Prescribing Providers for the delivery or use of Prescription Services ordered through the Site and/or any act or omission of another Provider.</span></span></span></span></li>\r\n		<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Providers shall treat all personal data and other information relating to a Customer and another Provider as confidential and keep all such information secure, and not share such data with any third party, or use such data for any purpose except to provide the Aesthetic Procedure to a Customer or the Prescription Services to a Non-</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Prescribing Provider as the case maybe, </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">and to manage any enquiries from the Customer or Non-</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Prescribing Provider</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">. Providers </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">shall take appropriate security measures (including physical, electronic and procedural measures) to help safeguard such personal data from unauthorized access, loss and disclosure and shall otherwise comply with all applicable laws and regulations relating to data protection.</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Providers shall ensure that individuals processing personal data are subject to a duty of confidence in relation to such personal data. Providers shall assist LinkAesthetics in providing subject access and allowing data subjects to exercise their rights under applicable laws and assist LinkAesthetics in meeting its legal obligations in relation to the security of processing, the notification of personal data breaches and data protection impact assessments. At the request of LinkAesthetics, Providers shall submit to audits and inspections by LinkAesthetics to ensure that it is complying with its obligations under this Condition 5.9 and shall notify LinkAesthetics if it is requested to take any action in breach of any applicable data protection legislation.&nbsp; &nbsp;</span></span></span></span></li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">6.</span></span></strong><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Promotion of Providers</span></span></strong></span></span></p>\r\n\r\n<ol>\r\n	<li>\r\n	<ol>\r\n		<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Providers</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> agree that LinkAesthetics shall be entitled to reproduce and use the </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Provider</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&rsquo;s name and associated logos within publicity for the Site and for the LinkAesthetics business.</span></span></span></span></li>\r\n		<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Without prejudice to Condition 6.1, on payment of a fee, we shall include the Provider&rsquo;s profile within an advertisement (<strong>Provider Advertisement) </strong>on the Site, subject to the following:</span></span></span></span></li>\r\n	</ol>\r\n	</li>\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">the provisions of Condition 5.2 and 5.3 shall apply to the Provider Advertisement;</span></span></span></span></li>\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Other than the providers full name, the &nbsp;Advertisement shall not include any information that enables another user to identify or contact the Provider outside of this platform;]</span></span></span></span></li>\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">we shall be entitled to reject or edit&nbsp; any Provider&nbsp; Advertisement if in our reasonable opinion, the Provider &nbsp;Advertisement does not comply with the provisions of Condition 6.2(a) and/or (b) and in such circumstances, no refunds shall be due to the Provider;</span></span></span></span></li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>\r\n	<ol>\r\n		<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">We shall publish the Provider Advertisement on the home page of the Site for the duration agreed with the Provider.&nbsp; Fees are due on a weekly basis in advance.&nbsp; If any payment is not received by the due date, we shall be entitled to suspend and/or terminate our obligations in relation to the Provider&nbsp; Advertisement.</span></span></span></span></li>\r\n		<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">We shall determine the size and location of the Provider&nbsp; Advertisement on the home page at our sole discretion. We do not warrant that publication of the Provider&nbsp; Advertisement will be uninterrupted or error free, provided that we shall use reasonable endeavours to make the Site available.&nbsp; We do not warrant any particular target response levels and/or page impressions in relation to a Provider&nbsp; Advertisement or the Site in general.</span></span></span></span></li>\r\n		<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">If a Provider&rsquo;s account is terminated under Condition 14, we shall be entitled to remove a Provider&nbsp; Advertisement without notice to you.</span></span></span></span></li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">7.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Payment and Cancellation</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">7.1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Customers shall pay the Fee for each </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Aesthetic</span></span> <span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Procedure when the </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Aesthetic</span></span> <span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Procedure is booked. Likewise, Non-Prescribing Providers shall pay for Prescription Services when the Prescription Services is booked. &nbsp;Payment is made through our payment service provider, Stripe.&nbsp;&nbsp; </span></span><span style=\"font-size:11.0pt\"><span style=\"background-color:#fefefe\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#333333\">By booking an Aesthetic Procedure or ordering a Prescription Services, Customers and Non-Prescribing Providers authorise Stripe and us to process payment of the Fee together with any payment processing charge imposed by Stripe.</span></span></span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">7.2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; If a Provider is for any reason unable to provide the Aesthetic Procedure or the Prescription Services, the Provider shall immediately notify LinkAesthetics and the Customer or Non-Prescribing Provider as the case may be by using the platform function for this, and shall attempt to reschedule.&nbsp;&nbsp; If it is not possible to reschedule, the Customer or Non-Prescribing Provider as the case may be shall be entitled to a full refund of the Fee. However, we shall be entitled to require the Provider to pay to us the Commission due under the Fee for the cancelled Aesthetic Procedure or Non-Prescribing Provider as the case may be. This amount will automatically be deducted from the fees paid to a provider from their next customer booking without notification.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">7.3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; A Customer is entitled to re-schedule an Aesthetic Procedure, and a Non-Prescribing rovider is entitled to re-schedule Prescription Services only in accordance with the Provider&rsquo;s terms and conditions.&nbsp; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">7.4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Within 48hours after the customer has attend the scheduled appointment, we shall to the Provider pay the Fee, less then current Commission.&nbsp; We shall notify the Provider by email of any changes to its Commission from time to time. We shall pay all sums due to the bank account details that the Provider has provided to us together with an emailed remittance advice. &nbsp;</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">7.5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Provider</span></span> <span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">agrees that it is self-employed and is not an employee of LinkAesthetics</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">. </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">The </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Provider</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> is responsible for making appropriate PAYE deductions for tax and national insurance contributions</span></span> <span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">and the </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Provider</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> shall indemnify </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">LinkAesthetics</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> (on a full indemnity basis) in respect of any claims or demands which may be made by the relevant authorities against </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">LinkAesthetics </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">in respect of income tax and national insurance contributions </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(or their local equivalent) </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">relating to the </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Provider</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">,</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> including any interest or penalties and any costs or expenses we incur in relation to the claim.</span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">8.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Reviews</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">8.1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Customers are entitled to post a review in relation to an Aesthetic Procedure.&nbsp; Customers warrant and represent that all reviews you post shall:</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; be honest and based on a true account of your experience of the </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Aesthetic</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Procedure;</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(b) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; not include any personal data of the Provider or any other person without their permission;</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#343434\">include any content which promotes fraudulent, obscene, pornographic, inappropriate or illegal activities; promotes violence or hatred; is or discriminatory of any group of people; is sexually explicit; or is defamatory, obscene, offensive, hateful or inflammatory</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">;</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; infringe the copyright, database rights, trade mark rights or other intellectual property rights of any third party; </span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; be deliberately or knowingly false, inaccurate or misleading; &nbsp;</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(f)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; not contain any virus; and/or</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-family:Verdana,sans-serif\"><span style=\"color:black\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(g)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; give rise to any cause of action against LinkAesthetics.</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">8.2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We do not monitor or review any reviews.&nbsp; However, we may remove any review at any time and without notice if we reasonably believe that such content infringes any of the provisions of Condition 8.1.</span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">9.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Suitability of Providers and Customers</strong></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#262626\">9.1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Providers and Customers acknowledge and agree that the Site is provided for information purposes only.&nbsp; LinkAesthetics does not seek to introduce or supply Customers to Providers or vice versa.</span></span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#262626\">9.2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; It is the responsibility of a Customer to ensure the Provider and </span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Aesthetic</span></span> <span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#262626\">Procedure are appropriate for their requirements. LinkAesthetics is not responsible for the acts of omissions of a Provider.</span></span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#262626\">9.3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; It is the responsibility of a Non-Prescribing Provider to ensure the Prescribing Provider and </span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Prescription Services</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#262626\"> are appropriate for their requirements. LinkAesthetics is not responsible for the acts of omissions of a Prescribing Provider.</span></span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">10.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Site Communications and Availability</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">10.1&nbsp;&nbsp;&nbsp; All communications between the Providers and Customers must be fair, honest and appropriate in the context of the Provider/potential employee relationship.&nbsp; In particular, you warrant and represent that your communications shall not include content that:</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; is defamatory, obscene or offensive; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; is in breach of applicable laws; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; harasses another user; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (d) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; involves the transmission of junk mail or spam;</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; engages in commercial activities not relating to the Procedures in question; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (f)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; is inciting hatred of any sort; and/or </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (g)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; contains any virus or malicious code.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">10.2&nbsp;&nbsp;&nbsp; We will use reasonable endeavours to maintain and make available to you the Site available at all times.&nbsp; However, there may be occasions when access to the Site may be interrupted, including for scheduled maintenance or upgrades, for emergency repairs, or due to failure of telecommunications links and/or equipment.&nbsp; We shall use reasonable endeavours to notify all users of any scheduled maintenance or upgrades, and to schedule such maintenance and upgrades outside of normal working hours.&nbsp; However, you agree that we have no liability to you for such interruptions. </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">10.3&nbsp;&nbsp;&nbsp; For the avoidance of doubt, we shall also not be liable if you are unable to access the Site for any reason within your control, including your failure to use appropriate equipment or insufficient bandwidth.</span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">12.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Disclaimer &ndash; Your attention is particularly drawn to these provisions</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#1e2c35\">11.1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You agree that LinkAesthetics has no responsibility and/or liability for any errors or omissions in any content posted by a Provider and/or a Customer.&nbsp; We accept no obligation to verify or review such content.&nbsp; &nbsp;Furthermore, we do not warrant that: </span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#1e2c35\">(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; any Customer shall find a suitable Provider for its needs;</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#1e2c35\">(b) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; a Non-Prescribing Provider will find a Prescribing Provider suitable for its needs; and/or</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#1e2c35\">(c) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; a Provider shall be engaged by any Customer or other Provider. &nbsp;&nbsp;</span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#1e2c35\">11.2</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; If you are a Provider, </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#1e2c35\">we </span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">shall in no circumstances be liable to you in contract, tort (including negligence) or otherwise for any direct or indirect losses you may suffer as a result of use of the Site, including:</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; loss of profit, anticipated profits or business; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; loss of data; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; loss of opportunity; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; loss of revenue; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; loss of goodwill or reputation; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(f)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; wasted expenditure; and/or</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(g)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; consequential, special or incidental loss or damage (whether or not advised of the possibility of the same). </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">11.3&nbsp;&nbsp;&nbsp; If you are a Customer:</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; if there is a problem with the Site that damages a device or any other digital content belonging to you and this is caused by our failure to use reasonable skill and care, we will either repair the damage or pay you compensation up to &pound;20 per device subject to evidence of the damage and financial loss caused by the Site;</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; if there is a problem with the Aesthetic Procedure, you should contact the Provider.&nbsp;&nbsp; We have no liability for the actions of the Provider.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">11.4&nbsp;&nbsp;&nbsp; If you are a Non-Prescribing Provider and there is a problem with the Prescription Services, you should contact the Prescribing Provider.&nbsp;&nbsp; We have no liability for the actions of the Prescribing Provider.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">11.5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Nothing in these Terms shall be construed as excluding or limiting our liability for death or personal injury caused by our negligence, for fraud or fraudulent misrepresentation or for any other liability that cannot be excluded by English law. Your consumer statutory rights are unaffected.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">12.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Indemnity</strong></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The Provider shall indemnify and keep indemnify and held harmless LinkAesthetics from and against any costs, claims, losses, damages, expenses and liabilities that LinkAesthetics may suffer or incur arising as a result of:</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">12.1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; any claim or allegation in relation to any content you have uploaded to the Site including a</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"> Provider </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Advertisement; and/or &nbsp;</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">12.2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; any claim or allegation from a Customer, other Provider, medical authority or other third party relating to the acts or omission of the Provider including in relation to the provision of Aesthetic Procedures and the sale or use of Prescription Services.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">13.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Intellectual Property Rights</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">13.1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The copyright in all Site Content is owned by or licensed to LinkAesthetics. All rights are reserved. You can view, print or download extracts of the Site Content for your own use. </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">13.2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You cannot otherwise copy, edit, vary, reproduce, publish, display, distribute, store, transmit, commercially exploit, disseminate in any form whatsoever or use the Site Content without our permission.&nbsp; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">14.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Termination or Suspension</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">14.1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We reserve the right to suspend or terminate the account of a Provider or a Customer at any time and without liability:</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; if any information that you provide to us is not true or we cannot verify or authenticate any such information; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(b) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; you are in breach of these Terms; </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(c) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; after a six (6) months continuous period of inactivity; and/or </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">(d) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; if we receive complaints or disputes are raised in relation to your activities on the Site.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">14.2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Following termination by us of your LinkAesthetics you must cease to use the Site and you must not re-register on the Site under any other name.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">14.3 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You may contact us at any time to terminate your </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">LinkAesthetics account, and provided there are no outstanding sums due or payable, we shall delete the account within 10 days of receipt of such a notice.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">15.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; General</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">15.1&nbsp;&nbsp;&nbsp; These Terms and the Privacy &amp; Cookie Policy (as amended from time to time) constitute the entire agreement relating to your use of the Site.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">15.2&nbsp;&nbsp;&nbsp; If any provision of these Terms is held by a court of competent jurisdiction to be invalid or unenforceable, then such provision shall be construed, as nearly as possible, to reflect the intentions of the parties and all other provisions shall remain in full force and effect.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">15.3&nbsp;&nbsp;&nbsp; Our failure to exercise or enforce any right or provision of these Terms shall not constitute a waiver of such right or provision. </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">15.4&nbsp;&nbsp;&nbsp; We may assign or otherwise transfer our rights and obligations in terms of these Terms to third parties.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">15.5&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:11.0pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\"><span style=\"color:#333333\">We are committed to ensuring that there is no modern slavery or human trafficking in our supply chains or in any part of our business.</span></span></span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">15.6&nbsp;&nbsp;&nbsp; If you are a consumer and you have any complaint or wish to raise a dispute under these Terms or otherwise in relation to the Site please follow this link </span></span><a href=\"http://ec.europa.eu/odr\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">http://ec.europa.eu/odr</span></span></a><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">. </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">These Terms shall be governed by and construed in accordance with English law and you agree to submit to the exclusive jurisdiction of the English Courts.</span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Last updated: May 2018</span></span></span></span></p>\r\n', '2', '2018-07-09 20:25:25', '2018-07-09 20:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'feedback by',
  `provider_id` int(11) NOT NULL,
  `feedback` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'user feedback',
  `feedback_type` int(11) NOT NULL COMMENT 'user feedback type',
  `status` enum('2','1','3') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-approved,2-pending,3-rejected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gain_provider`
--

CREATE TABLE `gain_provider` (
  `id` int(10) UNSIGNED NOT NULL,
  `header` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `gain_banner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `forward_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('1','2') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gain_provider`
--

INSERT INTO `gain_provider` (`id`, `header`, `content`, `gain_banner`, `forward_link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Academy of Aesthetic Medicine', '<p>Academy of Aesthetic Medicine brings you accredited training courses in Aesthetic Medicine delivered by a team of expert medical practitioners. We look forward to welcoming medical professionals from all over the world for our bespoke training courses.</p>\r\n', '1535245465.jpg', 'https://www.aamedicine.co.uk/', '1', '2018-08-26 09:04:25', '2018-08-26 09:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `la_payment_history`
--

CREATE TABLE `la_payment_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'paid to',
  `paid_for_id` int(11) NOT NULL COMMENT 'ex:appointment id,advertisement id',
  `payment_type` enum('2','1','3') COLLATE utf8_unicode_ci NOT NULL COMMENT '1- appointment, 2- advertisement',
  `account` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'provider stripe account',
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'paid amount',
  `la_share_percentage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'share for this transaction',
  `la_share_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'share for this transaction',
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'stripe transfer id',
  `payment_date` datetime NOT NULL COMMENT 'payment done on',
  `payment_status` enum('2','1') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-paid,2-failed',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'any description for the payment',
  `stripe_response` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'stripe response',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_chimp_info`
--

CREATE TABLE `mail_chimp_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'registered user',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'registered user email',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'registered user name',
  `user_type` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-end_user,2-provider',
  `status` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-active,2-not active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mail_chimp_info`
--

INSERT INTO `mail_chimp_info` (`id`, `user_id`, `email`, `name`, `user_type`, `status`, `created_at`, `updated_at`) VALUES
(43, 100, 'adexcel@yahoo.com', 'Kafayat Brown', '2', '1', '2018-09-26 19:52:45', '2018-09-26 19:52:45'),
(44, 101, 'Mac10cedis@gmail.com', 'Albert Mac ', '2', '1', '2018-10-03 05:35:42', '2018-10-03 05:35:42'),
(45, 102, 'jonnysmith@gmail.com', 'johnny', '1', '1', '2018-10-12 04:56:36', '2018-10-12 04:56:36'),
(46, 103, 'juliacfoster@yahoo.co.uk', 'Julia foster', '2', '1', '2018-10-14 19:05:11', '2018-10-14 19:05:11'),
(47, 104, 'lol43770@hotmail.co.uk', 'Lorraine Mingoia', '1', '1', '2018-10-21 00:22:52', '2018-10-21 00:22:52'),
(48, 105, 'Lorrainemingoia@hotmail.co.uk', 'Lorraine Mingoia', '2', '1', '2018-10-21 00:26:12', '2018-10-21 00:26:12'),
(49, 106, 'emilyhawley1xx@gmail.com', 'Emily Hawley', '1', '1', '2018-11-19 06:00:31', '2018-11-19 06:00:31'),
(52, 109, 'mark.johnson@doctors.org.uk', 'Mark Johnson', '2', '1', '2019-01-17 04:05:58', '2019-01-17 04:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2018_03_07_062909_create_user_details_table', 1),
('2018_03_07_064518_create_user_answers_table', 1),
('2018_03_29_105654_Provider_policy', 1),
('2018_03_29_120849_create_services_table', 1),
('2018_03_30_115043_create_provider_services_table', 1),
('2018_03_31_104219_create_provider_gallery_table', 1),
('2018_04_12_073927_create_appointment_table', 1),
('2018_04_12_112445_create_notification_table', 1),
('2018_04_18_104816_create_services_settings_table', 1),
('2018_04_26_103244_add_soft_deletes_to_appointment_table', 1),
('2018_04_30_085837_add_column_in_user_table', 1),
('2018_05_02_112537_create_disclaimer_table', 1),
('2018_05_02_140043_add_soft_deletes_to_user_table', 1),
('2018_05_03_054132_add_administrator_approvalcolumn_in_user_table', 1),
('2018_05_04_052142_add_nameslug_column_in_users_table', 1),
('2018_05_04_072705_create_feedback_table', 1),
('2018_05_05_060827_create_advertisement_table', 1),
('2018_05_05_101920_add_time_slot_advertisement', 1),
('2018_05_11_113126_add_social_login_fields_users_table', 1),
('2018_05_11_113819_add_location_string_user_details_table', 1),
('2018_05_15_140401_create_advertisement_amount_table', 1),
('2018_05_15_163212_create_advertisement_type_table', 1),
('2018_05_15_182458_add_days_slots_to_advertisement_table', 1),
('2018_05_16_180409_add__service_description_to_services_table', 1),
('2018_05_16_184557_create_status_mail_table', 1),
('2018_05_17_134740_create_stripe_user_account_table', 1),
('2018_05_17_174433_add_provider_id_to_feedback_table', 1),
('2018_05_17_194523_create_payment_history_table', 1),
('2018_05_18_182745_create_about_table', 1),
('2018_05_18_205555_add_fields_payment_history_table', 1),
('2018_05_18_211206_create_la_payment_history_table', 1),
('2018_05_19_110533_create_professional_table', 1),
('2018_05_19_110956_modify_field_stripe_user_account_table', 1),
('2018_05_19_141023_add_registration_number_to_user_answers_table', 1),
('2018_05_21_151623_create_bank_account_table', 1),
('2018_05_21_180844_add_service_banner_to_services_table', 1),
('2018_05_21_183344_add_service_readmore_to_sevices_table', 1),
('2018_05_21_194011_add_about_readmore_to_about_table', 1),
('2018_05_22_102952_add_fields_bank_aacount_table', 1),
('2018_05_22_140400_add_field_in_advertisement_table', 1),
('2018_05_23_112856_add_field_advertisement_table', 1),
('2018_05_23_154601_create_provider_refund_policies', 1),
('2018_05_23_173621_create_refund_history_table', 1),
('2018_05_23_183049_create_sessions_table', 1),
('2018_05_23_191306_create_provider_wallet_table', 1),
('2018_05_24_104323_create_cancel_appointment_table', 1),
('2018_05_24_112637_add_field_in_payment_history_table', 1),
('2018_05_24_112914_add_field_in_la_payment_history_table', 1),
('2018_05_24_135256_add_field_provider_wallet_table', 1),
('2018_05_24_185314_add_other_professional_pin_to_user_answer', 1),
('2018_05_28_124148_add_field_servicessettings', 1),
('2018_05_31_120314_create_subscribe_table', 1),
('2018_05_31_134154_add_field_bank_account', 1),
('2018_06_01_144411_add_field_provider_refund_policies', 1),
('2018_06_01_154002_create_gain_provider_tabel', 1),
('2018_06_01_165933_add_field_services_settings_policies', 1),
('2018_06_04_193227_create_admin_settings', 1),
('2018_06_05_122241_create_mail_chimp_info', 1),
('2018_06_06_124607_create_provider_combo_services_table', 1),
('2018_06_07_101549_add_field_in_services', 1),
('2018_06_07_111117_add_field_in_provider_services', 1),
('2018_06_11_190550_create_user_registration_count_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `notify_action_id` int(11) NOT NULL COMMENT 'ex:appointment id ',
  `notify_action_type` int(11) NOT NULL COMMENT '1-appointment,2-prescription request',
  `notify_action_from` int(11) NOT NULL,
  `notify_action_to` int(11) NOT NULL,
  `notify_comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notify_message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notify_status` int(11) NOT NULL COMMENT '1-viewed, 2-not-viewed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notify_action_id`, `notify_action_type`, `notify_action_from`, `notify_action_to`, `notify_comment`, `notify_message`, `notify_status`, `created_at`, `updated_at`) VALUES
(1, 100, 4, 100, 2, '', 'New user has been registered.', 1, '2018-09-26 19:52:45', '2018-09-27 04:23:05'),
(2, 101, 4, 101, 2, '', 'New user has been registered.', 1, '2018-10-03 05:35:43', '2018-10-03 05:41:53'),
(3, 101, 5, 101, 2, '', 'Submitted document.', 1, '2018-10-03 06:03:45', '2018-10-13 21:08:07'),
(4, 100, 5, 100, 2, '', 'Submitted document.', 1, '2018-10-03 07:40:32', '2018-10-13 21:07:40'),
(5, 102, 4, 102, 2, '', 'New user has been registered.', 1, '2018-10-12 04:56:36', '2018-10-13 20:52:08'),
(6, 103, 4, 103, 2, '', 'New user has been registered.', 1, '2018-10-14 19:05:11', '2018-10-14 19:19:08'),
(7, 104, 4, 104, 2, '', 'New user has been registered.', 1, '2018-10-21 00:22:52', '2018-10-21 02:17:11'),
(8, 105, 4, 105, 2, '', 'New user has been registered.', 1, '2018-10-21 00:26:12', '2018-10-21 02:12:13'),
(9, 106, 4, 106, 2, '', 'New user has been registered.', 1, '2018-11-19 06:00:31', '2018-11-21 02:14:20'),
(12, 109, 4, 109, 2, '', 'New user has been registered.', 1, '2019-01-17 04:05:58', '2019-01-18 05:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'who done',
  `paid_to` int(11) NOT NULL COMMENT 'paid to user',
  `paid_for_id` int(11) NOT NULL COMMENT 'ex:appointment id,advertisement id',
  `payment_type` int(11) NOT NULL COMMENT '1- appointment, 2- advertisement',
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'paid amount',
  `la_share_percentage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'share for this transaction',
  `la_share_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'share for this transaction',
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'stripe charge id',
  `payment_date` datetime NOT NULL COMMENT 'payment done on',
  `payment_status` int(11) NOT NULL COMMENT '1-paid,2-failed',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'any description for the payment',
  `stripe_response` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'stripe response',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professional`
--

CREATE TABLE `professional` (
  `id` int(10) UNSIGNED NOT NULL,
  `professional_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-active,2-deactivate',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `professional`
--

INSERT INTO `professional` (`id`, `professional_title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dental Nurse', '1', '2018-05-19 05:50:48', '2018-05-19 05:56:51'),
(2, 'Dental hygienist', '1', '2018-05-19 05:57:14', '2018-05-19 05:57:14'),
(3, 'Doctor', '1', '2018-05-19 05:57:51', '2018-05-19 05:57:51'),
(4, 'Dentist', '1', '2018-05-19 05:58:12', '2018-05-19 05:58:12'),
(5, 'Midwife', '1', '2018-05-19 05:58:40', '2018-05-19 05:58:40'),
(6, 'Nurse including nurse practitioners ', '1', '2018-05-19 05:58:45', '2018-05-19 05:58:45'),
(7, 'Paramedic', '1', '2018-05-19 05:58:50', '2018-05-19 05:58:50'),
(8, 'Pharmacists', '1', '2018-05-19 05:58:54', '2018-05-19 05:58:54'),
(9, 'Podiatrist', '1', '2018-05-19 05:58:59', '2018-05-19 05:58:59'),
(10, 'Radiographer', '1', '2018-05-19 05:59:03', '2018-05-19 05:59:03'),
(11, 'Others (please specify)', '1', '2018-05-19 05:59:09', '2018-05-19 05:59:09');

-- --------------------------------------------------------

--
-- Table structure for table `provider_combo_services`
--

CREATE TABLE `provider_combo_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `services_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'combo services ids',
  `service_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prescription_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'prescription amount, it is for prescribers',
  `time_needed` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'time needed for surgery (in hrs)',
  `service_status` enum('3','2','1') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-active,2-deactive,3-pending',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provider_gallery`
--

CREATE TABLE `provider_gallery` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'provider id',
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `original_path` text COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `provider_gallery`
--

INSERT INTO `provider_gallery` (`id`, `user_id`, `file_name`, `original_path`, `extension`, `status`, `created_at`, `updated_at`) VALUES
(4, 36, '1532964799.png', 'ORG_1532964799.jpg', '.png', '1', '2018-07-30 23:33:19', '2018-07-30 23:33:19'),
(5, 36, '1532964816.png', 'ORG_1532964817.jpg', '.png', '1', '2018-07-30 23:33:36', '2018-07-30 23:33:37'),
(6, 36, '1532965160.png', 'ORG_1532965161.jpg', '.png', '1', '2018-07-30 23:39:20', '2018-07-30 23:39:21'),
(7, 36, '1532965193.png', 'ORG_1532965194.jpg', '.png', '1', '2018-07-30 23:39:53', '2018-07-30 23:39:54'),
(8, 36, '1532965231.png', 'ORG_1532965231.jpg', '.png', '1', '2018-07-30 23:40:31', '2018-07-30 23:40:31'),
(9, 36, '1532965249.png', 'ORG_1532965249.jpg', '.png', '1', '2018-07-30 23:40:49', '2018-07-30 23:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `provider_policies`
--

CREATE TABLE `provider_policies` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `policy` longtext COLLATE utf8_unicode_ci NOT NULL,
  `policy_type` enum('cancel','reschedule','dissatisfaction') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `provider_policies`
--

INSERT INTO `provider_policies` (`id`, `user_id`, `policy`, `policy_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 36, '<p>Happy to reschedule your appointment if this is requested no later than 2 days before your appointment is due.</p>\r\n', 'reschedule', '2018-08-26 10:08:38', '2018-08-26 10:08:38', NULL),
(2, 36, '<p>&nbsp;Customers will receive a 25% refund there are unhappy with their treatment within reasonable limits.&nbsp;</p>\r\n', 'dissatisfaction', '2018-08-26 10:12:29', '2018-08-26 10:12:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `provider_refund_policies`
--

CREATE TABLE `provider_refund_policies` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `refund` tinyint(1) NOT NULL DEFAULT '1',
  `percentage_week` int(11) NOT NULL,
  `percentage_days` int(11) NOT NULL,
  `percentage_appointment_day` int(11) NOT NULL COMMENT 'if cancelled in appointment day(within 24hrs)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `provider_refund_policies`
--

INSERT INTO `provider_refund_policies` (`id`, `user_id`, `refund`, `percentage_week`, `percentage_days`, `percentage_appointment_day`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 36, 1, 70, 40, 30, '2018-06-29 15:53:50', '2018-06-29 15:53:50', NULL),
(15, 101, 1, 100, 10, 40, '2018-10-03 06:03:39', '2018-10-03 06:03:39', NULL),
(16, 100, 1, 100, 80, 70, '2018-10-03 07:40:27', '2018-10-03 07:40:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `provider_services`
--

CREATE TABLE `provider_services` (
  `provider_services_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `services_id` int(10) UNSIGNED NOT NULL,
  `category` int(11) NOT NULL COMMENT 'this service material will come under,relation services_id service table',
  `quantity` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'material quantity',
  `unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'material unit, ex:ml',
  `service_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service_offer` enum('2','1') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-yes,2-no',
  `offer_percentage` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'service offer in percentage',
  `service_actual_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'service_actual amount',
  `prescription_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'prescription amount, it is for prescribers',
  `time_needed` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'time needed for surgery (in hrs)',
  `service_status` int(11) NOT NULL,
  `service_type` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-regular,2-combo',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `provider_services`
--

INSERT INTO `provider_services` (`provider_services_id`, `user_id`, `services_id`, `category`, `quantity`, `unit`, `service_amount`, `service_offer`, `offer_percentage`, `service_actual_amount`, `prescription_amount`, `time_needed`, `service_status`, `service_type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(95, 101, 204, 8, '', '', '', '2', '', '', '', '', 1, '1', NULL, NULL, NULL),
(96, 101, 205, 9, '', '', '', '2', '', '', '', '', 1, '1', NULL, NULL, NULL),
(97, 101, 206, 11, '', '', '', '2', '', '', '', '', 1, '1', NULL, NULL, NULL),
(98, 100, 207, 8, '', '', '', '2', '', '', '', '', 1, '1', NULL, NULL, NULL),
(99, 100, 208, 9, '1', '', '30000', '2', '', '', '', '0.5', 1, '1', NULL, NULL, '2018-10-17 00:33:10'),
(100, 100, 209, 11, '1', '', '25000', '2', '', '', '', '0.5', 1, '1', NULL, NULL, '2018-10-17 00:28:30'),
(101, 100, 210, 8, '1', '', '25000', '2', '', '25000', '', '0.5', 1, '1', NULL, '2018-10-17 00:27:12', '2018-10-17 00:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `provider_wallet`
--

CREATE TABLE `provider_wallet` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'provider id',
  `amount_credited` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'amount credited to provider wallet',
  `amount_debited` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'amount debited from provider wallet',
  `balance` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'balance',
  `type` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-credited,2-debited',
  `payment_history_id` int(11) NOT NULL COMMENT 'payment_history_id',
  `amount_due` double(8,2) NOT NULL DEFAULT '0.00' COMMENT 'amount will deduct from the next stripe payout/transfer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refund_history`
--

CREATE TABLE `refund_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'refund to',
  `refund_action_id` int(11) NOT NULL COMMENT 'ex:appointment id',
  `refund_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'stripe refund id',
  `paid_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'provider service cost',
  `refund_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'amount refunded',
  `la_part_recieved` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'la share in percentage',
  `provider_part_received` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'provider share in percentage',
  `refund_status` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-success,2-failed',
  `stripe_response` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'json data, stripe response',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seo_pages`
--

CREATE TABLE `seo_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `page` int(11) NOT NULL COMMENT '0 - home, 1 - about, 2 - blog, 3 - service, 4 - privacy, 5 - terms',
  `sub_topic` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keyword` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seo_pages`
--

INSERT INTO `seo_pages` (`id`, `page`, `sub_topic`, `title`, `keyword`, `description`, `created_at`, `updated_at`) VALUES
(5, 3, 0, 'Our services.', 'lipfillers, botox, anti-wrinkle treatment, cheek fillers, lip enhancement', 'Welcome to Link Aesthetics, a community of aesthetics users, providers and prescribers.\r\n\r\nWhether you are a customer looking to book a treatment (lipfillers, botox, anti-wrinkle treatment, cheek fillers, lip enhancement) or a non-prescribing provider looking for prescription services, at Link Aesthetics we have a passion for connecting customers and providers together. We want to assist you in locating experienced providers for your convenience. We do all the research for you with this easy to use, effective and helpful platform.', '2018-10-06 03:23:06', '2018-10-23 03:36:25'),
(6, 0, 0, 'Linkaesthetics', 'lipfillers', 'Connecting you with aesthetics providers nation wide.  Find certified and professional aestheticians in every city that you go to. Lip fillers, anti-wrinkle treatment and cheek enhancement all at affordable prices.', '2018-10-06 20:34:23', '2018-10-25 18:49:16'),
(7, 1, 0, 'About us ', 'lipfillers', 'Overview\r\nLinkAesthetics was created to provide a professional platform for the growing aesthetics industry. LinkAesthetics addresses the need to bridge the gap between customers and freelance aesthetics providers, providing a convenient way to connect and arrange consultations.\r\n\r\nCustomers\r\nFor customers seeking aesthetics services, LinkAesthetics enables you to browse providers from across the country, compare prices and procedures, and book consultations. Our providers are certified health care professionals with specialisms in a wide variety of aesthetics procedures, so you can feel confident and assured when making your choice.\r\n\r\nProviders\r\nFor aesthetics providers, LinkAesthetics provides a platform on which you can showcase your work nationwide and connect with new customers. We aim to support you in maximising your potential clientele and building your professional network.\r\n\r\nPrescribing\r\nIn addition, non-prescribing providers can benefit from our growing network of prescribers trained in  aesthetics.', '2018-10-22 21:32:17', '2018-10-22 21:32:17'),
(8, 2, 0, 'Superdrug to Offer In-Store Aesthetics Treatments such as Botox and Lip Fillers: What Does This Mean for Existing Aestheticians?', 'Superdrug, Botox ', 'The recent news that Superdrug is set to start offering aesthetics treatments such as Botox and lip fillers in their high-street stores raises a lot of questions about what the future holds for existing aestheticians. Whilst this new competition may be daunting for existing aestheticians, are there elements of the customer – provider relationship that a high street chain simply can’t match? \r\n\r\nWhat is Superdrug offering? \r\nThe aesthetics treatments on offer at Superdrug will begin at £99 for a standard Botox treatment for areas such as forehead or crow’s feet. Superdrug is hiring only qualified nurses to carry out the lip filler, anti-wrinkling and Botox treatments, and insists that they are committed to providing the highest standard of service and safety.  \r\n\r\nIt is thought that recent television programs such as Love Island have further popularised treatments such as Botox, lip fillers such as Juviderm and Restylane, and anti-wrinkle treatments, particularly amongst younger clients. Superdrug hopes to capitalise on this increased demand, and has begun delivering treatments at its flagship store in London before branching out across its national network of high-street stores. \r\n\r\nHowever, the fact that Superdrug will only be offering aesthetics treatments to people over the age of 25 means that a significant portion of younger clients will not be able to use this service. This perhaps points to some of the limitations of Superdrug’s venture in to the aesthetics market, especially given the significant increase in the number of 18-25 years olds seeking lip filler treatments such as Restylane and Juviderm, as well as more traditional Botox treatments. \r\n\r\nWhat does this mean for freelance aestheticians and clinics? \r\nWhilst this new competition in the aesthetics market may concern some existing aestheticians, it is important to remember that the demand on freelancers and clinics for lip fillers, Botox and anti-wrinkling, as well as a growing number of new treatments, has never been higher. In recent years, around 100,000 Botox treatments have been carried out in the UK annually, with non-surgical treatments generating almost 3 billion pounds a year. The opportunities for existing aestheticians to grow their businesses continue to emerge.  \r\n\r\nOne area where high street chains will struggle to measure up with freelance aestheticians is in terms of building and maintaining client relationships. Aestheticians with a regular client base have much greater opportunities to build trust and confidence with their clients, to recommend new treatments and introduce new products.  \r\n\r\nBuilding a strong client base and developing relationships with clients gives aesthetics providers the opportunity to market their skills and expertise, and introduce clients to new treatments that they offer. For high-street chains offering aesthetic treatments, it is likely to be more difficult to establish that personal touch and build trust between client and provider.  ', '2018-10-23 03:51:37', '2018-10-23 03:51:37');

-- --------------------------------------------------------

--
-- Table structure for table `seo_title_settings`
--

CREATE TABLE `seo_title_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `site_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_separator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seo_title_settings`
--

INSERT INTO `seo_title_settings` (`id`, `site_name`, `title_separator`, `created_at`, `updated_at`) VALUES
(3, 'Compare aesthetics treatment prices in your city.', '|', '2018-10-06 02:32:13', '2018-10-22 21:26:04');

-- --------------------------------------------------------

--
-- Table structure for table `seo_web`
--

CREATE TABLE `seo_web` (
  `id` int(10) UNSIGNED NOT NULL,
  `web_master` int(11) NOT NULL COMMENT '0 - google, 1 - bing,  2 - alexa , 3 - pinterest, 4 - yandex',
  `verification_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `services_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'who created the service',
  `service` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL COMMENT 'if input is material, this will be services_id from same table',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `service_banner` text COLLATE utf8_unicode_ci NOT NULL,
  `service_readmore` text COLLATE utf8_unicode_ci NOT NULL,
  `service_type` enum('1','2','3','4') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-regular,2-combo,3-material,4-not a service',
  `combination` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'combination ids',
  `service_status` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`services_id`, `user_id`, `service`, `category`, `description`, `service_banner`, `service_readmore`, `service_type`, `combination`, `service_status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(8, 0, 'Lip Fillers', 0, '<p><strong>Have you ever wished your lips were more plump or defined?</strong></p>\r\n\r\n<p>Lip fillers are an excellent alternative to expensive cosmetic surgical procedures, which add volume to or augment the lips. They are safe cosmetic agents injected into the body of the upper and or lower lips. The two main types of lip fillers are the hyaluronic acid filler and the ca ollagen-based filler, both of which are specifically designed to suit lip tissue. Both hyaluronic acid and collagen are naturally occurring substances found in our bodies. Hyaluronic acid works to increase lip volume by promoting water retention in the lip tissue, whereas collagen is a physical filler which supplements the skin&rsquo;s own natural collagen. Lip fillers are behind the transformation of many well-known celebrities&rsquo; beautiful smiles and most certainly plump looking pouts.</p>\r\n', '2_1530293217.png', '<p>A variety of lip fillers have now been approved and are in use. The type of lip filler you chose for your treatment will depend on your desired results. Your aesthetic provider can use lip fillers to:</p>\r\n\r\n<ul>\r\n	<li>Give you a more defined&nbsp;lip line</li>\r\n	<li>Increase lip volume</li>\r\n	<li>Correct marionette lines</li>\r\n	<li>Treat smokers lips</li>\r\n</ul>\r\n\r\n<p>It is also worth bearing in mind that the results of lip filler injections do not only depend on the type of filler used, but also the amount of filler used, the injection technique and your unique anatomy.</p>\r\n\r\n<p><strong>How long do lip enhancement results last for?</strong></p>\r\n\r\n<p>This depends on the type of filler used and individual factors such as skin type, age, area treated and smoking. Taking into account these factors, lip enhancement treatment can generally last between 6-12months.</p>\r\n\r\n<p><strong>What are the side effects?</strong></p>\r\n\r\n<p>As with any dermal filler, some side effects include redness to the site of injection, swelling and slight soreness. However these are short-lived and don&rsquo;t usually last for more than 48hours.</p>\r\n', '1', '', 1, NULL, '2018-05-21 14:04:06', '2018-07-04 01:32:15'),
(9, 0, 'Cheek fillers', 0, '<p><strong>What are cheek fillers?</strong></p>\r\n\r\n<p>Like lip fillers, cheek fillers are used to add volume, and or to augment the cheeks. They are safe cosmetic agents injected around or near the cheekbone, also known as the zygomatic arch. The two main types of cheek fillers are the hyaluronic acid filler and the collagen-based filler. Both hyaluronic acid and collagen are naturally occurring substances found in our bodies. Hyaluronic acid works to enhance cheek volume by promoting water retention in the cheek tissue, whereas collagen is a physical filler which supplements the skin&rsquo;s own natural collagen. Cheek fillers are also behind the transformation of many well-known celebrities with beautifully defined and full looking cheeks.</p>\r\n', '2_1530293191.png', '<p>A number of cheek fillers have now been approved and are in use. The type of cheek filler you chose for your treatment will depend on your desired results. Your aesthetic provider can use cheek fillers to:</p>\r\n\r\n<p>Give you a fuller looking cheek</p>\r\n\r\n<p>Create a more defined looking cheek</p>\r\n\r\n<p>It is also worth noting that the results seen after cheek filler enhancement or augmentation does not only depend on the type of filler used, but also the amount of filler used, the injection technique and your unique anatomy.</p>\r\n\r\n<p><strong>How long do cheek filler results last for?</strong></p>\r\n\r\n<p>This depends on the type of filler used and individual factors such as skin type, age, area treated and smoking. Taking into account these factors, cheek enhancement treatment can generally last between 6-12months.</p>\r\n\r\n<p><strong>What are the side effects?</strong></p>\r\n\r\n<p>As with any dermal filler, some side effects include redness to the site of injection, swelling and slight soreness. However these are short-lived and don&rsquo;t usually last for more than 48hours.</p>\r\n', '1', '', 1, NULL, '2018-05-21 14:04:53', '2018-06-30 05:56:32'),
(10, 0, 'Dermal fillers', 0, '<p><strong>What are dermal fillers?</strong></p>\r\n\r\n<p>Dermal fillers are safe injectable cosmetic treatments made with naturally occurring substances such as collagen, hyaluronic acid and calcium hydroxyl apatite, which are present in the body. They are designed to be administered via a series of tiny injections under the skin&rsquo;s surface (dermis) in order to augment facial features. For example, dermal fillers can be used to enhance the jaw line or to rejuvenate facial skin by replacing soft-tissue volume loss, reducing or eliminating wrinkles.</p>\r\n', '2_1531178184.png', '<p><span dir=\"ltr\">With age, our faces naturally develop wrinkle lines and lose subcutaneous fat due to multiple factors including genetics, lifestyle and environmental factors such as sun exposure. Dermal fillers are an excellent alternative to facial cosmetic surgical procedures.</span></p>\r\n\r\n<p><strong>How do different types of dermal fillers differ?</strong></p>\r\n\r\n<p><span dir=\"ltr\">There are a number of dermal fillers licensed for use. They all differ in chemical composition, longevity, and degrees of softness. Most dermal fillers are designed to be used in more than one way, for example to reduce wrinkle lines as well as to enhance lips or to replace volume loss. To achieve optimum results, providers will ensure that the best dermal filler is matched to your desired outcome.</span></p>\r\n\r\n<p><strong>What areas can be treated with dermal fillers?</strong></p>\r\n\r\n<ul>\r\n	<li>Forehead lines</li>\r\n	<li>Sunken temples</li>\r\n	<li>Sunken eyes</li>\r\n	<li>Crow&rsquo;s feet</li>\r\n	<li>Irregular nose shapes</li>\r\n	<li>Sunken</li>\r\n	<li>Cheeks</li>\r\n	<li>Naso-labial (nose to mouth)</li>\r\n	<li>Lines</li>\r\n	<li>Thin lips</li>\r\n	<li>Smile lines</li>\r\n	<li>Sagging chin</li>\r\n	<li>Jaws lines</li>\r\n	<li>Full facial contouring.</li>\r\n</ul>\r\n\r\n<p><strong>How long does the procedure take?</strong></p>\r\n\r\n<p>The length of filler injection depends on the individual tolerance to needles, the location of treatment, and the number of areas being treated. You can expect an average session to last about 10-30minutes.</p>\r\n\r\n<p><strong>How long do the results of dermal fillers last for?</strong></p>\r\n\r\n<p>Depending on the type of facial filler used, results from most dermal fillers are temporary and usually lasts around 6-12months.&nbsp; Individual human factors such as age, skin type and the area injected also affects filler longevity. For this reason, additional treatment sessions at safe timely intervals are encouraged for maintaining lasting results.</p>\r\n\r\n<p><strong>What are the side effects of dermal fillers?</strong></p>\r\n\r\n<p>The most common side effects experienced by clients following filler injectionsinclude allergic reactions, minor bruising at the injection site, numbness,tenderness and slight redness or swelling. These are typically short lived, lastingup to 48hours. Providers under go training to be certified in aesthetic injectablesand therefore are able to recognise and deal with serious side effects.</p>\r\n', '4', '', 1, NULL, '2018-05-21 14:07:21', '2018-08-27 00:13:27'),
(11, 0, 'Anti-Wrinkle treatment', 0, '<p><strong>What is anti-wrinkle treatment?</strong></p>\r\n\r\n<p>Anti-wrinkle treatment focuses on reducing or eliminating wrinkles on the face. There are three types of facial wrinkles: dynamic wrinkles, static wrinkles and wrinkle folds. Dynamic wrinkles occur in areas of repetitive muscle movement such as the forehead and around the eyes. Muscle contraction causes the skin that overlies the muscle to fold, resulting in the formation of lines between the bulk of the muscle. Examples of dynamic wrinkles are crow&rsquo;s feet and frown lines. Static wrinkles are caused either by prolonged dynamic wrinkles or by environmental factors such as sun exposure and smoking. These are commonly found in the areas surrounding the upper lip, cheeks and base of our necks. Compared to dynamic and static wrinkles, wrinkle folds occur naturally as we age due to loss of skin structure, causing sagging of the skin. Wrinkle folds commonly occur in the area between the nose and mouth, also known as the naso-labial groove.</p>\r\n', '2_1530293165.png', '<p><strong>How do anti-wrinkle treatments work?</strong></p>\r\n\r\n<p>There are different types of anti-wrinkle treatments used depending on the type of wrinkles treated. The most commonly used treatment is Botulinium Toxin A (also known as Botox); a neurotoxic protein produced by the bacterium Clostridium botulinum. It is commercially produced for medical and cosmetic use and was approved in 2002 by the Food and Drug Administration (a federal agency of the United States Department of Health and Human Services). Botox works by blocking nerve impulses to the muscles and therefore stops them from contracting. Without muscle contraction, the skin is relaxed and does not bunch together, reducing the appearance of wrinkles. As such, Botox produces excellent results for treating dynamic wrinkles. Dysport and Xeomin are two newer anti-wrinkling treatments, which are also safe and effective and have FDA approval. These also contain botulinium toxin A and work in a similar way to Botox. Anti-wrinkle agents differ according to how quickly results are seen and the longevity of results.</p>\r\n\r\n<p>Alternatively, injectable fillers are sometimes used to treat wrinkles by replacing volume loss. Make sure to discuss with your provider to help you choose the best agent for your desired results.</p>\r\n\r\n<p><strong>What areas can be treated?</strong></p>\r\n\r\n<ul>\r\n	<li>Crow&rsquo;s feet</li>\r\n	<li>Glabellar</li>\r\n	<li>Forehead Lines</li>\r\n	<li>Eyebrow lifts</li>\r\n	<li>Lips (especially smoker lines)</li>\r\n	<li>Naso labial groove</li>\r\n</ul>\r\n\r\n<p><strong>How long is the procedure?</strong></p>\r\n\r\n<p>While the treatment time depends on the size and location of the injection site, on average this will usually take between 10-15minutes.</p>\r\n\r\n<p><strong>How long does treatment last?</strong></p>\r\n\r\n<p>Results typically last for between 3-4 months, although some can last for up to 6months depending on the type of anti-wrinkle agent used.</p>\r\n\r\n<p><strong>What are the side of anti-wrinkle treatment?</strong></p>\r\n\r\n<p>There are minimal side effects associated with using anti-wrinkle agents. These can include allergic reactions, minor bruising, temporary redness, tenderness and swelling around the site of injection.</p>\r\n', '1', '', 1, NULL, '2018-05-21 14:08:16', '2018-08-27 00:11:24'),
(204, 101, '', 8, '', '', '', '3', '', 1, NULL, '2018-10-03 06:03:39', '2018-10-03 06:03:39'),
(205, 101, '', 9, '', '', '', '3', '', 1, NULL, '2018-10-03 06:03:39', '2018-10-03 06:03:39'),
(206, 101, '', 11, '', '', '', '3', '', 1, NULL, '2018-10-03 06:03:39', '2018-10-03 06:03:39'),
(207, 100, '', 8, '', '', '', '3', '', 1, NULL, '2018-10-03 07:40:27', '2018-10-03 07:40:27'),
(208, 100, 'Juvederm Restylane Revolax Teoxane', 9, '', '', '', '3', '', 1, NULL, '2018-10-03 07:40:27', '2018-10-17 00:33:10'),
(209, 100, 'Azzalure Botox Bocouture', 11, '', '', '', '3', '', 1, NULL, '2018-10-03 07:40:27', '2018-10-17 00:28:30'),
(210, 100, 'Juvederm Restylane Revolax Teoxane', 8, '', '', '', '3', '', 1, NULL, '2018-10-17 00:27:12', '2018-10-17 00:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `services_settings`
--

CREATE TABLE `services_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `time_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'consultation time from',
  `time_to` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'consultation time to',
  `available_days` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'consultation days',
  `service_enable` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-enabled, 2-disabled',
  `prescription_enable` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-enabled, 2-disabled',
  `instant_appointment` enum('2','1') COLLATE utf8_unicode_ci NOT NULL COMMENT 'enable instant payment without witing for the provide rappoitnment,1-enabled,2-not enabled',
  `service_location_preference` enum('1','2','3') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-provider location,2-mobile,3-flexible',
  `status` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '1-active, 2-not-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services_settings`
--

INSERT INTO `services_settings` (`id`, `user_id`, `time_from`, `time_to`, `available_days`, `service_enable`, `prescription_enable`, `instant_appointment`, `service_location_preference`, `status`, `created_at`, `updated_at`) VALUES
(1, 36, '12:00', '17:00', '[\"2\",\"3\",\"5\",\"6\",\"7\"]', '1', '1', '2', '3', '1', '2018-06-29 16:40:11', '2018-08-24 05:34:19'),
(8, 100, '10:00', '18:10', '[\"2\",\"5\",\"6\"]', '1', '1', '2', '1', '1', '2018-10-17 01:14:16', '2018-10-17 01:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status_mail`
--

CREATE TABLE `status_mail` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status_template` text COLLATE utf8_unicode_ci NOT NULL,
  `status_type` enum('active','deactivate','delete','approve','reject') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status_mail`
--

INSERT INTO `status_mail` (`id`, `user_id`, `status_template`, `status_type`, `created_at`, `updated_at`) VALUES
(1, 101, 'Thank you registration. Waiting for admin approval.', 'active', '2018-10-03 06:03:45', '2018-10-03 06:03:45'),
(2, 101, '', 'approve', '2018-10-03 06:15:31', '2018-10-03 06:15:31'),
(3, 101, '', 'approve', '2018-10-03 06:15:36', '2018-10-03 06:15:36'),
(4, 100, 'Thank you registration. Waiting for admin approval.', 'active', '2018-10-03 07:40:32', '2018-10-03 07:40:32'),
(5, 100, '', 'approve', '2018-10-04 04:13:47', '2018-10-04 04:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `stripe_user_account`
--

CREATE TABLE `stripe_user_account` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'user id',
  `account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'custom stripe account id',
  `secret_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'account secret key',
  `publishable_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'account publishable key',
  `ac_created_at` int(11) NOT NULL COMMENT 'account created date',
  `stripe_response` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'response from stripe',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stripe_user_account`
--

INSERT INTO `stripe_user_account` (`id`, `user_id`, `account`, `secret_key`, `publishable_key`, `ac_created_at`, `stripe_response`, `created_at`, `updated_at`) VALUES
(1, 36, 'acct_1CiDrqFfZkg6JHQS', 'sk_test_mk0ZLGwY6ed7CmbHPQjd942I', 'pk_test_zfzuFWIXc24pzn5xg2DzV5CL', 1530245154, '{\"id\":\"acct_1CiDrqFfZkg6JHQS\",\"object\":\"account\",\"business_name\":null,\"business_url\":null,\"charges_enabled\":true,\"country\":\"GB\",\"created\":1530245154,\"debit_negative_balances\":false,\"decline_charge_on\":{\"avs_failure\":false,\"cvc_failure\":false},\"default_currency\":\"gbp\",\"details_submitted\":false,\"display_name\":null,\"email\":null,\"external_accounts\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/accounts\\/acct_1CiDrqFfZkg6JHQS\\/external_accounts\"},\"keys\":{\"secret\":\"sk_test_mk0ZLGwY6ed7CmbHPQjd942I\",\"publishable\":\"pk_test_zfzuFWIXc24pzn5xg2DzV5CL\"},\"legal_entity\":{\"additional_owners\":[],\"address\":{\"city\":null,\"country\":\"GB\",\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"business_name\":null,\"business_tax_id_provided\":false,\"dob\":{\"day\":null,\"month\":null,\"year\":null},\"first_name\":null,\"last_name\":null,\"personal_address\":{\"city\":null,\"country\":\"GB\",\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"type\":null,\"verification\":{\"details\":null,\"details_code\":null,\"document\":null,\"document_back\":null,\"status\":\"pending\"}},\"metadata\":[],\"payout_schedule\":{\"delay_days\":7,\"interval\":\"daily\"},\"payout_statement_descriptor\":null,\"payouts_enabled\":false,\"product_description\":null,\"statement_descriptor\":\"\",\"support_email\":null,\"support_phone\":null,\"timezone\":\"Etc\\/UTC\",\"tos_acceptance\":{\"date\":null,\"ip\":null,\"user_agent\":null},\"type\":\"custom\",\"verification\":{\"disabled_reason\":\"fields_needed\",\"due_by\":null,\"fields_needed\":[\"external_account\",\"legal_entity.dob.day\",\"legal_entity.dob.month\",\"legal_entity.dob.year\",\"legal_entity.first_name\",\"legal_entity.last_name\",\"legal_entity.type\",\"tos_acceptance.date\",\"tos_acceptance.ip\"]}}', '2018-06-29 16:35:54', '2018-06-29 16:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(10) UNSIGNED NOT NULL,
  `subscribe_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id`, `subscribe_email`, `created_at`, `updated_at`) VALUES
(4, '11569Agerter@hotmail.com', '2018-10-29 10:02:52', '2018-10-29 10:02:52'),
(5, 'Pamelapeters@yahoo.com', '2018-11-01 10:04:29', '2018-11-01 10:04:29'),
(6, 'Bergeman6971@yahoo.com', '2018-11-20 02:52:00', '2018-11-20 02:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'a unique string with user id',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_status` enum('in_active','active') COLLATE utf8_unicode_ci NOT NULL,
  `administrator_approval` enum('2','1','3') COLLATE utf8_unicode_ci NOT NULL COMMENT 'providers approval status by super admin, 1-approved, 2-pending for approval ,3-reject by super admin',
  `user_type` enum('end_user','super_admin','prescriber','non_prescriber') COLLATE utf8_unicode_ci NOT NULL,
  `social_login_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ex:facebook',
  `social_login_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ex:return token from facebook',
  `business_status` enum('2','1') COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verification_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mail verification code',
  `verified_at` datetime DEFAULT NULL COMMENT 'mail verification done at',
  `verification_code_sent_at` datetime NOT NULL COMMENT 'mail verification code sent date',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_slug`, `email`, `password`, `photo`, `user_status`, `administrator_approval`, `user_type`, `social_login_type`, `social_login_id`, `business_status`, `remember_token`, `verification_code`, `verified_at`, `verification_code_sent_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Super admin', 'admin-1', 'laadmin@gmail.com', '$2y$10$LANuXI/Hx4Va0n9nv5pAXO7lNzjith/Ncd6xHu1wvECEh3bkeU8cG', '', 'active', '1', 'super_admin', '', '', '2', 'eqCGzgJTkwrzVrQ9qbx60NBT80Q2toR5BCnx0qfChmwmiUNKS82XVyRaX5wx', '9dc4b0f984da067ab2363c5746e326147a1200b21e5baf1623386769de1ccbe4', '2018-06-13 16:01:13', '2018-06-13 15:57:19', '2018-06-13 10:24:51', '2019-01-21 19:12:46', NULL),
(36, 'Paul', 'peter-36', 'peter.atiiga@gmail.com', '$2y$10$yLjPwQQI8HJLOuFIj0qQHe079EljKGDLzlDK/uDQ/knI4qFqJaaWe', '1532968663.png', 'active', '1', 'prescriber', '', '', '2', '3hVtkuu3GvcIqhDloBhcDsm92LDG9mKL6TNFgYhDkCzsjapwJy9z1ZhMPZNz', 'c5b36ac501333f97c170f6867a15b84cf30bf3dc4f1116743952bf7b68437a9d', '2018-06-29 08:11:36', '2018-06-29 08:08:45', '2018-06-29 15:08:45', '2018-11-29 06:44:45', NULL),
(100, 'Kafayat Brown', 'kafayat-brown-100', 'adexcel@yahoo.com', '$2y$10$V4EqwsIMW8Ov/o4sScrefOrLRA5M1Br2UeneM9ZHcNBVep23gl5Yy', '100_1538523627.png', 'active', '1', 'prescriber', '', '', '2', 'VKQqRIPJTV9SzSbRogwo5N7VX3QhPMmU3tyRQLbApQDpSe5Jv2NSNnCYRW2F', 'b861fd63dba9449c73eec3e1ca9fb2009119354daee12116a73e3da1f6fa7d2d', '2018-10-02 23:21:02', '2018-10-02 22:19:25', '2018-09-26 19:52:45', '2018-10-17 01:42:32', NULL),
(101, 'Albert Mac ', 'albert-mac-101', 'Mac10cedis@gmail.com', '$2y$10$Jvdn8PH.jmfCd2VQouLvQ.RqNyXzyME45iOXrl89q3eRnCQvqqZUW', '101_1538517819.png', 'active', '1', 'prescriber', '', '', '2', 'Mq0kVLofjjKeDMwsqSaT0ayl971cCiJKYrurkdcZDE5Xu5TdUDFwykbIUqHq', 'de26a15b6175150595d1041245ee5f678085eaaa5d727f8b03f3b2ac29897578', '2018-10-02 22:38:17', '2018-10-02 22:35:42', '2018-10-03 05:35:42', '2018-10-03 06:52:50', NULL),
(102, 'johnny', 'johnny-102', 'jonnysmith@gmail.com', '$2y$10$8SB7t6rMx6q3zHPTYnPf9uo/aey8h2WUn8A.9P.PPq.7zD24eZbQC', '', 'in_active', '1', 'end_user', '', '', '2', NULL, '022ac3cef0ac2bc2515782e4bbdab160362263ff8b2bbb2e73e2e9f1c487b0b7', NULL, '2018-10-11 21:56:36', '2018-10-12 04:56:36', '2018-10-12 04:56:36', NULL),
(103, 'Julia foster', 'julia-foster-103', 'juliacfoster@yahoo.co.uk', '$2y$10$oY3h4St5OaPCErbOL9cS..9zepHkSFoWIi8.nGqisdoXpM.7DBMkm', '', 'in_active', '2', 'non_prescriber', '', '', '2', NULL, '2c2acc6db20be16dcf4f6ac210a20a94ecfb8bd342d9ef66eec8fa672efb2544', NULL, '2018-10-14 12:05:11', '2018-10-14 19:05:11', '2018-10-14 19:05:11', NULL),
(104, 'Lorraine Mingoia', 'lorraine-mingoia-104', 'lol43770@hotmail.co.uk', '$2y$10$/gaouP7DqYttDT9ejJD7D.vb6mBZ5gCMD91eHvg.olq9546OZruZW', '', 'active', '1', 'end_user', '', '', '2', NULL, '6ca974834c7f0162f4f290d443cecf51f6fc7020aa850920bfe8343fee1e7f99', '2018-10-20 17:24:28', '2018-10-20 17:22:52', '2018-10-21 00:22:52', '2018-10-21 00:24:28', NULL),
(105, 'Lorraine Mingoia', 'lorraine-mingoia-105', 'Lorrainemingoia@hotmail.co.uk', '$2y$10$e03z32nGUfytAGPoKULnv.Y3ycjyHE0BwP.uXMtI5ep71gaqAV1hy', '', 'in_active', '2', 'non_prescriber', '', '', '2', NULL, '5dbc0da39955e891669376c01f81f09e29b0e18ed9fa57968ee6dcbc14272423', NULL, '2018-10-20 17:26:12', '2018-10-21 00:26:12', '2018-10-21 00:26:12', NULL),
(106, 'Emily Hawley', 'emily-hawley-106', 'emilyhawley1xx@gmail.com', '$2y$10$0tXAMwy9ghG.etWoCxUJQO.AaYFHdLY37plsi/itFjnCAZ/M8VTqK', '', 'active', '1', 'end_user', '', '', '2', 'nT3iB0Ta8NbVgJvIuYNNUTHcws0R2hKVIvKGSgZfMPwQRdoi3IoDHdLOab6D', '32a87185762c5bafefcf119191f25283413c223c5eeecdce9bd1bc200715bb32', '2018-11-18 23:02:56', '2018-11-18 23:00:49', '2018-11-19 06:00:31', '2018-11-19 06:02:56', NULL),
(109, 'Mark Johnson', 'mark-johnson-109', 'mark.johnson@doctors.org.uk', '$2y$10$y2xZA98dC2PyAA9.HBB7HuhN5e/rKKvIKNijRsgdlHdGNacuPuqi.', '', 'in_active', '2', 'non_prescriber', '', '', '2', NULL, 'b5b354bdbf326e8d8f73b58e127eb64f145da44e9da3ca0746f7d423f96c72b5', NULL, '2019-01-16 21:05:58', '2019-01-17 04:05:58', '2019-01-17 04:05:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `uk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_uk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uk_qualification` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_uk_qualification` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `professional` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_professional` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registered_with` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `professional_pin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_professional_pin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_number` text COLLATE utf8_unicode_ci NOT NULL,
  `aesthetic_training` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aesthetic_training_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aesthetic_treatment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insurance_company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insurance_policy_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prescribing_rights` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_aesthetic_training` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_prescribing_rights` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `identity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_proof` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rights_prescribe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `medical_qualification` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aesthetic_training_certificate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insurance_certificate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_certificate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_answers`
--

INSERT INTO `user_answers` (`id`, `user_id`, `uk`, `other_uk`, `uk_qualification`, `other_uk_qualification`, `professional`, `other_professional`, `registered_with`, `professional_pin`, `other_professional_pin`, `registration_number`, `aesthetic_training`, `aesthetic_training_date`, `aesthetic_treatment`, `insurance_company_name`, `insurance_policy_number`, `prescribing_rights`, `other_aesthetic_training`, `other_prescribing_rights`, `identity`, `address_proof`, `rights_prescribe`, `medical_qualification`, `aesthetic_training_certificate`, `insurance_certificate`, `other_certificate`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 36, 'Y', NULL, 'Y', NULL, 'Doctor', NULL, NULL, 'General Medical Council (GMC)', NULL, '1234567', 'Y', '28/05/2018', '8,9,11', 'Lauren', '123456', 'doctor', NULL, NULL, '36_1_1530242630.jpg', '36_2_1530242630.jpg', '36_4_1530242630.jpg', '36_3_1530242630.jpg', '36_5_1530242630.jpg', '36_6_1530242630.jpg', '36_7_1530242630.jpg', NULL, '2018-06-29 15:53:50', '2018-06-29 15:53:50', NULL),
(23, 101, 'Y', '', 'Y', '', 'Doctor', '', NULL, 'General Medical Council (GMC)', '', '123456', 'Y', '02/02/2017', '8,9,11', 'Swinton', '12345678', 'doctor', '', '', '101_1_1538517819.jpg', '101_2_1538517819.jpg', '101_4_1538517819.jpg', '101_3_1538517819.jpg', '101_5_1538517819.jpg', '101_6_1538517819.JPG', NULL, NULL, '2018-10-03 06:03:39', '2018-10-03 06:03:39', NULL),
(24, 100, 'Y', '', 'Y', '', 'Nurse including nurse practitioners ', '', NULL, 'Nursing and Midwifery Council (NMC)', '', '06I0316E', 'Y', '26/03/2017', '8,9,11', 'Hamilton Fraser', '9457001', 'nurse_independent_prescriber', '', '', '100_1_1538523627.png', '100_2_1538523627.png', '100_4_1538523627.png', '100_3_1538523627.png', '100_5_1538523627.jpeg', '100_6_1538523627.png', '100_7_1538523627.jpeg', NULL, '2018-10-03 07:40:27', '2018-10-03 07:40:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` enum('Mr','Mrs','Miss','Ms','Dr') COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_line_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_line_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_string` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'make a comma separated string with user location',
  `social_login_response` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'response from fb after user authentication',
  `post_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `loginCount` int(11) NOT NULL COMMENT 'number of times logged in',
  `lastLogin` datetime NOT NULL COMMENT 'when the user last logged in',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `title`, `surname`, `forename`, `date_of_birth`, `nationality`, `address_line_1`, `address_line_2`, `country`, `country_code`, `state`, `city`, `location_string`, `social_login_response`, `post_code`, `zip`, `phone`, `business`, `business_address`, `latitude`, `longitude`, `loginCount`, `lastLogin`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 36, 'Mr', 'Smith', 'Peter', '03/09/1990', 'British', NULL, '4 Skinner Lane, Leeds, Reino Unido', 'Reino Unido', 'gt', 'England', 'West Yorkshire', '4 skinner lane,leeds,reino unido,reino unido,england,west yorkshire', '', 'LS7 1AR', NULL, '079 081 1239 5', 'WU', 'LA', '53.8039755', '-1.535179400000061', 44, '2018-11-28 23:43:26', NULL, '2018-06-29 15:08:45', '2018-11-29 06:43:26', NULL),
(65, 100, 'Mrs', 'Brown', 'Kafayat Brown', '27/10/1982', 'British', NULL, '127B Chatham Street, London, UK', 'United Kingdom', 'gb', 'England', 'Greater London', '127b chatham street,london,uk,greater london,england,united kingdom,se17 1pa', '', 'SE17 1PA', NULL, '078 246 0204 4', 'Adexcel Aesthetics Clinic', '189 Old Kent Road, London SE1 5NA', '51.4930337', '-0.08755410000003394', 3, '2018-10-16 17:21:43', NULL, '2018-09-26 19:52:45', '2018-10-17 01:03:45', NULL),
(66, 101, 'Dr', 'Opoku', 'Albert Mac ', '07/12/1990', 'British', NULL, '19 Colenso Road, Leeds, UK', 'United Kingdom', 'gb', 'England', 'West Yorkshire', '19 colenso road,leeds,uk,west yorkshire,england,united kingdom,ls11 0bx', '', 'LS11 0BX', NULL, '079 229 7805 8', 'Beautiful Life', 'Carr mills', '53.7816161', '-1.5633560999999645', 3, '2018-10-04 18:30:06', NULL, '2018-10-03 05:35:43', '2018-10-05 01:30:06', NULL),
(67, 102, 'Mr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gb', 'england', 'wakefield', 'wakefield,england,gb', '', NULL, NULL, NULL, NULL, NULL, '53.7000', '-1.4833', 0, '0000-00-00 00:00:00', NULL, '2018-10-12 04:56:36', '2018-10-12 04:56:36', NULL),
(68, 103, 'Mr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gb', 'england', 'mount bures', 'mount bures,england,gb', '', NULL, NULL, NULL, NULL, NULL, '51.9827', '0.7325', 0, '0000-00-00 00:00:00', NULL, '2018-10-14 19:05:11', '2018-10-14 19:05:11', NULL),
(69, 104, 'Mr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gb', 'sheffield', 'sheffield', 'sheffield,sheffield,gb', '', NULL, NULL, NULL, NULL, NULL, '53.3830', '-1.4659', 0, '0000-00-00 00:00:00', NULL, '2018-10-21 00:22:52', '2018-10-21 00:22:52', NULL),
(70, 105, 'Mr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gb', 'sheffield', 'sheffield', 'sheffield,sheffield,gb', '', NULL, NULL, NULL, NULL, NULL, '53.3830', '-1.4659', 0, '0000-00-00 00:00:00', NULL, '2018-10-21 00:26:12', '2018-10-21 00:26:12', NULL),
(71, 106, 'Mr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gb', 'kirklees', 'liversedge', 'liversedge,kirklees,gb', '', NULL, NULL, NULL, NULL, NULL, '53.7051', '-1.6933', 1, '2018-11-18 23:03:14', NULL, '2018-11-19 06:00:31', '2018-11-19 06:03:14', NULL),
(74, 109, 'Mr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gb', 'england', 'leicester', 'leicester,england,gb', '', NULL, NULL, NULL, NULL, NULL, '52.6042', '-1.1463', 0, '0000-00-00 00:00:00', NULL, '2019-01-17 04:05:58', '2019-01-17 04:05:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_registration_count`
--

CREATE TABLE `user_registration_count` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `count` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'registration count',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_registration_count`
--

INSERT INTO `user_registration_count` (`id`, `user_id`, `count`, `created_at`, `updated_at`) VALUES
(18, 101, '1', '2018-10-03 06:03:39', '2018-10-03 06:03:39'),
(19, 100, '1', '2018-10-03 07:40:27', '2018-10-03 07:40:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_settings`
--
ALTER TABLE `admin_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisement_amount`
--
ALTER TABLE `advertisement_amount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisement_type`
--
ALTER TABLE `advertisement_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_account_user_id_foreign` (`user_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancelled_appointment`
--
ALTER TABLE `cancelled_appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cancelled_appointment_user_id_foreign` (`user_id`);

--
-- Indexes for table `disclaimers`
--
ALTER TABLE `disclaimers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gain_provider`
--
ALTER TABLE `gain_provider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `la_payment_history`
--
ALTER TABLE `la_payment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `la_payment_history_user_id_foreign` (`user_id`);

--
-- Indexes for table `mail_chimp_info`
--
ALTER TABLE `mail_chimp_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_history_user_id_foreign` (`user_id`);

--
-- Indexes for table `professional`
--
ALTER TABLE `professional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_combo_services`
--
ALTER TABLE `provider_combo_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_gallery`
--
ALTER TABLE `provider_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_gallery_user_id_foreign` (`user_id`);

--
-- Indexes for table `provider_policies`
--
ALTER TABLE `provider_policies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_policies_user_id_foreign` (`user_id`);

--
-- Indexes for table `provider_refund_policies`
--
ALTER TABLE `provider_refund_policies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_refund_policies_user_id_foreign` (`user_id`);

--
-- Indexes for table `provider_services`
--
ALTER TABLE `provider_services`
  ADD PRIMARY KEY (`provider_services_id`),
  ADD KEY `provider_services_services_id_foreign` (`services_id`);

--
-- Indexes for table `provider_wallet`
--
ALTER TABLE `provider_wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_wallet_user_id_foreign` (`user_id`);

--
-- Indexes for table `refund_history`
--
ALTER TABLE `refund_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refund_history_user_id_foreign` (`user_id`);

--
-- Indexes for table `seo_pages`
--
ALTER TABLE `seo_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_title_settings`
--
ALTER TABLE `seo_title_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_web`
--
ALTER TABLE `seo_web`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`services_id`);

--
-- Indexes for table `services_settings`
--
ALTER TABLE `services_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_settings_user_id_unique` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `status_mail`
--
ALTER TABLE `status_mail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_mail_user_id_foreign` (`user_id`);

--
-- Indexes for table `stripe_user_account`
--
ALTER TABLE `stripe_user_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stripe_user_account_user_id_foreign` (`user_id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_answers_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_registration_count`
--
ALTER TABLE `user_registration_count`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_settings`
--
ALTER TABLE `admin_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `advertisement_amount`
--
ALTER TABLE `advertisement_amount`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `advertisement_type`
--
ALTER TABLE `advertisement_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cancelled_appointment`
--
ALTER TABLE `cancelled_appointment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disclaimers`
--
ALTER TABLE `disclaimers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gain_provider`
--
ALTER TABLE `gain_provider`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `la_payment_history`
--
ALTER TABLE `la_payment_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mail_chimp_info`
--
ALTER TABLE `mail_chimp_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `professional`
--
ALTER TABLE `professional`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `provider_combo_services`
--
ALTER TABLE `provider_combo_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provider_gallery`
--
ALTER TABLE `provider_gallery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `provider_policies`
--
ALTER TABLE `provider_policies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `provider_refund_policies`
--
ALTER TABLE `provider_refund_policies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `provider_services`
--
ALTER TABLE `provider_services`
  MODIFY `provider_services_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `provider_wallet`
--
ALTER TABLE `provider_wallet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refund_history`
--
ALTER TABLE `refund_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seo_pages`
--
ALTER TABLE `seo_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `seo_title_settings`
--
ALTER TABLE `seo_title_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seo_web`
--
ALTER TABLE `seo_web`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `services_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `services_settings`
--
ALTER TABLE `services_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `status_mail`
--
ALTER TABLE `status_mail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stripe_user_account`
--
ALTER TABLE `stripe_user_account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `user_registration_count`
--
ALTER TABLE `user_registration_count`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD CONSTRAINT `bank_account_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cancelled_appointment`
--
ALTER TABLE `cancelled_appointment`
  ADD CONSTRAINT `cancelled_appointment_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `la_payment_history`
--
ALTER TABLE `la_payment_history`
  ADD CONSTRAINT `la_payment_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD CONSTRAINT `payment_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `provider_gallery`
--
ALTER TABLE `provider_gallery`
  ADD CONSTRAINT `provider_gallery_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `provider_policies`
--
ALTER TABLE `provider_policies`
  ADD CONSTRAINT `provider_policies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `provider_refund_policies`
--
ALTER TABLE `provider_refund_policies`
  ADD CONSTRAINT `provider_refund_policies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `provider_services`
--
ALTER TABLE `provider_services`
  ADD CONSTRAINT `provider_services_services_id_foreign` FOREIGN KEY (`services_id`) REFERENCES `services` (`services_id`);

--
-- Constraints for table `provider_wallet`
--
ALTER TABLE `provider_wallet`
  ADD CONSTRAINT `provider_wallet_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `refund_history`
--
ALTER TABLE `refund_history`
  ADD CONSTRAINT `refund_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `services_settings`
--
ALTER TABLE `services_settings`
  ADD CONSTRAINT `services_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `status_mail`
--
ALTER TABLE `status_mail`
  ADD CONSTRAINT `status_mail_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `stripe_user_account`
--
ALTER TABLE `stripe_user_account`
  ADD CONSTRAINT `stripe_user_account_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
