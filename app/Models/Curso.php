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
}
