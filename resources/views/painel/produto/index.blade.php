@extends('home')

@section('content')
<div class="container">
    <div class="row ">
      @foreach ($produtos as $produto)
      
            <div class="col-sm-4 mt-3 ">
              <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Produto: {{$produto->nome}}</h5>
                    <p class="card-text"><b>Descrição:</b> {{$produto->descricao}}</p>
                    <p class="card-text"><b>Valor R$: </b>{{number_format($produto->valor, 2, ',', '.')}}</p>
                <a href="{{route('carrinho.show', $produto->id)}}" class="btn btn-primary btn-block"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                </div>
              </div>
            </div>
           
      @endforeach
    </div>
</div>

@endsection