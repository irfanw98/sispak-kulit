<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Dokter extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'tb_dokter';
    protected $guard = 'dokter';
    protected $primaryKey = 'kode_dokter';
    protected $fillable = [
        'user_id',
        'nama',
        'username',
        'email',
        'foto'
    ];

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
