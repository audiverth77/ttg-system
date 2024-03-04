<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application_job extends Model
{
    use HasFactory;

    protected $table = 'applications_job';

    protected $fillable = [
        'application_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
