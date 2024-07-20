<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'companies', 'email', 'token','role',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
