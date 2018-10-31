@extends('layouts.app')

@section('content')
    <div class="row">
        <h1>Posts</h1>
    </div>
    <div class="row">@include('inc.messages')</div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            @if( count($posts) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>SL No.</td>
                        <td>Title</td>
                        <td>Created at</td>
                        <td>Image</td>
                    </tr>
                    </thead>
                    <tbody>
                    @php ($i=1)
                    @foreach($posts as $post)
                        <tr>
                            <td> {{$i}}</td>
                            <td> <a href="/posts/{{$post->id}}">{{$post->title}}</a></td>
                            <td>{{$post->created_at}}</td>
                            @if($post->cover_image != 'noimage.jpg')
                            <td><img alt="Image" src="{{asset('cover_images/' . $post->cover_image)}}" class="img img-responsive"
                                style="max-width: 50px; max-height: 50px;"/></td>
                            @else
                            <td>N/A</td>
                            @endif
                        </tr>
                        @php ($i=$i+1)
                    @endforeach

                    </tbody>
                </table>
            @else
                No posts found.
            @endif
        </div>
        <style>
            .pagination li{
                padding: 1px 3px 1px 3px;
            }
        </style>
        <div class="col-sm-12 col-md-12 col-lg-12">
            {{$posts->links()}}
        </div>

    </div>

@endsection