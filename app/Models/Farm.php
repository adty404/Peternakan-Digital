<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Farm extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['code', 'office_id', 'name', 'address', 'email', 'phone', 'pic'];

    protected $hidden = [];

    public function office(){
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }
}
