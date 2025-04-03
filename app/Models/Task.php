<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    // Below fillable variable is a new code.
    protected $fillable = [
        'task',
        'is_completed',
    ];
}
