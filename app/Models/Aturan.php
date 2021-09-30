<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Gejala,
    Penyakit
};

class Aturan extends Model
{
    use HasFactory;

    protected $table = 'tb_aturan';
    protected $primaryKey = 'id';
    protected $fillable = ['penyakit_kode', 'gejala_kode'];

    public function gejala()
    {
        return $this->belongsTo(Gejala::class, 'gejala_kode', 'kode_gejala');
    }

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_kode', 'kode_penyakit');
    }

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
        ->format('d, M Y H:i');
    }

    public function getUpdatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['updated_at'])
        ->diffForHumans();
    }
}
