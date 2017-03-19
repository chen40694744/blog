<?php

namespace App\Http\Controllers\admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
    //
    public function index()
    {
        $data=Article::orderBy('art_id','desc')->paginate(10);
        //dd($data->links());
       return view('admin.article-list',compact('data'));
    }

    public function create()
    {
        $pid=(new Category)->tree();

        return view('admin.article-add', compact('pid'));
    }

    public function store()
    {
        $input=Input::except('_token');
        $input['art_time']=time();
        $rules=[
            'art_title'=>'required',
            'art_content'=>'required',
        ];
        $message=['art_title.required'=>'文章名称不能为空!',
            'art_content.required'=>'文章内容不能为空!'];
        $validator=Validator::make($input,$rules,$message);


        if($validator->passes()){

            $art=Article::create($input);
            if($art){
                return redirect('admin/article');
            }else{
                return back()->with('errors','更新失败，请稍后再试！');
            }
        }else{
            return back()->withErrors($validator);
        }


    }

    public function edit($art_id)
    {
        $pid=(new Category)->tree();
        $field=Article::find($art_id);
        return view('admin.article-edit', compact('pid', 'field'));
    }
    public function update($art_id)
    {
        $input=Input::except('_method','_token');
        $re=Article::where('art_id',$art_id)->update($input);
        if($re) {
            return redirect('admin/article');
        }else{
            return back()->with('errors','更新失败，请稍后再试！');
        }
    }
    public function destroy($art_id)
    {
        $re= Article::where('art_id',$art_id)->delete();
        if($re){
            $data=[
                'status' => 0,
                'msg' => '文章删除成功！',
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'文章删除失败，稍后再试！',
            ];

        }
        return $data;
    }

}
