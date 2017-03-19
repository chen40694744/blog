<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    //
    protected $table='navbar';
    protected  $primaryKey='nav_id';
    protected  $guarded=[];
    public $timestamps=false;
}
