<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> BookHub</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('img/book.png') }}" alt="Logo"
                    style="width: 30px; height: 30px; margin-right: 8px;">
                BookHub
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                        href="{{ url('/') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Contacto</a>
                    </li>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                            class="nav-link">
                                Panel
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                            class="nav-link ">
                                Iniciar Sesión
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                class="nav-link ">
                                    Registrarse
                                </a>
                            @endif
                        @endauth
                    @endif

                </ul>
            </div>
        </div>
    </nav>


    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicadores de navegación (puntos) -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/C1.jpg"
                    class="d-block w-100" alt="...">
                <div class="carousel-overlay">
                    <div class="carousel-caption d-block">
                        <h5>Bienvenidos a la BookHub</h5>
                        <p>Descubre, aprende y comparte conocimiento en un solo lugar.</p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/C2.jpg"
                    class="d-block w-100" alt="...">
                <div class="carousel-overlay">
                    <div class="carousel-caption d-block">
                        <h5>Un espacio para aprender</h5>
                        <p>Amplia tu conocimiento con los recursos más completos.</p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/C3.jpg"
                    class="d-block w-100" alt="...">
                <div class="carousel-overlay">
                    <div class="carousel-caption d-block">
                        <h5>Explora nuevas historias</h5>
                        <p>Sumérgete en nuevos mundos literarios.</p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Sección de características -->
    <section class="container py-5">
        <div class="row text-center">
            <!-- Primera tarjeta -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-light rounded">
                    <div class="card-img-container position-relative">
                        <!-- Imagen de la tarjeta -->
                        <img src="https://th.bing.com/th/id/OIP.vJdOhzoKDwX7hUOdKcP3SAHaE7?rs=1&pid=ImgDetMain"
                            class="card-img-top" alt="Catálogo de Libros">
                        <!-- Overlay transparente -->
                        <div class="overlay"></div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Catálogo de Libros</h5>
                        <p class="card-text">Accede a una amplia variedad de libros en todos los géneros.</p>
                    </div>
                </div>
            </div>

            <!-- Segunda tarjeta -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-light rounded">
                    <div class="card-img-container position-relative">
                        <!-- Imagen de la tarjeta -->
                        <img src="https://labdicasjornalismo.com/images/noticias/6330/26022021162107_Foto_capa_.jpg"
                            class="card-img-top" alt="Eventos">
                        <!-- Overlay transparente -->
                        <div class="overlay"></div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Eventos y Actividades</h5>
                        <p class="card-text">Únete a nuestros talleres y eventos literarios. </p>
                    </div>
                </div>
            </div>

            <!-- Tercera tarjeta -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-light rounded">
                    <div class="card-img-container position-relative">
                        <!-- Imagen de la tarjeta -->
                        <img src="https://th.bing.com/th/id/OIP.QyL2WPPCRXD0sCKlUkekdwAAAA?rs=1&pid=ImgDetMain"
                            class="card-img-top" alt="Lecturas Recomendadas">
                        <!-- Overlay transparente -->
                        <div class="overlay"></div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Lecturas Recomendadas</h5>
                        <p class="card-text">Te recomendamos libros según tus intereses.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <x-footer>
    </x-footer>

    <!-- Scripts de Bootstrap  -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
</html>
