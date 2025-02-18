<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GrowPriceTracker - Compara precios de cultivo interior</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="antialiased bg-gray-50">
        <!-- Navbar -->
        <nav class="bg-white shadow-sm fixed w-full z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <i class="fas fa-seedling text-2xl text-emerald-600"></i>
                            <span class="ml-2 text-xl font-bold text-gray-900">GrowPriceTracker</span>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/home') }}" class="font-medium text-emerald-600 hover:text-emerald-800 px-3 py-2">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="font-medium text-gray-600 hover:text-emerald-600 px-3 py-2">Ingresar</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 font-medium text-white bg-emerald-600 hover:bg-emerald-700 px-5 py-2 rounded-lg">Registrarse</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="pt-32 pb-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto text-center">
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6">
                    Encuentra los mejores precios para tu
                    <span class="text-emerald-600">cultivo </span>
                </h1>
                <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                    Compara precios en tiempo real entre múltiples growshops y ahorra en tus productos de cultivo.
                </p>
                <div class="mt-10">
                    <a href="{{ route('register') }}" class="bg-emerald-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-emerald-700 transition-colors duration-300">
                        Comenzar gratis
                    </a>
                </div>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="p-6 border rounded-xl hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-bolt text-emerald-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Monitoreo en tiempo real</h3>
                        <p class="text-gray-600">Precios actualizados al instante de múltiples tiendas especializadas</p>
                    </div>
                    
                    <div class="p-6 border rounded-xl hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-tags text-emerald-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">+20 categorías</h3>
                        <p class="text-gray-600">Iluminación, fertilizantes, sustratos, equipos y más</p>
                    </div>
                    
                    <div class="p-6 border rounded-xl hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-bell text-emerald-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Alertas de ofertas</h3>
                        <p class="text-gray-600">Recibe notificaciones cuando los productos bajen de precio</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Preview -->
        <div class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center mb-12">Productos que monitoreamos</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center p-4 hover:bg-gray-50 rounded-lg">
                        <i class="fas fa-lightbulb text-3xl text-emerald-600 mb-2"></i>
                        <h4 class="font-medium">Iluminación</h4>
                    </div>
                    <div class="text-center p-4 hover:bg-gray-50 rounded-lg">
                        <i class="fas fa-tint text-3xl text-emerald-600 mb-2"></i>
                        <h4 class="font-medium">Riego</h4>
                    </div>
                    <div class="text-center p-4 hover:bg-gray-50 rounded-lg">
                        <i class="fas fa-flask text-3xl text-emerald-600 mb-2"></i>
                        <h4 class="font-medium">Nutrientes</h4>
                    </div>
                    <div class="text-center p-4 hover:bg-gray-50 rounded-lg">
                        <i class="fas fa-leaf text-3xl text-emerald-600 mb-2"></i>
                        <h4 class="font-medium">Sustratos</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-emerald-600 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-white mb-4">¿Listo para optimizar tus gastos?</h2>
                <p class="text-lg text-emerald-100 mb-8">Regístrate gratis y comienza a ahorrar hoy mismo</p>
                <a href="{{ route('register') }}" class="inline-block bg-white text-emerald-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-300">
                    Crear cuenta gratuita
                </a>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-100 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-600">
                <p>© 2023 GrowPriceTracker. Todos los derechos reservados.</p>
            </div>
        </footer>
    </body>
</html>