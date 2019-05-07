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
        $dataForm = $request->all();

       $produto = $this->produto->find($dataForm['produto_id']);
       $user = auth()->user()->id;

       $pedidoId = $this->pedido->consultaPedido([
           'user_id' => $dataForm['user_id'],
           'status'  => 'RE'
       ]);

       if(empty($pedidoId)):

           $newPedido = $this->pedido->create([
               'user_id' =>  $dataForm['user_id'],
               'status'  => 'RE'
           ]);

            $pedidoId = $newPedido->id;

        endif;
        
       $createPedidoProduto =  $this->pedidoProduto->create([
            'status'        => 'RE',
            'valor'         =>  $produto->valor, 
            'produto_id'    =>  $produto->id, 
            'pedido_id'     =>  $pedidoId,
        ]);

        if($createPedidoProduto){
            session()->flash('success', 'PRODUTO ADICIONADO AO CARRINHO COM SUCESSO  .');
            return redirect()->route('carrinho.index');
        }
    }

    public function remover(Request $request)
    {
        $dataForm = $request->all();

        $remove_apenas_item = (boolean)$dataForm['item'];
        
        $user = auth()->user();

        $pedido = $this->pedido->consultaPedido([

            'user_id' => $user->id,
            'id'      => $dataForm['pedido_id'],
            'status'  => 'RE'

        ]);

        if(empty($pedido)) {
            session()->flash('error', 'Pedido não encontrado !');
            return redirect()->route('carrinho.listar');
        }

        $where_produto = [
            'pedido_id'     => $dataForm['pedido_id'],
            'produto_id'    => $dataForm['produto_id']
        ];

        $produto = $this->pedidoProduto->where($where_produto)->orderBy('id', 'desc')->first();
        
        if(empty($produto->id)) {
            session()->flash('error', 'Produto não encontrado no carrinho !');
            return redirect()->route('carrinho.listar');
        }

        if($remove_apenas_item) {
            $where_produto['id'] = $produto->id;
        }
       
        $this->pedidoProduto->where($where_produto)->delete();
        
        $check_pedido = $this->pedidoProduto->where([
            'pedido_id' => $produto->pedido_id
        ])->exists();
            
        if(!$check_pedido) {
            $this->pedido->where([
                'id' => $produto->pedido_id
            ])->delete(); 
        }

        session()->flash('success', 'Produto removido com sucesso do carrinho !');
        return redirect()->route('carrinho.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = $this->produto->find($id);
        $user    = auth()->user();
       
        if($produto):
            return view('painel.produto.show', compact('produto', 'user'));
        endif;
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
    }

    public function addProduto(Request $request)
    {
        
       $dataForm = $request->all();
      
       $produto = $this->produto->find($dataForm['id']);

       $user = auth()->user()->id;

       $pedidoId = $this->pedido->consultaPedido([
        'user_id' => $user,
        'status'  => 'RE'
       ]);

       if(empty($pedidoId)) {
        $newPedido = $this->pedido->create([
            'user_id' => $user,
            'status'  => 'RE'
        ]);

         $pedidoId = $newPedido->id;

       }

       $createPedidoProduto =  $this->pedidoProduto->create([
        'status'        => 'RE',
        'valor'         =>  $produto->valor, 
        'produto_id'    =>  $produto->id, 
        'pedido_id'     =>  $pedidoId,
        ]);
        
        dd($createPedidoProduto);

        if($createPedidoProduto){
            session()->flash('success', 'PRODUTO ADICIONADO AO CARRINHO COM SUCESSO  .');
            return redirect()->route('carrinho.listar');
        }


    }

    public function concluir(Request $request) 
    {
        $dataForm           = $request->all();
        $user               = auth()->user()->id;

        $check_pedido = $this->pedido->where([

            'id'        => $dataForm['pedido_id'],
            'user_id'   => $user,
            'status'    => 'RE'

        ]);
        
        if(!$check_pedido) {
            session()->flash('error', 'Pedido não encontrado !');
            return redirect()->route('carrinho.listar');
        }

        $check_produtos = $this->pedidoProduto->where([
            'pedido_id' => $dataForm['pedido_id']
        ])->exists();
        
        if(!$check_produtos) {
            session()->flash('error', 'Produtos do pedido não encontrados  !');
            return redirect()->route('carrinho.listar');
        }

        $this->pedidoProduto->where([
            'id' => $dataForm['pedido_id']
        ])->update([
            'status' => 'PA'
        ]);

        $this->pedido->where([
            'id' => $dataForm['pedido_id']
        ])->update([
            'status' => 'PA'
        ]);

        session()->flash('success', 'Compras concluidas com sucesso !  !');
        return redirect()->route('compras');
    }

    public function compras() 
    {
        $user = auth()->user()->id;

        $compras_pagas = $this->pedido->where([
            'status' => 'PA',
            'user_id'   =>  $user
        ])->orderBy('created_at', 'desc')->get();

        $compras_canceladas = $this->pedido->where([
            'status' => 'CA',
            'user_id'   =>  $user
        ])->orderBy('updated_at', 'desc')->get();

        return view('painel.carrinho.compras', compact('compras_pagas', 'compras_canceladas'));
    }
}
