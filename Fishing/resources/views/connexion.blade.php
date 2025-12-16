<link rel='stylesheet' type='text/css' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
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
<div class="d-flex justify-content-center align-items-center vh-100">
<div class="login-container align-right" style="width: 350px;">
    <h2 class="text-center">Connexion</h2>
    <form ACTION="{{ url('/login') }}" METHOD='POST'>
        @csrf
        @csrf
        <input name="login" type="username" class="form-control mb-3" placeholder="Nom d'utilisateur" required>
        <input name="pwd" type="password" class="form-control mb-3" placeholder="Mot de passe" required>
        <div class="text-center">
        <INPUT class="btn btn-primary" TYPE='SUBMIT' VALUE='Se connecter'>
        </div>
        @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif
    </form>
</div>
</div>