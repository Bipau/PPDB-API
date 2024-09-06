<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalonSiswa extends Model
{
    use HasFactory;
    protected $table = 'pendaftarans';
    protected $fillable = [
        'NISN',
        'nama',
        'alamat',
        'tgl_lahir',
        'tmp_lahir',
        'jenis_kelamin',
        'agama',
        'asal_sekolah',
        'nama_ortu',
        'pekerjaan_ortu',
        'no_telp_ortu',
        'foto'
    ];
}
