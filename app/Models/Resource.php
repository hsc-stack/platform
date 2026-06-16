<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read \App\Models\Node $node
 */
class Resource extends Model
{
    protected $fillable = [
        'node_id',
        'resource_type',
        'title',
        'content',
        'file_url',
    ];
    //
    public function node()
    {
        return $this->belongsTo(Node::class);
    }
}
