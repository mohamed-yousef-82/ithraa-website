-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2022 at 03:43 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ithraa`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `layer` longtext CHARACTER SET utf8 NOT NULL,
  `description` longtext CHARACTER SET utf8 NOT NULL,
  `image` longtext NOT NULL,
  `goals` longtext CHARACTER SET utf8 NOT NULL,
  `policies` longtext CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `title`, `layer`, `description`, `image`, `goals`, `policies`) VALUES
(2, '', 'القيادات الشابة والناشئة في العمل الخيري\r\n', 'هي ديوانية شهرية لإثراء المعرفة من خلال عرض الكتب الملهمة في العمل الخيري للقيادات الشابة في مناطق محددة', 'data/uploads/file_15174338548.jpg', '* الاطلاع المختصر على الكتب الملهمة في العمل الخيري.\r\n* فتح مجالات التفكير خارج الصندوق لتنمية العمل الخيري.\r\n* مناقشة الأفكار التطبيقية من خلال عرض أفكار الكتب الملهمة في العمل الخيري.\r\n* التواصل بين القيادات الشابة والتبادل المعرفي في الخبرات العملية من خلال النقاشات.\r\n', '* يتم التخطيط للقاءات الديوانية كل ستة أشهر وقبل كل مدة بثلاثة أشهر على الأقل.\r\n* يتاح لكل الأعضاء اقتراح الكتب والضيوف المناسبين حسب الرابط الخاص بذلك.\r\n* يتم تسجيل العضو الضيف المستضاف من قبل أحد الأعضاء قبل اللقاء بيوم على الأقل على الرابط المخصص لذلك.\r\n* يتم اصدار بطاقة عضوية لكل عضو ويلزم احضار البطاقة والتحضير لكل لقاء.\r\n* يتم حذف عضوية أي فرد مشارك في حال غياب ثلاث لقاءات بدون عذر مقبول خلال العام أو غياب لقاءين متتابعين وتسجل الأعذار عن طريق المنسق للديوانية.\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `accordion`
--

CREATE TABLE `accordion` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` longtext CHARACTER SET utf8 NOT NULL,
  `link` longtext CHARACTER SET utf8 NOT NULL,
  `image` longtext CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accordion`
--

INSERT INTO `accordion` (`id`, `title`, `description`, `link`, `image`) VALUES
(2, 'First Accordion', 'Description about this element description about this element description about this element description about this element', 'http://www.google.com', 'data/uploads/file_14973777928.jpg'),
(3, 'Socend Accordion', 'Description about this element description about this element description about this element description about this element', 'www.linkedin.com', 'data/uploads/file_14973780969.jpg'),
(4, 'العنوان', 'الوصف', '', 'data/uploads/file_15105518929.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `name`, `description`, `image`) VALUES
(25, 'فرع الرياض', 'ديوانية شهرية معرفية  في العمل الخيري', 'data/uploads/file_150813444915.png');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `image`, `name`, `cat_id`) VALUES
(14, 'data/uploads/file_150813946214.png', 'مركز عالم وفاق', 25),
(17, 'data/uploads/file_15081395419.jpg', 'أوقاف العرادي الخيرية', 25);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `comment_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` longtext CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `email`, `phone`, `address`) VALUES
(1, 'info@dethra.org', '+966553990025', 'المملكة العربية السعودية');

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `id` int(11) NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL,
  `count` int(11) NOT NULL,
  `image` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`id`, `title`, `count`, `image`) VALUES
(3, 'اللقاءات', 21, 'data/uploads/file_151048834914.png'),
(4, 'الكتب', 21, 'data/uploads/file_151055266215.png'),
(5, 'الزوار', 110, 'data/uploads/file_151048847910.png'),
(6, 'الأعضاء', 50, 'data/uploads/file_15105727868.png');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `add_date` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `book` longtext NOT NULL,
  `photo` longtext NOT NULL,
  `photo2` longtext NOT NULL,
  `photo3` longtext NOT NULL,
  `approve` tinyint(4) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL,
  `numb` int(11) NOT NULL,
  `guest` varchar(50) NOT NULL,
  `guest_pref` varchar(255) NOT NULL,
  `auther` varchar(50) NOT NULL,
  `deliver` varchar(50) NOT NULL,
  `deliver_pref` varchar(255) NOT NULL,
  `contact_number` int(11) NOT NULL,
  `link` longtext NOT NULL,
  `pdf` longtext NOT NULL,
  `item_time` longtext NOT NULL,
  `video` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `name`, `add_date`, `image`, `book`, `photo`, `photo2`, `photo3`, `approve`, `cat_id`, `numb`, `guest`, `guest_pref`, `auther`, `deliver`, `deliver_pref`, `contact_number`, `link`, `pdf`, `item_time`, `video`) VALUES
(148, 'نظم الجودة في المنظمات الغير الربحية', '2017-09-24', 'data/uploads/file_15081351738.jpg', '', 'data/uploads/file_15258025807.png', 'data/uploads/file_152580258012.jpg', 'data/uploads/file_152580258012.jpg', 1, 25, 2, 'أ. عبد الله بن نوري المزين', '', 'عاصم محمد حسن', '', '', 0, '', '', '', ''),
(151, 'كتاب (القطاع الثالث والفرص السانحة)', '2017-10-06', 'data/uploads/file_15081349217.jpg', '', 'data/uploads/file_152580291811.jpg', 'data/uploads/file_15258029185.jpg', 'data/uploads/file_152580291811.jpg', 1, 25, 1, 'د. محمد بن عبد الله السلومي', '', 'د. محمد بن عبد الله السلومي', 'المتلقى', '', 0, '', '', '', ''),
(153, 'كتاب (دعه فإنه مراهق)', '2017-10-16', 'data/uploads/file_150813578413.jpg', '', 'data/uploads/file_152580519512.png', 'data/uploads/file_152580299113.png', 'data/uploads/file_15258029915.png', 1, 25, 3, 'د. عبد الله الطارقي', '', 'د. عبد الله الطارقي', 'اسمد. عبد الله الطارقي', '', 553990025, 'http://dethra.org', '', '', ''),
(154, 'كتاب (العمل الاجتماعي والخيري)', '2017-10-16', 'data/uploads/file_150814953013.jpg', '', 'data/uploads/file_15258051608.jpg', 'data/uploads/file_15258051606.jpg', 'data/uploads/file_152580516010.jpg', 1, 25, 4, 'د. علي بن إبراهيم النملة', '', 'د. علي بن إبراهيم النملة', 'د. علي بن إبراهيم النملة', '', 553990025, 'رابط', '', '', ''),
(155, 'كتاب (ابتكار نموذج العمل التجاري)', '2017-10-16', 'data/uploads/file_15081496458.jpg', '', '', '', '', 1, 25, 5, 'أ. محمد المطيري', 'أ. محمد المطيري', 'أ. محمد المطيري', 'أ. محمد المطيري', 'أ. محمد المطيري', 553990025, 'رابط', '', '', ''),
(156, 'كتاب (هكذا ظهر جيل صلاح الدين وهكذا عادت القدس)', '2017-10-16', 'data/uploads/file_150814980115.jpg', '', '', '', '', 1, 25, 6, 'أ. سلطان الدويش', 'أ. سلطان الدويش', 'د. ماجد عرسان الكيلاني', 'أ. سلطان الدويش', 'أ. سلطان الدويش', 553990025, 'رابط', '', '', ''),
(158, 'كتاب (المانح الأول)', '2017-10-16', 'data/uploads/file_150814989512.jpg', '', '', '', '', 1, 25, 7, 'د. حسن بن شريم', 'د. حسن بن شريم', 'د. حسن بن شريم', 'د. حسن بن شريم', 'د. حسن بن شريم', 553990025, 'رابط', '', '', ''),
(159, 'كتاب (شباب مجتمعي)', '2017-10-16', 'data/uploads/file_15081499826.jpg', '', '', '', '', 1, 25, 8, 'أ. محمد الأنصاري', 'أ. محمد الأنصاري', 'غياث خليل هواري', 'أ. محمد الأنصاري', 'أ. محمد الأنصاري', 553990025, 'رابط', '', '', ''),
(160, 'كتاب (إدارة المنظمات غير الربحية)', '2017-10-16', 'data/uploads/file_150815004815.jpg', '', '', '', '', 1, 25, 9, 'م. موسى بن محمد الموسى', '', 'بيتر دراكر', 'م. موسى بن محمد الموسى', '', 553990025, 'رابط', 'data/uploads/file_15105716898.pdf', '', ''),
(162, 'كتاب (الاجتماع مفهمومه وقضاياه في القرآن الكريم والحديث الشريف)', '2017-10-16', 'data/uploads/file_15081502545.jpg', '', '', '', '', 1, 25, 11, 'د. يحيى الزمزمي', 'د. يحيى الزمزمي', 'أ. محمد الأنصاري و د. عبد الله الطارقي', 'د. يحيى الزمزمي', 'د. يحيى الزمزمي', 553990025, 'رابط', '', '', ''),
(163, 'كتاب (أدوات تطوير الموارد البشرية)', '2017-10-16', 'data/uploads/file_15081503307.jpg', '', '', '', '', 1, 25, 12, 'أ. عبد الله بن نوري المزين', 'أ. عبد الله بن نوري المزين', '-', 'أ. عبد الله بن نوري المزين', 'أ. عبد الله بن نوري المزين', 553990025, 'رابط', '', '', ''),
(164, 'كتاب (المقارنة المرجعية للمؤسسات غير الربحية)', '2017-10-16', 'data/uploads/file_150815050111.jpg', '', '', '', '', 1, 25, 13, 'أ. عبد الله بن نوري المزين', 'أ. عبد الله بن نوري المزين', '--', 'أ. عبد الله بن نوري المزين', 'أ. عبد الله بن نوري المزين', 553990025, 'رابط', '', '', ''),
(165, 'كتاب (الحيوية المالية في الجهات الخيرية)', '2017-10-16', 'data/uploads/file_15081505979.jpg', '', '', '', '', 1, 25, 14, 'أ. علي بن سليمان الفوزان', 'أ. علي بن سليمان الفوزان', '--', 'أ. علي بن سليمان الفوزان', 'أ. علي بن سليمان الفوزان', 553990025, 'رابط', '', '', ''),
(166, 'كتاب ( 15 خطوة عملية تحقق الكفاية الذاتية والاستدامة المالية في الجهات الأهلية)', '2017-10-16', 'data/uploads/file_150815067314.jpg', '', '', '', '', 1, 25, 15, 'د. محمد بن يحيى آل مفرح', 'د. محمد بن يحيى آل مفرح', 'د. محمد بن يحيى آل مفرح', 'د. محمد بن يحيى آل مفرح', 'د. محمد بن يحيى آل مفرح', 553990025, 'رابط', '', '', ''),
(167, 'كتاب (الشيء الوحيد الحقيقة المدهشة البسيطة وراء النتائج الرائعة)', '2017-10-16', 'data/uploads/file_15081507406.jpg', '', '', '', '', 1, 25, 16, 'أ. أديب بن محمد المحيذيف', '', 'جاري كيلر', 'أ. أديب بن محمد المحيذيف', '', 553990025, 'رابط', 'data/uploads/file_151057600715.pdf', '', ''),
(168, 'كتاب (قياس مدى نجاح التدخلات التي تهدف لتحسين سبل عيش الشباب - دليل عملي للرصد والتقييم)', '2017-10-16', 'data/uploads/file_15081508318.jpg', '', '', '', '', 1, 25, 17, 'د. عبد المجيد بن عثمان الزهراني', '', 'كيفين هنيبل - نايثان فيالا', 'د. عبد المجيد بن عثمان الزهراني', '', 553990025, 'رابط', 'data/uploads/file_151057605813.pdf', '', ''),
(169, 'كتاب (كيف يفكر السعوديون؟ أولويات واهتمامات)', '2017-10-16', 'data/uploads/file_150815090114.jpg', '', '', '', '', 1, 25, 18, 'د. سامر أبو رمان', '', 'د. سامر أبو رمان', 'د. سامر أبو رمان', '', 553990025, 'رابط', 'data/uploads/file_151057613415.pdf', '', ''),
(170, 'تصنيف مشاريع الريادة الاجتماعية ', '2017-10-16', 'data/uploads/file_15105480089.jpg', 'data/uploads/file_151691060210.jpg', '', '', '', 1, 25, 19, 'أ. عبد الحميد البلالي', '', 'سويتا كيم ألتر', 'م. سعيد اليزيدي', '', 553990025, 'رابط', 'data/uploads/file_15120354896.jpeg', '', ''),
(173, 'uuuuuuuuuuuuuu', '2017-12-16', 'data/uploads/file_15134179618.jpg', 'data/uploads/file_151341796112.jpg', '', '', '', 0, 25, 656, '', '', 'fgfd', 'fdgfdg', '', 56, 'fdgdf', 'data/uploads/file_151341796113.pdf', '', ''),
(174, 'hgfhhffghfghf', '2017-12-16', 'data/uploads/file_15242282046.jpg', 'data/uploads/file_15242281889.jpg', '', '', '', 0, 25, 55, '', '', 'فقثفق', 'قفثفف', '', 67767, 'بليبلل', 'data/uploads/file_151342508711.pdf', '', ''),
(177, 'oooooooooooo', '', 'data/uploads/file_152421666111.jpg', 'data/uploads/file_152421666115.jpg', '', '', '', 1, 25, 0, '', '', '', '', '', 0, '', 'data/uploads/file_152421663210.', '', ''),
(186, 'كتاب', '8', 'data/uploads/file_152425860112.jpg', 'data/uploads/file_152425860115.jpg', '', '', '', 1, 25, 6, '', '', 'البلب', 'بيسس', '', 98, 'http://www.google.com', 'data/uploads/file_15242586017.pdf', '', 'https://www.youtube.com/embed/JLm1ELLqJkA'),
(187, 'كتاب', '5-3-2020', 'data/uploads/file_152486009911.png', 'data/uploads/file_152486009915.jpg', '', '', '', 1, 25, 6, '', '', 'jhjhj', 'jhjhj', '6464', 656, 'http://www.instagram.com', 'data/uploads/file_152486009914.pdf', '', 'https://www.youtube.com/embed/2I8smQiqzLQ'),
(196, 'Company ', '6', 'data/uploads/file_15258006897.jpg', 'data/uploads/file_152580068915.jpg', 'data/uploads/file_152580068911.jpg', 'data/uploads/file_152580068913.jpg', 'data/uploads/file_152580068911.jpeg', 0, 25, 6, '', '', '6', '6', '6', 6, 'http://www.instagram.com', 'data/uploads/file_152580068914.pdf', '', 'https://www.youtube.com/embed/2I8smQiqzLQ'),
(198, 'كتاب جديدد', '5-3-2020', 'data/uploads/file_15258011826.jpg', 'data/uploads/file_152580114513.jpg', 'data/uploads/file_152580118215.jpg', 'data/uploads/file_15258011828.jpg', 'data/uploads/file_15258011825.jpg', 1, 25, 7, '', '', 'jhjhj', 'jhjhj', '', 7676, 'http://www.instagram.com', 'data/uploads/file_152580114510.png', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ithraa`
--

