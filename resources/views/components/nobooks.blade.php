<!-- Mensaje de éxito -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div id="noBooksMessage" class="alert alert-warning" style="display: none;">
    No hay libros disponibles.
</div>
