<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cat_id',
        'image',
        'gender'
    ];
    public function catagories(){
        return $this->belongsTo(Catagory::class,'cat_id');
    }
}
