<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

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


    public function sync()
    {

        $url = env('APP_URL_API', 'http://192.168.5.163:3001/api/');
        // TODO: Implement sync() method.
        $response = Http::withHeaders([
            'X-Barrier' => 'margaasih',
        ])->get($url . 'rombel');

        if ($response->ok()) {
            $datas = $response->json();
            foreach ($datas['rows'] as $data) {
                $this->updateOrCreate(
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
            }

            return true;
        }

        return false;
    }
}
