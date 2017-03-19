<?php

namespace App\Http\Controllers\Home;




use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;

class IndexController extends CommonController
{
    //
    public function index()
    {
        //show 6 top ranked picture
        $pic=Article::orderby('art_view','desc')->take(6)->get();
        //dd($pic);

        //5 top ranked article

        //useful links
        $ulink=Links::all();
        return view('home.index',compact('pic','ulink'));
    }
    public function list($cate_id)
    {
        //category list with pagination
        $art_list=Article::where('cate_id',$cate_id)->orderby('art_view','desc')->paginate(5);

        Category::where('cate_id',$cate_id)->increment('cate_view');

        //the sub-list of current list
        $sub_menu=Category::where('cate_pid',$cate_id)->get();

        $field=Category::find($cate_id);

        return view('home.list',compact('field', 'art_list','sub_menu'));
    }
    public function art($art_id)
    {
        $field=Article::join('category','article.cate_id','=','category.cate_id')->where('art_id',$art_id)->first();

        //check article view times
        Article::where('art_id',$art_id)->increment('art_view');

        $article['pre']=Article::where('art_id','<',$art_id)->orderby('art_id','desc')->first();
        $article['next']=Article::where('art_id','>',$art_id)->orderby('art_id','asc')->first();

        $data=Article::where('cate_id',$field->cate_id)->orderby('art_id','desc')->take(6)->get();
        return view('home.new',compact('field','article','data'));
    }

}
