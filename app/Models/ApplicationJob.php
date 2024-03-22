<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationJob extends Model
{
    use HasFactory;

    protected $table = 'applications_job';

    protected $fillable = [
        'job_id',
        'candidate_id',
        'application_date',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    /**
     * Obtiene el usuario que realiza la aplicación.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }   
}
