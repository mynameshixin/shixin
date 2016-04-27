<?php

namespace App\Models;

class CommentAction extends BaseModel
{
    protected $table = 'comment_action';

    public $timestamps = false;

    protected $hidden = ['created_at', 'updated_at'];

}
