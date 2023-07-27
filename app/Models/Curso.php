<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;


class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'curso_users', 'curso_id', 'user_id');
    }
}
