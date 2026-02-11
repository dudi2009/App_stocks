-- Jalankan query ini di phpMyAdmin untuk mengupdate tabel user

-- 1. Ubah enum lvl untuk menambahkan 'user'
ALTER TABLE `user` MODIFY `lvl` ENUM('admin','petugas','user') NOT NULL;

-- 2. Buat akun admin default (password: admin123)
INSERT INTO `user` (`username`, `password`, `lvl`) VALUES 
('admin', 'admin123', 'admin');

-- 3. Buat akun petugas default (password: petugas123)
INSERT INTO `user` (`username`, `password`, `lvl`) VALUES 
('petugas', 'petugas123', 'petugas');

-- 4. Buat akun user default (password: user123)
INSERT INTO `user` (`username`, `password`, `lvl`) VALUES 
('user', 'user123', 'user');
