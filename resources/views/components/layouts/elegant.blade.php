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
                background: rgba(255, 255, 255, 0.95);
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
            .pulse-glow {
                animation: pulseGlow 2s ease-in-out infinite alternate;
            }
            @keyframes pulseGlow {
                from { box-shadow: 0 0 20px rgba(59, 130, 246, 0.2); }
                to { box-shadow: 0 0 30px rgba(59, 130, 246, 0.4); }
            }
            .floating-elements {
                background: rgba(0, 0, 0, 0.03);
            }
        </style>
    </head>
    <body class="min-h-screen bg-gradient-animated antialiased overflow-y-auto">
        <!-- Elementos decorativos flotantes -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 floating-elements rounded-full blur-3xl floating-animation"></div>
            <div class="absolute top-3/4 right-1/4 w-96 h-96 floating-elements rounded-full blur-3xl floating-animation" style="animation-delay: -2s;"></div>
            <div class="absolute bottom-1/4 left-1/3 w-80 h-80 floating-elements rounded-full blur-3xl floating-animation" style="animation-delay: -4s;"></div>
        </div>
        <div class="relative z-10 flex min-h-screen flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="w-full max-w-md">
                <!-- Logo y título -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 mb-4 glass-effect rounded-2xl pulse-glow border-2 border-gray-200">
                        <x-app-logo-icon class="size-12 fill-current text-gray-700" />
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Sistema Facultad</h1>
                    <p class="text-gray-600">Acceso al Sistema</p>
                </div>
                <!-- Contenedor del formulario -->
                <div class="glass-effect rounded-3xl shadow-2xl w-full p-6">
                    {{ $slot }}
                </div>
                <!-- Footer -->
                <div class="text-center mt-6">
                    <p class="text-gray-500 text-sm">© {{ date('Y') }} Sistema de Gestión Académica</p>
                </div>
            </div>
        </div>
    </body>
</html>