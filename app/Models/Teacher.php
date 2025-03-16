<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
        'specialty',   // Optional field for additional info
        'department',  // Optional field for additional info
    ];

    /**
     * Get the user associated with this teacher.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the subject this teacher teaches.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
