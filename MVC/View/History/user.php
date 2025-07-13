<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Riwayat Saya</title>
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

    .status-info {
      background: linear-gradient(135deg, #dbeafe, #bfdbfe);
      color: #1e40af;
    }

    .status-warning {
      background: linear-gradient(135deg, #fef3c7, #fde68a);
      color: #92400e;
    }

    .money-highlight {
      background: linear-gradient(135deg, #fef3c7, #fde68a);
      color: #92400e;
      padding: 0.25rem 0.75rem;
      border-radius: 8px;
      font-weight: 700;
    }

    .date-badge {
      background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
      color: #3730a3;
      padding: 0.25rem 0.75rem;
      border-radius: 8px;
      font-weight: 600;
      font-size: 0.8rem;
    }

    .notes-box {
      background: rgba(255, 255, 255, 0.1);
      border-left: 4px solid #22c55e;
      padding: 0.5rem;
      border-radius: 4px;
      font-style: italic;
      color: #6b7280;
    }

    .timeline-dot {
      width: 12px;
      height: 12px;
      background: linear-gradient(135deg, #15803d, #22c55e);
      border-radius: 50%;
      display: inline-block;
      margin-right: 8px;
      box-shadow: 0 0 10px rgba(34, 197, 94, 0.5);
    }

    .fade-in {
      animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
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
            <i class="fas fa-history mr-3 text-green-600"></i>
            Riwayat Kerja Saya
          </h2>
          <div class="text-gray-500 text-sm" id="currentTime"></div>
        </div>
        
        <div class="overflow-x-auto rounded-lg">
          <table class="min-w-full text-sm text-gray-700">
            <thead>
              <tr>
                <th class="px-6 py-4 text-left">No</th>
                <th class="px-6 py-4 text-left">Jadwal</th>
                <th class="px-6 py-4 text-left">Absensi</th>
                <th class="px-6 py-4 text-left">Catatan</th>
                <th class="px-6 py-4 text-left">Gaji</th>
                <th class="px-6 py-4 text-left">Tanggal</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              <?php if (!empty($riwayats)): ?>
                <?php 
                $no = 1; 
                $totalGaji = 0;
                foreach ($riwayats as $r): 
                  $totalGaji += $r['salary'];
                ?>
                  <tr class="border-b fade-in">
                    <td class="px-6 py-4">
                      <div class="flex items-center">
                        <span class="timeline-dot"></span>
                        <span class="font-semibold"><?= $no++ ?></span>
                      </div>
                    </td>
                    <td class="px-6 py-4">
                      <div class="flex items-start space-x-2">
                        <i class="fas fa-briefcase text-blue-600 mt-1"></i>
                        <div>
                          <span class="font-semibold text-gray-900 block">
                            <?= htmlspecialchars($r['schedule_desc']) ?>
                          </span>
                          <span class="text-xs text-gray-500">Tugas Kerja</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4">
                      <?php
                      $absensi = htmlspecialchars($r['absensi']);
                      if (strtolower($absensi) === 'hadir' || strtolower($absensi) === 'present') {
                        echo '<span class="status-badge status-success">
                                <i class="fas fa-check-circle"></i>
                                Hadir
                              </span>';
                      } elseif (strtolower($absensi) === 'terlambat' || strtolower($absensi) === 'late') {
                        echo '<span class="status-badge status-warning">
                                <i class="fas fa-clock"></i>
                                Terlambat
                              </span>';
                      } else {
                        echo '<span class="status-badge status-info">
                                <i class="fas fa-info-circle"></i>
                                ' . $absensi . '
                              </span>';
                      }
                      ?>
                    </td>
                    <td class="px-6 py-4">
                      <?php if (!empty($r['notes'])): ?>
                        <div class="notes-box">
                          <i class="fas fa-sticky-note text-yellow-600 mr-2"></i>
                          <?= htmlspecialchars($r['notes']) ?>
                        </div>
                      <?php else: ?>
                        <span class="text-gray-400 italic">
                          <i class="fas fa-minus"></i> Tidak ada catatan
                        </span>
                      <?php endif; ?>
                    </td>
                    <td class="px-6 py-4">
                      <div class="flex items-center space-x-2">
                        <i class="fas fa-coins text-yellow-600"></i>
                        <span class="money-highlight">
                          Rp <?= number_format($r['salary'], 0, ',', '.') ?>
                        </span>
                      </div>
                    </td>
                    <td class="px-6 py-4">
                      <div class="flex items-center space-x-2">
                        <i class="fas fa-calendar-alt text-purple-600"></i>
                        <span class="date-badge">
                          <?= date('d M Y', strtotime($r['created_at'])) ?>
                        </span>
                      </div>
                      <div class="text-xs text-gray-500 mt-1">
                        <?= date('H:i', strtotime($r['created_at'])) ?> WIB
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-history text-3xl text-gray-400 mb-4"></i>
                    <p class="text-xl font-semibold">Belum Ada Riwayat Kerja</p>
                    <p class="text-sm mt-2">Riwayat kerja Anda akan muncul di sini setelah menyelesaikan tugas</p>
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <!-- Summary Cards -->
        <?php if (!empty($riwayats)): ?>
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-8">
            <?php
            $totalRiwayat = count($riwayats);
            $hadirCount = count(array_filter($riwayats, fn($r) => strtolower($r['absensi']) === 'hadir' || strtolower($r['absensi']) === 'present'));
            $terlambatCount = count(array_filter($riwayats, fn($r) => strtolower($r['absensi']) === 'terlambat' || strtolower($r['absensi']) === 'late'));
            $rataRataGaji = $totalGaji / max($totalRiwayat, 1);
            ?>
            
            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center">
              <div class="text-2xl font-bold text-white"><?= $totalRiwayat ?></div>
              <div class="text-sm text-gray-200">Total Riwayat</div>
              <i class="fas fa-list text-blue-300 text-xl mt-2"></i>
            </div>
            
            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center">
              <div class="text-2xl font-bold text-green-300"><?= $hadirCount ?></div>
              <div class="text-sm text-gray-200">Kehadiran</div>
              <i class="fas fa-check-circle text-green-300 text-xl mt-2"></i>
            </div>
            
            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center">
              <div class="text-2xl font-bold text-yellow-300"><?= $terlambatCount ?></div>
              <div class="text-sm text-gray-200">Terlambat</div>
              <i class="fas fa-clock text-yellow-300 text-xl mt-2"></i>
            </div>
            
            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center">
              <div class="text-2xl font-bold text-purple-300">
                Rp <?= number_format($rataRataGaji, 0, ',', '.') ?>
              </div>
              <div class="text-sm text-gray-200">Rata-rata Gaji</div>
              <i class="fas fa-chart-bar text-purple-300 text-xl mt-2"></i>
            </div>
          </div>

          <!-- Performance Summary -->
          <div class="mt-6 bg-gradient-to-r from-green-600 to-emerald-600 rounded-lg p-6 text-white">
            <div class="flex justify-between items-center">
              <div>
                <h3 class="text-lg font-semibold mb-2">
                  <i class="fas fa-chart-line mr-2"></i>
                  Ringkasan Performa
                </h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                  <div>
                    <span class="text-green-200">Tingkat Kehadiran:</span>
                    <span class="font-bold ml-2">
                      <?= $totalRiwayat > 0 ? round(($hadirCount / $totalRiwayat) * 100, 1) : 0 ?>%
                    </span>
                  </div>
                  <div>
                    <span class="text-green-200">Total Pendapatan:</span>
                    <span class="font-bold ml-2">Rp <?= number_format($totalGaji, 0, ',', '.') ?></span>
                  </div>
                </div>
              </div>
              <div class="text-right">
                <div class="text-3xl font-bold">
                  <?= $totalRiwayat ?>
                </div>
                <div class="text-green-200 text-sm">Hari Kerja</div>
              </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="mt-4">
              <div class="flex justify-between text-sm mb-1">
                <span>Tingkat Kehadiran</span>
                <span><?= $totalRiwayat > 0 ? round(($hadirCount / $totalRiwayat) * 100, 1) : 0 ?>%</span>
              </div>
              <div class="w-full bg-green-800 rounded-full h-2">
                <div class="bg-white h-2 rounded-full transition-all duration-500" 
                     style="width: <?= $totalRiwayat > 0 ? ($hadirCount / $totalRiwayat) * 100 : 0 ?>%"></div>
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

    // Add row click animation and stagger animation for rows
    document.addEventListener('DOMContentLoaded', function() {
      const rows = document.querySelectorAll('tbody tr');
      
      // Stagger animation for rows
      rows.forEach((row, index) => {
        if (!row.querySelector('.fas.fa-history')) { // Skip empty state row
          row.style.animationDelay = `${index * 0.1}s`;
        }
      });

      // Row click animation
      rows.forEach(row => {
        row.addEventListener('click', function() {
          this.style.transform = 'scale(1.02)';
          setTimeout(() => {
            this.style.transform = 'scale(1)';
          }, 150);
        });
      });

      // Animate progress bar
      const progressBar = document.querySelector('.bg-white.h-2');
      if (progressBar) {
        setTimeout(() => {
          progressBar.style.width = progressBar.style.width;
        }, 1000);
      }
    });
  </script>
</body>
</html>