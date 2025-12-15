<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';
    protected $primaryKey = 'IdAdmin';
    public $timestamps = false;

    protected $fillable = [
        'Nama',
        'Email',
        'NoTelpon',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'IdAdmin', 'IdAdmin');
    }
}
