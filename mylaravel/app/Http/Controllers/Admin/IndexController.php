<?php

namespace App\Http\Controllers\Admin;


use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    public function index(){

		return view('admin.index');
	}
    //change passowrd
    public function changepass(){
        if($input=Input::all()){
            $rules=['newpassword'=>'required|between:6,12|confirmed'];
            $message=['newpassword.required'=>'新密码不能为空!',
                'newpassword.between'=>'新密码必须6-12位!',
                'newpassword.confirmed'=>'新密码与确认密码不匹配!'];
            $validator=Validator::make($input,$rules,$message);


            if($validator->passes()){
                $user= User::first();
                $_password=Crypt::decrypt($user->user_pass);
                if($input['oldpassword']==$_password){
                    $user->user_pass=Crypt::encrypt($input['newpassword']);
                    $user->update();
                    return back()->with('errors','密码修改成功！');

                }else{
                    return back()->with('errors','原密码错误！');
                }
            }else{
               return back()->withErrors($validator);
            }
        }else {

            return view('admin.change-password');
        }
    }

}
