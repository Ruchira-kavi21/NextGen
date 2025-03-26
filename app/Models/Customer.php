<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\Hash;

class Customer extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $fillable = ['first_name', 'last_name', 'address', 'Zipcode', 'phone_number', 'optional_phone_number', 'email', 'password', 'status'];

    public function setPasswordAttribute($value)
{
    if (strlen($value) !== 60 || !preg_match('/^\$2[ayb]\$.{56}$/', $value)) {
        $this->attributes['password'] = bcrypt($value);
    } else {
        $this->attributes['password'] = $value;
    }
}
    protected $hidden = [
        'password',
        'remember_token',
    ];
}