<?php

namespace App\Livewire\Page;

use App\Enums\ContentStatus;
use App\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;
use Masmerise\Toaster\Toaster;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Table extends DataTableComponent
{
    protected $model = Page::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Page::query()->select(['id', 'title', 'slug', 'status']);
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
                    fn ($row) => view('livewire.page.table-actions', ['row' => $row])
                )
                ->html(),
        ];
    }

    #[On('do-page-delete')]
    public function deletePage(?int $id = null): void
    {
        abort_if(Gate::denies('delete_page'), 403);

        Page::findOrFail($id)->delete();
        Toaster::success(__('Page deleted successfully!'));
    }
}
