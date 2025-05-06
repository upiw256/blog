<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Env;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'ptk_id',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nuptk', 
        'nik',
        'bidang_studi_terakhir',
        'jenis_ptk_id_str',
        'nip',
    ];

    public function headmaster(): HasMany
    {
        return $this->hasMany(Headmaster::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'teacher_subjects', 'ptk_id', 'subject_id');
    }

    function TeacherSubject(): HasMany
    {
        return $this->hasMany(TeacherSubject::class, 'ptk_id');
    }

    /**
     * Define the relationship with schedules.
     */
    public function schedules(): HasManyThrough
    {
        return $this->hasManyThrough(
            Schedule::class,
            TeacherSubject::class,
            'ptk_id', // Foreign key on TeacherSubject table
            'teacher_subject_id', // Foreign key on Schedule table
            'ptk_id', // Local key on Teacher table
            'id' // Local key on TeacherSubject table
        );
    }

    public function sync()
    {
        $url = env('APP_URL_API', 'http://app.sman1mga.sch.id:30000/api/');
        $response = Http::withHeaders([
            'X-Barrier' => 'margaasih',
        ])->get($url . 'guru');

        if ($response->ok()) {
            $data = $response->json();
            $existingIds = [];
            foreach ($data['rows'] as $item) {

                $teacher = $this->updateOrCreate(
                    ['ptk_id' => $item['ptk_id']],
                    [
                        'ptk_id' => $item['ptk_id'],
                        'nama' => $item['nama'],
                        'jenis_kelamin' => $item['jenis_kelamin'] == 'P' ? 'Perempuan' : 'Laki-Laki',
                        'tempat_lahir' => $item['tempat_lahir'],
                        'tanggal_lahir' => $item['tanggal_lahir'],
                        'nuptk' => $item['nuptk'],
                        'nik' => $item['nik'],
                        'bidang_studi_terakhir' => $item['bidang_studi_terakhir'],
                        'jenis_ptk_id_str' => $item['jenis_ptk_id_str'],
                        'nip' => $item['nip'],
                    ]
                );
                $existingIds[] = $teacher->ptk_id;
            }

            // Delete teachers not present in the API response
            $this->whereNotIn('ptk_id', $existingIds)->delete();

            return true;
        }

        return false;
    }
}
