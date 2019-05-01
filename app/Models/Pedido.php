<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PedidoProduto;

class Pedido extends Model
{
    public function pedido_protudos()
    {
        return $this->hasMany(PedidoProduto::class)
                    ->select(\DB::raw('produto_id, sum(desconto) as descontos, sum(valor) as valores, count(1) as Qtd'))
                    ->groupBy('produto_id')
                    ->orderBy('produto_id', 'desc');
    }
    
}
