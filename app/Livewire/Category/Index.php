<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.category.index');
    }
}
