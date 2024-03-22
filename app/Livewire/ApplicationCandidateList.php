<?php

namespace App\Livewire;

use Livewire\Component;

class ApplicationCandidateList extends Component
{
    /**
     * The applications for the user.
     */
    public $applications;

    /**
     * Mount the component.
     */
    public function mount()
    {
        $user = auth()->user();
        $this->applications = $user->applications;
    }
}
