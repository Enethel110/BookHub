<x-app-layout>
    <div class="container mt-4">
        <h1 class="mb-4" style="color: gray; text-align: center">Libros</h1>

        <!-- Barra de búsqueda -->
        <form class="mb-4" action="{{ route('dashboard') }}" method="GET">
            <div class="input-group">
                <input id="searchInput" type="text" class="form-control" placeholder="Buscar por título o autor" name="search" value="{{ request()->search }}">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </div>
        </form>

        <!-- Botón para abrir la modal de agregar libro -->
        <div class="mb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookModal">Agregar Libro</button>
        </div>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Cards de libros -->
        <div id="librosContainer" class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($libros as $libro)
                <div class="col">
                    <div class="card">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Imagen del libro">
                        <div class="card-body">
                            <h5 class="card-title">{{ $libro->titulo }}</h5>
                            <p class="card-text">Autor: {{ $libro->autor }}</p>
                            <span class="badge bg-info">{{ $libro->estado }}</span>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <!-- Botón para cambiar el estado -->
                            <form action="{{ route('libros.toggleEstado', $libro) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm change-status">Cambiar Estado</button>
                            </form>

                            <!-- Botón para editar -->
                            <a href="{{ route('libros.edit', $libro) }}" class="btn btn-success btn-sm">Editar</a>

                            <!-- Formulario para eliminar libro -->
                            <form action="{{ route('libros.destroy', $libro) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-book">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-4">
            {{ $libros->links() }}
        </div>

    </div>

    <!-- Modal para agregar libro -->
    <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBookModalLabel">Nuevo Libro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addBookForm" action="{{ route('libros.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="autor" class="form-label">Autor</label>
                            <input type="text" class="form-control" id="autor" name="autor" required>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="disponible">Disponible</option>
                                <option value="prestado">Prestado</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary addBookForm">Guardar</button>
                        </div>                        
                       </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
    
    @endsection


    <script>
        document.getElementById('searchInput').addEventListener('input', function () {
            let query = this.value; // Obtiene el valor del campo de búsqueda
            
            // Realiza la solicitud AJAX si hay algo que buscar
            fetch(`/dashboard?search=${query}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest', // Asegura que es una solicitud AJAX
                }
            })
            .then(response => response.json())  // Espera la respuesta en formato JSON
            .then(data => {
                // Reemplaza el contenido de los libros con los nuevos resultados
                document.getElementById('librosContainer').innerHTML = data.libros;
                // Actualiza la paginación
                document.querySelector('.pagination').innerHTML = data.pagination;
            });
        });

        // Confirmación para agregar un libro
        document.getElementById('addBookForm').addEventListener('submit', function(e) {
            e.preventDefault(); 
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Quieres agregar este libro?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); 
                }
            });
        });

        // Confirmación para eliminar libro
        document.querySelectorAll('.delete-book').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); 
                let form = this.closest('form');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Este libro será eliminado permanentemente.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); 
                    }
                });
            });
        });

        // Confirmación para cambiar estado
        document.querySelectorAll('.change-status').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                let form = this.closest('form');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Quieres cambiar el estado de este libro?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, cambiar estado',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); 
                    }
                });
            });
        });
    </script>

</x-app-layout>
