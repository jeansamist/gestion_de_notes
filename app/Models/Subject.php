<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'code',
        
    ];

    /**
     * Get the grades associated with the subject.
     */
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
