<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Http;
class Teacher extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function headmaster(): HasMany
    {
        return $this->hasMany(Headmaster::class);
    }
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'teacher_subjects', 'teacher_id', 'subject_id');
    }
    function TeacherSubject(): HasMany
    {
        return $this->hasMany(TeacherSubject::class);
    }
    public function schedules(): HasManyThrough
    {
        return $this->hasManyThrough(Schedule::class, TeacherSubject::class, 'teacher_id', 'teacher_subject_id');
    }


    public function sync()
    {
        $url = env('APP_URL_API', 'http://app.sman1mga.sch.id:30000/api/');
        // set_time_limit(10015);
        // TODO: Implement sync() method.
        $response = Http::withHeaders([
            'X-Barrier' => 'margaasih',
        ])->get($url . 'guru');

        // dd($response);
        if ($response->ok()) {
            $data = $response->json();

            foreach ($data['rows'] as $item) {

                $this->updateOrCreate(
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
            }

            return true;
        }

        return false;
    }
}
