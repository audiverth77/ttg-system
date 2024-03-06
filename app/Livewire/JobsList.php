<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class JobsList extends Component
{
    public $jobs;

    public function mount()
    {
        if (Auth::check()) {
            
            $this->jobs = Auth::user()->jobs()->get();
        } else {
            
            $this->jobs = collect();
        }
    }

    public function render()
    {
        return view('livewire.jobs-list', ['jobs' => $this->jobs])->layout('layouts.app');
    }
}
