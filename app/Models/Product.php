<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'naziv',
        'opis',
        'cijena',
        'kolicina',
        'izvor',
    ];

    protected function casts(): array
    {
        return [
            'cijena' => 'decimal:2',
            'kolicina' => 'integer',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
