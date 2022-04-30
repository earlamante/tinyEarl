<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    public function getTinyAttribute()
    {
        return idToString($this->id);
    }

    public function getTinyearlAttribute()
    {
        return config('app.url') . '/' . $this->custom;
    }
}
