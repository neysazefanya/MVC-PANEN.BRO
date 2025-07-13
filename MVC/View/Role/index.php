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
    <title>Manajemen Role</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <?php include __DIR__ . '../../Template/sidebarAdmin.php'; ?>

        <!-- Main Content -->
        <main class="flex-1 p-8 ">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Manajemen Role</h1>
                        <p class="mt-2 text-gray-600">Kelola role pekerjaan dan pengaturan gaji</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200">
                            <span class="text-sm text-gray-500">Total Role:</span>
                            <span class="ml-2 font-semibold text-gray-900"><?= count($roles) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="mb-6">
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <i data-feather="briefcase" class="w-5 h-5 text-green-600"></i>
                                <span class="text-lg font-semibold text-gray-900">Daftar Role Pekerjaan</span>
                            </div>
                        </div>
                        <a href="?action=role-create" 
                           class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-6 py-2.5 rounded-lg font-medium transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center space-x-2">
                            <i data-feather="plus" class="w-4 h-4"></i>
                            <span>Tambah Role</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Role Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Table Header -->
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center space-x-2">
                        <i data-feather="users" class="w-5 h-5 text-gray-600"></i>
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Role</h3>
                    </div>
                </div>

                <?php if (empty($roles)): ?>
                    <!-- Empty State -->
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-feather="briefcase" class="w-8 h-8 text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada role</h3>
                        <p class="text-gray-500 mb-6">Mulai dengan menambahkan role pekerjaan pertama Anda</p>
                        <a href="?action=role-create" 
                           class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <i data-feather="plus" class="w-4 h-4 mr-2"></i>
                            Tambah Role
                        </a>
                    </div>
                <?php else: ?>
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-900 w-16">#</th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-900">
                                        <div class="flex items-center space-x-2">
                                            <i data-feather="tag" class="w-4 h-4"></i>
                                            <span>Nama Role</span>
                                        </div>
                                    </th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-900">
                                        <div class="flex items-center space-x-2">
                                            <i data-feather="dollar-sign" class="w-4 h-4"></i>
                                            <span>Gaji per Hari</span>
                                        </div>
                                    </th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-900 w-32">
                                        <div class="flex items-center space-x-2">
                                            <i data-feather="settings" class="w-4 h-4"></i>
                                            <span>Aksi</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php $no = 1;
                                foreach ($roles as $r): ?>
                                    <tr class="hover:bg-gray-50 transition-colors group">
                                        <td class="py-4 px-6 text-sm text-gray-500">
                                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-medium">
                                                <?= $no++ ?>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                                                    <i data-feather="briefcase" class="w-5 h-5 text-white"></i>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($r['name']) ?></div>
                                                    <div class="text-xs text-gray-500">Role Pekerjaan</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center space-x-2">
                                                <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                                    Rp <?= number_format($r['daily_wage'], 0, ',', '.') ?>
                                                </div>
                                                <span class="text-xs text-gray-500">per hari</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center space-x-2">
                                                <button onclick="confirmDelete(<?= $r['id'] ?>)" 
                                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors group-hover:opacity-100 ">
                                                    <i data-feather="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4">
            <div class="flex items-center justify-center w-12 h-12 bg-red-100 rounded-full mx-auto mb-4">
                <i data-feather="alert-triangle" class="w-6 h-6 text-red-600"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Konfirmasi Hapus</h3>
            <p class="text-gray-600 text-center mb-6">Apakah Anda yakin ingin menghapus role ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex space-x-3">
                <button onclick="closeModal()" 
                        class="flex-1 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                    Batal
                </button>
                <a id="deleteLink" href="#" 
                   class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-center">
                    Hapus
                </a>
            </div>
        </div>
    </div>

    <script>
        // Initialize Feather Icons
        feather.replace();
        
        // Delete confirmation
        function confirmDelete(roleId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteLink').href = `?action=role-delete&id=${roleId}`;
        }
        
        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
        
        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
        
        // Add entrance animation
        window.addEventListener('load', function() {
            const elements = document.querySelectorAll('main > *');
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    el.style.transition = 'all 0.5s ease-out';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>

</html>