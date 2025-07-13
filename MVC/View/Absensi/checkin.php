<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$work_schedule_id = $_GET['work_schedule_id'] ?? null;
if (!$work_schedule_id) {
    die('work_schedule_id tidak ditemukan!');
}
$checkin_time = date('Y-m-d H:i:s');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-In - Sistem Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes pulse-glow { 0%, 100% { box-shadow: 0 0 20px rgba(34, 197, 94, 0.5); } 50% { box-shadow: 0 0 30px rgba(34, 197, 94, 0.8); } }
        .glass { background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.25); }
        .animate-fade-in { animation: fadeIn 0.6s ease-out; }
        .animate-pulse-glow { animation: pulse-glow 2s infinite; }
        .green-gradient { background: linear-gradient(135deg, #15803d 0%, #22c55e 50%, #065f46 100%); }
    </style>
</head>
<body class="min-h-screen green-gradient flex items-center justify-center p-4">
    <!-- Background -->
    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute top-0 -left-4 w-72 h-72 bg-green-400 rounded-full mix-blend-multiply filter blur-xl opacity-30"></div>
        <div class="absolute -bottom-8 -right-4 w-72 h-72 bg-emerald-400 rounded-full mix-blend-multiply filter blur-xl opacity-30"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-lime-400 rounded-full mix-blend-multiply filter blur-xl opacity-20"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        <!-- Main Card -->
        <div class="glass rounded-3xl shadow-2xl p-6 animate-fade-in">
            <!-- Header -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full mb-3 animate-pulse-glow">
                    <i class="fas fa-fingerprint text-white text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-white mb-1">Check-In</h1>
                <p class="text-green-100 text-sm">Sistem Absensi Digital</p>
            </div>

            <!-- Time & Schedule Info in Grid -->
            <div class="grid grid-cols-2 gap-3 mb-6">
                <!-- Time Display -->
                <div class="glass rounded-xl p-3 text-center border border-white/20">
                    <div class="text-green-100 text-xs mb-1">Waktu</div>
                    <div class="text-lg font-bold text-white" id="current-time">
                        <?= date('H:i:s', strtotime($checkin_time)) ?>
                    </div>
                    <div class="text-green-200 text-xs"><?= date('d M Y', strtotime($checkin_time)) ?></div>
                </div>

                <!-- Schedule Info -->
                <div class="bg-gradient-to-r from-green-600/30 to-emerald-600/30 border border-green-400/40 rounded-xl p-3">
                    <div class="text-center">
                        <div class="text-green-200 text-xs mb-1">ID Jadwal</div>
                        <div class="text-white font-bold text-sm">#<?= htmlspecialchars($work_schedule_id) ?></div>
                        <i class="fas fa-calendar-alt text-green-300 text-lg mt-1"></i>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form method="post" action="index.php?action=absensi-checkin-process" class="mb-4">
                <input type="hidden" name="work_schedule_id" value="<?= htmlspecialchars($work_schedule_id) ?>">
                <input type="hidden" name="checkin_time" value="<?= htmlspecialchars($checkin_time) ?>">
                
                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 group relative overflow-hidden shadow-lg hover:shadow-xl"
                        id="checkin-btn">
                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 transform -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                    <div class="flex items-center justify-center space-x-3 relative z-10">
                        <i class="fas fa-sign-in-alt text-xl group-hover:rotate-12 transition-transform duration-300"></i>
                        <span class="text-lg">Lakukan Check-In</span>
                    </div>
                </button>
            </form>

            <!-- Feature Cards & Security Info in one row -->
            <div class="grid grid-cols-4 gap-2 items-center">
                <div class="glass rounded-lg p-2 text-center text-white hover:scale-105 transition-transform duration-300 hover:bg-white/20">
                    <i class="fas fa-user-check text-green-300 text-sm mb-1"></i>
                    <div class="text-xs">Hadir</div>
                </div>
                <div class="glass rounded-lg p-2 text-center text-white hover:scale-105 transition-transform duration-300 hover:bg-white/20">
                    <i class="fas fa-chart-line text-lime-300 text-sm mb-1"></i>
                    <div class="text-xs">Track</div>
                </div>
                <div class="glass rounded-lg p-2 text-center text-white hover:scale-105 transition-transform duration-300 hover:bg-white/20">
                    <i class="fas fa-mobile-alt text-emerald-300 text-sm mb-1"></i>
                    <div class="text-xs">Mobile</div>
                </div>
                <div class="glass rounded-lg p-2 text-center text-white hover:bg-white/20">
                    <i class="fas fa-shield-alt text-green-300 text-sm mb-1"></i>
                    <div class="text-xs">Aman</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateTime() {
            const now = new Date();
            document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID', {
                hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateTime();
            setInterval(updateTime, 1000);
            
            document.querySelector('form').addEventListener('submit', function() {
                const btn = document.getElementById('checkin-btn');
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                btn.disabled = true;
                btn.classList.add('opacity-75');
            });
        });
    </script>
</body>
</html>