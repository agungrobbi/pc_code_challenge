<?php

namespace App\Livewire\Category;

use App\Livewire\Utils\Modal;
use App\Livewire\Utils\Slug;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\Attributes\On;
use Masmerise\Toaster\Toaster;

class Upsert extends Component
{
    use Modal;
    use Slug;

    private $modalParameter = "{ detail: 'modalCategory' }";
    private $fields = ['category', 'title', 'slug'];

    public ?Category $category = null;
    public $title = '';
    public $slug = '';

    public function mount(?Category $category = null): void
    {
        if ($category) {
            $this->category = $category;
            $this->title = $category->title;
            $this->slug = $category->slug;
        }
    }

    public function render()
    {
        return view('livewire.category.modal');
    }

    #[On('open-category-modal')]
    public function openModal(?int $id = null): void
    {
        if ($id) {
            abort_if(Gate::denies('edit_category'), 403);

            $this->category = Category::findOrFail($id);
            $this->title = $this->category->title;
            $this->slug = $this->category->slug;
        } else {
            abort_if(Gate::denies('create_category'), 403);

            $this->resetModal($this->fields);
        }

        $this->modalEvent('open', $this->modalParameter);
    }

    public function save(): void
    {
        $rules = [
            'title' => 'required|string|min:4|max:255',
            'slug' => 'required|string|min:4|max:255',
        ];

        if ($this->category) {
            abort_if(Gate::denies('edit_category'), 403);

            $rules['slug'] .= '|unique:categories,slug,' . $this->category->id;
        }
        else {
            abort_if(Gate::denies('create_category'), 403);
        }

        $validated = $this->validate($rules);

        if ($this->category) {
            $this->category->update($validated);
            Toaster::success(__('Category updated successfully!'));
        } else {
            Category::create($validated);
            Toaster::success(__('Category created successfully!'));
        }

        $this->modalEvent('close', $this->modalParameter);
        $this->resetModal($this->fields);

        $this->dispatch('refresh-category-table');
    }

    #[On('do-category-delete')]
    public function deleteModal(?int $id = null): void
    {
        abort_if(Gate::denies('delete_category'), 403);

        Category::findOrFail($id)->delete();
        Toaster::success(__('Category deleted successfully!'));

        $this->dispatch('refresh-category-table');
    }
}
