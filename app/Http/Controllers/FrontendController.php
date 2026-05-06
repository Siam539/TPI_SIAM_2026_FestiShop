<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->sort_by) {
            $query->orderBy('price', $request->sort_by);
        }

        if ($request->in_stock == 'yes') {
            $query->where('stock', '>', 0);
        }

        $products = $query->paginate(15)->withQueryString();
        return view('frontend.index', compact('products'));
    }

    public function showProduct($slug)
    {
        $product = Product::where('slug', $slug)->with('category')->firstOrFail();
        return view('frontend.product-details', compact('product'));
    }

    public function cart()
    {
        $cartItems = null;
        $cartTotal = 0;
        $cartCount = 0;
        if (auth()->check()) {
            $cartItems = CartItem::where('user_id', auth()->user()->id)->with(['product.category'])->get();
            $cartCount = $cartItems->sum('quantity');
            foreach ($cartItems as $item) {
                $cartTotal += $item->product->price * $item->quantity;
            }
        }

        return view('frontend.cart', compact('cartItems', 'cartTotal', 'cartCount'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cartItem = CartItem::where('product_id', $product->id)->where('user_id', auth()->user()->id)->first();
        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            $cartItem = new CartItem();
            $cartItem->user_id = auth()->user()->id;
            $cartItem->product_id = $product->id;
            $cartItem->quantity = 1;
            $cartItem->save();
        }

        return redirect()->route('cart')->with('success', 'Produit ajouté avec succès au panier!');
    }

    public function syncCart(Request $request)
    {
        $userId = auth()->user()->id;
        $localCartItems = $request->input('cart_items');

        if (!$localCartItems || !is_array($localCartItems)) {
            return response()->json(['status' => false, 'message' => 'Aucun article à synchroniser']);
        }

        foreach ($localCartItems as $item) {
            $cartItem = CartItem::where('user_id', $userId)->where('product_id', $item['product_id'])->first();

            if ($cartItem) {
                $cartItem->quantity += $item['quantity'];
                $cartItem->save();
            } else {
                $cartItem = new CartItem();
                $cartItem->user_id = $userId;
                $cartItem->product_id = $item['product_id'];
                $cartItem->quantity = $item['quantity'];
                $cartItem->save();
            }
        }

        return response()->json(['status' => true, 'message' => 'Panier synchronisé avec succès']);
    }

    public function updateCartQuantity(Request $request)
    {
        $cartItem = CartItem::findOrFail($request->id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();
        return redirect()->route('cart')->with('success', 'Quantité mise à jour avec succès!');
    }

    public function deleteCartItem($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();
        return redirect()->route('cart')->with('success', 'Article supprimé avec succès du panier!');
    }

    public function checkout()
    {
        $cartTotal = 0;
        $cartItems = CartItem::where('user_id', auth()->user()->id)->with(['product.category'])->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Votre panier est vide!');
        }
        $cartCount = $cartItems->sum('quantity');
        foreach ($cartItems as $item) {
            $cartTotal += $item->product->price * $item->quantity;
        }
        return view('frontend.checkout', compact('cartItems', 'cartTotal', 'cartCount'));
    }

    public function checkoutStore(Request $request)
    {
        $request->validate([
            'billing_address' => 'required',
        ]);

        if ($request->different_shipping_address == 'yes') {
            $request->validate([
                'shipping_address' => 'required',
            ]);
        }

        $user = auth()->user();

        $cartItems = CartItem::where('user_id', $user->id)->with(['product.category'])->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Votre panier est vide!');
        }

        $cartTotal = 0;
        foreach ($cartItems as $item) {
            $cartTotal += $item->product->price * $item->quantity;
        }

        $user->billing_address = $request->billing_address;
        if ($request->different_shipping_address == 'yes') {
            $user->shipping_address = $request->shipping_address;
        } else {
            $user->shipping_address = $request->billing_address;
        }
        $user->save();

        $order = new Order();
        $order->user_id = $user->id;
        $order->total_price = $cartTotal;
        $order->save();

        foreach ($cartItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->quantity = $item->quantity;
            $orderItem->unit_price = $item->product->price;
            $orderItem->save();
        }

        CartItem::where('user_id', $user->id)->delete();

        return redirect()->route('order-confirmation', $order->id)->with('success', 'Commande passée avec succès!');
    }

    public function orderConfirmation($id)
    {
        $order = Order::with(['orderItems.product.category'])->findOrFail($id);
        return view('frontend.order-confirmation', compact('order'));
    }

    public function orders()
    {
        $orders = Order::where('user_id', auth()->user()->id)->with(['orderItems.product.category'])->get();
        return view('frontend.orders', compact('orders'));
    }

    public function orderDetails($id)
    {
        $order = Order::with(['orderItems.product.category'])->findOrFail($id);
        return view('frontend.order-details', compact('order'));
    }

    public function profile()
    {
        return view('frontend.profile');
    }

    public function profileDetailsUpdate(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'phone' => 'required|unique:users,phone,' . auth()->user()->id,
        ]);

        $user = auth()->user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('profile')->with('success', 'Informations mises à jour avec succès!');
    }

    public function profileAddressUpdate(Request $request)
    {
        $request->validate([
            'billing_address' => 'required',
            'shipping_address' => 'required',
        ]);

        $user = auth()->user();
        $user->billing_address = $request->billing_address;
        $user->shipping_address = $request->shipping_address;
        $user->save();

        return redirect()->route('profile')->with('success', 'Adresse mise à jour avec succès!');
    }

    public function profilePasswordUpdate(Request $request)
    {
        $request->validate([
            'password_current' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = auth()->user();
        if (!Hash::check($request->password_current, $user->password)) {
            return redirect()->route('profile')->with('error', 'Mot de passe actuel incorrect!');
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('profile')->with('success', 'Mot de passe mis à jour avec succès!');
    }
}
