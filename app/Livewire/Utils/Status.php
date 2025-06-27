<?php

namespace App\Livewire\Utils;

use App\Enums\ContentStatus;

trait Status
{
    public function getContentStatusOptionsProperty()
    {
        return ContentStatus::toArray();
    }
}
