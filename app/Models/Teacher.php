<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Http;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function headmaster(): HasMany
    {
        return $this->hasMany(Headmaster::class);
    }

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
                if ($item['jenis_ptk_id_str'] === 'Guru Mapel' || $item['jenis_ptk_id_str'] === 'Guru BK' || $item['jenis_ptk_id_str'] === 'Guru TIK' || $item['jenis_ptk_id_str'] === 'Kepala Sekolah') {
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
            }

            return true;
        }

        return false;
    }
}
