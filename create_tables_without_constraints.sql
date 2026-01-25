-- File ini berisi perintah untuk membuat tabel-tabel tanpa constraint foreign key
-- untuk menghindari error saat import data

-- Nonaktifkan foreign key checks
SET FOREIGN_KEY_CHECKS = 0;

-- Mulai transaksi
START TRANSACTION;

-- Bagian CREATE TABLE dari file asli akan disisipkan di sini
-- (Semua perintah CREATE TABLE dari file asli)

SOURCE u610382372_siakad_clean.sql;

-- Commit transaksi
COMMIT;

-- Aktifkan kembali foreign key checks
SET FOREIGN_KEY_CHECKS = 1;