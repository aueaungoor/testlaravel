<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // ✅ ใช้ Authenticatable แทน Model
use Illuminate\Notifications\Notifiable;

class Map extends Model
{
    use HasFactory;

    protected $table = 'user'; // ✅ ระบุชื่อตาราง (ถ้าชื่อไม่ตรงกับ Laravel naming convention)
    
    protected $fillable = ['fname', 'lname', 'lat', 'lng']; // ✅ ระบุฟิลด์ที่สามารถ insert ได้
}
