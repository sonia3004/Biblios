<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'genre',
        'year',
        'available',
        'reserved_by_first_name',
        'reserved_by_last_initial',
    ];

    protected $casts = [
        'available' => 'boolean',
    ];

    // Relation : livres favoris
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    // Relation : réservations des livres
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