CREATE TABLE `ithraa` (
  `id` int(11) NOT NULL,
  `image` longtext CHARACTER SET utf8 NOT NULL,
  `pdf` longtext CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ithraa`
--

INSERT INTO `ithraa` (`id`, `image`, `pdf`) VALUES
(4, 'data/uploads/file_150813289811.png', 'data/uploads/file_15081329606.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id`, `image`, `name`) VALUES
(1, 'data/uploads/file_151743389014.png', 'ديوانية اثراء');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `member` longtext CHARACTER SET utf8 NOT NULL,
  `visitor` longtext CHARACTER SET utf8 NOT NULL,
  `image` longtext CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `member`, `visitor`, `image`) VALUES
(1, '- أن يكون العضو مستقر في منطقة الديوانية الجغرافية.<br/>\r\n- أن يكون عاملا مع أحد الجهات الخيرية.<br/>\r\n- أن لا يكون أمضى أكثر من خمس سنوات في العمل الخيري.<br/>\r\n- الالتزام بالحضور للديوانية في مواعيدها المعلنة.<br/>\r\n- إبراز بطاقة العضوية عند الحضور.<br/>\r\n\r\nمميزات العضوية:<br/>\r\n- يحق للعضو اقتراح الكتب الملهمة والمساهمة في تحقيق أهداف الديوانية.<br/>\r\n- أولوية الحضور وحجز مقعد في الديوانية للعضو.<br/>\r\n- أولوية الحصول على نسخة من كتاب اللقاء في حال تم توفيرها.\r\n- يمنح العضو المستمر في البرنامج شهادة حضور في نهاية العام التشغيلي للديوانية.<br/> <br/> <br/>\r\n\r\n', 'يتم دفع رسوم زيارة الديوانية للمرة الواحدة 50 ريال ، ويمكنك الاشتراك بعضوية لعام ب 250 ريال فقط يتم استرداد المبالغ في حال حضور عدد معين من اللقاءات', 'data/uploads/file_150813459813.png');

