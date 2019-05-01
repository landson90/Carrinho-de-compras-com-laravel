<?php

namespace App\Http\Controllers\V1;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\PedidoProduto;

class CarrinhoController extends Controller
{
   
    private $pedido;
    private $produto;
    private $pedidoProduto;

    public function __construct(Pedido $pedido, Produto $produto, PedidoProduto $pedidoProduto)
    {
        $this->pedido        = $pedido;
        $this->produto       = $produto;
        $this->pedidoProduto = $pedidoProduto;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = $this->pedido
                        ->where([
                            'status'  => 'RE',
                            'user_id' => auth()->user()->id 
                        ])->get();
                            //dd( $pedidos[0]->pedido_protudos);
        return view('painel.carrinho.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function adicionar($id)
    {
        //  PRIMEIRO PASSO É CRIAR UM PEDIDO
        //'status', 'valor', 'desconto', 'produto_id', 'pedido_id', 'cupom_desconto_id'
        
        $user = auth()->user()->id;

        $produto = $this->produto->find($id);

        $createPedido = $this->pedido->create([
            'status'  => 'RE',
            'user_id' => $user
        ]);

        $pedidoId = $createPedido->id;

        //  SEGUNDO PASSO É CRIAR UM PEDIDO_PRODUTO
       
        $createPedidoProduto = $this->pedidoProduto->create([
            'status' => 'RE', 
            'valor'  =>  $produto->valor, 
            'desconto' => 0, 
            'produto_id' => $produto->id, 
            'pedido_id' => $pedidoId,
        ]);

        if ($createPedido && $createPedidoProduto):
            $this->index();
        endif;
        

    }
}
