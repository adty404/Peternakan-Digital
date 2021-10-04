<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'office';

    protected $fillable = ['code', 'name', 'address', 'email', 'phone', 'pic', 'logo'];

    protected $hidden = [];

    public function animal(){
        return $this->hasManyThrough(Animal::class, Farm::class);
    }

    public function farm(){
        return $this->hasMany(Farm::class);
    }

    public function gallery(){
        return $this->hasMany(Gallery::class);
    }
}
