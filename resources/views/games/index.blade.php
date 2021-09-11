@extends('games.template')

@section('title','Visualizar Jogos')

@section('content')

<div class="container">
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
@if (\Session::has('warning'))
    <div class="alert alert-warning">
        <ul>
            <li>{!! \Session::get('warning') !!}</li>
        </ul>
    </div>
@endif
@if (\Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('error') !!}</li>
        </ul>
    </div>
@endif
</div>

<div class="container">
<br>
<br>
<table class="table table-striped" >
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Genero</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($games->items() as $game)
        <tr>
          <th scope="row">{{$game->id}}</th>
          <td>{{$game->name}}</td>
          <td>{{$game->category->name}}</td>
          <td>
            <div class="container">
            <button type="button" class="btn btn-outline-info btn-icon btn-lg btn-block" title='Editar' onclick='location.href="{{ route('games.edit', $game)}}"'>
              Editar
              <i class="fa fa-pen"></i>
            </button>
            <br>
            <form action="{{route('games.destroy',[$game->id])}}" method="POST">
              @method('DELETE')
              @csrf
              <button  type="submit" class="btn btn-outline-danger btn-icon btn-lg btn-block" title='Deletar'>
                Deletar
                <i class="fa fa-pen"></i>
              </button>
            </div>
            </form>
          </td>
        </tr>
    </div>
      @endforeach
    </tbody>
  </table>

  <button type="button" class="btn btn-success btn-icon btn-lg" title='Adicionar' onclick='location.href="{{ route('games.create')}}"'>
    Adicionar
    <i class="fa fa-pen"></i>
  </button>
  {{$games->links()}}
@endsection
