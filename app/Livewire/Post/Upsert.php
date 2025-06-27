<?php

namespace App\Livewire\Post;

use App\Enums\ContentStatus;
use App\Models\Post;
use App\Livewire\Utils\Slug;
use App\Livewire\Utils\Status;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class Upsert extends Component
{
    use Status;
    use Slug;

    public $post = null;
    public $title = '';
    public $slug = '';
    public $status = 'draft';
    public $image = '';
    public $excerpt = '';
    public $content = '';

    public function mount($post = null): void
    {
        if ($post) {
            abort_if(Gate::denies('update post'), 403);

            $this->post = Post::find($post);
            if ($this->post) {
                $this->title = $this->post->title;
                $this->slug = $this->post->slug;
                $this->status = $this->post->status;
                $this->image = $this->post->image;
                $this->excerpt = $this->post->excerpt;
                $this->content = $this->post->content;
            } else {
                abort(404);
            }
        } else {
            abort_if(Gate::denies('create post'), 403);
        }
    }

    public function render()
    {
        return view('livewire.post.upsert');
    }

    protected function rules()
    {
        $rules = [
            'title' => 'required|string|min:4|max:255',
            'slug' => 'required|string|min:4|max:255',
            'status' => ['required', 'string', 'in:' . implode(',', ContentStatus::values())],
            'image' => 'nullable|url|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
        ];

        if ($this->post) {
            $rules['slug'] .= '|unique:posts,slug,' . ($this->post ? $this->post->id : 'NULL');
        }

        return $rules;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'status' => $this->status,
            'image' => $this->image,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
        ];

        if ($this->post) {
            $this->post->update($data);
            Toaster::success(__('Post updated successfully.'));
        } else {
            Post::create($data);
            Toaster::success(__('Post created successfully.'));
        }

        return redirect()->route('app.post.index');
    }
}
