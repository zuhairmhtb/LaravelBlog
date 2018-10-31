@extends('layouts.app')
@section('content')
    <h1> Views and Layouts</h1>
    <p>
    <ul class="list list-group">
        <li class="list-group-item"><b>Creating a Layout:</b> Add a layout blade.php file to the view. 'yield('tagname')' places the contents with the
                specified tag name to the location where yield exists. extends('layout.route') extends the layout file
                created in view. section('tagname') and endsection are used to include contents which will be
                placed in the layout.</li>
        <li class="list-group-item"><b>Passing a value from Controller to View: </b><br>
            public function index(){<br>
            $title = 'Welcome to Laravel';<br>
            //return view('pages.index')->with('title', $title);  --> This is another way to pass a variable<br>
            return view('pages.index', compact('title'));<br>
            }<br>
            //In the View<br>
            &#60h1&#62 &#123&#123 $title &#125&#125 &#60h1&#62
        </li>

        <li class="list-group-item"><b>Passing multiple values from Controller to View: </b><br>
            public function services(){<br>
            $data = array(<br>
            'title' => 'Services',<br>
            'dat' => 'Sample data'<br>
            );<br>
            return view('pages.index')->with($data);<br>
            }<br>
            //In the View<br>
            &#60h1&#62 &#123&#123 $title &#125&#125 &#60h1&#62<br>
            &#60p&#62 &#123&#123  $dat &#125&#125 &#60p&#62
        </li>
        <li class="list-group-item">
            <b>Checking number of items in an array in blade View:</b><br>
            &#64if( count($services) > 0)<br>
            &nbsp; &nbsp; &nbsp; &nbsp; &#64foreach($services as $service)<br>
            &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&#123&#123$service&#125&#125<br>
            &nbsp; &nbsp; &nbsp; &nbsp; &#64endforeach<br>
            &#64endif
        </li>
        <li class="list-group-item">
            <b>Loading a file from 'Public' folder: </b> &#123&#123 asset('path/to/file') &#125&#125
        </li>
        <li class="list-group-item"><b>Using SASS Stylesheet: </b>The files can be added to public dirctory and loaded using 'asset'<br>
        but a better option is to include the file in 'resources/assets/_filename.scss'. The new file then can<br>
        be added in 'resources/assets/app.scss' file using ' &#64import "filename" '</li>
        <li class="list-group-item"><b>Adding HTML Content from different file: </b> &#64include('file.path') </li>
        <li class="list-group-item">In order to display HTML content as HTML we need to use &#123&#33&#33 <i>$html_content &#33&#33&#125</i><br>
            <i>$html_content &#125&#125</i></li>

    </ul>
    </p>
@endsection
