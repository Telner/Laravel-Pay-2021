@extends('games.template')

@section('title','Visualizar Jogos')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
<form method='POST' action="{{route('games.update',$GameResource->id)}}" method="POST">
  @method('PUT')
  @csrf
  <div class="form-group">
    <label for="name">Nome do Jogo</label>
    <input type="text" class="form-control" value="{{old('name',$GameResource->name)}}" id="name" name="name" placeholder="Adicione o nome do Jogo." required="required">
    <small id="nameHelp" class="form-text text-muted">Nome do Jogo a ser cadastrado.</small>
  </div>
  <div class="form-group">
    <label for="sinopse">Sinopse do Jogo</label>
    <textarea type="text" class="form-control" id="sinopse" name="sinopse" placeholder="Adcionar o Sinopse do Jogo." required="required">{{old('sinopse',$GameResource->sinopse)}}</textarea>
  </div>
  <label for="sinopse">Genero do Jogo</label>
  <select class="form-control" id='category_id' name="category_id">
    @foreach($categoriesResource as $category)
      <option value="{{$category->id}}" @if($GameResource->category_id == $category->id) selected="selected" @endif>{{$category->name}}</option>
    @endforeach
  </select>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
@push('scripts')
<script>
</script>
@endpush
