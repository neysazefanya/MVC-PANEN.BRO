<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Seleksi Pengajuan Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper d-flex">
        <?php include __DIR__ . '../../Template/sidebarAdmin.php'; ?>

        <main class="p-4 w-100">
            <h3>Penempatan Karyawan</h3>
            <form method="POST">
                <div class="mb-3">
                    <label>Nama Karyawan</label>
                    <input class="form-control" value="<?= $app['user_name'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label>Jadwal</label>
                    <input class="form-control" value="<?= $app['schedule_desc'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label>Pilih Role</label>
                    <select name="role" class="form-control" required>
                        <option value="">-- Pilih Role --</option>
                        <?php foreach ($roles as $r): ?>
                            <option value="<?= $r['name'] ?>"><?= $r['name'] ?> (Rp <?= number_format($r['daily_wage']) ?>/hari)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="index.php?action=seleksi" class="btn btn-secondary">Kembali</a>
            </form>
        </main>
    </div>
</body>

</html>