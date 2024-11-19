<!-- Barra de búsqueda -->
<form class="mb-4" action="{{ route('dashboard') }}" method="GET">
    <div class="input-group">
        <input id="searchInput" type="text" class="form-control" placeholder="Buscar por título o autor" name="search"
            value="{{ request()->search }}"><select name="estado">
                <option value="">Todos</option>
                <option value="disponible" {{ request('estado') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="prestado" {{ request('estado') == 'prestado' ? 'selected' : '' }}>Prestado</option>
            </select>
        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
    </div>
</form>
