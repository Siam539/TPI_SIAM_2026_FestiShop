<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function order()
    {
        return view('frontend.orders');
    }

    public function products()
    {
        return view('frontend.products');
    }

    public function users()
    {
        return view('frontend.users');
    }
    public function profile()
    {
        return view('frontend.profile');
    }
}
