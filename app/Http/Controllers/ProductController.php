<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    function index(Request $request)
    {
        $categories = Category::orderBy('name', 'asc')->get();

        $query = Product::query();
        if ($request->name != null) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->category != null) {
            $query->where('category_id', $request->category);
        }
        if ($request->is_active != null) {
            $query->where('is_active', $request->is_active);
        }
        $products = $query->with('category')->paginate(20)->withQueryString();

        return view('admin.products.index', compact('products', 'categories'));
    }

    function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.products.create', compact('categories'));
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'stock' => 'required|integer|min:0',
            'is_active' => 'sometimes|boolean',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '.' . $extension;
            $directory = 'images/products';
            $fullPath = public_path($directory . '/' . $filename);

            if (!file_exists(public_path($directory))) {
                mkdir(public_path($directory), 0755, true);
            }

            $image = Image::decode($file->getContent())->coverDown(1000, 1000);
            $encoded = $image->encodeUsingFileExtension($extension, quality: 70);
            file_put_contents($fullPath, $encoded);

            $product->image = $directory . '/' . $filename;
        }

        $product->save();
        return redirect()->route('admin.products.index')->with('success', 'Produit ajouté avec succès');
    }

    function edit($id)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('categories', 'product'));
    }

    function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($product->image) {
                $oldPath = public_path($product->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '.' . $extension;
            $directory = 'images/products';
            $fullPath = public_path($directory . '/' . $filename);

            if (!file_exists(public_path($directory))) {
                mkdir(public_path($directory), 0755, true);
            }

            $image = Image::decode($file->getContent())->coverDown(1000, 1000);
            $encoded = $image->encodeUsingFileExtension($extension, quality: 70);
            file_put_contents($fullPath, $encoded);

            $product->image = $directory . '/' . $filename;
        }

        $product->save();
        return redirect()->route('admin.products.index')->with('success', 'Produit modifié avec succès');
    }

    function delete($id)
    {
        $product = Product::findOrFail($id);
        $orderItems = OrderItem::where('product_id', $product->id)->exists();

        if ($orderItems) {
            return redirect()->route('admin.products.index')->with('error', 'Le produit ne peut pas être supprimé car il est déjà présent dans une commande');
        }

        if ($product->image) {
            $oldPath = public_path($product->image);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé avec succès');
    }

    function changeStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->is_active = !$product->is_active;
        $product->save();
        return redirect()->route('admin.products.index')->with('success', 'Statut du produit changé avec succès');
    }
}
