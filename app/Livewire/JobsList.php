<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Job;

class JobsList extends Component
{
    public function mount()
    {
        $this->jobs = Job::all();
    }

    public function render()
    {
        return view('livewire.jobs-list')->layout('layouts.app');
    }
}
