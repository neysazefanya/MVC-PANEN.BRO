<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$work_schedule_id = $_GET['work_schedule_id'] ?? null;
if (!$work_schedule_id) {
    die('work_schedule_id tidak ditemukan!');
}
require_once './Model/absensi_model.php';
$absenceModel = new Absence();
$hasCheckIn = $absenceModel->hasCheckedInToday($work_schedule_id);
$hasCheckOut = $absenceModel->hasCheckedOutToday($work_schedule_id);

$schedule = $absenceModel->getScheduleById($work_schedule_id);
if (!$schedule) {
    die("Jadwal tidak ditemukan.");
}

$now = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
$finishTime = new DateTime($schedule['finish_day'], new DateTimeZone("Asia/Jakarta"));

if (!$hasCheckIn) {
    die("Anda belum melakukan check-in hari ini.");
}
if ($hasCheckOut) {
    die("Anda sudah melakukan check-out hari ini.");
}

$canCheckout = $now >= $finishTime;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-Out - Sistem Absensi</title>
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
                    <i class="fas fa-sign-out-alt text-white text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-white mb-1">Check-Out</h1>
                <p class="text-green-100 text-sm">ID: #<?= htmlspecialchars($work_schedule_id) ?></p>
            </div>

            <!-- Time Display -->
            <div class="glass rounded-xl p-3 mb-4 text-center border border-white/20">
                <div class="text-white font-bold" id="current-time"><?= date('H:i:s') ?></div>
                <div class="text-green-200 text-xs"><?= date('d M Y') ?></div>
            </div>

            <!-- Form -->
            <form method="post" action="index.php?action=absensi-checkout-process" class="space-y-4">
                <input type="hidden" name="work_schedule_id" value="<?= htmlspecialchars($work_schedule_id) ?>">
                
                <!-- Notes -->
                <div>
                    <label class="block text-white text-sm font-medium mb-2">
                        <i class="fas fa-sticky-note mr-1 text-lime-300"></i> Catatan Kerja
                    </label>
                    <textarea 
                        name="notes" 
                        rows="3" 
                        class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-green-200 focus:outline-none focus:ring-2 focus:ring-green-400 text-sm backdrop-blur-sm"
                        placeholder="Laporan kerja hari ini..."
                    ></textarea>
                </div>

                <!-- Status & Quantity in one row -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-white text-sm font-medium mb-2">
                            <i class="fas fa-tasks mr-1 text-emerald-300"></i> Status
                        </label>
                        <select 
                            name="status_of_duty" 
                            class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-400 text-sm backdrop-blur-sm"
                        >
                            <option value="1" class="bg-gray-800 text-white">✅ Selesai</option>
                            <option value="0" class="bg-gray-800 text-white">⏳ Belum</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white text-sm font-medium mb-2">
                            <i class="fas fa-hashtag mr-1 text-green-300"></i> Output
                        </label>
                        <input 
                            type="number" 
                            name="quantity" 
                            min="0" 
                            class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-green-200 focus:outline-none focus:ring-2 focus:ring-green-400 text-sm backdrop-blur-sm"
                            placeholder="Jumlah"
                        >
                    </div>
                </div>

                <!-- Submit Button or Warning -->
                <?php if ($canCheckout): ?>
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 group shadow-lg hover:shadow-xl"
                            id="checkout-btn">
                        <div class="flex items-center justify-center space-x-2">
                            <i class="fas fa-sign-out-alt group-hover:-rotate-12 transition-transform duration-300"></i>
                            <span>Check-Out</span>
                        </div>
                    </button>
                <?php else: ?>
                    <div class="bg-gradient-to-r from-yellow-500/20 to-amber-500/20 border border-yellow-400/40 rounded-lg p-4 text-center backdrop-blur-sm">
                        <i class="fas fa-clock text-yellow-300 text-xl mb-2"></i>
                        <div class="text-white text-sm">Tersedia setelah <strong class="text-yellow-300"><?= $finishTime->format('H:i') ?></strong></div>
                        <div class="text-yellow-300 font-bold" id="countdown">
                            <?php
                            $diff = $finishTime->getTimestamp() - $now->getTimestamp();
                            if ($diff > 0) {
                                $hours = floor($diff / 3600);
                                $minutes = floor(($diff % 3600) / 60);
                                echo sprintf('%02d:%02d', $hours, $minutes);
                            }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            </form>

            <!-- Footer -->
            <div class="mt-4 pt-3 border-t border-white/20 text-center">
                <div class="text-green-200 text-xs">
                    <i class="fas fa-shield-alt text-green-300 mr-1"></i>
                    Data tersimpan aman
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

        function updateCountdown() {
            const finishTime = new Date('<?= $finishTime->format('Y-m-d H:i:s') ?>');
            const now = new Date();
            const diff = finishTime.getTime() - now.getTime();
            
            if (diff > 0) {
                const hours = Math.floor(diff / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const countdownElement = document.getElementById('countdown');
                if (countdownElement) {
                    countdownElement.textContent = hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0');
                }
            } else {
                location.reload();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateTime();
            setInterval(updateTime, 1000);
            
            <?php if (!$canCheckout): ?>
            updateCountdown();
            setInterval(updateCountdown, 60000);
            <?php endif; ?>
            
            const form = document.querySelector('form');
            const btn = document.getElementById('checkout-btn');
            
            if (form && btn) {
                form.addEventListener('submit', function() {
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                    btn.disabled = true;
                    btn.classList.add('opacity-75');
                });
            }

            // Auto-resize textarea
            const textarea = document.querySelector('textarea');
            if (textarea) {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = this.scrollHeight + 'px';
                });
            }
        });
    </script>
</body>
</html> 