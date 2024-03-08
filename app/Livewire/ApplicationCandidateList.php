<?php

namespace App\Livewire;

use App\Models\ApplicationJob; 
use Livewire\Component;

class ApplicationCandidateList extends Component
{
    public $applications;

    public function mount()
    {
        $user = auth()->user();
        $this->applications = $user->applications()->get();

        // ApplicationJob::with(['user', 'job'])
        //                         ->when($candidateId, function($query) use ($candidateId) {
        //                             return $query->where('candidate_id', $candidateId);
        //                         })
        //                         ->get();
    }

    public function render()
    {
        return view('livewire.application-candidate-list')->layout('layouts.app');
    }
}
