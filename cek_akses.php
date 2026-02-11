<?php
// File untuk mengecek hak akses berdasarkan role

function cekLogin() {
    if (!isset($_SESSION['id_user'])) {
        echo "<script>window.location.href='login_user.php';</script>";
        exit;
    }
}

function cekAkses($allowed_roles) {
    if (!isset($_SESSION['lvl']) || !in_array($_SESSION['lvl'], $allowed_roles)) {
        echo "<div class='alert alert-danger m-3'>⛔ Anda tidak memiliki akses ke halaman ini!</div>";
        return false;
    }
    return true;
}

function isAdmin() {
    return isset($_SESSION['lvl']) && $_SESSION['lvl'] == 'admin';
}

function isPetugas() {
    return isset($_SESSION['lvl']) && $_SESSION['lvl'] == 'petugas';
}

function isUser() {
    return isset($_SESSION['lvl']) && $_SESSION['lvl'] == 'user';
}
?>
