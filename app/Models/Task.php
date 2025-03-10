<?php

namespace App\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_name',
        'task_description',
        'task_start_date',
        'task_end_date',
        'assigned_to',
        'created_by',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
