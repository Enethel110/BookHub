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
                        <img src="https://th.bing.com/th/id/OIP.L3z6m-ZXwouOHn4jF4WE5gHaHa?rs=1&pid=ImgDetMain" class="card-img-top" alt="Imagen del libro">
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
                        <!--    <a href="{{ route('libros.edit', $libro) }}" class="btn btn-success btn-sm"  data-bs-target="#editBookModal">Editar</a> -->
                            <a href="javascript:void(0);" class="btn btn-success btn-sm edit-book-btn" data-id="{{ $libro->id }}">Editar</a>
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


    <!-- Modal para editar libro -->
<div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBookModalLabel">Editar Libro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editBookForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editTitulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="editTitulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAutor" class="form-label">Autor</label>
                        <input type="text" class="form-control" id="editAutor" name="autor" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEstado" class="form-label">Estado</label>
                        <select class="form-select" id="editEstado" name="estado" required>
                            <option value="disponible">Disponible</option>
                            <option value="prestado">Prestado</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>                        
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <h2 class="mb-4" style="color: gray; text-align: center">Resumen de Libros</h2>
    <canvas id="booksChart" width="400" height="200"></canvas>
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

        document.addEventListener('DOMContentLoaded', function() {
    // Función para llenar el formulario de edición
    function fillEditForm(book) {
        document.getElementById('editTitulo').value = book.titulo;
        document.getElementById('editAutor').value = book.autor;
        document.getElementById('editEstado').value = book.estado;
        document.getElementById('editBookForm').action = `/libros/${book.id}`;
    }

    // Event listener para abrir el modal de edición y obtener los datos del libro
    document.querySelectorAll('.edit-book-btn').forEach(button => {
        button.addEventListener('click', function() {
            const bookId = this.dataset.id;
            fetch(`/libros/${bookId}/edit`)
                .then(response => response.json())
                .then(book => {
                    fillEditForm(book);
                    new bootstrap.Modal(document.getElementById('editBookModal')).show();
                })
                .catch(error => console.error('Error:', error));
        });
    });

    // Confirmación para editar un libro
    document.getElementById('editBookForm').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Quieres guardar los cambios en este libro?",
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
});

$(document).ready(function() {
                $('#librosTable').DataTable();

                // Fetch and fill edit form
                $('.edit-book-btn').click(function() {
                    const bookId = $(this).data('id');
                    fetch(`/dashboard/libros/${bookId}/edit`)
                        .then(response => response.json())
                        .then(book => {
                            $('#editTitulo').val(book.titulo);
                            $('#editAutor').val(book.autor);
                            $('#editEstado').val(book.estado);
                            $('#editBookForm').attr('action', `/dashboard/libros/${book.id}`);
                            $('#editBookModal').modal('show');
                        })
                        .catch(error => console.error('Error:', error));
                });

                // Gráfico de libros
                const librosArray = @json($librosArray);
                const disponibleCount = librosArray.filter(libro => libro.estado === 'disponible').length;
                const prestadoCount = librosArray.filter(libro => libro.estado === 'prestado').length;
                const totalCount = librosArray.length;

                const ctx = document.getElementById('booksChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Disponible', 'Prestado', 'Total'],
                        datasets: [{
                            label: 'Cantidad de Libros',
                            data: [disponibleCount, prestadoCount, totalCount],
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(153, 102, 255, 0.2)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });    </script>

</x-app-layout>
