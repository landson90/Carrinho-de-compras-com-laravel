@extends('home')

@section('content')
<div class="container">
    @if(session()->has('success'))
      
        <div class="alert alert-info">
          <strong>{{session()->get('success')}}</strong>
          <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      
    @endif
    @if(session()->has('error'))
      
        <div class="alert alert-info">
          <strong>{{session()->get('error')}}</strong>
          <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      
    @endif
</div>

  <div class="container">
      <div class="card">
          <h5 class="card-header">Produtos do carrinho </h5>
          <div class="card-body">
            @forelse ($pedidos as $pedido)
            <div class="row">
                <div class="col-lg-6">
                  <h5 class="card-title">Pedido :  {{ $pedido->id}}</h5>
                </div>
                <div class="col-lg-6">
                    <h5 class="card-title">Criado em :  {{ $pedido->created_at->format('d/m/Y H:i')}}</h5>
                </div>
              </div>
              <div class="row">
                  <table class="table table-striped">
                      <thead>
                        <tr>
                          
                          <th scope="col">Qtd</th>
                          <th scope="col">Produto</th>
                          <th scope="col">Valor Unit.</th>
                          <th scope="col">Desconsto(s)</th>
                          <th scope="col">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $total_pedido = 0; 
                        @endphp
                        @foreach ($pedido->pedido_protudos as $pedidosProdutos )
                        <tr>
                          <th scope="row">
                              <a href="#" onclick="carrinhoRemoverProduto({{$pedido->id}}, {{$pedidosProdutos->produto_id}}, 1)">
                                  <i class="fa fa-minus-circle" aria-hidden="true"></i>
                              </a>
                                <span class="col-lg-4">{{ $pedidosProdutos->qtd }}</span>
                              <a href="#" onclick="carrinhoAdicionarProduto({{$pedidosProdutos->produto_id}})">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </a>
                          </th>
                          <th>
                            {{$pedidosProdutos->produtos->nome}}
                          </th>
                          <th>
                              R$:   {{number_format($pedidosProdutos->produtos->valor, 2, ',', '.')}}
                          </th>
                          <th>
                              R$:   {{number_format($pedidosProdutos->descontos, 2, ',', '.')}}
                          </th>
                          @php
                              $total_produto = $pedidosProdutos->produtos->valor - $pedidosProdutos->descontos;
                              $total_pedido  += $total_produto;
                          @endphp
                          <th>
                              R$:   {{number_format($total_produto, 2, ',', '.')}}
                          </th>
                        </tr>
                       
                        @endforeach
                        <!--
                        <-->
                      </tbody>
                    </table>
                    <hr>
                      <div class="col-lg-4">
                        <button class="btn btn-block btn-info">CONTINUAR COMPRANDO</button>
                      </div>
                      <div class="col-lg-4">
                      <form action="{{route('concluir.compras')}}" method="POST">
                        {!! csrf_field() !!}
                          <input type="hidden" name="pedido_id" value="{{$pedido->id}}">
                          <button class="btn btn-block btn-danger" type="submit">CONCLUIR COMPRAS</button>
                        </form>
                    </div>
                    <div class="jumbotron jumbotron-fluid col-lg-4">
                        <div class="container">
                          <h1 class="display-5">Total do pedido R$:   {{number_format($total_pedido, 2, ',', '.')}}</h1>
                        </div>
                      </div>
              </div> 
              
                
              
            @empty
                <h5>Não há nenhum pedido no carrinho</h5>
            @endforelse
            
          </div>
        </div>
  </div>

  
<form action="{{route('carrinho.remover')}}" id="form_remover_produto" method="POST" >
  {!! csrf_field() !!}
  {{!!method_field('DELETE')!!}}
  <input type="hidden" name="produto_id">
  <input type="hidden" name="pedido_id">
  <input type="hidden" name="item">
</form>

  <form action="{{route('carrinho.produto.adicionar')}}" id="form_adicionar_produto" method="POST" >
      {!! csrf_field() !!}
  <input type="hidden" name="id">
</form>


<script src="{{asset('js/controlador.js')}}"></script>
@endsection