<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Rincian Gaji Saya</title>
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

    .status-info {
      background: linear-gradient(135deg, #dbeafe, #bfdbfe);
      color: #1e40af;
    }

    .status-secondary {
      background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
      color: #475569;
    }

    .money-highlight {
      background: linear-gradient(135deg, #fef3c7, #fde68a);
      color: #92400e;
      padding: 0.25rem 0.75rem;
      border-radius: 8px;
      font-weight: 700;
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

    .shimmer {
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      background-size: 200% 100%;
      animation: shimmer 1.5s infinite;
    }

    @keyframes shimmer {
      0% { background-position: -200% 0; }
      100% { background-position: 200% 0; }
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
            <i class="fas fa-money-bill-wave mr-3 text-green-600"></i>
            Rincian Gaji Saya
          </h2>
          <div class="text-gray-500 text-sm" id="currentTime"></div>
        </div>
        
        <div class="overflow-x-auto rounded-lg">
          <table class="min-w-full text-sm text-gray-700">
            <thead>
              <tr>
                <th class="px-6 py-4 text-left">No</th>
                <th class="px-6 py-4 text-left">Role</th>
                <th class="px-6 py-4 text-left">Hari Kerja</th>
                <th class="px-6 py-4 text-left">Upah / Hari</th>
                <th class="px-6 py-4 text-left">Total</th>
                <th class="px-6 py-4 text-left">Status</th>
                <th class="px-6 py-4 text-left">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              <?php if (isset($gajiSaya) && is_array($gajiSaya)): ?>
                <?php 
                $no = 1; 
                $totalGaji = 0;
                $totalHari = 0;
                foreach ($gajiSaya as $g): 
                  $totalGaji += $g['total_wage'];
                  $totalHari += $g['days_worked'];
                ?>
                  <tr class="border-b">
                    <td class="px-6 py-4"><?= $no++ ?></td>
                    <td class="px-6 py-4">
                      <div class="flex items-center space-x-2">
                        <i class="fas fa-user-tie text-blue-600"></i>
                        <span class="font-semibold"><?= htmlspecialchars($g['role_name']) ?></span>
                      </div>
                    </td>
                    <td class="px-6 py-4">
                      <div class="flex items-center space-x-2">
                        <i class="fas fa-calendar-day text-purple-600"></i>
                        <span class="font-medium"><?= $g['days_worked'] ?> hari</span>
                      </div>
                    </td>
                    <td class="px-6 py-4">
                      <span class="money-highlight">
                        Rp <?= number_format($g['daily_wage'], 0, ',', '.') ?>
                      </span>
                    </td>
                    <td class="px-6 py-4">
                      <div class="flex items-center space-x-2">
                        <i class="fas fa-coins text-yellow-600"></i>
                        <span class="font-bold text-lg text-green-700">
                          Rp <?= number_format($g['total_wage'], 0, ',', '.') ?>
                        </span>
                      </div>
                    </td>
                    <td class="px-6 py-4">
                      <?php
                      if ($g['is_paid']) {
                        echo '<span class="status-badge status-success">
                                <i class="fas fa-check-circle"></i>
                                Sudah Dibayar
                              </span>';
                      } elseif ($g['requested_by_employee']) {
                        echo '<span class="status-badge status-info pulse-animation">
                                <i class="fas fa-hourglass-half"></i>
                                Menunggu Pencairan
                              </span>';
                      } else {
                        echo '<span class="status-badge status-secondary">
                                <i class="fas fa-clock"></i>
                                Belum Diminta
                              </span>';
                      }
                      ?>
                    </td>
                    <td class="px-6 py-4">
                      <?php if (!$g['is_paid'] && !$g['requested_by_employee']): ?>
                        <a href="index.php?action=gaji-tarik&id=<?= $g['id'] ?>" class="btn-warning">
                          <i class="fas fa-hand-holding-usd"></i>
                          Ajukan Penarikan
                        </a>
                      <?php elseif ($g['is_paid']): ?>
                        <span class="status-badge status-success">
                          <i class="fas fa-check-double"></i>
                          Selesai
                        </span>
                      <?php else: ?>
                        <span class="status-badge status-info shimmer">
                          <i class="fas fa-cog fa-spin"></i>
                          Diproses
                        </span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-wallet text-3xl text-gray-400 mb-4"></i>
                    <p class="text-xl font-semibold">Belum Ada Data Gaji</p>
                    <p class="text-sm mt-2">Anda belum memiliki riwayat gaji</p>
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <!-- Summary Cards -->
        <?php if (isset($gajiSaya) && is_array($gajiSaya) && !empty($gajiSaya)): ?>
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-8">
            <?php
            $totalPendapatan = array_sum(array_column($gajiSaya, 'total_wage'));
            $sudahDibayar = array_sum(array_map(fn($g) => $g['is_paid'] ? $g['total_wage'] : 0, $gajiSaya));
            $menungguPencairan = array_sum(array_map(fn($g) => $g['requested_by_employee'] && !$g['is_paid'] ? $g['total_wage'] : 0, $gajiSaya));
            $belumDiminta = $totalPendapatan - $sudahDibayar - $menungguPencairan;
            ?>
            
            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center">
              <div class="text-2xl font-bold text-white">
                Rp <?= number_format($totalPendapatan, 0, ',', '.') ?>
              </div>
              <div class="text-sm text-gray-200">Total Pendapatan</div>
              <i class="fas fa-chart-line text-blue-300 text-xl mt-2"></i>
            </div>
            
            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center">
              <div class="text-2xl font-bold text-green-300">
                Rp <?= number_format($sudahDibayar, 0, ',', '.') ?>
              </div>
              <div class="text-sm text-gray-200">Sudah Dibayar</div>
              <i class="fas fa-check-circle text-green-300 text-xl mt-2"></i>
            </div>
            
            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center">
              <div class="text-2xl font-bold text-blue-300">
                Rp <?= number_format($menungguPencairan, 0, ',', '.') ?>
              </div>
              <div class="text-sm text-gray-200">Menunggu Pencairan</div>
              <i class="fas fa-hourglass-half text-blue-300 text-xl mt-2"></i>
            </div>
            
            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center">
              <div class="text-2xl font-bold text-yellow-300">
                Rp <?= number_format($belumDiminta, 0, ',', '.') ?>
              </div>
              <div class="text-sm text-gray-200">Belum Diminta</div>
              <i class="fas fa-clock text-yellow-300 text-xl mt-2"></i>
            </div>
          </div>

          <!-- Total Summary -->
          <div class="mt-6 bg-gradient-to-r from-green-600 to-emerald-600 rounded-lg p-6 text-white">
            <div class="flex justify-between items-center">
              <div>
                <h3 class="text-lg font-semibold mb-2">Ringkasan Gaji</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                  <div>
                    <span class="text-green-200">Total Hari Kerja:</span>
                    <span class="font-bold ml-2"><?= $totalHari ?> hari</span>
                  </div>
                  <div>
                    <span class="text-green-200">Rata-rata per Hari:</span>
                    <span class="font-bold ml-2">Rp <?= number_format($totalPendapatan / max($totalHari, 1), 0, ',', '.') ?></span>
                  </div>
                </div>
              </div>
              <div class="text-right">
                <div class="text-3xl font-bold">
                  Rp <?= number_format($totalPendapatan, 0, ',', '.') ?>
                </div>
                <div class="text-green-200 text-sm">Total Pendapatan</div>
              </div>
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

    // Add loading states for buttons
    document.addEventListener('DOMContentLoaded', function() {
      const buttons = document.querySelectorAll('a[href*="gaji-tarik"]');
      buttons.forEach(button => {
        button.addEventListener('click', function() {
          const originalContent = this.innerHTML;
          this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
          this.style.pointerEvents = 'none';
          
          // Restore after navigation (in case of back button)
          setTimeout(() => {
            this.innerHTML = originalContent;
            this.style.pointerEvents = 'auto';
          }, 2000);
        });
      });

      // Add row click animation
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