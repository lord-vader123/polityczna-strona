-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2024 at 05:32 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `politicians`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `committee`
--

CREATE TABLE `committee` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `committee_membership`
--

CREATE TABLE `committee_membership` (
  `id` int(11) NOT NULL,
  `comitette_id` int(11) DEFAULT NULL,
  `joining_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `party`
--

CREATE TABLE `party` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `short_name` varchar(5) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `party_affiliation`
--

CREATE TABLE `party_affiliation` (
  `id` int(11) NOT NULL,
  `party_id` int(11) DEFAULT NULL,
  `joining_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `politicians`
--

CREATE TABLE `politicians` (
  `id` int(11) NOT NULL,
  `politician_name` varchar(20) DEFAULT NULL,
  `politician_surname` varchar(30) DEFAULT NULL,
  `party_affiliation` int(11) DEFAULT NULL,
  `committee_membership` int(11) DEFAULT NULL,
  `is_representative` tinyint(1) DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `portrait` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `login` varchar(40) DEFAULT NULL,
  `passphrase` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `committee`
--
ALTER TABLE `committee`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `committee_membership`
--
ALTER TABLE `committee_membership`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comitette_id` (`comitette_id`);

--
-- Indeksy dla tabeli `party`
--
ALTER TABLE `party`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `party_affiliation`
--
ALTER TABLE `party_affiliation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `party_id` (`party_id`);

--
-- Indeksy dla tabeli `politicians`
--
ALTER TABLE `politicians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `party_affiliation` (`party_affiliation`),
  ADD KEY `committee_membership` (`committee_membership`),
  ADD KEY `creator` (`creator`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `committee`
--
ALTER TABLE `committee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `committee_membership`
--
ALTER TABLE `committee_membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `party`
--
ALTER TABLE `party`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `party_affiliation`
--
ALTER TABLE `party_affiliation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `politicians`
--
ALTER TABLE `politicians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `committee_membership`
--
ALTER TABLE `committee_membership`
  ADD CONSTRAINT `committee_membership_ibfk_1` FOREIGN KEY (`comitette_id`) REFERENCES `committee` (`id`);

--
-- Constraints for table `party_affiliation`
--
ALTER TABLE `party_affiliation`
  ADD CONSTRAINT `party_affiliation_ibfk_1` FOREIGN KEY (`party_id`) REFERENCES `party` (`id`);

--
-- Constraints for table `politicians`
--
ALTER TABLE `politicians`
  ADD CONSTRAINT `politicians_ibfk_1` FOREIGN KEY (`party_affiliation`) REFERENCES `party_affiliation` (`id`),
  ADD CONSTRAINT `politicians_ibfk_2` FOREIGN KEY (`committee_membership`) REFERENCES `committee_membership` (`id`),
  ADD CONSTRAINT `politicians_ibfk_3` FOREIGN KEY (`creator`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

