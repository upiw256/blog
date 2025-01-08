<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;
class Subject extends Model
{
    use HasFactory;
    protected $guarded = [];

    function TeacherSubject(): HasMany
    {
        return $this->hasMany(TeacherSubject::class);
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subjects', 'subject_id', 'teacher_id');
    }
    public function sync()
    {
        $url = env('APP_URL_API', 'http://app.sman1mga.sch.id:30000/api/');
        // TODO: Implement sync() method.
        $response = Http::withHeaders([
            'X-Barrier' => 'margaasih',
        ])->get($url . 'rombel');

        if ($response->ok()) {
            $datas = $response->json();

            // Looping through the 'rows' array
            foreach ($datas['rows'] as $data) {
                // Loop through the 'pembelajaran' array to get the 'nama_mata_pelajaran'
                if (isset($data['pembelajaran']) && is_array($data['pembelajaran'])) {
                    foreach ($data['pembelajaran'] as $pembelajaran) {
                        $this->updateOrCreate(
                            ['kode_subject' => $pembelajaran['mata_pelajaran_id']],
                            [
                                'kode_subject' => $pembelajaran['mata_pelajaran_id'],
                                'name' => $pembelajaran['nama_mata_pelajaran'],
                                'updated_at' => now(),
                            ]
                        );
                    }
                } else {
                    // Jika 'pembelajaran' tidak ada atau bukan array
                    Log::warning("Data pembelajaran tidak ditemukan untuk peserta_didik_id: " . $data['peserta_didik_id']);
                }


            }

            return true;
        }

        return false;

    }

}