<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    const STATE_ACTIVE = 1;
    const STATE_INACTIVE = 0;

    protected $table = 'jobs';

    protected $fillable = [
        'tittle',
        'description',
        'state', 
        'location', 
        'salary', 
        'employer_id'
    ];

    /**
     * Get the user that owns the job.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'employer_id'); 
    }

    /**
     * Get the candidates that applied to the job.
     */
    public function candidates()
    {
        return $this->belongsToMany(User::class, 'applications_job', 'job_id', 'candidate_id');
    }

    /**
     * Active scope
     */
    public function scopeActive($query)
    {
        return $query->where('state', self::STATE_ACTIVE);
    }
}
