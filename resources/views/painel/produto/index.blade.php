@extends('home')

@section('content')
<div class="container">
      @foreach ($produtos as $produto)
      <div class="row mt-3">
            <div class="col-sm-6">
              <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$produto->nome}}</h5>
                    <p class="card-text">{{$produto->descricao}}</p>
                    <p class="card-text">R$:{{number_format($produto->valor, 2, ',', '.')}}</p>
                  <a href="#" class="btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                </div>
              </div>
            </div>
           
</div>
      @endforeach
</div>

@endsection