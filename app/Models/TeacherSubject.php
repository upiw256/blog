<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
class TeacherSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'subject_id'
    ];

    function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
    public function sync()
    {

        $url = env('APP_URL_API', 'http://192.168.5.163:3001/api/');
        // TODO: Implement sync() method.
        $response = Http::withHeaders([
            'X-Barrier' => 'margaasih',
        ])->get($url . 'rombel');

        if ($response->ok()) {
            $datas = $response->json();
            
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $this->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            
            foreach ($datas['rows'] as $data) {
                foreach ($data['pembelajaran'] as $pembelajaran) {
                    $mapel = Subject::where('kode_subject', $pembelajaran['mata_pelajaran_id'])->first();
                    if ($mapel) {
                        $guru = Teacher::where('ptk_id', $pembelajaran['ptk_id'])->first();
                        if ($guru) {
                            $this->updateOrCreate(
                                [
                                    'teacher_id' => $guru->id,
                                    'subject_id' => $mapel->id,
                                ],
                                [
                                    'teacher_id' => $guru->id,
                                    'subject_id' => $mapel->id,
                                ]
                            );
                        }
                    }
                }
            }

            return true;
        }

        return false;
    }
}
