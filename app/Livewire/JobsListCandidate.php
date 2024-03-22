<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;

class JobsListCandidate extends Component
{
    /**
     * The jobs for the user.
     * @var Job[]
     */
    public $jobs;

    /**
     * Mount the component.
     */
    public function mount()
    {
        $this->jobs = Job::active()->get();
    }
}
