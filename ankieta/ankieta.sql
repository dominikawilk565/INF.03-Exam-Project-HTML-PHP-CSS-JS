-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 17, 2025 at 12:12 AM
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
-- Database: `ankieta`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `odpowiedzi`
--

CREATE TABLE `odpowiedzi` (
  `id` int(11) NOT NULL,
  `id_wypelniajacego` int(11) NOT NULL,
  `jezyki` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`jezyki`)),
  `front_or_back` enum('front-end','back-end') DEFAULT NULL,
  `nauczyciel` varchar(50) DEFAULT NULL,
  `ocena` tinyint(3) UNSIGNED DEFAULT NULL,
  `ciekawostka` text DEFAULT NULL,
  `jezyk_prow` varchar(50) DEFAULT NULL,
  `trudnosc` enum('Tak','Nie') DEFAULT NULL,
  `tempo` enum('dostosowywany','nie-zawsze','niedostosowywany') DEFAULT NULL,
  `materialy` tinyint(3) UNSIGNED DEFAULT NULL,
  `czestosc` enum('Czesto','Rzadko','prawie-nigdy','Nigdy','sprawdzian') DEFAULT NULL,
  `pytania` enum('Tak','Nie') DEFAULT NULL,
  `pytania_wyczerp` enum('Tak','Nie') DEFAULT NULL,
  `zadania` enum('Tak','Nie') DEFAULT NULL,
  `urzycie` enum('Tak','Nie','Nie wiem') DEFAULT NULL,
  `czestosc_urzycia` enum('Often','Rarely','occasionally','Never','use') DEFAULT NULL,
  `zmiana` text DEFAULT NULL
) ;

--
-- Dumping data for table `odpowiedzi`
--

INSERT INTO `odpowiedzi` (`id`, `id_wypelniajacego`, `jezyki`, `front_or_back`, `nauczyciel`, `ocena`, `ciekawostka`, `jezyk_prow`, `trudnosc`, `tempo`, `materialy`, `czestosc`, `pytania`, `pytania_wyczerp`, `zadania`, `urzycie`, `czestosc_urzycia`, `zmiana`) VALUES
(5, 20, '[\"HTML\",\"CSS\",\"rodzina_c\"]', 'front-end', 'Królikowski', 4, 'nie', 'zrozumiałego', 'Tak', 'nie-zawsze', 2, 'Nigdy', 'Tak', 'Nie', 'Tak', 'Tak', 'Rarely', '--');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id_wypelniajacego` int(11) NOT NULL,
  `plec` enum('k','m','inne') NOT NULL,
  `zaawansowanie` enum('Początkujący','średniozaawansowany','zaawansowany') NOT NULL,
  `rok` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id_wypelniajacego`, `plec`, `zaawansowanie`, `rok`) VALUES
(20, 'k', 'średniozaawansowany', 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `odpowiedzi`
--
ALTER TABLE `odpowiedzi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`id_wypelniajacego`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id_wypelniajacego`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `odpowiedzi`
--
ALTER TABLE `odpowiedzi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id_wypelniajacego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `odpowiedzi`
--
ALTER TABLE `odpowiedzi`
  ADD CONSTRAINT `odpowiedzi_ibfk_1` FOREIGN KEY (`id_wypelniajacego`) REFERENCES `uzytkownicy` (`id_wypelniajacego`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
