<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Kerja Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <?php include __DIR__ . '../../Template/sidebarKaryawan.php'; ?>

        <main class="flex-1 p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                        <i data-feather="user-check" class="w-6 h-6 text-white"></i>
                    </div>
                    Riwayat Kerja Saya
                </h1>
                <p class="text-gray-600 mt-2">Semua riwayat pekerjaan yang telah Anda selesaikan</p>
            </div>

            <?php if (!empty($riwayats)): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <i data-feather="clock"></i>
                            Riwayat Aktivitas
                        </h3>
                        <span class="text-sm text-gray-500">
                            Menampilkan <?= count($riwayats) ?> data
                        </span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="py-3 px-6 text-sm text-left font-semibold text-gray-700">#</th>
                                    <th class="py-3 px-6 text-sm text-left font-semibold text-gray-700">Jadwal</th>
                                    <th class="py-3 px-6 text-sm text-left font-semibold text-gray-700">Absensi</th>
                                    <th class="py-3 px-6 text-sm text-left font-semibold text-gray-700">Catatan</th>
                                    <th class="py-3 px-6 text-sm text-left font-semibold text-gray-700">Gaji</th>
                                    <th class="py-3 px-6 text-sm text-left font-semibold text-gray-700">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php $no = 1; foreach ($riwayats as $r): ?>
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="py-4 px-6 text-sm text-gray-500"><?= $no++ ?></td>
                                        <td class="py-4 px-6 text-sm text-gray-900"><?= htmlspecialchars($r['schedule_desc'] ?? '-') ?></td>
                                        <td class="py-4 px-6 text-sm">
                                            <?php
                                                $absensi = strtolower($r['absensi'] ?? 'tidak hadir');
                                                $color = match($absensi) {
                                                    'hadir' => 'bg-green-100 text-green-800',
                                                    'tidak hadir' => 'bg-red-100 text-red-800',
                                                    'terlambat' => 'bg-yellow-100 text-yellow-800',
                                                    'izin' => 'bg-blue-100 text-blue-800',
                                                    'sakit' => 'bg-purple-100 text-purple-800',
                                                    default => 'bg-gray-100 text-gray-800'
                                                };
                                            ?>
                                            <span class="px-3 py-1 rounded-full text-xs font-medium <?= $color ?>">
                                                <?= ucfirst($absensi) ?>
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-700">
                                            <?= !empty($r['description']) ? htmlspecialchars($r['description']) : '<span class="italic text-gray-400">Tidak ada</span>' ?>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-green-600 font-bold">
                                            Rp <?= number_format($r['total_wage'] ?? 0, 0, ',', '.') ?>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-700">
                                            <?= date('d/m/Y', strtotime($r['created_at'])) ?>
                                            <br>
                                            <span class="text-xs text-gray-400"><?= date('H:i', strtotime($r['created_at'])) ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-16 text-gray-500">
                    <i data-feather="folder" class="w-10 h-10 mx-auto mb-2"></i>
                    <p class="text-lg font-semibold">Belum ada riwayat kerja</p>
                    <p class="text-sm">Riwayat akan muncul setelah Anda menyelesaikan jadwal kerja.</p>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <script>feather.replace();</script>
</body>
</html>
