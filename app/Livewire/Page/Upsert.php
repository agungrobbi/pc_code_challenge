<?php

namespace App\Livewire\Page;

use App\Enums\ContentStatus;
use App\Livewire\Utils\Slug;
use App\Livewire\Utils\Status;
use App\Models\Page;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class Upsert extends Component
{
    use Status;
    use Slug;

    public $page = null;
    public $title = '';
    public $slug = '';
    public $status = 'draft';
    public $body = '';

    public function mount($page = null): void
    {
        if ($page) {
            abort_if(Gate::denies('update page'), 403);

            $this->page = Page::find($page);
            if ($this->page) {
                $this->title = $this->page->title;
                $this->slug = $this->page->slug;
                $this->status = $this->page->status;
                $this->body = $this->page->body;
            } else {
                abort(404);
            }
        }
        else {
            abort_if(Gate::denies('create page'), 403);
        }
    }

    public function render()
    {
        return view('livewire.page.upsert');
    }

    protected function rules()
    {
        $rule = [
            'title' => 'required|string|min:4|max:255',
            'slug' => 'required|string|min:4|max:255',
            'body' => 'required|string',
            'status' => ['required', 'string', 'in:' . implode(',', ContentStatus::values())],
        ];

        if ($this->page) {
            $rule['slug'] .= '|unique:pages,slug,' . ($this->page ? $this->page->id : 'NULL');
        }

        return $rule;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'status' => $this->status,
        ];

        if ($this->page) {
            $this->page->update($data);
            Toaster::success(__('Page updated successfully.'));
        } else {
            Page::create($data);
            Toaster::success(__('Page created successfully.'));
        }

        return redirect()->route('app.page.index');
    }
}
