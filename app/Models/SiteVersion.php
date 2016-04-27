<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteVersion extends Model
{

    protected $table = 'site_versions';
    
    protected $guarded = array('id');
    
    protected $hidden = array('created_at', 'updated_at');

}
