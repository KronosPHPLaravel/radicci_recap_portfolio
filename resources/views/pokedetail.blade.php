<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ucfirst($pokemon['name'])}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                    <input class="form-control me-2" type="search" name="name" id="query" placeholder="Nome Pokémon" aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit">Cerca</button>
                </form>
            </div>
        </div>
    </nav>
    <ul>
        {{ucfirst($pokemon['name'])}}
        <img src="{{$pokemon['sprites']['front_default']}}">
        <img src="{{$pokemon['sprites']['front_shiny']}}">
    </ul>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>