@extends('/layout')
 
@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add Valuta</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('valutas.store') }}">
          @csrf
          <div class="form-group">    
              <label for="valuta">Valuta Name:</label>
              <input type="text" class="form-control" name="valuta"/>
          </div>
 
          <div class="form-group">
              <label for="code">Valuta Code</label>
              <input type="text" class="form-control" name="code"/>
          </div>
 
          <div class="form-group">
              <label for="procent">Valuta %</label>
              <input type="number" class="form-control" name="procent"/>
          </div>
          <button type="submit" class="btn btn-primary">Add Valuta</button>
      </form>
  </div>
</div>
</div>
@endsection