<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;

class PedidoProduto extends Model
{
    public function produtos()
    {
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }
}
