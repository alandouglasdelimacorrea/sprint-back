<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public function user()
    {
        return $this->belongsToMany(User::class, "user_systems");
    }

    public function backlogs()
    {
        return $this->hasMany(Backlog::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
