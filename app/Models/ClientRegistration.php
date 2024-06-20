<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'email',
        'fullName',
        'phoneNumber',
    ];
}
