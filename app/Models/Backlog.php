<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backlog extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function systems()
    {
        return $this->belongsTo(System::class);
    }
}
