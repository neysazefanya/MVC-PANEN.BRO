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
    <title>Daftar Area Kerja</title>
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
                                <span class="text-2xl">📋</span>
                                Daftar Area Kerja
                            </h2>
                            <p class="text-gray-600 mt-1">Kelola semua area kerja perkebunan</p>
                        </div>
                        <a href="index.php?action=area-create" 
                           class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-medium py-2.5 px-4 rounded-lg flex items-center gap-2 transition-all duration-300 hover:shadow-lg hover:scale-105 active:scale-95">
                            <span class="text-lg">➕</span>
                            <span>Tambah Area</span>
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
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Nama Area</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Ukuran</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Jumlah Pohon</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Jenis Tanah</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php if (isset($areas) && is_array($areas) && count($areas) > 0): ?>
                                    <?php $no = 1; foreach ($areas as $a): ?>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 text-sm text-gray-900"><?= $no++ ?></td>
                                            <td class="px-6 py-4 text-sm font-medium text-gray-900"><?= htmlspecialchars($a['name']) ?></td>
                                            <td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($a['size']) ?> hektar</td>
                                            <td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($a['quantity_of_trees']) ?></td>
                                            <td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($a['type_of_soil'] ?? '') ?></td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    <a href="index.php?action=area-edit&id=<?= $a['id'] ?>" 
                                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors duration-200 flex items-center gap-1">
                                                        <i class="fas fa-edit"></i>
                                                        Edit
                                                    </a>
                                                    <a href="index.php?action=area-delete&id=<?= $a['id'] ?>" 
                                                       onclick="return confirm('Yakin ingin menghapus area ini?');"
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
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center text-gray-500">
                                                <i class="fas fa-map-marked-alt text-4xl mb-3 text-gray-400"></i>
                                                <p class="text-lg font-medium">Belum ada data area kerja</p>
                                                <p class="text-sm">Tambahkan area kerja pertama Anda</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Stats Cards -->
                <?php if (isset($areas) && is_array($areas) && count($areas) > 0): ?>
                    <?php
                    $totalArea = array_sum(array_column($areas, 'size'));
                    $totalTrees = array_sum(array_column($areas, 'quantity_of_trees'));
                    $totalCount = count($areas);
                    ?>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div class="bg-white rounded-xl shadow-sm p-6 animate-fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Total Area</p>
                                    <p class="text-2xl font-bold text-gray-800"><?= number_format($totalArea, 0, ',', '.') ?> ha</p>
                                </div>
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-map text-green-600 text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm p-6 animate-fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Total Pohon</p>
                                    <p class="text-2xl font-bold text-gray-800"><?= number_format($totalTrees, 0, ',', '.') ?></p>
                                </div>
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-tree text-blue-600 text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm p-6 animate-fade-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Jumlah Area</p>
                                    <p class="text-2xl font-bold text-gray-800"><?= $totalCount ?></p>
                                </div>
                                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-chart-bar text-purple-600 text-xl"></i>
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