<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //图片上传
    public function upload()
    {
        $file=Input::file('Filedata');
        if($file->isValid()){
            $entension=$file->getClientOriginalExtension();
            $newName=date('YmdHis').mt_rand(100,999).'.'.$entension;
            $file->move(base_path().'/public'.'/uploads',$newName);
            $filepath='uploads/'.$newName;
            return $filepath;
        }
    }
}
