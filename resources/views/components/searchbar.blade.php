<!-- Barra de búsqueda -->
<form class="mb-4" action="{{ route('dashboard') }}" method="GET">
    <div class="input-group">
        <input id="searchInput" type="text" class="form-control" placeholder="Buscar por título o autor" name="search"
            value="{{ request()->search }}">
        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
    </div>
</form>
