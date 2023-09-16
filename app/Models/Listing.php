<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model da listagem, com a criação e validação de filtros.
 */
class Listing extends Model
{
    /**
     * Utilizado para verificar factory.
     */
    use HasFactory;

    // protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags'];

    /**
     * Método para realizar pesquisa e filtragem por tags.
     *
     * @param  object $query pesquisa a ser realizada.
     * @param  array $filters filtros a serem usados nas pesquisas.
     * @return query pesquisa.
     */
    public function scopeFilter($query, array $filters)
    {
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
        
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }
}
