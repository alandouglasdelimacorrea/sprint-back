<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    protected $fillable = [ 'name', 'description', 'status', 'points', 'progress', 'open'];

    public function backlogs()
    {
        return $this->belongsTo(Backlog::class);
    }

    public function time_entries()
    {
        return $this->hasMany(TimeEntry::class);
    }

    public function notations()
    {
        return $this->belongsToMany(Task::class, "notations");
    }





}
