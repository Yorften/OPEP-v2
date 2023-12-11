-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql109.infinityfree.com
-- Generation Time: Dec 11, 2023 at 04:16 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_35580390_opepv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `articleId` int(11) NOT NULL,
  `articleTitle` varchar(255) DEFAULT NULL,
  `articleContent` varchar(30000) DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `themeId` int(11) DEFAULT NULL,
  `articleTag` varchar(50) DEFAULT NULL,
  `isDeleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`articleId`, `articleTitle`, `articleContent`, `userId`, `themeId`, `articleTag`, `isDeleted`) VALUES
(1, 'Mastering the Green Thumb: Essential Gardening Know-How for Beginners', 'Gardening can be a rewarding and therapeutic journey, but for those new to the craft, it might seem overwhelming. The good news is that with the right guidance, anyone can cultivate a flourishing garden. Whether you&#039;re dreaming of a backyard filled with vibrant blooms or a kitchen garden bursting with fresh produce, understanding some fundamental gardening know-how is the first step toward success.&#10;&#10;Understanding Your Zone and Soil&#10;Before you start digging, it&#039;s crucial to familiarize yourself with your plant hardiness zone. Knowing your zone helps you select plants that thrive in your climate. Websites or local agricultural extensions often provide detailed zone maps, making it easier to choose the right plants for your area.&#10;&#10;Next up is understanding your soil. Testing your soil&#039;s pH level and composition can offer invaluable insights. Different plants prefer different soil types, so amending your soil accordingly can significantly boost your gardening success.&#10;&#10;Sunlight: The Gardener&#039;s Best Friend&#10;Sunlight plays a pivotal role in a plant&#039;s life. Knowing the sunlight requirements of your plants is essential. Some plants thrive in full sun, while others prefer partial or full shade. Observing the sun patterns in your garden area can help determine the best spots for planting.&#10;&#10;Watering Wisdom&#10;One of the most common mistakes new gardeners make is either overwatering or underwatering their plants. Understanding the watering needs of your plants is crucial. Factors like the plant type, soil type, and weather conditions influence how much and how often you should water. Remember, it&#039;s better to water deeply and less frequently than to sprinkle lightly every day.&#10;&#10;Companion Planting and Pest Control&#10;Companion planting is a time-honored technique that involves growing certain plants together to benefit each other. Some plants repel pests or attract beneficial insects, while others enhance soil fertility. Researching companion planting strategies can help create a thriving, pest-resistant garden naturally.&#10;&#10;Seasonal Care and Maintenance&#10;Different seasons call for different gardening tasks. Spring might involve soil preparation and planting, while summer requires vigilant watering and pest control. Fall could mean harvesting and preparing the garden for the colder months, and winter might involve protecting plants from frost. Understanding the seasonal needs of your garden ensures its continuous growth and health.&#10;&#10;Conclusion&#10;Embarking on a gardening journey is a wonderful experience filled with learning and rewards. By mastering the basics of gardening know-how â€” from understanding your zone and soil to embracing the rhythms of nature throughout the seasons â€” you&#039;ll pave the way for a thriving garden. Remember, every gardener started somewhere, so don&#039;t be afraid to get your hands dirty, ask questions, and enjoy the process of nurturing your green space.', 11, 1, 'Flowers', 0),
(2, 'Gardening: A Beginner\'s Guide to Green-Thumbed Success', 'For those venturing into the world of gardening, there are foundational steps to ensure a thriving garden. Begin by understanding your plant hardiness zone. This knowledge aids in selecting plants suited to your climate, increasing their chances of flourishing.&#10;&#10;Soil is the backbone of a garden. Test its pH and composition to tailor it to your plants&#039; needs. Amending soil can make a significant difference in plant health and growth.&#10;&#10;Sunlight dictates plant growth. Familiarize yourself with your garden&#039;s sunlight patterns to position plants accordingly - full sun, partial shade, or full shade - for optimal growth.&#10;&#10;Watering is both an art and a science. Strike the right balance by understanding each plant&#039;s watering needs based on type, soil type, and prevailing weather conditions.&#10;&#10;Companion planting isn&#039;t just about aesthetics; it&#039;s a strategic move. Certain plants repel pests or attract beneficial insects, aiding in a natural defense system for your garden.&#10;&#10;Each season brings its own tasks. Spring initiates planting, summer requires vigilant watering and pest management, fall is harvest time, and winter necessitates protection from frost.&#10;&#10;Starting a garden is a learning curve. Embrace the learning process, observe nature&#039;s cues, and don&#039;t fear mistakes - they&#039;re part of the journey. Enjoy the wonder of nurturing life and witnessing your garden thrive.', 11, 1, 'Beginner', 0),
(3, 'Embarking on the Gardening Journey: A Beginner\'s Primer', 'For novices diving into gardening, the first step is understanding your plant hardiness zone. This information guides you in selecting plants that can thrive in your specific climate, ensuring a greater chance of success.&#10;&#10;Soil forms the foundation for healthy plants. Conduct tests to analyze its pH and composition. Adjustments like composting or adding specific nutrients can transform ordinary soil into a nourishing bed for your plants.&#10;&#10;The sun is a crucial factor in plant growth. Assess your garden&#039;s sunlight patterns to determine suitable spots for plants requiring full sun, partial shade, or full shade.&#10;&#10;Watering practices can make or break a garden. Learning the watering needs of your plants based on their type, soil, and weather conditions is essential. Deep, infrequent watering is often more beneficial than frequent, shallow watering.&#10;&#10;Companion planting is a strategic approach. Certain plants complement each other, repel pests, or attract beneficial insects, promoting a healthy garden ecosystem.&#10;&#10;Each season brings distinct tasks. Spring initiates planting and soil preparation, summer demands consistent watering and pest control, fall heralds harvest time, and winter requires protection against frost.&#10;&#10;Gardening is an ongoing learning process. Embrace the journey, seek advice when needed, and revel in the joy of nurturing life as your garden transforms into a vibrant, flourishing haven.', 25, 1, 'Beginner', 0),
(8, 'Blooms in Bloom: Exploring the Art of Floral Arrangements', 'Floral artistry is a captivating realm where nature&#039;s vibrant hues come together in stunning compositions. Delving into the world of floral arrangements opens a doorway to creativity and expression, allowing one to craft beauty from nature&#039;s bounty.&#10;&#10;Understanding Floral Design Principles&#10;&#10;At the heart of floral artistry lie design principles that guide composition. Balance, proportion, color, and texture are foundational elements. Balancing various flower shapes, sizes, and colors creates visually appealing arrangements. Proportion ensures harmony, while texture adds depth and interest.&#10;&#10;Choosing the Perfect Blooms&#10;&#10;Flower selection is an art in itself. Different flowers evoke distinct emotions and suit varied occasions. Roses symbolize love, while lilies evoke purity. Combining flowers with complementary colors and shapes elevates the arrangement&#039;s visual impact.&#10;&#10;Tools and Techniques&#10;&#10;Armed with the right tools, floral arranging becomes an enjoyable endeavor. Essential tools include floral shears, floral tape, and a variety of containers. Techniques like clustering, layering, and wiring help shape and structure arrangements, transforming blooms into artistic displays.&#10;&#10;Seasonal Inspirations&#10;&#10;Drawing inspiration from seasonal blooms adds a touch of nature&#039;s essence to arrangements. Spring offers tulips and daffodils, while summer presents an array of vibrant hues with sunflowers and dahlias. Autumn&#039;s rich colors feature chrysanthemums and marigolds, and winter embraces evergreens and holly.&#10;&#10;Expressing Creativity through Arrangements&#10;&#10;Floral artistry transcends mere aesthetics; it&#039;s a means of self-expression. From whimsical and romantic to minimalist and avant-garde, arrangements reflect emotions, themes, and personal style. Customizing arrangements for events or spaces adds a personal touch and creates memorable experiences.&#10;&#10;The Joy of Floral Gifting&#10;&#10;Gifting floral arrangements is a timeless gesture, conveying sentiments of love, gratitude, or sympathy. Knowing the language of flowers helps convey specific emotions, making each arrangement a heartfelt gift.&#10;&#10;Conclusion: Embracing Floral Beauty&#10;&#10;Floral artistry is a celebration of nature&#039;s beauty and human creativity. Exploring design principles, selecting blooms thoughtfully, and mastering techniques unleash the potential to create captivating arrangements. Whether adorning a space, celebrating an occasion, or gifting sentiments, floral artistry elevates moments and adds a touch of natural elegance to life&#039;s tapestry.', 1, 5, 'FlowerArrangements', 0),
(9, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam imperdiet finibus vestibulum. Pellentesque vel orci felis. Sed id nisi at diam porttitor facilisis vitae sit amet nunc. Proin mi nulla, tincidunt et enim sit amet, laoreet consequat tellus. In ultricies laoreet ipsum vel rutrum. Aliquam in elit vulputate, volutpat lectus eu, porta mi. Aenean tellus odio, commodo sagittis luctus et, posuere et tellus. Mauris efficitur enim ut libero finibus, ut cursus est suscipit.&#10;&#10;Phasellus finibus a nunc condimentum condimentum. Ut id faucibus ante. In a odio ut velit convallis ullamcorper a egestas ligula. Curabitur et lectus et arcu vulputate viverra. Nulla ornare suscipit neque ac commodo. Maecenas et viverra sapien, eget lobortis ex. Morbi metus ipsum, vestibulum eu sem a, mattis cursus nunc. Etiam commodo tincidunt nisl in accumsan. Ut in urna erat. Vestibulum pellentesque, tellus tempus lobortis blandit, enim nulla aliquam enim, ac pellentesque dui nulla fringilla erat. Aenean egestas consequat lorem, sed varius augue dictum hendrerit. Duis porta posuere molestie. In vel arcu ut nulla congue dictum. Donec non sapien sit amet leo egestas consectetur. Fusce facilisis nunc non lacus lacinia scelerisque.&#10;&#10;Vestibulum mattis dui ante, in porta nunc tincidunt quis. Donec vestibulum cursus ex sed varius. Aenean ac viverra nisl, non efficitur nunc. Mauris fringilla mattis bibendum. Etiam volutpat ultricies porta. Quisque risus est, accumsan in faucibus ultricies, sollicitudin nec ante. Fusce rhoncus mattis arcu vel pharetra. Aliquam vehicula libero et varius elementum. Sed quis lectus at nulla vestibulum condimentum.&#10;&#10;Vivamus facilisis nunc id velit dictum, sed lobortis metus semper. Aenean volutpat purus dolor, tincidunt eleifend leo semper nec. Aliquam erat volutpat. Sed lorem nisi, ultricies sit amet ornare sed, dapibus vel nibh. Suspendisse at magna dolor. Curabitur pretium lectus quis dolor posuere, a pulvinar libero blandit. Nunc accumsan, turpis id porttitor dignissim, augue felis fringilla lorem, in pulvinar eros urna sit amet lectus. Sed posuere, metus non vestibulum finibus, felis nulla pellentesque elit, id convallis lectus dui nec velit. In hac habitasse platea dictumst.&#10;&#10;Fusce quis felis vitae urna pretium tristique. Proin finibus consequat felis a maximus. Suspendisse malesuada ligula non velit imperdiet dictum. Nulla suscipit a neque vel imperdiet. Donec at viverra turpis, sed tincidunt leo. Phasellus sed sapien fermentum, pretium nisl eget, pretium mauris. Ut et pulvinar felis. Mauris fringilla dolor ac pharetra congue. Duis finibus dui laoreet volutpat gravida. Nulla accumsan at diam placerat luctus. Nunc commodo sapien nec nibh semper laoreet. Nullam massa massa, auctor sed fermentum et, sagittis eu ex. Nulla vehicula metus et augue pharetra pellentesque et vel turpis. Integer nisi ligula, pretium sit amet magna quis, rhoncus congue felis. Quisque ac convallis massa, ac tempor risus. Vestibulum consectetur, velit a congue eleifend, mauris odio cursus nulla, non dictum justo lorem quis purus.', 1, 3, 'LanguageOfFlowers', 1);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cartId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cartId`, `userId`) VALUES
(1, 5),
(3, 9),
(4, 10),
(5, 11),
(19, 12),
(20, 12),
(6, 13),
(7, 13),
(8, 13),
(9, 13),
(10, 13),
(11, 13),
(12, 13),
(13, 14),
(14, 15),
(15, 16),
(16, 17),
(17, 18),
(18, 19),
(21, 20),
(22, 22),
(23, 25),
(24, 28);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'Alocasia'),
(2, 'Anthurium'),
(3, 'Calathea'),
(4, 'Ficus'),
(5, 'Monstera'),
(6, 'Philodendron');

