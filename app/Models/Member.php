<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member';

    protected $fillable = ['users_id', 'nama', 'alamat' ,'no_telp', 'point'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
