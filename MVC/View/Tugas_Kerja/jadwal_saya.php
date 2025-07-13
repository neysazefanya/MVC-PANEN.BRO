<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if ($_SESSION['user']['role'] !== 'karyawan') {
    header("Location: index.php?action=login");
    exit;
}
require_once './Model/absensi_model.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Jadwal Saya</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #0f172a, #1e293b);
      background-attachment: fixed;
      background-size: 400% 400%;
      animation: gradientMove 20s ease infinite;
      min-height: 100vh;
    }

    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .gradient-green {
      background: linear-gradient(135deg, #15803d 0%, #22c55e 50%, #065f46 100%);
    }

    .gradient-green-text {
      background: linear-gradient(135deg, #15803d, #22c55e, #065f46);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .btn-green {
      background: linear-gradient(135deg, #15803d, #22c55e);
      color: #fff;
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      text-decoration: none;
    }

    .btn-green:hover {
      background: linear-gradient(135deg, #065f46, #15803d);
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(34, 197, 94, 0.3);
      color: #fff;
    }

    .btn-warning {
      background: linear-gradient(135deg, #f59e0b, #fbbf24);
      color: #fff;
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      text-decoration: none;
    }

    .btn-warning:hover {
      background: linear-gradient(135deg, #d97706, #f59e0b);
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(251, 191, 36, 0.3);
      color: #fff;
    }

    .btn-danger {
      background: linear-gradient(135deg, #dc2626, #ef4444);
      color: #fff;
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      text-decoration: none;
    }

    .btn-danger:hover {
      background: linear-gradient(135deg, #b91c1c, #dc2626);
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(239, 68, 68, 0.3);
      color: #fff;
    }

    .glass {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border-radius: 16px;
      padding: 2rem;
    }

    table thead {
      background: linear-gradient(135deg, #15803d, #22c55e);
      color: white;
    }

    table tbody tr:hover {
      background: rgba(34, 197, 94, 0.1);
      cursor: pointer;
    }

    .status-badge {
      padding: 0.5rem 1rem;
      border-radius: 12px;
      font-size: 0.9rem;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .status-success {
      background: linear-gradient(135deg, #dcfce7, #bbf7d0);
      color: #166534;
    }

    .status-warning {
      background: linear-gradient(135deg, #fef3c7, #fde68a);
      color: #92400e;
    }

    .status-danger {
      background: linear-gradient(135deg, #fee2e2, #fecaca);
      color: #991b1b;
    }

    .status-secondary {
      background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
      color: #475569;
    }

    .status-light {
      background: linear-gradient(135deg, #f8fafc, #f1f5f9);
      color: #334155;
    }

    .status-purple {
      background: linear-gradient(135deg, #f3e8ff, #e9d5ff);
      color: #7c3aed;
    }
  </style>
</head>

<body>
  <div class="flex">
    <?php include __DIR__ . '../../Template/sidebarKaryawan.php'; ?>
    
    <main class="flex-1 p-8">
      <div class="glass">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-2xl font-bold text-gray-800">Jadwal Kerja Saya</h2>
          <div class="text-gray-500 text-sm" id="currentTime"></div>
        </div>
        
        <div class="overflow-x-auto rounded-lg">
          <table class="min-w-full text-sm text-gray-700">
            <thead>
              <tr>
                <th class="px-6 py-4 text-left">No</th>
                <th class="px-6 py-4 text-left">Area Kerja</th>
                <th class="px-6 py-4 text-left">Deskripsi</th>
                <th class="px-6 py-4 text-left">Peran</th>
                <th class="px-6 py-4 text-left">Status</th>
                <th class="px-6 py-4 text-left">Mulai</th>
                <th class="px-6 py-4 text-left">Selesai</th>
                <th class="px-6 py-4 text-left">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              <?php if (!empty($jadwalsaya)): ?>
                <?php
                $absenceModel = new Absence();
                $now = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
                $no = 1;
                foreach ($jadwalsaya as $j):
                  $hasCheckIn  = $absenceModel->hasCheckedInToday($j['id']);
                  $hasCheckOut = $absenceModel->hasCheckedOutToday($j['id']);
                  $startTime   = new DateTime($j['start_day'], new DateTimeZone("Asia/Jakarta"));
                  $finishTime  = new DateTime($j['finish_day'], new DateTimeZone("Asia/Jakarta"));
                ?>
                  <tr class="border-b">
                    <td class="px-6 py-4"><?= $no++ ?></td>
                    <td class="px-6 py-4 font-semibold"><?= htmlspecialchars($j['area_name']) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($j['description']) ?></td>
                    <td class="px-6 py-4">
                      <span class="status-badge status-purple">
                        <i class="fas fa-user-tag"></i>
                        <?= htmlspecialchars($j['choice_of_role']) ?>
                      </span>
                    </td>
                    <td class="px-6 py-4">
                      <span class="status-badge status-success">
                        <i class="fas fa-check-circle"></i>
                        <?= htmlspecialchars($j['status']) ?>
                      </span>
                    </td>
                    <td class="px-6 py-4"><?= htmlspecialchars($j['start_day']) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($j['finish_day']) ?></td>
                    <td class="px-6 py-4">
                      <?php
                      if (!$hasCheckIn) {
                        $checkinLateThreshold = clone $startTime;
                        $checkinLateThreshold->modify('+5 minutes');

                        if ($now < $startTime) {
                          echo '<span class="status-badge status-secondary">
                                  <i class="fas fa-clock"></i> 
                                  Belum Waktu Check-In
                                </span>';
                        } elseif ($now > $finishTime) {
                          echo '<span class="status-badge status-danger">
                                  <i class="fas fa-times-circle"></i> 
                                  Lewat Waktu Check-In
                                </span>';
                        } elseif ($now >= $startTime && $now <= $checkinLateThreshold) {
                          echo '<a href="index.php?action=absensi-checkin-form&work_schedule_id=' . $j['id'] . '" 
                                  class="btn-green">
                                  <i class="fas fa-sign-in-alt"></i> 
                                  Check-In
                                </a>';
                        } else {
                          echo '<a href="index.php?action=absensi-checkin-form&work_schedule_id=' . $j['id'] . '&late=1" 
                                  class="btn-danger">
                                  <i class="fas fa-exclamation-triangle"></i> 
                                  Lewat Waktu Check-In
                                </a>';
                        }
                      } elseif ($hasCheckIn && !$hasCheckOut) {
                        if ($now < $finishTime) {
                          echo '<span class="status-badge status-secondary">
                                  <i class="fas fa-clock"></i> 
                                  Belum Waktu Check-Out
                                </span>';
                        } elseif ($now > $finishTime->modify('+4 hours')) {
                          echo '<span class="status-badge status-danger">
                                  <i class="fas fa-times-circle"></i> 
                                  Lewat Waktu Check-Out
                                </span>';
                        } else {
                          echo '<a href="index.php?action=absensi-checkout-form&work_schedule_id=' . $j['id'] . '" 
                                  class="btn-warning">
                                  <i class="fas fa-sign-out-alt"></i> 
                                  Check-Out
                                </a>';
                        }
                      } else {
                        echo '<span class="status-badge status-success">
                                <i class="fas fa-check-circle"></i> 
                                Selesai
                              </span>';
                      }
                      ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-info-circle text-3xl text-gray-400 mb-4"></i>
                    <p class="text-xl font-semibold">Belum Ada Jadwal Kerja</p>
                    <p class="text-sm mt-2">Silakan tunggu jadwal kerja dari admin</p>
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>

  <script>
    // Clock
    function updateTime() {
      const now = new Date();
      document.getElementById('currentTime').textContent =
        now.toLocaleTimeString('id-ID') + ' | ' + now.toLocaleDateString('id-ID');
    }
    setInterval(updateTime, 1000);
    updateTime();

    // Add loading states for buttons
    document.addEventListener('DOMContentLoaded', function() {
      const buttons = document.querySelectorAll('a[href*="absensi"]');
      buttons.forEach(button => {
        button.addEventListener('click', function() {
          const originalContent = this.innerHTML;
          this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
          this.style.pointerEvents = 'none';
          
          // Restore after navigation (in case of back button)
          setTimeout(() => {
            this.innerHTML = originalContent;
            this.style.pointerEvents = 'auto';
          }, 2000);
        });
      });
    });
  </script>
</body>
</html>