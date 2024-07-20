<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partnership extends Model
{
    use HasFactory;

    protected $table = 'partnerships';

    protected $primaryKey = 'id'; 

    public $incrementing = true; 

    // Fillable attributes
    protected $fillable = [
        'name',          
        'start_date',
        'end_date',
    ];

    protected $dates = ['start_date', 'end_date']; 
}
