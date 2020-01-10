-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 21, 2019 at 05:22 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `basera`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_master`
--

CREATE TABLE `admin_master` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(25) NOT NULL,
  `admin_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_master`
--

INSERT INTO `admin_master` (`admin_id`, `admin_email`, `admin_password`) VALUES
(1, 'ms@ms.com', 'ms@123'),
(2, 'test@test.com', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `aminities_master`
--

CREATE TABLE `aminities_master` (
  `AminitiesId` int(11) NOT NULL,
  `AminitiesName` varchar(250) NOT NULL,
  `ExtraAminities` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aminities_master`
--

INSERT INTO `aminities_master` (`AminitiesId`, `AminitiesName`, `ExtraAminities`) VALUES
(1, 'Wifi', 1),
(2, 'Swimming pool', 1),
(3, 'Laptop Friendly Enviornment', 1);

-- --------------------------------------------------------

--
-- Table structure for table `area_master`
--

CREATE TABLE `area_master` (
  `AreaId` int(11) NOT NULL,
  `AreaName` varchar(200) NOT NULL,
  `CityId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area_master`
--

INSERT INTO `area_master` (`AreaId`, `AreaName`, `CityId`) VALUES
(1, 'Ellisbridge', 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking_master`
--

CREATE TABLE `booking_master` (
  `BookingId` int(11) NOT NULL,
  `CustId` int(11) NOT NULL,
  `HouseId` int(11) NOT NULL,
  `CheckInDate` date NOT NULL,
  `CheckOutDate` date NOT NULL,
  `ConfirmationStatus` int(1) NOT NULL DEFAULT 0,
  `AdvancePayment` int(5) NOT NULL,
  `DuePayment` int(5) NOT NULL,
  `SystemDateTime` datetime DEFAULT current_timestamp(),
  `TranactionId` varchar(255) NOT NULL,
  `TotalNoOfGuest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_master`
--

INSERT INTO `booking_master` (`BookingId`, `CustId`, `HouseId`, `CheckInDate`, `CheckOutDate`, `ConfirmationStatus`, `AdvancePayment`, `DuePayment`, `SystemDateTime`, `TranactionId`, `TotalNoOfGuest`) VALUES
(1, 1, 1, '2019-09-28', '2019-09-29', 0, 1550, 1550, '2019-09-28 15:49:32', 'pay_DNaErraIkEqnMT', 3),
(2, 1, 1, '2019-09-30', '2019-10-01', 0, 1300, 1300, '2019-09-28 19:36:42', 'pay_DNe6mUrm5pXIsX', 2);

-- --------------------------------------------------------

--
-- Table structure for table `city_master`
--

CREATE TABLE `city_master` (
  `CityId` int(11) NOT NULL,
  `CityName` varchar(200) NOT NULL,
  `StateId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city_master`
--

INSERT INTO `city_master` (`CityId`, `CityName`, `StateId`) VALUES
(1, 'Ahmedabad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_master`
--

CREATE TABLE `customer_master` (
  `CustId` int(11) NOT NULL,
  `CustFirstName` varchar(150) NOT NULL,
  `CustLastName` varchar(150) NOT NULL,
  `CustEmail` varchar(150) NOT NULL,
  `CustPassword` text NOT NULL,
  `CustNumber` bigint(10) NOT NULL,
  `CustKYC` text DEFAULT NULL,
  `KYC_Status` int(1) NOT NULL,
  `CustomerRegistrationDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_master`
--

INSERT INTO `customer_master` (`CustId`, `CustFirstName`, `CustLastName`, `CustEmail`, `CustPassword`, `CustNumber`, `CustKYC`, `KYC_Status`, `CustomerRegistrationDate`) VALUES
(1, 'Vaibhav', 'Shah', 'vaibhav.sanskar@gmail.com', 'f82ae5c11f43ff4e3dc7f1e7462fc459da2d2a98', 9537385306, NULL, 0, '2019-09-28 15:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `damage_master`
--

CREATE TABLE `damage_master` (
  `DamageId` int(11) NOT NULL,
  `BookingId` int(11) NOT NULL,
  `ItemName` varchar(200) NOT NULL,
  `ItemDescription` text DEFAULT NULL,
  `Image` varchar(200) NOT NULL,
  `Price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `houseaminities_tranasction`
--

CREATE TABLE `houseaminities_tranasction` (
  `HAId` int(11) NOT NULL,
  `HouseId` int(11) NOT NULL,
  `AminitiesId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `houseaminities_tranasction`
--

INSERT INTO `houseaminities_tranasction` (`HAId`, `HouseId`, `AminitiesId`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `houseimage_master`
--

CREATE TABLE `houseimage_master` (
  `HIId` int(11) NOT NULL,
  `HouseId` int(11) NOT NULL,
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `houseimage_master`
--

INSERT INTO `houseimage_master` (`HIId`, `HouseId`, `Image`) VALUES
(1, 1, 'EnchantingAbode1190920190712291630.jpg'),
(2, 1, 'EnchantingAbode2190920190712292191.jpg'),
(3, 1, 'EnchantingAbode4210920191744072730.jpg'),
(4, 1, 'EnchantingAbode4190920190714061391.jpg'),
(5, 1, 'EnchantingAbode5190920190714062102.jpg'),
(6, 1, 'EnchantingAbode6190920190738282770.png');

-- --------------------------------------------------------

--
-- Table structure for table `house_master`
--

CREATE TABLE `house_master` (
  `HouseId` int(11) NOT NULL,
  `OwnerId` int(11) NOT NULL,
  `HouseName` varchar(250) NOT NULL,
  `HouseAddressLine1` text NOT NULL,
  `HouseAddressLine2` text NOT NULL,
  `HouseAddressLine3` text NOT NULL,
  `NoofAllowedGuest` int(3) NOT NULL,
  `NoofBedrooms` int(3) NOT NULL,
  `NoofBathrooms` int(3) NOT NULL,
  `AreaId` int(11) NOT NULL,
  `HouseDescription1` text NOT NULL,
  `HouseDescription2` text DEFAULT NULL,
  `HousePricePerPerson` int(5) NOT NULL,
  `HouseBasePrice` int(5) NOT NULL,
  `IsCancellable` int(1) NOT NULL,
  `CustomRules1` text DEFAULT NULL,
  `CustomRules2` text DEFAULT NULL,
  `IsHouseVerified` int(1) NOT NULL DEFAULT 0,
  `CheckIn` time NOT NULL,
  `CheckOut` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `house_master`
--

INSERT INTO `house_master` (`HouseId`, `OwnerId`, `HouseName`, `HouseAddressLine1`, `HouseAddressLine2`, `HouseAddressLine3`, `NoofAllowedGuest`, `NoofBedrooms`, `NoofBathrooms`, `AreaId`, `HouseDescription1`, `HouseDescription2`, `HousePricePerPerson`, `HouseBasePrice`, `IsCancellable`, `CustomRules1`, `CustomRules2`, `IsHouseVerified`, `CheckIn`, `CheckOut`) VALUES
(1, 1, 'Enchanting Abode', 'Near Benaulim Beach', 'NULL', 'NULL', 4, 2, 1, 1, '93% of recent guests gave the location a 5-star rating.\r\nThis property is managed by a professional hospitality company.\r\n\r\nA mesmerizing Indo-Portuguese studio villa, part of a well-guarded posh gated community.\r\nIt takes you back to a quieter, simpler time with its 5 mins canopied private walk-way to the gorgeous Benaulim beach, green vistas and multiple shaded reading nooks that steal your heart.\r\nHello', NULL, 500, 1600, 1, 'There is only one double bed at the property. However, we do have a double size floor mattress available free of cost.\r\nIn case you have 1 more person in the group and need an extra mattress, it can be provided for Rs. 500 per night.', 'There is enough parking space for two cars right in front of the villa.\r\n\r\nThe reception, right next to the entrance gate is a gorgeous space housing a great collection of books, some eccentric keychains and cutesy knick-knacks surely to re-awaken the inter', 0, '10:30:00', '12:00:00'),
(2, 2, 'Family Friendly Home 3', 'Near Subhash Bridge Circle, Subhash Bridge', '', '', 3, 1, 2, 1, 'Our home is located in posh area of Ahmedabad with easy access to restaurants/bus/rickshaws.\r\nOur room has attached bathroom with geyser. The lavatory is just outside the room. It has AC and extra amount of Rs. 160 per day in cash will be charged for AC.\r\nOur house is Near TV tower, Near Surdhara Circle, Sun-N-step Club Road, Thaltej@ 1.5 Km from Sterling Hospital and 1 Km from Sal Hospital and 1.5 Km from SG Highway.\r\n', 'Our house is Near TV tower, Near Surdhara Circle, Sun-N-step Club Road, Thaltej@ 1.5 Km from Sterling Hospital and 1 Km from Sal Hospital and 1.5 Km from SG Highway.\r\nOur house is a 2 storey bungalow located on 100 feet road in a posh locality of Drive inn Cinema.\r\nAll amenities like City Bus Service, Grocery store, Shopping Mall, Restaurants etc. are available nearby.', 210, 500, 0, 'Guest can access garden, veranda and balcony and parking space inside house and outside house.', 'We can provide homemade Breakfast / Tea / Coffee as per your wish at a reasonable extra cost.\r\n\r\nAll bedrooms are with AC and extra amount of Rs. 160 per day will be charged for AC.', 0, '11:00:00', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `near_by_places`
--

CREATE TABLE `near_by_places` (
  `NearPlaceId` int(11) NOT NULL,
  `NearPlaceName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `near_by_places`
--

INSERT INTO `near_by_places` (`NearPlaceId`, `NearPlaceName`) VALUES
(1, 'Kalupur'),
(2, 'gita mandir');

-- --------------------------------------------------------

--
-- Table structure for table `near_by_places_transaction`
--

CREATE TABLE `near_by_places_transaction` (
  `NTId` int(11) NOT NULL,
  `HouseId` int(11) NOT NULL,
  `NearPlaceId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `OrderId` int(11) NOT NULL,
  `BookingId` int(11) NOT NULL,
  `IsDamage` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `owner_master`
--

CREATE TABLE `owner_master` (
  `OwnerId` int(11) NOT NULL,
  `OwnerFirstName` varchar(150) NOT NULL,
  `OwnerLastName` varchar(150) NOT NULL,
  `OwnerEmail` varchar(150) NOT NULL,
  `OwnerPassword` text NOT NULL,
  `OwnerNumber` bigint(10) NOT NULL,
  `OwnerKYC` text NOT NULL,
  `OwnerRegistrationDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owner_master`
--

INSERT INTO `owner_master` (`OwnerId`, `OwnerFirstName`, `OwnerLastName`, `OwnerEmail`, `OwnerPassword`, `OwnerNumber`, `OwnerKYC`, `OwnerRegistrationDate`) VALUES
(1, 'Maitri', 'Shah', 'maitrijshah3@gmail.com', '8e0a74d68eeb0ff72248d7376fa129d8f57da101', 7043347686, 'about-320092019073336297.png', '2019-09-19 10:29:23'),
(2, 'vaibhav', 'shah', 'vaibhav.sanskar@gmail.com', 'f82ae5c11f43ff4e3dc7f1e7462fc459da2d2a98', 7894561230, 'Pan_card_0.jpeg', '2019-09-28 15:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `state_master`
--

CREATE TABLE `state_master` (
  `StateId` int(11) NOT NULL,
  `StateName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state_master`
--

INSERT INTO `state_master` (`StateId`, `StateName`) VALUES
(1, 'Gujarat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_master`
--
ALTER TABLE `admin_master`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `aminities_master`
--
ALTER TABLE `aminities_master`
  ADD PRIMARY KEY (`AminitiesId`),
  ADD UNIQUE KEY `AminitiesName` (`AminitiesName`);

--
-- Indexes for table `area_master`
--
ALTER TABLE `area_master`
  ADD PRIMARY KEY (`AreaId`),
  ADD KEY `CityId` (`CityId`);

--
-- Indexes for table `booking_master`
--
ALTER TABLE `booking_master`
  ADD PRIMARY KEY (`BookingId`),
  ADD KEY `CustId` (`CustId`),
  ADD KEY `HouseId` (`HouseId`);

--
-- Indexes for table `city_master`
--
ALTER TABLE `city_master`
  ADD PRIMARY KEY (`CityId`),
  ADD KEY `StateId` (`StateId`);

--
-- Indexes for table `customer_master`
--
ALTER TABLE `customer_master`
  ADD PRIMARY KEY (`CustId`),
  ADD UNIQUE KEY `CustEmail` (`CustEmail`),
  ADD UNIQUE KEY `CustNumber` (`CustNumber`);

--
-- Indexes for table `damage_master`
--
ALTER TABLE `damage_master`
  ADD PRIMARY KEY (`DamageId`),
  ADD KEY `BookingId` (`BookingId`);

--
-- Indexes for table `houseaminities_tranasction`
--
ALTER TABLE `houseaminities_tranasction`
  ADD PRIMARY KEY (`HAId`),
  ADD KEY `HouseId` (`HouseId`),
  ADD KEY `AminitiesId` (`AminitiesId`);

--
-- Indexes for table `houseimage_master`
--
ALTER TABLE `houseimage_master`
  ADD PRIMARY KEY (`HIId`),
  ADD KEY `HouseId` (`HouseId`);

--
-- Indexes for table `house_master`
--
ALTER TABLE `house_master`
  ADD PRIMARY KEY (`HouseId`),
  ADD KEY `AreaId` (`AreaId`),
  ADD KEY `OwnerId` (`OwnerId`);

--
-- Indexes for table `near_by_places`
--
ALTER TABLE `near_by_places`
  ADD PRIMARY KEY (`NearPlaceId`);

--
-- Indexes for table `near_by_places_transaction`
--
ALTER TABLE `near_by_places_transaction`
  ADD PRIMARY KEY (`NTId`),
  ADD KEY `HouseId` (`HouseId`),
  ADD KEY `NearPlaceId` (`NearPlaceId`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`OrderId`),
  ADD KEY `BookingId` (`BookingId`);

--
-- Indexes for table `owner_master`
--
ALTER TABLE `owner_master`
  ADD PRIMARY KEY (`OwnerId`),
  ADD UNIQUE KEY `OwnerEmail` (`OwnerEmail`),
  ADD UNIQUE KEY `OwnerNumber` (`OwnerNumber`);

--
-- Indexes for table `state_master`
--
ALTER TABLE `state_master`
  ADD PRIMARY KEY (`StateId`),
  ADD UNIQUE KEY `StateName` (`StateName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_master`
--
ALTER TABLE `admin_master`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `aminities_master`
--
ALTER TABLE `aminities_master`
  MODIFY `AminitiesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `area_master`
--
ALTER TABLE `area_master`
  MODIFY `AreaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_master`
--
ALTER TABLE `booking_master`
  MODIFY `BookingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `city_master`
--
ALTER TABLE `city_master`
  MODIFY `CityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_master`
--
ALTER TABLE `customer_master`
  MODIFY `CustId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `damage_master`
--
ALTER TABLE `damage_master`
  MODIFY `DamageId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `houseaminities_tranasction`
--
ALTER TABLE `houseaminities_tranasction`
  MODIFY `HAId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `houseimage_master`
--
ALTER TABLE `houseimage_master`
  MODIFY `HIId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `house_master`
--
ALTER TABLE `house_master`
  MODIFY `HouseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `near_by_places`
--
ALTER TABLE `near_by_places`
  MODIFY `NearPlaceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `near_by_places_transaction`
--
ALTER TABLE `near_by_places_transaction`
  MODIFY `NTId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owner_master`
--
ALTER TABLE `owner_master`
  MODIFY `OwnerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `state_master`
--
ALTER TABLE `state_master`
  MODIFY `StateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `area_master`
--
ALTER TABLE `area_master`
  ADD CONSTRAINT `area_master_ibfk_1` FOREIGN KEY (`CityId`) REFERENCES `city_master` (`CityId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booking_master`
--
ALTER TABLE `booking_master`
  ADD CONSTRAINT `booking_master_ibfk_2` FOREIGN KEY (`CustId`) REFERENCES `customer_master` (`CustId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_master_ibfk_3` FOREIGN KEY (`HouseId`) REFERENCES `house_master` (`HouseId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `city_master`
--
ALTER TABLE `city_master`
  ADD CONSTRAINT `city_master_ibfk_1` FOREIGN KEY (`StateId`) REFERENCES `state_master` (`StateId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `damage_master`
--
ALTER TABLE `damage_master`
  ADD CONSTRAINT `damage_master_ibfk_1` FOREIGN KEY (`BookingId`) REFERENCES `booking_master` (`BookingId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `houseaminities_tranasction`
--
ALTER TABLE `houseaminities_tranasction`
  ADD CONSTRAINT `houseaminities_tranasction_ibfk_1` FOREIGN KEY (`HouseId`) REFERENCES `house_master` (`HouseId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `houseaminities_tranasction_ibfk_2` FOREIGN KEY (`AminitiesId`) REFERENCES `aminities_master` (`AminitiesId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `houseimage_master`
--
ALTER TABLE `houseimage_master`
  ADD CONSTRAINT `houseimage_master_ibfk_1` FOREIGN KEY (`HouseId`) REFERENCES `house_master` (`HouseId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `house_master`
--
ALTER TABLE `house_master`
  ADD CONSTRAINT `house_master_ibfk_1` FOREIGN KEY (`AreaId`) REFERENCES `area_master` (`AreaId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `house_master_ibfk_2` FOREIGN KEY (`OwnerId`) REFERENCES `owner_master` (`OwnerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `near_by_places_transaction`
--
ALTER TABLE `near_by_places_transaction`
  ADD CONSTRAINT `near_by_places_transaction_ibfk_1` FOREIGN KEY (`HouseId`) REFERENCES `house_master` (`HouseId`),
  ADD CONSTRAINT `near_by_places_transaction_ibfk_2` FOREIGN KEY (`NearPlaceId`) REFERENCES `near_by_places` (`NearPlaceId`);

--
-- Constraints for table `order_master`
--
ALTER TABLE `order_master`
  ADD CONSTRAINT `order_master_ibfk_1` FOREIGN KEY (`BookingId`) REFERENCES `booking_master` (`BookingId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
