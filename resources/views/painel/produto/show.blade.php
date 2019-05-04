@extends('home')

@section('content')

    <div class="container">
            <div class="card">
                    <div class="card-body">
                      <h1 class="card-title">Produto : {{$produto->nome}}</h1>
                      <h3 class="card-text">Descrição : {{$produto->descricao}}</h3>
                      <h5 class="card-text">Valor R$ : {{$produto->valor}}</h5 >
                      <a href="{{route('carrinho.adicionar', $produto->id )}}" class="card-link badge badge-success">ADICIONAR AO CARRINHO</a>
                    <a href="{{route('loja.produtos')}}" class="card-link badge badge-warning">VOLTA A LOJA</a>
                    </div>
                  </div>
    </div>

@endsection