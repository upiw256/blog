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
use Illuminate\Support\Facades\DB;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    function TeacherSubject(): HasMany
    {
        return $this->hasMany(TeacherSubject::class);
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subjects', 'subject_id', 'ptk_id', 'id', 'ptk_id');
    }

    public function sync()
    {
        $url = env('APP_URL_API', 'http://app.sman1mga.sch.id:30000/api/');
        $response = Http::withHeaders([
            'X-Barrier' => 'margaasih',
        ])->get($url . 'rombel');

        if ($response->ok()) {
            $datas = $response->json();
            $existingSubjects = $this->pluck('kode_subject')->toArray();
            $apiSubjects = [];

            // Looping through the 'rows' array
            foreach ($datas['rows'] as $data) {
                // Loop through the 'pembelajaran' array to get the 'nama_mata_pelajaran'
                if (isset($data['pembelajaran']) && is_array($data['pembelajaran'])) {
                    foreach ($data['pembelajaran'] as $pembelajaran) {
                        $apiSubjects[] = $pembelajaran['mata_pelajaran_id'];

                        $this->updateOrCreate(
                            ['kode_subject' => $pembelajaran['mata_pelajaran_id']],
                            [
                                'kode_subject' => $pembelajaran['mata_pelajaran_id'],
                                'name' => $pembelajaran['nama_mata_pelajaran'],
                                'updated_at' => \Carbon\Carbon::now(),
                            ]
                        );
                    }
                } else {
                    Log::warning("Data pembelajaran tidak ditemukan untuk peserta_didik_id: " . $data['peserta_didik_id']);
                }
            }

            // Delete subjects that are not in the API
            $subjectsToDelete = array_diff($existingSubjects, $apiSubjects);
            $this->whereIn('kode_subject', $subjectsToDelete)->delete();

            return true;
        }

        return false;
    }
}