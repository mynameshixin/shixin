<?php

namespace App\Models;

class CollectionFolder extends BaseModel
{
    protected $table = 'collection_folder';

    public $timestamps = false;

    protected $hidden = ['created_at', 'updated_at'];

    public function folder(){
        return $this->belongsTo(Folder::class, 'folder_id');
    }

}
