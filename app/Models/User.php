<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'users';
    protected $fillable = ['username', 'email', 'password', 'entry_year', 'graduation_year', 'major', 'date_of_birth', 'address', 'phone_number', 'job'];
}
