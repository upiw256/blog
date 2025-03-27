<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Env;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class ClassRoom extends Model
{
    use HasFactory;
    protected $fillable = [
        'rombongan_belajar_id',
        'nama',
        'tingkat_pendidikan_id',
        'tingkat_pendidikan_id_str',
        'jenis_rombel_str',
        'kurikulum_id_str',
        'id_ruang_str',
        'moving_class',
        'ptk_id_str',
        'jurusan_id_str',
    ];
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
    public function student(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function sync()
    {
        $url = env('APP_URL_API', 'http://192.168.5.163:3001/api/');

        $response = Http::withHeaders([
            'X-Barrier' => 'margaasih',
        ])->get($url . 'rombel');

        if ($response->ok()) {
            $datas = $response->json();
            $existingIds = []; // To track IDs from the API

            foreach ($datas['rows'] as $data) {
                // Abaikan data jika jenis_rombel_str adalah "Ekstrakurikuler"
                if (strtolower($data['jenis_rombel_str']) === 'ekstrakurikuler' || $data['jenis_rombel_str'] === 'Matapelajaran Pilihan' || $data['jenis_rombel_str'] === 'Teori') {
                    continue;
                }

                $classRoom = $this->updateOrCreate(
                    [
                        'rombongan_belajar_id' => $data['rombongan_belajar_id'],
                    ],
                    [
                        'nama' => $data['nama'],
                        'tingkat_pendidikan_id' => $data['tingkat_pendidikan_id'],
                        'tingkat_pendidikan_id_str' => $data['tingkat_pendidikan_id_str'],
                        'jenis_rombel_str' => $data['jenis_rombel_str'],
                        'kurikulum_id_str' => $data['kurikulum_id_str'],
                        'id_ruang_str' => $data['id_ruang_str'],
                        'moving_class' => $data['moving_class'],
                        'ptk_id_str' => $data['ptk_id_str'],
                        'jurusan_id_str' => $data['jurusan_id_str'],
                    ]
                );

                $existingIds[] = $classRoom->rombongan_belajar_id; // Collect the IDs of synced data
            }

            // Delete classes that are not in the API response
            $this->whereNotIn('rombongan_belajar_id', $existingIds)->delete();

            return true;
        }

        return false;
    }

}
