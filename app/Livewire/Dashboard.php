<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'totalCategories' => Category::count(),
            'totalPages' => Page::count(),
            'totalPosts' => Post::count(),
        ]);
    }
}
