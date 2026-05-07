<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Gère les fonctionnalités réservées aux administrateurs et manutentionnaires :
 * suivi et mise à jour des commandes, gestion des utilisateurs (CRUD).
 */
class AdminController extends Controller
{
    // Retourne la liste des commandes selon le rôle de l'utilisateur connecté
    public function adminOrders()
    {
        // Filtre les commandes selon le rôle : le manutentionnaire ne traite que les commandes actives
        if (auth()->user()->role == 'manutentionnaire') {
            $orders = Order::with('user')->whereIn('status', ['open', 'preparation', 'awaiting', 'shipping'])->latest()->get();
        } else {
            $orders = Order::with('user')->latest()->get();
        }
        return view('admin.orders', compact('orders'));
    }

    public function orderDetails($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order-details', compact('order'));
    }

    // Met à jour le statut d'une commande, avec vérification et décrémentation du stock si expédition
    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Le stock est déduit uniquement au moment de l'expédition, pas à la commande
        if ($request->status == 'shipping') {
            //Verification du stock
            $is_insufficient = false;
            foreach ($order->orderItems as $item) {
                if ($item->product->stock < $item->quantity) {
                    $is_insufficient = true;
                    break;
                }
            }

            if ($is_insufficient) {
                $order->update([
                    'status' => 'awaiting',
                ]);

                return back()->with('warning', 'Stock insuffisant pour la commande.');
            }

            //Décrémentation du stock
            foreach ($order->orderItems as $item) {
                $item->product->update([
                    'stock' => $item->product->stock - $item->quantity,
                ]);
            }
        }

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Statut de la commande modifié avec succès.');
    }

    // Liste les utilisateurs avec filtres par nom, rôle et statut
    public function usersList(Request $request)
    {
        $query = User::query();
        if ($request->name != null) {
            $query->where('first_name', 'like', '%' . $request->name . '%')->orWhere('last_name', 'like', '%' . $request->name . '%');
        }
        if ($request->role != null) {
            $query->where('role', $request->role);
        }
        if ($request->is_active != null) {
            $query->where('is_active', $request->is_active);
        }
        $users = $query->orderBy('last_name', 'asc')->paginate(20)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        // La création d'un compte admin n'est pas autorisée depuis le panel
        $validated = $request->validate([
            'last_name' => 'required|string|max:50',
            'first_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email|max:100',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:customer,manutentionnaire',
        ]);

        $user = User::create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'last_name' => 'required|string|max:50',
            'first_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id . '|max:100',
            'phone' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:customer,manutentionnaire',
        ]);

        $user->update([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'role' => $validated['role'],
        ]);

        // Mise à jour du mot de passe uniquement si un nouveau a été saisi
        if ($validated['password']) {
            $user->update([
                'password' => Hash::make($validated['password']),
            ]);
        }
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur modifié avec succès.');
    }

    // Active ou désactive un compte utilisateur
    public function changeStatus($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'is_active' => !$user->is_active,
        ]);
        return redirect()->route('admin.users.index')->with('success', 'Statut de l\'utilisateur modifié avec succès.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        // Impossible de supprimer un utilisateur qui a des commandes en base
        if ($user->orders()->count() > 0) {
            return redirect()->route('admin.users.index')->with('error', 'Utilisateur ne peut pas être supprimé car il a des commandes.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
