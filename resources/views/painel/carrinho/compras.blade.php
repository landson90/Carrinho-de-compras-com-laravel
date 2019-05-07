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
        <h2>Minhas compras</h2>
        <hr>

        
  <div class="container">
        
            <div class="card-body">
                    <h4 class="card-title">Compras concluídas</h4>
                    @forelse ($compras_pagas as $pedido)
                        <div class="row mt-4">
                            <div class="col-lg-6">
                              <h5 class="card-title">Pedido : {{$pedido->id}}  </h5>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="card-title">Criado em : {{$pedido->created_at->format('d/m/Y H:i')}} </h5>
                            </div>
                        </div>
                        <div class="row">
                                <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        
                                      
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
                                     @foreach ($pedido->pedido_produto_item as $pedido_produto)

                                     @php
                                         $total_produto = $pedido_produto->produtos->valor - $pedido_produto->descontos;
                                         $total_pedido  += $total_produto;
                                     @endphp

                                     <tr>
                                        
                                            <th>
                                                {{ $pedido_produto->produtos->nome }}
                                            </th>
                                            <th>
                                                R$:   {{number_format($pedido_produto->produtos->valor, 2, ',', '.')}}
                                            </th>
                                            <th>
                                                R$:  {{number_format($pedido_produto->descontos, 2, ',', '.')}}
                                            </th>
                                            
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
                                  
                                      <div class="container">
                                        <p class="display-5">Total do pedido R$: {{number_format($total_produto, 2, ',', '.')}} </p>
                                      </div>
                                    
                            </div>
                    @empty
                       <h5 class="text-center">
                           @if ($compras_canceladas->count() > 0) 

                                Neste momento não há compras validas   
                           @else
                               Você ainda não fex nenhuma compra.
                           @endif
                       </h5>
                    @endforelse
                    <hr>
            </div>
         <div class="mt-4">
             <h4>Compras canceladas</h4>

             <div class="card-body">
                    
                    @forelse ($compras_canceladas as $pedido_cancelados)
                        <div class="row mt-4">
                            <div class="col-lg-6">
                              <h5 class="card-title">Pedido : {{$pedido_cancelados->id}}  </h5>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="card-title">Criado em : {{$pedido_cancelados->created_at->format('d/m/Y H:i')}} </h5>
                            </div>
                        </div>
                        <div class="row">
                                <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        
                                      
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
                                     @foreach ($pedido_cancelados->pedido_produto_item as $pedido_produto_cancelados)

                                     @php
                                         $total_produto = $pedido_produto->produtos->valor - $pedido_produto->descontos;
                                         $total_pedido  += $total_produto;
                                     @endphp

                                     <tr>
                                        
                                            <th>
                                                {{ $pedido_produto_cancelados->produtos->nome }}
                                            </th>
                                            <th>
                                                R$:   {{number_format($pedido_produto_cancelados->produtos->valor, 2, ',', '.')}}
                                            </th>
                                            <th>
                                                R$:  {{number_format($pedido_produto_cancelados->descontos, 2, ',', '.')}}
                                            </th>
                                            
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
                                  
                                      <div class="container">
                                        <p class="display-5">Total do pedido R$: {{number_format($total_produto, 2, ',', '.')}} </p>
                                      </div>
                                    
                            </div>
                    @empty
                       <h5 class="text-center">
                            Nenhuma compra foi cancelada.
                       </h5>
                    @endforelse
                    <hr>
            </div>
         </div>
    </div>
  
</div>
@endsection