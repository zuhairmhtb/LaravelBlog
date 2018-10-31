@extends('layouts.app')
@section('content')
    <h1> Using Controllers</h1>
    <p>
    <ul class="list-group">
        <li class="list-group-item">
            <b>Importing Model in a function to manipulate tables in db:</b>
            ModelName::all() returns all data in a model table. e.g. $posts = Post::all();
        </li>
    </ul>
    </p>
@endsection
