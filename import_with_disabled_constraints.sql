-- File ini telah dimodifikasi untuk mengatasi masalah foreign key constraint
-- saat import database

-- Nonaktifkan pemeriksaan foreign key sementara
SET FOREIGN_KEY_CHECKS = 0;

-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2026 at 09:50 PM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u610382372_siakad_1`
--

-- --------------------------------------------------------

-- Semua definisi tabel dari file asli akan disisipkan di sini
-- (Termasuk CREATE TABLE dan INSERT statements)

SOURCE u610382372_siakad_clean.sql

-- Indeks dan AUTO_INCREMENT dari file asli akan disisipkan di sini

-- Foreign key constraints yang tidak bermasalah akan ditambahkan di sini

-- Aktifkan kembali pemeriksaan foreign key
SET FOREIGN_KEY_CHECKS = 1;

COMMIT;