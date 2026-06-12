<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function nodes()
    {
        return $this->hasMany(Node::class);
    }
}
