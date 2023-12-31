<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kkj extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ["id"];

    public function kkj_kepala_keluarga(){
        return $this->hasOne(KkjKepalaKeluarga::class);
    }
    public function kkj_pasangan(){
        return $this->hasOne(KkjPasangan::class);
    }
    public function kkj_anak(){
        return $this->hasMany(KkjAnak::class);
    }
    public function kkj_keluarga(){
        return $this->hasMany(KkjKeluarga::class);
    }
    public function urgent(){
        return $this->hasOne(Urgent::class);
    }
}
