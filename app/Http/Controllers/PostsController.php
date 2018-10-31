<?php

namespace App\Http\Controllers;

use App\Post;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests;
use Symfony\Component\DomCrawler\Form;
use DB;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',//The function checks if the author is authorized
            ['except' => ['index', 'show']]); //Exceptions: The views which can be displayed if the user is not authenticated
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$post = Post::all(); //Find all posts
        //$post = Post::all()->take(1)->get(); // Retrieves only one post
        // Retrieves 10 post per page and the pagination numbers can be placed in the view
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Rules set for the form in order to be validated successfully
        $this->validate($request,
            [
                'title' => 'required',
                'body' => 'required',
                'cover_image' => 'image | max:1999' //Restrictions for image: Must be image | can be null(empty) and max image size 1999KB
            ]);
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id; // Get User ID of logged in User

        //Handle File upload
        if($request->hasFile('cover_image')){
            //Get Filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); //PHP method to extract name without extension
            //Get Extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension; // Unique Filename
            //Upload the image: It will be stored in public > cover_images
            $path = $request->file('cover_image')->move('cover_images', $fileNameToStore);
            //For Laravel 5.3 or higher after creating symlink:
            //Upload the image: It will be stored in Storage > app > public > cover_imagess
            //$path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            $post->cover_image = $fileNameToStore;

        }
        else{
            $fileNameToStore = 'noimage.jpg';
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        return redirect('/posts/')->with('success', 'Post created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id); //Find a post by a value
        //$post = Post::where('title', 'Post 2')->get(); //Find a post by an attribute
        //$post = DB::select('SELECT * FROM posts'); //use SQL query

        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Check if the post to be edited is user's post
        $post = Post::find($id);
        if(auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized attempt to edit the post');
        }
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Rules set for the form in order to be validated successfully
        $this->validate($request,
            [
                'title' => 'required',
                'body' => 'required',
                'cover_image' => 'image | max:1999' //Restrictions for image: Must be image | can be null(empty) and max image size 1999KB
            ]);
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        //Handle File upload
        if($request->hasFile('cover_image')){
            if($post->cover_image != 'noimage.jpg'){ //Delete if any image currently exists
                //delete the image
                unlink(public_path('cover_images/' . $post->cover_image));
            }
            //Get Filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); //PHP method to extract name without extension
            //Get Extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension; // Unique Filename
            //Upload the image: It will be stored in public > cover_images
            $path = $request->file('cover_image')->move('cover_images', $fileNameToStore);
            //For Laravel 5.3 or higher after creating symlink:
            //Upload the image: It will be stored in Storage > app > public > cover_imagess
            //$path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            $post->cover_image = $fileNameToStore;

        }
        else{
            $fileNameToStore = 'noimage.jpg';
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        return redirect('/home')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized attempt to edit the post');
        }
        if($post->cover_image != 'noimage.jpg'){
            //delete the image
            unlink(public_path('cover_images/' . $post->cover_image));
        }
        $post->delete();

        return redirect('/posts/')->with('success', 'The post has successfully been deleted.');
    }
}
