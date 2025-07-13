<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../../index.php?action=login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jadwal Kerja</title>
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
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
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
                                <span class="text-2xl">📅</span>
                                Daftar Jadwal Kerja
                            </h2>
                            <p class="text-gray-600 mt-1">Kelola semua jadwal kerja karyawan</p>
                        </div>
                        <a href="index.php?action=jadwal-create" 
                           class="bg-gradient-to-r from-green-500 to-green-600  hover:from-green-600 hover:to-green-700 text-white font-medium py-2.5 px-4 rounded-lg flex items-center gap-2 transition-all duration-300 hover:shadow-lg hover:scale-105 active:scale-95">
                            <span class="text-lg">➕</span>
                            <span>Tambah Jadwal</span>
                        </a>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden animate-fade-in">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-green-500 to-green-600 text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">#</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Area</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Mulai</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Selesai</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold">Terbit</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Deskripsi</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php if (isset($jadwals) && is_array($jadwals) && count($jadwals) > 0): ?>
                                    <?php $no = 1; foreach ($jadwals as $j): ?>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 text-sm text-gray-900"><?= $no++ ?></td>
                                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                        <?= strtoupper(substr($j['area_name'] ?? '', 0, 2)) ?>
                                                    </div>
                                                    <?= htmlspecialchars($j['area_name'] ?? '') ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-600">
                                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                                                    <i class="fas fa-play mr-1"></i>
                                                    <?= htmlspecialchars($j['start_day'] ?? '') ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-600">
                                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">
                                                    <i class="fas fa-stop mr-1"></i>
                                                    <?= htmlspecialchars($j['finish_day'] ?? '') ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-600">
                                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                                                    <i class="fas fa-tasks mr-1"></i>
                                                    <?= htmlspecialchars($j['status'] ?? '') ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <?php if ($j['is_published'] ?? false): ?>
                                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-green-100 text-green-600 rounded-full">
                                                        <i class="fas fa-check text-sm"></i>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-red-100 text-red-600 rounded-full">
                                                        <i class="fas fa-times text-sm"></i>
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-600 max-w-xs">
                                                <div class="truncate" title="<?= htmlspecialchars($j['description'] ?? '') ?>">
                                                    <?= htmlspecialchars($j['description'] ?? '') ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    <a href="index.php?action=jadwal-edit&id=<?= $j['id'] ?? '' ?>" 
                                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors duration-200 flex items-center gap-1">
                                                        <i class="fas fa-edit"></i>
                                                        Edit
                                                    </a>
                                                    <a href="index.php?action=jadwal-delete&id=<?= $j['id'] ?? '' ?>" 
                                                       onclick="return confirm('Yakin ingin menghapus jadwal ini?');"
                                                       class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors duration-200 flex items-center gap-1">
                                                        <i class="fas fa-trash"></i>
                                                        Hapus
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center text-gray-500">
                                                <i class="fas fa-calendar-alt text-4xl mb-3 text-gray-400"></i>
                                                <p class="text-lg font-medium">Belum ada data jadwal kerja</p>
                                                <p class="text-sm">Tambahkan jadwal kerja pertama Anda</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Stats Cards -->
                <?php if (isset($jadwals) && is_array($jadwals) && count($jadwals) > 0): ?>
                    <?php
                    $totalJadwal = count($jadwals);
                    $jadwalPublished = array_filter($jadwals, function($j) { return $j['is_published'] ?? false; });
                    $totalPublished = count($jadwalPublished);
                    $jadwalAktif = array_filter($jadwals, function($j) { return ($j['status'] ?? '') === 'aktif'; });
                    $totalAktif = count($jadwalAktif);
                    ?>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div class="bg-white rounded-xl shadow-sm p-6 animate-fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Total Jadwal</p>
                                    <p class="text-2xl font-bold text-gray-800"><?= number_format($totalJadwal, 0, ',', '.') ?></p>
                                </div>
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-calendar text-blue-600 text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm p-6 animate-fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Jadwal Terbit</p>
                                    <p class="text-2xl font-bold text-gray-800"><?= number_format($totalPublished, 0, ',', '.') ?></p>
                                </div>
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm p-6 animate-fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Jadwal Aktif</p>
                                    <p class="text-2xl font-bold text-gray-800"><?= number_format($totalAktif, 0, ',', '.') ?></p>
                                </div>
                                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-play-circle text-purple-600 text-xl"></i>
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