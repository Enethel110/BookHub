<x-app-layout>
    <div class="container mt-4">
        <h1 class="mb-4" style="color: gray; text-align: center">Libros</h1>

        <!-- Barra de búsqueda -->
        <x-searchbar>
        </x-searchbar>

        <!-- Botón para abrir la modal de agregar libro -->
        <x-addbook>
        </x-addbook>

        <!-- Mensaje de éxito y no books-->
        <x-nobooks>
        </x-nobooks>

        <!-- Cards de libros -->
        <div id="librosContainer" class="row row-cols-1 row-cols-md-3 g-4">
            @if ($libros->isEmpty())
                <div class="alert alert-warning text-center w-100">
                    No hay libros disponibles.
                </div>
            @else
                @foreach ($libros as $libro)
                    <div class="col">
                        <div class="card">
                            <img src="https://th.bing.com/th/id/OIP.L3z6m-ZXwouOHn4jF4WE5gHaHa?rs=1&pid=ImgDetMain"
                                class="card-img-top" alt="Imagen del libro">
                            <div class="card-body">
                                <h5 class="card-title">{{ $libro->titulo }}</h5>
                                <p class="card-text">Autor: {{ $libro->autor }}</p>
                                <span class="badge @if ($libro->estado == 'prestado') bg-dark @else bg-primary @endif">
                                    {{ $libro->estado }}
                                </span>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <!-- Botón para cambiar el estado -->
                                <form action="{{ route('libros.toggleEstado', $libro) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm change-status">Cambiar
                                        Estado</button>
                                </form>
                                <a href="javascript:void(0);" class="btn btn-success btn-sm edit-book-btn"
                                    data-id="{{ $libro->id }}">Editar</a>
                                <!-- Formulario para eliminar libro -->
                                <form action="{{ route('libros.destroy', $libro) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-book">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-4">
            {{ $libros->links() }}
        </div>

    </div>

    <!-- Modal para agregar libro -->
    <x-modaladdbook>
    </x-modaladdbook>


    <!-- Modal para editar libro -->
    <x-modaleditbook>
    </x-modaleditbook>

    <div class="container mt-4">
        <h2 class="mb-4" style="color: gray; text-align: center">Resumen de Libros</h2>
        <canvas id="booksChart" width="400" height="200"></canvas>
    </div>

    <script>
        // Pasa la variable librosArray a una variable JavaScript
        window.librosArray = @json($librosArray);
    </script>
</x-app-layout>
