<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menuModel extends Model
{
    use HasFactory;
    protected $table = 'menu';   
    public $timestamps = false;
    protected $row = ['id','menu_name','description','price','menu_image'];    
    // protected $connection = env('DB_CONNECTION');

}
