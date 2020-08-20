<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['path', 'activity_id', 'name'];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
