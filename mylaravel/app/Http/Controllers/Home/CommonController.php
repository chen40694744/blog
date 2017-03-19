<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Navbar;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    //share data of navbar
    public function __construct()
    {
        //the most popular article 5 with pagination
        $art=Article::orderby('art_view','desc')->paginate(5);
        //new article 8
        $new_art=Article::orderby('art_time','desc')->take(8)->get();
        $nav=Navbar::all();
        View::share('nav',$nav);
        View::share('art',$art);
        View::share('new_art',$new_art);
    }
}
