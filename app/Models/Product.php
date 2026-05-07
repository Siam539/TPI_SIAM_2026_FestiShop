<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

/**
 * Représente un produit du catalogue avec son stock, son prix et son image.
 */
#[Guarded(['id'])]
class Product extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