-- --------------------------------------------------------

--
-- Table structure for table `member_login`
--

CREATE TABLE `member_login` (
  `id` int(11) NOT NULL,
  `user` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `add_date` date NOT NULL,
  `image` longtext NOT NULL,
  `branch` varchar(255) CHARACTER SET utf8 NOT NULL,
  `kind` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_login`
--

INSERT INTO `member_login` (`id`, `user`, `email`, `mobile`, `add_date`, `image`, `branch`, `kind`) VALUES
(2, 'ياسر', 'com@gmail.com', '77', '2017-09-24', 'data/uploads/file_150628733215.jpg', 'فرع جدة', 2),
(3, 'إلياس', 'i.musliyar@gmail.com', '500046507', '2017-09-27', 'data/uploads/file_15065035646.jpg', 'فرع الرياض', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prograss`
--

CREATE TABLE `prograss` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prograss`
--

INSERT INTO `prograss` (`id`, `title`, `count`) VALUES
(2, 'Web Design', 95),
(3, 'Programing', 70),
(4, 'Marketing', 80),
(5, 'Cources', 88);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `product_number` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `distance` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `name`, `mobile`, `email`, `company`, `product_number`, `description`, `distance`, `country`) VALUES
(2, 'Mohamed Yousef', '0100555445556', 'm.yousef_82@yahoo.com', 'My Company', '434344', 'Description About My Request', '23', 'Egypt'),
(3, 'Mohamed Yousef', '068767', 'm.yousef0082@gmail.com', 'My Company', '5466', '656465465666', '23', 'Egypt');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` longtext CHARACTER SET utf8 NOT NULL,
  `image` longtext CHARACTER SET utf8 NOT NULL,
  `link` longtext CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`id`, `title`, `description`, `image`, `link`) VALUES
