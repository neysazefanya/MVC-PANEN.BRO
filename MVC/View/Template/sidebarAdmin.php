<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Area Kerja</title>
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
                        'slide-in': 'slideIn 0.3s ease-out',
                        'fade-in': 'fadeIn 0.2s ease-out',
                        'pulse-subtle': 'pulseSubtle 2s ease-in-out infinite',
                    },
                    keyframes: {
                        slideIn: {
                            '0%': { transform: 'translateX(-100%)' },
                            '100%': { transform: 'translateX(0)' }
                        },
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        pulseSubtle: {
                            '0%, 100%': { transform: 'scale(1)' },
                            '50%': { transform: 'scale(1.02)' }
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
        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .nav-link-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .nav-link-hover:hover {
            transform: translateX(8px);
            background: rgba(255, 255, 255, 0.1);
        }
        .sidebar-gradient {
            background: linear-gradient(135deg, #065f46 0%, #047857 25%, #059669 50%, #10b981 75%, #34d399 100%);
            position: relative;
        }
        .sidebar-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 50%, rgba(0,0,0,0.05) 100%);
            pointer-events: none;
        }
        .scrollbar-thin::-webkit-scrollbar {
            width: 4px;
        }
        .scrollbar-thin::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
        }
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }
        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen overflow-x-hidden">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-72 sidebar-gradient text-white flex flex-col shadow-2xl relative z-10 transition-all duration-300 ease-in-out">
            
            <!-- Header -->
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center glass-effect">
                        <i class="fas fa-cogs text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">Admin Panel</h1>
                        <p class="text-xs text-white/70">Management System</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 overflow-y-auto scrollbar-thin">
                <div class="space-y-6">
                    <!-- Management Section -->
                    <div class="animate-fade-in">
                        <h3 class="text-xs font-semibold text-white/60 uppercase tracking-wider mb-3 px-3">
                            Manajemen
                        </h3>
                        <div class="space-y-1">
                            <a href="index.php?action=area" 
                               class="nav-link-hover flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/90 hover:text-white active:bg-white/15 active:text-white group">
                                <i class="fas fa-map-marked-alt w-5 text-center group-hover:scale-110 transition-transform"></i>
                                <span>Daftar Area</span>
                            </a>
                            
                            <a href="index.php?action=jadwal" 
                               class="nav-link-hover flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/90 hover:text-white group">
                                <i class="fas fa-calendar-alt w-5 text-center group-hover:scale-110 transition-transform"></i>
                                <span>Jadwal Kerja</span>
                            </a>
                            
                            <a href="index.php?action=karyawan" 
                               class="nav-link-hover flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/90 hover:text-white group">
                                <i class="fas fa-users w-5 text-center group-hover:scale-110 transition-transform"></i>
                                <span>Karyawan</span>
                            </a>
                            
                            <a href="index.php?action=seleksi" 
                               class="nav-link-hover flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/90 hover:text-white group">
                                <i class="fas fa-user-check w-5 text-center group-hover:scale-110 transition-transform"></i>
                                <span>Seleksi Penempatan</span>
                            </a>
                            
                            <a href="index.php?action=role" 
                               class="nav-link-hover flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/90 hover:text-white group">
                                <i class="fas fa-briefcase w-5 text-center group-hover:scale-110 transition-transform"></i>
                                <span>Pekerjaan</span>
                            </a>
                            
                            <a href="index.php?action=gaji" 
                               class="nav-link-hover flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/90 hover:text-white group">
                                <i class="fas fa-money-bill-wave w-5 text-center group-hover:scale-110 transition-transform"></i>
                                <span>Penggajian</span>
                            </a>
                            
                            <a href="index.php?action=riwayat" 
                               class="nav-link-hover flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/90 hover:text-white group">
                                <i class="fas fa-chart-bar w-5 text-center group-hover:scale-110 transition-transform"></i>
                                <span>Laporan</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Footer -->
            <div class="p-4 border-t border-white/10 bg-black/10">
                <!-- User Profile -->
                <div class="flex items-center gap-3 mb-4 p-3 rounded-lg glass-effect hover:bg-white/10 transition-colors">
                    <a href="index.php?action=profile" class="flex items-center gap-3 w-full text-white hover:text-white no-underline">
                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center font-bold text-sm shadow-lg">
                            A
                        </div>
                        <div class="flex-1">
                            <h6 class="text-sm font-semibold mb-0">Admin</h6>
                            <small class="text-xs text-white/70">Administrator</small>
                        </div>
                    </a>
                </div>

                <!-- Logout Button -->
                <a href="index.php?action=logout" 
                   class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-medium py-2.5 px-4 rounded-lg flex items-center justify-center gap-2 transition-all duration-300 hover:shadow-lg hover:scale-105 active:scale-95">
                    <i class="fas fa-sign-out-alt text-sm"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>



        <!-- Mobile Menu Toggle -->
        <button id="mobile-menu-toggle" 
                class="fixed top-4 left-4 z-50 lg:hidden bg-primary-600 text-white p-3 rounded-lg shadow-lg hover:bg-primary-700 transition-colors">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black/50 z-40 lg:hidden hidden"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set active navigation link
            const navLinks = document.querySelectorAll('nav a');
            const currentPage = new URLSearchParams(window.location.search).get('action') || 'area';

            navLinks.forEach(link => {
                const linkAction = new URL(link.href).searchParams.get('action');
                if (linkAction === currentPage) {
                    link.classList.add('active', 'bg-white/15', 'text-white');
                } else {
                    link.classList.remove('active', 'bg-white/15', 'text-white');
                }
            });

            // Mobile menu functionality
            const mobileToggle = document.getElementById('mobile-menu-toggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobile-overlay');

            mobileToggle.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            });

            overlay.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });

            // Handle responsive behavior
            function handleResize() {
                if (window.innerWidth >= 1024) {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.add('hidden');
                } else {
                    sidebar.classList.add('-translate-x-full');
                }
            }

            window.addEventListener('resize', handleResize);
            handleResize(); // Initial check
        });
    </script>
</body>

</html>