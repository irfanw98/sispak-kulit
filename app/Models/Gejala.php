<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use App\Models\Penyakit;

class Gejala extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'tb_gejala';
    protected $guard = 'dokter';
    protected $primaryKey = 'kode_gejala';
    protected $keyType = 'string';
    protected $fillable = ['kode_gejala', 'nama',];

     public static function kode()
    {
        $kode = DB::table('tb_gejala')->max('kode_gejala');
        $addNol = ' ';
        $kode = str_replace("G", "", $kode);
        $kode = (int) $kode + 1;
        $incrementKode = $kode;

        
    	if (strlen($kode) == 1) {
    		$addNol = "00";
    	} elseif (strlen($kode) == 2) {
    		$addNol = "0";
    	}

    	$kodeBaru = "G" . $addNol . $incrementKode;
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
}
