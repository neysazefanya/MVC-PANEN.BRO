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
  <title>Jadwal Terbuka</title>
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
    }

    .btn-green:hover {
      background: linear-gradient(135deg, #065f46, #15803d);
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(34, 197, 94, 0.3);
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
      background: linear-gradient(135deg, #dcfce7, #bbf7d0);
      color: #166534;
      padding: 0.5rem 1rem;
      border-radius: 12px;
      font-size: 0.9rem;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }
  </style>
</head>

<body>
  <div class="flex">
    <?php include __DIR__ . '../../Template/sidebarKaryawan.php'; ?>

    <main class="flex-1 p-8">


      <div class="glass">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-2xl font-bold text-gray-800">Jadwal Kerja Tersedia</h2>
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
                <th class="px-6 py-4 text-left">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              <?php if (!empty($jadwalTersedia)): ?>
                <?php $no = 1; ?>
                <?php foreach ($jadwalTersedia as $j): ?>
                  <tr class="border-b">
                    <td class="px-6 py-4"><?= $no++ ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($j['area_name']) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($j['description']) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($j['start_day']) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($j['finish_day']) ?></td>
                    <td class="px-6 py-4">
                      <button
                        class="btn-green"
                        data-bs-toggle="modal"
                        data-bs-target="#detailModal"
                        data-id="<?= $j['id'] ?>"
                        data-area="<?= htmlspecialchars($j['area_name']) ?>"
                        data-description="<?= htmlspecialchars($j['description']) ?>"
                        data-start="<?= htmlspecialchars($j['start_day']) ?>"
                        data-finish="<?= htmlspecialchars($j['finish_day']) ?>"
                        data-status="<?= htmlspecialchars($j['status'] ?? '') ?>"
                      >
                        <i class="fas fa-info-circle"></i> Detail
                      </button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-calendar-times text-3xl text-gray-400 mb-4"></i>
                    <p class="text-xl font-semibold">Belum Ada Jadwal Tersedia</p>
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content glass">
        <div class="modal-header gradient-green text-white border-0">
          <h5 class="modal-title"><i class="fas fa-info-circle me-2"></i> Detail Jadwal</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p><strong>Area:</strong> <span id="modalArea"></span></p>
          <p><strong>Deskripsi:</strong> <span id="modalDescription"></span></p>
          <p><strong>Mulai:</strong> <span id="modalStart"></span></p>
          <p><strong>Selesai:</strong> <span id="modalFinish"></span></p>
          <div id="modalAction" class="mt-4"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-green" data-bs-dismiss="modal">
            <i class="fas fa-times"></i> Tutup
          </button>
        </div>
      </div>
    </div>
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

    // Modal logic
    const detailModal = document.getElementById('detailModal');
    detailModal.addEventListener('show.bs.modal', event => {
      const btn = event.relatedTarget;
      document.getElementById('modalArea').textContent = btn.dataset.area;
      document.getElementById('modalDescription').textContent = btn.dataset.description;
      document.getElementById('modalStart').textContent = btn.dataset.start;
      document.getElementById('modalFinish').textContent = btn.dataset.finish;

      const id = parseInt(btn.dataset.id);
      const status = btn.dataset.status;
      const applied = <?= json_encode($appliedIds ?? []); ?>;

      const modalAction = document.getElementById('modalAction');
      modalAction.innerHTML = '';

      if (status === 'diterima') {
        modalAction.innerHTML = `
          <div class="status-badge">
            <i class="fas fa-check-circle"></i> Lamaran Diterima
          </div>`;
      } else if (applied.includes(id)) {
        modalAction.innerHTML = `
          <div class="status-badge">
            <i class="fas fa-hourglass-half"></i> Menunggu Konfirmasi
          </div>`;
      } else {
        modalAction.innerHTML = `
          <a href="index.php?action=apply&schedule_id=${id}" class="btn-green">
            <i class="fas fa-paper-plane"></i> Ajukan Lamaran
          </a>`;
      }
    });
  </script>
</body>
</html>
