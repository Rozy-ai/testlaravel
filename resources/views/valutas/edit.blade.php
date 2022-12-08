@extends('/layout') 
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Editing Value</h1>
 
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('valutas.update', $valuta->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">
 
                <label for="valuta">Valuta Name:</label>
                <input type="text" class="form-control" name="valuta" value="{{ $valuta->valuta }}" />
            </div>
 
            <div class="form-group">
                <label for="code">Valuta Code:</label>
                <input type="text" class="form-control" name="code" value="{{ $valuta->code }}" />
            </div>
 
            <div class="form-group">
                <label for="value">Valuta %:</label>
                <input type="text" class="form-control" name="procent" value="{{ $valuta->procent }}" />
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection