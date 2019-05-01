@extends('home')

@section('content')

  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
      <li class="breadcrumb-item active">Carrinho</li>
      </ol>
    </nav>


  <div class="card">
      <div class="card-header">
      Carrinho Compras
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nome</th>
              <th scope="col">Descricao</th>
              <th scope="col">Valor</th>
              <th scope="col">Status Ativo</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($pedidos as $pedido)
            <tr>
              <th scope="row"></th>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                  <a href="#" class="badge badge-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                  <a href="#" class="badge badge-warning"><i class="fa fa-eye" aria-hidden="true"></i></a>
                  <a href="#" class="badge badge-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
              </td>
            </tr>  
            @empty
                <h2>Carrinho esta fazio !</h2>
            @endforelse
            
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection