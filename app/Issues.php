<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
     protected $table = 'issues';




    public function categories()
    {
       return $this->belongsTo(Categories::class, 'categories_id');
    }

}

