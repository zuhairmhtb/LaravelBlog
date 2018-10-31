@extends('layouts.app')
@section('content')
    <div class="row">
        @if(count($post) > 0)
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h1>{{$post->title}}</h1>
            </div>
            @if($post->cover_image != 'noimage.jpg')
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <img alt="Image" src="{{asset('cover_images/' . $post->cover_image)}}" class="img img-responsive"
                             style="max-width: 200px; max-height: 200px;"/>
                    </div>

                </div>
            @endif


            <div class="col-sm-12 col-md-12 col-lg-12">
                <span class="text text-justify text-info">
                    {!! $post->body !!} <!-- Does not Display HTML content as string -->
                </span>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <span style="font-size: 10px; font-style: italic">Created on {{$post->created_at}}</span>
            </div>
        @else
            A post with this ID does not exist.
        @endif
    </div>
@endsection