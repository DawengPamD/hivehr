<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $primaryKey = 'task_id'; // Define primary key

    public $incrementing = false; // Disable auto-incrementing for non-integer primary keys

    protected $fillable = [
        'task_id',
        'project_id',
        'name',
        'description',
        'due_date',
        'status',
        'priority',
    ];

    protected $dates = ['due_date']; // Cast dates

    /**
     * Get the project that owns the task.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }

    /**
     * Define any other relationships needed.
     */
}

