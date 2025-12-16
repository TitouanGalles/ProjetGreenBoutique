<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Leurres</title>
    <!-- Inclure Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Inclure DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Inclure DataTables Boutons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
</head>

<body>
    <!-- Barre de navigation -->
    <main>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">Fishing</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="{{ url('/logout') }}">Deconnexion</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </main>

    <!-- Bouton Ajouter -->
    <div class="container mt-5">
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLeurreModal">Ajouter un
                Leurre</button>
        </div>

        <!-- Tableau avec DataTables -->
        <h2 class="mb-4">Liste des Leurres</h2>
        <table id="leurreTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>ID</th>
                    <th>Actions</th> <!-- Colonne pour les boutons d'actions -->
                </tr>
            </thead>
            <tbody>
                @foreach ($baits as $bait)
                <tr>
                    <td><img src="{{ asset('images/' . $bait->nomImg) }}" class="img-fluid" alt="Image"
                            style="max-width: 100px;"></td>
                    <td>{{ $bait->nom }}</td>
                    <td>{{ $bait->descriptif }}</td>
                    <td>{{ $bait->prix }} €</td>
                    <td>{{ $bait->Id }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $bait->Id }}">
                            Modifier</button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $bait->Id }}">
                            Supprimer</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modale Modifier -->
    @foreach ($baits as $bait)
    <div class="modal fade" id="editModal{{ $bait->Id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ url('/backoffice/update/' . $bait->Id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Modifier le Leurre</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="edit-id" value="{{ $bait->Id }}">

                        <div class="mb-3">
                            <label for="edit-nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="edit-nom" name="edit-nom" value="{{ $bait->nom }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-descriptif" class="form-label">descriptif</label>
                            <textarea class="form-control" id="edit-descriptif" name="edit-descriptif" rows="3" required>{{ $bait->descriptif }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="edit-prix" class="form-label">Prix</label>
                            <input type="number" step="0.01" class="form-control" id="edit-prix" name="edit-prix" value="{{ $bait->prix }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="files" class="form-label">Image</label>
                            <input type="file" class="form-control" id="files" name="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" name="edit-leurre" class="btn btn-primary">Modifier</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach

    <!-- Modale pour ajouter un leurre -->
    <div class="modal fade" id="addLeurreModal" tabindex="-1" aria-labelledby="addLeurreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLeurreModalLabel">Ajouter un Leurres</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <form action="{{ url('/backoffice/store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                        @csrf
                        <div class="mb-3">
                            <label for="add-id" class="form-label">Id</label>
                            <input type="text" class="form-control" id="add-id" name="add-id" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="add-nom" name="add-nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-descriptif" class="form-label">Descriptif</label>
                            <input type="text" class="form-control" id="add-descriptif" name="add-descriptif" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-prix" class="form-label">Prix</label>
                            <input type="number" class="form-control" id="add-prix" name="add-prix" step="0.01"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Image</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>
                        <button type="submit" name="add-leurre" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modale de Confirmation de Suppression -->
    @foreach ($baits as $bait)
    <div class="modal fade" id="deleteModal{{ $bait->Id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la Suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer ce leurre ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form action="{{ url('/backoffice/delete/' . $bait->Id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach


    <!-- Inclure jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Inclure DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- Inclure Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script pour initialiser DataTables -->
    <script>
        $(document).ready(function () {
            $('#leurreTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "language": {
                    "lengthMenu": "Afficher _MENU_ leurres par page",
                    "zeroRecords": "Aucun leurre trouvé",
                    "info": "Page _PAGE_ de _PAGES_",
                    "infoEmpty": "Aucun leurre disponible",
                    "infoFiltered": "(filtré parmi _MAX_ leurres)",
                    "search": "Rechercher :"
                }
            });
        });
    </script>
</body>

</html>