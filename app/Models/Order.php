<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

/**
 * Représente une commande passée par un client.
 * Statuts possibles : open, preparation, awaiting, shipping, delivered.
 */
#[Guarded(['id'])]
class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
