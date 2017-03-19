<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navbar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class NavbarController extends Controller
{
    //
    public function index()
    {
        $data=Navbar::orderBy('nav_order', 'asc')->get();
        //dd($data);
        return view('admin.navbar.navbar-list', compact('data'));
    }
    //set change order
    public function changeorder()
    {
        $input=Input::all();
        $nav=Navbar::find($input['nav_id']);
        $nav->nav_order=$input['nav_order'];
        $re=$nav->update();
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
        return view('admin.navbar.navbar-add');
    }

    public function store()
    {
        $input=Input::except('_token');
        $rules=[
            'nav_name'=>'required',
            'nav_url'=>'required',
        ];
        $message=['nav_name.required'=>'链接名字不能为空!',
            'nav_url.required'=>'链接地址不能为空!',
        ];
        $validator=Validator::make($input,$rules,$message);

        if($validator->passes()){

            $art=Navbar::create($input);
            if($art){
                return redirect('admin/navbar');
            }else{
                return back()->with('errors','更新失败，请稍后再试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }
    public function edit($nav_id)
    {
        $field=Navbar::find($nav_id);
        return view('admin.navbar.navbar-edit', compact( 'field'));
    }
    public function update($nav_id)
    {
        $input=Input::except('_method','_token');
        $re=Navbar::where('nav_id',$nav_id)->update($input);
        if($re) {
            return redirect('admin/navbar');
        }else{
            return back()->with('errors','更新失败，请稍后再试！');
        }
    }
    public function destroy($nav_id)
    {
        $re= Navbar::where('nav_id',$nav_id)->delete();
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
