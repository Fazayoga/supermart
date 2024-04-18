<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Admin extends Authenticatable implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'user_type',
    ];

    protected $hidden = [
        'password',
    ];

    protected $primaryKey = 'id'; // Adjust based on your primary key column name

    public function getAuthPassword()
    {
        return $this->password;
    }

    // Customize credentials validation if needed
    public function validateCredentials($credentials)
    {
        return $this->password === $credentials['password'];
    }

    public function saveProfile($name, $email, $password = null)
    {
        $this->name = $name;
        $this->email = $email;

        if ($password !== null) {
            $this->password = Hash::make($password);
        }

        return $this->save();
    }
}
