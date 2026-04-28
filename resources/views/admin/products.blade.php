@extends('layouts.admin')

@section('content')

    <div class="my-4">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h1 class="mb-0">Gestion des produits</h1>
            <button class="btn btn-primary">
                <i class="fa-solid fa-plus me-2"></i>Créer un produit
            </button>
        </div>

        {{-- Filtres --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" class="form-control" placeholder="Rechercher par nom...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option selected>Toutes les catégories</option>
                            <option>Anniversaire</option>
                            <option>Mariage</option>
                            <option>Noël</option>
                            <option>Halloween</option>
                            <option>Pâques</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select">
                            <option selected>Tous les statuts</option>
                            <option>Actif</option>
                            <option>Inactif</option>
                            <option>Rupture de stock</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tableau des produits --}}
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th>Stock</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>001</td>
                            <td>
                                <img src="{{ asset('images/products/banderoles.jpg') }}"
                                     alt="Banderoles"
                                     class="rounded"
                                     style="width: 50px; height: 50px; object-fit: cover;">
                            </td>
                            <td><strong>Riethmüller Banderoles</strong></td>
                            <td><span class="badge bg-secondary">Anniversaire</span></td>
                            <td>5.90 CHF</td>
                            <td>8</td>
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

                        <tr>
                            <td>002</td>
                            <td>
                                <img src="{{ asset('images/products/happy-birthday.jpg') }}"
                                     alt="I Am Creative Set"
                                     class="rounded"
                                     style="width: 50px; height: 50px; object-fit: cover;">
                            </td>
                            <td><strong>I Am Creative Set</strong></td>
                            <td><span class="badge bg-secondary">Anniversaire</span></td>
                            <td>23.90 CHF</td>
                            <td>15</td>
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

                        <tr>
                            <td>003</td>
                            <td>
                                <img src="{{ asset('images/products/birthday-girl.jpg') }}"
                                     alt="Écharpe Birthday Girl"
                                     class="rounded"
                                     style="width: 50px; height: 50px; object-fit: cover;">
                            </td>
                            <td><strong>MU Style Écharpe Birthday Girl</strong></td>
                            <td><span class="badge bg-secondary">Anniversaire</span></td>
                            <td>14.90 CHF</td>
                            <td>0</td>
                            <td><span class="badge bg-danger">Rupture</span></td>
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

                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-muted mt-3 small">
            <i class="fa-solid fa-circle-info me-1"></i>
            La suppression est possible uniquement si le produit n'est utilisé dans aucune commande.
        </div>

    </div>

@endsection