<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laravel\Sanctum\HasApiTokens as SanctumHasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;
    protected $table = "admin";
    protected $primaryKey = "id_admin";
    protected $fillable = [
        'id_user',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
