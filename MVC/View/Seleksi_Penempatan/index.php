<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleksi Pengajuan Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.2s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(10px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="wrapper flex min-h-screen">
        <!-- Sidebar -->
        <?php include __DIR__ . '../../Template/sidebarAdmin.php'; ?>

        <!-- Main Content -->
        <main class="flex-1 p-8 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <!-- Header Section -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6 animate-fade-in">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                                <span class="text-2xl">📥</span>
                                Seleksi Pengajuan Karyawan
                            </h2>
                            <p class="text-gray-600 mt-1">Kelola pengajuan karyawan untuk jadwal kerja</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Total Pengajuan</p>
                                <p class="text-2xl font-bold text-green-600"><?= count($pengajuan ?? []) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden animate-fade-in">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-green-500 to-green-600 text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">#</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Nama Karyawan</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Skill</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Jadwal</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal Pengajuan</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php if (isset($pengajuan) && is_array($pengajuan) && count($pengajuan) > 0): ?>
                                    <?php $no = 1;
                                    foreach ($pengajuan as $p): ?>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 text-sm text-gray-900"><?= $no++ ?></td>
                                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                        <?= strtoupper(substr($p['user_name'] ?? '', 0, 2)) ?>
                                                    </div>
                                                    <?= htmlspecialchars($p['user_name'] ?? '') ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-700">
                                                <?php if (!empty($p['skills'])): ?>
                                                    <div class="flex flex-wrap gap-1">
                                                        <?php foreach (explode(', ', $p['skills']) as $skill): ?>
                                                            <span class="bg-emerald-100 text-emerald-800 text-xs font-medium px-2 py-0.5 rounded-full">
                                                                <?= htmlspecialchars($skill) ?>
                                                            </span>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php else: ?>
                                                    <span class="text-gray-400 italic text-sm">Tidak ada</span>
                                                <?php endif; ?>
                                            </td>

                                            <td class="px-6 py-4 text-sm text-gray-600">
                                                <div class="max-w-xs">
                                                    <div class="truncate" title="<?= htmlspecialchars($p['schedule_desc'] ?? '') ?>">
                                                        <i class="fas fa-calendar-alt text-gray-400 mr-1"></i>
                                                        <?= htmlspecialchars($p['schedule_desc'] ?? '') ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-600">
                                                <?php
                                                $status = $p['status'] ?? '';
                                                if ($status === 'pending'): ?>
                                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium flex items-center gap-1 w-fit">
                                                        <i class="fas fa-clock"></i>
                                                        Pending
                                                    </span>
                                                <?php elseif ($status === 'accepted'): ?>
                                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium flex items-center gap-1 w-fit">
                                                        <i class="fas fa-check-circle"></i>
                                                        Diterima
                                                    </span>
                                                <?php else: ?>
                                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium flex items-center gap-1 w-fit">
                                                        <i class="fas fa-times-circle"></i>
                                                        Ditolak
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-600">
                                                <div class="flex items-center gap-1">
                                                    <i class="fas fa-calendar text-gray-400"></i>
                                                    <?= htmlspecialchars($p['created_at'] ?? '') ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <?php if (($p['status'] ?? '') === 'pending'): ?>
                                                    <div class="flex items-center justify-center gap-2">
                                                        <a href="index.php?action=seleksi-assign&id=<?= $p['id'] ?? '' ?>"
                                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors duration-200 flex items-center gap-1">
                                                            <i class="fas fa-check"></i>
                                                            Terima
                                                        </a>
                                                        <a href="index.php?action=seleksi-reject&id=<?= $p['id'] ?? '' ?>"
                                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors duration-200 flex items-center gap-1">
                                                            <i class="fas fa-times"></i>
                                                            Tolak
                                                        </a>
                                                    </div>
                                                <?php else: ?>
                                                    <span class="text-gray-500 text-sm italic flex items-center justify-center gap-1">
                                                        <i class="fas fa-check-double"></i>
                                                        Selesai
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center text-gray-500">
                                                <i class="fas fa-inbox text-4xl mb-3 text-gray-400"></i>
                                                <p class="text-lg font-medium">Belum ada pengajuan karyawan</p>
                                                <p class="text-sm">Pengajuan karyawan akan muncul di sini</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Stats Cards -->
                <?php if (isset($pengajuan) && is_array($pengajuan) && count($pengajuan) > 0): ?>
                    <?php
                    $totalPengajuan = count($pengajuan);
                    $pengajuanPending = array_filter($pengajuan, function ($p) {
                        return ($p['status'] ?? '') === 'pending';
                    });
                    $totalPending = count($pengajuanPending);
                    $pengajuanAccepted = array_filter($pengajuan, function ($p) {
                        return ($p['status'] ?? '') === 'accepted';
                    });
                    $totalAccepted = count($pengajuanAccepted);
                    $pengajuanRejected = array_filter($pengajuan, function ($p) {
                        return ($p['status'] ?? '') === 'rejected';
                    });
                    $totalRejected = count($pengajuanRejected);
                    ?>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
                        <div class="bg-white rounded-xl shadow-sm p-6 animate-fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Total Pengajuan</p>
                                    <p class="text-2xl font-bold text-gray-800"><?= number_format($totalPengajuan, 0, ',', '.') ?></p>
                                </div>
                                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-file-alt text-orange-600 text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm p-6 animate-fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Menunggu</p>
                                    <p class="text-2xl font-bold text-gray-800"><?= number_format($totalPending, 0, ',', '.') ?></p>
                                </div>
                                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm p-6 animate-fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Diterima</p>
                                    <p class="text-2xl font-bold text-gray-800"><?= number_format($totalAccepted, 0, ',', '.') ?></p>
                                </div>
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm p-6 animate-fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Ditolak</p>
                                    <p class="text-2xl font-bold text-gray-800"><?= number_format($totalRejected, 0, ',', '.') ?></p>
                                </div>
                                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-times-circle text-red-600 text-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>

</html>