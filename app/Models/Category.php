<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = ['name', 'created_by', 'updated_by'];

    protected $hidden = [];

    public function cb(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function ub(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
