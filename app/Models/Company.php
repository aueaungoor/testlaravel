<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // ✅ ใช้ Authenticatable แทน Model
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['username', 'password']; // ✅ ต้องมี username และ password
    protected $hidden = ['password']; // ✅ ป้องกันไม่ให้ password ถูกเรียกใช้โดยตรง
}
