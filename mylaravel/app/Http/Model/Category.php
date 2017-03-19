<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table='category';
    protected  $primaryKey='cate_id';
    protected  $guarded=[];
    public $timestamps=false;

    public function tree()
    {
        $category=$this->orderby('cate_order','asc')->get();
        return $this->getTree($category, 'cate_id','cate_pid','cate_name',0);
    }


    public function getTree($data,$field_id, $field_pid,$cate_,$pid)
    {
        $arr=array();
        foreach ($data as $d=>$v)
        {

            if($v->$field_pid==$pid){
                $data[$d]["_".$cate_]=$data[$d]["$cate_"];
                $arr[] =$data[$d];
                foreach ($data as $m=>$n){
                    if($n->$field_pid==$v->$field_id){
                        $data[$m]["_".$cate_]='☛'.$data[$m]["$cate_"];
                        $arr[] =$data[$m];
                    }
                }
            }
        }
        return $arr;
    }
}
