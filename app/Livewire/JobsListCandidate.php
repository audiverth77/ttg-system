<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Job;

class JobsListCandidate extends Component
{
    public $jobs;

    public function mount()
    {
        $this->jobs = Job::where('state', 1)->get();
    }

    public function render()
    {
        return view('livewire.jobs-list-candidate', ['jobs' => $this->jobs])->layout('layouts.app');
    }
}
