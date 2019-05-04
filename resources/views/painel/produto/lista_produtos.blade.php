@extends('home')

@section('content')

  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
      <li class="breadcrumb-item active">Cadastro</li>
        <li class="breadcrumb-item active" aria-current="page">Produtos</li>
      </ol>
    </nav>


@if(session()->has('success'))
  <div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info">
            <button type="button"  class="close" aria-label="Close" data-dismiss="alert" aria-hidden="true">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{{session()->get('success')}}</strong>
        </div>
    </div>
  </div>
@endif
  
@if(session()->has('error'))
  <div class="row">
    <div class="alert alert-danger">
      <button type="button" class="close glyphicon glyphicon-remove" data-dismiss="alert" aria-hidden="true"></button>
      <strong>{{session()->get('error')}}</strong>
    </div>
  </div>
@endif
  
  <div class="card">
      <div class="card-header">
      Produtos <button type="button" class="btn btn-info" id="btnCreate" data-toggle="modal" data-target="#exampleModal">Novo</button>
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
            @forelse ($produtos as $produto)
            <tr>
              <th scope="row">{{$produto->id}}</th>
              <td>{{$produto->nome}}</td>
              <td>{{$produto->descricao}}</td>
              <td>{{$produto->valor}}</td>
              <td>{{$produto->ativo}}</td>
              <td>
                  <a href="#" class="badge badge-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                  <a href="#" class="badge badge-warning"><i class="fa fa-eye" aria-hidden="true"></i></a>
                  <a href="#" class="badge badge-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
              </td>
            </tr>  
            @empty
                <h2>Não tem produtos cadastrado !</h2>
            @endforelse
            
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal -->
<form action="{{route('produto.store')}}" class="form-group" method="POST">
  {!! csrf_field() !!}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <label for="nome">Nome</label>
              <input type="text" class="form-control" placeholder="Digite o nome" name="nome">
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-lg-12">
              <label for="decricao">Descrição</label>
              <textarea class="form-control" name="descricao" id="exampleFormControlTextarea1" rows="3" placeholder="Digite a descrição"></textarea>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-lg-6">
              <label for="valor">Valor</label>
              <input type="text" class="form-control" name="valor" placeholder="Digite o valor (EX:. 59.99)">
            </div>
            <div class="col-lg-6">
              <h5>Status de <b>Ativo</b></h5>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="ativo" id="inlineRadio1" value="S" checked>
                  <label class="form-check-label" for="inlineRadio1">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="ativo" id="inlineRadio2" value="N">
                  <label class="form-check-label" for="inlineRadio2">Não</label>
                </div>
            </div>
          </div>
        </div>
      
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>
</form>

@endsection