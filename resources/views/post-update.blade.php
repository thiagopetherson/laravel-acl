@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
         
            <h1>{{$post->title}}</h1>
            <p>{{$post->description}}</p><br>
            <b>Author: {{$post->user->name}}</b><br>           
                
        </div>
    </div>
</div>
@endsection
