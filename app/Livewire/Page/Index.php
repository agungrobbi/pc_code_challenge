<?php

namespace App\Livewire\Page;

use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        abort_if(Gate::denies('view page'), 403);

        return view('livewire.page.index');
    }
}
