<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function index(){
        if(!auth()->guest()){
            $title = 'Welcome to Laravel';
            //return view('pages.index', compact('title'));  ----> This is one way to pass a variable
            return view('pages.index')->with('title', $title);
        }
        else{
            return redirect('home');
        }

    }
    public function layouts(){
        return view('pages.layouts');
    }
    public function about(){
        $title = 'About Us';
        return view('pages.about', compact('title'));
    }
    public function services(){

        $data = array(
            'title' => 'Services',
            'services' => ['Web Design', 'Programming', 'SEO']
        );
        return view('pages.services')->with($data);
    }
    public function controllers(){
        return view('pages.controllers');
    }
}
