<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
{
    //
    public function index()
    {
        $data=Links::orderBy('link_ord', 'asc')->get();
        //dd($data);
        return view('admin.links.links-list', compact('data'));
    }
    //set change order
    public function changeorder()
    {
        $input=Input::all();
        $link=Links::find($input['link_id']);
        $link->link_ord=$input['link_ord'];
        $re=$link->update();
        if($re){
            $data=[
                'status'=>0,
                'msg'=>'友情链接排序更新成功',
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'友情链接排序更新失败，稍后再试',
            ];
        }
        return $data;
    }

    public function create()
    {
        return view('admin.links.links-add');
    }

    public function store()
    {
        $input=Input::except('_token');
        $rules=[
            'link_name'=>'required',
            'link_url'=>'required',
        ];
        $message=['link_name.required'=>'链接名字不能为空!',
            'link_url.required'=>'链接地址不能为空!',
        ];
        $validator=Validator::make($input,$rules,$message);

        if($validator->passes()){

            $art=Links::create($input);
            if($art){
                return redirect('admin/links');
            }else{
                return back()->with('errors','更新失败，请稍后再试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }
    public function edit($link_id)
    {
        $field=Links::find($link_id);
        return view('admin.links.links-edit', compact( 'field'));
    }
    public function update($link_id)
    {
        $input=Input::except('_method','_token');
        $re=Links::where('link_id',$link_id)->update($input);
        if($re) {
            return redirect('admin/links');
        }else{
            return back()->with('errors','更新失败，请稍后再试！');
        }
    }
    public function destroy($link_id)
    {
        $re= Links::where('link_id',$link_id)->delete();
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
