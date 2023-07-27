<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        "estado",
        "direction",
        "birthday",
        "dni",
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function adminlte_image(){
        return "https://picsum.photos/300/300";
    }

    public function adminlte_desc() {
        // Verifica que el usuario esté autenticado
        if (Auth::check()) {
            // Obtiene el usuario actualmente autenticado
            $user = Auth::user();
            
            // Verifica que el usuario tenga roles asignados
            if ($user->roles->count() > 0) {
                // Obtiene el rol del usuario
                $rol = $user->roles->first()->name;
         
                return $rol;
            }
        }
    
        return 'Usuario sin rol';
    }
    

    public $timestamps = false;
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, "curso_users", 'user_id', 'curso_id');
    }
}

