<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Env;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    protected $guard_name = 'api';
    public function canAccessPanel(Panel $panel): bool
    {
        // Implement your logic here to determine if the user has access to the panel
        // For example:
        return $this->hasRole('web') || $this->hasPermissionTo('all');
    }
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_teacher',
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
    public function sync()
    {
        $teachers = Teacher::all(); // Ambil semua data dari tabel teachers

        foreach ($teachers as $teacher) {
            $email = strtolower(str_replace(' ', '', $teacher->nama)).'@sman1mga.sch.id'; // Ambil email dari tabel teachers
            $user = self::updateOrCreate(
                ['email' => $teacher->email], // Gunakan email dari tabel teachers
                [
                    'name' => $teacher->nama, // Gunakan nama dari tabel teachers
                    'email' => $email, // Email tetap dari tabel teachers
                    'password' => bcrypt('#sman1mga'), // Password default
                    'id_teacher' => $teacher->id, // Ambil id dari tabel teachers
                ]
            );
            if (!$user->hasRole('guru')) {
                $user->assignRole('guru');
            }
        }

        return true;
    }
}