-- --------------------------------------------------------

--
-- Table structure for table `commands`
--

CREATE TABLE `commands` (
  `commandId` int(11) NOT NULL,
  `commandDate` date NOT NULL,
  `cartId` int(11) NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commands`
--

INSERT INTO `commands` (`commandId`, `commandDate`, `cartId`, `total`) VALUES
(18, '2023-11-29', 5, 1510),
(19, '2023-11-29', 14, 1431),
(20, '2023-11-29', 14, 604),
(21, '2023-11-29', 19, 6287),
(22, '2023-11-30', 19, 18717),
(23, '2023-11-30', 5, 663),
(24, '2023-11-30', 5, 1292);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentId` int(11) NOT NULL,
  `commentContent` varchar(3000) DEFAULT NULL,
  `userSession` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  `isDeleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `commentContent`, `userSession`, `articleId`, `isDeleted`) VALUES
(126, 'Cool article!', 11, 1, 0),
(127, 'zzzzzz', 12, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `plantId` int(11) NOT NULL,
  `plantName` varchar(50) NOT NULL,
  `plantDesc` varchar(300) NOT NULL,
  `plantImage` varchar(200) NOT NULL,
  `plantPrice` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`plantId`, `plantName`, `plantDesc`, `plantImage`, `plantPrice`, `categoryId`) VALUES
(5, 'Corrupti quam fugia', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a6fbeb4f08.40496695.avif', 767, 1),
(6, 'Ut eum cupidatat ut ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a776686563.01550973.avif', 743, 1),
(7, 'Omnis rerum soluta a', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a7fcba7165.10904732.avif', 663, 1),
(8, 'Cillum voluptate con', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a8040b4b38.08460861.avif', 47, 1),
(9, 'Ex velit voluptas ha', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a960ead941.96194964.avif', 688, 1),
(10, 'Magni ex officiis od', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a97cc34234.47961002.avif', 604, 1),
(11, 'Debitis laboris tene', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a99a508fc7.45531059.avif', 715, 1),
(12, 'Exercitationem modi ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a9a33cf527.14924931.avif', 938, 1),
(13, 'Numquam cumque ea et', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a9ab5cacd0.25106978.avif', 239, 1),
(14, 'Non tempor pariatur', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564a9b436c903.09059382.avif', 575, 1),
(15, 'Natus earum eu dicta', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564abffb21ff8.31232854.avif', 635, 2),
(16, 'In mollit in qui lib', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ac0a5c9d42.26958955.avif', 928, 4),
(17, 'Est fugiat sit rem', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ac1330c1c8.61787381.avif', 624, 4),
(18, 'Tempor illum reicie', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ac4ba5dec9.95657717.avif', 732, 5),
(19, 'Laboris est et eveni', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ac54ca4066.71954356.avif', 851, 5),
(20, 'Aliquip in molestiae', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ac78492665.28278304.avif', 272, 2),
(21, 'Omnis voluptas ullam', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ac814b8ba8.09852203.avif', 210, 2),
(22, 'Occaecat aspernatur ', 'Non amet id ea par', 'IMG-6564ac8bf3eb57.52155615.avif', 632, 2),
(23, 'Dolorem non quam dol', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564aca7b99fe6.74159729.avif', 132, 4),
(24, 'Labore harum volupta', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564acaf647e68.25344980.avif', 808, 4),
(25, 'Consequatur sunt ut', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564acb9b46526.36304615.avif', 98, 4),
(26, 'Porro magna ea eiusm', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564accd42fb62.20376249.avif', 770, 5),
(27, 'Accusamus nostrud ex', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564acd5005a67.96209236.avif', 514, 6),
(28, 'Incidunt et possimu', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564acde3e9cd6.12540958.avif', 807, 6),
(29, 'Et sunt sed culpa ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564acec966e46.37369085.avif', 333, 5),
(30, 'Aperiam illum ut of', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564acf36e1879.25065436.avif', 988, 6),
(31, 'Corporis cillum sapi', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564acfcdd76a9.64901956.avif', 249, 6),
(32, 'Ipsa exercitation i', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad0559e197.54279980.avif', 115, 6),
(33, 'Et aut blanditiis ip', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad1a97a4d4.85227686.avif', 524, 3),
(34, 'Ullamco et repellend', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad25339208.58745322.avif', 825, 3),
(35, 'Aut corrupti quo se', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad321127c3.90237164.avif', 916, 3),
(36, 'Magna do veritatis e', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad3ba61097.95977253.avif', 390, 6),
(37, 'Elit veniam incidi', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad42226785.40658458.avif', 234, 3),
(38, 'Ullamco ducimus num', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad4fbbbb86.70473620.avif', 582, 5),
(39, 'Et ipsum est quaera', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad6bd4b5e8.88287235.avif', 637, 6),
(40, 'Corrupti alias simi', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad88bc3bb3.89260818.avif', 457, 3),
(41, 'Est voluptates odio ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad949bfbb8.83024420.avif', 484, 5),
(42, 'Laboris ex cupiditat', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ad9e0a0a22.03768578.avif', 293, 3),
(43, 'Voluptatibus volupta', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564ada79a2542.37685311.avif', 609, 3),
(44, 'Alias voluptates fac', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564adb0165c15.55847651.avif', 131, 5),
(45, 'Quo illum et est ut', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, ipsum!', 'IMG-6564adb90a3139.86816290.avif', 494, 5);

-- --------------------------------------------------------

--
-- Table structure for table `plants_carts`
--

CREATE TABLE `plants_carts` (
  `plants_cartsId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `plantId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `isSelected` int(11) NOT NULL DEFAULT 0,
  `isCommanded` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plants_carts`
--

INSERT INTO `plants_carts` (`plants_cartsId`, `cartId`, `plantId`, `quantity`, `isSelected`, `isCommanded`) VALUES
(85, 19, 6, 4, 1, 21),
(86, 19, 7, 5, 1, 21),
(87, 19, 10, 16, 1, 22),
(88, 19, 40, 2, 1, 0),
(89, 19, 42, 1, 1, 22),
(90, 19, 16, 7, 1, 22),
(91, 19, 17, 1, 1, 22),
(92, 19, 23, 2, 1, 22),
(98, 14, 6, 1, 1, 19),
(99, 14, 9, 1, 1, 19),
(100, 14, 10, 1, 0, 20),
(102, 5, 5, 1, 1, 18),
(103, 5, 7, 3, 1, 23),
(104, 5, 9, 1, 0, 24),
(105, 5, 10, 1, 0, 24),
(106, 19, 5, 1, 1, 22),
(107, 19, 43, 1, 1, 22),
(108, 19, 7, 1, 0, 0),
(109, 5, 7, 3, 1, 0),
(111, 23, 7, 7, 0, 0),
(112, 23, 6, 1, 1, 0),
(113, 23, 5, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleId` int(11) NOT NULL,
  `roleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleId`, `roleName`) VALUES
(1, 'Client'),
(2, 'Admin'),
(3, 'Administrator'),
(4, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tagId` int(11) NOT NULL,
  `tagName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tagId`, `tagName`) VALUES
(20, 'Water'),
(21, 'Health'),
(22, 'Summer'),
(44, 'Fall'),
(45, 'Winter'),
(46, 'Spring'),
(47, 'Flowers'),
(48, 'Trees'),
(49, 'Fruit'),
(50, 'Vegetables'),
(52, 'RarePlants'),
(53, 'PlantAdaptations'),
(54, 'GardeningTips'),
(55, 'SeasonalCare'),
(56, 'FlowerArrangements'),
(57, 'PressedFlowers'),
(58, 'LanguageOfFlowers'),
(59, 'NativePlants'),
(60, 'BotanicalGardens'),
(61, 'Foraging'),
(62, 'MedicinalHerbs'),
(63, 'HerbalTeas'),
(64, 'HerbalWellness'),
(66, 'Beginner');

-- --------------------------------------------------------

--
-- Table structure for table `tags_themes`
--

CREATE TABLE `tags_themes` (
  `tags_themesId` int(11) NOT NULL,
  `themeId` int(11) DEFAULT NULL,
  `tagId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags_themes`
--

INSERT INTO `tags_themes` (`tags_themesId`, `themeId`, `tagId`) VALUES
(42, 2, 44),
(43, 2, 46),
(44, 2, 47),
(45, 2, 48),
(46, 2, 59),
(47, 2, 60),
(48, 3, 58),
(49, 3, 59),
(50, 3, 61),
(51, 4, 48),
(52, 4, 49),
(53, 4, 50),
(54, 4, 52),
(55, 4, 53),
(56, 4, 54),
(57, 4, 55),
(58, 5, 46),
(59, 5, 47),
(60, 5, 56),
(61, 5, 57),
(62, 5, 58),
(63, 6, 62),
(64, 6, 63),
(65, 6, 64),
(75, 1, 20),
(76, 1, 21),
(77, 1, 47),
(78, 1, 48),
(79, 1, 49),
(80, 1, 50),
(81, 1, 66);

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `themeId` int(11) NOT NULL,
  `themeName` varchar(255) DEFAULT NULL,
  `themeDeleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`themeId`, `themeName`, `themeDeleted`) VALUES
(0, 'None', 1),
(1, 'Gardening KnowHow', 0),
(2, 'Botanical Wonders', 0),
(3, 'Green Oasis', 0),
(4, 'Plant Parenthood', 0),
(5, 'Floral Artistry', 0),
(6, 'Herbal Remedies', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userEmail` varchar(300) NOT NULL,
  `userPassword` mediumblob NOT NULL,
  `isVerified` int(11) NOT NULL DEFAULT 0,
  `roleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPassword`, `isVerified`, `roleId`) VALUES
(1, 'Administrator', 'admin@youcode.ma', 0x243279243130243163554c354631787233587a4e42724d67335850364f6f636e61306d36507a6264307268503139762f486f6d49545253592e785743, 1, 3),
(2, 'giviqacy', 'lybokob@mailinator.com', 0x24327924313024594a2f4d55336e357067383354455536533933426e2e746b6f524345355172525357797472344b712f5346322e6a57766348355157, 0, 2),
(4, 'admin', 'mod@youcode.ma', 0x24327924313024694f774e46564f4e58443061626a74566739575832754742674a6338765030394170317944336d4c71573269466c7869656a5a3736, 1, 2),
(5, 'fyxyqicod', 'zaxozy@mailinator.com', 0x243279243130244c475962766a494b2e754a6c524759776f735363422e396f7037503134714c575032333132644a3471614f6858436d796c6461334b, 1, 1),
(8, 'linuga', 'vuwuryvo@mailinator.com', 0x2432792431302459685a5167643043744e523150626e3978725658564f6c687331424f494f6e4562384754595951486672594d66725a41394556444f, 0, 4),
(9, 'tived', 'jewitu@mailinator.com', 0x243279243130245051335175617653754c544d696e6a68554e58645475785273545744794d4935744c77306f50336c752e4a566e662f5a534b654d71, 1, 1),
(10, 'bicizizaqa', 'nyhajagy@mailinator.com', 0x24327924313024426577526f466f554a537552504e526a43356b62377530364643734a4b59655a6c3236336a37754e62322e6e68363859793952624b, 1, 1),
(11, 'client', 'lebywi@mailinator.com', 0x24327924313024304c4a443255306742744b7974584941397a4b4b56656a6b526a433045673869794741306a74554e48566536354e634e2e58774d6d, 1, 1),
(12, 'client2', 'seqedejel@mailinator.com', 0x2432792431302448656e674e64466d4c343257504a6c6b65494747507568584e6e4c30532e77584766737954505a7745773243315757755059423875, 1, 1),
(13, 'jykosot', 'piqid@mailinator.com', 0x243279243130246159354c54715878634342342e56364d394a63566e654431655a544531357766424f7370764a783566517477543854316158577657, 1, 1),
(14, 'client3', 'zaru@mailinator.com', 0x24327924313024394e447a4c744f47772e6f554d43574b57456d4e6d2e45705a41326c75444e7749706545744d633743484b4e396b36716851746e79, 1, 1),
(15, 'client4', 'fynuqirep@mailinator.com', 0x2432792431302446412e42523636632e4e544b2f5a63766143744a2e7537597a713274756b324b6b732e692f6d6239384251394c6f694e732e7a4f4f, 1, 1),
(16, 'xyvyboveri', 'fude@mailinator.com', 0x2432792431302453387a50394a3864746c6e777436737235552e314765634e45482f6f517733354b4464776264353571307964682f4a6c3231363243, 1, 1),
(17, 'myqysu', 'musubow@mailinator.com', 0x2432792431302459414c63716c3145776c796a7a58376253524b67714f692f636b467535547667774d48682f4e3475756431456a6175507779483357, 1, 1),
(18, 'zowimazu', 'gekuqek@mailinator.com', 0x243279243130243438624d53565a75526e62682f383054326a4f727565362f674f6461746c4c655652706f6c4f524246584c6e6f4957446e7a6f704b, 1, 1),
(19, 'gurupel', 'laxebowaq@mailinator.com', 0x24327924313024466b6a546d4f4d46682f48477831736d3153426c4375314e4733376d3578663459346c443267426b42726b747a30384d72652f7936, 1, 1),
(20, 'noura', 'malek', 0x243279243130246d49476854676f596c703135766e716f78534558767542717162374336682e7a566a73325535585541305a7241517a5143704f5779, 1, 1),
(21, 'ghollam', 'ghollamsimo1@gmail.com', 0x24327924313024784e357333486e583773314867633567645049347975337546535968626b677274745974305578634f72687347646171746655612e, 0, 4),
(22, 'jhon doe', 'jhonzaml@gmail.com', 0x24327924313024765043746c525556356f75574239505a75633763624f5647632e654853482f4978392e5365515236344662467a7350387847775553, 1, 1),
(23, 'gyjihyla', 'vuhas@mailinator.com', 0x243279243130247255784c496b504c4e533435497a4e6d714a4d39474f686c6732546f30494d6338306b7a423870303769774276446648424e775a4f, 0, 2),
(24, 'sazijicupo', 'sofe@mailinator.com', 0x243279243130246c4b4c7167593876734341477879583670396a36564f41675a6468624c73732e776c3167576d773655775a4859423252646963392e, 0, 4),
(25, 'xunoreqova', 'byqezesawa@mailinator.com', 0x24327924313024436f79355439634f35793853736e57386d73634c472e36504333486f4344792f5a3861316e53573854446b7743534c595563663043, 1, 1),
(26, '..', ' .', 0x243279243130247877684b576b636f694569663764393347734a4b412e67576e5169546f794a3845325a612f66717865586337355448666a6d667753, 0, 2),
(27, '  ', '    ', 0x243279243130244133776f4775322f477165426c526c3243557a696365736b59744e546d34694f56575a7451563575374261774a6f51494574427a71, 0, 4),
(28, '    .', '           .', 0x243279243130246a3855745a6e7149566637413332637654307a7034653976397a4d42306467746f477171567479756d6578773266494f6531523543, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`articleId`),
  ADD KEY `fk_userArticle` (`userId`),
  ADD KEY `fk_articletheme` (`themeId`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `FK_User` (`userId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `commands`
--
ALTER TABLE `commands`
  ADD PRIMARY KEY (`commandId`),
  ADD KEY `fk_command_cart` (`cartId`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `fk_comments` (`articleId`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`plantId`),
  ADD KEY `FK_Category` (`categoryId`);

--
-- Indexes for table `plants_carts`
--
ALTER TABLE `plants_carts`
  ADD PRIMARY KEY (`plants_cartsId`),
  ADD KEY `fk_cart` (`cartId`),
  ADD KEY `fk_plant` (`plantId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tagId`);

--
-- Indexes for table `tags_themes`
--
ALTER TABLE `tags_themes`
  ADD PRIMARY KEY (`tags_themesId`),
  ADD KEY `fk_theme` (`themeId`),
  ADD KEY `fk_tag` (`tagId`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`themeId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `FK_Role` (`roleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `articleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `commands`
--
ALTER TABLE `commands`
  MODIFY `commandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `plantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `plants_carts`
--
ALTER TABLE `plants_carts`
  MODIFY `plants_cartsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tagId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tags_themes`
--
ALTER TABLE `tags_themes`
  MODIFY `tags_themesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `themeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_articletheme` FOREIGN KEY (`themeId`) REFERENCES `themes` (`themeId`),
  ADD CONSTRAINT `fk_userArticle` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `FK_User` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `commands`
--
ALTER TABLE `commands`
  ADD CONSTRAINT `fk_command_cart` FOREIGN KEY (`cartId`) REFERENCES `carts` (`cartId`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments` FOREIGN KEY (`articleId`) REFERENCES `articles` (`articleId`);

--
-- Constraints for table `plants`
--
ALTER TABLE `plants`
  ADD CONSTRAINT `FK_Category` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`);

--
-- Constraints for table `plants_carts`
--
ALTER TABLE `plants_carts`
  ADD CONSTRAINT `fk_cart` FOREIGN KEY (`cartId`) REFERENCES `carts` (`cartId`),
  ADD CONSTRAINT `fk_plant` FOREIGN KEY (`plantId`) REFERENCES `plants` (`plantId`);

--
-- Constraints for table `tags_themes`
--
ALTER TABLE `tags_themes`
  ADD CONSTRAINT `fk_tag` FOREIGN KEY (`tagId`) REFERENCES `tags` (`tagId`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_theme` FOREIGN KEY (`themeId`) REFERENCES `themes` (`themeId`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_Role` FOREIGN KEY (`roleId`) REFERENCES `roles` (`roleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
