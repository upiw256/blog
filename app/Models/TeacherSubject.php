<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Env;
class TeacherSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'ptk_id',
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
        $response = Http::withHeaders([
            'X-Barrier' => 'margaasih',
        ])->get($url . 'rombel');

        if ($response->ok()) {
            $datas = $response->json();
            $existingIds = [];

            foreach ($datas['rows'] as $data) {
                foreach ($data['pembelajaran'] as $pembelajaran) {
                    $mapel = Subject::where('kode_subject', $pembelajaran['mata_pelajaran_id'])->first();
                    if ($mapel) {
                        $guru = Teacher::where('ptk_id', $pembelajaran['ptk_id'])->first();
                        if ($guru) {
                            $this->updateOrCreate(
                                [
                                    'ptk_id' => $guru->ptk_id,
                                    'subject_id' => $mapel->id,
                                ],
                                [
                                    'ptk_id' => $guru->ptk_id,
                                    'subject_id' => $mapel->id,
                                    'teacher_id' => $guru->id, // Populate the teacher_id column
                                ]
                            );
                            $existingIds[] = [
                                'ptk_id' => $guru->ptk_id,
                                'subject_id' => $mapel->id,
                            ];
                        }
                    }
                }
            }

            // Insert data into temp_teacher_subjects
            DB::table('temp_teacher_subjects')->insert(array_map(function ($item) {
                return [
                    'ptk_id' => (string) $item['ptk_id'], // Ensure ptk_id is cast to string
                    'subject_id' => (int) $item['subject_id'], // Ensure subject_id is cast to integer
                ];
            }, $existingIds));

            // Use a temporary table to store IDs to delete
            $idsToDelete = DB::table('teacher_subjects')
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('temp_teacher_subjects')
                        ->whereRaw('teacher_subjects.ptk_id = temp_teacher_subjects.ptk_id')
                        ->whereRaw('teacher_subjects.subject_id = temp_teacher_subjects.subject_id');
                })
                ->pluck('id');

            // Delete the rows using the collected IDs
            $this->whereIn('id', $idsToDelete)->delete();

            // Truncate the temp_teacher_subjects table
            DB::table('temp_teacher_subjects')->truncate();

            return true;
        }

        return false;
    }
}
