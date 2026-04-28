@extends('layouts.frontend')

@section('content')
    <div class="my-4">
        {{-- En-tête avec titre et bouton créer --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h1 class="mb-0">Gestion des utilisateurs</h1>
            <button class="btn btn-primary">
                <i class="fa-solid fa-plus me-2"></i>Créer un utilisateur
            </button>
        </div>

        {{-- Barre de recherche + filtres --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" class="form-control" placeholder="Rechercher par nom ou prénom...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option selected>Tous les rôles</option>
                            <option>Client</option>
                            <option>Manutentionnaire</option>
                            <option>Administrateur</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option selected>Tous les statuts</option>
                            <option>Actif</option>
                            <option>Inactif</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tableau des utilisateurs --}}
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- Utilisateur 1 --}}
                        <tr>
                            <td>001</td>
                            <td><strong>Doe</strong></td>
                            <td>John</td>
                            <td>john.doe@example.com</td>
                            <td><span class="badge bg-primary">Client</span></td>
                            <td><span class="badge bg-success">Actif</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary" title="Modifier">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Désactiver">
                                    <i class="fa-solid fa-ban"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Supprimer">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- Utilisateur 2 --}}
                        <tr>
                            <td>002</td>
                            <td><strong>Kazi</strong></td>
                            <td>Siam</td>
                            <td>siam.kazi@example.com</td>
                            <td><span class="badge bg-danger">Administrateur</span></td>
                            <td><span class="badge bg-success">Actif</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary" title="Modifier">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Désactiver">
                                    <i class="fa-solid fa-ban"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Supprimer">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- Utilisateur 3 --}}
                        <tr>
                            <td>003</td>
                            <td><strong>Martin</strong></td>
                            <td>Sophie</td>
                            <td>sophie.martin@example.com</td>
                            <td><span class="badge bg-success">Manutentionnaire</span></td>
                            <td><span class="badge bg-success">Actif</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary" title="Modifier">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Désactiver">
                                    <i class="fa-solid fa-ban"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Supprimer">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- Utilisateur 4 --}}
                        <tr>
                            <td>004</td>
                            <td><strong>Dubois</strong></td>
                            <td>Pierre</td>
                            <td>pierre.dubois@example.com</td>
                            <td><span class="badge bg-primary">Client</span></td>
                            <td><span class="badge bg-secondary">Inactif</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary" title="Modifier">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" title="Activer">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Supprimer">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- Utilisateur 5 --}}
                        <tr>
                            <td>005</td>
                            <td><strong>Leroy</strong></td>
                            <td>Marie</td>
                            <td>marie.leroy@example.com</td>
                            <td><span class="badge bg-primary">Client</span></td>
                            <td><span class="badge bg-success">Actif</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary" title="Modifier">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Désactiver">
                                    <i class="fa-solid fa-ban"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Supprimer">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        {{-- Info en bas --}}
        <div class="text-muted mt-3 small">
            <i class="fa-solid fa-circle-info me-1"></i>
            Les utilisateurs sont affichés par ordre alphabétique (Nom, Prénom)
        </div>
    </div>
@endsection
