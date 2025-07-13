<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal Kerja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    },
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
        .input-focus:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="wrapper flex min-h-screen">
        <!-- Include Sidebar -->
        <?php include __DIR__ . '../../Template/sidebarAdmin.php'; ?>

        <!-- Main Content -->
        <main class="flex-1 p-8 bg-gray-50">
            <div class="max-w-4xl mx-auto">
                <!-- Header Section -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6 animate-fade-in">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                                <span class="text-2xl">🗓️</span>
                                Tambah Jadwal Kerja
                            </h2>
                            <p class="text-gray-600 mt-1">Menambahkan jadwal kerja baru ke dalam sistem</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="index.php?action=jadwal"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg flex items-center gap-2 transition-all duration-300">
                                <i class="fas fa-arrow-left"></i>
                                <span>Kembali</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Alert Messages -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6 animate-fade-in">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-green-800 font-medium"><?= htmlspecialchars($_SESSION['success']) ?></span>
                        </div>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6 animate-fade-in">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-exclamation-circle text-red-500"></i>
                            <span class="text-red-800 font-medium"><?= htmlspecialchars($_SESSION['error']) ?></span>
                        </div>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <!-- Form Section -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden animate-fade-in">
                    <div class="p-6">
                        <form method="POST" class="space-y-6">
                            <!-- Area -->
                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                                    Area Kerja
                                </label>
                                <select name="area_id"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus"
                                    required>
                                    <option value="">Pilih Area</option>
                                    <?php foreach ($areas as $a): ?>
                                        <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['name'] ?? '') ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Mulai -->
                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-play-circle mr-2 text-green-500"></i>
                                    Tanggal Mulai
                                </label>
                                <input type="datetime-local" name="start_day"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus"
                                    required>
                            </div>

                            <!-- Selesai -->
                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-stop-circle mr-2 text-red-500"></i>
                                    Tanggal Selesai
                                </label>
                                <input type="datetime-local" name="finish_day"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus"
                                    required>
                            </div>

                            <!-- Status -->
                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-info-circle mr-2 text-yellow-500"></i>
                                    Status
                                </label>
                                <input type="text" name="status"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus"
                                    placeholder="Misal: Menunggu, Dikerjakan, Selesai">
                            </div>

                            <!-- Deskripsi -->
                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-align-left mr-2 text-purple-500"></i>
                                    Deskripsi (Opsional)
                                </label>
                                <textarea name="description"
                                    rows="4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus resize-none"
                                    placeholder="Tambahkan catatan tentang jadwal kerja"><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
                            </div>

                            <!-- Checkbox -->
                            <div class="flex items-center">
                                <input type="checkbox" name="is_published" id="publishCheck"
                                    class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                <label for="publishCheck" class="ml-2 text-sm text-gray-700">Terbitkan jadwal</label>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="flex justify-end">
                                <button type="submit"
                                    name="submit"
                                    class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-300 flex items-center gap-2">
                                    <i class="fas fa-plus-circle"></i>
                                    Tambahkan Jadwal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>

</html>
