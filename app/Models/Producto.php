<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'categoria_id',
        'imagen'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function scopeSearch($query, $term)
{
    if (!$term) {
        return $query;
    }

    return $query->where(function($q) use ($term) {
        $q->where('nombre', 'LIKE', '%'.$term.'%')
          ->orWhere('descripcion', 'LIKE', '%'.$term.'%');
    });
}
}