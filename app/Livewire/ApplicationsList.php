<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\ApplicationJob;

class ApplicationsList extends Component
{
    public $jobs;

    public function mount($jobId = null)
    {
        $this->jobs = ApplicationJob::with(['user', 'job'])
                                ->when($jobId, function($query) use ($jobId) {
                                    return $query->where('job_id', $jobId);
                                })
                                ->get();
    }

    public function render()
    {
        return view('livewire.applications-list')->layout('layouts.app');
    }
}