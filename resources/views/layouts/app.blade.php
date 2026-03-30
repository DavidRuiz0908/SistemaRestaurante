<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🍔 Restaurante App</title>
    <!-- Cargamos Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- BARRA DE NAVEGACIÓN SUPERIOR (Se calcula en automático) -->
    @php
        $carrito = session('carrito', []);
        $totalArticulos = array_sum(array_column($carrito, 'cantidad'));
    @endphp

    <nav class="navbar navbar-dark bg-dark sticky-top shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/menu') }}">🍔 Restaurante App</a>
            
            <a href="{{ url('/carrito') }}" class="btn btn-warning position-relative fw-bold">
                🛒 Ver Pedido
                @if($totalArticulos > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $totalArticulos }}
                        <span class="visually-hidden">artículos en el carrito</span>
                    </span>
                @endif
            </a>
        </div>
    </nav>

    <!-- AQUÍ SE INYECTARÁ EL CONTENIDO DE LAS OTRAS PANTALLAS -->
    <main>
        @yield('content')
    </main>

    <!-- Cargamos Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>