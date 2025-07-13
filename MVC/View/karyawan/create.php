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
    <title>Tambah Pengguna - Sistem Perkebunan</title>
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
                    <a href="index.php?action=karyawan" 
                       class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 transition-colors duration-200">
                        <i data-feather="arrow-left" class="w-5 h-5"></i>
                        <span class="font-medium">Kembali</span>
                    </a>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Tambah Pengguna Baru</h1>
                    <p class="text-gray-600">Daftarkan pengguna baru untuk sistem manajemen perkebunan</p>
                </div>
            </div>

            <!-- Form Section -->
            <div class="max-w-2xl">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white flex items-center gap-2">
                            <i data-feather="user-plus" class="w-5 h-5"></i>
                            Informasi Pengguna
                        </h2>
                    </div>
                    
                    <div class="p-6">
                        <form method="POST" action="?action=karyawan-create" class="space-y-6">
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Lengkap
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-feather="user" class="w-5 h-5 text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="name"
                                        name="name" 
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 placeholder-gray-400" 
                                        placeholder="Masukkan nama lengkap pengguna" 
                                        required
                                    >
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Nama yang akan ditampilkan di sistem</p>
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Email
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-feather="mail" class="w-5 h-5 text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="email" 
                                        id="email"
                                        name="email" 
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 placeholder-gray-400" 
                                        placeholder="user@example.com" 
                                        required
                                    >
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Email akan digunakan untuk notifikasi sistem</p>
                            </div>

                            <!-- Username Field -->
                            <div>
                                <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Username
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-feather="at-sign" class="w-5 h-5 text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="username"
                                        name="username" 
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 placeholder-gray-400" 
                                        placeholder="Masukkan username unik" 
                                        required
                                    >
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Username harus unik dan tidak boleh mengandung spasi</p>
                            </div>

                            <!-- Password Field -->
                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Password
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-feather="lock" class="w-5 h-5 text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="password" 
                                        id="password"
                                        name="password" 
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 placeholder-gray-400" 
                                        placeholder="Minimal 6 karakter" 
                                        required
                                    >
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Password minimal 6 karakter untuk keamanan</p>
                            </div>

                            <!-- Role Selection -->
                            <div>
                                <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Role Pengguna
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-feather="shield" class="w-5 h-5 text-gray-400"></i>
                                    </div>
                                    <select 
                                        id="role"
                                        name="role" 
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 appearance-none bg-white"
                                        required 
                                        onchange="toggleAvailability(this.value)"
                                    >
                                        <option value="">Pilih role pengguna</option>
                                        <option value="admin">Administrator</option>
                                        <option value="karyawan">Karyawan</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i data-feather="chevron-down" class="w-5 h-5 text-gray-400"></i>
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Tentukan hak akses pengguna dalam sistem</p>
                            </div>

                            <!-- Availability Field (Hidden by default) -->
                            <div id="availability-section" class="hidden">
                                <label for="availability_time" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Waktu Ketersediaan
                                </label>
                                <div class="relative">
                                    <div class="absolute top-3 left-3 pointer-events-none">
                                        <i data-feather="clock" class="w-5 h-5 text-gray-400"></i>
                                    </div>
                                    <textarea 
                                        id="availability_time"
                                        name="availability_time" 
                                        rows="3"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 placeholder-gray-400 resize-none"
                                        placeholder="Contoh: Senin - Jumat, 08:00 - 16:00"
                                    ></textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Jadwal kerja atau waktu ketersediaan karyawan</p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                                <button 
                                    type="submit" 
                                    class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                                >
                                    <i data-feather="user-plus" class="w-5 h-5"></i>
                                    Daftarkan Pengguna
                                </button>
                                <a 
                                    href="index.php?action=karyawan" 
                                    class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium transition-all duration-200 border border-gray-300"
                                >
                                    <i data-feather="x" class="w-5 h-5"></i>
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <!-- Admin Info -->
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                <i data-feather="shield" class="w-4 h-4 text-purple-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-purple-900 mb-1">Administrator</h4>
                                <p class="text-sm text-purple-700">
                                    Memiliki akses penuh ke semua fitur sistem, termasuk manajemen pengguna dan data.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Karyawan Info -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <i data-feather="users" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-green-900 mb-1">Karyawan</h4>
                                <p class="text-sm text-green-700">
                                    Akses terbatas untuk melakukan tugas operasional dan mencatat aktivitas kerja.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Notice -->
                <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <i data-feather="info" class="w-5 h-5 text-blue-500 mt-0.5"></i>
                        <div>
                            <h4 class="font-medium text-blue-900 mb-1">Keamanan Data</h4>
                            <p class="text-sm text-blue-700">
                                Semua data pengguna akan dienkripsi dan disimpan dengan aman. Pastikan untuk memberikan 
                                informasi yang akurat dan valid.
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

        // Toggle availability section based on role
        function toggleAvailability(role) {
            const availabilitySection = document.getElementById('availability-section');
            const availabilityInput = document.getElementById('availability_time');
            
            if (role === 'karyawan') {
                availabilitySection.classList.remove('hidden');
                availabilitySection.style.opacity = '0';
                availabilitySection.style.transform = 'translateY(-10px)';
                
                // Animate show
                setTimeout(() => {
                    availabilitySection.style.transition = 'all 0.3s ease-in-out';
                    availabilitySection.style.opacity = '1';
                    availabilitySection.style.transform = 'translateY(0)';
                }, 10);
            } else {
                availabilitySection.style.transition = 'all 0.3s ease-in-out';
                availabilitySection.style.opacity = '0';
                availabilitySection.style.transform = 'translateY(-10px)';
                
                // Hide after animation
                setTimeout(() => {
                    availabilitySection.classList.add('hidden');
                    availabilityInput.value = '';
                }, 300);
            }
        }

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;
            const role = document.getElementById('role').value;
            
            if (!name || !email || !username || !password || !role) {
                e.preventDefault();
                alert('Semua field wajib diisi!');
                return;
            }
            
            if (password.length < 6) {
                e.preventDefault();
                alert('Password minimal 6 karakter!');
                return;
            }
            
            if (username.includes(' ')) {
                e.preventDefault();
                alert('Username tidak boleh mengandung spasi!');
                return;
            }
        });

        // Add input animation effects
        const inputs = document.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.01)';
                this.parentElement.style.transition = 'transform 0.2s ease-in-out';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>