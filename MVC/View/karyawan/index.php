<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php?action=login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="bg-gray-50 font-sans">
    <div class="flex min-h-screen">
        <?php include __DIR__ . '../../Template/sidebarAdmin.php'; ?>

        <main class="flex-1  p-4 lg:p-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Manajemen Pengguna</h1>
                        <p class="text-gray-600">Kelola data admin dan karyawan sistem</p>
                    </div>
                    <a href="index.php?action=karyawan-create"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i data-feather="plus" class="w-5 h-5"></i>
                        Tambah Pengguna Baru
                    </a>
                </div>
            </div>

            <!-- Admin Section -->
            <div class="mb-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white flex items-center gap-2">
                            <i data-feather="shield" class="w-5 h-5"></i>
                            Daftar Admin
                        </h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200">
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-700 w-16">#</th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-700">Nama</th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-700">Username</th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-700">Email</th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <?php if ($admins): ?>
                                    <?php $no = 1;
                                    foreach ($admins as $a): ?>
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="py-4 px-6 text-sm text-gray-600 font-medium"><?= $no++ ?></td>
                                            <td class="py-4 px-6">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                                        <?= strtoupper(substr(htmlspecialchars($a['name']), 0, 1)) ?>
                                                    </div>
                                                    <div>
                                                        <div class="font-medium text-gray-900"><?= htmlspecialchars($a['name']) ?></div>
                                                        <div class="text-sm text-purple-600 font-medium">Administrator</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-600 font-mono"><?= $a['username'] ?></td>
                                            <td class="py-4 px-6 text-sm text-gray-600"><?= $a['email'] ?></td>
                                            <td class="py-4 px-6 text-sm text-gray-600">
                                                <div class="flex gap-2">
                                                    <a href="index.php?action=karyawan-edit&id=<?= $k['id'] ?>"
                                                        class="inline-flex items-center gap-1 bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm font-medium">
                                                        <i data-feather="edit" class="w-4 h-4"></i>Edit
                                                    </a>
                                                    <a href="index.php?action=karyawan-delete&id=<?= $k['id'] ?>"
                                                        onclick="return confirm('Yakin ingin menghapus pengguna ini?')"
                                                        class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-medium">
                                                        <i data-feather="trash-2" class="w-4 h-4"></i>Hapus
                                                    </a>
                                                </div>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="py-12 px-6 text-center">
                                            <div class="flex flex-col items-center gap-3">
                                                <i data-feather="users" class="w-12 h-12 text-gray-300"></i>
                                                <p class="text-gray-500 font-medium">Tidak ada admin tersedia</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Karyawan Section -->
            <div class="mb-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white flex items-center gap-2">
                            <i data-feather="briefcase" class="w-5 h-5"></i>
                            Daftar Karyawan
                        </h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200">
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-700 w-16">#</th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-700">Nama</th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-700">Username</th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-700">Email</th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-700">Waktu Tersedia</th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <?php if ($karyawans): ?>
                                    <?php $no = 1;
                                    foreach ($karyawans as $k): ?>
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="py-4 px-6 text-sm text-gray-600 font-medium"><?= $no++ ?></td>
                                            <td class="py-4 px-6">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                                        <?= strtoupper(substr(htmlspecialchars($k['name']), 0, 1)) ?>
                                                    </div>
                                                    <div>
                                                        <div class="font-medium text-gray-900"><?= htmlspecialchars($k['name']) ?></div>
                                                        <div class="text-sm text-green-600 font-medium">Karyawan</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-600 font-mono"><?= $k['username'] ?></td>
                                            <td class="py-4 px-6 text-sm text-gray-600"><?= $k['email'] ?></td>
                                            <td class="py-4 px-6">
                                                <?php if ($k['availability_time']): ?>
                                                    <span class="inline-flex items-center gap-1 bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                                        <i data-feather="clock" class="w-4 h-4"></i>
                                                        <?= $k['availability_time'] ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm font-medium">
                                                        <i data-feather="minus" class="w-4 h-4"></i>
                                                        Belum diatur
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-600">
                                                <div class="flex gap-2">
                                                    <a href="index.php?action=karyawan-edit&id=<?= $k['id'] ?>"
                                                        class="inline-flex items-center gap-1 bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm font-medium">
                                                        <i data-feather="edit" class="w-4 h-4"></i>Edit
                                                    </a>
                                                    <a href="index.php?action=karyawan-delete&id=<?= $k['id'] ?>"
                                                        onclick="return confirm('Yakin ingin menghapus pengguna ini?')"
                                                        class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-medium">
                                                        <i data-feather="trash-2" class="w-4 h-4"></i>Hapus
                                                    </a>
                                                </div>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="py-12 px-6 text-center">
                                            <div class="flex flex-col items-center gap-3">
                                                <i data-feather="users" class="w-12 h-12 text-gray-300"></i>
                                                <p class="text-gray-500 font-medium">Tidak ada karyawan tersedia</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Initialize Feather icons
        feather.replace();
    </script>
</body>

</html>