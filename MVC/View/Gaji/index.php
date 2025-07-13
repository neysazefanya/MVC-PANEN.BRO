<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Gaji</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
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
                        <h1 class="text-3xl font-bold text-gray-900 flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                                <i data-feather="dollar-sign" class="w-6 h-6 text-white"></i>
                            </div>
                            <span>Manajemen Penggajian</span>
                        </h1>
                        <p class="mt-2 text-gray-600">Kelola pembayaran gaji karyawan dengan mudah</p>
                    </div>
                    
                    
                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-3 gap-4">
                        <?php 
                        $totalGaji = 0;
                        $totalDibayar = 0;
                        $totalBelum = 0;
                        
                        if (isset($gaji) && is_array($gaji)) {
                            foreach ($gaji as $g) {
                                $totalGaji += $g['total_wage'];
                                if ($g['is_paid']) {
                                    $totalDibayar += $g['total_wage'];
                                } else {
                                    $totalBelum += $g['total_wage'];
                                }
                            }
                        }
                        ?>
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Total Gaji</p>
                                    <p class="text-lg font-bold text-gray-900">Rp <?= number_format($totalGaji, 0, ',', '.') ?></p>
                                </div>
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i data-feather="credit-card" class="w-4 h-4 text-blue-600"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Sudah Dibayar</p>
                                    <p class="text-lg font-bold text-green-600">Rp <?= number_format($totalDibayar, 0, ',', '.') ?></p>
                                </div>
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i data-feather="check-circle" class="w-4 h-4 text-green-600"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Belum Dibayar</p>
                                    <p class="text-lg font-bold text-orange-600">Rp <?= number_format($totalBelum, 0, ',', '.') ?></p>
                                </div>
                                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                                    <i data-feather="clock" class="w-4 h-4 text-orange-600"></i>
                                </div>
                            </div>
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
                                <i data-feather="users" class="w-5 h-5 text-gray-600"></i>
                                <span class="text-lg font-semibold text-gray-900">Daftar Penggajian</span>
                            </div>
                            <div class="text-sm text-gray-500">
                                Total: <?= isset($gaji) && is_array($gaji) ? count($gaji) : 0 ?> karyawan
                            </div>
                        </div>
                        <button onclick="generateSalary()" 
                                class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-6 py-2.5 rounded-lg font-medium transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center space-x-2">
                            <i data-feather="zap" class="w-4 h-4"></i>
                            <span>Generate Otomatis</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Salary Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <?php if (isset($gaji) && is_array($gaji) && count($gaji) > 0): ?>
                    <!-- Table Header -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center space-x-2">
                            <i data-feather="list" class="w-5 h-5 text-gray-600"></i>
                            <h3 class="text-lg font-semibold text-gray-900">Data Penggajian</h3>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-900 w-16">#</th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-900">
                                        <div class="flex items-center space-x-2">
                                            <i data-feather="user" class="w-4 h-4"></i>
                                            <span>Karyawan</span>
                                        </div>
                                    </th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-900">
                                        <div class="flex items-center space-x-2">
                                            <i data-feather="briefcase" class="w-4 h-4"></i>
                                            <span>Role</span>
                                        </div>
                                    </th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-900">
                                        <div class="flex items-center space-x-2">
                                            <i data-feather="calendar" class="w-4 h-4"></i>
                                            <span>Hari Kerja</span>
                                        </div>
                                    </th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-900">
                                        <div class="flex items-center space-x-2">
                                            <i data-feather="dollar-sign" class="w-4 h-4"></i>
                                            <span>Upah/Hari</span>
                                        </div>
                                    </th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-900">
                                        <div class="flex items-center space-x-2">
                                            <i data-feather="calculator" class="w-4 h-4"></i>
                                            <span>Total</span>
                                        </div>
                                    </th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-900">Status</th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-900 w-32">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php $no = 1; foreach ($gaji as $g): ?>
                                    <tr class="hover:bg-gray-50 transition-colors group">
                                        <td class="py-4 px-6 text-sm text-gray-500">
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-medium">
                                                <?= $no++ ?>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                                                    <span class="text-white font-semibold text-sm">
                                                        <?= strtoupper(substr($g['user_name'], 0, 2)) ?>
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($g['user_name']) ?></div>
                                                    <div class="text-xs text-gray-500">Karyawan</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium inline-block">
                                                <?= htmlspecialchars($g['role_name']) ?>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center space-x-2">
                                                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                                    <i data-feather="calendar" class="w-4 h-4 text-gray-600"></i>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900"><?= $g['days_worked'] ?></div>
                                                    <div class="text-xs text-gray-500">hari</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="text-sm font-medium text-gray-900">
                                                Rp <?= number_format($g['daily_wage'], 0, ',', '.') ?>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="text-lg font-bold text-green-600">
                                                Rp <?= number_format($g['total_wage'], 0, ',', '.') ?>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex flex-col space-y-2">
                                                <!-- Request Status -->
                                                <div>
                                                    <?php if ($g['requested_by_employee']): ?>
                                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium flex items-center space-x-1 w-fit">
                                                            <i data-feather="bell" class="w-3 h-3"></i>
                                                            <span>Diminta</span>
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs font-medium">
                                                            Auto Generate
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                
                                                <!-- Payment Status -->
                                                <div>
                                                    <?php if ($g['is_paid']): ?>
                                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium flex items-center space-x-1 w-fit">
                                                            <i data-feather="check-circle" class="w-3 h-3"></i>
                                                            <span>Dibayar</span>
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-xs font-medium flex items-center space-x-1 w-fit pulse-animation">
                                                            <i data-feather="clock" class="w-3 h-3"></i>
                                                            <span>Menunggu</span>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <?php if (!$g['is_paid']): ?>
                                                <button onclick="confirmPayment(<?= $g['id'] ?>, '<?= htmlspecialchars($g['user_name']) ?>', '<?= number_format($g['total_wage'], 0, ',', '.') ?>')" 
                                                        class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105 flex items-center space-x-2">
                                                    <i data-feather="check" class="w-4 h-4"></i>
                                                    <span>Bayar</span>
                                                </button>
                                            <?php else: ?>
                                                <div class="flex items-center space-x-2 text-green-600">
                                                    <i data-feather="check-circle" class="w-4 h-4"></i>
                                                    <span class="text-sm font-medium">Selesai</span>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <!-- Empty State -->
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-feather="dollar-sign" class="w-8 h-8 text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data gaji</h3>
                        <p class="text-gray-500 mb-6">Generate gaji otomatis untuk memulai penggajian</p>
                        <button onclick="generateSalary()" 
                                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <i data-feather="zap" class="w-4 h-4 mr-2"></i>
                            Generate Gaji
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <!-- Payment Confirmation Modal -->
    <div id="paymentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4">
            <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full mx-auto mb-4">
                <i data-feather="dollar-sign" class="w-6 h-6 text-green-600"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Konfirmasi Pembayaran</h3>
            <p class="text-gray-600 text-center mb-4">Apakah Anda yakin ingin menandai gaji sebagai sudah dibayar?</p>
            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-gray-600">Karyawan:</span>
                    <span id="employeeName" class="font-medium text-gray-900"></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Total Gaji:</span>
                    <span id="totalAmount" class="font-bold text-green-600"></span>
                </div>
            </div>
            <div class="flex space-x-3">
                <button onclick="closePaymentModal()" 
                        class="flex-1 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                    Batal
                </button>
                <a id="paymentLink" href="#" 
                   class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-center">
                    Konfirmasi Bayar
                </a>
            </div>
        </div>
    </div>

    <script>
        // Initialize Feather Icons
        feather.replace();
        
        // Generate salary function
        function generateSalary() {
            if (confirm('Apakah Anda yakin ingin generate gaji otomatis untuk semua karyawan?')) {
                window.location.href = 'index.php?action=gaji-generate-all';
            }
        }
        
        // Payment confirmation
        function confirmPayment(salaryId, employeeName, totalAmount) {
            document.getElementById('paymentModal').classList.remove('hidden');
            document.getElementById('employeeName').textContent = employeeName;
            document.getElementById('totalAmount').textContent = 'Rp ' + totalAmount;
            document.getElementById('paymentLink').href = `index.php?action=gaji-bayar&id=${salaryId}`;
        }
        
        function closePaymentModal() {
            document.getElementById('paymentModal').classList.add('hidden');
        }
        
        // Close modal when clicking outside
        document.getElementById('paymentModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePaymentModal();
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