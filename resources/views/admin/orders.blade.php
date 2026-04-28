@extends('layouts.admin')

@section('content')

    <div class="my-4">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h1 class="mb-0">Gestion des commandes</h1>
            <button class="btn btn-primary">
                <i class="fa-solid fa-plus me-2"></i>Créer une commande
            </button>
        </div>

        {{-- Filtres --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" class="form-control" placeholder="Rechercher par numéro ou client...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <select class="form-select">
                            <option selected>Tous les statuts</option>
                            <option>Ouverte</option>
                            <option>En préparation</option>
                            <option>En attente de produit</option>
                            <option>En cours d'envoi</option>
                            <option>Livré</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tableau (de la + récente à la + ancienne) --}}
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>N°</th>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Articles</th>
                            <th>Total</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td><strong>#00128</strong></td>
                            <td>24 avril 2026</td>
                            <td>Marie Leroy</td>
                            <td>3</td>
                            <td><strong>49.70 CHF</strong></td>
                            <td><span class="badge bg-info text-dark">Ouverte</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary" title="Voir détails">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" title="Valider">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>#00127</strong></td>
                            <td>23 avril 2026</td>
                            <td>John Doe</td>
                            <td>1</td>
                            <td><strong>14.90 CHF</strong></td>
                            <td><span class="badge bg-warning text-dark">En préparation</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary" title="Voir détails">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" title="Valider">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>#00126</strong></td>
                            <td>21 avril 2026</td>
                            <td>Pierre Dubois</td>
                            <td>2</td>
                            <td><strong>29.80 CHF</strong></td>
                            <td><span class="badge bg-secondary">En attente de produit</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary" title="Voir détails">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" title="Valider">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>#00125</strong></td>
                            <td>18 avril 2026</td>
                            <td>John Doe</td>
                            <td>1</td>
                            <td><strong>23.90 CHF</strong></td>
                            <td><span class="badge bg-primary">En cours d'envoi</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary" title="Voir détails">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>#00124</strong></td>
                            <td>15 avril 2026</td>
                            <td>John Doe</td>
                            <td>2</td>
                            <td><strong>11.80 CHF</strong></td>
                            <td><span class="badge bg-success">Livré</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary" title="Voir détails">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-muted mt-3 small">
            <i class="fa-solid fa-circle-info me-1"></i>
            Les commandes sont affichées de la plus récente à la plus ancienne.
        </div>

    </div>

@endsection