(3, 'كتاب (كيف يفكر السعوديون؟ أولويات واهتمامات)', 'ديوانية إثراء 18', 'data/uploads/file_151048602913.JPG', 'http://dethra.org/item.php?itemid=169'),
(4, 'تقرير التنمية الإنسانية UNDP واقع الشباب', 'ديوانية إثراء 21', 'data/uploads/file_151055303211.jpg', 'http://dethra.org/item.php?itemid=170'),
(5, 'كتاب (تصنيف مشاريع الريادة الاجتماعية)', 'ديوانية إثراء 19', 'data/uploads/file_15104858116.jpg', 'http://dethra.org/item.php?itemid=171');

-- --------------------------------------------------------

--
-- Table structure for table `socialmedia`
--

CREATE TABLE `socialmedia` (
  `social_id` int(11) NOT NULL,
  `link` longtext NOT NULL,
  `image` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `socialmedia`
--

INSERT INTO `socialmedia` (`social_id`, `link`, `image`) VALUES
(8, 'https://www.youtube.com/channel/UCowetnyZEjgsCYbQDF1J2_A?view_as=subscriber', 'fa fa-youtube'),
(13, 'https://twitter.com/waqf_alaradi', 'fa fa-twitter');

-- --------------------------------------------------------

--
-- Table structure for table `tabs`
--

CREATE TABLE `tabs` (
  `id` int(11) NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabs`
--

INSERT INTO `tabs` (`id`, `title`) VALUES
(2, 'ديوانية إثراء  3'),
(3, 'ديوانية إثراء 2'),
(4, 'ديوانية إثراء 1'),
(5, 'ديوانية إثراء  4'),
(6, 'ديوانية إثراء 5'),
(7, 'ديوانية إثراء 6'),
(8, 'ديوانية إثراء 7'),
(9, 'ديوانية إثراء 8'),
(10, 'ديوانية إثراء 9'),
(11, 'ديوانية إثراء 10'),
(12, 'ديوانية إثراء 11'),
(13, 'ديوانية إثراء 12'),
(14, 'ديوانية إثراء 13'),
(15, 'ديوانية إثراء 14'),
(16, 'ديوانية إثراء 15'),
(17, 'ديوانية إثراء 16'),
(18, 'ديوانية إثراء 17'),
(19, 'ديوانية إثراء 18'),
(20, 'ديوانية إثراء 19'),
(21, 'ديوانية إثراء 20'),
(22, 'ديوانية إثراء 21');

-- --------------------------------------------------------

--
-- Table structure for table `tabs_items`
--

CREATE TABLE `tabs_items` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` longtext CHARACTER SET utf8 NOT NULL,
  `image` longtext CHARACTER SET utf8 NOT NULL,
  `tab` int(11) NOT NULL,
  `approve` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabs_items`
--

INSERT INTO `tabs_items` (`id`, `title`, `description`, `image`, `tab`, `approve`, `item_id`) VALUES
(18, 'ديوانية إثراء 1', 'صور اللقاء', 'data/uploads/file_15081360245.JPG', 4, 1, 151),
(19, 'الصورة الثانية', 'بسيبسيسسب', 'data/uploads/file_150629908711.jpg', 3, 0, 149),
(20, 'الصورة الثالثة', 'سيسيسي', 'data/uploads/file_150629913915.jpg', 4, 1, 150),
(21, 'الالال', 'الالا', 'data/uploads/file_150650238812.jpg', 3, 0, 150),
(22, 'كتاب (نظم الجودة في المنظمات الغير الربحية)', '', 'data/uploads/file_15104875508.JPG', 3, 1, 148),
(23, 'ديوانية إثراء 3', '', 'data/uploads/file_15104876105.JPG', 2, 1, 153),
(24, 'ديوانية إثراء 4', '', 'data/uploads/file_151048768815.jpg', 5, 1, 154),
(25, 'ديوانية إثراء 5', '', 'data/uploads/file_15104877266.jpg', 6, 1, 155),
(26, 'ديوانية إثراء 6', '', 'data/uploads/file_15104877945.jpg', 7, 1, 156);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `groupid` int(11) NOT NULL DEFAULT '0',
  `truststatus` int(11) NOT NULL DEFAULT '0',
  `regstatus` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `image` longtext NOT NULL,
  `branch` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `fullname`, `groupid`, `truststatus`, `regstatus`, `date`, `image`, `branch`) VALUES
(23, 'mohamed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'company@gmail.com', 'mohamed yousef ', 1, 0, 1, '2017-07-11', 'data/uploads/file_14997832486.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` longtext CHARACTER SET utf8 NOT NULL,
  `link` longtext CHARACTER SET utf8 NOT NULL,
  `tab` int(11) NOT NULL,
  `branch` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `approve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `title`, `description`, `link`, `tab`, `branch`, `item_id`, `approve`) VALUES
(4, 'الديوانية 13', 'ديوانية إثراء 13', 'https://www.youtube.com/embed/2I8smQiqzLQ', 2, 25, 164, 0),
(5, 'الفيديو الثانى', 'سشسش', 'https://www.youtube.com/embed/LMvdCihhiMs', 3, 26, 149, 0),
(6, 'الفيديو الثالث', 'سشسيسسي', 'https://www.youtube.com/embed/LMvdCihhiMs', 4, 27, 150, 0),
(7, '', '', '', 2, 25, 151, 0),
(8, 'ديوانية إثراء 18', 'الرياض', 'https://www.youtube.com/embed/AJ_lGJcuGsY', 19, 25, 169, 0),
(9, 'ديوانية إثراء 13', 'الرياض', 'https://www.youtube.com/embed/2I8smQiqzLQ\" frameborder=', 14, 25, 164, 0),
(10, 'ديوانية إثراء 15', 'الرياض', 'https://www.youtube.com/embed/ogY4zDGZzKY\" frameborder=', 16, 25, 166, 0),
(11, 'ديوانية إثراء 17', 'الرياض', 'ihttps://www.youtube.com/embed/bVo_eGf-ggM\" frameborder=', 18, 25, 168, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accordion`
--
ALTER TABLE `accordion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `items_comment` (`item_id`),
  ADD KEY `comment_user` (`user_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `Cat_1` (`cat_id`);

--
-- Indexes for table `ithraa`
--
ALTER TABLE `ithraa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_login`
--
ALTER TABLE `member_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prograss`
--
ALTER TABLE `prograss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socialmedia`
--
ALTER TABLE `socialmedia`
  ADD PRIMARY KEY (`social_id`);

--
-- Indexes for table `tabs`
--
ALTER TABLE `tabs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabs_items`
--
ALTER TABLE `tabs_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `accordion`
--
ALTER TABLE `accordion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;
--
-- AUTO_INCREMENT for table `ithraa`
--
ALTER TABLE `ithraa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `member_login`
--
ALTER TABLE `member_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `prograss`
--
ALTER TABLE `prograss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `socialmedia`
--
ALTER TABLE `socialmedia`
  MODIFY `social_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tabs`
--
ALTER TABLE `tabs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tabs_items`
--
ALTER TABLE `tabs_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_comment` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `Cat_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
