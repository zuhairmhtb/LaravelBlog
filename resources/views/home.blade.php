@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if(count($posts) > 0)
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td>SL No.</td>
                                <td>Title</td>
                                <td>Created at</td>
                                <td>Delete</td>
                                <td>Edit</td>
                            </tr>
                            </thead>
                            <tbody>
                            @php ($i=1)
                            @foreach($posts as $post)
                                <tr>
                                    <td> {{$i}}</td>
                                    <td> <a href="/posts/{{$post->id}}">{{$post->title}}</a></td>
                                    <td>{{$post->created_at}}</td>
                                    @if(!Auth::guest() && Auth::user()->id == $post->user_id)
                                        <td>
                                            {!! Form::open(['action' => ['PostsController@destroy', $post->id],
                                        'method' => 'POST']) !!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                            {!! Form::close() !!}
                                        </td>
                                        <td><a class="btn btn-success" href="/posts/{{$post->id}}/edit/">Edit</a> </td>
                                    @else
                                        <td> - </td>
                                        <td> - </td>
                                    @endif
                                </tr>
                                @php ($i=$i+1)
                            @endforeach

                            </tbody>
                        </table>
                     @else
                        You have no posts. <a href="/posts/create/">Add a new post</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
