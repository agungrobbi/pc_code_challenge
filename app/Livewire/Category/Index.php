<?php

namespace App\Livewire\Category;

use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        abort_if(Gate::denies('view_category'), 403);

        return view('livewire.category.index');
    }
}
