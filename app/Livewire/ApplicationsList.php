<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;

class ApplicationsList extends Component
{
    /**
     * Id of the job.
     */
    public int $id;

    /**
     * The candidates for the job.
     */
    public $candidates = [];

    /**
     * Mount the component.
     * @param Job $job
     * @return void
     */
    public function mount(Job $job)
    {
        $this->fill($job->toArray());
        $this->candidates = $job->candidates;
    }
}
