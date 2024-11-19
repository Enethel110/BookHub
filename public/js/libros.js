document.getElementById('searchInput').addEventListener('input', function() {
    let query = this.value; // Obtiene el valor del campo de búsqueda

    // Realiza la solicitud AJAX si hay algo que buscar
    fetch(`/dashboard?search=${query}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest', // Asegura que es una solicitud AJAX
            }
        })
        .then(response => response.json()) // Espera la respuesta en formato JSON
        .then(data => {
            // Reemplaza el contenido de los libros con los nuevos resultados
            document.getElementById('librosContainer').innerHTML = data.libros;
            // Actualiza la paginación
            document.querySelector('.pagination').innerHTML = data.pagination;
        })
        .catch(error => console.error('Error en la solicitud AJAX:', error));
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
            icon: 'error',
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
            icon: 'info',
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
                    new bootstrap.Modal(document.getElementById('editBookModal'))
                        .show();
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
            icon: 'info',
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

    if (window.librosArray) {
        const disponibleCount = window.librosArray.filter(libro => libro.estado === 'disponible').length;
        const prestadoCount = window.librosArray.filter(libro => libro.estado === 'prestado').length;
        const totalCount = window.librosArray.length;

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
    } else {
        console.error('librosArray no está definido');
    }
});
