<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'student_id',
        'subject_id',
        'grade', // Numeric grade value
        'semester',
        'school_year',
    ];

    /**
     * Get the student associated with this grade.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the subject associated with this grade.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
