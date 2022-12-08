@extends('layout')
 
@section('main')
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Valutas</h1>     
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Valuta Name</td>
          <td>Valuta Code</td>
          @if($flag == false)
          <td> %</td> 
          @endif
          <td>Valuta Price</td>
        </tr>
    </thead>
    <tbody>
        @foreach($all as $valuta)
        <tr>
            <td>{{$valuta['valuta']}} </td>
            <td>{{$valuta['code']}}</td>
            @if($flag == false)
            <td>{{$valuta['procent']}}</td>
            <?php 
            $a = $valuta['price'] ;
            $b  = explode(',', $a); 
            $total = (int)$b[0].'.'.$b[1] ;
            $sum = ($total / 100) * $valuta['procent'] + $total;
            ?> 
            <td>{{ ($sum) }}</td>
            @else
            <td>{{ ($valuta['price']) }}</td>
            @endif
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
</div>
@endsection