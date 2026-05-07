<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

/**
 * Représente une catégorie de produits.
 */
#[Guarded(['id'])]
class Category extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
