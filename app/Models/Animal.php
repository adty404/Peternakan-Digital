<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'weight', 'height', 'condition', 'note', 'created_by', 'updated_by'];

    protected $hidden = [];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function farm(){
        return $this->belongsTo(Farm::class, 'farm_id', 'id');
    }
}
