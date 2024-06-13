<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'priority', 'due_date', 'is_completed', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

