<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokedex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><img src="/pokeball.png" style="width: 50px; height: 50px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Homepage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/info">Chi Siamo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contacts">Contatti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pokelist">Pokedex</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="/pokedetail" method="GET">
                    <input class="form-control me-2" type="search" name="name" id="query"
                        placeholder="Nome Pokémon" aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit">Cerca</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center text-center align-items-center">
            <div class="col-12 d-flex justify-content-center">
                <form action="/pokelist" method="get" class="w-25 mx-auto">
                    <div class="form-group">
                        <label for="region">Scegli una regione:</label>
                        <select class="form-control" id="region" name="region" onchange="this.form.submit()">
                            <option value="Kanto" {{ request('region') == 'Kanto' ? 'selected' : '' }}>Kanto</option>
                            <option value="Johto" {{ request('region') == 'Johto' ? 'selected' : '' }}>Johto</option>
                            <option value="Hoenn" {{ request('region') == 'Hoenn' ? 'selected' : '' }}>Hoenn</option>
                            <option value="Sinnoh" {{ request('region') == 'Sinnoh' ? 'selected' : '' }}>Sinnoh</option>
                            <option value="Unova" {{ request('region') == 'Unova' ? 'selected' : '' }}>Unova</option>
                            <option value="Kalos" {{ request('region') == 'Kalos' ? 'selected' : '' }}>Kalos</option>
                            <option value="Alola" {{ request('region') == 'Alola' ? 'selected' : '' }}>Alola</option>
                            <option value="Galar-Hisui" {{ request('region') == 'Galar-Hisui' ? 'selected' : '' }}>
                                Galar-Hisui</option>
                            <option value="Paldea" {{ request('region') == 'Paldea' ? 'selected' : '' }}>Paldea</option>
                            <option value="Extra" {{ request('region') == 'Extra' ? 'selected' : '' }}>Forme
                                Alternative</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-center text-center ">
            @foreach ($pokemons as $pokemon)
                <div class="col-4 d-flex justify-content-center py-4">
                    <div class="card align-items-center justify-content-center" style="width: 18rem;">
                        <img src="{{ $pokemon['sprites']['front_default'] }}" width="200px" height="auto">
                        <img src="{{ $pokemon['sprites']['front_shiny'] }}" width="200px" height="auto">
                        <div class="card-body text-center">
                            <h2 class="card-title text-center">{{ ucfirst($pokemon['name']) }}</h2>
                            <p>#{{ $pokemon['order'] }}</p>
                            <a href="/pokedetail/{{ $pokemon['name'] }}" class="btn btn-secondary">Apri</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col text-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <!-- Link alla pagina precedente -->
                        @if ($currentPage > 1)
                            <li class="page-item">
                                <a class="page-link" href="?page=1&region={{ $region }}">Start</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link"
                                    href="?page={{ $currentPage - 1 }}&region={{ $region }}">Previous</a>
                            </li>
                        @endif

                        <!-- Link per ogni pagina -->
                        @for ($i = $startPage; $i <= $endPage; $i++)
                            <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                <a class="page-link"
                                    href="?page={{ $i }}&region={{ $region }}">{{ $i }}</a>
                            </li>
                        @endfor

                        <!-- Link alla pagina successiva -->
                        @if ($currentPage < $totalPages)
                            <li class="page-item">
                                <a class="page-link"
                                    href="?page={{ $currentPage + 1 }}&region={{ $region }}">Next</a>
                            </li>
                            @if ($currentPage != $totalPages - 1)
                                <li class="page-item">
                                    <a class="page-link"
                                        href="?page={{ $totalPages }}&region={{ $region }}">{{ $totalPages }}</a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
