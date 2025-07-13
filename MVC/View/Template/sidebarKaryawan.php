<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Area Kerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            overflow-x: hidden;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        #sidebar {
            width: 280px;
            height: 100%;
            background: linear-gradient(135deg, #15803d 0%, #22c55e 50%, #065f46 100%);
            color: white;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        #sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            pointer-events: none;
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar-title {
            font-weight: 700;
            font-size: 22px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-title i {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px;
            border-radius: 50%;
            font-size: 16px;
        }

        .sidebar-subtitle {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 400;
        }


        .sidebar-nav {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px 0;
        }

        /* Custom scrollbar for sidebar-nav */
        .sidebar-nav::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #22c55e, #15803d);
            border-radius: 4px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #16a34a, #065f46);
        }

        .nav-section {
            margin-bottom: 25px;
        }

        .nav-section-title {
            font-size: 12px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.6);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            padding: 0 20px;
        }

        .nav-item {
            margin-bottom: 4px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 20px;
            margin: 0 8px;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 10px;
        }

        .nav-link:hover {
            color: white;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .nav-link:hover::before {
            opacity: 1;
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .nav-link.active::before {
            opacity: 1;
        }

        .nav-link i {
            width: 20px;
            margin-right: 15px;
            font-size: 16px;
            text-align: center;
        }

        .nav-link span {
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        .sidebar-footer {
            flex-shrink: 0;
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.1);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
        }

        .user-details h6 {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
        }

        .user-details small {
            color: rgba(255, 255, 255, 0.7);
            font-size: 12px;
        }

        .user-info {
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .user-info:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .user-info:active {
            background: rgba(255, 255, 255, 0.25);
            transform: translateX(2px);
        }

        .user-info h6,
        .user-info small {
            color: rgba(255, 255, 255, 0.9);
        }

        #logout-btn {
            background: linear-gradient(135deg, #16a34a, #15803d);
            border: none;
            padding: 12px 16px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            width: 100%;
            text-decoration: none;
        }

        #logout-btn:hover {
            background: linear-gradient(135deg, #15803d, #166534);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(22, 163, 74, 0.4);
            color: white;
        }

        #logout-btn i {
            font-size: 16px;
        }

        main {
            flex: 1;
            padding: 30px;
            background: #f8fafc;
        }

        @media (max-width: 768px) {
            #sidebar {
                width: 100%;
                position: fixed;
                left: -100%;
                z-index: 1000;
                transition: left 0.3s ease;
            }

            #sidebar.active {
                left: 0;
            }

            main {
                width: 100%;
            }
        }

        #sidebar::-webkit-scrollbar {
            width: 6px;
        }

        #sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        #sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        #sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <aside id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-title">
                    <i class="fas fa-cogs"></i>
                    Karyawan Panel
                </div>
                <div class="sidebar-subtitle">Sistem Perkebunan</div>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Menu Utama</div>
                    <div class="nav-item">
                        <a href="index.php?action=jadwal-terbuka" class="nav-link">
                            <i class="fas fa-calendar-plus"></i>
                            <span>Jadwal Kerja</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="index.php?action=jadwal-saya" class="nav-link">
                            <i class="fas fa-calendar-check"></i>
                            <span>Jadwal Saya</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="index.php?action=pengajuan-saya" class="nav-link">
                            <i class="fas fa-paper-plane"></i>
                            <span>Status Pengajuan</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="index.php?action=gaji-saya" class="nav-link">
                            <i class="fas fa-paper-plane"></i>
                            <span>Gaji</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="index.php?action=riwayat-saya" class="nav-link">
                            <i class="fas fa-chart-bar"></i>
                            <span>History</span>
                        </a>
                    </div>
                </div>
            </nav>

            <div class="sidebar-footer">
                <div class="user-info">
                    <a href="index.php?action=profile" style="text-decoration: none; color: inherit;">
                        <div class="user-avatar">
                            <?= strtoupper(substr($_SESSION['user']['name'] ?? 'Karyawan', 0, 1)) ?>
                        </div>
                    </a>
                    <div class="user-details">
                        <h6><?= $_SESSION['user']['name'] ?? 'Karyawan' ?></h6>
                        <small>Karyawan Aktif</small>
                    </div>
                </div>
                <a href="index.php?action=logout" id="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            const currentPage = new URLSearchParams(window.location.search).get('action') || 'dashboard';

            navLinks.forEach(link => {
                const linkAction = new URL(link.href).searchParams.get('action');
                if (linkAction === currentPage) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        });
    </script>
</body>

</html>