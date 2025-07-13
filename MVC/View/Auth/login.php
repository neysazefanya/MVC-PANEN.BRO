    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Sistem Perkebunan</title>
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
                        },
                        keyframes: {
                            float: {
                                '0%, 100%': { transform: 'translateY(0px)' },
                                '50%': { transform: 'translateY(-20px)' },
                            },
                            glow: {
                                '0%': { boxShadow: '0 0 5px #10b981, 0 0 10px #10b981, 0 0 15px #10b981' },
                                '100%': { boxShadow: '0 0 10px #10b981, 0 0 20px #10b981, 0 0 30px #10b981' },
                            },
                            slideUp: {
                                '0%': { opacity: '0', transform: 'translateY(50px)' },
                                '100%': { opacity: '1', transform: 'translateY(0)' },
                            },
                            bounceIn: {
                                '0%': { opacity: '0', transform: 'scale(0.3)' },
                                '50%': { opacity: '1', transform: 'scale(1.05)' },
                                '70%': { transform: 'scale(0.9)' },
                                '100%': { transform: 'scale(1)' },
                            }
                        }
                    }
                }
            }
        </script>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
            .cyber-grid {
                background-image: 
                    linear-gradient(rgba(16, 185, 129, 0.1) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(16, 185, 129, 0.1) 1px, transparent 1px);
                background-size: 50px 50px;
                background-position: 0 0, 0 0;
                animation: grid-move 20s linear infinite;
            }
            @keyframes grid-move {
                0% { background-position: 0 0, 0 0; }
                100% { background-position: 50px 50px, 50px 50px; }
            }
            .glass-morphism {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            .neon-border {
                border: 2px solid transparent;
                background: linear-gradient(45deg, #10b981, #06d6a0) padding-box, 
                            linear-gradient(45deg, #10b981, #06d6a0, #10b981) border-box;
            }
            .input-glow:focus {
                box-shadow: 0 0 20px rgba(16, 185, 129, 0.5);
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
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
                transition: left 0.5s;
            }
            .btn-cyber:hover::before {
                left: 100%;
            }
            .particle {
                position: absolute;
                width: 4px;
                height: 4px;
                background: #10b981;
                border-radius: 50%;
                opacity: 0.7;
                animation: particle-float 8s linear infinite;
            }
            @keyframes particle-float {
                0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
                10% { opacity: 1; }
                90% { opacity: 1; }
                100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
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
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
        </style>
    </head>
    <body class="min-h-screen cyber-grid overflow-hidden">
        <!-- Animated Background Particles -->
        <div class="fixed inset-0 pointer-events-none">
            <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
            <div class="particle" style="left: 20%; animation-delay: 1s;"></div>
            <div class="particle" style="left: 30%; animation-delay: 2s;"></div>
            <div class="particle" style="left: 40%; animation-delay: 3s;"></div>
            <div class="particle" style="left: 50%; animation-delay: 4s;"></div>
            <div class="particle" style="left: 60%; animation-delay: 5s;"></div>
            <div class="particle" style="left: 70%; animation-delay: 6s;"></div>
            <div class="particle" style="left: 80%; animation-delay: 7s;"></div>
            <div class="particle" style="left: 90%; animation-delay: 8s;"></div>
        </div>

        <!-- Floating Orbs -->
        <div class="fixed inset-0 pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full opacity-20 blur-xl animate-float"></div>
            <div class="absolute top-3/4 right-1/4 w-24 h-24 bg-gradient-to-r from-green-400 to-emerald-400 rounded-full opacity-20 blur-xl animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-1/4 left-1/3 w-40 h-40 bg-gradient-to-r from-teal-400 to-cyan-400 rounded-full opacity-15 blur-xl animate-float" style="animation-delay: 4s;"></div>
        </div>

        <!-- Main Container -->
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="w-full max-w-sm animate-slide-up">
                <!-- Login Card -->
                <div class="glass-morphism rounded-2xl p-6 shadow-2xl neon-border animate-bounce-in">
                    <!-- Header -->
                    <div class="text-center mb-6">
                        <div class="relative inline-block mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 via-teal-400 to-cyan-400 rounded-full flex items-center justify-center shadow-2xl animate-glow">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-400 rounded-full animate-ping"></div>
                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-400 rounded-full"></div>
                        </div>
                        <h1 class="text-2xl font-bold text-white mb-2 holographic">Panen Broo</h1>
                        <p class="text-emerald-200 text-sm font-medium">Sistem Manajemen Kelapa Sawit</p>
                        <div class="w-16 h-0.5 bg-gradient-to-r from-emerald-400 to-teal-400 mx-auto mt-3 rounded-full"></div>
                    </div>

                    <!-- Form -->
                    <form method="POST" action="?action=login" class="space-y-4">
                        <!-- Username Field -->
                        <div class="relative group">
                            <label for="username" class="block text-emerald-200 font-medium mb-1 text-xs uppercase tracking-wide">Username</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-emerald-400 group-hover:text-emerald-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <input 
                                    name="username" 
                                    id="username" 
                                    type="text"
                                    class="w-full pl-10 pr-3 py-3 bg-white/10 border border-emerald-400/30 rounded-lg text-white placeholder-emerald-200/50 focus:outline-none input-glow transition-all duration-300 backdrop-blur-sm text-sm"
                                    placeholder="Masukkan username"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="relative group">
                            <label for="password" class="block text-emerald-200 font-medium mb-1 text-xs uppercase tracking-wide">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-emerald-400 group-hover:text-emerald-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password"
                                    class="w-full pl-10 pr-3 py-3 bg-white/10 border border-emerald-400/30 rounded-lg text-white placeholder-emerald-200/50 focus:outline-none input-glow transition-all duration-300 backdrop-blur-sm text-sm"
                                    placeholder="Masukkan password"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between text-xs">
                            <label class="flex items-center text-emerald-200 hover:text-emerald-100 transition-colors cursor-pointer">
                                <input type="checkbox" class="w-3 h-3 text-emerald-400 bg-white/10 border-emerald-400/30 rounded focus:ring-emerald-400 focus:ring-1">
                                <span class="ml-2">Ingat saya</span>
                            </label>
                            <a href="#" class="text-emerald-400 hover:text-emerald-300 font-medium transition-colors hover:underline">
                                Lupa password?
                            </a>
                        </div>

                        <!-- Login Button -->
                        <button 
                            type="submit" 
                            class="w-full btn-cyber text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-emerald-400/25 transform hover:scale-105 transition-all duration-300 relative overflow-hidden text-sm"
                        >
                            <span class="relative z-10">MASUK KE SISTEM</span>
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="flex items-center my-4">
                        <div class="flex-1 h-px bg-gradient-to-r from-transparent via-emerald-400/50 to-transparent"></div>
                        <span class="px-3 text-emerald-200 text-xs">atau</span>
                        <div class="flex-1 h-px bg-gradient-to-r from-transparent via-emerald-400/50 to-transparent"></div>
                    </div>

                    <!-- Register Link -->
                    <div class="text-center">
                        <p class="text-emerald-200 mb-3 text-xs">
                            Belum punya akun?
                            <a href="?action=register" class="text-emerald-400 hover:text-emerald-300 font-semibold transition-colors hover:underline ml-1">
                                Daftar sekarang
                            </a>
                        </p>
                    </div>

                    <!-- Security Features -->
                    <div class="flex items-center justify-center space-x-4 pt-3 border-t border-emerald-400/20">
                        <div class="flex items-center text-emerald-200 text-xs">
                            <div class="w-1.5 h-1.5 bg-emerald-400 rounded-full mr-2 animate-pulse"></div>
                            <span>Keamanan Tinggi</span>
                        </div>
                        <div class="flex items-center text-emerald-200 text-xs">
                            <div class="w-1.5 h-1.5 bg-emerald-400 rounded-full mr-2 animate-pulse"></div>
                            <span>Enkripsi End-to-End</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Add some interactive effects
            document.addEventListener('DOMContentLoaded', function() {
                // Add mouse movement effect
                document.addEventListener('mousemove', function(e) {
                    const cursor = document.querySelector('.cursor-trail');
                    if (!cursor) {
                        const trail = document.createElement('div');
                        trail.className = 'cursor-trail fixed w-4 h-4 bg-emerald-400 rounded-full opacity-30 pointer-events-none z-50';
                        trail.style.left = e.clientX + 'px';
                        trail.style.top = e.clientY + 'px';
                        document.body.appendChild(trail);
                        
                        setTimeout(() => {
                            trail.remove();
                        }, 1000);
                    }
                });
            });
        </script>
    </body>
    </html>