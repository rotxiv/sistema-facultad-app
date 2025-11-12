<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <style>
            body {
                background: #ffffff;
                color: #1f2937;
            }            
            .bg-gradient-animated {
                background: linear-gradient(-45deg, #f8fafc, #e2e8f0, #cbd5e1, #94a3b8, #64748b, #475569);
                background-size: 400% 400%;
                animation: gradientShift 15s ease infinite;
            }
            @keyframes gradientShift {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            .glass-effect {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(0, 0, 0, 0.1);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
            }
            .floating-animation {
                animation: floating 6s ease-in-out infinite;
            }
            
            @keyframes floating {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            .account-card {
                transition: all 0.3s ease;
                cursor: pointer;
                background: rgba(255, 255, 255, 0.95);
                border: 2px solid rgba(0, 0, 0, 0.1);
            }
            .account-card:hover {
                transform: translateY(-10px) scale(1.05);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
                border-color: rgba(59, 130, 246, 0.4);
            }
            .account-card.selected {
                background: rgba(59, 130, 246, 0.1);
                border-color: rgba(59, 130, 246, 0.6);
                transform: translateY(-5px) scale(1.02);
            }
            .icon-container {
                background: rgba(0, 0, 0, 0.05);
                backdrop-filter: blur(10px);
                border-radius: 50%;
                width: 120px;
                height: 120px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 20px;
                transition: all 0.3s ease;
                border: 2px solid rgba(0, 0, 0, 0.1);
            }
            
            .account-card:hover .icon-container {
                background: rgba(59, 130, 246, 0.1);
                transform: scale(1.1);
                border-color: rgba(59, 130, 246, 0.3);
            }
            
            .floating-elements {
                background: rgba(0, 0, 0, 0.03);
            }
        </style>
    </head>
    <body class="min-h-screen bg-gradient-animated antialiased overflow-auto">
        
        <!-- Elementos decorativos flotantes -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 floating-elements rounded-full blur-3xl floating-animation"></div>
            <div class="absolute top-3/4 right-1/4 w-96 h-96 floating-elements rounded-full blur-3xl floating-animation" style="animation-delay: -2s;"></div>
            <div class="absolute bottom-1/4 left-1/3 w-80 h-80 floating-elements rounded-full blur-3xl floating-animation" style="animation-delay: -4s;"></div>
        </div>
        <div class="relative z-10 flex flex-col items-center justify-center gap-6 p-6 min-h-screen md:justify-center md:min-h-screen h-auto">
            <!-- Logo y encabezado -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-24 h-24 mb-6 glass-effect rounded-2xl">
                    <svg class="w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Universidad Autónoma</h1>
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Gabriel René Moreno</h2>
                <div class="w-32 h-1 bg-gradient-to-r from-red-500 to-red-600 mx-auto mb-6"></div>
                <h3 class="text-3xl font-bold text-red-600 mb-2">Bienvenido al Perfil</h3>
                <p class="text-xl text-blue-600 font-semibold">Elige tu tipo de cuenta</p>
            </div>
            <!-- Selector de tipo de cuenta -->
            <div class="w-full max-w-6xl">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Estudiante -->
                    <div class="account-card glass-effect rounded-3xl p-8 text-center" onclick="selectAccount(event, 'estudiante')">
                        <div class="icon-container">
                            <svg class="w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">ESTUDIANTE</h3>
                        <p class="text-gray-600 text-sm mb-6">Acceso al portal estudiantil, consulta de notas, horarios y materias</p>
                        <div class="bg-green-100 border border-green-200 rounded-lg p-3">
                            <p class="text-green-700 text-xs font-medium">Portal de estudiantes</p>
                        </div>
                    </div>
                    <!-- Docente -->
                    <div class="account-card glass-effect rounded-3xl p-8 text-center" onclick="selectAccount(event, 'docente')">
                        <div class="icon-container">
                            <svg class="w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">DOCENTE</h3>
                        <p class="text-gray-600 text-sm mb-6">Gestión de clases, registro de asistencia y calificaciones</p>
                        <div class="bg-orange-100 border border-orange-200 rounded-lg p-3">
                            <p class="text-orange-700 text-xs font-medium">Portal docente</p>
                        </div>
                    </div>
                    <!-- Administrativo -->
                    <div class="account-card glass-effect rounded-3xl p-8 text-center" onclick="selectAccount(event, 'administrativo')">
                        <div class="icon-container">
                            <svg class="w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">ADMINISTRATIVO</h3>
                        <p class="text-gray-600 text-sm mb-6">Administración del sistema, gestión de usuarios y configuración</p>
                        <div class="bg-blue-100 border border-blue-200 rounded-lg p-3">
                            <p class="text-blue-700 text-xs font-medium">Panel administrativo</p>
                        </div>
                    </div>
                </div>
                <!-- Botón continuar -->
                <div class="text-center mt-12">
                    <button id="continueBtn" onclick="continueToLogin()" 
                        disabled
                        class="px-12 py-4 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 disabled:from-gray-500 disabled:to-gray-600 disabled:cursor-not-allowed text-white font-bold text-lg rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-105 disabled:hover:scale-100 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-blue-400 focus:ring-offset-2 focus:ring-offset-transparent"
                    >
                        <span class="flex items-center justify-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                            Continuar al Login
                        </span>
                    </button>
                </div>
                <!-- Link de ayuda -->
                <div class="text-center mt-8">
                    <p class="text-gray-600 text-sm">
                        ¿Olvidaste tu contraseña? 
                        <a href="#" class="text-blue-600 hover:text-blue-800 underline transition-colors">
                            Recuperar acceso
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <script>
            //document.addEventListener('DOMContentLoaded', function () {
                let selectedAccountType = null;
                function selectAccount(event, type) {
                    // Remover selección anterior
                    document.querySelectorAll('.account-card').forEach(card => {
                        card.classList.remove('selected');
                    });
                    // Seleccionar nueva cuenta
                    event.currentTarget.classList.add('selected');
                    selectedAccountType = type;
                    // Habilitar botón continuar
                    const continueBtn = document.getElementById('continueBtn');
                    continueBtn.disabled = false;
                    continueBtn.classList.remove('disabled:from-gray-500', 'disabled:to-gray-600');
                }
                function continueToLogin() {
                    if (selectedAccountType) {
                        // Redirigir al login correspondiente
                        switch(selectedAccountType) {
                            case 'estudiante':
                                window.location.href = '{{ route("login.estudiante") }}';
                                break;
                            case 'docente':
                                window.location.href = '{{ route("login.docente") }}';
                                break;
                            case 'administrativo':
                                window.location.href = '{{ route("login.administrativo") }}';
                                break;
                        }
                    }
                }
                // Efecto de hover mejorado
                document.querySelectorAll('.account-card').forEach(card => {
                    card.addEventListener('mouseenter', function() {
                        if (!this.classList.contains('selected')) {
                            this.style.transform = 'translateY(-10px) scale(1.05)';
                        }
                    })
                });
                card.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('selected')) {
                        this.style.transform = 'translateY(0) scale(1)';
                    }
                });
        </script>
    </body>
</html>