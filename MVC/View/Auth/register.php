<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Perkebunan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'bounce-in': 'bounceIn 0.6s ease-out',
                        'pulse-glow': 'pulseGlow 3s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            },
                        },
                        glow: {
                            '0%': {
                                boxShadow: '0 0 5px #10b981, 0 0 10px #10b981, 0 0 15px #10b981'
                            },
                            '100%': {
                                boxShadow: '0 0 10px #10b981, 0 0 20px #10b981, 0 0 30px #10b981'
                            },
                        },
                        slideUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(50px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                        bounceIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'scale(0.3)'
                            },
                            '50%': {
                                opacity: '1',
                                transform: 'scale(1.05)'
                            },
                            '70%': {
                                transform: 'scale(0.9)'
                            },
                            '100%': {
                                transform: 'scale(1)'
                            },
                        },
                        pulseGlow: {
                            '0%, 100%': {
                                boxShadow: '0 0 10px rgba(16, 185, 129, 0.5)'
                            },
                            '50%': {
                                boxShadow: '0 0 20px rgba(16, 185, 129, 0.8)'
                            },
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .cyber-grid {
            background-image:
                linear-gradient(rgba(16, 185, 129, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(16, 185, 129, 0.1) 1px, transparent 1px);
            background-size: 30px 30px;
            background-position: 0 0, 0 0;
            animation: grid-move 20s linear infinite;
        }

        @keyframes grid-move {
            0% {
                background-position: 0 0, 0 0;
            }

            100% {
                background-position: 30px 30px, 30px 30px;
            }
        }

        .glass-morphism {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .neon-border {
            border: 2px solid transparent;
            background: linear-gradient(45deg, #10b981, #06d6a0) padding-box,
                linear-gradient(45deg, #10b981, #06d6a0, #10b981) border-box;
        }

        .input-glow:focus {
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.5);
            border-color: #10b981;
        }

        .btn-cyber {
            background: linear-gradient(45deg, #10b981, #06d6a0);
            position: relative;
            overflow: hidden;
        }

        .btn-cyber::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-cyber:hover::before {
            left: 100%;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: #10b981;
            border-radius: 50%;
            opacity: 0.5;
            animation: particle-float 8s linear infinite;
        }

        @keyframes particle-float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .holographic {
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #ffeaa7, #dda0dd);
            background-size: 400% 400%;
            animation: holographic 4s ease infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @keyframes holographic {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .slide-down {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transform: translateY(-20px);
            transition: all 0.4s ease-in-out;
        }

        .slide-down.visible {
            max-height: 150px;
            opacity: 1;
            transform: translateY(0);
        }

        .form-section {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .form-section:nth-child(1) {
            animation-delay: 0.1s;
        }

        .form-section:nth-child(2) {
            animation-delay: 0.2s;
        }

        .form-section:nth-child(3) {
            animation-delay: 0.3s;
        }

        .form-section:nth-child(4) {
            animation-delay: 0.4s;
        }

        .form-section:nth-child(5) {
            animation-delay: 0.5s;
        }

        .form-section:nth-child(6) {
            animation-delay: 0.6s;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="cyber-grid min-h-screen overflow-y-auto">

    <!-- Animated Background Particles -->
    <div class="fixed inset-0 pointer-events-none">
        <div class="particle" style="left: 15%; animation-delay: 0s;"></div>
        <div class="particle" style="left: 35%; animation-delay: 2s;"></div>
        <div class="particle" style="left: 55%; animation-delay: 4s;"></div>
        <div class="particle" style="left: 75%; animation-delay: 6s;"></div>
    </div>

    <!-- Floating Orbs -->
    <div class="fixed inset-0 pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-16 h-16 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full opacity-20 blur-xl animate-float"></div>
        <div class="absolute top-3/4 right-1/4 w-12 h-12 bg-gradient-to-r from-green-400 to-emerald-400 rounded-full opacity-20 blur-xl animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-1/4 left-1/3 w-20 h-20 bg-gradient-to-r from-teal-400 to-cyan-400 rounded-full opacity-15 blur-xl animate-float" style="animation-delay: 4s;"></div>
    </div>

    <!-- Main Container -->
    <div class="flex items-center justify-center min-h-screen p-4 overflow-y-auto">
        <div class="w-full max-w-sm animate-slide-up">
            <!-- Registration Card -->
            <div class="glass-morphism rounded-lg p-5 shadow-2xl neon-border animate-bounce-in">
                <!-- Header -->
                <div class="text-center mb-4">
                    <div class="relative inline-block mb-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-400 via-teal-400 to-cyan-400 rounded-full flex items-center justify-center shadow-lg animate-pulse-glow">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                        </div>
                        <div class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-gradient-to-r from-green-400 to-emerald-400 rounded-full animate-ping"></div>
                        <div class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-gradient-to-r from-green-400 to-emerald-400 rounded-full"></div>
                    </div>
                    <h1 class="text-lg font-bold text-white mb-1 holographic">Daftar Panen Broo</h1>
                    <p class="text-emerald-200 text-xs font-medium">Sistem Manajemen Kelapa Sawit</p>
                    <div class="w-12 h-0.5 bg-gradient-to-r from-emerald-400 via-teal-400 to-cyan-400 mx-auto mt-2 rounded-full"></div>
                </div>

                <!-- Form -->
                <form method="POST" action="?action=register" class="space-y-3">
                    <!-- Name Field -->
                    <div class="relative group form-section">
                        <label for="name" class="block text-emerald-200 font-medium mb-1 text-xs">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-emerald-400 group-hover:text-emerald-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input
                                name="name"
                                id="name"
                                type="text"
                                class="w-full pl-10 pr-3 py-2 bg-white/10 border border-emerald-400/30 rounded-lg text-white placeholder-emerald-200/50 focus:outline-none input-glow transition-all duration-300 backdrop-blur-sm text-sm"
                                placeholder="Ahmad Sawit"
                                required>
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div class="relative group form-section">
                        <label for="email" class="block text-emerald-200 font-medium mb-1 text-xs">Email Aktif</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-emerald-400 group-hover:text-emerald-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                            </div>
                            <input
                                name="email"
                                id="email"
                                type="email"
                                class="w-full pl-10 pr-3 py-2 bg-white/10 border border-emerald-400/30 rounded-lg text-white placeholder-emerald-200/50 focus:outline-none input-glow transition-all duration-300 backdrop-blur-sm text-sm"
                                placeholder="sawit@mail.com"
                                required>
                        </div>
                    </div>

                    <!-- Username Field -->
                    <div class="relative group form-section">
                        <label for="username" class="block text-emerald-200 font-medium mb-1 text-xs">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-emerald-400 group-hover:text-emerald-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                            </div>
                            <input
                                name="username"
                                id="username"
                                type="text"
                                class="w-full pl-10 pr-3 py-2 bg-white/10 border border-emerald-400/30 rounded-lg text-white placeholder-emerald-200/50 focus:outline-none input-glow transition-all duration-300 backdrop-blur-sm text-sm"
                                placeholder="ahmad123"
                                required>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="relative group form-section">
                        <label for="password" class="block text-emerald-200 font-medium mb-1 text-xs">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-emerald-400 group-hover:text-emerald-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input
                                name="password"
                                id="password"
                                type="password"
                                class="w-full pl-10 pr-3 py-2 bg-white/10 border border-emerald-400/30 rounded-lg text-white placeholder-emerald-200/50 focus:outline-none input-glow transition-all duration-300 backdrop-blur-sm text-sm"
                                placeholder="Minimal 6 karakter"
                                required>
                        </div>
                    </div>

                    <!-- Role Selection -->
                    <div class="relative group form-section">
                        <label for="role" class="block text-emerald-200 font-medium mb-1 text-xs">Peran</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-emerald-400 group-hover:text-emerald-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <select
                                name="role"
                                id="role"
                                class="w-full pl-10 pr-8 py-2 bg-white/10 border border-emerald-400/30 rounded-lg text-white focus:outline-none input-glow transition-all duration-300 backdrop-blur-sm text-sm appearance-none"
                                required
                                onchange="toggleAvailability(this.value)">
                                <option value="" class="text-gray-800">-- Pilih Peran --</option>
                                <option value="admin" class="text-gray-800">Admin</option>
                                <option value="karyawan" class="text-gray-800">Karyawan</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Tampilkan skill hanya jika role = karyawan -->
                    <div id="skillSection" style="display:none;">
                        <label class="block mb-1 text-white">Pilih Skill:</label>
                        <?php foreach ($roles as $r): ?>
                            <label class="block text-white">
                                <input type="checkbox" name="skills[]" value="<?= $r['id'] ?>"> <?= htmlspecialchars($r['name']) ?>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <!-- Availability Section (Hidden by default) -->
                    <div id="availability-box" class="slide-down form-section">
                        <div class="relative group">
                            <label for="availability" class="block text-emerald-200 font-medium mb-1 text-xs">Waktu Ketersediaan</label>
                            <div class="relative">
                                <div class="absolute top-2 left-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-emerald-400 group-hover:text-emerald-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <textarea
                                    name="availability_time"
                                    id="availability"
                                    rows="2"
                                    class="w-full pl-10 pr-3 py-2 bg-white/10 border border-emerald-400/30 rounded-lg text-white placeholder-emerald-200/50 focus:outline-none input-glow transition-all duration-300 backdrop-blur-sm text-sm resize-none"
                                    placeholder="Contoh: Senin - Jumat, 08.00 - 16.00"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-section">
                        <button
                            type="submit"
                            class="w-full btn-cyber text-white font-semibold py-2.5 px-4 rounded-lg shadow-lg hover:shadow-emerald-400/25 transform hover:scale-105 transition-all duration-300 relative overflow-hidden text-sm">
                            <span class="relative z-10 flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                <span>DAFTAR SEKARANG</span>
                            </span>
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="flex items-center my-3">
                    <div class="flex-1 h-px bg-gradient-to-r from-transparent via-emerald-400/50 to-transparent"></div>
                    <span class="px-3 text-emerald-200 text-xs">atau</span>
                    <div class="flex-1 h-px bg-gradient-to-r from-transparent via-emerald-400/50 to-transparent"></div>
                </div>

                <!-- Login Link -->
                <div class="text-center mb-2">
                    <p class="text-emerald-200 text-xs">
                        Sudah punya akun?
                        <a href="?action=login" class="text-emerald-400 hover:text-emerald-300 font-semibold transition-colors hover:underline ml-1">
                            Login di sini
                        </a>
                    </p>
                </div>

                <!-- Security Features -->
                <div class="grid grid-cols-3 gap-2 pt-2 border-t border-emerald-400/20">
                    <div class="flex items-center text-emerald-200 text-xs">
                        <div class="w-1.5 h-1.5 bg-emerald-400 rounded-full mr-2 animate-pulse"></div>
                        <span>Aman</span>
                    </div>
                    <div class="flex items-center text-emerald-200 text-xs">
                        <div class="w-1.5 h-1.5 bg-emerald-400 rounded-full mr-2 animate-pulse"></div>
                        <span>Enkripsi</span>
                    </div>
                    <div class="flex items-center text-emerald-200 text-xs">
                        <div class="w-1.5 h-1.5 bg-emerald-400 rounded-full mr-2 animate-pulse"></div>
                        <span>Verifikasi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleAvailability(role) {
            const box = document.getElementById('availability-box');
            if (role === 'karyawan') {
                box.classList.add('visible');
            } else {
                box.classList.remove('visible');
            }
        }

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add mouse movement effect for cursor trail
            let trail = [];
            document.addEventListener('mousemove', function(e) {
                trail.push({
                    x: e.clientX,
                    y: e.clientY
                });
                if (trail.length > 5) {
                    trail.shift();
                }

                // Create trailing effect
                if (Math.random() < 0.05) {
                    const particle = document.createElement('div');
                    particle.className = 'fixed w-1 h-1 bg-emerald-400 rounded-full opacity-50 pointer-events-none z-50';
                    particle.style.left = e.clientX + 'px';
                    particle.style.top = e.clientY + 'px';
                    particle.style.transition = 'opacity 1s ease-out';
                    document.body.appendChild(particle);

                    setTimeout(() => {
                        particle.style.opacity = '0';
                        setTimeout(() => particle.remove(), 1000);
                    }, 100);
                }
            });

            // Add input focus effects
            const inputs = document.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.01)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });
        });

        document.getElementById('role').addEventListener('change', function() {
            const skillSection = document.getElementById('skillSection');
            skillSection.style.display = this.value === 'karyawan' ? 'block' : 'none';
        });
    </script>
</body>

</html>