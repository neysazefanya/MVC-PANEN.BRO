<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Area Kerja</title>
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
                                <span class="text-2xl">🛠️</span>
                                Tambah Area Kerja
                            </h2>
                            <p class="text-gray-600 mt-1">Menambahkan area kerja baru ke dalam sistem</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="index.php?action=area"
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
                        <form method="POST" class="space-y-6" id="areaForm">
                            <!-- Nama Area -->
                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-map-pin mr-2 text-green-500"></i>
                                    Nama atau Lokasi Area
                                </label>
                                <input type="text"
                                    name="name"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus transition-all duration-300 placeholder-gray-400"
                                    placeholder="Masukkan nama atau lokasi area kerja"
                                    value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>"
                                    required>
                                <p class="text-xs text-gray-500 mt-1">Contoh: Area Utama, Kebun Timur, dll.</p>
                            </div>

                            <!-- Ukuran Area -->
                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-ruler-combined mr-2 text-blue-500"></i>
                                    Ukuran Area
                                </label>
                                <div class="relative">
                                    <input type="number"
                                        name="size"
                                        step="0.1"
                                        min="0"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus transition-all duration-300 placeholder-gray-400"
                                        placeholder="Masukkan ukuran area"
                                        value="<?= isset($_POST['size']) ? htmlspecialchars($_POST['size']) : '' ?>"
                                        required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-500 text-sm">hektar</span>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Ukuran area dalam satuan hektar (contoh: 25.5)</p>
                            </div>

                            <!-- Jumlah Pohon -->
                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-tree mr-2 text-green-600"></i>
                                    Jumlah Pohon
                                </label>
                                <input type="number"
                                    name="quantity_of_trees"
                                    min="0"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus transition-all duration-300 placeholder-gray-400"
                                    placeholder="Masukkan jumlah pohon yang ada"
                                    value="<?= isset($_POST['quantity_of_trees']) ? htmlspecialchars($_POST['quantity_of_trees']) : '' ?>"
                                    required>
                                <p class="text-xs text-gray-500 mt-1">Jumlah total pohon yang terdapat di area ini</p>
                            </div>

                            <!-- Deskripsi -->
                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-align-left mr-2 text-purple-500"></i>
                                    type_of_soil
                                </label>
                                <input name="type_of_soil"
                                    rows="4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus transition-all duration-300 placeholder-gray-400 resize-none"
                                    placeholder="Tambahkan catatan atau keterangan tambahan tentang area kerja"><?= isset($_POST['type_of_soil']) ? htmlspecialchars($_POST['type_of_soil']) : '' ?></textarea>
                                <p class="text-xs text-gray-500 mt-1">Contoh: Area ini memiliki sistem irigasi otomatis</p>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="flex justify-end">
                                <button type="submit"
                                    name="submit"
                                    class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-300 flex items-center gap-2">
                                    <i class="fas fa-plus-circle"></i>
                                    Tambahkan Area
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