<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'office';

    protected $fillable = ['code', 'name', 'address', 'email', 'phone', 'pic'];

    protected $hidden = [];
}
