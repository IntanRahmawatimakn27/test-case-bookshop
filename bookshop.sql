-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2024 at 03:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `level` enum('admin','user,',',') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama`, `level`) VALUES
(2, 'admin', 'adminrhm123\r\n', 'rahma', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publication_date` date NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `pages` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `publication_date`, `publisher`, `pages`, `category_id`, `image`) VALUES
(1, 'Laskar Pelangi', 'Andrea Hirata', '2024-08-01', 'Bentang Pustaka', 300, 6, 'book10.jpg'),
(22, 'The Great Gatsby', 'F. Scott Fitzgerald', '1925-04-10', 'Charles Scribner\'s Sons', 218, 20, 'book8.jpg'),
(23, '1984', 'George Orwell', '1949-06-08', 'Secker & Warburg', 328, 7, '1984.jpg'),
(24, 'To Kill a Mockingbird', 'Harper Lee', '1960-07-11', 'J.B. Lippincott & Co.', 281, 7, 'to kill.jpg'),
(25, 'Pride and Prejudice', 'Jane Austen', '1813-01-28', 'T. Egerton', 279, 20, 'pride.jpg'),
(26, 'The Catcher in the Rye', 'J.D. Salinger', '1951-07-16', 'Little, Brown and Company', 277, 5, 'the catcher.jpg'),
(27, 'The Hobbit', 'J.R.R. Tolkien', '1937-09-21', 'George Allen & Unwin', 310, 6, 'hobbit.jpg'),
(28, 'Fahrenheit 451', 'Ray Bradbury', '1953-10-19', 'Ballantine Books', 249, 5, '451.jpg'),
(29, 'Moby-Dick', 'Herman Melville', '1851-11-14', 'Harper & Brothers', 585, 5, 'moby dick.jpg'),
(30, 'War and Peace', 'Leo Tolstoy', '1869-01-01', 'The Russian Messenger', 1225, 8, 'war andpeace.jpg'),
(31, 'Great Expectations', 'Charles Dickens', '1861-08-01', 'Chapman & Hall', 505, 6, 'book7.jpg'),
(32, 'The Odyssey', 'Homer', '2013-10-15', 'Ancient Greece', 541, 7, 'odyssey.jpg'),
(33, 'Crime and Punishment', 'Fyodor Dostoevsky', '1866-01-01', 'The Russian Messenger', 430, 5, 'crime.jpg'),
(34, 'Alice\'s Adventures in Wonderland', 'Lewis Carroll', '1865-11-26', 'Macmillan Publishers', 200, 10, 'alices.jpg'),
(35, 'Brave New World', 'Aldous Huxley', '1932-01-01', 'Chatto & Windus', 311, 7, 'brave.jpg'),
(36, 'Wuthering Heights', 'Emily Brontë', '1847-12-01', 'Thomas Cautley Newby', 416, 6, 'wuthering.jpg'),
(37, 'Jane Eyre', 'Charlotte Brontë', '1847-10-16', 'Smith, Elder & Co.', 500, 7, 'book9.jpg'),
(38, 'The Divine Comedy', 'Dante Alighieri', '1320-01-01', 'John Murray', 798, 7, 'the divine.jpg'),
(39, 'Don Quixote', 'Miguel de Cervantes', '1605-01-16', 'Francisco de Robles', 1072, 6, 'don.jpg'),
(40, 'One Hundred Years of Solitude', 'Gabriel Garcia Marquez', '1967-05-30', 'Harper & Row', 417, 20, 'one hundred.jpg'),
(41, 'The Brothers Karamazov', 'Fyodor Dostoevsky', '1880-01-01', 'The Russian Messenger', 824, 5, 'the brothers.jpg'),
(63, 'Harry Potter', 'JK.Rowling', '2024-08-16', 'Gramedia', 342, 6, 'harry potter.jpg'),
(64, 'Hujan', 'Tere Liye', '2024-08-04', 'Gramedia', 343, 6, 'Hujan.jpg'),
(68, 'Jendral & Jevano', 'Amanda Audria', '2024-08-04', 'Gramedia', 322, 15, '../uploads/jendral_jevano.jpg'),
(69, 'Querida', 'GabyXWSSO', '2024-08-22', 'Gramedia', 421, 15, '../uploads/querida.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(5, 'Science Fiction (Fiksi Ilmiah)'),
(6, ' Fantasy'),
(7, 'Thriller / Suspense / Mystery'),
(8, ' Historical'),
(10, 'Realistic Fiction'),
(15, 'Romance'),
(20, 'Fanfiction'),
(22, 'Horor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
