<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Représente un utilisateur de la plateforme.
 * Trois rôles possibles : customer, manutentionnaire, admin.
 */
#[Guarded(['id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable {
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
    // Accessor : retourne le nom complet via $user->name
    public function getNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }
}
