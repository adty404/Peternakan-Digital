<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Farm extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'farm';

    protected $fillable = ['code', 'office_id', 'name', 'address', 'email', 'phone', 'pic', 'logo', 'qrcode'];

    protected $hidden = [];

    public function animal(){
        return $this->hasMany(Animal::class, 'farm_id');
    }
    
    public function office(){
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    public function gallery(){
        return $this->hasMany(Gallery::class);
    }

}
