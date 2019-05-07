@extends('home')

@section('content')

    <div class="container">
            <div class="card">
                    <div class="card-body">
                      <h1 class="card-title">Produto : {{$produto->nome}}</h1>
                      <h3 class="card-text">Descrição : {{$produto->descricao}}</h3>
                      <h5 class="card-text">Valor R$ : {{$produto->valor}}</h5 >
<hr>
                      <form action="{{route('carrinho.store')}}" method="POST">
                          {!! csrf_field() !!}
                      <input type="hidden" name="user_id" value="{{$user->id}}">
                      <input type="hidden" name="produto_id" value="{{$produto->id}}">
                          <button  class="btn btn-success btn-block mt-2" type="submit"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                      </form>
                      
                      <button  class="btn btn-warning btn-block mt-2"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                    </div>
                  </div>
    </div>

@endsection