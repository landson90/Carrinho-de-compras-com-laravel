<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PedidoProduto;

class Pedido extends Model
{
    protected $fillable = ['status', 'user_id'];
    
    public function pedido_protudos()
    {
        return $this->hasMany(PedidoProduto::class)
                    ->select(\DB::raw('produto_id, sum(desconto) as descontos, sum(valor) as valores, count(1) as qtd'))
                    ->groupBy('produto_id')
                    ->orderBy('produto_id', 'desc');
    }

    public function pedido_produto_item() 
    {
        return $this->hasMany(PedidoProduto::class);
    }
    
    public function consultaPedido($value)
    {
        $pedido = self::where($value)->first();
        return !empty($pedido->id)? $pedido->id : null;
    }
    
}
