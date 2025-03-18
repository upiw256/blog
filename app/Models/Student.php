<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model
{
    
    use HasFactory, HasApiTokens;
    protected $foreignKey = 'peserta_didik_id';
    protected $fillable = [
        'peserta_didik_id',
        'nipd',
        'sekolah_asal',
        'nama',
        'nisn',
        'jenis_kelamin',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'agama_id_str',
        'alamat_jalan',
        'nomor_telepon_seluler',
        'nama_ayah',
        'pekerjaan_ayah_id_str',
        'nama_ibu',
        'pekerjaan_ibu_id_str',
        'nama_wali',
        'pekerjaan_wali_id_str',
        'anak_keberapa',
        'nama_rombel',
        'extracurricular_activity_id',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function sync()
    {

        $url = env('APP_URL_API', 'http://192.168.5.163:3001/api/');
        // TODO: Implement sync() method.
        $response = Http::withHeaders([
            'X-Barrier' => 'margaasih',
        ])->get($url . 'siswa');

        if ($response->ok()) {
            $datas = $response->json();
            foreach ($datas['rows'] as $data) {
                $this->updateOrCreate(
                    ['peserta_didik_id' => $data['peserta_didik_id']],
                    [
                        'peserta_didik_id' => $data['peserta_didik_id'],
                        'nipd' => $data['nipd'],
                        'sekolah_asal' => $data['sekolah_asal'],
                        'nama' => $data['nama'],
                        'nisn' => $data['nisn'],
                        'jenis_kelamin' => $data['jenis_kelamin'] == 'P' ? 'Perempuan' : 'Laki-Laki',
                        'nik' => $data['nik'],
                        'tempat_lahir' => $data['tempat_lahir'],
                        'tanggal_lahir' => $data['tanggal_lahir'],
                        'agama_id_str' => $data['agama_id_str'],
                        'nomor_telepon_seluler' => $data['nomor_telepon_seluler'],
                        'nama_ayah' => $data['nama_ayah'],
                        'pekerjaan_ayah_id_str' => $data['pekerjaan_ayah_id_str'],
                        'nama_ibu' => $data['nama_ibu'],
                        'pekerjaan_ibu_id_str' => $data['pekerjaan_ibu_id_str'],
                        'nama_wali' => $data['nama_wali'],
                        'pekerjaan_wali_id_str' => $data['pekerjaan_wali_id_str'],
                        'anak_keberapa' => $data['anak_keberapa'],
                        'nama_rombel' => $data['nama_rombel'],
                    ]
                );
            }

            return true;
        }

        return false;
    }

}
