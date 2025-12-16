<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
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

    @if(empty(session('Panier')))
        <div class="card mb-3 col mx-auto" style="max-width: 300px;">
            <div class="card-header">
                Résumé
            </div>
            <div class="card-body">
                <h5 class="card-title">Votre panier est vide !</h5>
            </div>
        </div>
    @else
        @foreach(session('Panier') as $id)
            @php
                $bait = $baits->where('Id', $id)->first();
                $prix = $quantites[$id - 1] * $bait->prix;
            @endphp
            <div class="card mb-3 col mx-auto" style="max-width: 850px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('images/' . $bait->nomImg) }}" class="img-fluid rounded-start" alt="">
                    </div>
                    <div class="col-md-8 ">
                        <div class="card-body">
                            <h5 class="card-title">{{ $bait->nom }}</h5>
                            <p class="card-text">{{ $bait->descriptif }}</p>
                            <p class="card-text">{{ $prix }}€</p>
                            <p class="card-text">Quantite : {{ $quantites[$bait->Id - 1] }}</p>
                            <form action="{{ url('/suppPanier/' . $bait->Id) }}" method="POST">
                                @csrf
                                @csrf
                                <div class="row g-3">
                                    <div class="col-auto">
                                        <label for="staticEmail2" class="visually-hidden"></label>
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Quantite à supprimer ">
                                    </div>
                                    <div class="col-auto">
                                        <label for="inputPassword2" class="visually-hidden">Quantite à supprimer</label>
                                        <input type="text" class="form-control" name="quantite">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-3">Confirmer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if(!empty(session('Panier')))
    <div class="card mb-3 col mx-auto" style="max-width: 300px;">
        <a href="{{ url('/supPanier') }}" class="btn btn-primary">Supprimer tout le panier</a>
    </div>
    <div class="card mb-3 col mx-auto" style="max-width: 300px;">
        <div class="card-header">
            Résumé
        </div>
        <div class="card-body">
            <h5 class="card-title">Résumé de la commande</h5>
            <p class="card-text">Total de la commande : {{ $prixTotal }} €</p>
            <a href="{{ url('/paiement') }}" class="btn btn-primary">Payer</a>
        </div>
    </div>
    @endif
</body>
</html>