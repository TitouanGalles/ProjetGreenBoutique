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
    <div class="position-relative" style="height: 100vh;">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="card text-center">
                <div class="card-header">
                    Paiement
                </div>
                <div class="card-body">
                    <form action="{{ url('/verifPaiement') }}" method="POST">
                        @csrf
                        @csrf
                        <h5 class="card-title">Ajout d'une carte de crédit :</h5>
                        <p class="card-text"><label>Numéro de carte</label><input type="text" name="numCarte" value="{{ old('numCarte') }}" /></p>
                        @if(session('verifCarte') === false)
                        <p class="text-danger">Code de carte incorrecte</p>
                        @endif
                        <br/><br/>
                        <p class="card-text"><label>Date d'expiration</label><input name="date" type="date" value="{{ old('date') }}"/></p>
                        @if(session('verifDate') === false)
                        <p class="text-danger">Date d expiration incorrecte</p>
                        @endif
                        @if(session('verifDate') === true && session('verifCarte') === true)
                        <p class="text-success">Paiement réussi</p>
                        @endif
                        <input type="submit" value="Payer">
                    </form>
                </div>
            </div>


        </div>
    </div>
</body>
</html>