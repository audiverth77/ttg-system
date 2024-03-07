<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    protected $fillable = [
        'tittle',
        'description',
        'state', 
        'location', 
        'salary', 
        'employer_id'
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'employer_id'); 
    }

    public function applicationJob()
    {
        return $this->hasMany(ApplicationJob::class);
    }
}
