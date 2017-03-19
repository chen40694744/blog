<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class CategoryController extends CommonController
{
    //get.admin/category
    public function index()
    {
        $category=(new Category)->tree();
        return view('admin.cate-list')->with('data',$category);
    }


    //post.admin/category
    public function store()
    {
        $input=Input::except('_token');
        //dd($input);
        $rules=['cate_name'=>'required'];
        $message=['cate_name.required'=>'文章名称不能为空!',];
        $validator=Validator::make($input,$rules,$message);


        if($validator->passes()){
            $upload=Category::create($input);
            if($upload){
                return redirect('admin/category');
            }else{
                return back()->with('errors','数据提交失败，请稍后再试！');
            }



        }else{
            return back()->withErrors($validator);
        }

    }
    //get.admin/category/create
    public function create()
    {
        $pid=Category::where('cate_pid',0)->get();
        //dd($pid);
        return view('admin.cate-add',compact('pid'));

    }
    //get.admin/category/{category}
    public function show()
    {

    }
    //put.admin/category/{category}
    public function update($cate_id)
    {
        $input=Input::except('_method','_token');
        $re=Category::where('cate_id',$cate_id)->update($input);
        if($re) {
            return redirect('admin/category');
        }else{
            return back()->with('errors','更新失败，请稍后再试！');
        }

    }
    //get.admin/category/{category}
    public function edit($cate_id)
    {
        $field=Category::find($cate_id);
        $pid=Category::where('cate_pid',0)->get();
        return view('admin.cate-edit', compact('field','pid'));
    }
    //get.admin/category/{category}
    public function destroy($cate_id)
    {
       $re= Category::where('cate_id',$cate_id)->delete();
       Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
       if($re){
           $data=[
               'status' => 0,
               'msg' => '分类删除成功！',
           ];
       }else{
           $data=[
               'status'=>1,
               'msg'=>'分类删除失败，稍后再试！',
           ];

       }
        return $data;
    }
    public function changeorder()
    {
        $input=Input::all();
        $nav=Category::find($input['cate_id']);
        $nav->cate_order=$input['cate_order'];

        $re=$nav->update();
        if($re){
            $data=[
                'status'=>0,
                'msg'=>'分类排序更新成功',
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'分类排序更新失败，稍后再试',
            ];
        }
        return $data;
    }

}
