<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if ($_SESSION['user']['role'] !== 'karyawan') {
    header("Location: index.php?action=login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Status Pengajuan</title>
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

    .status-pending {
      background: linear-gradient(135deg, #ddd6fe, #c4b5fd);
      color: #6d28d9;
    }

    .pulse-animation {
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0%, 100% {
        opacity: 1;
      }
      50% {
        opacity: 0.7;
      }
    }
  </style>
</head>

<body>
  <div class="flex">
    <?php include __DIR__ . '../../Template/sidebarKaryawan.php'; ?>
    
    <main class="flex-1 p-8">
      <div class="glass">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-paper-plane mr-3 text-green-600"></i>
            Status Pengajuan
          </h2>
          <div class="text-gray-500 text-sm" id="currentTime"></div>
        </div>
        
        <div class="overflow-x-auto rounded-lg">
          <table class="min-w-full text-sm text-gray-700">
            <thead>
              <tr>
                <th class="px-6 py-4 text-left">No</th>
                <th class="px-6 py-4 text-left">Area Kerja</th>
                <th class="px-6 py-4 text-left">Deskripsi</th>
                <th class="px-6 py-4 text-left">Mulai</th>
                <th class="px-6 py-4 text-left">Selesai</th>
                <th class="px-6 py-4 text-left">Status</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              <?php if (!empty($pengajuanSaya)): ?>
                <?php 
                $no = 1;
                foreach ($pengajuanSaya as $p): 
                ?>
                  <tr class="border-b">
                    <td class="px-6 py-4"><?= $no++ ?></td>
                    <td class="px-6 py-4 font-semibold"><?= htmlspecialchars($p['area_name']) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($p['description']) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($p['start_day']) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($p['finish_day']) ?></td>
                    <td class="px-6 py-4">
                      <?php
                      $status = htmlspecialchars($p['status']);
                      if ($status === 'pending') {
                        echo '<span class="status-badge status-pending pulse-animation">
                                <i class="fas fa-hourglass-half"></i>
                                Pending
                              </span>';
                      } elseif ($status === 'accepted') {
                        echo '<span class="status-badge status-success">
                                <i class="fas fa-check-circle"></i>
                                Diterima
                              </span>';
                      } elseif ($status === 'rejected') {
                        echo '<span class="status-badge status-danger">
                                <i class="fas fa-times-circle"></i>
                                Ditolak
                              </span>';
                      } else {
                        echo '<span class="status-badge status-warning">
                                <i class="fas fa-question-circle"></i>
                                ' . htmlspecialchars($status) . '
                              </span>';
                      }
                      ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-inbox text-3xl text-gray-400 mb-4"></i>
                    <p class="text-xl font-semibold">Belum Ada Pengajuan</p>
                    <p class="text-sm mt-2">Anda belum mengajukan jadwal kerja apapun</p>
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <!-- Summary Cards -->
        <?php if (!empty($pengajuanSaya)): ?>
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-8">
            <?php
            $totalPengajuan = count($pengajuanSaya);
            $pending = array_filter($pengajuanSaya, fn($p) => $p['status'] === 'pending');
            $accepted = array_filter($pengajuanSaya, fn($p) => $p['status'] === 'accepted');
            $rejected = array_filter($pengajuanSaya, fn($p) => $p['status'] === 'rejected');
            ?>
            
            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center">
              <div class="text-2xl font-bold text-white"><?= $totalPengajuan ?></div>
              <div class="text-sm text-gray-200">Total Pengajuan</div>
              <i class="fas fa-paper-plane text-blue-300 text-xl mt-2"></i>
            </div>
            
            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center">
              <div class="text-2xl font-bold text-purple-300"><?= count($pending) ?></div>
              <div class="text-sm text-gray-200">Pending</div>
              <i class="fas fa-hourglass-half text-purple-300 text-xl mt-2"></i>
            </div>
            
            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center">
              <div class="text-2xl font-bold text-green-300"><?= count($accepted) ?></div>
              <div class="text-sm text-gray-200">Diterima</div>
              <i class="fas fa-check-circle text-green-300 text-xl mt-2"></i>
            </div>
            
            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center">
              <div class="text-2xl font-bold text-red-300"><?= count($rejected) ?></div>
              <div class="text-sm text-gray-200">Ditolak</div>
              <i class="fas fa-times-circle text-red-300 text-xl mt-2"></i>
            </div>
          </div>
        <?php endif; ?>
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

    // Add row click animation
    document.addEventListener('DOMContentLoaded', function() {
      const rows = document.querySelectorAll('tbody tr');
      rows.forEach(row => {
        row.addEventListener('click', function() {
          this.style.transform = 'scale(1.02)';
          setTimeout(() => {
            this.style.transform = 'scale(1)';
          }, 150);
        });
      });
    });
  </script>
</body>
</html>