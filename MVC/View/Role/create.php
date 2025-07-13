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
    <title>Tambah Role Pekerjaan</title>
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
                <div class="flex items-center gap-4 mb-4">
                    <a href="?action=role" 
                       class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 transition-colors duration-200">
                        <i data-feather="arrow-left" class="w-5 h-5"></i>
                        <span class="font-medium">Kembali</span>
                    </a>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Tambah Role Pekerjaan</h1>
                    <p class="text-gray-600">Buat role pekerjaan baru untuk sistem manajemen</p>
                </div>
            </div>

            <!-- Form Section -->
            <div class="max-w-2xl">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white flex items-center gap-2">
                            <i data-feather="briefcase" class="w-5 h-5"></i>
                            Informasi Role Pekerjaan
                        </h2>
                    </div>
                    
                    <div class="p-6">
                        <form method="POST" class="space-y-6">
                            <!-- Nama Role Field -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Role
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-feather="tag" class="w-5 h-5 text-gray-400"></i>
                                    </div>
                                    <input type="text" 
                                           id="name"
                                           name="name" 
                                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 placeholder-gray-400" 
                                           placeholder="Masukkan nama role (contoh: Manager, Developer, Designer)" 
                                           required>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Nama role harus jelas dan deskriptif</p>
                            </div>

                            <!-- Gaji per Hari Field -->
                            <div>
                                <label for="daily_wage" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Gaji per Hari
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-400 font-medium">Rp</span>
                                    </div>
                                    <input type="number" 
                                           id="daily_wage"
                                           name="daily_wage" 
                                           class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 placeholder-gray-400" 
                                           placeholder="0" 
                                           min="0"
                                           step="1000"
                                           required>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Masukkan nominal gaji harian dalam rupiah</p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                                <button type="submit" 
                                        class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <i data-feather="save" class="w-5 h-5"></i>
                                    Simpan Role
                                </button>
                                <a href="?action=role" 
                                   class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium transition-all duration-200 border border-gray-300">
                                    <i data-feather="x" class="w-5 h-5"></i>
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="mt-6 bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <i data-feather="info" class="w-5 h-5 text-green-500 mt-0.5"></i>
                        <div>
                            <h4 class="font-medium text-green-900 mb-1">Informasi Penting</h4>
                            <p class="text-sm text-green-700">
                                Role yang dibuat akan digunakan untuk mengelompokkan karyawan dan menentukan 
                                struktur gaji. Pastikan nama role mudah dipahami dan gaji yang ditetapkan sesuai 
                                dengan standar perusahaan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Initialize Feather icons
        feather.replace();
        
        // Format currency input
        const salaryInput = document.getElementById('daily_wage');
        salaryInput.addEventListener('input', function(e) {
            // Remove non-numeric characters except for the decimal point
            let value = e.target.value.replace(/[^\d]/g, '');
            
            // Add thousand separators
            if (value) {
                value = parseInt(value).toLocaleString('id-ID');
            }
            
            // Update the display (for visual feedback)
            // Note: The actual value sent will be the numeric value
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const wage = document.getElementById('daily_wage').value;
            
            if (!name) {
                e.preventDefault();
                alert('Nama role harus diisi');
                return;
            }
            
            if (!wage || wage <= 0) {
                e.preventDefault();
                alert('Gaji per hari harus diisi dan lebih dari 0');
                return;
            }
        });
    </script>
</body>
</html>