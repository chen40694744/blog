<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once 'org/code/vcode.class.php';
class LoginController extends CommonController
{
    //
    public function login()
    {
        //get all submit information
        if($input = Input::all()){

            if(strtoupper($_SESSION['code'])!=strtoupper($input['code'])){
                return back()->with('msg','验证码错误！');
            }
            $user=User::first();
            if($user->user_name!=$input['user_name'] || Crypt::decrypt($user->user_pass)!=$input['pass_word']){

                return back()->with('msg','用户名或密码错误！');
            }
            session(['user'=>$user]);
            return redirect('admin/index');
        }
        else {

            return view('admin.login');
        }

    }
    //get verification code picture
    public function code()
    {
        $vcode=new \Vcode;
        $_SESSION['code'] = $vcode->getcode();
        $vcode->outimg();
    }
    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }

}
?>