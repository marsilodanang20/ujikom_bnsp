<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'kd_jurusan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kd_jurusan',
        'nm_jurusan',
        'durasi',
        'biaya',
    ];

    public function peserta(): HasMany
    {
        return $this->hasMany(Peserta::class, 'kd_jurusan', 'kd_jurusan');
    }

    public function pendaftaran(): HasMany
    {
        return $this->hasMany(Pendaftaran::class, 'kd_jurusan', 'kd_jurusan');
    }
}
