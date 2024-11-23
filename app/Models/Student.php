<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'students';

    // The attributes that are mass assignable
    protected $fillable = [ 
        'name', 
        'age', 
        'class_id', 
        'section_id',
        'class_name',
        'section_name'
    ];

    // Optional: Specify the primary key if it's not 'id'
    protected $primaryKey = 'id';
}
