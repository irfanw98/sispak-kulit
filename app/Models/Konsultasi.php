<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Konsultasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_konsultasi';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'kode_penyakit', 'kode_gejala'];


    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function penyakit() {
        return $this->belongsTo(Penyakit::class, 'kode_penyakit', 'kode_penyakit');
    }

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
        ->format('d-m-Y');
    }

    public function getUpdatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['updated_at'])
        ->diffForHumans();
    }
}
