@extends('/layout')
 
@section('main')
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Valutas</h1>
    <div>
        <a href="{{ route('valutas.create')}}" class="btn btn-primary mb-3">Add Valuta</a>
    </div>      
    @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Valuta Name</td>
          <td>Valuta Code</td>
          <td>Valuta %</td>
          <td>Updated at</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($valutas as $valuta)
        <tr>
            <td>{{$valuta->id}}</td>
            <td>{{$valuta->valuta}} </td>
            <td>{{$valuta->code}}</td>
            <td>{{$valuta->procent}}</td>
            <td>{{$valuta->updated_at}}</td>
            <td>
                <a href="{{ route('valutas.edit',$valuta->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('valutas.destroy', $valuta->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
</div>
@endsection