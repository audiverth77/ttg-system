<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class JobsList extends Component
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
        $user = Auth::user();
        $this->jobs = $user->jobs ?? [];
    }
}
