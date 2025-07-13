<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Gaji Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="wrapper d-flex">
    <?php include __DIR__ . '../../Template/sidebarKaryawan.php'; ?>

    <main class="p-4 w-100">
        <h3 class="mb-4">💼 Riwayat Gaji Saya</h3>

        <table class="table table-striped">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Jadwal</th>
                    <th>Hari Masuk</th>
                    <th>Upah / Hari</th>
                    <th>Total Gaji</th>
                    <th>Tanggal Perhitungan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($gaji)): $no = 1; foreach ($gaji as $g): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $g['schedule_desc'] ?></td>
                    <td><?= $g['total_days'] ?> hari</td>
                    <td>Rp <?= number_format($g['daily_wage']) ?></td>
                    <td><strong>Rp <?= number_format($g['total_salary']) ?></strong></td>
                    <td><?= $g['created_at'] ?></td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="6" class="text-center text-muted">Belum ada data gaji.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</div>
</body>
</html>
