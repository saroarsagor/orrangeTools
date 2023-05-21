<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'details',
        'start_time',
        'end_time',
        'project_id',
    ];

    public function project()
    {
        return $this->hasOne(Project::class,'id','project_id');
    }
}
