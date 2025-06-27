<?php

namespace App\Livewire\Post;

use App\Enums\ContentStatus;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Masmerise\Toaster\Toaster;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Table extends DataTableComponent
{
    protected $model = Post::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Post::query()->select(['id', 'title', 'slug', 'status']);
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->hideIf(true),
            Column::make('Title')
                ->sortable(),
            Column::make('Slug')
                ->sortable(),
            Column::make('Status', 'status')
                ->label(fn ($row) =>
                    ContentStatus::toArray()[$row->status] ?? 'Unknown'
                ),
            Column::make('Actions')
                ->label(
                    fn ($row) => view('livewire.post.table-actions', ['row' => $row])
                )
                ->html(),
        ];
    }

    #[On('do-post-delete')]
    public function deletePost(?int $id = null): void
    {
        Post::findOrFail($id)->delete();
        Toaster::success(__('Post deleted successfully!'));
    }
}
