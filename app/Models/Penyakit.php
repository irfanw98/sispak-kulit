<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use App\Models\Gejala;

class Penyakit extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'tb_penyakit';
    protected $guard = 'dokter';
    protected $primaryKey = 'kode_penyakit';
    protected $keyType = 'string';
    protected $fillable = [
        'kode_penyakit', 
        'nama', 
        'deskripsi', 
        'solusi'
    ];

    public static function kode()
    {
        $kode = DB::table('tb_penyakit')->max('kode_penyakit');
        $addNol = ' ';
        $kode = str_replace("P", "", $kode);
        $kode = (int) $kode + 1;
        $incrementKode = $kode;

        
    	if (strlen($kode) == 1) {
    		$addNol = "00";
    	} elseif (strlen($kode) == 2) {
    		$addNol = "0";
    	}

    	$kodeBaru = "P" . $addNol . $incrementKode;
    	return $kodeBaru;
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

     public function gejala()
    {
        return $this->belongsToMany(Gejala::class, 'tb_aturan', 'penyakit_kode','gejala_kode');
    }
}
