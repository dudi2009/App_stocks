<?php
// File untuk membuat user pertama
// Akses file ini langsung: http://localhost/App_stock/setup_user.php
// HAPUS FILE INI SETELAH SELESAI SETUP!

$koneksi = new mysqli("localhost", "root", "", "db_stock");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ubah enum dulu
$koneksi->query("ALTER TABLE `user` MODIFY `lvl` ENUM('admin','petugas','user') NOT NULL");

// Password yang akan digunakan
$password_admin = password_hash('admin123', PASSWORD_DEFAULT);
$password_petugas = password_hash('petugas123', PASSWORD_DEFAULT);
$password_user = password_hash('user123', PASSWORD_DEFAULT);

// Hapus user lama jika ada (optional)
$koneksi->query("DELETE FROM user WHERE username IN ('admin', 'petugas', 'user')");

// Insert user baru
$koneksi->query("INSERT INTO user (username, password, lvl) VALUES ('admin', '$password_admin', 'admin')");
$koneksi->query("INSERT INTO user (username, password, lvl) VALUES ('petugas', '$password_petugas', 'petugas')");
$koneksi->query("INSERT INTO user (username, password, lvl) VALUES ('user', '$password_user', 'user')");

echo "<h2>✅ Setup Berhasil!</h2>";
echo "<p>User berhasil dibuat:</p>";
echo "<ul>";
echo "<li><b>admin</b> - password: <code>admin123</code> (Level: Admin)</li>";
echo "<li><b>petugas</b> - password: <code>petugas123</code> (Level: Petugas)</li>";
echo "<li><b>user</b> - password: <code>user123</code> (Level: User)</li>";
echo "</ul>";
echo "<p><a href='login.php'>Klik di sini untuk Login</a></p>";
echo "<p style='color:red'><b>⚠️ HAPUS FILE INI SETELAH SELESAI SETUP!</b></p>";

$koneksi->close();
?>
