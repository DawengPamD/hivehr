<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $primaryKey = 'project_id'; // Define primary key

    public $incrementing = false; // Disable auto-incrementing for non-integer primary keys

    protected $fillable = [
        'project_id',
        'project_name',
        'partnership_id',
        'project_manager',
        'status',
        'start_date',
        'end_date',
    ];

    protected $dates = ['start_date', 'end_date']; // Cast dates
    
}
