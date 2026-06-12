<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    //
    public function node()
    {
        return $this->belongsTo(Node::class);
    }
}
