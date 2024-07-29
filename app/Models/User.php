<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, softDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'email_verified_at'
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

    public function rol(): HasOne
    {
        return $this->hasOne(Rol::class, 'user_id');
    }

    public function ordens(): HasMany
    {
        return $this->hasMany(Orden::class, 'user_id');
    }

    public function cupones()
    {
        return $this->hasMany(Cupon::class, 'user_id');
    }


    public $user;
    public $isAdmin;

    public function mount()
    {
        $this->user = auth()->user();
        if ($this->user) {
            $this->isAdmin = $this->user->is_admin;
        }
    }

    public function canAccessPanel(Panel $panel): bool
    {
        $is_admin =  false;

        //return $is_admin;

        return $this -> is_admin == 1;
    }
}
