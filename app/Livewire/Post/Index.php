<?php

namespace App\Livewire\Post;

use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        abort_if(Gate::denies('view post'), 403);

        return view('livewire.post.index');
    }
}
