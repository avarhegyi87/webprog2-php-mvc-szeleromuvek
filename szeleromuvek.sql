-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Okt 20. 11:52
-- Kiszolgáló verziója: 10.4.22-MariaDB
-- PHP verzió: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `szeleromuvek`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(10) UNSIGNED NOT NULL,
  `csaladi_nev` varchar(45) NOT NULL DEFAULT '',
  `utonev` varchar(45) NOT NULL DEFAULT '',
  `bejelentkezes` varchar(12) NOT NULL DEFAULT '',
  `jelszo` varchar(40) NOT NULL DEFAULT '',
  `jogosultsag` varchar(3) NOT NULL DEFAULT '_1_'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `csaladi_nev`, `utonev`, `bejelentkezes`, `jelszo`, `jogosultsag`) VALUES
(1, 'Várhegyi-Miłoś', 'Ádám', 'adamvm', '7450c30ed820db62bb93baf1ce3365d205c6fd7d', '__1');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `helyszin`
--

CREATE TABLE `helyszin` (
  `id` int(10) UNSIGNED NOT NULL,
  `nev` varchar(30) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '',
  `megyeid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `helyszin`
--

INSERT INTO `helyszin` (`id`, `nev`, `megyeid`) VALUES
(1, 'Várpalota', 14),
(2, 'Kulcs', 13),
(3, 'Mosonszolnok', 15),
(4, 'Mosonmagyaróvár', 15),
(5, 'Bükkaranyos', 1),
(6, 'Erk', 2),
(7, 'Újrónafő', 15),
(8, 'Szápár', 14),
(9, 'Vép', 16),
(11, 'Mezőtúr', 5),
(12, 'Törökszentmiklós', 5),
(14, 'Felsőzsolca', 1),
(15, 'Csetény', 14),
(16, 'Ostffyasszonyfa', 16),
(17, 'Levél', 15),
(19, 'Csorna', 15),
(20, 'Mecsér', 15),
(21, 'Bakonycsernye', 13),
(22, 'Sopronkövesd', 15),
(23, 'Nagylózs', 15),
(25, 'Jánossomorja', 15),
(26, 'Ács', 12),
(27, 'Pápakovácsi', 14),
(28, 'Vönöck', 16),
(29, 'Kisigmánd', 12),
(30, 'Bőny', 15),
(31, 'Csém', 12),
(32, 'Nagyigmánd', 12),
(35, 'Bábolna', 12),
(37, 'Ikervár', 16),
(38, 'Lövő', 15);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `megye`
--

CREATE TABLE `megye` (
  `id` int(10) UNSIGNED NOT NULL,
  `nev` varchar(30) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '',
  `regio` varchar(20) COLLATE utf8_hungarian_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `megye`
--

INSERT INTO `megye` (`id`, `nev`, `regio`) VALUES
(1, 'Borsod-Abaúj-Zemplén', 'Észak-Magyarország '),
(2, 'Heves', 'Észak-Magyarország '),
(3, 'Nógrád', 'Észak-Magyarország '),
(4, 'Hajdú-Bihar', 'Észak-Alföld '),
(5, 'Jász-Nagykun-Szolnok', 'Észak-Alföld '),
(6, 'Szabolcs-Szatmár-Bereg', 'Észak-Alföld '),
(7, 'Bács-Kiskun', 'Dél-Alföld '),
(8, 'Békés', 'Dél-Alföld '),
(9, 'Csongrád', 'Dél-Alföld '),
(10, 'Pest', 'Közép-Magyarország '),
(11, 'Budapest ', 'Közép-Magyarország '),
(12, 'Komárom-Esztergom', 'Közép-Dunántúl '),
(13, 'Fejér', 'Közép-Dunántúl '),
(14, 'Veszprém', 'Közép-Dunántúl '),
(15, 'Győr-Moson-Sopron', 'Nyugat-Dunántúl '),
(16, 'Vas', 'Nyugat-Dunántúl '),
(17, 'Zala', 'Nyugat-Dunántúl '),
(18, 'Baranya', 'Dél-Dunántúl '),
(19, 'Somogy', 'Dél-Dunántúl '),
(20, 'Tolna', 'Dél-Dunántúl ');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `menu`
--

CREATE TABLE `menu` (
  `url` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `nev` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `jogosultsag` varchar(3) COLLATE utf8_hungarian_ci NOT NULL,
  `sorrend` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `menu`
--

INSERT INTO `menu` (`url`, `nev`, `jogosultsag`, `sorrend`) VALUES
('adatlekerdezes', 'Adatlekérdezés', '111', 30),
('arfolyamok', 'Árfolyamok', '111', 40),
('belepes', 'Belépés', '100', 50),
('hirek', 'Hírek', '111', 20),
('kilepes', 'Kilépés', '011', 70),
('nyitolap', 'Nyitólap', '111', 10),
('regisztral', 'Regisztráció', '100', 60);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `torony`
--

CREATE TABLE `torony` (
  `id` int(10) UNSIGNED NOT NULL,
  `darab` int(10) UNSIGNED DEFAULT 0,
  `teljesitmeny` int(10) UNSIGNED DEFAULT 0,
  `kezdev` year(4) DEFAULT current_timestamp(),
  `helyszinid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `torony`
--

INSERT INTO `torony` (`id`, `darab`, `teljesitmeny`, `kezdev`, `helyszinid`) VALUES
(1, 1, 250, 2000, 1),
(2, 1, 600, 2001, 2),
(3, 2, 600, 2002, 3),
(4, 2, 600, 2003, 4),
(5, 1, 225, 2005, 5),
(6, 1, 800, 2005, 6),
(7, 1, 800, 2005, 7),
(8, 1, 1800, 2005, 8),
(9, 1, 600, 2005, 9),
(10, 5, 2000, 2005, 4),
(11, 1, 1500, 2006, 11),
(12, 1, 1500, 2006, 12),
(13, 5, 2000, 2006, 4),
(14, 1, 1800, 2006, 14),
(15, 2, 2000, 2006, 15),
(16, 1, 600, 2006, 16),
(17, 12, 2000, 2006, 17),
(18, 1, 800, 2007, 3),
(19, 1, 800, 2007, 19),
(20, 1, 800, 2007, 20),
(21, 1, 2000, 2007, 21),
(22, 4, 3000, 2008, 22),
(23, 3, 3000, 2008, 23),
(24, 1, 2000, 2008, 23),
(25, 12, 2000, 2008, 17),
(26, 4, 2000, 2008, 25),
(27, 1, 1800, 2008, 25),
(28, 1, 2000, 2008, 26),
(29, 1, 2000, 2008, 27),
(30, 1, 850, 2008, 28),
(31, 19, 2000, 2009, 29),
(32, 8, 2000, 2009, 30),
(33, 4, 1800, 2010, 30),
(34, 1, 1800, 2010, 30),
(35, 6, 2000, 2010, 31),
(36, 7, 2000, 2010, 32),
(37, 6, 2000, 2010, 26),
(38, 2, 2000, 2010, 32),
(39, 6, 2000, 2010, 35),
(40, 1, 3000, 2010, 35),
(41, 1, 2000, 2010, 25),
(42, 4, 2000, 2011, 37),
(43, 13, 2000, 2011, 37),
(44, 1, 2000, 2010, 38);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `helyszin`
--
ALTER TABLE `helyszin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `megyeid` (`megyeid`);

--
-- A tábla indexei `megye`
--
ALTER TABLE `megye`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`url`);

--
-- A tábla indexei `torony`
--
ALTER TABLE `torony`
  ADD PRIMARY KEY (`id`),
  ADD KEY `helyszinid` (`helyszinid`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `helyszin`
--
ALTER TABLE `helyszin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT a táblához `megye`
--
ALTER TABLE `megye`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT a táblához `torony`
--
ALTER TABLE `torony`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `helyszin`
--
ALTER TABLE `helyszin`
  ADD CONSTRAINT `helyszin_ibfk_1` FOREIGN KEY (`megyeid`) REFERENCES `megye` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `torony`
--
ALTER TABLE `torony`
  ADD CONSTRAINT `torony_ibfk_1` FOREIGN KEY (`helyszinid`) REFERENCES `helyszin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
