<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'matricule',
        'birth_date',
        'gender', // e.g., 'male', 'female', 'other'
        'class',
        'profile_photo',
        // Optionally, include 'gpa' if stored in the table.
        'gpa',
    ];

    /**
     * Get the user that owns this student record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the grades associated with the student.
     */
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
