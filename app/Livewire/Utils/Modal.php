<?php

namespace App\Livewire\Utils;

trait Modal
{
    /**
     * Open modal event.
     *
     * @return void
     */
    private function modalEvent(string $event, string $parameter): void
    {
        $this->js("window.dispatchEvent(new CustomEvent('" . $event . "-modal', " . $parameter . "))");
    }

    /**
     * Reset modal.
     *
     * @return string
     */
    public function resetModal(array $fields): void
    {
        $this->reset($fields);
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
