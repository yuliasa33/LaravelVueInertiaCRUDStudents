<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classItem extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'table_class_item';

    // The attributes that are mass assignable
    protected $fillable = [ 
        'class_name',
    ];

    // Optional: Specify the primary key if it's not 'id'
    protected $primaryKey = 'class_id';
}
