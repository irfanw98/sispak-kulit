<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    User,
    Aturan
};

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'tb_konsultasi';
    protected $fillable = ['user_id', 'aturan_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function penyakit() {
        return $this->belongsTo(Penyakit::class, 'kode_penyakit', 'kode_penyakit');
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