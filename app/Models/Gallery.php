<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery';

    protected $fillable = ['code', 'picture', 'created_by', 'updated_by'];

    protected $hidden = [];

    public function office(){
        return $this->belongsTo(Office::class, 'code', 'code');
    }

    public function farm(){
        return $this->belongsTo(Farm::class, 'code', 'code');
    }

    public function cb(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function ub(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
