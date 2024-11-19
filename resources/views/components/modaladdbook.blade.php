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
