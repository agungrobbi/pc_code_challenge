<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Table extends DataTableComponent
{
    protected $model = Category::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
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
            Column::make('Actions')
                ->label(
                    fn ($row, Column $column) => view('livewire.category.table-actions', ['row' => $row])
                )
                ->html(),
        ];
    }

    #[On('refresh-category-table')]
    public function refreshTable(): void
    {
        // Livewire automatically re-renders the component when a method
        // with #[On] is called. For Rappasoft tables, this re-render
        // is enough to trigger a fresh data fetch.
    }
}
