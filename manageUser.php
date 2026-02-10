<?php
// Hanya admin dan petugas yang bisa akses
if (!cekAkses(['admin', 'petugas'])) return;

// Tentukan role apa yang bisa ditambah
$allowed_lvl = [];
if (isAdmin()) {
    $allowed_lvl = ['admin', 'petugas', 'user']; // Admin bisa tambah semua
} elseif (isPetugas()) {
    $allowed_lvl = ['user']; // Petugas hanya bisa tambah user
}
?>

<div class="container mt-4">
    <h3 class="text-light">👥 Kelola User</h3>
    
    <!-- Form Tambah User -->
    <div class="card bg-dark text-light mb-4">
        <div class="card-header">Tambah User Baru</div>
        <div class="card-body">
            <form method="POST" action="?hal=manageUserProses">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="col-md-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="col-md-3">
                        <select name="lvl" class="form-select" required>
                            <option value="">-- Pilih Level --</option>
                            <?php foreach ($allowed_lvl as $lvl): ?>
                                <option value="<?= $lvl ?>"><?= ucfirst($lvl) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success w-100">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel User -->
    <div class="card bg-dark text-light">
        <div class="card-header">Daftar User</div>
        <div class="card-body">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Filter user yang bisa dilihat berdasarkan role
                    if (isAdmin()) {
                        $query = mysqli_query($koneksi, "SELECT * FROM user ORDER BY lvl, username");
                    } else {
                        // Petugas hanya lihat user
                        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE lvl='user' ORDER BY username");
                    }
                    
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query)):
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td>
                            <span class="badge bg-<?= $row['lvl'] == 'admin' ? 'danger' : ($row['lvl'] == 'petugas' ? 'warning' : 'info') ?>">
                                <?= ucfirst($row['lvl']) ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($row['id_user'] != $_SESSION['id_user']): ?>
                                <?php if (isAdmin() || (isPetugas() && $row['lvl'] == 'user')): ?>
                                    <a href="?hal=manageUserDelete&id=<?= $row['id_user'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">Hapus</a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
