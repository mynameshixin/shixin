<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = 'comments';

    protected $guarded = array('id');

    //protected $hidden = array('created_at', 'updated_at');
}