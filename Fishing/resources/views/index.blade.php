<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
    <title>Fishing</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Fishing</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" href="{{ url('/connexion') }}">Connexion</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ url('/panier') }}">Panier</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <div class="row row-cols-1 row-cols-md-5 g-4 mx-auto">
        @foreach($baits as $bait)
        <div class="col mb-5">
            <div class="card">
                <a href="{{ asset('images/' . $bait->nomImg) }}" target="_blank">
                    <img src="{{ asset('images/' . $bait->nomImg) }}" alt="" class="card-img-top" style="width: 100%; height: auto;">
                </a>

            <div class="card-body bg-secondary">
                <h5>{{ $bait->nom }}<br/>{{ $bait->descriptif }}<br/>{{ $bait->prix }}€</br></h5>
                <a href="{{ url('/ajoutPanier/' . $bait->Id) }}" class="btn btn-primary">Ajouter au panier</a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ $bait->Id }}">Infos</button>
                    <div class="modal fade" id="{{ $bait->Id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $bait->Id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="{{ $bait->Id }}">{{ $bait->nom }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <img src="{{ asset('images/' . $bait->nomImg) }}" alt="Image" style="width: 80%; max-width: 400px; height: auto;">
                                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        @endforeach
    </div>



</body>
</html>
