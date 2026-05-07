<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

/**
 * Gère le CRUD des catégories dans l'interface admin.
 * Une catégorie ne peut pas être supprimée si elle contient des produits.
 */
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->paginate(20)->withQueryString();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    // Valide et enregistre une nouvelle catégorie avec normalisation du slug
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name|max:255',
            'slug' => 'required|string|unique:categories,slug|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            // Normalise le slug : minuscules et espaces remplacés par des tirets
            'slug' => strtolower(str_replace(' ', '-', $request->slug)),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie créée avec succès.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id . '|max:255',
            'slug' => 'required|string|unique:categories,slug,' . $category->id . '|max:255',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->slug)),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    // Vérifie l'intégrité avant suppression
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        // Empêche la suppression d'une catégorie qui contient encore des produits
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'La catégorie ne peut pas être supprimée car elle contient des produits.');
        }
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}
