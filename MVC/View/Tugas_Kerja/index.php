<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php?action=login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Penugasan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="wrapper d-flex">
    <?php include __DIR__ . '../../Template/sidebarAdmin.php'; ?>

    <main class="p-4 w-100">
        <h3 class="mb-4">🧑‍🌾 Daftar Penugasan Karyawan</h3>
        <a href="index.php?action=tugas-create" class="btn btn-success mb-3">➕ Tambah Penugasan</a>

        <table class="table table-bordered">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Nama Karyawan</th>
                    <th>Jadwal</th>
                    <th>Peran</th>
                    <th>Status Tugas</th>
                    <th>Dibuat Pada</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($penugasan)): ?>
                    <?php $no = 1; foreach ($penugasan as $t): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $t['employee_name'] ?></td>
                            <td><?= $t['schedule_desc'] ?></td>
                            <td><?= $t['choice_of_role'] ?></td>
                            <td><?= $t['status'] ?></td>
                            <td><?= $t['created_at'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center text-muted">Belum ada penugasan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</div>
</body>
</html>
