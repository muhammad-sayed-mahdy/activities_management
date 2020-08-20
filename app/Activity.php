<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = ['id', 'started_at', 'ended_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
