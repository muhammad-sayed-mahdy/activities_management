<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
