<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use App\User;

class Admin extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'tb_admin';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','nama','username','created_at','updated_at'];

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