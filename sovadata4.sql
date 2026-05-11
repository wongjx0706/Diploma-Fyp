SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
--
-- Create customer table
--
CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_contactnum` varchar(100) NOT NULL,
  `customer_password` varchar(100) NOT NULL,
  `customer_secret` varchar(100) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `customer`
--
INSERT INTO `customer` VALUES
(1, 'Jing Xiang', 'user@gmail.com', '0129012479', 'user', 'Wong'),
(2, 'Yong Qi', 'Huser@gmail.com', '01233334444', 'Huser', 'Chen'),
(3, 'Ze Xiang', 'Muser@gmail.com', '01988887777','Muser', 'Wong');

-- Create room table
CREATE TABLE `room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_name` varchar(100) NOT NULL,
  `room_description` varchar(1000) NOT NULL,
  `room_price` decimal(10,2) NOT NULL,
  `room_image` varchar(100) NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `room`
--
INSERT INTO `room` VALUES
(1, 'Standard Single', '- Capacity 1-2 Persons Bed Type \r\n- Super Single Room with Television \r\n- Small Dining Table \r\n- Wi-fi Services Room with Air-Conditioning \r\n- Without Breakfast \r\n- All rooms are non-smoking', '90.00', 'uploads/Standard_Single.jpg'),
(2, 'Standard Queen Room', '- Capacity | 2-3 Persons\r\n- Bed Type | Queen Size\r\n- Room with Television\r\n- Room with 2-seaters Sofa\r\n- Small Dining Area\r\n- Wi-fi Services\r\n- Room with Air-Conditioning\r\n- Without Breakfast\r\n- All rooms are non-smoking', '110.00', 'uploads/Standard_Queen_Room.jpg'),
(3, 'Standard King Room', '- Capacity | 2-3 Persons\r\n- Bed Type | King Size\r\n- Room with Television\r\n- Room with 3-seater Sofa\r\n- Small Dining Table\r\n- Wi-fi Services\r\n- Room with Air-Conditioning\r\n- Without Breakfast\r\n- All rooms are non-smoking', '120.00', 'uploads/Standard_King_Room.jpg'),
(4, 'Deluxe Single Room', '- Capacity | 1-2 Persons\r\n- Bed Type | Queen Size\r\n- Room with Television\r\n- Room with 1-seater Sofa\r\n- Small Dining Area\r\n- Wi-fi Services\r\n- Room with Air-Conditioning\r\n- Including Breakfast\r\n- All rooms are non-smoking', '135.00', 'uploads/Deluxe_Single_Room.jpg'),
(5, 'Deluxe Queen Room', '- Capacity | 3-4 Persons\r\n- Bed Type | Double-Queen Size\r\n- Room with two 2-seaters Sofa\r\n- Room with Television\r\n- Medium Dining Area\r\n- Wi-fi Services\r\n- Room with Air-Conditioning\r\n- Including Breakfast\r\n- All rooms are non-smoking', '160.00', 'uploads/Deluxe_Double_Queen_Room.jpg'),
(6, 'Deluxe King Room', '- Capacity | 5-6 Persons\r\n- Bed Type | Double-King Size\r\n- Room with Two 3-seater Sofa\r\n- Room with Television\r\n- Large Dining Area\r\n- Wi-fi Services\r\n- Room with Air-Conditioning\r\n- Including Breakfast\r\n- Small Study Area\r\n- All rooms are non-smoking', '230.00', 'uploads/Deluxe_Double_King_Room.jpg');

-- Create reservation table
CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `reservation_date` date NOT NULL,
  `reservation_date_in` date NOT NULL,
  `reservation_date_out` date NOT NULL,
  `total_payment` varchar(100) NOT NULL,
  `reservation_status` varchar(100) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `account_number` varchar(30) NOT NULL,
  PRIMARY KEY (`reservation_id`),
  KEY `fk_customer` (`customer_id`),
  KEY `fk_room` (`room_id`),
  CONSTRAINT `fk_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `reservation` VALUES
(2, 1, 1, '2024-06-28', '2024-06-29', '2024-06-30', '90','Approved', 'DuitNow', '123456789'),
(3, 1, 2, '2024-06-30', '2024-07-01', '2024-07-03', '220','Approved', 'Online Transfer', '665533214'),
(4, 1, 5, '2024-06-29', '2024-06-30', '2024-07-01', '160','Cancel by the Hotel', 'DuitNow', '99887788'),
(5, 1, 6, '2024-06-30', '2024-07-01', '2024-07-02', '90','On Hold', 'DuitNow', '2020121230');

-- Create review table
CREATE TABLE `review` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `review_time` datetime NOT NULL,
  `review_description` varchar(500) NOT NULL,
  PRIMARY KEY (`review_id`),
  KEY `fk_review_customer` (`customer_id`),
  KEY `fk_review_reservation` (`reservation_id`),
  CONSTRAINT `fk_review_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_review_reservation` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `review` VALUES
(20, 1, 2, '2024-06-01 03:11:22', 'Neat and Clean Room, Service with right manner'),
(21, 1, 3, '2024-06-04 13:35:52', 'Nice Room to Stay Cation. Heal my mood and motivate me to back to my life');

-- Create staff table
CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_name` varchar(100) NOT NULL,
  `staff_email` varchar(100) NOT NULL,
  `staff_contactnum` varchar(100) NOT NULL,
  `staff_password` varchar(100) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `staff` VALUES
(1, 'Jing Xiang', 'staff@gmail.com', '01123358924', 'staff'),
(2, 'Yong Qi', 'Hstaff@gmail.com', '0123456789', 'Hstaff');

COMMIT;
