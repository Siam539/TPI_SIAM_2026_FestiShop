<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminProducts()
    {
        return view('admin.products');
    }

    public function adminOrders()
    {
        return view('admin.orders');
    }

    public function usersList(Request $request)
    {
        $query = User::query();
        if ($request->name) {
            $query->where('first_name', 'like', '%' . $request->name . '%')->orWhere('last_name', 'like', '%' . $request->name . '%');
        }
        if ($request->role) {
            $query->where('role', $request->role);
        }
        if ($request->is_active) {
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

        return redirect()->route('admin.users')->with('success', 'Utilisateur créé avec succès.');
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

        if ($validated['password']) {
            $user->update([
                'password' => Hash::make($validated['password']),
            ]);
        }
        return redirect()->route('admin.users')->with('success', 'Utilisateur modifié avec succès.');
    }

    public function changeStatus($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'is_active' => !$user->is_active,
        ]);
        return redirect()->route('admin.users')->with('success', 'Statut de l\'utilisateur modifié avec succès.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
