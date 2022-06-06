-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2022 at 11:57 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cocktails`
--

-- --------------------------------------------------------

--
-- Table structure for table `cocktails`
--

CREATE TABLE `cocktails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) DEFAULT '',
  `name` varchar(255) DEFAULT '',
  `desc` varchar(500) DEFAULT '',
  `api_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cocktails`
--

INSERT INTO `cocktails` (`id`, `image_path`, `name`, `desc`, `api_id`) VALUES
(52, 'https://www.thecocktaildb.com/images/media/drink/x03td31521761009.jpg', 'Old Pal', 'Chill cocktail glass. Add ingredients to a mixing glass, and fill 2/3 full with ice. Stir about 20 seconds. Empty cocktail glass and strain into the glass. Garnish with a twist of lemon peel.', 17827),
(53, 'https://www.thecocktaildb.com/images/media/drink/qrot6j1504369425.jpg', 'Golden dream', 'Shake with cracked ice. Strain into glass and serve.', 17199),
(54, 'https://www.thecocktaildb.com/images/media/drink/vrwquq1478252802.jpg', 'Old Fashioned', 'Place sugar cube in old fashioned glass and saturate with bitters, add a dash of plain water. Muddle until dissolved.\r\nFill the glass with ice cubes and add whiskey.\r\n\r\nGarnish with orange twist, and a cocktail cherry.', 11001),
(55, 'https://www.thecocktaildb.com/images/media/drink/otn2011504820649.jpg', 'Rum Old-fashioned', 'Stir powdered sugar, water, and bitters in an old-fashioned glass. When sugar has dissolved add ice cubes and light rum. Add the twist of lime peel, float 151 proof rum on top, and serve.', 12089),
(56, 'https://www.thecocktaildb.com/images/media/drink/w8cxqv1582485254.jpg', 'Classic Old-Fashioned', 'In an old-fashioned glass, muddle the bitters and water into the sugar cube, using the back of a teaspoon. Almost fill the glass with ice cubes and add the bourbon. Garnish with the orange slice and the cherry. Serve with a swizzle stick.', 11145),
(57, 'https://www.thecocktaildb.com/images/media/drink/7j1z2e1487603414.jpg', 'Kill the cold Smoothie', 'Juice ginger and lemon and add it to hot water. You may add cardomom.', 12720),
(58, 'https://www.thecocktaildb.com/images/media/drink/vyrvxt1461919380.jpg', 'A Night In Old Mandalay', 'In a shaker half-filled with ice cubes, combine the light rum, añejo rum, orange juice, and lemon juice. Shake well. Strain into a highball glass almost filled with ice cubes. Top with the ginger ale. Garnish with the lemon twist.', 17832),
(59, 'https://www.thecocktaildb.com/images/media/drink/metwgh1606770327.jpg', 'Mojito', 'Muddle mint leaves with sugar and lime juice. Add a splash of soda water and fill the glass with cracked ice. Pour the rum and top with soda water. Garnish and serve with straw.', 11000),
(60, 'https://www.thecocktaildb.com/images/media/drink/vwxrsw1478251483.jpg', 'Mojito Extra', 'Put mint with lemon juice in a glas, mash the mint with a spoon, ice, rum & fill up with club soda. Top it with Angostura.', 15841),
(61, 'https://www.thecocktaildb.com/images/media/drink/wfqmgm1630406820.jpg', 'Mango Mojito', 'Squeeze the juice from 1½ limes and blend with the mango to give a smooth purée.\r\nCut the rest of the limes into quarters, and then cut each wedge in half again. Put 2 pieces of lime in a highball glass for each person and add 1 teaspoon of caster sugar and 5-6 mint leaves to each glass. Squish everything together with a muddler or the end of a rolling pin to release all the flavours from the lime and mint.\r\nDivide the mango purée between the glasses and add 30ml white rum and a handful of crush', 178358),
(62, 'https://www.thecocktaildb.com/images/media/drink/07iep51598719977.jpg', 'Blueberry Mojito', 'Muddle the blueberries with the other ingredients and serve in a highball glass. Garnish with mint and a half slice of lime.', 178336);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cocktails`
--
ALTER TABLE `cocktails`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cocktails`
--
ALTER TABLE `cocktails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
