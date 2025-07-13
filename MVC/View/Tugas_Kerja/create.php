<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Penugasan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="wrapper d-flex">
    <?php include __DIR__ . '../../Template/sidebarAdmin.php'; ?>

    <main class="p-4 w-100">
        <h3 class="mb-4">📝 Tambah Penugasan Karyawan</h3>
        <form method="POST">
            <div class="mb-3">
                <label>Jadwal</label>
                <select name="schedule_id" class="form-control" required>
                    <option value="">Pilih Jadwal</option>
                    <?php foreach ($schedules as $s): ?>
                        <option value="<?= $s['id'] ?>"><?= $s['description'] ?> (<?= $s['start_day'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Karyawan</label>
                <select name="employee_id" class="form-control" required>
                    <option value="">Pilih Karyawan</option>
                    <?php foreach ($employees as $e): ?>
                        <option value="<?= $e['id'] ?>"><?= $e['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Peran dalam Tugas</label>
                <input type="text" name="choice_of_role" class="form-control" placeholder="Contoh: Pemupuk, Penyemprot" required>
            </div>
            <div class="mb-3">
                <label>Status Awal</label>
                <input type="text" name="status" class="form-control" value="dijadwalkan" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Penugasan</button>
            <a href="index.php?action=tugas" class="btn btn-secondary">Kembali</a>
        </form>
    </main>
</div>
</body>
</html>
