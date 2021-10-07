<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peristiwa extends Model
{
    use HasFactory;

    protected $table = 'peristiwa';

    protected $fillable = ['animal_id', 'tanggal', 'waktu', 'peristiwa', 'keterangan', 'foto', 'created_by', 'updated_by'];

    protected $hidden = [];

    public function cb(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function ub(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function animal(){
        return $this->belongsTo(Animal::class, 'animal_id', 'id');
    }
}
