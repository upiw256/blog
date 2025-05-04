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
    public function canAccessPanel(Panel $panel): bool
    {
        // Implement your logic here to determine if the user has access to the panel
        // For example:
        return $this->hasRole('web') ||  $this->hasRole('admin');
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
        $url = env('APP_URL_API', 'http://192.168.5.163:3001/api/');
        // set_time_limit(10015);
        // TODO: Implement sync() method.
        $response = Http::withHeaders([
            'X-Barrier' => 'margaasih',
        ])->get($url . 'guru');

        // dd($response);
        if ($response->ok()) {
            $data = $response->json();

            foreach ($data['rows'] as $item) {
                if ($item['jenis_ptk_id_str'] === 'Guru' || $item['jenis_ptk_id_str'] === 'Guru BK' || $item['jenis_ptk_id_str'] === 'Guru TIK' || $item['jenis_ptk_id_str'] === 'Kepala Sekolah') {
                    // dd(strtolower(str_replace(' ', '-', $item['nama'] . '@sman1mga.sch.id')));
                    $this->updateOrCreate(
                        ['email' => str_replace(['.', ','], '', strtolower(str_replace(' ', '-', $item['nama']))) . '@sman1mga.sch.id'],
                        [
                            'name' => $item['nama'],
                            'email' => str_replace(['.', ','], '', strtolower(str_replace(' ', '-', $item['nama']))) . '@sman1mga.sch.id',
                            'password' => '#sman1mga',

                        ]
                    );
                }
            }

            return true;
        }

        return false;
    }
}
