<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Dokter extends Model
{
    use HasFactory, HasRoles, SoftDeletes;

    protected $table = 'tb_dokter';
    protected $guard = 'dokter';
    protected $primaryKey = 'kode_dokter';
    // public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'kode_dokter',
        'user_id',
        'nama',
        'username',
        'email',
        'foto'
    ];

    public static function kode()
    {
        $kode = DB::table('tb_dokter')->max('kode_dokter');
        $addNol = ' ';
        $kode = str_replace("DR-", "", $kode);
        $kode = (int) $kode + 1;
        $incrementKode = $kode;

        
    	if (strlen($kode) == 1) {
    		$addNol = "00";
    	} elseif (strlen($kode) == 2) {
    		$addNol = "0";
    	}

    	$kodeBaru = "DR-" . $addNol . $incrementKode;
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

     //Relations
    public function user() {
        return $this->belongsTo(User::class);
    }

}
