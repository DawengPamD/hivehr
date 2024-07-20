<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'industry', 'size', 'address', 'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'company_user');
    }
}

