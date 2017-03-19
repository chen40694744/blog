<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class ConfigController extends Controller
{
    //
    public function index()
    {
        $data=Config::orderBy('conf_order', 'asc')->get();
        //dd($data);
        foreach ($data as $d=>$v){
            switch ($v->field_type){
                case 'input';
                $data[$d]->_html='<input type="text" class="input-text" name="conf_content[]" value="'.$v->conf_content.'">';
                break;

                case 'textarea';
                $data[$d]->_html='<textarea type="text" class="textarea"  name="conf_content[]">'.$v->conf_content.'</textarea>';
                break;

                case 'radio';
                $arr=explode(',' ,$v->field_value);
                $str='';
                foreach ($arr as $a=>$n){
                    $r=explode('|',$n);
                    $c=$v->conf_content==$r[0]?'&nbsp; checked &nbsp;':'';
                  $str .='<input type="radio" name="conf_content[]" value="'.$r[0].'" '.$c.'>'.$r[1].'&nbsp;&nbsp;';
                }
                    $data[$d]->_html=$str;
                break;
            }
        }
        return view('admin.config.config-list', compact('data'));
    }

    public function create()
    {
        return view('admin.config.config-add');
    }

    public function store()
    {
        $input=Input::except('_token');
        $rules=[
            'conf_name'=>'required',
            'conf_title'=>'required',
        ];
        $message=['conf_name.required'=>'配置项名字不能为空!',
            'conf_title.required'=>'配置项不能为空!',
        ];
        $validator=Validator::make($input,$rules,$message);

        if($validator->passes()){

            $art=Config::create($input);
            if($art){
                return redirect('admin/config');
            }else{
                return back()->with('errors','更新失败，请稍后再试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }
    public function show()
    {

    }
    public function edit($conf_id)
    {
        $field=Config::find($conf_id);
        return view('admin.config.config-edit', compact( 'field'));
    }
    public function update($conf_id)
    {
        $input=Input::except('_method','_token');
        $re=Config::where('conf_id',$conf_id)->update($input);
        if($re) {
            $this->create_conf();
            return redirect('admin/config');
        }else{
            return back()->with('errors','更新失败，请稍后再试！');
        }
    }
    public function destroy($conf_id)
    {
        $re= Config::where('conf_id',$conf_id)->delete();
        if($re){
            $data=[
                'status' => 0,
                'msg' => '配置项删除成功！',
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'配置项删除失败，稍后再试！',
            ];

        }
        return $data;
    }

    //set change order
    public function changeorder()
    {
        $input=Input::all();
        $nav=Config::find($input['conf_id']);
        $nav->conf_order=$input['conf_order'];
        $re=$nav->update();
        if($re){
            $data=[
                'status'=>0,
                'msg'=>'配置项排序更新成功',
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'配置项排序更新失败，稍后再试',
            ];
        }
        return $data;
    }
    public function changecontent()
    {
        $input=Input::all();
        $re='';
        foreach ($input['conf_id'] as $i=>$v){
           $re=Config::where('conf_id',$v)->update(['conf_content'=>$input['conf_content'][$i]]);
        }
            $this->create_conf();
            return back()->with('errors','配置项更新成功！');
    }
    public function create_conf()
    {
        $con=Config::pluck('conf_content','conf_name')->all();
        $path=base_path().'\config\web.php';
        $str='<?php return '.var_export($con,true).';';
        file_put_contents($path,$str);
        echo $path;
    }

}
