<?php
// Pastikan $riwayats sudah diisi dari model History -> getAll()
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kerja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
<div class="flex min-h-screen">
    <?php include __DIR__ . '../../Template/sidebarAdmin.php'; ?>

    <main class="flex-1 p-8">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                        <i data-feather="folder" class="w-6 h-6 text-white"></i>
                    </div>
                    <span>Riwayat Kerja</span>
                </h1>
                <p class="mt-2 text-gray-600">Pantau dan kelola riwayat aktivitas kerja yang telah selesai</p>
            </div>
            <a href="index.php?action=jadwal-arsipkan" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow font-semibold">🔁 Arsipkan Jadwal Selesai</a>
        </div>

        <?php
        $total = count($riwayats);
        $status = isset($r['absensi']) ? strtolower($r['absensi']) : '';
        $totalGaji = array_sum(array_column($riwayats, 'total_wage'));
        ?>

        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded-xl shadow border border-gray-200">
                <p class="text-sm text-gray-500">Total Records</p>
                <p class="text-2xl font-bold text-gray-900"><?= $total ?></p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow border border-gray-200">
                <p class="text-sm text-gray-500">Total Gaji</p>
                <p class="text-2xl font-bold text-purple-600">Rp <?= number_format($totalGaji, 0, ',', '.') ?></p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <?php if (!empty($riwayats)): ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="text-left py-3 px-6 text-sm font-bold text-gray-700">#</th>
                            <th class="text-left py-3 px-6 text-sm font-bold text-gray-700">Nama Karyawan</th>
                            <th class="text-left py-3 px-6 text-sm font-bold text-gray-700">Jadwal</th>
                            <th class="text-left py-3 px-6 text-sm font-bold text-gray-700">Gaji</th>
                            <th class="text-left py-3 px-6 text-sm font-bold text-gray-700">Waktu</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        <?php $no = 1; foreach ($riwayats as $r): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-6 text-gray-600"><?= $no++ ?></td>
                                <td class="py-3 px-6">
                                    <div class="font-semibold text-gray-900"><?= htmlspecialchars($r['user_name']) ?></div>
                                </td>
                                <td class="py-3 px-6 text-gray-700"><?= htmlspecialchars($r['schedule_desc']) ?></td>
                                <td class="py-3 px-6 text-green-600 font-bold">Rp <?= number_format($r['total_wage'], 0, ',', '.') ?></td>
                                <td class="py-3 px-6 text-sm text-gray-500">
                                    <?= date('d/m/Y H:i', strtotime($r['created_at'])) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center p-12 text-gray-500">
                    <i data-feather="folder" class="w-12 h-12 mx-auto text-gray-400 mb-4"></i>
                    <p class="font-medium">Belum ada riwayat kerja</p>
                    <p class="text-sm">Riwayat akan muncul setelah jadwal selesai dan diarsipkan.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>

<script>
    feather.replace();
</script>
</body>
</html>
