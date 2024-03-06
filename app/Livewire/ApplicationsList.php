<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Application_job;

class ApplicationsList extends Component
{
    public $jobs;

    public function mount()
    {
        $this->Application_job = Application_job::all(); 
    }

    public function render()
    {
        return view('livewire.applications-list')->layout('layouts.app');
    }
}